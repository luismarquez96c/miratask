<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BillingModel extends CI_Model {

	function time_expense_add($item){
		if(isset($item["id"]) && $item["id"]>0){
			$this->db->update("ml_bi_time_expense",$item,array("id"=>$item["id"]));
			return $item["id"];
		}else{
			$this->db->insert("ml_bi_time_expense",$item);
			return $this->db->insert_id();
		}
		
	}

	function get_matter_name($id){
		$sql = "SELECT Name FROM ml_ma_matters WHERE Id = '$id'";
		$query = $this->db->query($sql);
		return $query->row();
	}

	function time_expense_get($id_entry){
		$sql="select *, (select Name from ml_ma_matters b WHERE b.Id=a.id_matter) matter_name from ml_bi_time_expense a WHERE a.id=?";
		$r=$this->db->query($sql,array($id_entry))->row();
		return $r;
	}
	function time_expense_remove($id_entry){
		$this->db->update("ml_bi_time_expense",array("status"=>-1),array("id"=>$id_entry));
	}

	function activities_get($id_matter){
		$sql="select a.*, b.code from ml_bi_time_expense a inner join ml_bi_billing_codes b inner join ml_bi_invoices c on a.InvoiceNumber = c.Number where a.id_matter=? and a.billing_code=b.id AND a.status > 0 AND c.Status != '-1' ORDER BY a.date_activity ASC ";
		$r=$this->db->query($sql,array($id_matter))->result();
		return $r;
	}
	function billing_code_get(){
		$sql="select * from ml_bi_billing_codes where status=1";
		$r=$this->db->query($sql)->result();
		return $r;
	}
	function owners_get(){
		$sql="SELECT * FROM ml_us_users WHERE state=1";
		$r=$this->db->query($sql)->result();
		return $r;
	}



	function getTotal(){
		$count=$this->db->query("select count(a.id) cant from ml_bi_time_expense a where a.status > 0")->row();
		$count=$count->cant;
		return $count;
	}

	function activities_get_all($page,$per_page){
		
		$sql="	select a.*, b.code, c.Name name_matter from ml_bi_time_expense a 
		INNER JOIN ml_bi_billing_codes b ON a.billing_code=b.id 
		INNER JOIN ml_ma_matters c ON a.id_matter=c.Id
		WHERE  a.status > 0 ORDER BY a.date_activity DESC limit ".$page.",".$per_page." ";

		$r=$this->db->query($sql)->result();

		return $r;
	}


	function getTotalInvoices($filtro){
		$count=$this->db->query("SELECT count(a.Id) cant FROM ml_bi_invoices a WHERE a.Id!='' ".$filtro."  ")->row();
		$count=$count->cant;
		return $count;

	}
	function getMaxInvoicesNumber(){
		$count=$this->db->query("select MAX(a.Number) cant from ml_bi_invoices a ")->row();
		$count=$count->cant;
		return $count;

	}

	function invoices($page,$per_page,$filtro){

		$sql="	SELECT a.*, 
		CASE 
		WHEN a.TypeObject='contact'  
		THEN (SELECT CONCAT(FirstName, ' ', LastName) AS ClientName FROM ml_co_contact WHERE Id=a.Object)
		WHEN a.TypeObject='matter' 
		THEN (SELECT `Name` AS ClientName FROM ml_ma_matters WHERE Id=a.Object) 
		ELSE NULL
		END AS NameClient,
		(SELECT SUM(amount) AS InvoiceAmount FROM ml_bi_time_expense WHERE InvoiceNumber=a.Id  ) AS InvoiceAmount,
		(SELECT SUM(Amount) AS Amount        FROM ml_bi_time_expense WHERE InvoiceNumber=a.Id  ) AS Amount 
		FROM ml_bi_invoices a 
		WHERE  a.Id is not null ".$filtro." AND Status!='-1' ORDER BY a.Id ASC limit ".$page.",".$per_page." ";

		//echo $sql;			

		$r=$this->db->query($sql)->result();
		
		return $r;


	}

	function SaveNew($tabla,$data)
	{

		$this->db->insert($tabla,$data);

		return $this->db->insert_id();;
		

	}


	function updateTimesAndExpenses($InvoiceNumber, $starTime="", $endTime="", $id_matter ){

		if($starTime=="" AND $endTime==""){

			$query="
			UPDATE ml_bi_time_expense 
			SET InvoiceNumber='".$InvoiceNumber."'
			WHERE 
			id_matter='".$id_matter."' AND (InvoiceNumber IS NULL OR  InvoiceNumber='' OR  InvoiceNumber='0' ) ";

		}elseif($starTime!="" AND $endTime!=""){

			$query="
			UPDATE ml_bi_time_expense 
			SET InvoiceNumber='".$InvoiceNumber."'
			WHERE 
			date_activity>='".$starTime."' AND date_activity<='".$endTime."' AND id_matter='".$id_matter."' AND (InvoiceNumber IS NULL OR  InvoiceNumber='' OR  InvoiceNumber='0' )  ";

		}
		


		$this->db->query($query);

		return $this->db->affected_rows();	 
	}



	function getTotalcodes(){
		$count=$this->db->query("select count(a.id) cant from ml_bi_billing_codes a ")->row();
		$count=$count->cant;
		return $count;

	}

	function codes($page,$per_page){

		

		$sql="	SELECT a.* 
		FROM ml_bi_billing_codes a 
		WHERE  a.status > 0 ORDER BY a.code   ASC limit ".$page.",".$per_page." ";

		$r=$this->db->query($sql)->result();
		
		return $r;


	}

	function InvoiceEntries($invoiceCode,$tipo){

		$sql="	SELECT a.* 
		FROM ml_bi_time_expense a 
		WHERE  a.status > 0 AND InvoiceNumber = '$invoiceCode' AND Type_entry='$tipo' ORDER BY a.id   ASC   ";

		//echo $sql; 			

		$r=$this->db->query($sql)->result();
		
		return $r;


	}

	public function searhInvoice($criteria){

		$stringQuery="SELECT  *  FROM ml_bi_invoices
		WHERE 
		(Number LIKE '%".$criteria."%' OR 
		BillToName LIKE '%".$criteria."%' OR 
		Address LIKE '%".$criteria."%' ) AND Status != -1 LIMIT 20";

 		//echo $stringQuery;

		$query = $this->db->query($stringQuery);

		return $query->result();
		

	}

	function getEstadistic(){

		$stringQuery = "
		SELECT  
		(SELECT SUM(InvoiceAmount) FROM ml_bi_invoices WHERE Status = 'Paid') AS Paid  , 
		(SELECT SUM(InvoiceAmount) FROM ml_bi_invoices WHERE Status = 'Invoiced') AS Invoiced , 
		(SELECT SUM(InvoiceAmount) FROM ml_bi_invoices WHERE Status = 'Partial') AS Partial, 
		(SELECT SUM(InvoiceAmount) FROM ml_bi_invoices WHERE Status = 'Draft') AS Draft 

		FROM ml_bi_invoices group by Paid";

		$query = $this->db->query($stringQuery);
		return $query->row();
		
	}

	function getEstadisticOverdue(){

		$fecha = date('Y-m-d H:i:s');

		$stringQuery = " SELECT SUM(InvoiceAmount) AS Overdue FROM ml_bi_invoices WHERE (Status='Invoiced' OR Status='PartiallyPaid')  AND  DueDate < '$fecha' "; 

		$query = $this->db->query($stringQuery);

		return $query->row();

	}

	function PaidLast30days(){

		$fecha = date('Y-m-d H:i:s');
		$nuevafecha = strtotime ( '-30 day' , strtotime ( $fecha ) ) ;
		$nuevafecha = date ( 'Y-m-d H:i:s' ,  $nuevafecha );

		$stringQuery = " SELECT SUM(InvoiceAmount) AS PaidLast30days  FROM ml_bi_invoices WHERE Status='Paid' AND InvoiceDate >='$nuevafecha' AND InvoiceDate <= '$fecha' "; 

		$query = $this->db->query($stringQuery);

		return $query->row();

	}

	function  InvoicedinDraft($pagina,$limit){

		if($pagina!="" and $limit!="" ){ 
			$limit=" LIMIT $pagina, $limit ";
		}else{
			$limit="";
		}

		$stringQuery = " SELECT Id, Number , BillToName , InvoiceAmount FROM ml_bi_invoices WHERE Status='Draft'  $limit "; 

		$query = $this->db->query($stringQuery);

		return $query->result();

	}

	function  Uninvoiced($pagina,$limit){

		if($pagina!="" and $limit!="" ){ 
			$limit=" LIMIT $pagina, $limit ";
		}else{
			$limit="";
		}

		$stringQuery = " 

		SELECT  ma.Id, 
		ma.Name
		FROM    ml_ma_matters ma
		WHERE   NOT EXISTS( SELECT NULL FROM ml_bi_invoices i WHERE i.BillTo=ma.Id ) $limit

		"; 


		$query = $this->db->query($stringQuery);

		return $query->result();



	} 

	function sum_time_expenses($id_matter){

		$query = "SELECT SUM(amount) AS total FROM ml_bi_time_expense WHERE  id_matter='$id_matter' ";
		$query = $this->db->query($query);
		return $query->row();
	}	


	function ComingDue($rest=''){

		$fecha = date('Y-m-d H:i:s');

		if($rest > '0' AND $rest<=60){

	 		//$rest2=$rest-30;


			$nuevafecha1 = strtotime ( '-'.$rest.' day' ,  strtotime ( $fecha ) ) ;
			$nuevafecha1 = date ( 'Y-m-d H:i:s' ,  $nuevafecha1 );

			$nuevafecha2 = strtotime ( '-30 day' , strtotime ( $nuevafecha1 ) ) ;
			$nuevafecha2 = date ( 'Y-m-d H:i:s' ,  $nuevafecha2 );

			$where=" AND DueDate >='$nuevafecha2' AND DueDate <= '$nuevafecha1' "; 

			//echo $where."<br>";

		}elseif($rest>60){

			$nuevafecha1 = strtotime ( '-'.$rest.' day' ,  strtotime ( $fecha ) ) ;
			$nuevafecha1 = date ( 'Y-m-d H:i:s' ,  $nuevafecha1 );


			$where=" AND DueDate < '$nuevafecha1'  "; 

			//echo $where."<br>";
		}else{
			$where=" AND DueDate >= '$fecha'  ";
			//echo $where."<br>";
		}

		$stringQuery = " SELECT 
		SUM(InvoiceAmount) AS ComingDue  
		FROM ml_bi_invoices 

		WHERE Status!='' 

		$where "; 

		$query = $this->db->query($stringQuery);



		return $query->row();
	}


	function activities_get_youbilled($time){

		$sql="SELECT count(amount) AS Total, sum(amount) AS total_ingreso FROM ml_bi_time_expense  WHERE  status > 0 AND id_user='".$this->session->userdata("Id")."'  ".$time." ";

		$r=$this->db->query($sql)->row();

		//echo $sql;

		return $r;
	}

	function updatePay($id){
		$data = array('Status'=>'Paid');
		$where = array('Id' => $id);
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update('ml_bi_invoices');

		return $this->db->affected_rows();
	}

	function getInvoicesToPrint($date1,$date2)
	{
		$where = "InvoiceDate BETWEEN '$date1' AND '$date2 23:59:59'";
		$this->db->limit(70);
		$this->db->where($where);
		$this->db->select('*');
		$query = $this->db->get('ml_bi_invoices');

		return $query->result();
	}

	function get_info_invoice($id){
		$where = "Number = '$id'";
		$this->db->where($where);
		$this->db->select('Status');
		$query = $this->db->get('ml_bi_invoices');

		return $query->row();
	}



}

/* End of file BillingModel.php */
				/* Location: ./application/models/BillingModel.php */