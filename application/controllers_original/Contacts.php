<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {
	
	function  __construct(){
	 	parent:: __construct();

	 	if($this->session->userdata('Email')==""){ redirect("Login"); }
	  	$this->load->model('SecureModel');
	  	$this->load->model('MatterModel');
		$this->load->model('UserModel');
		$this->load->model('ContactModel');
		
	}

	public function index()
	{

		$this->GetList();
	}
	
	public function  MAxResultXPage($Contxpage){
		
		$this->session->set_userdata("Contxpage",$Contxpage);
		$this->session->set_userdata("ContActualpage","0");
		redirect(base_app()."Contacts");
	}
	
	public function Page($page=0){
		
		if($page==""){ $page='0'; }
		
		$this->session->set_userdata("ContActualpage",$page);
		
		redirect(base_app()."Contacts");
	}

	public function setGroup($group){ 

		if($group!=""){
			if($group=="ALL"){
				//set matter
				$this->session->set_userdata("ContActualGroup","  ");
				$this->session->set_userdata("ContActualpage","0");
				$this->session->set_userdata("ContActualLetter","  ");
				redirect(base_app()."Contacts");
			}else{
				//set matter
				$this->session->set_userdata("ContActualGroup","  AND  EXISTS ( SELECT g.Id FROM ml_co_group_contact AS g WHERE g.IdContact = c.Id AND g.IdGroup='$group'  ) " );


				  
				$this->session->set_userdata("ContActualpage","0");
				$this->session->set_userdata("ContActualLetter","  ");
				redirect(base_app()."Contacts");
			}	
		}

	}
	
	public function ListAlpha($letter){
		
		if($letter!=""){
			if($letter=="ALL"){
				//set matter
				$this->session->set_userdata("ContActualLetter","  ");
				$this->session->set_userdata("ContActualpage","0");
				redirect(base_app()."Contacts");
			}else{
				//set matter
				$this->session->set_userdata("ContActualLetter","  AND ( c.FirstName LIKE '".$letter."%' OR c.FirstName LIKE '".strtolower($letter)."%' ) ");
				$this->session->set_userdata("ContActualpage","0");
				redirect(base_app()."Contacts");
			}	
		}
	}
	
	public function GetList()
	{
		
		$this->session->set_userdata("ContactIDdelete","");
	
		if($this->session->userdata("ContActualpage")==""){
			$this->session->set_userdata("ContActualpage","0");
		}
		
		if($this->session->userdata("Contxpage")==""){
			$this->session->set_userdata("Contxpage","10");
		}
		
		if($this->session->userdata("ContActualLetter")==""){
			$this->session->set_userdata("ContActualLetter","  ");
		}

		if($this->session->userdata("ContActualGroup")==""){
			$this->session->set_userdata("ContActualGroup","  ");
		}


		$actualPage  =$this->session->userdata("ContActualpage");
		$Resulxpage  =$this->session->userdata("Contxpage");
		$ActualLetter=$this->session->userdata("ContActualLetter");
		$ContActGroup=$this->session->userdata("ContActualGroup");  


		$data=$this->SecureModel->globalTask();
		
		$total=$this->ContactModel->getTotal($ActualLetter.$ContActGroup);

		$this->load->library('pagination');

		$config['base_url']   = base_url().'Contacts/page/';
		$config['total_rows'] = $total->total;
		$config['per_page']   = $Resulxpage;
		$config["cur_page"]   = $actualPage;

		$this->pagination->initialize($config);
		
		$endItem=$actualPage+$Resulxpage;
		if($endItem>$total->total){ $endItem=$total->total; }
		
		$data["totalContact"] = $total->total;
		$data["startItem"] = $actualPage;
		$data["endItem"] = $endItem;
		$data['Contacts']=$this->ContactModel->ListAll($actualPage,$Resulxpage,$ActualLetter.$ContActGroup);
		$data['Groups']=$this->ContactModel->GroupList();
		

		$data['links'] = $this->pagination->create_links();
		$data["vista"]="Contacts/List";

		$this->load->view('MainView', $data);
	}
	
	public function eraseListConfirm(){
		
		$fromList=$this->input->post('ItemID');
		
		if (count($fromList)<1)
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Contacts");
		}
		
		$data=$this->SecureModel->globalTask();
		
		$data['linkSi']=base_app()."Contacts/eraseList";
		$data['linkNo']=base_app()."Contacts";
		
		
		
		if (count($fromList)>0)
		{
			foreach ($this->input->post('ItemID') AS $key => $val)
			{
				$dataDelete[]  = $val;
				$result        = $this->ContactModel->getOne($val);
				$ItemNomb[] = $result->FirstName;
			}
		}
		
		/*echo "<pre>";
		print_r($ContactNomb);
		echo "</pre>";
		*/
		
		
		$this->session->set_userdata("ContactIDdelete",$dataDelete);
	 
		$data['nameObject']="Contacts";
		$data["ObjectNomb"]=$ItemNomb;
		$data["vista"]="global/Confirm";

		$this->load->view('MainView', $data);
		
		 
		
	}
	
	public function eraseList(){
		
		$dataDelete=$this->session->userdata("ContactIDdelete");
		
		if(count($dataDelete)>0){
			
				foreach ($dataDelete as $value){ 
					$result=$this->ContactModel->deleteOne($value);
				}
				
		}
		
		$this->session->set_userdata("ContactIDdelete","");
		
		if($result=="success"){
			
			$message="The data has been Remove Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Contacts");
			
		}elseif($result=="error"){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Contacts");
			
		}
		
	}

	public function saveGroup(){

		$GroupName  = $this->input->post('GroupName');
		$status     = "";

		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('GroupName',    'Group Name',      'required|min_length[5]|trim');

		if($this->form_validation->run() == FALSE)
		{
			$status="error";
		}

		if($status=="")
		{
			$data = array(
				'Name'     =>$this->input->post('GroupName'),
				'Status'   =>"1",
				'Creator'  =>$this->session->userdata("Id"),
				'Date'     =>date('Y m d H:i:s')
			);

			$insert_id=$this->ContactModel->SaveNewGroup($data);	


			if($insert_id!=""){
			
				$message="The data has been Save Succeful!";
				$this->session->set_userdata('message', $message);
				redirect(base_app()."Contacts");
			
			}elseif($insert_id==""){
				
				$message="Something Wrong, contact to technical support!";
				$this->session->set_userdata('Wmessage', $message);
				redirect(base_app()."Contacts");
				
			}

		}
		
		
	}
	
	
}		
	
?>