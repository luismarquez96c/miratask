
<form id="formNewMatterRel" method="post" action="<?=base_app()?>Matters/saveRelMatter" >
	
	 
	
		
		<div id="contorno" class="col-md-12 boxSlider">
			<div class="Boxtitle">Add Matter Relationship </div>
			
			<div class="boxheadButtons">
					Attach an existing Matters by typing the Matter name in the Search field.
			</div>
				
			<div class="h10"></div>
		
			<div class="allInputContainer">
				
				
				<div class="form-group row">
								
					 <label for="" class="col-sm-1 col-form-label">Others Matter *</label>
					 
					 <div class="col-md-5">
						<input type="text" class="form-control" name="Contact1" id="Contact1" onkeyup="SearchMatter(this.value)" autocomplete="off" value="<?= set_value('Contact1');?>" placeholder="Search existing Matter   &#xF002" style="font-family:Arial, FontAwesome" required />
							<div id="MatterWrapBox">
								<?php 
									foreach($relatedMatter as $row){
								?>
								
									<span id="MatterItem<?=$row->IdMatter2?>" class="staffItem btn btn-default btn-xs">
										<?=$row->NameMatter;?>
										<span onclick="removeRelMatter(<?=$row->IdMatter2?>)">X</span>
										<input type="hidden" name="MatterRel[]" value="<?=$row->IdMatter2?>">
									</span>
								
								
								<?php 
								} 
								
								?>
								
								<input type="hidden" name="otherStaf[]" value="'1'">
							
							</div>
							
						<div class="SearchBox" id="MatterResult"></div>
						<input type="hidden"     name="MatterID"   value="" required />
					 </div>

					  
					  
				</div> 
				
				
				
				<div class="ln_solid"></div>
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
						<input type="submit" value="Save and Close" id="save_close"  class="btn btn-primary " > 
						<a id="cancel"  onclick="closeRelContact()" class="btn btn-primary">Cancel </a>
					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	