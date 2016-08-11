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
								<label class="col-md-2 control-label">Titulo</label>
								<div class="col-md-9">
									<input type="text" class="form-control" name="title" value="{{ $exam->title}}">
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Tipo</label>
								<div class="col-md-9">
									<select class="form-control" name="types" id="types" value="">
									@if($exam->isPresential())
										<option value="presential" selected>Presencial</option>
										<option value="online">En Linea</option>
									@else
										<option value="presential">Presencial</option>
										<option value="online" selected>En Linea</option>
									@endif
												
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Descripcion</label>
								<div class="col-md-9">
									<textarea class="form-control" name="description" rows="3">{{ $exam->description }}</textarea>
								</div>
							</div>


							@if($exam->isPresential())
								<fieldset id="info_online" style="display:none;">
							@else
								<fieldset id="info_online" >
							@endif
							
							<legend>Informacion Examen en Linea</legend>
							<div class="form-group">
								<label class="col-md-2 control-label">Fecha</label>
								<div class="col-md-9 ">
									<input  id="date" type="text" class="form-control" name="date_exam" value="{{$exam->getDate()}}" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Hora Inicio</label>
								<div class="col-md-9 clockpicker">
									<input type="text" class="form-control" name="time_start" value="{{$exam->getStartTime()}}" >
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-2 control-label">Hora Final</label>
								<div class="col-md-9 clockpicker">
									<input type="text" class="form-control" name="duration" value="{{$exam->getEndTime()}}" >
								</div>
							</div>

					
							<div class="form-group">
								<label class="col-md-2 control-label">Ponderacion de la Nota</label>
								<div class="col-md-9">
									<input type="number" class="form-control" name="total" min="0" max="100" value="{{ $exam->total }}">
								</div>
							</div>
							</fieldset>
							

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

@section('scripts')
<script src="{{URL::asset('js/bootstrap-datetimepicker.min.js')}}"></script>

 <script type="text/javascript">
 	$('#date').datetimepicker({
 		format:'YYYY-MM-DD'
 	});
 </script>


 <script type="text/javascript">

	function showInfoOnline(){
		$('#info_online').show();
	}

	function hideInfoOnline(){
		$('#info_online').hide()
	}

	$('#types').change(function(){
		var option =$("#types option:selected").val(); 
		// alert(option);
		if(option == 'presential'){
			hideInfoOnline();
		}else if(option == 'online'){
			showInfoOnline();
		}
	});

	// hideInfoOnline();


</script>

@endsection