<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar_model extends CI_Model {

	function owners_get(){
		$sql="SELECT * FROM ml_us_users WHERE state=1";
		$r=$this->db->query($sql)->result();
		return $r;
	}

	function attach_search($s){
		$sql="SELECT tmp.* FROM (
				SELECT a.Id, a.Name, a.Status,'MATTER' AS 'type' FROM ml_ma_matters a WHERE a.Name LIKE '%".$s."%'
				UNION ALL
				SELECT a.Id, a.Title 'Name', '1' AS 'Status','CONTACT' AS 'type' FROM ml_co_contact a WHERE a.Title LIKE '%".$s."%'
				) AS tmp ORDER BY 
				CASE
				    WHEN tmp.name LIKE '".$s."%' THEN 1
				    WHEN tmp.name LIKE '%".$s."' THEN 3
				    ELSE 2
				END
				LIMIT 100";

		$r=$this->db->query($sql)->result();
		return $r;
	}
	function event_save($event){
		if(isset($event["id"]) && $event["id"]>0){
			$this->db->update("ml_cal_events",$event,array("id"=>$event["id"]));
			return $event["id"];
		}else{
			$this->db->insert("ml_cal_events",$event);
			return $this->db->insert_id();
		}
	}
	function attach_event_save($attachs){
		$id_event=$attachs[0]["id_event"];
		$this->db->delete("ml_cal_events_attach",array("id_event"=>$id_event));
		$this->db->insert_batch("ml_cal_events_attach",$attachs);
	}
	function events_get($users,$year,$month){
		$next_month=$month+1;
		$next_year=$year;
		if($next_month>12){
			$next_month=1;
			$next_year++;
		}
		if($next_month<10){
			$next_month="0".$next_month;
		}
		$sql="
		select 
		id,id_user,subject,location,start_date,start_time,end_date,end_time,start_fulldate,end_fulldate,description,status,all_day, (DATEDIFF(end_fulldate,start_fulldate)+1) days, (DAYOFWEEK(start_fulldate)-1) weekday
		from ml_cal_events a WHERE a.status=1 AND (date_format(a.start_fulldate,'%Y-%m')='".$year."-".$month."' OR date_format(a.start_fulldate,'%Y-%m')='".$next_year."-".$next_month."' ) AND a.id_user IN (".implode(",",$users).")";
		$sql.=" ORDER BY a.start_date ASC, (DATEDIFF(end_fulldate,start_fulldate)+1) DESC";
		//echo $sql;
		$r=$this->db->query($sql)->result();
		return $r;
	}
	function event_get($id_event){
		$sql="select * from ml_cal_events a WHERE a.id=?";
		$r=$this->db->query($sql,array($id_event))->row();
		if(isset($r->id)){
			$sql="SELECT *,
					IF(a.type_attach='MATTER',
					(SELECT b.Name FROM ml_ma_matters b WHERE b.Id=a.id_attach),
					(SELECT c.Title FROM ml_co_contact c WHERE c.Id=a.id_attach)) name_attach
					 FROM ml_cal_events_attach a WHERE a.id_event=?";
			$r->attachs=$this->db->query($sql,array($id_event))->result();
			return $r;
		}
		return false;
	}
	function events_by_matter($id_matter){
		$sql="SELECT b.id, b.subject
				FROM ml_cal_events_attach a INNER JOIN ml_cal_events b ON a.id_event=b.id AND a.type_attach='MATTER'
				WHERE a.id_attach=?";
		$r=$this->db->query($sql,array($id_matter))->result();
		return $r;
	}
	function matter_get_by_id($id){
		$sql="SELECT a.Id, a.Name FROM ml_ma_matters a WHERE a.Id=?";
		$r=$this->db->query($sql,array($id))->row();
		if(isset($r->Id)){
			return $r;
		}
		return false;
	}
	function event_delete($id_event){
		$this->db->update("ml_cal_events",array("status"=>-1),array("id"=>$id_event));
	}
}

/* End of file Calendar_model.php */
/* Location: ./application/models/Calendar_model.php */