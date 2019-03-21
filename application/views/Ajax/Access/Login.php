
      <div class="texto">
       <h3>Sign in to you account</h3>
      </div>

      <div class="panel-body">
       <form accept-charset="UTF-8" role="form" class="form-signin" action="<?=base_app()?>Login/validar" method="post">

        <fieldset>
         <div class="col-xs-12 col-md-12">
          <div class="form-group">
           <input type="email" class="form-control" name="txt_correo" required="" id="correo" placeholder="Enter you email">
          </div>
         </div>

         <div class="col-xs-12 col-md-12">
          <div class="form-group">
           <input type="password" class="form-control" name="txt_password" required="" id="password" placeholder="Enter your password">
          </div>
         </div>
        </fieldset>


        <div class="col-xs-12 col-md-12">
         <button type="submit" class="btn btn-primary btn-lg btn-block" id="submit"><p>Sign in</p></button>
        </div>

        </form>

       <div class="col-md-6" id="forgot-password"><a href="<?=base_app()?>Login/GetCode"><u>Forgot Password?</u></a></div>
       <div class="col-md-6" id="change-password"><a href="<?=base_app()?>Login/GetCode"><u>Change Password?</u></a></div>
      </div>
    </div>

