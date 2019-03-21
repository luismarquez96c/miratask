<?php  
class CheckinModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function status($id_user,$fecha)
	{
		$this->db->select('estado');
		$this->db->from('ml_user_sessions');

		$array = array('id_user' => $id_user,'fecha_register'=>$fecha);
		$this->db->where($array);

		$query = $this->db->get();

		return $query->row();
	}

	public function validate($id_user)
	{
		$sql = "SELECT * FROM ml_user_sessions WHERE id_user = '".$id_user."'";
		$query = $this->db->query($sql);

		$user=$query->row();

		if (count($user)>0) {
			return '1';
		}
		else{
			return '0';
		}
	}

	public function insert_user($id_user)
	{
		$data = array('id_user'=>$id_user,'fecha_register'=>date('Y-m-d'));
		$this->db->insert('ml_user_sessions', $data); 
	}

	public function update_inicio($inicio,$id_user)
	{
		$data = array('hora_start'=>$inicio,'estado'=>1);
		$this->db->set($data);
		$this->db->where('id_user', $id_user);
		$this->db->where('fecha_register',date('Y-m-d'));
		$this->db->update('ml_user_sessions');
	}

	public function get_hora($user,$campo)
	{
		$vali = date('Y-m-d');
		$sql = "SELECT ".$campo." FROM ml_user_sessions WHERE id_user = '".$user."' AND fecha_register ='".$vali."'";
		$query = $this->db->query($sql);

		return $query->row();
	}

	public function update_pause($hora,$id_user)
	{
		$data = array('hora_pausa'=>$hora,'estado'=>2);
		$this->db->set($data);
		$this->db->where('id_user', $id_user);
		$this->db->where('fecha_register', date('Y-m-d'));
		$this->db->update('ml_user_sessions');
	}

	public function update_resume($hora,$id_user)
	{
		$data = array('hora_pausa_fin'=>$hora,'estado'=>3);
		$this->db->set($data);
		$this->db->where('id_user',$id_user);
		$this->db->where('fecha_register', date('Y-m-d'));
		$this->db->update('ml_user_sessions');
	}

	public function update_ceckout($hora,$id_user)
	{
		$data = array('hora_fin'=>$hora,'estado'=>4);
		$this->db->set($data);
		$this->db->where('id_user',$id_user);
		$this->db->where('fecha_register',date('Y-m-d'));
		$this->db->update('ml_user_sessions');
	}
}


?>