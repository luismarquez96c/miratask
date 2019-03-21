 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("MatterModel");
 ?>

 <script src="<?=base_url()?>js/contactAjax.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<script src="<?=base_url()?>js/util.js"></script>

<script>
 $( function() {
    $( "#DateOpened" ).datepicker();
  } );
</script>
<!-- CONTENIDO Contacts -->



 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3>Contacts</h3><hr>
 </div>

 <div class="row">
	
	<div class="matterContent">
		<!-- Contacts -->
		
		<div class="col-md-3 panel_cat">
			<div class="x_panel">
			   
				 
			 
				<!-- matter cat  -->
				<div id=" " class="tabcontent matCat usRate " style="display: block;">
					

					
					 <?php
					
					$this->load->view("User/menu");
				 ?>	




					 

					<div class="clearh1"></div>
					
					 

					
					
					
				</div>
			</div>
		</div>
			
			 
		<div class="col-xs-9 ListWrap">		
			  
			<form   action="<?=base_app()?>User/update/<?=$user->Id?>" method="POST" id="contactList" >
			  
			  	<div class="col-xs-12  buttWrap">

				  	<!-- boton " + add Contact"-->
					<div class="col-md-3 pl0">


						<?php 
							if($user->State==1){
								$label='Deactivate';
							}elseif($user->State==2){
								$label='Activate';
							} 
						?>

						<a id="add_matters" href="<?=base_url()?>User/Changestatus/<?=$user->State?>/<?=$user->Id?>" class="btn btn-primary btn-lg btn-block" >
						<i class="fa fa-plus"></i> &nbsp; <?=$label?>
						</a>
					</div>

				</div><!-- fin xs 9 -->

				<div class="clearh20"></div>

				<!-- tabla -->

				<div class="col-xs-12" >
					
					


					
					<div class="addUserInputWrap">


						<div class="BoxtitleGray">
							  &nbsp; <?=$user->Name?> <?=$user->Middle?> <?=$user->LastName?>   
						</div>
						
						
						<?php echo validation_errors('<span class="error">', '</span>'); ?>
						 
						
						<div class="clearh1"></div>
						
						 
						<div class="col-xs-12 wrapMess">
							<?php 
							if(isset($message)){ echo $message; }   
							echo $this->session->userdata("Wmessage");
							     $this->session->set_userdata("Wmessage","");
							echo $this->session->userdata("message");
							     $this->session->set_userdata("message","");
							?>
						</div>
						 
					
						<table class="addUser">

					 		<tr>
					 			<td style="width: 120px;">Name*</td>
					 			<td>
					 				<input type="text" name="Name" id="Name"      value="<?=$user->Name?>"     class="shortSelect2"  />
									<input type="text" name="Middle" id="Middle"  value="<?=$user->Middle?>"     class="shortSelect2"  />
									<input type="text" name="LastName" id="LastName" value="<?=$user->LastName?>" class="shortSelect2"  />
								</td>
					 		</tr>

					 		<tr>
					 			<td>Email*</td>
					  			<td><input type="text" style="width:435px" class="largeselect" name="Email" id="Email" value="<?=$user->Email?>"></td>
					  			<input type="hidden" style="width:435px" class="largeselect" name="actEmail" id="actEmail" value="<?=$user->Email?>">
					 		</tr>
					 		<tr>
					 			<td>Password*</td>
					  			<td><input type="text" style="width:435px" value="" class="largeselect" name="Password" id="Password" placeholder="**********" ></td>
					 		</tr>
					 		<tr>
					 			<td>Password*</td>
					  			<td><input type="text" style="width:435px" value="" class="largeselect" name="Password2" id="Password2" placeholder="**********" value="<?= set_value('Password2');?>"></td>
					 		</tr>

					 		<tr>
					 			<td>Default Hourly Rate*</td>
							 	<td>
							 		<script type="text/javascript">
											function sumDif(oper){

											if(oper=='sum'){

												 
												actualVal=actualVal + 0.1;
												//actualVal=parseFloat(actualVal).toFixed(1);

												$("#Hourly").val(actualVal);	

											}

											if(oper=='dif'){
												 
												actualVal=actualVal - 0.1;
												//actualVal=parseFloat(actualVal).toFixed(1);

												if(actualVal<0){ actualVal=0; }

												$("#Hourly").val(actualVal);	
											}
										}

									</script>
									
									<input id="Hourly" name="Hourly" type="text" class="largeselect" value="<?=$user->HourlyRate?>" > 

									<a   class="TcarreDle" style="padding:0px;" >

										  <li class="c1" onclick="sumDif('sum')"> </li>
										  <li class="c2" onclick="sumDif('dif')"> </li>

									</a>
								</td>


					 		</tr>

					 		<tr>
					 			<td>
					 				Role*
					 				<br>
					 				<br>
					 				<br>
					 				<br>
					 				<br>
					 				<br>


					 			</td>
					 			<td>
					 				<div class="role"><input type="radio" value="1"  name="Role" id="Role" <?php echo ($user->Role=="1")?" checked=' checked'":""?> > Admin</div>
					 				<div class="role"><input type="radio" value="2"  name="Role" id="Role" <?php echo ($user->Role=="2")?" checked=' checked'":""?> > Atorney</div>
					 				<div class="role"><input type="radio" value="3"  name="Role" id="Role" <?php echo ($user->Role=="3")?" checked=' checked'":""?> > Staff</div>
					 			</td>
					 		</tr>
					 		<tr>
					 			<td> 
					 				
							 	</td>
							 	<td>
							 		<div class="col-md-3" style="float:right">
										<input  id="save" type="submit" value="Save" class="btn btn-primary btn-lg btn-block"  > 
									</div>

									<div class="col-md-3" style="float:right;">
										<a id="cancel"   class="btn btn-primary btn-lg btn-block" href="<?=base_url()?>User"   >Cancel </a>
									</div>

							 	</td>
					 			 
					 		</tr>
						</table>

						 

						 



					</div><!-- fin all imput task -->  



					


						 

					<div class="clearh50"></div>
				</div><!-- fin col-md-9 -->
			</form>	

		</div><!-- finn list wrap -->

	</div><!-- fin clase maters content -->

 </div>
 