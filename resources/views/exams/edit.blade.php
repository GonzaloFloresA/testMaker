@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Editar Examen</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')

					<form class="form-horizontal" role="form" method="POST" action="{{ url('teacher/group/'.$group.'/exam/edit/'.$exam->id) }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label class="col-md-2 control-label">Materia</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="course" value="{{ $exam->name_course }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Institucion</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="institution" value="{{ $exam->institution }}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Tipo</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="type" value="{{ $exam->type}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Descripcion</label>
								<div class="col-md-9">
									<textarea class="form-control" name="description" rows="3">{{ $exam->description }}</textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Duracion</label>
								<div class="col-md-9">
									<select class="form-control" name="duration" id="duration" value="{{$exam->duration}}">
										@foreach($range as $duration)
											@if($duration['selected'] == 1)
												<option value="{{ $duration['time'] }}" selected>
													{{ $duration['time'] }}
												</option>
											@else
												<option value="{{ $duration['time'] }}">
													{{ $duration['time'] }}
												</option>
											@endif
											
										@endforeach
									
									</select>
									
									
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Hora de Inicio</label>
								<div class="col-md-9 clockpicker">
									<input type="text" class="form-control" name="time_start" value="{{ date_format(date_create($exam->time_start), 'H:i')}}" >
								</div>
							</div>

							

							<div class="form-group">
								<div class="col-md-6 col-md-offset-2 text-center">
									<button type="submit" class="btn btn-primary">Guardar</button>
									<a href="{{	URL:: previous() }}" class="btn btn-primary">Cancelar</a>

								</div>
								<a href="{{ url('teacher/group/'.$group.'/exam/edit/'.$exam->id.'/asign') }}" class="pull-right">Asignar Preguntas >> &nbsp &nbsp  &nbsp</a>
							</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</div>



@endsection