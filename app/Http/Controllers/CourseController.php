<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Course;
use App\Career;
use App\Http\Requests\CourseRequest;
use Session;
use Hash;
use Redirect;
use Validator;
use Excel;
use Config;
use DB;
// use Illuminate\Support\Facades\Request;
class CourseController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		//
		// $courses = Course::all();
		// dd($request->get('attribute'));
		switch ($request->get('attribute')) {
			case 'cod_sis':
				$courses = Course::codsis($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				break;
			case 'level':
				$courses = Course::level($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				break;
			case 'name':
			default:
				$courses = Course::name($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				break;
		}
		$careers = Career::all();
		return view('courses.courseList', compact('courses','careers'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CourseRequest $request)
	{
		$course = new Course;
		$course->cod_sis = $request['cod_sis'];
		$course->name = $request['name'];
		$course->level = $request['level'];
		$course->career_id = $request['career_id'];
		$course->save();

		Session::flash('flash_message',"Se ha registrado el curso ".$course->name." de manera exitosa!");

		return redirect('admin/course');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		$course = Course::find($id);
		$careers = Career::all();
		return view("courses.edit", compact('course','careers'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$course = Course::find($id);
		$val_cod_sis = $course->cod_sis == $request['cod_sis'] ? 'required': 'required|unique:courses' ;

		$rules = array(
			'name' => 'required|string',
			'cod_sis' => $val_cod_sis,
			'level' => 'required|integer|between:1,10',
			'career_id' => 'required|integer|exists:careers,id'
		);

		$this->validate($request, $rules);


		// $course->cod_sis = $requestData['cod_sis'];
		$course->name = $request['name'];
		$course->cod_sis = $request['cod_sis'];
		$course->level = $request['level'];
		$course->career_id = $request['career_id'];
		$course->save();

		Session::flash('flash_message',"Se han actualizado los datos de ".$course->name." de manera exitosa!");

		return redirect('admin/course');
	}

	/**
	 * show message for confirm delete resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function eliminate($id)
	{
		$course = Course::find($id);
		return view("courses.eliminate", compact('course'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
		Course::find($id)->delete();

		Session::flash('flash_message',"Se ha eliminado el curso!");

		return redirect('admin/course');
	}

	public function excel(Request $request){
		return view('courses.excel');
	}

	public function previs(Request $request){
			// dd(storage_path());
			if(!$request->hasFile('file-up')){
				return Redirect::back();
			}

			$fileExcel = $request->file('file-up');

		  // validamos tipo de archivo
			$validator = Validator::make(
	  		['file' => $fileExcel, 'extension' => strtolower($fileExcel->getClientOriginalExtension()),],
				['file' => 'required', 'extension' => 'required|in:csv',]
			);

			if($validator->fails()){
					return Redirect::back()->withErrors($validator);
			}else{

					// validamos datos del archivo
					Config::set('excel.csv.delimiter',';');
					$data = Excel::load($fileExcel->getRealPath(), function($reader){})->get();
					// dd( empty($data) ." - ". $data->count() );
					$rules = array('cod_sis'=> 'required|integer|unique:courses',
										 'name'   => 'required',
									 	 'level'  => 'required|integer|between:1,10',
									 	 'career' => 'required|string|exists:careers,abbr',
									 	 );
					$courses = array();
					$notifications = array();
					if(!empty($data) && $data->count()){

						foreach($data as $key => $row){

								$validatorrow = Validator::make(
				 						['cod_sis' => $row->cod_sis,
										 'name' => $row->name,
										 'level' => $row->level,
										 'career' => $row->career,
										 ],
										 $rules);


								if($validatorrow->fails()){
										$messages = $validatorrow->errors();
										foreach ($messages->all() as $message) {
											$notifications[] = "Fila ".$key.": ".$message;
										}
								}else{
										$career = Career::where('abbr','=',strval($row->career))->first();
										$course = new Course;
										$course->cod_sis = intval($row->cod_sis);
										$course->name = strval($row->name);
										$course->level =intval( $row->level);
										$course->career_id = intval($career->id);
										$courses[] = $course;

										// dd($courses->toArray());
								}
							}
						}else{
							$notifications[] = "El archivo esta vacio";
						}
						// dd($this->validateRepeats($courses));
						$result = $this->validateRepeats($courses);
						if($result['message'] != ""){
								$notifications[] = $result['message'];
								$courses = $result['courses'];
						}

						// guardamos temporalmente los datos
						$this->saveExcel($courses);
						if(count($notifications) != 0){
							return view('courses.preview',compact('notifications','courses'));
						}else{
							Session::flash('flash_message',"Los registros son correctos.");
							return view('courses.preview',compact('courses'));
						}
			}
		}

		private function validateRepeats($courses){
			$cod_sis = array();
			$unique = array();
			foreach ($courses as $course) {
				if(!in_array($course->cod_sis,$cod_sis)){
					$cod_sis[] = $course->cod_sis;
					$unique[] = $course;
				}
			}

			if(count($unique) != count($courses)){
				return array("message" => "El archivo tiene el atributo cod_sis con repeticiones",
										 "courses" => $unique);
			}else{
				return array("message" => "",
										 "courses" => $unique);
			}
		}

	private function saveExcel($courses){
		$coursesArray = [];
		// $coursesArray[] = ['cod_sis', 'name', 'level', 'career_id'];
		foreach ($courses as $course) {
			$coursesArray[] = $course->toArray();
		}
		Excel::create('temp_excel', function($excel) use($coursesArray){
			$excel->sheet('Sheet 1',function($sheet) use($coursesArray){
					// dd($coursesArray);
					$sheet->fromArray($coursesArray);
			});
		})->store('csv'); // guardado en app/storage/exports por defecto...
	}

	public function saveModel(){
		$path = storage_path().'/exports/temp_excel.csv';
		Config::set('excel.csv.delimiter',';');
		$data = Excel::load($path, function($reader){})->get();
		// dd($data);
		if(!empty($data) && $data->count()){
				foreach($data as $key => $row){
					$course = new Course;
					$course->cod_sis = $row->cod_sis;
					$course->name = $row->name;
					$course->level = $row->level;
					$course->career_id = $row->career_id;
					$course->save();
				}
				Session::flash('flash_message',"Los registros se han guardado correctamente");
		}

		return redirect('admin/course');

	}


	public function sendEmail(Request $request){
		dd('enviando email');
		dd($request['id']);
	}


	public function deleteGroup(Request $request){
		dd('eliminando cursos');
	}

}
