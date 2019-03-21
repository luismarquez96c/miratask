<?php
class MatterModel extends CI_Model {

	public function __construct() {
		$this->load->database();
	}

	public function GetList($role)
	{

		$queryString = "SELECT * ";              

		$query = $this->db->query($queryString);

 		//print_r($query->result());

		return $query->result();


	}
	
	function getTotal($ActualLetter,$class){
		if ($class === 'Desactivated') {
			$query = "SELECT COUNT(Id) AS total FROM ml_ma_matters ma WHERE Status='2'";

		}else if ($class === 'Overdue') {
			$query = "SELECT COUNT(Id) AS total FROM ml_ma_matters ma WHERE Status!='' ".$ActualLetter." ";
		}
		else{
			$query = "SELECT COUNT(Id) AS total FROM ml_ma_matters ma WHERE Status!='' ".$ActualLetter." ";
		}
		$query = $this->db->query($query);
		return $query->row();

	}
	
	function getOne($id){

		$query = "SELECT Id, Name   FROM ml_ma_matters WHERE Id ='".$id."' ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	function getLast5(){
		
		$query = "SELECT *  FROM ml_ma_matters WHERE Status='1'  ORDER BY DateOpen DESC LIMIT 5";
		$query = $this->db->query($query);           
		return $query->result();
	}
	
	function ListAll($limit1,$limit2,$where,$Class){
		if ($Class=="Overdue") {
			$query = "SELECT invoice.Status, invoice.DueDate, ma.* FROM ml_ma_matters as ma INNER JOIN ml_bi_invoices as invoice ON invoice.Object = ma.Id WHERE (invoice.Status!='Paid' AND invoice.Status!='Draft') ORDER BY Date DESC LIMIT ".$limit1.",".$limit2."";
		}else{

			$query = "SELECT *   FROM ml_ma_matters ma WHERE Status != '-1' ".$where."  ORDER BY Date DESC LIMIT ".$limit1.",".$limit2."  ";
		}
		
		$query = $this->db->query($query);           
		return $query->result();
		
		
		
	}	

	public function SaveNew($data)
	{

		$this->db->insert('ml_ma_matters',$data);

		$insert_id = $this->db->insert_id();

		return $insert_id;


	}

	public function SaveBillActv($data)
	{

		$this->db->insert('ml_bi_activities',$data);

		$insert_id = $this->db->insert_id();

		return $insert_id;


	}

	public function SaveNote($data)
	{
 		//$query = "INSERT INTO ml_ma_notes(IdMatter,Note)  VALUES(".$idMatter.", ".$note." ) ";
		$this->db->insert('ml_ma_notes',$data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
	
	
	

	public function listFromTable($table)
	{

		$query = $this->db->get($table);             
		return $query->result();

	}
	
	public function totalMatterArea($Area){
		$query = "SELECT COUNT(Id) AS total FROM ml_ma_matters WHERE Area = '".$Area."' ";
		$query = $this->db->query($query);
		return $query->row();
	}
	
	public function deleteOne($Id,$Status){
		


		$this->db->where('Id', $Id);
		$this->db->update("ml_ma_matters", array('Status'=>$Status));

		if (!$this->db->affected_rows()) {
			//for log $result = 'Error! ID ['.$id.'] not found';
			$result="error";
		} else {
			$result = 'success';
		}
		
		return $result;
		
	}
	
	//saveStafRelated
	public function saveStafRelated($data)
	{
		
		
		$this->db->insert('ml_ma_staff',$data);
		
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
	public function deleteStaff($IdMatter,$IdUser){

		$stringQuery="DELETE FROM ml_ma_staff WHERE IdMatter='".$IdMatter."' AND  IdUser='".$IdUser."' ";
		$this->db->query($stringQuery);
		
		//$this->db->affected_rows()


	}
	
	public function relatedStaff($IdMatter){
		
		$stringQuery="SELECT mf.*, (SELECT CONCAT(Name,' ',LastName) FROM ml_us_users WHERE Id=mf.IdUser) AS AtorneyName FROM ml_ma_staff mf WHERE mf.IdMatter='".$IdMatter."' ";


		
		$query = $this->db->query($stringQuery);
		return $query->result();
		
	}

	public function getBalance($id_matter)
	{
		$sql = "SELECT SUM(InvoiceAmount) as Balance FROM ml_bi_invoices WHERE Status = 'Draft' AND Object = ".$id_matter." group by Balance";
		$query = $this->db->query($sql);

		return $query->row();
	}
	
	public function   oneArea($id){
		
		$stringQuery="SELECT * FROM ml_ma_area WHERE Id='".$id."' ";
		$query = $this->db->query($stringQuery);
		return $query->row();
	}
	
	public function   oneStatus($id){
		
		$stringQuery="SELECT State FROM ml_sis_states WHERE Id='".$id."' ";
		$query = $this->db->query($stringQuery);
		return $query->row();
	}

	public function selectOne($Id){
		$stringQuery="SELECT * FROM ml_ma_matters WHERE Id='".$Id."' ";
		$query = $this->db->query($stringQuery);
		return $query->row();
	}
	
	public function Update($data,$Id){
		
		$this->db->where('Id', $Id);
		$this->db->update("ml_ma_matters", $data);
		
		return $this->db->affected_rows();
		
	}
	
	public function updataTemplate($template,$idMatter){
		
		$this->db->where('Id', $idMatter);
		$this->db->update("ml_ma_matters", array("Template"=>$template));
		
		return $this->db->affected_rows();
		
	}
	
	public function getAttorney($getAttorney){
		
		$stringQuery="SELECT Id,  Name, LastName FROM ml_us_users WHERE Id='".$getAttorney."' ";
		$query = $this->db->query($stringQuery);

		return  $query->row();
	}
	
	public function getOneRelatedStaff($array){
		
		$this->db->where($array);
		$this->db->select('*');
		$this->db->from('ml_ma_staff');
		$query = $this->db->get();

		return  $query->row();
	}

	public function getOneRelated($array,$table){

		$this->db->where($array);
		$this->db->select('*');
		$this->db->from($table);
		$query = $this->db->get();

		return  $query->row();

	}


	
	public function  NotesCreated($matterID){
		$query = "SELECT COUNT(Id) AS total FROM ml_ma_notes WHERE IdMatter='".$matterID."'   ";
		$query = $this->db->query($query);
		return $query->row();
		
	}
	
	public function  NotesOfMatter($matterID){
		$query = "SELECT * FROM ml_ma_notes WHERE IdMatter='".$matterID."' ORDER BY Date DESC  ";
		

		
		$query = $this->db->query($query);
		return $query->result();
		
	}

	public function ruta($id){
		$sql="select FisicalDir from ml_do_documents where Id =".$id." ";
		$query=$this->db->query($sql);
		return $query->result();

	}
	//all activity
	public function extractRecent(){

		$query = "

		SELECT tmp.* FROM (
		

		
		SELECT
		`Id`,
		`Name` titulo, 
		`DateOpen` fecha,        
		'matter' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=`UserCreator` LIMIT 1)  Creator, 
		'created' Actions,
		'vacio' AS Too,
		Id idToo  
		FROM ml_ma_matters  
		UNION ALL
		SELECT  
		n.IdMatter Id,
		n.Note titulo, 
		n.Date fecha, 
		'note' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=n.Creator LIMIT 1) Creator,
		'added' Actions,  
		(SELECT `Name` FROM ml_ma_matters WHERE Id=n.IdMatter LIMIT 1) AS Too, 
		n.IdMatter idToo
		FROM  ml_ma_notes AS n
		UNION ALL
		SELECT  
		`Id`,
		`Name` titulo, 
		UpdatedDate fecha, 
		'matter' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=`UserUpdater` LIMIT 1) Creator,  
		'updated' Actions,
		'vacio' Too,
		Id idToo   
		FROM ml_ma_matters   
		UNION ALL
		SELECT
		cr.IdContact,
		(SELECT CONCAT(FirstName,' ',LastName) FROM ml_co_contact WHERE Id=cr.IdContact LIMIT 1) titulo, 
		cr.Date fecha, 
		'contact' Object,
		(SELECT CONCAT(Name , ' ', LastName ) FROM ml_us_users WHERE Id=cr.Creator LIMIT 1) Creator,  
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=cr.IdMatter LIMIT 1) Too ,
		cr.IdMatter idToo
		FROM ml_ma_contact_related cr
		UNION ALL
		SELECT
		t.Id Id,
		t.Subject titulo, 
		t.Date fecha, 
		'task' Object,
		(SELECT CONCAT(Name , ' ', LastName ) FROM ml_us_users WHERE Id=t.Creator LIMIT 1) Creator,  
		'added' Actions, 
		'vacio' Too,
		t.Id idToo
		FROM ml_ta_task t 
		UNION ALL
		SELECT 
		ta.Task Id,
		(SELECT `Subject` FROM ml_ta_task WHERE Id=ta.Task LIMIT 1) titulo, 
		ta.Date fecha, 
		'task' Object,
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=ta.Creator LIMIT 1) Creator,  
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=ta.IdObject LIMIT 1) Too,
		ta.IdObject AS idToo
		FROM ml_ta_atach ta WHERE ta.TypeObject = 'matter' 
		UNION ALL
		SELECT
		d.Id,
		d.FileName titulo, 
		d.Date fecha, 
		'document' Object,
		(SELECT CONCAT(Name , ' ', LastName ) FROM ml_us_users WHERE Id=d.Creator LIMIT 1) Creator,  
		'added' Actions,
		'vacio'  Too,
		d.Id idToo
		FROM ml_do_documents d WHERE d.Status!='2'
		UNION ALL
		SELECT 
		da.Document Id,	
		(SELECT `FileName` FROM ml_do_documents WHERE Id=da.Document LIMIT 1) titulo, 
		da.Date fecha, 
		'document' Object,
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=da.Creator LIMIT 1) Creator,  
		'added' Actions , 
		(SELECT `Name` FROM ml_ma_matters WHERE Id=da.IdObject LIMIT 1) Too,
		da.IdObject AS idToo
		FROM ml_do_atach da WHERE da.TypeObject = 'matter' 

		UNION ALL
		SELECT  
		id Id,
		`description` titulo, 
		creation_date fecha, 
		'Time and expense' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=id_user LIMIT 1) Creator,  
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=id_matter LIMIT 1) Too,
		id_matter idToo  
		FROM ml_bi_time_expense  
		UNION ALL
		SELECT
		ev.id Id,
		ev.subject titulo, 
		ev.date fecha, 
		'event' Object,
		(SELECT CONCAT(Name , ' ', LastName ) FROM ml_us_users WHERE Id=ev.creator LIMIT 1) Creator,  
		'added' Actions,
		(SELECT CONCAT(Name , ' ', LastName ) FROM ml_us_users WHERE Id=ev.id_user LIMIT 1)  Too,
		ev.id_user idToo 
		FROM ml_cal_events ev WHERE status!='-1'

		


		) AS tmp
		ORDER BY tmp.fecha  DESC LIMIT 4

		";
		
		$query = $this->db->query($query);           
		return $query->result();
		

	}
	
	function relatedContacts($idMatter){
		
		$query = "  SELECT 
		CR.*, 
		(SELECT CONCAT(co.FirstName,co.LastName)  FROM ml_co_contact co WHERE co.Id=CR.IdContact LIMIT 1 ) AS ContactName 
		FROM 
		ml_ma_contact_related CR WHERE CR.IdMatter ='".$idMatter."'  ";




		
		$query = $this->db->query($query);           
		return $query->result();
		
	}


	

	//Only for this mmatter
	public function RecentOfMatter($Id){

		$query = "

		SELECT tmp.* FROM (
		
		SELECT 
		Id, 
		`Name` titulo, 
		`DateOpen` fecha,        
		'matter' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=`UserCreator` LIMIT 1)  Creator, 
		'created' Actions,
		'vacio' Too,
		Id AS idToo  
		FROM ml_ma_matters WHERE Id='$Id'
		UNION ALL  
		SELECT  
		n.IdMatter Id,
		SUBSTRING(n.Note,0,20) titulo, 
		n.Date fecha, 
		'note' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=n.Creator LIMIT 1) Creator,
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=n.IdMatter LIMIT 1)  Too,
		n.IdMatter idToo   

		FROM  ml_ma_notes AS n WHERE n.IdMatter='$Id'
		UNION ALL
		SELECT  
		Id,
		`Name` titulo, 
		UpdatedDate fecha, 
		'matter' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=`UserUpdater` LIMIT 1) Creator,  
		'updated' Actions ,
		'vacio' Too,
		Id AS idToo 
		FROM ml_ma_matters WHERE Id='$Id'
		UNION ALL
		SELECT 
		cr.IdContact Id, 
		(SELECT CONCAT(FirstName,' ',LastName) FROM ml_co_contact WHERE Id=cr.IdContact LIMIT 1) titulo, 
		`Date` fecha, 
		'contact' Object,
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=cr.Creator LIMIT 1) Creator,  
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=cr.IdMatter LIMIT 1) Too, 
		cr.IdMatter AS idToo
		FROM ml_ma_contact_related cr WHERE cr.IdMatter = '$Id'
		UNION ALL

		SELECT 
		ta.Task Id,
		(SELECT `Subject` FROM ml_ta_task WHERE Id=ta.Task LIMIT 1) titulo, 
		ta.Date fecha, 
		'task' Object,
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=ta.Creator LIMIT 1) Creator,  
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=ta.IdObject LIMIT 1) Too,
		ta.IdObject AS idToo
		FROM ml_ta_atach ta WHERE ta.IdObject= '$Id' AND ta.TypeObject = 'matter' 
		UNION ALL

		SELECT 
		d.Document Id,	
		(SELECT `FileName` FROM ml_do_documents WHERE Id=d.Document LIMIT 1) titulo, 
		d.Date fecha, 
		'doc' Object,
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=d.Creator LIMIT 1) Creator,  
		'added' Actions , 
		(SELECT `Name` FROM ml_ma_matters WHERE Id=d.IdObject LIMIT 1) Too,
		d.IdObject AS idToo
		FROM ml_do_atach d WHERE d.IdObject= '$Id' AND d.TypeObject = 'matter' 
		UNION ALL

		SELECT
		ev.id_event Id,
		(SELECT subject FROM ml_cal_events WHERE id=ev.id_event LIMIT 1) titulo, 
		ev.date fecha, 
		'event' Object,
		(SELECT CONCAT(Name , ' ', LastName ) FROM ml_us_users WHERE Id=ev.creator LIMIT 1) Creator,  
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=ev.id_attach LIMIT 1) Too,
		ev.id_attach AS idToo
		FROM ml_cal_events_attach ev WHERE  ev.type_attach='MATTER' AND ev.id_attach='$Id'
		UNION ALL

		SELECT  
		id Id,
		`description` titulo, 
		creation_date fecha, 
		'Time and expense' Object, 
		(SELECT CONCAT(`Name` , ' ', `LastName` ) FROM ml_us_users WHERE Id=id_user LIMIT 1) Creator,  
		'added' Actions,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=id_matter LIMIT 1) Too,
		id_matter AS idToo
		FROM ml_bi_time_expense WHERE id_matter='$Id'



		) AS tmp
		WHERE tmp.fecha!=''
		ORDER BY tmp.fecha  DESC LIMIT 4

		";
		
		$query = $this->db->query($query);           
		return $query->result();
		

	}
	
	public function relatedMatter($IdMatter){
		$query = "SELECT 
		mr.IdMatter2, 
		(SELECT Name FROM ml_ma_matters WHERE Id=mr.IdMatter2 LIMIT 1) AS NameMatter ,
		(SELECT DateOpen FROM ml_ma_matters WHERE Id=mr.IdMatter2 LIMIT 1) AS DateOpen
		FROM 
		ml_ma_matters_related mr WHERE mr.IdMatter1='".$IdMatter."'   ";

		
		$query = $this->db->query($query);
		return $query->result();

	}
	
	public function deleteRelMatter($IdMatter1,$IdMatter2){

		$stringQuery="DELETE FROM ml_ma_matters_related WHERE IdMatter1='".$IdMatter1."' AND  IdMatter2='".$IdMatter2."' ";
		$this->db->query($stringQuery);
		
		//echo $this->db->affected_rows();
		
		return $this->db->affected_rows();


	}
	
	public function searhMatter($criteria){

		$stringQuery="SELECT  Id, MatterID, Name  FROM ml_ma_matters
		WHERE 
		(Name LIKE '%".$criteria."%' OR 
		MatterID LIKE '%".$criteria."%' ) AND Status='1' LIMIT 20";

 		//echo $stringQuery;

		$query = $this->db->query($stringQuery);

		return $query->result();


	}
	
	//saveStafRelated
	public function saveRelMatter($data)
	{
		
		
		$this->db->insert('ml_ma_matters_related',$data);
		
		
		$insert_id = $this->db->insert_id();
		
		return $insert_id;
	}
	
	public function getOneRelMatter($array){
		
		$this->db->where($array);
		$this->db->select('*');
		$this->db->from('ml_ma_matters_related');
		$query = $this->db->get();

		return  $query->row();
	}

	public function relatedTask($idObjeto){
		
		$query = "
		SELECT 
		Id,
		Task, 
		(SELECT Subject FROM ml_ta_task WHERE Id=at.Task ) as Subject,
		(SELECT AssignTo FROM ml_ta_task WHERE Id=at.Task ) as AssignTo,
		(SELECT Date FROM ml_ta_task WHERE Id=at.Task ) as Date
		FROM ml_ta_atach at 

		WHERE 

		at.TypeObject='matter' AND at.IdObject='".$idObjeto."'    


		";

		$query = $this->db->query($query);           
		return $query->result();

	}




	public function relatedDoc($id){
		
		$query = "
		SELECT 
		at.Id, 
		at.IdObject,
		at.Document,
		(SELECT FileName FROM ml_do_documents WHERE Id=at.Document ) as FileName,
		(SELECT Description FROM ml_do_documents WHERE Id=at.Document ) as Description,
		(SELECT DateUpdated FROM ml_do_documents WHERE Id=at.Document ) as DateUpdated,
		(SELECT Type FROM ml_do_documents WHERE Id=at.Document ) as Type,
		(SELECT FisicalDir FROM ml_do_documents WHERE Id=at.Document) as Url

		FROM ml_do_atach at 

		WHERE 

		at.TypeObject='matter' AND at.IdObject='".$id."'    


		";

		$query = $this->db->query($query);           
		return $query->result();

	}


	public function search($criteria){

		$query = "
		SELECT tmp.* FROM (
		SELECT
		`Id`,
		`Name` titulo,      
		'matter' Object
		FROM ml_ma_matters WHERE Status !='-1' AND (Name LIKE '%$criteria%' OR MatterID LIKE '%$criteria%')
		UNION ALL
		SELECT  
		`IdMatter` Id,
		(SELECT `Name` FROM ml_ma_matters WHERE Id=IdMatter LIMIT 1) titulo,  
		'note' Object
		FROM  ml_ma_notes  WHERE Note LIKE '%$criteria%' 
		UNION ALL
		SELECT
		Id,
		CONCAT(c.FirstName , ' ', c.LastName ) AS titulo, 
		'contact' Object
		FROM ml_co_contact c WHERE MATCH (FirstName, LastName) AGAINST ('$criteria') 
		UNION ALL

		SELECT
		p.Contact as Id,
		CONCAT(c.FirstName,' ',c.LastName ) AS titulo, 
		'contact' Object
		FROM ml_co_phone p INNER JOIN ml_co_contact c on p.Contact=c.Id WHERE p.Phone LIKE '%$criteria%' 	
		UNION ALL
		SELECT
		Id,
		Subject titulo, 
		'task' Object
		FROM ml_ta_task   WHERE Subject LIKE '%$criteria%' 
		UNION ALL
		SELECT
		Id,
		FileName titulo, 
		'doc' Object
		FROM ml_do_documents WHERE   FileName LIKE '%$criteria%'
		
		UNION ALL
		SELECT
		ev.id Id,
		ev.subject titulo, 
		'event' Object
		FROM ml_cal_events ev WHERE `status`!='-1' AND ev.subject LIKE '%$criteria%' 
		UNION ALL
		SELECT  
		id Id,
		`description` titulo, 
		'Time and expense' Object 
		FROM ml_bi_time_expense WHERE description  LIKE '%$criteria%'

		) AS tmp
		ORDER BY 
		CASE
		WHEN tmp.titulo LIKE '%$criteria%' THEN 1
		WHEN tmp.titulo LIKE '%$criteria%' THEN 2
		
		ELSE 1
		END
		LIMIT 15	

		";
		
		$query = $this->db->query($query);           
		return $query->result();
		

	}


	
	public function InvoicesRel($matter){

		$query = " SELECT
		i.Id,
		i.Number, 
		i.DueDate,
		i.InvoiceDate,
		i.Status	 
		FROM 
		ml_bi_invoices i 
		WHERE i.BillTo='$matter' AND i.Status!='-1' order by i.DueDate asc";

		$query = $this->db->query($query);           
		return $query->result();
	}

	
	
	public function get_billing_status($id_matter)
	{
		$sql = "SELECT invoice.Status,invoice.DueDate,invoice.Object FROM ml_bi_invoices as invoice INNER JOIN ml_ma_matters as matter ON invoice.Object = matter.Id WHERE invoice.Object = '".$id_matter."'";
		$query = $this->db->query($sql);           
		return $query->result();

	} 




}

?>