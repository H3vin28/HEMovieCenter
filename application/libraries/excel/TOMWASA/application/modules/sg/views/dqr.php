  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="row mb-12">
              <div class="col-md-12"><h1 class="m-0">QR Code</h1></div>
            </div>
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <img src="<?php echo base_url('assets/qrcode_images_users/').base64_encode($row->account_id.'~'.$row->firstname.'~'.$row->middle_name.'~'.$row->lastname);?>.png" style="border: 1px solid;width: 100%;margin-bottom: 20px;">
                    <a href="<?php echo base_url('assets/qrcode_images_users/').base64_encode($row->account_id.'~'.$row->firstname.'~'.$row->middle_name.'~'.$row->lastname);?>.png" class="btn btn-primary col-lg-12" download>DOWNLOAD QRCODE</a>
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
                    <div class="card card-primary card-outline">
                      <div class="card-body box-profile">
                        <div class="text-center">
                          <img class="profile-user-img img-fluid img-square"
                               src="<?php echo base_url('assets/pro_pic_images/'.$hresult->image);?>"
                               alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center"><?php echo strtoupper($hresult->firstname.' '.str_split($hresult->middle_name)[0].'. '.$hresult->lastname.' '.$hresult->suffix)?></h3>
                        <p class="text-muted text-center"></p>
                        <ul class="list-group list-group-unbordered mb-3 text-center">
                          <li class="list-group-item">
                            <span><?php echo$hresult->email_address?></span>
                          </li>
                          <li class="list-group-item">
                            <span><?php echo strtoupper($hresult->mobile_number)?></span>
                          </li>
                          <li class="list-group-item">
                            <span><?php echo strtoupper($hresult->gender)?></span>
                          </li>
                          <li class="list-group-item">
                            <span><?php echo strtoupper($hresult->barangay_name.', '.$hresult->muni_name.', '.$hresult->province_name.', '.$hresult->region_name)?></span>
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
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->