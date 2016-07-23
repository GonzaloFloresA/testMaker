@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" > Grupos Asignados de la materia 
					<strong> {{$name_course}} </strong>
				</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
				
					<div class="row">
						<div class="col-md-8 col-md-offset-2">
							<table class="table table-bordered">
								<thead>
									<th class="text-center">Grupo Nro.</th>
									<th class="text-center">Acciones</th>
								</thead>
								<tbody>
								@foreach($groups as $group)
									<tr>
										<td class="text-center">
											{{ $group->nro }}
										</td>
										<td class="text-center">
											<!-- <a href="{{ url('teacher/group/'.$group->id.'/students') }}" class="btn btn-default btn-delete bg-blue" data-toggle="tooltip" title="Lista de Estudiantes">
												<i class="fa fa-users" aria-hidden="true" ></i>
											</a> -->

											<a href="{{ url('teacher/group/'.$group->id.'/questions') }}" class="btn btn-default btn-delete bg-lime" data-toggle="tooltip" title="Preguntas de la Materia">
												<i class="fa fa-question" aria-hidden="true"></i>
											</a>

											<a href=" {{ url('teacher/group/'.$group->id.'/exams') }} " class="btn btn-default btn-delete bg-orange" data-toggle="tooltip" title="Lista de Examenes">
												<i class="fa fa-list" aria-hidden="true" ></i>
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
	</div>
</div>
@endsection