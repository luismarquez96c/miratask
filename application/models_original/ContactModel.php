<?php
class ContactModel extends CI_Model {

 	public function __construct() {
   		$this->load->database();
 	}

 	public function SaveNewContact($data)
 	{

 		$this->db->insert('ml_co_contact',$data);
 		$insert_id = $this->db->insert_id();

 		return $insert_id;
		        
 	}

 	public function SaveNewGroup($data)
 	{

 		$this->db->insert('ml_co_groups',$data);
 		$insert_id = $this->db->insert_id();

 		return $insert_id;
		        
 	}
	
	public function SaveNewAddress($data)
 	{
 		$this->db->insert('ml_co_address',$data);
 		$insert_id = $this->db->insert_id();
 		return $insert_id;
 	}
	
	public function SaveNewPhone($data)
 	{
 		$this->db->insert('ml_co_phone',$data);
 		$insert_id = $this->db->insert_id();
 		return $insert_id;
 	}
	
	public function SaveNewEmail($data)
 	{
 		$this->db->insert('ml_co_email',$data);
 		$insert_id = $this->db->insert_id();
 		return $insert_id;
 	}
	
	public function SaveNewWebsite($data)
 	{
 		$this->db->insert('ml_co_website',$data);
 		$insert_id = $this->db->insert_id();
 		return $insert_id;
 	}
	
	public function SaveRel($data)
 	{

 		$this->db->insert('ml_ma_contact_related',$data);

 		$insert_id = $this->db->insert_id();

 		return $insert_id;
		        

 	}

 	 

 	public function SelectLike($criteria){

 		$stringQuery="SELECT Id, FirstName, LastName FROM ml_co_contact 
 		WHERE 
 		FirstName LIKE '%".$criteria."%' OR 
 		LastName LIKE '%".$criteria."%'  OR 
 		Middle LIKE '%".$criteria."%' OR 
 		Suffix LIKE '%".$criteria."%' ";

 		$query = $this->db->query($stringQuery);

		return $query->result();
		        

 	}


 	public function ContactAndMAtt($criteria){

 		$stringQuery="  SELECT tmp.* FROM (
					
						SELECT
							Id,  
							Name titulo, 
							Date fecha,        
							'matter' Object, 
							MatterID Description  
						FROM ml_ma_matters 
						WHERE Name LIKE '%".$criteria."%' OR 
 							  MatterID LIKE '%".$criteria."%'   
						UNION ALL
						SELECT  
							Id,
							CONCAT(`FirstName` , ' ' , `LastName`) titulo, 
							Date fecha, 
							'contact' Object, 
							Class Description 
						FROM  ml_co_contact 
						WHERE FirstName LIKE '%".$criteria."%' OR 
 							  LastName LIKE '%".$criteria."%'   
						
					) AS tmp
					 ORDER BY 
						CASE
						    WHEN tmp.titulo LIKE '".$criteria."%' THEN 1
						    WHEN tmp.titulo LIKE '%".$criteria."' THEN 3
						    ELSE 2
						END
						LIMIT 100

					";

 		$query = $this->db->query($stringQuery);

		return $query->result();
		        

 	}



	
	public function  StatesOfCountries($country){
		
		$stringQuery="SELECT * FROM ml_co_country_states WHERE Country = '".$country."'  ";

 		$query = $this->db->query($stringQuery);

		return $query->result();
		
	}
	
	public function   CountryList(){
		
		$stringQuery="SELECT * FROM ml_co_country ";

 		$query = $this->db->query($stringQuery);

		return $query->result();
		
	}

	public function   GroupList(){
		
		$stringQuery="SELECT * FROM ml_co_groups ";

 		$query = $this->db->query($stringQuery);

		return $query->result();
		
	}

	public function oneContact($id){
		
		$stringQuery="SELECT * FROM ml_co_contact WHERE Id='".$id."' ";
		
 		$query = $this->db->query($stringQuery);
		return $query->row();
		
		
	}
	
	public function   GroupsOFContacts($contact){
		
		$stringQuery="SELECT (SELECT Name FROM ml_co_groups WHERE Id=g.IdGroup LIMIT 1 ) AS NameGroup FROM ml_co_group_contact g WHERE g.IdContact='".$contact."'   ";
 		$query = $this->db->query($stringQuery);

		return $query->result();
	}
	 

	public function   oneGroup($Group){
		
		$stringQuery="SELECT * FROM ml_co_groups WHERE Id='".$Group."' LIMIT 1 ";
 		$query = $this->db->query($stringQuery);

		return $query->row();
	}
	
	public function   onePhone($contact){
		
		$stringQuery="SELECT Phone FROM ml_co_phone WHERE Contact='".$contact."' LIMIT 1 ";
 		$query = $this->db->query($stringQuery);
		return $query->row();
	}
	
	public function   oneEmail($contact){
		
		$stringQuery="SELECT Email FROM ml_co_email WHERE Contact='".$contact."' LIMIT 1 ";
 		$query = $this->db->query($stringQuery);
		return $query->row();
	}
	
	function getTotal($ActualLetter){
		 
		$query = "SELECT COUNT(c.Id) AS total FROM ml_co_contact c WHERE c.Id>='0' ".$ActualLetter." ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	function ListAll($limit1,$limit2,$where){
		
		$query = "SELECT c.*  FROM ml_co_contact c WHERE c.Id>='0' ".$where." ORDER By Date DESC LIMIT ".$limit1.",".$limit2."  ";
		
		 

		$query = $this->db->query($query);           
		return $query->result();
		
	}	

	 	
	
	public function deleteOne($id){
		
		$this->db->delete("ml_co_contact",array('Id'=>$id));
		
		if (!$this->db->affected_rows()) {
			//for log $result = 'Error! ID ['.$id.'] not found';
			$result="error";
		} else {
			$result = 'success';
		}
		
		return $result;
		
	}
	
	function getOne($id){
		 
		$query = " SELECT FirstName FROM ml_co_contact WHERE Id='".$id."'  ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	function CheckContactInGroup($Contact,$Group){
		
		$query = "SELECT Id FROM ml_co_group_contact WHERE IdContact='".$Contact."' AND IdGroup=  '".$Group."' ";
		$query = $this->db->query($query);
		return $query->row();
		
	}
	
	function AddContactInGroup($Contact,$Group){
		
		$data=array("IdContact"=>$Contact, 
					"IdGroup"=>$Group, 
					"Date"=>date("Y-m-d H:i:s"), 
					"Creator"=>$this->session->userdata("Id")
					);
		
		$this->db->insert('ml_co_group_contact', $data);
		
 		return $this->db->insert_id();
		
	}
	
	function RemContactInGroup($Contact,$Group){
		
		$stringQuery="DELETE FROM ml_co_group_contact WHERE IdContact='".$Contact."' AND  IdGroup='".$Group."' ";
		
 		$this->db->query($stringQuery);
		
		return $this->db->affected_rows();
	
	}
	function RemAllContactInGroup($Contact){
		
		$stringQuery="DELETE FROM ml_co_group_contact WHERE IdContact='".$Contact."' ";
		
 		$this->db->query($stringQuery);
		
		return $this->db->affected_rows();
	
	}

	function GetContactInGroup($Contact,$Group){
		
		$stringQuery="SELECT * FROM ml_co_group_contact WHERE IdContact='".$Contact."' AND  IdGroup='".$Group."' ";

		//echo $stringQuery;
		
 		$query=$this->db->query($stringQuery);
		
		return $query->result();
	
	}

	public function get_table($tabla,$where) {

		//$query = "SELECT * FROM $tabla WHERE Contact='".$IdContact."' ";

		$query = $this->db->get_where($tabla, $where, "", "");

		return $query->result();
		 
	}  

	public function update($data,$where,$table){
		
		$this->db->where($where);
		$this->db->update($table, $data);
		
		return $this->db->affected_rows();
		
	}
	



 	 



 }
 	
 ?>