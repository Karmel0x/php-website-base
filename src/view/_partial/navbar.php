
  <nav class="navbar navbar-expand-lg fixed-top navbar-transparent " color-on-scroll="100">
    <div class="container">
      <div class="navbar-translate">
        <a class="navbar-brand" href="<?=URL_PATH;?>" rel="tooltip" title="Site title" data-placement="bottom">
          <span>PHP•</span> Website Base
        </a>
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
        <div class="navbar-collapse-header">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="<?=URL_PATH;?>">
                PHP•
              </a>
            </div>
            <div class="col-6 collapse-close text-right">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
        <ul class="navbar-nav">

          <?php
          if(!empty($_SESSION['user_id'])){
          if(!empty($_SESSION['rights'])){
          ?>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> Admin
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="<?=URL_PATH;?>admin/user" class="dropdown-item">
                <i class="tim-icons icon-image-02"></i>Users
              </a>
            </div>
          </li>
          <?php
          }
          ?>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> Account
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="javascript:" class="dropdown-item">
                <i class="tim-icons icon-image-02"></i>
                <?php
                  include_once('src/model/admin.user.php');
                  echo getUserDetailsById($_SESSION['user_id'], 'name');
                ?>
              </a>
              <a href="<?=URL_PATH;?>profile" class="dropdown-item">
                <i class="tim-icons icon-single-02"></i>Profile
              </a>
              <a href="<?=URL_PATH;?>profile/settings" class="dropdown-item">
                <i class="tim-icons icon-settings-gear-63"></i>Settings
              </a>
              <a href="<?=URL_PATH;?>api/account/logout" class="dropdown-item">
                <i class="tim-icons icon-button-power"></i>Logout
              </a>
            </div>
          </li>
          <?php
          }else{
          ?>
          <li class="nav-item">
            <a class="nav-link" href="<?=URL_PATH;?>account">Login</a>
          </li>
          <?php
          }
          ?>
          <!-- li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/" target="_blank">
              <i class="fab fa-twitter"></i>
              <p class="d-lg-none d-xl-none">Twitter</p>
            </a>
          </li>
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/" target="_blank">
              <i class="fab fa-facebook-square"></i>
              <p class="d-lg-none d-xl-none">Facebook</p>
            </a>
          </li>
          <li class="nav-item p-0">
            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/" target="_blank">
              <i class="fab fa-instagram"></i>
              <p class="d-lg-none d-xl-none">Instagram</p>
            </a>
          </li>
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> Getting started
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="https://demos.creative-tim.com/blk-design-system/docs/1.0/getting-started/overview.html" class="dropdown-item">
                <i class="tim-icons icon-paper"></i> Documentation
              </a>
              <a href="examples/register-page.html" class="dropdown-item">
                <i class="tim-icons icon-bullet-list-67"></i>Register Page
              </a>
              <a href="examples/landing-page.html" class="dropdown-item">
                <i class="tim-icons icon-image-02"></i>Landing Page
              </a>
              <a href="examples/profile-page.html" class="dropdown-item">
                <i class="tim-icons icon-single-02"></i>Profile Page
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-default d-none d-lg-block" href="javascript:void(0)" onclick="scrollToDownload()">
              <i class="tim-icons icon-cloud-download-93"></i> Button
            </a>
          </li -->
          <li class="dropdown nav-item">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
              <i class="fa fa-cogs d-lg-none d-xl-none"></i> Getting started
            </a>
            <div class="dropdown-menu dropdown-with-icons">
              <a href="https://github.com/Karmel0x/php-website-base" class="dropdown-item">
                <i class="tim-icons icon-paper"></i> php-website-base
              </a>
              <a href="https://demos.creative-tim.com/blk-design-system/docs/1.0/getting-started/overview.html" class="dropdown-item">
                <i class="tim-icons icon-paper"></i> template
              </a>
            </div>
          </li>

        </ul>
      </div>
    </div>
  </nav>
