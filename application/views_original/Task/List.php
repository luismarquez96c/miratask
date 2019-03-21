 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("TaskModel");

 ?>
    <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
 	<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
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
							<a id="add_matters"   class="btn btn-primary btn-lg btn-block" onclick="createTask('','')" >
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
							<a class="boton_filtro btn " onclick="switchx('filtro_wrap')">
								<img src="<?=base_url()?>img/filtro.png" > Filter
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
							<a class="boton_filtro btn ">
							 	<input type="checkbox" style="margin-top"  name="showCompleted"  id="showCompleted" <?=$chek?> value=""> Show Completed
							</a> 
						</div>

						
						
						

				</div><!-- fin  col-xs-12 -->

				<div class="clearh1"></div>


<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->

				
				<div class="filtro_wrap TaskallInputWrap" id="filtro_wrap" style='display:none' >


					
					<div class="col-md-5" style="padding-left: 0px !important;">
						 
						<?php 
						$AtorneyName=$ci->UserModel->GetAttorney($this->session->userdata('taskfilAssig'));

						if(count($AtorneyName)>0){
							$AtorneyName = $AtorneyName->Name." ".$AtorneyName->LastName;
						}

						?>



						<button id="AssignButt" type="button" class="shortSelect" style="width:157px !important;" >
						
						<?=($AtorneyName=="")?" AssignTo":$AtorneyName?>
							
						</button>
						<input type="hidden" name="Assign" id="Assign" value="<?=$task->AssignTo?>" /> 
						
						<button type="button" class="Tcarre" onclick="switchx('list1')">
							<span class="caret"></span>
						</button>
						
						<ul class="dropdown-menu btn-block" id="list1">
						
							<?php  foreach($Attorney as $row ){ ?>
							
							<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?> <?=$row->LastName?>', 'Assign', 'AssignButt' )"> <?=$row->Name?> <?=$row->LastName?> </li>
							
							<?php  } ?>
							
							
						</ul>

					</div><!-- fin asigg to -->





					<div class="col-md-5">
						 
						<?php $PriorityName=$ci->TaskModel->Priority($this->session->userdata('taskfilPriority')); ?>
						
						<button id="PriorityButt" type="button" class="shortSelect" ><?=($PriorityName->Name=="")?" Priority":$PriorityName->Name?></button>
						<input type="hidden" name="Priority" placeholder="Priority"  id="Priority" value="<?=$PriorityName->Id?>" /> 
						
						<button type="button" class="Tcarre"  onclick="switchx('list2')" ><span class="caret"></span></button>
						
						<ul class="dropdown-menu btn-block shortbox" id="list2" >
							<?php foreach($priority as $row ){ ?>
								<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?>', 'Priority', 'PriorityButt' )" > 
									<span class="colors" style="background:#<?=$row->Color?>" ></span> <?=$row->Name?>   
								</li>
							 <?php } ?>
						</ul>

					</div>





					<div class="col-md-5">
						<?php 
							$categoryName=$ci->TaskModel->Category($this->session->userdata('taskfilCategory'));

							$back="";
							$onclicK='';

							if($task->Status==3){

								$back='style="background:#dfdfdf"';
								$onclicK='';

							}elseif($task->Status!=3){

								$back="";
								$onclicK='onclick="markComplete(\''.$task->Id.'\')"';

							}
						?>
						     
						<button id="CategoryButt" type="button" class="shortSelect" ><?=($categoryName->Name=="")?" Category":$categoryName->Name?></button>
						<input type="hidden" name="Category" id="Category" value="<?=$categoryName->Id?>" /> 
						
						<button type="button" class="Tcarre"  onclick="switchx('list3')" ><span class="caret"></span></button>
						
						<ul class="dropdown-menu btn-block shortbox" id="list3" >
							
							<?php foreach($category as $row ){ ?>
								<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?>', 'Category', 'CategoryButt' )" > 
									<span class="colors" style="background:#<?=$row->Color?>" ></span> <?=$row->Name?>   
								</li>
							 <?php } ?>
							
						</ul>
					</div><!-- fin col category -->




					<div class="col-md-5">
						 
						<?php $StatusName=$ci->TaskModel->Status($this->session->userdata('taskfilStatus')); ?>
						     
						<button id="StatusButt" type="button" class="shortSelect" ><?=($StatusName->Name=="")?" Status":$StatusName->Name?></button>
						<input type="hidden" name="Status" id="Status" value="<?=$task->Status?>" /> 
						
						<button type="button" class="Tcarre" onclick="switchx('list4')" ><span class="caret"></span> </button>
						
						<ul class="dropdown-menu btn-block shortbox" id="list4" >
							
							<?php foreach($status as $row ){ ?>							
							 	<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Status?>', 'Status','StatusButt' )"> <?=$row->Status?> </li>
							<?php } ?>
							
						</ul>
					</div><!-- end status -->



					<div class="col-md-5"> <!-- fecha uno -->

						<input type="text" placeholder="Range Date" name="StartTime" id="StartTime" value="<?=$this->session->userdata('taskfilStartTime')?>" class="shortSelect"  />
						<button type="button" class="Tcarre calendarIco" id="StartimeIco"  ></button>
							
						<script>
								$( "#StartTime" ).datepicker();
								$("#StartimeIco").click(function() {
									$("#StartTime").datepicker("show");
								});
						</script>
					

						

					</div>


					<div class="col-md-5">

						<input  id="EndTime"  placeholder="To Date"  type="text"   name="EndTime" value="<?=$this->session->userdata('taskfilEndTime')?>" class="shortSelect"  />
						<button id="EndTimeIco" type="button" class="Tcarre calendarIco"  ></button>
							
						<script>
								$( "#EndTime" ).datepicker();
								$("#EndTimeIco").click(function() {
									$("#EndTime").datepicker("show");
								});

						</script>
						     
							

					</div>	




					<div class="col-md-5" style="margin-right: 0px; padding-right: 0px !important;">
						<a id="save" class="btn btn-block filsearch" style="font-family:Lato, FontAwesome;" onclick="filtro('listForm','Task/filtro')">&nbsp; &#xF002;   </a>
					</div>




					<div class="col-md-5" style="padding-left: 0px !important;  margin-top:10px;" id="ButtonsWrapBox_A">

						<input   type="text" class="shortSelect" style="width:190px !important;" onkeyup="ContactAndMAtt(this.value,'_A')" placeholder="Searh for contact or matter "> 
						<div class="  dropdown-menu" id="ContactResult_A"></div>
						
						
						 
					
					</div><!-- fin search contacta or matter  -->


					<div class="col-md-5" style=" margin-top:10px;" id="ButtonsWrapBox_A">

						
						<div id="ButtonsWrapBox_A" class="ml125">
						<?php
							if(count($relations)>0){
								foreach ($relations as $key  ) { 

										if($key->TypeObject=="matter"){
											$nameObjeto=$ci->MatterModel->selectOne($key->IdObject);
										}elseif($key->TypeObject=="contact"){
											$nameObjeto=$ci->TaskModel->contactRelated($key->IdObject);
										}
							

							?>
									 
										<!-- ContMAtter_A -->
										<span id="ContMAtterButt<?=$key->IdObject?>" class="staffItem  btn btn-default btn-xs"> 
											<?=$nameObjeto->Name?><span onclick="deleteAtach('<?=$key->IdObject?>','<?=$key->TypeObject?>','<?=$task->Id?>'),remHtmlTag('ContMAtterButt<?=$key->IdObject?>'),remHtmlTag('<?=$key->IdObject?>matter')">X</span>
										<input type="hidden" name="ContMAtter_A[]" value="<?=$key->IdObject?>_matter"></span>

						<?php   }
							}

							?>
						</div><!-- fin ButtonsWrapBox -->

					</div><!-- fin contenedoir botones relacion -->

				</div><!-- fin filtro -->


<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->
<!-- filtro ************************************************************************************************************************************************* -->





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
							
							$Staff   = $ci->UserModel->GetAttorney($row->AssignTo);	
							$Priority  = $ci->TaskModel->Priority($row->Priority);
							$Status    = $ci->TaskModel->Status($row->Status);
							$Category  = $ci->TaskModel->Category($row->Category);

							//$relatedStaff = $this->TaskModel->relatedStaff($row->Id);
							
							$totSTF=count($relatedStaff);
							
							 
						?>
						 <tr>
							  <td><input type="checkbox" name="ItemID[]" value="<?=$row->Id?>"></td>
							  <td><a style="cursor:pointer" onclick="detailTask('<?=$row->Id?>','')"><?=$row->Subject?></a></td>
							  <td><?=decodedate($row->DueDate)?></td>
							   
							  <td>
							  	<?=$Priority->Name?> 
							  </td>
							  <td><?=$row->EstimatedHours?></td>
							  <td><?=$Status->Status?></td>	
							  <td><?=$Category->Name?></td>
							  <td><?=$Staff->Name?> <?=$Staff->LastName?></td>
							   
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
 