<?php 
$ci = &get_instance();
$ci->load->model("ContactModel");
for($i=2;$i<=$totAddressCont;$i++){
	?>
	
	<input type="hidden" name="totAddressCont" id="totAddressCont"  value="<?php  echo $totAddressCont;   ?>" />
				<div class="form-group row">	
					<label for="" class="col-sm-1 col-form-label">Address <?=$i?>  </label>
					
					<select name="Country<?=$i?>" style="color:#0055a5;"  onchange="StateOfCountry(this.value, '1')" >
						 <option>Select One Country</option>
						 <?php 
							foreach ($Countries as $row)
							{
							?>
								<option value="<?=$row->Id?>" <?php echo (set_value('Country'.$i)==$row->Id)?" selected=' selected'":""?>><?=$row->Country?></option>
							<?php
							}
						?>
					</select>	
				</div>
				
				<div class="form-group row">	
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
					<input type="text" name="Street1_<?=$i?>" placeholder="Street" class="fieldLar" value="<?=set_value('Street1_'.$i)?>" />
				</div>
				
				<div class="form-group row">	
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
					<input type="text" name="Street2_<?=$i?>" placeholder="Street 2" class="fieldLar" value="<?=set_value('Street2_'.$i)?>" />
				</div>
				<div class="form-group row">	
					<input type="text" name="City<?=$i?>" id="City<?=$i?>" placeholder="City"  value="<?=set_value('City'.$i)?>"  />
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
					
					<?php 
					$getStates=$ci->ContactModel->StatesOfCountries(set_value('Country'.$i));
					?>
					
					<select name="State<?=$i?>" class="fieldR" id="State1">
					
					
					
						 <option>Select State</option>
						 
						 <?php 
							foreach ($getStates as $row)
							{
							?>
								<option value="<?=$row->Id?>" <?php echo (set_value('State'.$i)==$row->Id)?" selected=' selected'":""?>>
									<?=$row->State?>
								</option>
							<?php
							}
						?>
						 
						 
					</select>
					
				</div>
				
				<div class="form-group row">
					<label for="" class="col-sm-1 col-form-label">&nbsp;</label>  
					<input type="text" name="ZipCode<?=$i?>" id="ZipCode<?=$i?>" placeholder="Zip Code" value="<?=set_value('ZipCode'.$i)?>"  />
				</div>
	
<?php
  }

?>