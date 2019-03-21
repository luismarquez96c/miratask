<?php

class Usuarios_model extends CI_Model {

 public function __construct() {
   $this->load->database();
 }

public function validar_usuarios($correo, $password) {

 $query = "SELECT * FROM ml_users where correo=? and password=?";
 $query = $this->db->query($query,array($correo, $password));
 echo "<pre>";
 print_r ($this->db->last_query());
 echo "</pre>";
 $r=$query->row();
  if (count($r)>0) {
      return $r;
  }
    return false;
    }

}