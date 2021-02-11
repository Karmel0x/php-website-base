<?php
if(empty($GLOBALS['variable']['profile'])){
  echo 'profile not found';
  return;
}
?>


  <div class="text-center mt-4">
    <div class="row">
      <div class="col-lg-6">
        <br><br>
        <h3><?=$profile;?><span class="font-weight-light"></span></h3>
        <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i>info1</div>
        <div class="h6 mt-4"><i class="ni business_briefcase-24 mr-2"></i>info12</div>
        <div><i class="ni education_hat mr-2"></i>info123</div>
      </div>
      <div class="col-lg-6">
        <img src="<?=URL_PATH;?>template/assets/img/mike.jpg" class="rounded-circle" style="max-width: 300px">
      </div>
    </div>
  </div>
  <div class="mt-5 py-5 border-top text-center">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <p>An artist of considerable range, Ryan — the name taken by Melbourne-raised, Brooklyn-based Nick Murphy — writes, performs and records all of his own music, giving it a warm, intimate feel with a solid groove structure. An artist of considerable range.</p>
        <a href="javascript:;">Show more</a>
      </div>
    </div>
  </div>
