@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">

				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-2">
							Crear Grupo
						</div>
						<div class="col-md-4">
							<div class="row">
							<a href="{{ url('admin/group/excel') }}" class="btn btn-success" data-toggle="tooltip" title="Crear a partir de excel">
								<i class="fa fa-table" aria-hidden="true"></i>
							</a>
							</div>
						</div>

					</div>
				</div>

				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
          <div class="row">
            <div class="col-md-12">

              <form class="" action="{{url('admin/group/store')}}" method="post">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
									<label for="teacher">Docente</label>
                  <select multiple class="form-control" name="teacher">
                    @foreach($teachers as $teacher)
                      <option value="{{$teacher->id}}" data-group="{{$teacher->groups}}">{{$teacher->user->name}}</option>
                    @endforeach
                  </select>
                </div>
                </div>

                <div class="col-md-6">
                <div  class="form-group">
									<label for="course">Materia</label>
                  <select multiple class="form-control" name="course">
                    @foreach($courses as $course)
                      <option value="{{$course->id}}">{{$course->name}}</option>
                    @endforeach
                  </select>
                </div>
                </div>

                <!-- <div class="col-md-1">
                <div class="form-group">
                  <input class="form-control col-md-1" type="text" name="name" value="">
                </div>
                </div> -->
                </div>
                <div class="row">
                  <div class="col-md-2 col-md-offset-5">
                  <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="button">Crear Grupo</button>
                  </div>
                  </div>
                </div>
              </form>
            </div>
          </div>

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading" >

          <div class="row">
            <div class="col-md-3">
              Registro de Grupos
            </div>
            <div class="col-md-3">
              <!-- <div class="row">

              <button class="btn btn-success" formaction="{{ url('admin/user/email') }}" form="form-email" data-toggle="tooltip" title="Enviar Correo.">
                <i class="fa fa-envelope-o" aria-hidden="true"></i>
              </button>
              <button  class="btn btn-success" formaction="{{ url('admin/user/deletegroup') }}" form="form-email"  data-toggle="tooltip" title="Eliminar Usuarios">
                <i class="fa fa-trash-o" aria-hidden="true"></i>
              </button>
              </div> -->
            </div>
            <div class="col-md-6" >
              <div class="row">
              <form class="form-inline col-md-offset-2" action="{{url('admin/group')}}" method="get">

                  <div class="form-group">
                  <select class="form-control" name="attribute">
                    <option value="course">Materia</option>
                    <option value="teacher">Docente</option>
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
          <table class="table table-bordered black">
            <thead>
              <th class="text-center">Materia</th>
              <th class="col-sm-1 text-center">Grupo</th>
              <th class="text-center">Docente</th>
              <th class="text-center">
                Acciones
              </th>
              <!-- <th class="col-sm-1">Semestre</th>
              <th class="col-sm-2">Carrera</th>
              <th>Acciones</th> -->
            </thead>
            <tbody>


              <form class="" action="" method="get" id="check-selection">
              @foreach($groups as $group)
                <tr>

                  <td>
                    {{$group->course->name}}
                  </td>
                  <td>
                     <a href="{{url('admin/group/show/'.$group->id)}}" class="btn btn-default btn-delete bg-orange"  data-toggle="tooltip" title="Ver Grupo">
+                          {{$group->nro}}
+                        </a>
                  </td>
                  <td>
                    {{$group->teacher->user->name}}
                  </td>

                  <td class="text-center">
                    <a href="{{url('admin/group/eliminate/'.$group->id)}}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar" >
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
                  </td>
                </tr>
              @endforeach
              </form>
            </tbody>
          </table>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
