<?php  
defined('BASEPATH') OR exit('No direct script access allowed');


class Checkin extends CI_Controller{

	function  __construct(){
		parent:: __construct();

		if($this->session->userdata('Email')==""){ redirect("Login"); }
		$this->load->model('SecureModel');
		$this->load->model('MatterModel');
		$this->load->model('CheckinModel');
		
	}

	public function index()
	{
		$fecha = date('Y-m-d');
		$check=$this->CheckinModel->status($this->session->userdata("Id"),$fecha);
		if($check==""){
			echo 0;
		}else{
			echo $check->estado;
		}		
	}


	public function start()
	{

		//$validate=$this->CheckinModel->validate($this->session->userdata("Id"));

		$horaInicio = date('Y-m-d H:i:s');
		$register = $this->CheckinModel->insert_user($this->session->userdata("Id"));
		$update = $this->CheckinModel->update_inicio($horaInicio,$this->session->userdata("Id"));
		echo 'Recording Start';


	}

	public function pause()
	{
		$status = $this->input->post('status');
		if ($status == 0) {
			$fecha1 = $this->CheckinModel->get_hora($this->session->userdata("Id"),'hora_start');
			$fecha1 = new DateTime($fecha1->hora_start);
			$fecha2 = date('Y-m-d H:i:s');
			$fecha2 = new DateTime($horaActual);

			$intervalo = $fecha1->diff($fecha2);
			echo $intervalo->format('%h hours and %i minutes');

		}
		else{
			$horaPausa = date('Y-m-d H:i:s');
			$update = $this->CheckinModel->update_pause($horaPausa,$this->session->userdata("Id"));
			echo 'Pause Start';
		}
	}

	public function resume()
	{
		$horaResume = date('Y-m-d H:i:s');
		$update = $this->CheckinModel->update_resume($horaResume,$this->session->userdata("Id"));
		echo 'Resume';
	}

	public function checkout()
	{
		$status = $this->input->post('status');
		if ($status == 0) {
			$fecha1 = $this->CheckinModel->get_hora($this->session->userdata("Id"),'hora_pausa');
			$fecha1 = new DateTime($fecha1->hora_pausa);

			$fecha2 = $this->CheckinModel->get_hora($this->session->userdata("Id"),'hora_pausa_fin');
			$fecha2 = new DateTime($fecha2->hora_pausa_fin);

			$intervalo = $fecha1->diff($fecha2);
			$intervalo = $intervalo->format('-%h hours -%i minutes');

			$horaCeckout = date('Y-m-d H:i:s');
			$horaCeckout = strtotime($intervalo,strtotime($horaCeckout));
			$horaCeckout = date('Y-m-d H:i:s',$horaCeckout);
			$horaCeckout = new DateTime($horaCeckout);

			$fecha_start = $this->CheckinModel->get_hora($this->session->userdata("Id"),'hora_start');
			$fecha_start = new DateTime($fecha_start->hora_start);

			$intervalo2 = $fecha_start->diff($horaCeckout);

			echo $intervalo2->format('%h hours %i minutes');

		}else{
			$horaCeckout = date('Y-m-d H:i:s');
			$update = $this->CheckinModel->update_ceckout($horaCeckout,$this->session->userdata("Id"));
			echo 'Check out Completed';
		}
	}

}


?>