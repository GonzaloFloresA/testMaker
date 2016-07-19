@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-5 col-md-offset-4">
			<div class="panel panel-default">
				<div class="panel-heading" >Cuenta de Usuario</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')

            <form class="form-horizontal" action="admin/student/activate/{{$user->id}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            Esta seguro que desea {{ $user->isActive() ? 'Desactivar' :  'Activar' }} la cuenta del Usuario.
            <div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
                  @if($user->isActive())
                    Desactivar
                  @else
                    Activar
                  @endif
								</button>
                <a href="{{URL::previous()}}" class="btn btn-primary">Volver</a>
							</div>
						</div>
          </form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
