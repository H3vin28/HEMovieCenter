  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-lg-2">
          </div>
          <div class="col-lg-8">
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
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="row mb-12">
                      <div class="col-md-12"><h1 class="m-0">QR Code</h1></div>
                    </div>
                    <div class="card card-primary card-outline">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <img src="<?php echo base_url('assets/qrcode_images_users/').base64_encode($hresult->account_id.'~'.$hresult->firstname.'~'.$hresult->middle_name.'~'.$hresult->lastname);?>.png" style="border: 1px solid;width: 100%;margin-bottom: 20px;">
                            <a href="<?php echo base_url('assets/qrcode_images_users/').base64_encode($hresult->account_id.'~'.$hresult->firstname.'~'.$hresult->middle_name.'~'.$hresult->lastname);?>.png" class="btn btn-primary col-lg-12" download>DOWNLOAD QRCODE</a>
                          </div>
                        </div>
                      </div>
                    </div><!-- /.card -->
                  </div>
                  <div class="col-lg-8">
                    <div class="row mb-12">
                      <div class="col-md-10"><h1 class="m-0">Profile</h1></div>
                      <div class="col-md-2"><a href="#" class="m-0">Edit</a></div>
                    </div>
                    <div class="card card-primary card-outline">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12">
                            <!-- Profile Image -->
                            <div class="card card-danger card-outline">
                              <div class="card-body box-profile">
                                <div class="text-center">
                                  <img class="profile-user-img img-fluid img-square"
                                       src="<?php echo base_url('assets/pro_pic_images/'.$hresult->image);?>"
                                       alt="User profile picture">
                                </div>
                                <h3 class="profile-username text-center"><?php echo strtoupper($hresult->firstname.' '.str_split($hresult->middle_name)[0].'. '.$hresult->lastname.' '.$hresult->name_extension)?></h3>
                                <p class="text-muted text-center"></p>
                                <ul class="list-group list-group-unbordered mb-3 text-center">
                                  <li class="list-group-item">
                                    <span><?php echo $hresult->email_address?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span><?php echo strtoupper($hresult->office_name)?></span>
                                  </li>
                                  <li class="list-group-item">
                                    <span><?php echo strtoupper($hresult->position)?></span>
                                  </li>
                                </ul>
                              </div>
                              <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                          </div>
                        </div>
                      </div>
                    </div><!-- /.card -->
                  </div>
                  <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
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