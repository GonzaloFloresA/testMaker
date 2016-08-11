@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Iniciar Sesion</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
