function WI_Calendar(currentDate,config){







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

  this.viewType='month';



    this.year = this.Calendar.getFullYear();     // Returns year

    this.month = this.Calendar.getMonth(); //Returns month (0-11)

    this.today = this.Calendar.getDate();    // Returns day (1-31)

    this.weekday = this.Calendar.getDay();    // Returns day (0-6)

    this.month_name= this.month_of_year[this.month];



    this.DAYS_OF_WEEK = 7;    // "constant" for number of days in a week

    this.DAYS_OF_MONTH = 31;    // "constant" for number of days in a month

    this.cal;    // Used for printing

    this.first_day_week=this.Calendar.firstDayWeek(this.today);





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

    if(config!=undefined && config.viewType!=undefined){

      this.viewType=config.viewType;

    }
    if(config!=undefined && config.monthsFormat!=undefined){

      this.month_of_year=config.monthsFormat;

    }



    this.set_date=function(custom_date){

      custom_date=custom_date.split('-');



      this.Calendar =new Date(custom_date[0],custom_date[1]-1,custom_date[2],0,0,0);

      this.year = this.Calendar.getFullYear();     

      this.month = this.Calendar.getMonth(); 

      this.today = this.Calendar.getDate();    

      this.weekday = this.Calendar.getDay();

      this.first_day_week=this.Calendar.firstDayWeek(this.today);

      this.build_html();

    };



    this.build_html=function(){



      this.month_name= this.month_of_year[this.month];

      switch(this.viewType){

        case 'month':

        this.build_html_month();

        break;

        case 'week':

        this.build_html_week();

        break;

        case 'day':

        this.buid_html_day();

        break;



      }





      this.HTML=this.cal;

      if(this.onBuildHTML!=undefined){

        this.onBuildHTML(this);

      }

    };

    this.build_html_month=function(){

  this.Calendar.setDate(1);    // Start the calendar day at '1'

  this.Calendar.setMonth(this.month);



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

  if( (new Date()).getDate()==this.Calendar.getDate() && this.month==this.CurrentCalendar.getMonth())

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

  //this.Calendar.setDate(this.Calendar.getDate()+1);

  

  if((index+1)<this.Calendar.monthDays())

    this.Calendar.setTime(this.Calendar.addDays(1).getTime());



}// end for loop



for(var index=0; index < 6-week_day; index++){



  this.cal += "<td class='day-until'>" + (index+1) + this.TD_end;

}



this.cal += '</TD></TR></TABLE>';



};



this.build_html_week=function(){

  this.Calendar.setDate(this.first_day_week);

  if(this.first_day_week>this.today){

   this.Calendar.setMonth(this.month+1);

 }



 this.cal =  '<div class="wi-calendar-week">';

 this.cal+=  '<div class="wi-calendar-week-header">';



 for(var i=0;i<7;i++){

  this.cal+='<div class="wi-calendar-week-header-day">'+this.day_of_week[i]+" "+(this.Calendar.addDays(i).getDate())+'</div>'; 

}

this.cal+='<div class="wi-calendar-week-header-allday">';

for(var i=0;i<7;i++){

  this.cal+='<div class="wi-calendar-week-header-allday-day"  date="'+this.Calendar.addDays(i).getDateFormat()+'"></div>';

}

this.cal+='</div>';

this.cal+= '</div>';



this.cal+=  '<div class="wi-calendar-week-container">';

this.cal+='<div class="wi-calendar-hours">';

for(var h=0;h<24;h++){

  this.cal+='<div class="wi-calendar-item-hour" minute="'+(h*60)+'">'+this.toAMPM(h)+"</div>";

}

this.cal+='</div>';

this.cal+='<div class="wi-calendar-days"> <div class="wi-data-calendar-week"></div>';

for(var i=0;i<7;i++){

  this.cal+='<div class="wi-calendar-day" date="'+this.Calendar.addDays(i).getDateFormat()+'">';

  for(var h=0;h<24;h++){

    this.cal+='<div class="wi-calendar-item-day" minute="'+(h*60)+'"></div>';

  }

  this.cal+='</div>';

}



this.cal+='</div>';

this.cal+='</div>';

this.cal+='</div>';

};





this.buid_html_day=function(){

  this.Calendar.setDate(this.today);



  this.cal =  '<div class="wi-calendar-week">';

  this.cal+=  '<div class="wi-calendar-week-header">';



  var i=this.Calendar.getDay();

  this.cal+='<div class="wi-calendar-week-header-day full-day">'+this.day_of_week[i]+" "+(this.Calendar.getDate())+'</div>'; 



  this.cal+='<div class="wi-calendar-week-header-allday">';

  this.cal+='<div class="wi-calendar-week-header-allday-day" style="width:100%"  date="'+this.Calendar.getDateFormat()+'"></div>';

  this.cal+='</div>';



  this.cal+= '</div>';



  this.cal+=  '<div class="wi-calendar-week-container">';

  this.cal+='<div class="wi-calendar-hours ">';

  for(var h=0;h<24;h++){

    this.cal+='<div class="wi-calendar-item-hour">'+this.toAMPM(h)+"</div>";

  }

  this.cal+='</div>';

  this.cal+='<div class="wi-calendar-days">  <div class="wi-data-calendar-week"></div>';





  this.cal+='<div class="wi-calendar-day  full-day" date="'+this.Calendar.getDateFormat()+'" >';

  for(var h=0;h<24;h++){

    this.cal+='<div class="wi-calendar-item-day" minute="'+(h*60)+'"></div>';

  }

  this.cal+='</div>';

  



  this.cal+='</div>';

  this.cal+='</div>';

  this.cal+='</div>';



};





this.toAMPM=function(val){

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

;

this.build_html();



this.next=function(){

  switch(this.viewType){

    case 'month':





    this.month=this.month+1;

    if(this.month>11){

      this.month=0;

      this.year++;

      this.CurrentCalendar.setYear(this.year);

    }

    this.Calendar.setDate(1);

    this.Calendar.setMonth(this.month);

    this.Calendar.setYear(this.year);

    this.first_day_week=this.Calendar.firstDayWeek(this.today);

    

    break;

    case 'week':



    this.Calendar.setMonth(this.month);

    this.Calendar.setTime(this.Calendar.addDays(7).getTime());

    this.month=this.Calendar.getMonth();

    this.year=this.Calendar.getFullYear();

    this.first_day_week=this.Calendar.firstDayWeek(this.Calendar.getDate());

    this.today=this.first_day_week;

    break;

    case 'day':

    this.Calendar.setTime(this.Calendar.addDays(1).getTime());

    this.month=this.Calendar.getMonth();

    this.year=this.Calendar.getFullYear();

    this.first_day_week=this.Calendar.firstDayWeek(this.Calendar.getDate());

    this.today=this.Calendar.getDate();

    break;

  }

  

  this.build_html();

};

this.prev=function(){

 switch(this.viewType){

  case 'month':



  this.month=this.month-1;

  if(this.month<0){

    this.month=11;

    this.year--;

    this.CurrentCalendar.setYear(this.year);

  }

  this.Calendar.setDate(1);

  this.Calendar.setMonth(this.month);

  this.Calendar.setYear(this.year);

  console.log("cal: "+this.Calendar);



  this.first_day_week=this.Calendar.firstDayWeek(this.today);



  break;

  case 'week':

  this.Calendar.setMonth(this.month);

  this.Calendar.setTime(this.Calendar.addDays(-7).getTime());

  this.month=this.Calendar.getMonth();

  this.year=this.Calendar.getFullYear();

  this.first_day_week=this.Calendar.firstDayWeek(this.Calendar.getDate());

  this.today=this.first_day_week;

  break;

  case 'day':

  this.Calendar.setTime(this.Calendar.addDays(-1).getTime());

  this.month=this.Calendar.getMonth();

  this.year=this.Calendar.getFullYear();

  this.first_day_week=this.Calendar.firstDayWeek(this.Calendar.getDate());

  this.today=this.Calendar.getDate();

  break;

}

this.build_html();

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

  var tmp_day=new Date(this.getTime());

  tmp_day.setDate(today);

  var day_week=tmp_day.getDay()*-1;





  return tmp_day.addDays(day_week).getDate();

}

Date.prototype.monthDays= function(){

  var d= new Date(this.getFullYear(), this.getMonth()+1, 0);

  return d.getDate();

}

Date.prototype.getDateFormat=function(){

  y=this.getFullYear();

  m=this.getMonth()+1;

  d=this.getDate();

  return y+"-"+(m<10?'0'+m:m)+"-"+(d<10?"0"+d:d);

}

Date.prototype.getWeekDay=function(){

  days=new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

  return days[this.getDay()];

}

Date.prototype.getMonthName=function(){

  months=new  Array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

  return months[this.getMonth()];

}

Date.prototype.getHourAMPM=function(){

  h=this.getHours();

  am="am";

  if(h>=12){

    am="pm";

  }

  if(h>=13){

    h=h-12;

  }

  if(h==0){

    h=12;

  }

  h=(h<10?"0"+h:h);

  m=(this.getMinutes()<10?"0"+this.getMinutes() : this.getMinutes());

  return h+":"+m+" "+am;

}

