@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class=" green panel-heading"> Previsualizacion de Datos </div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					@include('common.notifications')
					<p>Los registros correctos se ven a continuacion, si continuas los mismos se registraran.</p>
          <table class='table table-bordered'>
            <thead>
              <th>
                Codigo_sis
              </th>
              <th>
                Nombre
              </th>
							<th>
								Semestre
							</th>
							<th>
								Carrera
							</th>
            </thead>
            <tbody>

              @foreach($courses as $course)
                <tr>
                  <td>{{ $course->cod_sis}}</td>
                  <td>{{ $course->name }}</td>
									  <td>{{ $course->level }}</td>
											  <td>{{ $course->career->name }}</td>
                </tr>
              @endforeach

            </tbody>
          </table>
					<div class="text-center">
						<a href="{{url('admin/course/excel')}}" class="btn btn-primary"> Atras </a>
						<a href="{{url('admin/course/savexcel')}}"  class="btn btn-primary"> Guardar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
