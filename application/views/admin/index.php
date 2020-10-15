<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="mdi mdi-home"></i>
        </span> Dashboard </h3>
    </div>
    <?php if($this->session->userdata('is_admin') == 0){?>
      <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <h4 class="font-weight-normal mb-3">
                Companies 
                <i class="mdi mdi-home mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5"><?=$total_companies?></h2>
              <!-- <h6 class="card-text">Increased by 60%</h6> -->
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
              <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Users<i class="mdi mdi-account-multiple mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5"><?=$total_users?></h2>
              <!-- <h6 class="card-text">Decreased by 10%</h6> -->
            </div>
          </div>
        </div>
      </div>
    <?php }?>
    <?php if($this->session->userdata('is_admin') == 1){?>
      <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <h4 class="font-weight-normal mb-3">
                Contests 
                <i class="mdi mdi-home mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5"><?=$total_contest?></h2>
              <!-- <h6 class="card-text">Increased by 60%</h6> -->
            </div>
          </div>
        </div>
        <div class="col-md-4 stretch-card grid-margin">
          <div class="card bg-gradient-info card-img-holder text-white">
            <div class="card-body">
              <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
              <h4 class="font-weight-normal mb-3">Users<i class="mdi mdi-account-multiple mdi-24px float-right"></i>
              </h4>
              <h2 class="mb-5"><?=$total_users?></h2>
              <!-- <h6 class="card-text">Decreased by 10%</h6> -->
            </div>
          </div>
        </div>
      </div>
    <?php }?>
  </div>
         