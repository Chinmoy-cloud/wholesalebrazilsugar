<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faqs extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$urlPermission = array('faqs','add-faq','edit-faq');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		}else if( in_array($this->uri->segment(2), $urlPermission) && (!is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->library('Admin_ajax_pagination');
		$this->load->model('admin/faqs_model');
		$this->perPage = 10;
	}

	public function index(){
		$data = array('viewPage'=>'faqs/list','pageTitle'=>'Faqs','jsFiles'=>array('faqs','moment.min','daterangepicker.min'),'cssFiles'=>array('daterangepicker'),'activeMenus'=>array('all-faqs','faqs'));
		$data['main_cat'] = $this->db->select('name,id')->get_where('category', array('activated'=>1))->result();
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
        $totalRec = count($this->faqs_model->getList( $this->input->post() ));
        $config['base_url']    = base_url().'admin/forum-search-data';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->admin_ajax_pagination->initialize($config);

		$data['faqs'] = $this->faqs_model->getList( $this->input->post(),array('start'=>$offset,'limit'=>$this->perPage) );

		
		if( ( $offset + $this->perPage ) < ( $totalRec -1 ))
        $end = $offset + $this->perPage;
        else
        $end = $totalRec;

		$data['start'] = $offset+1;
		$data['end'] = $end;
		$data['total'] = $totalRec;

		$returnArr['html'] = $this->load->view('admin/faqs/ajax_list',$data,true);
		$returnArr['pagination'] = $this->load->view('admin/faqs/ajax_list_pagination',$data,true);
        echo json_encode($returnArr);
	}

	public function manageFaq($id=''){
		$data = array('viewPage'=>'faqs/manage','jsFiles'=>array('faqs'));
		$data['all_cat'] = $this->db->get_where('category', array('activated'=>1))->result();
		if($id){
			$data['pageTitle'] = 'Edit Faq';
			$data['activeMenus'] = array('all-faqs','edit-faq');
			$data['faqs'] = $this->faqs_model->getData($id);
		} else {
			$data['pageTitle'] = 'Add Faq';
			$data['activeMenus'] = array('all-faqs','add-faq');
			$data['faqs'] = array();
		}
		$this->load->view('admin/template/default',$data);
	}

	public function saveData(){
		$data = $this->input->post();

		if(isset($data['main_cat_id']) && isset($data['sub_cat_id'])){
			$category_id = array_merge($data['main_cat_id'],$data['sub_cat_id']);
			$data['category_id'] = implode(',', $category_id);
		}else if(isset($data['main_cat_id']) && !isset($data['sub_cat_id'])){
			$category_id = $data['main_cat_id'];
			$data['category_id'] = implode(',', $category_id);
		}else if(!isset($data['main_cat_id']) && isset($data['sub_cat_id'])){
			$category_id = $data['sub_cat_id'];
			$data['category_id'] = implode(',', $category_id);
		}
		if($data['id']){
	         $data['modified_by'] = $this->session->userdata('user_id');
		}else{
			$data['created_by'] = $this->session->userdata('user_id');
		}
		
		$return = $this->faqs_model->saveData($data);
		
		echo json_encode($return);
	}

	public function deleteData(){
		$return = $this->faqs_model->deleteData($this->input->post());
		echo json_encode($return);
	}

	public function statusChange(){
		$return = $this->faqs_model->statusChange($this->input->post());
		echo json_encode($return);
	}

	public function changeFeaturedForum(){
		$return = $this->faqs_model->changeFeaturedForum($this->input->post());
		echo json_encode($return);
	}

	public function saveOrdering(){
		$return = $this->faqs_model->saveOrdering($this->input->post());
		echo json_encode($return);
	}

}