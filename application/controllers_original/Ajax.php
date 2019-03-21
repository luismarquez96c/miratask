<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ajax extends CI_Controller {

	function  __construct(){

		parent:: __construct();



		if($this->session->userdata('Email')==""){ redirect("Login"); }

		$this->load->model('SecureModel');

		$this->load->model('ContactModel');

		$this->load->model('UserModel');

		$this->load->model('MatterModel');

		$this->load->model('TaskModel');

		$this->load->model('BillingModel','billing');

		$this->load->model('AdminModel');

		$this->load->helper('cookie');



	}



	function CloseMatter(){

		$this->load->view('Matters/CloseMatter');

	}

	



	//FieldNumber : secuencia de id de cada objeto en el html de la vista

	function showContact($section)

	{

		$criteria = $this->input->post("Contact");

		$result   = $this->ContactModel->SelectLike($criteria);

		//$this->load->view('Contacts/ListAjax', $data);

		

		foreach ($result as $row)

		{

			//parametros que se le enviaran a la funcion script setFields()

			//id : valor del campo hidden por ejemplo:  value="id"  

			//Name: valor del textbox:  ejemplo   value="Name" 

			//hideField: nombre del campo oculto ej: name="hideField+section"

			//TextField: nombre del campo text ej: name="TextField+section"

			//ResultBox: objeto contenedor donde se muestran esta lista, debe cerrarse al dar click en un item.

			$id=$row->Id;

			$Name=$row->FirstName.' '.$row->LastName;

			$hideField='ContactID'.$section;

			$TextField='Contact'.$section;

			$ResultBox='ContactResult'.$section;

			

			

			

			//al hacer click en el item de la lista desplegada 

			//setfiled()   llenara el hidden y el textbox en el archivo util.js

			echo '<li><a onclick="setFields(\''.$id.'\',\' '.$Name.'\',\''.$hideField.'\',\''.$TextField.'\',\''.$ResultBox.'\' )">'.$Name.'</a></li>';

			

		}

	}



	function ContactAndMAtt($section)

	{

		$criteria = $this->input->post("Criteria");

		$result   = $this->ContactModel->ContactAndMAtt($criteria);

		//$this->load->view('Contacts/ListAjax', $data);

		

		foreach ($result as $row)

		{

			

			$id=$row->Id;

			$Name=$row->titulo;

			$sectionName=$section;

			$idButton ='ContMAtterButt'.$id;





			$ResultBox='ContactResult'.$section;

			

			if($row->Object == 'matter'){



				$img='<img src="'.base_url().'img/matters_blue.png">';

			}

			if($row->Object == 'contact'){



				$img='<img src="'.base_url().'img/contact_group.png">';

			}

			

			

			echo '<li onclick="addFieldButt(\''.$id.'\',\' '.$Name.'\',\''.$sectionName.'\',\''.$idButton.'\',\''.$ResultBox.'\' , \''.$row->Object.'\')" > 

			<div>'.$img.' &nbsp; '.$Name.'</div> 

			<div class="desc">'.$row->Description.'</div> 

			</li>';

			

		}

	}

	

	



	

	

	//this method is used in update Matter

	function OtherStaffByName(){

		

		$criteria=$this->input->post("OtherStaff");

		$result=$this->UserModel->allLikeAttorney($criteria);

		

		foreach ($result as $row)

		{

			

			$id=$row->Id;

			$Name=$row->Name.' '.$row->LastName;

			$hideField='OtherStaffID';

			$TextField='OtherStaff';

			$ResultBox='resulAttorney';

			

			echo '<li><a onclick="addStaff(\''.$id.'\',\' '.$Name.'\',\''.$hideField.'\',\''.$TextField.'\',\''.$ResultBox.'\' )">'.$Name.'</a></li>';

			

		}

		

	}

	

	function SearchStaff(){

		

		$criteria=$this->input->post("OtherStaff");

		$result=$this->UserModel->GetLikeAdmiAttorney($criteria);

		

		foreach ($result as $row)

		{

			

			$id=$row->Id;

			$Name=$row->Name.' '.$row->LastName;

			$hideField='OtherStaffID';

			$TextField='OtherStaff';

			$ResultBox='resulAttorney';

			

			echo '<li><a onclick="addFieldStaff(\''.$id.'\',\' '.$Name.'\',\''.$hideField.'\',\''.$TextField.'\',\''.$ResultBox.'\' )">'.$Name.'</a></li>';

			

		}

		

	}

	

	function getCountryState($country){

		

		$StatesOfCountry=$this->ContactModel->StatesOfCountries($country);

		

		foreach ($StatesOfCountry as $row)

		{

			

			echo '<option value="'.$row->Id.'">'.$row->State.'</option>';

			

		} 

	}

	

	function getCountryList(){

		

		$Country=$this->UserModel->GetListFrom("ml_co_country", " WHERE Id='62' OR Id='68' OR Id='157'");

		

		foreach ($Country as $row)

		{

			

			echo '<option value="'.$row->Id.'">'.$row->Country.'</option>';

			

		} 

		

	}



	function ContactNew(){

		

		$data['totAddressCont']=1;

		$data['totPhoneCont']=1;

		$data['totEmailCont']=1;

		$data['totWebsiteCont']=1;

		

		$data['Groups']   	 = $this->UserModel->GetListFrom("ml_us_groups");

		$data['Attorneys']   = $this->UserModel->Attorney(); 

		$data['Countries']   = $this->UserModel->GetListFrom("ml_co_country", " ");

		

		

		$this->load->view('Contacts/NewContactAjax',$data);

	}

	

	



	function ContactNewSave(){





		

		$status="";

		

		$totAddressCont  = $this->input->post('totAddressCont');

		$totPhoneCont    = $this->input->post('totPhoneCont');

		$totEmailCont    = $this->input->post('totEmailCont');

		$totWebsiteCont  = $this->input->post('totWebsiteCont');

		

		$this->load->library('form_validation');

		

		if($this->input->post('Class')=="Individual"){

			$this->form_validation->set_rules('Name',    'Name',      'required|min_length[3]|trim');

			$this->form_validation->set_rules('LastName','Last Name', 'required|min_length[3]|trim');

			//$this->form_validation->set_rules('Middle',  'Middle',    'required|min_length[3]|trim');

			//$this->form_validation->set_rules('Suffix',  'Suffix',    'required|min_length[3]|trim');

		}

		if($this->input->post('Class')=="Business-Org"){

			$this->form_validation->set_rules('Company',  'Company',    'required|min_length[3]|trim');

		}

		

		$this->form_validation->set_rules('Country1', 'Country', 'required|trim');

		$this->form_validation->set_rules('Street1_1','Street 1','required|min_length[5]|trim');

		$this->form_validation->set_rules('City1', 'City', 'required|min_length[3]|trim');

		$this->form_validation->set_rules('State1','State 1','required|trim');

		

		//validando Adrress

		for($i=2;$i<=$totAddressCont;$i++)

		{

			if($this->input->post('Country'.$i)!=""){

				$this->form_validation->set_rules('Country'.$i,  'Country '.$i, 'required|trim');

			}

			if($this->input->post('Street1_'.$i)!=""){

				$this->form_validation->set_rules('Street1_'.$i, 'Street '.$i,   'required|min_length[3]|trim');

			}

			if($this->input->post('City'.$i)!=""){

				$this->form_validation->set_rules('City'.$i,     'City '.$i,     'required|min_length[3]|trim');

			}

			if($this->input->post('State'.$i)!=""){

				$this->form_validation->set_rules('State'.$i,    'State '.$i,    'required|trim');

			}

		}

		

		//Validate Phone

		for($i=1;$i<=$totPhoneCont;$i++)

		{

			if($this->input->post('Phone'.$i)!="")

			{

				$this->form_validation->set_rules('Phone'.$i, 'Phone'.$i, 'required|numeric|min_length[6]|trim');

			}	

		}

		//Validate Email

		for($i=1;$i<=$totEmailCont;$i++)

		{

			if($this->input->post('Email'.$i)!="")

			{

				$this->form_validation->set_rules('Email'.$i, 'Email '.$i, 'required|valid_email|min_length[3]|trim');

			}	

		}

		

		//Validate Website

		for($i=1;$i<=$totWebsiteCont;$i++)

		{

			

			if($this->input->post('Website'.$i)!="")

			{

				//echo "Valor de Website ".$this->input->post('Website'.$i);

				$this->form_validation->set_rules('Website'.$i, 'Website '.$i, 'required|valid_url_format');

			}

		}

		



		if($this->form_validation->run() == FALSE)

		{

			$status="error";

		}



		if($status=="")

		{

			

			//change date format

			if ($this->input->post('Birdate')=="12-10-1969") {

				$old_date_timestamp = strtotime($this->input->post('Birdate'));

				$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 

			}

			else{

				$new_date = '0000-00-00 00:00:00';

			}

			

			

			$data = array(

				'FirstName'=>$this->input->post('Name'),

				'LastName'=>$this->input->post('LastName'),

				'Middle'=>$this->input->post('Middle'),

				'Suffix'=>$this->input->post('Suffix'),

				'Profession'=>$this->input->post('Profession'),

				'Company'=>$this->input->post('Company'),

				'Birdate'=>$new_date,

				'OtherIdentifier'=>$this->input->post('OtherIdenty'),

				'GroupId'=>$this->input->post('Groups'),

				'Title'=>$this->input->post('Tittle'),

				'ClientId'=>$this->input->post('ClientID'),

				'Class'=>$this->input->post('Class'),

				'Owner'=>$this->input->post('Own'),

				'Creator'=>$this->session->userdata("Id"),

				'Date'=>date("Y-m-d H:i:s"),

				'Status'=>'1'

			);



			$insert_id=$this->ContactModel->SaveNewContact($data);



			if($insert_id!="")

			{



				$arr = array('status' => 1, 'insert_id' => $insert_id, 'tot_address' =>$totAddressCont, 'tot_phone' =>$totPhoneCont); 

				

				//insert Adrress

				for($i=1;$i<=$totAddressCont;$i++)

				{



					$data = array(

						'Country'  =>$this->input->post('Country'.$i),

						'Street'  => $this->input->post('Street1_'.$i),

						'Street2'  =>$this->input->post('Street2_'.$i),

						'City'      =>$this->input->post('City'.$i),

						'State'     =>$this->input->post('State'.$i),

						'ZipCode'   =>$this->input->post('ZipCode'.$i),

						'Contact'   =>$insert_id

					);

					

					

					$address_id=$this->ContactModel->SaveNewAddress($data);

					

				}

				

				//insert Phone

				for($i=1;$i<=$totPhoneCont;$i++)

				{

					

					if($this->input->post('Phone'.$i)!="")

					{

						$data = array(

							'Phone'    =>$this->input->post('Phone'.$i),

							'Ext'      => $this->input->post('Ext'.$i),

							'Contact'  =>$insert_id,

							'Status'   =>'1'	

						);

						

						$phone_id=$this->ContactModel->SaveNewPhone($data);

					}	

					

				}

				

				//insert Email

				for($i=1;$i<=$totEmailCont;$i++)

				{

					

					if($this->input->post('Email'.$i)!="")

					{

						$data = array(

							'Email'    => $this->input->post('Email'.$i),

							'Contact'  => $insert_id,

							'Status'   =>'1' 

						);

						

						$phone_id=$this->ContactModel->SaveNewEmail($data);

						

					}	

					

				}

				

				//insert WEBSITE

				for($i=1;$i<=$totWebsiteCont;$i++)

				{

					

					if($this->input->post('Website'.$i)!="")

					{

						

						$data = array(

							'Website'    => $this->input->post('Website'.$i),

							'Contact'    => $insert_id 

						);

						

						$phone_id=$this->ContactModel->SaveNewWebsite($data);

						

					}

				}



				$groupID=$this->input->post("groupID");

				

				if(count($groupID)>0)

				{

					

					foreach ($groupID AS $key => $Group)

					{

						

						//check if exist in group

						$ContCheck=$this->ContactModel->CheckContactInGroup($insert_id, $Group);

						if(count($ContCheck)<1){

							$insertG_id = $this->ContactModel->AddContactInGroup($insert_id, $Group);

						}



					}

					

				}

				

			}else{



				$arr = array('status' => 0, 'insert_id' => 'false'); 



			}

			

		}

		

		//DEFINE OUT

		IF($status=="error"){

			

			$data["Wmessage"]="Something Wrong!, Contact Thenical support";

			file_put_contents('./log_'.date("j.n.Y").'.txt', "Something Wrong When Core try to write data", FILE_APPEND);

			

			$data['totAddressCont'] =$totAddressCont;

			$data['totPhoneCont']   =$totPhoneCont;

			$data['totEmailCont']   =$totEmailCont;

			$data['totWebsiteCont'] =$totWebsiteCont;

			

			//$data['paisR']=$totWebsiteCont;

			

			$data['Groups']   =$this->UserModel->GetListFrom("ml_us_groups");

			$data['Attorneys']   = $this->UserModel->Attorney(); 

			$data['Countries']=$this->UserModel->GetListFrom("ml_co_country");



			$this->load->view('Contacts/NewContactAjax',$data);

			

			

		}else{

			$name=$this->input->post('Name')." ".$this->input->post('LastName')." ".$this->input->post('Middle')." ".$this->input->post('Suffix');

			echo "ok,".$name.",".$insert_id;

		}

	   		//add the header here

	    	//header('Content-Type: application/json');

	    	//echo json_encode($arr);

		

	}

	

	public function loadRelContForm(){



		$this->load->view("Contacts/newRelContact"); 

		

	}



	public function atachTo(){



		



		$this->load->view("task/relMatterOrContact",$data); 

		

	}



	public function StaffAdd(){

		

		$id=$this->input->post('Staff');

		

		$matterAct=$this->session->userdata("IDMatterActual");

		

		//CHECK IF atorney exist

		

		

		

		$data=array(

			'IdUser'=>$id,

			'IdMatter'=>$matterAct,

			'Creator'=>$this->session->userdata("Id"),

			'Date'=>date('Y-m-d h:i:s')

		);

		

		

		

		$total=$this->MatterModel->getOneRelatedStaff(array('IdUser'=>$id, 'IdMatter'=>$matterAct));	

		

		if(count($total)<1){

			

			$result = $this->MatterModel->saveStafRelated($data);

		}

		

		echo count($total);

		

		

	}

	

	public function StaffRemove(){

		

		$id=$this->input->post('Staff');



		$result = $this->MatterModel->deleteStaff($this->session->userdata("IDMatterActual"), $id);



	}

	

	public function  ToGroup($oper){

		

		

		

		$contactItem=$this->input->post("ItemID");

		$GroupItem=$this->input->post("GroupItem");

		

		if(count($GroupItem)>0 AND count($contactItem)>0){

			

			

			foreach ($GroupItem AS $key => $Group)

			{

				foreach ($contactItem AS $key => $Contact)

				{

					

					//check if exist in group

					$ContCheck=$this->ContactModel->CheckContactInGroup($Contact,$Group);

					

					if(count($ContCheck)<1){

						

						if($oper==1){

							

							$insert_id = $this->ContactModel->AddContactInGroup($Contact,$Group);

						}	

					}

					

					if($oper==2)

					{

						$insert_id = $this->ContactModel->RemContactInGroup($Contact,$Group);

						

					}



				}

			}

			

			if($insert_id>0){

				echo 1;

			}elseif($insert_id<1){

				echo 0;	

			}

			

			

			

		}else{

			echo 3;

		}



	}

	

	

	

	

	public function loadRelMattForm(){

		

		$data["relatedMatter"]=$this->MatterModel->relatedMatter($this->session->userdata("IDMatterActual"));

		$this->load->view("Matters/newRelMatter",$data); 

		

	}

	

	public function MatterRelRemove(){

		

		$IdMatter2=$this->input->post('IdMatter2');



		$result = $this->MatterModel->deleteRelMatter($this->session->userdata("IDMatterActual"), $IdMatter2);

		

		if ($result>1){

			echo 1;

		}



	}

	

	function SearchRelMatter(){

		

		$criteria=$this->input->post("IdMatter");

		$result=$this->MatterModel->searhMatter($criteria);

		

		foreach ($result as $row)

		{

			

			$id=$row->Id;

			$Name=substr($row->Name,0,25);

			$ResultBox='MatterResult';

			

			echo '<li><a onclick="addFieldMatter(\''.$id.'\',\' '.$Name.'\',\''.$ResultBox.'\' )">'.$Name.'</a></li>';

			

		}

		

	}



	function MatterRelToInvoice(){

		

		$criteria=$this->input->post("Criteria");

		$result=$this->MatterModel->searhMatter($criteria);

		

		foreach ($result as $row)

		{

			

			$id=$row->Id;

			$Name=substr($row->Name,0,25);

			

			

			echo '<li><a href="'.base_app().'Billing/setCriterioInvoices/'.$id.'/'.str_ireplace(",", "_", $Name).'">'.$Name.'</a></li>';



			

		}

		

	}







	

	function ContIndividualField(){

		

		$this->load->view("Contacts/individualContactFields");

	}













	function deleteAtach($id,$tipo,$task){



		if($id!=""){

			$this->TaskModel->deleteAtach($id,$tipo,$task);

		}else{

			echo "error";

		}	



	}	







	

	function TaskNew(){



		if($this->input->post('IdMatter')!=""){

			$data["AddActualMatter"]="si";

			$data["actualMatter"]=$this->MatterModel->getOne($this->input->post('IdMatter'));



		}

		

		

		$data["priority"]=$this->TaskModel->listFromTable("ml_ta_priority");

		$data["status"]=$this->TaskModel->listFromTable("ml_ta_status");

		$data["category"]=$this->TaskModel->listFromTable("ml_ta_category");

		$data["Attorney"]=$this->UserModel->activeAttorney();

		

		

		

		

		$this->load->view("Task/NewTaskAjax",$data);

	}



	function TaskDetail($id){



		if($this->input->post('IdMatter')!=""){

			$data["AddActualMatter"]="si";

			$data["actualMatter"]=$this->MatterModel->getOne($this->input->post('IdMatter'));



		}

		

		

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









		

		

		

		

		

		

		

		$this->load->view("Task/detailTaskAjax",$data);

	}





	function TaskSaveNew(){



		$status="";

		$mensaje='<span class="red" >';

		

		

		

		

		$this->load->library('form_validation');



		$this->form_validation->set_rules('Subject', 'Subject', 'required|trim');

		$this->form_validation->set_rules('StartTime', 'StartTime', 'required|trim');

		$this->form_validation->set_rules('EndTime',    'EndTime',  'required|trim');





		$starTime=$this->input->post('StartTime');

		$endTime =$this->input->post('EndTime');



		if($starTime!="" AND $endTime!="") {



			if(strtotime($starTime)>strtotime($endTime)){

				$status="error";

				$mensaje.=' Start Time shoud be minor to End time';

			}



		}





		if($this->form_validation->run() == FALSE)

		{

			$status="error";

		}



		if($status=="")

		{

			



			$data = array(

				'Name'=>$this->input->post('Name'),

				'StartDate'=>encodedate($starTime),

				'DueDate'=>encodedate($endTime),

				'Subject'=>$this->input->post('Subject'),

				'Priority'=>$this->input->post('Priority'),

				'Status'=>$this->input->post('Status'),

				'Category'=>$this->input->post('Category'),

				'EstimatedHours'=>$this->input->post('EstimatedTime'),

				'Staff'=>$this->input->post('Staff'),

				'Date'=>date('Y-m-d H:i:s'),

				'Creator'=>$this->session->userdata('Id'),

				'Description'=>$this->input->post('Description'),

				'AssignTo'=>$this->input->post('Assign')

				

			);



			



			$insert_id=$this->TaskModel->SaveNewTask($data);



			if($insert_id!="")

			{



				//insert other staff list

				

				$fromList=$this->input->post('ContMAtter_A');

				

				//print_r($fromList);

				

				if (count($fromList)>0)

				{

					foreach ($fromList AS $key => $val)

					{

						$objeto=explode("_",$val);



						$data=array(

							'Task'=>$insert_id,

							'IdObject  '=>$objeto[0],

							'TypeObject'=>$objeto[1],

							'Creator'=>$this->session->userdata("Id"),

							'Date'=>date('Y-m-d H:i:s')

						);





						$total=$this->TaskModel->InsertAtach($data);	

						

					}

				}



				$this->load->helper("SendMail");



				$userDB=$this->SecureModel->get('ml_us_users', " AND Id='".$this->input->post('Assign')."'  ");



				//echo $userDB->Email.'<br>';



				if($userDB->Email!=""){



					$content ="<h2>Se te ha asignado una nueva tarea</h2>";



					$content.= $this->session->userdata('Name').' '.$this->session->userdata('LastName').' te ha asignado una nueva tarea en '.base_url();

					$content.="<br>Fecha de inicio: ".$starTime;

					$content.="<br>Fecha de finalización: ".$endTime;

					$content.="<br>Descripción: ".$this->input->post('Description')."<br><br><br>";



					$content.='<br>Para más detalles de click en el siguiente enlace: ';

					$content.='<a href="'.base_app().'Task/TaskDetail/'.$insert_id.'">'.base_app().'Task/TaskDetail/'.$insert_id.'</a><br><br>';



					$img_empresa = $this->AdminModel->get_url();



					$content.='<br><img src="'.$img_empresa->url.'"<br>';

					$content.='<br><a href="'.base_url().'">MiraTask.com</a>';







					SendMail($userDB->Email,$content,"Tienes una nueva tarea");



				}





				









			}

			

		}

		

		//DEFINE OUT

		IF($status=="error"){

			

			$mensaje.="</span>";

			echo $mensaje;

			echo validation_errors('<span class="error">', '</span>'); 

			

		}else{

			

			echo "ok";

		}

	   		//add the header here

	    	//header('Content-Type: application/json');

	    	//echo json_encode($arr);

		

		

	}



	public function  AtachTaskList(){

		

		

		

		$taskList=$this->input->post("ItemID");

		$ContacORmatterList=$this->input->post("ContMAtterAtach");

		

		if(count($ContacORmatterList)>0 AND count($taskList)>0){

			

			

			foreach ($ContacORmatterList AS $key => $CoMa)

			{



				$objeto=explode("_",$CoMa);





				foreach ($taskList AS $key => $task)

				{



					//check if exist in group

					$ContCheck=$this->TaskModel->CheckCoMa($objeto[2],$task,$objeto[0]);





					$data=array(

						'Task'=>$task,

						'IdObject  '=>$objeto[0],

						'TypeObject'=>$objeto[1],

						'Creator'=>$this->session->userdata("Id"),

						'Date'=>date('Y-m-d H:i:s')

					);





					

					if(count($ContCheck)<1){

						

						$insert_id=$this->TaskModel->InsertAtach($data);

						

					}

					

					

				}

			}

			

			if($insert_id>0){

				echo 1;

			}elseif($insert_id<1){

				echo 0;	

			}

			

			

			

		}else{

			echo 3;

		}



	}



	function completedTask(){



		$id=$this->input->post("IdTask");



		if($id==""){



			$message='<span class="red">No task selected!</span>';

			

			$this->session->set_userdata('message', $message);



			

			



		}







		$resul=$this->TaskModel->MarkCompleted($id);



		if($resul=="success"){



			$message='<span class="green">Task has Marked complete !</span>';

			

			$this->session->set_userdata('message', $message);



		}else{

			$message='<span class="red">Something Wrong , contact Thenical support!</span>'.$resul.' id: '.$id;

			

			$this->session->set_userdata('message', $message);

		}



		$this->TaskDetail($id);



	}



	function updateTask($id){





		if($id==""){



			$message='<span class="red">No task selected!</span>';

			$this->session->set_userdata('Wmessage', $message);



		}





		$status="";

		$mensaje='<span class="red" >';



		$this->load->library('form_validation');



		$this->form_validation->set_rules('Subject', 'Subject', 'required|trim');

		$this->form_validation->set_rules('StartTime', 'StartTime', 'required|trim');

		$this->form_validation->set_rules('EndTime',    'EndTime',  'required|trim');





		$starTime=$this->input->post('StartTime');

		$endTime =$this->input->post('EndTime');



		if($starTime!="" AND $endTime!="") {



			if(strtotime($starTime)>strtotime($endTime)){

				$status="error";

				$mensaje.=' Start Time shoud be minor to End time';

			}



		}



		if($this->form_validation->run() == FALSE)

		{

			$status="error";

		}



		if($status=="")

		{

			

			$data = array(

				'Name'=>$this->input->post('Name'),

				'StartDate'=>encodedate($this->input->post('StartTime')),

				'DueDate'=>encodedate($this->input->post('EndTime')),

				'Subject'=>$this->input->post('Subject'),

				'Priority'=>$this->input->post('Priority'),

				'Status'=>$this->input->post('Status'),

				'Category'=>$this->input->post('Category'),

				'EstimatedHours'=>$this->input->post('EstimatedTime'),

				'Staff'=>$this->input->post('Staff'),

				'Updated'=>date('Y-m-d H:i:s'),

				'Editor'=>$this->session->userdata('Id'),

				'Description'=>$this->input->post('Description'),

				'AssignTo'=>$this->input->post('Assign')

				

			);



			

			$insert_id=$this->TaskModel->Update($data,$id);



			if($insert_id<1){



				$status="error";



			}

			



			//insert other staff list

			

			$fromList=$this->input->post('ContMAtter_A');

			

			//print_r($fromList);

			

			if (count($fromList)>0)

			{

				foreach ($fromList AS $key => $val)

				{

					$objeto=explode("_",$val);



					$data=array(

						'Task'=>$id,

						'IdObject  '=>$objeto[0],

						'TypeObject'=>$objeto[1],

						'Creator'=>$this->session->userdata("Id"),

						'Date'=>date('Y-m-d H:i:s')

					);



					//check if exist

					$exist=$this->TaskModel->CheckCoMa($objeto[1],$id, $objeto[0]);



					if(count($exist)>0){

						

						$total=$this->TaskModel->InsertAtach($data);	

						

					}



					

				}

			}

			



			

			

		}

		

		//DEFINE OUT

		IF($status=="error"){

			

			$mensaje.="</span>";

			echo $mensaje;

			echo validation_errors('<span class="error">', '</span>'); 

			

		}else{

			

			echo "ok";

		}

	   		//add the header here

	    	//header('Content-Type: application/json');

	    	//echo json_encode($arr);

		

		

	}





	function deleteTask(){



		IF($this->input->post('id_task')!=''){

			

			$this->TaskModel->deleteTask($this->input->post('id_task'));



			echo "1";

			

		}else{

			

			echo "0";

		}



	}



	function completeTask(){

		IF($this->input->post('id_task')!=''){

			

			$this->TaskModel->MarkCompleted($this->input->post('id_task'));



			echo "1";

			

		}else{

			

			echo "0";

		}

	}





	function Search()

	{

		$criteria = $this->input->post("Criteria");

		$result   = $this->MatterModel->search($criteria);

		

		foreach ($result as $row)

		{

			

			if($row->Object=="note"){



				$label="to the matter";

				$img="recentactv.png";

				$enlace=' href="'.base_app().'Matters/Details/'.$row->Id.'?tab=notes" ';



				



			}elseif($row->Object=="matter"){



				$label="";

				$img="matters_blue.png";

				$enlace=' href="'.base_app().'Matters/Details/'.$row->Id.'" ';

				

			}elseif($row->Object=="contact"){

				

				$label="to the matter";

				$img="contact_group.png";

				$enlace=' onclick="atachTo(\'AjaxContact/details/'.$row->Id.'\')" ';



			}elseif($row->Object=="doc"){

				$ruta=$this->MatterModel->ruta($row->Id)[0]->FisicalDir;



				if(substr($ruta,0,1)==".")

					$route= $ruta;

				else

					$route= 'docsxup/';





				$label="";

				$img="Document_blue.png";

				$enlace='target="_blank" href="'.base_url().$route.$row->titulo.'" ';



				



			}elseif($row->Object=="task"){

				

				$label="";

				$img="task.png";

				$enlace=' onclick="detailTask(\''.$row->Id.'\')" ';   



			}elseif($row->Object=="event"){

				

				$label="";

				$img="recentActivity.png";

				$enlace=' onclick="loadEvent(\''.$row->Id.'\')" ';  



			}elseif($row->Object=="Time and expense"){

				

				$label="";

				$img="Billing_blue.png";

				$enlace=' onclick="add_entry_g(\'0\',\''.$row->Id.'\')" ';       



			}else{



				$label="";

				$img="";

			}

			$titulo_cal=$row->titulo;

                    //$titulo=$row->titulo;

			if($row->Object=="Time and expense"){

				$titulo_cal=substr(strip_tags ($row->titulo),0,100);

                        //$titulo_cal=strip_tags($row->titulo);

			}else{

				$titulo_cal=strip_tags($row->titulo);

			}

			

			$titulo_cal=str_replace($criteria,'<span class="resaltado">'.$criteria.'</div>',$titulo_cal);

			

                    //$titulo_cal=preg_replace("/(".$criteria.")i/",'<span class="resaltado">'.$criteria.'</div>',$titulo_cal);        

			

			echo '

			<a '.$enlace.' >

			<div class="icon"> <img src="'.base_url().'img/'.$img.'"></div> 

			<div class="desc"> '.$titulo_cal.' </div> 

			<div class="clearh1"></div>    

			</a>

			

			';

			

		}

	}





	function MarkClosedMatter(){



		$status="";



		$IdMatter= $this->session->userdata("IDMatterActual");



		if($IdMatter==""){

			

			$mensaje='<span class="red"> Not selected MAtter </span>';

			

			$status="error";



		}



		



		$this->form_validation->set_rules('CloseOn', 'Date Closed',  'required|trim'); 

		$this->form_validation->set_rules('comments','Comments',     'required|trim'); 

		

		

		

		if($this->form_validation->run() == FALSE)

		{

			$status="error";

			

		}



		if($status==""){



			$data=array('Status'=>'4',  

				'DateClosed'=>$this->input->post("CloseOn"),

				'Comments'=>$this->input->post("comments")

			);

			

			$lastSaveRel=$this->MatterModel->Update($data,$IdMatter);

			

			if($lastSaveRel!=""){

				

				echo 1;



			}else{

				

				$status="error";

				$mensaje.='<span class="red"> Not Saved Something Wrong </span>';





			}



		}



		if($status=="error"){



			

			echo $mensaje;

			echo validation_errors('<span class="error">', '</span>'); 

		}

		

	}





	function BorrarNota($id_nota){



		$aff=$this->SecureModel->delete('ml_ma_notes',array('Id'=>$id_nota));



		if($aff>0){

			echo 1;

		}



	}















}



?>