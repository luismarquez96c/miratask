<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Secure extends CI_Controller {
 
 function  __construct(){
  parent:: __construct();
  
  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->load->model('SecureModel');
  if($this->session->userdata('Email')==""){ redirect("Login"); }

}

public function index() 
{

  $this->load->view('login');

}

public function CheckAcces($ObjectName, $rol)
{

 $query = "SELECT * FROM ml_sis_object_role WHERE Controller='".$email."' AND Role='".$rol."' ";

 $query = $this->db->query($query);

 return $query->row();

}

public function RemoveSession(){

  
  $this->session->unset_userdata('Name');
  $this->session->unset_userdata('LastName');
  $this->session->unset_userdata('Estate');
  $this->session->unset_userdata('Role');
  $this->session->unset_userdata('Email');
  $this->session->unset_userdata('HourlyRate');
  $this->session->unset_userdata('email_unread');
  $this->session->unset_userdata('pass_unread');


  $message="Has been logOut!";
  $this->session->set_userdata('message', $message);

  redirect(base_app()."Login/SendSuccess");

}










}

?>