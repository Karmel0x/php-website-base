<!DOCTYPE html>
<html lang="en">
  <?php
    include(__DIR__.'/_partial/head.php');
  ?>
  <body class="landing-page">
    <?php
      include(__DIR__.'/_partial/navbar.php');
    ?>
    <div class="wrapper">

      <section class="section section-lg">
        <section class="section">
          <img src="../assets/img/path4.png" class="path">
          <div class="container">
            <?php
		        if(!include_child()){
              include_once('src/view/profile.index.php');
            }
            ?>
          </div>
        </section>
      </section>

      <?php
      include(__DIR__.'/_partial/footer.php');
      ?>
    </div>

    <?php
    include(__DIR__.'/_partial/scripts.php');
    ?>
  </body>
</html>
