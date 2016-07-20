@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-2">
							Lista de Usuarios
						</div>
						<div class="col-md-4">
							<div class="row">

							<button class="btn btn-success" formaction="{{ url('admin/user/email') }}" form="form-email" data-toggle="tooltip" title="Enviar Correo.">
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</button>
							<button  class="btn btn-success" formaction="{{ url('admin/user/deletegroup') }}" form="form-email"  data-toggle="tooltip" title="Eliminar Usuarios">
								<i class="fa fa-trash-o" aria-hidden="true"></i>
							</button>
							</div>
						</div>
						<div class="col-md-6" >
							<div class="row">
              <form class="form-inline col-md-offset-4" action="{{url('admin/user')}}" method="get">

									<div class="form-group">
									<select class="form-control" name="attribute">
										<option value="name">Nombre</option>
										<option value="email">Email</option>
										<option value="type">Tipo</option>
										<option value="active">Estado</option>
									</select>
									</div>
  								<div class="form-group">
											<input type="text"  name="field" class="form-control" id="field" placeholder="Atributo...">
  								</div>
									<div class="form-group">
										<button type="submit" class="btn btn-success"><i class="fa fa-search" aria-hidden="true"></i></button>
									</div>
              </form>
							</div>

            </div>
					</div>

				</div>
				<div class="panel-body">
          @include('common.messages')
          @include('common.error')
          <table class="table table-bordered">
            <thead >
							<th class="text-center col-md-1">Select</th>
              <th>Foto</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Email</th>
              <th class="text-center col-md-1">Tipo</th>
              <th class="text-center col-md-1">Estado</th>
							<th class="text-center col-md-1">Acciones</th>
            </thead>
            <tbody>
              <tr>
							<form class="" action="" method="get" id="form-email">
              @foreach($users as $user)
                <tr>
									<td class="text-center">
											<input type="checkbox"  name="id[]" value="{{ $user->id }}">
									</td>
                  <td class="text-center">
                  		@if($user->user_img != 'nan')
                  		<img src="{{URL::asset( 'images/profileimg/'.$user->user_img )}}" alt="default" class="img-circle" width="30px" height="30px">
                  		@else
                  		<img src="{{URL::asset( 'images/profileimg/default_avatar.png' )}}" alt="default" class="img-circle" width="30px" height="30px">
                  		@endif
			
                  </td>
                  <td>
                    {{$user->name}}
                  </td>
                  <td>
                    {{$user->email}}
                  </td>
                  <td>
                    @if($user->type == 0)
                      Administrador
                    @elseif($user->type == 1)
                      Docente
                    @elseif($user->type == 2)
                      Estudiante
                    @endif
                  </td>

                    @if($user->active == 1)
										<td class="text-center">
											<label for="" class="label label-success">Activo</label>
										</td>
										<td class="text-center">
												@if(!$user->type != 0)
												<!-- <form class="form-horizontal" action="{{url('admin/user/activeUser/'.$user->id)}}" method="post">
														<input type="hidden" name="_token" value="{{ csrf_token() }}">
															<button type="submit" class="btn-xs btn-primary">
																Desactivar
															</button>
												</form> -->
												<a href="{{url('admin/user/activeUser/'.$user->id)}}" class="btn btn-default btn-delete bg-red"  data-toggle="tooltip" title="Desactivar">
													<i class="fa fa-close" aria-hidden="true"></i>
												</a>
												@endif
										</td>
                      <!-- <input type="checkbox" name="name" value="" checked="true"> -->
                    @else
										<td class="text-center">
												<label for="" class="label label-danger">Inactivo</label>
										</td>
										<td class="text-center">
											<!-- <form class="form-horizontal" action="{{url('admin/user/activeUser/'.$user->id)}}" method="post">
													<input type="hidden" name="_token" value="{{ csrf_token() }}">
														<button type="submit" class="btn-xs btn-primary">
															Activar
														</button>
											</form> -->
											<a href="{{url('admin/user/activeUser/'.$user->id)}}" class="btn btn-default btn-edit bg-green" data-toggle="tooltip" title="Activar">
												<i class="fa fa-check" aria-hidden="true"></i>
											</a>
										</td>

                    @endif

                </tr>
              @endforeach
						</form>
            </tbody>
          </table>
					
				</div>
			</div>
		</div>
	</div> <!-- fin div row -->

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading" >
					<div class="row">
						<div class="col-md-2">
							Detalles del grupo
						</div>
						<div>
							Id del grupo : {{$group}}
						</div>
						
					</div>

				</div>
				<div class="panel-body">
          

				</div>
			</div>   <!-- fin panel default -->
		</div> <!-- fin col md10 -->
	</div> <!-- fin row second -->
</div>
@endsection
