$(document).on("input",".mask-hour",function(e){
   var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,2})/);
  /* if(x[1].length==1 && parseInt(x[1])>1 && parseInt(x[1])<10){
   	x[1]="0"+x[1];
   }*/
    e.target.value =(!x[2] ? x[1] : x[1] + ':' + x[2]);
});
$(document).on("change",".mask-hour",function(e){
	val=e.target.value;
	if(val.length==2){
		val=val+":00";
		e.target.value=val;
		return;
	}
	if(val.length==4){
		val=val+"0";
		e.target.value=val;
		return;
	}

});
$(document).on("input",".mask-date",function(e){
   var x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,2})(\d{0,4})/);
    e.target.value =(!x[2] ? x[1] : x[1] + '/' + x[2])+(!x[3]?'':'/'+x[3]);
});
