<?php 

	for($i=2;$i<=$totWebsiteCont;$i++)
	{
	?>
	
	<div class="form-group row">
		<label for="" class="col-sm-1 col-form-label"> Website <?=$i?></label>  
		<input type="text" name="Website<?=$i?>" id="Website<?=$i?>" placeholder="http://yourwebsite.com" class="fieldLar" value="<?=set_value('Website'.$i)?>"/>
	</div>
	
	<?php 
	}
	?>