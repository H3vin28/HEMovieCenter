  <!-- Main Footer -->
  <footer class="main-footer">
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
<!-- Toastr -->
<script src="<?php echo base_url('assets/adminlte/')?>plugins/toastr/toastr.min.js"></script>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?php echo base_url('assets/qrscannerJS/')?>instascan.min.js"></script>
<script>
	var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
    scanner.addListener('scan',function(content){
      var hidden_time_inout = $("#hidden_time_inout").val();
      var date = $("#date").text();
      var time = $("#time").text();
      if(hidden_time_inout == 'visit_office'){
        alert(atob(content.replace(' ','+')));
        var type = atob(content.replace(' ','+')).split('~')[3];
        // alert(typeof(type));exit();
        if(type == '2'){
          var purpose = $("#Purpose").val();
          if(!$.trim(purpose)){
            toastr.error("Purpose is required. Enter your purpose in visiting this office.");
            $("textarea").css('border','1px solid red');
            $("#required").css('color','red');
          } else {
            $.ajax({  
              type: "post",
              url: "<?php echo base_url('sg/ScanQR/');?>",             
              data: {
                hidden_time_inout:hidden_time_inout,
                text:content,
                purpose:purpose,
                date:date,
                time:time
              },                  
              success: function(data1){
                var result = JSON.parse(data1);
                alert(result);
                if(result === true){
                  toastr.success("You may now enter the "+atob(content).split('~')[1]+"'s Office.");
                } else if(result == 'Error_code_HE102894-SGUV0') {
                  toastr.error("There's an error. Please ask the MIS about this error. Error Code: HE102894-SGUV01");
                } else {
                  toastr.error("There's an error. Please ask the MIS about this error. Error Code: HE102894-SGSV01");
                }

              }
            });
          }
        } else {
          toastr.error("QR Code is not an office type. Please ask the MIS if this is an error.");
        }
        
      } else if(hidden_time_inout == 'enter_classroom') {
        $.ajax({    
          type: "post",
          url: "<?php echo base_url('sg/ScanQR/');?>",             
          data: {
            hidden_time_inout:hidden_time_inout,
            text:content,
            purpose:'',
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
            scanner.start(cameras[1]);
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

      } else if($(this).val() == 2){
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
      } 
    });
</script>
</body>
</html>