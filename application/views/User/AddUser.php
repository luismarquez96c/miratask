 <?php 
 $ci =&get_instance();
 $ci->load->model("ContactModel");
 $ci->load->model("MatterModel");
 $ci->lang->load($this->session->userdata("lng") , 'labels');
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
 	<h3><?php echo $this->lang->line('add_user_1'); ?></h3><hr>
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
 			
 			<form   action="<?=base_app()?>User/saveNew" method="POST" id="contactList" >
 				
 				

 				

 				<!-- tabla -->

 				<div class="col-xs-12" >
 					
 					


 					
 					<div class="addUserInputWrap">


 						<div class="BoxtitleGray">
 							&nbsp; <?php echo $this->lang->line('add_user_2'); ?>
 						</div>
 						
 						
 						<?php echo validation_errors('<span class="error">', '</span>'); ?>
 						
 						
 						<div class="clearh1"></div>
 						
 						
 						<div class="col-xs-12 wrapMess">
 							<?php 
 							if(isset($message)){ echo $message; }   
 							echo $this->session->userdata("Wmessage");
 							echo $this->session->set_userdata("message","");
 							?>
 						</div>
 						
 						
 						<table class="addUser">

 							<tr>
 								<td style="width: 120px;"><?php echo $this->lang->line('add_user_3'); ?>*</td>
 								<td>
 									<input type="text" name="Name"     id="Name"     value="<?= set_value('Name');?>"     class="shortSelect2"  />
 									<input type="text" name="Middle"   id="Middle"   value="<?= set_value('Middle');?>"     class="shortSelect2"  />
 									<input type="text" name="LastName" id="LastName" value="<?= set_value('LastName');?>" class="shortSelect2"  />
 								</td>
 							</tr>

 							<tr>
 								<td><?php echo $this->lang->line('add_user_4'); ?>*</td>
 								<td><input type="text" style="width:435px" class="largeselect" name="Email" id="Email"  value="<?= set_value('Email');?>" ></td>
 							</tr>
 							<tr>
 								<td><?php echo $this->lang->line('add_user_5'); ?>*</td>
 								<td><input type="text" style="width:435px" class="largeselect" name="Password" id="Password" value="<?= set_value('Password');?>"></td>
 							</tr>
 							<tr>
 								<td><?php echo $this->lang->line('add_user_5'); ?>*</td>
 								<td><input type="text" style="width:435px" class="largeselect" name="Password2" id="Password2" value="<?= set_value('Password2');?>"></td>
 							</tr>

 							<tr>
 								<td><?php echo $this->lang->line('add_user_6'); ?>*</td>
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
									
									<input id="Hourly" name="Hourly" type="text" class="largeselect" value="<?=set_value('Email');?>" > 

									<a   class="TcarreDle" style="padding:0px;" >

										<li class="c1" onclick="sumDif('sum')"> </li>
										<li class="c2" onclick="sumDif('dif')"> </li>

									</a>
								</td>


							</tr>

							<tr>
								<td>
									<?php echo $this->lang->line('add_user_11'); ?>*
									<br>
									<br>
									<br>
									<br>
									<br>
									<br>

								</td>
								<td>
									<div class="role"><input type="radio" value="1" name="Role" id="Role" <?php echo (set_value('Role')=="1")?" checked=' checked'":""?>> <?php echo $this->lang->line('add_user_7'); ?>   </div>
									<div class="role"><input type="radio" value="2" name="Role" id="Role" <?php echo (set_value('Role')=="2")?" checked=' checked'":""?>> <?php echo $this->lang->line('add_user_8'); ?></div>
									<div class="role"><input type="radio" value="3" name="Role" id="Role" <?php echo (set_value('Role')=="3")?" checked=' checked'":""?>> <?php echo $this->lang->line('add_user_9'); ?>   </div>
								</td>
							</tr>
							<tr>
								<td> 
									
								</td>
								<td>
									<div class="col-md-3" style="float:right">
										<input  id="save" type="submit" value="Save" class="btn btn-primary btn-lg btn-block"> 
									</div>

									<div class="col-md-3" style="float:right">
										<a id="cancel"   class="btn btn-primary btn-lg btn-block" href="<?=base_url()?>User"  ><?php echo $this->lang->line('add_user_10'); ?> </a>
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
