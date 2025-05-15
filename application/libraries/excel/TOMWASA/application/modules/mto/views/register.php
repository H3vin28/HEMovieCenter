<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CBAS</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/')?>custom-css.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition register-page">
<div class="registration_width">
  <div class="card card-outline card-primary"  style="margin-top: 4rem!important;margin-bottom: 4rem!important;">
    <div class="card-header text-center">
      <span class="h1">Registration Form</span>
    </div>
    <div class="card-body">
      <form action="<?php echo base_url('emp/insert_reg/')?>" method="post" id="reg_form" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            <center>
            <div class="form-group">
              <img class="image_design" src="<?php echo base_url('assets/pro_pic_images/pro_pic_icon.png')?>" id="img_preview">
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="pro_pic" accept="image/*" onchange="loadFile(event)">
                <label class="custom-file-label" style="text-align: left" for="customFile" id="label_choose_file">Choose file</label>
              </div>
            </div>
          </div>
          <div class="col-md-4">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Firstname" name="fname">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Lastname" name="lname">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Middle Name" name="mname">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <select class="form-control select2bs4" style="width: 80%;" name="suffix">
                <option selected="selected" value="" disabled>Suffix (Optional)</option>
                <option value="">None</option>
                <option>Sr.</option>
                <option>Jr.</option>
                <option>I</option>
                <option>II</option>
                <option>III</option>
                <option>IV</option>
                <option>V</option>
                <option>VI</option>
                <option>VII</option>
                <option>VIII</option>
                <option>VIII</option>
                <option>IX</option>
                <option>X</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <select class="form-control select2bs4" style="width: 80%;" name="gender">
                <option selected="selected" value="" disabled>Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-transgender"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="email" class="form-control" placeholder="Email Address" name="email_add">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="input-group mb-3">
              <select class="form-control select2bs4" style="width: 80%;" name="position">
                <option selected="selected" value="" disabled>Position</option>
                <option>Instructor</option>
                <option>Staff</option>
                <option>Part-Timer</option>
                <option>Job-Order</option>
                <option>Security Guard</option>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-users"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <select class="form-control select2bs4" style="width: 80%;"  name="designated_office">
                <option selected="selected" value="" disabled>Designated Office</option>
                <?php foreach ($all_dept_office as $value) {?>
                  <option value="<?php echo $value->id;?>"><?php echo $value->office_name;?></option>
                <?php } ?>
              </select>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-university"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username" name="username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user-secret"></span>
                </div>
              </div>
            </div>
            
            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text">
                  <a href="#" class="fas fa-exclamation-triangle" style="color: orange;" id="warning_but"></a>
                </div>
              </div>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" minlength="8" maxlength="15">
              <div class="input-group-append">
                <div class="input-group-text">
                  <a href="#" class="fas fa-eye" data-id="1" style="color: #495057;"  id="p_eye"></a>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-exclamation-triangle" style="color: red" id="not_re"></span>
                </div>
              </div>
              <input type="password" class="form-control" placeholder="Retype Password" id="re_password" name="re_password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <a href="#" class="fas fa-eye" style="color: #495057;" id="rp_eye"></a>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <button id="but_reg" class="btn btn-primary btn-block" disabled>Register</button>
              </div>
              <div class="col-6">
                <a href="<?php echo base_url()?>" class="btn btn-danger btn-block">Cancel</a>
              </div>
            </div>

            <div style="padding-top: 1rem; text-align: right;">
              <a href="<?php echo base_url()?>" class="text-center">I already have an account</a>
            </div>

          </div>
        </div>
      </form>
      
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->
<button type="button" id="hidden_btn_modal" class="btn btn-default" data-toggle="modal" data-target="#modal-default" data-backdrop="static" data-keyboard="false" hidden>
      Launch Default Modal
  </button>

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content" style="background-color: #e2f1f3;">
        <center>
          <div class="row">
            <div class="col-md-12">
              <img src="<?php echo base_url('assets/images/')?>v_loading.webp" style="width: 35%;">
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label>Please wait while the system saving your data.</label>
            </div>
          </div>
        </center>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/')?>dist/js/adminlte.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/toastr/toastr.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jquery-validation/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
  $('#but_reg').click(function(e) {
    e.preventDefault();
    var proceed = 0;
    var arr = [];
    $('span[class="text-danger"]').remove();
    $('span[class="text-success"]').remove();
    if($('input[name="fname"]').val() < 1){
      $('input[name="fname"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      $('input[name="fname"]').css("border","1px solid red");
      arr.push(0);
    } else {
      $('input[name="fname"]').css("border","");
      arr.push(1);
    }

    if($('input[name="lname"]').val() < 1){
      $('input[name="lname"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      $('input[name="lname"]').css("border","1px solid red");
      arr.push(0);
    } else {
      $('input[name="lname"]').css("border","");
      arr.push(1);
    }

    if($('select[name="gender"]').val() == null){
      $('select[name="gender"]').css("border","1px solid red");
      $('select[name="gender"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('select[name="gender"]').css("border","");
      arr.push(1);
    }

    if($('input[name="email_add"]').val() < 1){
      $('input[name="email_add"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      $('input[name="email_add"]').css("border","1px solid red");
      arr.push(0);
    } else if (IsEmail($('input[name="email_add"]').val()) === false){
      $('input[name="email_add"]').closest('.input-group').before('<span class="text-danger">Enter a valid email address.</span>');
      $('input[name="email_add"]').css("border","1px solid red");
      arr.push(0);
    } else {
      $('input[name="email_add"]').css("border","");
      arr.push(1);
    }

    if($('select[name="position"]').val() == null){
      $('select[name="position"]').css("border","1px solid red");
      $('select[name="position"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('select[name="position"]').css("border","");
      arr.push(1);
    }

    if($('select[name="designated_office"]').val() == null){
      $('select[name="designated_office"]').css("border","1px solid red");
      $('select[name="designated_office"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('select[name="designated_office"]').css("border","");
      arr.push(1);
    }

    if($('input[name="username"]').val() < 1){
      $('input[name="username"]').css("border","1px solid red");
      $('input[name="username"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('input[name="username"]').css("border","");
      arr.push(1);
    }

    if($('input[name="password"]').val() < 1){
      $('input[name="password"]').css("border","1px solid red");
      $('input[name="password"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('input[name="password"]').css("border","");
      arr.push(1);
    }

    var proceed = allTheSame(arr);

    if(proceed === true){
      $('#reg_form').submit();
      $('#hidden_btn_modal').click();
    }

  });

  function allTheSame(array) {
    return array.every(function(element){
      return element === array[0];
    });
  }

  function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if(!regex.test(email)) {
      return false;
    }else{
      return true;
    }
  }

  $('#warning_but').click(function(e) {
    e.preventDefault();
    toastr.error('Password must contain at least 8 characters, 1 Capital Letter, 1 Small Letter, 1 Special Character and 1 Number.')
  });

  $('#password').keyup(function(){
    $('span[class="text-danger"]').remove();
    $('span[class="text-success"]').remove();
    var password = $('#password').val();
    var re_password = $('#re_password').val();
    if(password.match(/[a-z]/) && password.match(/[0-9]/) && password.match(/[!@#$%^&*_]/) && password.match(/[A-Z]/) && password.length >= 8){
      $('input[name="password"]').css("border","");
      $('input[name="password"]').closest('.input-group').before('<span class="text-success">Password is good.</span>');
      if(password == re_password){
        $('input[name="re_password"]').css("border","");
        $('input[name="re_password"]').closest('.input-group').before('<span class="text-success">Password matched.</span>');
        $('#not_re').attr("style","color: green");
        $('#but_reg').removeAttr("disabled");
      } else {
        $('input[name="re_password"]').css("border","1px solid red");
        $('input[name="re_password"]').closest('.input-group').before('<span class="text-danger">Password not matched.</span>');
        $('#not_re').attr("style","color: red");
        $('#but_reg').attr("disabled","disabled");
      }
    } else {
      $('input[name="password"]').css("border","1px solid red");
      $('input[name="password"]').closest('.input-group').before('<span class="text-danger">Password must contain at least 8 characters, 1 Capital Letter, 1 Small Letter, 1 Special Character and 1 Number.</span>');
    }
    
  });

  $('#re_password').keyup(function(){
    $('span[class="text-danger"]').remove();
    $('span[class="text-success"]').remove();
    var password = $('#password').val();
    var re_password = $('#re_password').val();
    if(password == re_password){
      $('input[name="re_password"]').css("border","");
      $('input[name="re_password"]').closest('.input-group').before('<span class="text-success">Password matched.</span>');
      $('#not_re').attr("style","color: green");
      $('#but_reg').removeAttr("disabled");
    } else {
      $('input[name="re_password"]').css("border","1px solid red");
      $('input[name="re_password"]').closest('.input-group').before('<span class="text-danger">Password not matched.</span>');
      $('#not_re').attr("style","color: red");
      $('#but_reg').attr("disabled","disabled");
    }
    
  });

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

  $('#rp_eye').click(function(e) {
    e.preventDefault();
    var pe = $('#rp_eye').data('id');
    if(pe == 1){
      $('#re_password').attr("type","text");
      $('#rp_eye').data('id',0);
      $('#rp_eye').attr("class","fas fa-eye-slash");
    } else {
      $('#re_password').attr("type","password");
      $('#rp_eye').data('id',1);
      $('#rp_eye').attr("class","fas fa-eye");
    }
  });

  var loadFile = function(event) {
    var output = document.getElementById('img_preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src); // free memory
    }
    var filename = $('input[type=file]').val().split('\\').pop();
    $('#label_choose_file').text(filename);
  };
</script>
</body>
</html>
