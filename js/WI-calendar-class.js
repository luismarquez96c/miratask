class WI_Calendar{


  constructor(currentDate,config){
    this.Calendar = currentDate;
    this.day_of_week = new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
    this.month_of_year = new Array('January','February','March','April','May','June','July','August','September','October','November','December');
    this.CurrentCalendar=new Date();
    this.ID="WI-"+Math.floor((Math.random() * 1000) + 1);


    this.TR_start = '<TR>';
    this.TR_end = '</TR>';
    this.highlight_start = '<TD class="day today">';
    this.highlight_end   = '';
    this.TD_start = '<TD >';
    this.TD_end = '</TD>';
    this.template_cell="[DAY]";
    this.removeHeader=false;
    this.year = this.Calendar.getFullYear();     // Returns year
    this.month = this.Calendar.getMonth(); //Returns month (0-11)
    this.today = this.Calendar.getDate();    // Returns day (1-31)
    this.weekday = this.Calendar.getDay();    // Returns day (1-31)
    this.month_name= this.month_of_year[this.month];

    this.DAYS_OF_WEEK = 7;    // "constant" for number of days in a week
    this.DAYS_OF_MONTH = 31;    // "constant" for number of days in a month
    this.cal;    // Used for printing


    if( config!=undefined && config.template_cell!=undefined){
      this.template_cell=config.template_cell;
    }
    if( config!=undefined && config.days_format!=undefined){
      this.day_of_week=config.days_format;
    }
    if( config!=undefined && config.removeHeader!=undefined){
      this.removeHeader=config.removeHeader;
    }
    if(config!=undefined && config.onBuildHTML!=undefined){
      this.onBuildHTML=config.onBuildHTML;
    }

    this.build_html();
  }

  build_html(){
    this.Calendar.setDate(1);    // Start the calendar day at '1'
    this.Calendar.setMonth(this.month);    // Start the calendar month at now
    this.month_name= this.month_of_year[this.month];
   this.build_html_month();
   // this.build_html_week();
    this.HTML=this.cal;
    if(this.onBuildHTML!=undefined){
      this.onBuildHTML(this);
    }

  }
  next(){
    this.month=this.month+1;
    this.build_html()
  }
  prev(){
    this.month=this.month-1;
    this.build_html()
  }

  build_html_month(){
    this.cal =  '';
    this.cal += '<TABLE ID="'+this.ID+'" YEAR="'+this.year+'" MONTH="'+(this.month+1)+'" BORDER=0 CELLSPACING=0 CELLPADDING=2>';
    if(!this.removeHeader){
      this.cal += '<tr class="month-title">';
      this.cal += '<td class="calendar-prev"><center><span class="glyphicon glyphicon-chevron-left"></span></center></td><TD COLSPAN="5" ><CENTER><B>';
      this.cal += this.month_of_year[this.month]  + '   ' + this.year + '</B>'+  this.TD_end + '<td class="calendar-next"><center><span class="glyphicon glyphicon-chevron-right"></span></center></td>'+ this.TR_end;

    }
    this.cal += '<tr class="days-week">';

//   DO NOT EDIT BELOW THIS POINT  //

// LOOPS FOR EACH DAY OF WEEK
for(var index=0; index < this.DAYS_OF_WEEK; index++)
{

// BOLD TODAY'S DAY OF WEEK
if(this.weekday == index)
  this.cal += this.TD_start + '<B>' + this.day_of_week[index] + '</B>' + this.TD_end;

// PRINTS DAY
else
  this.cal += this.TD_start + this.day_of_week[index] + this.TD_end;
}

this.cal += this.TD_end + this.TR_end;
this.cal += this.TR_start;

// FILL IN BLANK GAPS UNTIL TODAY'S DAY

for(var index=0; index < this.Calendar.getDay(); index++){
  this.cal += "<td class='day-until'>" +  this.Calendar.addDays((this.Calendar.getDay()-index)*-1).getDate() + this.TD_end;
}

// LOOPS FOR EACH DAY IN CALENDAR
for(var index=0; index < this.DAYS_OF_MONTH; index++)
{
  if( this.Calendar.getDate() > index )
  {
  // RETURNS THE NEXT DAY TO PRINT
  var week_day = this.Calendar.getDay();

  // START NEW ROW FOR FIRST DAY OF WEEK
  if(week_day == 0)
    this.cal += this.TR_start;

  if(week_day != this.DAYS_OF_WEEK)
  {

  // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
  var day  = this.Calendar.getDate();

  // HIGHLIGHT TODAY'S DATE
  if( this.today==this.Calendar.getDate() && this.month==this.CurrentCalendar.getMonth())
    this.cal += this.highlight_start +  this.template_cell.replace("[DAY]",day).replace("[DATE]",this.CurrentCalendar.getFullYear()+"-"+(this.month+1<10?"0"+(this.month+1) :(this.month+1))+"-"+(day<10?"0"+day:day)) + this.highlight_end + this.TD_end;

  // PRINTS DAY
  else
    this.cal += "<td class='day'>" + this.template_cell.replace("[DAY]",day).replace("[DATE]",this.CurrentCalendar.getFullYear()+"-"+(this.month+1<10?"0"+(this.month+1) :(this.month+1))+"-"+(day<10?"0"+day:day)) + this.TD_end;
}

  // END ROW FOR LAST DAY OF WEEK
  if(week_day == this.DAYS_OF_WEEK)
    this.cal += this.TR_end;
}

  // INCREMENTS UNTIL END OF THE MONTH
  this.Calendar.setDate(this.Calendar.getDate()+1);

}// end for loop

for(var index=0; index < 6-week_day; index++){

  this.cal += "<td class='day-until'>" + (index+1) + this.TD_end;
}

this.cal += '</TD></TR></TABLE>';
}

build_html_week(){
 this.cal =  '<div class="wi-calendar-week">';
 this.cal+=  '<div class="wi-calendar-week-header">';
 var first_day_week=this.Calendar.firstDayWeek(this.today);
 for(var i=0;i<7;i++){
   this.cal+='<div class="wi-calendar-week-header-day">'+this.day_of_week[i]+" "+(first_day_week+i)+'</div>'; 
 }
 this.cal+= '</div>';

 this.cal+=  '<div class="wi-calendar-week-container">';
 this.cal+='<div class="wi-calendar-hours">';
 for(var h=0;h<24;h++){
  this.cal+='<div class="wi-calendar-item-hour">'+this.toAMPM(h)+"</div>";
 }
this.cal+='</div>';
this.cal+='<div class="wi-calendar-days">';
for(var i=0;i<7;i++){
 this.cal+='<div class="wi-calendar-day">';
 for(var h=0;h<24;h++){
  this.cal+='<div class="wi-calendar-item-day"></div>';
 }
 this.cal+='</div>';
}

this.cal+='</div>';
this.cal+='</div>';
this.cal+='</div>';
}
toAMPM(val){
  if(val==0){
    return "12 am";
  }
  if(val <12){
    return val+" am";
  }
  if(val==12){
    return val+" pm";
  }
  return (val-12)+" pm";
}
}

Date.prototype.getWeekNumber = function(){
  var d = new Date(Date.UTC(this.getFullYear(), this.getMonth(), this.getDate()));
  var dayNum = d.getUTCDay() || 7;
  d.setUTCDate(d.getUTCDate() + 4 - dayNum);
  var yearStart = new Date(Date.UTC(d.getUTCFullYear(),0,1));
  return Math.ceil((((d - yearStart) / 86400000) + 1)/7)
};
Date.prototype.addDays=function(days){
  var tmp_moth=new Date();
  var timeMonth=this.getTime();
  tmp_moth.setTime(timeMonth+(parseInt(days)*24*60*60*1000));
  return tmp_moth;
}
Date.prototype.firstDayWeek=function(today){
  var tmp_day=new Date();
  tmp_day.setDate(today);
  var day_week=tmp_day.getDay()*-1;


  return tmp_day.addDays(day_week).getDate();
}