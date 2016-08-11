<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App;
use View;
use App\Exam;
use App\Question;
class PdfController extends Controller {

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
	public function store()
	{
		//
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function invoice($id){
		$exam = Exam::find($id);
		
		// $questions_order = Question::join('exam_question','questions.id','=','exam_question.question_id')
		// 						->where('exam_question.exam_id','=',$id)->orderBy('exam_question.order','asc')->get();

		// $questions_order = $exam->questions;

		$questions_order = $exam->questions->sortBy(function($question){
			return $question->pivot->order;
		});

		// dd($exam->questions, $questions_order);
		$pdf = App::make('dompdf.wrapper');
		// dd($title);
		// $view =  View::make('admin.invoice', compact('data', 'date', 'invoice'));
		$saludos = "saludos desde pdf";
		$view= View::make('pdfs.exam', compact('exam','questions_order'));
		$pdf->loadHTML($view);//->setPaper('a4', 'landscape');
		return $pdf->stream('examen.pdf',array('Attachment'=>0));
	}	

	 public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }

}
