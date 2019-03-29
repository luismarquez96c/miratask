 

<script src="<?=base_url()?>js/contactAjax.js"></script>
<script src="<?=base_url()?>js/util.js"></script>

<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<?php 
$ci =&get_instance();

$ci->lang->load($this->session->userdata("lng") , 'labels');
?>


<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3><?php echo $this->lang->line('matters_13'); ?></h3><hr>
</div>

<div class="row">
	
	<div class="col-md-12 col-sm-12 col-xs-12">

		<div class="wizard">
			<div class="wizard-inner">
				
				<div class="connecting-line"></div>
				
				<ul id="formularios" class="nav nav-tabs" role="tablist" style="">

					<li id="WBallnext1" role="presentation" class="active" >
						<a class="step"  id="Ballnext1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
							<span class="round-tab">1</span>
							<span class="stepLabel"><?php echo $this->lang->line('matters_14'); ?></span>
						</a>
						
					</li>

					
					<li id="WBallnext2" role="presentation" class="disabled">
						<a class="step" id="Ballnext2"   data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
							<span class="round-tab">2</span>
							<span class="stepLabel"><?php echo $this->lang->line('matters_15'); ?></span>
						</a>
					</li>
					
					
					<li id="WBallnext3" role="presentation" class="disabled">
						<a class="step" id="Ballnext3"   data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
							<span class="round-tab">3</span>
							<span class="stepLabel"><?php echo $this->lang->line('matters_16'); ?></span>
						</a>
					</li>
					
					
					
				</ul>
			</div>
			<br>

			<form class="form-horizontal"  action="<?=base_app()?>Matters/SaveNew" method="post">
				
				
				
				<div class="tab-content">


					<div class="tab-pane active" role="tabpanel" id="step1">

						<div id="contorno" class="col-md-12 wrapNewMatt">

							<div class="forms">
								<div class="panel-body">
									<p><?php echo $this->lang->line('matters_17'); ?></p>
								</div>
							</div>
							<br>
							
							<div class="allInputContainer">
								
								<?php echo validation_errors('<span class="error">', '</span>'); ?>
								<div class="clearh1"></div>
								<div class="form-group row">

									<div class="col-md-6">
										<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_18'); ?></label>
										
										<input type="text" class="form-control"   placeholder="" name="Name" value="<?= set_value('Name');?>" />
										
									</div>
									<div class="col-md-6">	
										<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_19'); ?></label>
										
										<input type="text" id="MatterID" name="MatterID" class="form-control"     value="<?=set_value('MatterID')?>" />
									</div>
									
								</div>

								<div class="form-group row">
									<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_20'); ?></label>
									<div class="col-md-5">
										<input type="text" class="form-control" id="" placeholder="" name="Description" value="<?= set_value('Description');?>">
									</div>
								</div>

								<div class="form-group row">
									<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_21'); ?></label>
									<div class="col-md-5">
										<input type="text" id="hp" class="form-control" name="Contact_A" onkeyup="showContacts(this.value,'_A')" autocomplete="off" value="<?= set_value('Contact_A');?>" placeholder="<?php echo $this->lang->line('matters_22'); ?>   &#xF002" style="font-family:Arial, FontAwesome" />
										<div class="SearchBox" id="ContactResult_A"></div>
										<input type="hidden"     name="ContactID_A" value="<?= set_value('ContactID_A');?>" />		
										
									</div>
								</div>

								<div class="form-group row">
									<label for="" class="col-sm-1 col-form-label"></label>
									<div class="col-md-5">
										<button type="button" onclick="createContact('ContactID_A','Contact_A')" class="btn btn-default btn-lg btn-block">
											<i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i>  <?php echo $this->lang->line('matters_23'); ?></button>
										</div>
									</div>
									<hr>

									<div class="form-group row">
										
										<div class="col-md-6">					
											<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_24'); ?></label>
											
											
											<select name="Area" class="form-control blueText" placeholder=""  > 
												<option value=""><?php echo $this->lang->line('matters_35'); ?></option>
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
									 	<!-- <label for="" class="col-sm-1 col-form-label">Matter Template*</label>
									  
										  
										<select class="form-control blueText" placeholder="" name="Template"  > 
											<option value=""><?php echo $this->lang->line('matters_35'); ?></option>
													<?php 
														foreach ($Templates as $row)
														{ ?>
															<option value="<?=$row->Id?>" <?php echo (set_value('Template')==$row->Id)?" selected=' selected'":""?>><?=$row->Template?></option>
												<?php   }
													
													?>
												</select> -->
												
												
												
												<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_27'); ?></label>
												
												
												<select name="Notifications" class="form-control blueText"  > 
													<option value=""><?php echo $this->lang->line('matters_35'); ?></option>
													<?php 
													foreach ($Notifications as $row)
														{ ?>
															
															<option value="<?=$row->id?>" <?php echo (set_value('Notifications')==$row->id)?" selected=' selected'":""?>><?=$row->Laps?></option>
															<?php	
														}  
														?>
													</select>

												</div>
											</div><!-- fin form-group -->
											
											
											<div class="form-group row">
												
												<div class="col-md-6">
													<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_25'); ?></label>

													<script>
														$( function() {
															$( "#DateOpened" ).datepicker();
															
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
													<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_28'); ?></label>
													
													
													<select name="ResponsibleAttorney" class="form-control" placeholder=""  > 
														<option value=""><?php echo $this->lang->line('matters_35'); ?></option>
														<?php 
														foreach ($Attorney as $row)
														{
															?>
															<option value="<?=$row->Id?>" <?php echo (set_value('ResponsibleAttorney')==$row->Id)?" selected=' selected'":""?>><?=ucwords(strtolower($row->Name." ".$row->LastName))?></option>
															<?php
														}
														?>
													</select>
													
												</div>
											</div><!-- fin groups -->

											
											<div class="form-group row">

												<div class="col-md-6">
													<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_26'); ?></label>
													
													<div class="input-group">
														
														<input type="text" name="Contact_R"   autocomplete="off" class="form-control"  onkeyup="showContacts(this.value,'_R')"  placeholder="<?php echo $this->lang->line('matters_22'); ?>  &#xF002" style="font-family:Arial, FontAwesome"   value="<?= set_value('Contact_R');?>" >
														<input type="hidden"     name="ContactID_R"  value="<?= set_value('ContactID_R')?>" />	
														<div  class="SearchBox" id="ContactResult_R" ></div>
														
														
													</div>
												</div> 
												
												<div class="col-md-6">
													<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_29'); ?></label>
													
													<!-- <input type="text" name="OtherStaff" id="OtherStaff" class="form-control" autocomplete="off" id=""  value="<?= set_value('OtherStaff');?>" > -->
													
													<input type="text" name="OtherStaffC" onkeyup="searchStaff(this.value)" value=""   class="form-control" autocomplete="off" placeholder="<?php echo $this->lang->line('matters_30'); ?>" />
													<div id="staffWrapBox">
														<span class="col-sm-1 col-form-label ml70"> </span>
														
													</div>
													<div id="resulAttorney" class="SearchBox"></div>



													
												</div>

											</div>

											<div class="form-group row">
												
												<div class="col-md-6">
													<label for="" class="col-sm-1 col-form-label">
														&nbsp;
													</label>
												</div>
												<div class="col-md-6">
													<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_31'); ?></label>
													
													<select name="OriginatingAttorney" class="form-control" placeholder=""  > 
														<option value=""><?php echo $this->lang->line('matters_35'); ?></option>
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

								<!--
								<hr>
								<div class="form-group">
									
									<div class="mat_description_wrap">
										 
										Description:
										<br>
										<br> 
										<textarea name="Description" style="width:100px !important; height:100px !important;"><?=$Matter->Description?></textarea>
										 
									</div>
									 
								</div>


							-->
							
							
							
							<hr>

							
							<div class="form-group row fitButtons">
								
								
								<div class="col-md-3">
									<input  id="save_close" type="submit" value="<?php echo $this->lang->line('matters_32'); ?>" class="btn btn-primary btn-lg btn-block"> 
									
									
									

								</div>

								<div class="col-md-3">
									<a id="cancel" href="<?=base_app()?>Matters" type="button" class="btn btn-primary btn-lg btn-block">
										<?php echo $this->lang->line('matters_33'); ?>
									</a>
								</div>

								<div class="col-md-3">

									<script type="text/javascript">
										$( document ).ready(function() {

											$( "#next2" ).click(function() { 

												$("#step1").hide("fast");
												$("#step2").show("fast");
												$("#step3").hide("fast");

												$( "#WBallnext1" ).removeClass("active");
												$( "#WBallnext2" ).addClass( "active" );
												$( "#WBallnext3" ).removeClass("active");

											});
											$( "#next3" ).click(function() { 

												$("#step1").hide("fast");
												$("#step2").hide("fast");
												$("#step3").show("fast");

												$( "#WBallnext1" ).removeClass("active");
												$( "#WBallnext2" ).removeClass("active");
												$( "#WBallnext3" ).addClass( "active" );

											});


											
											$( "#Ballnext1" ).click(function() { 
												$("#step1").show("fast");
												$("#step2").hide("fast");
												$("#step3").hide("fast");

												$( "#WBallnext1" ).addClass( "active" );
												$( "#WBallnext2" ).removeClass("active");
												$( "#WBallnext3" ).removeClass("active");

											});	
											$( "#Ballnext2" ).click(function() { 
												$("#step1").hide("fast");
												$("#step2").show("fast");
												$("#step3").hide("fast");

												
												$( "#WBallnext1" ).removeClass("active");
												$( "#WBallnext2" ).addClass( "active" );
												$( "#WBallnext3" ).removeClass("active");

											});
											$( "#Ballnext3" ).click(function() { 
												$("#step1").hide("fast");
												$("#step2").hide("fast");
												$("#step3").show("fast");

												$( "#WBallnext1" ).removeClass("active");
												$( "#WBallnext2" ).removeClass("active");
												$( "#WBallnext3" ).addClass( "active" );
											});
											
											
										});
									</script>
									<a id="next2" href="#step2" type="button"   class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('matters_34'); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
								</div>
							</div>



							



						</div><!-- fin allInputContainer -->
					</div><!-- Fin contorno -->
					
					
				</div><!-- fin tab-pane 1-->

				
				
				
				<!-- ******************** 2 2 2*************************************************************************************************************** top pane 2-->
				
				<input type="hidden" name="totCont" id="totCont"  value="<?php  echo $totOthersCont;   ?>" />
				
				<div class="tab-pane" role="tabpanel" id="step2">
					
					
					<div id="contorno" class="col-md-12">

						<div class="forms">
							<div class="panel-body">
								<p><?php echo $this->lang->line('matters_36'); ?></p>
							</div>
						</div>
						
						<br>
						
						<?php echo validation_errors('<span class="error">', '</span>'); ?>

						<div class="allInputContainer">
							
							<br>
							<br>
							
							<button type="button" class="btn  btn-default addFields" onclick="addFields()"><i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i> <?php echo $this->lang->line('matters_39'); ?></button>
							
							<div class="form-group row">
								
								<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_37'); ?></label>
								
								<div class="col-md-5">
									<input type="text" class="form-control" name="Contact1" id="Contact1" onkeyup="showContacts(this.value,'1')" autocomplete="off" value="<?= set_value('Contact1');?>" placeholder="<?php echo $this->lang->line('matters_22'); ?>   &#xF002" style="font-family:Arial, FontAwesome" />
									<div class="SearchBox" id="ContactResult1"></div>
									<input type="hidden"     name="ContactID1"   value="<?= set_value('ContactID1');?>" />
								</div>

								
								<div class="col-md-5">
									<input type="text" id="Relation1" name="Relation1" class="form-control"   placeholder="<?php echo $this->lang->line('matters_38'); ?>" value="<?= set_value('Relation1');?>">
									
								</div> 
							</div>
							
							<div id="OtherContact">
								
								
								
							</div>
							
							<div class="form-group row">
								<label for="" class="col-sm-1 col-form-label"></label>
								<div class="col-md-5">
									<button type="button" class="btn btn-default btn-lg btn-block" onclick="createOtherContact()">
										<i class="fa fa-plus" aria-hidden="true" style="font-family:Arial, FontAwesome"></i>  <?php echo $this->lang->line('matters_23'); ?>
									</button>
								</div>
							</div>
							
							<br>
							<br>
							
							<hr>
							
							<br>
							<br>
							
							
							<div class="form-group row fitButtons">
								
								<label for="" class="col-sm-1 col-form-label"></label>
								<div class="col-md-3">
									<input  id="save_close" type="submit" value="<?php echo $this->lang->line('matters_32'); ?>" class="btn btn-primary btn-lg btn-block"> 
								</div>

								<div class="col-md-3">
									<a href="<?=base_app()?>Matters" id="cancel" type="button" class="btn btn-primary btn-lg btn-block">
										Cancel 
									</a>
								</div>

								<div class="col-md-3">
									<a id="next3" href="#step3" type="button"   class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('matters_34'); ?><i class="fa fa-angle-right" aria-hidden="true"></i></a>
								</div>
							</div>

							

						</div><!-- fin allInputContainer -->
						
						
					</div><!-- Fin contorno -->
					
					
				</div><!-- fin tab-pane -->

				
				
				
				<!-- 33 3333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333333 -->
				
				
				<div class="tab-pane" role="tabpanel" id="step3">

					<div id="contorno" class="col-md-12">

						<div class="forms">
							<div class="panel-body">
								<p><?php echo $this->lang->line('matters_17'); ?></p>
							</div>
						</div>
						<br>
						
						
						<div class="allInputContainer">

							
							
							
							<div class="clearh20"></div>
							

							<div class="form-group row">

								<div class="col-md-6">

									<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_40'); ?></label>
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-usd"></span>
										</span>
										<input style="width: 175px"  type="text" class="form-control calcule-billing"   placeholder="" name="TotalAmount" value="<?= set_value('TotalAmount');?>" />
									</div>
									
									
								</div>
								<div class="col-md-6">
									<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_41'); ?></label>
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-usd"></span>
										</span>
										<input style="width: 175px" type="text" id="Initial_Fee" name="Initial_Fee" class="form-control calcule-billing"     value="" />
									</div>


									<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_42'); ?></label>
									
									
									<div class="input-group">
										<span class="input-group-addon">
											<span class="glyphicon glyphicon-usd"></span>
										</span>
										<input style="width: 175px" type="text" id="Fee" name="Fee" class="form-control calcule-billing"     value="<?=set_value('Fee')?>" />
									</div>
								</div>
								
							</div>



							<div class="form-group row">	


								<div class="col-md-6">
									<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_43'); ?></label>

									<script>
										$( function() {
											$( "#StartDate" ).datepicker({
												constrainInput: true
											});
											
											$("#calendarIco1").click(function() {
												$("#StartDate").datepicker("show");
											});
										});
										
										
									</script>
									<div class="input-group">	 
										<input type="text" readonly="" id="StartDate" name="StartDate" class="form-control blueText calcule-billing" autocomplete="off"  value="<?= set_value('StartDate');?>"   />
										
										<div  id="calendarIco1"></div>  
									</div> 
								</div>



								<div class="col-md-6">
									<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_44'); ?></label>

									<script>
											/* $( function() {
													$( "#EndDate" ).datepicker({
														constrainInput: true
													});
													
													$("#calendarIco2").click(function() {
														$("#EndDate").datepicker("show");
													});
												});*/
												
												
											</script>
											<div class="input-group">	 
												<input type="text" id="EndDate" readonly="" name="EndDate" class="form-control blueText" autocomplete="off"  value="<?= set_value('EndDate');?>"   />
												
												<div  id="calendarIco2"></div>  
											</div> 
										</div>


									</div><!-- fin row -->




									
									<div class="form-group row">		
										<div class="col-md-6">					
											<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('matters_45'); ?></label>
											
											
											<select name="Periodicity" class="form-control blueText calcule-billing" placeholder=""> 
												
												<option value="-1"><?php echo $this->lang->line('matters_35'); ?></option>
												<option <?=(set_value('Periodicity')=="0"?"selected":"") ?> value="0"><?php echo $this->lang->line('matters_46'); ?></option>
												<option <?=(set_value('Periodicity')=="1"?"selected":"") ?> value="1"><?php echo $this->lang->line('matters_47'); ?></option>
												<option <?=(set_value('Periodicity')=="2"?"selected":"") ?> value="2"><?php echo $this->lang->line('matters_48'); ?></option>
												<option <?=(set_value('Periodicity')=="3"?"selected":"") ?> value="3"><?php echo $this->lang->line('matters_49'); ?></option>
												<option <?=(set_value('Periodicity')=="4"?"selected":"") ?> value="4"><?php echo $this->lang->line('matters_50'); ?></option>
												<option <?=(set_value('Periodicity')=="5"?"selected":"") ?> value="5"><?php echo $this->lang->line('matters_51'); ?></option>
												
											</select>
											
										</div>

										<div class="col-md-6 payday" style="display: <?=((int)set_value('Periodicity')>2?'inline-block':'none') ?>"> 
											<label for="" class="col-sm-1 col-form-label">Day of month to pay</label>
											
											
											<select class="form-control blueText" placeholder="" name="PerDay"> 
												<option value="-1"><?php echo $this->lang->line('matters_35'); ?></option>
												<?php for($i=1;$i<=31;$i++): ?>
													<option values="<?=$i ?>"><?=$i ?></option>
												<?php endfor; ?>
											</select>  
										</div>

									</div>
									<div class="message-area" style="display: none"><div class="message-system"></div></div>





									<br>
									<br>
									
									<hr>
									
									<br>
									<br>

									<div class="form-group row fitButtons">
										
										<label for="" class="col-sm-1 col-form-label"></label>
										<div class="col-md-3">
											<input  id="save_close" type="submit" value="<?php echo $this->lang->line('matters_32'); ?>" class="btn btn-primary btn-lg btn-block"> 
										</div>

										<div class="col-md-3">
											<a href="<?=base_app()?>Matters" id="cancel" type="button" class="btn btn-primary btn-lg btn-block"> <?php echo $this->lang->line('matters_33'); ?>
											
										</a>
									</div>

									
								</div>





							</div><!-- fin all input container -->  


							
						</div><!-- Fin contorno -->
						
					</div><!-- fin tap panel 3  -->


					
					
					
					
				</div><!-- fin tab-content -->
				
				
				
			</form>

		</div> <!-- fin wizard -->
		
	</div><!-- fin col-md-12 -->
	
</div><!-- fin row -->




<script type="text/javascript" src="<?=base_url() ?>js/WI-calendar.js"></script>
<script type="text/javascript">


	var totalAmountVal;



	// EVENTO QUE PERMITE QUE LOS CAMPOS NUMERICOS NO SEA UN NO NUMERO NI UN NÚMERO NEGATIVO
	$(".calcule-billing").change(function(){
		validarNumero($(this).val(), $(this) );
	});

	// FUNCTION MANDADA A LLAMAR POR EL EVENTO CHANGE DE LOS CAMPOS NUMERICOS
	function validarNumero(numero, obj){
		var validador = "";
		var mensaje = "";

		if( isNaN(numero) ){
			mensaje = "El valor que ha ingresado no es un número";
			validador = "error";

		}else if(numero <= 0) {

			mensaje = "El valor que ha ingresado no debe de ser cero o menor que cero";
			validador = "error";

		}

		if(validador != ""){
			if(obj.attr('name') == 'TotalAmount' || obj.attr('name') == 'Initial_Fee' || obj.attr('name') == 'Fee' ){
				$(obj).css('border', '1px solid red');

				alert(mensaje);
				setTimeout(function(){

					$(obj).css('border', '');
				}, 1500);
				$(obj).val('');
			}

		}else{
			calcular_billing();
		}


	}

	

	function calcular_billing(){
		total=Number($('[name="TotalAmount"]').val());
		initial_fee=Number($('[name="Initial_Fee"]').val());
		fee=Number($('[name="Fee"]').val());
		start_date=str2date($('[name="StartDate"]').val());
		periodicity=$('[name="Periodicity"]').val();
		fecha_fin="";
		pay_day=$('[name="PerDay"]').val();

		totalPay=total-initial_fee;

		if(fee>totalPay || fee==0){
			$('[name="Fee"]').val(totalPay);
		}

		if(total < initial_fee ){
			$('[name="Fee"]').val(0);
			$('[name="Initial_Fee"]').val(total);
			alert("El pago inicial no puede ser mayor que el total a pagar");
		}

		if(start_date==false){
			return;
		}
		if(fee==0){
			fee=total;
		}
		if(periodicity>2){
			$(".payday").show();
		}else{
			$(".payday").hide();
		}
		
		
		
		fee_rate=Math.ceil(totalPay/fee);

		switch(periodicity){
			case "0": // pago unico
			fecha_fin=date2str(start_date);
			$('[name="Fee"]').val(totalPay);
			break;
			case "1": // semanal
			fecha_fin=start_date;
			for(i=1;i<=fee_rate;i++){
				fecha_fin=fecha_fin.addDays(7);
			}
			fecha_fin=date2str(fecha_fin);
			break;
			case "2": // cada 15 dias
			
				//alert(fee_rate);
				fecha_fin=start_date;
				for(i=1;i<=fee_rate;i++){
					fecha_fin=fecha_fin.addDays(15);
				}
				fecha_fin=date2str(fecha_fin);
				break;
			case "3": // mensual
			

			fecha_fin=start_date;
			
			for(i=1;i<=fee_rate;i++){
				fecha_fin=new Date(fecha_fin.setMonth(fecha_fin.getMonth()+1));
			}
			fecha_fin=date2str(fecha_fin);
			break;
			case "4": // Bi mensual
			

			fecha_fin=start_date;
			
			for(var i=1;i<=fee_rate;i++){
				fecha_fin=new Date(fecha_fin.setMonth(fecha_fin.getMonth()+2));

			}
			fecha_fin=date2str(fecha_fin);
			break;
			case "5": // trimensual

			fecha_fin=start_date;
			
			for(i=1;i<=fee_rate;i++){
				fecha_fin=new Date(fecha_fin.setMonth(fecha_fin.getMonth()+3));

			}
			fecha_fin=date2str(fecha_fin);
			break;
		}

		$('[name="EndDate"]').val(fecha_fin);

	}

	function str2date(str){
		str=str.split("/");
		if(str.length<3){
			return false;
		}
		return new Date(str[2],str[0]-1,str[1],0,0,0);
	}
	function date2str(d){
		return ((d.getMonth()+1)<10?"0"+(d.getMonth()+1):(d.getMonth()+1))+"/"+(d.getDate()<10?"0"+d.getDate():d.getDate())+"/"+ d.getFullYear();
	}

	$(".form-horizontal").submit(function(e){
		$(".message-area .message-system").html("").removeClass('error, success').parent().hide();

		/*total=Number($('[name="TotalAmount"]').val());
		
		fee=Number($('[name="Fee"]').val());
		start_date=str2date($('[name="StartDate"]').val());
		periodicity=$('[name="Periodicity"]').val();

		if(total==0){
			$(".message-area .message-system").html("Invalid Total Amount ").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}
		if(start_date==false){
			$(".message-area .message-system").html("Select a valid date").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}
		if(periodicity==-1){
			$(".message-area .message-system").html("Select a periodicity").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}
		if(fee==0){
			$(".message-area .message-system").html("Invalid Fee").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}*/
		
		


	});
</script>



