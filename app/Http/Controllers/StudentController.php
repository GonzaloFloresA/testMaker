<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Student;
use App\Course;
use App\Career;
use App\Group;
use App\GroupStudent;
use Hash;
use Session;
use Redirect;
use Validator;
use Excel;
use Config;
use DB;

class StudentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		if($request->get('unknow')){
			$unknows = Student::unknow($request->get('unknow'))->orderBy('id', 'ASC')->paginate(10);
			$registered = Student::where('user_id','!=',0)->orderBy('id', 'ASC')->paginate(10);
		}elseif($request->get('register')){
			$registered = Student::register($request->get('register'))->orderBy('id', 'ASC')->paginate(10);
			$unknows = Student::where('user_id','=',0)->orderBy('id', 'ASC')->paginate(10);
		}else{
			$unknows = Student::where('user_id','=',0)->orderBy('id', 'ASC')->paginate(10);
			$registered = Student::where('user_id','!=',0)->orderBy('id', 'ASC')->paginate(10);
		}

		// dd($registered);
		return view('students.list', compact('unknows','registered'));
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
	public function store(Request $request)
	{
		$student = new Student;
		$rules = array('cod_sis' => 'required|unique:students');
		$this->validate($request, $rules);
		$student->cod_sis = $request['cod_sis'];
		$student->save();
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
		$student = Student::find($id);
		$user_id = $student->user_id;
		$validator = Validator::make(['user_id' => $user_id], ['user_id' => 'required|in:0']);
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}else{
			return view("students.eliminate", compact('student'));
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
		$student = Student::find($id);
		$student->delete();
		Session::flash('flash_message', "El codigo Estudiante se ha eliminado.");
		return redirect('admin/student');
		// return view('teachers.preview', compact('teachers'));
	}

	public function previs(Request $request){

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

			$rules = array('cod_sis' => 'required|integer|unique:students');
			$students = array();
			$notifications = array();

			$unique = array();
			if(!empty($data) && $data->count()){
				foreach ($data as $key => $row) {
					$student = array();
					$student['cod_sis'] = intval($row->cod_sis);
					$student['error'] = FALSE;
					$validatorrow = Validator::make(
						['cod_sis' => $row->cod_sis],
						$rules
					);

					if($validatorrow->fails()){
						$messages = $validatorrow->errors();

						$student['error'] = TRUE;
						foreach($messages->all() as $message){
							$notifications[] = "Fila ".++$key.": ".$message;
						}

					}

					//validamos registros repetidos en el mismo archivo
					if(!in_array($row->cod_sis,$unique)){
						$unique[] = intval($row->cod_sis);
					}else{
						$notifications[] = "Fila ".++$key.": Repetida";
						$student['error'] = TRUE;
					}
					$students[] = $student;
				}
			}else{
				$notifications[] = "El archivo esta vacio";
			}

			if(count($notifications) != 0){
				return view('students.preview',compact('students'))->withErrors($notifications);
			}else{
				Session::flash('flash_message', "Los registros son correctos.");
				return view('students.preview', compact('students'));
			}
		}
	}

	public function saveModel(Request $request){
		if($request->get('cod_sis')){
			$codigos = $request->get('cod_sis');
			foreach($codigos as $codigo){
				$student  = new Student;
				$student->cod_sis = $codigo;
				$student->user_id = 0;
				$student->save();
			}
			Session::flash('flash_message',"Los registros se ha guardado correctamente");
		}
		return redirect('admin/student');
	}


	public function mycourses($id){
		/*
		$student = Student::where('user_id','=',$id)->first();
		$courses= new Collection;
		foreach ($student->groups as $group) {
			$courses->push($group->course);
		}
		$courses = $courses->unique();
		// dd($courses);
		
		return view('courses.coursedesc', compact('courses'));
*/


		$courses = DB::table('groups')
            ->join('group_student', 'group_student.group_id', '=', 'groups.id')
            ->join('courses', 'courses.id', '=', 'groups.course_id')
            ->join('teachers','teachers.id','=','groups.teacher_id')
            ->join('users', 'users.id', '=', 'teachers.user_id')
            ->select('group_student.id as groupStudentId','groups.id','courses.name as courseName','users.name as userName','groups.nro','groups.semester')
            ->where('group_student.student_id', $id)
            ->get();

		return view("courses.coursedesc", compact('courses'));
	}

	public function registerToCourseList(Request $request,$id){

		//dd('explore	');
		$user_id = $id;
		$mycourses = DB::table('groups')
            		->join('group_student', 'group_student.group_id', '=', 'groups.id')
            		->join('courses', 'courses.id', '=', 'groups.course_id')
            		->join('teachers','teachers.id','=','groups.teacher_id')
            		->join('users', 'users.id', '=', 'teachers.user_id')
            		->select('groups.id')
            		->where('group_student.student_id', $user_id)
            		->get();
        $mycoursesArray = array();
        //$tam = sizeof($mycourses);
            		//dd($mycourses);	
        foreach ($mycourses as $mc) {
			array_push($mycoursesArray,$mc->id);
		}
       // dd($mycoursesArray);
		$find = $request->get('field');

		switch ($request->get('attribute')) {
			case 'anio':
				//$groups = Group::anio($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				$groups = DB::table('groups')
            		->join('courses', 'courses.id', '=', 'groups.course_id')
            		->join('careers','careers.id','=','courses.career_id')
            		->join('teachers','teachers.id','=','groups.teacher_id')
            		->join('users', 'users.id', '=', 'teachers.user_id')
            		->select('groups.id','groups.year','groups.nro','courses.level','users.name as teacherName','courses.name as courseName','careers.name as careerName');

            		if(trim($find) != "")
            		$groups = $groups->whereNotIn('groups.id', $mycoursesArray)->where('groups.year', "LIKE", "%$find%")->orderBy('groups.year', 'DESC')->paginate(10);
            		else
            		$groups = $groups->whereNotIn('groups.id', $mycoursesArray)->orderBy('groups.year', 'DESC')->paginate(10);

				break;
			case 'docente':
				//dd('orden docente');
				//$groups = Group::whereNotIn('id', $mycoursesArray)->orderBy('', 'ASC')->paginate(10);
				$groups = DB::table('groups')
            		->join('courses', 'courses.id', '=', 'groups.course_id')
            		->join('careers','careers.id','=','courses.career_id')
            		->join('teachers','teachers.id','=','groups.teacher_id')
            		->join('users', 'users.id', '=', 'teachers.user_id')
            		->select('groups.id','groups.year','groups.nro','courses.level','users.name as teacherName','courses.name as courseName','careers.name as careerName');

            		if(trim($find) != "")
            		$groups = $groups->whereNotIn('groups.id', $mycoursesArray)->where('users.name', "LIKE", "%$find%")->orderBy('users.name', 'DESC')->paginate(10);
            		else
            		$groups = $groups->whereNotIn('groups.id', $mycoursesArray)->orderBy('users.name', 'ASC')->paginate(10);
            		
				break;
			case 'materia':
				$groups = DB::table('groups')
            		->join('courses', 'courses.id', '=', 'groups.course_id')
            		->join('careers','careers.id','=','courses.career_id')
            		->join('teachers','teachers.id','=','groups.teacher_id')
            		->join('users', 'users.id', '=', 'teachers.user_id')
            		->select('groups.id','groups.year','groups.nro','courses.level','users.name as teacherName','courses.name as courseName','careers.name as careerName');

            		if(trim($find) != "")
            		$groups = $groups->whereNotIn('groups.id', $mycoursesArray)->where('courses.name', "LIKE", "%$find%")->orderBy('courses.name', 'DESC')->paginate(10);
            		else
            		$groups = $groups->whereNotIn('groups.id', $mycoursesArray)->orderBy('courses.name', 'ASC')->paginate(10);
            		
				break;
			default:
				//$groups = Course::name($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				//$groups = Group::paginate(10);
				
				$groups = DB::table('groups')
            		->join('courses', 'courses.id', '=', 'groups.course_id')
            		->join('careers','careers.id','=','courses.career_id')
            		->join('teachers','teachers.id','=','groups.teacher_id')
            		->join('users', 'users.id', '=', 'teachers.user_id')
            		->select('groups.id','groups.year','groups.nro','courses.level','users.name as teacherName','courses.name as courseName','careers.name as careerName')
            		->whereNotIn('groups.id', $mycoursesArray)->orderBy('id', 'ASC')->paginate(10);
            		
				break;
				//perform - $groups = Group::whereNotIn('id', $mycoursesArray)->orderBy('id', 'ASC')->paginate(10);
				break;
		}
		$careers = Career::all();

		return view('courses.registerToCourseList', compact('courses','careers','groups'));

	}

	public function confirmCourse($id)
	{
		$group = Group::find($id);
		return view("courses.registerConfirmCourse", compact('group'));
	}

	public function registerToCourse($id,Request $request)
	{
		$student = $request->get('student_id');

  		$groupStudent = new GroupStudent;
		$groupStudent->group_id = $id;
		$groupStudent->student_id = $student;
		$groupStudent->anio = 2016;
		$groupStudent->semester = 1;
		$groupStudent->save();

		Session::flash('flash_message',"Se ha inscrito correctamente!");
		return redirect('student/'.$student.'/course');
	}

	public function getOutConfirmGroup($id){
		$groupStudent = GroupStudent::find($id);
		return view("courses.getOutConfirmGroup", compact('groupStudent'));
	}

	public function getOutGroup($id,Request $request){
		$student = $request->get('student_id');

		$studentGroup = GroupStudent::find($id);
		$studentGroup->delete();
		Session::flash('flash_message', "Usted ha abandonado correctamente el grupo.");

		return redirect('student/'.$student.'/course');
	}
}
