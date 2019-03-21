<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dashboard extends CI_Controller {



	public $role;

	

	function  __construct(){

		parent:: __construct();


		if($this->session->userdata('Email')==""){ redirect("Login"); }


		$this->load->model('SecureModel');

		$this->load->model('MatterModel');

		$this->load->model('TaskModel');

		$this->load->model('BillingModel');

		$this->lang->load($this->session->userdata("lng") , 'labels');

	}



	public function setFiltroTask($time){



		if($time=="Today"){



			$this->session->set_userdata("labelTimeAct",$this->lang->line('days_1'));

			$this->session->set_userdata("time"," AND StartDate>='".date('Y-m-d 00:00:00')."' AND StartDate<='".date('Y-m-d 59:59:59')."' ");



		}else if($time=="Tomorrow"){



			$Date=date('Y-m-d 00:00:00', strtotime(date('Y-m-d 00:00:00'). ' + 1 day'));



			$this->session->set_userdata("labelTimeAct",$this->lang->line('days_2'));

			$this->session->set_userdata("time"," AND StartDate='".$Date."' ");



		}else if($time=="Week"){



			$monday = date( 'Y-m-d H:i:s', strtotime( 'monday this week' ) );

			$friday = date( 'Y-m-d H:i:s', strtotime( 'friday this week' ) );



			$this->session->set_userdata("labelTimeAct",$this->lang->line('days_3'));

			$this->session->set_userdata("time"," AND StartDate>='".$monday."' AND StartDate<='".$friday."'   ");



		}else if($time=="Overdue"){



			$this->session->set_userdata("labelTimeAct",$this->lang->line('days_5'));

			$this->session->set_userdata("time"," AND  Status!='3' AND DueDate<'".date( 'Y-m-d H:i:s')."' ");



		}else if($time=="All"){



			$this->session->set_userdata("labelTimeAct",$this->lang->line('none_1'));

			$this->session->set_userdata("time","    ");



		}else{



			$this->session->set_userdata("labelTimeAct",$this->lang->line('days_1'));

			$this->session->set_userdata("time"," AND StartDate>='".date('Y-m-d 00:00:00')."' AND StartDate<='".date('Y-m-d 59:59:59')."' ");



		}

		

		redirect(base_app()."Dashboard");





	} 



	public function setMYLastTask($time){



		if($time=="Today"){



			$this->session->set_userdata("labelMTimeAct", "Today");

			$this->session->set_userdata("time2"," AND StartDate>='".date('Y-m-d 00:00:00')."' AND StartDate<='".date('Y-m-d 59:59:59')."' ");



		}else if($time=="Tomorrow"){



			$Date=date('Y-m-d 00:00:00', strtotime(date('Y-m-d 00:00:00'). ' + 1 day'));



			$this->session->set_userdata("labelMTimeAct", "Tomorrow");

			$this->session->set_userdata("time2"," AND StartDate='".$Date."' ");





		}else if($time=="Overdue"){



			$this->session->set_userdata("labelMTimeAct", "Overdue");

			$this->session->set_userdata("time2"," AND  Status!='3' AND DueDate<'".date( 'Y-m-d 00:00:00')."' ");



		}else if($time=="Priority"){



			$this->session->set_userdata("labelMTimeAct", "All");

			$this->session->set_userdata("time2","    ");



		}else{



			$this->session->set_userdata("labelMTimeAct", "Today");

			$this->session->set_userdata("time2"," AND StartDate>='".date('Y-m-d 00:00:00')."' AND StartDate<='".date('Y-m-d 59:59:59')."' ");



		}

		

		redirect(base_app()."Dashboard");



		

	} 





	public function setLastMetting($time){



		if($time=="Today"){



			$this->session->set_userdata("labelExp", "Today");

			$this->session->set_userdata("time3"," AND  start_date>='".date('Y-m-d 00:00:00')."' AND end_date<='".date('Y-m-d 59:59:59')."' ");



		}else if($time=="Tomorrow"){



			$Date=date('Y-m-d 00:00:00', strtotime(date('Y-m-d 00:00:00'). ' + 1 day'));



			$this->session->set_userdata("labelExp", "Tomorrow");

			$this->session->set_userdata("time3"," AND start_date='".$Date."' ");





		}else if($time=="Week"){



			$monday = date( 'Y-m-d H:i:s', strtotime( 'monday this week' ) );

			$friday = date( 'Y-m-d H:i:s', strtotime( 'friday this week' ) );



			$this->session->set_userdata("labelExp","Week");

			$this->session->set_userdata("time3"," AND start_date>='".$monday."' AND end_date<='".$friday."'   ");



		} 

		

		redirect(base_app()."Dashboard");



		

	} 



	public function index()

	{

		//echo "Username:  ".$this->session->userdata('Email');

		//echo $this->session->userdata("Role");
		$ID_USER = $this->session->userdata("Id");




		if($this->session->userdata("time")==""){ $this->setFiltroTask('Today'); }



		

		$data=$this->SecureModel->globalTask();



		//echo "<br>filtro actual: ".$this->session->userdata("time");

		if ($this->session->userdata('Role')==1) {
			//$where = "";
			$data["lastFive"]   = $this->MatterModel->getLast5($where);
		}else{
			//$where = " AND ResponsibleAttoney='".$this->session->userdata("Id")."'";
			$data["lastFive"]   = $this->MatterModel->matter_last_by_user($ID_USER);
		}


		
		
		

		$data["lastTask"]   = $this->TaskModel->getLast5($this->session-> userdata("time"));


		$filtro=" AND AssignTo='".$this->session->userdata("Id")."' ".$this->session->userdata("time2");



		$data["myLastTask"]   = $this->TaskModel->getLast5($filtro, "  ");

		

		$data["recentActi"] = $this->MatterModel->extractRecent();



		$data["Meeting"]    = $this->TaskModel->getLastMetting($this->session->userdata("time3"), "LIMIT 10");



		$data["youBilled"]  = $this->BillingModel->activities_get_youbilled($this->session->userdata("time4"));









		$this->load->view('MainView',$data);



	}





	public function setYouBilled($time){



		if($time=="Today"){



			$this->session->set_userdata("labelYou", $this->lang->line('days_1'));

			$this->session->set_userdata("time4"," AND  date_activity>='".date('Y-m-d 00:00:00')."' AND date_activity<='".date('Y-m-d 59:59:59')."' ");









		}else if($time=="Week"){



			$monday = date( 'Y-m-d H:i:s', strtotime( 'monday this week' ) );

			$friday = date( 'Y-m-d H:i:s', strtotime( 'friday this week' ) );



			$this->session->set_userdata("labelYou",$this->lang->line('days_3'));

			$this->session->set_userdata("time4"," AND date_activity>='".$monday."' AND date_activity<='".$friday."'   ");



		}else if($time=="Month"){



			$daysOFmonth = cal_days_in_month(CAL_GREGORIAN,date('m'), date('Y'));



			$mesd1 = date('Y-m-').'01'.' 00:00:00';

			$mesd2 = date('Y-m-').$daysOFmonth.' 59:59:59';



			$this->session->set_userdata("labelYou",$this->lang->line('days_6'));

			$this->session->set_userdata("time4"," AND date_activity>='".$mesd1."' AND date_activity<='".$mesd2."'   ");



		}else if($time=="Year"){



			$daysOFmonth = cal_days_in_month(CAL_GREGORIAN,date('m'), date('Y'));



			$mesd1 = date('Y-').'01-01'.date(' 00:00:00');

			$mesd2 = date('Y-').'12-31'.date(' 59:59:59');



			$this->session->set_userdata("labelYou",$this->lang->line('days_7'));

			$this->session->set_userdata("time4"," AND date_activity>='".$mesd1."' AND date_activity<='".$mesd2."'   ");



		} 

		

		redirect(base_app()."Dashboard");



		

	} 





	public function loginEmail()

	{

		$user = $this->input->post('correo');

		$pass = $this->input->post('contra');



		$getEmail = email_accounts($user,$pass);



		$newdata = array(

			'email_unread' => $user,

			'pass_unread' => $pass

		);



		$this->session->set_userdata($newdata);



		echo $getEmail;

	}



}