<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
              <li class="breadcrumb-item">View</li>
              <li class="breadcrumb-item active">Partially Damage</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4">
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-3 col-form-label">Barangay&nbsp;</label>
              <div class="col-sm-9">
                <form action="<?php echo base_url('admin/totally/')?>" method="get" id="brgy_form">
                  <select class="form-control select2" style="width: 100%;" name="brgy" id="brgy_select">
                    <option selected="selected"><?php echo @$this->input->get('brgy') != null ? @$this->input->get('brgy') : 'Anahawan';?></option>
                    <option>Anahawan</option>
                    <option>Banday</option>
                    <option>Biasong</option>
                    <option>Bogo</option>
                    <option>Cabascan</option>
                    <option>Camansi</option>
                    <option>Cambite</option>
                    <option>Canlupao</option>
                    <option>Carnaga</option>
                    <option>Cawayan</option>
                    <option>Higosoan</option>
                    <option>Hinagtikan</option>
                    <option>Hinapo</option>
                    <option>Hugpa</option>
                    <option>Iniguihan</option>
                    <option>Looc</option>
                    <option>Luan</option>
                    <option>Maanyag</option>
                    <option value="mag_ata">Mag-ata</option>
                    <option>Mapgap</option>
                    <option>Maslog</option>
                    <option>Punong</option>
                    <option>Rizal</option>
                    <option value="san_agustin">San Agustin</option>
                    <option value="san_antonio">San Antonio</option>
                    <option value="san_isidro">San Isidro</option>
                    <option value="san_miguel">San Miguel</option>
                    <option value="san_roque">San Roque</option>
                    <option>Tinago</option>
                  </select>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fa fa-server"></i>&nbsp;All Partially Damages of Brgy. <?php echo @$this->input->get('brgy') != null ? @$this->input->get('brgy') : 'Anahawan';?>
                </h3>
                <button type="button" class="btn btn-default" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#modal-sm" id="hid_modal_button" hidden>sadad
                </button>
                <div class="modal fade" id="modal-sm">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header text-center">
                        <h2>Wait patiently while the system generating the QR codes for all of the properties.</h2>
                      </div>
                      <div class="modal-body">
                        <div class="overlay">
                            <i class="fas fa-2x fa-sync fa-spin"></i>
                        </div>
                        <center><img src="<?php echo base_url('assets/favicon_io/to_logo.png')?>"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <table id="" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th rowspan="2" style="width: 7%!important">FAM_NO</th>
                      <th rowspan="2" style="width: 6%!important">HH_UN</th>
                      <th colspan="4" style="width: 4%!important">NAME</th>
                      
                      <!-- <th style="writing-mode: vertical-lr;width: 4%!important">AGE</th> -->
                      <th rowspan="2">RELATIONSHIP</th>
                      <th rowspan="2">TYPE</th>
                      <!-- <th style="writing-mode: vertical-lr;width: 4%!important">FAMILY SIZE</th> -->
                      <!-- <th rowspan="2">REMARKS</th> -->
                    </tr>
                    <tr>
                      <th>SURNAME</th>
                      <th>FIRSTNAME</th>
                      <th>MIDDLE NAME</th>
                      <th style="writing-mode: vertical-lr;width: 4%!important">EXT</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($allBeneficiaries as $value){
                    ?>
                    <tr>
                      <td><?php echo $value->fam_no?></td>
                      <td><?php echo $value->hh_un?></td>
                      <!-- <td><?php echo $value->no != 0 ? $value->no : '';?></td> -->
                      <td><?php echo $value->surname?></td>
                      <td><?php echo $value->firstname?></td>
                      <td><?php echo $value->ext?></td>
                      <td><?php echo $value->middle_name?></td>
                      <!-- <td><?php echo $value->age?></td> -->
                      <td><?php echo $value->relationship?></td>
                      <td>
                        <?php 
                          if(strtoupper($value->relationship) == 'HEAD'){
                            if($value->damage == 2){
                              echo 'Totally Damage';
                            } else {
                              echo 'Partially Damage';
                            }
                          } else {
                            echo '';
                          }
                        ?>    
                      </td>
                      <!-- <td><?php echo $value->family_resize != 0 ? $value->family_resize : '';?></td>
                      <td><?php echo $value->remarks?></td> -->
                    </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>