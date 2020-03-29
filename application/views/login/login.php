<div class="limiter">
		<div class="container-login100">
			<div class="notifications" style="">
				<?php echo $this->session->flashdata('msg'); ?>
			</div>
			<div class="wrap-login100 p-b-160 p-t-50">
				<form method="post" accept-charset="utf-8" action="<?php echo base_url('login/login/log_in')?>" class="login100-form validate-form">
					<span id="a" class="login100-form-title p-b-5">
						<img src="<?php echo base_url("assets/img/logo-mmp-75.png")?>" class="img"><h3><b>MMP - Cuti Online</b></h3>
					</span>
					<span class="login100-form-title p-b-43">
						<h6>PT. Megah Medika Pharma</h6>
					</span>
					<div class="wrap-input100 rs1 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username" autocomplete="off">
						<span class="label-input100">Username</span>
					</div>
					
					<div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass">
						<span class="label-input100">Password</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Sign in
						</button>
					</div>
					<div class="text-center w-full p-t-23">
						<a href="<?php echo base_url('SignupController')?>">
							Sign Up !!
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>