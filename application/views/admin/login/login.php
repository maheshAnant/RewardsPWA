<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Rewards PWA</title>
    <!-- plugins:css -->
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
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="<?=ADMIN_ASSETS_PATH?>images/logo.svg">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" action="<?=ADMIN_PATH?>login/chklogin" method="POST">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="email" value="<?php echo set_value('email'); ?>">
                    <?php echo form_error('email', '<div class="error" style="color:red">', '</div>'); ?>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>">
                    <?php echo form_error('password', '<div class="error" style="color:red">', '</div>'); ?>
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <?php if(isset($error) && $error != 0){?> 
                    <div></div>
                    <div class="error" style="color:red; padding-top: 2%"> <?=$errormsg?> </div>
                  <?php } ?>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="<?=ADMIN_ASSETS_PATH?>vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?=ADMIN_ASSETS_PATH?>js/off-canvas.js"></script>
    <script src="<?=ADMIN_ASSETS_PATH?>js/hoverable-collapse.js"></script>
    <script src="<?=ADMIN_ASSETS_PATH?>js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>