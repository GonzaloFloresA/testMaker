<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Question;
use App\MultipleQuestion;
use App\ComplementQuestion;
use App\Option;
use App\Group;
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

	 		case 'falsoVerdad':
	 			//dd('entra a complemento');
	 			$question = new Question;
	 			$question->title = "Default Title";
	 			$question->types = 'falsoVerdad';
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
				$view = View::make('questions.showDevelop',compact('question','group'));
				
			}else if($question->types == 'multiple'){

				$view = View::make('questions.show',compact('question','group'));
				// $view = View::make('questions.show')->with('question',$question);
				
			}else if($question->types == 'complemento'){
				// $complementos = array();
				// foreach ($question->complementQuestions as $complement) {
				// 	$complementos[$complement->id] = (array) json_decode($complement->solution);
				// }
				
				$regexp = '/<compl>compl-(.+?)<\/compl>/i';
				preg_match_all($regexp, $question->description,$matches);
				array_values($matches);
				$combine = array_combine($matches[1],$matches[0]);
				// dd($combine );
				$description = $question->description;
				// dd($matches);
				foreach($combine as $key =>$value){
					// dd($value);
					$res = '<span contenteditable class="span_editable" id="'.$key.'"></span><input type="hidden" name="id[]" value="'.$key.'">
						  <input type="hidden"  id="_'.$key.'"  name="cont[]" >';
					$description = str_replace($value,$res,$description);
			}

			$view = View::make('questions.showComplemento',compact('question','complementos','group','description'));
			}else if($question->types == 'falsoVerdad'){				
				$view = View::make('questions.showTrueFalse',compact('question','group'));
			}
			
			$sections = $view->renderSections();
			return Response::json($sections['ajax']);
			
		}

		if($question->types == 'develop'){

			return view('questions.showDevelop', compact('question','group'));

		}else if($question->types == 'multiple'){

			return view('questions.show', compact('question','group'));

		}else if($question->types == 'complemento'){

			$regexp = '/<compl>compl-(.+?)<\/compl>/i';
			preg_match_all($regexp, $question->description,$matches);
			array_values($matches);
			$combine = array_combine($matches[1],$matches[0]);
			// dd($combine );
			$description = $question->description;
			// dd($matches);
			foreach($combine as $key =>$value){
				// dd($value);
				$res = '<span contenteditable class="span_editable"  style="min-width:100px !important;" id="'.$key.'"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><input type="hidden" name="id[]" value="'.$key.'">
						  <input type="hidden"  id="_'.$key.'"  name="cont[]" >';
				$description = str_replace($value,$res,$description);
			}
			// dd($description);
			return view('questions.showComplemento', compact('question','description','group'));

		}else if($question->types == 'falsoVerdad'){

			return view('questions.showTrueFalse', compact('question','group'));
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
			$complementos = array();
				foreach ($question->complementQuestions as $complement) {
					$arr = (array) json_decode($complement->solution);
					$str = implode("-",$arr);
					$complementos[$complement->id] = $str;
				}
				 // dd($complementos);
			return view('questions.complemento',compact('question','group','complementos'));	
		}else if($question->types == 'falsoVerdad'){
			return view('questions.trueFalse',compact('question','group'));
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
			// dd($request->get('option_credible'));
			$rules = array(
			'title' => 'required|string',
			'description' => 'string',
			'credible' => 'bool',
			);
			$this->validate($request, $rules);
			// falta introducir una respuesta

			$option_id = $request->get('option_id');
			$option_desc = $request->get('option_desc');
			$option_cred = $request->get('option_credible');

			for($i=0; $i<count($option_id); $i++){
				$option = Option::find($option_id[$i]);
				$option->description = $option_desc[$i];
				if($option_cred != null && in_array($option_id[$i],$option_cred)){
					$option->credible = 1;	
				}else{
					$option->credible = 0;	
				}
				$option->save();
				
				if ($option->description == ""){
					$option->delete();
				}
			}

			$newOptionField = $request->get('new_option');
			if($newOptionField != ""){
				$newOption = new Option;
				$newOption->description = $newOptionField;
				$newOption->credible = $request->get('new_op_credible')? 1:0;
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
			'news' => 'array',
			);
			$this->validate($request, $rules);
			
			
			 
			// dd('eliminar',$request->get('deletes'),"nuevos",$request->get('news_index'),$request->get('news'),'actualizar',$request->get('save_id'),$request->get('save'));
			$description = $request->get('description');
			$news = $request->get('news');
			$news_index = $request->get('news_index');
			// dd($description, $news, $news_index);
			// guardamos los complementos nuevos
			if($news_index != null){
				for ($i=0; $i<count($news_index); $i++){
					$arr = array();
					$arr = explode('-', $news[$i]);
					$arr = array_map('trim',$arr);
					
					$arr = array_diff($arr, [""]);
					$arr = array_map('strtolower',$arr);
					$arr = array_values($arr);
				

					if($arr != null && !empty($arr)){
						$complement = new ComplementQuestion();
						$complement->question_id = $question->id;
						$complement->solution = json_encode($arr);
						$complement->save();

						$match = '<compl>comp-new_'.$news_index[$i].'</compl>';
						$id_ = $complement->id;
						$description = str_replace($match,"<compl>compl-$id_</compl>",$description);
						//dd($match, $id_,$description);
					}
					//$response['compl_'.$i] = $arr;
				 	//$i++;
				}
				// dd($description);
			}

			// guardamos cambios en los complementos anteriores
			if($request->get('save_id') != null){
				$save_id = $request->get('save_id');
				$save = $request->get('save');

				for($i=0; $i<count($save_id); $i++){
					$arr = array();
					$arr = explode('-', $save[$i]);
					$arr = array_map('trim',$arr);
					
					$arr = array_diff($arr, [""]);
					$arr = array_values($arr);
					if($arr != null && !empty($arr)){
						$complement = ComplementQuestion::find($save_id[$i]);
						// $complement->question_id = $question->id;
						$complement->solution = json_encode($arr);
						$complement->save();
					}	
				}	
			}

			// eliminamos complementos
			if($request->get('deletes') != null){
				$deletes = $request->get('deletes');
				foreach($deletes as $key => $value){
					$complement = ComplementQuestion::find($value);
					$complement->delete();
				}
			}
				

			$question->title = $request['title'];
			$question->description = $description;
			$question->save();
			// dd($question->description);
			Session::flash('flash_message',"Los datos se han actualizado correctamente");
			return Redirect::back();
		}else if($question->types == 'falsoVerdad'){

		
			$rules = array(
			'title' => 'required|string',
			'description' => 'string',
			);
			$this->validate($request, $rules);
			

			Session::flash('flash_message',"Los datos se han actualizado correctamente");
			$question->title = $request['title'];
			$question->description = $request['description'];
			$question->credible = intval($request['credible']);
			$question->save();

			return Redirect::back();
		}

		return redirect('teacher/group/'.$group.'/questions');	
	}


	public function verifyResponse(Request $request, $group, $id){
		$question = Question::find($id);
		$notifications = array();
		if($question->types == 'multiple'){

				$rules = array('response' => 'required|array');
				$this->validate($request, $rules);

				$response = array_map('intval',$request->get('response'));
				sort($response);
				$true_response = $question->multipleQuestion->options->filter(function($value){
					return $value->credible == 1;
				});

				$true_response = $true_response->lists('id');
				sort($true_response);
				// dd(sort($response),sort($true_response));
				if($response === $true_response){
					// dd('respuesta correcta');
					Session::flash('flash_message',"La respuesta es correcta.");
				}else{
					$notifications[]= 'La respuesta es incorrecta.';
				}
				return Redirect::back()->withErrors($notifications);
		}else if($question->types == 'complemento'){
			$notifications = array();
			$isCredible = True;
			$combine = array_combine($request->get('id'), $request->get('cont'));
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
					Session::flash('flash_message',"La solucion es correcta");
			}else{
				
				$notifications[] = "La solucion es incorrecta";
				}

			return Redirect::back()->withErrors($notifications);

		}else if($question->types == 'falsoVerdad'){
			$notifications = array();
			if($question->credible == intval($request->credible)){
				Session::flash('flash_message',"La solucion es correcta");
			}else{
				$notifications[] = "La solucion es incorrecta";
			}
			return Redirect::back()->withErrors($notifications);
			
		}	
	}


	public function delete($group_id, $id){
		$group = Group::find($group_id);
		$question = Question::find($id);

		return view('questions.eliminate', compact('group','question'));
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

			foreach ($question->complementQuestions as $complement) {
				$complement->delete();
			}		
			$question->delete();

		}else if($question->types == 'falsoVerdad'){
			$question->delete();
		}
		
		Session::flash('flash_message',"La eliminacion se ha completado..");
		return redirect('teacher/group/'.$group.'/questions');
	}

}
