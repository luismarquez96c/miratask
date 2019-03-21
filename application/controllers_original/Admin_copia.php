<?php  
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{

	function __construct(){
		parent:: __construct();

		if($this->session->userdata('Email')==""){ redirect("Login"); }

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

		$data=$this->SecureModel->globalTask();
		$data['users']=$this->AdminModel->get_users();

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


		$data=$this->SecureModel->globalTask();
		$data['users']=$this->AdminModel->get_users();

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
			
		}

		$data['date2'] = date('Y-m-d');
		$data['date1'] = date('Y-m-d',strtotime('-1 day',strtotime(date('Y-m-d'))));
		
		$data['vista'] = "administrator/Adjust_time";
		$this->load->view('MainView', $data);
	}

	public function update_fecha()
	{
		$nueva_hora = $this->input->post('hora_update');
		$nueva_hora_f = $this->input->post('hp_f');
		$usuario = $this->input->post('usuario');
		$campo = $this->input->post('row');
		$vali = $this->input->post('fecha_v');


		$fecha = $this->AdminModel->get_fecha($usuario,$campo,$vali);

		$fecha = date('Y-m-d',strtotime($fecha->$campo));

		if (empty($nueva_hora_f)) {
			$fecha_update = $fecha." ".$nueva_hora;

			$this->AdminModel->set_fecha($campo,$fecha_update,$usuario,$vali);
		}else{
			$fecha_update = $fecha." ".$nueva_hora;
			$fecha_update_f = $fecha." ".$nueva_hora_f;
			$this->AdminModel->set_fecha($campo,$fecha_update,$usuario,$vali,$fecha_update_f);
		}

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