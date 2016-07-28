@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">

				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-2">
							Mis Preguntas
						</div>
						<div class="col-md-6">
							<div class="row">
							<!-- <a href="{{ url('teacher/question/store') }}" class="btn btn-success" data-toggle="tooltip" title="Crear Pregunta nueva">
								<i class="fa fa-plus" aria-hidden="true"></i>
							</a> -->

							<form class="form-inline col-md-offset-1" action="{{url('teacher/question/store')}}" method="get">

									<div class="form-group">
									<select class="form-control" name="type">
										<option value="multiple">Opcion Multiple</option>
										<option value="develop">Desarrollo</option>
										<option value="complemento">Complemento</option>
									</select>
									</div>
  									
									<div class="form-group">
										<input type="hidden" name="group" value="{{ $id }}">
										<button type="submit" class="btn btn-success" data-toggle="tooltip" title="Crear Pregunta nueva">
										<i class="fa fa-plus" aria-hidden="true"></i>
										</button>
									</div>
              </form>
							</div>
						</div>



					</div>
				</div>

				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<table class="table table-bordered">
								<thead>
									<th class="text-center">Titulo</th>
									<th class="text-center">Tipo</th>
									<th class="text-center">Acciones</th>
								</thead>
								<tbody>
									@foreach($questions as $question)
										<tr>
											<td class="text-center">
												{{ $question->title }}
											</td>
											<td class="text-center">
												@if($question->types == 'develop')
													Desarrollo
												@elseif($question->types == 'multiple')
													Op. Multiple
												@elseif($question->types == 'complemento')
													Complemento
												@endif
												
											</td>
											<td class="text-center">
												<a href="{{ url('teacher/question/show/'.$question->id) }}" class="btn btn-default btn-delete bg-orange" data-toggle="tooltip" title="Ver Pregunta">
												<i class="fa fa-eye" aria-hidden="true" ></i>
												</a>

												<a href="{{ url('teacher/question/edit/'.$question->id) }}" class="btn btn-default btn-delete bg-blue" data-toggle="tooltip" title="Editar Pregunta">
												<i class="fa fa-pencil" aria-hidden="true" ></i>
												</a>

												<a href="{{ url('teacher/question/delete/'.$question->id) }}" class="btn btn-default btn-delete bg-red" data-toggle="tooltip" title="Eliminar Pregunta">
												<i class="fa fa-trash" aria-hidden="true" ></i>
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
