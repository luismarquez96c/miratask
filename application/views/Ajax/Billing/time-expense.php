
<?php $status_op=array("1"=>"Uninvoiced","2"=>"Invoiced","3"=>"Paid" ); ?>

<form name ="listForm" id="listForm"  action="<?=base_app()?>Billing/eraseEntriesConfirm" method="POST" >
	<div class="row">
		<div class="col-xs-12  buttWrap">
			<!-- boton " + add Matters"-->

			<div class="col-md-3 pl0">
				<a id="add_matters"   class="btn btn-primary btn-lg btn-block" onclick="add_entry(0)" >
					<i class="fa fa-plus"></i> &nbsp; Add Entry
				</a>
			</div>


			<!-- boton " Delete Matters" -->
			<div class="col-md-3">
				<input type="submit" id="delete_matters"  class="btn fa-trash btn-block" value="&#xf1f8; Delete Entry" style="font-family:Arvo, FontAwesome" />
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
			<p>Time & Expense Entries </p> <span onclick="printTMatters()" class="fa fa-print"></span>
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



				<?=$this->session->userdata("Timesxpage")?>
				
				<span class="caret"></span>

			</button>

			<ul class="dropdown-menu btn-block" role="menu">
				<li><a href="<?=base_app()?>Billing/MAxResultXPage/5">5</a></li>
				<li><a href="<?=base_app()?>Billing/MAxResultXPage/10">10</a></li>
				<li><a href="<?=base_app()?>Billing/MAxResultXPage/15">15</a></li>
				<li><a href="<?=base_app()?>Billing/MAxResultXPage/20">20</a></li>
				<li><a href="<?=base_app()?>Billing/MAxResultXPage/30">30</a></li>
			</ul>
		</div>
		<div class="resultInfo col-md-4">
			<?=$startItem?>-<?=$endItem?> of <?=$totalTimes?> items
		</div>
		<div class="clearh1"></div>
	</div>


	<div id="resultTable">
		<table class="table table-bordered table-inverse">
			<thead>
				<tr>
					<th></th>
					<th>Type</th>
					<th>Date</th>
					<th>Billing Code</th>
					<th width="80">Time/<br />Quantity</th>
					<th  width="80">Rate/<br />Cost ($)</th>
					<th>Total</th><th  width="250">Matter</th>
					<th>Status</th>
				</tr>

			</thead>
			<tbody>
				<?php foreach($billing as $i => $acti): 
				if($acti->type_entry=="TIME"){
					$timeIco="billing_clok.png";
				}elseif($acti->type_entry=="EXPENSE"){
					$timeIco="expense.png";
				}
				

				?>

					<tr entry="<?=$acti->id ?>">
						<td><input type="checkbox" name="ItemID[]" id="ItemID[]" value="<?=$acti->id ?>" ></td>
						<td>
						 <img src="<?=base_url()?>img/<?=$timeIco?>" style="width:16px; height:16px;" > 
						</td>
						<td><a href="javascript: add_entry(0,'<?=$acti->id ?>')"> <?=decodedate($acti->date_activity)?></a></td>
						<td><?=$acti->code ?></td>
						<td><?=$acti->units ?></td>
						<td>$<?=$acti->rate ?></td>
						<td>$<?=$acti->amount ?></td>
						<td><?=$acti->name_matter ?></td>
						<td><?=$status_op[$acti->status] ?></td>
					</tr>
				<?php endforeach; ?>
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