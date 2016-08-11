@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-5">
							Mis Examenes de <strong>{{ $group->course->name }}</strong>
						</div>
						<div class="col-md-7">
							<div class="row">
							<a href="{{ url('teacher/group/'.$group->id.'/exam/create')}}" class="btn btn-success" data-toggle="tooltip" title="Crear Examen nuevo"><i class="fa fa-plus" aria-hidden="true"></i></a>
						
							</div>
						</div>



					</div>
				</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					
					<table class="table table-bordered">
								<thead>
									<th class="text-center">Titulo</th>
									<th class="text-center">Tipo</th>
									<th class="text-center">Puntaje</th>
									<th class="text-center">% Nota</th>
									<th class="text-center">Fecha</th>
									<th class="text-center">Hora Inicio</th>
									<th class="text-center">Hora Fin</th>
									<th class="text-center">Estado</th>
									<th class="text-center">Acciones</th>
									

								</thead>
								<tbody>
								@foreach($exams as $exam)
									<tr class="text-center">
										<td>{{$exam->title}}</td>
										<td>
										@if($exam->types == 'presential')
											Presencial
										@elseif($exam->types == 'online')
											En linea
										@endif
										</td>

										<td>{{$exam->totalPercent()}}</td>
										@if($exam->isOnline())
											<td>{{$exam->total}}</td>
											<td>{{$exam->getDate()}}</td>
											<td>{{$exam->getStartTime()}}</td>
											<td>{{$exam->getEndTime()}}</td>
										@else
											<td class="active" colspan="4"></td>
										
										@endif
										
										<td class="text-center">
											@if($exam->state == 'edition')
												<span class="label label-primary">
													{{$exam->state}}
												</span>
											@elseif($exam->state == 'terminate')
												<span class="label label-default">
													{{$exam->state}}
												</span>
											@elseif($exam->state == 'publicate')
												<span class="label label-warning">
													{{$exam->state}}
												</span>
											@endif
										</td>
										<td class="text-center">

											<a href="{{ url('teacher/group/'.$group->id.'/exam/'.$exam->id.'/show') }}" id="show_exam" class="btn btn-default btn-delete  bg-maroon"  data-toggle="tooltip" title="Vista Preliminar del Examen">
											<i class="fa fa-eye" aria-hidden="true"></i>
											</a>

											@if($exam->stateEdition())
											<a href="{{ url('teacher/group/'.$group->id.'/exam/edit/'.$exam->id) }}" class="btn btn-default btn-delete bg-olive" data-toggle="tooltip" title="Editar Examen">
												<i class="fa fa-pencil" aria-hidden="true"></i>
											</a>

											<a href="{{ url('teacher/group/'.$group->id.'/exam/edit/'.$exam->id.'/asign') }}" class="btn btn-default btn-delete bg-blue" data-toggle="tooltip" title="Asignar Preguntas">
												<i class="fa fa-tasks" aria-hidden="true"></i>
											</a>
											@endif

											<a  href="{{ url('teacher/exam/'.$exam->id.'/pdf') }}" class="btn btn-default btn-delete bg-navy" data-toggle="tooltip" title="Generar Pdf" target="_blank">
												<i class="fa fa-print" aria-hidden="true"></i>
											</a>

											@if($exam->isOnline() && $exam->stateTerminate())
											<a  href="{{ url('teacher/group/'.$group->id.'/exam/'.$exam->id.'/publicate') }}" class="btn btn-default btn-delete bg-orange" data-toggle="tooltip" title="Publicar Examen">
												<i class="fa fa-paper-plane" aria-hidden="true"></i>
											</a>
											@endif

											@if($exam->stateEdition())
											<a href="{{ url('teacher/group/'.$group->id.'/exam/delete/'.$exam->id) }}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar Examen">
												<i class="fa fa-trash" aria-hidden="true"></i>
											</a>
											@endif
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
