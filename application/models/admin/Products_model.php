<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getList($params = array(),$limit = array()){
		$this->db->select('id,title,alias,created_date,featured,active,price,sale_price');
		$this->db->from('products');
		if(isset($params['status']) && $params['status']){
			$this->db->where('products.active',$params['status']);	
		}

		if(isset($params['startEnd']) && $params['startEnd']){
			  $explode = explode('-', $params['startEnd']);
			  $starDate = $explode[0];
			  $endDate = $explode[1];
			   $st=date('Y-m-d',strtotime($starDate)).' 00:00:00';
			   $et=date('Y-m-d',strtotime($endDate)).' 23:59:00';
              $this->db->where('products.created_date >=',$st);
			  $this->db->where('products.created_date <=',$et);
		}

		
		if(isset($params['keyword']) && $params['keyword']){
			$this->db->where('(products.title LIKE "%'.$params['keyword'].'%")');	
		}

		if(isset($params['featured']) && $params['featured']){
			$this->db->where('products.featured',$params['featured']);	
		}

		if(isset($params['sortBy']) && $params['sortBy'] && isset($params['sortByField']) && $params['sortByField']){
			$this->db->order_by($params['sortByField'],$params['sortBy']);
		} else {
			$this->db->order_by('products.id','DESC');
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
		return $this->db->get_where('products',array('alias'=>$alias))->row();
	}

	public function saveData($data=array()){
		if($data['id']){
			$id = $data['id'];
			$data['modified_at'] = date('Y-m-d H:i:s');
			unset($data['id']);
			$this->db->where('id',$id)->update('products',$data);
		} else {			
			$data['created_date'] = date('Y-m-d H:i:s');
			$this->db->insert('products',$data);
		}
		return array('status'=>1,'msg'=>'Data successfully saved');
	}

	public function aliasCheck($where=array()){
		$return = $this->db->get_where('products',$where)->num_rows();
		if($return > 0){
			return array('status'=>2,'msg'=>'Product alias already exists.');
		} else {
			return array('status'=>1);
		}
	}

	public function statusChange($data=array()){
		$updateData = $this->db->where('id',$data['id'])->update('products',array('active'=>$data['status']));
		return array('status'=>1,'msg'=>'Status changed successfully.');
	}

	public function deleteData($data=array()){
		if($data['ids']){
			$ids = explode(',', $data['ids']);
			$getData = $this->db->where_in('id',$ids)->get('products')->result();
			if($getData){
				foreach ($getData as $key => $value) {
					@unlink('./uploads/product/'.$value->logo);	
					@unlink('./uploads/product/70x70/'.$value->logo);
					@unlink('./uploads/product/150x150/'.$value->logo);
					@unlink('./uploads/product/350x250/'.$value->logo);	
				}				
			}
			$this->db->where_in('id',$ids)->delete('products');
			return array('status'=>1,'msg'=>'Deleted successfully.');
		} else {
			return array('status'=>2,'msg'=>'Something went wrong,please try again later.');
		}
	}

	public function saveOrdering($data=array()){
		if($data['ids']){
			foreach ($data['ids'] as $key => $value) {
				$this->db->where('id',$value)->update('products',array('ordering'=>$data['ordering'][$key]));
			}
			return array('status'=>1,'msg'=>'Updated successfully.');
		}
	}

	public function changeFeaturedProduct($data=array()){
		$this->db->where('id',$data['id'])->update('products',array('featured'=>$data['featured']));
		return array('status'=>1,'msg'=>'Product featured successfully.');
	}


}
?>