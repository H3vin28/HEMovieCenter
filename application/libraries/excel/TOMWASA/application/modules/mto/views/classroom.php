  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Classrooms</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                  <div class="col-lg-12"><h4>New Classroom</h4></div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?php echo base_url('emp/insert_classroom/');?>" method="post">
                  <div class="text-right">
                    <button class="btn btn-success" type="button" id="do_add_form"><span class="fas fa-plus"></span></button>
                  </div>
                  <div id="form">
                    <div class="card-body" style="border:1px solid black;border-radius: 5px;margin: 5px 0px;">
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Classroom Name" name="classroom[]" required>
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-home"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div id="append_form"></div>
                  <div class="social-auth-links text-center mt-2 mb-3">
                    <input type="hidden" name="office_designation_id" value="<?php echo $office_designation_id;?>">
                    <input type="submit" class="btn btn-block btn-primary" value="Save">
                  </div>
                </form>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card card-primary">
              <div class="card-header">
                <div class="row">
                  <div class="col-lg-8"><h4>All Classrooms</h4></div>
                  <div class="col-lg-4 text-right"><button id="print_all" class="btn btn-warning"><span class="fas fa-print"></span> Print All QR Codes</button></div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="classroom" class="table table-bordered table-striped" style="margin-top: 0px!important;">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Classroom?</th>
                    <th>QR Code</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if(count($classroom) != 0 ){
                    foreach ($classroom as $value) {
                    ?>
                    <tr>
                      <td><?php echo $value->classroom_name;?></td>
                      <td>
                        <center>
                          <div class="custom-control custom-checkbox">
                            <input class="custom-control-input custom-control-input-primary" type="checkbox" id="customCheckbox4" <?php echo $value->type == 1 ? 'checked' : '';?> >
                            <label for="customCheckbox4" class="custom-control-label"></label>
                          </div>
                        </center>
                      </td>
                      <td>
                        <center>
                          <?php 
                          $encode = base64_encode($value->id.'~'.$value->classroom_name.'~'.$value->designated_office_id.'~'.$value->type);
                          $path = str_replace("\\", "/", FCPATH."assets/qrcode_images_doc/".$encode.'.png');
                          $path1 = str_replace("+", " ", $path);
                          if(file_exists($path1)){ ?>
                            <img src="<?php echo base_url('assets/qrcode_images_doc/'.str_replace("+", " ", $encode).'.png')?>" width="100px"  height="100px"/>                  
                          <?php } else{ ?>
                            <a href="<?php echo base_url('emp/gen_qr/?c='.$encode)?>" class="btn btn-success">Generate</a>
                          <?php } ?>
                        </center>
                      </td>
                      <td>
                        <center>
                          <button class="btn btn-primary" onclick="edit(<?php echo $value->id;?>)">Edit</button>
                          <button class="btn btn-warning" onclick="printDiv('<?php echo base_url('assets/qrcode_images_doc/').str_replace("+", " ",$encode);?>`<?php echo base64_decode($encode)?>')"><span class="fas fa-print"></span> Print QR</button>
                        </center>
                      </td>
                    </tr>
                  <?php }} else {?>
                    <tr>
                      <td colspan="4"><center>No Data Found!</center></td>
                    </tr>
                  <?php }?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
  
        <div class="row" id="printableArea" hidden>
          <div class="col-md-5">
            <img id="qr_image" width="100%" />
            <center><label id="name_office"></label></center>
          </div>
        </div>

        <div class="row" id="printableArea_all" style="page-break-inside: auto;" hidden>
          <?php 
          foreach ($classroom as $value) {
            $encode = base64_encode($value->id.'~'.$value->classroom_name.'~'.$value->designated_office_id.'~'.$value->type);
            $path = str_replace("\\", "/", FCPATH."assets/qrcode_images_doc/".$encode.'.png');
            $path1 = str_replace("+", " ", $path);
            if(file_exists($path1)){
            ?>
              <div class="col-md-6">
                <img src="<?php echo base_url('assets/qrcode_images_doc/'.str_replace("+", " ", $encode).'.png')?>" width="100%"/> 
                <center><label><h1><?php echo $value->classroom_name;?></h1></label></center>
              </div>
        <?php 
            }
          }?>
        </div>
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->