<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_settings_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function getPages(){
		return $this->db->select('title,id')->get_where('pages',array('page_type'=>'pages'))->result();
	}

	public function getPosts(){
		return $this->db->select('title,id')->order_by('ordering','ASC')->get_where('post',array('active'=>1))->result();
	}

	public function saveData($data=array()){
		$this->db->where('setting_key','menu')->where('usertype',$data['menu'])->update('setting',array('setting_value'=>serialize($data['jsonDdata']),'modified_at'=>date('Y-m-d H:i:s'),'modified_by'=>$this->session->userdata('user_id')));
		return array('status'=>1,'msg'=>'Updated successfully.');
	}

	public function getData($data=array()){
		return $this->db->select('setting_value')->get_where('setting',array('setting_key'=>'menu','usertype'=>$data['menu']))->row();
	}


}
?>