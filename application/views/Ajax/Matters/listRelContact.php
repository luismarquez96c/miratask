<?php
	
	for($i=2;$i<=$totalothers;$i++) 
	{
		?>
		
		
		<div class="form-group row">
								
			 <label for="" class="col-sm-1 col-form-label">Others Contact *</label>
			 
			 <div class="col-md-5">
				<input type="text" class="form-control" name="Contact<?=$i?>" onkeyup="showContacts(this.value,'<?=$i?>')" autocomplete="off" value="<?= set_value('Contact'.$i);?>" placeholder="Search existing contacts   &#xF002" style="font-family:Arial, FontAwesome" />
				<div class="SearchBox" id="ContactResult<?=$i?>"></div>
				<input type="hidden"     name="ContactID<?=$i?>"   value="<?= set_value('ContactID'.$i);?>" />
			 </div>

			  
			 <div class="col-md-5">
				<input type="text" id="Relation<?=$i?>" name="Relation<?=$i?>" class="form-control"   placeholder="Relationship to Matter" value="<?= set_value('Relation'.$i);?>">
				 
			 </div>
			 
			 
			 
		</div>
		
		
	<?php 
	}
	
	//echo "<br>Other contacta related view<br>";

?>