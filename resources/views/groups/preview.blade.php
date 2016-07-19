@extends('layouts.master')

@section('content')
<div class="container-fluid">
  @include('common.messages')
  @include('common.error')
  <!-- @include('common.notifications') -->
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class=" green panel-heading"> Previsualizacion de Datos </div>
				<div class="panel-body">

					<p>Los registros que son correctos se guardaran si lo desea, el resto sera ignorado</p>
          <div class="row">
          <div class="col-md-10 col-md-offset-1">
          <form class="" action="{{url('admin/group/savexcel')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <table class='table table-bordered text-center'>
            <thead>
              <th class="text-center">
                Fila
              </th>
              <th class="text-center">
                Codigo Sis Docente
              </th>
              <th class="text-center">
                Codigo Sis Materia
              </th>
              <th class="text-center">
                Grup Nro.
              </th>
              <th class="text-center">
                Inspeccion
              </th>
            </thead>
            <tbody>
              <span style="display:none;">{{ $i = 0 }}</span>
              @foreach($groups as $group)
                @if($group['error'])
                    <tr class="danger">
                @else
                    <tr class="success">
                @endif

                  <td>
                      {{++$i}}
                  </td>

                  <td>{{ $group['cod_sis_teacher'] }}</td>
                  <td>{{ $group['cod_sis_course'] }}</td>
                  <td>{{ $group['nro'] }}</td>
                  <td>
                    @if($group['error'])
                      <span class="label label-danger bg-red">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                      </span>
                    @else
                      <span class="label label-success bg-green">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                      </span>
                      <input type="hidden" name="teachers_id[]" value="{{ $group['teacher_id'] }}">
                      <input type="hidden" name="courses_id[]" value="{{ $group['course_id'] }}">
                      <input type="hidden" name="nro[]" value="{{ $group['nro'] }}">
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
