@extends('layouts.master')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" >Enviar Notificacion</div>
				<div class="panel-body">
					@include('common.messages')
					@include('common.error')
          <div class="row">
            <form class="" action="{{url('admin/user/send/email')}}" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="col-md-4 ">
              <ul class="list-group pre-scrollable">
                  @foreach($users as $user)
                  <li class="list-group-item">
                    <img src="{{URL::asset($user->userPhoto())}}" alt="" class="img-circle" width="30px" height="30px"/> {{$user->email}}
                    <input type="hidden" name="email[]" value="{{$user->email}}">
                  </li>
                  @endforeach
              </ul>
            </div>
            <div class="col-md-8">

                <!-- <div class="row"> -->
                  <div class="form-group">
                    <textarea class="form-control" name="contentemail" rows="8" cols="60"></textarea>
                  <!-- </div> -->
                </div>
                <div class="form-group pull-right">
                  <!-- <div class="text-center"> -->
                    <button type="submit" name="button" class="btn btn-success">Enviar</button>
                  <!-- </div> -->
                </div>

            </div>
            </form>
          </div>


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea',menubar:false });</script>
