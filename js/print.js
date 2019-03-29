var base_url = 'http://demo.web-informatica.info/Miralaw/';



// function printInvoices(){

// 	var date1 = $('#date1').val();

// 	var date2 = $('#date2').val();



// 	if (date1=='' || date2=='') {

// 		alert('seleccione una fecha correcta');

// 	}



// 	window.location.replace(base_url+'Billing/invoicesToPrint?fecha1='+date1+'&fecha2='+date2);

// }

function printInvoices(url_base='') {
	var date1 = $('#date1').val();

	var date2 = $('#date2').val();
	
	
	
	
	if (date1 == '' || date2 == '') {
		
		alert('seleccione una fecha correcta');
		
	}else{
		
		$.ajax({
			url: url_base+'Billing/invoicesToPrint?fecha1='+date1+'&fecha2='+date2, success: function (result) {
				myWindow=window.open('', '', 'left=0,top=0,width=1180,height=900,toolbar=0,scrollbars=0,status=0');
				myWindow.document.write(result);
				myWindow.focus();
				myWindow.print();
			}
		});
		
		
		
	}
}