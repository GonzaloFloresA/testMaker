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
				<div class="col-md-12">
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
					


				    @foreach($question->multipleQuestion->options as $option)
					<div class="form-group row">	
  						<div class="col-md-12">
  							<div class="row">
  							<div class="col-md-2">
								<label for="option" class="" >Opcion </label>
							</div>
							<div class="col-md-10">
    						<div class="input-group">
    							<input type="hidden" name="option_id[]" value="{{$option->id}}">
    							<span class="input-group-addon">
    								@if($option->credible == 1)
										<input type="checkbox" name="option_credible[]" value="{{$option->id}}" aria-label="..." checked="checked">
    								@else
										<input type="checkbox" name="option_credible[]" value="{{$option->id}}" aria-label="...">
    								@endif
    								
    							</span>    
     							<input type="text" class="form-control" name = "option_desc[]" value="{{$option->description}}">
       							<!-- <span class="input-group-addon">
									<button type="button" class="btn btn-xs btn-default bg-green border-green btn-delete">
										<i class="fa fa-plus" aria-hidden="true"></i>
									</button>
									<button type="button" class="btn btn-xs btn-default bg-red border-red btn-delete">
										<i class="fa fa-times" aria-hidden="true"></i>
									</button>
      							</span>
 -->
    						</div>
    						</div>
    						</div>
  						</div>
					</div>
				    @endforeach	
					<div class="form-group row">	
  						<div class="col-md-12">
  							<div class="row">
  							<div class="col-md-2">
								<label for="option" class="" >Opcion </label>
							</div>
							<div class="col-md-10">
    						<div class="input-group">
    							
    							<span class="input-group-addon">
    								<input type="checkbox"  aria-label="..." name="new_op_credible" >
    							</span>    
     							<input type="text" class="form-control" name="new_option" value="">
       							<!-- <span class="input-group-addon">
									<button type="button" class="btn btn-xs btn-default bg-green border-green btn-delete">
										<i class="fa fa-plus" aria-hidden="true"></i>
									</button>
									<button type="button" class="btn btn-xs btn-default bg-red border-red btn-delete">
										<i class="fa fa-times" aria-hidden="true"></i>
									</button>
      							</span> -->

    						</div>
    						</div>
    						</div>
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
	</div>

@endsection
