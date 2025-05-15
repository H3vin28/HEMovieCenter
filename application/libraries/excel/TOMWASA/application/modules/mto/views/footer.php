
  <!-- Main Footer -->
  <footer class="main-footer">
    <span id="hidden_message" hidden><?php echo @base64_decode($this->input->get('m'))?></span>
    <strong>CBAS 2022.</strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/adminlte/')?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/adminlte/')?>dist/js/demo.js"></script>
<!-- jQuery -->
<script src="<?php echo base_url('assets/qrscannerJS/')?>instascan.min.js"></script>
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
<script>
  <?php 
  if($this->uri->segment(2) == ''){
  ?>
  var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
    scanner.addListener('scan',function(content){
      var hidden_time_inout = $("#hidden_time_inout").val();
      var date = $("#date").text();
      var time = $("#time").text();
      if(hidden_time_inout == 'visit_office'){
        var purpose = $("#Purpose").val();
        if(!$.trim(purpose)){
          toastr.error("Purpose is required. Enter your purpose in visiting this office.");
          $("textarea").css('border','1px solid red');
          $("#required").css('color','red');
        } else {
          $.ajax({  
            type: "post",
            url: "<?php echo base_url('emp/ScanQR/');?>",             
            data: {
              hidden_time_inout:hidden_time_inout,
              text:text,
              purpose:purpose,
              date:date,
              time:time
            },                  
            success: function(data){
              var result = JSON.parse(data);
              if(result === true){
                toastr.success("You may now enter the "+atob(text).split('~')[1]+"'s Office.");
              } else {
                toastr.error("There's an error. Please ask the MIS about this error.");
              }
            }
          });
        }
      } else if(hidden_time_inout == 'time_in_out') {
        $.ajax({    
          type: "post",
          url: "<?php echo base_url('emp/ScanQR/');?>",             
          data: {
            hidden_time_inout:hidden_time_inout,
            text:content,
            purpose:purpose,
            date:date,
            time:time
          },                  
          success: function(data){
            var result = JSON.parse(data);
            if(result.no_error == 'yes'){
              toastr.success(result.message);
            } else {
              toastr.error(result.message);
            }
          }
        });
      }
    });
    
    Instascan.Camera.getCameras().then(function (cameras){
        if(cameras.length>0){
            scanner.start(cameras[0]);
            $('[name="options"]').on('change',function(){
                if($(this).val()==1){
                    if(cameras[1]!=""){
                        scanner.start(cameras[1]);
                        $('#back').addClass(' btn-primary');
                        $('#back').removeClass(' btn-secondary');
                        $('#front').addClass(' btn-secondary');
                        $('#front').removeClass(' btn-primary');
                    }else{
                        alert('No Front camera found!');
                    }
                }else if($(this).val()==2){
                    if(cameras[0]!=""){
                        scanner.start(cameras[0]);
                        $('#front').addClass(' btn-primary');
                        $('#front').removeClass(' btn-secondary');
                        $('#back').addClass(' btn-secondary');
                        $('#back').removeClass(' btn-primary');
                    }else{
                        alert('No Back camera found!');
                    }
                }
            });
        }else{
            console.error('No cameras found.');
            alert('No cameras found.');
        }
    }).catch(function(e){
        console.error(e);
        alert(e);
    });


  <?php }?>

  $(document).ready(function () {
    $('#classroom').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

    function display_ct7() {
      var x = new Date()
      var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
      hours = x.getHours( ) % 12;
      hours = hours ? hours : 12;
      hours=hours.toString().length==1? 0+hours.toString() : hours;

      var minutes=x.getMinutes().toString()
      minutes=minutes.length==1 ? 0+minutes : minutes;

      var seconds=x.getSeconds().toString()
      seconds=seconds.length==1 ? 0+seconds : seconds;

      var month=(x.getMonth() +1).toString();
      month=month.length==1 ? 0+month : month;

      var dt=x.getDate().toString();
      dt=dt.length==1 ? 0+dt : dt;

      // var x1=x.toLocaleString('default', { month: 'long' }) + " " + dt + ", " + x.getFullYear(); 
      // x1 = x1 + "  " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;

      var date= x.toLocaleString('default', { month: 'long' }) + " " + dt + ", " + x.getFullYear(); 
      var time = hours + ":" +  minutes + ":" +  seconds + " " + ampm;
      document.getElementById('date').innerHTML = date;
      document.getElementById('time').innerHTML = time;
      display_c7();
    }

    function display_c7(){
      var refresh=1000; // Refresh rate in milli seconds
      mytime=setTimeout('display_ct7()',refresh);
    }
    display_c7()

    $('[name="buttons"]').on('click',function(){
      console.log($(this).val());
      if($(this).val() == 1){
        $('#hidden_time_inout').val('time_in_out');
        $('#div_purpose').attr('hidden','hidden');
        
        $('#btn_time_inout').removeClass('btn-secondary');
        $('#btn_time_inout').addClass('btn-primary');

        $('#btn_office').removeClass('btn-primary');
        $('#btn_office').addClass('btn-secondary');
        
        $('#btn_classroom').removeClass('btn-primary');
        $('#btn_classroom').addClass('btn-secondary');

        $('#btn_student').addClass('btn-secondary');
        $('#btn_student').removeClass('btn-primary');

      } else if($(this).val() == 2){
        $('#hidden_time_inout').val('visit_office');
        $('#div_purpose').removeAttr('hidden');

        $('#btn_time_inout').removeClass('btn-primary');
        $('#btn_time_inout').addClass('btn-secondary');

        $('#btn_office').removeClass('btn-secondary');
        $('#btn_office').addClass('btn-primary');
        
        $('#btn_classroom').removeClass('btn-primary');
        $('#btn_classroom').addClass('btn-secondary');

        $('#btn_student').addClass('btn-secondary');
        $('#btn_student').removeClass('btn-primary');

      } else if($(this).val() == 3){
        $('#hidden_time_inout').val('enter_classroom');
        $('#div_purpose').attr('hidden','hidden');
        
        $('#btn_time_inout').removeClass('btn-primary');
        $('#btn_time_inout').addClass('btn-secondary');

        $('#btn_office').removeClass('btn-primary');
        $('#btn_office').addClass('btn-secondary');
        
        $('#btn_classroom').removeClass('btn-secondary');
        $('#btn_classroom').addClass('btn-primary');

        $('#btn_student').addClass('btn-secondary');
        $('#btn_student').removeClass('btn-primary');

      } else if($(this).val() == 4){
        $('#hidden_time_inout').val('enter_students');
        $('#div_purpose').attr('hidden','hidden');
        
        $('#btn_time_inout').removeClass('btn-primary');
        $('#btn_time_inout').addClass('btn-secondary');

        $('#btn_office').removeClass('btn-primary');
        $('#btn_office').addClass('btn-secondary');
        
        $('#btn_classroom').addClass('btn-secondary');
        $('#btn_classroom').removeClass('btn-primary');

        $('#btn_student').removeClass('btn-secondary');
        $('#btn_student').addClass('btn-primary');
      }
    });

    $('#do_add_form').on('click', function(){
      var div_form = $('#form').html();
      var button = '<div class="text-right"><button type="button" class="btn btn-danger do_remove_form"><span class="fas fa-minus"></span></button></div>';
      var append = button;
      append+= div_form;
       $('#append_form').append('<div class="added_form">'+append+'</div>');
    });

    function printDiv(qr) {
      var p_area = document.getElementById('printableArea');
      p_area.removeAttribute("hidden");
      var image = document.getElementById('qr_image');
      image.setAttribute("src", qr.split("`")[0]+ ".png")
      var off = qr.split("`")[1];
      document.getElementById('name_office').innerHTML = "QR Code for " + off.split("~")[1];
      var printContents = document.getElementById('printableArea').innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }

    window.addEventListener('afterprint', (event) => {
      window.location.replace("");
    });

    $("#print_all").on('click',function(){
      var p_area = document.getElementById('printableArea_all');
      var printContents = '<div class="row">' + document.getElementById('printableArea_all').innerHTML +'</div>';
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      console.log(printContents);
      window.print();
      document.body.innerHTML = originalContents;
    });

    $(".changeDtr").change(function(){
      var month = $("select[name='month']").val();
      var year = $("select[name='year']").val();
      $.ajax({    
          type: "post",
          url: "<?php echo base_url('emp/dtr_ajax/');?>",             
          data: {
            month:month,
            year:year
          },                  
          success: function(data){
            var html = $("#dtr_month");
            $("#dtr_month tr").remove();
            html.append($.parseHTML(data));
          }
        });
    });
</script>
<script>
  $(document).ready(function(){
    var text = $('#hidden_message').text();
    var message = text.split('~')[1];
    var design = text.split('~')[0];

    if(text != ''){
      if(design == 'success'){
        toastr.success(message);
      } else if(design == 'errorrr'){
        toastr.error(message);
      } 
    }
  })
</script>
<script>
  $(document).ready(function () {
    $("#employees_table").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["colvis"]
    }).buttons().container().appendTo('#employees_table_wrapper .col-md-6:eq(0)');

    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });
</script>
<script>
  function update(data){
    var account_id = data.split("~")[0];
    var action_number = data.split("~")[1];
    var text = '';
    if(action_number == 0){
      text = 'Are you sure you want to DEACTIVATE this account?';
    } else if(action_number == 1){
      text = 'Are you sure you want to ACTIVATE this account?';
    } else if(action_number == 2){
      text = 'Are you sure you want to DECLINE this account?';
    } else if(action_number == 3){
      text = 'Are you sure you want to DELETE PERMANENTLY this account?';
    }
    $.ajax({  
      type: "post",
      url: "<?php echo base_url('emp/getEmpById/');?>",             
      data: {
        account_id:account_id
      },                  
      success: function(data){
        var row = JSON.parse(data);
        var mname = row.middle_name
        var name = row.firstname+' '+mname.split('')[0]+'. '+row.lastname;
        console.log(name);
        $('#account_id').val(row.account_id);
        $('#action_number').val(action_number);
        $('#account_name').text('Account name: '+name);
        $('#modal_text').text(text);
        $('#hidden_btn_modal').click();
      }
    });
  }
  // $(document).ready(function () {
  //   $('[class="but_action"]').on('click', function(){
  //     var data = $(this).data("value");
  //     console.log(data);
  //     var account_id = data.split("~")[0];
  //     var action_number = data.split("~")[1];
  //     var text = '';
  //     if(action_number == 0){
  //       text = 'Are you sure you want to DEACTIVATE this account?';
  //     } else if(action_number == 1){
  //       text = 'Are you sure you want to ACTIVATE this account?';
  //     } else if(action_number == 2){
  //       text = 'Are you sure you want to DECLINE this account?';
  //     } else if(action_number == 3){
  //       text = 'Are you sure you want to DELETE PERMANENTLY this account?';
  //     }
  //     $.ajax({  
  //       type: "post",
  //       url: "<?php echo base_url('emp/getEmpById/');?>",             
  //       data: {
  //         account_id:account_id
  //       },                  
  //       success: function(data){
  //         var row = JSON.parse(data);
  //         var mname = row.middle_name
  //         var name = row.firstname+' '+mname.split('')[0]+'. '+row.lastname;
  //         console.log(name);
  //         $('#account_id').val(row.account_id);
  //         $('#action_number').val(action_number);
  //         $('#account_name').text('Account name: '+name);
  //         $('#modal_text').text(text);
  //         $('#hidden_btn_modal').click();
  //       }
  //     });
  //   });
  // });
</script>
</body>
</html>