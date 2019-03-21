<?php
	//include("../config/config.php");

function decodedate($date){


	if($date=="0000-00-00 00:00:00" OR $date=="" ){

		$new_date="";

	}else{

		$database_date_timestamp = strtotime($date);
		$new_date = date('m/d/Y', $database_date_timestamp);

	}




	echo $new_date;



}

function crear_hora($hora){
	$nueva_hora = ($hora/60);

	$partes=explode(".",$nueva_hora);

	if ($partes[0]>12) {

		$horas = $partes[0]-12;
		($horas<10?$horas="0".$horas:$horas);

		$minutos = $partes[1]*0.6;
		($minutos>0?$minutos==$minutos:$minutos="00");
		$nueva_hora = $horas.":".$minutos;
		$nueva_hora = $nueva_hora." P.M.";

	}else{
		$horas = $partes[0];
		($horas<10?$horas="0".$horas:$horas);
		$minutos = $partes[1]*0.6;
		($minutos>0?$minutos==$minutos:$minutos="00");
		$nueva_hora = $horas.":".$minutos;
		$nueva_hora = $nueva_hora." A.M.";

	}

	return $nueva_hora;
}
?>