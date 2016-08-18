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
                	@foreach($groups as $group)

                 <div class="col-md-3 col-sm-6 ">
                    <div class="team-member wow fadeInUp animated group" data-wow-duration="400ms" data-wow-delay="300ms" style="visibility: visible; animation-duration: 400ms; animation-delay: 300ms; animation-name: fadeInUp;">
                        <div class="team-img">
                        	<a href="{{url('teacher/group/'.$group->id.'/description')}}">
                            <img class="img-responsive" src="{{ URL::asset('images/libro-icono.png')}}" alt="" width="150px">
                            </a> 
                        </div>
                        <div class="team-info">
                            <p></p>
                            <p>  <span><strong>Grupo {{ $group->nro }} </strong></span>
                            	<span class="pull-right">
                            	<a class="btn btn-default btn-delete bg-olive" href="{{ url('teacher/group/'.$group->id.'/questions') }}" data-toggle="tooltip" title="Preguntas de la Materia">
                            		<i class="fa fa-question" aria-hidden="true"></i>
                            	</a>
                            	<a class="btn btn-default btn-delete bg-olive" href="{{ url('teacher/group/'.$group->id.'/exams') }}" data-toggle="tooltip" title="Lista de Examenes">
                            		<i class="fa fa-list " aria-hidden="true"></i>
                            	</a>
                            	</span>
                            </p>
                           
                        </div>  
                    </div>
                </div>
                	@endforeach
            </div>

					
					<!-- <div class="row">
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
 -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection