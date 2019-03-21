 <?php 
	$ci =&get_instance();
	$ci->load->model("ContactModel");
	$ci->load->model("MatterModel");
 ?>

<script src="<?=base_url()?>js/contactAjax.js"></script>
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 
<script src="<?=base_url()?>js/util.js"></script>

<script>
 $( function() {
    $( "#DateOpened" ).datepicker();
  } );
</script>
<!-- CONTENIDO Contacts -->



 <div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3>Billing codes</h3><hr>
 </div>

 <div class="row">
	
	<div class="matterContent">
		<!-- Contacts -->
		
		<div class="col-md-3 panel_cat">
			<div class="x_panel">
				<!-- matter cat  -->
				<div id=" " class="tabcontent matCat usRate " style="display: block;">
					<?php $this->load->view("User/menu"); ?>	
					<div class="clearh1"></div>
				</div>
			</div>
		</div>	 


	 <?php 
		$ci =&get_instance();
		$ci->load->model("UserModel");
	 
	 ?>


	<?php $status_op=array("1"=>"Uninvoiced","2"=>"Invoiced","3"=>"Paid" ); ?>


		<div class="col-xs-9 ListWrap">			
			<form name ="listForm" id="listForm"  action="<?=base_app()?>Billing/changeStatusList" method="POST" >
				<input type="hidden" name="actionButt" value="" /> 
				<div class="row">
					<div class="col-xs-12  buttWrap">
						<!-- boton " + add Matters"-->

						<div class="col-md-3 pl0">
							<a id="add_matters"   class="btn btn-primary btn-lg btn-block" onclick="new_billingcode()" >
								<i class="fa fa-plus"></i> &nbsp; Add Billing Code
							</a>
						</div>


						<!-- boton " Delete Matters" -->
						 <div class="col-md-3 pl0">
							<a type="button" id="add_matters"  class="btn  act btn-lg btn-block"     >Activate</a>
						</div> 
						<div class="col-md-3 pl0">
							<a type="button" id="add_matters"  class="btn deact btn-lg btn-block"    >Deactivate</a>
						</div> 

					</div><!-- fin  col-xs-12 -->

				</div>
				<br />

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
					<?php 
						echo $this->session->userdata("Wmessage");
						echo $this->session->userdata("message");
					?>	
					<div class="print">
						<p>Billing Codes </p> <span onclick="printTMatters()" class="fa fa-print"></span>
					</div>
				</div>


				<!-- tabla -->

				<div class="col-md-12">

					<div class="paginationWrap" > 
						<div class="pagesList col-md-4" >
						 
						 <?php echo $links ?>

					</div> 
					<div class="resxP col-md-4">
						<span class="l">Result per page: &nbsp;</span>

						<button   type="button" class="btn btn-default btn-xs br0 l" data-toggle="dropdown" style="width: 70px">
							<?=$this->session->userdata("codesxpage")?>
							
							<span class="caret"></span>

						</button>

						<ul class="dropdown-menu btn-block" role="menu">
							<li><a href="<?=base_app()?>Billing/cMAxResultXPage/5">5</a></li>
							<li><a href="<?=base_app()?>Billing/cMAxResultXPage/10">10</a></li>
							<li><a href="<?=base_app()?>Billing/cMAxResultXPage/15">15</a></li>
							<li><a href="<?=base_app()?>Billing/cMAxResultXPage/20">20</a></li>
						</ul>
					</div>
					<div class="resultInfo col-md-4">
						<?=$startItem?>-<?=$endItem?> of <?=$totalObjects?> items
					</div>
					<div class="clearh1"></div>
				</div>


				<div id="resultTable">
					<table class="table table-bordered table-inverse">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Description</th>
								<th>Status</th>
								<!--<th>invoice Date</th>
								<th>Due Date</th>
								<th>Matter</th>
								<th>Balance</th>
								<th>Invoice Amount</th> -->
								
							</tr>

						</thead>
						<tbody>
							<?php foreach($billing as $i => $code): 

							  

							   

							?>
								<tr>
									<td><input type="checkbox" name="ItemId[]" id="ItemId[]" value="<?=$code->id ?>"> </td>
									<td><?=$code->code ?></td>
									<td><?=$code->description?></td>
									<td>

										<?php 

										$StateName=$ci->UserModel->GetState($row->State);

										 if($code->status==1){
												$img='status_1.jpg';
											}elseif($code->status==2){
												$img='status_2.jpg';
											} 

										?>
										<a href="<?=base_url()?>Billing/Changestatus/<?=$code->status?>/<?=$code->id?>">

										  		<img src="<?=base_url()?>img/<?=$img?>">
										  		
										  	</a>
										  	<?=$code->status?>

									</td>
								 
									 

								</tr>
							<?php 
							 
							endforeach; 

							?>
						</tbody>
					</table>
				</div> <!-- fin print table -->   

			</div><!-- fin col-md-9 -->

			</form>	

		</div>
	</div><!-- fin clase maters content -->

 </div>		

	<!-- Modal -->
	<div id="modal-event" class="modal fade modal-mira" role="dialog">
		<div class="loading-modal"></div>
	</div>
	<script type="text/javascript">
		function add_entry(id_matter,id_entry){
			$("#modal-event").modal("show");

			id_entry=(id_entry!=undefined) ? id_entry : 0;
			$.post(base_url+"Billing/time_expense_modal?from=billing",{id_matter:id_matter,id_entry:id_entry},function(response){
				$("#modal-event").html(response);
			});
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


	<script>

	$(".act").click(function(){
		$('input[name="actionButt"]').val("act");

		//alert("hola es act ");

		$("#listForm").submit();

	});
	$(".deact").click(function(){
			$('input[name="actionButt"]').val("deact");
			//alert("hola es deact ");
			$("#listForm").submit();

	});
		
	</script>

