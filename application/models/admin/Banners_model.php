<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	
	public function saveData($data=array()){
		//echo '<pre>';print_r($data);die();
		if($data['id']){
			$id = $data['id'];
			unset($data['id']);
			$data['home_banner'] =  (isset($data['home_banner'])?$data['home_banner']:2);
			$this->db->where('id',$id)->update('banner',$data);
		} else {
			$data['created_at'] = date('Y-m-d H:i:s');
			$this->db->insert('banner',$data);
		}

		return array('status'=>1,'msg'=>'Data successfully saved');
	}

}
?>