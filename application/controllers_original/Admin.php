<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __construct(){
		parent:: __construct();

		if($this->session->userdata('Email')==""){ redirect("Login"); }

		if($this->session->userdata("Role")!="1"){ redirect(base_url().'dashboard'); }

		$this->load->model('SecureModel');
		$this->load->model("AdminModel");
	}

	public function index()
	{
		$data=$this->SecureModel->globalTask();
		$data["vista"]="administrator/Admin_panel";
		$data['date2'] = date('Y-m-d');
		$data['date1'] = date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d'))));
		$this->load->view('MainView', $data);
	}

	public function Working_time()
	{
		function hora_parcial($hora,$minutos)
		{
			$restante = round($minutos/6, 1);

			$restante = str_replace(".", "", $restante);

			return $hora.".".$restante;

		}

		function calcular_total($a_break,$d_break){
			return $a_break+$d_break;
		}

		function horas_reloj($tiempo){
			$tiempo = explode(".", $tiempo);

			$hora = $tiempo[0];

			$minutos = round($tiempo[1]*0.6,0);

			return $hora[0]." Hours ".$minutos." Minutes";
		}

		if($this->input->get('date1')!="" && $this->input->get('date2')!=""){
			$fecha1 = $this->input->get('date1');
			$fecha2 = $this->input->get('date2');
		}else{
			$fecha1 = "";
			$fecha2 = date('Y-m-d');
		}

		$data=$this->SecureModel->globalTask();
		$data['users']=$this->AdminModel->get_users($fecha1,$fecha2);

		for ($i = 0; $i < count($data['users']); $i++) {

			$fechaInicio = $data['users'][$i]->hora_start;
			$fechaInicio = new DateTime($fechaInicio);

			$fecha_pausa = $data['users'][$i]->hora_pausa;
			$fecha_pausa = new DateTime($fecha_pausa);

			$fecha_pausa_fin = $data['users'][$i]->hora_pausa_fin;
			$fecha_pausa_fin = new DateTime($fecha_pausa_fin);

			$fechaFin = $data['users'][$i]->hora_fin;
			$fechaFin = new DateTime($fechaFin);

			$intervalo1 = $fechaInicio->diff($fecha_pausa);
			$intervalo2 = $fecha_pausa_fin->diff($fechaFin);

			$data['work_time'][$i] = calcular_total(hora_parcial($intervalo1->format('%h'),$intervalo1->format('%i')),hora_parcial($intervalo2->format('%h'),$intervalo2->format('%i')));

			$data['work_time'][$i] = horas_reloj($data['work_time'][$i]);
			
		}

		/*for ($i = 0; $i < count($data['users']); $i++) {
			$fechaPausa = $data['users'][$i]->hora_pausa;
			$fechaPausaFin = $data['users'][$i]->hora_pausa_fin;

			$break = 

			$fechaInicio = $data['users'][$i]->hora_start;
			$fechaInicio = new DateTime($fechaInicio);

			$fechaFin = $data['users'][$i]->hora_fin;
			$fechaFin = new DateTime($fechaFin);

			$intervalo = $fechaInicio->diff($fechaFin);
			$data['work_time'][$i] = $intervalo->format('%h hours and %i minutes');
		}
*/
		$data['vista']="administrator/Working_time";
		$this->load->view('MainView', $data);
	}

	public function Working_detail($Id)
	{
		$data=$this->SecureModel->globalTask();
		$data['vista'] = "administrator/Working_detail";
		$data['user'] = $Id;
		$data['date2'] = date('Y-m-d');
		$data['date1'] = date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d'))));
		$this->load->view('MainView', $data);
	}

	public function Adjust_time()
	{
		function hora_parcial($hora,$minutos)
		{
			$restante = round($minutos/6, 1);

			$restante = str_replace(".", "", $restante);

			return $hora.".".$restante;

		}

		function calcular_total($a_break,$d_break){
			return $a_break+$d_break;
		}

		if($this->input->get('date1')!="" && $this->input->get('date2')!=""){
			$fecha1 = $this->input->get('date1');
			$fecha2 = $this->input->get('date2');
		}else{
			$fecha1 = "";
			$fecha2 = date('Y-m-d');
		}

		$data=$this->SecureModel->globalTask();
		$data['users']=$this->AdminModel->get_users($fecha1,$fecha2);

		for ($i = 0; $i < count($data['users']); $i++) {

			$fechaInicio = $data['users'][$i]->hora_start;
			$fechaInicio = new DateTime($fechaInicio);

			$fecha_pausa = $data['users'][$i]->hora_pausa;
			$fecha_pausa = new DateTime($fecha_pausa);

			$fecha_pausa_fin = $data['users'][$i]->hora_pausa_fin;
			$fecha_pausa_fin = new DateTime($fecha_pausa_fin);

			$fechaFin = $data['users'][$i]->hora_fin;
			$fechaFin = new DateTime($fechaFin);

			$intervalo1 = $fechaInicio->diff($fecha_pausa);
			$intervalo2 = $fecha_pausa_fin->diff($fechaFin);

			$intervalo3 = $fecha_pausa->diff($fecha_pausa_fin);

			$data['work_time'][$i] = calcular_total(hora_parcial($intervalo1->format('%h'),$intervalo1->format('%i')),hora_parcial($intervalo2->format('%h'),$intervalo2->format('%i')));
			
			$data['breaks_hours'][$i] = $intervalo3->format('%h hours %iminutes');
			
		}

		$data['date2'] = date('Y-m-d');
		$data['date1'] = date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d'))));
		
		$data['vista'] = "administrator/Adjust_time";
		$this->load->view('MainView', $data);
	}

	public function update_fecha()
	{
		$usuario = $this->input->post('usuario');
		$fecha_v = $this->input->post('fecha_v');
		$start = $this->input->post('start');
		$hora_pausa = $this->input->post('hora_pausa');
		$hora_pausaf = $this->input->post('hora_pausaf');
		$hora_out = $this->input->post('hora_out');

		$start = $fecha_v." ".$start;
		$hora_pausa = $fecha_v." ".$hora_pausa;
		$hora_pausaf = $fecha_v." ".$hora_pausaf;
		$hora_out = $fecha_v." ".$hora_out;

		$this->AdminModel->set_fecha($usuario,$fecha_v,$start,$hora_pausa,$hora_pausaf,$hora_out);
		

	}

	public function delete_fecha()
	{
		$usuario = $this->input->post('usuario');

		$this->AdminModel->delete_fecha_($usuario);
	}

	public function changeLogo()
	{
		$data=$this->SecureModel->globalTask();
		$data["vista"]="administrator/ChangeLogo";

		$this->load->view('MainView', $data);
	}

	public function upload_image()
	{
		$config['upload_path']          = './img/logo';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 2048;
		$config['max_height']           = 2048;

		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto'))
		{
			$error = array('error' => $this->upload->display_errors());

			redirect(base_app()."Admin");
		}
		else
		{
			$uploadData = $this->upload->data();
			$url = base_url().'img/logo/'.$uploadData['file_name'];

			$this->AdminModel->updateFoto($url);

			redirect(base_app()."Dashboard");
		}
	}

}



?>