@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" > Vista del Examen </div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					<div class="exam_info">	
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<span id="institution" class="pull-left"><strong>{{$exam->institution }}</strong></span>
							<span id="course" class="pull-right"><strong>{{ $exam->name_course }}</strong></span>
							<div id="title" class="text-center"><h3>{{$exam->title}}</h3></div>
							@if($state == 'eval')
								<div class="personal">			
								<p id="name"><strong>Nombre:</strong> <i> {{ $student->user->name }} </i></p>
								<p id="cod_sis"><strong>Codigo Sis:</strong> <i>{{$student->cod_sis}}</i> </p>						
								<p id="date"><strong>Fecha:</strong>  <i>{{ date('Y-m-d')}}</i></p>
								<p id="group"><strong>Grupo:</strong> <i>{{$group->nro}}</i></p>
								</div>
							@else
								<div class="personal">			
								<p id="name"><strong>Nombre:</strong> <i>NOMBRE DEL ESTUDIANTE </i></p>
								<p id="cod_sis"><strong>Codigo Sis:</strong> <i>CODIGO SIS DEL ESTUDIANTE</i> </p>						
								<p id="date"><strong>Fecha:</strong>  <i>FECHA</i></p>
								<p id="group"><strong>Grupo:</strong> <i>GRUPO</i></p>
								</div>
							@endif	
							
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							<form action="{{ url('student/'.$student->user->id.'/group/'.$group->id.'/exam/'.$exam->id.'/eval/'.$eval->id.'/terminate') }}" method="POST" class="sub-eval">
							@foreach($exam->questionOrdered() as $question)
								@if($question->isMultiple())
									<div class="row">
									<div class="col-md-12 show_question">
										<div class="description">
										<strong>{{$question->pivot->order}}.- </strong>
											<p >
												{{ $question->description }}
												<strong>( {{ $question->pivot->percent }} pts.)</strong>
											</p>
										</div>
										<div class="options">
											
											
											<div class="input-group">
											<ul>
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<input type="hidden" name="questions_id[]" value="{{ $question->id }}">
											@foreach($question->multipleQuestion->options as $option)
												<li>
													<input type="checkbox" name="response_{{ $question->id }}[]" value="{{ $option->id }}"><p> {{ $option->description }} </p>
												</li>
											@endforeach
											</ul>
											</div>

											<!-- @if($state == 'eval')
												<div class="form-group pull-right">
												<button class= "btn btn-primary" type="submit">Responder</button>
											</div>
											@endif -->

										
										
										</div>
									</div>
									</div>

								@elseif( $question->isFalsoVerdad() )
									<div class="row">
										<div class="col-md-12 show_question">
											<div class="description">
												<strong>{{$question->pivot->order}}.- </strong>
													<p>
														{{ $question->description }}
														<strong>( {{ $question->pivot->percent }} pts.)</strong>
													</p>

											</div>
											<div class="selection">
												
												<input type="hidden" name="questions_id[]" value="{{ $question->id }}">
													<div class="input-group">
													<input type="radio" name="response_{{ $question->id }}" value="1" > Verdad
								    			<input type="radio" name="response_{{ $question->id }}" value="0" > Falso
								    			</div>
								    			<!-- @if($state == 'eval')
												<div class="form-group pull-right">
												<button class= "btn btn-primary" type="submit">Responder</button>
											</div>
											@endif -->
												
											</div>
										</div>
									</div>
								@elseif( $question->isComplemento() )
									<div class="row">
										<div class="col-md-12 show_question">
											
											<input type="hidden" name="questions_id[]" value="{{ $question->id }}">
												<div class="description">
													<strong>{{$question->pivot->order}}.- </strong>
													<p>
														{!! $question->evalVersion() !!}
														<strong>( {{ $question->pivot->percent }} pts.)</strong>
													</p>
												</div>
												<!-- @if($state == 'eval')
												<div class="form-group pull-right">
												<button class= "btn btn-primary " type="submit">Responder</button>
												</div>
												@endif -->
										
										</div>
									</div>
								@elseif( $question->isDevelop() )
									<div class="row">
										<div class="col-md-12 show_question">
											<div class="description">
												<strong>{{$question->pivot->order}}.- </strong>
												<p>
													{{ $question->description }}
													<strong>( {{ $question->pivot->percent }} pts.)</strong>
												</p>
											</div>
											<div class="response">
										
												<div class="form-group">
												<label for="response">R.-</label>
												<textarea class="form-control scroll-personal" rows="5" name="response"></textarea>
												<input type="hidden" name="id" value="{{ $question->id }}">
												</div>
											</div>
											
											
										</div>
									</div>
								@endif
								
							@endforeach	
							<div class="row">
						<p></p>
						<div class="col-md-12">
							<div class="form-group text-center">
				
									<!-- <a class= "btn btn-primary" href="{{ URL::previous() }}">Salir Vista</a> -->
									<button class= "btn btn-primary" type="submit">Responder</button>				
							</div>
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

@section('scripts')
<script>
	// $(".sub-eval").submit(function(e){
	// 	e.preventDefault();
	// 	var dir_url = $(this).attr('action');
	// 	var data = $(this).serialize();
	// 	ajaxPost('')
	// });

	$('body').on('blur','span.span_editable',function(){
	var id = $(this).attr('id');
	var text = $(this).html();
	text = text.replace(/&nbsp;/gi,'');
	text = text.replace(/\s/gi,'');
	// alert(id);
	$('#_'+id).val(text);
	// $('#cont').val('gato');
	});	



	$.fn.ajaxPost = function(url,method,sectionToRender) {
        $.ajax({
            type: method,
            url: url,
            dataType: 'json',
            success: function (data) {
                ajaxRenderSection(sectionToRender)
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
            }
        });
    }
</script>
@endsection
