  <!-- Main Footer -->
  <!-- ./wrapper -->
  <footer class="main-footer">
    <strong>TOMWASA Billing System 2022.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
      <?php @$message = $this->input->get('m');?>
      <input type="hidden" id="hidden_text" value="<?php echo base64_decode(@$message);?>">
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/')?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/adminlte/')?>dist/js/demo.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/toastr/toastr.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url('assets/adminlte/')?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/select2/js/select2.full.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      bsCustomFileInput.init();
    });
  </script>
  <script>
    function checkCurrent(e){
      var current_value = parseInt(e.value);
      var last_value = parseInt(document.getElementById('last_reading'+e.getAttribute('id')).value);
      if(e.value.length == 0){
        e.removeAttribute('required');
        e.removeAttribute('style');
      } else {
        e.setAttribute('required','required');
      }
      if(current_value >= last_value){
        e.style.borderColor = "green";
      } else {
        e.style.borderColor = "red";
      }
    }

    window.addEventListener('load', (event) => {
      var message = document.getElementById('hidden_text').value;
      var text = message.split("~")[1];
      var des = message.split("~")[0];
      if(message != ''){
        if(des == 'success'){
          toastr.success(text);
        } else if(des == 'errorrr'){
          toastr.error(text);
        }
      }
    });

    $(document).ready(function () {

      $('#consumersTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#JanTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#FebTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#MarTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#AprTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#MayTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#JunTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#JulTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#AugTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#SepTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#OctTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#NovTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#DecTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      $('#individual_ledger').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      $('select[name="barangay"]').on('change',function(){
        $('#barangay_form').submit();
      });

      $('#not_minimum').on('click',function(){
        var minimum = $(this).is(":checked");
        if(minimum == true){
          $('#not_minimum_label').html('Minimum');
          $('#not_minimum').val(1);
        } else {
          $('#not_minimum_label').html('Not Minimum');
          $('#not_minimum').val(0);
        }
      });

      $('select[name="month"]').on('change',function(){
        var id = $(this).val();
        $.ajax({
          url: '<?php echo base_url('eo/AjaxGetDataConsumersList/')?>',
          data: 'month='+ id,
          type: 'post',
          async: false,
          error: function() {
            alert('Something is wrong!');
          },
          success: function(data) {
            // console.log(JSON.parse(data));
            $('#consumersListDiv div[class="row"]').remove();
            $('#array_id').html('');
            $('#consumersListDiv').append().html(JSON.parse(data).list);
            $('#array_id').append().html(JSON.parse(data).array_id.toString());
            $('#last').append().html(JSON.parse(data).last.toString());
            // console.log(JSON.parse(data).array_id.toString());
          }
        });
      });

      // $('.meterReading').on('click',function(){
      //   console.log($(this).attr("data-id"));
      //   // $('#modal-add-meterReading'+id).show();
      // });
    });
  </script>
<?php if($this->uri->segment(2) == 'home'){?>
  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/adminlte/')?>plugins/chart.js/Chart.min.js"></script>
  <script>
    $(document).ready(function () {
      var color = ['rgba(249,42,9,1)','rgba(14,225,62,1)','rgba(6,3,223,1)'];
      var chartDatas;
      $.ajax({
        url: '<?php echo base_url('eo/AjaxGetData/')?>',
        async: false,
        error: function() {
          alert('Something is wrong!');
        },
        success: function(data) {
          chartDatas = JSON.parse(data);
        }
      });
      var areaChartData = {
        labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [
          {
            label               : '2022',
            backgroundColor     : color[0],
            borderColor         : color[0],
            pointStrokeColor    : color[0],
            pointHighlightStroke: color[0],
            pointRadius          : false,
            pointColor          : '#3b8bba',
            pointHighlightFill  : '#fff',
            data                : chartDatas
          },
          
        ]
      }

      var areaChartOptions = {
        maintainAspectRatio : true,
        responsive : true,
        legend: {
          display: true
        },
        scales: {
          xAxes: [{
            gridLines : {
              display : true,
            }
          }],
          yAxes: [{
            gridLines : {
              display : false,
            }
          }]
        }
      }
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      barChartData.datasets[0] = temp0

      var barChartOptions = {
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : false
      }

      new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      })
    })
  </script>
<?php }?>
</body>
</html>