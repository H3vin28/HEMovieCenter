<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: linear-gradient(to right, #051343, #1c37c5);">
    <!-- Content Header (Page header) -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 justify-content-center">
          <div class="col-sm-10">
            <h1 class="m-0">Movie Lists</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <button id="myBTBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
        <div class="row justify-content-center">
          <div class="col-sm-10">
            <div class="card">
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-sm-3">
                    <h5>Genre :</h5>
                  </div>
                  <div class="col-sm-3">
                    <h5>Year :</h5>
                  </div>
                  <!-- <div class="col-sm-2">
                    <h5>Rating :</h5>
                  </div> -->
                  <div class="col-sm-3">
                    <h5>Order By :</h5>
                  </div>
                </div>
                <form method="get" id="form_sort">
                  <div class="row justify-content-center">
                    <div class="col-sm-3">
                      <select class="select2" style="width: 100%" name="genre">
                        <?php if(@$this->input->get('genre') != null){?>
                          <option><?= $this->input->get('genre')?></option>
                        <?php }?>
                        <option value="">All</option>
                        <?php foreach($genres as $genre){?>
                        <option><?= $genre->name?></option>
                        <?php }?>
                      </select>
                    </div>
                    <div class="col-sm-3">
                      <select class="select2" style="width: 100%" name="year">
                        <?php if(@$this->input->get('year') != null){?>
                          <option><?= $this->input->get('year')?></option>
                        <?php }?>
                        <option value="">All</option>
                        <?php foreach($years as $year){?>
                        <option><?= $year->year_released?></option>
                        <?php }?>
                      </select>
                    </div>
                    <!-- <div class="col-sm-3">
                      <select class="select2" style="width: 100%" name="rating">
                        <?php if(@$this->input->get('rating') != null){?>
                          <option><?= $this->input->get('rating')?></option>
                        <?php }?>
                        <option value="">All</option>
                        <option value="5">5.0</option>
                        <option value="4">4+</option>
                        <option value="3">3+</option>
                        <option value="2">2+</option>
                        <option value="1">1+</option>
                        <option value="0">0+</option>
                      </select>
                    </div> -->
                    <div class="col-sm-3">
                      <select class="select2" style="width: 100%" name="order_by">
                        <?php if(@$this->input->get('order_by') != null){?>
                          <option><?= $this->input->get('order_by')?></option>
                        <?php }?>
                        <option value="">Default</option>
                        <option>Latest</option>
                        <option>Oldest</option>
                        <!-- <option>Rating</option> -->
                      </select>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-sm-10">
             
            <div class="row d-flex flex-wrap">
            <?php 
            if($movies == null){
              echo '<div class="col-sm-10 text-center mt-5"><h2 class="text-white">No Data Found!</h2></div>';
            } else {
              foreach ($movies as $row) {
              ?>
              <div class="col-sm-3 d-flex">
                <div class="card movie-card flex-fill">
                    <a href="<?= base_url('main/selected_movie/'.$row->id)?>" style="color:white">
                        <img src="<?= base_url('assets/movies_image/'.$row->file_name)?>" class="card-img-top" style="height: 260px;">
                        <div class="card-body">
                            <h4 class="card-text"><?= $row->title?></h4>
                            <h6 class="card-text">Year: <?= $row->year_released?></h6>
                            <h6 class="card-text">Genre: <?= $row->genre?></h6>
                            <h6 class="card-text">Description: <br/><?= $row->description?></h6>
                        </div>
                    </a>
                </div>
              </div>
            <?php }}?> 
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>