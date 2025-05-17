<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: rgba(5, 19, 67, 1);">
    <!-- Brand Logo -->
    <!-- <a href="#" class="brand-link" style="background-color: rgba(5, 19, 67, 1);">
      <img src="<?= base_url('assets/images/HEMC1.png')?>" alt="AdminLTE Logo" class="" style="width: 100%;">
    </a> -->

    <!-- Sidebar -->
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/images/HEMC1.png')?>" alt="AdminLTE Logo" class="" style="width: 96%;">
        </div>
      </div>

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/images/pro_pic.png')?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block" data-toggle="modal" <?= @$row != null ? 'data-target="#user-modal"':' data-target="#login-modal"'?> ><?= @$row != null ? '@'.$row->username:'Login'?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="<?= base_url()?>" class="nav-link <?= $this->uri->segment(2) == null ? 'active' : ''?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="<?= base_url('main/movies/')?>" class="nav-link <?= $this->uri->segment(2) == 'movies' || $this->uri->segment(2) == 'selected_movie' ? 'active' : ''?>">
              <i class="nav-icon fas fa-film"></i>
              <p>
                Movies
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <div class="modal fade" id="login-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">LOGIN PAGE</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="form_submit" autocomplete="off" method="post" action="<?= base_url('main/login_process/')?>">
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <label>Email Address or Username</label>
                <div class="input-group mb-3">
                  <input type="text" class="form-control" name="email" placeholder="Enter Username or Email">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <label>Password</label>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" name="password" placeholder="Enter Password">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-eye" id="p_eye1" data-id="1"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Signin</button>
          </div>
          <div class="modal-footer justify-content-between">
            <a href="<?= base_url('main/signup/')?>">Don't have any account? Click this to Signup</a>
          </div>
        </form> 
      </div> 
    </div>
  </div>
  <div class="modal fade" id="user-modal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">USER INFORMATION</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Full Name:</label>
            <p class="form-control-plaintext"><?= $row->fullname ?></p>
          </div>
          
          <div class="form-group">
            <label>Username:</label>
            <p class="form-control-plaintext"><?= $row->username ?></p>
          </div>

          <div class="form-group">
            <label>Email Address:</label>
            <p class="form-control-plaintext"><?= $row->email ?></p>
          </div>

          <div class="form-group">
            <label>Password:</label>
            <input type="password" class="form-control" value="********" readonly>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"><i class="fas fa-edit"></i> EDIT INFORMATION</button>
        </div>
      </div>
    </div>
  </div>
