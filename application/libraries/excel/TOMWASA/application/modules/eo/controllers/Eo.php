<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eo extends MX_Controller {
	public function __construct() {
    parent::__construct();
    $this->load->model(array('Eo_model'));
        // var_dump(md5('12345'));
		// exit;
		// 827ccb0eea8a706c4c34a16891f84e7b
 	} 
    
	public function index()
	{	
		if($this->nativesession->get('id') != NULL){
    	redirect(base_url('eo/home/'));
    } else {
    	$this->load->view('login_page');
    }
		
	}

	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$rows = $this->Eo_model->CheckAccount( 'accounts' , $where );
		if($rows != NULL){
			if($rows->status == 0){
				$message = base64_encode('errorrr~Account is deactivated. Please ask the Developer or other Administrator to Activate your account.');
				redirect(base_url('/?m='.$message));
			} else if($rows->status == 1) {
				$this->nativesession->set('id',$rows->id);
				$message = base64_encode('success~Welcome '.$rows->username.'!');
				if($rows->usertype == 1){
					redirect(base_url('eo/home/?m='.$message));
				} else if($rows->usertype == 2){
					redirect(base_url('mto/home/?m='.$message));
				}
			} 
		} else {
			$message = base64_encode("errorrr~Incorrect username or password.");
			redirect(base_url('/?m='.$message));
		}
	}

	public function home(){
		$account_id = $this->nativesession->get('id');
		$row = $this->checkAccountNotNull();
		$where = [];
		$data['all_consumers'] = $this->Eo_model->getAllConsumers($where);
		$this->heading($row);
		$this->load->view('home',$data);
		$this->load->view('footer');
	}

	public function consumers(){
		$account_id = $this->nativesession->get('id');
		$row = $this->checkAccountNotNull();
		if((($barangay_post = @$this->input->post('barangay')) != null) && @$this->input->post('barangay') != 'All Barangay'){
			$where = [
				'ci.barangay_id' => @$barangay_post
			];
		} else {
			$where = [];
		}
		$data['all_consumers'] = $this->Eo_model->getAllConsumers($where);
		$data['selected_barangay'] = $this->Eo_model->getSelectedBarangay($barangay_post);
		
		$data['all_barangays'] = $this->Eo_model->getAllBarangays();
		$this->heading($row);
		$this->load->view('consumers',$data);
		$this->load->view('footer');
	}

	public function meter_reading(){
		$account_id = $this->nativesession->get('id');
		$row = $this->checkAccountNotNull();
		$barangay_post = @$this->input->post('barangay');
		$data['nav_items'] = json_decode($this->meterReading($barangay_post))->nav;
		$data['tab_panes'] = json_decode($this->meterReading($barangay_post))->tab;
		$data['selected_barangay'] = $this->Eo_model->getSelectedBarangay($barangay_post);
		// $data['meter_reading'] = $this->Eo_model->getMeterReading($where);
		$data['all_barangays'] = $this->Eo_model->getAllBarangays();
		
		$this->heading($row);
		$this->load->view('meter_reading',$data);
		$this->load->view('footer');
	}

	public function individual_ledger(){
		$account_id = $this->nativesession->get('id');
		$row = $this->checkAccountNotNull();
		if((($barangay_post = @$this->input->post('barangay')) != null) && @$this->input->post('barangay') != 'All Barangay'){
			$where = [
				'ci.barangay_id' => @$barangay_post
			];
		} else {
			$where = [];
		}
		$data['all_consumers'] = $this->Eo_model->getAllConsumers($where);
		$data['all_barangays'] = $this->Eo_model->getAllBarangays();
		
		$this->heading($row);
		$this->load->view('individual_ledger',$data);
		$this->load->view('footer');
	}

	public function AddMeterReading(){
		$account_id = $this->nativesession->get('id');
		$row = $this->checkAccountNotNull();
		$reading_year = date('Y');
		$date_inputted = date('Y-m-d');
		$meter_reading = $this->input->post('meterreading');
		$month = $this->input->post('month');
		$minimum = $this->input->post('minimum');
		if($minimum == null){
			$minimum = 0;
		}
		$last = $this->input->post('last');
		$array_id = explode(',',$this->input->post('arrays_id'));
		$last_reading_array = explode(',', $last);
		for($x=0;$x<count($last_reading_array);$x++){
			if($meter_reading[$x] == null){
				continue;
			} 
			$data = [
				"consumers_id" => $array_id[$x],
				"last_reading" => $last_reading_array[$x],
				"current_reading" => $meter_reading[$x],
				"remark" => '',
				"date_inputted" => $date_inputted,
				"reading_month" => $month,
				"reading_year" => $reading_year,
				"minimum" => $minimum
			];
			var_dump($data);
			$this->Eo_model->insert($data,'meter_reading');
		}
		$message = base64_encode("success~Meter reading successfully added!");
		redirect(base_url('eo/meter_reading/?m='.$message));
	}

	function heading($row){
		$data['hresult'] = $row;
		$this->load->view('head.php');
		$this->load->view('header.php',$data);
	}

	public function logout()
	{	
		$this->nativesession->delete('id');
		redirect(base_url());
	}

	function checkAccountNotNull(){
		$id = $this->nativesession->get('id');
		if($id == NULL){
			$message = base64_encode("errorrr~You have to login first before you can access the page.");
			redirect(base_url('?m='.$message));
		} else {
			$where = array(
				'id' => $id
			);
			$rows = $this->Eo_model->CheckAccount( 'accounts' , $where );
			if($rows->usertype != 1){
				$message = base64_encode("errorrr~Restricted page. Your account is not an admin type.");
				redirect(base_url('?m='.$message));
			} else {
				return $rows;
			}
			
		}
	}

	public function AjaxGetDataConsumersList(){
		$post_month = $this->input->post('month');
		$last_array= array();
		$array_id = array();
		$where = [];
		$allConsumers = $this->Eo_model->getAllConsumers($where);
		$list = '';
		foreach ($allConsumers as $consumerInfo) {
			$meter_reading_month = $this->Eo_model->getMeterReadingPerMonth($consumerInfo->id,$post_month);
			if($meter_reading_month == null ){
				if($this->Eo_model->getLastMeterReading($consumerInfo->id) != null){
						$last = $this->Eo_model->getLastMeterReading($consumerInfo->id)->current_reading;
					} else {
						$last = 0;
					}
				array_push($array_id,$consumerInfo->id);
				array_push($last_array,$last);
				$list .= '<div class="form-group row mt-1" style="border-bottom: 2px solid #aba4a4; padding-bottom: 7px;">';
        $list .= '<label class="col-sm-6 col-form-label">'.$consumerInfo->name.'</label>';
        $list .= '<input type="text"  name="lastreading1[]" class="form-control col-sm-2" id="last_reading'.$consumerInfo->id.'" value="'.$last.'" disabled="disabled">&nbsp;&nbsp;';
        $list .= '<input type="text" onkeyup="checkCurrent(this)" id="'.$consumerInfo->id.'" class="current_reading1 form-control col-sm-3" name="meterreading[]" placeholder="Enter Here">';
        $list .= '</div>';
			}
		}
		echo json_encode(["list"=>$list,"array_id"=>$array_id,"last"=>$last_array]);
	}

	public function AjaxGetData(){
		$array = array();
		$month = ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		$where = [];
		$allConsumers = $this->Eo_model->getAllConsumers($where);
		for($x=1;$x<count($month);$x++){
			$total_per_month = 0;
			foreach ($allConsumers as $consumerInfo) {
				$meter_reading_month = $this->Eo_model->getMeterReadingPerMonth($consumerInfo->id,$x);
				if($meter_reading_month != null ){
					$last = $meter_reading_month->last_reading;
					$current = $meter_reading_month->current_reading;
					$cons = $current - $last;
					$amount = $cons * 12;
					$total_per_month += $amount;
				} else {
					if($this->Eo_model->getLastMeterReading($consumerInfo->id) != null){
						$last = $this->Eo_model->getLastMeterReading($consumerInfo->id)->current_reading;
					} else {
						$last = '-';
					}
					$current = '-';
					$cons = '-';
					$amount = 0;
				}
			}
			array_push($array,$total_per_month);
		}
		echo json_encode($array);
	}

	public function meterReading($barangay_post){
		$month = ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		$month1 = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
		$nav_item = '';
		$tab_pane = '';
		$modal = '';
		if($barangay_post != null && $barangay_post != 'All Barangay'){
			$where = [
				'ci.barangay_id' => @$barangay_post
			];
		} else {
			$where = [];
		}
		$allConsumers = $this->Eo_model->getAllConsumers($where);
		
		for($x=1;$x<count($month);$x++){
			if($x==1){
				$selected = 'true';
				$active = 'active';
				$tab_pane_active = 'show active';
			} else {
				$active = '';
				$selected = 'false';
				$tab_pane_active = '';
			}

			$nav_item .= '<li class="nav-item"><a class="nav-link '.$active.'" id="custom-tabs-'.$month[$x].'-tab" data-toggle="pill" data-id="'.$x.'" href="#custom-tabs-'.$month[$x].'" role="tab" aria-controls="custom-tabs-'.$month[$x].'" aria-selected="'.$selected.'">'.$month[$x].'</a></li>';
			$tab_pane .= '<div class="tab-pane fade '.$tab_pane_active.'" id="custom-tabs-'.$month[$x].'" role="tabpanel">';
			$tab_pane .= '<table class="table table-bordered table-striped" id="'.$month[$x].'Table" style="margin-top: 0px!important;"><thead><tr>';
			$tab_pane .= '<th width="5%" class="text-center"></th>';
			$tab_pane .= '<th width="30%" class="text-center">NAME</th>';
			$tab_pane .= '<th width="10%" class="text-center">BARANGAY</th>';
			$tab_pane .= '<th width="10%" class="text-center">LAST</th>';
			$tab_pane .= '<th width="10%" class="text-center">METER READING</th>';
			$tab_pane .= '<th width="10%" class="text-center">CONS</th>';
			$tab_pane .= '<th width="10%" class="text-center">AMOUNT</th>';
			$tab_pane .= '<th width="15%" class="text-center">REMARKS</th>';
			$tab_pane .= '</tr></thead><tbody class="text-center">';
			$total_per_month = 0;
			foreach ($allConsumers as $consumerInfo) {
				$meter_reading_month = $this->Eo_model->getMeterReadingPerMonth($consumerInfo->id,$x);
				// var_dump($meter_reading_month);
				if($meter_reading_month != null ){
					$last = $meter_reading_month->last_reading;
					$current = $meter_reading_month->current_reading;
					$cons = $current - $last;
					$amount = $cons * 12;
					$total_per_month += $amount;
				} else {
					if($this->Eo_model->getLastMeterReading($consumerInfo->id) != null){
						$last = $this->Eo_model->getLastMeterReading($consumerInfo->id)->current_reading;
					} else {
						$last = '-';
					}
					$current = '-';
					$cons = '-';
					$amount = 0;
				}
				$tab_pane .= '<tr>';
				$tab_pane .= '<td>'.$consumerInfo->sequence_number.'</td>';
				$tab_pane .= '<td>'.$consumerInfo->name.'</td>';
				$tab_pane .= '<td>'.$consumerInfo->barangay_name.'</td>';
				$tab_pane .= '<td>'.$last.'</td>';
				$tab_pane .= '<td>'.$current.'</td>';
				$tab_pane .= '<td>'.$cons.'</td>';
				$tab_pane .= '<td>P '.number_format($amount).'</td>';
				$tab_pane .= '<td>'.@$meter_reading_month->remark.'</td>';
				$tab_pane .= '</tr>';
			}
			
			$tab_pane .= '</tbody><tfoot>';
			$tab_pane .= '<tr>';
			$tab_pane .= '<td></td>';
			$tab_pane .= '<td><b>TOTAL<b></td>';
			$tab_pane .= '<td></td>';
			$tab_pane .= '<td></td>';
			$tab_pane .= '<td></td>';
			$tab_pane .= '<td></td>';
			$tab_pane .= '<td><b> P '.number_format($total_per_month).'</b></td>';
			$tab_pane .= '<td></td>';
			$tab_pane .= '</tr>';
			$tab_pane .= '</tfoot></table>';
			$tab_pane .= '</div>';

		}

		return json_encode(['nav'=> $nav_item,'tab'=>$tab_pane,'modal'=>$modal,'total'=>$total_per_month]);
	}
}
