  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-12">
            <h1 class="m-0">Meter Reading</h1>
            <button type="button" class="btn btn-success mt-2" style="float:left" data-toggle="modal" data-target="#meterReading"><i class="fas fa-circle-plus"></i> Input Meter Reading</button>
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
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <?php echo $nav_items;?>
                </ul>
              </div>
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
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <?php echo $tab_panes;?>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>

        </div>

        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <div class="modal fade" id="meterReading">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add Meter Reading</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url('eo/AddMeterReading/')?>" method="POST" autocomplete="off">
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12" style="margin-bottom:4px;">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-3 col-form-label">Month of: </label>
                  <div class="col-sm-4">
                    <select class="form-control select2" style="width: 100%;" name="month">
                      <option selected disabled>Select Month</option>
                      <option value="1">January</option>
                      <option value="2">February</option>
                      <option value="3">March</option>
                      <option value="4">April</option>
                      <option value="5">May</option>
                      <option value="6">June</option>
                      <option value="7">July</option>
                      <option value="8">August</option>
                      <option value="9">September</option>
                      <option value="10">October</option>
                      <option value="11">November</option>
                      <option value="12">December</option>
                    </select>
                    <textarea id="array_id" name="arrays_id" hidden></textarea>
                    <textarea id="last" name="last" hidden></textarea>
                  </div>
                  <div class="form-group col-sm-5" style="margin-top:7px;">
                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input" id="not_minimum" name="minimum"value="0">
                      <label class="custom-control-label" for="not_minimum" id="not_minimum_label">Not Minimum</label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group row" style="border-bottom: 2px solid #aba4a4; border-top: 2px solid #aba4a4; padding-bottom: 4px;">
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
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>