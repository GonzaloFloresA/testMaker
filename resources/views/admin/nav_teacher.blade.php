<div class="collapse navbar-collapse navbar-right">
  <ul class="nav navbar-nav">
    <li class="scroll"><a href="{{url('/')}}">
      <i class="fa fa-home" aria-hidden="true"></i> Inicio </a>
    </li>
    <li class="scroll">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
        <i class="fa fa-users" aria-hidden="true"></i> Estudiantes <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <!-- <li> <a href="teacher/student">Todos</a></li>
        <li> <a href="teacher/student">Grupos</a></li>
        <li> <a href="#">Ingenieria Informatica</a></li>
        <li> <a href="#">Ingenieria de Sistemas</a></li> -->
      </ul>
    </li>
    <li class="scroll">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown">
        <i class="fa fa-book" aria-hidden="true"></i> Mis Materias <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li> <a href="{{url('teacher/'.Auth::user()->id.'/course')}}">Todas</a></li>

      </ul>
    </li>
    <li class="">
      <a href="#" class="dropdown-toggle conv-lowercase" data-toggle="dropdown" data-hover="dropdown">
        <img src="{{URL::asset( Auth::user()->userPhoto() )}}" alt="default" class="img-circle" width="30px" height="30px">
        {{explode('@',Auth::user()->email)[0]}}
        <b class="caret"></b>
      </a>
      <ul class="dropdown-menu">
        <li><a href="{{url('user/profile/'.Auth::user()->id)}}"><i class="fa fa-user" aria-hidden="true"></i> Perfil</a></li>
        <li><a href="{{url('auth/logout')}}">
              <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out
            </a>
        </li>
      </ul>
    </li>
  </ul>
</div>
