<?php 

function encode($string) {

	$key=config_item('encryption_key');

	$result = '';

	for($i=0; $i<strlen($string); $i++) {

		$char = substr($string, $i, 1);

		$keychar = substr($key, ($i % strlen($key))-1, 1);

		$char = chr(ord($char)+ord($keychar));

		$result.=$char;

	}

	return urlencode(base64_encode($result));

}

function decode($string) {

	$string=urldecode($string);

	$key=config_item('encryption_key');

	$result = '';

	$string = base64_decode($string);

	for($i=0; $i<strlen($string); $i++) {

		$char = substr($string, $i, 1);

		$keychar = substr($key, ($i % strlen($key))-1, 1);

		$char = chr(ord($char)-ord($keychar));

		$result.=$char;

	}

	return $result;

}

function fill_menu_dropdown($module,$id_item=0){

	$ci =& get_instance();

	$r=$ci->pergaminosdb->menu_x_modulo_get($module);

	foreach($r as $i => $item):

		echo '<option value="'.$item->id.'" '.($item->id==$id_item? 'selected=""' : "").'>'.$item->name_menu.'</option>';

	endforeach;

}



function message($type,$mensaje){

	$ci =& get_instance();

	$ci->session->set_flashdata($type,$mensaje);

}

function show_message(){



	$ci =& get_instance();

	if($ci->session->flashdata("success")){

		echo '<div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span> '.$ci->session->flashdata("success").'</div>';

	}

	if($ci->session->flashdata("error")){

		echo '<div class="alert alert-danger"><span class="glyphicon glyphicon-remove"></span> '.$ci->session->flashdata("error").'</div>';

	}

	if($ci->session->flashdata("info")){

		echo '<div class="alert alert-info"><span class="glyphicon glyphicon-info-sign"></span> '.$ci->session->flashdata("info").'</div>';

	}

}

function user_get($value=""){

	$ci =& get_instance();

	$user=$ci->session->userdata("user_system");

	switch ($value) {

		case 'fullname':

		return $user->firstname." ".$user->lastname;

		break;

		case 'id':

		return $user->id;

		break;

		case 'username':

		return $user->username;

		break;

		default:

		return $user;

		break;

	}

	return $user;



}

function getMenu(){



}

function status($id){

	if($id==1)

		return "Activo";

	else

		return "Inactivo";

}

function getItemLongDescription($id_item){

	$ci =& get_instance();

	$sql="SELECT

	(SELECT GROUP_CONCAT(a.`description_long` SEPARATOR ' ') FROM tbl_item_descriptions a WHERE a.`item_id`=".$id_item." ORDER BY secuencia ASC) long_description,

	(SELECT GROUP_CONCAT(a.`content` SEPARATOR ' ') FROM tbl_item_content a WHERE a.`item_id`=".$id_item." ORDER BY secuencia ASC) content

	";

	$r=$ci->db->query($sql)->row();

	if(count($r)>0)

		return $r;

	return false;

}

function Paginate($ArrayList,$page,$numrows,&$total){

	$total=count($ArrayList);

	$total=ceil($total/$numrows);

	$tmpList=array();

	$li=($page-1)*$numrows;

	$ls=$li+$numrows;

	foreach($ArrayList as $i=> $item){

		if($i>=$li && $i<$ls){

			$tmpList[]=$item;

		}

	}

	unset($ArrayList);

	return $tmpList;



}





function timeformat($hora){

	$ampm="AM";

	if($hora>=12){

		$ampm="PM";

	}

	if($hora>12){



		$hora-=12;

	}





	$time=sprintf("%02d",$hora).":00 ".$ampm;

	return $time;

}

function getList($array,$index){

	$out=array();

	foreach($array as $i => $item):

		$out[$item->id]=$item->$index;

	endforeach;

	return $out;

}



function configSet($key,$value){

	$ci =& get_instance();



	$r=$ci->db->query("select * from tbl_config where variable='".$key."'")->row();

	if(count($r)>0){

		$ci->db->update("tbl_config",array("value"=>$value),array("variable"=>$key));

	}else{

		$ci->db->insert("tbl_config",array("value"=>$value,"variable"=>$key));

	}

}

function configGet($key){

	$ci =& get_instance();

	$r=$ci->db->query("select * from tbl_config where variable='".$key."'")->row();

	if(isset($r->value))

		return $r->value;

	else

		return "";

}

function send_mail($mail,$subject,$html,$hiddens=""){

	$CI =& get_instance();

	$config = Array(

		'protocol' => PROTOCOL,

		'smtp_host' => SMTP_HOST,

                'smtp_port' => SMTP_PORT,//587  25

                'smtp_user' => SMTP_USER,

                'smtp_pass' => SMTP_PASS,

                'mailtype'  => 'html',

                'charset'   =>  'utf-8',

                'validate'=> true

            );

	$CI->load->library('email', $config);

	$CI->email->set_newline("\r\n");

	$CI->email->from('info@mail.com',"");

	$CI->email->to($mail);



	if($hiddens!="")

		$CI->email->bcc($hiddens);



	$CI->email->subject($subject);

	$CI->email->message($html);

	$CI->email->send();

}

function clearstring($text){

	$text=str_replace("'", "\'", $text);

	$text=str_replace("\n", "\'", $text);

	$text=str_replace("\r", "\'", $text);

	$text=str_replace('"', "\'", $text);

	

	return $text;

}

function ExcelExport($headers,$matrix,$namefile='export'){

	$CI =& get_instance();

	$CI->load->library("PHPExcel");

	$objPHPExcel = new PHPExcel(); 

	$objPHPExcel->getActiveSheet()->setTitle('Proyectos'); 

	$columns_name=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");

	$i=0;

	$j=0;

	foreach($headers as $i => $row){

		$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(($i),1,$row);

		$objPHPExcel->getActiveSheet()

		->getColumnDimensionByColumn($i)

		->setAutoSize(true);

		$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow(($i),(1))->getFont()->setBold(true);

		$j++;

	}







	foreach($matrix as $i => $row){

		$j=0;

		$i=$i+1;

		foreach($row as  $cell){

            //$columnum=$j;

			if($j>26){

                //$columnum

			}



			$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(($j),($i+1),$cell);



			$j++;

		}

	}

//return;



// Save as an Excel BIFF (xls) file 

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 



	header('Content-Type: application/vnd.ms-excel'); 

	header('Content-Disposition: attachment;filename="'.$namefile.'.xls"'); 

	header('Cache-Control: max-age=0');

//ob_end_clean(); 

	$objWriter->save('php://output'); 

	exit(); 

}

function PDFExport($html="",$nombre="export"){

	define("DOMPDF_ENABLE_REMOTE", false);

	$CI =& get_instance();

	$CI->load->library("HTML2PDF");

	$objPDF = new HTML2PDF(); 

	$objPDF->create($html,$nombre,true);

	exit(); 

}

function ExcelGet($fileName,$sheet=-1,$index=true){





	$CI =& get_instance();

	$CI->load->library("PHPExcel");



	$excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);



	$excelReader->setReadDataOnly();



               // $loadSheets = array('Sheet1');

               // $excelReader->setLoadSheetsOnly($loadSheets);



                //the default behavior is to load all sheets

	$excelReader->setLoadAllSheets();



	$excelObj = $excelReader->load($fileName);

	$excelObj->getActiveSheet()->toArray(null, true,true,true);





	$worksheetNames = $excelObj->getSheetNames($fileName);

	$return = array();

	foreach($worksheetNames as $key => $sheetName){

                    //set the current active worksheet by name

		$excelObj->setActiveSheetIndexByName($sheetName);

                    //create an assoc array with the sheet name as key and the sheet contents array as value

		$return[$key] = $excelObj->getActiveSheet()->toArray(null, true,true,$index);

	}



	if($sheet!=-1){



		return $return[$sheet];

	}



	else

		return $return;

}

function zero($num,$zeros=2){

	return sprintf('%0'.$zeros.'d', $num);

}

function cleardate($date){

	if(trim($date)==""){

		return "";

	}

	$ar=explode(" ",$date);



	$date=explode("/",$ar[0]);

	if(count($date)==3){

		$d=zero((int)$date[0]);

		$m=zero((int)$date[1]);

		$y=($date[2]<=99? "19".$date[2]:$date[2]);

		return $y."-".$m."-".$d;

	}

		//sprintf("%0", $mStretch);

	return "";

}

function cleardate2($str){

	$months=array("","january"=>1,"february"=>2,"march"=>3,"april"=>4,"may"=>5,"june"=>6,"july"=>7,"august"=>8,"september"=>9,"october"=>10,"november"=>11,"december"=>12);

	$block=explode(",",$str);

	

	$block1=explode(" ",trim($block[1]));



	$month=$months[strtolower($block1[0])];

	$day=$block1[1];

	$block2=explode(" ",trim($block[2]));





	$year=$block2[0];

	$block3=explode("-",$block2[1]);

	

	$hour=zero(($block2[2]=="PM"?$block3[0]+12:$block3[0])).":".zero($block3[1]).":00";

	return $year."-".zero($month)."-".zero($day)." ".$hour;

}

 function plantilla_aplicar($html,$parametros=array()){



	 	$html=explode("{{",$html);

	 	$html=array_map(function($item) use ($parametros){

	 		$key=substr($item,0,strpos($item,'}}'));

	 		$replace=(isset($parametros[$key])?$parametros[$key]:"");

	 		return str_replace($key."}}",$replace,$item);

	 	},$html);

	 	$html=implode("",$html);

	 	return $html;

	 }

?>