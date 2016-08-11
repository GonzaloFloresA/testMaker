@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		@include('common.messages')
		@include('common.error')
		<div class="col-md-10 col-md-offset-1">
			
					<div class="panel panel-default">

				<div class="panel-heading" >
					
					<div class="row">
						<div class="col-md-7">
							Lista de Estudiantes del grupo <strong>{{$group_selected->nro}}</strong> de la materia de <strong>{{$group_selected->course->name }}.</strong>
						</div>
	
						<div class="col-md-4" >
							<div class="row">
              <form class="form-inline" action="{{url('teacher/'.Auth::user()->id.'/student/list')}}" method="get" id="form-users">
								<div class="form-group">
									<select class="form-control" name="group_id">
										<option disabled selected>Escoja un grupo</option>
										@foreach($groups as $group)
											<option value="{{$group->id}}">{{$group->course->name}} G{{$group->nro}}</option>
										@endforeach
									</select>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
              </form>
							</div>
            </div>
						
						<div class="col-md-1">
							<div class="row">
								<button class="btn btn-success" formaction="{{ url('teacher/user/create/email') }}" form="form-email" data-toggle="tooltip" title="Enviar Correo.">
									<i class="fa fa-envelope-o" aria-hidden="true"></i>
								</button>
								<button class="btn btn-success" data-toggle="tooltip" title="Seleccionar Todo" id="select-all">
									<i class="fa fa-globe" aria-hidden="true"></i>
								</button>				
							</div>
						</div>
					</div>
				
				</div>

				<div class="panel-body">		
         	<table class="table table-bordered">
         		<thead>
							<th class="text-center col-md-1">Select</th>
							<th class="text-center col-md-2">Codigo Sis</th>
              <th class="text-center col-md-1">Foto</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Email</th>
              <th class="text-center col-md-1">Tipo</th>
            </thead>
            <tbody>
            	<form action="" method="post" id="form-email">
            		<input type="hidden" name="_token" value="{{ csrf_token() }}">
            		@foreach($group_selected->students->sortByDesc('user_id') as $student)

            			@if($student->user_id == 0)
										<tr>
											<td class="text-center">
												
											</td>
											<td>
                    		{{$student->cod_sis}}
                  		</td>
                  		<td colspan="4" class="text-center danger">Estudiante sin Cuenta de Usuario</td>
										</tr>
            			@else


									<tr>
										<td class="text-center">
											<input type="checkbox"  name="id[]" value="{{ $student->user_id }}">
										</td>
										<td>
                    	{{$student->cod_sis}}
                  	</td>
										<td class="text-center">
                      <img src="{{URL::asset( $student->user->userPhoto() )}}" alt="default" class="img-circle" width="30px" height="30px">
                  	</td>
                  	<td>
                    	{{$student->user->name}}
                  	</td>
                  	<td>
                    	{{$student->user->email}}
                  	</td>
                  	<td>
                    	@if($student->user->isStudent())
                      	Estudiante
                    	@endif
                  	</td>	
									</tr>
									@endif
            		@endforeach
            	</form>
            </tbody>
         	</table>

				</div>

			</div>
	


				</div>
			</div>
		
@endsection

@section('scripts')
	<script>
		$('#select-all').click(function(){
			$users = $("input[type='checkbox']");
			$users.each(function($index,element){
				$(this).prop('checked',true);
			});
			// console.log($users);
			// alert($users.length);
		});
	</script>
@endsection
