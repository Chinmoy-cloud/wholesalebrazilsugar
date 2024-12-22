<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getList($params = array(),$limit = array()){

		$admin_query = $this->db->query('SELECT demo_admin FROM user WHERE id = '.$this->session->userdata('user_id').'');
		$admin_result = $admin_query->row_array();

		$this->db->select('id,name,email,created_date,activated');
		$this->db->from('user');
		$this->db->where('usertype','employee');
		if(isset($admin_result['demo_admin']) && $admin_result['demo_admin'] == 1){
			$this->db->where('created_by',$this->session->userdata('user_id'));
		}

		if(isset($params['status']) && $params['status']){
			$this->db->where('user.activated',$params['status']);	
		}
		if(isset($params['keyword']) && $params['keyword']){
			$this->db->where('(user.name LIKE "%'.$params['keyword'].'%" OR user.email LIKE "%'.$params['keyword'].'%")');	
		}

		if(isset($params['startEnd']) && $params['startEnd']){
			  $explode = explode('-', $params['startEnd']);
			  //print_r($explode)
			 // print_r($explode);die;
			  $starDate = $explode[0];
			  $endDate = $explode[1];
			   $st=date('Y-m-d',strtotime($starDate)).' 00:00:00';
			   $et=date('Y-m-d',strtotime($endDate)).' 23:59:00';
              $this->db->where('user.created_date >=',$st);
			  $this->db->where('user.created_date <=',$et);
		}

		if(isset($params['sortBy']) && $params['sortBy'] && isset($params['sortByField']) && $params['sortByField']){
			$this->db->order_by($params['sortByField'],$params['sortBy']);
		} else {
			$this->db->order_by('user.id','DESC');
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
		$admin_query = $this->db->query('SELECT demo_admin FROM user WHERE id = '.$this->session->userdata('user_id').'');
		$admin_result = $admin_query->row_array();
		if (isset($admin_result['demo_admin']) && $admin_result['demo_admin'] == 1) {
			return $this->db->get_where('user',array('id'=>$id,'created_by'=>$this->session->userdata('user_id')))->row();
		}else{
			return $this->db->get_where('user',array('id'=>$id))->row();
		}
	}

	public function saveData($data=array()){
		unset($data['role_sub']);
		unset($data['role_parent']);			
		if($data['id']){
			$data['modified_at'] = date('Y-m-d H:i:s');
			if($data['password'] == ''){
				unset($data['password']);
				$data['name'] = $data['firstname'].' '.$data['lastname'];
			} else {
				$data['name'] = $data['firstname'].' '.$data['lastname'];
				$data['password'] = md5($data['password']);
			}
			$id = $data['id'];
			unset($data['id']);
			$this->db->where('id',$id)->update('user',$data);
		} else {
			$data['name'] = $data['firstname'].' '.$data['lastname'];
			$data['password'] = md5($data['password']);
			$data['created_date'] = date('Y-m-d H:i:s');
			$this->db->insert('user',$data);
		}

		return array('status'=>1,'msg'=>'Data successfully saved');
	}

	public function emailCheck($where=array()){

		$return = $this->db->get_where('user',$where)->num_rows();
		if($return > 0){
			return array('status'=>2,'msg'=>'Email already exists.');
		} else {
			return array('status'=>1);
		}
	}

	public function statusChange($data=array()){

		$this->db->where('id',$data['id'])->update('user',array('activated'=>$data['status']));
		return array('status'=>1,'msg'=>'Status changed successfully.');
	}

	public function deleteData($data=array()){

		if($data['ids']){
			$ids = explode(',', $data['ids']);
			$getData = $this->db->where_in('id',$ids)->get('user')->result();
			if($getData){
				foreach ($getData as $key => $value) {
					@unlink($value->profile);
				}
				
			}
			$this->db->where_in('id',$ids)->delete('user');
			return array('status'=>1,'msg'=>'Deleted successfully.');
		} else {
			return array('status'=>2,'msg'=>'Something went wrong,please try again later.');
		}
	}
}
?>