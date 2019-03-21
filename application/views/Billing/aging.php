 <?php 
 $ci =&get_instance();

 $ci->load->model("BillingModel",'billing'); 
 $ci->load->model("SecureModel",'billing');
 $ci->load->model('MatterModel','matter');
 $ci->lang->load($this->session->userdata("lng") , 'labels');
 ?>
 <style>
 .container-tabs .col-lg-2{
 	width: 20% !important;
 }
 .container-tabs .tabs {
 	background: #f4f4f4;
 	border: 1px solid #ebebeb;
 	border-radius: 5px 5px 0px 0px;
 	color: #0055a5;
 	font-size: 16px;
 }
 .container-tabs .tabs:hover{
 	background: #f4f4f4;
 	border: 1px solid #ebebeb;
 	border-radius: 5px 5px 0px 0px;
 	color: #0055a5;
 	font-size: 16px;
 }
</style>
<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3><?=$this->lang->line('aging_0') ?></h3><hr>
</div>

<div class="col-xs-12">
	<div class="container container-tabs" style="padding: 0px 0px">
		<div class="col-lg-2" style="padding: 0px 0px">
			<a href="<?=base_url('Billing/Aging/0')?>" class="btn btn-primary btn-lg btn-block tabs <?=($active==0?'active':'')?>"><?=$this->lang->line('aging_1') ?></a>
		</div>
		<div class="col-lg-2" style="padding: 0px 0px">
			<a href="<?=base_url('Billing/Aging/1')?>" class="btn btn-primary btn-lg btn-block tabs <?=($active==1?'active':'')?>" ><?=$this->lang->line('aging_2')?></a>
		</div>
		<div class="col-lg-2" style="padding: 0px 0px">
			<a href="<?=base_url('Billing/Aging/30')?>" class="btn btn-primary btn-lg btn-block tabs <?=($active==30?'active':'')?>"><?=$this->lang->line('aging_3')?></a>
		</div>
		<div class="col-lg-2" style="padding: 0px 0px">
			<a href="<?=base_url('Billing/Aging/60')?>" class="btn btn-primary btn-lg btn-block tabs <?=($active==60?'active':'')?>"><?=$this->lang->line('aging_4')?></a>
		</div>
		<div class="col-lg-2" style="padding: 0px 0px">
			<a href="<?=base_url('Billing/Aging/90')?>" class="btn btn-primary btn-lg btn-block tabs <?=($active==90?'active':'')?>"><?=$this->lang->line('aging_5')?></a>
		</div>
	</div>
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
</div>

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
		<p><?=$this->lang->line('aging_0') ?></p>
	</div>
</div>

<div class="col-md-12">
	<div class="paginationWrap" > 
		<div class="pagesList col-md-4" >

			<?php echo $links; ?>

		</div> 
		<div class="resxP col-md-4">
			<span class="l"><?=$this->lang->line('contacts_6')?> &nbsp;</span>

			<button type="button" class="btn btn-default btn-xs br0 l" data-toggle="dropdown" style="width: 70px">

				<?=$this->session->userdata("InvoiceDuexpage")?>

				<span class="caret"></span>

			</button>

			<ul class="dropdown-menu btn-block" role="menu">
				<li><a href="<?=base_url("Billing/iMAxResultXPage2/5/$active")?>">5</a></li>
				<li><a href="<?=base_url("Billing/iMAxResultXPage2/10/$active")?>">10</a></li>
				<li><a href="<?=base_url("Billing/iMAxResultXPage2/15/$active")?>">15</a></li>
				<li><a href="<?=base_url("Billing/iMAxResultXPage2/20/$active")?>">20</a></li>
				<li><a href="<?=base_url("Billing/iMAxResultXPage2/30/$active")?>">30</a></li>
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
					<th><?=$this->lang->line('billing_43')?></th>
					<th><?=$this->lang->line('billing_44')?></th>
					<th><?=$this->lang->line('billing_45')?></th>
					<th><?=$this->lang->line('billing_46')?></th>
					<th><?=$this->lang->line('billing_47')?></th>
					<th><?=$this->lang->line('billing_48')?></th>
					<th><?=$this->lang->line('billing_49')?></th>
					<th><?=$this->lang->line('billing_50')?></th>

				</tr>

			</thead>
			<tbody>
				<?php 
				

				foreach($billing as $i => $invoice):

					$balance = $ci->matter->getBalance($invoice->Object);

				   //if($invoice->InvoiceAmount > 0 ){

					$totalTimes = 0;
					$totalExpen = 0;
					$amount     = 0;

					$descuentoServ = 0;
					$descuentoExpen = 0;

					$Expense    = $ci->billing->InvoiceEntries($invoice->Number, "EXPENSE");
					$Times      = $ci->billing->InvoiceEntries($invoice->Number, "TIME");

					//echo '<br>count ex '.count($Expense);

					if(count($Times)>0){
						foreach ($Times as $key){   $totalTimes = $totalTimes+$key->amount; }
					}

					if(count($Expense)>0){
						foreach ($Expense as $key){ $totalExpen = $totalExpen+$key->amount; }
					}

					$totalPartial=$totalExpen+$totalTimes;

					//echo $totalPartial;

					//echo  "<br>".$invoice->Number." Total partial : ".$totalPartial;



					if($totalPartial >= 0 ){

					   	//cal tax and discount
						if($invoice->Discount=="true"){

							if($invoice->DiscType=='porc'){

								if($invoice->DiscServices > 0 ){

									$descuentoServ = ($totalTimes*$invoice->DiscServices)/100;

								}

								if($invoice->DiscExpenses > 0 ){

									$descuentoExpen = ($totalExpen*$invoice->DiscExpenses)/100;

								}


							}else if(typeDesc=='mone'){
								$descuentoServ  = $invoice->DiscServices;
								$descuentoExpen = $invoice->DiscExpenses;
							}



							$total_descuentos =	$descuentoServ + $descuentoExpen;

							$totalCalculado = $totalPartial-$total_descuentos;

						}else{
							$totalCalculado = $totalPartial;
						}	

						//echo "<br> Total Calculado : ".$totalCalculado;




						if($invoice->Tax=="true"){

							if($invoice->TaxApplieTo =="Services" ){

								$TotalTax= ($totalTimes*$invoice->TaxValue)/100;
							}
							if($invoice->TaxApplieTo =="Expense" ){

								$TotalTax= ($totalExpen*$invoice->TaxValue)/100;
							}
							if($invoice->TaxApplieTo =="Expense" ){

								$TotalTax= ($totalCalculado*$invoice->TaxValue)/100;
							}

						} 

						$totalCalculado = $totalCalculado + $TotalTax;

						//echo "<br> Total Calculado After Tax : ".$totalCalculado;


						$payments=$ci->SecureModel->getTabla('ml_bi_payments', " AND InvoiceNumber=$invoice->Number ");

						//echo "<pre>";
						//print_r($payments);
						//echo "</pre>";

						if(count($payments>0)){ 

							foreach ($payments as $pay) {  
								$amount=$amount+$pay->Amount; 
							}

						}else{
							$amount=0;
						}

						//echo "<br> amount : ".$amount;

 							//$balance=number_format($totalCalculado,'2')-number_format($amount,'2');

						//echo "balance ".$balance."<br><br>";

						$dateValidate =  strtotime($invoice->DueDate);
						$today = strtotime(date('Y-m-d'));

						if (($invoice->Status !='Draft' && $invoice->Status !='Paid') && $today>$dateValidate) {
							$alert = "vencido";
						}else{
							$alert = '';
						}

						?>
						<tr class="<?=$alert?>">
							<td><a href="<?=base_app()?>Billing/invoice_details/<?=$invoice->Id ?>"><?=$invoice->Number ?></td>
								<td><?= $invoice->BillToName?></td>
								<td><?=traducirFactura($this->lang->line('main_9'),$invoice->Status) ?></td>
								<td>
									<?php 
									if($invoice->InvoiceDate=='0000-00-00 00:00:00'){
										echo '';
									}else{
										decodedate($invoice->InvoiceDate);
									}


									?>

								</td>
								<td>

									<?php 
									if($invoice->DueDate=='0000-00-00 00:00:00'){
										echo '';
									}else{
										decodedate($invoice->DueDate); 
									}
									?>


								</td>
								<td><?=$invoice->NameClient ?></td>
								<td>$<?=$balance->Balance?></td>
								<td>$<?=$totalCalculado?></td>


							</tr>

							<?php 
						}
					endforeach; 

					?>
				</tbody>
			</table>
		</div>
	</div>