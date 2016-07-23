<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Group;
use App\Exam;
use Session;

class ExamController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($group)
	{
		$name_course = "";
		$institute = "";
		if($group){
			// $group = intval(Session::get('group'));
			// dd($group);
			$name_course =  Group::join('courses','groups.course_id','=','courses.id')
								->where('groups.id','=',$group)->first()->name;
		    $institution =  Group::join('courses','groups.course_id','=','courses.id')
		    					->join('careers','courses.career_id','=','careers.id')
		    					->where('groups.id','=',$group)->first()->name;
		    // Session::forget('group');
		}
		return view('exams.create',compact('group','name_course','institution'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request, $group)
	{
		// $data = date_create($request->get("time_start"));
		// dd(date_format($data, 'H:i:s'));

		$rules = array(
			'course' => 'required|string',
			'institution' => 'required|string',
			'type' => 'string',
			'duration' => 'date_format:H:i:s',
			'time_start' => 'date_format:H:i',
			'description' => 'string'
			);

		$this->validate($request, $rules);

		$exam = new Exam;
		$exam->group_id = $group;	
		$exam->name_course = $request['course'];
		$exam->institution = $request['institution'];
		$exam->type = $request['type'];
		$exam->duration = $request['duration'];
		$exam->time_start = $request['time_start'];
		$exam->description = trim($request['description']);
		$exam->save();
		Session::flash('flash_message',"El examen se ha creado de forma exitosa");
		
		return redirect('teacher/group/'.$group.'/exams');

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
	public function edit($group,$id)
	{
		$exam = Exam::find($id);
		// dd($exam);

		return view('exams.edit',compact('group','exam'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $group, $id)
	{
		$exam = Exam::find($id);
		$rules = array(
			'course' => 'required|string',
			'institution' => 'required|string',
			'type' => 'string',
			'duration' => 'date_format:H:i:s',
			'time_start' => 'date_format:H:i',
			'description' => 'string'
			);

		$this->validate($request, $rules);

		$exam->name_course = $request['course'];
		$exam->institution = $request['institution'];
		$exam->type = $request['type'];
		$exam->duration = $request['duration'];
		$exam->time_start = $request['time_start'];
		$exam->description = trim($request['description']);
		$exam->save();
		Session::flash('flash_message',"Los datos se han actualizado exitosamente");
		
		return redirect('teacher/group/'.$group.'/exams');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($group, $id)
	{
		$exam = Exam::find($id);
		$exam->delete();
		Session::flash('flash_message',"Se ha eliminado el examen");
		
		return redirect('teacher/group/'.$group.'/exams');

	}



}
