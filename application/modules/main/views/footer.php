  <footer class="main-footer navbar-light">
    <strong>Copyright &copy; 2025 HE Movie Center.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url('assets/adminlte/')?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/adminlte/')?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url('assets/adminlte/')?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?= base_url('assets/adminlte/')?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url('assets/adminlte/')?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url('assets/adminlte/')?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url('assets/adminlte/')?>plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url('assets/adminlte/')?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url('assets/adminlte/')?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/adminlte/')?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/adminlte/')?>dist/js/adminlte.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/adminlte/')?>plugins/select2/js/select2.full.min.js"></script>
<!-- jquery-validation -->
<script src="<?= base_url('assets/adminlte/')?>plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/jquery-validation/additional-methods.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url('assets/adminlte/')?>plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script>

  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    $("#search_movie").autocomplete({
      source: function(request, response) {
        $.ajax({
          url: "<?= base_url('main/getAllTitle/')?>",
          type: "GET",
          data: { term: request.term },
          success: function(data) {
            response(JSON.parse(data));
          }
        });
      },
      select: function(event, ui) {
        $("#search_movie").val(ui.item.value); // set selected value
        $("#searchForm").submit();       // submit the form
      },
      minLength: 2,
    });

    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    var message = '<?= @$this->session->flashdata('message')?>';
    var icon = '<?= @$this->session->flashdata('icon')?>';
    if(message != ''){
      Toast.fire({
        icon: icon,
        title: '<div class="flex-center">'+message+'</div>'
      });
    }

    $.validator.setDefaults({
      submitHandler: function () {
        $('#form_submit').submit();
      }
    });
    
    $('#form_submit').validate({
      rules: {
        email: {
          required: true
        },
        password: {
          required: true,
          minlength: 6
        }
      },
      messages: {
        email: {
          required: "Please enter your email address or username"
        },
        password: {
          required: "Please enter your password",
          minlength: "Your password must be at least 6 characters long"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.input-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });

    $.validator.setDefaults({
      submitHandler: function () {
        $('#signup_form_submit').submit();
      }
    });

    $.validator.addMethod("strongPassword", function (value, element) {
      return this.optional(element) || 
             /[A-Z]/.test(value) &&    // has uppercase
             /[a-z]/.test(value) &&    // has lowercase
             /[0-9]/.test(value) &&    // has number
             value.length >= 6;        // at least 6 characters
    }, "Password must be at least 6 characters and include an uppercase letter, lowercase letter, and a number.");

    $('#signup_form_submit').validate({
      rules: {
        email: {
          required: true,
          email: true
        },
        fullname: {
          required: true
        },
        'genre[]': {
          required: true
        },
        username: {
          required: true,
          minlength: 5
        },
        password_signup: {
          required: true,
          strongPassword: true
        },
        confirm_password: {
          required: true,
          equalTo: "#password_signup"
        }
      },
      messages: {
        email: {
          required: "Please enter your email address or username"
        },
        password: {
          required: "Please enter your password"
        },
        fullname: {
          required: "Please enter your fullname"
        },
        'genre[]': {
          required: "Please select at least 1 genre"
        },
        username: {
          required: "Please enter your username",
          minlength: "Username must be 5 characters"
        },
        confirm_password: {
          equalTo: "Password do not match"
        }
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.input-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  })

  $('.clear_btn').on('click', function(){
    $('#signup_form_submit')[0].reset();
    $('select[name="genre[]"]').val(null).trigger('change');
  })

  <?php if(@$this->uri->segment(2) == "movies"){?>
  $('select').on('change', function(){
    $('#form_sort').submit();
  })

  $('#myBTBtn').on('click', function(e){
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, 'slow');
  })

  let mybutton = document.getElementById("myBTBtn");

  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  <?php }?>

  $('#p_eye1').click(function(e) {
    e.preventDefault();
    var pe = $('#p_eye1').data('id');
    if(pe == 1){
      $('input[name="password"]').attr("type","text");
      $('#p_eye1').data('id',0);
      $('#p_eye1').attr("class","fas fa-eye-slash");
    } else {
      $('input[name="password"]').attr("type","password");
      $('#p_eye1').data('id',1);
      $('#p_eye1').attr("class","fas fa-eye");
    }
  });

  $('#p_eye').click(function(e) {
    e.preventDefault();
    var pe = $('#p_eye').data('id');
    if(pe == 1){
      $('input[name="password"]').attr("type","text");
      $('#password_signup').attr("type","text");
      $('#p_eye').data('id',0);
      $('#p_eye').attr("class","fas fa-eye-slash");
    } else {
      $('input[name="password"]').attr("type","password");
      $('#password_signup').attr("type","password");
      $('#p_eye').data('id',1);
      $('#p_eye').attr("class","fas fa-eye");
    }
  });

  $('#re_p_eye').click(function(e) {
    e.preventDefault();
    var pe = $('#re_p_eye').data('id');
    if(pe == 1){
      $('input[name="confirm_password"]').attr("type","text");
      $('#re_p_eye').data('id',0);
      $('#re_p_eye').attr("class","fas fa-eye-slash");
    } else {
      $('input[name="confirm_password"]').attr("type","password");
      $('#re_p_eye').data('id',1);
      $('#re_p_eye').attr("class","fas fa-eye");
    }
  });
</script>
</body>
</html>