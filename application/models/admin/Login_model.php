<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function login($data=array()){
		$query = $this->db->where_in('usertype',array('admins','vahiclesowner','employee'))->get_where('user',array('email'=>$data['email'],'password'=>md5($data['password'])))->row();
		if($query && $query->activated == 1){
			$this->session->set_userdata('user_id',$query->id);
			$this->session->set_userdata('role',$query->usertype);
			$return = array('status'=>1,'msg'=>'You have successfully logged in');
		} else if($query && $query->activated != 1){
			$return = array('status'=>2,'msg'=>'Your account is not activated');
		} else {
			$return = array('status'=>2,'msg'=>'Email/password is incorrect');
		}

		return $return;
	}
}
?>