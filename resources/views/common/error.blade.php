@if (count($errors) > 0)
  <div class="alert alert-danger bg-red white">
    <button type="button" class="close white" data-dismiss="alert"><i class="fa fa-times" aria-hidden="true"></i>
</button>
    <strong>Ups!</strong> Hay algunos problemas con tus campos.<br><br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

@if(Session::has('errorSintaxis'))
<div class="alert alert-danger bg-red white">
    <button type="button" class="close white" data-dismiss="alert"><i class="fa fa-times" aria-hidden="true"></i>
</button>
    <strong>Ups!</strong> {{ Session::get('errorSintaxis') }}<br><br>
    <ul>
    	<!-- <li></li> -->
    </ul>
  </div>
      
@endif