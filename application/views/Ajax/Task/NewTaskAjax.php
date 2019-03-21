 

<script src="<?php echo base_url(); ?>js/jquery-ui/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css">  

<form id="formNewTask" method="post" >
	

	

	<div   class="col-md-12 boxSlider">
		<div class="Boxtitle">Add Task <span class="close" onclick="CloseObject('taskForm')">x</span> </div>

		<div class="taskheadButtons btn-group ml-2">


			<a id="MarkComplete" style="background:#dfdfdf; cursor: no-drop;  "  >
				Mark Complete
			</a>
			<input type="hidden" name="Category" id="Category" value="" /> 
			<buttom type="buttom" id="CategoryButt"     data-toggle="dropdown" >

				Category

			</buttom>
			<ul class="dropdown-menu btn-block shortbox" role="menu">

				<?php 
				foreach($category as $row ){
					?>
					<li onclick="thisSelect('<?=$row->Id?>', '<?=$row->Name?>', 'Category', 'CategoryButt' )" > 
						<span class="colors" style="background:#<?=$row->Color?>" ></span> <?=$row->Name?>   
					</li>
					<?php 
				}
				?>

			</ul>



			<a id="addtime" onclick="add_entry(0)">
				Add Time
			</a>

			<div class="clearh1"></div>	

		</div>


		
		<div class="TaskallInputWrap">


			<div id="resultErrors"></div>


			<div class="clearh1"></div>



			<div class="form-group row btn-group ml-2">

				<label>Subject*</label> 


				<input id="Subject" name="Subject" type="text" class="largeselect" style="width:435px" /> 

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

					<button id="PriorityButt" type="button" class="shortSelect" >Normal</button>
					<input type="hidden" name="Priority" id="Priority" value="" /> 

					<button type="button" class="Tcarre" data-toggle="dropdown" >
						<span class="caret"></span> 
					</button>

					<ul class="dropdown-menu btn-block shortbox" role="menu">
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

					<button id="StatusButt" type="button" class="shortSelect" >Not Started</button>
					<input type="hidden" name="Status" id="Status" value="1" /> 

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

				<button id="AssignButt" type="button" class="largeselect" >Select User</button>
				<input type="hidden" name="Assign" id="Assign" value="" /> 

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
				<!--<style>
				.container-user-new{
					padding-left: 100px;
				}

				.container-user-new .text-center{
					width: 425px;
					margin-left: 33px;
				}
			</style>
			<div id="ContactResult_VU" class="hidden">
				
			</div>-->
		</div>




		<div class="form-group row">
			<div class="shortSelectWrap1 btn-group ml-2">



				<script>
					$( function() {
						$( "#StartTime2" ).datepicker();
					} );
				</script>

				<label>Start Time</label> 

				<input type="date" name="StartTime" id="StartTime2" value="" class="shortSelect" style="width: 145px !important;" />
				<!--<button type="button" class="Tcarre calendarIco" id="StartimeIco2"   >-->

				</button>




			</div>
			<div class="shortSelectWrap2 btn-group ml-2">





				<label>End Time</label> 

				<input id="EndTime2" type="date" name="EndTime" value="" class="shortSelect" style="width: 145px !important;"/>
				<!--<button id="EndTimeIco2" type="button" class="Tcarre calendarIco"  ></button>-->





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

						<input id="EstimatedTime" name="EstimatedTime" type="text" class="largeselect" > 

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


					
					<input id=""  type="text" class="largeselect" value="" onkeyup="ContactAndMAtt(this.value,'_A')" placeholder="Searh for contact or matter "> 

					<a   class="Tcarre"> <span class="caret" ></span> </a>

					<div class="dropdown-menu" id="ContactResult_A"></div>





					<div id="ButtonsWrapBox_A" class="ml125">
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

						<textarea id="Description" name="Description" type="textarea" class="largeselect" placeholder="Type a description"></textarea>
					</div>
















					<div class="clearh1"></div>

					<div class="form-group row fitButtons ">

						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>
						<label for="" class="col-sm-1 col-form-label">&nbsp;</label>

						<div class="col-md-3">
							<a  id="save"  onclick="saveTask()" class="btn btn-primary btn-lg btn-block">Save <img id="lodimg" src="<?=base_url()?>img/loading_blue.gif"></a> 
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
			<div class="loading-modal"></div>
		</div>
		<script type="text/javascript">

			function add_entry(id_matter,id_entry){

				if($("#Subject").val()!=""){

					$("#modal-event").modal("show");

					id_entry=(id_entry!=undefined) ? id_entry : 0;
					$.post(base_url+"Billing/time_expense_modal?from=billing",{id_matter:id_matter,id_entry:id_entry},function(response){
						$("#modal-event").html(response);

						$(".modal-backdrop").hide();
					});
				}else{

					$("#resultErrors").html('<span class="red">The Subject field is required.</span>');

				}
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
		</script>




