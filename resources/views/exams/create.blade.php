@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Crear Examen Nuevo</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')

					<form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/group/'.$group.'/exam/create') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="col-md-2 control-label">Materia</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="course" value="{{ $name_course }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Institucion</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="institution" value="{{ $institution }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Tipo</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="type" value="">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Duracion</label>
								<div class="col-md-9">
									<select class="form-control" name="duration" id="duration">
									@foreach($range as $duration)
										<option value="{{ $duration['time'] }}">
											{{ $duration['time'] }}
										</option>
									@endforeach
									</select>
									
									<!-- <span class="input-group-addon">
       	 						<span class="glyphicon glyphicon-time"></span>
    							</span> -->
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Hora de Inicio</label>
								<div class="col-md-9 clockpicker">
									<input type="text" class="form-control" name="time_start" value="" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Descripcion</label>
								<div class="col-md-9">
									<textarea type="text" class="form-control" name="description" >
									</textarea>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-2 text-center">
									<button type="submit" class="btn btn-primary">Guardar</button>
									<a href="{{	URL:: previous() }}" class="btn btn-primary">Cancelar</a>
								</div>
							</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection
