
  @if(Session::has('flash_message'))
  <div class="alert alert-success bg-green white">
     <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times" aria-hidden="true"></i></button>
	   <p>	{{Session::get('flash_message')}} </p>
  </div>
	@endif
