
    <!-- Modal -->
<div id="myModal" class="modal fade log" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="row">
                        <div class="col-sm-12 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Identificacion de Usuario</h3>
                                    <p>Ingrese login y password para iniciar sesion:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <form role="form" action="auth/login" method="post" class="login-form">
                                   {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label class="sr-only" for="email">Email</label>
                                        <input type="text" name="email" placeholder="Email" class="form-username form-control" id="email" value="{{ old('email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="password">
                                        <!-- <input type="hidden" name = "action" value = "user_login"/> -->
                                    </div>
                                    <button type="submit" class="btn">Ingresar</button>

                                </form>
                                <a href="" class="">Olvidaste tu Contrasena?</a>
                                <a href="{{url('auth/register')}}" class="" style="margin-left: 58%;">Registrate</a>
                            </div>
                        </div>
    </div>
  </div>
</div>
