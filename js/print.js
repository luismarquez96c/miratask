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

	$.ajax({
		url: "demo_test.txt", success: function (result) {
			$("#div1").html(result);
		}
	});

	var date1 = $('#date1').val();

	var date2 = $('#date2').val();



	if (date1 == '' || date2 == '') {

		alert('seleccione una fecha correcta');

	}else{

		
		
		window.location.replace(url_base + 'Billing/invoicesToPrint?fecha1=' + date1 + '&fecha2=' + date2);
		
	}
}