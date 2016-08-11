@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Detalles del Curso</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
          	<form class="form-horizontal" role="form" method="POST" action="{{ url('admin/course/edit/'.$course->id) }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

            	<div class="form-group">
								<label class="col-md-4 control-label">Codigo Sis</label>
								<div class="col-md-6">
									<input type="cod_sis" class="form-control" name="cod_sis" value="{{ $course->cod_sis }}" disabled >
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Nombre</label>
								<div class="col-md-6">
									<input type="text" class="form-control" name="name" value="{{ $course->name }}" disabled>
								</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Semestre</label>
									<div class="col-md-6">
										<input type="text" class="form-control" name="level" value="{{ $course->level }}" disabled>
									</div>
							</div>

							<div class="form-group">
								<label class="col-md-4 control-label">Carrera</label>
								<div class="col-md-6">
									<select class="form-control" name="career_id" value='{{$course->career_id}}' disabled>
										<!-- <option value='-1' selected hidden>Escoja un valor</option> -->
										@foreach($careers as $career)
										@if( $career->id === intval($course->career_id) )
												<option value='{{$career->id}}' selected >{{$career->name}}</option>
										@else
												<option value='{{$career->id}}' >{{$career->name}}</option>
										@endif

										@endforeach
									</select>
								</div>
							</div>

							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
								
                  <a class="btn btn-primary" href="{{url('admin/course/edit/'.$course->id)}}">Editar
                  </a>
									<a class="btn btn-primary" href="{{URL::previous()}}">Volver</a>
								</div>                         
							</div>                    
						</form>
				</div>
			
	

<!-- LISTAR TODAS LOS GRUPOS -->

	
		</div> <!-- panel default -->
		
		<div class="panel panel-default">
				<div class="panel-heading" >Grupos de la Materia</div>
				<div class="panel-body">
				<table class="table table-bordered black">
              <thead>
                	<th class="col-sm-1">Nro</th>
                	<th>Docente</th>
                	<th>Materia</th>
                	<th>Anio</th>
                	<th>Semestre</th>
                	<th>Acciones</th>
              </thead>
              <tbody>
				@foreach($groups as $group)
                  <tr>
										
                    <td>
                      {{ $group->nro }}
                    </td>
                    <td>
                      {{ $group->teacherName }}
                    </td>
					<td>
						{{ $group->courseName }}
					</td>
					<td>
						{{ $group->year }}
					</td>
					<td>
						{{ $group->semester }}
					</td>
										
                    <td class="text-center">
                      
                      <a href="{{url('admin/group/eliminate/'.$group->id)}}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar" >
                      <i class="fa fa-trash" aria-hidden="true"></i>
                    </a>
					  
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
				</div>
			</div>
		</div>



		</div> <!-- col md 8 -->
	</div> <!-- row -->
</div>
@endsection