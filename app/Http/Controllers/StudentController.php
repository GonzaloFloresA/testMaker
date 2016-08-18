<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Collection as Collection;
use App\Student;
use App\Course;
use App\User;
use App\Group;
use App\Evaluation;
use App\Exam;
use App\Question;
use App\ComplementQuestion;
use Hash;
use Session;
use Redirect;
use Validator;
use Excel;
use Config;
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
		$student = Student::where('user_id','=',$id)->first();
		$courses= new Collection;
		foreach ($student->groups as $group) {
			$courses->push($group->course);
		}
		$courses = $courses->unique();
		$groups = $student->groups;
		// dd($courses);

		return view('students.mycourses', compact('courses','groups'));
	}


	public function myexams($id, $group_id){
		$student = User::find($id)->student;

		// dd($student->evaluations);
		$exams = $student->groups->where('id',intval($group_id))->first()->evaluations->where('type','final');
		//$exams = $student->exams->where('group_id',intval($group_id));
		//$exams = $student->evaluations->
		// dd($exams);
		// dd($student->exams);
		$group = Group::find($group_id);
	
		// dd($exams);
		return view('students.myexams',compact('id','exams','group'));
	}

	public function verifyToken($id, $group_id, $exam_id, $eval_id){
		return view('exams.verifyToken', compact('id','group_id','exam_id','eval_id'));
	}


	public function startEvaluation(Request $request, $id, $group_id, 
		$exam_id, 
		$eval_id){	
		$student = User::find($id)->student;
		$evaluation = Evaluation::find(intval($eval_id));
		$exam = Exam::find(intval($exam_id));
		$group = Group::find(intval($group_id));
		$eval = Evaluation::find(intval($eval_id));
		$eval->start = date("Y-m-d H:i:s");
		$eval->save();
		$tokenEval = $evaluation->token_access;
		$notifications = [];
		$state = 'eval';
		if($tokenEval == $request->get('token_eval')){
			return view('exams.evaluate',compact('exam','group','state','student','eval'));
		}else{
			$notifications[] = "El token introducido no es correcto. Vuelva a Intentar";
			return Redirect::back()->withErrors($notifications);
		}
	}


	public function terminateEvaluation(Request $request,$id,$group_id,$exam_id,$eval_id){
		$exam = Exam::find(intval($exam_id));
		$eval = Evaluation::find(intval($eval_id));
		$student = User::find($id)->student;
	 	$ids = $request->get('questions_id');
	 	$calif = 0;
	 	$results = [];
	 	$notifications = [];
	 	// dd($request);
	 	foreach ($ids as $key => $value) {
	 		$response = $request->get('response_'.$value);
	 		if( $response != null && $this->verifyQuestion($value,$response) ){
	 			$percent = $exam->questions->where('id',intval($value))->first()->pivot->percent; 
	 			$calif += $percent;

	 		}else{
	 			//dd('no existe '.$value);
	 		}

	 	}
	 	$eval->calification = $calif;
	 	$eval->pending = false;
	 	$eval->end = date("Y-m-d H:i:s");
	 	
	 	
	 	if($calif < 80){
	 		// el examen se reprobo creamos otro intento
	 		$intent = $eval->intent + 1;
	 		if ($intent <= $exam->intents){
	 			
	 			$evaluation = new Evaluation;
				$evaluation->exam_id = $exam->id;
				$evaluation->pending = true;
				$evaluation->intent  = $intent;
				$evaluation->calification = 0;
				$evaluation->type = 'final';
				$evaluation->token_access = $eval->token_access;
				$evaluation->save();
				$student->evaluations()->attach($evaluation->id);
				$eval->type = 'partial';
				$notifications[] = "Lo siento su nota es de $calif inferior a 80.Vuelva a Intentar :( ";
	 		}else{
				$notifications[] = "Ha reprobado el examen. Mas cuidado la proxima vez :(";
	 		}		

	 	}else{
	 	   Session::flash('flash_message',"Felicidades, has aprobado tu examen :) ");
	 	}
	 	$eval->save();

	 	return redirect('student/'.$id.'/group/'.$group_id.'/')->withErrors($notifications);

	 	// dd('la nota total es '.$calif);
	}

	public function verifyQuestion($id, $response){
		$question = Question::find(intval($id));
		if($question->types == 'multiple'){
			sort($response);
			$true_response = $question->multipleQuestion->options->filter(function($value){
					return $value->credible == 1;
				});
			$true_response = $true_response->lists('id');
			sort($true_response);
			if($response  == $true_response){
				return true;
			}else{
				return false;
			}
			
		}else if($question->types == 'falsoVerdad'){
			if($question->credible == intval($response)){
				return true;
			}else{
				return false;
			}
		}else if($question->types == 'complemento'){

			$isCredible = True;
			$combine = array_combine($response[0], $response[1]);
			// dd($combine);
			foreach($combine as $_id => $response){
				$complement = ComplementQuestion::find($_id);
				$arr_solution = json_decode($complement->solution);
				// convert caracters
				$string = htmlentities($response, null, 'utf-8');
				$content = str_replace("&nbsp;", "", $string);
				$response = html_entity_decode($content);
				
				if(!in_array(trim($response), $arr_solution)){
					$isCredible = false;
				}				
			}

			if($isCredible){
				return true;
			}else{
				return false;
			}
		}	
	}


	private function obtenCaracterAleatorio($arreglo) {
		$clave_aleatoria = array_rand($arreglo, 1);	
		return $arreglo[ $clave_aleatoria ];	
	}
 
	private function obtenCaracterMd5($car) {
		$md5Car = md5($car.Time());	
		$arrCar = str_split(strtoupper($md5Car));	
		$carToken = $this->obtenCaracterAleatorio($arrCar);	
		return $carToken;
	}
 
	private function obtenToken() {
		
		$mayus = "ABCDEFGHIJKMNPQRSTUVWXYZ";
		$mayusculas = str_split($mayus);	
		$numeros = range(0,9);
		shuffle($mayusculas);
		shuffle($numeros);		
		$arregloTotal = array_merge($mayusculas,$numeros);
		$newToken = "";
		
		for($i=0;$i<=10;$i++) {
				$miCar = $this->obtenCaracterAleatorio($arregloTotal);
				$newToken .= $this->obtenCaracterMd5($miCar);
		}
		return $newToken;
	}




}
