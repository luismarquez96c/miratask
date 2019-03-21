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
	<h3>Users</h3><hr>
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
			
			 
		<div class="col-xs-9 ListWrap">		
			  
			<form   action="<?=base_app()?>Contacts/eraseListConfirm" method="POST" id="contactList" >
			  
			  <div class="col-xs-12  buttWrap">

				  	<!-- boton " + add Contact"-->
					<div class="col-md-3 pl0">
						<a id="add_matters" href="<?=base_url()?>User/addForm" class="btn btn-primary btn-lg btn-block" >
						<i class="fa fa-plus"></i> &nbsp; Add User
						</a>
					</div>

				</div><!-- fin xs 9 -->

				<div class="col-xs-12 wrapMess">
					<?php 
					if(isset($message)){ echo $message; }   
					echo $this->session->userdata("Wmessage");
					echo $this->session->set_userdata("message","");
					?>
				</div>





				<!-- all Contacts -->


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
						    newWin.close(); 
						}
				</script>

				<div class="col-xs-12">
					<div class="print">
						<p>Firm Users And Rates</p> <span onclick="printTMatters()"  class="fa fa-print  fa-2x"  ></span>
					</div>
				</div>


				<!-- tabla -->

				<div class="col-xs-12" >
					
					


					
					<div id="resultTable"> 
					
						<table class="table table-bordered table-inverse">
							<thead>
								<tr>
									<!-- <th> </th> -->
									<th>Last Name</th>
									<th>Firt Name</th>
									<th>Role(s)</th>
									<th>Email</th>
									<th>Default Hourly Rate</th>
									<th>Account Status</th>
								</tr>
							</thead>

						<tbody>
						<?php 
						
						foreach ($Users as $row){ 
							
								$roleName=$ci->UserModel->GetRole($row->Role);
								$StateName=$ci->UserModel->GetState($row->State);
								
						 		if($row->State==1){
									$img='status_1.jpg';
								}elseif($row->State==2){
									$img='status_2.jpg';
								}
						 
						?>
						 <tr>
							  <!-- <td><input type="checkbox" name="ItemID[]" value="<?=$row->Id?>" class="itemContact"> </td> -->
							  <td><a href="<?=base_app()?>User/detail/<?=$row->Id?>"> <?=$row->LastName?></a></td>
							  <td><a href="<?=base_app()?>User/detail/<?=$row->Id?>"><?=$row->Name?></a></td>
							  <td><?=$roleName->Role?></td>
							  <td><?=$row->Email?></td>
							  <td><?=$row->HourlyRate?></td>
							  <td>
							  	<a href="<?=base_url()?>User/Changestatus/<?=$row->State?>/<?=$row->Id?>">

							  		<img src="<?=base_url()?>img/<?=$img?>">
							  		
							  	</a>
							  	<?=$StateName->State?>
							  </td>
							 
						 </tr>
						
						<?php } ?>
						  
						</tbody>
					   </table>
					</div><!-- fin result table -->   




					<div class="paginationWrap" > 
						<div class="pagesList col-md-4" ><?php echo $links ?></div> 
						<div class="resxP     col-md-4">
							
							<span class="l">Result per page: &nbsp;</span>
							
							<button   type="button" class="btn btn-default btn-xs br0 l" data-toggle="dropdown">
								
								Change
									<span class="caret"></span>
								
							</button>

							<ul class="dropdown-menu btn-block" role="menu">
								 <li><a href="<?=base_app()?>User/MAxResultXPage/5">5</a></li>
								 <li><a href="<?=base_app()?>User/MAxResultXPage/10">10</a></li>
								 <li><a href="<?=base_app()?>User/MAxResultXPage/15">15</a></li>
								 <li><a href="<?=base_app()?>User/MAxResultXPage/20">20</a></li>
							</ul>


							
						</div>
						<div class="resultInfo col-md-4">
							<?=$startItem?>-<?=$endItem?> of <?=$totalUser?> items
						</div>
						<div class="clearh1"></div>
					</div>

					<div class="clearh50"></div>
				</div><!-- fin col-md-9 -->
			</form>	
		</div>


	</div><!-- fin clase maters content -->

 </div>
 