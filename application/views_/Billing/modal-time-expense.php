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
<form id="timeexp" method="post" action="<?=base_url("Billing/save_time_expense") ?>" class="form-time-expense">
	<input type="hidden" id="" name="redirAfterSend"   value="<?=$redirAfterSend?>" />
	<input type="hidden" id="" name="id" value="<?=_v($entry->id,0)?>" placeholder="" />

	<?php if($this->input->get("from") && $this->input->get("from")=="billing"): ?>
		<input type="hidden" id="" name="from" value="billing" placeholder="" />
	<?php endif; ?>
	<div class="modal-dialog w700 form-events">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
				<h4 class="modal-title"><span class="glyphicon glyphicon-calendar"></span> <?=(isset($entry->id)? "Edit" : "Add" ) ?> Time and Expense</h4>
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
	$(".calendar").datepicker({ "dateFormat":'mm/dd/yy',  changeMonth: true, changeYear: true});
</script>
<script type="text/javascript">

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
			$(".for-time").show();
			$(".for-expense").hide();
		}else{
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
