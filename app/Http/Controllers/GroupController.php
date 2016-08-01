<?php namespace App\Http\Controllers;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use App\Teacher;
use App\Student;
use App\Course;
use App\Group;
use Session;
use Hash;
use Redirect;
use Validator;
use Excel;
use Config;

class GroupController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$attr = $request->get('attribute');
		$value = $request->get('field');
	  // dd($attr." = ".$value);
			switch ($attr) {
				case 'course':
					$groups = Group::join('courses','groups.course_id','=','courses.id')
												 ->where('courses.name',"LIKE","%$value%")->get();
					break;
				case 'teacher':
					$groups = Group::join('teachers','groups.teacher_id','=','teachers.id')
												 ->join('users','teachers.user_id','=','users.id')
												 ->where('users.name',"LIKE","%$value%")->get();
						break;
				default:
					$groups = Group::orderBy('id','ASC')->get();
					break;
			}


		$teachers = Teacher::where('user_id','!=',0)->orderBy('id', 'ASC')->get();
		$courses = Course::orderBy('name', 'ASC')->get();

		return view('groups.list',compact('teachers', 'courses','groups'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request)
	{

		// $t = Teacher::select('id')->where('cod_sis','=',4)->first();
		// dd($t);
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

			$rules = array( 'cod_sis_teacher' => 'required|integer|exists:teachers,cod_sis',
											'cod_sis_course'  => 'required|integer|exists:courses,cod_sis',
											'group_nro'       => 'required|integer',
										);
			$groups = array();
			$notifications = array();
			$unique  = array();
			if(!empty($data) && $data->count()){

				 foreach ($data  as $key => $row) {
					 $group = array();
					 $t = Teacher::select('id')->where('cod_sis','=',intval($row->cod_sis_teacher))->first();
					 $group['cod_sis_teacher'] = $row->cod_sis_teacher;
					 if($t === null){
						 $group['teacher_id'] = -1;
					 }else{
						  $group['teacher_id'] = $t->id;
					 }
					 $c = Course::select('id')->where('cod_sis','=',intval($row->cod_sis_course))->first();
					 $group['cod_sis_course'] = $row->cod_sis_course;
					 if($c === null){
						 $group['course_id'] = -1;
					 }else{
						  $group['course_id'] = $c->id;
					 }
					//  $group['course_id'] = Course::select('id')->where('cod_sis','=',intval($row->cod_sis_course))->first()->id;     // REVISAR

					 $group['nro'] = intval($row->group_nro);
					 $group['error'] = FALSE;

				 	$validatorrow = Validator::make(
						[ 'cod_sis_teacher' => $row->cod_sis_teacher,
							'cod_sis_course' => $row->cod_sis_course,
							'group_nro' => $row->group_nro,
						],
					$rules);

					if($validatorrow->fails()){
						$messages = $validatorrow->errors();

						$group['error'] = TRUE;
						foreach ($messages->all() as $message) {
							$notifications[] = "Fila ".++$key.": ".$message;
						}
					}

					$oldgroup = Group:: where('course_id','=', $group['course_id'])
															->where('nro','=', $group['nro'])->first();
					if($oldgroup){
						// si el grupo existe creamos la notificacion
						$notifications[] = "Fila ".++$key.": Este grupo ya existe";
						$group['error'] = TRUE;
					}

					$groups[] = $group;
				 }
			}else{
				$notifications[] = "El archivo esta vacio";
			}
			// dd($groups);
			if(count($notifications) != 0){
				return view('groups.preview',compact('groups'))->withErrors($notifications);
			}else{
				Session::flash('flash_message', "Los registros son correctos.");
				return view('groups.preview', compact('groups'));
			}

		}


	}


	public function saveModel(Request $request){
		if($request->get('teachers_id') && $request->get('courses_id')){
			$teachers = $request->get('teachers_id');
			$courses = $request->get('courses_id');
			$nros = $request->get('nro');
			// dd($nros);
			$html = "";
			for($i=0; $i<count($teachers); $i++){
				$group = new Group;
				$group->teacher_id = $teachers[$i];
				$group->course_id = $courses[$i];
				$group->nro = $nros[$i];
				$group->save();
			}
			Session::flash('flash_message', "Los registros se han guardado correctamente");
		}
		return redirect('admin/group');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function asign(Request $request)
	{
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
			$rules = array( 'cod_sis_student' => 'required|integer|exists:students,cod_sis',
							'cod_sis_course'  => 'required|integer|exists:courses,cod_sis',
							'group_nro'       => 'required|integer',
						);
			$inscriptions = array();
			$notifications = array();
			$unique  = array();

			if(!empty($data) && $data->count()){
				foreach ($data as $key => $row) {
					$row_id = ++$key;
					$inscription = array();
					$inscription['error'] = FALSE;
					// Getting id student  
					$s = Student::select('id')->where('cod_sis','=',intval($row->cod_sis_student))->first();
					$inscription['cod_sis_student'] = intval($row->cod_sis_student);
					if($s === null){
						$inscription['student_id'] = -1;
					}else{
						$inscription['student_id'] = $s->id;
					}

					// Getting id Course
					$c = Course::select('id')->where('cod_sis','=',intval($row->cod_sis_course))->first();
					$inscription['cod_sis_course'] = intval($row->cod_sis_course);
					if($c === null){
						$inscription['course_id'] = -1;
					}else{
						$inscription['course_id'] = $c->id;
					}

					// nro group 
					$inscription['group_nro'] = intval($row->group_nro);

					// Validate data from row
					$validatorrow = Validator::make(
						[ 'cod_sis_student' => $row->cod_sis_student,
							'cod_sis_course' => $row->cod_sis_course,
							'group_nro' => $row->group_nro,
						],
					$rules);

					// Fails register errors for notifications
					if($validatorrow->fails()){
						$messages = $validatorrow->errors();

						$inscription['error'] = TRUE;
						foreach ($messages->all() as $message) {
							$notifications[] = "Fila ".$row_id.": ".$message;
						}
					}

					// Verify group_nro in Course exist
					$group = Group::where('course_id','=',$inscription['course_id'])
									->where('nro','=',$inscription['group_nro'])->first();
					// dd($group);
					// dd($group->students);
					// if group not exist
					if($group == null ){
						$notifications[] = "Fila ".$row_id.": Este grupo no existe";
						$inscription['error'] = TRUE;
						$inscription['group_id'] = -1;
					}else{
						// verify previous inscription
						$students = $group->students;
						if($students->contains($inscription['student_id'])){
							$notifications[] = "Fila ".$row_id.": Este estudiante ya esta inscrito en este materia y en este grupo";
							$inscription['error'] = TRUE;
							
						}
						
						$inscription['group_id'] = $group->id;
						
					}

					$inscriptions[] = $inscription;

				}
				 // dd($inscriptions);
			}else{
				$notifications[] = "El archivo esta vacio";
			}
			// dd($inscriptions);
			if(count($notifications) != 0){
				return view('groups.inscription',compact('inscriptions'))->withErrors($notifications);
			}else{
				Session::flash('flash_message', "Los registros son correctos.");
				return view('groups.inscription', compact('inscriptions'));
			}
		}
	}

	public function inscription(Request $request)
	{
		// dd($request);
		if($request->get('students_id') && $request->get('groups_id')){
			$students = $request->get('students_id');
			$groups = $request->get('groups_id');
			$nros = $request->get('nro');
			// dd($nros);
			$html = "";
			for($i=0; $i<count($students); $i++){
				$group = Group::find($groups[$i]);
				$group->students()->attach($students[$i],array('anio'=>2016, 'semester' => 1));

				// $group->teacher_id = $teachers[$i];
				// $group->course_id = $courses[$i];
				// $group->nro = $nros[$i];
				//$group->save();
			}
			Session::flash('flash_message', "La inscripcion se ha realizado correctamente");
		}
		return redirect('admin/group');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$groups = Group::where('course_id','=',$request->get('course'))->get();
		$max = $groups->max('nro');
		if($max === null){
			$max = 1;
			//dd("no existen grupos de esta materia");
		}else{
			++$max;
			// dd("el grupo mas reciente es ".$max." el siguiente sera ".++$max);
		}
		$group = new Group;
		$group->course_id = $request->get('course');
		$group->teacher_id = $request->get('teacher');
		$group->nro = $max;
		$group->save();
		// dd($groups->max('nro'));
		Session::flash('flash_message',"Se ha creado un nuevo grupo...");
		return redirect('admin/group');
		// return "del docente".$request->get('teacher')." y el de curso ".$request->get('course');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$group = $id;

		$users = DB::table('group_student')
            
            ->join('students', 'students.id', '=', 'group_student.student_id')
            ->join('users', 'users.id', '=', 'students.user_id')
            ->select('group_student.anio','group_student.semester','users.id','users.name','users.email','users.active', 'users.type','users.user_img')
            ->where('group_student.group_id',$id)
            ->get();

        $students = Student::all();
		return view("groups.groupView", compact('users','group','students'));
	}

	public function registerstudent(Request $request, $id){
		$student_id = $request->get('student');
		$group = Group::find($id);

		if(!$group->students->contains($student_id)){
			$group->students()->attach($student_id,array('semester'=> 1, 'anio' => 2016));
			// $group->students()->attach($students[$i],array('anio'=>2016, 'semester' => 1));
			Session::flash('flash_message', "La inscripcion se ha realizado correctamente.");
		}else{
			Session::flash('warnings',"El alumno ya esta inscrito en este grupo.");
		}

		return Redirect::back();
		
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

	public function eliminate($id)
	{
		$group = Group::find($id);
		return view('groups.eliminate',compact('group'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Group::find($id)->delete();
		Session::flash('flash_message',"Se ha eliminado el grupo!");

		return redirect('admin/group');
	}

	public function excel(){
		return view('groups.excel');
	}

}
