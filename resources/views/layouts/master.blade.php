<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="webthemez">
  @include('common.header')


</head>
<body>
	<header>
	  <nav id="main-nav" class="navbar navbar-default navbar-fixed-top" role="banner">
	    <div class="container">
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="{{url('/')}}">
	          <img  src="{{URL::asset('images/logo.png')}}" width="50px" height="20px" alt="logo">
	        </a>
	      </div>
				@if(Auth::check())
					@if(Auth::user()->isAdmin())
						@include('admin.nav_admin')
					@elseif(Auth::user()->isTeacher())
						@include('admin.nav_teacher')
					@elseif(Auth::user()->isStudent())
						@include('admin.nav_student')
					@endif
				@else
					@include('admin.nav_default')
				@endif
	    </div><!--/.container-->
	  </nav><!--/nav-->
	</header><!--/header-->
	<div class="row">

			@yield('content')
	
    @include('common.footer')
	<div class="remodal" data-remodal-id="modal">
  		<button data-remodal-action="close" class="remodal-close"></button>
  		
  			<div id="content-modal" class="modal-style"></div>
  		
  		<!-- <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button> -->
  		<!-- <button data-remodal-action="confirm" class="remodal-confirm">OK</button> -->
	</div>
	@yield('scripts')
</body>
</html>
