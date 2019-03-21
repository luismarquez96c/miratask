<?php $ci =&get_instance();
$ci->load->model("SecureModel");
?>	
<html>

<head>
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet"> 

	<link href="<?php echo base_url(); ?>css/invoice_preview.css" rel="stylesheet">

</head>
<body>
	<script type="text/javascript">
		function printTMatters() {

			var divToPrint = document.getElementById('printArea');
			var htmlToPrint = '<html><head>';
			htmlToPrint +='<link href="<?php echo base_url(); ?>css/invoice_preview.css" rel="stylesheet">';

			htmlToPrint +='<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">';
			htmlToPrint +='<link href="https://fonts.googleapis.com/css?family=Arvo" rel="stylesheet">';

			htmlToPrint +=  '</head><body style="background: #fff;">';
			htmlToPrint += '' +
			'<style type="text/css">' +
			'#matters_details {' +
			'width:100%;' +
			'}' +
			'</style>';
			htmlToPrint += divToPrint.outerHTML;
			htmlToPrint +=  '</body></html>';

			newWin = window.open('', '', 'left=0,top=0,width=1180,height=900,toolbar=0,scrollbars=0,status=0');
			newWin.document.write(htmlToPrint);
			setTimeout(newWin.print(), 1000);
			//newWin.close(); 
		}
	</script>
	<script>
		var comentario_live = $('#comentario-live').val();

		if (comentario_live!="") {
			$('#comment').text(comentario_live);
		}
	</script>	
	<div class="print_invoice">
		<span onclick="printTMatters()" class="fa fa-print"></span>
	</div>

	<div id="printArea" style="width:1150;">



		<div class="head_tittle" 
		<?php if($inv_setting[11]->estado=='OK'){ ?>	
			style="background-image: url('<?=base_url()?>img/<?=$inv_setting[11]->valor?>')"
		<?php } ?>
		>

	</div>

	<div class="body_conten">

		<script type="text/javascript">
			typeDesc = "<?=$Invoice->DiscType?>";
			TaxApplieTo = "<?=$Invoice->TaxApplieTo?>";

			totalDescEX = "<?=$Invoice->DiscExpenses?>";
			totalDescSE = "<?=$Invoice->DiscServices?>";

			$( document ).ready(function() {
				calDescServ(totalDescSE);
				calDescExpen(totalDescEX);
				calTax(taxPorc);

				$("#fadeBlack").click(function() {
					/* Act on the event */
					$("#prev_inv").hide();
					$("#fadeBlack").hide();
				});
			});

		</script> 


		<?php 

		$address=$Invoice->Address;

		if($address==""){
			$address=$ClienteAddress->Street.", ".$ClienteAddress->City.", ".$ClientePais->Country;
		}

		$billToName=$Invoice->BillToName;

		if($billToName==""){

			$BillTo     = $Cliente->Id;
			$billToName = $Cliente->FirstName." ".$Cliente->Middle." ".$Cliente->LastName;

		}


		?>


		<div class="info">
			<div class="vineta firstv">
				<?php if($inv_setting[1]->estado=='OK'){ ?>
					<h3><?=$inv_setting[1]->valor?></h3>
				<?php }?>
				
				<?php if($inv_setting[2]->estado=='OK'){ ?>
					<?=$inv_setting[2]->valor?><br>
					<?=$inv_setting[3]->valor?> <?=$inv_setting[4]->valor?>, <?=$inv_setting[5]->valor?>
					<br>
				<?php }?>
				
				<?php if($inv_setting[6]->estado=='OK'){ ?>
					Phone: <?=$inv_setting[6]->valor?><br>
					Fax:<?=$inv_setting[7]->valor?><br>
				<?php }?>

				<?php if($inv_setting[9]->estado=='OK'){ ?>
					<?=$inv_setting[9]->valor?><br>
				<?php }?>

				<?php if($inv_setting[10]->estado=='OK'){ ?>
					<?=$inv_setting[10]->valor?><br>
				<?php }?>

				<?php if($inv_setting[8]->estado=='OK'){ ?>	
					<?=$inv_setting[8]->valor?><br>
				<?php }?>
			</div>

			<div class="vineta">
				<h3><?=$billToName?></h3>
				<?=$address?>
			</div>

			<div class="vineta lastv">
				<h3>&nbsp;</h3>
				<strong>Invoice #:</strong> <?=$Invoice->Number?><br>
				<strong>Invoice Date:</strong> <?=decodedate($Invoice->InvoiceDate)?><br>
				<strong>Duie Date:</strong> <?=decodedate($Invoice->DueDate)?><br>
				<strong>Case:</strong><?=$Matter->Name?><br>
			</div>
			<div class="clearh1"></div>
		</div>

		<div class="detallesWrap">

			<div class="dtitle">			
				Services
			</div>
			<table  class="table2">
				<thead>
					<tr>

						<th>Date</th>
						<th>Activity</th>
						<th>Description</th>
						<th>Rate</th>
						<th>Hours</th>
						<th>Total</th>


					</tr>
				</thead>

				<tbody>

					<?php 
					foreach ($Times as $row){ 
						$Activity=$ci->SecureModel->get('ml_bi_billing_codes',  " AND id='".$row->billing_code."' ");		
						?>
						<tr>
							<td><?=decodedate($row->creation_date)?></td>
							<td><?=$Activity->code?></td>
							<td><?=$row->description?></td>
							<td>$<?=$row->rate?></td>
							<td><?=$row->unit?></td> 
							<td><?=$row->amount?></td>
						</tr>
						<?php 
						$totalTimes=$totalTimes+$row->amount;
					} 
					?>	

				</tbody>
			</table>



			
		</div><!-- detalles wrap -->


		<div class="detallesWrap">

			<div class="dtitle">			
				Services
			</div>
			<table  class="table table-bordered table-inverse">
				<thead>
					<tr>

						<th>Date</th>
						<th>Expense</th>
						<th>Description</th>
						<th>Cost</th>
						<th>Quantity</th>
						<th>Total</th>

					</tr>
				</thead>

				<tbody>
					<?php
					foreach ($Expense as $row){ 	
						?>
						<tr>
							<td><?=decodedate($row->creation_date)?></td>
							<td><?=$row->description?></td>
							<td><?=$row->description?></td>
							<td>$<?=$row->amount?></td>
							<td>1</td>
							<td><?=$row->amount?></td>
						</tr>

						<?php 
						$totalExpense=$totalExpense+$row->amount;
					} 

					?>

				</tbody>
			</table>



			
		</div><!-- detalles wrap -->

		<div class="coment_wrap">

			<div class="coment">
				<h3>
					Comments
				</h3>
				<?php  if(empty($Invoice->Comments)){

					echo "<span id='comment'>Thank You for your payment.
					Gracias por su pago.</span>";
				}else{
					echo "<span id='comment'>".$Invoice->Comments."</span>";
				}
				?>
			</div>

			<div class="totales">
				
				<table class="totalesTable">

					<tr style="border-bottom:1px solid #FFF">
						<td>Services subtotal</td>
						<td>
							<input type="hidden" name="totServi_hidden" id="totServi_hidden" value="<?=$totalTimes?>" />
							$<span id="totServi"><?=$totalTimes?></span>

						</td>
					</tr>

					<tr style="border-bottom:1px solid #FFF">
						<td>Payment</td>
						<td>
							<input type="hidden" name="totServi_hidden" id="totServi_hidden" value="<?=$totalTimes?>" />
							$<span id="totServi"><?=$Invoice->DiscPart?></span>

						</td>
					</tr>

					<tr style="border-bottom:1px solid #FFF">
						<td>Balance</td>
						<td>
							<input type="hidden" name="totServi_hidden" id="totServi_hidden" value="<?=$totalTimes?>" />
							$<span id="totServi"><?=(($Invoice->Status=='Paid')?'0.00':$totalTimes+$totalExpense-$Invoice->DiscPart)?></span>

						</td>
					</tr>

					<?php if(count($Expense)>0){ ?>
						<tr style="border-bottom:1px solid #FFF">
							<td>Expense subtotal</td>
							<td>
								<input type="hidden" name="totExpen_hidden" id="totExpen_hidden" value="<?=$totalExpense?>" />
								$<span id="totExpen"><?=$totalExpense?></span>		
							</td>
						</tr>
					<?php } ?>

					<tr style="border-bottom:1px solid #FFF">
						<td>
							Discount
						</td>
						<td>
							<input type="hidden" name="totDesc_hidden" id="totDesc_hidden" value="<?=$Invoice->DiscServices+$Invoice->DiscExpenses?>" />
							$<span id="totDesc"><?=$Invoice->DiscServices+$Invoice->DiscExpenses?></span>
						</td>
					</tr>


					<tr style="border-bottom:1px solid #FFF">
						<td>
							Tax
						</td>
						<td>
							$<span id="taxx"></span>
						</td>
					</tr>	

					<tr class="tfooter">
						<td>Total Due</td>
						<td>
							<input type="hidden" name="totFinal_hidden" id="totFinal_hidden" value="<?=(($Invoice->Status=='Paid')?'0.00':$totalTimes+$totalExpense);?>" />
							$ <span id="s"><?=(($Invoice->Status=='Paid')?'0.00':$totalTimes+$totalExpense-$Invoice->DiscPart);?></span>

							<script type="text/javascript">
								totalFinal="<?=$totalTimes+$totalExpense?>";
								totalParc=totalFinal;

								var taxPorc = "<?=$Invoice->TaxValue?>";
								if(taxPorc=="" || taxPorc==undefined){ taxPorc = 0; }

								totserv=<?=$totalTimes?>;

								<?php if($totalExpense){
									echo  "totexpen=".$totalExpense.";";
								}else{
									echo  "totexpen=0;";  
								}
								?>;
							</script>
						</td>
					</tr>
				</table>

			</div>

			<div class="clearh1"></div>
			
		</div>




		<script src="<?=base_url()?>js/utilbilling.js"></script>
		

	</div><!-- fin body conten -->


</div><!-- fin printArea -->


</body>
</html>