@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading" >Confirmar Termino Edicion</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					<div id="confirm_eliminate">
						<p>Esta seguro que quiere terminar la edicion del examen <strong>{{$exam->title}}</strong> del grupo <strong>{{ $group->nro }}</strong>. Si lo hace no podra volver a editar la informacion del mismo, asi como asignar preguntas.</p>
					</div>
					<form class="form" action="{{ url('teacher/group/'.$group->id.'/exam/'.$exam->id.'/terminate') }}" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="text-center">
						<button class="btn btn-primary" type="submit" name="button">Terminar</button>
						<a class="btn btn-primary" href="{{ url('teacher/group/'.$group->id.'/exam/edit/'.$exam->id.'/asign')}}">Volver</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
