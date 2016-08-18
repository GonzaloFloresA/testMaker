@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading" >Verificar Token</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					<p>Por favor inserte el Token que le fue suminstrado.</p>
					<form class="form-horizontal" role="form" method="POST" action="{{url('student/'.$id.'/group/'.$group_id.'/exam/'.$exam_id.'/eval/'.$eval_id) }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Token </label>
							<div class="col-md-6">
								<input  class="form-control" name="token_eval" value="{{ old('token_eval') }}">
							</div>
						</div>

					

						

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Comenzar Examen</button>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
