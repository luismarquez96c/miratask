<?php 
 $ci =&get_instance();
$langu = $this->session->userdata("lng");
if(!$langu ){
	$langu = 'es';
}
 $ci->lang->load($langu , 'labels');
 ?>


<!--
<div class="texto">
	<h3>Signssss in to you account</h3>
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

-->
<div id="containerfluid">
<div class="col off background">

<button onclick="location.replace('<?=base_app()?>login/chlang?lng=es&rtn=<?=$this->uri->uri_string();?>')" >ES</button>
<button  onclick="location.replace('<?=base_app()?>login/chlang?lng=en&rtn=<?=$this->uri->uri_string();?>')" >EN</button>

		<form accept-charset="UTF-8" role="form" class="form-signin" action="<?=base_app()?>Login/validar" method="post">
        <div class="divlogin">
            <div class="row-fluid user-row" style="padding-top: 1px;">
        <img src="<?=base_app()?>logomira-demo.png" class="img-responsive" alt="MiraLaw">
       </div>
            <div class="col">
                <h1 class="textlogin"><?php echo $this->lang->line('login_1'); ?></h1>
            </div>
            <div class="col">
				<input name="txt_correo" required="" id="correo" class="d-flex mx-auto inputmira" type="email" placeholder="Enter your email">
				<input name="txt_password" required="" id="password" class="d-flex mx-auto inputmira" type="password" placeholder="Enter your password">
				<button style="height: 29px;" id="submit" class="btn btn-primary d-flex justify-content-center mx-auto btnmira" type="submit">Sign in&nbsp;</button></div>
            <div class="row off more">
                <div class="col-6"><a href="<?=base_app()?>Login/GetCode" class="linkmira">Forgot the Password?</a></div>
                <div class="col-6"><a href="<?=base_app()?>Login/GetCode" class="linkmira">Change Password?</a></div>
            </div>
		</div>
	</form>
        <div class="divlogin off">
            <div class="col">
                <p class="paragraph">Terms of Service I Terms of Conditions I Privacy Policy <br>Copyright © 2018 Powered by MiraLaw Group. <br>All rights reserved. <br> <br>Design by Web Informática <br> <br></p>
            </div>
        </div>
	</div>
	
	</div>