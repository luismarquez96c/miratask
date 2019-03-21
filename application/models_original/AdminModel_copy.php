<?php  

defined('BASEPATH') OR exit('No direct script access allowed');


class AdminModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function get_users()
	{
		$sql = "SELECT session.hora_start, session.hora_pausa,session.hora_pausa_fin, session.hora_fin, user.Name, user.LastName, user.Id FROM ml_user_sessions AS session INNER JOIN ml_us_users AS user ON user.Id = session.id_user";
		$query = $this->db->query($sql);

		return $query->result();
	}

	public function get_info_user($id)
	{
		$sql = "SELECT session.hora_start, session.hora_pausa, session.hora_pausa_fin, session.hora_fin, user.Name, user.LastName, user.Id, session.fecha_register FROM ml_user_sessions AS session INNER JOIN ml_us_users AS user ON user.Id = session.id_user WHERE user.Id = $id";
		$query = $this->db->query($sql);

		return $query->result();	
	}

	public function get_fecha($id,$campo,$fecha_v)
	{

		$sql = "SELECT $campo FROM ml_user_sessions WHERE id_user = '$id' AND fecha_register = '$fecha_v'";

		$query = $this->db->query($sql);

		return $query->row();
	}

	public function set_fecha($campo,$fecha,$id,$vali)
	{
		$data = array($campo=>$fecha);
		$where = array('id_user' => $id, 'fecha_register' => $vali);
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('ml_user_sessions');
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