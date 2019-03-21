<?php  

defined('BASEPATH') OR exit('No direct script access allowed');


class AdminModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_users($fecha1="",$fecha2)
	{
		$sql = "SELECT session.id_user, session.hora_start, session.hora_pausa,session.hora_pausa_fin, session.hora_fin, user.Name, user.LastName, user.Id FROM ml_user_sessions AS session INNER JOIN ml_us_users AS user ON user.Id = session.id_user WHERE session.fecha_register BETWEEN '$fecha1' AND '$fecha2 23:59:59' GROUP BY session.id_user";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function get_info_user($id,$fecha1,$fecha2)
	{
		$sql = "SELECT session.iduser_sessions, session.hora_start, session.hora_pausa, session.hora_pausa_fin, session.hora_fin, user.Name, user.LastName, user.Id, session.fecha_register FROM ml_user_sessions AS session INNER JOIN ml_us_users AS user ON user.Id = session.id_user WHERE user.Id = $id AND session.fecha_register BETWEEN '$fecha1' AND '$fecha2 23:59:59' ORDER BY fecha_register ASC";
		$query = $this->db->query($sql);

		return $query->result();	
	}

	public function get_horas_user($id)
	{
		$sql = "SELECT session.hora_start, session.hora_pausa, session.hora_pausa_fin, session.hora_fin, session.fecha_register FROM ml_user_sessions AS session INNER JOIN ml_us_users AS user ON user.Id = session.id_user WHERE user.Id = $id";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function get_fecha($id,$campo,$fecha_v)
	{

		$sql = "SELECT $campo FROM ml_user_sessions WHERE id_user = '$id' AND fecha_register = '$fecha_v'";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function set_fecha($usuario,$fecha_v,$start,$hora_pausa,$hora_pausaf,$hora_out)
	{
		$data = array('hora_start'=>$start, 'hora_pausa'=>$hora_pausa,'hora_pausa_fin'=>$hora_pausaf,'hora_fin'=>$hora_out);
		$where = array('id_user' => $usuario, 'fecha_register' => $fecha_v);
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('ml_user_sessions');
	}

	public function get_role($id)
	{
		$sql = "SELECT b.Role FROM ml_us_users AS a INNER JOIN ml_us_role AS b ON b.Id = a.Role WHERE a.Id = '$id'";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function delete_fecha_($id)
	{
		$this->db->where('iduser_sessions', $id);
		$this->db->delete('ml_user_sessions');
	}

	public function get_url()
	{
		$sql = "SELECT url FROM ml_admin_logo";
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function updateFoto($url)
	{
		$sql = "UPDATE ml_admin_logo SET url = '$url' WHERE id = 1";
		$this->db->query($sql);
	}

}

/* End of file AdminModel.php */



?>