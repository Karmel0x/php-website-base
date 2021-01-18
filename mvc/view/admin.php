<!DOCTYPE html>
<html lang="en">

<?php
include(__DIR__.'/_partial/head.php');
?>

<body class="index-page">

<?php
include(__DIR__.'/_partial/navbar.php');
?>

  <div class="wrapper">
    <div class="section">

      <div class="container container-xl mt-5">
        <?php
		    include('mvc/shared/include_child.php');
        ?>
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
