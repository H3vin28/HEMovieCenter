<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: linear-gradient(to right, #051343, #1c37c5);">
    <!-- Content Header (Page header) -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            &nbsp;
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <div class="card">
              <div class="card-header">
                <h2 class="m-0">Signup Form</h2>
              </div>
              <form id="signup_form_submit" autocomplete="off" method="post" action="<?= base_url('main/signup_process/')?>">
                <div class="card-body">
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

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Genre</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <select class="select2" name="genre[]" multiple="multiple" data-placeholder="Select a genre" style="width: 89%;">
                          <?php foreach($genres as $genre){?>
                            <option><?= $genre->name?></option>
                          <?php }?>
                        </select>
                        <div class="input-group-append">
                          <span class="input-group-text"><i class="fas fa-film"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Password</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="password" id="password_signup" class="form-control" name="password_signup" placeholder="Enter Password">
                        <div class="input-group-append">
                          <button type="button" class="input-group-text"><i class="fas fa-eye" data-id="1" id="p_eye"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Retype Password</label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <input type="password" class="form-control" name="confirm_password" placeholder="Retype Password">
                        <div class="input-group-append">
                          <button type="button" class="input-group-text"><i class="fas fa-eye" data-id="1" id="re_p_eye"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer justify-content-between">
                  <button type="button" class="btn btn-default clear_btn">Clear</button>
                  <button type="submit" class="btn btn-primary float-right">Signup</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>