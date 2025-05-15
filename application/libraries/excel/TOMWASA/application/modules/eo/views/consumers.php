  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-12">
            <h1 class="m-0">All Consumers</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                  <div class="col-lg-2">
                    <button class="btn btn-success" type="button" data-toggle="modal" data-target="#modal-register"><i class="fas fa-user-plus fa-solid" style="margin-right: 5px;"></i>New Consumer</button>
                    <!-- <button class="btn btn-warning" type="button" id="print_all_qr"><i class="fas fa-print" style="margin-right: 5px;"></i>Print All QR Codes</button> -->
                  </div>
                  <div class="col-lg-2">
                    <form method="post" id="barangay_form">
                      <select class="form-control select2" style="width: 100%;" name="barangay">
                        <?php echo @$selected_barangay != null &&  @$selected_barangay != 'All Barangay'? '<option selected="selected" value="'.$selected_barangay->id.'">'.$selected_barangay->barangay_name.'</option>' : '';?>
                        <option <?php echo @$selected_barangay != null ? '' : 'selected';?>>All Barangay</option>
                        <?php foreach($all_barangays as $value){?>
                        <option value="<?php echo $value->id;?>"><?php echo $value->barangay_name;?></option>
                        <?php }?>
                      </select>
                    </form>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered table-striped" id="consumersTable" style="margin-top: 0px!important;">
                  <thead>
                  <tr>
                    <th width="5%">NO.</th>
                    <th width="20%">NAME</th>
                    <th width="10%">BARANGAY</th>
                    <th width="10%">APPLICATION NO.</th>
                    <th width="10%">TYPE</th>
                    <th width="15%">DATE APPLIED</th>
                    <th width="30%"></th>
                  </tr>
                  </thead>
                  <tbody class="text-center">
                    <?php 
                      foreach ($all_consumers as $value) {
                    ?>
                      <tr>
                        <td><?php echo $value->sequence_number?></td>
                        <td><?php echo $value->name?></td>
                        <td><?php echo $value->barangay_name?></td>
                        <td><?php echo $value->application_number?></td>
                        <td><?php echo $value->consumer_type?></td>
                        <td><?php echo $value->date_applied?></td>
                        <td>
                          <button class="btn btn-primary" style="margin-bottom: 5px;" data-toggle="modal" data-target="#modal-update<?php echo $value->id;?>">Edit</button>
                          <a class="btn btn-warning" href="#">Cut-Off</a>
                          <a class="btn btn-danger" href="#">Delete</a>
                        </td>
                      </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.card -->
          </div>

        </div>

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
