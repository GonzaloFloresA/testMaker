@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading" >Editar Carrera</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
          <form class="form-horizontal" role="form" method="POST" action="{{ url('admin/career/'.$career->id) }}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-2 control-label">Nombre</label>
              <div class="col-md-8">
                <input type="cod_sis" class="form-control" name="name" value="{{ $career->name }}" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-2 control-label">Abreviacion</label>
              <div class="col-md-8">
                <input type="name" class="form-control" name="abbr" value="{{ $career->abbr }}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
              </div>
            </div>
          </form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
