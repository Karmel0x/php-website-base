<!DOCTYPE html>
<html lang="en">

<?php
include(__DIR__.'/_partial/head.php');
?>

<body class="index-page">

  <div class="wrapper">
    <?php
      include(__DIR__.'/_partial/navbar.php');
    ?>

    <?php
		include_child();
    ?>
        
    <?php
    include(__DIR__.'/_partial/footer.php');
    ?>
  </div>

  <?php
  include(__DIR__.'/_partial/scripts.php');
  ?>
</body>
</html>
