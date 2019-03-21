<?php $ci =&get_instance();
$ci->load->model("SecureModel");

$url = $this->input->get('url');
?>		

<script type="text/javascript">
	typeDesc = "<?=$Invoice->DiscType?>";
	TaxApplieTo = "<?=$Invoice->TaxApplieTo?>";

	totalDescEX = "<?=$Invoice->DiscExpenses?>";
	totalDescSE = "<?=$Invoice->DiscServices?>";

	$( document ).ready(function() {
		<?php if($Invoice->Discount=="true"){?>
			calDescServ(totalDescSE);
			calDescExpen(totalDescEX);
		<?php } ?>
		<?php if($Invoice->Tax=="true"){?>
			calTax(taxPorc);
		<?php }?>
	});

</script> 

<div class="col-md-3 pl0">
	<a id="add_matters" class="btn btn-primary btn-lg btn-block" href="<?=base_app()?>Billing/invoices">
		<i class="fa fa-plus"></i> &nbsp; Back to invoices
	</a>
</div>

<div class="col-md-3 pl0">
	<a id="add_matters" class="btn btn-primary btn-lg btn-block"  onclick="prew_invoice(<?=$Invoice->Id?>)"  >
		<i class="fa fa-plus"></i> &nbsp; Preview
	</a>
</div>


<div class="col-md-3 pl0">
	<a id="add_matters" class="btn btn-primary btn-lg btn-block" href="<?=base_app()?>Billing/deleteDraft/<?=$Invoice->Id.'?url='.$url?>">
		<i class="fa fa-plus"></i> &nbsp; Delete Draft
	</a>
</div>	
<div class="clearh50"></div>
<?php 
echo $this->session->userdata("Wmessage");
echo $this->session->userdata("message");
?>	
<form name="detail_invoice" id="detail_invoice" method="POST" action="<?=base_app()?>Billing/invoice_update">
	
	<input type="hidden" name="invoiceType" value="<?=$Invoice->invoiceType?>">	
	<input type="hidden" name="id_invoice" value="<?=$Invoice->Id?>">
	<input type="hidden" name="num_invoice" value="<?=$Invoice->Number?>">

	<div class="invoiceDetails ">
		<div class="BoxtitleGray"> &nbsp; <img src="<?=base_url()?>img/time_exp_title.png" />  &nbsp;  Edit Invoice (<?=$Invoice->BillToName?>)</div>
		<div class="">

			<div class="clearh50">
				<div class="col-md-6" style="margin-top:20px;">
					<div class="col-md-3"> <label>Matter: </label> </div>
					<div class="col-md-6"> <?=$Matter->Name?>       </div>
				</div>

				<div class="col-md-6" style="margin-top:20px;">
					&nbsp;
				</div>

			</div>

			<div class="col-md-5">
				<?php 

				$address=$Invoice->Address;



				if($address==""){
					$address=$ClienteAddress->Street.", ".$ClienteAddress->City.", ".$ClientePais->Country;
				}

				$billToName=$Invoice->BillToName;
				$BillTo=$Invoice->BillTo;
				if($billToName==""){

					$BillTo     = $Cliente->Id;
					$billToName = $Cliente->FirstName." ".$Cliente->Middle." ".$Cliente->LastName;
				}

				?>

				<label>Bill to</label> 
				
				<input name="Contact_A" id="Contact_A" class="lupa" value="<?=$billToName?>"  onkeyup="showContacts(this.value,'_A')" placeholder="Searh for client name " type="text"> 
				<div class="dropdown-menu" id="ContactResult_A" style="margin-top: -120px; margin-left: 113px;"></div>


				<input type="hidden" value="<?=$BillTo?>" name="ContactID_A">


				<input type="hidden" value="<?=$Matter->Id?>" name="matter">

				<label style="margin-top:20px;">Addres</label>
				<textarea name="Address"><?=$address?></textarea>
				


			</div>

			<div class="col-md-5">

				<label>Invoice #</label>
				<input type="text" name="InvoiceNumber" value="<?=$Invoice->Number?>">

				<label>Term</label>


				<select name="terms">
					<option value="Custom Due Date" <?=($Invoice->Term=="Custom Due Date")?" selected=' selected'":""?> >Custom Due Date</option>
					<option value="Due Upon Receipt"<?=($Invoice->Term=="Due Upon Receipt")?" selected=' selected'":""?> >Due Upon Receipt</option>
					<option value="Net 7"     		<?=($Invoice->Term=="Net 7")?" selected=' selected'":""?> >Net 7</option>
					<option value="Net 30" 	  		<?=($Invoice->Term=="Net 30")?" selected=' selected'":""?> >Net 30</option>
					<option value="Net 60"    		<?=($Invoice->Term=="Net 60")?" selected=' selected'":""?> >Net 60</option>
				</select>

				<div class=" shortDate btn-group ml-2">
					<label>Invoice Date</label>
					<input name="iDate" id="iDate"   class=" " type="text" value="<?=decodedate($Invoice->InvoiceDate)?>">
					<a  class="mt20" id="iDateIco"></a>
				</div>

				<div class=" shortDate btn-group ml-2">
					<label>Due Date</label>
					<input name="DueDate" id="DueDate"  class=" " type="text" value="<?=decodedate($Invoice->DueDate)?>" >
					<a   class="mt20" id="DueDateIco"></a>
				</div>				

			</div>


			<div class="clearh50"></div>



		</div>
	</div>


	<!-- all matters title yelllow-->

	<div class="col-xs-12">
		<div class="print">
			<p>Services </p>  
		</div>
	</div>


	<!-- tabla -->

	<div class="col-md-12">
		

		
		
		<div id="resultTable">
			<table  class="table table-bordered table-inverse">
				<thead>
					<tr>
						<th>Date</th>
						<th>Activity</th>
						<th>Description</th>
						<th>Staff</th>
						<th>Rate Fee</th>
						<th>Hours</th>
						<th>Amount</th>
					</tr>
				</thead>

				<tbody>
					<?php
					if(count($Times)>0){
						foreach ($Times as $row){ 
							$Activity=$ci->SecureModel->get('ml_bi_billing_codes',  " AND id=".$row->billing_code);	
							$Staff=$ci->SecureModel->get('ml_us_users',  " AND Id=".$row->id_user);	
							?>
							<tr>
								<td><?=decodedate($row->creation_date)?></td>
								<td><?=$Activity->code?></td>
								<td><?=$row->description?></td>
								<td><?=$Staff->Name?> <?=$Staff->Middle?> <?=$Staff->LastName?></td>
								<td>$<?=$row->rate?></td>
								<td><?=$row->unit?></td> 
								<td><?=$row->amount?></td>
							</tr>
							<?php 
							$totalTimes=$totalTimes+$row->amount;
						}
					}else{
						$totalTimes=0;
					} 
					?>

					<tr>
						<td colspan="9">
							<br>
							<a onclick="add_entry(<?=$Matter->Id?>,'')">
								<img src="<?=base_url()?>img/otrotask.png"> &nbsp; New Entry
							</a>
							<br>
							<br>
						</td>	
					</tr>		

				</tbody>
			</table>



		</div> <!-- fin print table -->   
		

	</div><!-- fin col-md-9 -->





	<!-- all matters title yelllow-->

	<div class="col-xs-12">
		<div class="print">
			<p>Expenses </p>  
		</div>
	</div>


	<!-- tabla -->

	<div class="col-md-12">
		

		
		
		<div id="resultTable">
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
					<tr  >
						<td colspan="8">
							<br>
							<a onclick="add_entry(<?=$Matter->Id?>,'')">
								<img src="<?=base_url()?>img/otrotask.png"> &nbsp; New Entry
							</a>
							<br>
							<br>
						</td>	
					</tr>	

					<tr style="<?=(($Invoice->Status=='Paid')?'display:none':'')?>">
						<td colspan="4">
							<?php 
							if($Invoice->Discount=="true"){
								$displayDiscount='style="display:block"';

							}
							if($Invoice->Discount=="false" OR $Invoice->Discount==""){
								$displayDiscount='style="display:none"  ';
							}
							?>



							<!--APPLY DISCOUNT -->

							<input type="checkbox" name="AppDisc" id="AppDisc" value="true" <?=($Invoice->Discount=="true")?" checked=' checked'":""?> > &nbsp; Apply Discount<br>

							<div id="AppDiscBox" class="AppDiscBox" <?=$displayDiscount?> >

								<label>Type</label>

								<select name="DiscType">
									<option>Select One</option>			
									<option value="porc" <?=("porc"==$Invoice->DiscType)?" selected=' selected'":""?>  onclick="selectedDesc(this.value)" >%</option>
									<option value="mone" <?=("mone"==$Invoice->DiscType)?" selected=' selected'":""?> onclick="selectedDesc(this.value)" >$</option>
								</select>

								<label>Services</label>
								<input type="text" id="discServ"  onkeyup="calDescServ(this.value)" name="discServ" value="<?=$Invoice->DiscServices?>" />

								<label>Expenses</label>
								<input type="text" id="discExpen" onkeyup="calDescExpen(this.value)" name="discExpen" value="<?=$Invoice->DiscExpenses?>" />


							</div>

							<br>
							<br>



							<!--APPLY TAX -->
							<?php 
							if($Invoice->Tax=="true"){
								$displayDiscount='style="display:block"';

							}
							if($Invoice->Tax=="false" OR $Invoice->Discount==""){
								$displayDiscount='style="display:none"  ';
							}
							if($Invoice->DiscPart==0){
								$displayPart = 'style="display:none"';
							}else{
								$displayPart = 'style="display:block"';
							}
							?>

							<input type="checkbox" name="AppTax" id="AppTax" value="true" <?=($Invoice->Tax=="true")?" checked=' checked'":""?>> &nbsp; Apply Tax<br>

							<div id="AppTaxBox" class="AppDiscBox" <?=$displayDiscount?>>

								<label>Value(in %)</label>
								<input type="text"   id="taxValue" name="taxValue" value="<?=$Invoice->TaxValue?>" onkeyup="calTax(this.value)" />

								<label>Applies to</label>

								<select name="TaxApplieTo">
									<option value="Services" <?=("Services"==$Invoice->TaxApplieTo)?" selected=' selected'":""?> onclick="selectedTipeTax(this.value)">Services</option>
									<option value="Expenses" <?=("Expenses"==$Invoice->TaxApplieTo)?" selected=' selected'":""?> onclick="selectedTipeTax(this.value)">Expenses</option>
									<option value="Services_y_Expenses" <?=("Services & Expenses"==$Invoice->TaxApplieTo)?" selected=' selected'":""?> onclick="selectedTipeTax(this.value)" >Services & Expenses</option>
								</select>


							</div>

							<br>
							<br>

							<input type="checkbox" <?=(($Invoice->DiscPart!=0)?" checked='checked'":'')?> name="AppPart" id="AppPart" value="true"> &nbsp; Partial Payment<br>

							<div id="AppPartBox" class="AppDiscBox" <?=$displayPart?>>

								<input type="text" id="PartValue" name="PartValue" value="<?=(($Invoice->DiscPart!="")?"$Invoice->DiscPart":' ')?>" onkeyup="calPart(this.value)" />

							</div>

							<br>
							<br>

							<!--<input type="checkbox" name="show_und" value="true" <?=($Invoice->ShowOutstandingBalances=="true")?" checked=' checked'":""?> > &nbsp; Show outstanding balances<br><br>
							-->

							Comments (Visible to client)<br><br>
							<textarea id="comentario-live" name="comments" style="border:1px solid #f3f3f3; width:390px;"><?=$Invoice->Comments?></textarea>

						</td >

						<td colspan="4">

							<table class="table2">
								<tr>
									<td>
										Total services
									</td>
									<td>
										<input type="hidden" name="totServi_hidden" id="totServi_hidden" value="<?=$totalTimes?>" />
										$<span id="totServi"><?=$totalTimes?></span>
									</td>
								</td>

								<tr>
									<td>
										Total Expenses
									</td>
									<td>
										<input type="hidden" name="totExpen_hidden" id="totExpen_hidden" value="<?=$totalExpense?>" />
										$<span id="totExpen"><?=$totalExpense?></span>
									</td>

								</td>	

								<tr>
									<td>
										Discount
									</td>
									<td>
										<input type="hidden" name="totDesc_hidden" id="totDesc_hidden" value="<?=$Invoice->DiscServices+$Invoice->DiscExpenses?>" />
										$<span id="totDesc"><?=$Invoice->DiscServices+$Invoice->DiscExpenses?></span>
									</td>
								</td>

								<tr>
									<td>
										Partial Payment
									</td>
									<td>
										$<span id='PartialTotal'><?=$Invoice->DiscPart?></span>	
									</td>
								</tr>	

								<tr>
									<td>
										Tax
									</td>
									<td>
										$<span id="taxx"></span>
									</td>
								</td>	

								<tr>
									<td>
										Total Due
									</td>
									<td>
										<input type="hidden" name="totFinal_hidden" id="totFinal_hidden" value="<?=(($Invoice->Status=='Paid')?'0.00':$totalTimes+$totalExpense);?>" />
										$<span id="totFinalWrap">
											<?php 
											$totalFinal=$totalTimes+$totalExpense-$Invoice->DiscPart;
											echo (($Invoice->Status=='Paid')?'0.00':$totalFinal);
											?>

										</span>

										<script type="text/javascript">

											totalFinal="<?=$totalTimes+$totalExpense?>";

											totalParc=totalFinal;

											var taxPorc = "<?=$Invoice->TaxValue?>";

											if(taxPorc=="" || taxPorc==undefined){ taxPorc = 0; }

											totserv=<?=$totalTimes?>;

											<?php 
											if($totalExpense){
												echo  "totexpen=".$totalExpense.";";
											}else{
												echo  "totexpen=0;";  
											}
											if($Invoice->DiscPart!=""){
												echo "var totalPartial =".$Invoice->DiscPart;
											}else{
												echo "var totalPartial =0";
											}
											?> 
											

										</script>


									</td>
								</td>	

							</table>


						</td >

					</tr>

				</tbody>
			</table>

		</div> <!-- fin print table -->

		<div class="row">

			<h4 class="alert-success text-center hidden">Succcessfull payment!</h4>
			<div  class="col-sm-4">


				<input id="preview" value="Preview" class="btn-lg invb previ" onclick=" prew_invoice(<?=$Invoice->Id?>)"   type="button"> 


			</div>
			<style>
			.disabled{
				background: #E2E2E2 !important;
				color: #000 !important;
				border-color: #BABABA !important;
			}
		</style>

		<div  class="col-sm-8">

			<input id="cancel" value="Cancel" class="btn-lg invb fr" type="button" > 

			<input id="saveAsDraft" value="Save as Draft" class="btn-lg invb fr" style="background:#0055a5; border-color:#014483;" type="button">
			<input type="hidden" value="<?=$Invoice->Id?>" id="id_invoice">

			<button type="button" id="makePayment" <?=($Invoice->Status=="Paid"?'disabled=""':'') ?> class="btn-lg invb fr <?=($Invoice->Status=="Paid"?'disabled':'') ?>" style="background:#07bdbf; border-color:#05a894;padding: 8px 18px !important;">Apply Payment</button>


		</div>


	</div>


</div><!-- fin col-md-9 -->





</form>

<!-- Modal -->
<div id="modal-event" class="modal fade modal-mira" role="dialog">
	<div class="loading-modal"></div>
</div>

<script type="text/javascript">
	$('#makePayment').click(function(){
		var id = $('#id_invoice').val();

		$.post(base_url+"Billing/paymentsNew",{id: id},function(response){
			$('#makePayment').addClass('disabled').attr('disabled');
			$('.alert-success').removeClass('hidden');
		});
	});
</script>

<script type="text/javascript">
	function add_entry(id_matter,id_entry){


		$("#modal-event").modal("show");

		id_entry=(id_entry!=undefined) ? id_entry : 0;
		$.post(base_url+"Billing/time_expense_modal?from=billing",{id_matter:id_matter,id_entry:id_entry},function(response){
			$("#modal-event").html(response);
		});
	}

</script>













<script>





	$( "#iDate" ).datepicker({

		format:'DD/MM/YYYY HH:mm',
		inline: true
	});

	$("#iDateIco").click(function() {
		$("#iDate").datepicker("show");
	});


	$( "#DueDate" ).datepicker({

		format:'DD/MM/YYYY HH:mm',
		inline: true
	});

	$("#DueDateIco").click(function() {
		$("#DueDate").datepicker("show");
	});




</script>


