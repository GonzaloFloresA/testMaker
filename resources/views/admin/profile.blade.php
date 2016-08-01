@extends('layouts.master')
@section('content')



<div class="container-fluid">
@include('common.messages')
@include('common.error')
	<div class="row">

		<div class="col-md-2 col-md-offset-2">

			<div class="panel panel-default">
				<div class="panel-heading" >Foto de Perfil</div>
				<div class="panel-body">

					<img  id="img-photo" src="{{URL::asset( Auth::user()->userPhoto() )}}" alt="default" class="img-rounded" width="165px" height="175px">
					<form  class="form-horizontal" enctype="multipart/form-data" action="{{ url('user/storage/'.$user->id) }}" method="post">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class="col-md-12">
								<div class="browse-wrap">
    							<div class="title">Cargar Foto</div>
    								<input type="file" id="photo-file" name="file-up" class="photo" title="Choose a file to upload">
									</div>
									<span class="upload-path"></span>
								<!-- <input class="btn" type="file" id="photo" name="photo"  value="Enviar"> -->
							</div>
						</div>


							<div class="form-group">
								<div class="col-md-12 ">
									<div class="text-center">
										<button type="submit" class="btn btn-primary">Guardar</button>
									</div>
								</div>
							</div>

					</form>


				</div>
			</div>

		</div>

		<div class="col-md-6">


			<div class="panel panel-default ">
				<div class="panel-heading" >Datos Personales</div>
				<div class="panel-body">

					<form class="form-horizontal" role="form" method="POST" action="{{ url('user/edit/'.$user->id) }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
							<label class="col-md-2 control-label">Nombre</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="name" value="{{ $user->name }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Email</label>
							<div class="col-md-9">
								<input type="email" class="form-control" name="email" value="{{ $user->email }}" >
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-2 control-label">Telefono</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="phone" value="{{ $user->phone }}" >
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-2">
								<button type="submit" class="btn btn-primary">Guardar Cambios</button>

							</div>

						</div>
					</form>

				</div>
			</div>

			<div class="panel panel-default shadow-panel">
				<div class="panel-heading" > Cambiar Contrasena </div>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ url('user/resetpass/'.$user->id) }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">


						<div class="form-group">
							<label class="col-md-4 control-label">Contrasena Nueva</label>
							<div class="col-md-8">
								<input type="password" class="form-control" name="password" value="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmar Contrasena</label>
							<div class="col-md-8">
								<input type="password" class="form-control" name="password_confirmation" value="">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-2 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Guardar</button>
							</div>
						</div>
					</form>
				</div>
			</div
		
		</div>

</div>
</div>
@stop
