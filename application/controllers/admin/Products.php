<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();

		$urlPermission = array('products','add-product','edit-product');
		$userPermission = getUserDetails($this->session->userdata('user_id'),'role_manage');
		if(!$this->session->userdata('user_id')){
			redirect('admin/logout');
		} else if( in_array($this->uri->segment(2), $urlPermission) && (!is_array($userPermission) || !in_array($this->uri->segment(2), $userPermission)) ){
			redirect('admin/logout');
		}
		$this->load->library('Admin_ajax_pagination');
		$this->load->model('admin/products_model');
		$this->perPage = 10;
	}

	public function index(){
		$data = array('viewPage'=>'products/list','pageTitle'=>'Products','jsFiles'=>array('products','moment.min','daterangepicker.min'),'cssFiles'=>array('daterangepicker'),'activeMenus'=>array('all-products','products'));
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
        $totalRec = count($this->products_model->getList( $this->input->post() ));

        $config['base_url']    = base_url().'admin/product-search-data';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->admin_ajax_pagination->initialize($config);

		$data['products'] = $this->products_model->getList( $this->input->post(),array('start'=>$offset,'limit'=>$this->perPage) );
		if( ( $offset + $this->perPage ) < ( $totalRec -1 ) )
        $end = $offset + $this->perPage;
        else
        $end = $totalRec;

		$data['start'] = $offset+1;
		$data['end'] = $end;
		$data['total'] = $totalRec;

		$returnArr['html'] = $this->load->view('admin/products/ajax_list',$data,true);
		$returnArr['pagination'] = $this->load->view('admin/products/ajax_list_pagination',$data,true);
        echo json_encode($returnArr);

	}

	public function manageProduct($alias=''){
		$data = array('viewPage'=>'products/manage','jsFiles'=>array('products'));
		$data['brands'] = $this->db->get_where('brands',array('status'=>1))->result();
		if($alias){
			$data['pageTitle'] = 'Edit Products';
			$data['activeMenus'] = array('all-products','edit-product');
			$data['products'] = $this->products_model->getData($alias);
		} else {
			$data['pageTitle'] = 'Add Products';
			$data['activeMenus'] = array('all-products','add-product');
			$data['products'] = array();
		}
		$this->load->view('admin/template/default',$data);
	}

	public function saveData(){
		$data = $this->input->post();
		$data['user_id'] = $this->session->userdata('user_id');	
		$uploadFile = $this->doUpload($_FILES,$data['logo']);
		if($uploadFile['status'] == 1){
			$data['logo'] = ($uploadFile['logo'])?$uploadFile['logo']:$data['logo'];
			if($data['id']){
				$data['modified_by'] = $this->session->userdata('user_id');
				$alaisCheckWhere = array('id != '=>$data['id'],'alias'=>$data['alias']);
			}else{
				$data['created_by'] = $this->session->userdata('user_id');
				$alaisCheckWhere = array('alias'=>$data['alias']);
			}
			$aliasCheck = $this->products_model->aliasCheck($alaisCheckWhere);
			if($aliasCheck['status'] == 1){
				$return = $this->products_model->saveData($data);
			}else{
				$return = $aliasCheck;
			}
		}else{
			$return = $uploadFile;
		}
		echo json_encode($return);
	}


	public function doUpload($FILES,$logo){
		if($FILES['image']['name']){

			$config['upload_path']          = 'uploads/product';

			if(!is_dir($config['upload_path'])){
				mkdir($config['upload_path'],0777,TRUE);
			}

			if(!is_dir('uploads/product/70x70')){
				mkdir('uploads/product/70x70',0777,TRUE);
			}
			if(!is_dir('uploads/product/150x150')){
				mkdir('uploads/product/150x150',0777,TRUE);
			}
			if(!is_dir('uploads/product/350x250')){
				mkdir('uploads/product/350x250',0777,TRUE);
			}

			$config['allowed_types']        = 'gif|jpg|png|jpeg|JPG|JPEG';
			$config['max_size']             = 10000;
			$config['max_width']            = 20000;
			$config['max_height']           = 10000;
			$config['file_name'] 			= 'product_'.rand(10,99).time();

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('image')){
				return array('status'=>2,'msg'=>$this->upload->display_errors()); 
			}else{
				@unlink('./uploads/product/'.$logo);
				@unlink('./uploads/product/70x70/'.$logo);
				@unlink('./uploads/product/150x150/'.$logo);
				@unlink('./uploads/product/350x250/'.$logo);

				$size_arr = array(
					'0' => array('70','70','70x70'),
					'1' => array('150','150','150x150'),
					'2' => array('350','250','350x250')
				);
				
				foreach($size_arr as $key => $row) {
					$this->load->library('image_lib');
				    $config['image_library'] = 'GD2';
				    $config['source_image'] = './uploads/product/'.$this->upload->data()['file_name'];
				    $config['maintain_ratio'] = TRUE;
				    $config['width']     = $row[0];
				    $config['height']   = $row[1];
				    $config['new_image']   = './uploads/product/'.$row[2]."/".$this->upload->data()['file_name'];

				    $this->image_lib->clear();
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
				}
				return array('status'=>1,'logo'=> $config['upload_path'].'/' . $this->upload->data()['file_name']);
			}
		} else {

			return array('status'=>1,'logo'=>'');
		}

	}

	public function statusChange(){
		$return = $this->products_model->statusChange($this->input->post());
		echo json_encode($return);
	}



	public function deleteData(){
		$return = $this->products_model->deleteData($this->input->post());
		echo json_encode($return);
	}

	public function saveOrdering(){
		$return = $this->products_model->saveOrdering($this->input->post());
		echo json_encode($return);
	}

	// public function statusChangeBanner(){
	// 	$return = $this->blogs_model->statusChangeBanner($this->input->post());
	// 	echo json_encode($return);
	// }

	public function changeFeaturedProduct(){
		$return = $this->products_model->changeFeaturedProduct($this->input->post());
		echo json_encode($return);
	}

}
?>