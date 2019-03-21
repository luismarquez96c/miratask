<?php 
 $ci =&get_instance();

 $ci->lang->load($this->session->userdata("lng") , 'labels');
 ?>
<form id="formNewFolder" method="post"  >

		<div id="contorno" class="col-md-12 boxSlider">

			<div class="BoxtitleGray">
				<img src="<?=base_url()?>img/gray_folder.png"> &nbsp;<?php echo $this->lang->line('document_14'); ?>  <span onclick="CloseObject('newFolder')" >X</span>
			</div>
			
			<div class="boxheadButtons">
					 
			</div>
				
			 <div class="clearh50"></div>

		
			<div class="allInputContainer">

				
				
				
				<div class="form-group row  atachto">

					<?php echo validation_errors('<span class="error">', '</span>'); ?>
			 		<div class="clearh1"></div>									
					  
					 <label class="col-sm-1 col-form-label" > <?php echo $this->lang->line('document_15'); ?></label>

					<div class="col-md-8 ">

						<input type="text" class="form-control" placeholder="<?php echo $this->lang->line('document_16'); ?>" name="FolderName" id="FolderName" autocomplete="off"  placeholder="Search existing contacts   &#xF002" style="font-family:Arial, FontAwesome; width:100%"   />
							
					</div>

					  
					  
				</div> 
				
				
				<div class="clearh50"></div>
				 
				<div class="form-group">
					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

						<a onclick="SaveFolder()" type="button"   id="save_close_atach"  class="btn btn-primary " > 
						<?php echo $this->lang->line('document_17'); ?>
						</a>


						<a id="cancel"  onclick="CloseObject('newFolder')" class="btn btn-primary"><?php echo $this->lang->line('document_18'); ?></a>
					</div>
				</div>
				
				
				
				
			</div>	
			
			
		
		</div>
		
		<div class="clearh50"></div>

	</form>	