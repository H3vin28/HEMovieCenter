<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background-image: linear-gradient(to right, #051343, #1c37c5);">
    <!-- Content Header (Page header) -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-1"></div>
          <div class="col-sm-8">
            <h1 class="m-0">Movie Details</h1>
          </div>
          <div class="col-sm-3">
            <h1 class="m-0">Similar Movies</h1>
          </div>
          <div class="col-sm-1"></div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mb-3">
          <div class="col-sm-1"></div>
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-4 mb-3">
                <img src="<?= base_url('assets/movies_image/'.$movie->file_name)?>" style="width: 100%;object-fit: cover;height: 370px;"/>
              </div>
              <div class="col-sm-8">
                <h1><?= $movie->title?> <em style="font-size: 20pt;">( <?= $movie->year_released?> )</em></h1>
                <h5 class="text-white"></h5>
                <hr style="border: 1px solid white">
                
                <h5 class="text-white"><?= $movie->genre?></h5>
                <hr style="border: 1px solid white">
                <h5 class="text-white">" <?= $movie->description?> "</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <video width="100%" controls autoplay>
                  <source src="<?= base_url()?>/assets/videos/video_intro.mp4" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            </div>
          </div>
          <div class="col-sm-2">
            <div class="row justify-content-center">
              <?php 
              $count = 0;
              foreach ($similar_movie as $movie) {
              if($count == 4){
                break;
              }
              $count++;
              ?>
              <div class="col-sm-11 mb-3 position-relative hover-overlay">
                <a href="<?= base_url('main/selected_movie/'.$movie->id)?>">
                  <img src="<?= base_url('assets/movies_image/'.$movie->file_name)?>" style="width: 100%;height: 200px;"
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