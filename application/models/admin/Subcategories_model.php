<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategories_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getList($params = array(),$limit = array()){

		$this->db->select('id,name,alias,activated,popular,created_at');
		$this->db->from('category');
		$this->db->where('category_type','sub');

		if(isset($params['status']) && $params['status']){
			$this->db->where('category.activated',$params['status']);	
		}
		if(isset($params['keyword']) && $params['keyword']){
			$this->db->where('(category.name LIKE "%'.$params['keyword'].'%")');	
		}

		if(isset($params['startEnd']) && $params['startEnd']){
			  $explode = explode('-', $params['startEnd']);
			  $starDate = $explode[0];
			  $endDate = $explode[1];
			   $st=date('Y-m-d',strtotime($starDate)).' 00:00:00';
			   $et=date('Y-m-d',strtotime($endDate)).' 23:59:00';
              $this->db->where('category.created_at >=',$st);
			  $this->db->where('category.created_at <=',$et);
		}
		if(isset($params['sortBy']) && $params['sortBy'] && isset($params['sortByField']) && $params['sortByField']){
			$this->db->order_by($params['sortByField'],$params['sortBy']);
		} else {
			$this->db->order_by('category.id','DESC');
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
		return $this->db->get_where('category',array('alias'=>$alias,'category_type' =>'sub'))->row();
	}

	public function saveData($data=array()){
		if($data['id']){
			$id = $data['id'];
			$data['updated_at'] = date('Y-m-d H:i:s');
			unset($data['id']);
			$this->db->where('id',$id)->update('category',$data);
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$this->db->insert('category',$data);
		}
		return array('status'=>1,'msg'=>'Data successfully saved');
	}

	public function aliasCheck($where=array()){

		$return = $this->db->get_where('category',$where)->num_rows();
		if($return > 0){
			return array('status'=>2,'msg'=>'Category alias already exists.');
		} else {
			return array('status'=>1);
		}
	}

	public function getCategory(){
		$query = $this->db->query('Select * from category where activated=1 order by name');
		$prepare_category = $query->result_array();
		$result_main = array();
		foreach($prepare_category as $key => $prepare_categories){
			if($prepare_categories['category_type'] == 'main'){
				$prepare_categories['sub'] = array();
				array_push($result_main,$prepare_categories);
			}
		}					
		foreach($prepare_category as $key => $value){				
			if($value['rootcategoryid']){
				foreach($result_main as $key => $category){
					if($category['id'] == $value['rootcategoryid']){
						array_push($result_main[$key]['sub'],$value);
					}
				}
			}
		}

		return $result_main;
	}

	public function statusChange($data=array()){

		$this->db->where('id',$data['id'])->update('category',array('activated'=>$data['status']));
		return array('status'=>1,'msg'=>'Status changed successfully.');
	}

	public function deleteData($data=array()){

		if($data['ids']){
			$ids = explode(',', $data['ids']);
			$getData = $this->db->where_in('id',$ids)->get('category')->result();
			if($getData){
				foreach ($getData as $key => $value) {
					@unlink($value->logo);
				}
				
			}
			$this->db->where_in('id',$ids)->delete('category');
			return array('status'=>1,'msg'=>'Deleted successfully.');
		} else {
			return array('status'=>2,'msg'=>'Something went wrong,please try again later.');
		}
	}


}
?>