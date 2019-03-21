<?php 
$ci =&get_instance();

$ci->lang->load($this->session->userdata("lng") , 'labels');
?>
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

</div>