  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Dashboard</h1>
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
            <a href="<?php echo base_url('eo/consumers/')?>" style="color: black">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>All Consumers</strong></span>
                  <span class="info-box-number"><?php echo number_format(count($all_consumers));?></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3">
            <a href="<?php echo base_url('eo/meter_reading/')?>" style="color: black">
              <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-solid fa-chalkboard-user"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Meter Reading</strong></span>
                  <span class="info-box-number"><strong><?php echo date('Y');?></strong></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3">
            <a href="<?php echo base_url('eo/individual_ledger/')?>" style="color: black">
              <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-address-book fa-fw"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Individual Ledger</strong></span>
                  <span class="info-box-number"><strong><?php echo date('Y');?></strong></span>
                </div>
              </div>
            </a>
          </div>
          <div class="col-lg-3">
            <a href="<?php echo base_url('eo/monthly_billing/')?>" style="color: black">
              <div class="info-box">
                <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-solid fa-calendar-days"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text"><strong>Monthly Billing</strong></span>
                  <span class="info-box-number"><strong><?php echo date('Y');?></strong></span>
                </div>
              </div>
            </a>
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <style type="text/css">
                .container1 {
                  display: flex;
                  padding: 0.5em;
                }
                .text-orientation {
                  text-orientation: inherit;
                  text-align: center;
                }
              </style>
              <div class="card-body">
                <div class="chart">
                  <center>
                    <h6>TOMAS OPPUS MUNICIPAL WATER SYSTEM ADMINISTRATION</h6>
                    <h5>WATER CONSUMPTION</h5>
                  </center>
                  <div class="container1">
                    <h6 style="writing-mode: vertical-rl;margin: 0px;" class="text-orientation">AMOUNT IN CUBIC METER</h6>
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

