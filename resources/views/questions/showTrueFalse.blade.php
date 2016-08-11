@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >{{ $question->title }}</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')

					<div class="row " >
						<div class="col-md-10 col-md-offset-1 bg-silver">

							<p style="text-align:justify;"> <strong> Pregunta: </strong>
								{{ $question->description }}	
							</p>

							<div class="row">
							<form action="{{ url('teacher/group/'.$group.'/question/verify/'.$question->id) }}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="col-md-12">
							<div class="row form-group">
								<label for="title" class="col-sm-1"></label>
								<div class="col-sm-1">
									<span class="input-group-addon">
									@if($question->credible == 1)
										<input type="radio" name="credible" value="1" checked> Verdad
								    	<input type="radio" name="credible" value="0" > Falso	
									@else
										<input type="radio" name="credible" value="1" > Verdad
								    	<input type="radio" name="credible" value="0" checked> Falso	
									@endif
									</span>			
								</div>
							</div>	

								<div class="form-group">
									<div class="text-center">	
										<button class="btn btn-primary" type="submit">	Verificar Respuesta
										</button>
										<a href="{{	url('teacher/group/'.$group.'/questions') }}" class="btn btn-primary">Volver</a>
									</div>
								</div>
							</div>
							</form>

							</div>
						</div>
					</div>

					
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('ajax')

			<div class="panel panel-default">
				<div class="panel-heading" >{{ $question->title }}</div>
				<div class="panel-body">
					<div class="row bg-silver" >
						<div class="col-md-10 col-md-offset-1">
							<p style="text-align:justify;"> <strong> Pregunta: </strong>
								{{ $question->description }}	
							</p>
						</div>
					</div>

				</div>
			</div>

@endsection