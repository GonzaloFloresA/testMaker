@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Descripcion del Curso</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					<form action="{{url('teacher/group/'.$group->id.'/description')}}" method="POST">
					 	<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
						<div class="form-group">
								<label class="col-md-2 control-label">Descripcion</label>
								<div class="col-md-9">
									<textarea class="form-control" name="description" rows="6">{{ $group->description }}</textarea>
								</div>
						</div>
						</div>
						<div class="row">
						<p></p>
						<div class="form-group">
								<div class="col-md-6 col-md-offset-2 text-center">
									<button type="submit" class="btn btn-primary">Guardar</button>
									<a href="{{	url('teacher//course/') }}" class="btn btn-primary">Cancelar</a>

								</div>
								
							</div>
						</div>

					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea',menubar:false });</script>
@endsection;