<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matters extends CI_Controller {
	function  __construct(){
		parent:: __construct();

		if($this->session->userdata('Email')==""){ redirect("Login"); }
		$this->load->model('SecureModel');
		$this->load->model('MatterModel');
		$this->load->model('UserModel');
		$this->load->model('ContactModel');
		$this->load->model('TaskModel');
		$this->load->model('BillingModel');

		
		
	}

	public function index()
	{

		$this->GetList();
	}
	
	public function  MAxResultXPage($Mattxpage){
		
		$this->session->set_userdata("Mattxpage",$Mattxpage);
		$this->session->set_userdata("MattActualpage","0");
		redirect(base_app()."Matters");
	}
	
	public function Page($page=0){
		
		if($page==""){ $page='0'; }
		
		$this->session->set_userdata("MattActualpage",$page);
		
		redirect(base_app()."Matters");
	}
	
	public function ListAlpha($letter){
		
		if($letter!=""){
			if($letter=="ALL"){
				//set session
				$this->session->set_userdata("MattActualLetter","  ");
				$this->session->set_userdata("MattActualpage","0");
				redirect(base_app()."Matters");
			}else{
				//set matter
				$this->session->set_userdata("MattActualLetter"," AND ( Name LIKE '".$letter."%' OR Name LIKE '".strtolower($letter)."%' ) ");
				$this->session->set_userdata("MattActualpage","0");
				redirect(base_app()."Matters");
			}

			
			
		}
	}
	
	public function ChangeArea($Area){
		
		//set session
		if($Area!=""){
			if($Area=="ALL"){

				$this->session->set_userdata("MattActualArea"," AND (ma.Status='1' OR ma.Status='2')");
				$this->session->set_userdata("MattActualpage","0");
				$this->session->set_userdata("MattActualLetter","  ");
				$this->session->set_userdata("Class","ALL");
				redirect(base_app()."Matters");

			}if ($Area=="Actived") {

				$this->session->set_userdata("MattActualArea"," AND Status='1'");
				$this->session->set_userdata("MattActualLetter","  ");
				$this->session->set_userdata("MattActualpage","0");
				$this->session->set_userdata("Class","Actived");
				redirect(base_app()."Matters");

			}if ($Area == "Desactivated") {

				$this->session->set_userdata("MattActualArea"," AND Status='2'");
				$this->session->set_userdata("MattActualLetter","  ");
				$this->session->set_userdata("MattActualpage","0");
				$this->session->set_userdata("Class","Desactivated");
				redirect(base_app()."Matters");

			}if ($Area == 'Overdue') {

				$this->session->set_userdata("MattActualArea"," AND (ma.Status='1' OR ma.Status='2')");
				$this->session->set_userdata("MattActualLetter","  ");
				$this->session->set_userdata("MattActualpage","0");
				$this->session->set_userdata("Class","Overdue");
				redirect(base_app()."Matters");

			}
			else{

				$this->session->set_userdata("MattActualArea"," AND Area='".$Area."' ");
				$this->session->set_userdata("MattActualLetter","  ");
				$this->session->set_userdata("MattActualpage","0");
				redirect(base_app()."Matters");

			}
		}
		
	}

	public function GetList()
	{
		
		$this->session->set_userdata("MatterIDdelete","");
		
		if($this->session->userdata("MattActualpage")==""){
			$this->session->set_userdata("MattActualpage","0");
		}
		
		if($this->session->userdata("Mattxpage")==""){
			$this->session->set_userdata("Mattxpage","10");
		}
		
		if($this->session->userdata("MattActualLetter")==""){
			$this->session->set_userdata("MattActualLetter","  ");
		}
		
		if($this->session->userdata("MattActualArea")==""){
			$this->session->set_userdata("MattActualArea"," ");
		}
		
		
		
		$actualPage = $this->session->userdata("MattActualpage");
		$Mattxpage  = $this->session->userdata("Mattxpage");
		$ActualLetter=$this->session->userdata("MattActualLetter");
		$ActualArea = $this->session->userdata("MattActualArea");
		$Class = $this->session->userdata("Class");

		$data=$this->SecureModel->globalTask();
		
		$total=$this->MatterModel->getTotal($ActualArea.$ActualLetter,$Class);

		$this->load->library('pagination');

		$config['base_url'] = base_url().'Matters/page/';
		$config['total_rows'] = $total->total;
		$config['per_page'] = $Mattxpage;
		$config["cur_page"] = $actualPage;

		$this->pagination->initialize($config);
		
		$endItem=$actualPage+$Mattxpage;
		if($endItem > $total->total){ $endItem=$total->total; }
		
		$data["startItem"] = $actualPage;
		$data["endItem"] = $endItem;
		$data["totalMatter"] = $total->total;
		$data['Matters']=$this->MatterModel->ListAll($actualPage,$Mattxpage,$ActualArea.$ActualLetter,$Class);
		$data['Areas']=$this->MatterModel->listFromTable("ml_ma_area");

		$data['links'] = $this->pagination->create_links();

		$data['billing_status'] = $this->MatterModel->get_billing_status($data['Id']);

		$data["vista"]="Matters/List";

		$this->load->view('MainView', $data);
	}

	public function CreateNew(){

		$data=$this->SecureModel->globalTask();
		
		$data['totOthersCont']="1";
		
		$data["Areas"]=$this->MatterModel->listFromTable("ml_ma_area");
		$data["Templates"]=$this->MatterModel->listFromTable("ml_ma_template");
		$data["Notifications"]=$this->MatterModel->listFromTable("ml_ma_notification_lapse");
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
		//$this->form_validation->set_rules('MatterID',            'Matter ID',            'required|min_length[3]|trim'); 
		
		$this->form_validation->set_rules('ContactID_A',         'Client name',         'required|numeric|trim');
		$this->form_validation->set_rules('Contact_A',           'Client Name',           'required|min_length[3]|trim');
		
        //$this->form_validation->set_rules('Area',                'Practice Area',       'required|min_length[1]|numeric|trim');
        //$this->form_validation->set_rules('DateOpened',          'Date Opened',          'required|min_length[3]|trim'); 
		//$this->form_validation->set_rules('Template',            'Template',            'required|numeric|trim'); 
		
		//$this->form_validation->set_rules('ContactID_R',         'Contact referred',   		'required|numeric|trim'); 
		//$this->form_validation->set_rules('Contact_R',           'Contact Referred',   		'required|trim'); 

		//$this->form_validation->set_rules('ResponsibleAttorney', 'Responsible Attorney', 'required|numeric|trim'); 
		
		
		//$this->form_validation->set_rules('OtherStaff',          'Other Staff',          'required|trim'); 
		
		//$this->form_validation->set_rules('OriginatingAttorney', 'Originating Attorney', 'required|numeric|trim'); 
		//$this->form_validation->set_rules('Notifications',       'Notifications',       'required|numeric|trim'); 
		
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

			$insert_id=$this->MatterModel->SaveNew($data);
			
			//echo "Id insertado: ".$insert_id;
			
			if($insert_id!=""){
				
				//CHEK IF OTHERS CONTACTS ADDED AND INSERT IN DB

				//save client like a related contact
				$dataR=array(
					'IdContact'=>$this->input->post('ContactID_A'),
					'IdMatter'=>$insert_id,
					'Relation'=>'Client of Matter'
				);
				$this->ContactModel->SaveRel($dataR);
				
				
				
				for($i=1; $i<=$otherContTot;$i++)
				{
					
					$idCont=$this->input->post('ContactID'.$i);
					$ContNam=$this->input->post('Contact'.$i);
					$Relation=$this->input->post('Relation'.$i);
					
					if($idCont!="")
					{
						if($ContNam!="")
						{
							
							

							$totalRelc=$this->MatterModel->getOneRelated(array('IdContact'=>$idCont,'IdMatter'=>$insert_id), 'ml_ma_contact_related');	

							if(count($totalRelc)<1){
								
								$dataR=array('IdContact'=>$idCont,
									'IdMatter'=>$insert_id,
									'Relation'=>$Relation,
									'Date'=>date('Y-m-d H:i:s'),
									'Creator'=>$this->session->userdata("Id")
								);
								
								$lastSaveRel=$this->ContactModel->SaveRel($dataR);
							}	
							
							
							
						}
					}
				}

				//save de billling data
				$this->load->model('BillingModel','billing');

				$dataBill = array(
					'MatterId'           =>$insert_id,
					'BillingId'          =>'1',
					'TotalAmount'        =>$this->input->post('TotalAmount'),
					'Fee'               =>$this->input->post('Fee'),
					'Kind'               =>'1',
					'kindEntrie'         =>'1',
					'StartDate'          =>$this->input->post('StartDate'),
					'EndDate'            =>$this->input->post('EndDate'),
					'Hours'              =>'2',
					'Rate'               =>'2',
					'Creator'            =>$this->session->userdata("Id"),
					'Date'               =>date('Y-m-d H:i:s'),
					'Period'             =>$this->input->post('Periodicity'),
					'PerDay'             =>$this->input->post('PerDay')
				);

				$insert_idBill=$this->MatterModel->SaveBillActv($dataBill);

				$total=$this->input->post('TotalAmount');
				$fee=$this->input->post('Fee');
				$initial_fee=$this->input->post('Initial_Fee');
				$start_date=$this->input->post('StartDate');
				$periodicity=$this->input->post('Periodicity');

				$time_expense=$this->generate_time_expense($start_date,$total,$fee,$periodicity,$initial_fee);
				foreach($time_expense as $i => $te):
					$max=$this->billing->getMaxInvoicesNumber();
					$max=$max+1;

					$mattersname = $this->billing->get_matter_name($insert_id);

					$data = array(
						'Number'=>$max,	
						'Status' => 'Draft',
						'InvoiceDate'=>date('Y-m-d H:i:s'),
						'DueDate'=>$te['date_activity'],
						'Balance'=>'',
						'InvoiceAmount'=>$te['amount'],
						'Creator'=>$this->session->userdata("Id"),
						'Object'=>$insert_id,
						'TypeObject'=>'matter',
						'BillToName'=>trim($mattersname->Name),
						'BillTo'=>trim($insert_id)

					);

					$invoiceId = $this->billing->SaveNew('ml_bi_invoices',$data);
					$te["billing_code"]=9;
					$te["id_matter"]=$insert_id;
					$te['InvoiceNumber'] = $max;
					$this->billing->time_expense_add($te);
				endforeach;


				
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
						
						$total=$this->MatterModel->getOneRelatedStaff(array('IdUser'=>$val,'IdMatter'=>$insert_id));	

						if(count($total)<1){

							
							$result = $this->MatterModel->saveStafRelated($data);
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
			$data["Areas"]=$this->MatterModel->listFromTable("ml_ma_area");
			$data["Templates"]=$this->MatterModel->listFromTable("ml_ma_template");
			$data["Notifications"]=$this->MatterModel->listFromTable("ml_ma_notification_lapse");
			$data["Attorney"]=$this->UserModel->Attorney();
			$data['totOthersCont']=$otherContTot;
			
			
			$data["vista"]="Matters/newmatter";
			$this->load->view('MainView', $data);
		}
		
		

	}
	//fin save new()******************************************************************************************************************************************
	//fin save new()******************************************************************************************************************************************
	//fin save new()******************************************************************************************************************************************
	//fin save new()******************************************************************************************************************************************
	//fin save new()******************************************************************************************************************************************
	//fin save new()******************************************************************************************************************************************





	public function NewNote($idMatter){


		$data=$this->SecureModel->globalTask();

		
		$message="The data has been Save Succeful!";
		
		$this->session->set_userdata('message', $message);
		$this->session->set_userdata('ActivateTap', "note");
		redirect(base_app()."Matters/Details/".$idMatter);


	}
	
	public function SaveNote($IdMatter){

		$datos=array(
			'IdMatter'=>$IdMatter, 
			'note'=>$this->input->post("note"),
			'Date'=>date('Y-m-d H:i:s'),
			'Creator'=>$this->session->userdata("Id")	
		);
		
		
		$this->MatterModel->SaveNote($datos);

		$message="The data has been Save Succeful!";
		
		$this->session->set_userdata('message', $message);
		$this->session->set_userdata('ActivateTap', "note");
		redirect(base_app()."Matters/Details/".$IdMatter."?tab=notes");

		//echo base_app()."Matters/Details/".$IdMatter;
	}

	public function eraseMatterConfirm($IdMatter){
		
		
		
		if ($IdMatter=="")
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters");
		}
		
		
		$data=$this->SecureModel->globalTask();
		
		$data['linkSi']=base_app()."Matters/eraseOne";
		$data['linkNo']=base_app()."Matters/Details/".$IdMatter;
		
		$result        = $this->MatterModel->getOne($IdMatter);
		$ItemNomb[]    = $result->Name;

		$this->session->set_userdata("MatterIDdelete",$IdMatter);
		
		$data['nameObject']="Matter";
		$data["ObjectNomb"]=$ItemNomb;
		$data["vista"]="global/Confirm";

		$this->load->view('MainView', $data);

	}	

	public function eraseOne(){
		
		
		$Id=$this->session->userdata("MatterIDdelete");
		

		$result=$this->MatterModel->deleteOne($Id,'-1');
		
		
		$this->session->set_userdata("MatterIDdelete","");
		
		if($result=="success"){
			
			$message="The data has been Remove Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Matters");
			
		}elseif($result=="error"){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters");
			
		}
		
	}


	
	public function eraseListConfirm(){
		
		$fromList=$this->input->post('ItemID');
		
		if (count($fromList)<1)
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters");
		}
		
		
		$data=$this->SecureModel->globalTask();
		
		$data['linkSi']=base_app()."Matters/eraseList";
		$data['linkNo']=base_app()."Matters";
		
		
		
		if (count($fromList)>0)
		{
			foreach ($fromList AS $key => $val)
			{

				$dataDelete[]  = $val;
				$result        = $this->MatterModel->getOne($val);
				$ItemNomb[] = $result->Name;
			}
		}
		
		
		

		$this->session->set_userdata("MatterIDdelete",$dataDelete);
		
		$data['nameObject']="Matters";
		$data["ObjectNomb"]=$ItemNomb;
		$data["vista"]="global/Confirm";

		$this->load->view('MainView', $data);

	}	
	
	public function eraseList(){
		
		
		
		$dataDelete=$this->session->userdata("MatterIDdelete");
		
		if(count($dataDelete)>0){
			
			foreach ($dataDelete as $value){ 

				$result=$this->MatterModel->deleteOne($value,'-1');
			}
		}
		
		$this->session->set_userdata("MatterIDdelete","");
		
		if($result=="success"){
			
			$message="The data has been Remove Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Matters");
			
		}elseif($result=="error"){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters");
			
		}
		
	}
	
	/*DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
	/*DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
	/*DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD                           DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
	/*DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
	/*DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
	/*DDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDDD*/
	public function Details($Id){
		
		if($Id==""){
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters");
		}
		
		$this->session->set_userdata("IDMatterActual",$Id);
		
		$data=$this->SecureModel->globalTask();
		
		$data['Matter']=$this->MatterModel->selectOne($Id);
		
		$data['nameObject']="Matters";
		$data["ObjectNomb"]=$ItemNomb;
		$data["Attorney"]=$this->UserModel->Attorney();
		$data["Areas"]=$this->MatterModel->listFromTable("ml_ma_area");	
		$data["actualMatter"]=$Id;	
		$data["Templates"]=$this->MatterModel->listFromTable("ml_ma_template");


		
		$data['ContactAsociated']=$this->MatterModel->relatedContacts($Id);
		$data['relatedMatter']=$this->MatterModel->relatedMatter($Id);
		$data['relatedTask']=$this->MatterModel->relatedTask($Id);
		$data['relatedDoc']=$this->MatterModel->relatedDoc($Id);

		$data["lastTask"]   = $this->TaskModel->getLast5();
		
		$data["notes"]=$this->MatterModel->NotesOfMatter($Id);
		$data["notesCreated"]=$this->MatterModel->NotesCreated($Id);
		$data["recentActi"]  =$this->MatterModel->RecentOfMatter($Id);
		$data["relatedStaff"]=$this->MatterModel->relatedStaff($Id);

		$data['balance'] = $this->MatterModel->getBalance($Id);
		
		$this->load->model('BillingModel','billing');

		$data["billing"]=$this->billing->activities_get($Id);

		$data["InvoicesRel"]=$this->MatterModel->InvoicesRel($Id);



		$data["vista"]="Matters/Details";

		$this->load->view('MainView', $data);
	}



	
	
	
	public function Update($Id){ 
		
		$status="";
		
		$data=$this->SecureModel->globalTask();
		
		//VALIDATION
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('Name',                'Name',                'required|min_length[3]|trim');
		//$this->form_validation->set_rules('MatterID',            'MatterID',            'required|min_length[3]|trim'); 
		
        //$this->form_validation->set_rules('ContactID_A',         'ContactID_A',         'required|numeric|trim');
		//$this->form_validation->set_rules('Contact_A',           'Contact_A',           'required|min_length[3]|trim');
		
        //$this->form_validation->set_rules('Area',                'Area',                'required|min_length[1]|numeric|trim');
        //$this->form_validation->set_rules('DateOpened',          'DateOpened',          'required|min_length[3]|trim'); 
		//$this->form_validation->set_rules('Template',            'Template',            'required|numeric|trim'); 
		
		//$this->form_validation->set_rules('ContactID_R',         'ContactID_R',   		'required|numeric|trim'); 
		//$this->form_validation->set_rules('Contact_R',           'Contact_R',   		'required|trim'); 

		//$this->form_validation->set_rules('ResponsibleAttorney', 'ResponsibleAttorney', 'required|numeric|trim'); 
		
		//$this->form_validation->set_rules('OtherStaffID',        'OtherStaffID',        'required|numeric|trim'); 
		//$this->form_validation->set_rules('OtherStaff',          'OtherStaff',          'required|trim'); 
		
		//$this->form_validation->set_rules('OriginatingAttorney', 'OriginatingAttorney', 'required|numeric|trim'); 
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
				'Description'       =>$this->input->post('Description'),
				'UserUpdater'       =>$this->session->userdata("Id")
                //*****************************************************
				//********************************************************	
				//********************************************************
			);

			//echo " Valor de desc".$this->input->post('Description');

			$insert_id=$this->MatterModel->Update($data,$Id);
			
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
	
	public function ChangeTemplate($template,$idMatter){
		
		$this->MatterModel->updataTemplate($template,$idMatter);
		
		$message="The data has been Save Succeful!";
		
		$this->session->set_userdata('message', $message);
		$this->session->set_userdata('ActivateTap', "template");
		redirect(base_app()."Matters/Details/".$idMatter);
		
		
	}
	
	public function saveRelContact(){
		
		
		
		$data=array('IdContact'=>$this->input->post('ContactID1'),  
			'IdMatter'=>$this->session->userdata("IDMatterActual"),
			'Relation'=>$this->input->post('Relation1'),
			'Date'=>date('Y-m-d H:i:s'),
			'Creator'=>$this->session->userdata("Id")
		);
		
		$lastSaveRel=$this->ContactModel->SaveRel($data);
		
		if($lastSaveRel!=""){
			
			$message="The data has been Save Succeful!";
			
			$this->session->set_userdata('message', $message);
			$this->session->set_userdata('ActivateTap', "record");
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual")."?tab=records");

		}else{
			
			$message="Something Wrong, contact technical support!";
			
			$this->session->set_userdata('message', $message);
			$this->session->set_userdata('ActivateTap', "record");
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual")."?tab=records");

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
				$total=$this->MatterModel->getOneRelMatter(array('IdMatter1'=>$matterActual,'IdMatter2'=>$val));	

				if(count($total)<1)
				{

					$result = $this->MatterModel->saveRelMatter($data);
				}
				
			}
		}
		
		if($result>0){
			
			$message="Date saved success!";
			
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual")."?tab=records");
			
		}elseif($result<1){
			
			$message="Something Wrong, contact technical support!";
			
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Matters/Details/".$this->session->userdata("IDMatterActual")."?tab=records");
			
		}
		
		
		
		
	}

	
	
	
	

	public function pruebaFecha(){

		$old_date_timestamp = strtotime("11/09/2017 ".date('H:i:s'));
		$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 

		//echo $new_date;
	}

	function generate_time_expense($start_date,$total,$fee,$periodicity,$initial_fee=0){
		if ($perday==0) {
			$date_activity = $start_date;
		}else{
			$date_activity = date("Y-m-",strtotime($start_date)).$perday;
		}

		$total_pay=$total-$initial_fee;
		$num_payments=ceil($total_pay/$fee);

		$payments=array();
		$extra_time=" + 0 days";
		switch($periodicity){
			case "0": // pago unico
			$extra_time=" + 0 days";
			break;
			case "1": // semanal
			$extra_time=" + 7 days";
			break;
			case "2": // cada 15 dias
			$extra_time=" + 15 days";
			break;
			case "3": // mensual
			$extra_time=" + 1 month";
			break;
			case "4": // Bi mensual
			$extra_time=" + 2 month";
			break;
			case "5": // trimensual
			$extra_time=" + 3 month";
			break;
		}

		if($initial_fee>0){
			$payments[]=array(
				"date_activity"=>Date("Y-m-d",strtotime($date_activity)),
				"rate"=>$initial_fee,
				"units"=>1,
				"amount"=>$initial_fee,
				"status"=>1,
				"is_flat_fee"=>1,
				"type_entry"=>"TIME",
				"creation_date"=>date('Y-m-d H:i:s')
			);
		}
		

		for($i=1;$i<=$num_payments;$i++){

			//if($i==0){ 
			//	$date_activity=Date("Y-m-d",strtotime($date_activity));
			// }else{
			$date_activity=Date("Y-m-d",strtotime($date_activity.$extra_time));
			// }


			

			$amount_pay=(($i*$fee)<$total_pay)? $fee : ($total_pay-(($i-1)*$fee));
			$payments[]=array(
				"date_activity"=>$date_activity,
				"rate"=>$amount_pay,
				"units"=>1,
				"amount"=>$amount_pay,
				"status"=>1,
				"is_flat_fee"=>1,
				"type_entry"=>"TIME",
				"creation_date"=>date('Y-m-d H:i:s')
			);
		}

		return $payments;

	}

	function deleteRelcontact($IdMatter,$IdContact){

		if($IdMatter=="" or $IdContact==""){

			$message='<span class="red">No Matter or Contact selected to remove!</span>';
			$this->session->set_userdata('Wmessage', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');

			
		}

		$result=$this->SecureModel->delete('ml_ma_contact_related', array('IdContact'=>$IdContact,'IdMatter'=>$IdMatter));

		if($result>0){

			$message='<span class="green">Contact related has been remove!</span>';
			$this->session->set_userdata('message', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');
		}

		

	}

	function deleteRelMatter($IdMatter,$IdMatter2){

		if($IdMatter=="" or $IdMatter2==""){


			$message='<span class="red">No Matter selected!</span>';
			$this->session->set_userdata('Wmessage', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');

		}


		$result=$this->SecureModel->delete('ml_ma_matters_related', array('IdMatter1'=>$IdMatter,'IdMatter2'=>$IdMatter2));

		if($result>0){

			$message='<span class="green">Matter relation has been remove!</span>';
			$this->session->set_userdata('message', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');
		}



		

	}

	function deleteReldoc($IdMatter,$IdDocument){
		
		if($IdMatter=="" or $IdDocument==""){

			$message='<span class="red">No Matter or Document selected!</span>';
			$this->session->set_userdata('Wmessage', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');

			
		}

		$data=array(

			'Document'=>$IdDocument,
			'IdObject'=>$IdMatter,
			'TypeObject'=>"matter"

		);

		$result=$this->SecureModel->delete('ml_do_atach', $data);
		//deleteAtach

		if($result>0){

			$message='<span class="green">Document relation has been remove!</span>';
			$this->session->set_userdata('message', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');
		}

		

	}


	function deleteRelEve($IdMatter,$IdEvent){

		if($IdMatter=="" or $IdEvent==""){

			$message='<span class="red">No Matter or Event selected!</span>';
			$this->session->set_userdata('Wmessage', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');
		}

		$data=array(

			'id_event'=>$IdEvent,
			'id_attach'=>$IdMatter,
			'type_attach'=>"MATTER"

		);

		$result=$this->SecureModel->delete('ml_cal_events_attach', $data);
		//deleteAtach
		if($result>0){

			$message='<span class="green">Event relation has been remove!</span>';
			$this->session->set_userdata('message', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');
		}
		

	}

	function deleteRelTask($IdMatter,$IdTask){

		if($IdMatter=="" or $IdTask==""){

			$message='<span class="red">No Matter or Task selected!</span>';
			$this->session->set_userdata('Wmessage', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');
		}

		$data=array(

			'Task'=>$IdTask,
			'IdObject'=>$IdMatter,
			'TypeObject'=>"matter"

		);

		$result=$this->SecureModel->delete('ml_ta_atach', $data);
		//deleteAtach
		if($result>0){

			$message='<span class="green">Task relation has been remove!</span>';
			$this->session->set_userdata('message', $message);

			redirect(base_app().'Matters/Details/'.$IdMatter.'?tab=records');
		}
		

	}
	public function DesactivarList($action){
		
		if($action==""){
			
			echo "0";
			
		}else{
			
			$dataDelete=$this->input->post('ItemID');

			if(count($dataDelete)>0){

				foreach ($dataDelete as $value){ 

					$result=$this->MatterModel->deleteOne($value,$action);
				}
				
				if($result=="success"){
					echo "1";
				}elseif($result=="error"){
					echo "0";
				}
				
			}elseif(count($dataDelete)<1){
				echo "3";
			}
			
		}

	}

	function NewBilling(){
		//save de billling data
		$this->load->model('BillingModel','billing');

		$dataBill = array(
			'MatterId'           =>$insert_id,
			'BillingId'          =>'1',
			'TotalAmount'        =>$this->input->post('TotalAmount'),
			'Fee'               =>$this->input->post('Fee'),
			'Kind'               =>'1',
			'kindEntrie'         =>'1',
			'StartDate'          =>$this->input->post('StartDate'),
			'EndDate'            =>$this->input->post('EndDate'),
			'Hours'              =>'2',
			'Rate'               =>'2',
			'Creator'            =>$this->session->userdata("Id"),
			'Date'               =>date('Y-m-d H:i:s'),
			'Period'             =>$this->input->post('Periodicity'),
			'PerDay'             =>$this->input->post('PerDay')
		);

		$insert_idBill=$this->MatterModel->SaveBillActv($dataBill);

		$total=$this->input->post('TotalAmount');
		$fee=$this->input->post('Fee');
		$initial_fee=$this->input->post('Initial_Fee');
		$start_date=$this->input->post('StartDate');
		$periodicity=$this->input->post('Periodicity');

		$time_expense=$this->generate_time_expense($start_date,$total,$fee,$periodicity,$initial_fee);
		foreach($time_expense as $i => $te):
			$max=$this->billing->getMaxInvoicesNumber();
			$max=$max+1;

			$mattersname = $this->billing->get_matter_name($insert_id);

			$data = array(
				'Number'=>$max,	
				'Status' => 'Draft',
				'InvoiceDate'=>date('Y-m-d H:i:s'),
				'DueDate'=>$te['date_activity'],
				'Balance'=>'',
				'InvoiceAmount'=>$te['amount'],
				'Creator'=>$this->session->userdata("Id"),
				'Object'=>$insert_id,
				'TypeObject'=>'matter',
				'BillToName'=>trim($mattersname->Name),
				'BillTo'=>trim($$insert_id)

			);

			$invoiceId = $this->billing->SaveNew('ml_bi_invoices',$data);
			$te["billing_code"]=9;
			$te["id_matter"]=$insert_id;
			$te['InvoiceNumber'] = $max;
			$this->billing->time_expense_add($te);
		endforeach;
	}


}