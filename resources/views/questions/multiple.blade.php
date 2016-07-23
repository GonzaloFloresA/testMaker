@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Editar pregunta de Opcion Multiple</div>
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
							<input class="form-control" type="text" name="description" id="description" value="{{ $question->description }}">
						</div>		
					</div>
				    @foreach($question->multipleQuestion->options as $option)
						<div class="form-group">
						<label for="option" class="col-sm-2" >Opcion </label>		
						<div class="col-sm-10 input-group container-input">
							<input type="hidden" name="option_id[]" value="{{$option->id}}">
							<input class="form-control" type="text" name="option_desc[]" id="content"  value="{{ $option->description }}">
							
							<div class="input-group-btn">
								<!-- <input type="checkbox"  name="solution"> -->
								<!-- <button type="button" class="btn btn-default bg-green border--green btn-delete">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</button> -->								
								<!-- <button type="button" class="btn btn-default bg-red border--red btn-delete">
									<i class="fa fa-times" aria-hidden="true"></i>
								</button> -->
								
							</div>
							
						</div>	
					</div>
				    @endforeach	
					<div class="form-group">
						<label for="option" class="col-sm-2" >Opcion </label>		
						<div class="col-sm-10 input-group container-input">				
							<input class="form-control" type="text" name="new_option" id="content"  value="">
							
							<div class="input-group-btn">
								<!-- <input type="checkbox"  name="solution"> -->
								<!-- <button type="button" class="btn btn-default bg-green border--green btn-delete">
									<i class="fa fa-plus" aria-hidden="true"></i>
								</button>								
								<button type="button" class="btn btn-default bg-red border--red btn-delete">
									<i class="fa fa-times" aria-hidden="true"></i>
								</button>
								 -->
							</div>
							
						</div>	
					</div>
					

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">	
							<button class="btn btn-primary" type="submit">	Guardar
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
