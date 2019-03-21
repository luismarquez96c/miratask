 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("TaskModel");

 ?>


<!-- CONTENIDO MATTERS -->
<script src="<?=base_url()?>js/util.js"></script>


 <?php if(isset($message)){ echo $message; }  ?>

 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3>Task</h3><hr>
 </div>

 <div class="row">
	
	<div class="matterContent">
	<!-- MATTERS -->
		
		<div class="col-md-12 col-sm-12 col-xs-12">
			<form name ="listForm" id="listForm"  action="<?=base_app()?>Task/eraseListConfirm" method="POST" >
					
				<div class="col-xs-12  buttWrap">
					  <!-- boton " + add Matters"-->
					 
						<div class="col-md-2 pl0">
							<a id="add_matters"   class="btn btn-primary btn-lg btn-block" onclick="createTask()" >
								<i class="fa fa-plus"></i> &nbsp; Add Task
							</a>
						</div>
					  

						<!-- boton " Delete Matters" -->
						<div class="col-md-2">
							<input type="submit" id="delete_matters"  class="btn fa-trash btn-block" value="&#xf1f8; Delete Task" style="font-family:Arvo, FontAwesome" />
						</div>

						<div class="col-md-2 pl0">
							<a id="close_matter"  class="btn btn-block" >
							<i class="fa fa-plus"></i> &nbsp; Mark Complete
							</a>
						</div>
						
						<div class="col-md-2 pl0">
							<a onclick="atachTo('Ajax/atachTo')" id="add_matters"   class="btn btn-primary btn-lg btn-block" >
							<i class="fa fa-plus"></i> &nbsp; Attach To
							</a>
						</div>
						
						<div class="col-md-2 pl0">
							<?php
							 
								if($this->session->userdata("showCompleted")=="si"){
									$chek="checked='checked'";
								}else {
									$chek="";
								}								
								
							?>
							 <input type="checkbox" name="showCompleted"  id="showCompleted" <?=$chek?> value=""> Show Completed
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
						<p>Task </p> <span onclick="printTMatters()" class="fa fa-print"></span>
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
								 <li><a href="<?=base_app()?>Task/MAxResultXPage/5">5</a></li>
								 <li><a href="<?=base_app()?>Task/MAxResultXPage/10">10</a></li>
								 <li><a href="<?=base_app()?>Task/MAxResultXPage/15">15</a></li>
								 <li><a href="<?=base_app()?>Task/MAxResultXPage/20">20</a></li>
							</ul>
						</div>
						<div class="resultInfo col-md-4">
							<?=$startItem?>-<?=$endItem?> of <?=$totalTask?> items
						</div>
						<div class="clearh1"></div>
					</div>
					
					
					<div id="resultTable">
						<table  class="table table-bordered table-inverse">
							<thead>
								<tr>
									<th> </th>
									<th>Subject</th>
									<th>Due Date</th>
								 
									<th>Priority</th>
									<th>Est. Time</th>
									<th>Status</th>
									<th>Category</th>
									<th>Staff</th>
								</tr>
							</thead>

						<tbody>
						<?php 
						
						foreach ($Task as $row){ 
							
							//$Subject   = $ci->UserModel->GetAttorney($row->Subject);	
							$Priority  = $ci->TaskModel->Priority($row->Priority);
							$Status    = $ci->TaskModel->Status($row->Status);
							$Category  =$ci->TaskModel->Category($row->Category);

							$relatedStaff = $this->TaskModel->relatedStaff($row->Id);
							
							$totSTF=count($relatedStaff);
							
							 
						?>
						 <tr>
							  <td><input type="checkbox" name="ItemID[]" value="<?=$row->Id?>"></td>
							  <td><a style="cursor:pointer" onclick="detailTask('<?=$row->Id?>')"><?=$row->Subject?></a></td>
							  <td><?=decodedate($row->DueDate)?></td>
							   
							  <td>
							  	<?=$Priority->Name?> 
							  </td>
							  <td><?=$row->EstimatedHours?></td>
							  <td><?=$Status->Status?></td>	
							  <td><?=$Category->Name?></td>
							  <td><?php
								$i=1;
								foreach($relatedStaff as $row){
									
									 echo $row->AtorneyName;
									 
									if($i>0 and $i<$totSTF){ echo ","; }
										
										$i++;
								} 
								?></td>
							   
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
 