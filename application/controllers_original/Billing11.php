<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Billing extends CI_Controller {
	function  __construct(){
		parent:: __construct();

		//only role 1 can see this controller
		if($this->session->userdata("Role")!="1"){ redirect(base_url().'dashboard'); }

		if($this->session->userdata('Email')==""){ redirect("Login"); }
		$this->load->model('SecureModel');
		$this->load->model('DocumentModel');
		$this->load->model('UserModel');
		$this->load->model('BillingModel','billing');
		$this->load->helper('cookie');
		$this->load->model('MatterModel');
	}

	public function index()
	{

		$this->dashboard();
	}

	 

	public function dashboard($paginaActual=1){

		$data=$this->SecureModel->globalTask();

		$data['Estadistic']           = $this->billing->getEstadistic();
		$data['getEstadisticOverdue'] = $this->billing->getEstadisticOverdue();
		$data['PaidLast30days']       = $this->billing->PaidLast30days();

		$data['ComingDue']             = $this->billing->ComingDue();
		$data['ComingDue1']            = $this->billing->ComingDue('1');
		$data['ComingDue2']            = $this->billing->ComingDue('30');
		$data['ComingDue3']            = $this->billing->ComingDue('60');
		$data['ComingDue4']            = $this->billing->ComingDue('90');

		$arrayName[0] = $data['ComingDue']->ComingDue;
		$arrayName[1] = $data['ComingDue1']->ComingDue;
		$arrayName[2] = $data['ComingDue2']->ComingDue;
		$arrayName[3] = $data['ComingDue3']->ComingDue;
		$arrayName[4] = $data['ComingDue4']->ComingDue;

		$max = max($arrayName);

		$data['height']  = ($max==0)?0:($data['ComingDue'] ->ComingDue*100)/$max;
		$data['height1'] = ($max==0)?0:($data['ComingDue1']->ComingDue*100)/$max;
		$data['height2'] = ($max==0)?0:($data['ComingDue2']->ComingDue*100)/$max;
		$data['height3'] = ($max==0)?0:($data['ComingDue3']->ComingDue*100)/$max;
		$data['height4'] = ($max==0)?0:($data['ComingDue4']->ComingDue*100)/$max;

		//************
		$total=$this->billing->InvoicedinDraft($pagina="", $limit="");
		$total=count($total);

		$this->load->library('pagination');
		$config['base_url']   =   base_url().'Billing/dashboard';
		$config['total_rows'] =   $total;
		$config['per_page']   =   4;
		$config["cur_page"]   =   $paginaActual;
		$config['num_links']  =  2;
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();

		//nav info
		$endItem=$paginaActual+4;
		if($endItem > $total){ $endItem=$total; }
		$data["startItem"] = $paginaActual;
		$data["endItem"] = $endItem;
		$data["totalObjects"] = $total;
		$data['InvoicedinDraft']  = $this->billing->InvoicedinDraft($paginaActual,'4');


		//************ univoiced data
		$paginaActual_u= $this->session->userdata("univoicedActualpage");
		if($paginaActual_u<1){ $paginaActual_u=1;   }
		
		$total_u=$this->billing->Uninvoiced($pagina="", $limit="");
		$total_u=count($total_u);

		
		$config_u['base_url']   =   base_url().'Billing/set_univioced_page';
		$config_u['total_rows'] =   $total_u;
		$config_u['per_page']   =   4;
		$config_u["cur_page"]   =   $paginaActual_u;
		$config_u['num_links']  =  2;
		$this->pagination->initialize($config_u);
		$data['links_u'] = $this->pagination->create_links();

		//nav info

		$endItem_u=$paginaActual_u+4;
		if($endItem_u > $total_u){ $endItem=$total_u; }
		$data["startItem_u"] = $paginaActual_u;
		$data["endItem_u"] = $endItem_u;
		$data["totalObjects_u"] = $total_u;
		$data['Uninvoiced']  = $this->billing->Uninvoiced($paginaActual_u,'4');







		$data["vista"]="Billing/dashboarBilling";

		$this->load->view('MainView', $data);
	}


	public function set_univioced_page($page){

		if($page==""){ $page='0'; }
		
		$this->session->set_userdata("univoicedActualpage",$page);
		
		redirect(base_app()."Billing/dashboard");

	}


	
	public function pruebaFecha(){

		$old_date_timestamp = strtotime("11/09/2017 ".date('H:i:s'));
		$new_date = date('Y-m-d H:i:s', $old_date_timestamp); 

		echo $new_date;
	}



	function time_expense_modal(){
		$this->load->helper('calendar_helper');
		$this->load->model('MatterModel');
		$data["billing_codes"]=$this->billing->billing_code_get();
		$data["owners"]=$this->billing->owners_get();

		$id_entry=(int)$this->input->post("id_entry");
		if($id_entry==0 && $this->input->post("id_matter")){
			$data["default_matter"]=$this->MatterModel->selectOne((int)$this->input->post("id_matter"));
		}


		$data["entry"]=$this->billing->time_expense_get($id_entry);
		$this->load->view('Billing/modal-time-expense', $data, FALSE);
	}


	function save_time_expense(){
		

		$this->load->helper('calendar_helper');
		$timexp["id"]=(int)$this->input->post("id");
		$timexp["type_entry"]=$this->input->post("type_entry");
		$timexp["billing_code"]=(int)$this->input->post("billing_code");
		$timexp["date_activity"]=str_to_date($this->input->post("date"));
		$timexp["id_user"]=(int)$this->input->post("user");
		$timexp["is_flat_fee"]=(int)$this->input->post("is_flat_fee");
		//$timexp["creation_date"]=date(Y-m-d H:i:s);

		$timexp["no_charge"]=(int)$this->input->post("no_charge");
		if($timexp["id"]==0){
			$timexp["status"]=1;
			$timexp["creation_date"]=date("Y-m-d H:i:s");
		}


		if($timexp["type_entry"]=="TIME"):
			if($timexp["is_flat_fee"]==0){
				$timexp["units"]=(float)$this->input->post("units");
				$timexp["rate"]=(float)$this->input->post("rate");
				$timexp["amount"]=(float)$this->input->post("amount");
				
				$h=floor($timexp["units"]/1); // hours
				$m=round(($timexp["units"]-$h)*60); // minutes
				$timexp["minutes"]=($h*60)+$m;
			}else{
				$timexp["units"]=1;
				$timexp["rate"]=(float)$this->input->post("rate");
				$timexp["amount"]=$timexp["rate"];
			}
			else:
				$timexp["units"]=(float)$this->input->post("units_expense");
			$timexp["rate"]=(float)$this->input->post("rate_expense");
			$timexp["amount"]=$timexp["units"]*$timexp["rate"];
			endif;

			$timexp["description"]=$this->input->post("description");
			$timexp["notes"]=$this->input->post("notes");
			$id_attach=$this->input->post("id_attach");
			$timexp["id_matter"]=$id_attach[0];
			
			if($this->session->userdata("InvNumActual")!=""){
				 
				$timexp["InvoiceNumber"]=$this->session->userdata("InvNumActual");

				$this->session->set_userdata("InvNumActual","");
			}
			

			$id_timeexpense=$this->billing->time_expense_add($timexp);


			 

			if($this->input->post("redirAfterSend")!='no'){

			
				if($this->input->post("from") && $this->input->post("from")=="billing"){
					redirect(base_url("Billing/time_expense"));
				}else{
					redirect(base_url("Matters/Details/".$id_attach[0]."?tab=billing"));	
				}

			}

			if($id_timeexpense>0){
				echo 1;
			}else{
				echo 0;
			}
			
			


		/*echo "<pre style='display:block'>";
		print_r($timexp);
		echo "</pre>";*/

	}
	function parse_date(){

	}
	function remove_entry(){
		$id_entry=(int)$this->input->post("id_entry");

		$this->billing->time_expense_remove($id_entry);
		$json["error"]=0;
		echo json_encode($json);
	}

	public function  MAxResultXPage($xpage){
		
		$this->session->set_userdata("Timesxpage",$xpage);
		$this->session->set_userdata("TimesActualpage","0");
		redirect(base_app()."Billing/time_expense");
	}
	
	public function Page($page=0){
		
		if($page==""){ $page='0'; }
		
		$this->session->set_userdata("TimesActualpage",$page);
		
		redirect(base_app()."Billing/time_expense");
	}

	function time_expense(){
		$data=$this->SecureModel->globalTask();

		if($this->session->userdata("TimesActualpage")==""){ $this->session->set_userdata("TimesActualpage","0"); }
		if($this->session->userdata("Timesxpage")==""){ $this->session->set_userdata("Timesxpage","10"); }

		$actualPage = $this->session->userdata("TimesActualpage");
		$Objectxpage  = $this->session->userdata("Timesxpage");

		$total=$this->billing->getTotal();

		//echo "total:".$total;


		$this->load->library('pagination');

		$config['base_url']   =   base_url().'Billing/Page/';
		$config['total_rows'] =   $total;
		$config['per_page']   =   $Objectxpage;
		$config["cur_page"]   =   $actualPage;
		$config['num_links']  =  2;
	 


		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();

		//nav info
		$endItem=$actualPage+$Objectxpage;
		if($endItem > $total){ $endItem=$total; }
		$data["startItem"] = $actualPage;
		$data["endItem"] = $endItem;
		$data["totalTimes"] = $total;

		$data["billing"]=$this->billing->activities_get_all($actualPage,$Objectxpage);

		$data["vista"]="Billing/template-billing";
		$data["vista_billing"]="Billing/time-expense";

		$this->load->view('MainView', $data);
	}

	 
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/*************************************************************** INVOICES   *****************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/*************************************************************** INVOICES   *****************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
	function new_invoice($id_matter=""){

		if($id_matter!=""){
			$data['datos_matter'] = $this->SecureModel->get('ml_ma_matters', " AND Id='$id_matter'  ");
		}

		$this->load->view("Billing/new-invoice",$data); 
	}




	public function  iMAxResultXPage($xpage){
		
		$this->session->set_userdata("Invoicexpage",$xpage);
		$this->session->set_userdata("InvoiceActualpage","0");
		redirect(base_app()."Billing/invoices");
	}
	
	public function iPage($page=0){
		
		if($page==""){ $page='0'; }
		$this->session->set_userdata("InvoiceActualpage",$page);
		redirect(base_app()."Billing/invoices");
	}

	public function setCriterioInvoices($idMatter="",$name=""){

		if($idMatter==""){
			$this->session->set_userdata("MAtterAsociatedInvoice", "");
			$this->session->set_userdata("InvoiceActualpage","0");
			$this->session->set_userdata("matterCriterioActual","");

			redirect(base_app()."Billing/invoices");
		}else{

			$where=" AND BillTo='".$idMatter."' ";
			$this->session->set_userdata("InvoiceActualpage","0");
			$this->session->set_userdata("MAtterAsociatedInvoice", $where);
			$this->session->set_userdata("matterCriterioActual",$name);

			redirect(base_app()."Billing/invoices");
		}

		

	}

	function invoices($page=1){

		$data=$this->SecureModel->globalTask();

		if($this->session->userdata("InvoiceActualpage")==""){ $this->session->set_userdata("InvoiceActualpage","0"); }
		if($this->session->userdata("Invoicexpage")==""){ $this->session->set_userdata("Invoicexpage","10"); }
		if($this->session->userdata("MAtterAsociatedInvoice")==""){ $this->session->set_userdata("MAtterAsociatedInvoice", ""); }

		//assig values from sessions
		$actualPage = $this->session->userdata("InvoiceActualpage");
		$Objectxpage  = $this->session->userdata("Invoicexpage");
		$criterio=$this->session->userdata("MAtterAsociatedInvoice");

		$total=$this->billing->getTotalInvoices($criterio);

		$this->load->library('pagination');

		$config['base_url']   =   base_app().'Billing/iPage/';
		$config['total_rows'] =   $total;
		$config['per_page']   =   $Objectxpage;
		$config["cur_page"]   =   $actualPage;
		$config['num_links']  =  2;
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();

		//nav info
		$endItem=$actualPage+$Objectxpage;

		if($endItem > $total){ $endItem=$total; }
		$data["startItem"]    = $actualPage;
		$data["endItem"]      = $endItem;
		$data["totalObjects"] = $total;

		$data["billing"]=$this->billing->invoices($actualPage,$Objectxpage,$criterio);
		 
		$data["vista"]="Billing/template-billing";
		$data["vista_billing"]="Billing/invoices_list";

		$this->load->view('MainView', $data);

	}





	function SearchMatter(){
		
		$criteria=$this->input->post("Criteria");

		$result=$this->MatterModel->searhMatter($criteria);
		
		foreach ($result as $row)
		{
			
			$id=$row->Id;
			$Name=substr($row->Name,0,25);
			 
			echo '<li><a onclick="addInvoiceMatter(\''.$id.'\',\' '.$Name.'\',\'idMatter\', \'matterName\' )">
						<img src="'.base_url().'img/matters_blue.png"> &nbsp; '.$Name.'</a></li>';
												//(valForHidden, selectedString, idHidden, button )			              
		}
		
	}

	//for pay creation
	function SearchInvoice(){
		
		$criteria=$this->input->post("Criteria");
		$result=$this->billing->searhInvoice($criteria);
		
		foreach ($result as $row)
		{
			
			$id=$row->Id;


			//$Expense      = $this->billing->InvoiceEntries($id, "EXPENSE");
			//$Times        = $this->billing->InvoiceEntries($id, "TIME");

			$Name=substr($row->BillToName,0,25)."(Invoice Number:".$row->Number.")";
			 
			
			echo '<li><a onclick="addInvoiceMatter(\''.$id.'\',\' '.$Name.'\',\'id_invoice\', \'BillToName\' )">
						<img src="'.base_url().'img/matters_blue.png"> 
								'.$Name.'</a></li>';
												//(valForHidden, selectedString, idHidden, button )			
		               
		}
		
	}

	function saveInvoice(){

		$status = "";
		$mensaje= "";

		$starTime=encodedate($this->input->post("StartTime"));
		$endTime=encodedate($this->input->post("EndTime"));

		//VALIDATION
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('idMatter',                  'Name matter',     'required');
		$this->form_validation->set_rules('matterName',                'Name Matter',     'required|min_length[3]|trim');

		if($this->input->post('dateInvoice')=="times"){
			
			$this->form_validation->set_rules('StartTime',         'Start Time',         'required|trim');
			$this->form_validation->set_rules('EndTime',            'End Time',         'required|trim');

		}

		


		if($this->form_validation->run() == FALSE)
		{
			$status="error";
		}

        
		if($status==""){

			
			if($this->input->post('dateInvoice')=="times"){
				//check if there are some entries on this range dates
				//this validatios it is here because , first validate the dates and id matter are not empty
				$where_e=" AND id_matter='".$this->input->post("idMatter")."' AND InvoiceNumber='' AND date_activity >= '".$starTime."' AND date_activity<='".$endTime."' ";
				$result_e=$this->SecureModel->getOne('ml_bi_time_expense', $where_e);

				//echo $where_e;

				//echo "<br>entradas encontradas : ".count($result_e);
				
				if(count($result_e)<1){
					$status="error";
					$mensaje.='<span class="error">Error, No entries found on this date range</span>';
				}
			}


			if($status==""){

				//selsect max
				$max=$this->billing->getMaxInvoicesNumber();
				$max=$max+1;

				//get Name of matter
				//$this->SecureModel->get('ml');

				$data = array(
								'Number'=>$max,	
								'Status' => 'Draft',
								'InvoiceDate'=>date('Y-m-d H:i:s'),
								'DueDate'=>'',
								'Balance'=>'',
								'InvoiceAmount'=>'',
								'Creator'=>$this->session->userdata("Id"),
								'Object'=>$this->input->post("idMatter"),
								'TypeObject'=>'matter',
								'BillToName'=>trim($this->input->post("matterName")),
								'BillTo'=>trim($this->input->post("idMatter"))

							);

				$invoiceId = $this->billing->SaveNew('ml_bi_invoices',$data);

				if($invoiceId>0){

					

					$invoiceNumber=$this->SecureModel->get('ml_bi_invoices', " AND Id='$invoiceId'  ");

					//echo "invoice number : ".$invoiceNumber->Number;

					if($invoiceNumber->Number > 0){

						if($this->input->post('dateInvoice')=="times"){

						 	
							$this->billing->updateTimesAndExpenses($invoiceNumber->Number,$starTime,$endTime,$this->input->post("idMatter"));
						}

						if($this->input->post('dateInvoice')=="all"){

							$this->billing->updateTimesAndExpenses($invoiceNumber->Number,"","",$this->input->post("idMatter"));

						}

						echo 1;

					}
					 
			
				}else{
					$status="error";
					$mensaje.='<span class="error">Internal Error, No data Saved Contact Technical Support</span>';
				}
			}	


		}


		if($status=="error"){
				 echo validation_errors('<span class="error">', '</span>'); 
				 echo $mensaje;
		}
		

	}


	public function invoice_details($id){

		if($id==""){
			
			$message='<span class="red">No invoice selected </span>';
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/invoices");
			
		}

	 	$data=$this->SecureModel->globalTask();

		$data['Invoice']      	= $this->SecureModel->get('ml_bi_invoices', " AND Id=$id ");

		 

		if(count($data['Invoice'])){

			$data['Matter']       	= $this->SecureModel->get('ml_ma_matters',  " AND Id='".$data['Invoice']->BillTo."' ");
			$data['Cliente']      	= $this->SecureModel->get('ml_co_contact',  " AND Id='".$data['Matter']->Client."' LIMIT 1 " );

			$data['ClienteAddress'] = $this->SecureModel->get('ml_co_address',  " AND Contact='".$data['Cliente']->Id."' LIMIT 1 ");
			$data['ClientePais']    = $this->SecureModel->get('ml_co_country',  " AND Id='".$data['ClienteAddress']->Country."' LIMIT 1 ");

			$this->session->set_userdata("InvNumActual",$data['Invoice']->Number);

			$data['Expense']      = $this->billing->InvoiceEntries($data['Invoice']->Number, "EXPENSE");
			$data['Times']        = $this->billing->InvoiceEntries($data['Invoice']->Number, "TIME");

			$data["vista"]        = "Billing/template-billing";
			$data["vista_billing"]= "Billing/invoice_details";

			 
			$this->load->view('MainView', $data);

		}else{
			echo "No invoice selected";
		}

	}

	public function invoice_update(){

		//VALIDATION
		$this->load->library('form_validation');
		
		if($this->session->userdata("InvNumActual")!=$this->input->post('InvoiceNumber')){
			$this->form_validation->set_rules('InvoiceNumber', 'Invoice Number',     'required|trim|is_unique[ml_bi_invoices.Number]');
		}else{
			$this->form_validation->set_rules('InvoiceNumber', 'Invoice Number',     'required|trim');
		}

		$this->form_validation->set_rules('ContactID_A',        'Bill To',     'required|trim');
		$this->form_validation->set_rules('matter',        'Matter',      'required|trim');
	 
		if($this->form_validation->run() == FALSE)
		{
			$status="error";
		}

        //echo 'Bill to from formm: '.$this->input->post('Contact_A');

		if($status==""){


			$data=array(
				
				'Number'=>$this->input->post('InvoiceNumber'),
				'BillTo'=>$this->input->post('ContactID_A'),
				'Address'=>$this->input->post('Address'),
				'Term'  =>$this->input->post('terms'),
				'InvoiceDate'=>encodedate($this->input->post('iDate')),
				'DueDate'=>encodedate($this->input->post('DueDate')),
				'Discount'=>$this->input->post('AppDisc'),
				'DiscType'=>$this->input->post('DiscType'),
				'DiscServices'=>$this->input->post('discServ'),
				'DiscExpenses'=>$this->input->post('discExpen'),
				'Tax'=>$this->input->post('AppTax'),
				'TaxValue'=>$this->input->post('taxValue'),
				'TaxApplieTo'=>$this->input->post('TaxApplieTo'),
				'ShowOutstandingBalances'=>$this->input->post('show_und'),
				'invoiceType'=>$this->input->post('invoiceType'),
				'Comments'=>$this->input->post('comments'),
				'BillToName'=>$this->input->post('Contact_A')
			);


			$this->SecureModel->update($data, array('Id' => $this->input->post('id_invoice') ),'ml_bi_invoices');

			
		}

		if($status=="error"){
			$message='<span class="red">Something Wrong, contact to technical support!</span>'.validation_errors();
			$this->session->set_userdata('Wmessage', $message);
		    redirect(base_app()."Billing/invoice_details/".$this->input->post('id_invoice'));
		}else{
			$message='<span class="green">data save Succeful!</span>'.validation_errors();
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/invoice_details/".$this->input->post('id_invoice'));
		}



	}

	function deleteDraft($id){	

		if($id==""){
			
			$message='<span class="red">No invoice selected </span>';
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/invoice_details/".$id);
			
		}

		 

		$affecRow=$this->SecureModel->update(array('Status' =>'-1'   ) , array('Id' => $id, 'invoiceType'=>'draft') ,'ml_bi_invoices');

		//echo " Afected rows: ".$affecRow;

		if($affecRow > 0){

			$this->SecureModel->update(array('InvoiceNumber' =>''   ) , array('InvoiceNumber' => $id ) ,'ml_bi_time_expense');

		}else{
			$status="error";
		}

		//echo "<br> Estatus : ".$status;

		if($status=="error"){
			$message='<span class="red">No Deleted, may be not in draft!</span>'.validation_errors();
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/invoice_details/".$id);
		}else{
			$message='<span class="green">data delete Succeful!</span>'.validation_errors();
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/invoice_details/".$id);
		}

	}	

	function prew_invoice($id){


		if($id==""){
			
			$message='<span class="red">No invoice selected </span>';
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/invoices");
			

		}

	 	$data=$this->SecureModel->globalTask();

		$data['Invoice']      	= $this->SecureModel->get('ml_bi_invoices', " AND Id='$id' ");
		$data['Matter']       	= $this->SecureModel->get('ml_ma_matters',  " AND Id='".$data['Invoice']->BillTo."' ");
		$data['Cliente']      	= $this->SecureModel->get('ml_co_contact',  " AND Id='".$data['Matter']->Client."' ");
		$data['ClienteAddress'] = $this->SecureModel->get('ml_co_address',  " AND Contact='".$data['Cliente']->Id."'   LIMIT 1 ");
		$data['ClientePais']    = $this->SecureModel->get('ml_co_country',  " AND Id='".$data['ClienteAddress']->Country."' LIMIT 1 ");

		 

		$data['Expense']      = $this->billing->InvoiceEntries($data['Invoice']->Number, "EXPENSE");
		$data['Times']        = $this->billing->InvoiceEntries($data['Invoice']->Number, "TIME");

		//select setting for invoices
		$data['inv_setting'] = $this->SecureModel->getTabla('ml_bi_invoice_setting','');
		 

		$this->load->view("Billing/invoice_prew",$data);

	}

	function apply_pay(){



		$this->load->view("Billing/ajax_apply_pay");

	}




	public function savepay(){

		//VALIDATION
		$this->load->library('form_validation');
		
		 

		$this->form_validation->set_rules('id_invoice',        'Bill To',     'required|trim');
		$this->form_validation->set_rules('Amount',            'Amounts',      'required|trim');
	 
		if($this->form_validation->run() == FALSE)
		{
			$status="error";
		}

        //echo 'Bill to from formm: '.$this->input->post('Contact_A');

		if($status==""){


			$data=array(

				'Date'=>encodedate($this->input->post('Datep')),
				'InvoiceNumber'=>$this->input->post('id_invoice'),
				'Type'=>$this->input->post('TypePay'),
				'IsVoided'=>'',
				'Detail'=>$this->input->post('TransactionDetail'),
				'Notes'=>$this->input->post('notes'),
				'Amount'=>$this->input->post('Amount')				 
				
			);


			$this->SecureModel->SaveNew('ml_bi_payments',$data);

			
		}

		if($status=="error"){
			echo '<span class="red">Something Wrong !</span>'.validation_errors();
			 
		}else{
			echo '1';
		}



	}











/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/*************************************************************** CODESSSS   *****************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/
/*************************************************************** CODESSSS   *****************************************************************************/
/********************************************************************************************************************************************************/
/********************************************************************************************************************************************************/



	public function  cMAxResultXPage($xpage){
		
		$this->session->set_userdata("codesxpage",$xpage);
		$this->session->set_userdata("codesActualpage","0");
		redirect(base_app()."Billing/codes");
	}
	
	public function cPage($page=0){
		
		if($page==""){ $page='0'; }
		$this->session->set_userdata("codesActualpage",$page);
		redirect(base_app()."Billing/codes");
	}



	function codes(){

		$data=$this->SecureModel->globalTask();



		 
		if($this->session->userdata("codesActualpage")==""){ $this->session->set_userdata("codesActualpage","0"); }
		if($this->session->userdata("codesxpage")==""){ $this->session->set_userdata("codesxpage","10"); }

		$actualPage = $this->session->userdata("codesActualpage");
		$Objectxpage  = $this->session->userdata("codesxpage");

		$total=$this->billing->getTotalcodes();

		$this->load->library('pagination');

		$config['base_url']   =   base_url().'Billing/cPage/';
		$config['total_rows'] =   $total;
		$config['per_page']   =   $Objectxpage;
		$config["cur_page"]   =   $actualPage;
		$config['num_links']  =  2;
	
		$this->pagination->initialize($config);
		$data['links'] = $this->pagination->create_links();

		//nav info
		$endItem=$actualPage+$Objectxpage;

		if($endItem > $total){ $endItem=$total; }
		$data["startItem"]    = $actualPage;
		$data["endItem"]      = $endItem;
		$data["totalObjects"] = $total;

		$data["billing"]=$this->billing->codes($actualPage,$Objectxpage);
		 
		$data["vista"]="Billing/billing_codes_list";
		//$data["vista_billing"]="Billing/billing_codes_list";
		$this->load->view('MainView', $data);

	}



	public function new_code(){

		$this->load->view("Billing/new-billing_code",$data);
	}


	public function saveCode(){


		//VALIDATION
		$this->load->library('form_validation');
		
		 

		$this->form_validation->set_rules('tipo',        'Type of Billing Code',     'required|trim');
		$this->form_validation->set_rules('CodeName',    'Billing code name ',      'required|trim');
		$this->form_validation->set_rules('description',    ' description  ',      'required|trim');
	 
		if($this->form_validation->run() == FALSE)
		{
			$status="error";


		}

        //echo 'Bill to from formm: '.$this->input->post('Contact_A');

		if($status==""){


			$data=array(

				'code'=>$this->input->post('CodeName'),
				'status'=>'1',
				'type'=>$this->input->post('tipo'),
				'description'=>$this->input->post('description') 				
			);


			$affect=$this->SecureModel->SaveNew('ml_bi_billing_codes', $data);

			if($affect < 1){
				$status="error";
				$mensaje='<span class="red">Something Wrong, no data save !</span>';
			}

			
		}

		if($status=="error"){
			echo '<span class="red">Something Wrong !</span>'.validation_errors().$mensaje;
			 
		}else{
			echo '1';
		}

	}

	

	function Changestatus($status,$idCode){

		if($status==1){
			$newStatus=2;
		}elseif($status==2){
			$newStatus=1;
		}


		$this->SecureModel->update(array('status' => $newStatus, ),array('id' => $idCode, ),'ml_bi_billing_codes');

		redirect(base_url("Billing/codes"));

	}

	function changeStatusList(){

		$ids=$this->input->post("ItemId");
		$action=$this->input->post("actionButt");

		//print_r($ids);

		if(count($ids)>0){


			foreach ($ids as $key => $value) {

				//echo $value."<br>";

				if($action=='act'){
					$newStatus=1;
				}elseif($action=='deact'){
					$newStatus="2";
				}

				$this->SecureModel->update(array('status' => $newStatus ),array('id' => $value ),'ml_bi_billing_codes');
				 
			}

			$this->session->set_userdata("message",'<span class="green">Status changed!  </span>');
			redirect(base_url("Billing/codes"));


		}else{

			$this->session->set_userdata("Wmessage",'<span class="red">No Codes selected!   </span>');
			redirect(base_url("Billing/codes"));
		}

	}


	public function eraseEntriesConfirm(){
		
		$fromList=$this->input->post('ItemID');
		
		if (count($fromList)<1)
		{
			$message='<span class="error">No Data Selected!</span>'; 
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/time_expense");
		}
		
		
		$data=$this->SecureModel->globalTask();
		
		$data['linkSi']=base_app()."Billing/eraseEntries";
		$data['linkNo']=base_app()."Billing/time_expense";
		
		  
		
		if (count($fromList)>0)
		{
			foreach ($fromList AS $key => $val)
			{

				$dataDelete[]  = $val;
				$result        = $this->SecureModel->getOne('ml_bi_time_expense'," AND id=$val");
				$matter        = $this->SecureModel->getOne('ml_ma_matters'," AND Id=$result->id_matter");
				$ItemNomb[] = $result->date_activity.' | Matter Name:  '.$matter->Name.' | Amount: '.$result->amount;

				 
			}
		}

		$this->session->set_userdata("EntriesIDSdelete",$dataDelete);
	 
		$data['nameObject']="Entries";
		$data["ObjectNomb"]=$ItemNomb;
		$data["vista"]="global/Confirm";

		$this->load->view('MainView', $data);

	}	


	
	public function eraseEntries(){
		
		
		
		$dataDelete=$this->session->userdata("EntriesIDSdelete");
		
		if(count($dataDelete)>0){
			
			foreach ($dataDelete as $value){ 

				$result=$this->SecureModel->update(array('status' => '-1'  ),array('id' => $value ),'ml_bi_time_expense');
			}
		}
		
		 $this->session->set_userdata("EntriesIDSdelete","");
		
		if($result>0){
			
			$message="The data has been Remove Succeful!";
			$this->session->set_userdata('message', $message);
			redirect(base_app()."Billing/time_expense");
			
		}elseif($result<1){
			
			$message="Something Wrong, contact to technical support!";
			$this->session->set_userdata('Wmessage', $message);
			redirect(base_app()."Billing/time_expense");
			
		}
		
	}

	function invoice_setting(){

		$data=$this->SecureModel->globalTask();

		$data['inv_setting']=$this->SecureModel->getTabla('ml_bi_invoice_setting','');

		 

		$data["vista"]="Billing/invoice_setting";
		$this->load->view('MainView', $data);

		 
	}

	function update_invoice_setting(){

		//VALIDATION
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('address',      'Type of Billing Code', 'required|trim');
		$this->form_validation->set_rules('email',        'Email',                'required|trim');
		$this->form_validation->set_rules('contact_name', ' Contact Name  ',      'required|trim');
	 
		if($this->form_validation->run() == FALSE)
		{
			$status="error";
			$errores=validation_errors('<span class="error">', '</span>');
			$this->session->set_userdata("validation_errors",$errores);
		}

        //CORE
		if($status==""){

			$this->SecureModel->update(array('estado'=>$this->input->post('name_status')), array('campo'=>'display_name'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor' =>$this->input->post('name')),        array('campo'=>'display_name'), 'ml_bi_invoice_setting');

			$this->SecureModel->update(array('estado'=>$this->input->post('address_status')), array('campo'=>'address'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor' =>$this->input->post('address')),        array('campo'=>'address'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor'=>$this->input->post('country')),   array('campo'=>'address_country'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor'=>$this->input->post('city')),      array('campo'=>'address_city'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor'=>$this->input->post('code')),      array('campo'=>'address_code'), 'ml_bi_invoice_setting');

			$this->SecureModel->update(array('estado'=>$this->input->post('phone_status')), array('campo'=>'phone_number'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor'=>$this->input->post('phone')),         array('campo'=>'phone_number'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor'=>$this->input->post('fax')),           array('campo'=>'phone_number'), 'ml_bi_invoice_setting');

			$this->SecureModel->update(array('estado'=>$this->input->post('website_status')), array('campo'=>'website'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor' =>$this->input->post('website')),        array('campo'=>'website'), 'ml_bi_invoice_setting');

			$this->SecureModel->update(array('estado'=>$this->input->post('contact_name_status')), array('campo'=>'contact_name'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor' =>$this->input->post('contact_name')),        array('campo'=>'contact_name'), 'ml_bi_invoice_setting');

			$this->SecureModel->update(array('estado'=>$this->input->post('email_status')), array('campo'=>'email'), 'ml_bi_invoice_setting');
			$this->SecureModel->update(array('valor' =>$this->input->post('email')),        array('campo'=>'email'), 'ml_bi_invoice_setting');


			$this->SecureModel->update(array('estado'=>$this->input->post('logo_status')), array('campo'=>'logo'), 'ml_bi_invoice_setting');


			$config['upload_path']          = './img/';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']             = 0;
	        $config['max_width']            = 280;
	        $config['max_height']           = 110;

	        $this->load->library('upload', $config);

	        if ( ! $this->upload->do_upload('logo'))
	        {
	                $errores = $this->upload->display_errors();
					$this->session->set_userdata("validation_errors",'<span class="red">'.$errores.'</span>');
  
	        }
	        else
	        {
	                //$data1 = array('upload_data' => $this->upload->data());

	                $filedata=$this->upload->data();
	                $this->SecureModel->update(array('valor'=>$filedata['file_name']), array('campo'=>'logo'), 'ml_bi_invoice_setting');

	                 
	        }
				
		}


	    redirect(base_app().'Billing/invoice_setting');

	
	}

	 

	

	
}