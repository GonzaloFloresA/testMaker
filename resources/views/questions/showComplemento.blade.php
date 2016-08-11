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
							<strong> Pregunta: </strong>
							<form action="{{url('teacher/group/'.$group.'/question/verify/'.$question->id)}}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div  style="text-align:justify;"> 
								
								{!! $description !!}	
								
							</div>
							
						</div>
					</div>
					<p></p>
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
@endsection

@section('ajax')
	<div class="panel panel-default">
				<div class="panel-heading" >{{ $question->title }}</div>
				<div class="panel-body">	
				
					<div class="row " >
						<div class="col-md-10 col-md-offset-1 bg-silver">
							<strong> Pregunta: </strong>
							<form action="{{url('teacher/group/'.$group.'/question/verify/'.$question->id)}}" method="POST">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div  style="text-align:justify;"> 
								
								{!! $description !!}	
								
							</div>
							
						</div>
					</div>

					<p></p>
								
	
				</div>
				
			</div>

@endsection


@section('scripts')
<script>
$('body').on('blur','span.span_editable',function(){
	var id = $(this).attr('id');
	var text = $(this).html();
	text = text.replace(/&nbsp;/gi,'');
	text = text.replace(/\s/gi,'');
	// alert(id);
	$('#_'+id).val(text);
	// $('#cont').val('gato');
});	
	
</script>
@endsection