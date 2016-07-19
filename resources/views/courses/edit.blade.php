@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Editar Curso</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')

          <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/course/edit/'.$course->id) }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
							<label class="col-md-4 control-label">Codigo Sis</label>
							<div class="col-md-6">
								<input type="cod_sis" class="form-control" name="cod_sis" value="{{ $course->cod_sis }}" >
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ $course->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Semestre</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="level" value="{{ $course->level }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Carrera</label>
							<div class="col-md-6">
								<select class="form-control" name="career_id" value='{{$course->career_id}}'>
										<!-- <option value='-1' selected hidden>Escoja un valor</option> -->
										@foreach($careers as $career)
										@if( $career->id === intval($course->career_id) )
												<option value='{{$career->id}}' selected >{{$career->name}}</option>
										@else
												<option value='{{$career->id}}' >{{$career->name}}</option>
										@endif

										@endforeach
								</select>
							</div>
						</div>



						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Guardar</button>
									<a class="btn btn-primary" href="{{URL::previous()}}">Volver</a>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
