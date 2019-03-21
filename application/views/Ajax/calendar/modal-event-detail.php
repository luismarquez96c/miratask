<style type="text/css">
.time-item{
	width:  100%;
	position: relative;
}
.time-item select{
	position: absolute;
	right: 0px;
	top: 0px;
	border: 1px solid #e6e6e6;

	background: none;
}
</style>
<?php //$this->load->view('include-scripts'); ?>
<?php //if(!$this->input->get("fromMatter")): ?>

<?php //endif; ?>

<form method="post" action="<?=base_url("calendar/save_event") ?>" class="form-save-event">
	<input type="hidden" id="" name="id" value="<?=_v($event->id,0)?>" placeholder="" />
	<div class="modal-dialog w700">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><span class="glyphicon glyphicon-calendar"></span> <?=(isset($event->id)? "Edit" : "Add" ) ?> Event</h4>
			</div>
			<div class="modal-body">
				<div class="panel-event form-events">
					<div class="panel-event-options"></div>

					<div class="row">
						<div class="col-xs-3 text-right">
							<label>Owner</label>
						</div>
						<div class="col-xs-8">

							<select class="form-control" name="owner">
								<?php foreach($owners as $i => $item): ?>
									<option value="<?=$item->Id ?>" <?=($item->Id==(!isset($event->id_user) && userget()->id? userget()->id : $event->id_user )? 'selected' :'') ?> ><?=$item->Name." ".$item->LastName ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 text-right">
							<label>Subject*</label>
						</div>
						<div class="col-xs-8">

							<input type="text" id="" name="subject" value="<?=_v($event->subject) ?>" placeholder="" class="form-control" required="" />

						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 text-right">
							<label>Location</label>
						</div>
						<div class="col-xs-8">

							<input type="text" id="" name="location" value="<?=_v($event->location) ?>" placeholder="" class="form-control" />

						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 text-right">
							<label>Start Time</label>
						</div>
						<div class="col-xs-3">
							<input type="text" id="" name="start_date" value="<?=isset($event->start_fulldate)?extrac_date($event->start_fulldate,"m/d/Y"): $date ?>" class="form-control calendar mask-date" placeholder="00/00/0000" required="" />
						</div>
						<div class="col-xs-3 col-xs-offset-1">
							<div class="time-item">
								<input type="hidden" name="start_time" value="<?=isset($event->start_fulldate)?extrac_date($event->start_fulldate,"H:i"): minutes_to_hours($minute) ?>" placeholder="" />
								<input type="text" id="start_time"  value="" class="form-control mask-hour start-hour" placeholder="00:00" required="" />
								<select class="time-ampm">
									<option value="am">A.M.</option>
									<option value="pm">P.M.</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 text-right">
							<label>End Time</label>
						</div>
						<div class="col-xs-3">
							<input type="text" id="" name="end_date" value="<?=isset($event->end_fulldate)?extrac_date($event->end_fulldate,"m/d/Y"): $date ?>" class="form-control calendar mask-date"  placeholder="00/00/0000" required=""/>
						</div>
						<div class="col-xs-3 col-xs-offset-1">
							<div class="time-item">
								<input type="hidden" id="" name="end_time" value="<?=isset($event->end_fulldate)?extrac_date($event->end_fulldate,"H:i"): minutes_to_hours($minute+60) ?>"/>
								<input type="text" id="end_time" name="" value="" class="form-control mask-hour end-hour" placeholder="00:00"  required=""/>
								<select class="time-ampm">
									<option value="am">A.M.</option>
									<option value="pm">P.M.</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-3">
							</div>
							<script type="text/javascript">

								$('#allday').click(function () {

									var $this = $(this);

									if ($this.is(':checked')) {

										$('#start_time').removeAttr( "required");
										$('#end_time').removeAttr( "required");

										$('#start_time').val("06:00").change();
										$('#end_time').val("23:59").change();

									}else {

										$('#start_time').attr( "required", "Beijing Brush Seller" );
										$('#end_time').attr( "required", "Beijing Brush Seller" );

										$('#start_time').val("00:00").change();
										$('#end_time').val("00:00").change();

									}

								});

							</script>
							<div class="col-xs-8">
								<input type="checkbox" id="allday" name="allday" value="1" <?=isset($event->all_day) && $event->all_day==1? 'checked' : '' ?> /> All Day Event
							</div>
						</div>
						<div class="row">
							<div class="col-xs-3 text-right">
								<label>Attach To</label>
							</div>
							<div class="col-xs-8">
								<div class="input-autocomplete">
									<input type="text" id="attach_search" name="" value="" placeholder="" class="form-control autocomplete" />
									<div class="list-autocomplete">

									</div>
								</div>
								<div class="attach-selected">
									<?php if(!isset($event->attachs) && $default_matter!=false): ?>
										<div class="item-attach"><?=$default_matter->Name ?>
										<input type="hidden" id="" name="id_attach[]" value="<?=$default_matter->Id ?>" /><input type="hidden" id="" name="type_attach[]" value="MATTER" />
										<span class="remove glyphicon glyphicon-remove"></span>
									</div>
								<?php endif; ?>
								<?php if(isset($event->attachs)): 
									foreach($event->attachs as $i => $item): ?>
										<div class="item-attach"><?=$item->name_attach ?>
										<input type="hidden" id="" name="id_attach[]" value="<?=$item->id_attach ?>" /><input type="hidden" id="" name="type_attach[]" value="<?=$item->type_attach ?>" />
										<span class="remove glyphicon glyphicon-remove"></span>
									</div>
								<?php 	endforeach;
							endif;
							?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-3 text-right">

					</div>
					<div class="col-xs-8">
						<textarea class="form-control" name="description" style="height:100px;"><?=_v($event->description) ?></textarea>
					</div>
				</div>

				<div class="message-area" style="display: none">
					<div class="message-system"></div>
				</div>
				<br />
				<div class="row">
					<div class="col-xs-11 text-right">
						<input type="button" id="cancel" name="" style="width: 150px" value="Cancel" class="btn  btn-primary" data-dismiss="modal" />
						<input type="submit" id="save_close" name="" style="width: 150px" value="Save" class="btn  btn-primary" />
					</div>
				</div>
			</div>
		</div>

	</div>

</div>
</form>
<script type="text/javascript">


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

		//alert("herre");

		id=$(this).data("id");
		name=$(this).data("name");
		type=$(this).data("type");

		auto=$(this).closest('.input-autocomplete');
		html='<div class="item-attach">'+name;
		html+='		<input type="hidden" id="" name="id_attach[]" value="'+id+'" /><input type="hidden" id="" name="type_attach[]" value="'+type+'" />';
		html+='		<span class="remove glyphicon glyphicon-remove"></span>';
		html+='</div>';

		$(".attach-selected").append(html);
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

	$(document).ready(function() {
	/*$(".calendar").datepicker( "destroy" );
	$(".calendar").removeClass("hasDatepicker").removeAttr('id');
	$(".calendar").datepicker({ "dateFormat":'mm/dd/yy',  changeMonth: true, changeYear: true});*/
});




</script>
<script type="text/javascript">
	
	$(".form-save-event").submit(function(){
		$(".message-area .message-system").html("").removeClass('error, success').parent().hide();

		if(!check_time($(".start-hour").val())){
			$(".message-area .message-system").html("Invalid start hour").addClass('error').parent().show();
			return false;
		}
		if(!check_time($(".end-hour").val())){
			$(".message-area .message-system").html("Invalid end hour").addClass('error').parent().show();
			return false;
		}
		$(".form-save-event").find(".btn").hide();

		$.post($(this).attr("action"),$(this).serialize(),function(data){
			if(data.error==0){
				$(".message-area .message-system").html("Event has been successfully saved").addClass('success').parent().show();
				setTimeout(function(){
					$("#modal-event").modal("hide");
					if(typeof get_events_calendar === 'function'){
						get_events_calendar(main_calendar);
					}else{
						var base_app = 'http://demo.web-informatica.info/Miralaw/';
						var current_url= window.location.href;

						current_url_tmp = current_url.split('/');

						var tmp = current_url_tmp[6].split('?');

						var url_orig = base_app+'Matters/Details/'+tmp[0];

						if (current_url_tmp[4]=='Matters') {
							current_url = url_orig+'?tab=records';

							window.location.href = current_url;
						}else{
							location.reload();
						}
					}

				},3000);
			}else{
				$(".form-save-event").find(".btn").show();
				$(".message-area .message-system").html(data.message).addClass('error').parent().show();
			}
		},"json");
		return false;
	});
	function check_time(val){
		x=val.split(":");
		if(x.length<2){
			return false;
		}
		if(parseInt(x[0])>23){
			return false;
		}
		if(parseInt(x[1])>59){
			return false;
		}
		return true;
	}
</script>
<script type="text/javascript">
	$('.time-item input, .time-item select').change(function(){
		item=$(this).parent();

		time=item.find('input[type="text"]').val();
		ampm=item.find('select').val();
		if(check_time(time)){
			hh=time.split(":");
			mm=Number(hh[1]);
			hh=Number(hh[0]);
			
			if(hh>12){
				hh=hh-12;
				hh=(hh<10?'0'+hh:hh);
				mm=(mm<10?'0'+mm:mm);
				item.find('input[type="text"]').val(hh+":"+mm);
				item.find('select').val('pm');
				ampm='pm';
			}
			if(ampm=='pm'){
				if(Number(hh)==12){
					hh=12;
				}else{
					hh=Number(hh)+12;	
				}
				
			}else{
				if(Number(hh)==12){
					hh=0;
				}
			}
			mm=Number(mm);
			hh=Number(hh);
			time24=(hh<10?'0'+hh:hh)+":"+(mm<10?'0'+mm:mm);
		}else{
			time24="";
		}
		
		item.find('input[type="hidden"]').val(time24);
	});
	$(document).ready(function() {
		$('.time-item').each(function(index, el) {
			item=$(this);
			time_set=item.find('input[type="hidden"]').val();
			if(check_time(time_set)){
				hh=time_set.split(":");
				mm=Number(hh[1]);
				hh=Number(hh[0]);
				if(hh>12){
					hh=hh-12;
					hh=(hh<10?'0'+hh:hh);
					mm=(mm<10?'0'+mm:mm);
					item.find('input[type="text"]').val(hh+":"+mm);
					item.find('select').val('pm');
					
				}else{
					hh=(hh<10?'0'+hh:hh);
					mm=(mm<10?'0'+mm:mm);
					item.find('input[type="text"]').val(hh+":"+mm);
					if(hh==12){
						item.find('select').val('pm');
					}else{
						item.find('select').val('am');
					}
					if(hh=='00'){
						item.find('input[type="text"]').val("12:"+mm);
					}
					
				}
			}
		});
	});
</script>