 

<script src="<?=base_url()?>js/contactAjax.js"></script>
<script src="<?=base_url()?>js/util.js"></script>
 
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
 <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 




<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
  <h3>New Matters</h3><hr>
</div>

 <div class="row">
 
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="wizard">
			<div class="wizard-inner">
			
				<div class="connecting-line"></div>
			 
				<ul id="formularios" class="nav nav-tabs" role="tablist" style="">

					<li role="presentation" class="active">
					   <a class="step" href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
							<span class="round-tab">1</span>
							<span class="stepLabel">Matters Basic</span>
					   </a>
					   
					</li>

					  
					<li role="presentation" class="disabled">
						   <a class="step" href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
								<span class="round-tab">2</span>
								<span class="stepLabel">Intake Details</span>
						   </a>
					</li>
					  

					<li role="presentation" class="disabled">
					   <a class="step" href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
							<span class="round-tab">3</span>
							<span class="stepLabel">Billing Arrangement</span>
					   </a>
					</li>

					 
				 
				</ul>
			</div>
			<br>

			<form class="form-horizontal"  action="<?=base_app()?>Matters/SaveNew" method="post">
			
					
				 
				<div class="tab-content">


					<div class="tab-pane active" role="tabpanel" id="step1">

						<div id="contorno" class="col-md-12">

							<div class="forms">
								<div class="panel-body">
									<p>Enter basic matter informations. The information can be added or edited at any time once the matter is created.</p>
								</div>
						   </div>
						   <br>
							
							<div class="allInputContainer">
							
								<?php echo validation_errors('<span class="error">', '</span>'); ?>
								<div class="clearh1"></div>
								<div class="form-group row">

									<div class="col-md-6">
									 	<label for="" class="col-sm-1 col-form-label">Matter Name *</label>
									 
										<input type="text" class="form-control" required="required" placeholder="" name="Name" value="<?= set_value('Name');?>" />
									 
									</div>
									<div class="col-md-6">	
									 	<label for="" class="col-sm-1 col-form-label">Matter ID *</label>
									 
										<input type="text" id="MatterID" name="MatterID" class="form-control"     value="<?=set_value('MatterID')?>" />
									</div>
									 
								</div>

								<div class="form-group row">
									 <label for="" class="col-sm-1 col-form-label">Description *</label>
									 <div class="col-md-5">
										<input type="text" class="form-control" id="" placeholder="" name="Description" value="<?= set_value('Description');?>">
									 </div>
								</div>

								<div class="form-group row">
									 <label for="" class="col-sm-1 col-form-label">Client Name*</label>
									 <div class="col-md-5">
											<input type="text" class="form-control" name="Contact_A" onkeyup="showContacts(this.value,'_A')" autocomplete="off" value="<?= set_value('Contact_A');?>" placeholder="Search existing contacts   &#xF002" style="font-family:Arial, FontAwesome" />
											<div class="SearchBox" id="ContactResult_A"></div>
											<input type="hidden"     name="ContactID_A" value="<?= set_value('ContactID_A');?>" />		
											
									 </div>
								</div>

								<div class="form-group row">
									 <label for="" class="col-sm-1 col-form-label"></label>
									 <div class="col-md-5">
										<button type="button" onclick="createContact('ContactID_A','Contact_A')" class="btn btn-default btn-lg btn-block">
										<i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i>  Create New Contact</button>
									 </div>
								</div>
								<hr>

								<div class="form-group row">
									
									<div class="col-md-6">					
									 	<label for="" class="col-sm-1 col-form-label">Practice Area*</label>
									 
										
									   <select name="Area" class="form-control blueText" placeholder=""  > 
											<option value="">Select One</option>
													<?php 
														foreach ($Areas as $row)
														{
															?>
															<option value="<?=$row->Id?>" <?php echo (set_value('Area')==$row->Id)?" selected=' selected'":""?>><?=$row->Name?></option>
														<?php
														}
													?>
										</select>
										
									</div>

									<div class="col-md-6"> 
									 	<label for="" class="col-sm-1 col-form-label">Matter Template*</label>
									  
										  
										<select class="form-control blueText" placeholder="" name="Template"  > 
											<option value="">Select One</option>
													<?php 
														foreach ($Templates as $row)
														{ ?>
															<option value="<?=$row->Id?>" <?php echo (set_value('Template')==$row->Id)?" selected=' selected'":""?>><?=$row->Template?></option>
												<?php   }
													
													?>
										</select>
											
										  
									</div>
								</div><!-- fin form-group -->
							  
							  
								<div class="form-group row">
									 
									<div class="col-md-6">
									 	<label for="" class="col-sm-1 col-form-label">Date Opened*</label>

											<script>
											 $( function() {
													$( "#DateOpened" ).datepicker({
														constrainInput: true
													});
													
													$("#calendarIco").click(function() {
														$("#DateOpened").datepicker("show");
													});
											  });
											  
											  
											</script>
										<div class="input-group">	 
											<input type="text" id="DateOpened" name="DateOpened" class="form-control blueText" autocomplete="off"  value="<?= set_value('DateOpened');?>"   />
										 
										 	<div  id="calendarIco"></div>  
										</div> 
									</div>

									<div class="col-md-6">	
										<label for="" class="col-sm-1 col-form-label">Responsible Attorney*</label>
									 
											 
										<select name="ResponsibleAttorney" class="form-control" placeholder=""  > 
											<option value="">Select One</option>
											<?php 
												foreach ($Attorney as $row)
												{
													?>
													<option value="<?=$row->Id?>" <?php echo (set_value('ResponsibleAttorney')==$row->Id)?" selected=' selected'":""?>><?=$row->Name?></option>
												<?php
												}
											?>
										</select>
											 
									</div>
								</div><!-- fin groups -->

							
								<div class="form-group row">

									<div class="col-md-6">
										<label for="" class="col-sm-1 col-form-label">Referred By*</label>
									 
										<div class="input-group">
											 
											<input type="text" name="Contact_R"   autocomplete="off" class="form-control"  onkeyup="showContacts(this.value,'_R')"  placeholder="Search existing Contact  &#xF002" style="font-family:Arial, FontAwesome"   value="<?= set_value('Contact_R');?>" >
											<input type="hidden"     name="ContactID_R"  value="<?= set_value('ContactID_R')?>" />	
											<div  class="SearchBox" id="ContactResult_R" ></div>
											 
											 
										</div>
									</div> 
									
									<div class="col-md-6">
									 	<label for="" class="col-sm-1 col-form-label">Other Staff*</label>
									  														   
										<input type="text" name="OtherStaff" id="OtherStaff" class="form-control" autocomplete="off" id=""  value="<?= set_value('OtherStaff');?>" >
										 
									 </div>

								</div>

								<div class="form-group row">
								
									<div class="col-md-6">
									 	<label for="" class="col-sm-1 col-form-label">
									 		&nbsp;
									 	</label>
									 	<div class="input-group"> 
											<button type="button" onclick="createContact('ContactID_R','Contact_R')"  class="btn btn-default btn-lg btn-block"><i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i>  Create New Contact</button>
									 	</div> 
									
									</div>
									<div class="col-md-6">
									 	<label for="" class="col-sm-1 col-form-label">Originating Attorney*</label>
									  
										<select name="OriginatingAttorney" class="form-control" placeholder=""  > 
													<option value="">Select One</option>
												<?php 
													foreach ($Attorney as $row)
													{
														?>
														<option value="<?=$row->Id?>" <?php echo (set_value('OriginatingAttorney')==$row->Id)?" selected=' selected'":""?>><?=$row->Name?></option>
														
													<?php
													}
												?>
										</select>
									 </div>	
								</div>


								<div class="form-group row">

									<div class="col-md-6">
									  	<label for="" class="col-sm-1 col-form-label">
									  		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 	</label>
									 
										<div class="input-group">
											<div class="vacio"></div>
										</div>
									</div> 

									<div class="col-md-6">
									 	<label for="" class="col-sm-1 col-form-label">Send Notifications every*</label>
									  
										 
											<select name="Notifications" class="form-control blueText"  > 
													<option value="">Select One</option>
													<?php 
														foreach ($Notifications as $row)
														{ ?>
															  
															<option value="<?=$row->id?>" <?php echo (set_value('Notifications')==$row->id)?" selected=' selected'":""?>><?=$row->Laps?></option>
												<?php	
														}  
													?>
											</select>
										 
									 </div>
								</div>
								
								
								
								<hr>

							
								<div class="form-group row">
								
									<label for="" class="col-sm-1 col-form-label"></label>
									<div class="col-md-3">
										<input  id="save_close" type="submit" value="Save and Close" class="btn btn-primary btn-lg btn-block"> 
									</div>

									<div class="col-md-3">
										<button id="cancel" type="button" class="btn btn-primary btn-lg btn-block">Cancel </button>
									</div>

									<div class="col-md-3">

										<script type="text/javascript">
											$( document ).ready(function() {
											    $( "#next2" ).click(function() { 
											    	$("#step1").hide("fast");
													$("#step2").show("fast");
													$("#step3").hide("fast");
											    });
											    $( "#next3" ).click(function() { 
											    	$("#step1").hide("fast");
													$("#step2").hide("fast");
													$("#step3").show("fast");
											    });
											    
											});
										</script>
											<a id="next2" href="#step2" type="button"   class="btn btn-primary btn-lg btn-block">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
								</div>

							</div><!-- fin allInputContainer -->
						</div><!-- Fin contorno -->
						
						
					</div><!-- fin tab-pane 1-->

				 
				 
				 
				  <!-- *********************************************************************************************************************************** top pane 2-->
					
					<input type="hidden" name="totCont" id="totCont"  value="<?php  echo $totOthersCont;   ?>" />
					
					<div class="tab-pane" role="tabpanel" id="step2">
						
						
						<div id="contorno" class="col-md-12">

							<div class="forms">
								<div class="panel-body">
									<p>Set up the billing arrangement for this matter. The information can be added or edited at any time once the matter is created.</p>
								</div>
						   </div>
						   
						   <br>
						   
						   <?php echo validation_errors('<span class="error">', '</span>'); ?>

							<div class="allInputContainer">
							
								<br>
								<br>
								
								<button type="button" class="btn  btn-default addFields" onclick="addFields()"><i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i>  Add</button>
								
								<div class="form-group row">
								
									 <label for="" class="col-sm-1 col-form-label">Others Contact *</label>
									 
									 <div class="col-md-5">
										<input type="text" class="form-control" name="Contact1" id="Contact1" onkeyup="showContacts(this.value,'1')" autocomplete="off" value="<?= set_value('Contact1');?>" placeholder="Search existing contacts   &#xF002" style="font-family:Arial, FontAwesome" />
										<div class="SearchBox" id="ContactResult1"></div>
										<input type="hidden"     name="ContactID1"   value="<?= set_value('ContactID1');?>" />
									 </div>

									  
									 <div class="col-md-5">
										<input type="text" id="Relation1" name="Relation1" class="form-control"   placeholder="Relationship to Matter" value="<?= set_value('Relation1');?>">
										 
									 </div> 
								</div>
								
								<div id="OtherContact">
									
									<?php
									
									if(isset($otherContactView)){
										$odata['totalothers']=$totalothers;
										$this->load->view($otherContactView,$odata);
									}
									
									?>
									
								</div>
								
								<div class="form-group row">
									 <label for="" class="col-sm-1 col-form-label"></label>
									 <div class="col-md-5">
										<button type="button" class="btn btn-default btn-lg btn-block" onclick="createOtherContact()">
											<i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i>  Create New Contact
										</button>
									 </div>
								</div>
								
								<br>
								<br>
								
								<hr>
								
								<br>
								<br>
								
								
								<div class="form-group row">
								
									<label for="" class="col-sm-1 col-form-label"></label>
									<div class="col-md-3">
										<input  id="save_close" type="submit" value="Save and Close" class="btn btn-primary btn-lg btn-block"> 
									</div>

									<div class="col-md-3">
										<button id="cancel" type="button" class="btn btn-primary btn-lg btn-block">Cancel </button>
									</div>

									<div class="col-md-3">
											<a id="next3" href="#step3" type="button"   class="btn btn-primary btn-lg btn-block">Next <i class="fa fa-angle-right" aria-hidden="true"></i></a>
									</div>
								</div>

								

							</div><!-- fin allInputContainer -->
							
						
						</div><!-- Fin contorno -->
						
						
					</div><!-- fin tab-pane -->

					 
					 
					 
					 
					 
					 
					<div class="tab-pane" role="tabpanel" id="step3">
						  <h3>Formulario 3</h3>
						  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est odio, quam, labore fugiat rerum deserunt doloremque atque reiciendis ipsum in eaque fuga voluptates recusandae iusto. Repellat expedita, doloremque fuga unde.</p>

						  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est odio, quam, labore fugiat rerum deserunt doloremque atque reiciendis ipsum in eaque fuga voluptates recusandae iusto. Repellat expedita, doloremque fuga unde.</p>

						  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est odio, quam, labore fugiat rerum deserunt doloremque atque reiciendis ipsum in eaque fuga voluptates recusandae iusto. Repellat expedita, doloremque fuga unde.</p>

						  <ul class="list-inline pull-right">
						   <li><button type="button" class="btn btn-default prev-step">Previous</button></li>
						   <li><button type="button" class="btn btn-default next-step">Skip</button></li>
						   <li><button type="button" class="btn btn-primary btn-info-full next-step">Save and continue</button></li>
						  </ul>
					 </div>

					 
					 
					 
					 
					 
					 <div class="tab-pane" role="tabpanel" id="complete">
					  <h3>Formulario 4</h3>
					  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est odio, quam, labore fugiat rerum deserunt doloremque atque reiciendis ipsum in eaque fuga voluptates recusandae iusto. Repellat expedita, doloremque fuga unde.</p>

					  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est odio, quam, labore fugiat rerum deserunt doloremque atque reiciendis ipsum in eaque fuga voluptates recusandae iusto. Repellat expedita, doloremque fuga unde.</p>

					  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est odio, quam, labore fugiat rerum deserunt doloremque atque reiciendis ipsum in eaque fuga voluptates recusandae iusto. Repellat expedita, doloremque fuga unde.</p>
					 </div>
					 <div class="clearfix"></div>
					 
					 
				</div><!-- fin tab-content -->
				
				
				
			</form>

		</div> <!-- fin wizard -->
		
	</div><!-- fin col-md-12 -->
	
</div><!-- fin row -->






