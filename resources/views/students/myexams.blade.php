@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		

		<div class="col-md-10 col-md-offset-1">

			<div class="panel panel-default">
				<div class="panel-heading" >Detalles de la materia</div>
				<div class="panel-body">
					<p>Docente: <strong>{{ $group->teacher->user->name }}</strong></p>
					<p>Descripcion: <div class="bg-aqua">{!! $group->description !!}</div></p>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading" >Examenes de <strong>{{ $group->course->name }}</strong> Grupo <strong>{{ $group->nro }}</strong></div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
				
					<table class="table table-bordered">
						<thead>
							<th class="text-center">Descripcion</th>
							<th class="text-center">Puntaje Examen</th>
							<th class="text-center">Puntaje Ponderado</th>
							<th class="text-center">Token Access</th>
						
							<th class="text-center">Hora Inicio</th>
							<th class="text-center">Hora Fin</th>
							<th class="text-center">Estado</th>
							<th class="text-center">Accion</th>
						</thead>
						<tbody>
							@foreach($exams as $exam)
								<tr class="text-center">
									<td>{{$exam->exam->title}}</td>
									<td>{{$exam->calification}}</td>
									<td>{{$exam->calification * $exam->exam->total / 100}}</td>
									<td>{{$exam->token_access}}</td>
									<td>{{$exam->start}}</td>
									<td>{{$exam->end}}</td>
									@if($exam->pending == false)
										<td>
											<label class="label default bg-gray">Terminado</label></td>
										
										<td>
											
										</td>
									@else 
										<td>
											<label class="label default bg-blue">Pendiente</label></td>
										
										<td>
				<a href="{{url('student/'.$id.'/group/'.$group->id.'/exam/'.$exam->exam->id.'/eval/'.$exam->id) }}" class="btn  btn-xs bg-olive white">Iniciar Examen</a>
										</td>
									@endif
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
