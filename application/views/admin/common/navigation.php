 <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="<?= checkImage('profile',$this->session->userdata('profile_pic')) ?>" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2"> <?= get_login_name() ?>  </span>
                  <span class="text-secondary text-small"><?= get_login_user_role() ?></span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>

            <li class="nav-item <?=get_active_links();?>">
              <a class="nav-link" href="<?=ADMIN_PATH?>">
                <span class="menu-title">Dashboard</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
            <?php 
            foreach (navigation_links() as $links) {
            ?>
            <li class="nav-item <?=get_active_links($links['action']);?>">
                <a class="nav-link" href="<?=ADMIN_PATH.$links['action']?>">
                  <span class="menu-title"><?=$links['title']?></span>
                  <i class="mdi <?=$links['icon']?> menu-icon"></i>
                </a>
            </li>
            <?php   
            } 
            ?>
          </ul>
        </nav>  