<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sg extends MX_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model(array('Users_model'));
        $this->load->library(array('qrlib'));

    } 
    
	public function index()
	{		
		// var_dump(md5('H3vin_28'));
		// exit;
		$this->load->view('login_page');
	}

	public function login()
	{	
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$rows = $this->Users_model->CheckAccount( $username , md5($password) );
		if(count($rows) != 0){
			foreach ($rows as $value) {
				$account_status = $value->status;
				$account_usertype = $value->usertype;
				$account_id = $value->id;
			}

			if($account_status == 0){
				$message = base64_encode('account_deactivated');
				redirect(base_url('/?m='.$message));
			}else if($account_status == 2){
				$message = base64_encode('account_declined');
				redirect(base_url('/?m='.$message));
			}else if($account_status == 3){
				$message = base64_encode('account_deleted');
				redirect(base_url('/?m='.$message));
			} else if($account_status == 1) {
				$this->nativesession->set('username',$username);
				$this->nativesession->set('usertype',$account_usertype);
				$this->nativesession->set('id',$account_id);
				$message = base64_encode('login_success');

				if($account_usertype == 1 || $account_usertype == 2){
					redirect(base_url('emp/'));
				} else if($account_usertype == 3){
					redirect(base_url('sg/home/'));
				} else if($account_usertype == 0){
					$message = base64_encode('login_superadmin');
					redirect(base_url('/?m='.$message));
				} else if($account_usertype == 4){
					redirect(base_url('g/'));
				}
			} 
		} else {
			$message = base64_encode('login_error');
			redirect(base_url('/?m='.$message));
		}
	}

	public function register()
	{	
		$condition = 'region1';
		$where = '';
		$ob_name = 'regDesc';
		$data['regions'] = $this->Users_model->getAddress("refregion",$condition,$where,$ob_name);
		$this->load->view('register.php',$data);
	}

	public function getaddressAjax()
	{	
		$condition = $this->input->post('condition');
		$code = $this->input->post('code');
		if($condition == 'region'){
			$where = array('regCode' => $code);
			$table = 'refprovince';
			$ob_name = 'provDesc';
		} else if(($condition == 'province')){
			$where = array('provCode' => $code);
			$table = 'refcitymun';
			$ob_name = 'citymunDesc';
		} else if(($condition == 'municipal')){
			$where = array('citymunCode' => $code);
			$table = 'refbrgy';
			$ob_name = 'brgyDesc';
		}
		$result = $this->Users_model->getAddress($table,$condition,$where,$ob_name);
		echo json_encode(array('result'=> $result, 'condition'=>$condition));
	}

	public function home()
	{	
		$this->checkAccountNotNull();
		$account_id = $this->nativesession->get('id');
		$row = $this->Users_model->getInformation("sg_information",$account_id);
		$data['result'] = $row;
		$this->heading($row);
		$this->load->view('home.php',$data);
		$this->load->view('footer.php');
	}

	public function dqr()
	{	
		$this->checkAccountNotNull();
		$account_id = $this->nativesession->get('id');
		$row = $this->Users_model->getInformation("sg_information",$account_id);
		$data['row'] = $row;

		$this->heading($row);
		$this->load->view('dqr.php',$data);
		$this->load->view('footer.php');
	}

	public function ScanQR(){
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$hidden = $this->input->post('hidden_time_inout');
		$purpose = $this->input->post('purpose');
		$date_visited = date("Y-m-d", strtotime($this->input->post('date')));
		$time = date('H:i:s', strtotime($this->input->post('time')));
		$office = explode('~',base64_decode(str_replace(" ", "+", $this->input->post('text'))))[1];
		$office_id = explode('~',base64_decode(str_replace(" ", "+", $this->input->post('text'))))[0];

		if($hidden == 'visit_office'){
			$table = 'sg_visit';
		} else if($hidden == 'enter_classroom'){
			$table = 'enter_classroom';
		}
		// echo json_encode(array($account_id,$office_id,$date_visited,$time,$purpose,$hidden));exit;
		$row = $this->Users_model->checkVE($table,$account_id,$date_visited,$office_id);
		if($row == NULL){
			$data = [
				'account_id' => $account_id,
				'designation_office_id' => $office_id,
				'date_visited' => $date_visited,
				'time_checkin' => $time,
				'time_checkout' => '',
				'purpose' => $purpose
			];
			$check = $this->Users_model->saveVisit($table,$data);
			if($check === true){
				$message = 'save_success';
			} else {
				$message = 'save_error';
			}
		} else {
			if($row->time_checkout == '00:00:00'){ 
				$id = $row->id;
				$data = [
					'time_checkout' => $time,
				];
				$check = $this->Users_model->updateVisit($table,$data,$id);
				if($check === true){
					$message = 'update_success';
				} else {
					$message = 'update_error';
				}
			} else {
				$message = 'Error_code_HE102894-SGUV01';
			}
		}
		echo json_encode($message);
	} 

	public function insert_reg()
	{	
		$username = $this->input->post('username');
		$checkUN = $this->Users_model->checkUsername($username);
		if(count($checkUN) == 0){
			date_default_timezone_set('Asia/Manila'); 
			$date = date('m-d-Y H:i:s');
			$fname = $this->input->post('fname');
			$lname = $this->input->post('lname');
			$mname = $this->input->post('mname');
			$suffix = $this->input->post('suffix');
			$email_add = $this->input->post('email_add');
			$gender = $this->input->post('gender');
			$mobile_number = $this->input->post('mnumber');
			$barangay = $this->input->post('barangay');
			$municipal_city = $this->input->post('municipal');
			$province = $this->input->post('province');
			$region = $this->input->post('region');
			$password = $this->input->post('password');

			$config['upload_path'] = FCPATH."assets\pro_pic_images";
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $config['max_size'] = 100000;
	        $config['max_width'] = 5000;
	        $config['max_height'] = 5000;

	        $config1['upload_path'] = FCPATH.'assets\valid_id';
	        $config1['allowed_types'] = 'gif|jpg|png|jpeg';
	        $config1['max_size'] = 100000;
	        $config1['max_width'] = 5000;
	        $config1['max_height'] = 5000;

	        $this->load->library('upload', $config1);

	        if($this->upload->do_upload('valid_id')){
	        	$valid_id = $this->upload->data()['file_name'];
	        } else {
	        	$message = base64_encode($this->upload->display_errors());
	        	redirect(base_url('/?m='.$message));
	        }

	        $this->load->library('upload', $config);

	        if(!$this->upload->do_upload('pro_pic')){
	            $message1 = $this->upload->display_errors();
	            if('You did not select a file to upload.' == $message1){
	            	$message = base64_encode('success_no_image_sg');
	            } else {
	            	$message =  $message1;
	            }
	            
	            $image_path = 'pro_pic_icon.png';

	        } else {
	        	$image_path = $this->upload->data()['file_name'];
	        	$message = base64_encode('success_sg');
	        }

	        $accounts_data = [
				"username" => $username,
				"password" => md5($password),
				"usertype" => 3,
				"status" => 1
			];

			$account_id = $this->Users_model->insertData('accounts',$accounts_data);
	        
	        $info_data = [
				"account_id" => $account_id,
				"firstname" => $fname,
				"lastname" => $lname,
				"middle_name" => $mname,
				"suffix" => $suffix,
				"gender" => $gender,
				"email_address" => $email_add,
				"mobile_number" => $mobile_number,
				"image" => $image_path,
				"barangay" => $barangay,
				"municipal_city" => $municipal_city,
				"province" => $province,
				"region" => $region,
				"valid_id" => $valid_id,
				"date_registered" => $date,
			];

			$check = $this->Users_model->insertData('sg_information',$info_data);
			if($check != NULL){
				$text = base64_encode($account_id.'~'.$fname.'~'.$mname.'~'.$lname);
				$folder= FCPATH."assets/qrcode_images_users/";
				$file_name=$folder.$text.'.png';
				QRcode::png($text,$file_name,'H',24,1);
			} else {
				$message = base64_encode("There's an error in savind the data. Please contact the MIS.");
			}
        } else {
        	foreach ($checkUN as $value) {
        		$fname = $value->firstname;
        		$lname = $value->lastname;
        	}
        	$message = base64_encode('Username has been used by '.$fname.' '.$lname.'.');
        }
       	redirect(base_url('/?m='.$message));
	}

	public function logout()
	{	
		$this->nativesession->delete('id');
		redirect(base_url());
	}

	function heading($row){
		$data['hresult'] = $row;
		$this->load->view('head.php');
		$this->load->view('header.php',$data);
	}

	function checkAccountNotNull(){
		$id = $this->nativesession->get('id');
		if($id == NULL){
			$message = base64_encode("not_login");
			redirect(base_url('?m='.$message));
		}
	}
}
