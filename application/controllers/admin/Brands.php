<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Brands extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$urlPermission = array('brands','add-brand','edit-brand');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		} else if( in_array($this->uri->segment(2), $urlPermission) &&  ( !is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->library('Admin_ajax_pagination');
		$this->load->model('admin/brand_model');
		$this->perPage = 10;
	}

	public function index(){
		$data = array('viewPage'=>'brands/list','pageTitle'=>'Brands','jsFiles'=>array('brands','moment.min','daterangepicker.min'),'cssFiles'=>array('daterangepicker'),'activeMenus'=>array('all-brands','brands'));
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

        $totalRec = count($this->brand_model->getList($this->input->post()));

        $this->perPage = $this->input->post('perPage');
        $config['base_url']    = base_url().'admin/brand-search-data';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->admin_ajax_pagination->initialize($config);

		$data['brands'] = $this->brand_model->getList($this->input->post(),array('start'=>$offset,'limit'=>$this->perPage));
		//echo "<pre>"; print_r($data['vendors']); die;

		$returnArr['html'] = $this->load->view('admin/brands/ajax_list',$data,true);
		$returnArr['pagination'] = $this->load->view('admin/brands/ajax_list_pagination',$data,true);
        echo json_encode($returnArr);

	}

	public function manageBrand($id=''){
		$data = array('viewPage'=>'brands/manage','jsFiles'=>array('brands'));
		if($id){
			$data['pageTitle'] = 'Edit Brand';
			$data['activeMenus'] = array('all-brands','edit-brand');			
			$data['users'] = $this->brand_model->getData($id);
		} else {
			$data['pageTitle'] = 'Add Brand';
			$data['activeMenus'] = array('all-brands','add-brand');
			$data['users'] = array();
		}
		$data['role_manage'] = ManuArrange();
		$this->load->view('admin/template/default',$data);
	}

	public function saveData(){
		$data = $this->input->post();		
		$uploadFile = $this->doUpload($_FILES,$data['image']);
		if($uploadFile['status'] == 1){
			$data['image'] = ($uploadFile['image'])?$uploadFile['image']:$data['image'];
			if($data['id']){
				$data['modified_by'] = $this->session->userdata('user_id');
				$nameCheckWhere = array('id != '=>$data['id'],'name'=>$data['name']);
			} else {
				$data['created_by'] = $this->session->userdata('user_id');
				$nameCheckWhere = array('name'=>$data['name']);
			}
			$nameCheck = $this->brand_model->nameCheck($nameCheckWhere);
			if($nameCheck['status'] == 1){
				$return = $this->brand_model->saveData($data);
			} else {
				$return = $nameCheck;
			}
		} else {
			$return = $uploadFile;
		}
		echo json_encode($return);
	}

	public function statusChange(){

		$return = $this->brand_model->statusChange($this->input->post());
		echo json_encode($return);
	}

	public function doUpload($FILES,$profile){

		if($FILES['image']['name']){

			$config['upload_path']          = 'uploads/brands';

			if(!is_dir($config['upload_path'])){
				mkdir($config['upload_path'],0777,TRUE);
			}

			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;
			$config['max_width']            = 20000;
			$config['max_height']           = 10000;
			$config['file_name'] 			= time().$FILES['image']['name'];

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image')){
				return array('status'=>2,'msg'=>$this->upload->display_errors()); 
			}else{
				@unlink($profile);
				return array('status'=>1,'image'=>$config['upload_path'].'/' . $this->upload->data()['file_name']);
			}
		} else {

			return array('status'=>1,'image'=>'');
		}
		
	}

	public function deleteData(){
		$return = $this->brand_model->deleteData($this->input->post());
		echo json_encode($return);
	}

}
?>