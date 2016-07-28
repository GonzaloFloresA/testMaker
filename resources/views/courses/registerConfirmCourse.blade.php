@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading" >Confirmar Inscripcion</div>
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
						Esta seguro que quiere Inscribirse al Grupo <strong>{{$group->nro}}</strong> - <strong> {{$group->course->name}}</strong> del Docente <strong>{{$group->teacher->user->name}}</strong>
					</p>
					<form class="form" action="{{ url('student/'.$group->id.'/register') }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token	() }}">
						<input type="hidden" name="student_id" value="{{ Auth::user()->id }}">
						<div class="text-center">
						<button class="btn btn-primary" type="submit" name="button">Inscribirse</button>
						<a class="btn btn-primary" href="{{URL::previous()}}">Volver</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
