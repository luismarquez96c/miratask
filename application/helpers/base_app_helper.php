<?php

function base_app(){

	return base_url();

}

function email_accounts($user,$pass)

{

	$hostname = '{mail.web-informatica.com:993/imap/ssl/novalidate-cert}INBOX';

	$m = imap_open($hostname, $user, $pass, NULL, 1, array('DISABLE_AUTHENTICATOR' => 'GSSAPI'));

	$result = imap_search($m, 'UNSEEN');

	imap_close($m);

	if (!empty($result)) {

		return "Unread Emails: " . count($result);

	}else{

		return "Unread Emails: 0";

	}



}


function traducirFactura($idioma,$valor)
{
	if ($idioma=='ES') {
		if ($valor=='Draft') {
			$valor='Borrador';
		}else{
			$valor='Pagado';
		}
	}

	return $valor;
}

function traducirPrioridad($idioma,$valor)
{
	$ci =& get_instance();

	$ci->load->model('SecureModel');

	if ($idioma=='EN') {
		$valor = $ci->SecureModel->priorityEN($valor)->Name_EN;
	}

	return $valor;

}

function traducirStatus($idioma,$valor)
{
	$ci =& get_instance();

	$ci->load->model('SecureModel');

	if ($idioma=='EN') {
		$valor = $ci->SecureModel->statusEN($valor)->Status_EN;
	}

	return $valor;
}


?>