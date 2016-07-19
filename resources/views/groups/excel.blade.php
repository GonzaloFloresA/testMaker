@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class=" green panel-heading"> Crear Grupo con Hoja de calculo </div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					<p>
						Los archivos deberian tener la extension .csv
					</p>
					<h3>
						<span class="upload-path"></span>
					</h3>

					<div class="row">
						<div class="col-md-4 col-md-offset-2">
              <h1 class='text-center'><i class="fa fa-chain fa-4x" aria-hidden="true"></i></h1>
              <form  class="form-horizontal" enctype="multipart/form-data" action="{{ url('admin/group/create') }}" method="post">
    						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    						<div class="form-group">
    							<div class="col-md-12">
    								<div class="browse-wrap">
        							<div class="title">Asignar Docente Grupo</div>
        								<input type="file" id="file-up" name="file-up" class="excel" title="Choose a file to upload">
    									</div>
    									<!-- <span class="upload-path"></span> -->
    								<!-- <input class="btn" type="file" id="photo" name="photo"  value="Enviar"> -->
    							</div>
    						</div>
    							<div class="form-group">
    								<div class="col-md-12 ">
    									<div class="text-center">
    										<button type="submit" class="btn btn-primary">Previsualizar</button>
    									</div>
    								</div>
    							</div>
    					</form>
            </div>

						<div class="col-md-4">
              <h1 class='text-center'><i class="fa fa-chain fa-4x" aria-hidden="true"></i></h1>
              <form  class="form-horizontal" enctype="multipart/form-data" action="{{ url('admin/group/asign') }}" method="post">
    						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    						<div class="form-group">
    							<div class="col-md-12">
    								<div class="browse-wrap">
        							<div class="title" >Asignar Estudiante Grupo</div>
        								<input type="file" id="file-up" name="file-up" class="excel" title="Choose a file to upload">
    									</div>
    									<!-- <span class="upload-path"></span> -->
    								<!-- <input class="btn" type="file" id="photo" name="photo"  value="Enviar"> -->
    							</div>
    						</div>
    							<div class="form-group">
    								<div class="col-md-12 ">
    									<div class="text-center">
    										<button type="submit" class="btn btn-primary">Previsualizar</button>
    									</div>
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
@endsection
