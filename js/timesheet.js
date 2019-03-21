$(document).ready(function() {
	$('.bat').hover(function() {
		$('.at').css('color', '#fff');
	}, function() {
		$('.at').css('color', '#909090');
	});

	$('.bwt').hover(function() {
		$('.wt').css('color', '#fff');
	}, function() {
		$('.wt').css('color', '#909090');
	});


	$.ajax({
		url: base_app+'Checkin/index',
		type: 'POST',
		dataType: 'HTML',
		data: {status: '1'},
		success:function(response){
			if (response==0) {
				$('#Checkin').addClass('null');
			}
			if (response==1) {
				$('#Checkin').addClass('active');
				$('#Pause').removeClass('active');
				$('#Checkout').removeClass('active');
			}
			if (response==2) {
				$('#Resume').removeClass('active');
				$('#Pause').addClass('active');
			}
			if (response==3) {
				$('#Pause').removeClass('active');
				$('#Checkin').addClass('active');
				$('#Resume').addClass('active');
				$('#Checkout').removeClass('active');
			}
		}

	});

	$('#Checkin').click(function() {
		if ($('#Checkin').attr('class')!='active' && $('#Checkin').attr('class')=='null') {
			$('#light-box-sessions').modal('show');
			$('.btn-lightbox').click(function() {
				var check = $(this).data('button');
				if (check === 'y') {
					$(this).addClass('active');
					$.ajax({
						url: base_app+'Checkin/start',
						type: 'POST',
						dataType: 'HTML',
						data: {status: '1'},
						success:function(data){
							alert(data);
							$('#light-box-sessions').modal('hide');
							$('#Pause').removeClass('active');
						}
					});
				}else{
					$('#light-box-sessions').modal('hide');
				}
			});
		}else{
			alert('You can´t start again');
		}
	});


	$('#Pause').click(function() {
		if ($(this).attr('class')!='active'){
			$.post(base_app+'Checkin/pause', {status: '0'}, function(work_hours) {
				$('.head-modal').html('Pause Time');
				$('.img-lightbox').attr('src', base_app+'img/lightbox/pause_icon.png');
				if ($('#light-box-sessions').data('lng')=='EN') {
					html_modal = "You have been working for "+work_hours+". </br>Wold you like to pause your session?";
				}else{
					html_modal = "Haz trabajado: "+work_hours+". </br>¿Deseas poner en pausa tu sesión?";
				}
				$('.text-modal').html(html_modal);
				$('.btn-yes').data('button', 'y_p');
				$('.btn-no').data('button', 'n_p');
				$('#light-box-sessions').modal('show');

				$('.btn-lightbox').click(function() {
					var check = $(this).data('button');
					if (check === 'y_p') {
						$('#Pause').addClass('active');
						$('#Checkin').addClass('active');
						$('#Resume').removeClass('active');
						$.ajax({
							url: base_app+'Checkin/pause',
							type: 'POST',
							dataType: 'HTML',
							data: {status: '1'},
							success: function(data){
								alert(data);
								$('#light-box-sessions').modal('hide');
							}
						});
					}if(check === 'n_p'){
						$('#light-box-sessions').modal('hide');
					}else{

					}
				});
			});
		}else{
			alert('You can´t pause again');
		}
	});

	$('#Resume').click(function() {
		if ($(this).attr('class')!='active') {
			$('.head-modal').html('Resume');
			$('.img-lightbox').attr('src', base_app+'img/lightbox/start_icon.png');
			if ($('#light-box-sessions').data('lng')=='EN') {
				html_modal = "Do you want to resume your session?";
			}else{
				html_modal = "¿Deseas retomar la sesión?";
			}
			$('.text-modal').html(html_modal);
			$('.btn-yes').data('button', 'y_r');
			$('.btn-no').data('button', 'n_r');
			$('#light-box-sessions').modal('show');

			$('.btn-lightbox').click(function() {
				var check = $(this).data('button');
				if (check == 'y_r') {
					$('#Resume').addClass('active');
					$('#Pause').removeClass('active');
					$('#Checkout').removeClass('active');
					$.ajax({
						url: base_app+'Checkin/resume',
						type: 'POST',
						dataType: 'HTML',
						data: {status: '1'},
						success:function(data){
							alert(data);
							$('#light-box-sessions').modal('hide');
						}
					});
				}if (check=='n_r'){
					$('#light-box-sessions').modal('hide');
				}else{

				}
			});
		}else{
			alert('You can´t resume');
		}
	});

	$('#Checkout').click(function() {
		if ($(this).attr('class')!='active') {
			$.post(base_app+'Checkin/checkout', {status: '0'}, function(work_hours) {

				$('.head-modal').html('Check Out');
				$('.img-lightbox').attr('src', base_app+'img/lightbox/checkout_icon.png');
				if ($('#light-box-sessions').data('lng')=='EN') {
					html_modal = "You worked "+work_hours+" today. </br>Dou you want to check out?";
				}else{
					html_modal = "Haz trabajado: "+work_hours+". </br>¿Deseas cerrar la sesión?";
				}
				$('.text-modal').html(html_modal);
				$('.btn-yes').data('button', 'y_co');
				$('.btn-no').data('button', 'n_co');
				$('#light-box-sessions').modal('show');

				$('.btn-lightbox').click(function() {

					var check = $(this).data('button');

					if (check == 'y_co') {
						$('#Checkout').addClass('active');
						$('#Checkin').removeClass('active');
						$('#Pause').addClass('active');
						$('#Resume').addClass('active');
						$.ajax({
							url: base_app+'Checkin/checkout',
							type: 'POST',
							dataType: 'HTML',
							data: {status: '1'},
							success:function(data){
								$('.text-modal').html(data);
								$('.container-buttons').html('<button class="btn btn-success btn-lg btn-lightbox" data-dismiss="modal">OK</button>')
							}
						});
					}if (check == 'n_co'){
						$('#light-box-sessions').modal('hide');
					}else{

					}
				});

			});
		}else{
			alert('You can´t check out');
		}
	});

	$('.fa-edit').click(function() {
		var element = $(this).data('row');
		$('.'+element).removeAttr('readonly').focus();
		$('.save-'+element).removeClass('hidden');
		$(this).addClass('hidden');
	});

	$('.fa-save').click(function() {
		var element = $(this).data('row');

		$('.'+element).attr('readonly');

		var user = $("#user"+element).val();
		
		var hora_start = $('#start'+element).val();

		var pausa = $('#pausa'+element).val();

		var pausaf = $('#pausaf'+element).val();

		var out = $('#out'+element).val();

		var validate = $('#validate'+element).val();

		if (out<pausaf) {

			alert('El checkout no debe ser menor al break out');
			$('#out'+element).focus();

		} else if (pausaf<pausa) {
			alert('El break out no debe ser menor al break in');

			$('#pausaf'+element).focus();

		}else if (pausa<hora_start) {

			alert('El break in no debe ser menor al check in');
			$('#pausa'+element).focus();

		}else{
			$.ajax({
				url: base_app+'Admin/update_fecha',
				type: 'POST',
				dataType: 'HTML',
				data: {usuario: user, start:hora_start, hora_pausa:pausa, hora_pausaf:pausaf, hora_out:out, fecha_v: validate},
				success:function (data) {
					location.reload();
				}
			});

			$(this).addClass('hidden');
			$('.edit-'+element).removeClass('hidden');
		}
	});

	$('.fa-delete').click(function(){
		var confirm = window.confirm("Delete?");
		
		if (confirm==true){

			var element = $(this).data('row');

			var user = $("#id"+element).val();

			$.ajax({
				url: base_app+'Admin/delete_fecha',
				type: 'POST',
				dataType: 'HTML',
				data: {usuario: user},
				success:function (data) {
					location.reload();
				}
			});
		}else{
			
		}
	});

});


function exportarXLS()
{
	var tab_text="<table border='1px'><tr bgcolor='#7577E6' colspan='4'>";
	var textRange; var j=0;
    tab = document.getElementById('tabla'); // ID de la tabla

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
    	tab_text=tab_text+tab.rows[j].innerHTML+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");// Remueve los links
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // Remueve las imágenes
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // Remover inputs

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE"); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))
    {
    	txtArea1.document.open("txt/html","replace");
    	txtArea1.document.write(tab_text);
    	txtArea1.document.close();
    	txtArea1.focus(); 
    	sa=txtArea1.document.execCommand("SaveAs",true,"Timesheet.xls");
    }  
    else                
    	sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
}