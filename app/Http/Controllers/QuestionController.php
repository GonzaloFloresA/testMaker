<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Question;
use App\MultipleQuestion;
use App\Option;
use Redirect;
use Session;

class QuestionController extends Controller {

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
	 	$type = $request->get('type');
	 	switch ($type) {
	 		case 'multiple':
	 			$question = new Question;
	 			$question->title = "Default Title";
	 			$question->types = 'multiple';
	 			$question->description = "";
	 			$question->group_id = intval($request->get('group'));
	 			$question->save();

	 			$multiple = new MultipleQuestion;
	 			$multiple->question_id = $question->id;
	 			$multiple->save();

	 			// dd($question);
	 			break;
	 		case 'develop':
	 			$question = new Question;
	 			$question->title = "Default Title";
	 			$question->types = 'develop';
	 			$question->description = "";
	 			$question->group_id = intval($request->get('group'));
	 			$question->save();

	 			break;
	 		
	 	}
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
		$question = Question::find($id);
		if($question->types == 'develop'){
			return view('questions.showDevelop', compact('question'));
		}else{
			return view('questions.show', compact('question'));
		}
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		// dd("aqui se editan las preguntas ".$id);
		$question = Question::find($id);
		if($question->types == 'develop'){
			return view("questions.develop",compact('question'));
		}else{
			return view('questions.multiple',compact('question'));
		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request,$id)
	{
		$question = Question::find($id);
		if($question->types == 'develop'){

			$rules = array(
			'title' => 'required|string',
			'description' => 'string',
			);
			$this->validate($request, $rules);

			Session::flash('flash_message',"Los datos se han actualizado correctamente");
			$question->title = $request['title'];
			$question->description = $request['description'];
			$question->save();

			return Redirect::back();

		}else{
			$rules = array(
			'title' => 'required|string',
			'description' => 'string',
			);
		$this->validate($request, $rules);
		// falta introducir una respuesta

		$option_id = $request->get('option_id');
		$option_desc = $request->get('option_desc');

		for($i=0; $i<count($option_id); $i++){
			$option = Option::find($option_id[$i]);
			$option->description = $option_desc[$i];
			$option->save();
			if ($option->description == ""){
				$option->delete();
			}
		}

		$newOptionField = $request->get('new_option');
		if($newOptionField != ""){
			$newOption = new Option;
			$newOption->description = $newOptionField;
			$newOption->multiple_question_id = $question->multipleQuestion->id;
			$newOption->save();
		}



		Session::flash('flash_message',"Los datos se han actualizado correctamente");
		$question->title = $request['title'];
		$question->description = $request['description'];
		$question->save();

		return Redirect::back();
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

		$question = Question::find($id);

		if($question->types == 'develop'){
			$question->delete();
		}else{
			foreach ($question->multipleQuestion->options as $option) {
				$option->delete();
			}
			$question->multipleQuestion->delete();
			$question->delete();
		}
		

		return Redirect::back();
	}

}
