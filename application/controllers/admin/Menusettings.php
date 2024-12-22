<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menusettings extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$urlPermission = array('menu-settings');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		} else if( in_array($this->uri->segment(2), $urlPermission) && (!is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->library('Admin_ajax_pagination');
		$this->load->model('admin/menu_settings_model');
		$this->perPage = 10;
	}

	public function index(){
		$data = array('viewPage'=>'menu-settings/list','pageTitle'=>'Menu Settings','jsFiles'=>array('menu-settings','jquery.mjs.nestedSortable','jquery.ui.touch-punch'),'activeMenus'=>array('settings','menu-settings'));
		$data['pages'] = $this->menu_settings_model->getPages();
		$data['posts'] = $this->menu_settings_model->getPosts();
		$this->load->view('admin/template/default',$data);
	}

	public function saveData(){
		$return = $this->menu_settings_model->saveData($this->input->post());
		echo json_encode($return);
	}

	public function getData(){
		$data['menus'] = $this->menu_settings_model->getData($this->input->post());
		$html = $this->load->view('admin/menu-settings/ajax-list',$data,true);
		echo json_encode(array('html'=>$html));
	}

}
?>