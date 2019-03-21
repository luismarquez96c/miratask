 <?php 
 $ci =&get_instance();
 $ci->load->model("ContactModel");
 ?>
 <script type="text/javascript">

 	CountAddAdress=<?=$totAddressCont?>;
 	CountAddPhone =<?=$totPhoneCont?>;
 	totEmailCont  =<?=$totEmailCont?>;
 	totWebsiteCont=<?=$totWebsiteCont?>;

 </script>
 
 <form id="formNewContact" method="post" >

 	<input type="hidden" name="Contacto" id="Contacto"  value="<?=$oneContact->Id; ?>" />




 	<div id="contorno" class="col-md-12 boxSlider">



 		<div class="Boxtitle">Contact Details <span class="close2" onclick="CloseObject('atachTo', 'noreload')">X</span> </div>



 		<div class="boxheadButtons">

 			<?php  //echo " Class of contact ".$oneContact->Class;  ?>

 			<script>
 				<?php 



 				if($oneContact->Class=='Individual'){
 					$radio1="checked='checked'";
 					$radio2="";  	
 				}elseif($oneContact->Class=='Business-Org'){
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



 				<button id="GroupContactsButt" type="button" class="btn btn-lg btn-secondary">Group</button>
 				<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >

 					<span class="caret"></span>

 				</button>
 				<ul class="dropdown-menu btn-block groupTopList" role="menu">

 					<?php 
 					foreach ($Groups as $row)
 					{ 

 						$selectGroup=$ci->ContactModel->GetContactInGroup($oneContact->Id, $row->Id);

							//echo '<br> count of '.count($selectGroup).'<BR>';

 						if(count($selectGroup)>0){
 							$chequed="checked=checked";
 						}else{
 							$chequed="";	
 						}	

 						?>

 						<li class="">
 							<input type="checkbox" <?=$chequed?>  name="goupID[]" class="goupID" value="<?=$row->Id?>" onclick="addHiddenGroups(this.value)">
 							<?=$row->Name?> 
 						</li>

 						<?php  
 					} 
 					?>  



 				</ul>

 			</div><!-- fin wrap ml 2 -->




 			<div class="btn-group ml-2 ml50">



 				<button id="OwnerButt" type="button" class="btn btn-lg btn-secondary SelectOwn"  ><?=$attorney->Name?> <?=$attorney->LastName?></button>
 				<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown" >

 					<span class="caret"></span>

 				</button>
 				<ul class="dropdown-menu btn-block groupTopList" role="menu">


 					<input type="hidden" id="Own" name="Own" value="<?=$oneContact->Owner?>">

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

 				<div id="resultErrors"></div>

 				<div class="clearh1"></div>

 				<div id="individualSection">

 					<div class="form-group row">	
 						<label for="" class="col-sm-1 col-form-label">Title</label>  
 						<input type="text" name="Tittle" id="Tittle" value="<?=$oneContact->Title?>" />
 					</div>

 					<div class="form-group row">
 						<label for="" class="col-sm-1 col-form-label">Name*</label> 
 						<input type="text" name="Name"     placeholder="First"  value="<?=$oneContact->FirstName?>" />
 						<input type="text" name="Middle"   placeholder="Middle" class="fieldR"	value="<?=$oneContact->Middle?>" />
 					</div>

 					<div class="form-group row">	
 						<input type="text" name="LastName" id="LastName" placeholder="Last" value="<?=$oneContact->LastName?>" />
 						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
 						<input type="text" name="Suffix" id="Suffix" placeholder="Suffix" class="fieldR" value="<?=$oneContact->Suffix?>" />
 					</div>	

 					<div class="form-group row"> 

 					</div>	

 					<div class="form-group row"> 

 					</div>

 					<div class="form-group row">	
 						<label for="" class="col-sm-1 col-form-label">Profession</label>  
 						<input type="text" name="Profession" id="Profession" value="<?=$oneContact->Profession?>" />
 					</div>

 				</div><!-- fin individual section -->

 				<div class="form-group row">	
 					<label for="" class="col-sm-1 col-form-label">Company</label>  
 					<input type="text" name="Company" id="Company" value="<?=$oneContact->Company?>" />
 				</div>

 				<div class="form-group row">	
 					<label for="" class="col-sm-1 col-form-label">ClientID</label>  
 					<input type="text" name="ClientID" id="ClientID" value="<?=$oneContact->ClientId?>" />
 				</div>





 				<!-- *****************************ADRESS************************ -->
 				<input type="hidden" name="totAddressCont" id="totAddressCont"  value="<?php  echo $totAddressCont;   ?>" />
 				<?php 

 				$i=1;

 				foreach ($address as $key) {
					# code...

 					?>

 					<input type="hidden" name="idAddress_<?=$i?>" id="idAddress_<?=$i?>"  value="<?=$key->id?>" />

 					<div class="form-group row">

 						<label for="" class="col-sm-1 col-form-label">Address <?=$i?> *</label>

 						<select name="Country<?=$i?>" style="color:#0055a5;"  onchange="StateOfCountry(this.value,<?=$i?>)">
 							<option>Select One Country</option>
 							<?php 
 							foreach ($Countries as $row)
 							{
 								?>
 								<option value="<?=$row->Id?>" <?php echo ($key->Country==$row->Id)?" selected=' selected'":""?>>
 									<?=$row->Country?>
 								</option>
 								<?php
 							}
 							?>
 						</select>	

 					</div>

 					<div class="form-group row">	
 						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
 						<input type="text" name="Street1_<?=$i?>" placeholder="Street" class="fieldLar" value="<?=$key->Street?>" />
 					</div>

 					<div class="form-group row">	
 						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
 						<input type="text" name="Street2_<?=$i?>" placeholder="Street 2" class="fieldLar" value="<?=$key->Street2?>"/>
 					</div>

 					<?php 
 					$ci = &get_instance();
 					$ci->load->model("ContactModel");

 					if($key->Country!=""){
 						$getStates=$ci->ContactModel->StatesOfCountries($key->Country);
 					}
 					?>


 					<div class="form-group row">	

 						<input type="text" name="City<?=$i?>" id="City<?=$i?>" placeholder="City" value="<?=$key->City?>" />
 						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  


 						<select name="State<?=$i?>" class="fieldR" id="State<?=$i?>">
 							<option>Select State</option>
 							<?php 
 							foreach ($getStates as $row)
 							{
 								?>
 								<option value="<?=$row->Id?>" <?php echo ($key->State==$row->Id)?" selected=' selected'":""?>>
 									<?=$row->State?>
 								</option>
 								<?php
 							}
 							?>
 						</select>
 					</div>

 					<div class="form-group row">
 						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
 						<input type="text" name="ZipCode<?=$i?>" id="ZipCode<?=$i?>" placeholder="Zip Code" value="<?=$key->Zipcode?>" />
 					</div>

 					<?php 
 					$i++;
 				}
 				?>


 				<?php 
 				if($totAddressCont>1){

					//$this->load->view("Contacts/moreAddress");
 				}
 				?>

 				<div id="AddressExpansor">


 				</div>

 				<!-- boton add addreess -->
 				<div class="form-group row">
 					<label for="" class="col-sm-1 col-form-label addAdress" onclick="addBorr('<?=$oneContact->Id?>','AjaxContact/AddBorr','address')"  >
 						<span class="addAdresButt"  ></span>Add address</label>  
 					</div>



 					<!--  FIN ADRESS ******************************************--> 









 					<input type="hidden" name="totPhoneCont" id="totPhoneCont"  value="<?=$totPhoneCont?>" />

 					<?php 

 					$i=1;

 					foreach ($phones as $key) {

 						?>
 						<input type="hidden" name="idPhone_<?=$i?>" id="idPhone_<?=$i?>"  value="<?=$key->Id?>" />

 						<div class="form-group row">
 							<label for="" class="col-sm-1 col-form-label">Phone <?=$i?></label>  
 							<input type="text" name="Phone<?=$i?>" id="Phone<?=$i?>" placeholder="555-555-5555"      value="<?=$key->Phone?>" maxlength="12" />
 							<input type="text" name="Ext<?=$i?>"   id="Ext<?=$i?>" class="fieldR" placeholder="Ext." value="<?=$key->Ext?>" />
 						</div>

 						<?php 
 						$i++;
 					} 

 					?>

 					<?php //if($totPhoneCont>1){   $this->load->view("Contacts/morePhone"); }?>

 					<div id="PhoneExpansor"></div>

 					<!-- boton add Phone -->
 					<div class="form-group row">
 						<label for="" class="col-sm-1 col-form-label addAdress" onclick="addBorr('<?=$oneContact->Id?>','AjaxContact/AddBorrPhone','phone')"  >
 							<span class="addAdresButt"></span>Add Phone</label>  
 						</div>





 						<!-- EMAIL -->
 						<input type="hidden" name="totEmailCont" id="totEmailCont"  value="<?php  echo $totEmailCont;   ?>" />

 						<?php 

 						$i=1;

 						foreach ($emails as $key) {

 							?>

 							<input type="hidden" name="idEmail_<?=$i?>" id="idEmail_<?=$i?>"  value="<?=$key->Id?>" />

 							<div class="form-group row">
 								<label for="" class="col-sm-1 col-form-label">Email <?=$i?></label>  
 								<input type="text" name="Email<?=$i?>" id="Email<?=$i?>" class="fieldLar" placeholder="sample@hotmail.com" value="<?=$key->Email?>" />
 							</div>

 							<?php 
 							$i++;
 						} ?>
 						<?php //if($totEmailCont>1){   $this->load->view("Contacts/moreEmail"); }?>
 						<div id="EmailExpansor"></div>

 						<div class="form-group row"> <!-- boton add Email -->
 							<label for="" class="col-sm-1 col-form-label addAdress" onclick="addBorr('<?=$oneContact->Id?>','AjaxContact/AddBorrEmail','email')" >
 								<span class="addAdresButt"></span>Add Email</label>  
 							</div>





 							<script>
 								$( function() {
 									$( "#Birdate" ).datepicker();
 								} );
 							</script>

 							<div class="form-group row">
 								<label for="" class="col-sm-1 col-form-label">Date Of Birth</label>  
 								<input type="text" name="Birdate" id="Birdate" value="<?=decodedate($oneContact->Birdate)?>" />
 							</div>

 							<div class="form-group row">
 								<label for="" class="col-sm-1 col-form-label">Other identifier</label>  
 								<input type="text" name="OtherIdenty" id="OtherIdenty" value="<?=$oneContact->OtherIdentifier?>" />
 							</div>




 							<!-- WEBSITE -->

 							<input type="hidden" name="totWebsiteCont" id="totWebsiteCont"  value="<?php  echo $totWebsiteCont;   ?>" />

 							<?php 
 							$i=1;
 							foreach ($websites as $key) {
 								?>

 								<input type="hidden" name="idWebsite_<?=$i?>" id="idWebsite_<?=$i?>"  value="<?=$key->Id?>" />

 								<div class="form-group row">
 									<label for="" class="col-sm-1 col-form-label"> Website <?=$i?></label>  
 									<input type="text" name="Website<?=$i?>" id="Website<?=$i?>" placeholder="http://yourwebsite.com" class="fieldLar" value="<?=$key->Website?>"/>
 								</div>
 								<?php 
 								$i++;
 							} ?>
 							<?php //if($totWebsiteCont>1){   $this->load->view("Contacts/moreWebsite"); }?>

 							<div id="WebsiteExpansor"></div>

 							<div class="form-group row"> <!-- boton add website -->
 								<label for="" class="col-sm-1 col-form-label addAdress" onclick="addBorr('<?=$oneContact->Id?>','AjaxContact/AddBorrWebsite','website')" >
 									<span class="addAdresButt"></span>Add Website</label>  
 								</div>




 								<div class="clearh1"></div>

 								<div class="form-group row fitButtons ">

 									<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
 									<label for="" class="col-sm-1 col-form-label">&nbsp;</label>

 									<div class="col-md-3">
 										<input  id="save" onclick="updateContact()" type="button" value="Save" class="btn btn-primary btn-lg btn-block"> 
 									</div>

 									<div class="col-md-3">
 										<button onclick="CloseObject('atachTo', 'noreload')" id="cancel" type="button" class="btn btn-primary btn-lg btn-block">Cancel </button>
 									</div>

 									<br>
 									<br>
 									<br>

 									<div class="clearh1"></div>
 								</div>


 							</div>	

 						</div>

 					</form>	