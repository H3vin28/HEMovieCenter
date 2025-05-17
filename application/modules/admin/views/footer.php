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
<script src="<?= base_url('assets/adminlte/')?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url('assets/adminlte/')?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2();

    bsCustomFileInput.init();

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example1_filter").addClass('float-right');
    $("#example1_paginate").addClass('float-right');

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
        $('#add_movie').submit();
      }
    });

    $.validator.addMethod("noLetters", function(value, element) {
      return this.optional(element) || !/[a-zA-Z]/.test(value);
    }, "Letters are not allowed.");

    $('#add_movie').validate({
      rules: {
        file_name: {
          required: true
        },
        title: {
          required: true
        },
        description: {
          required: true
        },
        year_released: {
          required: true,
          noLetters: true
        },
        'genre[]': {
          required: true
        }
      },
      messages: {
        file_name: {
          required: "Please add a cover image."
        },
        title: {
          required: "Please enter a movie title"
        },
        description: {
          required: "Please enter a movie description"
        },
        year_released: {
          required: "Please enter a year when movie released"
        },
        'genre[]': {
          required: "Please select at least 1 genre"
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
        $('#add_admin_submit').submit();
      }
    });

    $('#add_admin_submit').validate({
      rules: {
        fullname: {
          required: true
        },
        username: {
          required: true
        },
        email: {
          required: true
        }
      },
      messages: {
        fullname: {
          required: "Fullname is required."
        },
        username: {
          required: "Username is required."
        },
        email: {
          required: "Email address is required."
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



    $('.delete_btn').on("click", function(){
      var id = $(this).data('id');
      var movie = $(this).data('movie');

      $('#movie_name').text(movie);
      $('input[name="movie_id"]').val(id);
      console.log(id);
    });

    $.validator.setDefaults({
      submitHandler: function () {
        $('#update_movie').submit();
      }
    });

    $.validator.addMethod("noLetters1", function(value, element) {
      return this.optional(element) || !/[a-zA-Z]/.test(value);
    }, "Letters are not allowed.");

    $('#update_movie').validate({
      rules: {
        up_file_name: {
          required: true
        },
        up_title: {
          required: true
        },
        up_description: {
          required: true
        },
        up_year_released: {
          required: true,
          noLetters1: true
        },
        'up_genre[]': {
          required: true
        }
      },
      messages: {
        up_file_name: {
          required: "Please add a cover image."
        },
        up_title: {
          required: "Please enter a movie title"
        },
        up_description: {
          required: "Please enter a movie description"
        },
        up_year_released: {
          required: "Please enter a year when movie released"
        },
        'up_genre[]': {
          required: "Please select at least 1 genre"
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

    $('.update_btn').on("click", function(){
      var id = $(this).data('id');
      var title = $(this).data('title');
      var description = $(this).data('description');
      var year_released = $(this).data('year_released');
      var genre = $(this).data('genre');
      var genreArray = genre.split(',').map(function(item) {
        return item.trim();
      });
      console.log(id);
      $('input[name="up_title"]').val(title);
      $('textarea[name="up_description"]').html(description);
      $('input[name="up_year_released"]').val(year_released);
      $('#genre_select').val(genreArray).trigger('change');
      $('input[name="movie_id"]').val(id);
      $('#modal-update-movie').modal();
    });

    $('.delete_btn').on("click", function(){
      var id = $(this).data('id');
      var name = $(this).data('fullname');

      $('#account_name').text(name);
      $('input[name="account_id"]').val(id);
    });

    $('.reset_btn').on("click", function(){
      var id = $(this).data('id');
      var name = $(this).data('fullname');

      $('#account_reset_name').text(name);
      $('input[name="reset_account_id"]').val(id);
    });

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'Action',
          'Adventure',
          'Animation',
          'Biography',
          'Comedy',
          'Crime',
          'Documentary',
          'Drama',
          'Family',
          'Fantasy',
          'History',
          'Horror',
          'Music',
          'Musical',
          'Mystery',
          'Romance',
          'Sci-Fi',
          'Sport',
          'Thriller',
          'War',
          'Western',
      ],
      datasets: [
        {
          data: [14,10,7,1,11,12,2,7,4,9,2,6,2,3,5,5,13,3,8,4,7],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de', '#f2d6de', '#02d6de','red', 'blue', 'orange', 'yellow', 'violet', 'green','olive','indigo','pink','magenta','brown','black','#20f440'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })
  });
</script>
</body>
</html>