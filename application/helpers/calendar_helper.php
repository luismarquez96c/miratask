<?php 

function userget(){

	$CI =& get_instance();

	$user=array(

	"id"=>$CI->session->userdata('Id'),

    "name"=>$CI->session->userdata('Name'),

    "lastname"=>$CI->session->userdata('LastName'),

    "status"=>$CI->session->userdata('Estate'),

    "role"=>$CI->session->userdata('Role'),

    "email"=>$CI->session->userdata('Email')

    );

    return (object)$user;

}

function str_to_date($str){

	$str=explode("/",$str);

	if(count($str)!=3){

		return false;

	}

	if(!checkdate($str[0],$str[1],$str[2])){

		return false;

	}

	return $str[2]."-".zero($str[0])."-".zero($str[1]);

}

function date_to_str($date){

	return date("m/d/Y",strtotime($date));

}

function str_to_minutes($str){

	$str=explode(":",$str);

	if(count($str)!=2){

		return false;

	}

	$mins=$str[0]*60+$str[1];

	return ($mins<=1439? $mins:false ); // 1439 = 23 horas 59 segundos

}

function minutes_to_hours($minutes){

	$h=floor($minutes/60);

	$m=$minutes-($h*60);

	return zero($h).":".zero($m);

}

function zero($num,$zeros=2){

  return sprintf('%0'.$zeros.'d', $num);

}



function _v(&$obj,$default=""){

	if(isset($obj)){

		return $obj;

	}

	return $default;

}

function extrac_date($date,$format){

	return date($format,strtotime($date));

}



?>

