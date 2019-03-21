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
	<h3><?php echo $this->lang->line('invoice_settings_1'); ?></h3><hr>
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
			  
			<form   action="<?=base_app()?>Billing/update_invoice_setting/<?=$inv_setting->Id?>" method="POST" id="contactList"  enctype="multipart/form-data" >
			  
			  	
				<!-- tabla -->

				<div class="col-xs-12" >
					
					<div class="addUserInputWrap">

						<div class="BoxtitleGray">
							  &nbsp; <?php echo $this->lang->line('invoice_settings_2'); ?>  
						</div>
						
						
						<?php echo validation_errors('<span class="error">', '</span>'); ?>
						
						<div class="addUser">
							 
							<strong><?php echo $this->lang->line('invoice_settings_3'); ?></strong>
							<br>	 
							<?php echo $this->lang->line('invoice_settings_4'); ?>
							 
						</div>
						
						 
						
						<div class="clearh1"></div>
						
						 
						<div class="col-xs-12 wrapMess">
							<?php 
							if(isset($message)){ echo $message; }   
							echo $this->session->userdata("validation_errors");
							     $this->session->set_userdata("Wmessage","");
							echo $this->session->userdata("message");
							     $this->session->set_userdata("message","");
							?>
						</div>
						 
					
						<table class="addUser " style="margin-top: 5px;">


							<tr>
					 			<td style="width: 30px;">
					 			<input type="checkbox" name="firm_name_status" value="OK" <?=($inv_setting[0]->estado=="OK")?" checked='checked'":""?> >
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_5'); ?></td>
					 			<td>
					 				<div style="text-align:left;"> &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;   <?=$inv_setting[0]->valor?></div>
								</td>
					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 				<input type="checkbox" name="name_status" value="OK" <?=($inv_setting[1]->estado=="OK")?" checked='checked'":""?>>
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_6'); ?></td>
					 			<td><input type="text" style="width:435px" class="largeselect" name="name" id="name" value="<?=$inv_setting[1]->valor?>"</td>
					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 			<input type="checkbox" name="address_status" value="OK" <?=($inv_setting[2]->estado=="OK")?" checked='checked'":""?>>
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_7'); ?></td>
					 			<td>
					 				<input type="text" style="width:435px" class="largeselect" name="address" id="address" value="<?=$inv_setting[2]->valor?>">
					 			</td>
					 		</tr>
	
					 		<tr>

					 			<td style="width: 30px;"> </td>
					 			<td style="width: 120px;"> </td>
					 			<td>
									<input type="text" name="country"  id="country"  value="<?=$inv_setting[3]->valor?>"   class="shortSelect2"  />
									<input type="text" name="city"     id="city"     value="<?=$inv_setting[4]->valor?>" class="shortSelect2"  />
									<input type="text" name="code"     id="code"     value="<?=$inv_setting[5]->valor?>"  style="width:125px;"  />
								</td>

					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 			<input type="checkbox" name="phone_status" value="OK" <?=($inv_setting[6]->estado=="OK")?" checked='checked'":""?> >
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_8'); ?></td>
					 			<td>
					 				<input type="text" name="phone" id="phone"      value="<?=$inv_setting[6]->valor?>"     class="shortSelect2"  />
									<div class="  fax">Fax</div>
									<input type="text" name="fax" id="fax" value="<?=$inv_setting[7]->valor?>" class="shortSelect2"  />
								</td>
					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 			<input type="checkbox" name="website_status" value="OK" <?=($inv_setting[8]->estado=="OK")?" checked='checked'":""?>>
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_9'); ?></td>
					 			<td>
					 				<input type="text" style="width:435px" class="largeselect" name="website" id="website" value="<?=$inv_setting[8]->valor?>">
					 			</td>
					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 			<input type="checkbox" name="contact_name_status" value="OK" <?=($inv_setting[9]->estado=="OK")?" checked='checked'":""?>>
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_10'); ?></td>
					 			<td>
					 				<input type="text" style="width:435px" class="largeselect" name="contact_name" id="contact_name" value="<?=$inv_setting[9]->valor?>">
					 			</td>
					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 			<input type="checkbox" name="email_status" value="OK" <?=($inv_setting[10]->estado=="OK")?" checked='checked'":""?>>
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_11'); ?></td>
					 			<td><input type="text" style="width:435px" class="largeselect" name="email" id="email" value="<?=$inv_setting[10]->valor?>"></td>
					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 			 
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_12'); ?></td>
					 			<td><input style="width: 435px;" type="file" name="logo" id="logo"></td>
					 		</tr>

					 		<tr>
					 			<td style="width: 30px;">
					 			<input type="checkbox" name="logo_status" value="OK" <?=($inv_setting[11]->estado=="OK")?" checked='checked'":""?>>
					 			</td>
					 			<td style="width: 120px;"><?php echo $this->lang->line('invoice_settings_13'); ?></td>
					 			<td><img src="<?=base_url()?>img/<?=$inv_setting[11]->valor?>" ></td>
					 		</tr>

					 		 

					 		<tr>
					 			<td> 
					 				
							 	</td>
					 			<td> 
					 				
							 	</td>
							 	<td>
							 		<div class="col-md-3" style="float:right">
										<input  id="save" type="submit" value="<?php echo $this->lang->line('invoice_settings_15'); ?>" class="btn btn-primary btn-lg btn-block"  > 
									</div>

									<div class="col-md-3" style="float:right;">
										<a id="cancel"   class="btn btn-primary btn-lg btn-block" href="<?=base_url()?>inv_setting"   ><?php echo $this->lang->line('invoice_settings_14'); ?></a>
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
 