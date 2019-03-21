function WI_Calendar(currentDate,config){
  WIC={
    Calendar        : null,
    day_of_week     : new Array('Sun','Mon','Tue','Wed','Thu','Fri','Sat'),
    month_of_year   : new Array('January','February','March','April','May','June','July','August','September','October','November','December'),
    TR_start        :'<TR>',
    TR_end          :'</TR>',
    highlight_start :'<TD class="day today">',
    highlight_end   :'',
    TD_start        :'<TD >',
    TD_end          :'</TD>',
    template_cell   :"[DAY]",
    removeHeader    :false,
    year            :0,
    month           :0,
    today           :0,
    weekday         :0,
    month_name      :"",
    CurrentCalendar :null,
    DAYS_OF_WEEK          :7,    // "constant" for number of days in a week
    DAYS_OF_MONTH           :31,    // "constant" for number of days in a month
    cal:"",    // Used for printing
    HTML:"",
    onBuildHTML:[],
    ID:0,
    init:function(currentDate,config){ // START INIT
      WIC.Calendar = currentDate;
      WIC.CurrentCalendar=new Date();
      WIC.ID="WI-"+Math.floor((Math.random() * 1000) + 1);
      WIC.year = WIC.Calendar.getFullYear();     // Returns year
      WIC.month = WIC.Calendar.getMonth(); //Returns month (0-11)
      WIC.today = WIC.Calendar.getDate();    // Returns day (1-31)
      WIC.weekday = WIC.Calendar.getDay();    // Returns day (1-31)
      WIC.month_name= WIC.month_of_year[WIC.month];

      if( config!=undefined && config.template_cell!=undefined){
        WIC.template_cell=config.template_cell;
      }
      if( config!=undefined && config.days_format!=undefined){
        WIC.day_of_week=config.days_format;
      }
      if( config!=undefined && config.removeHeader!=undefined){
        WIC.removeHeader=config.removeHeader;
      }
      if(config!=undefined && config.onBuildHTML!=undefined){
        WIC.prototype.onBuildHTML=config.onBuildHTML;
      }

      WIC.build_html();
  }, // END INIT
  build_html:function(){
    WIC.Calendar.setDate(1);    
    WIC.Calendar.setMonth(WIC.month);  
    WIC.month_name= WIC.month_of_year[WIC.month];
    WIC.build_html_month();
    //build_html_week();
      WIC.HTML=WIC.cal;
      if(WIC.prototype.onBuildHTML!=null){
        WIC.prototype.onBuildHTML(WIC);
      }
    },
    next:function(){
      WIC.month=WIC.month+1;
      WIC.build_html();
    },
    prev:function(){
      WIC.month=WIC.month-1;
      WIC.build_html();
    },
    build_html_month:function (){
    WIC.cal =  '';
    WIC.cal += '<TABLE ID="'+WIC.ID+'" YEAR="'+WIC.year+'" MONTH="'+(WIC.month+1)+'" BORDER=0 CELLSPACING=0 CELLPADDING=2>';
    if(!WIC.removeHeader){
      WIC.cal += '<tr class="month-title">';
      WIC.cal += '<td class="calendar-prev"><center><span class="glyphicon glyphicon-chevron-left"></span></center></td><TD COLSPAN="5" ><CENTER><B>';
      WIC.cal += WIC.month_of_year[WIC.month]  + '   ' + WIC.year + '</B>'+  WIC.TD_end + '<td class="calendar-next"><center><span class="glyphicon glyphicon-chevron-right"></span></center></td>'+ WIC.TR_end;

    }
    WIC.cal += '<tr class="days-week">';

//   DO NOT EDIT BELOW THIS POINT  //

// LOOPS FOR EACH DAY OF WEEK
for(var index=0; index < WIC.DAYS_OF_WEEK; index++)
{

// BOLD TODAY'S DAY OF WEEK
if(WIC.weekday == index)
  WIC.cal += WIC.TD_start + '<B>' + WIC.day_of_week[index] + '</B>' + WIC.TD_end;

// PRINTS DAY
else
  WIC.cal += WIC.TD_start + WIC.day_of_week[index] + WIC.TD_end;
}

WIC.cal += WIC.TD_end + WIC.TR_end;
WIC.cal += WIC.TR_start;

// FILL IN BLANK GAPS UNTIL TODAY'S DAY

for(var index=0; index < WIC.Calendar.getDay(); index++){
  WIC.cal += "<td class='day-until'>" +  WIC.Calendar.addDays((WIC.Calendar.getDay()-index)*-1).getDate() + WIC.TD_end;
}

// LOOPS FOR EACH DAY IN CALENDAR
for(var index=0; index < WIC.DAYS_OF_MONTH; index++)
{
  if( WIC.Calendar.getDate() > index )
  {
  // RETURNS THE NEXT DAY TO PRINT
  var week_day = WIC.Calendar.getDay();

  // START NEW ROW FOR FIRST DAY OF WEEK
  if(week_day == 0)
    WIC.cal += WIC.TR_start;

  if(week_day != WIC.DAYS_OF_WEEK)
  {

  // SET VARIABLE INSIDE LOOP FOR INCREMENTING PURPOSES
  var day  = WIC.Calendar.getDate();

  // HIGHLIGHT TODAY'S DATE
  if( WIC.today==WIC.Calendar.getDate() && WIC.month==WIC.CurrentCalendar.getMonth())
    WIC.cal += WIC.highlight_start +  WIC.template_cell.replace("[DAY]",day).replace("[DATE]",WIC.CurrentCalendar.getFullYear()+"-"+(WIC.month+1<10?"0"+(WIC.month+1) :(WIC.month+1))+"-"+(day<10?"0"+day:day)) + WIC.highlight_end + WIC.TD_end;

  // PRINTS DAY
  else
    WIC.cal += "<td class='day'>" + WIC.template_cell.replace("[DAY]",day).replace("[DATE]",WIC.CurrentCalendar.getFullYear()+"-"+(WIC.month+1<10?"0"+(WIC.month+1) :(WIC.month+1))+"-"+(day<10?"0"+day:day)) + WIC.TD_end;
}

  // END ROW FOR LAST DAY OF WEEK
  if(week_day == WIC.DAYS_OF_WEEK)
    WIC.cal += WIC.TR_end;
}

  // INCREMENTS UNTIL END OF THE MONTH
  WIC.Calendar.setDate(WIC.Calendar.getDate()+1);

}// end for loop

for(var index=0; index < 6-week_day; index++){

  WIC.cal += "<td class='day-until'>" + (index+1) + WIC.TD_end;
}

WIC.cal += '</TD></TR></TABLE>';
}


  };

  
  WIC.init(currentDate,config);


  

function build_html_week(){
 WIC.cal =  '<div class="wi-calendar-week">';
 WIC.cal+=  '<div class="wi-calendar-week-header">';
 var first_day_week=WIC.Calendar.firstDayWeek(WIC.today);
 for(var i=0;i<7;i++){
   WIC.cal+='<div class="wi-calendar-week-header-day">'+WIC.day_of_week[i]+" "+(first_day_week+i)+'</div>'; 
 }
 WIC.cal+= '</div>';

 WIC.cal+=  '<div class="wi-calendar-week-container">';
 WIC.cal+='<div class="wi-calendar-hours">';
 for(var h=0;h<24;h++){
  WIC.cal+='<div class="wi-calendar-item-hour">'+toAMPM(h)+"</div>";
}
WIC.cal+='</div>';
WIC.cal+='<div class="wi-calendar-days">';
for(var i=0;i<7;i++){
 WIC.cal+='<div class="wi-calendar-day">';
 for(var h=0;h<24;h++){
  WIC.cal+='<div class="wi-calendar-item-day"></div>';
}
WIC.cal+='</div>';
}

WIC.cal+='</div>';
WIC.cal+='</div>';
WIC.cal+='</div>';
}
function toAMPM(val){
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

return WIC;
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