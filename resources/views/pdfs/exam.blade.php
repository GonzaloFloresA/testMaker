@extends('pdfs.layout')

@section('questions')
@foreach($questions_order as $question)
	
@if($question->types == 'develop')
	<div class="develop">
		<p><strong>{{$question->pivot->order}}.- </strong>{{ $question->description }} <strong>( {{$question->pivot->percent}} ptos.)</strong> </p>
	</div>
@elseif($question->types == 'multiple')
	<div class="multiple">
		<p><strong>{{$question->pivot->order}}.- </strong> {{ $question->description }} <strong>( {{$question->pivot->percent}} ptos.)</strong></p>
		<ul>
			@foreach($question->multipleQuestion->options as $option)
				<li><input type="checkbox" style="display:inline;">  {{$option->description}}</li>
			@endforeach
		</ul>
	</div>
@elseif($question->types == 'falsoVerdad')
	<div class="falsoVerdad">
		<p><strong>{{$question->pivot->order}}.- </strong> {{ $question->description }} <strong>( {{$question->pivot->percent}} ptos.)</strong></p>
		<p><strong>V</strong><input type="radio" style="display:inline;" > <strong>F</strong> <input type="radio" style="display:inline;"></p>
	</div>

@elseif($question->types == 'complemento')
	<div class="complemento">
		<p><strong>{{$question->pivot->order}}.- </strong> {!! $question->printVersion() !!} <strong>( {{$question->pivot->percent}} ptos.)</strong></p>
	</div>
@endif


@endforeach

@endsection