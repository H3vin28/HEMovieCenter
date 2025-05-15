  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Daily Time Record</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
          </div>
          <div class="col-lg-5">
            <form action="<?php echo base_url('emp/print_dtr/')?>" method="post">
              <div style="margin-bottom: 10px;"><button type="submit" class="btn btn-primary">Print DTR as PDF</button></div>
              <div class="card card-primary card-outline">
                <div class="card-body">
                  <div class="container" id="print_dtr">
                    <div class="row print_desing">
                      <div class="col-lg-12">
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
                          ?>
                          <em><span>For the month of </span></em>
                          <select class="changeDtr" style="width: 30%; margin-left: 10px" name="month" id="month">
                            <option <?php echo $month == 1 ? 'selected': '';?> value="1">January</option>
                            <option <?php echo $month == 2 ? 'selected': '';?> value="2">February</option>
                            <option <?php echo $month == 3 ? 'selected': '';?> value="3">March</option>
                            <option <?php echo $month == 4 ? 'selected': '';?> value="4">April</option>
                            <option <?php echo $month == 5 ? 'selected': '';?> value="5">May</option>
                            <option <?php echo $month == 6 ? 'selected': '';?> value="6">June</option>
                            <option <?php echo $month == 7 ? 'selected': '';?> value="7">July</option>
                            <option <?php echo $month == 8 ? 'selected': '';?> value="8">August</option>
                            <option <?php echo $month == 9 ? 'selected': '';?> value="9">September</option>
                            <option <?php echo $month == 10 ? 'selected': '';?> value="10">October</option>
                            <option <?php echo $month == 11 ? 'selected': '';?> value="11">November</option>
                            <option <?php echo $month == 12 ? 'selected': '';?> value="12">December</option>
                          </select>
                          <select class="changeDtr" style="width: 20%; margin-left: 10px" name="year">
                            <?php for($Year = date("Y"); $Year >= 2021; $Year--){?>
                              <option><?php echo $Year;?></option>
                            <?php } ?>
                          </select>
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
                        <div class="print_size_dtr card-body table-responsive p-0" style="margin-top: 10px;">
                          <table class="table table_dtr table-bordered" style="font-size: 14px!important;">
                            <thead>
                              <tr>
                                <th rowspan="2" width="10%" class="text-center">Day</th>
                                <th colspan="2" width="30%" class="text-center">A.M.</th>
                                <th colspan="2" width="30%" class="text-center">P.M.</th>
                                <th colspan="2" width="30%" class="text-center">Undertime</th>
                              </tr>
                              <tr>
                                <th width="15%" class="text-center">Arrival</th>
                                <th width="15%" class="text-center">Departure</th>
                                <th width="15%" class="text-center">Arrival</th>
                                <th width="15%" class="text-center">Departure</th>
                                <th width="15%" class="text-center">Arrival</th>
                                <th width="15%" class="text-center">Departure</th>
                              </tr>
                            </thead>
                            <tbody id="dtr_month">
                              <?php
                              for($x=1; $x<=31;$x++){
                                foreach ($time_in_out as $value) {
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
                            </tbody>
                            <tr>
                              <td colspan="5" class="text-right"><b>Total</b></td>
                              <td width="15%" class="text-center">&nbsp;</td>
                              <td width="15%" class="text-center">&nbsp;</td>
                            </tr>
                          </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="print_size_text text-justify" style="padding-top: 15px;"><em><span>I certify on my honor that the above is a true and correct report of the hours of work performed, record of which was made daily at the time of arrival and departure from office.</span></em></div>
                        <div class="print_size_text" style="border-bottom: 2px solid black"></br>&nbsp;</div>
                        <div class="print_size_text"></br><em>VERIFIED as to the prescribed office hours:</em></div>
                        <div class="print_size_text" style="border-bottom: 2px solid black"></br>&nbsp;</div>
                        <div class="print_size_text text-center"><em>In Charge</em></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div><!-- /.card -->
            </form>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-4">
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
