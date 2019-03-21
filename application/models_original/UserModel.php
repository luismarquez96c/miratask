<?php

class UserModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function validate($email, $password) {

		$queryString = "SELECT * FROM ml_us_users WHERE Email='".$email."' and Passwordd='".$password."' AND State='1' ";
		$query = $this->db->query($queryString);

		$user=$query->row();

		
		if (count($user)>0) {

			return $user;

		}else{

			return false;
		}

	}    

	public function oneByEmail($email) {

		$query = "SELECT * FROM ml_us_users WHERE Email='".$email."' ";

		$query = $this->db->query($query);

		return $query->row();
		
	}   

	public function updatePassCode($code, $email){

		$query = "UPDATE  ml_us_users SET Code='".$code."' WHERE email='".$email."'  ";

		//echo $query;

		//$query = $this->db->query($query);

		if ($this->db->query($query)){

			return true;

		}else{

			return false;
		}

		


	}

	public function updatePassword($code, $password){

		$query = "UPDATE  ml_us_users SET Passwordd='".md5($password)."', Code='' WHERE Code='".$code."'  ";

		if ($this->db->query($query)){

			return true;

		}else{

			return false;
		}

	}

	public function GetCode($code) {

		$query = "SELECT Code FROM ml_us_users WHERE Code='".$code."' ";

		$query = $this->db->query($query);

		return $query->row();
		
	}  

	public function GetAttorney($Id) {

		$query = "SELECT * FROM ml_us_users WHERE Id='".$Id."' ";

		$query = $this->db->query($query);

		return $query->row();
		
	}  

	public function GetLikeAttorney($criteria){

		$stringQuery="SELECT Id,  Name, LastName FROM ml_us_users 
		WHERE 
		(Name LIKE '%".$criteria."%' OR 
		LastName LIKE '%".$criteria."%' ) AND role='2' ";

		$query = $this->db->query($stringQuery);

		return $query->result();
		

	}
	public function allLikeAttorney($criteria){

		$stringQuery="SELECT Id,  Name, LastName FROM ml_us_users 
		WHERE 
		(Name LIKE '%".$criteria."%' OR 
		LastName LIKE '%".$criteria."%' ) AND  State!='2' AND State!='-1' ";

		$query = $this->db->query($stringQuery);

		return $query->result();
		

	}

	public function GetLikeAdmiAttorney($criteria){

		$stringQuery="SELECT * FROM ml_us_users 
		WHERE 
		(Name LIKE '%".$criteria."%' OR 
		LastName LIKE '%".$criteria."%' ) AND Role in ('1','2','3') and state = 1 ";

		$query = $this->db->query($stringQuery);

		return $query->result();
		

	}
	
	public function Attorney()
	{

		$stringQuery="SELECT Id,  Name, LastName FROM ml_us_users WHERE Role in ('1', '2', '3') and state = 1  ORDER BY Role DESC ";

		$query = $this->db->query($stringQuery);

		return $query->result();
		
	}

	public function activeAttorney()
	{
		$stringQuery="SELECT * FROM ml_us_users WHERE State='1' ORDER BY Role DESC ";

		$query = $this->db->query($stringQuery);

		return $query->result();
		
	}


	
	
	
	public function GetListFrom($tabla,$where="")
	{

		$stringQuery="SELECT * FROM ".$tabla."  ".$where."   ";

		$query = $this->db->query($stringQuery);

		return $query->result();
		
	}




	function getTotal(){
		
		$query = "SELECT COUNT(Id) AS total FROM ml_us_users WHERE State!=''  ";
		$query = $this->db->query($query);
		return $query->row();
	}

	function ListAll($limit1,$limit2){
		
		$query = "SELECT *  FROM ml_us_users WHERE State!=''   LIMIT ".$limit1.",".$limit2." ";
		
		$query = $this->db->query($query);           
		return $query->result();
		
	}	


	public function GetRole($Role) {

		$query = "SELECT Role FROM ml_us_role WHERE Id='".$Role."' ";

		$query = $this->db->query($query);

		return $query->row();
		
	}  
	public function GetState($State) {

		$query = "SELECT State FROM ml_sis_states WHERE Id='".$State."' ";

		$query = $this->db->query($query);

		return $query->row();
		
	}  

	
	
	public function ChangeStatus($status,$idUser){

		$query = "UPDATE  ml_us_users SET State='".$status."' WHERE Id='".$idUser."'  ";

		//echo $query;

		if ($this->db->query($query)){

			return true;

		}else{

			return false;
		}

	}


	public function SaveNew($data)
	{

		$this->db->insert('ml_us_users',$data);

		$insert_id = $this->db->insert_id();

		return $insert_id;
		

	}

	public function update($data,$Id){
		
		$this->db->where('Id', $Id);
		$this->db->update("ml_us_users", $data);
		
		return $this->db->affected_rows();
		
	}

	public function getEmail($id)
	{
		$sql = "SELECT Email FROM ml_us_users WHERE Id=".$id;

		$query = $this->db->query($sql);

		return $query->row();
	}



}
