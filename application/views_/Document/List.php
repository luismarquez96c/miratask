 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("DocumentModel");

 ?>


<!-- CONTENIDO MATTERS -->
<script src="<?=base_url()?>js/util.js"></script>
<script src="<?=base_url()?>js/utildoc.js"></script>


 <?php if(isset($message)){ echo $message; }  ?>

 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3>Document</h3><hr>
 </div>

 <div class="row">
	
	<div class="matterContent">
	<!-- MATTERS -->


		<!-- Menu de categorias  -->
		<div class="col-xs-3 folderNav">
			 
			   
				<div id="folderNavTitle" class="">

					<li class="flderview tablinks" onclick="openCity(event, 'folders_tree')">
						<img src="<?=base_app()?>img/bluefolder.png"  >
					   &nbsp;  Folder view
					</li>

					<li class=" tablinks" onclick="openCity(event, 'documents_tree')">
						<img src="<?=base_app()?>img/blue_category.png">			
						&nbsp; Category
						
					</li>


					<div class="clearfix"></div>
				</div>
				<?php 
				if($this->session->userdata("DocumentActualFol") != "" ){
					$display1='style="display:block"';
					$display2='';
				}elseif($this->session->userdata("DocumentActualCat") != "" ){
					$display1='';
					$display2='style="display:block"';
				}else{
					$display1='style="display:block"';
				}
				?>



				<!-- Folders cat  -->
				<div id="folders_tree" class="tabcontent matCat"   <?=$display1?> >
					
					  

					 <?php 
				 
					foreach($Folders as $row)
					{	

					?>
					<a href="<?=base_app()."Document/ChangeFolder/".$row->Id?>"> 
					    <img src="<?=base_app()?>img/bluefolder.png"  > &nbsp; <?=$row->Name?>
					</a>

					<?php 
					
					}
					
					?>						
					 


				</div>
			 
				<!-- documents cat  -->
				<div id="documents_tree" class="tabcontent matCat " <?=$display2?>>
					
					 
					<a href="<?=base_app()."Document/ChangeCat"?>" style="background:#e9e8e8"> 
						All Documents
					</a>

					<?php 
				 
						foreach($Categories as $row)
						{	
						 
					?>

						<a href="<?=base_app()."Document/ChangeCat/".$row->Id?>"> 
							<?=$row->Name?> <span>(<?=$row->TotalDocs?>)</span>
						</a>
					 <?php 
					
					}
					
					?> 					
					 


				</div>
			 
		</div><!-- fin menu de categorias -->



		
		<div class="col-xs-9 ListWrap">
			<form name ="listForm" id="listForm" action="<?=base_app()?>Document/eraseListConfirm" method="POST" >
					
				<div class="col-xs-12  buttWrap">
					  <!-- boton " + add Folder"-->
					 
						<div class="col-md-3 pl0">
							<a id="add_matters"   class="btn btn-primary btn-lg btn-block" onclick="newFolder()" >
								<i class="fa fa-plus"></i> &nbsp; Add folder
							</a>
						</div>



						<div class="btn-group ml-2 listButtWrap">
							<button id="abc" type="button" class="btn btn-lg btn-secondary">Upload</button>
					      	<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown">
								<span class="caret"></span>
					      	</button>

					      	<ul class="dropdown-menu btn-block" role="menu">
					        	<li onclick="newDocument()">Upload Files/Folders</li>
					        	 
					      	</ul>

						</div>
						




						<div class="btn-group ml-2 listButtWrap">
							<button id="abc" type="button" class="btn btn-lg btn-secondary">More</button>
					      	<button type="button" class="btn btn-secondary dropdown-toggle caret2" data-toggle="dropdown">
								<span class="caret"></span>
					      	</button>

					      	<ul class="dropdown-menu btn-block" role="menu">
					        	<li onclick="atachTo('AjaxDoc/MoveTo')">Move To</li>
					        	<li onclick="atachTo('AjaxDoc/atachTo')">Atach To</li>
					        	 
					      	</ul>

						</div>




						<!-- boton " Delete" -->
						<div class="col-md-3">
							<input type="submit" id="delete_matters"  class="btn fa-trash btn-block" value="&#xf1f8; Delete" style="font-family:Arvo, FontAwesome" />
						</div>
						
						 
						
						

				</div><!-- fin  col-xs-12 -->

				<div class="col-xs-12 wrapMess">
					<?php 
						echo $this->session->userdata("Wmessage");
						     $this->session->set_userdata("Wmessage","");
						?>

				</div>
					
				<!-- all matters title yelllow-->

				<div class="col-xs-12">
					<script type="text/javascript">
						function printTMatters() {
							var divToPrint = document.getElementById('resultTable');
						    var htmlToPrint = '' +
						        '<style type="text/css">' +
						        'table th, table td {' +
						        'border:1px solid #000;' +
						        'padding;0.5em;' +
						        '}' +
						        '</style>';
						    htmlToPrint += divToPrint.outerHTML;
						    newWin = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
						    newWin.document.write(htmlToPrint);
						    newWin.print();
						    newWin.open();
						    newWin.close(); 
						}
					</script>	
					<div class="print">
						<p>Document </p> <span onclick="printTMatters()" class="fa fa-print"></span>
					</div>
				</div>


				<!-- tabla -->

				<div class="col-md-12">
					
					<div class="paginationWrap col-xs-3" > 
						<div class="pagesList col-md-4" ><?php echo $links ?></div> 
						<div class="resxP col-md-4">
							<span class="l">Result per page: &nbsp;</span>
							
							<button   type="button" class="btn btn-default btn-xs br0 l" data-toggle="dropdown">
								
								Change
									<span class="caret"></span>
								
							</button>

							<ul class="dropdown-menu btn-block" role="menu">
								 <li><a href="<?=base_app()?>Document/MAxResultXPage/5">5</a></li>
								 <li><a href="<?=base_app()?>Document/MAxResultXPage/10">10</a></li>
								 <li><a href="<?=base_app()?>Document/MAxResultXPage/15">15</a></li>
								 <li><a href="<?=base_app()?>Document/MAxResultXPage/20">20</a></li>
							</ul>
						</div>
						<div class="resultInfo col-md-4">
							<?=$startItem?>-<?=$endItem?> of <?=$totalDocument?> items
						</div>
						<div class="clearh1"></div>
					</div>
					
					
					<div id="resultTable">
						<table  class="table table-bordered table-inverse">
							<thead>
								<tr>
									<th> </th>
									<th>File Name</th>
									<th>Description</th>
								 
									<th>Category</th>
									<th>Date Modified</th>
									 
								</tr>
							</thead>

						<tbody>
						<?php 
						
						foreach ($Document as $row){ 
							
							$Category  = $ci->DocumentModel->Category($row->Category);
							if($row->Type==".docx" or $row->Type==".doc" or $row->Type==".DOC" or $row->Type==".DOCX" or $row->Type==".rtf" or $row->Type==".RTF"){
								 
								 $Icon='<img src="'.base_url().'img/_doc.png" />'; 

							}elseif($row->Type==".pdf" or $row->Type==".PDF" ){ 

								$Icon='<img src="'.base_url().'img/_pdf.png" />';  

							}elseif($row->Type==".jpg" or $row->Type==".jpeg" or $row->Type==".png" or $row->Type==".PNG" or $row->Type==".JPG" or $row->Type==".JPEG"){ 

								$Icon='<img src="'.base_url().'img/jpg2.png" />'; 

							}else{ 

								$Icon='<img src="'.base_url().'img/video_.png" />'; 

							}

								
						?>
						 <tr>
							  <td><input type="checkbox" name="ItemID[]" value="<?=$row->Id?>"></td>

							  <td>
							  		<a href="<?=base_url()?>docsxup/<?=$row->FileName?>">
							  	   		&nbsp;  <?=$Icon?> &nbsp; 
							  	   	</a>	

							  	   	&nbsp;  

							  	   	<a onclick=" atachTo('AjaxDoc/DocumentDetails/<?=$row->Id?>')"><?=$row->FileName?></a>
							  		
							  </td>
							  <td><?=$row->Description?></td>
							  <td><?=$Category->Name?></td>
							  <td>
							  <?php
							  if($row->DateUpdated!=""){

							  		echo decodedate($row->DateUpdated);

							  }else{
							  		echo "No updated";
							  }
							  ?>
							  	

							  </td> 
							   
							   
						 </tr>
						
						<?php } ?>
						  
						</tbody>
					   </table>
					</div> <!-- fin print table -->   
				</div><!-- fin col-md-9 -->

			</form>	
		</div><!-- fin contenedor de matters -->

	</div><!-- fin clase maters content -->

 </div>
 