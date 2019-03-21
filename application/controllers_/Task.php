<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Controller {
	function  __construct(){
	 	parent:: __construct();

	 	if($this->session->userdata('Email')==""){ redirect("Login"); }
	  	$this->load->model('SecureModel');
	  	$this->load->model('TaskModel');
		$this->load->model('UserModel');
		$this->load->model('ContactModel');

	 
	
	}

	public function index()
	{

		$this->GetList();
	}
	
	public function  MAxResultXPage($Taskxpage){
		
		$this->session->set_userdata("Taskxpage",$Taskxpage);
		$this->session->set_userdata("TaskActualpage","0");
		redirect(base_app()."Task");
	}
	
	public function Page($page=0){
		
		if($page==""){ $page='0'; }
		
		$this->session->set_userdata("TaskActualpage",$page);
		
		redirect(base_app()."Task");
	}
	
	
	public function viewCompleted(){
		
		if($this->session->userdata("showCompleted")=="si")
		{
			 $this->session->set_userdata("showCompleted","no");
			 $this->session->set_userdata("showComplQuery", "");
			 
			 
			 
		}elseif($this->session->userdata("showCompleted")=="no"){ 
			
			 $this->session->set_userdata("showCompleted","si");
			 $this->session->set_userdata("showComplQuery", " AND Status='3' ");
			 
			 
			 
		}else{
			 $this->session->set_userdata("showCompleted","no");
			 $this->session->set_userdata("showComplQuery", "");
		}	
		
		redirect(base_app()."Task");
		
    }
	
	public function ChangeCat($Cat){
		
		//set session
		if($Cat!=""){
			if($Cat=="ALL"){
				$this->session->set_userdata("TaskActualArea","  ");
				$this->session->set_userdata("TaskActualpage","0");
				$this->session->set_userdata("showComplQuery","  ");
				redirect(base_app()."Task");
			}else{
				$this->session->set_userdata("TaskActualArea"," AND Category='".$Cat."' ");
				$this->session->set_userdata("showComplQuery","  ");
				$this->session->set_userdata("TaskActualpage","0");
				
			}
		}
		
	}

	public function GetList()
	{
		
		$this->session->set_userdata("TaskIDdelete","");
	
		if($this->session->userdata("TaskActualpage")==""){
			$this->session->set_userdata("TaskActualpage","0");
		}
		
		if($this->session->userdata("Taskxpage")==""){
			$this->session->set_userdata("Taskxpage","10");
		}
		
		if($this->session->userdata("showComplQuery")==""){
			$this->session->set_userdata("showComplQuery","  ");
		}
		
		if($this->session->userdata("TaskActualArea")==""){
			$this->session->set_userdata("TaskActualArea"," ");
		}

		$actualPage = $this->session->userdata("TaskActualpage");
		$Taskxpage  = $this->session->userdata("Taskxpage");
		$showComplQuery=$this->session->userdata("showComplQuery");
		$ActualArea = $this->session->userdata("TaskActualArea");

		$data=$this->SecureModel->globalTask();
		
		$total=$this->TaskModel->getTotal($showComplQuery);

		$this->load->library('pagination');

		$config['base_url'] = base_url().'Task/page/';
		$config['total_rows'] = $total->total;
		$config['per_page'] = $this->session->userdata("Taskxpage");
		$config["cur_page"] = $actualPage;

		$this->pagination->initialize($config);
		
		$endItem=$actualPage+$Taskxpage;
		if($endItem>$total->total){ $endItem=$total->total; }
		
		$data["startItem"] = $actualPage;
		$data["endItem"] = $endItem;
		$data["totalTask"] = $total->total;
		$data['Task']=$this->TaskModel->ListAll($actualPage,$Taskxpage,$showComplQuery);
		 

		$data['links'] = $this->pagination->create_links();
		$data["vista"]="Task/List";

		$this->load->view('MainView', $data);
	}

	public function CreateNew(){

		$data=$this->SecureModel->globalTask();
		
		$data['totOthersCont']="1";
		
		$data["Areas"]=$this->TaskModel->listFromTable("ml_ma_area");
		$data["Templates"]=$this->TaskModel->listFromTable("ml_ma_template");
		$data["Notifications"]=$this->TaskModel->listFromTable("ml_ma_notification_lapse");
		$data["Attorney"]=$this->UserModel->Attorney(); 
		$data['Countries']=$this->UserModel->GetListFrom("ml_co_country");

		$data["vista"]="Matters/newmatter";

		$this->load->view('MainView', $data);

	}
	
	public function SaveNew(){
		
		$status="";
		
		$data=$this->SecureModel->globalTask();
		
		$otherContTot=$this->input->post('totCont');
		
		//if var it is empty , redirect to Create New
		if($otherContTot==""){ redirect(base_app()."Matters/CreateNew"); }
		
		//echo "total de otros contactos ".$this->input->post('othersContacts');
		
		//VALIDATION
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('Name',                'Name Matter',                'required|min_length[3]|trim');
        $this->form_validation->set_rules('Description',         'Description',         'required|min_length[3]|trim');
		$this->form_validation->set_rules('MatterID',            'Matter ID',            'required|min_length[3]|trim'); 
		
        $this->form_validation->set_rules('ContactID_A',         'Client name',         'required|numeric|trim');
		$this->form_validation->set_rules('Contact_A',           'Client Name',           'required|min_length[3]|trim');
		
        $this->form_validation->set_rules('Area',                'Practice Area',       'required|min_length[1]|numeric|trim');
        $this->form_validation->set_rules('DateOpened',          'Date Opened',          'required|min_length[3]|trim'); 
		$this->form_validation->set_rules('Template',            'Template',            'required|numeric|trim'); 
		
		$this->form_validation->set_rules('ContactID_R',         'Contact referred',   		'required|numeric|trim'); 
		$this->form_validation->set_rules('Contact_R',           'Contact Referred',   		'required|trim'); 

		$this->form_validation->set_rules('ResponsibleAttorney', 'Responsible Attorney', 'required|numeric|trim'); 
		
		
		//$this->form_validation->set_rules('OtherStaff',          'Other Staff',          'required|trim'); 
		
		$this->form_validation->set_rules('OriginatingAttorney', 'Originating Attorney', 'required|numeric|trim'); 
		$this->form_validation->set_rules('Notifications',       'Notifications',       'required|numeric|trim'); 
		
		//$status=$this->form_validation->run();
		
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
				'Description'       =>$this->input->post('Description'),
				'Client'            =>$this->input->post('ContactID_A'),
				'Area'              =>$this->input->post('Area'),
				'DateOpen'          =>encodedate($this->input->post('DateOpened')." ".date('H:i:s')),
				'ReferedBy'         =>$this->input->post('ContactID_R'),
				'Template'          =>$this->input->post('Template'),
				'ResponsibleAttoney'=>$this->input->post('ResponsibleAttorney'),
				'OtherStaf'         =>$this->input->post('OtherStaff'),
				'Originating'       =>$this->input->post('OriginatingAttorney'),
				'Notification'      =>$this->input->post('Notifications'),
				'MatterID'          =>$this->input->post('MatterID'),
				'Status'            =>'1',
				'Date'              =>date('Y-m-d H:i:s'),
				'UserCreator'       =>$this->session->userdata("Id")
			 );

			$insert_id=$this->TaskModel->SaveNew($data);
			
			//echo "Id insertado: ".$insert_id;
			
			if($insert_id!=""){
				
				//CHEK IF OTHERS CONTACTS ADDED AND INSERT IN DB
				
					
				for($i=1; $i<=$otherContTot;$i++)
				{
				
					$idCont=$this->input->post('ContactID'.$i);
					$ContNam=$this->input->post('Contact'.$i);
					$Relation=$this->input->post('Relation'.$i);
					
					if($idCont!="")
					{
						if($ContNam!="")
						{
						
						//echo "<br>Ultimo id ".$insert_id;
							
							$data=array('IdContact'=>$idCont,
										'IdMatter'=>$insert_id,
										'Relation'=>$Relation
							);
							
							$lastSaveRel=$this->ContactModel->SaveRel($data);
							
							//echo "<br> lasat save rel ".$lastSaveRel;
							
							
						}
					}
				}

				//save de billling data


				$dataBill = array(
					'MatterId'           =>$insert_id,
					'BillingId'          =>'1',
					'TotalAmount'        =>$this->input->post('TotalAmount'),
					'Free'               =>$this->input->post('Free'),
					'Kind'               =>'1',
					'kindEntrie'         =>'1',
					'StartDate'          =>$this->input->post('StartDate'),
					'EndDate'            =>$this->input->post('EndDate'),
					'Hours'              =>'2',
					'Rate'               =>'2',
					'Creator'            =>$this->session->userdata("Id"),
					'Date'               =>date('Y-m-d H:i:s'),
					'Period'             =>$this->input->post('Period'),
					'PerDay'             =>$this->input->post('PerDay')
				 );

				$insert_idBill=$this->TaskModel->SaveBillActv($dataBill);
				
				
				
				//insert other staff list
				
				$fromList=$this->input->post('otherStaf');
				
				//print_r($fromList);
				
				if (count($fromList)>0)
				{
					foreach ($fromList AS $key => $val)
					{
						$data=array(
								'IdUser'=>$val,
								'IdMatter'=>$insert_id,
								'Creator'=>$this->session->userdata("Id"),
								'Date'=>date('Y-m-d H:i:s')
							 );
							
						$total=$this->TaskModel->getOneRelatedStaff(array('IdUser'=>$val,'IdMatter'=>$insert_id));	

						if(count($total)<1){

							
							$result = $this->TaskModel->saveStafRelated($data);
						}
						
					}
				}
				


					
				 
				$message="The data has been Save Succeful!";
				$this->session->set_userdata('message', $message);
				redirect(base_app()."Matters");
				
			}else{
				$status="error";
			}
		}
		//FIN CORE
		
		
		//DEFINE OUT
		IF($status=="error"){
			
			//$data["Wmessage"]="Something Wrong!, Contact Thenical support";
			file_put_contents('./log_'.date("j.n.Y").'.txt', "Something Wrong When Core try to write data", FILE_APPEND);
			
			$data['totalothers']=$otherContTot;
			
			if($otherContTot>1)
			{
				$data['otherContactView']="Matters/listRelContact";
			}
			
			$data['Countries']=$this->UserModel->GetListFrom("ml_co_country");
			$data["Areas"]=$this->TaskModel->listFromTable("ml_ma_area");
			$data["Templates"]=$this->TaskModel->listFromTable("ml_ma_template");
			$data["Notifications"]=$this->TaskModel->listFromTable("ml_ma_notification_lapse");
			$data["Attorney"]=$this->UserModel->Attorney();
			$data['totOthersCont']=$otherContTot;
			 
			
			$data["vista"]="Matters/newmatter";
			$this->load->view('MainView', $data);
		}
		
		 

	}//fin save new()


	
	
	
	public function MarkCompleted(){
		
		$fromList=$this->input->post('ItemID');
		
		if (count($fromList)<1)
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Task");
		}
		
		
		
		if (count($fromList)>0)
		{
			foreach ($fromList AS $key => $val)
			{
				$result        = $this->TaskModel->MarkCompleted($val);	
			}
		}
		
		if($result=="success"){
			
			$message="The data has been Marked Completed Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Task");
			
		}elseif($result=="error"){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Task");
			
		}

	}	
	

	


	
	public function eraseListConfirm(){
		
		$fromList=$this->input->post('ItemID');
		
		if (count($fromList)<1)
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Task");
		}
		
		
		$data=$this->SecureModel->globalTask();
		
		$data['linkSi']=base_app()."Task/eraseList";
		$data['linkNo']=base_app()."Task";
		
		
		
		if (count($fromList)>0)
		{
			foreach ($fromList AS $key => $val)
			{

				$dataDelete[]  = $val;
				$result        = $this->TaskModel->getOne($val);
				$ItemNomb[] = $result->Name;
			}
		}
		
		
		

		$this->session->set_userdata("TaskIDSdelete",$dataDelete);
	 
		$data['nameObject']="Task";
		$data["ObjectNomb"]=$ItemNomb;
		$data["vista"]="global/Confirm";

		$this->load->view('MainView', $data);

	}	
	
	public function eraseList(){
		
		
		
		$dataDelete=$this->session->userdata("TaskIDSdelete");
		
		if(count($dataDelete)>0){
			
			foreach ($dataDelete as $value){ 

				$result=$this->TaskModel->deleteOne($value);
			}
		}
		
		$this->session->set_userdata("TaskIDSdelete","");
		
		if($result=="success"){
			
			$message="The data has been Remove Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Task");
			
		}elseif($result=="error"){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Task");
			
		}
		
	}
	
	public function Details($Id){
		
		if($Id==""){
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters");
		}
		
		$this->session->set_userdata("IDMatterActual",$Id);
		
		$data=$this->SecureModel->globalTask();
		
		$data['Matter']=$this->TaskModel->selectOne($Id);
		
		$data['nameObject']="Matters";
		$data["ObjectNomb"]=$ItemNomb;
		$data["Attorney"]=$this->UserModel->Attorney();
		$data["Areas"]=$this->TaskModel->listFromTable("ml_ma_area");	
		$data["actualMatter"]=$Id;	
		$data["Templates"]=$this->TaskModel->listFromTable("ml_ma_template");
		
		$data['ContactAsociated']=$this->TaskModel->relatedContacts($Id);
		$data['relatedMatter']=$this->TaskModel->relatedMatter($Id);
		
		
		
		$data["notes"]=$this->TaskModel->NotesOfMatter($Id);
		$data["notesCreated"]=$this->TaskModel->NotesCreated($Id);
		$data["recentActi"]  =$this->TaskModel->RecentOfMatter($Id);
		$data["relatedStaff"]=$this->TaskModel->relatedStaff($Id);
		
		
		$data["vista"]="Matters/Details";

		$this->load->view('MainView', $data);
	}
	
	
	
	public function Update($Id){ 
	
		$status="";
		
		$data=$this->SecureModel->globalTask();
		
		//VALIDATION
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('Name',                'Name',                'required|min_length[3]|trim');
		$this->form_validation->set_rules('MatterID',            'MatterID',            'required|min_length[3]|trim'); 
		
        $this->form_validation->set_rules('ContactID_A',         'ContactID_A',         'required|numeric|trim');
		$this->form_validation->set_rules('Contact_A',           'Contact_A',           'required|min_length[3]|trim');
		
        $this->form_validation->set_rules('Area',                'Area',                'required|min_length[1]|numeric|trim');
        $this->form_validation->set_rules('DateOpened',          'DateOpened',          'required|min_length[3]|trim'); 
		//$this->form_validation->set_rules('Template',            'Template',            'required|numeric|trim'); 
		
		$this->form_validation->set_rules('ContactID_R',         'ContactID_R',   		'required|numeric|trim'); 
		$this->form_validation->set_rules('Contact_R',           'Contact_R',   		'required|trim'); 

		$this->form_validation->set_rules('ResponsibleAttorney', 'ResponsibleAttorney', 'required|numeric|trim'); 
		
		//$this->form_validation->set_rules('OtherStaffID',        'OtherStaffID',        'required|numeric|trim'); 
		//$this->form_validation->set_rules('OtherStaff',          'OtherStaff',          'required|trim'); 
		
		$this->form_validation->set_rules('OriginatingAttorney', 'OriginatingAttorney', 'required|numeric|trim'); 
		//$this->form_validation->set_rules('Notifications',       'Notifications',       'required|numeric|trim'); 
		
		//$status=$this->form_validation->run();
		
		if($this->form_validation->run() == FALSE)
		{
			$status="error";
			$errores=validation_errors('<span class="error">', '</span>');
			$this->session->set_userdata("validation_errors",$errores);
		}
		//END VALIDATION
		
		//echo "status ".$status;

		//CORE
		if($status==""){
			
			$data = array(
				'Name'              =>$this->input->post('Name'),
				//'Description'       =>$this->input->post('Description'),
				'Client'            =>$this->input->post('ContactID_A'),
				'Area'              =>$this->input->post('Area'),
				'DateOpen'          =>encodedate($this->input->post('DateOpened')),
				'ReferedBy'         =>$this->input->post('ContactID_R'),
				//'Template'          =>$this->input->post('Template'),
				'ResponsibleAttoney'=>$this->input->post('ResponsibleAttorney'),
				'OtherStaf'         =>$this->input->post('OtherStaff'),
				'Originating'       =>$this->input->post('OriginatingAttorney'),
				//'Notification'      =>$this->input->post('Notifications'),
				'MatterID'          =>$this->input->post('MatterID'),
				'UpdatedDate'       =>date('Y-m-d H:i:s'),
				'UserUpdater'       =>$this->session->userdata("Id")
				                                                        //*****************************************************
																		//********************************************************	
																		//********************************************************
			 );

			$insert_id=$this->TaskModel->Update($data,$Id);
			
			//echo "Id insertado: ".$insert_id;
			
			if($insert_id!=""){
				
				
				
				

				$message="All data has been save!";
				$this->session->set_userdata('message', $message);
				redirect(base_app()."Matters/Details/".$Id);
				
			}else{
				
				$message='<span class="e">Something Wrong, contact to technical support!';
				$this->session->set_userdata('Wmessage', $message);
				redirect(base_app()."Matters/Details/".$Id);
			}
			
			
		}
		//FIN CORE
		
		if($status=="error"){
			$message='<span class="e">Something Wrong, contact to technical support!</span>';
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters/Details/".$Id);
		}
		
		
	
	}
	

	
	public function saveRelContact(){
		
		
		
		$data=array('IdContact'=>$this->input->post('ContactID1'),  
					'IdMatter'=>$this->session->userdata("IDMatterActual"),
					'Relation'=>$this->input->post('Relation1')
				);
				
		$lastSaveRel=$this->ContactModel->SaveRel($data);
		
		if($lastSaveRel!=""){
			
			$message="The data has been Save Succeful!";
		 
			$this->session->set_userdata('message', $message);
			$this->session->set_userdata('ActivateTap', "record");
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual"));

		}else{
			
			$message="Something Wrong, contact technical support!";
		 
			$this->session->set_userdata('message', $message);
			$this->session->set_userdata('ActivateTap', "record");
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual"));

		}
		
		
	}
	
	function saveRelMatter(){
						 
		$fromList     = $this->input->post("MatterRel");
		$matterActual = $this->session->userdata("IDMatterActual");
		
		if (count($fromList)>0)
		{
			foreach ($fromList AS $key => $val)
			{
				//echo $val."<br>";
				
				$data=array(
						'IdMatter1'=>$matterActual,
						'IdMatter2'=>$val,
						'Creator'=>$this->session->userdata("Id"),
						'Date'=>date('Y-m-d H:i:s')
					 );
				//check if matter exist	
				$total=$this->TaskModel->getOneRelMatter(array('IdMatter1'=>$matterActual,'IdMatter2'=>$val));	

				if(count($total)<1)
				{

					$result = $this->TaskModel->saveRelMatter($data);
				}
				
			}
		}
		
		if($result>0){
			
			$message="Date saved success!";
		 
			$this->session->set_userdata('message', $message);
			$this->session->set_userdata('ActivateTap', "record");
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual"));
			
		}elseif($result<1){
			
			$message="Something Wrong, contact technical support!";
		 
			$this->session->set_userdata('Wmessage', $message);
			$this->session->set_userdata('ActivateTap', "record");
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual"));
			
		}
		
		
		
		
	}



	

	public function pruebaFecha(){

		//$old_date_timestamp = strtotime("11/09/2017 ".date('H:i:s'));
		//$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 

		echo $fecha1=mktime('02/10/2017');
		echo '<BR>';
		echo '<BR>';
		echo $fecha2=mktime('06/10/2017');

		echo $new_date;
	}


	
}