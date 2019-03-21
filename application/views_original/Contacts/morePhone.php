<?php 

	for($i=2;$i<=$totPhoneCont;$i++)
	{
	?>
	
	 
	
	<div class="form-group row">
		<label for="" class="col-sm-1 col-form-label">Phone <?=$i?></label>  
		<input type="text" name="Phone<?=$i?>" id="Phone<?=$i?>" placeholder="555-555-5555"    value="<?=set_value('Phone'.$i)?>" />
		<input type="text" name="Ext<?=$i?>" id="Ext<?=$i?>" class="fieldR" placeholder="Ext." value="<?=set_value('Ext'.$i)?>" />
	</div>
	
	<?php 
	}
	?>