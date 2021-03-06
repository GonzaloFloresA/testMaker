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
							
							<div class="personal">			
							<p id="name"><strong>Nombre:</strong> <i>NOMBRE DEL ESTUDIANTE </i></p>
							<p id="cod_sis"><strong>Codigo Sis:</strong> <i>CODIGO SIS DEL ESTUDIANTE</i> </p>						
							<p id="date"><strong>Fecha:</strong>  <i>FECHA</i></p>
							<p id="group"><strong>Grupo:</strong> <i>GRUPO</i></p>
							</div>
						</div>
					</div>
					</div>
					<div class="row">
						<div class="col-md-10 col-md-offset-1">
							
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
													<input type="radio" name="credible" value="1" > Verdad
								    			<input type="radio" name="credible" value="0" > Falso
								    			</div>
								    			
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
														{!! $question->showVersion() !!}
														<strong>( {{ $question->pivot->percent }} pts.)</strong>
													</p>
												</div>
											
										
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
						</div>
					</div>
					<div class="row">
						<p></p>
						<div class="col-md-12">
							<div class="form-group text-center">
				
									<a class= "btn btn-primary" href="{{ URL::previous() }}">Salir Vista</a>
												
							</div>
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
