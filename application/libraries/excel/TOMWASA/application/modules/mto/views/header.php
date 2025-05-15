<body class="layout-top-nav layout-navbar-fixed layout-footer-fixed sidebar-collapse">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <div style="margin-right: 10px;padding: 5px 10px 5px 0px; border-right: 1px solid gray">
        <img src="<?php echo base_url('assets/adminlte/')?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">LSystem</span>
      </div>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav" style="width: 100%">
          <li class="nav-item">
            <a href="<?php echo base_url('emp/')?>" class="nav-link <?php echo $this->uri->segment(2) == '' ? 'active' : '';?>">
              <i class="fas fa-qrcode"></i> <label>Scan</label>
            </a>
          </li>
          <li class="nav-item dropdown <?php echo $this->uri->segment(2) == 'dtr' || $this->uri->segment(2) == 'profile' || $this->uri->segment(2) == 'accounts' ? 'active' : '';?>">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
              <i class="fas fa-users"></i> &nbsp;<label>View</label>
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li <?php echo $hresult->usertype == 1 ? '' : 'hidden'?>><a href="<?php echo base_url('emp/employees/')?> <?php echo $this->uri->segment(2) == 'employees' ? 'active' : '';?>" class="dropdown-item">Employees</a></li>

              <li><a href="<?php echo base_url('emp/profile/')?> <?php echo $this->uri->segment(2) == 'profile' ? 'active' : '';?>" class="dropdown-item">Profile</a></li>

              <li><a href="<?php echo base_url('emp/dtr/')?>" class="dropdown-item <?php echo $this->uri->segment(2) == 'dtr' ? 'active' : '';?>">DTR</a></li>

              <li <?php echo $hresult->usertype == 1 ? '' : 'hidden'?>><a href="<?php echo base_url('emp/classrooms/')?>" class="dropdown-item <?php echo $this->uri->segment(2) == 'classrooms' ? 'active' : '';?>">Classrooms</a></li>
              <li><a href="#" class="dropdown-item">History</a></li>
            </ul>
          </li> 
          <li class="nav-item acc_name">
            <span class="navbar-brand">
              <img src="<?php echo base_url('assets/pro_pic_images/'.$hresult->image);?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="width: 22%!important;opacity: 0.8">
              <span class="brand-text font-weight-light"><?php echo $hresult->firstname.' '.strtoupper(str_split($hresult->middle_name)[0]).'. '.$hresult->lastname.' '.$hresult->name_extension?></span>
            </span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url('emp/logout/')?>">
              <i class="fas fa-power-off"></i> <label>Logout</label>
            </a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <!-- <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <li class="nav-item">
          <span class="navbar-brand">
            <img src="<?php echo base_url('assets/pro_pic_images/'.$hresult->image);?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="width: 22%!important;opacity: 0.8">
            <span class="brand-text font-weight-light"><?php echo $hresult->firstname.' '.strtoupper(str_split($hresult->middle_name)[0]).'. '.$hresult->lastname.' '.$hresult->name_extension?></span>
          </span>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url('emp/logout/')?>">
            <i class="fas fa-power-off"></i> <label>Logout</label>
          </a>
        </li>
      </ul> -->
    </div>
  </nav>
  <!-- /.navbar -->