<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp extends MX_Controller {
	public function __construct() {
        parent::__construct();
        $this->load->model(array('Emp_model'));
        $this->load->library(array('qrlib'));

        //var_dump(base64_decode('ZXJyb3J+QWNjb3VudCBzdWNjZXNzZnVsbHkgREVBQ1RJVkFURUQu'));exit;
    } 
    
	public function index()
	{	
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$row = $this->Emp_model->getInformation($account_id);
		$data['emp_information'] = $row;
		// var_dump($row);exit;
		$this->heading($row);
		$this->load->view('home',$data);
		$this->load->view('footer');
	}

	public function register()
	{	
		$data['all_dept_office'] = $this->Emp_model->getAllDO();
		$this->load->view('register.php',$data);
	}

	public function profile()
	{	
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$row = $this->Emp_model->getInformation($account_id);
		$data['hresult'] = $row;
		$this->heading($row);
		$this->load->view('profile',$data);
		$this->load->view('footer');
	}

	public function employees(){
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$row = $this->Emp_model->getInformation($account_id);
		$data['all_employees'] = $this->Emp_model->getAllEmployeesByOffice($row->office_designation);
		$data['department'] = $this->Emp_model->getDepartment($row->office_designation);
		$this->heading($row);
		$this->load->view('employees',$data);
		$this->load->view('footer');
	}

	public function getEmpById(){
		$account_id = $this->input->post('account_id');
		$this->checkAccountNotNull();
		$row = $this->Emp_model->getInformation($account_id);
		echo json_encode($row);
	}

	public function classrooms()
	{	
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$row = $this->Emp_model->getInformation($account_id);
		if($row->usertype != 1){
			$message = base64_encode("not_dept_head~");
			redirect(base_url('emp/?m='.$message));
		}
			
		$data['classroom'] = $this->Emp_model->getClassroomByOffice($row->office_designation);
		$data['office_designation_id'] = $row->office_designation;
		$this->heading($row);
		$this->load->view('classroom',$data);
		$this->load->view('footer');
		
	}

	public function changeAccStatus(){
		$account_id = $this->input->post('account_id');
		$status = $this->input->post('action_number');
		$message = '';
	    if($status == 0){
	        $message = base64_encode("errorrr~Account successfully DEACTIVATED.");
	    } else if($status == 1){
	        $message = base64_encode("success~Account successfully ACTIVATED.");
	    } else if($status == 2){
	        $message = base64_encode("errorrr~Account successfully DECLINED.");
	    } else if($status == 3){
	        $message = base64_encode("errorrr~Account successfully DELETED.");
	    }
		$data = [
			'status' => $status
		];

		$where = array(
			'id' => $account_id 
		);

		$this->Emp_model->update('accounts',$data,$where);
		
		redirect(base_url('emp/employees/?m='.$message));
	}

	public function getclassrooms()
	{	
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$row = $this->Emp_model->getInformation($account_id);
		$all_classrooms = $this->Emp_model->getClassroomByOffice($row->office_designation);
		echo json_encode($all_classrooms);
	}

	public function insert_classroom(){
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$office_designation_id = $this->input->post('office_designation_id');
		$classroom = $this->input->post('classroom');
		$array = array();
		for($x=0; $x < count($classroom);$x++) {
	       	array_push($array,array(
				'designated_office_id' => $office_designation_id,
				'classroom_name' => $classroom[$x],
	        	'status' => 1
			));		
	    }
		
		$bool_check = $this->Emp_model->insert_classroom($array);
		if($bool_check == true){
			$message = base64_encode("classroom_success~");
			redirect(base_url('emp/classrooms/?m='.$message));
		} else {
			$message = base64_encode("classroom_error~");
			redirect(base_url('emp/classrooms/?m='.$message));
		}
	}

	public function gen_qr()
	{
		$this->checkAccountNotNull();
		$text = $this->input->get('c');
		$folder= FCPATH."assets/qrcode_images_doc/";
		if(file_exists($folder)){
			$file_name=$folder.$text.'.png';
			QRcode::png($text,$file_name,'H',24,1);
			$message = base64_encode("gen_success~");
		} else {
			// error code DO102894-001
			$message = base64_encode("error_folder_not_found~");
		} 
		
		redirect(base_url('emp/classrooms/?m='.$message));

	}

	public function insert_reg()
	{	
		$username = $this->input->post('username');
		$checkUN = $this->Emp_model->checkUsername($username);
		if(count($checkUN) == 0){
			date_default_timezone_set('Asia/Manila'); 
			$date = date('m-d-Y H:i:s');
			$fname = $this->input->post('fname');

			$lname = $this->input->post('lname');
			$mname = $this->input->post('mname');
			$suffix = $this->input->post('suffix');
			$email_add = $this->input->post('email_add');
			$gender = $this->input->post('gender');
			$position = $this->input->post('position');
			$designated_office = $this->input->post('designated_office');
			$password = $this->input->post('password');

			$config['upload_path'] = FCPATH."assets\pro_pic_images";
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $config['max_size'] = 100000;
	        $config['max_width'] = 5000;
	        $config['max_height'] = 5000;

	        $this->load->library('upload', $config);

	        if(!$this->upload->do_upload('pro_pic')){
	            $message1 = $this->upload->display_errors();
	            if('You did not select a file to upload.' == $message1){
	            	$message = base64_encode('success_no_image');
	            } else {
	            	$message =  $message1;
	            }
	            
	            $image_path = 'pro_pic_icon.png';
	        } else {
	        	$image_path = $this->upload->data()['file_name'];
	        	$message = base64_encode('success');
	        }

	        $accounts_data = [
				"username" => $username,
				"password" => md5($password),
				"usertype" => 2,
				"status" => 0
			];

			$account_id = $this->Emp_model->insertData('accounts',$accounts_data);
	        
	        $info_data = [
				"account_id" => $account_id,
				"firstname" => $fname,
				"lastname" => $lname,
				"middle_name" => $mname,
				"name_extension" => $suffix,
				"gender" => $gender,
				"email_address" => $email_add,
				"office_designation" => $designated_office,
				"position" => $position,
				"image" => $image_path,
				"date_registered" => $date,
				"date_approved" => "",
			];

			$check = $this->Emp_model->insertData('emp_information',$info_data);
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

	public function dtr_ajax(){
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$month = $this->input->post('month');
        $Year = $this->input->post('year');
		$row = $this->Emp_model->getInformation($account_id);
		$result = $this->Emp_model->getTimeInOutPerEmp($month,$Year,$account_id);
		$html = '';
	    for($x=1; $x<=31;$x++){
	        foreach ($result as $value) {
	          $day = date("d", strtotime($value->date_time_in));
	          if($day == $x){
	            if($value->morning_time_in == null){
	              $morning_time_in = '';
	            } else {
	              $morning_time_in = date("h:i", strtotime(base64_decode($value->morning_time_in)));
	            }

	            if($value->morning_time_out ==  null){
	              $morning_time_out = '';
	            } else {
	              $morning_time_out = date("h:i", strtotime(base64_decode($value->morning_time_out)));
	            }

	            if($value->afternoon_time_in ==  null){
	              $afternoon_time_in = '';
	            } else {
	              $afternoon_time_in = date("h:i", strtotime(base64_decode($value->afternoon_time_in)));
	            }

	            if($value->afternoon_time_out ==  null){
	              $afternoon_time_out = '';
	            } else {
	              $afternoon_time_out = date("h:i", strtotime(base64_decode($value->afternoon_time_out)));
	            }

	            break;
	          } else {
	            $morning_time_in = '';
	            $morning_time_out = '';
	            $afternoon_time_in = '';
	            $afternoon_time_out = '';
	          }
	        }
	      $html .= '<tr>';
	      $html .= '<td width="10%" class="text-center">'.$x.'</td>';
	      $html .= '<td width="15%" class="text-center">'.@$morning_time_in.'</td>';
	      $html .= '<td width="15%" class="text-center">'.@$morning_time_out.'</td>';
	      $html .= '<td width="15%" class="text-center">'.@$afternoon_time_in.'</td>';
	      $html .= '<td width="15%" class="text-center">'.@$afternoon_time_out.'</td>';
	      $html .= '<td width="15%" class="text-center"></td>';
	      $html .= '<td width="15%" class="text-center"></td>';
	      $html .= '</tr>';
	    }

	    echo $html;
	}

	public function dtr(){
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$month = date("m");
        $Year = date("Y");
		$row = $this->Emp_model->getInformation($account_id);
		$data['time_in_out'] = $this->Emp_model->getTimeInOutPerEmp($month,$Year,$account_id);
		$data['emp_information'] = $row;
		$this->heading($row);
		$this->load->view('dtr',$data);
		$this->load->view('footer');
	}

	public function ScanQR(){
		$this->checkAccountNotNull();
		$hidden = $this->input->post('hidden_time_inout');
		$office = explode('~',base64_decode(str_replace(" ", "+", $this->input->post('text'))))[1];
		if($hidden == 'time_in_out'){
			if($office == 'Time In' || $office == 'Time Out') {
				$purpose = $this->input->post('purpose');
				$date = date("Y-m-d", strtotime($this->input->post('date')));
				$time = date("H:i:s", strtotime($this->input->post('time')));
				$account_id = $this->nativesession->get('id');
				$info = $this->Emp_model->getInformation($account_id);
				if($info->gender == "Male"){
					$proper_name = 'Mr. '.$info->firstname.' '.$info->lastname;
				} else {
					$proper_name = 'Mrs/Miss. '.$info->firstname.' '.$info->lastname;
				}

				$hour = date("H", strtotime($time));
				$getDataTimeInOut = $this->Emp_model->checkTimeIn($date,$account_id);
				if($office == 'Time In'){
					if($getDataTimeInOut != null){
						if($getDataTimeInOut->morning_time_in == null){
							$morning_in = false;
						} else {
							$morning_in = true;
						}
						if($getDataTimeInOut->morning_time_out == null){
							$morning_out = false;
						} else {
							$morning_out = true;
						}
						if($getDataTimeInOut->afternoon_time_in == null){
							$afternoon_in = false;
						} else {
							$afternoon_in = true;
						}
						if($getDataTimeInOut->afternoon_time_out == null){
							$afternoon_out = false;
						} else {
							$afternoon_out = true;
						}

						$time_current = explode(':', date("H:i", strtotime($time)));
						$time_morning_out =  explode(':', date("H:i", strtotime($getDataTimeInOut->morning_time_out)));
						$minuteInterval = (($time_current[0]*60) + $time_current[1]) - (($time_morning_out[0]*60) + $time_morning_out[1]); 

						$morning_out_time = date("h:i a", strtotime($getDataTimeInOut->morning_time_out.'+ 5 minute'));
						if($hour > 11){
							if ($morning_in == false) {
								//Error code 102894-009
								echo json_encode(["no_error"=>"no", "message"=>"There's an error. Err No. 102894-009. Please contact the MIS."]);
							} else {
								if($morning_in == true && $morning_out == false){
									echo json_encode(["no_error"=>"no", "message"=>"Good afternoon ".$proper_name.". Time out (morning) first before time in (afternoon)."]);
								} else {
									if($minuteInterval >= 5){
										if($morning_out == true && $afternoon_in == false){
											$field_name = 'afternoon_time_in';
											$message = "Good afternoon ".$proper_name.".";
											echo $this->update_time_out($field_name,$time,$date,$account_id,$message);
										} else if($morning_in == true && $afternoon_in == true) {
											echo json_encode(["no_error"=>"no", "message"=>$proper_name.", you are already time in both morning and afternoon. Please check your DTR."]);
										}
										
									} else {
										echo json_encode(["no_error"=>"no", "message"=>"There's 5 minutes interval. Please wait until ".$morning_out_time."."]);
									}
								}
							}
						} else {
							if ($morning_in == false) {
								//Error code 102894-008
								echo json_encode(["no_error"=>"no", "message"=>"There's an error. Err No. 102894-008. Please contact the MIS."]);
							} else if ($morning_in == true && $morning_out == false) {
								echo json_encode(["no_error"=>"no", "message"=>$proper_name.", you are already time in (morning). Please check your DTR."]);
							} else if($morning_in == true && $morning_out == true){
								echo json_encode(["no_error"=>"no", "message"=>$proper_name.", you are already time in and out (morning). Please wait until 11 AM to time in (afternoon)."]);
							}
						}
					} else {
						if($hour > 11){
							$data = [
								'morning_time_in' => '',
								'morning_time_out' => '',
								'afternoon_time_in' => base64_encode($time),
								'afternoon_time_out' => '',
								'date_time_in' => $date,
								'account_id' => $account_id,
								'month' => date("m", strtotime($this->input->post('date'))),
								'year' => date("Y", strtotime($this->input->post('date')))
							];

							$bool = $this->Emp_model->InsertTimeIn($data);

							if($bool == true){
								echo json_encode(array("no_error"=>"yes", "message"=>"Good afternoon ".$proper_name."."));
							} else {
								//Error code 102894-002
								echo json_encode(["no_error"=>"no", "message"=>"There's an error. Err No. 102894-002. Please contact the MIS."]);
							}
						} else {
							$data = [
								'morning_time_in' => base64_encode($time),
								'morning_time_out' => '',
								'afternoon_time_in' => '',
								'afternoon_time_out' => '',
								'date_time_in' => $date,
								'account_id' => $account_id,
								'month' => date("m", strtotime($this->input->post('date'))),
								'year' => date("Y", strtotime($this->input->post('date')))
							];

							$bool = $this->Emp_model->InsertTimeIn($data);

							if($bool == true){
								echo json_encode(array("no_error"=>"yes", "message"=>"Good morning ".$proper_name."."));
							} else {
								//Error code 102894-003
								echo json_encode(["no_error"=>"no", "message"=>"There's an error. Err No. 102894-003. Please contact the MIS."]);
							}
						}
						
					}

				///Timeout
				} else if($office == 'Time Out'){
					if($getDataTimeInOut != null){
						if($getDataTimeInOut->morning_time_in == null){
							$morning_in = false;
						} else {
							$morning_in = true;
						}
						if($getDataTimeInOut->morning_time_out == null){
							$morning_out = false;
						} else {
							$morning_out = true;
						}
						if($getDataTimeInOut->afternoon_time_in == null){
							$afternoon_in = false;
						} else {
							$afternoon_in = true;
						}
						if($getDataTimeInOut->afternoon_time_out == null){
							$afternoon_out = false;
						} else {
							$afternoon_out = true;
						}

						if($morning_in === false || ($morning_in === true && $afternoon_in === true && $afternoon_out === false)){
							if($afternoon_in === true && $afternoon_out === false){
								$field_name = 'afternoon_time_out';
								$message = "Goodbye ".$proper_name.". See you tommorow.";
								echo $this->update_time_out($field_name,$time,$date,$account_id,$message);
							} else {
								//Error code: 102894-005
								echo json_encode(["no_error"=>"no", "message"=>"There's an error. Err No. 102894-005. Please contact the MIS."]);
							}
						} else if($morning_in === true && $afternoon_in === false && $morning_out === false){
							$field_name = 'morning_time_out';
							$message = "Goodbye ".$proper_name.". See you this afternoon.";
							echo $this->update_time_out($field_name,$time,$date,$account_id,$message);
						} else if($morning_in === true && $morning_out === true && $afternoon_in === false){
							echo json_encode(["no_error"=>"no", "message"=>$proper_name.", you are already time out (morning). Please check your DTR and time in for the afternon."]);
						} else if($morning_in === true && $morning_out === true && $afternoon_in === true && $afternoon_out === true){
							echo json_encode(["no_error"=>"no", "message"=>$proper_name.", you are already time out both morning and afternoon. Please check your DTR."]);
						} else {
							//Error code 102894-006
							echo json_encode(["no_error"=>"no", "message"=>"There's an error. Err No. 102894-006. Please contact the MIS."]);
						}
					} else {
						echo json_encode(["no_error"=>"no", "message"=>$proper_name.", you didn't time in. Please check your DTR."]);
					}
				}
				
			} else {
				echo json_encode(['info'=>Null,'message'=>'This QR Code is not for Time In or Time Out.']);
			}
		} else if($hidden == 'visit_office'){
			echo json_encode(['info'=>Null,'message'=>'Visit office']);
		}
				
	}

	function update_time_out($field_name,$time,$date,$account_id,$message){
		$data = [
			$field_name => base64_encode($time)
		];

		$bool = $this->Emp_model->UpdateTimeIn($data,$date,$account_id);

		if($bool == true){
			return json_encode(array("no_error"=>"yes", "message"=>$message));
		} else {
			//Error code 102894-007
			return json_encode(["no_error"=>"no", "message"=>"There's an error. Err No. 102894-007. Please contact the MIS."]);
		}
	}

	public function print_dtr(){
		$account_id = $this->nativesession->get('id');
		$this->checkAccountNotNull();
		$month = $this->input->post('month');
    	$Year = $this->input->post('year');
    	$month_array = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
		$emp_information = $this->Emp_model->getInformation($account_id);
		$time_in_out = $this->Emp_model->getTimeInOutPerEmp($month,$Year,$account_id);
		//$this->load->view('print_dtr',$data);
		// create new PDF document
		$pdf = new TCPDF('P', PDF_UNIT, 'A4', true, 'UTF-8', false);
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		// add a page
		$pdf->AddPage();
		// define some HTML content with style
		$name = $emp_information->firstname.' '.strtoupper(str_split($emp_information->middle_name)[0]).'. '.$emp_information->lastname;
		$month_of = $month_array[$month].' '.$Year;
		$html = '
		<!-- EXAMPLE OF CSS STYLE -->
		<style>
			.print_desing {
				font-family: Arial;
			}
			.print_size_title {
				font-size: 14px!important;
			}
			.print_size_name {
				font-size: 12px!important;
				margin-top: 10px;
				border-bottom: 1px solid black;
			}
			.table_dtr, .table_dtr tr td{
				border: 1px solid black;
			}
			.print_size_text{
				font-size: 10px!important;
			}
			.text-center {
				text-align: center !important;
			}
			.text-right {
				text-align: right !important;
			}	
			.text-justify {
				text-align: justify !important;
			}
		</style>
		<table width="100%">
			<tr>
				<td width="48%">
					<table style="width: 100%">
						<tr>
							<td colspan="3" class="print_size_text"><em>Civil Service Form No. 48</em></td>
						</tr>    
						<tr>
							<td colspan="3" class="print_size_title text-center"><b>DAILY TIME RECORD</b></center></td>
						</tr>
						<tr>
							<td colspan="3" class="print_size_text text-center">----o0o----</td>
						</tr>
						<tr>
							<td colspan="3" class="print_size_name text-center"><br><br>'.$name.'</td>
						</tr>
						<tr>
							<td colspan="3" class="print_size_text text-center">(Name)</td>
						</tr>
						<tr>
							<td class="print_size_text">For the month of </td>
							<td colspan="2" class="print_size_text text-center" style="border-bottom: 1px solid black;"><em>'.$month_of.'</em></td>
						</tr>
						<tr>
							<td rowspan="2" cellspacing="2" class="print_size_text text-center" width="40%"><em>Official hours for arrival and departure</em></td>
							<td width="30%" class="print_size_text text-right" style="padding-right: 5px;"><em>Regular Days&nbsp;&nbsp; </em></td>
							<td width="30%" style="border-bottom: 1px solid black;">&nbsp;</td>
						</tr>
						<tr>
							<td width="30%" class="print_size_text text-right" style="padding-right: 5px;"><em>Saturdays&nbsp;&nbsp;</em></td>
							<td width="30%" style="border-bottom: 1px solid black;">&nbsp;</td>
						</tr>
						<tr>
							<td width="100%" class="print_size_text">
								<br>
								<br>
								<table class="table_dtr print_size_text" style="width: 100%">
                  <tr>
                    <td rowspan="2" width="10%" class="text-center"><br><br>Day</td>
                    <td colspan="2" width="30%" class="text-center"><b>A.M.</b></td>
                    <td colspan="2" width="30%" class="text-center"><b>P.M.</b></td>
                    <td colspan="2" width="30%" class="text-center"><b>Undertime</b></td>
                  </tr>
                  <tr>
                    <td width="15%" class="text-center"><b>Arrival</b></td>
                    <td width="15%" class="text-center"><b>Departure</b></td>
                    <td width="15%" class="text-center"><b>Arrival</b></td>
                    <td width="15%" class="text-center"><b>Departure</b></td>
                    <td width="15%" class="text-center"><b>Arrival</b></td>
                    <td width="15%" class="text-center"><b>Departure</b></td>
                  </tr>';
                  for($x=1; $x<=31;$x++){
                    foreach ($time_in_out as $value) {
                      $day = date("d", strtotime($value->date_time_in));
                      if($day == $x){
                        if($value->morning_time_in == null){
                          $morning_time_in = '';
                        } else {
                          $morning_time_in = date("h:i", strtotime(base64_decode($value->morning_time_in)));
                        }

                        if($value->morning_time_out == null){
                          $morning_time_out = '';
                        } else {
                          $morning_time_out = date("h:i", strtotime(base64_decode($value->morning_time_out)));
                        }

                        if($value->afternoon_time_in == null){
                          $afternoon_time_in = '';
                        } else {
                          $afternoon_time_in = date("h:i", strtotime(base64_decode($value->afternoon_time_in)));
                        }

                        if($value->afternoon_time_out == null){
                          $afternoon_time_out = '';
                        } else {
                          $afternoon_time_out = date("h:i", strtotime(base64_decode($value->afternoon_time_out)));
                        }

                        break;
                      } else {
                        $morning_time_in = '';
                        $morning_time_out = '';
                        $afternoon_time_in = '';
                        $afternoon_time_out = '';
                      }
                    }
    $html .= '    <tr>
                    <td width="10%" class="text-center">'.$x.'</td>
                    <td width="15%" class="text-center">'.@$morning_time_in.'</td>
                    <td width="15%" class="text-center">'.@$morning_time_out.'</td>
                    <td width="15%" class="text-center">'.@$afternoon_time_in.'</td>
                    <td width="15%" class="text-center">'.@$afternoon_time_out.'</td>
                    <td width="15%" class="text-center"></td>
                    <td width="15%" class="text-center"></td>
                  </tr>';
                }
    $html .= '	<tr>
                    <td colspan="5" class="text-right"><b>Total&nbsp;&nbsp;</b></td>
                    <td width="15%" class="text-center">&nbsp;</td>
                    <td width="15%" class="text-center">&nbsp;</td>
                  </tr> 
                </table>
							</td>
						</tr>
						<tr>
							<td class="print_size_text text-justify"><em><br>I certify on my honor that the above is a true and correct report of the hours of work performed, record of which was made daily at the time of arrival and departure from office.</em></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid black;"><br><br></td>
						</tr>
						<tr>
							<td class="print_size_text"><br><br><em>VERIFIED as to the prescribed office hours:</em></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid black;"><br><br></td>
						</tr>
						<tr>
							<td class="print_size_text text-center"><em>In Charge</em></td>
						</tr>
					</table>
				</td>
				<td width="4%">
				</td>
				<td width="48%">
					<table style="width: 100%">
						<tr>
							<td colspan="3" class="print_size_text"><em>Civil Service Form No. 48</em></td>
						</tr>    
						<tr>
							<td colspan="3" class="print_size_title text-center"><b>DAILY TIME RECORD</b></center></td>
						</tr>
						<tr>
							<td colspan="3" class="print_size_text text-center">----o0o----</td>
						</tr>
						<tr>
							<td colspan="3" class="print_size_name text-center"><br><br>'.$name.'</td>
						</tr>
						<tr>
							<td colspan="3" class="print_size_text text-center">(Name)</td>
						</tr>
						<tr>
							<td class="print_size_text">For the month of </td>
							<td colspan="2" class="print_size_text text-center" style="border-bottom: 1px solid black;"><em>'.$month_of.'</em></td>
						</tr>
						<tr>
							<td rowspan="2" cellspacing="2" class="print_size_text text-center" width="40%"><em>Official hours for arrival and departure</em></td>
							<td width="30%" class="print_size_text text-right" style="padding-right: 5px;"><em>Regular Days&nbsp;&nbsp; </em></td>
							<td width="30%" style="border-bottom: 1px solid black;">&nbsp;</td>
						</tr>
						<tr>
							<td width="30%" class="print_size_text text-right" style="padding-right: 5px;"><em>Saturdays&nbsp;&nbsp;</em></td>
							<td width="30%" style="border-bottom: 1px solid black;">&nbsp;</td>
						</tr>
						<tr>
							<td width="100%" class="print_size_text">
								<br>
								<br>
								<table class="table_dtr print_size_text" style="width: 100%">
                  <tr>
                    <td rowspan="2" width="10%" class="text-center"><br><br>Day</td>
                    <td colspan="2" width="30%" class="text-center"><b>A.M.</b></td>
                    <td colspan="2" width="30%" class="text-center"><b>P.M.</b></td>
                    <td colspan="2" width="30%" class="text-center"><b>Undertime</b></td>
                  </tr>
                  <tr>
                    <td width="15%" class="text-center"><b>Arrival</b></td>
                    <td width="15%" class="text-center"><b>Departure</b></td>
                    <td width="15%" class="text-center"><b>Arrival</b></td>
                    <td width="15%" class="text-center"><b>Departure</b></td>
                    <td width="15%" class="text-center"><b>Arrival</b></td>
                    <td width="15%" class="text-center"><b>Departure</b></td>
                  </tr>';
                  for($x=1; $x<=31;$x++){
                    foreach ($time_in_out as $value) {
                      $day = date("d", strtotime($value->date_time_in));
                      if($day == $x){
                        if($value->morning_time_in == null){
                          $morning_time_in = '';
                        } else {
                          $morning_time_in = date("h:i", strtotime(base64_decode($value->morning_time_in)));
                        }

                        if($value->morning_time_out == null){
                          $morning_time_out = '';
                        } else {
                          $morning_time_out = date("h:i", strtotime(base64_decode($value->morning_time_out)));
                        }

                        if($value->afternoon_time_in == null){
                          $afternoon_time_in = '';
                        } else {
                          $afternoon_time_in = date("h:i", strtotime(base64_decode($value->afternoon_time_in)));
                        }

                        if($value->afternoon_time_out == null){
                          $afternoon_time_out = '';
                        } else {
                          $afternoon_time_out = date("h:i", strtotime(base64_decode($value->afternoon_time_out)));
                        }

                        break;
                      } else {
                        $morning_time_in = '';
                        $morning_time_out = '';
                        $afternoon_time_in = '';
                        $afternoon_time_out = '';
                      }
                    }
    $html .= '    <tr>
                    <td width="10%" class="text-center">'.$x.'</td>
                    <td width="15%" class="text-center">'.@$morning_time_in.'</td>
                    <td width="15%" class="text-center">'.@$morning_time_out.'</td>
                    <td width="15%" class="text-center">'.@$afternoon_time_in.'</td>
                    <td width="15%" class="text-center">'.@$afternoon_time_out.'</td>
                    <td width="15%" class="text-center"></td>
                    <td width="15%" class="text-center"></td>
                  </tr>';
                }
    $html .= '        
    							<tr>
                    <td colspan="5" class="text-right"><b>Total&nbsp;&nbsp;</b></td>
                    <td width="15%" class="text-center">&nbsp;</td>
                    <td width="15%" class="text-center">&nbsp;</td>
                  </tr> 
                </table>
							</td>
						</tr>
						<tr>
							<td class="print_size_text text-justify"><em><br>I certify on my honor that the above is a true and correct report of the hours of work performed, record of which was made daily at the time of arrival and departure from office.</em></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid black;"><br><br></td>
						</tr>
						<tr>
							<td class="print_size_text"><br><br><em>VERIFIED as to the prescribed office hours:</em></td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid black;"><br><br></td>
						</tr>
						<tr>
							<td class="print_size_text text-center"><em>In Charge</em></td>
						</tr>
					</table>
				</td>
			</tr>    
		</table>     
		';
		$pdf->writeHTML($html, true, 0, true, 0);

		$pdf->lastPage();

		$pdf->Output('DTR '.$month.', '.$Year.'.pdf', 'D');

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
			$message = base64_encode("not_login");
			redirect(base_url('?m='.$message));
		}
	}
}
