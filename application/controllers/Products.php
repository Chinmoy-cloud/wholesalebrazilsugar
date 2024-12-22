<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Products extends CI_Controller {

	public function __construct(){
		parent::__construct();		
        $this->load->model('front/products_model');
	}

	public function index() { 
        $data = array('viewPage'=>'products/list','pageTitle'=>'Products','activeMenus'=>array('products'),'jsFiles'=>array('products','cms'));
        $data['products'] = $this->products_model->getList();
        $this->load->view('front/template/default',$data);
    }

    public function details($alias) { 
        $data = array('viewPage'=>'products/details','pageTitle'=>'Product Details','activeMenus'=>array('products'),'jsFiles'=>array('products','cms'),'cssFiles'=>array());
        $data['details'] = $this->products_model->getDetails($alias);
        //echo '<pre>'; print_r($data['details']); die();
        $this->load->view('front/template/default',$data);
    }

}
?>