<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
	function  __construct(){
	 	parent:: __construct();

	 	if($this->session->userdata('Email')==""){ redirect("Login"); }
	  	$this->load->model('SecureModel');
	  	$this->load->model('MatterModel');
		$this->load->model('UserModel');
		 		
	}

	public function index()
	{

		$this->GetList();
	}
	
	public function  MAxResultXPage($Contxpage){
		
		$this->session->set_userdata("Userxpage",$Contxpage);
		$this->session->set_userdata("UserActualpage","0");
		redirect(base_app()."User");
	}
	
	public function Page($page=0){
		
		if($page==""){ $page='0'; }
		
		$this->session->set_userdata("UserActualpage",$page);
		
		redirect(base_app()."User");
	}

	 
	
	 
	
	public function GetList()
	{
		
		$this->session->set_userdata("UserIDdelete","");
	
		if($this->session->userdata("UserActualpage")==""){
			$this->session->set_userdata("UserActualpage","0");
		}
		
		if($this->session->userdata("Userxpage")==""){
			$this->session->set_userdata("Userxpage","10");
		}
		
		$actualPage  =$this->session->userdata("UserActualpage");
		$Resulxpage  =$this->session->userdata("Userxpage");

		$data=$this->SecureModel->globalTask();
		$total=$this->UserModel->getTotal();

		$this->load->library('pagination');

		$config['base_url']   = base_url().'User/page/';
		$config['total_rows'] = $total->total;
		$config['per_page']   = $Resulxpage;
		$config["cur_page"]   = $actualPage;

		$this->pagination->initialize($config);
		
		$endItem=$actualPage+$Resulxpage;
		if($endItem>$total->total){ $endItem=$total->total; }
		
		$data["totalUser"] = $total->total;
		$data["startItem"] = $actualPage;
		$data["endItem"] = $endItem;
		$data['Users']=$this->UserModel->ListAll($actualPage,$Resulxpage);
		 
		
		$data['links'] = $this->pagination->create_links();
		$data["vista"]="User/List";

		$this->load->view('MainView', $data);
	}








	
	public function Changestatus($status,$user){


		if($status=="" or $user==""){
			redirect(base_app()."User");
		}else{

			if($status==1){
				$status=2;
			}elseif($status==2){
				$status=1;
			}

			$this->UserModel->ChangeStatus($status,$user);


			//echo "<br>".$status." / ".$user;

			redirect(base_app()."User");


		}
	
	}



	public function addForm(){

		$data=$this->SecureModel->globalTask();




		$data["vista"]="User/AddUser";

		$this->load->view('MainView', $data);
	}	

	public function SaveNew(){
		
		$status="";
		
		$data=$this->SecureModel->globalTask();
		
		//echo "total de otros contactos ".$this->input->post('othersContacts');
		
		//VALIDATION
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('Name',                'Name',              'required|min_length[3]|trim');
        //$this->form_validation->set_rules('Middle',              'Middle',            'required|min_length[3]|trim');
		$this->form_validation->set_rules('LastName',            'Last Name',         'required|min_length[3]|trim'); 
		
		 
        $this->form_validation->set_rules('Email',               'Email',            'required|trim|is_unique[ml_us_users.Email]');
       

		$this->form_validation->set_rules('Hourly',              'Hourly',           'required|numeric|trim');
		$this->form_validation->set_rules('Role',                'Role',             'required|trim');


		if($this->input->post('Password')!=$this->input->post('Password2')){
			$status="error";

			$message='<span class="red">Password Not the same!</span>';
			$this->session->set_userdata('Wmessage', $message);
		}
		
		
		if($this->form_validation->run() == FALSE)
		{
			$status="error";
		}
		//END VALIDATION
		
		//change date format
		//$old_date_timestamp = strtotime($this->input->post('DateOpened')." ".date('H:i:s'));
		//$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 
		
		//echo "<br> fecha de datos abierto ".$new_date;
		
		//CORE
		if($status==""){
			
			$data = array(
				'Name'              =>$this->input->post('Name'),
				'LastName'          =>$this->input->post('LastName'),
				'Email'             =>$this->input->post('Email'),
				'HourlyRate'        =>$this->input->post('Hourly'),
				'State'				=>'2',
				'Role'              =>$this->input->post('Role'),
				'Passwordd'         =>md5($this->input->post('Password')),
				'Middle'            =>$this->input->post('Middle'),
				'Date'              =>date('Y-m-d H:m:s'),
				'Creator'           =>$this->session->userdata("Id") 
				 
			 );

			$insert_id=$this->UserModel->SaveNew($data);
			
			//echo "Id insertado: ".$insert_id;
			
			if($insert_id!=""){
				
				$message="The data has been Save Succeful!";
				$this->session->set_userdata('message', $message);
				redirect(base_app()."User");
				
			}else{
				$status="error";
			}
		}
		//FIN CORE
		
		
		//DEFINE OUT
		IF($status=="error"){
			
			//$data["Wmessage"]="Something Wrong!, Contact Thenical support";
			file_put_contents('./log_'.date("j.n.Y").'.txt', "Something Wrong When Core try to write data", FILE_APPEND);
			
			$data=$this->SecureModel->globalTask();




			$data["vista"]="User/AddUser";

			$this->load->view('MainView', $data);
		}
		
		 

	}//fin save new()



	public function detail($id){

		$data=$this->SecureModel->globalTask();


		$data['user']=$this->UserModel->GetAttorney($id);

		$data["vista"]="User/updateUser";

		$this->load->view('MainView', $data);
	}	


	public function update($id){

		if($id==""){
			redirect(base_app()."User");
			$message='<span class="red">Not User selected!</span>';
			$this->session->set_userdata('Wmessage', $message);
		
		}

		
		$status="";
		
		$data=$this->SecureModel->globalTask();
		
		//echo "total de otros contactos ".$this->input->post('othersContacts');
		
		//VALIDATION
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('Name',                'Name',              'required|min_length[3]|trim');
        ///$this->form_validation->set_rules('Middle',              'Middle',            'required|min_length[3]|trim');
		$this->form_validation->set_rules('LastName',            'Last Name',         'required|min_length[3]|trim'); 
		
       	if($this->input->post('actEmail')!=$this->input->post('Email')){
        	$this->form_validation->set_rules('Email',               'Email',            'required|trim|is_unique[ml_us_users.Email]');
        }
        
		$this->form_validation->set_rules('Hourly',              'Hourly',           'required|numeric|trim');
		$this->form_validation->set_rules('Role',                'Role',             'required|trim');

		if($this->input->post('Password')!=""){
			if($this->input->post('Password')!=$this->input->post('Password2')){
				$status="error";

				$message='<span class="red">Password Not the same!</span>';
				$this->session->set_userdata('Wmessage', $message);
			}else{
				$Passwordd='ok';
			}
		}
		
		if($this->form_validation->run() == FALSE)
		{
			$status="error";
		}
		//END VALIDATION
		
		//change date format
		//$old_date_timestamp = strtotime($this->input->post('DateOpened')." ".date('H:i:s'));
		//$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 
		
		//echo "<br> fecha de datos abierto ".$new_date;
		
		//CORE
		if($status==""){

				if($Passwordd=='ok'){

					$datau['Passwordd']     =md5($this->input->post('Password'));
				}
			
			
				$datau['Name']              =$this->input->post('Name');
				$datau['LastName']          =$this->input->post('LastName');
				$datau['Email']             =$this->input->post('Email');
				$datau['HourlyRate']        =$this->input->post('Hourly');
				$datau['State']				='2';
				$datau['Role']              =$this->input->post('Role');
				
				$datau['Middle']            =$this->input->post('Middle');
				 
				$datau['Creator']           =$this->session->userdata("Id") ;
				 
			 

			$insert_id=$this->UserModel->update($datau,$id);
			
			//echo "Id insertado: ".$insert_id;
			
			if($insert_id!=""){
				
				$message="<span class='green'>The data has been Save Succeful!</span>";
				$this->session->set_userdata('message', $message);
				redirect(base_app()."User/detail/".$id);
				
			}else{
				$status="error";
			}
		}
		//FIN CORE
		
		
		//DEFINE OUT
		IF($status=="error"){
			
			//$data["Wmessage"]="Something Wrong!, Contact Thenical support";
			file_put_contents('./log_'.date("j.n.Y").'.txt', "Something Wrong When Core try to write data", FILE_APPEND);
			
			$data=$this->SecureModel->globalTask();


			$data['user']=$this->UserModel->GetAttorney($id);

			$data["vista"]="User/updateUser";

			$this->load->view('MainView', $data);
		}
		
		 

	}//fin save new()






}		
	
?>