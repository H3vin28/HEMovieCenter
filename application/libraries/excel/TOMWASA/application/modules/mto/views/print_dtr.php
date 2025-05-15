  <?php 
  $account_id = $this->nativesession->get('id');
  $this->checkAccountNotNull();
  $month = $this->input->post('month');
  $Year = $this->input->post('year');
  $month_array = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
  $emp_information = $this->Emp_model->getInformation($account_id);
  $time_in_out = $this->Emp_model->getTimeInOutPerEmp($month,$Year,$account_id);


  ?>
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/')?>custom-css.css">
    <div class="content">
      <div class="container">                  
        <div class="row print_desing">
          <div class="col-lg-6">
            <div class="print_size_text"><em><span>Civil Service Form No. 48</span></em></div>
            <div class="print_size_title text-center mb-0"><span><b>DAILY TIME RECORD</b></span></div>
            <div class="print_size_text text-center" style="line-height: 0.5;"><span>----o0o----</span></div>
            <div class="print_size_name text-center">
              <?php echo $emp_information->firstname.' '.strtoupper(str_split($emp_information->middle_name)[0]).'. '.$emp_information->lastname;?>
            </div>
            <div class="print_size_text text-center" style="line-height: 1;border-top: 1px solid black;">
              <span>(Name)</span>
            </div>
            <div class="print_size_text">
              <?php 
                $month = date("m");
                $Year = date("Y");
                $month_array = ['','January','February','March','April','May','June','July','August','September','October','November','December'];
              ?>
              <table style="width: 100%">
                <tr>
                  <td width="40%" class="text-center"><em>For the month of </em></td>
                  <td width="60%" class="text-center"><div style="border-bottom: 1px solid black;width: 100%;"><?php echo $month_array[$month];?> <?php echo $Year;?></div></td>
                </tr>
              </table>
            </div>

            <div class="print_size_text">
              <em>
                <table>
                  <tr>
                    <td rowspan="2" width="40%" class="text-center">Official hours for arrival and departure</td>
                    <td class="text-right" style="padding-right: 5px;width: 30%">Regular days </td>
                    <td width="30%"><div style="border-bottom: 1px solid black;width: 100%;">&nbsp;</div></td>
                  </tr>
                  <tr>
                    <td class="text-right" style="padding-right: 5px;width: 30%">Saturdays </td>
                    <td width="30%"><div style="border-bottom: 1px solid black;width: 100%;">&nbsp;</div></td>
                  </tr>
                </table>
              </em>
            </div>
            <div class="print_size_dtr" style="margin-top: 10px;">
                <table class="table_dtr" style="width: 100%">
                  <tr>
                    <td rowspan="2" width="10%" class="text-center">Day</td>
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
                  </tr>
                  <?php
                  for($x=1; $x<=31;$x++){
                    foreach ($time_in_out as $value) {
                      $day = date("d", strtotime($value->date_time_in));
                      if($day == $x){
                        if($value->morning_time_in == '00:00:00'){
                          $morning_time_in = '';
                        } else {
                          $morning_time_in = date("h:i", strtotime($value->morning_time_in));
                        }

                        if($value->morning_time_out == '00:00:00'){
                          $morning_time_out = '';
                        } else {
                          $morning_time_out = date("h:i", strtotime($value->morning_time_out));
                        }

                        if($value->afternoon_time_in == '00:00:00'){
                          $afternoon_time_in = '';
                        } else {
                          $afternoon_time_in = date("h:i", strtotime($value->afternoon_time_in));
                        }

                        if($value->afternoon_time_out == '00:00:00'){
                          $afternoon_time_out = '';
                        } else {
                          $afternoon_time_out = date("h:i", strtotime($value->afternoon_time_out));
                        }

                        break;
                      } else {
                        $morning_time_in = '';
                        $morning_time_out = '';
                        $afternoon_time_in = '';
                        $afternoon_time_out = '';
                      }
                    }
                  ?>
                  <tr>
                    <td width="10%" class="text-center"><?php echo $x;?></td>
                    <td width="15%" class="text-center"><?php echo @$morning_time_in;?></td>
                    <td width="15%" class="text-center"><?php echo @$morning_time_out;?></td>
                    <td width="15%" class="text-center"><?php echo @$afternoon_time_in;?></td>
                    <td width="15%" class="text-center"><?php echo @$afternoon_time_out;?></td>
                    <td width="15%" class="text-center"></td>
                    <td width="15%" class="text-center"></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="5" class="text-right"><b>Total</b></td>
                    <td width="15%" class="text-center">&nbsp;</td>
                    <td width="15%" class="text-center">&nbsp;</td>
                  </tr>
                </table>
            </div>
            <div class="print_size_text text-justify"><em><span>I certify on my honor that the above is a true and correct report of the hours of work performed, record of which was made daily at the time of arrival and departure from office.</span></em></div>
            <div class="print_size_text" style="border-bottom: 2px solid black"></br>&nbsp;</div>
            <div class="print_size_text"></br><em>VERIFIED as to the prescribed office hours:</em></div>
            <div class="print_size_text" style="border-bottom: 2px solid black"></br>&nbsp;</div>
            <div class="print_size_text text-center"><em>In Charge</em></div>
          </div>
          <div class="col-lg-6">
            <div class="print_size_text"><em><span>Civil Service Form No. 48</span></em></div>
            <div class="print_size_title text-center mb-0"><span><b>DAILY TIME RECORD</b></span></div>
            <div class="print_size_text text-center" style="line-height: 0.5;"><span>----o0o----</span></div>
            <div class="print_size_name text-center">
              <?php echo $emp_information->firstname.' '.strtoupper(str_split($emp_information->middle_name)[0]).'. '.$emp_information->lastname;?>
            </div>
            <div class="print_size_text text-center" style="line-height: 1;border-top: 1px solid black;">
              <span>(Name)</span>
            </div>
            <div class="print_size_text">
              <table style="width: 100%">
                <tr>
                  <td width="40%" class="text-center"><em>For the month of </em></td>
                  <td width="60%" class="text-center"><div style="border-bottom: 1px solid black;width: 100%;"><?php echo $month_array[$month];?> <?php echo $Year;?></div></td>
                </tr>
              </table>
            </div>

            <div class="print_size_text">
              <em>
                <table>
                  <tr>
                    <td rowspan="2" width="40%" class="text-center">Official hours for arrival and departure</td>
                    <td class="text-right" style="padding-right: 5px;width: 30%">Regular days </td>
                    <td width="30%"><div style="border-bottom: 1px solid black;width: 100%;">&nbsp;</div></td>
                  </tr>
                  <tr>
                    <td class="text-right" style="padding-right: 5px;width: 30%">Saturdays </td>
                    <td width="30%"><div style="border-bottom: 1px solid black;width: 100%;">&nbsp;</div></td>
                  </tr>
                </table>
              </em>
            </div>
            <div class="print_size_dtr" style="margin-top: 10px;">
                <table class="table_dtr" style="width: 100%">
                  <tr>
                    <td rowspan="2" width="10%" class="text-center">Day</td>
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
                  </tr>
                  <?php
                  for($x=1; $x<=31;$x++){
                    foreach ($time_in_out as $value) {
                      $day = date("d", strtotime($value->date_time_in));
                      if($day == $x){
                        if($value->morning_time_in == '00:00:00'){
                          $morning_time_in = '';
                        } else {
                          $morning_time_in = date("h:i", strtotime($value->morning_time_in));
                        }

                        if($value->morning_time_out == '00:00:00'){
                          $morning_time_out = '';
                        } else {
                          $morning_time_out = date("h:i", strtotime($value->morning_time_out));
                        }

                        if($value->afternoon_time_in == '00:00:00'){
                          $afternoon_time_in = '';
                        } else {
                          $afternoon_time_in = date("h:i", strtotime($value->afternoon_time_in));
                        }

                        if($value->afternoon_time_out == '00:00:00'){
                          $afternoon_time_out = '';
                        } else {
                          $afternoon_time_out = date("h:i", strtotime($value->afternoon_time_out));
                        }

                        break;
                      } else {
                        $morning_time_in = '';
                        $morning_time_out = '';
                        $afternoon_time_in = '';
                        $afternoon_time_out = '';
                      }
                    }
                  ?>
                  <tr>
                    <td width="10%" class="text-center"><?php echo $x;?></td>
                    <td width="15%" class="text-center"><?php echo @$morning_time_in;?></td>
                    <td width="15%" class="text-center"><?php echo @$morning_time_out;?></td>
                    <td width="15%" class="text-center"><?php echo @$afternoon_time_in;?></td>
                    <td width="15%" class="text-center"><?php echo @$afternoon_time_out;?></td>
                    <td width="15%" class="text-center"></td>
                    <td width="15%" class="text-center"></td>
                  </tr>
                  <?php } ?>
                  <tr>
                    <td colspan="5" class="text-right"><b>Total</b></td>
                    <td width="15%" class="text-center">&nbsp;</td>
                    <td width="15%" class="text-center">&nbsp;</td>
                  </tr>
                </table>
            </div>
            <div class="print_size_text text-justify"><em><span>I certify on my honor that the above is a true and correct report of the hours of work performed, record of which was made daily at the time of arrival and departure from office.</span></em></div>
            <div class="print_size_text" style="border-bottom: 2px solid black"></br>&nbsp;</div>
            <div class="print_size_text"></br><em>VERIFIED as to the prescribed office hours:</em></div>
            <div class="print_size_text" style="border-bottom: 2px solid black"></br>&nbsp;</div>
            <div class="print_size_text text-center"><em>In Charge</em></div>
          </div>
        </div>
      </div>
    </div>