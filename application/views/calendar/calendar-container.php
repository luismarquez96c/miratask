<?php 
$ci =&get_instance();
$ci->load->model("MatterModel");
$ci->load->model("UserModel");
$ci->lang->load($this->session->userdata("lng") , 'labels');
?>
<div class="col-md-12 col-sm-12 col-xs-12" id="titulo" >
	<h3><?php echo $this->lang->line('calendar_1'); ?></h3><hr>
</div>
<style type="text/css">
	.wi-calendar-week-header-allday-day{
		width: 14.285%;
		height: 100%;
		float: left;
		position: relative;
	}
</style>


<div class="matterContent">
	<!-- CALENDAR -->
	<div class="row">
		<div class="col-xs-12 col-md-10">

			<div class="">
				
				<a href="javascript:add_event()" class="btn btn-primary btn-gray"> <span class="glyphicon glyphicon-plus"></span> <?php echo $this->lang->line('calendar_2'); ?></a>
				

			</div>

			<div class="x_panel" style="width: 100%">

				<div id="matters" class="x_title">
					<h2><i class="glyphicon glyphicon-calendar"></i> &ensp;<?php echo $this->lang->line('calendar_1'); ?></h2>
					<div class="clearfix"></div>
				</div>
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<!--  -->
				<div class="calendar-buttons">
					<div class="row">
						<div class="col-xs-5 text-center views-calendar hidden-xs">
							<a href="javascript:calendar_change_view('day')" class="btn btn-gray btn-day "><?php echo $this->lang->line('calendar_3'); ?></a>
							<a href="javascript:calendar_change_view('week')" class="btn btn-gray btn-week"><?php echo $this->lang->line('calendar_4'); ?></a>
							<a href="javascript:calendar_change_view('month')" class="btn btn-gray btn-month active"><?php echo $this->lang->line('calendar_5'); ?></a>
						</div>
						<div class="col-md-4 col-xs-12 text-center">
							<label class="calendar-current-day">August 09-31-2017</label>
						</div>
						<div class="col-md-3 col-xs-12 text-center">
							<a href="" class="btn btn-gray"><?php echo $this->lang->line('calendar_6'); ?></a>
							<a href="javascript:prev_month();" class="btn-circle"><span class="glyphicon glyphicon-triangle-left"></span></a>
							<a href="javascript:next_month();" class="btn-circle"><span class="glyphicon glyphicon-triangle-right"></span></a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-xs-12">
						<div class="calendar-area">
							<div class="wi-data-calendar"></div>
							<div class="main-calendar"></div>
						</div>
					</div>
				</div>


			</div>
		</div>
		
		<div class="col-xs-12 col-sm-2 col-lg-2">
			<div class="x_panel mini-calendar" style="width: 100%">
				<div id="matters" class="x_title">
					<h2 class="date-calendar-2" style="width: 100%">June</h2>
					<div class="text-right calendar-widget-buttons">
						<span class="glyphicon glyphicon-arrow-left" onclick="cal_widget_prev()"></span>&nbsp;&nbsp;
						<span class="glyphicon glyphicon-arrow-right" onclick="cal_widget_next()"></span>
					</div>
				</div>
				<div class="padding">
					<div class="table-responsive">
						<div class="calendar-widget">

						</div>
					</div>
				</div>
			</div>
			<br /><br />
			<div class="x_panel">
				<div id="matters" class="x_title">
					<h2 style="width: 100%"><?php echo $this->lang->line('calendar_7'); ?></h2>
					
				</div>
				<div class="" style="position: relative;">
					<div class="list-calenders">
						<ul class="">
							<li>
								<input type="checkbox" id="" name="calenders[]" value="<?=userget()->id ?>" checked=""  />
								<span class="color-calender open-picker calendar-color-01" index_color="01"></span>
								<?php echo $this->lang->line('calendar_8'); ?>
							</li>
							<?php foreach($owners as $i => $owner): if($owner->Id!=userget()->id): ?>
								<li>
									<input type="checkbox" id="" name="calenders[]" value="<?=$owner->Id; ?>"  />
									<span class="color-calender open-picker calendar-color-<?=(($i+1)<10?"0".($i+1):($i+1)); ?> " index_color="<?=(($i+1)<10?"0".($i+1):($i+1)); ?>"></span>
									<?=$owner->Name." ".$owner->LastName ?>
								</li>
							<?php endif; endforeach; ?>
							
							
						</ul>
					</div>
					<div class="picker-color" style="display: none" >

						<ul class="calendar-colors">
							<li><a class="calendar-color-01" index_color="01"></a></li>
							<li><a class="calendar-color-02" index_color="02"></a></li>
							<li><a class="calendar-color-03" index_color="03"></a></li>
							<li><a class="calendar-color-04" index_color="04"></a></li>
							<li><a class="calendar-color-05" index_color="05"></a></li>
							<li><a class="calendar-color-06" index_color="06"></a></li>
							<li><a class="calendar-color-07" index_color="07"></a></li>
							<li><a class="calendar-color-08" index_color="08"></a></li>
							<li><a class="calendar-color-09" index_color="09"></a></li>
							<li><a class="calendar-color-10" index_color="10"></a></li>
							<li><a class="calendar-color-11" index_color="11"></a></li>
							<li><a class="calendar-color-12" index_color="12"></a></li>
							<li><a class="calendar-color-13" index_color="13"></a></li>
							<li><a class="calendar-color-14" index_color="14"></a></li>
							<li><a class="calendar-color-15" index_color="15"></a></li>
							<li><a class="calendar-color-16" index_color="16"></a></li>
							<li><a class="calendar-color-17" index_color="17"></a></li>
							<li><a class="calendar-color-18" index_color="18"></a></li>
							<li><a class="calendar-color-19" index_color="19"></a></li>
							<li><a class="calendar-color-20 selected"  index_color="20"></a></li>
						</ul>
					</div>
				</div>



			</div>
		</div>
	</div>


</div>

<br /><br />

<!-- Modal -->
<div id="modal-event" class="modal fade modal-mira" role="dialog">
	<div class="loading-modal"></div>
</div>
<div class="preview-event" style="display: none">
	<div class="preview-event-header">
		
		
	</div>
	<div class="preview-event-body">
		<table>
			<tr>
				<td align="center"  width="40px"><span class="ico-preview-owner"></span></td>
				<td width="40px">Owner</td>
				<td><span class="owner-name">Mira Gabriela</span></td>
			</tr>
			<tr>
				<td align="center" ><span class="ico-preview-clock"></span></td>
				<td>Start</td>
				<td><span class="start-date">Monday, Jun 12, 2017</span><b>11:00 am</b></td>
			</tr>
			<tr>
				<td align="center" ><span class="ico-preview-clock"></span></td>
				<td>End</td>
				<td><span class="end-date">Monday, Jun 12, 2017</span><b>11:00 am</b></td>
			</tr>
		</table>
		<div class="text-center">
			<a href="javascript:delete_event()" class="delete-event">
				<span class="glyphicon glyphicon-remove"></span>&nbsp; 
				Delete from calendar
			</a>
		</div>
	</div>
</div>
<link href="<?php echo base_url(); ?>css/jquery-ui.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>js/jquery-ui.js"></script>
<script src="<?php echo base_url(); ?>js/mask.js"></script>

<script type="text/javascript">
	var current_user=<?=userget()->id ?>;
</script>
<script type="text/javascript" src="<?=base_url() ?>js/WI-calendar.js"></script>


<script type="text/javascript">
	set_settings_calendar();
	var DATA_CALENDAR=null;
	template_cell0 ='<a href="javascript:update_calendar(\'[DATE]\')">[DAY]</a>';
	date0=new Date();
	var calendar_widget=new WI_Calendar(date0,{
		template_cell:template_cell0,
		removeHeader:true,
		days_format:new Array('<?php echo $this->lang->line('calendar_38'); ?>','<?php echo $this->lang->line('calendar_39'); ?>','<?php echo $this->lang->line('calendar_40'); ?>','<?php echo $this->lang->line('calendar_41'); ?>','<?php echo $this->lang->line('calendar_42'); ?>','<?php echo $this->lang->line('calendar_43'); ?>','<?php echo $this->lang->line('calendar_44'); ?>'),
		monthsFormat: new Array('<?php echo $this->lang->line('calendar_26'); ?>','<?php echo $this->lang->line('calendar_27'); ?>','<?php echo $this->lang->line('calendar_28'); ?>','<?php echo $this->lang->line('calendar_29'); ?>','<?php echo $this->lang->line('calendar_30'); ?>','<?php echo $this->lang->line('calendar_31'); ?>','<?php echo $this->lang->line('calendar_32'); ?>','<?php echo $this->lang->line('calendar_33'); ?>','<?php echo $this->lang->line('calendar_34'); ?>','<?php echo $this->lang->line('calendar_35'); ?>','<?php echo $this->lang->line('calendar_36'); ?>','<?php echo $this->lang->line('calendar_37'); ?>'),
		onBuildHTML:function(cal){
			$(".calendar-widget").html(cal.HTML);
			$(".date-calendar-2").text(cal.month_name+" "+cal.year)
		}
	});
	
	function  cal_widget_prev() {
		calendar_widget.prev();
	}
	function  cal_widget_next() {
		calendar_widget.next();
	}


	template_cell ='<span date="[DATE]">[DAY]</span>';
	config={
		template_cell:template_cell,
		days_format:new Array('<?php echo $this->lang->line('calendar_9'); ?>','<?php echo $this->lang->line('calendar_10'); ?>','<?php echo $this->lang->line('calendar_11'); ?>','<?php echo $this->lang->line('calendar_12'); ?>','<?php echo $this->lang->line('calendar_13'); ?>','<?php echo $this->lang->line('calendar_14'); ?>','<?php echo $this->lang->line('calendar_15'); ?>'),
		removeHeader:true,
		viewType:'month',
		monthsFormat: new Array('<?php echo $this->lang->line('calendar_26'); ?>','<?php echo $this->lang->line('calendar_27'); ?>','<?php echo $this->lang->line('calendar_28'); ?>','<?php echo $this->lang->line('calendar_29'); ?>','<?php echo $this->lang->line('calendar_30'); ?>','<?php echo $this->lang->line('calendar_31'); ?>','<?php echo $this->lang->line('calendar_32'); ?>','<?php echo $this->lang->line('calendar_33'); ?>','<?php echo $this->lang->line('calendar_34'); ?>','<?php echo $this->lang->line('calendar_35'); ?>','<?php echo $this->lang->line('calendar_36'); ?>','<?php echo $this->lang->line('calendar_37'); ?>'),
		onBuildHTML:function (calendar){
			
			$(".main-calendar").html(calendar.HTML);
			$(".calendar-current-day").text(calendar.month_name+" "+calendar.year);
			
			get_events_calendar(calendar);
		}
	}
	
	

	date=new Date();
	var main_calendar= new WI_Calendar(date,config);

	function prev_month() {
		main_calendar.prev();
	}
	function next_month() {

		main_calendar.next();
	}
	function calendar_change_view(type){
		$(".views-calendar a").removeClass("active");
		$(".views-calendar .btn-"+type).addClass('active');
		main_calendar.viewType=type;
		main_calendar.build_html();
		

	}

	function render_event(event){
		date=event.start_date;
		time=event.start_time;
		id_user=event.id_user;
		days=parseInt(event.days);
		allday=(event.all_day==1?true:false);
		color="calendar-event-color-";
		for(var c=0;c<users.length;c++){
			if(users[c]==id_user){
				color+=colors[c];
			}
		}
		

		switch(main_calendar.viewType){
			case 'month':
			
			target=$(".main-calendar table [date='"+date+"']").parent();

			
			if(target.length==0){ return false};

			v_top=target.position().top+25;
			v_left=target.position().left;
			num_events=(target.attr("events")!=undefined? parseInt(target.attr("events")) : 0);


			v_top=v_top+(25*num_events);

			next_week=false;
			next_week_event={};
			if(days==1){
				w=target.outerWidth();
			}else{
					//w=target.outerWidth()*((days+parseInt(event.weekday)>7)?(7-event.weekday):days);
					w=target.outerWidth()*((days+parseInt(event.weekday)>7)?(7-event.weekday):days);
					//alert(7-event.weekday);
				}


				html='<div data-id-event="'+event.id+'" data-start="'+event.start_fulldate+'" data-end="'+event.end_fulldate+'" data-owner="'+event.id_user+'" data-subject="'+event.subject+'" class="wi-data-calendar-item '+color+'" style="top:'+v_top+'px; left:'+(v_left+1)+'px; width:'+(w-2)+'px">'+event.subject+'</div>';
				$(".wi-data-calendar").append(html);
				num_events++;
				target.attr("events",num_events);
				if(days>1){
					next_target=target;
					limit=((days+parseInt(event.weekday)>7)?(7-event.weekday):days);
					for(var nn=2;nn<=limit;nn++){
						next_target=next_target.next();
						num_events_next=(next_target.attr("events")!=undefined? parseInt(next_target.attr("events")) : 0);
						next_target.attr("events",(num_events_next+1));
					}
				}



				if(num_events>3){
					height_row=num_events*25+13;
					target.height(height_row);
				}

				if(days+parseInt(event.weekday)>7){
					diference=(7-event.weekday);

					/*console.log(event);*/
					t=strtotime(date).addDays(diference);
						//console.log(t);
						//console.log(diference);
						next_week_event=event;
						next_week_event.weekday=0;
						next_week_event.days=event.days-diference;
						next_week_event.start_date=timetostr(t);
						render_event(next_week_event);
					}

					break;
					case 'week':
					time_round=(Math.floor(time/60))*60;

					if(!allday){
						target=$(".main-calendar .wi-calendar-day[date='"+date+"'] [minute='"+time_round+"']");
					}else{

						target=$(".main-calendar .wi-calendar-week-header-allday-day[date='"+date+"']");
					}
					if(target.length==0){ return false};

					v_top=target.position().top;
					v_left=target.position().left;

					num_evens=(target.attr("events")!=undefined? parseInt(target.attr("events")) : 0);

					w=target.outerWidth();
					h=target.outerHeight();
					event_time=event.end_time-event.start_time;
					if(allday){
						h=h;
					}else{
						h=h*Math.ceil(event_time/60);	
					}
					

					
					if(!allday){
						html='<div  data-id-event="'+event.id+'" data-start="'+event.start_fulldate+'" data-end="'+event.end_fulldate+'" data-owner="'+event.id_user+'" data-subject="'+event.subject+'"  date="'+date+'" minute="'+time_round+'" minute_end="'+(time_round+(60*Math.ceil(event_time/60)))+'" class="wi-data-calendar-item-day '+color+'" style="top:'+v_top+'px; left:'+v_left+'px; width:'+w+'px; height:'+h+'px"><div class="valing">'+event.subject+'</div></div>';
						$(".wi-data-calendar-week").append(html);
					}else{
						html='<div  data-id-event="'+event.id+'" data-start="'+event.start_fulldate+'" data-end="'+event.end_fulldate+'" data-owner="'+event.id_user+'" data-subject="'+event.subject+'"  date="'+date+'" minute="'+time_round+'" minute_end="'+(time_round+(60*Math.ceil(event_time/60)))+'" class="wi-data-calendar-item-day '+color+'" style="width:'+w+'px; height:'+h+'px"><div class="valing">'+event.subject+'</div></div>';
						target.append(html);
					}
					
					
					num_events++;
					target.attr("events",num_evens);
					resize_width(date,time_round,w);

					break;
					case 'day':
					time_round=(Math.floor(time/60))*60;

					if(!allday){
						target=$(".main-calendar .wi-calendar-day[date='"+date+"'] [minute='"+time_round+"']");
					}else{

						target=$(".main-calendar .wi-calendar-week-header-allday-day[date='"+date+"']");
					}
					if(target.length==0){ return false};

					v_top=target.position().top;
					v_left=target.position().left;

					num_evens=(target.attr("events")!=undefined? parseInt(target.attr("events")) : 0);

					w=target.outerWidth();
					h=target.outerHeight();
					event_time=event.end_time-event.start_time;
					if(allday){
						h=h;
					}else{
						h=h*Math.ceil(event_time/60);	
					}
					html='<div  data-id-event="'+event.id+'" data-start="'+event.start_fulldate+'" data-end="'+event.end_fulldate+'" data-owner="'+event.id_user+'" data-subject="'+event.subject+'"  date="'+date+'" minute="'+time_round+'" class="wi-data-calendar-item-day '+color+'" style="top:'+v_top+'px; left:'+v_left+'px; width:'+w+'px"><div class="valing">'+event.subject+'</div></div>';
					
					if(!allday){
						html='<div  data-id-event="'+event.id+'" data-start="'+event.start_fulldate+'" data-end="'+event.end_fulldate+'" data-owner="'+event.id_user+'" data-subject="'+event.subject+'"  date="'+date+'" minute="'+time_round+'" minute_end="'+(time_round+(60*Math.ceil(event_time/60)))+'" class="wi-data-calendar-item-day '+color+'" style="top:'+v_top+'px; left:'+v_left+'px; width:'+w+'px; height:'+h+'px"><div class="valing">'+event.subject+'</div></div>';
						$(".wi-data-calendar-week").append(html);
					}else{
						html='<div  data-id-event="'+event.id+'" data-start="'+event.start_fulldate+'" data-end="'+event.end_fulldate+'" data-owner="'+event.id_user+'" data-subject="'+event.subject+'"  date="'+date+'" minute="'+time_round+'" minute_end="'+(time_round+(60*Math.ceil(event_time/60)))+'" class="wi-data-calendar-item-day '+color+'" style="width:'+w+'px; height:'+h+'px"><div class="valing">'+event.subject+'</div></div>';
						target.append(html);
					}

					num_events++;
					target.attr("events",num_evens);
					resize_width(date,time_round,w);


					break;
				}


			}
			function resize_width(date,time,w){
				items=$('[date="'+date+'"][minute="'+time+'"]');

				if(items.size()>1){
					w=(w/items.size())-2;
					l=items.eq(0).position().left;
					items.each(function(index, el) {
						$(this).outerWidth(w);
						v_left=l+(w*index)+(index>0? (3*index) :0);
						$(this).css("left",v_left+"px");
					});

				}
			}
			var users;
			var colors;
			function get_events_calendar(calendar){

				users=$(".list-calenders [name='calenders[]']:checked").map(function(){return $(this).val();}).get();
				colors=$(".list-calenders [name='calenders[]']:checked").next().map(function(){return $(this).attr("index_color");}).get();

				dataStorage=[];
				for(i in users){
					dataStorage.push({user:users[i],color:colors[i]});
				}
				localStorage.setItem('mira-calendar-settings',JSON.stringify(dataStorage));

				dataPost={
					month:calendar.month+1,
					year:calendar.year,
					users:users
				};
				$(".wi-data-calendar").html("");
				$(".wi-data-calendar-week").html("");
				$(".wi-calendar-week-header-allday-day").html("");
				$(".main-calendar table td.day").attr("events",0);
				$(".wi-calendar-item-day").attr("events",0);
				$.post(base_url+"calendar/events_get",dataPost,function(data){
					DATA_CALENDAR=data;

					for(i in data){
						event=data[i];
						render_event(event);
					}
				},"json");
			}
			function set_settings_calendar(){
				settings=JSON.parse(localStorage.getItem('mira-calendar-settings'));


				for(i in settings){
					console.log(".list-calenders [name='calenders[]'][value='"+settings[i].user+"']");
					$(".list-calenders [name='calenders[]'][value='"+settings[i].user+"']").prop('checked',true);
			//$(".list-calenders [name='calenders[]'][values='"+settings[i].user+"']").prop('checked',true);
			//colors=$(".list-calenders [name='calenders[]']:checked").next().map(function(){return $(this).attr("index_color");}).get();
		}
		
	}
</script>

<script type="text/javascript">
	function add_event(date,minute){
		$("#modal-event").html("");
		$("#modal-event").modal("show");
		date=(date!=undefined?date:0);
		minute=(minute!=undefined?minute:0);
		$.post(base_url+"Calendar/modal_event_detail",{date:date,minute:minute},function(response){
			$("#modal-event").html(response);
			$('.calendar').datepicker({
				format: "mm/dd/yy",
			    //startDate: "01-01-2015",
			    //endDate: "01-01-2020",
			   // todayBtn: "linked",
			   autoclose: true,
			   todayHighlight: true,
			   container: '#modal-event modal-body'
			});
			
		});

	}


	$("#modal-event").on('shown.bs.modal', function() {

	});

	$(document).on("click",".wi-data-calendar-item, .wi-data-calendar-item-day",function(){
		id_event=$(this).data("id-event");
		$("#modal-event").modal("show");
		$.post(base_url+"Calendar/modal_event_detail",{id:id_event},function(response){
			$("#modal-event").html(response);
			//location.reload();
		});
	});
	$(document).on("dblclick",".main-calendar table td.day",function(){
		date=$(this).find("span").attr("date");
		add_event(date);
	});
	$(document).on("dblclick",".wi-calendar-item-day",function(){
		date=$(this).parent().attr("date");
		time=$(this).attr("minute");
		add_event(date,time);
	});
	$(".list-calenders [name='calenders[]']").change(function(){
		get_events_calendar(main_calendar);
	});
	var target_color_picker=null;
	$(".open-picker").click(function(e){
		target_color_picker=$(this);
		vtop=$(this).position().top+12;
		vleft=$(this).position().left;
		$(".picker-color").css({"top":vtop+"px","left":vleft+"px"}).show();
	});
	$(".calendar-colors a").click(function(event) {
		current=$(this);
		index_color=current.attr("index_color");
		var classes = target_color_picker.attr("class").split(' ');
		$.each(classes, function(i, c) {
			if (c.indexOf("calendar-color-") == 0) {
				target_color_picker.removeClass(c);
			}
		});

		target_color_picker.addClass('calendar-color-'+index_color);
		target_color_picker.attr("index_color",index_color);
		$(".picker-color").hide();
		get_events_calendar(main_calendar);
	});



	$(document).click(function(event) { 
		if(!$(event.target).closest('.picker-color, .open-picker').length) {
			if($('.picker-color').is(":visible")) {
				$('.picker-color').hide();
			}
		}        
	});
	var timepreview=null;
	$(document).on("mouseenter",".wi-data-calendar-item, .wi-data-calendar-item-day",function(){
		clearTimeout(timepreview);
		panel=$(".preview-event");
		vtop=$(this).offset().top-230;
		vleft=$(this).offset().left;
		w=$(this).outerWidth();
		vleft=vleft+((w/2)-125);
		panel.css({"top":vtop+"px","left":vleft+"px"});

		owner=$(".list-calenders input[name='calenders[]'][value='"+$(this).data("owner")+"']").parent().text().trim();
		owner=(owner=="My Calendar" ? "Me" : owner);

		starttime=strtotime($(this).data("start"));
		endtime=strtotime($(this).data("end"));


		panel.find(".preview-event-header").text($(this).data("subject").substr(0,30));
		panel.find(".owner-name").text(owner);
		panel.find(".start-date").text(starttime.getWeekDay()+", "+starttime.getMonthName() + " "+ starttime.getDate()+", "+starttime.getFullYear());
		panel.find(".start-date").next().text(starttime.getHourAMPM());
		panel.find(".end-date").text(endtime.getWeekDay()+", "+endtime.getMonthName() + " "+ endtime.getDate()+", "+endtime.getFullYear());
		panel.find(".end-date").next().text(endtime.getHourAMPM());
		//if(current_user!=$(this).data("owner")){
		//	panel.find(".delete-event").hide();
		//}else{
			panel.find(".delete-event").show().attr("href",'javascript:delete_event('+$(this).data("id-event")+')');
		//}
		panel.show();
	});
	$(document).on("mouseout",".wi-data-calendar-item, .wi-data-calendar-item-day",function(){
		timepreview=setTimeout(function(){
			$(".preview-event").hide();
		},100);
		
	});
	$(document).on("mouseenter",".preview-event, .preview-event *",function(){
		$(".preview-event").show();
		clearTimeout(timepreview);
	});
	$(document).on("mouseout",".preview-event",function(){
		timepreview=setTimeout(function(){
			$(".preview-event").hide();
		},100)
	});



	function strtotime(str){
		str=str.split(" ");
		strdate=str[0].split("-");
		if(str.length>1){
			strtime=str[1].split(":");
			t=new Date(strdate[0],(strdate[1]-1),strdate[2],strtime[0],strtime[1],strtime[2]);	
		}else{
			t=new Date(strdate[0],(strdate[1]-1),strdate[2],0,0,0);	
		}
		
		return t;
	}
	function timetostr(time){
		return time.getFullYear()+"-"+((time.getMonth()+1)<10? "0"+(time.getMonth()+1) : (time.getMonth()+1))+"-"+((time.getDate()<10)? "0"+time.getDate():time.getDate());
	}
	function delete_event(id_event){
		if(!confirm("are you sure that delete this element?")){
			return false;
		}
		$.post(base_url+"Calendar/event_detele",{"id_event":id_event},function(data){
			if(data.error==0){
				
				$('[data-id-event="'+id_event+'"]').hide();
			}
		},"json");
	}
	function update_calendar(fdate){
		main_calendar.set_date(fdate);
	}
</script>
<script>
	$(document).ready(function() {
		var ancho = $( window ).width();
		if (ancho<=480) {
			calendar_change_view('day');
			$('.mini-calendar').addClass('hidden');
			$('.wi-calendar-week-header').css({
				'padding-left' : '0',
				'padding-right' : '0'
			});
		}
	});
	
</script>