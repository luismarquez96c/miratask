<br />
<?php 
$status_op=array("1"=>"Uninvoiced","2"=>"Paid" );
$ci =&get_instance();
$ci->load->model("BillingModel");
?>
<div>
	<div class="row">
		<div class="col-xs-12">
			<a href="javascript:add_entry(<?=$Matter->Id ?>)" class="btn btn-primary">Add Entry</a>
		</div>
	</div>
</div>
<table class="table table-bordered table-inverse">
	<thead>
		<tr>
			<th>Number</th><th>Date</th><th>Billing Code</th><th>Time/Quantity</th><th>Rate/Cost ($)</th><th>Total</th><th>Status</th><th>Delete</th>
		</tr>

	</thead>
	<tbody>
		<?php foreach($billing as $i => $acti): 
			?>
			<tr>
				<td><?=$acti->InvoiceNumber?></td>
				<td><a href="javascript: add_entry(0,'<?=$acti->id ?>')"> <?=$acti->date_activity ?></a></td>
				<td><?=$acti->code ?></td>
				<td><?=$acti->units ?></td>
				<td>$<?=$acti->rate ?></td>
				<td>$<?=$acti->amount ?></td>
				<td>
					<?php 
					$status = $ci->BillingModel->get_info_invoice($acti->InvoiceNumber);
					echo $status->Status;
					?>
					
				</td>
				<td align='center'><a href="<?=base_url('Billing/eraseEntriesConfirmGet/'.$acti->id.'/'.$Matter->Id)?>"><img src="<?=base_url('/img/status_2.jpg')?>"></a></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<!-- Modal -->
<div id="modal-event" class="modal fade modal-mira" role="dialog">
	<div class="loading-modal"></div>
</div>
<script type="text/javascript">
	function add_entry(id_matter,id_entry){
		$("#modal-event").modal("show");

		id_entry=(id_entry!=undefined) ? id_entry : 0;
		$.post(base_url+"Billing/time_expense_modal",{id_matter:id_matter,id_entry:id_entry},function(response){
			$("#modal-event").html(response);
		});
	}
</script>
<?php if($this->input->get("tab") && $this->input->get("tab")=="billing"): ?>
<script type="text/javascript">$('[href="#tcontenido6"]').click();</script>
<?php endif; ?>

<?php if($this->input->get("tab") && $this->input->get("tab")=="notes"): ?>
<script type="text/javascript">$('[href="#tcontenido4"]').click();</script>
<?php endif; ?>
<?php if($this->input->get("tab") && $this->input->get("tab")=="records"): ?>
<script type="text/javascript">$('[href="#tcontenido3"]').click();</script>
<?php endif; ?>