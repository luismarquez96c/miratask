<?php
class TaskModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function GetList($role)
	{

		$queryString = "SELECT * ";              

		$query = $this->db->query($queryString);

 		//print_r($query->result());

		return $query->result();
		

	}
	
	function getTotal($ActualLetter){
		
		$query = "SELECT COUNT(a.Id) AS total FROM ml_ta_task a WHERE a.Status!='' ".$ActualLetter." ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	function getOne($id){
		
		$query = "SELECT *   FROM ml_ta_task WHERE Id ='".$id."' ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	function getLast5($filtro="", $limit="  "){
		
		$query = " SELECT *  FROM ml_ta_task WHERE Id!='' AND Status!='3'  ".$filtro."  ORDER BY Priority ASC ".$limit." ";

		//echo $query;

		$query = $this->db->query($query);           
		return $query->result();
	}

	function getLastMetting($filtro="", $limit="LIMIT 5"){
		
		$query = " SELECT *  FROM ml_cal_events WHERE Status!='-1' ".$filtro."  ORDER BY start_time ASC ".$limit." ";

		//echo $query;

		$query = $this->db->query($query);
		return $query->result();
	}
	
	function ListAll($limit1,$limit2,$where){
		
		$query = "SELECT  a.*   FROM ml_ta_task a WHERE a.Status!='' ".$where."  ORDER BY a.Date DESC LIMIT ".$limit1.",".$limit2."  ";
		
		$query = $this->db->query($query);           
		return $query->result();
		
		
		
	}	

	public function SaveNew($data)
	{

		$this->db->insert('ml_ta_task',$data);

		$insert_id = $this->db->insert_id();

		return $insert_id;
		

	}


	public function listFromTable($table)
	{

		$query = $this->db->get($table);             
		return $query->result();
		
	}
	
	
	
	public function deleteOne($Id){
		
		

		$this->db->where('Id', $Id);
		$this->db->update("ml_ta_task", array('Status'=>''));

		if (!$this->db->affected_rows()) {
			//for log $result = 'Error! ID ['.$id.'] not found';
			$result="error";
		} else {
			$result = 'success';
		}
		
		return $result;
		
	}
	
	public function  MarkCompleted($Id){
		
		$this->db->where('Id', $Id);
		$this->db->update("ml_ta_task", array('Status'=>'3'));

		if (!$this->db->affected_rows()) {
			$result="error";
		} else {
			$result = 'success';
		}
		
		return $result;
	}	
	
	//save atach
	public function InsertAtach($data)
	{
		
		
		$this->db->insert('ml_ta_atach',$data);
		
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}

	//SaveNewTask
	public function SaveNewTask($data)
	{
		
		
		$this->db->insert('ml_ta_task',$data);
		
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}


	
	public function deleteStaff($IdTask,$IdUser){

		$stringQuery="DELETE FROM ml_ta_staff WHERE IdTask='".$IdTask."' AND  IdUser='".$IdUser."' ";
		$this->db->query($stringQuery);
		
		//$this->db->affected_rows()
		

	}
	
	public function relatedStaff($IdTask){
		
		$stringQuery="SELECT mf.*, (SELECT CONCAT(Name,' ',LastName) FROM ml_us_users WHERE Id=mf.IdUser) AS AtorneyName FROM ml_ta_staff mf WHERE mf.IdTask='".$IdTask."' ";
		
		
		
		$query = $this->db->query($stringQuery);
		return $query->result();
		
	}
	
	
	
	public function   oneStatus($id){
		
		$stringQuery="SELECT State FROM ml_sis_states WHERE Id='".$id."' ";
		$query = $this->db->query($stringQuery);
		return $query->row();
	}

	public function selectOne($Id){
		$stringQuery="SELECT * FROM ml_ta_task WHERE Id='".$Id."' ";
		$query = $this->db->query($stringQuery);
		return $query->row();
	}
	
	public function Update($data,$Id){
		
		$this->db->where('Id', $Id);
		$this->db->update("ml_ta_task", $data);

		//$this->db->lastquery;
		
		return $this->db->affected_rows();
		
	}
	
	
	
	public function getAttorney($getAttorney){
		
		$stringQuery="SELECT Id,  Name, LastName FROM ml_us_users WHERE Id='".$getAttorney."' ";
		$query = $this->db->query($stringQuery);

		return  $query->row();
	}
	
	public function getOneRelatedStaff($array){
		
		$this->db->where($array);
		$this->db->select('*');
		$this->db->from('ml_ta_staff');
		$query = $this->db->get();

		return  $query->row();
	}



	public function Priority($Id){

		$stringQuery="SELECT Name FROM ml_ta_priority WHERE Id='".$Id."' ";
		$query = $this->db->query($stringQuery);

		return  $query->row();
	}

	public function Status($Id){

		$stringQuery="SELECT Status FROM ml_ta_status WHERE Id='".$Id."' ";
		$query = $this->db->query($stringQuery);

		return  $query->row();
	}


	public function Category($Id){

		$stringQuery="SELECT * FROM ml_ta_category WHERE Id='".$Id."' ";
		$query = $this->db->query($stringQuery);

		return  $query->row();
	}




	function CheckCoMa($tipo,$idTask, $idObjeto){

		$stringQuery="SELECT Id FROM ml_ta_atach WHERE TypeObject='".$idObjeto."' AND Task='".$idTask."'  AND IdObject='".$idObjeto."' ";
		$query = $this->db->query($stringQuery);

		return  $query->row();


	}

	function getMattCont($idTask){

		$stringQuery="SELECT 
		at.*
		
		FROM 
		ml_ta_atach at 
		WHERE  
		at.Task='".$idTask."'    ";


		$query = $this->db->query($stringQuery);

		return  $query->result();


	}

	function contactRelated($id){
		$stringQuery="SELECT CONCAT (FirstName, LastName) as Name FROM ml_co_contact WHERE Id='".$id."'  ";
		$query = $this->db->query($stringQuery);

		return  $query->row();
	}

	function deleteAtach($id,$tipo,$task){

		$stringQuery=" DELETE FROM ml_ta_atach WHERE IdObject='".$id."' AND TypeObject='".$tipo."' AND Task='".$task."' ";

		$this->db->query($stringQuery);

		return $this->db->affected_rows();


	}

	function deleteTask($task){

		$stringQuery=" DELETE FROM ml_ta_task WHERE Id='".$task."'  ";

		$this->db->query($stringQuery);

		return $this->db->affected_rows();


	}

	




	
	
	
	
	
	
	
	
	
	
	
	
	



}

?>