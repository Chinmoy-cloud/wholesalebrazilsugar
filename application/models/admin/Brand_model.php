<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brand_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getList($params = array(),$limit = array()){	

		$this->db->select('id,name,icon,tab_icon,description,created_date,status');
		$this->db->from('brands');

		if(isset($params['status']) && $params['status']){
			$this->db->where('brands.status',$params['status']);	
		}
		if(isset($params['keyword']) && $params['keyword']){
			$this->db->where('(brands.name LIKE "%'.$params['keyword'].'%")');	
		}

		if(isset($params['startEnd']) && $params['startEnd']){
			  $explode = explode('-', $params['startEnd']);
			  $starDate = $explode[0];
			  $endDate = $explode[1];
			   $st=date('Y-m-d',strtotime($starDate)).' 00:00:00';
			   $et=date('Y-m-d',strtotime($endDate)).' 23:59:00';
              $this->db->where('brands.created_date >=',$st);
			  $this->db->where('brands.created_date <=',$et);
		}

		if(isset($params['sortBy']) && $params['sortBy'] && isset($params['sortByField']) && $params['sortByField']){
			$this->db->order_by($params['sortByField'],$params['sortBy']);
		} else {
			$this->db->order_by('brands.id','DESC');
		}

		if(array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
			$this->db->limit($limit['limit'],$limit['start']);
		}elseif(!array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
			$this->db->limit($limit['limit']);
		}

		$query = $this->db->get();
		//echo $this->db->last_query(); die;
		return ($query->num_rows() > 0)?$query->result():array();

	}

	public function getData($id=''){
		return $this->db->get_where('brands',array('id'=>$id))->row();
	}

	public function saveData($data=array()){
		if($data['id']){
			$data['modified_at'] = date('Y-m-d H:i:s');			
			$id = $data['id'];
			unset($data['id']);
			$this->db->where('id',$id)->update('brands',$data);
		} else {
			$data['status'] = 1;
			$data['slug'] = time();
			$data['created_date'] = date('Y-m-d H:i:s');
			$this->db->insert('brands',$data);
		}

		return array('status'=>1,'msg'=>'Data successfully saved');
	}

	public function nameCheck($where=array()){
		$return = $this->db->get_where('brands',$where)->num_rows();
		if($return > 0){
			return array('status'=>2,'msg'=>'Name already exists.');
		} else {
			return array('status'=>1);
		}
	}

	public function statusChange($data=array()){
		$this->db->where('id',$data['id'])->update('brands',array('status'=>$data['status']));
		return array('status'=>1,'msg'=>'Status changed successfully.');
	}

	public function deleteData($data=array()){

		if($data['ids']){
			$ids = explode(',', $data['ids']);
			$getData = $this->db->where_in('id',$ids)->get('brands')->result();
			if($getData){
				foreach ($getData as $key => $value) {
					@unlink($value->image);
				}
				
			}
			$this->db->where_in('id',$ids)->delete('brands');
			return array('status'=>1,'msg'=>'Deleted successfully.');
		} else {
			return array('status'=>2,'msg'=>'Something went wrong,please try again later.');
		}
	}
}
?>