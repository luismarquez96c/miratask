<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

	function  __construct(){
		parent:: __construct();

		if($this->session->userdata('Email')==""){ redirect("Login"); }
		$this->load->model('SecureModel');
		$this->load->model('MatterModel');
		$this->load->model('UserModel');
		$this->load->model('ContactModel');
		$this->load->model('Calendar_model','calendar');
		$this->load->helper('calendar_helper');
		$this->load->model('AdminModel');
	}

	public function index()
	{
		$data=$this->SecureModel->globalTask();


		$data["owners"]=$this->calendar->owners_get();
		
		$data["vista"]="calendar/calendar-container";
		$this->load->view('MainView', $data);
	}
	
	function modal_event_detail(){
		$data["date"]=($this->input->post("date") && $this->input->post("date")!=0 ? date("m/d/Y",strtotime($this->input->post("date"))) : date("m/d/Y") );
		$data["minute"]=(int)$this->input->post("minute");
		// DEFAULT_MATTER VA NULO AL LLAMAR DESDE ADD_EVENT JS
		$data["default_matter"]=$this->calendar->matter_get_by_id((int)$this->input->post("matter_id"));

		$id_event=$this->input->post("id")?(int)$this->input->post("id"):0;
		$data["owners"]=$this->calendar->owners_get();
		$data["event"]=$this->calendar->event_get($id_event);
		$this->load->view('calendar/modal-event-detail',$data);
	}

	function attach_search(){
		$w=addslashes($this->input->post("search"));
		$r=$this->calendar->attach_search($w);
		$json["error"]=0;
		$json["data"]=$r;
		echo json_encode($json);
	}
	function save_event(){
		$post=$this->input->post();

		$start_date=str_to_date($this->input->post("start_date"));
		$end_date=str_to_date($this->input->post("end_date"));
		$start_time=str_to_minutes($this->input->post("start_time"));
		$end_time=str_to_minutes($this->input->post("end_time"));

		$attach_id=$this->input->post("id_attach");
		$attach_type=$this->input->post("type_attach");

		$event["id"]=$this->input->post("id")?(int)$this->input->post("id"):0;
		$event["id_user"]=$this->input->post("owner");
		$event["subject"]=$this->input->post("subject");
		$event["location"]=$this->input->post("location");
		$event["start_date"]=$start_date;
		$event["start_time"]=$start_time;
		$event["end_date"]=$end_date;
		$event["end_time"]=$end_time;
		$event["start_fulldate"]=$start_date." ".minutes_to_hours($start_time).":00";
		$event["end_fulldate"]=$end_date." ".minutes_to_hours($end_time).":00";
		$event["description"]=$this->input->post("description");
		$event["all_day"]=$this->input->post("allday")?1:0;
		$event["private"]=0;
		$event["date"]=date('Y-m-d H:i:s');
		$event["creator"]=$this->session->userdata("Id");

		

		



		
		$id_event=$this->calendar->event_save($event);
		$attachs=array();
		if(is_array($attach_id)):
			foreach($attach_id as $i => $att):
				$tmp["id_event"]=$id_event;
				$tmp["id_attach"]=$att;
				$tmp["type_attach"]=$attach_type[$i];
				$tmp["date"]=date('Y-m-d H:i:s');
				$tmp["creator"]=$this->session->userdata("Id");
				$attachs[]=$tmp;
			endforeach;


			$this->calendar->attach_event_save($attachs);
		endif;

		$this->load->helper("SendMail");

		$userDB=$this->SecureModel->get('ml_us_users', " AND Id='".$this->input->post('owner')."'  ");

		if($userDB->Email!=""){

			$content ="<h2>Se te ha asignado un nuevo evento</h2>";

			$content.= $this->session->userdata('Name').' '.$this->session->userdata('LastName').' te ha asignado un nuevo evento en: '.base_url();

			$content.="<br>Fecha de inicio: ".$start_date;

			$content.="<br>Fecha de finalización: ".$end_date;

			$content.="<br>Descripción: ".$this->input->post('description')."<br><br><br>";

			$content.='<br>Para más detalles de click en el siguiente enlace: ';

			$content.='<a href="'.base_app().'Calendar/"> Evento Nuevo</a><br><br>';

			$img_empresa = $this->AdminModel->get_url();

			$content.='<br><img src="'.$img_empresa->url.'"<br>';

			$content.='<br><a href="'.base_url().'">MiraTask.com</a>';

			SendMail($userDB->Email,$content,"Tienes un nuevo evento");
		}


		$json["error"]=0;

		echo json_encode($json);

	}
	function events_get(){
		$users=$this->input->post("users");
		$month=zero($this->input->post("month"));
		$year=$this->input->post("year");
		if(count($users)>0){

			$r=$this->calendar->events_get($users,$year,$month);	
		}else{
			$r=array();
		}
		echo json_encode($r);
	}
	function event_detele(){
		$id_event=(int)$this->input->post("id_event");
		$this->calendar->event_delete($id_event);
		$r["error"]=0;
		echo json_encode($r);
	}


}

/* End of file Calendar.php */
/* Location: ./application/controllers/Calendar.php */