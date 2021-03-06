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
	function time_expense_get($id_entry){
		$sql="select *, (select Name from ml_ma_matters b WHERE b.Id=a.id_matter) matter_name from ml_bi_time_expense a WHERE a.id=?";
		$r=$this->db->query($sql,array($id_entry))->row();
		return $r;
	}
	function time_expense_remove($id_entry){
		$this->db->update("ml_bi_time_expense",array("status"=>-1),array("id"=>$id_entry));
	}

	function activities_get($id_matter){
		$sql="select a.*, b.code from ml_bi_time_expense a inner join ml_bi_billing_codes b where a.id_matter=? and a.billing_code=b.id  AND a.status > 0 ORDER BY a.date_activity DESC ";
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


	function getTotalInvoices(){
		$count=$this->db->query("select count(a.Id) cant from ml_bi_invoices a ")->row();
		$count=$count->cant;
		return $count;

	}
	function getMaxInvoicesNumber(){
		$count=$this->db->query("select MAX(a.Number) cant from ml_bi_invoices a ")->row();
		$count=$count->cant;
		return $count;

	}

	function invoices($page,$per_page){

		/*$sql="	SELECT a.*, 
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
					WHERE  a.Id !=''  ORDER BY a.InvoiceDate ASC limit ".$page.",".$per_page." ";*/
		$sql="
		SELECT a.*,
			CASE 
			WHEN a.TypeObject='contact'  
			THEN (SELECT CONCAT(FirstName, ' ', LastName) AS ClientName FROM ml_co_contact WHERE Id=a.Object)
			WHEN a.TypeObject='matter' 
			THEN (SELECT `Name` AS ClientName FROM ml_ma_matters WHERE Id=a.Object) 
			ELSE NULL
			END AS NameClient
		FROM ml_bi_invoices a
		WHERE  a.Id !=''  ORDER BY a.InvoiceDate ASC limit ".$page.",".$per_page." ";
		
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
 	function getTotalfromRangeTimeExpense($id_matter,$starTime="", $endTime=""){
 		$sql="SELECT sum(amount) total FROM ml_bi_time_expense a WHERE a.id_matter=".$id_matter." AND a.date_activity >= '".$starTime."' AND a.date_activity <='".$endTime."' AND (a.InvoiceNumber=0 OR a.InvoiceNumber IS NULL OR a.InvoiceNumber='')";
 		$r=$this->db->query($sql)->row();
 		if(count($r)>0){
 			return $r->total;
 		}
 		return 0;
 	}
 	function  invoice_get($id_invoice){
 		$sql="select * from ml_bi_invoices a where a.Id=".$id_invoice;
 		$r=$this->db->query($sql)->row();
 		return $r;
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
				SUM(InvoiceAmount) AS Paid  , 
				SUM(InvoiceAmount) AS Invoiced , 
				SUM(InvoiceAmount) AS Partial, 
				SUM(InvoiceAmount) AS Draft 

		FROM ml_bi_invoices ";

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

			$where=" AND InvoiceDate >='$nuevafecha2' AND InvoiceDate <= '$nuevafecha1' "; 

			//echo $where."<br>";

		}elseif($rest>60){

			$nuevafecha1 = strtotime ( '-'.$rest.' day' ,  strtotime ( $fecha ) ) ;
			$nuevafecha1 = date ( 'Y-m-d H:i:s' ,  $nuevafecha1 );
		 

			$where=" AND InvoiceDate < '$nuevafecha1'  "; 

			//echo $where."<br>";
		}else{
			$where=" AND InvoiceDate >= '$fecha'  ";
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
		
		$sql="	SELECT count(amount) AS Total FROM ml_bi_time_expense  WHERE  status > 0 AND id_user='".$this->session->userdata("Id")."'  ".$time." ";

		$r=$this->db->query($sql)->row();

		//echo $sql;

		return $r;
	}
	function addPayToInvoice($id,$amount){
		$invoice=$this->db->query("select * from ml_bi_invoices where Id=".$id)->row();
		$invoice->Balance=$invoice->Balance+$amount;
		$invoice->PaidAmount=$invoice->Balance;
		$this->db->update("ml_bi_invoices",$invoice,array("Id"=>$id));
		return $invoice->InvoiceAmount-$invoice->Balance;
	}
	

}

/* End of file BillingModel.php */
/* Location: ./application/models/BillingModel.php */