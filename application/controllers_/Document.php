<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document extends CI_Controller {
	function  __construct(){
	 	parent:: __construct();

	 	if($this->session->userdata('Email')==""){ redirect("Login"); }
	  	$this->load->model('SecureModel');
	  	$this->load->model('DocumentModel');
		$this->load->model('UserModel');
		$this->load->model('ContactModel');

	 
	
	}

	public function index()
	{

		$this->GetList();
	}
	
	public function  MAxResultXPage($Documentxpage){
		
		$this->session->set_userdata("Documentxpage",$Documentxpage);
		$this->session->set_userdata("DocumentActualpage","0");
		redirect(base_app()."Document");
	}
	
	public function Page($page=0){
		
		if($page==""){ $page='0'; }
		
		$this->session->set_userdata("DocumentActualpage",$page);
		
		redirect(base_app()."Document");
	}

	public function ChangeCat($cat=""){
		
		if($cat=="")
		{ 

			$cat=''; 

		}else{
		
			$cat=" AND Category = '".$cat."' ";

		
		}
		$this->session->set_userdata("DocumentActualpage","0");
		$this->session->set_userdata("DocumentActualCat",$cat);
		$this->session->set_userdata("DocumentActualFol","");
		redirect(base_app()."Document");

	}

	public function ChangeFolder($fol=""){
		
		if($fol=="")
		{ 

			$fol=''; 

		}else{
		
			$fol=" AND Folder = '".$fol."' ";

		
		}
		$this->session->set_userdata("DocumentActualpage","0");
		$this->session->set_userdata("DocumentActualFol",$fol);
		$this->session->set_userdata("DocumentActualCat","");
		redirect(base_app()."Document");
	}


	
	
	 
	 

	public function GetList()
	{
		
		$this->session->set_userdata("DocumentIDdelete","");
	
		if($this->session->userdata("DocumentActualpage")==""){
			$this->session->set_userdata("DocumentActualpage","0");
		}
		
		if($this->session->userdata("Documentxpage")==""){
			$this->session->set_userdata("Documentxpage","10");
		}

		if($this->session->userdata("DocumentActualCat")==""){
			$this->session->set_userdata("DocumentActualCat","");
		}

		if($this->session->userdata("DocumentActualFol")==""){
			$this->session->set_userdata("DocumentActualFol","");
		}

		 
		

		$actualPage = $this->session->userdata("DocumentActualpage");
		$Documentxpage  = $this->session->userdata("Documentxpage");
		$DocumentActualCat=$this->session->userdata("DocumentActualCat");
		$DocumentActualFol=$this->session->userdata("DocumentActualFol");


		$data=$this->SecureModel->globalTask();
		
		$total=$this->DocumentModel->getTotal($DocumentActualCat.$DocumentActualFol);

		$this->load->library('pagination');

		$config['base_url'] = base_url().'Document/page/';
		$config['total_rows'] = $total->total;
		$config['per_page'] = $this->session->userdata("Documentxpage");
		$config["cur_page"] = $actualPage;

		$this->pagination->initialize($config);
		
		$endItem=$actualPage+$Documentxpage;
		if($endItem>$total->total){ $endItem=$total->total; }

		
		$data["startItem"] = $actualPage;
		$data["endItem"]   = $endItem;
		$data["totalDocument"] = $total->total;
		$data['Document']=$this->DocumentModel->ListAll($actualPage,$Documentxpage,$DocumentActualCat.$DocumentActualFol);
		 

		$data['links'] = $this->pagination->create_links();
		$data["vista"]="Document/List";

		$data['Categories']=$this->DocumentModel->Categories();
		$data['Folders']=$this->DocumentModel->listFromTable("ml_do_folders");



		$this->load->view('MainView', $data);
	}



	 
	
	public function eraseListConfirm(){
		
		$fromList=$this->input->post('ItemID');
		
		if (count($fromList)<1)
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Document");
		}
		
		
		$data=$this->SecureModel->globalTask();
		
		$data['linkSi']=base_app()."Document/eraseList";
		$data['linkNo']=base_app()."Document";
		
		
		
		if (count($fromList)>0)
		{
			foreach ($fromList AS $key => $val)
			{

				$dataDelete[]  = $val;
				$result        = $this->DocumentModel->getOne($val);
				$ItemNomb[] = $result->FileName;
			}
		}

		$this->session->set_userdata("DocumentIDSdelete",$dataDelete);
	 
		$data['nameObject']="Document";
		$data["ObjectNomb"]=$ItemNomb;
		$data["vista"]="global/Confirm";

		$this->load->view('MainView', $data);

	}	


	
	public function eraseList(){
		
		
		
		$dataDelete=$this->session->userdata("DocumentIDSdelete");
		
		if(count($dataDelete)>0){
			
			foreach ($dataDelete as $value){ 

				$result=$this->DocumentModel->deleteOne($value);
			}
		}
		
		$this->session->set_userdata("DocumentIDSdelete","");
		
		if($result=="success"){
			
			$message="The data has been Remove Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Document");
			
		}elseif($result=="error"){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Document");
			
		}
		
	}
	
	


	public function MoveToFolder($idFolder){



		$fromList=$this->input->post('ItemID');
		
		if (count($fromList)<1)
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Document");
		}

		if(count($fromList)>0){
			
			foreach ($fromList as $value){ 

				$result=$this->DocumentModel->MoveTofolder($value, $idFolder);
			}
		}
		
		  
		
		if($result>0){
			
			$message="The data has been Remove Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Document");
			
		}elseif($result<1){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Document");
			
		}



	}
	
	
	 
	

	
	 
	
	

	public function pruebaFecha(){

		$old_date_timestamp = strtotime("11/09/2017 ".date('H:i:s'));
		$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 

		echo $new_date;
	}


	
}