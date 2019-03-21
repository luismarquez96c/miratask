
<?php 
$ci =&get_instance();

$ci->lang->load($this->session->userdata("lng") , 'labels');
?>
<form id="formNewMatterRel" method="post" action="<?=base_app()?>Matters/saveRelMatter" >
	
	
	
	
	<div id="contorno" class="col-md-12 boxSlider">
		<div class="Boxtitle"><?php echo $this->lang->line('moveto_1'); ?> </div>
		
		<div class="boxheadButtons">
			<?php echo $this->lang->line('moveto_2'); ?>
		</div>
		
		<div class="h10"></div>
		
		<div class="allInputContainer">
			

			
			<!-- Folders cat  -->
			<div id="folders_tree" class="tabcontent matCat"   style="display:block">
				
				

				<?php 
				
				foreach($Folders as $row)
				{	

					?>
					<a onclick="moveToFolder(<?=$row->Id?>)" > 
						<img src="<?=base_app()?>img/bluefolder.png"  > &nbsp; <?=$row->Name?>
					</a>

					<?php 
					
				}
				
				?>						
			</div>


			<div class="ln_solid"></div>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
					<a id="cancel"  onclick="closeAtach()" class="btn btn-primary"><?php echo $this->lang->line('moveto_3'); ?> </a>
				</div>
			</div>
			
			
			
			
		</div>	
		
		
		
	</div>
	
	<div class="clearh50"></div>

</form>	