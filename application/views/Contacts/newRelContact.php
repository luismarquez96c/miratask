<?php 
	$ci =&get_instance();
	$ci->lang->load($this->session->userdata("lng") , 'labels');
 ?>
<form id="formNewContact" method="post" action="<?=base_app()?>Matters/saveRelContact" >
	
	 
	
		
		<div id="contorno" class="col-md-12 boxSlider">
			<div class="Boxtitle"><?php echo $this->lang->line('windows_9'); ?></div>
			
			<div class="boxheadButtons">
			<?php echo $this->lang->line('windows_10'); ?>
			</div>
				
			<div class="h10"></div>
		
			<div class="allInputContainer">
				
				
				<div class="form-group row">
								
					 <label for="" class="col-sm-1 col-form-label"><?php echo $this->lang->line('windows_11'); ?></label>
					 
					 <div class="col-md-5">
						<input type="text" class="form-control" name="Contact1" id="Contact1" onkeyup="showContacts(this.value,'1')" autocomplete="off" value="<?= set_value('Contact1');?>" placeholder="<?php echo $this->lang->line('windows_12'); ?>   &#xF002" style="font-family:Arial, FontAwesome" required />
						<div class="SearchBox" id="ContactResult1"></div>
						<input type="hidden"     name="ContactID1"   value="<?= set_value('ContactID1');?>" required />
					 </div>

					  
					 <div class="col-md-5">
						<input type="text" id="Relation1" name="Relation1" class="form-control"   placeholder="<?php echo $this->lang->line('windows_13'); ?>" value="<?= set_value('Relation1');?>" required >
						 
					 </div> 
				</div> 
				
				
				
				<div class="ln_solid"></div>
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<input type="submit" value="<?php echo $this->lang->line('matters_32'); ?>" id="save_close"  class="btn btn-primary " > 
						<a id="cancel"  onclick="closeRelContact()" class="btn btn-primary"><?php echo $this->lang->line('matters_33'); ?> </a>
					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	