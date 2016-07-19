@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading" >Confirmar Eliminacion</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Ups!</strong> Hay algunos problemas con tus campos.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<p>
						Esta seguro que quiere eliminar <strong>{{$course->name}}</strong> con codigo sis numero <strong> {{$course->cod_sis}}</strong>
					</p>
					<form class="form" action="{{ url('admin/course/delete/'.$course->id) }}" method="post">
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
