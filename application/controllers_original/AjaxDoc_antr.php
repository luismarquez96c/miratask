<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxDoc extends CI_Controller {
	function  __construct(){
	 	parent:: __construct();

	 	if($this->session->userdata('Email')==""){ redirect("Login"); }
	  	$this->load->model('SecureModel');
	  	$this->load->model('ContactModel');
	  	$this->load->model('UserModel');
		$this->load->model('MatterModel');
		$this->load->model('DocumentModel');

	}

 

	function newFolder(){
		$this->load->view("Document/newFolder");
	}   


	public function SaveNewFolder(){
		
		$status="";
		
		 
		
		//echo "total de otros contactos ".$this->input->post('othersContacts');
		
		//VALIDATION
		$this->load->library('form_validation');
		$this->form_validation->set_rules('FolderName','Folder Name','required|min_length[3]|trim|is_unique[ml_do_folders.Name]');

		
         
		
		if($this->form_validation->run() == FALSE)
		{
			$status="error";
		}
		//END VALIDATION
		
 
		
		//CORE
		if($status==""){
			
			$data = array(
				'Name'              =>$this->input->post('FolderName'),
				'Parent'            => '0',
				'Date'              =>date('Y-m-d H:i:s'),
				'Creator'           =>$this->session->userdata("Id")
			 );

			$insert_id=$this->DocumentModel->SaveNew("ml_do_folders", $data);

			if($insert_id>0){

				echo '1';

			}else if($insert_id<1){

				$status="error";

			}
				
		}else{
			$status="error";
		}
		 
		//FIN CORE
		
		
		//DEFINE OUT
		IF($status=="error"){
			echo '0';
			$this->load->view("Document/newFolder");
			 
		}
		
		 

	}//fin save new()
	

	function newDocument($IdMatter=""){

		$this->session->set_userdata("folderActual",'1');
		$this->session->set_userdata("quiidFiledata", array());

		$data['Folders']=$this->DocumentModel->listFromTable("ml_do_folders");
		$data['actualMatter']=$IdMatter;

		$this->load->view("Document/newDocument",$data);
	}   

	function  DocumentDetails($idDocument=""){

		if($idDocument!=""){

			 
			$this->session->set_userdata("quiidFiledata", array($idDocument=>$idDocument));



			$data['Folders']=$this->DocumentModel->listFromTable("ml_do_folders");

			$data['Document'] =$this->DocumentModel->getOne($idDocument);
			$data['relations']=$this->DocumentModel->getCoMa($idDocument);


			$this->load->view("Document/DocumentDetails",$data);

		}

		
	}   

	

	function setFolderAct(){

		$this->session->set_userdata("folderActual",$this->input->post("ActualFol"));
	} 


	function  upload($folder="1"){



		//tomo el valor de un elemento de tipo texto del formulario
		//$cadenatexto = $_POST["cadenatexto"];
		//echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>";

		$config['upload_path']          = './docsxup/';
        $config['allowed_types']        = 'docx|doc|pdf|application/octet-stream|application/pdf|jpg|jpeg|png|PNG|JPG|JPEG|MP4|AVI|WEBM|3GP|GIF|WMV|MKV|MPG|MPEG|VOB|MOV|FLV|SWF|mp4|avi|web|3gp|gif|wmv|mkv|mpeg|mpg|vob|mov|flv|swf';
        $config['max_size']             = 900000;
        $config['remove_spaces' ]       = false;

         
        $this->load->helper("cleanvars");
         
        if($this->session->userdata("folderActual")==""){
			$this->session->set_userdata("folderActual","1");
		}

        $NameFile     = $_FILES["qqfile"]["name"]=addslashes(cleanvars(html_escape($_FILES["qqfile"]["name"])));
        $folderActual = $this->session->userdata("folderActual");
        

        print_r($_FILES["qqfile"]);
        echo '<br> name file '. $NameFile;

        
       

        //Array
		//(
		//    [name] => Datos de recomendacion.docx
		//    [type] => application/octet-stream
		//    [tmp_name] => C:\xampp\tmp\php7CBE.tmp
		//    [error] => 0
		//    [size] => 11728
		//) 

        if(!file_exists('./docsxup/'.$NameFile)){

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('qqfile'))
	        {
	                $error = array('error' => $this->upload->display_errors());

	                //print_r($error);

	                echo '{"success":false, "error": "File not upload!" }';

	                 
	        }
	        else
	        {
	        		 //print_r($this->upload->data());

	        		$filedata=$this->upload->data();
	        		$ext=$filedata['file_ext'];
	                $data = array(

	                /*We comprove again, may be codeigneter are replaced white spaces of file name*/	

	                //if(file_exists('./docsxup/'.$filedata['file_name'],)){
	                //	echo '{"success": false, "error": "The File already exists!" }';
	                //}else{

		                'FileName'=>$filedata['file_name'],
						'Type'=>$ext,
						'Folder'=>$folderActual,
						'Date'=>date("Y-m-d H:i:s"),
						'Creator'=>$this->session->userdata("Id"),
						'FisicalDir'=>"/docsxup/".$NameFile,
						'Category'=>'0',
						'Description'=>'',
						'Status'=>'1'
						 );

		                $las_id=$this->DocumentModel->SaveNew("ml_do_documents",$data);

		                //this id of all doc save, will be used for end to edit Description and atached Matter of all documents of this upload
		                //$docSession = $this->session->userdata("docSession");
		                //$docSession[$las_id] = $las_id;
		                //$this->session->set_userdata("docSession", $docSession);


		                //echo "quiid : ".$this->input->post('qquuid');
				        //this is id requested by fine-upload  when it send file and data
				        //we save this id in session for make delete inn method delete after
				        //more documetation about Fine-Upload here: https://docs.fineuploader.com/branch/master/features/delete.html

				        $quiidFiledata=$this->session->userdata("quiidFiledata");
				        $quiidFiledata[$this->input->post('qquuid')]=$las_id;
				        $this->session->set_userdata("quiidFiledata", $quiidFiledata);



		                if($las_id>0){

		                	$matterAct=$this->session->userdata("IDMatterActual");

		                	 if($matterAct!=""){
		                	 	
		                	 	 

		                	 	$data2=array(
									'Document'=>$las_id,
									'IdObject  '=>$matterAct,
									'TypeObject'=>'matter',
									'Creator'=>$this->session->userdata("Id"),
									'Date'=>date('Y-m-d H:i:s')
							 	);

								$insert_id=$this->DocumentModel->InsertAtach($data2);
							}	
		                	 

		                }


		                echo '{"success":true}';
	            	//}

	                 
	        }
        }else{
        	echo '{"success": false, "error": "File already exists!" }';
        }




		
	}

	public function atachTo(){

		 

		$this->load->view("Document/relMatterOrContact",$data); 
			
	}


	public function  AtachList(){
		
		
		
		$docList=$this->input->post("ItemID");
		$ContacORmatterList=$this->input->post("ContMAtterAtach");
		
		if(count($ContacORmatterList)>0 AND count($docList)>0){
			
			
			foreach ($ContacORmatterList AS $key => $CoMa)
			{

				$objeto=explode("_",$CoMa);


				foreach ($docList AS $key => $doc)
				{

					//check if exist in group
					$ContCheck=$this->DocumentModel->CheckCoMa($objeto[2],$doc,$objeto[0]);


					$data=array(
							'Document'=>$doc,
							'IdObject  '=>$objeto[0],
							'TypeObject'=>$objeto[1],
							'Creator'=>$this->session->userdata("Id"),
							'Date'=>date('Y-m-d H:i:s')
						 );


					
					if(count($ContCheck)<1){
						
						$insert_id=$this->DocumentModel->InsertAtach($data);
							
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



	public function MoveTo(){

		$data['Folders']=$this->DocumentModel->listFromTable("ml_do_folders");

		$this->load->view("Document/MoveToFolder",$data); 
			
	}


	function saveDetailOfDocuments(){

		//get the session documents
		$docSession = $this->session->userdata("quiidFiledata");

	    if(count($docSession)>0){

	     	foreach ($docSession as $key => $doc) {

	     		$folder=$this->input->post('Folder');

	     		if($folder==""){
	     			$folder=$this->session->userdata("folderActual");
	     		}


	     		$data = array(

	                'Description'=>$this->input->post('Description'),
					'Folder'=>$folder
					 );

	     		$las_id=$this->DocumentModel->update($data, array('Id' =>$doc), 'ml_do_documents');

	     		$ContMAtter_A=$this->input->post("ContMAtter_A");

	     		if(count($ContMAtter_A)>0){

	     			foreach ($ContMAtter_A as $key => $CoMa) {

	     				//echo "<br>valor del atacch.".$CoMa;

	     				$objeto=explode("_",$CoMa);

	     				//check if exist in group
						$ContCheck=$this->DocumentModel->CheckCoMa($objeto[1],$doc,$objeto[0]);

						if(count($ContCheck)<1){

							$dataR=array(
								'Document'=>$doc,
								'IdObject  '=>$objeto[0],
								'TypeObject'=>$objeto[1],
								'Creator'=>$this->session->userdata("Id"),
								'Date'=>date('Y-m-d H:i:s')
							 );
							
							$insert_id=$this->DocumentModel->InsertAtach($dataR);	
						}

	     			}

	     		} 

	            

	     	}

	     	$this->session->set_userdata("quiidFiledata", array());

	     	echo 1;


	    }else{
	     	 
	     	echo '<span class="red">No data Saved, may be you did not upload any file';
	    }

	}

	function ConsultDocInsess(){

		$docSession = $this->session->userdata("docSession");

	    if(count($docSession)>0){
	    	print_r($docSession);
	    }

	    echo "<br><br> qui de documentos <br>";

	    print_r($this->session->userdata("quiidFiledata"));

	}

	function delete(){
 
		$quiidSES=$this->session->userdata("quiidFiledata");
		$quiidDocument=$this->input->post('qquuid');
		$IdDoc=$quiidSES[$quiidDocument];

		$result=$this->DocumentModel->deleteOne($IdDoc);


		if($result=="success"){

		

			//this id of all doc save, will be used for end to edit Description and atached Matter of all documents of this upload
	        //$docSession = $this->session->userdata("docSession");
	        //unset($docSession[$IdDoc]);
	        //$this->session->set_userdata("docSession", $docSession);


	        //echo "quiid : ".$this->input->post('qquuid');
	        //this is id requested by fine-upload  when it send file and data
	        //we save this id in session for make delete inn method delete after
	        //more documetation about Fine-Upload here: https://docs.fineuploader.com/branch/master/features/delete.html

	        $quiidFiledata=$this->session->userdata("quiidFiledata");
	        unset($quiidFiledata[$quiidDocument]);

	        $this->session->set_userdata("quiidFiledata", $quiidFiledata); 
        }

	}

	function deleteAtach($id,$tipo,$doc){

		if($id!=""){
			$this->DocumentModel->deleteAtach($id,$tipo,$doc);
		}else{
			echo "error";
		}	

	}	

	public function loadRelDocForm(){

		
		$this->load->view("Document/newRelDocument"); 
			
	}

	function showDocList()
	{
		$criteria = $this->input->post("Document");
		$result   = $this->DocumentModel->SelectLike($criteria);
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
			$Name=$row->FileName; 
			
			 
			 
			//al hacer click en el item de la lista desplegada 
			//setfiled()   llenara el hidden y el textbox en el archivo util.js
			echo '<li><a onclick="addFieldDoc(\''.$id.'\',\' '.$Name.'\' )">'.$Name.'</a></li>';
		               
		}
	}

	function saveRelDoc(){

		$Reldoc=$this->input->post("RelDoc");

 		if(count($Reldoc)>0){

 			foreach ($Reldoc as $key => $doc) {

 				//check if exist in group
				$ContCheck=$this->DocumentModel->CheckCoMa('matter',$doc,$this->session->userdata("IDMatterActual"));

				if(count($ContCheck)<1){

					$dataR=array(
						'Document'=>$doc,
						'IdObject  '=>$this->session->userdata("IDMatterActual"),
						'TypeObject'=>'matter',
						'Creator'=>$this->session->userdata("Id"),
						'Date'=>date('Y-m-d H:i:s')
					 );
					
					$insert_id=$this->DocumentModel->InsertAtach($dataR);	
				}

 			}

 			echo 1;

 			 

			 
			 

 		}else{
 			echo '<span class="red">No selected Documents</span>';
 		} 

	}




}

?>
