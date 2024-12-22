<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getList($params = array(),$limit = array()){
		$this->db->select('contacts.id,contacts.name,contacts.email,contacts.phone,contacts.message,contacts.type,contacts.status,contacts.created_at,products.title as product_name');
		$this->db->from('contacts');
		$this->db->join('products','products.id=contacts.product_id','left');
		if(isset($params['keyword']) && $params['keyword']){
			$this->db->where('((contacts.name LIKE "%'.$params['keyword'].'%") OR (contacts.email LIKE "%'.$params['keyword'].'%") OR (contacts.phone LIKE "%'.$params['keyword'].'%"))');	
		}
		if(isset($params['status']) && $params['status']){
			$this->db->where('contacts.status',$params['status']);
		}
		if(isset($params['type']) && $params['type']){
			$this->db->where('contacts.type',$params['type']);
		}
		if(isset($params['sortBy']) && $params['sortBy'] && isset($params['sortByField']) && $params['sortByField']){
			$this->db->order_by($params['sortByField'],$params['sortBy']);
		} else {
			$this->db->order_by('contacts.id','DESC');
		}		
		if(isset($params['startEnd']) && $params['startEnd']){
			  $explode = explode('-', $params['startEnd']);
			  $starDate = $explode[0];
			  $endDate = $explode[1];
			   $st=date('Y-m-d',strtotime($starDate)).' 00:00:00';
			   $et=date('Y-m-d',strtotime($endDate)).' 23:59:00';
              $this->db->where('contacts.created_at >=',$st);
			  $this->db->where('contacts.created_at <=',$et);
		}
		if(array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
			$this->db->limit($limit['limit'],$limit['start']);
		}elseif(!array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
			$this->db->limit($limit['limit']);
		}
		$query = $this->db->get();
		return ($query->num_rows() > 0)?$query->result():array();
	}

	public function getData($alias=''){
		return $this->db->get_where('contacts',array('slug'=>$alias))->row();
	}	

	public function statusChange($data=array()){
		$this->db->where('id',$data['id'])->update('contacts',array('status'=>$data['status']));
		return array('status'=>1,'msg'=>'Status changed successfully.');
	}


	public function deleteData($data=array()){
		if($data['ids']){
			$ids = explode(',', $data['ids']);
			$this->db->where_in('id',$ids)->delete('contacts');
			return array('status'=>1,'msg'=>'Deleted successfully.');
		} else {
			return array('status'=>2,'msg'=>'Something went wrong,please try again later.');
		}
	}


}
?>