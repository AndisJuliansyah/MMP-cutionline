<link rel="stylesheet" type="text/css" href="assets/login/vendor/bootstrap/css/bootstrap.min.css">
<link href="<?php echo base_url(''); ?>assets/plugins/sweetalert2/sweetalert2.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="assets/login/vendor/select2/select2.min.css">
<link rel="stylesheet" type="text/css" href="assets/css_custom/signup.css">
<link rel="icon" type="image/png" href="assets/img/logo-mmp-75.png"/>
<!--=====================================================================-->
<title>Sign up</title> 
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 left">
			<div class="row">
			<div class="col-md-2">
				<img src="<?php echo base_url("assets/img/logo-mmp-75.png")?>" class="img">
			</div>
			<div class="col-md-8">
				<h3>
				MMP-Cuti Online
				</h3>	
			</div>
			</div>
				<h6>
					PT. Megah Medika Pharma
				</h6>
			<hr>
			<div>
				<p> Aplication <b>MMP-CUTI ONLINE</b> is a supporting application in the operations of PT. Megah Medika Pharma which can be used easily.</p>
				<p> make your vacation come true ....</p>
			</div>
		</div>
		<div class="col-md-8 right">
				<h4>SIGN UP</h4>
			<hr>
			<form id="submit" role="form">
				<div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <select class="form-control nip" name="nip" style="height:50px;" required>
                                                <option value="0">Select Item</option>
                                                <?php foreach($employe as $data){?>
                                                    <option value="<?php echo $data->nip ?>"><?php echo $data->nip.' - '.$data->name_employe?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Karyawan</label>
                                            <input id="name" class="form-control" type="text" name="name" readonly>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <input id="position" class="form-control" type="text" name="position" readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Division</label>
                                            <input id="division" class="form-control" type="text" name="division"readonly>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Join</label>
                                             <input id="join" class="form-control" type="text" name="join"readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <input id="branch" class="form-control" type="text" name="total" value=""readonly>
                                        </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                             <input class="form-control" type="text" name="username" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="Password" name="pass" required>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <?php foreach($active as $data){?>
                                                <option value="<?php echo $data->id_active; ?>">
                                                    <?php echo $data->name_active; ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Level</label>
                                            </select>
                                            <input id="level" class="form-control" type="hidden" name="level" readonly>
                                            <input id="lvl" class="form-control" type="text" name="lvl" readonly>
                                        </div>
                                </div>
                            </div>
						<a href="<?php echo base_url('login')?>" type="button" class="btn btn-warning btn-sm pull-right">Cancel</a>
                            <button id="btn" type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">Submit</button>
			</form>
		</div>
	</div>
</div>
<!--=====================================================================-->
<script src="<?php echo base_url('assets/login/vendor/jquery/jquery-3.2.1.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
<script src="assets/login/vendor/select2/select2.min.js"></script>
<script src="assets/js_custom/signup.js"></script>