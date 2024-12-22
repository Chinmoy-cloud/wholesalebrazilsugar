<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emails_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getList($params = array(),$limit = array()){

		$this->db->select('id,subject,email_for,code,created_at');
		$this->db->from('email');

		if(isset($params['keyword']) && $params['keyword']){
			$this->db->where('(email.code LIKE "%'.$params['keyword'].'%" OR email.subject LIKE "%'.$params['keyword'].'%" OR email.email_for LIKE "%'.$params['keyword'].'%")');	
		}

			if(isset($params['startEnd']) && $params['startEnd']){
			  $explode = explode('-', $params['startEnd']);
			  $starDate = $explode[0];
			  $endDate = $explode[1];
			   $st=date('Y-m-d',strtotime($starDate)).' 00:00:00';
			   $et=date('Y-m-d',strtotime($endDate)).' 23:59:00';
              $this->db->where('email.created_at >=',$st);
			  $this->db->where('email.created_at <=',$et);
		}

		if(isset($params['sortBy']) && $params['sortBy'] && isset($params['sortByField']) && $params['sortByField']){
			$this->db->order_by($params['sortByField'],$params['sortBy']);
		} else {
			$this->db->order_by('email.id','DESC');
		}

		if(array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
			$this->db->limit($limit['limit'],$limit['start']);
		}elseif(!array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
			$this->db->limit($limit['limit']);
		}

		$query = $this->db->get();
		// echo $this->db->last_query();die();
		return ($query->num_rows() > 0)?$query->result():array();

	}

	public function getData($id=''){

		return $this->db->get_where('email',array('id'=>$id))->row();
	}

	public function saveData($data=array()){
		if($data['id']){
			$id = $data['id'];
			unset($data['id']);
			$this->db->where('id',$id)->update('email',$data);
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$this->db->insert('email',$data);
		}

		return array('status'=>1,'msg'=>'Data successfully saved');
	}

	
}
?>