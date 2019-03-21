 <?php 
 $ci =&get_instance();

 $ci->load->model("BillingModel",'billing'); 
 $ci->load->model("SecureModel",'billing');
 $ci->load->model('MatterModel','matter'); 
 ?>

 <script src="<?php echo base_url(); ?>js/util.js"></script>
 <script src="<?=base_url('js/print.js')?>"></script>

 <script>
 	
 	function slideDown(objeto) {	
 		if($("#"+objeto).is( ":visible" )){
 			$("#"+objeto).slideUp("fast");
 		}else{

 			$("#"+objeto).slideDown( "fast" );
 		}
 	} 	

 </script>

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
 				<a id="delete_matters" onclick="slideDown('form-print')"  class="btn   btn-block" > Print</a>
 			</div>

 			<!-- boton " Delete Matters" -->
 			<div class="col-md-3">
 				<a id="delete_matters" href="<?=base_app()?>Billing/setCriterioInvoices"  class="btn   btn-block" >  All Invoices </a>
 			</div>


 			<div class="col-md-3">
 				<input   type="text" class="Mediumselect" onkeyup="MatterRelToInvoice(this.value)" placeholder="Searh for  matter " value="<?=$this->session->userdata("matterCriterioActual")?>"> 
 				<div class="dropdown-menu" id="MatterResult"></div>
 			</div>



 		</div><!-- fin  col-xs-12 -->

 	</div>
 	<div class="form-group container-form-print" id="form-print">
 		<div class="col-xs-3 col-xs-offset-5">
 			<div class="form-group">
 				<label for="date1">From: </label>
 				<input type="date" class="form-control" name="date1" id="date1" value="<?=$date1?>" max="<?=$date2?>">
 			</div>
 		</div>
 		<div class="col-xs-3">
 			<div class="form-group">
 				<label for="date2">To: </label>
 				<input type="date" class="form-control" name="date2" id="date2" value="<?=$date2?>" max="<?=$date2?>">
 			</div>
 		</div>
 		<div class="col-xs-1 text-center">
 			<span onclick="printInvoices()" class="fa fa-print fa-2x vcenter"></span>
 		</div>
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
 			<p>Invoices</p>
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
 						<th>Invoices #</th>
 						<th>Name</th>
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
 									<td>$<?=$balance->Balance?></td>
 									<td>$<?=$totalCalculado?></td>


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