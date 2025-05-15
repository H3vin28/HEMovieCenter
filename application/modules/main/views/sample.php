
    <!-- Navbar -->
    <?php $this->load->view('header'); ?>
    
    <!-- Sidebar -->
    <?php $this->load->view('sidebar'); ?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Movies List</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    
                        <div class="col-sm-2">
                            <div class="card movie-card">
                                <a href="#" style="color:white">
                                    <img src="<?= base_url('assets/images/logo.png')?>" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="card-text">adadada</h3>
                                        <h6 class="card-text">Year: 2025</h6>
                                        <h6 class="card-text">Genre: </h6>
                                        <h6 class="card-text">Description: sdadadwdwa sadsa d</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <?php $this->load->view('footer'); ?>
