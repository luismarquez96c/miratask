var base_url = 'http://demo.web-informatica.info/Miralaw/';

function printInvoices(){
	var date1 = $('#date1').val();
	var date2 = $('#date2').val();

	if (date1=='' || date2=='') {
		alert('seleccione una fecha correcta');
	}

	window.location.replace(base_url+'Billing/invoicesToPrint?fecha1='+date1+'&fecha2='+date2);
}