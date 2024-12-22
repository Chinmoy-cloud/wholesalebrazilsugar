<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('user_id') && $this->uri->segment(2) != 'logout'){
			redirect('admin/dashboard');
		}
		$this->load->model('admin/login_model');
	}

	public function index(){
       //echo 'hi';die;
		$data = array('viewPage'=>'login','pageTitle'=>'Admin Login','jsFiles'=>array('login','jquery.cookie'),'cssFiles'=>array('login'));
		$this->load->view('admin/template/login',$data);
	}

	public function login(){

		$login = $this->login_model->login($this->input->post());
		echo json_encode($login);
	}

	public function sendotp(){
		$response = array();
		$data = $this->input->post();
		$email = $data['email'];
		if($data['email'] != ""){
			$query = $this->db->query("SELECT * FROM user WHERE email = '".$email."' AND FIND_IN_SET('admins',usertype) <> 0");
			$result = $query->result_array();
			if(count($result) == 1){
				$getTemplate = $this->db->get_where('email',array('code'=>'user-otp','email_for'=>'admins','status'=>1))->row();
				if($getTemplate){

					$six_digit_random_number = mt_rand(100000, 999999);
					$pattern = array('{USER_NAME}','{USER_OTP}');
					$replacement = array($result[0]['name'],$six_digit_random_number);
					$body = str_replace($pattern,$replacement,$getTemplate->content);
					$this->email->from($getTemplate->from_email,$getTemplate->from_name);
					$this->email->to($email);
					$this->email->set_mailtype('html');
					$this->email->subject($getTemplate->subject);
					$this->email->message($body);
					$mail = $this->email->send();

					$user_update = $this->db->where('id',$result[0]['id'])->update('user',array('otp'=>$six_digit_random_number,'otp_time'=>date('Y-m-d H:i:s')));

					if ($mail && $user_update) {
						$response['msg'] = "We send an OTP to this email, please verify";
						$response['status'] = 1;
						$response['data'] = $result[0]['id'];
					}else{
						$response['msg'] = "Sorry for the inconvenience, please try sometime later";
						$response['status'] = 0;
					}
				}else{
					$response['msg'] = "Sorry for the inconvenience, please contact other admins";
					$response['status'] = 0;
				}
			}else{
				$response['msg'] = "Sorry! you are not a valid admin";
				$response['status'] = 0;
			}
		}else{
			$response['msg'] = "Enter your email first";
			$response['status'] = 0;
		}
		echo json_encode($response);
	}

	public function checkotp(){
		$data = $this->input->post();
		$getuserdata = $this->db->get_where('user',array('id'=>$data['user_id']))->row();
		if (isset($getuserdata->id) && $getuserdata->id != "" && $getuserdata->otp != NULL && $getuserdata->otp_time != NULL && $getuserdata->otp != "" && $getuserdata->otp_time != "") {
			$db_time = strtotime($getuserdata->otp_time);
			$current_time = strtotime(date('Y-m-d H:i:s'));
			$interval  = abs($current_time - $db_time);
			$minutes   = round($interval / 60);
			if($minutes <= 5 && $getuserdata->otp == $data['otp']){
				$response['msg'] = "Now you can change your password";
				$response['status'] = 1;
				$response['user_id'] = $data['user_id'];
				$response['otp'] = $data['otp'];
			}else{
				$response['msg'] = "Sorry! time exceeded or OTP does'nt mathced";
				$response['status'] = 0;
			}
		}else{
			$response['msg'] = "Sorry! you are not a valid admin";
			$response['status'] = 0;
		}
		echo json_encode($response);
	}


	public function change_pass(){
		$data = $this->input->post();
		$getuserdata = $this->db->get_where('user',array('id'=>$data['user_id'],'otp'=>$data['otp']))->row();
		if (isset($getuserdata->id) && $getuserdata->id != "" && $getuserdata->otp != NULL && $getuserdata->otp_time != NULL && $getuserdata->otp != "" && $getuserdata->otp_time != "") {
			if($data['new_password'] == $data['new_cpassword']){
				$new_password = md5($data['new_password']);
				$pass_update = $this->db->where('id',$data['user_id'])->update('user',array('otp'=>NULL,'otp_time'=>NULL,'password'=>$new_password));
				if($pass_update){
					$response['msg'] = "Password changed successfully, login with your new password";
					$response['status'] = 1;
				}else{
					$response['msg'] = "Sorry! something went wrong, please try later";
					$response['status'] = 0;
				}
			}else{
				$response['msg'] = "Sorry! password and confirm password does'nt matched";
				$response['status'] = 0;
			}
		}else{
			$response['msg'] = "Sorry! you are not a valid admin";
			$response['status'] = 0;
		}
		echo json_encode($response);
	}

	public function logout(){
		$this->session->set_userdata('user_id','');
		$this->session->set_userdata('role','');
		$this->session->sess_destroy();
		redirect('admin');
	}
}
?>