<div id="logout" class="modal fade log" role="dialog">

  <div class="modal-dialog">
    <div class="modal-content login-modal">
    <div class="modal-header login-modal-header">
                     <!-- <div class="form-top-right"> -->
                    <!-- <i class="fa fa-sign-out"></i> -->
                <!-- </divform>  -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center" id="loginModalLabel">Finalizar Sesion</h4>
    </div>
    <div class="model-body">
    <div class="row">
        <div class="col-sm-12 ">
            <div class="form-top">
                <div class="form-top-left">
                    <!-- <h3>Finalizar sesion</h3> -->

                    <p>Esta seguro que desea salir?</p>
                </div>
                <!-- <div class="form-top-right">
                    <i class="fa fa-sign-out"></i>
                </div> -->
            </div>
            <div class="form-bottom">
                <form role="form" action="inc/process.php" method="post" class="login-form">
                    <input type="hidden" name = "action" value = "user_logout"/>
                        <button type="submit" class="btn btn-danger">Salir</button>
                        <!-- <button type="submit" class="btn btn-danger">Cancelar</button> -->
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
  </div>
</div>
