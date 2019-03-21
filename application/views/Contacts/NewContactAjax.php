<?php 
$ci =&get_instance();

$ci->lang->load($this->session->userdata("lng") , 'labels');
?>
<style>
#contenedor-busqueda{
	position: absolute;
	z-index: 60;
	/*top: 519px;
	left: 183px;*/
	width: 209px;

}
#contenedor-busqueda2{
	position: absolute;
	z-index: 60;
	/*top: 519px;
	left: 393px;*/
	width: 208px;
}
</style>
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

				if (numbersArray[3]=='Bussiness') {
					$('input[name="'+fieldContactID+'"]').val(numbersArray[2]);
					$('input[name="'+fieldContactName+'"]').val(numbersArray[4]);
				}else{

					$('input[name="'+fieldContactID+'"]').val(numbersArray[2]);
					$('input[name="'+fieldContactName+'"]').val(numbersArray[1]);

				}
				$("#newContactForm").hide();
				$("#fadeBlack").hide();
				$("#newContactForm").hide();
				current = (window.location.href).split('/');
				if(current[3] == 'Contacts'){
					location.reload();
				}
				
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
		<div class="Boxtitle"><?php echo $this->lang->line('contacts_12'); ?></div>
		
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
				<input type="radio" name="Class" value="Individual" <?=$radio1?>  onclick="addFieldIndividual()" ><?php echo $this->lang->line('contacts_13'); ?>
			</div>
			
			<div class="btn-group ml-2 ml50">		
				<input type="radio" name="Class" value="Business-Org" <?=$radio2?> onclick="RemoveFieldIndividual()"  class="ml50" ><?php echo $this->lang->line('contacts_14'); ?>
			</div>
			
			<div class="btn-group ml-2 ml50">

				<button id="GroupContactsButt" type="button" class="btn btn-lg btn-secondary"><?php echo $this->lang->line('contacts_5'); ?></button>
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

					<button id="OwnerButt" type="button" class="btn btn-lg btn-secondary SelectOwn"  ><?php echo $this->lang->line('contacts_41'); ?></button>
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
						
						<!--<div class="form-group row">	
							<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_15'); ?></label>  
							<input type="text" name="Tittle" id="Tittle" value="<?=set_value('Tittle')?>" />
						</div>-->
						
						<div class="form-group row">
							<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_16'); ?></label> 
							<input type="text" name="Name"     placeholder="<?php echo $this->lang->line('contacts_17'); ?>"  value="<?=set_value('Name')?>" />
							<input type="text" name="Middle"   placeholder="<?php echo $this->lang->line('contacts_19'); ?>" class="fieldR"	value="<?=set_value('Middle')?>" />
						</div>

						<div class="form-group row">	
							<input type="text" name="LastName" id="LastName" placeholder="<?php echo $this->lang->line('contacts_18'); ?>" value="<?=set_value('LastName')?>" />
							<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
							<input type="text" name="Suffix" id="Suffix" placeholder="<?php echo $this->lang->line('contacts_20'); ?>" class="fieldR" value="<?=set_value('Suffix')?>" />
						</div>	
						
						<div class="form-group row"> 
							
						</div>	
						
						<div class="form-group row"> 
							
						</div>
						
						<div class="form-group row">	
							<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_21'); ?></label>  
							<input type="text" name="Profession" id="Profession" value="<?=set_value('Profession')?>" />
						</div>
						
					</div><!-- fin individual section -->
					
					<div class="form-group row">	
						<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_22'); ?></label>  
						<input type="text" name="Company" autocomplete="off" id="Company" value="<?=set_value('Company')?>" />
					</div>
					
					<div class="form-group row">	
						<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_23'); ?></label>  
						<input type="text" name="ClientID" id="ClientID" value="<?=set_value('ClientID')?>" />
					</div>
					
					
					
					
					
					<!-- *****************************ADRESS************************ -->
					
					<input type="hidden" name="totAddressCont" id="totAddressCont"  value="<?php  echo $totAddressCont;   ?>" />
					<div class="form-group row">

						

						<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_25'); ?></label>
						<div class="col-sm-4" style="padding: 0px">
							<input type="hidden" name="Country1">
							<input type="text" id="pais_search" autocomplete="off" placeholder="<?php echo $this->lang->line('contacts_25'); ?>">
							<div id="contenedor-busqueda" class="hidden">
								<ul class="list-group paises-get">

								</ul>
							</div>
						</div>
						<div class="col-sm-4" style="padding: 0px;">
							<input type="hidden" name="State1" >
							<input type="text" id="estado" autocomplete="off" placeholder="<?php echo $this->lang->line('billing_45'); ?>" disabled="">
							<div id="contenedor-busqueda2" class="hidden">
								<ul class="list-group estados-get">
								</ul>
							</div>	
						</div>

						

					</div>
					
					<div class="form-group row">	
						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
						<input type="text" name="Street1_1" placeholder="<?php echo $this->lang->line('contacts_26'); ?>" class="fieldLar" value="<?=set_value('Street1_1')?>" />
					</div>
					
					<div class="form-group row">	
						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
						<input type="text" name="Street2_1" placeholder="<?php echo $this->lang->line('contacts_27'); ?>" class="fieldLar" value="<?=set_value('Street2_1')?>"/>
					</div>
					
					<?php 
					$ci = &get_instance();
					$ci->load->model("ContactModel");
					
					if(set_value('Country1')!=""){
						$getStates=$ci->ContactModel->StatesOfCountries(set_value('Country1'));
					}
					?>
					
					
					<div class="form-group row">	
						
						<input type="text" name="City1" id="City1" placeholder="<?php echo $this->lang->line('contacts_28'); ?>" value="<?=set_value('City1')?>" />
						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
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
							<span class="addAdresButt"  ></span><?php echo $this->lang->line('contacts_31'); ?></label>  
						</div>
						<!--  FIN ADRESS --> 
						
						
						
						
						
						
						<input type="hidden" name="totPhoneCont" id="totPhoneCont"  value="<?php  echo $totPhoneCont;   ?>" />
						
						<div class="form-group row">
							<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_32'); ?></label>  
							<input type="text" name="Phone1" id="Phone1" placeholder="503-7777-7777"    value="<?=set_value('Phone1')?>" maxlength="12" />
							<input type="text" name="Ext1" id="Ext1" class="fieldR" placeholder="Extención" value="<?=set_value('Ext1')?>" />
						</div>
						
						<?php if($totPhoneCont>1){   $this->load->view("Contacts/morePhone"); }?>
						
						<div id="PhoneExpansor"></div>
						
						<!-- boton add Phone -->
						<div class="form-group row">
							<label for="" class="col-sm-1 col-form-label addAdress" onclick="addPhoneField()"  ><span class="addAdresButt"></span><?php echo $this->lang->line('contacts_33'); ?></label>  
						</div>
						
						
						
						
						
						<!-- EMAIL -->
						<input type="hidden" name="totEmailCont" id="totEmailCont"  value="<?php  echo $totEmailCont;   ?>" />
						<div class="form-group row">
							<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_34'); ?></label>  
							<input type="text" name="Email1" id="Email1" class="fieldLar" placeholder="usuario@hotmail.com" value="<?=set_value('Email1')?>" />
						</div>
						
						<?php if($totEmailCont>1){   $this->load->view("Contacts/moreEmail"); }?>
						
						<div id="EmailExpansor"></div>
						
						<div class="form-group row"> <!-- boton add Email -->
							<label for="" class="col-sm-1 col-form-label addAdress" onclick="addEmailField()" ><span class="addAdresButt"></span><?php echo $this->lang->line('contacts_35'); ?></label>  
						</div>
						
						
						
						
						
						<script>
							$( function() {
								$( "#Birdate" ).datepicker();
							} );
						</script>
						
						<!--<div class="form-group row only-individual">
							<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_36'); ?></label>  
							<input type="text" name="Birdate" id="Birdate" value="<?=set_value('Birdate')?>" />
						</div>-->

						
						
						
						
						<!-- WEBSITE -->
						
						<input type="hidden" name="totWebsiteCont" id="totWebsiteCont"  value="<?php  echo $totWebsiteCont;   ?>" />
						
						<div class="form-group row">
							
							<label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('contacts_38'); ?></label>  
							<input type="url" name="Website1" id="Website1" placeholder="http://sitioweb.com" class="fieldLar" value="<?=set_value('Website1')?>"/>
						</div>
						
						<?php if($totWebsiteCont>1){   $this->load->view("Contacts/moreWebsite"); }?>
						
						<div id="WebsiteExpansor"></div>
						
						<div class="form-group row"> <!-- boton add website -->
							<label for="" class="col-sm-1 col-form-label addAdress" onclick="addWebsiteField()" ><span class="addAdresButt"></span><?php echo $this->lang->line('contacts_39'); ?></label>  
						</div>
						
						
						
						
						<div class="clearh1"></div>
						
						<div class="form-group row fitButtons ">
							
							<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
							<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
							
							<div class="col-md-3">
								<input  id="save" type="button" value="<?php echo $this->lang->line('contacts_40'); ?>" class="btn btn-primary btn-lg btn-block"> 
							</div>

							<div class="col-md-3">
								<button id="cancel" type="button" class="btn btn-primary btn-lg btn-block"><?php echo $this->lang->line('task_31'); ?></button>
							</div>

							<br>
							<br>
							<br>
							
							<div class="clearh1"></div>
						</div>
						
						
					</div>	
					
				</div>

			</form>	

			<script>
				function asignar_nombre(id,nombre) {
					$('[name="Country1"]').val(id);
					$('#pais_search').val(nombre);
					$('#contenedor-busqueda').removeClass('hidden')
					$('.paises-get').html(' ');
				}

				function asignar_nombre_state(id,nombre) {
					$('[name="State1"]').val(id);
					$('#estado').val(nombre);
					$('#contenedor-busqueda2').removeClass('hidden');
					$('.estados-get').html(' ');
				}

				$('#pais_search').keyup(function() {
					var text = $(this).val();
					$.ajax({
						url: base_url+'AjaxContact/getPaisSerch',
						type: 'POST',
						dataType: 'JSON',
						data: {pais: text},
						success:function(paises){
							var html = '';
							for (var i = 0; i < paises.length; i++) {
								html += '<li class="list-group-item" onclick="asignar_nombre('+paises[i].Id+',\''+paises[i].Nombre+'\')">'+paises[i].Nombre+'</li>';
							}
							$('#contenedor-busqueda').removeClass('hidden');
							$('.paises-get').html(html);
							$('#estado').removeAttr('disabled');
						}
					})
					
				});

				$('#estado').keyup(function() {
					var text = $(this).val();
					var pais = $('[name="Country1"]').val();
					$.ajax({
						url: base_url+'AjaxContact/getStates',
						type: 'POST',
						dataType: 'JSON',
						data: {pais: pais, texto: text},
						success:function(estados){
							var html = '';
							for (var i = 0; i < estados.length; i++) {
								html += '<li class="list-group-item" onclick="asignar_nombre_state('+estados[i].Id+',\''+estados[i].State+'\')">'+estados[i].State+'</li>';
							}
							$('#contenedor-busqueda2').removeClass('hidden');
							$('.estados-get').html(html);
						}
					})
					
				});

			</script>