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
		$this->load->model('BillingModel','billing');

	 
	
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

	public function filtro(){
		
		$filtro="";
				
		$fromList=$this->input->post('ContMAtter_A');
		 
		$i=1;

		if(count($fromList)>0)
		{
			

			foreach ($fromList AS $key => $val)
			{

				$objeto=explode("_",$val);
				//select from task
				$taskEncontrado=$this->SecureModel->getTabla('ml_ta_atach', " AND IdObject='".$objeto[0]."' AND TypeObject='".$objeto[1]."' "  );

				if(count($taskEncontrado)>0){

					foreach ($taskEncontrado as $res) {
						$ids_task[]=$res->Task;
					}
					

				}

				
			}

			$totaltask=count($ids_task);

			if($totaltask>1){

				$filtro.=" AND ( ";

				foreach ($ids_task as $key => $value) {

					if($i==$totaltask){
						$filtro.="  a.Id='".$value."' ";
					}else{
						$filtro.="  a.Id='".$value."' OR  ";
					}

					$i++;
					# code...
				}

				$filtro.=" ) ";	
			}elseif($totaltask==1){
				$filtro.=" AND  a.Id='".$value."' ";
			}

		}

		

		if($this->input->post('Assign')!=""){
			$filtro.=" AND a.AssignTo='".$this->input->post('Assign')."' ";
			$this->session->set_userdata('taskfilAssig',$this->input->post('Assign'));
		}
		if($this->input->post('Priority')!=""){
			$filtro.=" AND a.Priority='".$this->input->post('Priority')."' ";
			$this->session->set_userdata('taskfilPriority',$this->input->post('Priority'));
		}
		if($this->input->post('Category')!=""){
			$filtro.=" AND a.Category='".$this->input->post('Category')."' ";
			$this->session->set_userdata('taskfilCategory',$this->input->post('Category'));
		}
		if($this->input->post('Status')!=""){
			$filtro.=" AND a.Status='".$this->input->post('Status')."' ";
			$this->session->set_userdata('taskfilStatus',$this->input->post('Status'));
		}
		 
		if($this->input->post('StartTime')!="" AND $this->input->post('EndTime') ==""){
			$filtro.=" AND a.StartDate='".encodedate($this->input->post('StartTime'))."' ";
			$this->session->set_userdata('taskfilStartTime',$this->input->post('StartTime'));
			$this->session->set_userdata('taskfilEndTime',$this->input->post('EndTime'));
		}	

		if($this->input->post('StartTime')!="" AND $this->input->post('EndTime') !=""){
			$filtro.=" AND a.StartDate BETWEEN '".encodedate($this->input->post('StartTime'))."' AND '".encodedate($this->input->post('EndTime'))."' ";
			$this->session->set_userdata('taskfilStartTime',$this->input->post('StartTime'));
			$this->session->set_userdata('taskfilEndTime',$this->input->post('EndTime'));
		}
		 

		$this->session->set_userdata("Taskfiltro",$filtro);

		echo 'ok';

	}
	
	
	public function viewCompleted(){
		
		if($this->session->userdata("showCompleted")=="si")
		{
			 $this->session->set_userdata("showCompleted","no");
			 $this->session->set_userdata("showComplQuery", "");
		 
		}elseif($this->session->userdata("showCompleted")=="no"){ 
			
			 $this->session->set_userdata("showCompleted","si");
			 $this->session->set_userdata("showComplQuery", " AND a.Status='3' ");
			 
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
				$this->session->set_userdata("TaskActualArea"," AND a.Category='".$Cat."' ");
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

		if($this->session->userdata("Taskfiltro")==""){
			$this->session->set_userdata("Taskfiltro"," ");
		}

		$actualPage = $this->session->userdata("TaskActualpage");
		$Taskxpage  = $this->session->userdata("Taskxpage");
		$showComplQuery=$this->session->userdata("showComplQuery");
		$ActualArea = $this->session->userdata("TaskActualArea");
		$Taskfiltro=$this->session->userdata("Taskfiltro");

		$data=$this->SecureModel->globalTask();
		
		$total=$this->TaskModel->getTotal($showComplQuery.$Taskfiltro);

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
		$data['Task']=$this->TaskModel->ListAll($actualPage,$Taskxpage,$showComplQuery.$Taskfiltro);


		$data["priority"]=$this->TaskModel->listFromTable("ml_ta_priority");
		$data["status"]=$this->TaskModel->listFromTable("ml_ta_status");
		$data["category"]=$this->TaskModel->listFromTable("ml_ta_category");
		$data["Attorney"]=$this->UserModel->Attorney();
		 

		$data['links'] = $this->pagination->create_links();
		$data["vista"]="Task/List";

		$this->load->view('MainView', $data);
	}

	



	function TaskDetail($id){



		if($this->input->post('IdMatter')!=""){
			$data["AddActualMatter"]="si";
			$data["actualMatter"]=$this->MatterModel->getOne($this->input->post('IdMatter'));



		}

		$data=$this->SecureModel->globalTask();
		
		
		$data["priority"]=$this->TaskModel->listFromTable("ml_ta_priority");
		$data["status"]=$this->TaskModel->listFromTable("ml_ta_status");
		$data["category"]=$this->TaskModel->listFromTable("ml_ta_category");
		$data["Attorney"]=$this->UserModel->Attorney();
		$data["task"]=$this->TaskModel->getOne($id);


		$relations=$this->TaskModel->getMattCont($id);

				//echo "task actual : ".$task->Id;
				

				foreach ($relations as $key  )
				{

					if($MatterForTimeExpen=="")
					{

						if($key->TypeObject=="matter")
						{
						 	$MatterForTimeExpen=$key->IdObject;
						}
					}

				}


		$data["relations"]	= $relations;	


		/*billing part*/
		$this->load->helper('calendar_helper');
		$this->load->model('MatterModel');

		$data["billing_codes"]=$this->billing->billing_code_get();
		$data["owners"]=$this->billing->owners_get();

		 
		$data["default_matter"]=$this->MatterModel->selectOne((int)$MatterForTimeExpen);
	 

		$data["entry"]=$this->billing->time_expense_get($id_entry);
		 
		$data["sendViaAjax"]='si';
		$data["redirAfterSend"]='no';
		$data["taskid"]=$id;

		
		

		/********/




		 
		
		
		
		
		$data["vista"]="Task/detailTask";

		$this->load->view('MainView', $data);
		
		 
	}


	
	
	
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