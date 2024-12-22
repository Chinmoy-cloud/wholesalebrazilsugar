<?php



defined('BASEPATH') OR exit('No direct script access allowed');

error_reporting(0);

class Home extends CI_Controller {



	public function __construct(){

		parent::__construct();

		$this->load->library('email');

	}



	public function index() { 

        $data = array('viewPage'=>'home/index','pageTitle'=>'Home','activeMenus'=>array('home'),'jsFiles'=>array('cms'));

        $this->load->view('front/template/default',$data);

    }



    public function contactSaveData(){

		$data = $this->input->post();

		$storeContact = $this->db->insert('contacts',$data);

		if($data['product_id']){

			$getProduct = $this->db->get_where('products',array('id'=>$data['product_id']))->row();

			$getUserEmailTemplate = $this->db->get_where('email',array('code'=>'frontend-enquiry-mail','email_for'=>'admins','status'=>1))->row();

			if($getUserEmailTemplate){

				// $config = Array(

				//     'protocol' => 'smtp',

				//     'smtp_host' => 'mail.buyboatengines.com/',

				//     'smtp_port' => 465,

				//     'smtp_user' => 'contact@buyboatengines.com',

				//     'smtp_pass' => 'X!w&HKuMDUXC',

				//     'mailtype'  => 'html',

				//     'charset'   => 'iso-8859-1'

				// );

				// $this->load->library('email', $config);

				$pattern = array('{PRODUCT}','{NAME}','{EMAIL}','{PHONE}','{MESSAGE}');

				$replacement = array($getProduct->title,$data['name'],$data['email'],$data['phone'],$data['message']);

				$body = str_replace($pattern,$replacement,$getUserEmailTemplate->content);

				$this->email->from($getUserEmailTemplate->from_email,$getUserEmailTemplate->from_name);

				$this->email->to($getUserEmailTemplate->to_email);

				$this->email->set_mailtype('html');

				$this->email->subject($getUserEmailTemplate->subject);

				$this->email->message($body);

				$mail = $this->email->send();

			}

		}else{

			$getUserEmailTemplate = $this->db->get_where('email',array('code'=>'frontend-contact-us','email_for'=>'admins','status'=>1))->row();

			if($getUserEmailTemplate){

				// $config = Array(

				//     'protocol' => 'smtp',

				//     'smtp_host' => 'mail.buyboatengines.com/',

				//     'smtp_port' => 465,

				//     'smtp_user' => 'contact@buyboatengines.com',

				//     'smtp_pass' => 'X!w&HKuMDUXC',

				//     'mailtype'  => 'html',

				//     'charset'   => 'iso-8859-1'

				// );

				// $this->load->library('email', $config);

				$pattern = array('{NAME}','{EMAIL}','{MESSAGE}');

				$replacement = array($data['name'],$data['email'],$data['message']);

				$body = str_replace($pattern,$replacement,$getUserEmailTemplate->content);

				$this->email->from($getUserEmailTemplate->from_email,$getUserEmailTemplate->from_name);

				$this->email->to($getUserEmailTemplate->to_email);

				$this->email->set_mailtype('html');

				$this->email->subject($getUserEmailTemplate->subject);

				$this->email->message($body);

				$mail = $this->email->send();

			}

		}		

		$return['status'] = '1';

		$return['message'] = 'Mail send successfully';

		echo json_encode($return);

	}



	public function enqueryModal() {

        $data = $this->input->post();

        $return['html'] = $this->load->view('front/enquery-modal',$data,true);

        echo json_encode($return);

    }

    public function about() {
        $data = array('viewPage'=>'about','pageTitle'=>'About Us','activeMenus'=>array('about'),'jsFiles'=>array('cms'));
        $this->load->view('front/template/default',$data);
    }

    public function contact() {
        $data = array('viewPage'=>'contact','pageTitle'=>'Contact Us','activeMenus'=>array('contact'),'jsFiles'=>array('cms'));
        $this->load->view('front/template/default',$data);
    }





    public function termsAndCondition() {

        $data = array('viewPage'=>'terms','pageTitle'=>'Term & Condition','activeMenus'=>array('terms-and-condition'),'jsFiles'=>array());

        $this->load->view('front/template/default',$data);

    }



    public function shippingPolicy() {

        $data = array('viewPage'=>'shipping-policy','pageTitle'=>'Shipping Policy','activeMenus'=>array('shipping-policy'),'jsFiles'=>array());

        $this->load->view('front/template/default',$data);

    }



	public function returnPolicy() {

        $data = array('viewPage'=>'return-policy','pageTitle'=>'Return Policy','activeMenus'=>array('return-policy'),'jsFiles'=>array());

        $this->load->view('front/template/default',$data);

    }



    public function privacyPolicy() {

        $data = array('viewPage'=>'privacy-policy','pageTitle'=>'Privacy Policy','activeMenus'=>array('privacy-policy'),'jsFiles'=>array());

        $this->load->view('front/template/default',$data);

    }



}



?>