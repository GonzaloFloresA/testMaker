@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >Examenes de <strong>{{ $group->course->name }}</strong> grupo <strong>{{ $group->nro }}</strong></div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
				
					<table class="table table-bordered">
						<thead>
							<th class="text-center">Descripcion</th>
							<th class="text-center">Puntaje Examen</th>
							<th class="text-center">Puntaje Ponderado</th>
							
							<th class="text-center">Fecha</th>
							<th class="text-center">Hora de Inicio</th>
							<th class="text-center">Hora de Finalizacion</th>
							<th class="text-center">Estado</th>
						</thead>
						<tbody>
							@foreach($exams as $exam)
								<tr>
									<td>{{$exam->title}}</td>
									<td>0</td>
									<td>0</td>
									<td>{{$exam->getDate()}}</td>
									<td>{{$exam->getStartTime() }}</td>
									<td>{{$exam->getEndTime()}}</td>
									<td><span class="label label-primary">Pendiente</span></td>
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
