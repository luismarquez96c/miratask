<script type="text/javascript">

	  CountAddAdress=<?=$totAddressCont?>;
	  CountAddPhone =<?=$totPhoneCont?>;
	  totEmailCont  =<?=$totEmailCont?>;
	  totWebsiteCont=<?=$totWebsiteCont?>;
	  
$( document ).ready(function() {	

	$("#save").click( function () {

		$.ajax({
		url: base_app + 'Ajax/ContactNewSave',
		type: 'POST',
		dataType: 'html',
		data: $("#formNewContact").serialize()
		}).done(function (data) {
			
			//var theString = data,
			//bits = theString.split('|').slice(0, -1); // split the string and remove the last one

			var numbersString = data;
			var numbersArray = numbersString.split(','); 
			
			//alert("Estado "+numbersArray[0]+"|Name "+numbersArray[1]+"|Id "+numbersArray[2]);

			if(numbersArray[0]=="ok"){

				$('input[name="'+fieldContactID+'"]').val(numbersArray[2]);
				$('input[name="'+fieldContactName+'"]').val(numbersArray[1]);
				

				$("#newContactForm").hide();

				//alert(" Contact Has been save! id " + fieldContactID + ": " + bits[2]);
				
				$("#fadeBlack").hide();
				$("#newContactForm").hide();
			}
			 
			 
			$("#newContactForm").html(data);
			 
		});
		
	});

	$("#cancel").click( function () {

		$("#newContactForm").hide();
		$("#newContactForm").html("enty");
		$("#fadeBlack").hide();
	});
	
	
	
	
	 

	 
	

}); 


</script>
 
	<form id="formNewContact" method="post" >
	
	 
	
		
		<div id="contorno" class="col-md-12 boxSlider">
			<div class="Boxtitle">Add Contact</div>
			
			<div class="boxheadButtons">
					<script>
						<?php 
							if(set_value('Class')=='Individual'){
								$radio1="checked='checked'";
								$radio2="";  	
							}elseif(set_value('Class')=='Business-Org'){
								$radio1="";
								$radio2="checked='checked'"; ?>
								
								RemoveFieldIndividual();
								
							<?php	
							}else{
								$radio1="checked='checked'";
								$radio2=""; 	
							}
						?>
					</script>
			
					<div class="btn-group ml-2"><!-- checked="checked"  -->
						<input type="radio" name="Class" value="Individual" <?=$radio1?>  onclick="addFieldIndividual()" >Individuals
					</div>
					
					<div class="btn-group ml-2 ml50">		
						<input type="radio" name="Class" value="Business-Org" <?=$radio2?> onclick="RemoveFieldIndividual()"  class="ml50" >Business / Organizations
					</div>
					
					<div class="btn-group ml-2 ml50">

						<button id="GroupContactsButt" type="button" class="btn btn-lg btn-secondary">Groups</button>
						<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >
						 
							<span class="caret"></span>
						 
						</button>
						<ul class="dropdown-menu btn-block groupTopList" role="menu">

							<?php 
							foreach ($Groups as $row)
							{ ?>

							<li class="">
								<input type="checkbox" name="groupID[]" class="goupID" value="<?=$row->Id?>" onclick="addHiddenGroups(this.value)">
								 <?=$row->Name?> 
							</li>
							
							<?php  
							} 
							?>  
							
									
							
						</ul>
						  
					</div><!-- fin wrap ml 2 -->

					 
					  
					
					<div class="btn-group ml-2 ml50">

						<button id="OwnerButt" type="button" class="btn btn-lg btn-secondary SelectOwn"  >Select Owner</button>
						<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >
						 
							<span class="caret"></span>
						 
						</button>
						<ul class="dropdown-menu btn-block groupTopList" role="menu">
							 
							
							<input type="hidden" id="Own" name="Own" value="<?=$this->session->userdata("Id")?>">

							<?php 
							 
							 
							foreach ($Attorneys as $row)
							{ ?>

								<li class="" onclick="thisSelect(<?=$row->Id?>,'<?=$row->Name?> <?=$row->LastName?>','Own','OwnerButt' )">
									
									 <?=$row->Name?>   <?=$row->LastName?>
								</li>
							
							<?php  
							 
							} 
							?>  
							
									
							
						</ul>
						  
					</div><!-- fin wrap ml 2 -->
					
					
					
					
				</div>
				
			<div class="h10"></div>
		
			<div class="allInputContainer">
				
				
				<?php echo validation_errors('<span class="error">', '</span>'); ?>
				
				<div class="clearh1"></div>
				
				<div id="individualSection">
				
					<div class="form-group row">	
						<label for="" class="col-sm-1 col-form-label">Title</label>  
						<input type="text" name="Tittle" id="Tittle" value="<?=set_value('Tittle')?>" />
					</div>
				
					<div class="form-group row">
						<label for="" class="col-sm-1 col-form-label">Name*</label> 
						<input type="text" name="Name"     placeholder="First"  value="<?=set_value('Name')?>" />
						<input type="text" name="Middle"   placeholder="Middle" class="fieldR"	value="<?=set_value('Middle')?>" />
					</div>

					<div class="form-group row">	
						<input type="text" name="LastName" id="LastName" placeholder="Last" value="<?=set_value('LastName')?>" />
						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
						<input type="text" name="Suffix" id="Suffix" placeholder="Suffix" class="fieldR" value="<?=set_value('Suffix')?>" />
					</div>	
					
					<div class="form-group row"> 
					
					</div>	
					
					<div class="form-group row"> 
					
					</div>
					
					<div class="form-group row">	
						<label for="" class="col-sm-1 col-form-label">Profession</label>  
						<input type="text" name="Profession" id="Profession" value="<?=set_value('Profession')?>" />
					</div>
				
				</div><!-- fin individual section -->
				
				<div class="form-group row">	
					<label for="" class="col-sm-1 col-form-label">Company</label>  
					<input type="text" name="Company" id="Company" value="<?=set_value('Company')?>" />
				</div>
				
				<div class="form-group row">	
					<label for="" class="col-sm-1 col-form-label">ClientID</label>  
					<input type="text" name="ClientID" id="ClientID" value="<?=set_value('ClientID')?>" />
				</div>
				
				
				
				
				
				<!-- *****************************ADRESS************************ -->
											
				<input type="hidden" name="totAddressCont" id="totAddressCont"  value="<?php  echo $totAddressCont;   ?>" />
				<div class="form-group row">
				
					<label for="" class="col-sm-1 col-form-label">Address *</label>
					
					<select name="Country1" style="color:#0055a5;"  onchange="StateOfCountry(this.value, '1')">
						 <option>Select One Country</option>
						 <?php 
							foreach ($Countries as $row)
							{
							?>
								<option value="<?=$row->Id?>" <?php echo (set_value('Country1')==$row->Id)?" selected=' selected'":""?>>
									<?=$row->Country?>
								</option>
							<?php
							}
						?>
					</select>	
					
				</div>
				
				<div class="form-group row">	
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
					<input type="text" name="Street1_1" placeholder="Street" class="fieldLar" value="<?=set_value('Street1_1')?>" />
				</div>
				
				<div class="form-group row">	
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
					<input type="text" name="Street2_1" placeholder="Street 2" class="fieldLar" value="<?=set_value('Street2_1')?>"/>
				</div>
				
				<?php 
					$ci = &get_instance();
					$ci->load->model("ContactModel");
					
					if(set_value('Country1')!=""){
						$getStates=$ci->ContactModel->StatesOfCountries(set_value('Country1'));
					}
				?>
				
				
				<div class="form-group row">	
				
					<input type="text" name="City1" id="City1" placeholder="City" value="<?=set_value('City1')?>" />
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
					
					
					<select name="State1" class="fieldR" id="State1">
						 <option>Select State</option>
						 <?php 
							foreach ($getStates as $row)
							{
							?>
								<option value="<?=$row->Id?>" <?php echo (set_value('State1')==$row->Id)?" selected=' selected'":""?>>
									<?=$row->State?>
								</option>
							<?php
							}
						?>
					</select>
				</div>
				
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
					<input type="text" name="ZipCode1" id="ZipCode1" placeholder="Zip Code" value="<?=set_value('ZipCode1')?>" />
				</div>
				
				
				<?php 
				if($totAddressCont>1){
					 
					$this->load->view("Contacts/moreAddress");
				}
				?>
				
				<div id="AddressExpansor">
				
				
				</div>
				
				<!-- boton add addreess -->
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label addAdress" onclick="addAddressFields()"  >
					<span class="addAdresButt"  ></span>Add address</label>  
				</div>
				<!--  FIN ADRESS --> 
				
				
				
				
				
				
				<input type="hidden" name="totPhoneCont" id="totPhoneCont"  value="<?php  echo $totPhoneCont;   ?>" />
				
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label">Phone</label>  
					<input type="text" name="Phone1" id="Phone1" placeholder="555-555-5555"    value="<?=set_value('Phone1')?>" maxlength="12" />
					<input type="text" name="Ext1" id="Ext1" class="fieldR" placeholder="Ext." value="<?=set_value('Ext1')?>" />
				</div>
				
				<?php if($totPhoneCont>1){   $this->load->view("Contacts/morePhone"); }?>
				
				<div id="PhoneExpansor"></div>
				
				<!-- boton add Phone -->
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label addAdress" onclick="addPhoneField()"  ><span class="addAdresButt"></span>Add Phone</label>  
				</div>
				
				
				
				
				
				<!-- EMAIL -->
				<input type="hidden" name="totEmailCont" id="totEmailCont"  value="<?php  echo $totEmailCont;   ?>" />
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label">Email</label>  
					<input type="text" name="Email1" id="Email1" class="fieldLar" placeholder="sample@hotmail.com" value="<?=set_value('Email1')?>" />
				</div>
				
				<?php if($totEmailCont>1){   $this->load->view("Contacts/moreEmail"); }?>
				
				<div id="EmailExpansor"></div>
				
				<div class="form-group row"> <!-- boton add Email -->
					<label for="" class="col-sm-1 col-form-label addAdress" onclick="addEmailField()" ><span class="addAdresButt"></span>Add Email</label>  
				</div>
				
				
				
				
				
				<script>
				 $( function() {
					$( "#Birdate" ).datepicker();
				  } );
				</script>
				
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label">Date Of Birdate</label>  
					<input type="text" name="Birdate" id="Birdate" value="<?=set_value('Birdate')?>" />
				</div>
				
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label">Other identifier</label>  
					<input type="text" name="OtherIdenty" id="OtherIdenty" value="<?=set_value('OtherIdenty')?>" />
				</div>
				
				
				
				
				<!-- WEBSITE -->
				
				<input type="hidden" name="totWebsiteCont" id="totWebsiteCont"  value="<?php  echo $totWebsiteCont;   ?>" />
				
				<div class="form-group row">
					
					<label for="" class="col-sm-1 col-form-label"> Website</label>  
					<input type="text" name="Website1" id="Website1" placeholder="http://yourwebsite.com" class="fieldLar" value="<?=set_value('Website1')?>"/>
				</div>
				
				<?php if($totWebsiteCont>1){   $this->load->view("Contacts/moreWebsite"); }?>
				
				<div id="WebsiteExpansor"></div>
				
				<div class="form-group row"> <!-- boton add website -->
					<label for="" class="col-sm-1 col-form-label addAdress" onclick="addWebsiteField()" ><span class="addAdresButt"></span>Add Website</label>  
				</div>
				
				
				
				
				<div class="clearh1"></div>
				
				<div class="form-group row fitButtons ">
									
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
					 
					<div class="col-md-3">
						<input  id="save" type="button" value="Save" class="btn btn-primary btn-lg btn-block"> 
					</div>

					<div class="col-md-3">
						<button id="cancel" type="button" class="btn btn-primary btn-lg btn-block">Cancel </button>
					</div>

					  <br>
					  <br>
					  <br>
					  
					<div class="clearh1"></div>
				</div>
				
				
			</div>	
		
		</div>

	</form>	