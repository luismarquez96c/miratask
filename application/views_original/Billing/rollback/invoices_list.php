 <?php 
	$ci =&get_instance();

	$ci->load->model("BillingModel",'billing'); 
	$ci->load->model("SecureModel",'billing'); 
?>

<?php $status_op=array("1"=>"Uninvoiced","2"=>"Invoiced","3"=>"Paid" ); ?>

<form name ="listForm" id="listForm"  action="<?=base_app()?>Task/eraseListConfirm" method="POST" >
	<div class="row">
		<div class="col-xs-12  buttWrap">
			<!-- boton " + add Matters"-->

			<div class="col-md-3 pl0">
				<a id="add_matters"   class="btn btn-primary btn-lg btn-block" onclick="new_invoice()" >
					<i class="fa fa-plus"></i> &nbsp; Create Invoice
				</a>
			</div>


			<!-- boton " Delete Matters" -->
			<div class="col-md-3">
				<a id="delete_matters" onclick="apply_pay()"  class="btn   btn-block" >  Apply Pay </a>
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
			<p>Invoices </p> <span onclick="printTMatters()" class="fa fa-print"></span>
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

				<?=$this->session->userdata("Invoicexpage")?>
				
				<span class="caret"></span>

			</button>

			<ul class="dropdown-menu btn-block" role="menu">
				<li><a href="<?=base_app()?>Billing/iMAxResultXPage/5">5</a></li>
				<li><a href="<?=base_app()?>Billing/iMAxResultXPage/10">10</a></li>
				<li><a href="<?=base_app()?>Billing/iMAxResultXPage/15">15</a></li>
				<li><a href="<?=base_app()?>Billing/iMAxResultXPage/20">20</a></li>
				<li><a href="<?=base_app()?>Billing/iMAxResultXPage/30">30</a></li>
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
					<th>Invoices Number</th>
					<th>Status</th>
					<th>invoice Date</th>
					<th>Due Date</th>
					<th>Matter</th>
					<th>Balance</th>
					<th>Invoice Amount</th>
					
				</tr>

			</thead>
			<tbody>
				<?php 
				//echo count($billing);

				//print_r($billing);

				foreach($billing as $i => $invoice): 

				   //$balance=$invoice->InvoiceAmount-$invoice->amount;

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

					//echo  "<br>".$invoice->Number." Total partial : ".$totalPartial;
					 


					if($totalPartial > 0 ){

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
													
						$balance=number_format($totalCalculado,'2')-number_format($amount,'2');

						//echo "balance ".$balance."<br><br>";



						?>
						<tr>
							<td><a href="<?=base_url()?>Billing/invoice_details/<?=$invoice->Id ?>"><?=$invoice->Number ?></td>
							<td><?=$invoice->Status ?></td>
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
							<td>$<?=$invoice->Balance?></td>
							<td>$<?=$invoice->InvoiceAmount?></td>
							 

						</tr>

						<?php 
					}
				endforeach; 

				?>
			</tbody>
		</table>
	</div> <!-- fin print table -->   

</div><!-- fin col-md-9 -->

</form>	

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