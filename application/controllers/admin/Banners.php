<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$urlPermission = array('banners');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		} else if( in_array($this->uri->segment(2), $urlPermission) && (!is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->library('Admin_ajax_pagination');
		$this->load->model('admin/banners_model');
		$this->perPage = 10;
	}

	public function index(){

		$data = array('viewPage'=>'banners/list','pageTitle'=>'Banners list page','jsFiles'=>array('banners'),'activeMenus'=>array());
		$this->load->view('admin/template/default',$data);
	}

	
	public function BannersManage(){
		$data = array('viewPage'=>'banners/manage','jsFiles'=>array('banners'));
		$type = $this->uri->segment(3);
		$type_id = $this->uri->segment(4);
		
		$pagetitle = '';
		if($type == 'categories'){
			$pagetitle = ' for '.getCatImage($type_id,'name').' category';
		} else if($type == 'subcategories'){
			$pagetitle = ' for '.getCatImage($type_id,'name').' sub category';
		} else if($type == 'blog'){
			$pagetitle = ' for '.getBlogImage($type_id,'title').' blog';
		} else if($type == 'pages'){
			$pagetitle = ' for '.getPageDetails($type_id,'title').' page';
		}
		$data['breadcrumb'] = $pagetitle;

		$data['type'] = $type;
		$data['type_id'] = $type_id;
		$data['banners'] = $this->db->get_where('banner',array('page_type_id'=>$type_id,'page_type'=>$type))->row();
		if($data['banners']){
			$data['pageTitle'] = 'Edit Banner';
			$data['activeMenus'] = array();
		} else {
			$data['pageTitle'] = 'Add Banner';
			$data['activeMenus'] = array();
			$data['banners'] = array();
		}
		$this->load->view('admin/template/default',$data);
	}

	public function saveData(){
		$data = $this->input->post();
		if($data['id']){
          $data['modified_by'] = $this->session->userdata('user_id');
            $data['modified_at'] = date('Y-m-d H:i:s');
		}else{
          $data['created_by'] = $this->session->userdata('user_id');
          $data['created_at'] = date('Y-m-d H:i:s');
		}
		$uploadFile = $this->doUpload($_FILES,$data['image']);
		if($uploadFile['status'] == 1){
			$data['image'] = ($uploadFile['image'])?$uploadFile['image']:$data['image'];
			$return = $this->banners_model->saveData($data);			
		}else{
			$return = $uploadFile;
		}
		echo json_encode($return);
	}


	public function doUpload($FILES,$image){

		if($FILES['images']['name']){

			$config['upload_path']          = 'uploads/banner';

			if(!is_dir($config['upload_path'])){
				mkdir($config['upload_path'],0777,TRUE);
			}

			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 10000;
			$config['max_width']            = 20000;
			$config['max_height']           = 10000;
			$config['file_name'] 			= time().$FILES['images']['name'];

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('images')){
				return array('status'=>2,'msg'=>$this->upload->display_errors()); 
			}else{
				@unlink($image);
				return array('status'=>1,'image'=>$config['upload_path'].'/' . $this->upload->data()['file_name']);
			}
		} else {

			return array('status'=>1,'image'=>'');
		}

	}

}
?>