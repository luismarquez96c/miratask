<?php
class SecureModel extends CI_Model {

 	public function __construct() {
   		$this->load->database();
 	}

 	public function GetMenu($role){

 		$queryString = "SELECT Menu,
 						(SELECT Class FROM ml_sis_objects WHERE Id=o.Menu ) AS Class,
 						(SELECT cssId FROM ml_sis_objects WHERE Id=o.Menu ) AS cssId,
                       (SELECT Text FROM ml_sis_objects WHERE Id=o.Menu ) AS Text,
                       (SELECT Link FROM ml_sis_objects WHERE Id=o.Menu ) AS Link
                        FROM ml_sis_object_role AS o WHERE Role='".$role."'   ";

 		$query = $this->db->query($queryString);

 		 

		return $query->result();

 	}

 	public function globalTask()
	{

		$dataMenu=$this->GetMenu($this->session->userdata("Role"));

		//echo "role: ".$this->session->userdata("Role");

		//echo "<pre>";
		//print_r($dataMenu);
		//echo "</pre>";

		$data["vista"]="dashboard";
		$data["MainMenu"]=$dataMenu;


		//$data["dataMenu"]=$dataMenu;

		return $data;

	}

	public function delete($tabla,$where){

		$this->db->delete($tabla, $where);

		return $this->db->affected_rows();
	}

	public function update($data,$where,$table){
		
		$this->db->where($where);
		$this->db->update($table, $data);
		
		return $this->db->affected_rows();
		
	}

	function getOne($tabla,$where){
		 
		$query = "SELECT *  FROM $tabla WHERE  id>0  $where ";
		$query = $this->db->query($query);
		return $query->row();
	}

	function get($tabla,$where){
		 
		$query = "SELECT *  FROM $tabla WHERE  Id>0  $where ";
		$query = $this->db->query($query);
		return $query->row();
	}
	function getTabla($tabla,$where){
		 
		$query = "SELECT *  FROM $tabla WHERE  Id>0  $where ";
		$query = $this->db->query($query);
		return $query->result();
	}

	public function SaveNew($tabla, $data)
 	{

 		$this->db->insert($tabla,$data);

 		$insert_id = $this->db->insert_id();

 		return $insert_id;
		        

 	}



 }
 	
 ?>