@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
    @include('common.messages')
    @include('common.error')
		<div class="col-md-5 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-5">
							Docentes no Registrados
						</div>
						<div class="col-md-1">
							<div class="row">
							<a href="{{ url('admin/course/excel') }}" class="btn btn-success" data-toggle="tooltip" title="Ingresar Excel">
								<i class="fa fa-table" aria-hidden="true"></i>
							</a>
							</div>
						</div>
						<div class="col-md-6" >
							<div class="row">
              <form class="form-inline col-md-offset-1" action="{{url('admin/teacher')}}" method="get">
  								<div class="form-group">
											<input type="text"  name="unknow" class="form-control" id="unknow" placeholder="Codigo Sis...">
  								</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
              </form>
							</div>
            </div>
					</div>
				</div>
				<div class="panel-body">

          <table class="table table-bordered black">
            <thead>
              <!-- <th class="col-sm-1 text-center">Select</th> -->
              <th class="col-sm-1 text-center">Codigo Sis</th>
              <th class="col-sm-1 text-center">Acciones</th>
            </thead>
            <tbody>

              <tr>
                <form class="form-inline" action="{{url('admin/teacher/create')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <td>
                  <input  class="form-control" type="text" name="cod_sis" value="">
                </td>

                <td class="text-center">
                  <button  class="btn btn-default btn-create bg-blue" type="submit" name="button" data-toggle="tooltip" title="Crear Materia"><i class="fa fa-plus" aria-hidden="true"></i></button>
                </td>
              </form>
              </tr>

              @foreach($unknows as $teacher)
                <tr>

                  <td>
                    {{$teacher->cod_sis}}
                  </td>


                  <td class="text-center">

                    <a href="{{url('admin/teacher/eliminate/'.$teacher->id)}}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar" >
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
					<div class="row text-center">
							{!! $unknows->render() !!}
					</div>
				</div>
			</div>
		</div>



    <div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-4">
							Docentes Registrados
						</div>
						<div class="col-md-2">


						</div>
						<div class="col-md-6" >
							<div class="row">
              <form class="form-inline col-md-offset-3" action="{{url('admin/teacher')}}" method="get">
  								<div class="form-group">
											<input type="text"  name="register" class="form-control" id="register" placeholder="Codigo Sis...">
  								</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
              </form>
							</div>
            </div>
					</div>

				</div>
				<div class="panel-body">


          <table class="table table-bordered black">
            <thead>
              <!-- <th class="col-sm-1 text-center">Select</th> -->
              <th class="col-sm-1 text-center">Codigo Sis</th>
              <th class="col-sm-2 text-center">Nombre</th>
              <th class="col-sm-1 text-center">Acciones</th>
            </thead>
            <tbody>
              <form class="" action="" method="get" id="check-selection">
              @foreach($registered as $teacher)
                <tr>
                  <!-- <td class="text-center">

                      <input type="checkbox" name="id[]" value="{{ $teacher->id }}">

                  </td> -->
                  <td>
                    {{$teacher->cod_sis}}
                  </td>
                  <td>
                    {{$teacher->user->name}}
                  </td>

                  <td class="text-center">
                    <a href="{{ url('admin/user?attribute=name&field='.$teacher->user->name) }}" class="btn btn-default btn-edit bg-orange" data-toggle="tooltip" title="Ver usuario">
                    	<i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                    <!-- <a href="{{url('admin/teacher/eliminate/'.$teacher->id)}}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar" >
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a> -->
                  </td>
                </tr>
              @endforeach
              </form>
            </tbody>
          </table>
					<div class="row text-center">
							{!! $registered->render() !!}
					</div>
				</div>
			</div>
		</div>


	</div>
</div>
@endsection
