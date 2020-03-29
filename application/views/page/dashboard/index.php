<?php
    header('Last-Modified:'.  gmdate('D, d M Y H:i:s').'GMT');
    header('Cache-Control: no-store, no-cache, must-revalidate');
    header('Cache-Control: post-check=0, pre-check=0',false);
    header('Pragma: no-cache');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="76x76" href="<?php echo base_url('assets/img/logo-mmp-75.png') ?>">
    <title>MMP-CUTIONLINE</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url('assets/plugins/bootstrap/bootstrap.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/pace/pace-theme-big-counter.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/css/main-style.css');?>" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/plugins/dataTables/Buttons-1.5.4/css/buttons.dataTables.min.css');?>">

    <link href="<?php echo base_url('assets/plugins/dataTables/jquery.dataTables.min.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/dataTables/dataTables.bootstrap.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url(''); ?>assets/plugins/sweetalert2/sweetalert2.css" rel="stylesheet" />
    <link href="<?php echo base_url('assets/plugins/select2-develop/dist/css/select2.min.css');?>" rel="stylesheet" />

    <!-- Page-Level CSS -->
    <link href="<?php echo base_url('assets/plugins/morris/morris-0.4.3.min.css');?>" rel="stylesheet" />
    <link href="<?php echo base_url(''); ?>assets/plugins/datetimepicker-master/jquery.datetimepicker.css" rel="stylesheet" />
   </head>
<body>
    <!--  wrapper -->
    <div id="wrapper">
        <!-- navbar top -->
            <?php $this->load->view('page/dashboard/header');?>
        <!-- end navbar side -->
        <!--  page-wrapper -->
        <div id="page-wrapper">

            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $title;?></h1>
                </div>
                <!--End Page Header -->
            </div>
            <?php $this->load->view($content);?>
        </div>
        <!-- end page-wrapper -->

    </div>
    <!-- end wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="<?php //echo base_url('assets/plugins/jquery-1.10.2.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/jquery-3.3.1.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/bootstrap/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/datetimepicker-master/build/jquery.datetimepicker.full.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/plugins/select2-develop/dist/js/select2.min.js')?>"></script>
    <!-- <script src="<?php //echo base_url('assets/plugins/dataTables/jquery.dataTables.js')?>"></script> -->

    <script src="<?php echo base_url('assets/plugins/dataTables/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/dataTables.buttons.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/buttons.flash.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/jszip.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/pdfmake.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/vfs_fonts.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/buttons.html5.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/dataTables/buttons.print.min.js');?>"></script>

    <script src="<?php echo base_url('assets/plugins/metisMenu/jquery.metisMenu.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/sweetalert2/sweetalert2.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/pace/pace.js');?>"></script>
    <script src="<?php echo base_url('assets/scripts/siminta.js');?>"></script>
    <!-- Page-Level Plugin Scripts-->
    <script src="<?php echo base_url('assets/plugins/morris/raphael-2.1.0.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/morris/morris.js"');?>"></script>
    <script src="<?php echo base_url('assets/scripts/dashboard-demo.js');?>"></script>

</body>

</html>
