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
		newWin.print();
		newWin.close(); 
	}
</script>	
<div class="print_invoice">
	 <span onclick="printTMatters()" class="fa fa-print"></span>
</div>

<div id="printArea" style="width:1150;">



	<div class="head_tittle">

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
				 			$address=$ClienteAddress->Street.", ".$ClienteAddress->Street.", ".$ClientePais->Country;
				 		}

				 		$billToName=$Invoice->BillToName;

				 		if($billToName==""){

				 			$BillTo     = $Cliente->Id;
				 			$billToName = $Cliente->FirstName." ".$Cliente->Middle." ".$Cliente->LastName;

				 		}


				 	?>


		<div class="info">
			<div class="vineta firstv">
				<h3>Miralaw Group, APC</h3>
				3211 E12th Street Suite 122
				OAKLAND CA, 94601

				Phone: 510-437-9998
				Fax:510-437-9909
				gmira@miralawgroup.com
				www.notodeportation.com
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
				Freeze work 6/22/2016
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
				Thank You for your payment.
				Gracias por su pago.
				
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
				 	</td>

				 	<tr style="border-bottom:1px solid #FFF">
				 		<td>
				 			Tax
				 		</td>
				 		<td>
				 			$<span id="taxx"></span>
				 		</td>
				 	</td>	

					<tr style="border-bottom:1px solid #FFF">
						<td>Subtotal</td>
						<td><?=$totalTimes+$totalExpense?></td>
					</tr>
					<tr class="tfooter">
						<td>Total</td>
						<td>
							<input type="hidden" name="totFinal_hidden" id="totFinal_hidden" value="<?=$totalTimes+$totalExpense?>" />
				 			$<span id="totFinalWrap"><?=$totalTimes+$totalExpense?></span>

				 			<script type="text/javascript">
					 			totalFinal="<?=$totalTimes+$totalExpense?>";
					 			totalParc=totalFinal;

					 			var taxPorc = "<?=$Invoice->TaxValue?>";
					 			if(taxPorc=="" || taxPorc==undefined){ taxPorc = 0; }

					 			totserv=<?=$totalTimes?>;

					 			<?php if($totalExpense){
					 				echo  "totexpen=".$totalExpense.";";
					 			}else{
					 				echo  "totexpen='';";  
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