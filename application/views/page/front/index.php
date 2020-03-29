<div class="row">
                <!-- Welcome -->
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        <i class="fa fa-folder-open"></i><b>&nbsp;Hello !! </b>Welcome Back <b><?php echo $this->session->userdata('n_name')?></b> In Aplication MMP-Cuti Digital.
                    </div>
                </div>
                <!--end  Welcome -->
            </div>

            <?php 
            $level = $this->session->userdata('level');
            if($level == '1'){?>
            <div class="row">
                <!--quick info section -->
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green">
                            <i class="fa fa-plane fa-3x"></i>
                            <h3><?php echo $kalkulasi[0]->total_cuti; ?> Hari</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Total Cuti
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body yellow">
                            <i class="fa fa-tasks fa-3x"></i>
                            <h3><?php echo $kalkulasi[0]->sisa_cuti; ?> Hari</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Sisa Cuti
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green">
                            <i class="fa fa-thumbs-up fa-3x"></i>
                            <h3><?php echo $kalkulasi[0]->all_cuti; ?> Hari</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Cuti Yang Diambil
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body red">
                            <i class="fa fa-warning fa-3x"></i>
                            <h3><?php echo $transaksi; ?> Permohonan</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Cuti Yang Ditolak
                            </span>
                        </div>
                    </div>
                </div>
                <!--end quick info section -->
            </div>
            <?php }else if($level == '2'){?>
                <div class="row">
                <!--quick info section -->
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body yellow">
                            <i class="fa fa-warning fa-3x"></i>
                            <h3><?php echo $kalkulasi; ?> Permohonan</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Yang Belum Approve
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green">
                            <i class="fa fa-group fa-3x"></i>
                            <h3><?php echo $employe; ?> Orang</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Karyawan
                            </span>
                        </div>
                    </div>
                </div>
                </div>
                <!--end quick info section -->
            </div>
            <?php }else if($level == '3'){?>
                <div class="row">
                <!--quick info section -->
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body yellow">
                            <i class="fa fa-question fa-3x"></i>
                            <h3><?php echo $kalkulasi; ?> Permohonan</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Yang Belum Approve
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green">
                            <i class="fa fa-group fa-3x"></i>
                            <h3><?php echo $employe; ?> Orang</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Karyawan
                            </span>
                        </div>
                    </div>
                </div>
                </div>
            <?php }else{?>
                <div class="row">
                <!--quick info section -->
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body yellow">
                            <i class="fa fa-question fa-3x"></i>
                            <h3><?php echo $transaksi[0]; ?> Permohonan</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Yang Belum Approve
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body green">
                            <i class="fa fa-thumbs-up fa-3x"></i>
                            <h3><?php echo $transaksi[2]; ?> Permohonan</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Yang Disetujui
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body red">
                            <i class="fa fa-warning fa-3x"></i>
                            <h3><?php echo $transaksi[4]; ?> Permohonan</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Yang Ditolak
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-primary text-center no-boder">
                        <div class="panel-body" style="background-color: #6495ED">
                            <i class="fa fa-group fa-3x"></i>
                            <h3><?php echo $employe; ?> Orang</h3>
                        </div>
                        <div class="panel-footer">
                            <span class="panel-eyecandy-title">Jumlah Karyawan
                            </span>
                        </div>
                    </div>
                </div>
                </div>
            <?php }?>