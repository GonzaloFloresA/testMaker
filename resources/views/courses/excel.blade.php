@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class=" green panel-heading"> Crear Materias con Hoja de calculo </div>
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
            <div class="col-md-4">
              <h1 class='text-center'><i class="fa fa-table fa-4x" aria-hidden="true"></i></h1>
              <form  class="form-horizontal" enctype="multipart/form-data" action="{{ url('admin/course/excel') }}" method="post">
    						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    						<div class="form-group">
    							<div class="col-md-12">
    								<div class="browse-wrap">
        							<div class="title">Cargar Materias</div>
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
              <h1 class='text-center'><i class="fa fa-user-plus fa-4x" aria-hidden="true"></i></h1>
              <form  class="form-horizontal" enctype="multipart/form-data" action="{{ url('admin/teacher/excel') }}" method="post">
    						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    						<div class="form-group">
    							<div class="col-md-12">
    								<div class="browse-wrap">
        							<div class="title">Cargar Docentes</div>
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
              <h1 class='text-center'><i class="fa fa-users fa-4x" aria-hidden="true"></i></h1>
              <form  class="form-horizontal" enctype="multipart/form-data" action="{{ url('admin/student/excel') }}" method="post">
    						<input type="hidden" name="_token" value="{{ csrf_token() }}">
    						<div class="form-group">
    							<div class="col-md-12">
    								<div class="browse-wrap">
        							<div class="title">Cargar Estudiantes</div>
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
