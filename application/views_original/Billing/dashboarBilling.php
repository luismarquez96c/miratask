<!-- CONTENIDO MATTERS -->
<script src="<?=base_url()?>js/util.js"></script>
 <?php 
	$ci =&get_instance();
	$ci->load->model("BillingModel");

 ?>

<?php if(isset($message)){ echo $message; }  ?>

<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css"> 



<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3>Billing</h3><hr>
</div>

<div class="row">

	<div class="matterContent">
		<!-- MATTERS -->



		<!-- Menu de categorias  -->
		<div class="col-xs-3 folderNav">
			<?php $this->load->view('Billing/menu-billing'); ?>
		</div><!-- fin menu de categorias -->

		<div class="col-xs-9 ListWrap">


			<div class="col-xs-12  landingbuttWrap">
				<!-- boton " + add Matters"-->

				<li class="col-md-2  ml0i">
					 $<?=number_format ( $Estadistic->Paid , 2 , "." , "," )?>
					<div>Outstanding</div>
				</li>

				<li class="col-md-2 cred">
					$<?=number_format ( $getEstadisticOverdue->Overdue , 2 , "." , "," )?>
					<div>Overdue</div>
				</li>

				<li class="col-md-2   cgreen">
					$<?=number_format ( $PaidLast30days->PaidLast30days , 2 , "." , "," )?>
					<div>Paid Last 30 days </div>
				</li>

				<li class="col-md-2  cyellow">
					$<?=number_format ( $Estadistic->Invoiced , 2 , "." , "," )?>
					<div>Univoiced entries</div>
				</li>


			</div><!-- fin  col-xs-12 -->

			<div class="col-xs-12 wrapMess">
				<?php 
				echo $this->session->userdata("Wmessage");
				$this->session->set_userdata("Wmessage","");
				?>

			</div>

			<!-- all matters title yelllow-->
			<div class="col-md-12 shadowWrap">



				<div class="titleBillDsh">
					Aging Report
				</div>


				<div class="BarsWrap">

						


					<li style="padding-top:<?=100-$height?>px;">
						$<?=number_format ( $ComingDue->ComingDue , 2 , "." , "," )?>	
						<span style="background:#34d1be; height:<?=$height?>px;"></span>
						<div>Coming Due</div>	
					</li>

					<li style="padding-top:<?=100-$height1?>px;">
						$<?=number_format ( $ComingDue1->ComingDue, 2 , "." , "," )?>	
						<span style="background:#39add2; height:<?=$height1?>px;"></span>
						<div>1-30 Days</div>	
					</li>

					<li style="padding-top:<?=100-$height2?>px;">
						$<?=number_format ( $ComingDue2->ComingDue, 2 , "." , "," )?>	
						<span style="background:#f1a14a; height:<?=$height2?>px;"></span>
						<div>31-60 Days</div>	
					</li>

					<li style="padding-top:<?=100-$height3?>px;">
						$<?=number_format ( $ComingDue3->ComingDue, 2 , "." , "," )?>	
						<span style="background:#f4cf5d; height:<?=$height3?>px;"></span>
						<div>61-90 Days</div>	
					</li>


					<li style="padding-top:<?=100-$height4?>px;">
						$<?=number_format($ComingDue4->ComingDue, 2 , "." , "," )?>	
						<span style="background:#f16a4c; height:<?=$height4?>px;"></span>
						<div>Over-90 Days</div>	
					</li>

					<div class="clearh1"></div>	

				</div> <!-- fin print table --> 




			</div><!-- fin col-md-9 -->






		</div><!-- fin contenedor de matters -->

		<div class="invoicedwrap col-md-12 ">
			<li>
				<div class="x_title"> <img src="<?=base_url()?>img/Billing_blue.png" /> Uninvoiced Amounts for Matters</div>	
				<table class="table table2      ">
					
					<?php foreach($Uninvoiced AS $row_u){ 
							$tot_times=$ci->BillingModel->sum_time_expenses($row_u->Id);
					?>
					<tr>
						<td><a href="<?=base_app()?>Matters/Details/<?=$row_u->Id?>?tab=billing"><?=$row_u->Name?></a></td>
						<td><?php
						if($tot_times->total>0){
						    echo '$'.$tot_times->total;
						    $enlace=' onclick="new_invoice('.$row_u->Id.')" ';
						}else{
							echo 'No entries found';
							$enlace='href="javascript:add_entry('.$row_u->Id.')"';
						}

						?></td>
						<td><a <?=$enlace?> ><img src="<?=base_url()?>img/otrotask.png" /></a></td>
					</tr>
					 
					<?php 
						}
					?>

				</table>


				<div class="paginationWrap col-xs-3"> 

					<div class="pagesList col-md-4">
						<?php echo $links_u ?>
					</div> 

					<div class="resultInfo col-md-4">
						<?=$startItem_u?>-<?=$endItem_u?> of <?=$totalObjects_u?> items
					</div>

					<div class="clearh1"></div>
				</div>



			</li>

			<li class="ml30">
				<div class="x_title"> <img src="<?=base_url()?>img/Billing_blue.png" /> &nbsp; Invoiced in Draft Status</div>
				<table class="table table2      ">
					<?php foreach($InvoicedinDraft AS $row){ ?>

					<tr>
						<td><a href="<?=base_url()?>Billing/invoice_details/<?=$row->Id?>?tab=billing">
							<?=$row->BillToName?>
							</a>	
						</td>
						<td>$<?=$row->InvoiceAmount?></td>

					</tr>

					<?php 
						}
					?>


					 

				</table>
				<div class="paginationWrap col-xs-3"> 

					<div class="pagesList col-md-4">
						<?php echo $links ?>
					</div> 

					<div class="resultInfo col-md-4">
						<?=$startItem?>-<?=$endItem?> of <?=$totalObjects?> items
					</div>

					<div class="clearh1"></div>
				</div>	
			</li>

		</div><!-- fin invoicedwrap -->

		<div class="clearh50"></div>

	</div><!-- fin clase maters content -->

</div>


