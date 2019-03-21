  <?php 
  $ci =&get_instance();
  $ci->load->model("TaskModel");

  ?>




  <script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
  <link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
  <script src="<?=base_url()?>js/util.js"></script>

  <form id="formNewTask" method="post" >




  	<div   class="col-md-12 boxSlider">
  		<div class="Boxtitle">Task Details<span class="close" onclick="CloseObject('taskForm')">x</span> </div>

  		<div class="taskheadButtons btn-group ml-2">

  			<?php 
  			$categoryName=$ci->TaskModel->Category($task->Category);

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

  			<a id="MarkComplete"  <?=$onclicK?> <?=$back?> >
  				Mark Complete
  			</a>

  			<input type="hidden" name="Category" id="Category" value="<?=$task->Category?>" /> 
  			<buttom type="buttom" id="CategoryButt"     data-toggle="dropdown" >

  				<?=$categoryName->Name?>

  			</buttom>


  			<ul class="dropdown-menu btn-block shortbox" role="menu">

  				<?php 
  				foreach($category as $row )
  				{
  					?>
  					<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?>', 'Category', 'CategoryButt' )" > 
  						<span class="colors" style="background:#<?=$row->Color?>" ></span> <?=$row->Name?>   
  					</li>
  					<?php 
  				}
  				?>

  			</ul>

  			<?php 





  			?>

  			<a id="addtime" onclick="add_entry('<?=$MatterForTimeExpen?>')" >
  				Add Time
  			</a>

  			<div class="clearh1"></div>	

  		</div>



  		<div class="TaskallInputWrap">


  			<div id="resultErrors"></div>


  			<div class="clearh1"></div>



  			<div class="form-group row btn-group ml-2">

  				<label>Subject</label> 


  				<input id="Subject" name="Subject" value="<?=$task->Subject?>" type="text" class="largeselect" style="width:435px" /> 

					<!--<button type="button" class="Tcarre" data-toggle="dropdown" >
						<span class="caret"></span> 
					</button>
					
					<ul class="dropdown-menu btn-block" role="menu">
					
					
					
					<?php 
					   foreach($Attorney as $row ){
					?>
					
						<li  onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?> <?=$row->LastName?>', 'Subject', 'SubjectButt' )" > <?=$row->Name?> <?=$row->LastName?> </li>
						
					<?php 
					}
					?>	
					 
				</ul> -->

			</div>
			
			<div class="form-group row">
				<div class="shortSelectWrap1 btn-group ml-2">
					
					
					<label>Priority</label> 

					<?php 
					$PriorityName=$ci->TaskModel->Priority($task->Priority);
					?>

					<button id="PriorityButt" type="button" class="shortSelect" ><?=$PriorityName->Name?></button>

					<input style="z-index: 1000000" type="hidden" name="Priority" id="Priority" value="<?=$task->Priority?>" /> 

					<button style="z-index: 1000000" type="button" class="Tcarre" data-toggle="dropdown" >
						<span class="caret"></span> 
					</button>

					<ul class="dropdown-menu btn-block shortbox" role="menu" style="z-index: 1000000">
						<?php 
						foreach($priority as $row ){
							?>
							<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?>', 'Priority', 'PriorityButt' )" > 
								<span class="colors" style="background:#<?=$row->Color?>" ></span> <?=$row->Name?>   
							</li>
							<?php 
						}
						?>
					</ul>	 

				</div>
				<div class="shortSelectWrap2 btn-group ml-2">

					<label>Status</label> 

					<?php 
					$StatusName=$ci->TaskModel->Status($task->Status);
					?>

					<button id="StatusButt" type="button" class="shortSelect" ><?=$StatusName->Status?></button>
					<input type="hidden" name="Status" id="Status" value="<?=$task->Status?>" /> 

					<button type="button" class="Tcarre" data-toggle="dropdown" >
						<span class="caret"></span> 
					</button>

					<ul class="dropdown-menu btn-block shortbox" role="menu">

						<?php 
						foreach($status as $row ){
							?>							

							<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Status?>', 'Status','StatusButt' )"> <?=$row->Status?> </li>
							
							<?php 
						}
						?>

					</ul>



				</div>	

			</div><!-- fin form group -->




			<div class="form-group row btn-group ml-2">

				<label>Assign To</label> 


				<?php 
				$AtorneyName=$ci->UserModel->GetAttorney($task->AssignTo);
				?>

				<button id="AssignButt" type="button" class="largeselect" ><?=$AtorneyName->Name?> <?=$AtorneyName->LastName?></button>
				<input type="hidden" name="Assign" id="Assign" value="<?=$task->AssignTo?>" /> 

				<button type="button" class="Tcarre" data-toggle="dropdown" >
					<span class="caret"></span> 
				</button>

				<ul class="dropdown-menu btn-block" role="menu">
					
					<?php 
					foreach($Attorney as $row ){
						?>
						
						<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?> <?=$row->LastName?>', 'Assign', 'AssignButt' )"> <?=$row->Name?> <?=$row->LastName?> </li>
						
						<?php 
					}
					?>


				</ul>
			</div>




			<div class="form-group row">
				<div class="shortSelectWrap1 btn-group ml-2" style="z-index: 20000">
					
					
					<script>

						$( "#StartTime" ).datepicker();

					</script>
					
					
					<label>Start Time</label> 
					<input type="date" id="StartTime" name="StartTime" value="<?=date('Y-m-d',strtotime($task->StartDate))?>" class="shortSelect" placeholder="" required=""style="width: 145px !important;" >

					
					<!--<button type="button" class="Tcarre calendarIco" id="StartimeIco">
					</button>-->




				</div>
				<div class="shortSelectWrap2 btn-group ml-2">
					
					
					
					<script>
						

						$( "#EndTime" ).datepicker();

						$("#EndTimeIco").click(function() {
							$("#EndTime").datepicker("show");
						});


					</script>

					<label>End Time</label> 

					<input  id="EndTime"    type="date"   name="EndTime" value="<?=date('Y-m-d',strtotime($task->DueDate))?>" class="shortSelect" style="width: 145px !important;"  />
					<!--<button id="EndTimeIco" type="button" class="Tcarre calendarIco"  ></button>-->





				</div>	

			</div><!-- fin form group -->





			<div class="form-group row btn-group ml-2">

				<label>EstimatedTime</label> 

				<script type="text/javascript">
					function sumDif(oper){

						if(oper=='sum'){


							actualVal=actualVal + 0.1;
									//actualVal=parseFloat(actualVal).toFixed(1);

									$("#EstimatedTime").val(actualVal.toFixed(1));	

								}

								if(oper=='dif'){

									actualVal=actualVal - 0.1;
									//actualVal=parseFloat(actualVal).toFixed(1);

									if(actualVal<0){ actualVal=0; }

									$("#EstimatedTime").val(actualVal.toFixed(1));	
								}
							}

						</script>

						<input id="EstimatedTime" name="EstimatedTime" type="text" value="<?=$task->EstimatedHours?>" class="largeselect" > 

						<a   class="TcarreDle" >

							<li class="c1" onclick="sumDif('sum')"> </li>
							<li class="c2" onclick="sumDif('dif')"> </li>

						</a>


					</div>





				<!-- <div class="form-group row btn-group ml-2">
				 
					<label>Actual Time</label> <label>0</label> 
				</div> -->







				<div class="form-group row btn-group ml-2  ">

					<label>Attach To</label> 


					
					<input   type="text" class="largeselect" value="" onkeyup="ContactAndMAtt(this.value,'_A')" placeholder="Searh for contact or matter "> 

					<a   class="Tcarre">

						<span class="caret" ></span>   

					</a>

					<div class="  dropdown-menu" id="ContactResult_A"></div>





					<div id="ButtonsWrapBox_A" class="ml125">
						<?php



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

							<?php }

							?>


							<!-- ContMAtter_A -->
							<?php if($AddActualMatter=="si"){ ?>

								<!-- ContMAtter_A -->
								<span id="ContMAtterButt38" class="staffItem  btn btn-default btn-xs"> 
									<?=$actualMatter->Name?><span onclick=""> </span>
									<input type="hidden" name="ContMAtter_A[]" value="<?=$actualMatter->Id?>_matter"></span>

								<?php  } ?>


							</div>



						</div>






						<div class="form-group row btn-group ml-2">

							<label>Description</label> 

							<textarea id="Description" name="Description" type="textarea" class="largeselect" placeholder="Type a description"><?=$task->Description?></textarea>
						</div>



						<div class="clearh1"></div>

						<div class="form-group row fitButtons ">

							<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
							<label for="" class="col-sm-1 col-form-label">&nbsp;</label>

							<div class="col-md-3">
								<input  id="save" type="button" value="Save" onclick="updateTask('<?=$task->Id?>')" class="btn btn-primary btn-lg btn-block"> 
							</div>

							<div class="col-md-3">
								<button id="cancel" type="button" class="btn btn-primary btn-lg btn-block" onclick="CloseObject('taskForm')" >Cancel </button>
							</div>

							<br>
							<br>
							<br>

							<div class="clearh1"></div>
						</div>


					</div>	

				</div>

			</form>	

			<div id="modal-event" class="modal fade modal-mira" role="dialog">
				<?php
				$this->load->view('Billing/modal-time-expense');
				?>
			</div>
			<script type="text/javascript">

				function add_entry(id_matter,id_entry){


					$("#modal-event").modal("show");

					$(".modal-backdrop").hide();

			/*if($("#Subject").val()!=""){

				$("#modal-event").modal("show");

					id_entry=(id_entry!=undefined) ? id_entry : 0;
					$.post(base_url+"Billing/time_expense_modal?from=billing",{id_matter:id_matter,id_entry:id_entry},function(response){
					$("#modal-event").html(response);

					$(".modal-backdrop").hide();
				});
			}else{

				$("#resultErrors").html('<span class="red">The Subject field is required.</span>');

			}*/
		}


		function remove_entry(id_entry){
			if(confirm("are you sure that delete this element?")){
				$.post(base_url+"Billing/remove_entry",{id_entry:id_entry},function(data){
					if(data.error==0){
						$('tr[entry="'+id_entry+'"]').fadeOut();
					}else{
						alert("Error. Try later");
					}

				},"json");
			}

		}

		$(".boxSlider").click(function(event) {
			$("#ContactResult_A").hide();
		});
	</script>