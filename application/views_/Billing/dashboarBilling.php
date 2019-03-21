
<!-- CONTENIDO MATTERS -->
<script src="<?=base_url()?>js/util.js"></script>


<?php if(isset($message)){ echo $message; }  ?>

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
					 $<?=$Estadistic->Paid?>
					<div>Outstanding</div>
				</li>

				<li class="col-md-2 cred">
					$<?=$getEstadisticOverdue->Overdue?>
					<div>Overdue</div>
				</li>

				<li class="col-md-2   cgreen">
					$<?=$PaidLast30days->PaidLast30days?>
					<div>Paid Last 30 days </div>
				</li>

				<li class="col-md-2  cyellow">
					$<?=$Estadistic->Invoiced?>
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
						$<?=$ComingDue->ComingDue?>	
						<span style="background:#34d1be; height:<?=$height?>px;"></span>
						<div>Coming Due</div>	
					</li>

					<li style="padding-top:<?=100-$height1?>px;">
						$<?=$ComingDue1->ComingDue?>	
						<span style="background:#39add2; height:<?=$height1?>px;"></span>
						<div>1-30 Days</div>	
					</li>

					<li style="padding-top:<?=100-$height2?>px;">
						$<?=$ComingDue2->ComingDue?>	
						<span style="background:#f1a14a; height:<?=$height2?>px;"></span>
						<div>31-60 Days</div>	
					</li>

					<li style="padding-top:<?=100-$height3?>px;">
						$<?=$ComingDue3->ComingDue?>	
						<span style="background:#f4cf5d; height:<?=$height3?>px;"></span>
						<div>61-90 Days</div>	
					</li>


					<li style="padding-top:<?=100-$height4?>px;">
						$<?=$ComingDue4->ComingDue?>	
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
					<tr>
						<td>Maria Contreras,Maria Sandra(U-Visa)</td>
						<td>$20.666.66</td>
						<td><img src="<?=base_url()?>img/otrotask.png" /></td>
					</tr>
					<tr>
						<td>Jose Contreras,Melgar Santos(U-Visa)</td>
						<td>$20.666.66</td>
						<td><img src="<?=base_url()?>img/otrotask.png" /></td>
					</tr>
					<tr>
						<td>Maria Contreras,Maria Sandra(U-Visa)</td>
						<td>$20.666.66</td>
						<td><img src="<?=base_url()?>img/otrotask.png" /></td>
					</tr>
					<tr>
						<td>Maria Contreras,Maria Sandra(U-Visa)</td>
						<td>$20.666.66</td>
						<td><img src="<?=base_url()?>img/otrotask.png" /></td>
					</tr>

				</table>
				<div class="paginationWrap col-xs-3"> 

					<div class="pagesList col-md-4">
						<strong>1</strong>
						<a href="" data-ci-pagination-page="2">2</a>
						<a href="" data-ci-pagination-page="3">3</a>
						<a href="" rel="next" data-ci-pagination-page="2">&gt;</a>
						<a href="" data-ci-pagination-page="166">Last ›</a>
					</div> 

					<div class="resultInfo col-md-4">
						0-10 of 1651 items
					</div>

					<div class="clearh1"></div>
				</div>

			</li>

			<li class="ml30">
				<div class="x_title"> <img src="<?=base_url()?>img/Billing_blue.png" /> &nbsp; Invoiced in Draft Status</div>
				<table class="table table2      ">
					<?php foreach($InvoicedinDraft AS $row){ ?>

					<tr>
						<td><a href="<?=base_url()?>Billing/invoice_details/<?=$row->Id?>">
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
