@if (isset($notifications) && count($notifications) > 0)
  <div class="alert alert-danger bg-red white">
    <button type="button" class="close white" data-dismiss="alert"><i class="fa fa-times" aria-hidden="true"></i>
</button>
    <strong>Ups!</strong> Hay algunos problemas con tus campos.<br><br>
    <ul>
      @foreach ($notifications as  $value)
        <li>{{ $value }}</li>
      @endforeach
    </ul>
  </div>
@endif
