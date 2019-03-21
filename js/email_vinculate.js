$(document).ready(function() {
	$('#form-email').submit(function() {
		var email = $('#email').val();
		var pass = $('#pass').val();
		$.ajax({
			url: base_app+'Dashboard/loginEmail',
			type: 'POST',
			dataType: 'HTML',
			data: {correo: email, contra: pass},
			success:function (data) {
				$('#info_email').text(data);
				$('#modal-correo').modal('hide');
			}
		});
		
		return false
	});;
});