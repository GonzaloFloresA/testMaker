@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading" >Confirmar Eliminacion</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					<p>
						Esta seguro que quiere eliminar el codigo estudiante <strong>Nro {{$student->cod_sis}}</strong>.
					</p>
					<form class="form" action="{{ url('admin/student/delete/'.$student->id) }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="text-center">
						<button class="btn btn-primary" type="submit" name="button">Eliminar</button>
						<a class="btn btn-primary" href="{{URL::previous()}}">Volver</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
