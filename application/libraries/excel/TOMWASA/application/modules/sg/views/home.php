  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Scan QR Code</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
          </div>
          <div class="col-lg-6">
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
              <button class="btn btn-primary" name="buttons" value="1" id="btn_office">Visit Office</button>
              <button class="btn btn-secondary" name="buttons" value="2" id="btn_classroom">Enter Classroom</button>
            </div>
            <input type="hidden" id="hidden_time_inout" value="visit_office">
            <h4><span id='date'></span> <span id='time'></span></h4>
            <div class="card card-primary card-outline">
              <div class="card-body">
                <div class="container">
                  <div id="div_purpose">
                    <label for="Purpose">Purpose <span id="required"><i>(Required)</i></span> :</label>
                    <textarea rows="2" id="Purpose" style="width: 100%;"></textarea>
                  </div>
                  <label for="title">Scan QR Code : </label>
                  <video id="preview" style="width: 100%; height: 300px;"></video>
                  <center>
                    <div class="btn-group btn-group-toggle mb-5" data-toggle="buttons">
                      <label class="btn btn-secondary" id="front">
                        <input type="radio" name="options" value="2" autocomplete="off" id="front"> Front Camera
                      </label>
                      <label class="btn btn-primary" id="back">
                        <input type="radio" name="options" value="1" autocomplete="off" id="back"> Back Camera
                      </label>
                    </div>
                  </center>
                </div>
              </div>
            </div><!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-3">
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <button type="button" class="btn btn-default" id="hidden_modal" data-toggle="modal" data-target="#modal-default" hidden></button>
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Default Modal</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>One fine body&hellip;</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->