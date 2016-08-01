
  @if(Session::has('flash_message'))
  <div class="alert alert-success bg-green white">
     <button type="button" class="close" data-dismiss="alert"><i class="fa fa-times" aria-hidden="true"></i></button>
	   <p>	{{Session::get('flash_message')}} </p>
  </div>
	@endif

@if(Session::has('warnings'))
<div class="alert alert-danger bg-orange white">
    <button type="button" class="close white" data-dismiss="alert"><i class="fa fa-times" aria-hidden="true"></i>
</button>
    <strong><i class="fa fa-exclamation-circle" aria-hidden="true"></i></strong> {{ Session::get('warnings') }}<br><br>
  </div>
@endif 
