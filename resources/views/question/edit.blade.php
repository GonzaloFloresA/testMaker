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

	<div class="container-fluid" id="app">
		<div class="row">
		<div class="col-md-2 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading " style="border-bottom:3px solid #049372; background-color: #049372; color:white">Tipo de Pregunta</div>
				<div class="panel-body">
					<div class="row pre-scrollable">
						<div class="list-group">
							<a href="#" class="list-group-item bg-jungle active">
								<i class="fa fa-table" aria-hidden="true"></i>  Opcion Multiple
							</a>
							<a href="#" class="list-group-item bg-jungle">
								<i class="fa fa-align-justify" aria-hidden="true"></i> Desarrollo
							</a>
							<a href="#" class="list-group-item bg-jungle"> Complementacion </a>
							<a href="#" class="list-group-item bg-jungle"> Enlaces  </a>
							<a href="#" class="list-group-item bg-jungle"> Opcion Multiple </a>
							<a href="#" class="list-group-item bg-jungle"> Desarrollo  </a>
							<a href="#" class="list-group-item bg-jungle"> Complementacion </a>
							<a href="" class="list-group-item bg-jungle"> Enlaces  </a>
							<a href="" class="list-group-item bg-jungle"> Opcion Multiple </a>
							<a href="" class="list-group-item bg-jungle"> Desarrollo  </a>
							<a href="" class="list-group-item bg-jungle" > Complementacion </a>
							<a href="" class="list-group-item bg-jungle"> Enlaces  </a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-7">
			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading " style="border-bottom:3px solid #4DAF7C; background-color:#4DAF7C; color:white">Edicion de la pregunta</div>
					<div class="panel-body">

							<div v-for="question in questions">
									<question_template :title="question.title"
																		 :statement="question.statement"
																		 :options = "question.options">
									</question_template>
							</div>


					</div>
				</div>
			</div>

			<div class="row">
				<div class="panel panel-default">
					<div class="panel-heading " style="border-bottom:3px solid #049372; background-color: #049372; color:white">Respuesta Pregunta</div>
					<div class="panel-body">
						<pre>
							{{$data | json}}
						</pre>
					</div>
				</div>
			</div>




		</div>


		</div>
	</div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
