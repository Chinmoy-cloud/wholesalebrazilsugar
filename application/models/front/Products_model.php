<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getList($params = array(),$limit = array()){
		$this->db->select('id,title,alias,created_date,featured,active,logo,short_description');
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

		// if(array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
		// 	$this->db->limit($limit['limit'],$limit['start']);
		// }elseif(!array_key_exists("start",$limit) && array_key_exists("limit",$limit)){
		// 	$this->db->limit($limit['limit']);
		// }

		$query = $this->db->get();
		return ($query->num_rows() > 0)?$query->result():array();

	}

	public function getDetails($alias=''){
		$this->db->select('products.id,products.title,products.alias,products.created_date,products.featured,products.active,products.price,products.sale_price,brands.name as brand_name,products.horspower,products.weight,products.shaft_length,products.short_description,products.description,products.logo');
		$this->db->from('products');
		$this->db->join('brands','brands.id=products.brand_id','left');
		$this->db->where('products.active',1);	
		$this->db->where('products.alias',$alias);
		$query = $this->db->get();
		return ($query->num_rows() > 0)?$query->row():array();
	}
}
?>