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

					<div class="row bg-silver" >
						<div class="col-md-10 col-md-offset-1">
							<p style="text-align:justify;"> <strong> Pregunta: </strong>
								{{ $question->description }}	
							</p>
							@for ($i=0; $i < count($listaComplementos); $i++)  
	
								@if($i%2==0)
									{{ $listaComplementos[$i] }}
								@else
									<input  type="text" name="resp[]" id="content">
								@endif
							@endfor
						</div>
					</div>
					

				</div>
				<div class="form-group">
						<div class="col-sm-offset-5 col-sm-10">	
							<a class="btn btn-primary" href="{{url('teacher/group/'.$question->group_id.'/questions')}}">Volver	</a>
								
						</div>
					</div>
			</div>
		</div>
	</div>
</div>
@endsection
