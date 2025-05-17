<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 float-left">ALL USERS</h1>
            <button class="btn btn-success ml-3" type="button" data-toggle="modal" data-target="#add-admin-modal"><i class="fas fa-plus-square"></i> Add Admin</button>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">View</a></li>
              <li class="breadcrumb-item active">All Users</li>
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
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%">No.</th>
                      <th width="15%">Fullname</th>
                      <th width="10%">Username</th>
                      <th width="20%">Email Address</th>
                      <th width="10%">Usertype</th>
                      <th width="15%">Genre</th>
                      <th width="25%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $counter = 0;
                    foreach($users as $row){ $counter++;?>
                      <tr>
                        <td><?= $counter?></td>
                        <td><?= $row->fullname?></td>
                        <td><?= $row->username?></td>
                        <td><?= $row->email?></td>
                        <td><?= $row->usertype?></td>
                        <td><?= $row->genre?></td>
                        <td class="text-center">
                          <button class="btn btn-primary reset_btn" data-toggle="modal" data-target="#modal-reset-account" data-id="<?= $row->id?>" data-fullname="<?= $row->fullname?>"><i class="fas fa-cog"></i> Reset Password</button>

                          <button class="btn btn-danger delete_btn" data-toggle="modal" data-target="#modal-delete-account" data-id="<?= $row->id?>" data-fullname="<?= $row->fullname?>"><i class="fas fa-trash"></i> Remove</button>
                        </td>
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

  <div class="modal fade" id="add-admin-modal">
    <div class="modal-dialog">
      <form action="<?= base_url('admin/add_admin_account/')?>" method="post" id="add_admin_submit">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fa-plus-square"></i> ADDING NEW ADMIN</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Fullname</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <input type="text" class="form-control" name="fullname" placeholder="Enter Fullname">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                  </div>
                  <input type="text" class="form-control" name="username" placeholder="Enter Username">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                  </div>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Email Address</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <input type="email" class="form-control" name="email" placeholder="Enter Email Address">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Account</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <div class="modal fade" id="modal-delete-account">
    <div class="modal-dialog">
      <form action="<?= base_url('admin/delete_account/')?>" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fas-exclamation-triangle"></i> SYSTEM WARNING</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5>Are you sure you want to delete this account (<span id="account_name"></span>)?</h5>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="account_id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Remove Account</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-reset-account">
    <div class="modal-dialog">
      <form action="<?= base_url('admin/reset_account/')?>" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fas-exclamation-triangle"></i> SYSTEM WARNING</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5>Are you sure you want to reset this account (<span id="account_reset_name"></span>)?</h5>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="reset_account_id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Reset Account</button>
          </div>
        </div>
      </form>
    </div>
  </div>