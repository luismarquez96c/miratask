<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_check extends CI_Controller {
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
	
	   
	function load_all_docs(){

		set_time_limit(0);

		$this->load->helper("util");

	   	$excel=ExcelGet("./tmp/docs.xlsx");
	   	$excel=$excel[0];
	   
	  	/* 7
	   	unset($excel[1]);
	   	echo "<pre>";
	   	print_r( $excel);
	   	echo "</pre>"; */

	   	

		foreach($excel as $i => $item){

			$Type = explode(".",trim($item["A"]));

			$extencion=".".array_pop($Type);
			
			 $row["FileName"]     = trim($item["A"]);
			$row["Type"]         = $extencion;
			$row["Folder"]       = "1";
			$row["Creator"]      = "1"; 
			$row["FisicalDir"]   = "/docsxup/".trim($item["A"]);
			$row["Category"]     = "1";
			$row["Description"]  = trim($item["B"]);
			$row["Status"]       = "1"; 

			$this->SecureModel->SaveNew('ml_do_documents',$row);
			$id=$this->db->insert_id();

			$row2["Document"]   = $id;
			$row2["IdObject"]   = $this->get_id_matter(trim($item["B"]));
			$row2["TypeObject"] = 'matter';
			$row2["Creator"]    = "1";

			$this->SecureModel->SaveNew('ml_do_atach',$row2);

			$DATA[]=$row;  

		}

		echo "</table>";
	}




	function get_id_matter($string){
		//$sql="select Id from ml_ma_matters WHERE Name like '%".$string."%'";

		//$string=explode(",",$string);

		//$sql="SELECT MA.Name, MA.Id FROM ml_ma_matters MA WHERE MA.Name LIKE '%".trim($string[0])."%' ";

		$sql="SELECT MA.Name, MA.Id FROM ml_ma_matters MA WHERE MA.Name LIKE '%".trim(str_replace("'","",$string))."%' ";

		$r=$this->db->query($sql)->row();

		return $r;
	}



	function corregir_docs(){

		set_time_limit(0);

		$this->load->helper("util");

	   	$excel=ExcelGet("./docctemp/Mira_Law_Firm_path_to_Matter.csv");
	   	$excel=$excel[0];
	   
	  	/* 7
	   	unset($excel[1]);
	   	echo "<pre>";
	   	print_r( $excel);
	   	echo "</pre>"; */

	   	 echo '<style>table td{ border:1px solid #CCC; font-family:arial; padding:0px 4px;} </style>';
	    echo '<table celspacing="0" celpadding="0" style="font-size:10px; border:1px solid #CCC;">';
	    echo '<tr>';
		echo  "<td>Cont</td>";
		echo  "<td>Doc_excel</td>";
		echo  "<td>MATTER_excel</td>";
		echo  "<td>IDdocDB</td>";
		echo  "<td>MATTER_ID</td>";
		echo  "<td>Matter afecc";
		echo  "<td>ID Correcto</td>";
		echo  "<td>Matter Correcto</td>";
		echo '</tr>';  

		$c=71;
		$d=1;
		foreach($excel as $i => $item){

			$MATTER_AFECTED='';

			 
			$id_doc_DB=$this->SecureModel->get('ml_do_documents'," AND FileName ='".trim(str_replace("'","\'",$item["A"]))."' ");

			if(count($id_doc_DB)>0){

				$id_ATACH=$this->SecureModel->getTabla('ml_do_atach'," AND Document = '".$id_doc_DB->Id."' AND TypeObject='matter' ");

				if(count($id_ATACH)>1){

					$stilo2='background:#c333cc;';  

					foreach ($id_ATACH as $att) {

						 $MAT_AFF=$this->SecureModel->get('ml_ma_matters'," AND Id = '".$att->IdObject."' ");
						 $MATTER_AFECTED.='<br>'.$MAT_AFF->Id.' - '.$MAT_AFF->Name;
						 $IDMATAFF=$MAT_AFF->Id;

						 if($att->IdObject==""){ 
						 	$atach_sin_id_matter[$d]=$att->Id;
						 }

					}
					

				}elseif(count($id_ATACH)==1){

					$MAT_AFF=$this->SecureModel->get('ml_ma_matters'," AND Id = '".$id_ATACH[0]->IdObject."' ");
					$MATTER_AFECTED.='<br>'.$MAT_AFF->Id.' - '.$MAT_AFF->Name;
					$IDMATAFF=$MAT_AFF->Id;

					$stilo2=''; 

				}elseif(count($id_ATACH)<1){
					$MATTER_AFECTED.='No encontrado';
					$IDMATAFF="";

					$stilo2=''; 
				}


			}else{

				$MATTER_AFECTED.='no Encontrado';
				$IDMATAFF="";

				$doc_no_found[$d] = $item["A"];

			}

			$Matter2=$this->get_id_matter($item["B"]); 

			if(!isset($Matter2->Id)){ 

				$nuevoName=explode("[", $item["B"]);

				$Matter2=$this->get_id_matter($nuevoName[0]);

			}

			if(!isset($Matter2->Id)){ 

				$nuevoName=explode("(", $item["B"]);

				$Matter2=$this->get_id_matter($nuevoName[0]);

			}

			$FinalMatterID=$Matter2->Id;

			if($IDMATAFF!=$FinalMatterID){ $stilo='background:#ffd4d4; color:red; '; }else{ $stilo='';  }

			if($FinalMatterID==""){ $FinalMatterID="x_x"; $matters_no_found[$d]=$item["B"]; } 

			 
			 echo  '<tr style="'.$stilo.'" >';
			echo  "<td>".$c."</td>";
			echo  "<td>".$item["A"]."</td>";
			echo  "<td>".$item["B"]."</td>";
			echo  "<td>".$id_doc_DB->Id."</td>";
			echo  "<td>".$IDMATAFF."</td>";
			echo  '<td style="'.$stilo2.'" >'.$MATTER_AFECTED.'</td>';
			echo  "<td>".$FinalMatterID."</td>";
			echo  "<td>".$Matter2->Name."</td>";   

			if($item["B"] =="NONE"){

				$MATTER_NONE[$d]='id_ATACH: - '.$c.' /';

			}

			
			if($stilo!=''){
				 if($FinalMatterID !="x_x"){
					//check if exist by Document, id mater, objeto matter

					if(isset($id_doc_DB->Id)){	


						//if not exist, make insert
						$checkExist=$this->SecureModel->get('ml_do_atach'," AND Document='".$id_doc_DB->Id."' AND IdObject='".$FinalMatterID."' AND TypeObject='matter' AND Id>'13009'  ORDER BY Id DESC ");

						if(count($checkExist)==0){

							//echo "<br> UPDATE ml_do_atach SET Document='".$id_doc_DB->Id."', IdObject='".$FinalMatterID."', TypeObject='matter' WHERE Id='".$c."'; ";
						
						}elseif(count($checkExist)>0){
							//echo "<br> UPDATE ml_do_atach SET Document='".$id_doc_DB->Id."', IdObject='".$FinalMatterID."', TypeObject='matter' WHERE Id='".$c."'; ";


							$docs_duplicados_en_matter[$d]='ATACH_ACT:'.$c.' - id_ATACH:'.$checkExist->Id.' - '.$checkExist->Document.'-IDMATTER: '.$checkExist->IdObject;


						}

					}							
				}
			}
			

			$c++;
			$d++;
		}

		 echo "</table>";
		echo '<br>Matter No encontrados:<br>';
		echo '<pre>';
		echo print_r($matters_no_found);
		echo '</pre>';

		echo '<br>atach_sin_id_matter:<br>';
		echo '<pre>';
		echo print_r($atach_sin_id_matter);
		echo '</pre>';

		echo '<br>doc_no_found:<br>';
		echo '<pre>';
		echo print_r($doc_no_found);
		echo '</pre>';

		echo '<br>doc ya existen en atach en un solo matter:<br>';
		echo '<pre>';
		echo print_r($docs_duplicados_en_matter);
		echo '</pre>';

		echo '<br>doc MATTER NONE :<br>';
		echo '<pre>';
		echo print_r($MATTER_NONE);
		echo '</pre>';
		 
	}


	function reload_contacts(){
		set_time_limit(0);

		$this->load->helper("util");
		//$excel=ExcelGet("./tmp/libro1.xlsx");
	
	    $excel=ExcelGet("./tmp/Contacts.xlsx");
		$excel=$excel[0];

		unset($excel[1]);
		/*echo "<pre style='display:block'>";
		print_r($excel);
		echo "</pre>";
		return;*/


		$DATA=array();
		
		foreach($excel as $i => $item):

			$row="";
			
			$where = " AND FirstName LIKE '%".trim($item["B"])."%' AND LastName LIKE '%".trim($item["D"])."%' ";
			$contact = $this->SecureModel->get("ml_co_contact", $where);

			/*echo "<pre>";
			print_r($contact);
			echo "</pre>";
			echo $item["H"];
			echo "<br> Contact id".$contact->Id;*/

			if($contact->Id > 0 ){

				$pho=array();

					if(trim($item["K"])!=""){   $pho[]=array("Contact"=>$contact->Id,"Phone"=>$item["K"]); }
					if(trim($item["L"])!=""){   $pho[]=array("Contact"=>$contact->Id,"Phone"=>$item["L"]); }
					if(trim($item["M"])!=""){   $pho[]=array("Contact"=>$contact->Id,"Phone"=>$item["M"]); }
					if(trim($item["N"])!=""){   $pho[]=array("Contact"=>$contact->Id,"Phone"=>$item["N"]); }
					if(trim($item["O"])!=""){   $pho[]=array("Contact"=>$contact->Id,"Phone"=>$item["O"]); }

					//echo "<br>count : ".count($pho);

					if(count($pho)>0){

						//$this->SecureModel->SaveNew("ml_co_phone",$pho);
						$this->db->insert_batch("ml_co_phone",$pho);
					}

			}	

			if($item["H"]!=""){
				if($contact->Id > 0 ){

					$row["Birdate"]=$this->partFecha($item["H"]);

					//$this->SecureModel->update($row,array('Id'=>$contact->Id), 'ml_co_contact');

					

					//$id=$this->db->insert_id();

					//echo " <br> Existe: ".$item["B"]." ".trim($item["D"]);

					//echo "<br>UPDATE ml_co_contact SET Birdate='".$this->partFecha($item["H"])."' WHERE Id='".$contact->Id."'; ";

				}else{

					//echo " <br> No existe: ".$item["B"]." ".trim($item["D"]);

				}
				
			}
			 
			

			/*$row2="";
			$row2["IdContact"]=$id;
			$row2["IdGroup"]  ='1';
			//$this->db->insert('ml_co_group_contact',$row2);
			
			 

			

			$email=array();
			if(trim($item["P"])!=""){$email[]=array("Contact"=>$id,"Email"=>$item["P"]);}
			if(trim($item["Q"])!=""){$email[]=array("Contact"=>$id,"Email"=>$item["Q"]);}
			if(trim($item["R"])!=""){$email[]=array("Contact"=>$id,"Email"=>$item["R"]);}
			if(trim($item["S"])!=""){$email[]=array("Contact"=>$id,"Email"=>$item["S"]);}
			if(trim($item["T"])!=""){$email[]=array("Contact"=>$id,"Email"=>$item["T"]);}
			if(count($email)>0){
			
				//$this->db->insert_batch("ml_co_email",$email);
			}
			$address=array();
			if(trim($item["U"])!="" && $this->build_address(trim($item["U"]),$id)!=false){$address[]=$this->build_address(trim($item["U"]),$id);}
			if(trim($item["V"])!="" && $this->build_address(trim($item["V"]),$id)!=false){$address[]=$this->build_address(trim($item["V"]),$id);}
			
			if(count($address)>0){
				//$this->db->insert_batch("ml_co_address",$address);
			}
			
			/*echo "<pre style='display:block'>";
			print_r($row);
			echo "</pre>";*/



			$DATA[]=$row;
		endforeach;

		echo "Ready";

	/*	echo "<pre style='display:block'>";
		print_r($DATA);
		echo "</pre>";*/
		//$this->db->insert_batch("sys_organizaciones_afiliadas",$DATA);

		//ftips_combinacion1
	}



	function partFecha($fecha){
		
		 
		//echo $fecha.'<br>';

		$fecha=explode(" ",trim($fecha));


		$hora  = $fecha[1];
		$timestamp = strtotime($hora);
		$new_Hora = date('H:i:s', $timestamp);  

		$fecha = $fecha[0];

		$fechaparts =explode("/", $fecha);
		$fechaFinal=$fechaparts[2].'-'.$fechaparts[0].'-'.$fechaparts[1]." ".$new_Hora;

		//echo "<pre>";
		//print_r($fechaparts);
		//echo "</pre>";

		return $fechaFinal;
	}
	
	
	 
	

	
	 
	
	

	public function pruebaFecha(){

		$old_date_timestamp = strtotime("11/09/2017 ".date('H:i:s'));
		$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 

		echo $new_date;
	}






	
}