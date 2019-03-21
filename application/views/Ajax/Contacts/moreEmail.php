<?php 

	for($i=2;$i<=$totEmailCont;$i++)
	{
	?>
	
	<div class="form-group row">
		<label for="" class="col-sm-1 col-form-label"> Email <?=$i?></label>  
		<input type="text" name="Email<?=$i?>" id="Email<?=$i?>" placeholder="sample@hotmail.com" class="fieldLar" value="<?=set_value('Email'.$i)?>"/>
	</div>
	
	<?php 
	}
	?>