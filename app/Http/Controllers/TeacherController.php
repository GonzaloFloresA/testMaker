<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Teacher;
use App\Course;
use App\Group;
use App\Question;
use App\Exam;
use Hash;
use Session;
use Redirect;
use Validator;
use Excel;
use Config;

class TeacherController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->get('unknow')){
			$unknows = Teacher::unknow($request->get('unknow'))->orderBy('id', 'ASC')->paginate(10);
			$registered = Teacher::where('user_id','!=',0)->orderBy('id', 'ASC')->paginate(10);
		}elseif($request->get('register')){
			$registered = Teacher::register($request->get('register'))->orderBy('id', 'ASC')->paginate(10);
			$unknows = Teacher::where('user_id','=',0)->orderBy('id', 'ASC')->paginate(10);
		}else{
			$unknows = Teacher::where('user_id','=',0)->orderBy('id', 'ASC')->paginate(10);
			$registered = Teacher::where('user_id','!=',0)->orderBy('id', 'ASC')->paginate(10);
		}

		return view('teachers.list', compact('unknows','registered'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		// dd($request['cod_sis']);
		$teacher = new Teacher;
		$rules = array('cod_sis' => 'required|unique:teachers');
		$this->validate($request, $rules);
		$teacher->cod_sis = $request['cod_sis'];
		$teacher->save();
		Session::flash('flash_message',"Se han guardado los datos correctamente!");

		return Redirect::back();
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
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	public function eliminate($id, Request $request){
		$teacher = Teacher::find($id);
		$user_id = $teacher->user_id;
		$validator = Validator::make(['user_id' => $user_id], ['user_id' => 'required|in:0']);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}else{
			return view("teachers.eliminate", compact('teacher'));
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$teacher = Teacher::find($id);
		$teacher->delete();
		Session::flash('flash_message', "El codigo Docente se ha eliminado.");
		return redirect('admin/teacher');
	}


	public function previs(Request $request){
		// dd('vista de los archivos excel');
		if(!$request->hasFile('file-up')){
			return Redirect::back();
		}

		$fileExcel = $request->file('file-up');

		// validamos el tipo de archivo
		$validator = Validator::make(
			['file' => $fileExcel, 'extension' => strtolower($fileExcel->getClientOriginalExtension()),],
			['file' => 'required', 'extension' => 'required|in:csv',]
		);

		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}else{

			// validamos los datos del archivo
			Config::set('excel.csv.delimiter', ';');
			$data = Excel::load($fileExcel->getRealPath(),function($reader){})->get();

			$rules = array('cod_sis' => 'required|integer|unique:teachers');
			$teachers = array();
			$notifications = array();

			$unique = array();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $row) {
					$teacher = array();
					$teacher['cod_sis'] = intval($row->cod_sis);
					$teacher['error'] = FALSE;
					$validatorrow = Validator::make(
						['cod_sis' => $row->cod_sis],
						$rules
					);

					if($validatorrow->fails()){
						$messages = $validatorrow->errors();
						// $validatorrow->errors()->add('cargo',"chamacos tengo oro");

						// $messages->add("cargo","gatos de corriente media");
						// dd($validatorrow);
						$teacher['error'] = TRUE;
						foreach($messages->all() as $message){
							$notifications[] = "Fila ".++$key.": ".$message;
						}

					}else{
						// $teacher = new Teacher;
						// $teacher->cod_sis = intval($row->cod_sis);
						// $teachers[] = $teacher;

					}
					if(!in_array($row->cod_sis,$unique)){
						$unique[] = intval($row->cod_sis);
					}else{
						$notifications[] = "Fila ".++$key.": Repetida";
						$teacher['error'] = TRUE;
					}
					$teachers[] = $teacher;
				}
			}else{
				$notifications[] = "El archivo esta vacio";
			}
			//  dd($teachers);
			// $result = $this->validateRepeats($teachers);
			// if($result['message'] != ""){
			// 	$notifications[] = $result['message'];
			// 	$teachers = $result['teachers'];
			// }

			// $this->saveExcel($teachers);
			if(count($notifications) != 0){
				// return view('teachers.preview',compact('notifications','teachers'));
				return view('teachers.preview',compact('teachers'))->withErrors($notifications);
			}else{
				Session::flash('flash_message', "Los registros son correctos.");
				return view('teachers.preview', compact('teachers'));
			}
		}
	}


	private function validateRepeats($teachers){
		$unique = collect($teachers)->unique();

		if(count($unique) != count($teachers)){
			return array("message" => "El archivo tiene el atributo cod_sis con repeticiones",
									 "teachers" => $unique);
		}else{
			return array("message" => "",
									 "teachers" => $unique);
		}
		// dd(count($coleccion));
	}

	public function saveModel(Request $request){
		if($request->get('cod_sis')){
			$codigos = $request->get('cod_sis');
			// $teachers = array();
			foreach ($codigos as $codigo) {
				$teacher = new Teacher;
				$teacher->cod_sis = $codigo;
				$teacher->user_id = 0;
				$teacher->save();
				// $teachers[] = $teacher;
			}
			Session::flash('flash_message', "Los registros se han guardado correctamente");
		}
		return redirect('admin/teacher');
	}


	public function mycourses($id){
 		$teacher = Teacher::where('user_id','=',$id)->first();
		// dd($teacher->groups->course_id);
		$courses = new Collection;
		// dd($teacher->groups->course);
		foreach ($teacher->groups as $group) {
			$courses->push($group->course);
		}
		$courses = $courses->unique();
		// dd($courses->unique());
		// $courses = $teacher->groups->course->unique('cod_sis');
		// dd($courses);
		// foreach ($teacher->courses as $course) {
		// 	echo $course->name." con el grupo ".$course->pivot->group."<br/>";
		// }
		// dd($courses);
		return view('courses.coursedesc', compact('courses'));
	}

	public function groups($teacher, $course){
		$id = Teacher::where('user_id','=',$teacher)->first()->id;
		$name_course = Course::where('id','=',$course)->first()->name;
		$groups = Group::where('teacher_id','=',$id)->where('course_id','=',intval($course))->get();
		// dd($groups);
		return view('groups.details',compact('groups','name_course'));
	}

	public function mystudents($id){

	}

	public function myquestions($group){

		$questions = Question::where('group_id','=',intval($group))->orderBy('id','desc')->get();
		// dd($questions);
		return view('questions.list',compact('questions','group'));
	}

	public function myexams($group){
		$exams = Exam::where('group_id','=',$group)->get();

		return view('exams.list',compact('group','exams'));
	}

}
