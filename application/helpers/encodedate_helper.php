<?php
	//include("../config/config.php");

	function encodedate($date){

		if($date==""){
			$date=date('Y-m-d H:i:s');
		}
		
		
		$old_date_timestamp = strtotime($date);
		$new_date = date('Y-m-d H:i:s', $old_date_timestamp);  
		
		



		return $new_date;

		 

	}
?>