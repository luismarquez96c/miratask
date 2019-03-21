<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class AjaxContact extends CI_Controller {

	function  __construct(){

		parent:: __construct();



		if($this->session->userdata('Email')==""){ redirect("Login"); }

		$this->load->model('SecureModel');

		$this->load->model('ContactModel');

		$this->load->model('UserModel');

		$this->load->model('MatterModel');

		$this->load->model('TaskModel');

		$this->load->model('BillingModel','billing');

		$this->load->helper('cookie');



	}





	function details($IdContact){



		$status="";



		if($IdContact==""){

			

			$mensaje='<span class="red"> Not selected Contact </span>';

			

			$status="error";



		}elseif($IdContact!=""){



			$data['address']       = $this->ContactModel->get_table('ml_co_address',array('Contact'=>$IdContact));

			$data['phones']        = $this->ContactModel->get_table('ml_co_phone',  array('Contact'=>$IdContact));

			$data['emails']        = $this->ContactModel->get_table('ml_co_email',  array('Contact'=>$IdContact));

			$data['websites']      = $this->ContactModel->get_table('ml_co_website',array('Contact'=>$IdContact));

			

			$data['totAddressCont'] = count($data['address']);

			$data['totPhoneCont']=    count($data['phones']);

			$data['totEmailCont']=    count($data['emails']);

			$data['totWebsiteCont']=  count($data['websites']);

			

			$data['Groups']   	 = $this->UserModel->GetListFrom("ml_us_groups");

			$data['Attorneys']   = $this->UserModel->Attorney(); 

			$data['Countries']   = $this->UserModel->GetListFrom("ml_co_country", " " );



			$data['oneContact']  = $this->ContactModel->oneContact($IdContact);

			$data['attorney']    = $this->UserModel->GetAttorney($data['oneContact']->Owner);



			$this->load->view('Contacts/DetailsContactAjax',$data);



		}



		

	}



	function AddBorr(){



		$data = array(

			'Country'  =>'',

			'Street'  => '',

			'Street2'  =>'',

			'City'      =>'',

			'State'     =>'',

			'ZipCode'   =>'',

			'Contact'   =>$this->input->post("Contact")

		);

		

		

		$address_id=$this->ContactModel->SaveNewAddress($data);



		echo $address_id;

	}



	



	function AddBorrPhone(){



		$data = array(

			'Phone'    =>'',

			'Ext'      => '',

			'Contact'  =>$this->input->post("Contact"),

			'Status'   =>'1'	

		);

		

		$phone_id=$this->ContactModel->SaveNewPhone($data);



		echo $phone_id;

	}





	function AddBorrEmail(){



		$data = array(

			'Email'    => '',

			'Contact'  => $this->input->post("Contact"),

			'Status'   =>'1' 

		);

		

		$email_id=$this->ContactModel->SaveNewEmail($data);



		echo $email_id;



	}



	function AddBorrWebsite(){



		$data = array(

			'Website'    => '',

			'Contact'    => $this->input->post("Contact")

		);

		

		$website_id = $this->ContactModel->SaveNewWebsite($data);



		echo $website_id;



	}







	function Update(){

		

		$status="";

		$contactoAct=$this->input->post("Contacto");

		

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

				//$this->form_validation->set_rules('Website'.$i, 'Website '.$i, 'required|valid_url_format');

			}

		}

		



		if($this->form_validation->run() == FALSE)

		{

			$status="error";

		}



		if($status=="")

		{

			

			//change date format

			if ($this->input->post('Birdate')!="12-10-1969") {

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



			$insert_id=$this->ContactModel->update($data,array('Id' => $contactoAct ),'ml_co_contact');



			if($insert_id=="")

			{



				$arr = array('status' => 0, 'insert_id' => 'false'); 



			}	



			//$arr = array('status' => 1, 'insert_id' => $insert_id, 'tot_address' =>$totAddressCont, 'tot_phone' =>$totPhoneCont); 

			

			//insert Adrress

			for($i=1;$i<=$totAddressCont;$i++)

			{

				$idAddress=$this->input->post('idAddress_'.$i);



				$data = array(

					'Country'  =>$this->input->post('Country'.$i),

					'Street'  => $this->input->post('Street1_'.$i),

					'Street2'  =>$this->input->post('Street2_'.$i),

					'City'      =>$this->input->post('City'.$i),

					'State'     =>$this->input->post('State'.$i),

					'ZipCode'   =>$this->input->post('ZipCode'.$i)

				);

				

				

				$address_id=$this->ContactModel->update($data,array('id' => $idAddress),'ml_co_address');



				if($address_id==""){   }

					

			}

		

			//insert Phone

		for($i=1;$i<=$totPhoneCont;$i++)

		{

			

			if($this->input->post('Phone'.$i)!="")

			{

				$idPhone=$this->input->post('idPhone_'.$i);



				$data = array(

					'Phone'    =>$this->input->post('Phone'.$i),

					'Ext'      => $this->input->post('Ext'.$i)	

				);

				

				$phone_id=$this->ContactModel->update($data,array('Id' => $idPhone),'ml_co_phone');

			}	

			

		}

		

			//insert Email

		for($i=1;$i<=$totEmailCont;$i++)

		{

			

			if($this->input->post('Email'.$i)!="")

			{

				$idEmail=$this->input->post('idEmail_'.$i);

				$data = array(

					'Email'    => $this->input->post('Email'.$i)

				);

				

				$email_id=$this->ContactModel->update($data,array('Id' => $idEmail),'ml_co_email');

				

			}	

			

		}

		

			//insert WEBSITE

		for($i=1;$i<=$totWebsiteCont;$i++)

		{

			

			if($this->input->post('Website'.$i)!="")

			{

				$idWebsite=$this->input->post('idWebsite_'.$i);



				$data = array(

					'Website'    => $this->input->post('Website'.$i)

				);

				

				$website_id=$this->ContactModel->update($data,array('Id' => $idWebsite),'ml_co_website');

				

			}

		}

		

		$goupID=$this->input->post("goupID");

		

		if(count($goupID)>0)

		{



			$this->ContactModel->RemAllContactInGroup($contactoAct);

			

			foreach ($goupID AS $key => $Group)

			{

				

					//check if exist in group

				$ContCheck=$this->ContactModel->CheckContactInGroup($contactoAct,$Group);

				

				if(count($ContCheck)<1){

					

					$insertG_id = $this->ContactModel->AddContactInGroup($contactoAct,$Group);

					

				}



			}

			

		}

		



		

		

	}

	

		//DEFINE OUT

	IF($status=="error"){

		

		echo validation_errors('<span class="error">', '</span>'); 

		

	}else{

		

		echo "ok";

	}

	   		//add the header here

	    	//header('Content-Type: application/json');

	    	//echo json_encode($arr);

	

}



}



?>