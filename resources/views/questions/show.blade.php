@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			
			<div class="panel panel-default">
				<div class="panel-heading" >{{ $question->title }}</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')

					<div class="row " >
						<div class="col-md-10 col-md-offset-1 bg-silver">
							<p style="text-align:justify;"> <strong> Pregunta: </strong>
								{{ $question->description }}	
							</p>
							<form method="POST" action="{{ url('teacher/group/'.$group.'/question/verify/'.$question->id) }}">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								@foreach( $question->multipleQuestion->options as $option)
									
									<p style="text-align:justify;"> 
										
										@if($option->credible)
											<input type="checkbox" checked = "checked" name="response[]" value="{{ $option->id }}">
										@else
											<input type="checkbox" name="response[]" value="{{ $option->id }}">
										@endif
										{{ $option->description }}
									</p>
								@endforeach
								<div class="form-group">
									<div class="text-center">	
										<button class="btn btn-primary" type="submit">	Verificar Respuesta
										</button>
										<a href="{{	url('teacher/group/'.$group.'/questions') }}" class="btn btn-primary">Volver</a>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection



@section('ajax')

			
			<div class="panel panel-default">
				<div class="panel-heading" >{{ $question->title }}</div>
				<div class="panel-body">
					

					<div class="row bg-silver" >
						<div class="col-md-10 col-md-offset-1">
							<p style="text-align:justify;"> <strong> Pregunta: </strong>
								{{ $question->description }}	
							</p>
							<form action="">
								@foreach( $question->multipleQuestion->options as $option)
									
									<p style="text-align:justify;"> <input type="checkbox">
										{{ $option->description }}
									</p>
								@endforeach
							</form>
						</div>
					</div>

				</div>
			</div>
			
	
@endsection


