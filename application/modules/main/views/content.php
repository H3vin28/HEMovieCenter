<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: linear-gradient(to right, #051343, #1c37c5);">
    <!-- Content Header (Page header) -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 justify-content-center">
          <div class="col-sm-10">
            <img src="<?= base_url('assets/images/header.png')?>" width="100%">
          </div>
        </div>
      </div>
    </div>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 justify-content-center">
          <div class="col-sm-10">
            <h1 class="m-0">Recommended Movies</h1>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center mb-3">
          <div class="col-sm-10">
            <div class="row">
              <?php 
              $count = 0;
              foreach ($movies as $movie) {
                if($count == 6){
                  break;
                }
                $count++;
              ?>
              <div class="col-sm-2 position-relative hover-overlay">
                <a href="<?= base_url('main/selected_movie/'.$movie->id)?>">
                  <img src="<?= base_url('assets/movies_image/'.$movie->file_name)?>" style="width: 100%; height: 210px;"
                  class="img-fluid" 
                  alt="<?= $movie->title ?>"
                  />
                  <div class="overlay-title">
                    <span style="font-size: 20px;font-weight: bolder;"><?= $movie->title?></span>
                    <br/>
                    <?= $movie->year_released?>
                    <br/>
                    <?= $movie->genre?>
                  </div>
                </a>
              </div>
              <?php }?> 
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>