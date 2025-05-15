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
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/adminlte/')?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <style type="text/css">
    .modal{
      text-align: center;
    }

    @media screen and (min-width:  768px){
      .modal:before{
        display: inline-block;
        vertical-align: middle;
        content: " ";
        height: 100%;
      }
    }

    .modal-dialog {
      display: inline-block;
      vertical-align: middle;
      al
    }
  </style>
</head>
<body class="hold-transition register-page">
<div class="registration_width">
  <div class="card card-outline card-primary"  style="margin-top: 4rem!important;margin-bottom: 4rem!important;">
    <div class="card-header text-center">
      <span class="h1">Registration Form for Student or Guest</span>
    </div>
    <div class="card-body">
      <form action="<?php echo base_url('sg/insert_reg/')?>" method="post" id="reg_form" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-4">
            <center>
              <div class="form-group">
                <img class="image_design" src="<?php echo base_url('assets/pro_pic_images/pro_pic_icon.png')?>" id="img_preview" style="cursor: pointer;">
                <div><label id="customFile2">(Image Name)</label></div>
              </div>
              <div class="form-group" hidden>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="customFile" name="pro_pic" accept="image/*" onchange="loadFile(event,'pro_pic')" required>
                  <label class="custom-file-label" style="text-align: left" for="customFile" id="label_choose_file">Choose file</label>
                </div>
              </div>
            </center>
          </div>
          <div class="col-md-4">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="ID Number (Note: This will be your USERNAME.)" name="username" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user-secret"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Firstname" name="fname" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>

            </div>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Lastname" name="lname" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Middle Name" name="mname" required>
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
                <option selected="selected" value="null" disabled>Gender</option>
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
              <input type="email" class="form-control" placeholder="Email Address" name="email_add" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>

            <span class="text-danger mobile_text" hidden>Mobile number must be numeric.</span>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Phone Number (Ex. 09...)" name="mnumber" value="09" maxlength="11" id="mnumber" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-mobile-alt"></span>
                </div>
              </div>
            </div>
            <label>Current Address</label>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <select class="form-control select2bs4 address" style="width: 80%;" name="region">
                    <option selected="selected" disabled value="">Region</option>
                    <?php
                    foreach ($regions as $value) {?>
                      <option value="<?php echo $value->regCode?>"><?php echo $value->regDesc?></option>
                    <?php } ?>
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <select class="form-control select2bs4 address" style="width: 80%;" name="province">
                    <option selected="selected" disabled value="">Province</option>
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <select class="form-control select2bs4 address" style="width: 80%;" name="municipal">
                    <option selected="selected" disabled value="">Municipal/City</option>
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map"></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="input-group mb-3">
                  <select class="form-control select2bs4 address" style="width: 80%;" name="barangay">
                    <option selected="selected" disabled value="">Barangay</option>
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-map"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            
            <div class="input-group mb-3">
              <div class="input-group-append">
                <div class="input-group-text">
                  <a href="#" class="fas fa-exclamation-triangle" style="color: orange;" id="warning_but"></a>
                </div>
              </div>
              <input type="password" class="form-control" placeholder="Password" name="password" id="password" minlength="8" maxlength="15" required>
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
              <input type="password" class="form-control" placeholder="Retype Password" id="re_password" name="re_password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <a href="#" class="fas fa-eye" style="color: #495057;" id="rp_eye"></a>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <center>
                <div class="form-group">
                  <img src="<?php echo base_url('assets/valid_id/valid_id_icon.png')?>" id="valid_id_preview" style="cursor: pointer;padding: 10px;border: 2px solid #746f6f;border-radius: 5px;" width="45%">
                  <div><label id="valid_id_text">(Image Name)</label></div>
                  <div><span><i>Note: Attach your student id or any valid id for validation purposes.</i></span></div>
                </div>
                <div class="form-group" hidden>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="valid_id_input" name="valid_id" accept="image/*" onchange="loadFile(event,'valid_id')" required>
                  </div>
                </div>
              </center>
            </div>
              
            <div class="row">
              <div class="col-12">
                <button type="submit" id="but_reg" class="btn btn-success btn-block" disabled>Register</button>
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
<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/select2/js/select2.full.min.js"></script>
<script>
  $('#img_preview').click(function(e) {
    $('#customFile').click();
  })

  $('#valid_id_preview').click(function(e) {
    $('#valid_id_input').click();
  })
  var arr = [];

  $('#but_reg').click(function(e) {
    e.preventDefault();
    var proceed = 0;
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

    if($('select[name="region"]').val() == null){
      $('select[name="region"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('select[name="region"]').css("border","");
      arr.push(1);
    }

    if($('select[name="province"]').val() == null){
      $('select[name="province"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('select[name="province"]').css("border","");
      arr.push(1);
    }

    if($('select[name="municipal"]').val() == null){
      $('select[name="municipal"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('select[name="municipal"]').css("border","");
      arr.push(1);
    }

    if($('select[name="barangay"]').val() == null){
      $('select[name="barangay"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('select[name="barangay"]').css("border","");
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

    if($('input[name="username"]').val() < 1){
      $('input[name="username"]').css("border","1px solid red");
      $('input[name="username"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('input[name="username"]').css("border","");
      arr.push(1);
    }

    if($('input[name="mnumber"]').val() < 1){
      $('input[name="mnumber"]').css("border","1px solid red");
      $('input[name="mnumber"]').closest('.input-group').before('<span class="text-danger">This field is required.</span>');
      arr.push(0);
    } else {
      $('input[name="mnumber"]').css("border","");
      arr.push(1);
    }

    var m_num = $('input[name="mnumber"]').val();
    if(m_num.match(/[a-z]/)|| m_num.match(/[!@#$%^&*_]/) || m_num.match(/[A-Z]/)){
      $('input[name="mnumber"]').css("border","1px solid red");
      $('.mobile_text').removeAttr("hidden");
      arr.push(0);
    } else {
      $('.mobile_text').attr("hidden","hidden");
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

    if($('input[name="valid_id"]').val() < 1){
      $('img[id="valid_id_preview"]').css("border","2px solid red");
      $('input[name="valid_id"]').closest('.form-group').before('<center><span class="text-danger">Valid id is required.</span></center>');
      arr.push(0);
    } else {
      $('img[id="valid_id_preview"]').css("border","2px solid #746f6f");
      arr.push(1);
    }

    var proceed = allTheSame(arr);

    if(proceed === true){
      $('#reg_form').submit();
      $('#hidden_btn_modal').click();
    }

  });
  
  $('#mnumber').on('keyup', function(){
    var m_num = $(this).val();
    if(m_num.match(/[a-z]/)|| m_num.match(/[!@#$%^&*_]/) || m_num.match(/[A-Z]/)){
      $('input[name="mnumber"]').css("border","1px solid red");
      $('.mobile_text').removeAttr("hidden");
    } else {
      $('.mobile_text').attr("hidden","hidden");
    }
  })

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

  $('#re_password').keyup(function(){
    var password = $('#password').val();
    var re_password = $('#re_password').val();
    if(password == re_password){
      $('#not_re').attr("style","color: green");
    } else {
      $('#not_re').attr("style","color: red");
    }
    
  });

  $('#password').keyup(function(){
    var password = $('#password').val();
    if(password.match(/[a-z]/) && password.match(/[0-9]/) && password.match(/[!@#$%^&*_]/) && password.match(/[A-Z]/) && password.length >= 8){
      
    } else {
      
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

  var loadFile = function(event,image) {
    console.log(image);
    if(image == 'valid_id'){
      var output = document.getElementById('valid_id_preview');
    }else{
      var output = document.getElementById('img_preview');
    }
    
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src); // free memory
    }
    var filename = $('input[type=file]').val().split('\\').pop();
    $('#label_choose_file').text(filename);
    if(image == 'valid_id'){
      $('#valid_id_text').text(filename);
    } else {
      $('#customFile2').text(filename);
    }
  };
</script>
<script>
  $(document).ready(function(){
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })

  $('.address').change(function(){
    var condition = $(this).attr('name');
    var code = $(this).val();
    $.ajax({    
      type: "post",
      url: "<?php echo base_url('sg/getaddressAjax/');?>",             
      data: {
        code:code,
        condition:condition
      },                  
      success: function(result){
        var data = JSON.parse(result);
        console.log(data.condition);
        var arrayData = data.result;
        if(data.condition == 'region'){
          $('select[name="province"]').find('option').remove();
          $('select[name="province"]').append('<option disabled selected="selected"  value="">Province</option>');
          $('select[name="municipal"]').find('option').remove();
          $('select[name="municipal"]').append('<option disabled selected="selected"  value="">Municipal/City</option>');
          $('select[name="barangay"]').find('option').remove();
          $('select[name="barangay"]').append('<option disabled selected="selected"  value="">Barangay</option>');
          for(let i = 0; i < arrayData.length; i++){
            $('select[name="province"]').append('<option value="'+arrayData[i].provCode+'">'+arrayData[i].provDesc+'</option>');
          }
        } else if(data.condition == 'municipal'){
          $('select[name="barangay"]').find('option').remove();
          $('select[name="barangay"]').append('<option disabled selected="selected"  value="">Barangay</option>');
          for(let i = 0; i < arrayData.length; i++){
            $('select[name="barangay"]').append('<option value="'+arrayData[i].brgyCode+'">'+arrayData[i].brgyDesc+'</option>');
          }
        } else if(data.condition == 'province'){
          $('select[name="municipal"]').find('option').remove();
          $('select[name="municipal"]').append('<option disabled selected="selected"  value="">Municipal/City</option>');
          $('select[name="barangay"]').find('option').remove();
          $('select[name="barangay"]').append('<option disabled selected="selected"  value="">Barangay</option>');
          for(let i = 0; i < arrayData.length; i++){
            $('select[name="municipal"]').append('<option value="'+arrayData[i].citymunCode+'">'+arrayData[i].citymunDesc+'</option>');
          }
        }
       
      }
    });
  })
</script>
</body>
</html>
