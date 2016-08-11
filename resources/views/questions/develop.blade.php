@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Editar pregunta de Desarrollo</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
		<div class="container-fluid">
			<div class="row">
				<form  class="form-horizontal" action="{{ url('teacher/group/'.$group.'/question/edit/'.$question->id)}}" method ="POST">
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
							<input class="form-control" type="text" name="description" id="description" value="{{ $question->description }}">
						</div>		
					</div>					

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">	
							<button class="btn btn-primary" type="submit">	Guardar
							</button>
							<a href="{{	url('teacher/group/'.$group.'/questions') }}" class="btn btn-primary">Volver</a>
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
