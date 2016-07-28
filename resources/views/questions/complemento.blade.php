@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Editar Pregunta de Complemento</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
		<div class="container-fluid">
			<div class="row">
				<form  class="form-horizontal" action="{{ url('teacher/question/edit/'.$question->id)}}" method ="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<label for="title" class="col-sm-2">Titulo</label>		
							<div class="col-sm-10">					
								<input class="form-control" type="text" name="title" id="title" value="{{ $question->title }}">
							</div>		
					</div>

					<div class="form-group">
						<label for="title" class="col-sm-2">Enunciado</label>		
						<div class="col-sm-10">					
							
							 <textarea class="form-control" rows="4" name="description" id="description">{{ $question->description }}</textarea>
        
						</div>		
					</div>					

					
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">	
							<a class="btn btn-primary" href="{{url('teacher/group/'.$question->group_id.'/questions')}}">Volver	</a>
							<button class="btn btn-danger btn-lg" type="submit">	Guardar
							</button>
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

@endsection
