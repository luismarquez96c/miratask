<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

 function  __construct(){
  parent:: __construct();
  
  $this->load->helper('form');
  $this->load->library('form_validation');
  $this->load->model('UserModel');

  $this->load->library('session');

  if ($this->session->userdata('Email')!=""){ redirect("dashboard"); }

}



public function index() 
{
  if ($this->session->userdata('LastName')!="") 
  {
    redirect("dashboard");
  }

  $data["vista"]="Access/Login";

  $this->load->view("Access/Main",$data);

}



public function validar(){

  $correo=$this->input->post('txt_correo');
  $Password=$this->input->post('txt_password');

  $user=$this->UserModel->validate($correo, md5($Password));


			//print_r($user);

            //echo "usuario actual".$this->session->userdata('Email');

  if (count($user)>0) {

    $this->session->set_userdata('Id', $user->Id);
    $this->session->set_userdata('Name', $user->Name);
    $this->session->set_userdata('LastName', $user->LastName);
    $this->session->set_userdata('Estate', $user->State);
    $this->session->set_userdata('Role', $user->Role);
    $this->session->set_userdata('Email', $user->Email);
    $this->session->set_userdata('HourlyRate', $user->HourlyRate);
    $this->session->set_userdata('smessage', "");
    //$this->session->set_userdata('pass_unread',$user->Pass_E);
    

    redirect("Dashboard");

  }else{

    $data['Wmessage']="User or Incorrect Password!";
    $data['vista']="Access/Login";

    $this->load->view('Access/Main',$data);

  }
}





public function GetCode(){
  $data["vista"]="Access/GetCode";

  $this->load->view("Access/Main",$data);
}

public function SendLinkCode(){

  $email=$this->input->post('Email');

        //echo "Email:".$email;

  if($email!=""){

            //validacion de email

            //select user
    $emailFromDB=$this->UserModel->oneByEmail($email);
    if(isset($emailFromDB->Email)){ $emailFromDB=$emailFromDB->Email; }

            //print_r($emailFromDB);

            //if get email fron db
    if($emailFromDB!=""){

                //echo "email db:".$emailFromDB->Email;

                //make link whit key

      $code= md5(date('Y/z-H:i:s-u').$emailFromDB);

      $code= substr(base64_encode($code),0,40);

      $link = base_app()."Login/PasswordUpdater/".$code;

                //insert linkcode
      if($this->UserModel->updatePassCode($code,$emailFromDB)){


        $this->load->helper("SendMail");

        $content="You Has been Requested Change your Password, please click or paste link on your navigation bar: ".$link;

        SendMail($emailFromDB,$content,"Change Pasword Link");


        $message="We send link to your email for change password, for next step go at your email account ";
        $this->session->set_userdata('message', $message);

        redirect(base_app()."Login/SendSuccess");



      }else{

        $data["Wmessage"]="Error: Something has wromn , try again or contact with technical support!";
        $data["vista"]="Access/GetCode";

        $this->load->view('Access/Main', $data);
      }


    }else{

      $data["Wmessage"]="Error:Email does not registered in our system!";

      $data["vista"]="Access/GetCode";
      $this->load->view('Access/Main', $data);
    }
  }




}

public function PasswordUpdater($code){

        //echo "Codigo Recibido: ".$code;

        ////select from user
  $r=$this->UserModel->getCode($code);

        //echo "<br> total resultados db: ".count($r);

  if (count($r)>0) {
              //return TRUE;
    $data['code']=$code;  
    $data["vista"]="Access/ChangePasword";
    $this->load->view('Access/Main', $data);

              //se borrara el codigo de la db hasta que la nueva password sea guardada

  }else{

    $message="The code entered is incorrect, please Check careful your email code, or try type your mail for recive a new code";
    $this->session->set_userdata('message', $message);

    redirect(base_app()."Login/SendError");
  }



}

public function SavePassword($code){

  $r=$this->UserModel->getCode($code);
  $state="";
        //echo "<br> total resultados db: ".count($r);

  if (count($r)>0) {

    $pass1=$this->input->post('Password');
    $pass2=$this->input->post('Password2');

            //echo "password 1 ".$pass1;
            //echo "password 2 ".$pass2;

    if(($pass1==$pass2) and ($pass1!="" and $pass2!="") ){

      if($this->UserModel->updatePassword($code, $pass1)){

        $message='We change your password, try make <a href="'.base_app().'Login">Login here</a> ';
        $this->session->set_userdata('message', $message);

        redirect(base_app()."Login/SendSuccess");

                    //echo "Success";

      }else{
        $state="Error:Something Wrong, please contact thecnical support.";
      }
    }else{
      $state="Error:The password are not the same.";
    }

    $data['code']=$code;
    $data['Wmessage']=$state;  
    $data["vista"]="Access/ChangePasword";
    $this->load->view('Access/Main', $data);



  }else{

    $message='The code entered is incorrect, please Check careful your email code, or try type your mail for recive a <a href="'.base_app().'Login/GetCode">New code</a>';
    $this->session->set_userdata('message', $message);

    redirect(base_app()."Login/SendError");
  }






}

public function SendSuccess(){

 $data["vista"]="Access/Success";
 $data["message"]=$this->session->userdata('message');

 $this->load->view('Access/Main', $data);

}

public function SendError(){

 $data["vista"]="Access/Error";
 $data["message"]=$this->session->userdata('message');

 $this->load->view('Access/Main', $data);

}






}