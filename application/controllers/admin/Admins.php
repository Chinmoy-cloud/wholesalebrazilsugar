<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admins extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$urlPermission = array('admins','add-admin','edit-admin');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		} else if( in_array($this->uri->segment(2), $urlPermission) && (!is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->library('Admin_ajax_pagination');
		$this->load->model('admin/admins_model');
		$this->perPage = 10;
	}

	public function index(){

		$data = array('viewPage'=>'admins/list','pageTitle'=>'Admins','jsFiles'=>array('admins','moment.min','daterangepicker.min'),'cssFiles'=>array('daterangepicker'),'activeMenus'=>array('all-admins','admins'));
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
        $totalRec = count($this->admins_model->getList( $this->input->post() ));

        $config['base_url']    = base_url().'admin/admin-search-data';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->admin_ajax_pagination->initialize($config);

		$data['admins'] = $this->admins_model->getList( $this->input->post(),array('start'=>$offset,'limit'=>$this->perPage) );

		$returnArr['html'] = $this->load->view('admin/admins/ajax_list',$data,true);
		$returnArr['pagination'] = $this->load->view('admin/admins/ajax_list_pagination',$data,true);
        echo json_encode($returnArr);

	}

	public function manageAdmin($id=''){

		$data = array('viewPage'=>'admins/manage','jsFiles'=>array('admins'));
		if($id){
			$data['pageTitle'] = 'Edit Admin';
			$data['activeMenus'] = array('all-admins','edit-admin');
			$data['admins'] = $this->admins_model->getData($id);
		} else {
			$data['pageTitle'] = 'Add Admin';
			$data['activeMenus'] = array('all-admins','add-admin');
			$data['admins'] = array();
		}
		$data['role_manage'] = ManuArrange();
		//echo "<pre>"; print_r($data['role_manage']); die;
		$this->load->view('admin/template/default',$data);
	}

	public function saveData(){

		$data = $this->input->post();

		// if(isset($data['role_parent']) && isset($data['role_sub'])){
		// 	$role_data = array_merge($data['role_parent'],$data['role_sub']);
		// 	array_push($role_data,"dashboard");
		// 	$data['role_manage'] = json_encode($role_data);
		// }else if(isset($data['role_parent']) && !isset($data['role_sub'])){
		// 	$role_data = $data['role_parent'];
		// 	array_push($role_data,"dashboard");
		// 	$data['role_manage'] = json_encode($role_data);
		// }else{
		// 	$role_data = array("dashboard");
		// 	$data['role_manage'] = json_encode($role_data);
		// }

		$uploadFile = $this->doUpload($_FILES,$data['profile']);
		if($uploadFile['status'] == 1){
			$data['profile'] = ($uploadFile['profile'])?$uploadFile['profile']:$data['profile'];
			if($data['id']){
				$data['modified_by'] = $this->session->userdata('user_id');
				$emailCheckWhere = array('id != '=>$data['id'],'email'=>$data['email']);
			} else {
				$data['created_by'] = $this->session->userdata('user_id');
				$emailCheckWhere = array('email'=>$data['email']);
			}
			$emailCheck = $this->admins_model->emailCheck($emailCheckWhere);
			if($emailCheck['status'] == 1){
				$return = $this->admins_model->saveData($data);
			} else {
				$return = $emailCheck;
			}
		} else {
			$return = $uploadFile;
		}
		echo json_encode($return);
	}

	public function statusChange(){

		$return = $this->admins_model->statusChange($this->input->post());
		echo json_encode($return);
	}

	public function doUpload($FILES,$profile){

		if($FILES['image']['name']){

			$config['upload_path']          = 'uploads/user/avatars';

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
				return array('status'=>1,'profile'=>$config['upload_path'].'/' . $this->upload->data()['file_name']);
			}
		} else {

			return array('status'=>1,'profile'=>'');
		}
		
	}

	public function deleteData(){

		$return = $this->admins_model->deleteData($this->input->post());
		echo json_encode($return);
	}

}
?>