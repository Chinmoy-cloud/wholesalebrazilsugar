<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$urlPermission = array('dashboard');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		} else if( in_array($this->uri->segment(2), $urlPermission) && (!is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->model('admin/dashboard_model');
	}

	public function index(){
		$data = array('viewPage'=>'dashboard','pageTitle'=>'Dashboard','activeMenus'=>array('dashboard'));
		$start = date('Y-m-d',strtotime(date('Y-m-d h:i:s', strtotime('today - 30 days')))).' 00:00:00';
		$end = date('Y-m-d').' 23:59:00';
		$data['count_product'] = $this->db->get_where('products',array('active'=>1))->num_rows();
		$data['total_enquiry'] = $this->db->get_where('contacts',array('status'=>1))->num_rows();
		$data['month_enquiry'] = $this->db->get_where('contacts',array('status'=>1,'created_at >='=>$start,'created_at <='=>$end))->num_rows();
		$data['today_enquiry'] = $this->db->get_where('contacts',array('status'=>1,'created_at >='=>date('Y-m-d').' 00:00:00','created_at <='=>date('Y-m-d').' 23:59:00'))->num_rows();
		$this->load->view('admin/template/default',$data);
	}
}
?>