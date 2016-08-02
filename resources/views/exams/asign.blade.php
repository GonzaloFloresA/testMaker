@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Llenar Examen</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
					
					<div class="row">
						<div class="col-md-4">
							<h4 class="text-center">Preguntas disponibles</h4>
							
							<ul class="list-group scroll-personal" id="questions">
								@foreach($questions as $question)
									
									@if($exam->questions->contains($question->id))
										<li   class="list-group-item blocked" id="{{$question->id}}">
											@if ($question->types == 'complemento')
												<img src="{{URL::asset('images/question/icon-c.jpeg')}}" alt="" class="img-circle" width="20px">
											@elseif ($question->types == 'multiple')
												<img src="{{URL::asset('images/question/icon-sm.jpeg')}}" alt="" class="img-circle" width="20px">
											@elseif ($question->types == 'develop')
												<img src="{{URL::asset('images/question/icon-d.jpeg')}}" alt="" class="img-circle" width="20px">
											@elseif ($question->types == 'falsoVerdad')
												<img src="{{URL::asset('images/question/icon-fv.jpeg')}}" alt="" class="img-circle" width="20px">
											@endif
											
											{{ $question->title }}
										
										</li>

									@else
										<li   class="list-group-item question"  id="{{$question->id}}">
										<a data-remodal-target="modal" href="{{ url('teacher/group/'.$group.'/question/show/'.$question->id) }}" id="{{ $question->id }}">
										@if ($question->types == 'complemento')
											<img src="{{URL::asset('images/question/icon-c.jpeg')}}" alt="" class="img-circle" width="20px">
										@elseif ($question->types == 'multiple')
											<img src="{{URL::asset('images/question/icon-sm.jpeg')}}" alt="" class="img-circle" width="20px">
										@elseif ($question->types == 'develop')
											<img src="{{URL::asset('images/question/icon-d.jpeg')}}" alt="" class="img-circle" width="20px">
										@elseif ($question->types == 'falsoVerdad')
											<img src="{{URL::asset('images/question/icon-fv.jpeg')}}" alt="" class="img-circle" width="20px">
										@endif
										</a>
										
										{{ $question->title }}
										
										</li>
									@endif
								@endforeach
							</ul>
						</div>
						<div class="col-md-2">
							<h4>&nbsp</h4>
							<h4>&nbsp</h4>
							<h4>&nbsp</h4>
							<h4>&nbsp</h4>
							<div class="col-md-12">
								<button class="btn btn-primary" id="add"> >>> </button>	
							</div>
							<p>&nbsp</p>
							<div class="col-md-12">
							<button class="btn btn-primary" id="remove"> <<< </button>
							</div>

						</div>
						<div class="col-md-6">
							<h4 class="text-center">Preguntas de Examen</h4>
							<div>
								<button id="show_exam" class="btn btn-default btn-menu btn-sm bg-orange"  data-toggle="tooltip" title="Vista Preliminar del Examen">
									<i class="fa fa-eye" aria-hidden="true"></i>
								</button>
								<button id="edit_percent" class="btn btn-default btn-menu btn-sm bg-maroon"  data-toggle="tooltip" title="Puntaje por defecto">
									<i class="fa fa-percent" aria-hidden="true"></i>
								</button>
								<button id="random_order" class="btn btn-default btn-menu btn-sm bg-navy" data-toggle="tooltip" title="Ordenar Aleatoriamente">
									<i class="fa fa-random" aria-hidden="true"></i>
								</button>
								<div class="pull-right">
									<button id="up" class="btn btn-default btn-menu btn-sm bg-blue"  data-toggle="tooltip" title="Subir">
									<i class="fa fa-arrow-up" aria-hidden="true"></i>
								</button>
								<button id="down" class="btn btn-default btn-menu btn-sm bg-blue"  data-toggle="tooltip" title="Bajar">
									<i class="fa fa-arrow-down" aria-hidden="true"></i>
								</button>
								</div>
							</div>
							<form method="POST" action="{{ url('teacher/group/'.$group.'/exam/edit/'.$id.'/asign') }}">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<ul class="list-group scroll-personal"  id="exam">
								@foreach($questionsExam as $question)
									<li class="list-group-item question" id="{{ $question->question_id }}" >
										<div class="row">
											<div class="col-sm-9">
												<span id="{{ $question->question_id }}" >
										 			<strong> {{$question->order}} </strong>

										 			<a data-remodal-target="modal" href="{{ url('teacher/group/'.$group.'/question/show/'.$question->question_id) }}" id="{{ $question->question_id }}">
										@if ($question->types == 'complemento')
											<img src="{{URL::asset('images/question/icon-c.jpeg')}}" alt="" class="img-circle" width="20px">
										@elseif ($question->types == 'multiple')
											<img src="{{URL::asset('images/question/icon-sm.jpeg')}}" alt="" class="img-circle" width="20px">
										@elseif ($question->types == 'develop')
											<img src="{{URL::asset('images/question/icon-d.jpeg')}}" alt="" class="img-circle" width="20px">
										@elseif ($question->types == 'falsoVerdad')
											<img src="{{URL::asset('images/question/icon-fv.jpeg')}}" alt="" class="img-circle" width="20px">
										@endif
										</a>
										{{ $question->title }}
										 			<!-- <a  data-remodal-target="modal" href="{{ url('teacher/group/'.$group.'/question/show/'.$question->question_id) }}" id="{{ $question->question_id }}" >
										 				
										 			</a> --> 
										 						
												</span>
											</div>
											<div class="col-sm-3">
												<input type="number" id="{{$question->question_id}}" class="form-control" value="{{$question->percent}}" min='0' max='100'>
												<input type="hidden" name="id_q[]" value="{{$question->question_id}}_{{$question->percent}}">
											</div>
										</div>
									</li>
									
								@endforeach
							</ul>
							<div class="form-group">
								<div class="col-md-6 col-md-offset-2 text-center">
									<button type="submit" class="btn btn-primary">Guardar</button>
									<!-- <a href="{{	URL:: previous() }}" class="btn btn-primary">Cancelar</a> -->
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
  <script src="{{URL::asset('js/asign.js')}}"></script>
  <script>
  	$('[data-remodal-id=modal]').remodal();
  	$(document).on('opened', '.remodal', function () {
  		var url = $(".active a").attr('href');
  		// $(this).ajaxPost('http://localhost:8000/teacher/group/9/question/show/18','POST','/');
  		ajaxRenderSection(url);
  		 // $('#content-modal').empty().append(url); 
  		// $("#content-modal").append($("<p></p>").text(id));
	});
	$(document).on('closed', '.remodal', function () {
  		 $("#content-modal").empty();
	});

	function ajaxRenderSection(url) {
        $.ajax({
            type: 'GET',
            url: url,
            dataType: 'json',
            success: function (data) {
                $('#content-modal').empty().append($(data)); 
                console.log($(data));
            },
            error: function (data) {
                var errors = data.responseJSON;
                if (errors) {
                    $.each(errors, function (i) {
                        console.log(errors[i]);
                    });
                }
                console.log("errores");
            }
        });
    }

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

