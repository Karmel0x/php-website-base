<!DOCTYPE html>
<html lang="en">

  <?php
  include(__DIR__.'/_partial/head.php');
  ?>

<body class="register-page">

  <?php
  include(__DIR__.'/_partial/navbar.php');
  ?>

  <div class="wrapper">
    <div class="page-header" style="min-height: unset;">
      <div class="page-header-image"></div>
      <div class="content">
        <div class="container">
          <div class="row">
            <div class="col-12 offset-lg-0 offset-md-2" style="max-width: 450px">
              <div id="square7" class="square square-7"></div>
              <div id="square8" class="square square-8"></div>
              <div class="card card-register">
                <div class="card-header">
                  <img class="card-img" src="<?=URL_PATH;?>template/assets/img/square1.png" alt="Card image">
                  <h4 class="card-title"><?=$GLOBALS['REQUEST_URI'][1];?></h4>
                </div>
                <div class="card-body">
                  
                <?php
                if(!empty($_GET['result'])){
                ?>
                <div class="card-header bg-white">
                  <div class="text-muted text-center">
                    <?=htmlspecialchars($_GET['result']);?>
                  </div>
                </div>
                <?php
                }
                ?>

                <form role="form" action="<?=URL_PATH;?>api/account/<?=$GLOBALS['REQUEST_URI'][1];?>" method="post">
                  <input type="hidden" name="zxczczxcxz" value="<?=$time;?>">
                  <?php
		              include('mvc/shared/include_child.php');
                  ?>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary my-4">Sign in</button>
                  </div>
                </form>

                <div class="row text-center">
                  <?php
                  if($GLOBALS['REQUEST_URI'][1] == 'reminder'){
                  ?>
                  <div class="col-6">
                    <a href="<?=URL_PATH;?>account/login" class="text-light"><small>Remembered password?</small></a>
                  </div>
                  <?php
                  }
                  else if($GLOBALS['REQUEST_URI'][1] == 'register'){
                  ?>
                  <div class="col-6">
                    <a href="<?=URL_PATH;?>account/login" class="text-light"><small>Have an account?</small></a>
                  </div>
                  <?php
                  }
                  ?>
                  <?php
                    if($GLOBALS['REQUEST_URI'][1] != 'reminder'){
                  ?>
                  <div class="col-6">
                    <a href="<?=URL_PATH;?>account/reminder" class="text-light"><small>Forgot password?</small></a>
                  </div>
                  <?php
                  }
                  ?>
                  <?php
                  if($GLOBALS['REQUEST_URI'][1] != 'register'){
                  ?>
                  <div class="col-6">
                    <a href="<?=URL_PATH;?>account/register" class="text-light"><small>Create new account</small></a>
                  </div>
                  <?php
                  }
                  ?>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div style="position: absolute;top: 0;right: 0;">
          <div class="register-bg"></div>
          <div id="square1" class="square square-1"></div>
          <div id="square2" class="square square-2"></div>
          <div id="square3" class="square square-3"></div>
          <div id="square4" class="square square-4"></div>
          <div id="square5" class="square square-5"></div>
          <div id="square6" class="square square-6"></div>
        </div>
      </div>
    </div>
  </div>
  
    <?php
    include(__DIR__.'/_partial/footer.php');
    ?>
  </div>

  <?php
  include(__DIR__.'/_partial/scripts.php');
  ?>
</body>
</html>
