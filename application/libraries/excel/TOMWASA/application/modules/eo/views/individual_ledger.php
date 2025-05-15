  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-12">
            <h1 class="m-0">Individual Ledger</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12 col-lg-12">
            <div class="card card-primary card-tabs">
              <div class="card-header"></div>
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-2 mb-2">
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
                <div class="row">
                  <div class="col-lg-12">
                    <table id="individual_ledger" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th width="13%">Sequence No.</th>
                          <th>Customers' Name</th>
                          <th width="5%">Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($all_consumers as $value){?>
                        <tr>
                          <td><?php echo $value->id?></td>
                          <td><?php echo $value->name?></td>
                          <td><?php echo $value->status?></td>
                          <td><button class="btn btn-primary col-lg-12" data-toggle="modal" data-target="#ledger_modal<?php echo $value->id?>">View</button></td>

                          <div class="modal fade" id="ledger_modal<?php echo $value->id?>">
                            <div class="modal-dialog">
                              <div class="modal-content" style="width: 200%;">
                                <div class="modal-header">
                                  <h4 class="modal-title">Add Meter Reading</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <form action="<?php echo base_url('eo/AddMeterReading/')?>" method="POST" autocomplete="off">
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-lg-12">
                                        <div class="form-group row">
                                          <label class="col-sm-6 col-form-label"><b>Name</b></label>
                                          <label class="col-sm-2 col-form-label"><center><b>Last</b></center></label>
                                          <label class="col-sm-3 col-form-label"><center><b>Current</b></center></label>
                                        </div>
                                      </div>
                                      <div class="col-lg-12" id="consumersListDiv">
                                      </div>
                                    </div> 
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Print</button>
                                  </div>
                                </form>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
          </div>

        </div>

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>