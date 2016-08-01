<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Question;
use App\MultipleQuestion;
use App\Option;
use Redirect;
use Session;
use Response;
use View;
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
	public function store($group, Request $request)
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

	 		case 'complemento':
	 			//dd('entra a complemento');
	 			$question = new Question;
	 			$question->title = "Default Title";
	 			$question->types = 'complemento';
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
	public function show(Request $request, $group, $id)
	{
		$question = Question::find($id);
		// dd($question);
		
		
		if($request->ajax()){	
			if($question->types == 'develop'){
				$view = View::make('questions.showDevelop')->with('question',$question);
				
			}else if($question->types == 'multiple'){
				$view = View::make('questions.show')->with('question',$question);
				
			}else if($question->types == 'complemento'){
				$listaComplementos = $this->multiexplode(array("(x)","(/x)"), $question->description);
				$data = array('question' => $question, 'listaComplementos' =>$listaComplementos);
				$view = View::make('questions.showComplemento')->with($data);
			}
			
			$sections = $view->renderSections();
			return Response::json($sections['ajax']);
			
		}

		if($question->types == 'develop'){

			return view('questions.showDevelop', compact('question'));

		}else if($question->types == 'multiple'){

			return view('questions.show', compact('question'));

		}else if($question->types == 'complemento'){

			$listaComplementos = $this->multiexplode(array("(x)","(/x)"), $question->description);
			// dd($listaComplementos);
			return view('questions.showComplemento', compact('question','listaComplementos'));
		}

		return redirect('teacher/group/'.$group.'/questions');
		
	}


	public function multiexplode ($delimiters,$string) {    
    	$ready = str_replace($delimiters, $delimiters[0], $string);
    	$launch = explode($delimiters[0], $ready);
    	return  $launch;
 	}
	

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($group, $id)
	{
		// dd("aqui se editan las preguntas ".$id);
		$question = Question::find($id);
		if($question->types == 'develop'){
			return view("questions.develop",compact('question','group'));
		}else if($question->types == 'multiple'){
			return view('questions.multiple',compact('question','group'));
		}else if($question->types == 'complemento'){
			return view('questions.complemento',compact('question','group'));	
		}

		return redirect('teacher/group/'.$group.'/questions');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update( Request $request, $group, $id)
	{

		$question = Question::find($id);
		// dd($question->types);
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

		}else if($question->types == 'multiple'){
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
		}else if($question->types == 'complemento'){

		
			$rules = array(
			'title' => 'required|string',
			'description' => 'string',
			);
			$this->validate($request, $rules);

			if (strpos($request['description'], '(x)') === false && 
				strpos($request['description'], '(/x)') === false) {

    			return Redirect::back()->with('errorSintaxis', 'No se ha encontrado las etiquetas (x) y (/x), favor utilizar ese formato');
			}

			$open = substr_count($request['description'], '(x)');
			$close = substr_count($request['description'], '(/x)');
			
    		if($open != $close)
    			return Redirect::back()->with('errorSintaxis', 'Hay etiquetas (x) y (/x) no estan emparejadas correctamente.');

			Session::flash('flash_message',"Los datos se han actualizado correctamente");
			$question->title = $request['title'];
			$question->description = $request['description'];
			$question->save();

			return Redirect::back();
		}

		return redirect('teacher/group/'.$group.'/questions');	
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($group, $id)
	{

		$question = Question::find($id);

		if($question->types == 'develop'){
			$question->delete();
		}else if($question->types == 'multiple'){
			foreach ($question->multipleQuestion->options as $option) {
				$option->delete();
			}
			$question->multipleQuestion->delete();
			$question->delete();
		}else if($question->types == 'complemento'){
			$question->delete();
		}
		

		return redirect('teacher/group/'.$group.'/questions');
	}

}
