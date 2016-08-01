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
						</div>
					</div>

				</div>
			</div>

@endsection
