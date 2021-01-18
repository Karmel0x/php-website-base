
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <h1 class="text-center">Your account settings</h1>
       </div>
	</div>
			
	<div class="row">
		<?php
		if(!empty($_GET['result'])){
		?>
		<div class="col-12 p-4 bg-<?=!empty($_GET['result_success']) ? 'success' : 'danger';?>" style="border-radius: 8px;">
			<div class="text-center" style="color: white;font-weight: 600;text-transform: uppercase;">
				<?=$_GET['result'];?>
	  		</div>
	  	</div>
		<?php
		}
		?>
	  	<div class="col-lg-6">
			<div class="card-body px-lg-5 py-lg-5">
				<div class="text-center text-muted mb-4">
					<small>Here you can change your password</small>
				</div>
				<form role="form" method="post" action="">
					<input type="hidden" name="submit" value="<?=AccountActionType::PASSWORD_CHANGE;?>">
					<div class="form-group">
						<div class="input-group input-group-alternative mb-3">
    						<div class="input-group-prepend">
    						  <div class="input-group-text">
    						    <i class="tim-icons icon-lock-circle"></i>
    						  </div>
    						</div>
							<input class="form-control" placeholder="Old password" type="text" name="form_password_old" />
						</div>
					</div>
					<div class="form-group">
						<div class="input-group input-group-alternative mb-3">
    						<div class="input-group-prepend">
    						  <div class="input-group-text">
    						    <i class="tim-icons icon-lock-circle"></i>
    						  </div>
    						</div>
							<input class="form-control" placeholder="New password" type="text" name="form_password" />
						</div>
					</div>
					<!--div class="form-group focused">
						<div class="input-group input-group-alternative">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
							</div>
							<input class="form-control" placeholder="Repeat new password" type="password" name="form_password2" />
						</div>
					</div-->
					<!--div class="text-muted font-italic">
						<small>password strength: <span class="text-success font-weight-700">strong</span></small>
					</div-->
					<div class="text-center">
						<button type="submit" class="btn btn-primary mt-4">Save</button>
					</div>
				</form>
	    	</div>
	  	</div>
	  	<div class="col-lg-6">
		  	<?php
			if(!isMailConfirmed()){
			?>
			<div class="card-body px-lg-5 pt-lg-5 pb-0">
				<div class="text-center text-muted">
					<small>For account security, please confirm your email</small>
				</div>
				<form method="post" action="">
					<div class="text-center">
						<button type="submit" class="btn btn-primary mt-2" name="sendconfirm" value="1">Send confirmation email</button>
					</div>
				</form>
	        </div>
		  	<?php
			}
			?>

			<div class="card-body px-lg-5 py-lg-5">
				<div class="text-center text-muted mb-4">
					<small>Here you can change your account details (Name)</small>
				</div>
				<form role="form" method="post" action="">
					<input type="hidden" name="submit" value="<?=AccountActionType::DETAILS_UPDATE;?>">
					<div class="form-group">
						<div class="input-group input-group-alternative">
							<div class="input-group-prepend">
                    			<span class="input-group-text"><i class="fa fa-user"></i></span>
                  			</div>
							<input class="form-control" placeholder="Name" type="text" name="form_name" value="<?=getUserDetailsById($_SESSION['user_id']);?>" />
						</div>
					</div>
					<div class="text-center">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
	        </div>
	  	</div>
	</div>
