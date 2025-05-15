<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ALL USERS</h1>
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