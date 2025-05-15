<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CBAS</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/');?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/');?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/');?>dist/css/adminlte.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/')?>custom-css.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <span class="h1"><b>Login Form</b></span>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="<?php echo base_url();?>sg/login/" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Username" name="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-secret"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password" id="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <a href="#" class="fas fa-eye" data-id="1" style="color: #495057;"  id="p_eye"></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-0">
        <a href="<?php echo base_url('sg/register/')?>" class="text-center">Register as student or guest</a>
      </p>
      <?php @$message = $this->input->get('m');?>
      <input type="hidden" id="hidden_text" value="<?php echo base64_decode(@$message);
        ?>">
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/adminlte/');?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminlte/');?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/');?>dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/toastr/toastr.min.js"></script>
<script>
  var message = document.getElementById('hidden_text').value;
  if(message != ''){
    if(message == 'success'){
      toastr.success('Registered Successfully. Please wait for the admin to approve your account.');
    } else if(message == 'success_no_image'){
      toastr.success("Registered Successfully. Please wait for the admin to approve your account. You didn't select an image so your profile will be default image.");
    } else if(message == 'success_sg'){
      toastr.success("Registered Successfully.");
    } else if(message == 'success_no_image_sg'){
      toastr.success("Registered Successfully. You didn't select an image so your profile will be default image.");
    } else if(message == 'login_error'){
      toastr.error("Username or password is incorrect. Please try again.");
    } else if(message == 'account_deactivated'){
      toastr.error("Your account is not confirmed. Please wait or ask your department head to approve your account.");
    } else if(message == 'account_deleted'){
      toastr.error("Your account has been deleted. Please ask your department head to approve your account.");
    } else if(message == 'account_declined'){
      toastr.error("Your account has been declined. Please ask your department head to approve your account.");
    } else if(message == 'not_login'){
      toastr.error("Login first to continue.");
    } else if(message == 'login_superadmin'){
      toastr.error("Your account is superadmin. Login to superadmin login page.");
    } else {
      toastr.error(message);
    }
  }

  $('#p_eye').click(function(e) {
    e.preventDefault();
    var pe = $('#p_eye').data('id');
    if(pe == 1){
      $('#password').attr("type","text");
      $('#p_eye').data('id',0);
      $('#p_eye').attr("class","fas fa-eye-slash");
    } else {
      $('#password').attr("type","password");
      $('#p_eye').data('id',1);
      $('#p_eye').attr("class","fas fa-eye");
    }
  });
</script>
</body>
</html>
