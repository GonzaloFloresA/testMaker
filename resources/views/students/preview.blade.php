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
          <div class="col-md-6 col-md-offset-3">
          <form class="" action="{{url('admin/student/savexcel')}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <table class='table table-bordered text-center'>
            <thead>
              <th class="text-center">
                Fila
              </th>
              <th class="text-center">
                Codigo_sis
              </th>
              <th class="text-center">
                Inspeccion
              </th>
            </thead>
            <tbody>
              <span style="display:none;">{{ $i = 0 }}</span>
              @foreach($students as $student)
                @if($student['error'])
                    <tr class="danger">
                @else
                    <tr class="success">
                @endif

                  <td>
                      {{++$i}}
                  </td>

                  <td>{{ $student['cod_sis']}}</td>

                  <td>
                    @if($student['error'])
                      <span class="label label-danger bg-red">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                      </span>
                    @else
                      <span class="label label-success bg-green">
                        <i class="fa fa-check-circle" aria-hidden="true"></i>
                      </span>
                      <input type="hidden" name="cod_sis[]" value="{{ $student['cod_sis'] }}">
                    @endif
                  </td>
                </tr>
              @endforeach

            </tbody>
          </table>
          <div class="text-center">
						<a href="{{url('admin/course/excel')}}" class="btn btn-primary"> Atras </a>
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
