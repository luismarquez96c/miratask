  <?php 
  $ci =&get_instance();
  $ci->load->model("DocumentModel");

  ?>



  

  <div id=" " class="col-md-12 boxSlider">

  	<div class="BoxtitleGray">
  		<img src="<?=base_url()?>img/gray_folder.png"> &nbsp; <?=$Document->FileName?>  <span onclick="CloseObject('atachTo')" >X</span>
  	</div>
  	
  	<div class="boxheadButtons">
  		
  	</div>
  	
  	<div class="clearh50"></div>

  	
  	<div class="TaskallInputWrap allInputContainer">

  		<form id="formNewDocs">

  			<div id="listErrors"></div>

  			<div class="form-group row btn-group ml-2  " >
  				
  				<label>Select folder </label> 

  				

  				<div class="btn-group ml-2  foldWrap" >
  					<?php 
  					if($Document->Folder==""){
  						$folder="Select Folder";
  					}else{

  						$folder=$ci->DocumentModel->getOneWhere($Document->Folder,"ml_do_folders");
  						$folder=$folder->Name;
  					}
  					?>		
  					
  					<div id="folderSelector"   class="largeselect"  style="margin-left:25px;" ><?=$folder?></div>
  					<button type="button" class="btn btn-secondary dropdown-toggle Tcarre" data-toggle="dropdown" aria-expanded="false" style="width:50px;">
  						<span class="caret"></span>
  					</button>

  					<ul class="dropdown-menu btn-block" role="menu">
  						<?php 
  						
  						foreach($Folders as $row)
  						{	

  							?>
  							<li onclick="ChangeFolder('<?=$row->Id?>','<?=$row->Name?>', 'folderSelector' )"  ><?=$row->Name?></li>
  							<?php
  						}
  						?>
  					</ul>

  				</div>
  			</div>

  			

  			<div class="form-group row btn-group ml-2  ">
  				
  				<label>Attach To</label> 

  				<input id="EstimatedTime" class="largeselect" value="" onkeyup="ContactAndMAtt(this.value,'_A')" placeholder="Searh for contact or matter " type="text"> 

  				<a class="Tcarre">

  					<span class="caret"></span>   

  				</a>

  				<div class="  dropdown-menu" id="ContactResult_A"></div>

  				<div id="ButtonsWrapBox_A" class="ml125">
  					<!-- ContMAtter_A -->
  					<?php

							//print_r($relations);
  					

  					foreach ($relations as $key  ) { 

  						if($key->TypeObject=="matter"){
  							$nameObjeto=$ci->MatterModel->selectOne($key->IdObject);
  						}elseif($key->TypeObject=="contact"){
  							$nameObjeto=$ci->TaskModel->contactRelated($key->IdObject);
  						}
  						


  						?>
  						
  						<!-- ContMAtter_A -->
  						<span id="ContMAtterButt<?=$key->IdObject?>" class="staffItem  btn btn-default btn-xs"> 
  							<?=$nameObjeto->Name?><span onclick="deleteAtachDoc('<?=$key->IdObject?>','<?=$key->TypeObject?>','<?=$Document->Id?>'),remHtmlTag('ContMAtterButt<?=$key->IdObject?>'),remHtmlTag('<?=$key->IdObject?>matter')">X</span>
  							<input type="hidden" name="ContMAtter_A[]" value="<?=$key->IdObject?>_matter"></span>

  						<?php } ?>
  					</div>

  				</div>

  				

  				<div class="form-group row btn-group ml-2">
  					
  					<label>Description</label> 
  					
  					<textarea id="Description" name="Description" type="textarea" class="largeselect" placeholder="Type a description"><?=$Document->Description?></textarea>
  				</div>
  				
  				
  				<div class="clearh50"></div>
  				<div class="form-group">
  					<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

  						<a onclick="saveDataOfDoc()" type="button"   id="save_close_atach"  class="btn btn-primary " > 
  							Save and Close
  						</a>


  						<a id="cancel"  onclick="CloseObject('atachTo')" class="btn btn-primary">Cancel </a>
  					</div>
  				</div>
  				
  				
  			</form>	
  			
  		</div>	<!-- fin intput container --> 
  		
  		
  		
  	</div>
  	
  	<div class="clearh50"></div>
  	
  	