<style type="text/css">
.form-events .form-control{
	min-width: 0px !important;
	background-color: #fff;
}
.form-events textarea.form-control{ height: auto !important; }
.modal-body .tabs-modal{
	height: 42px;
	border-bottom: 1px solid #dfdfdf;
}
.modal-body .tabs-modal .tab-modal{
	color: #2c2c2d;
	font-size: 14px;
	padding: 0px;
	text-align: center;
	height: 100%;
	min-width: 180px;
	display: inline-block;
	line-height: 42px;
	border-right: 1px solid #dfdfdf;
	cursor: pointer;
}
.modal-body .tabs-modal .tab-modal.active{
	background: #dfdfdf;
}
.body-tabs-modal-container{
	padding: 15px;
}
.bg-shadow{
	background: #f2f6fa;
	margin-right: -15px;
	margin-left: -15px;
	padding:15px;
	margin-top: 15px;
	margin-bottom: 15px;
}
.item-attach{
	min-height: 25px;
	height: auto;
}
</style>
<?php print_r($entry) ?>
<form id="timeexp" method="post" action="<?=base_url("Billing/save_time_expense") ?>" class="form-time-expense">
	<input type="hidden" id="" name="redirAfterSend"   value="<?=$redirAfterSend?>" />
	<input type="hidden" id="" name="id" value="<?=_v($entry->id,0)?>" placeholder="" />

	<?php if($this->input->get("from") && $this->input->get("from")=="billing"): ?>
	<input type="hidden" id="" name="from" value="billing" placeholder="" />
<?php endif; ?>
<div class="modal-dialog w700 form-events">
	<!-- Modal content-->
	<div class="modal-content" style="">
		<div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
			<h4 class="modal-title">
				<span class="glyphicon glyphicon-calendar"></span> 
				<?=(isset($entry->id)? "Edit" : "Add" ) ?> Time and Expense
				<span class="close" onclick="switchx('timeexp')">x</span>
			</h4>
		</div>
		<div class="modal-body no-padding">
			<div class="tabs-modal">


				<div class="tab-modal <?=(!isset($entry->type_entry) || (isset($entry->type_entry) && $entry->type_entry=="TIME")) ? "active":"" ?>" target="tab-time">

					<img src="<?=base_url()?>img/time_icon_button.png">
					Time 
					
					<input type="radio" name="type_entry" value="TIME"  <?=(!isset($entry->type_entry)?'checked=""':'') ?>  style="display: none" <?=(isset($entry->type_entry) && $entry->type_entry=="TIME") ? "checked":"" ?> />

				</div>



				<div class="tab-modal <?=(isset($entry->type_entry) && $entry->type_entry=="EXPENSE") ? "active":"" ?>" target="tab-expense">

					<img src="<?=base_url()?>img/expense.png">

					Expense <input type="radio" name="type_entry" value="EXPENSE" style="display: none" <?=(isset($entry->type_entry) && $entry->type_entry=="EXPENSE") ? "checked":"" ?> />

				</div>

				<div class="tab-modal <?=(isset($entry->type_entry) && $entry->type_entry=="RANGE") ? "active":"" ?>" target="tab-range">

					<img src="<?=base_url()?>img/time_icon_button.png">

					New Billing <input type="radio" name="type_entry" value="RANGE" style="display: none" <?=(isset($entry->type_entry) && $entry->type_entry=="RANGE") ? "checked":"" ?> />

				</div>


			</div>
			<div class="body-tabs-modal-new-billing" style="display: none;">
				<div class="tab-pane" role="tabpanel" id="step3">

					<div id="contorno" class="col-md-12">

						<div class="forms">
							<div class="panel-body">
								<p>Enter basic matter informations. The information can be added or edited at any time once the matter is created.</p>
							</div>
						</div>
						<br>


						<div class="allInputContainer">




							<div class="clearh20"></div>


							<div class="form-group row">

								<div class="col-md-6">
									<form class="form-horizontal" action="#" id="form-new-billing">
										<input type="hidden" id="id_matter" value="<?=$this->input->post('id_matter');?>">
										<label for="" name="id" class="col-sm-1 col-form-label">Total Amount  </label>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-usd"></span>
											</span>
											<input style="width: 175px"  type="text" class="form-control calcule-billing"   placeholder="" id="TotalAmount" name="TotalAmount" value="<?= set_value('TotalAmount');?>" />
										</div>


									</div>
									<div class="col-md-6">
										<label for="" class="col-sm-1 col-form-label">Initial Fee </label>
										<div class="input-group">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-usd"></span>
											</span>
											<input style="width: 175px" type="text" id="Initial_Fee" name="Initial_Fee" class="form-control calcule-billing" id="Initial_Fee" value="" />
										</div>


										<label for="" class="col-sm-1 col-form-label">Fee  </label>


										<div class="input-group">
											<span class="input-group-addon">
												<span class="glyphicon glyphicon-usd"></span>
											</span>
											<input style="width: 175px" type="text" id="Fee" name="Fee" class="form-control calcule-billing" id="Fee" value="<?=set_value('Fee')?>" />
										</div>
									</div>

								</div>



								<div class="form-group row">	


									<div class="col-md-6">
										<label for="" class="col-sm-1 col-form-label">Start Date</label>

										<script>
											$( function() {
												$( "#StartDate" ).datepicker({
													constrainInput: true
												});

												$("#calendarIco1").click(function() {
													$("#StartDate").datepicker("show");
												});
											});


										</script>
										<div class="input-group">	 
											<input type="text" readonly="" style="z-index: 10000;" id="StartDate" name="StartDate" class="form-control blueText calcule-billing" id="StartDate" autocomplete="off"  value="<?= set_value('StartDate');?>"   />

											<div  id="calendarIco1" style="z-index: 1000000"></div>  
										</div> 
									</div>



									<div class="col-md-6">
										<label for="" class="col-sm-1 col-form-label">End Date</label>

										<script>
											/* $( function() {
													$( "#EndDate" ).datepicker({
														constrainInput: true
													});
													
													$("#calendarIco2").click(function() {
														$("#EndDate").datepicker("show");
													});
												});*/


											</script>
											<div class="input-group">	 
												<input type="text" id="EndDate"  style="z-index: 101000" readonly="" name="EndDate" class="form-control blueText" id="EndDate" autocomplete="off"  value="<?= set_value('EndDate');?>"   />

												<div  id="calendarIco2" style="z-index: 101000" ></div>  
											</div> 
										</div>


									</div><!-- fin row -->





									<div class="form-group row">		
										<div class="col-md-6">					
											<label for="" class="col-sm-1 col-form-label">Periodicity</label>


											<select name="Periodicity" id="Period" class="form-control blueText calcule-billing" placeholder=""> 

												<option value="-1">Select One</option>
												<option <?=(set_value('Periodicity')=="0"?"selected":"") ?> value="0">Only</option>
												<option <?=(set_value('Periodicity')=="1"?"selected":"") ?> value="1">Weekly</option>
												<option <?=(set_value('Periodicity')=="2"?"selected":"") ?> value="2">BiWeekly</option>
												<option <?=(set_value('Periodicity')=="3"?"selected":"") ?> value="3">Monthly</option>
												<option <?=(set_value('Periodicity')=="4"?"selected":"") ?> value="4">Bimonthly</option>
												<option <?=(set_value('Periodicity')=="5"?"selected":"") ?> value="5">Quartely</option>

											</select>

										</div>

										<div class="col-md-6 payday" style="display: <?=((int)set_value('Periodicity')>2?'inline-block':'none') ?>"> 
											<label for="" class="col-sm-1 col-form-label">Day of month to pay</label>


											<select class="form-control blueText" placeholder="" name="PerDay" id="PerDay"> 
												<option value="-1">Select One</option>
												<?php for($i=1;$i<=31;$i++): ?>
													<option values="<?=$i ?>"><?=$i ?></option>
												<?php endfor; ?>
											</select>  
										</div>

									</div>
									<div class="message-area" style="display: none"><div class="message-system"></div></div>





									<br>
									<br>

									<hr>

									<br>
									<br>

									<div class="form-group row fitButtons">

										<label for="" class="col-sm-1 col-form-label"></label>
										<div class="col-md-3">
											<input  id="save_close" type="button" value="Save and Close" class="btn btn-primary btn-lg btn-block"> 
										</div>

										<div class="col-md-3">
											<a href="<?=base_app()?>Matters" id="cancel" type="button" class="btn btn-primary btn-lg btn-block"> Cancel

											</a>
										</div>


									</div>





								</div><!-- fin all input container -->  



							</div><!-- Fin contorno -->
						</form>
					</div>

				</div>
				<div class="body-tabs-modal-container">

					<div class="row">
						<div class="col-xs-2 text-right">
							<label>Billing Code*</label>
						</div>
						<div class="col-xs-4">
							<select class="form-control" name="billing_code">
								<option value="-1">-Select a Billing Code-</option>
								<?php foreach($billing_codes as $i => $bc): ?>
									<option value="<?=$bc->id ?>" <?=(isset($entry->billing_code) && $entry->billing_code==$bc->id)?"selected":"" ?>><?=$bc->code ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="col-xs-2 text-right">
							<label>Date</label>
						</div>
						<div class="col-xs-4">
							<input type="text" id="" name="date" value="<?=isset($entry->date_activity)? date_to_str($entry->date_activity) :"" ?>" placeholder="" class="form-control calendar" />
						</div>
					</div>
					<div class="row">
						<div class="col-xs-2 text-right">
							<label>Matter*</label>
						</div>
						<div class="col-xs-4">
							<div class="input-autocomplete">
								<input type="text" id="attach_search" name="" value="" placeholder="" class="form-control autocomplete" />
								<div class="list-autocomplete">

								</div>
								<div class="attach-selected">
									<?php if(isset($default_matter)): ?>
										<div class="item-attach"><?=$default_matter->Name ?>
										<input type="hidden" id="" name="id_attach[]" value="<?=$default_matter->Id ?>" /><input type="hidden" id="" name="type_attach[]" value="MATTER" />
										<span class="remove glyphicon glyphicon-remove"></span>
									</div>
								<?php endif; ?>


								<?php if(isset($entry->id_matter)): ?>
									<div class="item-attach"><?=$entry->matter_name ?>
									<input type="hidden" id="" name="id_attach[]" value="<?=$entry->id_matter ?>" /><input type="hidden" id="" name="type_attach[]" value="MATTER" />
									<span class="remove glyphicon glyphicon-remove"></span>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-xs-2 text-right">
					<label>User</label>
				</div>
				<div class="col-xs-4">
					<select class="form-control" name="user">
						<?php foreach($owners as $i => $item): ?>
							<option value="<?=$item->Id ?>" <?=($item->Id==(!isset($entry->id_user) && userget()->id? userget()->id : $entry->id_user )? 'selected' :'') ?> ><?=$item->Name." ".$item->LastName ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-2 text-right">
					<label>Description</label>
				</div>
				<div class="col-xs-10">
					<textarea class="form-control" rows="2" style="resize: none;" name="description"><?=_v($entry->description) ?></textarea>
				</div>
			</div>
			<div class="bg-shadow for-time">
				<div class="row">
					<div class="col-xs-2 text-right">
						<label>Charge Type*</label>
					</div>
					<div class="col-xs-4">
						<select class="form-control" name="is_flat_fee">
							<option <?=(isset($entry->is_flat_fee)&& $entry->is_flat_fee==0)? "selected" :"" ?> value="0">Hourly Rate</option>
							<option <?=(isset($entry->is_flat_fee)&& $entry->is_flat_fee==1)? "selected" :"" ?> value="1">Flat Fee</option>
						</select>
					</div>
					<div class="col-xs-2 text-right">
						<label class="fee-label">Rate/Hour</label>
					</div>
					<div class="col-xs-4">
						<input type="number" id="" name="rate" value="<?=_v($entry->rate) ?>" placeholder="" class="form-control autocalcule-time"  step="0.01" />
					</div>
				</div>
				<div class="row no-fee" <?=(isset($entry->is_flat_fee)&& $entry->is_flat_fee==1)? "style='display:none'" :"" ?>>
					<div class="col-xs-2 text-right">
						<label>Duration</label>
					</div>
					<div class="col-xs-4">
						<input type="number" id="" name="units" value="<?=_v($entry->units) ?>" placeholder="" class="form-control autocalcule-time"  step="0.01" />
						<br />
						<span class="hour-text">0 Hours: 0 minutes</span><br />
						<input type="checkbox" id="" name="no_charge" value="1" <?=(isset($entry->no_charge) && $entry->no_charge==1? "checked" : "") ?> /> <span>No charge</span>
					</div>
					<div class="col-xs-2 text-right">
						<label>Total ($)</label>
					</div>
					<div class="col-xs-4">
						<input type="text" id="" name="amount" value="<?=_v($entry->amount) ?>" placeholder="" class="form-control" readonly="" />
					</div>
				</div>
			</div>
			<div class="bg-shadow for-expense" style="display: none">
				<div class="row">
					<div class="col-xs-2 text-right">
						<label>Cost</label>
					</div>
					<div class="col-xs-4">
						<input type="number" id="" name="rate_expense" value="<?=_v($entry->rate) ?>" placeholder="" class="form-control autocalcule-expense"  step="0.01" />
					</div>
					<div class="col-xs-2 text-right">
						<label>Quantity</label>
					</div>
					<div class="col-xs-4">
						<input type="number" id="" name="units_expense" value="<?=_v($entry->units) ?>" placeholder="" class="form-control  autocalcule-expense"  step="0.01" />
					</div>
				</div>
				<div class="row">
					<div class="col-xs-2 text-right">
						<label>Total ($)</label>
					</div>
					<div class="col-xs-4">
						<input type="text" id="" name="total_expense" value="<?=_v($entry->amount) ?>" placeholder="" class="form-control "  readonly="" />
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-xs-2 text-right">
					<label>Notes</label>
				</div>
				<div class="col-xs-10">
					<textarea name="notes" class="form-control" rows="2" style="resize: none;"><?=_v($entry->notes) ?></textarea>
				</div>
			</div>
			<div class="message-area" style="display: none">
				<div class="message-system"></div>
			</div>
			<div class="text-right">
				<input type="button" id="cancel" name="" style="width: 150px" value="Cancel" class="btn  btn-primary" data-dismiss="modal" />
				<?php if($sendViaAjax=='si'){ ?>   
					<input type="button" id="save_close"  onclick="savetime()" name="" style="width: 150px" value="Save" class="btn  btn-primary" />
				<?php }else{?>
					<input type="submit" id="save_close" name="" style="width: 150px" value="Save" class="btn  btn-primary" />
				<?php }?>	
			</div>
		</div>

	</div>
</div>
</div>
</div>



</form>
<script type="text/javascript">
	$(".calcule-billing").change(function(){
		calcular_billing();

	});
	function calcular_billing(){
		total=Number($('[name="TotalAmount"]').val());
		initial_fee=Number($('[name="Initial_Fee"]').val());
		fee=Number($('[name="Fee"]').val());
		start_date=str2date($('[name="StartDate"]').val());
		periodicity=$('[name="Periodicity"]').val();
		fecha_fin="";
		pay_day=$('[name="PerDay"]').val();

		totalPay=total-initial_fee;
		
		if(fee>totalPay || fee==0){
			$('[name="Fee"]').val(totalPay);
		}
		if(start_date==false){
			return;
		}
		if(fee==0){
			fee=total;
		}
		if(periodicity>2){
			$(".payday").show();
			$('.modal-content').css('height','858px');
		}else{
			$(".payday").hide();
		}
		fee_rate=Math.ceil(totalPay/fee);

		switch(periodicity){
			case "0": // pago unico
			fecha_fin=date2str(start_date);
			$('[name="Fee"]').val(totalPay);
			break;
			case "1": // semanal
			fecha_fin=start_date;
			for(i=1;i<=fee_rate;i++){
				fecha_fin=fecha_fin.addDays(7);
			}
			fecha_fin=date2str(fecha_fin);
			break;
			case "2": // cada 15 dias
			
				//alert(fee_rate);
				fecha_fin=start_date;
				for(i=1;i<=fee_rate;i++){
					fecha_fin=fecha_fin.addDays(15);
				}
				fecha_fin=date2str(fecha_fin);
				break;
			case "3": // mensual
			

			fecha_fin=start_date;

			for(i=1;i<=fee_rate;i++){
				fecha_fin=new Date(fecha_fin.setMonth(fecha_fin.getMonth()+1));
			}
			fecha_fin=date2str(fecha_fin);
			break;
			case "4": // Bi mensual


			fecha_fin=start_date;

			for(var i=1;i<=fee_rate;i++){
				fecha_fin=new Date(fecha_fin.setMonth(fecha_fin.getMonth()+2));

			}
			fecha_fin=date2str(fecha_fin);
			break;
			case "5": // trimensual

			fecha_fin=start_date;

			for(i=1;i<=fee_rate;i++){
				fecha_fin=new Date(fecha_fin.setMonth(fecha_fin.getMonth()+3));

			}
			fecha_fin=date2str(fecha_fin);
			break;
		}

		$('[name="EndDate"]').val(fecha_fin);
	}

	function str2date(str){
		str=str.split("/");
		if(str.length<3){
			return false;
		}
		return new Date(str[2],str[0]-1,str[1],0,0,0);
	}
	function date2str(d){
		return ((d.getMonth()+1)<10?"0"+(d.getMonth()+1):(d.getMonth()+1))+"/"+(d.getDate()<10?"0"+d.getDate():d.getDate())+"/"+ d.getFullYear();
	}

	$(".form-horizontal").submit(function(e){
		$(".message-area .message-system").html("").removeClass('error, success').parent().hide();

		total=Number($('[name="TotalAmount"]').val());

		fee=Number($('[name="Fee"]').val());
		start_date=str2date($('[name="StartDate"]').val());
		periodicity=$('[name="Periodicity"]').val();

		if(total==0){
			$(".message-area .message-system").html("Invalid Total Amount ").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}
		if(start_date==false){
			$(".message-area .message-system").html("Select a valid date").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}
		if(periodicity==-1){
			$(".message-area .message-system").html("Select a periodicity").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}
		if(fee==0){
			$(".message-area .message-system").html("Invalid Fee").addClass('error').parent().show();
			$("#Ballnext3").click();
			return false;
		}
		
		


	});
</script>
<script type="text/javascript">
	$(".calendar").datepicker({ "dateFormat":'mm/dd/yy',  changeMonth: true, changeYear: true});
</script>
<script type="text/javascript">

	$("#form-new-billing").submit(function(){
		savetime();
	});

	function savetime(){

		var url = base_app+"Billing/save_time_expense"; 

		$.ajax({
			type: "POST",
			url: url,
			data: $("#timeexp").serialize(),
			success: function(data)
			{
				data.trim();
				if(data==0){

					alert("No saved something wrong!"); 



				}else if(data==1){

					alert("Task completed Succeful!"); 


					$("#modal-event").modal("hide");

					updateTask('<?=$taskid?>');



				} 
			}
		});

	}
	

	$(document).off('keyup', ".autocomplete");
	$(document).on("keyup",".autocomplete",function(){
		auto=$(this).parent();
		search=$(this).val().trim();
		$.post(base_url+'calendar/attach_search',{search:search},function(data){
			if(data.error==0){
				result=data.data;
				auto.find(".list-autocomplete").html("");
				for(i in result){
					attach=result[i];
					auto.find(".list-autocomplete").append('<div class="item-autocomplete" data-id="'+attach.Id+'" data-name="'+attach.Name+'" data-type="'+attach.type+'">'+attach.Name+'<span>'+attach.type+'</span></div>');
				}
				auto.find(".list-autocomplete").show();
			}
		},'json');
		
	});
	$(document).off("click",".list-autocomplete .item-autocomplete");
	$(document).on("click",".list-autocomplete .item-autocomplete",function(){

		//alert("here");

		id=$(this).data("id");
		name=$(this).data("name");
		type=$(this).data("type");

		auto=$(this).closest('.input-autocomplete');

		html='<div class="item-attach">'+name;
		html+='		<input type="hidden" id="" name="id_attach[]" value="'+id+'" /><input type="hidden" id="" name="type_attach[]" value="'+type+'" />';
		html+='		<span class="remove glyphicon glyphicon-remove"></span>';
		html+='</div>';



		$(".attach-selected").html(html);
		$(this).parent().hide().html("");
		auto.find(".autocomplete").val("");
	});

	$(document).off("focusout",".autocomplete");
	$(document).on("focusout",".autocomplete",function(){
		auto=$(this).parent();
		setTimeout(function(){
			auto.find(".list-autocomplete").hide();
		},200);
		
	});
	$(document).off("focusin",".autocomplete" );
	$(document).on("focusin",".autocomplete",function(){
		auto=$(this).parent();
		auto.find(".list-autocomplete").show();
	});
	$(document).off("click",".item-attach .remove");
	$(document).on("click",".item-attach .remove",function(){
		$(this).parent().fadeOut(500,function(){
			$(this).remove();
		});
	});
</script>
<script type="text/javascript">
	var is_flat_fee=0;
	$('[name="is_flat_fee"]').change(function(){
		if($(this).val()==1){
			is_flat_fee=true;
			$(".fee-label").text("Fee");
			$(".no-fee").hide();
		}else{
			$(".fee-label").text("Rate/Hour");
			$(".no-fee").show();
		}
	});
	$(".autocalcule-time").change(function(){
		total=0;
		if(!is_flat_fee){
			rate=$('[name="rate"]').val();
			units=$('[name="units"]').val();

			total=Math.round((rate*units) * 100) / 100;
			$('[name="amount"]').val(total.toFixed(2));
			$(".hour-text").text(decimals2hours(units));

		}
	});
	$(".autocalcule-expense").change(function(){
		total=0;
		cost=$('[name="rate_expense"]').val();
		qty=$('[name="units_expense"]').val();
		total=Math.round((cost*qty) * 100) / 100;
		$('[name="total_expense"]').val(total.toFixed(2));
	});
	function hours2decimals(){

	}
	function decimals2hours(decimals){
		h=Math.floor(decimals/1);
		m=Math.round((decimals-h)*60);
		return h+" Hours: "+m+" minutes";

	}
	$(".tab-modal").click(function(){
		$(".tab-modal").removeClass("active");
		$(this).addClass("active");
		$(this).find('[type="radio"]').prop("checked",true);
		type_entry=$(this).find('[type="radio"]').val();
		if(type_entry=='TIME'){
			$(".body-tabs-modal-new-billing").hide();
			$(".body-tabs-modal-container").show();
			$(".for-time").show();
			$(".for-expense").hide();
			$('.modal-content').css('height',' ');
		}if (type_entry=='RANGE') {
			$('.modal-content').css('height','816px');
			$(".body-tabs-modal-container").hide();
			$(".body-tabs-modal-new-billing").show();

		}
		else{
			$('.modal-content').css('height','');
			$(".body-tabs-modal-new-billing").hide();
			$(".body-tabs-modal-container").show();
			$(".for-time").hide();
			$(".for-expense").show();
		}
	});

	$(".form-time-expense").submit(function(){
		$(".message-area .message-system").html("").removeClass('error, success').parent().hide();
		if($('[name="billing_code"]').val()=="-1"){
			$(".message-area .message-system").html("Select a billing code").addClass("error").parent().show();
			return false;
		}
		if($('[name="date"]').val().trim()==""){
			$(".message-area .message-system").html("Invalid date").addClass("error").parent().show();
			return false;
		}
		if($('[name="id_attach[]"]').size()==0){
			$(".message-area .message-system").html("Select a matter").addClass("error").parent().show();
			return false;
		}

		return true;
	});
</script>


<script>
	$('#save_close').click(function(){
		var matter = $('#id_matter').val();
		var total = $('#TotalAmount').val();
		var initial = $('#Initial_Fee').val();
		var fee = $('#Fee').val();
		var start = $('#StartDate').val();
		var end = $('#EndDate').val();
		var period = $('#Period').val();
		var perday = $('#PerDay').val();

		var ajax = {Matter: matter, Total: total, Initial: initial, Fee: fee, Start: start, End: end, Period: period, Perday: perday};

		$.ajax({
			type: "POST",
			url: base_app+'Billing/New_Billing',
			data: ajax,
			success: function(response)
			{
				alert('Save');
				$('#modal-event').modal('hide');
				var url = location.href;
				window.location.href = url+'?tab=billing';
			}
		});

	});


</script>
