
<form id="formNewMatterRel" method="post" action="<?=base_app()?>Matters/saveRelMatter" >
	
	 
	
		
		<div id="contorno" class="col-md-12 boxSlider">
			<div class="Boxtitle">Attach Existing Record </div>
			
			<div class="boxheadButtons">
					Attach to a contact  or matter by typing the name in the "Search field".
			</div>
				
			<div class="h10"></div>
		
			<div class="allInputContainer">
				
				
				<div class="form-group row  atachto">
								
					  
					 
					<div class="col-md-8 ">
						<input type="text" class="form-control" placeholder="Search for Contact or Matter" name="Contact1" id="Contact1" onkeyup="ContactAndMAtt(this.value,'_B')" autocomplete="off" value="<?= set_value('Contact1');?>" placeholder="Search existing contacts   &#xF002" style="font-family:Arial, FontAwesome; width:100%" required />
							
						<div class="SearchBox dropdown-menu" id="ContactResult_B"></div>
					 
						<div id="ButtonsWrapBox_B" class="">
							<!-- ContMAtter_B -->
						</div>

					</div>
 
				</div> 
				
				
				
				<div class="ln_solid"></div>
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

						<a onclick="AtachList('AjaxDoc/AtachList')" type="button"   id="save_close_atach"  class="btn btn-primary " > 
							Save and Close
						</a>


						<a id="cancel"  onclick="closeAtach()" class="btn btn-primary">Cancel </a>
					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	