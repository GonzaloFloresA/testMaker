
@extends('layouts.master')

@section('content')
<div class="container-fluid">

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-2">
							Lista de Materias
						</div>
						<div class="col-md-4">
							<div class="row">
							<a href="{{ url('admin/course/excel') }}" class="btn btn-success" data-toggle="tooltip" title="Crear a partir de excel">
								<i class="fa fa-table" aria-hidden="true"></i>
							</a>

							<button  class="btn btn-success" formaction="{{ url('admin/course/deletegroup') }}" form="check-selection" data-toggle="tooltip" title="Eliminar Seleccionados">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</button>
							</div>
						</div>
						<div class="col-md-6" >
							<div class="row">
              <form class="form-inline col-md-offset-4" action="{{url('admin/course')}}" method="get">

									<div class="form-group">
									<select class="form-control" name="attribute">
										<option value="name">Nombre</option>
										<option value="cod_sis">Codigo</option>
										<option value="level">Semestre</option>
									</select>
									</div>
  								<div class="form-group">
											<input type="text"  name="field" class="form-control" id="field" placeholder="Atributo...">
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
          	@include('common.messages')
						@include('common.error')


            <table class="table table-bordered black">
              <thead>
								<th>Select</th>
                <th class="col-sm-1">Codigo Sis</th>
                <th>Nombre</th>
								<th class="col-sm-1">Semestre</th>
								<th class="col-sm-2">Carrera</th>
                <th>Acciones</th>
              </thead>
              <tbody>

                <tr>
                  <form class="form-inline" action="{{url('admin/course/create')}}" method="post">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
									<td>

									</td>
                  <td>
                    <input  class="form-control" type="text" name="cod_sis" value="">
                  </td>
                  <td>
                    <input  class="form-control" type="text" name="name" value="">
                  </td>
									<td>
										<input  class="form-control" type="text" name="level" value="">
									</td>
									<td>
										<select class="form-control" name="career_id">
												<option value='-1' selected hidden>Escoja un valor</option>
												@foreach($careers as $career)
														<option value='{{$career->id}}' >{{$career->name}}</option>
												@endforeach
										</select>

									</td>
                  <td class="text-center">
                    <button  class="btn btn-default btn-create bg-blue" type="submit" name="button" data-toggle="tooltip" title="Crear Materia"><i class="fa fa-plus" aria-hidden="true"></i></button>
                  </td>
                  </form>
                </tr>
								<form class="" action="" method="get" id="check-selection">
                @foreach($courses as $course)
                  <tr>
										<td class="text-center">
											<!-- <div class="checkbox"> -->
												<input type="checkbox" name="id[]" value="{{ $course->id }}">
											<!-- </div> -->
										</td>
                    <td>
                      {{$course->cod_sis}}
                    </td>
                    <td>
                      {{$course->name}}
                    </td>
										<td>
											{{$course->level}}
										</td>
										<td>
											{{$course->career->name}}
										</td>
                    <td class="text-center">
                      <a href="{{url('admin/course/edit/'.$course->id)}}" class="btn btn-default btn-edit bg-green" data-toggle="tooltip" title="Editar">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
                      <a href="{{url('admin/course/eliminate/'.$course->id)}}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar" >
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
					
					  <a href="{{url('admin/course/show/'.$course->id)}}" class="btn btn-default btn-delete bg-green" data-toggle="tooltip" title="Ver Detalles" >
												<span class="glyphicon glyphicon-eye-open"></span>
											</a>
                    </td>
                  </tr>
                @endforeach
								</form>
              </tbody>
            </table>
						<div class="row text-center">
								{!! $courses->render() !!}
						</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
