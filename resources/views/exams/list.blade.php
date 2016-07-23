@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-2">
							Mis Examenes
						</div>
						<div class="col-md-6">
							<div class="row">
							<a href="{{ url('teacher/group/'.$group.'/exam/create')}}" class="btn btn-success" data-toggle="tooltip" title="Crear Examen nuevo"><i class="fa fa-plus" aria-hidden="true"></i></a>
						
							</div>
						</div>



					</div>
				</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					
					<table class="table table-bordered">
								<thead>
									<th class="text-center">Nombre Curso</th>
									<th class="text-center">Institucion</th>
									<th class="text-center">Tipo</th>
									<th class="text-center">Duracion</th>
									<th class="text-center">Acciones</th>
								</thead>
								<tbody>
								@foreach($exams as $exam)
									<tr>
										<td>{{$exam->name_course}}</td>
										<td>{{$exam->institution}}</td>
										<td>{{$exam->type}}</td>
										<td>{{$exam->duration}}</td>
										<td>
											<a href="{{ url('teacher/group/'.$group.'/exam/edit/'.$exam->id) }}" class="btn btn-default btn-delete bg-olive" data-toggle="tooltip" title="Editar Examen">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</a>

											<a href="{{ url('teacher/group/'.$group.'/exam/delete/'.$exam->id) }}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar Examen">
												<i class="fa fa-close" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
								@endforeach
								</tbody>
							</table>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
