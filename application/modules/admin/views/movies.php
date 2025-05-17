<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">ALL MOVIES</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">View</a></li>
              <li class="breadcrumb-item active">All Movies</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-header">
                <button class="btn btn-success" data-toggle="modal" data-target="#modal-add-movie">ADD MOVIE</button>
              </div>
              <div class="card-body">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="5%">No.</th>
                      <th width="15%">Image</th>
                      <th width="15%">Title</th>
                      <th width="20%">Description</th>
                      <th width="5%">Year Released</th>
                      <th width="10%">Genre</th>
                      <th width="15%">Date Added</th>
                      <th width="15%">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $counter = 0;
                    foreach($movies as $row){ $counter++;?>
                      <tr>
                        <td><?= $counter?></td>
                        <td><img src="<?= base_url('assets/movies_image/'.$row->file_name)?>" class="card-img-top" style="width: 100%;"></td>
                        <td><?= $row->title?></td>
                        <td><?= $row->description?></td>
                        <td><?= $row->year_released?></td>
                        <td><?= $row->genre?></td>
                        <td><?= date('F d, Y h:s:i A', strtotime($row->date_created))?></td>
                        <td>
                          <button class="btn btn-primary update_btn"
                            data-title="<?= $row->title?>"
                            data-description='<?= $row->description?>'
                            data-year_released="<?= $row->year_released?>"
                            data-genre="<?= $row->genre?>"
                            data-file_name="<?= $row->file_name?>"
                            data-id="<?= $row->id?>"
                          ><i class="fas fa-edit"></i> Edit</button>

                          <button class="btn btn-danger delete_btn mt-1" data-toggle="modal" data-target="#modal-delete-movie" data-id="<?= $row->id?>" data-movie="<?= $row->title?>"><i class="fas fa-trash"></i> Delete</button>
                        </td>
                      </tr>
                    <?php }?>
                  </tbody>
                </table>
              </div>
              <div class="card-footer clearfix">
                <?= $pagination_links ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <div class="modal fade" id="modal-add-movie">
    <div class="modal-dialog">
      <form action="<?= base_url('admin/add_movie/')?>" method="post" id="add_movie" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Adding New Movie</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Cover Image <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="file_name" accept="image/*" id="file_name">
                      <label class="custom-file-label" for="file_name">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Movie Title <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="text" name="title" class="form-control" placeholder="Enter Movie Title">
                  </div>
                </div>
                <div class="form-group">
                  <label>Description <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <textarea class="form-control" name="description" placeholder="Enter Description ..." ></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label>Year Released <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="text" name="year_released" class="form-control" placeholder="Enter Year Released (e.g. <?= date('Y')?>)" value="<?= date('Y')?>">
                  </div>
                </div>
                <div class="form-group">
                  <label>Genre <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <select class="select2 form-control" name="genre[]" multiple="multiple" data-placeholder="Select a genre" style="width: 100%">
                      <?php foreach($genres as $genre){?>
                        <option><?= $genre->name?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Movie</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-update-movie">
    <div class="modal-dialog">
      <form action="<?= base_url('admin/update_movie/')?>" method="post" id="add_movie" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Updating Movie Information</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Cover Image <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" name="up_file_name" accept="image/*" id="up_file_name">
                      <label class="custom-file-label" for="up_file_name">Choose file</label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Movie Title <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="text" name="up_title" class="form-control" placeholder="Enter Movie Title">
                  </div>
                </div>
                <div class="form-group">
                  <label>Description <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <textarea class="form-control" name="up_description" placeholder="Enter Description ..." ></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label>Year Released <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <input type="text" name="up_year_released" class="form-control" placeholder="Enter Year Released (e.g. <?= date('Y')?>)">
                  </div>
                </div>
                <div class="form-group">
                  <label>Genre <span class="text-danger">*</span></label>
                  <div class="input-group">
                    <select class="select2 form-control" name="up_genre[]" id="genre_select"multiple="multiple" data-placeholder="Select a genre" style="width: 100%">
                      <?php foreach($genres as $genre){?>
                        <option><?= $genre->name?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="movie_id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update Movie</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="modal fade" id="modal-delete-movie">
    <div class="modal-dialog">
      <form action="<?= base_url('admin/delete_movie/')?>" method="post">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title"><i class="fas fas-exclamation-triangle"></i> SYSTEM WARNING</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4>Movie Name: <span id="movie_name"></span></h4 >
            <h5>Are you sure you want to delete this movie?</h5>
          </div>
          <div class="modal-footer justify-content-between">
            <input type="hidden" name="movie_id">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-danger">Delete Movie</button>
          </div>
        </div>
      </form>
    </div>
  </div>