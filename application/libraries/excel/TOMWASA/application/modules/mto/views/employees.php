  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-2">
          </div>
          <div class="col-lg-8">
            <h1 class="m-0">All Employees</h1>
          </div><!-- /.col -->
          <div class="col-lg-2">
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-2"></div>
          <div class="col-lg-8">
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                  <div class="col-lg-12">
                    <center>
                    <h3><?php echo $department->office_name?> Department</h3> 
                    </center>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="employees_table" style="margin-top: 0px!important;">
                  <thead>
                  <tr>
                    <th>Profile Picture</th>
                    <th>Name</th>
                    <th>Office Designation</th>
                    <th>QR Code</th>
                    <th>Position</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                      foreach ($all_employees as $value) {
                    ?>
                      <tr>
                        <td width="10%">
                          <img class="brand-image img-circle elevation-3" src="<?php echo base_url('assets/pro_pic_images/'.$value->image)?>" width="60px" height="60px">
                        </td>
                        <td><?php echo $value->firstname.' '.strtoupper(str_split($value->middle_name)[0]).'. '. $value->lastname?></td>
                        <td><?php echo $value->office_name?></td>
                        <td>
                          <?php $text = base64_encode($value->account_id.'~'.$value->firstname.'~'.$value->middle_name.'~'.$value->lastname);?>
                          <img class="brand-image" src="<?php echo base_url('assets/qrcode_images_users/'.$text)?>.png" width="60px" height="60px">
                        </td>
                        <td><?php echo $value->position?></td>
                        <td>
                          <?php 
                          if($value->acc_status == 1){
                            echo '<span class="btn btn-success button_employee status_cursor">Approved</span>';
                          }else if($value->acc_status == 0){
                            echo '<span class="btn btn-warning button_employee status_cursor">No Action</span>';
                          }else if($value->acc_status == 2){
                            echo '<span class="btn btn-danger button_employee status_cursor">Declined</span>';
                          }?>
                          
                        </td>
                        <td>
                          <?php if($value->acc_status == 1){?>
                            <button class="btn btn-primary button_employee"onclick="update('<?php echo $value->account_id?>~0')">Deactivate</button>
                          <?php }else if($value->acc_status == 0){ ?>
                            <button class="btn btn-success button_employee" onclick="update('<?php echo $value->account_id?>~1')">Approve</button>
                            <button class="btn btn-danger button_employee" onclick="update('<?php echo $value->account_id?>~2')">Decline</button>
                          <?php }else if($value->acc_status == 2){?>
                            <button class="btn btn-danger button_employee" onclick="update('<?php echo $value->account_id?>~3')">Delete</button>
                            <button class="btn btn-success button_employee" onclick="update('<?php echo $value->account_id?>~1')">Approve</button>
                          <?php }?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-lg-2"></div>

        </div>

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <button type="button" id="hidden_btn_modal" class="btn btn-default" data-toggle="modal" data-target="#modal-default" hidden>
    Launch Default Modal
  </button>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="<?php echo base_url('emp/changeAccStatus/')?>" method="post">
          <div class="modal-header">
            <h4 class="modal-title"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="account_id" id="account_id">
            <input type="hidden" name="action_number" id="action_number">
            <center>
              <h5><label id="account_name"></label></h5>
              <h5><label id="modal_text"></label></h5>
              <br>
            </center>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-success col-sm-5" data-dismiss="modal">No</button>
            <button type="submit" class="btn btn-danger col-sm-5">Yes</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->