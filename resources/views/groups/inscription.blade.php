@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Inscripcion de Estudiantes</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					<p>Los registros que son correctos se guardaran si lo desea, el resto sera ignorado</p>

					<div class="row">
          	<div class="col-md-10 col-md-offset-1">
          		<form class="" action="{{url('admin/group/inscription')}}" method="post">
            		<input type="hidden" name="_token" value="{{ csrf_token() }}">
          			<table class='table table-bordered text-center'>
            			<thead>
              			<th class="text-center"> Fila </th>
              			<th class="text-center"> Codigo Sis Estudiante </th>
              			<th class="text-center"> Codigo Sis Materia </th>
              			<th class="text-center">Grupo Nro. </th>
              			<th class="text-center">	Inspeccion </th>
            			</thead>
            			<tbody>
              			<span style="display:none;">{{ $i = 0 }}</span>
              				@foreach($inscriptions as $inscription)
                				@if($inscription['error'])
                    			<tr class="danger">
                				@else
                    			<tr class="success">
                				@endif
 														<td> {{++$i}} </td>
                  					<td>{{ $inscription['cod_sis_student'] }}</td>
                  					<td>{{ $inscription['cod_sis_course'] }}</td>
                  					<td>{{ $inscription['group_nro'] }}</td>
                  					<td>
                   					 	@if($inscription['error'])
                      				<span class="label label-danger bg-red">
                        				<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                      				</span>
                    					@else
                      				<span class="label label-success bg-green">
                        				<i class="fa fa-check-circle" aria-hidden="true"></i>
                      				</span>
                      				<input type="hidden" name="students_id[]" value="{{ $inscription['student_id'] }}">
                      				<input type="hidden" name="groups_id[]" value="{{ $inscription['group_id'] }}">
                      				<input type="hidden" name="nro[]" value="{{ $inscription['group_nro'] }}">
                    					@endif
                  					</td>
                					</tr>
              				@endforeach

            </tbody>
          </table>
          <div class="text-center">
						<a href="{{url('admin/group/excel')}}" class="btn btn-primary"> Atras </a>
						<!-- <a href="{{url('admin/teacher/savexcel')}}"  class="btn btn-primary"> Guardar</a> -->
            <button type="submit" name="button" class="btn btn-primary">Guardar</button>
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
