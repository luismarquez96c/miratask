<?php
class DocumentModel extends CI_Model {

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
		 
		$query = "SELECT COUNT(Id) AS total FROM ml_do_documents WHERE Status!='2' ".$ActualLetter." ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	function getOne($id){
		 
		$query = "SELECT *  FROM ml_do_documents WHERE Id ='".$id."' ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	function getLast5($filtro="", $limit=" LIMIT 5 "){
		
		$query = " SELECT *  FROM ml_do_documents WHERE Id!=''  ".$filtro."  ORDER BY Date DESC ".$limit." ";
		$query = $this->db->query($query);           
		return $query->result();
	}

	
	function ListAll($limit1,$limit2,$where){
		
		$query = "SELECT  *   FROM ml_do_documents WHERE Status!='2' ".$where."  ORDER BY Date DESC LIMIT ".$limit1.",".$limit2."  ";
		
		$query = $this->db->query($query);  
		         
		return $query->result();
		
		
		
	}	

 	public function SaveNew($tabla,$data)
 	{

 		$this->db->insert($tabla,$data);

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
		$this->db->update("ml_do_documents", array('Status'=>'2'));

		if (!$this->db->affected_rows()) {
			//for log $result = 'Error! ID ['.$id.'] not found';
			$result="error";
		} else {
			$result = 'success';
		}
		
		return $result;
		
	}
	
	 
	
	//save atach
	public function InsertAtach($data)
 	{
		
		
		$this->db->insert('ml_do_atach',$data);
		
		
 		$insert_id = $this->db->insert_id();
		
 		return $insert_id;
	}

	 

	
	 
	
	 
	
 
	
	public function   oneStatus($id){
		
		$stringQuery="SELECT State FROM ml_sis_states WHERE Id='".$id."' ";
 		$query = $this->db->query($stringQuery);
		return $query->row();
	}

	public function selectOne($Id){
		$stringQuery="SELECT * FROM ml_do_documents WHERE Id='".$Id."' ";
 		$query = $this->db->query($stringQuery);
		return $query->row();
	}

	public function getOneWhere($Id,$tabla){
		$stringQuery="SELECT * FROM ".$tabla." WHERE Id='".$Id."' ";

		//echo $stringQuery;

 		$query = $this->db->query($stringQuery);
		return $query->row();
	}
	
	
	public function MoveTofolder($Id, $folder){
		
		$this->db->where('Id', $Id);
		$this->db->update("ml_do_documents", array('Folder'=>$folder));
		
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

		$stringQuery="SELECT Status FROM ml_do_status WHERE Id='".$Id."' ";
 		$query = $this->db->query($stringQuery);

		return  $query->row();
	}


	public function Category($Id){

		$stringQuery="SELECT Name FROM ml_do_category WHERE Id='".$Id."' ";
 		$query = $this->db->query($stringQuery);

		return  $query->row();
	}

	public function Categories(){

		$stringQuery=" SELECT dc.Id, dc.Name, (SELECT COUNT(Id)  FROM ml_do_documents WHERE Category=dc.Id) AS TotalDocs FROM ml_do_category dc  ";
 		$query = $this->db->query($stringQuery);

		return  $query->result();
	}


	function CheckContact($idDocument, $idContact){

		$stringQuery="SELECT Id FROM ml_do_contatc WHERE Contact='".$idContact."' AND Document='".$idDocument."'    ";
 		$query = $this->db->query($stringQuery);

		return  $query->row();


	}

	function CheckCoMa($tipo,$idDoc, $idObjeto){

		$stringQuery="SELECT Id FROM ml_do_atach WHERE TypeObject='".$tipo."' AND Document='".$idDoc."'  AND IdObject='".$idObjeto."' ";
 		$query = $this->db->query($stringQuery);

		return  $query->result();


	}
 	
 	function getCoMa($idDoc ){

		$stringQuery="SELECT * FROM ml_do_atach WHERE     Document='".$idDoc."'    ";

		//echo $stringQuery;


 		$query = $this->db->query($stringQuery);

		return  $query->result();


	}
	 

	public function update($data,$where,$table){
		
		$this->db->where($where);
		$this->db->update($table, $data);
		
		return $this->db->affected_rows();
		
	}

	function deleteAtach($id,$tipo,$doc){

		$stringQuery=" DELETE FROM ml_do_atach WHERE IdObject='".$id."' AND TypeObject='".$tipo."' AND Document='".$doc."' ";

		$this->db->query($stringQuery);

		return $this->db->affected_rows();


	}

	public function SelectLike($criteria){

 		$stringQuery="SELECT * FROM ml_do_documents 
 		WHERE 
 		FileName LIKE '%".$criteria."%' OR 
 		Description LIKE '%".$criteria."%'   ";

 		$query = $this->db->query($stringQuery);

		return $query->result();
		        

 	}
	 
    public function SelectByName($Name){

 		$stringQuery="SELECT * FROM ml_do_documents 
 		WHERE 
 		FileName = '".$criteria."'  ";

 		$query = $this->db->query($stringQuery);

		return $query->result();
		        

 	}
	 
 }
 	
 ?>