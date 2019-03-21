
<?php 
 $ci =&get_instance();

 $ci->lang->load($this->session->userdata("lng") , 'labels');
 ?>
<form id="formNewMatterRel" method="post" action="<?=base_app()?>Matters/saveRelMatter" >
	
	 
	
		
		<div id="contorno" class="col-md-12 boxSlider">
			<div class="Boxtitle"><?php echo $this->lang->line('moveto_4'); ?> </div>
			
			<div class="boxheadButtons">
					<?php echo $this->lang->line('moveto_5'); ?>
			</div>
				
			<div class="h10"></div>
		
			<div class="allInputContainer">
				
				
				<div class="form-group row  atachto">
								
					  
					 
					<div class="col-md-8 ">
						<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('document_22'); ?>" name="Contact1" id="Contact1" onkeyup="ContactAndMAtt(this.value,'_B')" autocomplete="off" value="<?= set_value('Contact1');?>" placeholder="Search existing contacts   &#xF002" style="font-family:Arial, FontAwesome; width:100%" required />
							
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
							<?php echo $this->lang->line('moveto_6'); ?>
						</a>


						<a id="cancel"  onclick="closeAtach()" class="btn btn-primary"><?php echo $this->lang->line('moveto_7'); ?></a>
					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	