<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin </title>
    <link rel="manifest" href="<?=PWA_PATH?>manifest.json">
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=ADMIN_ASSETS_PATH?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=ADMIN_ASSETS_PATH?>vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?=ADMIN_ASSETS_PATH?>vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?=ADMIN_ASSETS_PATH?>css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?=ADMIN_ASSETS_PATH?>images/favicon.ico" />
    <link rel="shortcut icon" href="<?=ADMIN_ASSETS_PATH?>images/jquery-ui.css" />

    <link href="<?= ADMIN_ASSETS_PATH ?>plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="#"><img src="<?=ADMIN_ASSETS_PATH?>images/logo.svg" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="#"><img src="<?=ADMIN_ASSETS_PATH?>images/logo-mini.svg" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="<?=ADMIN_PATH?>logout">
                <i class="mdi mdi-power"></i><b>Sign Out</b>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
        <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        