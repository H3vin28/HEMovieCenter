<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HE Movie Center 1.0.0</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/summernote/summernote-bs4.min.css">
  <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo.png')?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/')?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <style type="text/css">
    .select2-selection__arrow {
      display: none !important;
    }

    .ui-autocomplete {
      z-index: 1055!important;
    }

    .ui-autocomplete-loading{
      background: white right center no-repeat;
    }

    [class*=sidebar-dark-] .nav-sidebar>.nav-item.menu-open>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item:hover>.nav-link, [class*=sidebar-dark-] .nav-sidebar>.nav-item>.nav-link:focus {
      background-color: rgba(255,255,255,0)!important;
    }

    .dark-mode .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .dark-mode .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #4249f8!important;
    }

    h4, h6 {
      margin-bottom: 0px!important;
    }

    .card {
      background-color: rgba(0, 0, 0, 0.4)!important;
    }

    #myBTBtn {
      display: none;
      position: fixed;
      bottom: 68px;
      right: 14px;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      background-color: red;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
    }

    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
      background-color: #007bff !important;
      color: #fff;
    }

    h1{
      color: #fff;
    }

    h4, h6{
      color: #000;
    }

    .card {
      background-color: rgba(255, 255, 255, 1) !important;
    }

    .input-group-text{
      width: 45px;
      text-align: center;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
      color: #fff!important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
      background-color: red!important;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered {
      line-height: 30px!important;
    }

    .select2-container .select2-selection--single {
      height: 41px!important;
    }

    .flex-center {
      display: flex;
      align-items: center;
      height: 45px;
    }

    .hover-overlay {
      overflow: hidden;
    }

    .hover-overlay .overlay-title {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 92.5%;
      background: rgba(0, 0, 0, 0.6); /* semi-transparent black */
      color: white;
      text-align: center;
      margin: 0px 7px;
      opacity: 0;
      transition: opacity 0.3s ease-in-out;
    }

    .hover-overlay:hover .overlay-title {
      opacity: 1;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed control-sidebar-slide-open sidebar-mini-xs layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?= base_url('assets/images/logo.png')?>" alt="HE Movie Center Logo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light dropdown-legacy border-bottom-0">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="<?= base_url('assets/adminlte/')?>#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <div class="navbar-search-block col-sm-6" style="display: flex;margin-left: 50px;">
          <form action="<?= base_url('main/search_title/')?>" id="searchForm" class="form-inline" method="post">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" id="search_movie" name="search_movie" placeholder="Quick Search Movie Title" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="button" style="cursor: default;">
                <i class="fas fa-search btn-navbar"></i>
              </button>
            </div>
          </div>
          </form>
        </div>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="nav-icon fab fa-facebook"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="nav-icon fab fa-youtube"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="nav-icon fab fa-instagram-square"></i>
        </a>
      </li>
      <li class="nav-item dropdown" <?= @$row != null ? '':'hidden'?>>
        <a class="nav-link" href="<?= base_url('main/logout/')?>">
          <i class="nav-icon fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->