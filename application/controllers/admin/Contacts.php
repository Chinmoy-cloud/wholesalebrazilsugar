<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$urlPermission = array('contacts');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		} else if( in_array($this->uri->segment(2), $urlPermission) && (!is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->library('Admin_ajax_pagination');
		$this->load->model('admin/contacts_model');
		$this->perPage = 10;
	}

	public function index(){
		$data = array('viewPage'=>'contacts/list','pageTitle'=>'Contacts','jsFiles'=>array('contacts','moment.min','daterangepicker.min'),'cssFiles'=>array('daterangepicker'),'activeMenus'=>array('all-contacts','contacts'));
		$this->load->view('admin/template/default',$data);
	}

	public function ajaxPaginationSearch(){
        $returnArr = array();
		$page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $this->perPage = $this->input->post('perPage');
        $totalRec = count($this->contacts_model->getList( $this->input->post()));

        $config['base_url']    = base_url().'admin/contact-search-data';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->admin_ajax_pagination->initialize($config);
		$data['contacts'] = $this->contacts_model->getList( $this->input->post(),array('start'=>$offset,'limit'=>$this->perPage) );
		$returnArr['html'] = $this->load->view('admin/contacts/ajax_list',$data,true);
		$returnArr['pagination'] = $this->load->view('admin/contacts/ajax_list_pagination',$data,true);
        echo json_encode($returnArr);
	}

	public function statusChange(){
		$return = $this->contacts_model->statusChange($this->input->post());
		echo json_encode($return);
	}

	public function deleteData(){
		$return = $this->contacts_model->deleteData($this->input->post());
		echo json_encode($return);
	}
	
}
?>