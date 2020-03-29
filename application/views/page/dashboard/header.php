        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <!-- navbar-header -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">
                    <!-- <h3><strong>MMP-CUTDIG</strong></h3> -->
                    <?php if($this->uri->segment(2)){
                        echo '<img src="../assets/img/logo-mmp-75.png" id="image_logo" alt="" />';
                    }else{
                        echo '<img src="assets/img/logo-mmp-75.png" id="image_logo" alt="" />';
                    }?>
                    
                    
                </a>
                <div class="logo_text">
                        <h3>
                            MMP - Cuti Online
                        </h3>
                </div>   
                    <h6>
                        PT. Megah Medika Pharma
                    </h6>
            </div>
            <!-- end navbar-header -->
            <!-- navbar-top-links -->
            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <div id="nav"></div>
                        <i class="fa fa-bell fa-3x"></i>
                    </a>
                    <ul id="notif" class="dropdown-menu dropdown-alerts not">
                        <li class="divider"></li>
                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-3x"></i>
                    </a>
                    <!-- dropdown user-->
                    <?php $id = $this->session->userdata('id_users');?>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url("usercontroller/edituser/$id");?>"><i class="fa fa-user fa-fw"></i>User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('login/login/logout');?>"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                        </li>
                    </ul>
                    <!-- end dropdown-user -->
                </li>
                <!-- end main dropdown -->
            </ul>
            <!-- end navbar-top-links -->

        </nav>
       
        <nav class="navbar-default navbar-static-side" role="navigation">
            <!-- sidebar-collapse -->
            <div class="sidebar-collapse">
                <!-- side-menu -->
                <ul class="nav" id="side-menu">
                    <li>
                        <!-- user image section-->
                        <div class="user-section">
                            <div class="user-section-inner">
                                <?php if ($this->uri->segment(3)) {?>
                                        <img src="../../assets/img/employe/<?php echo $this->session->userdata('image')?>" style="width: 80px" alt="">
                                <?php } elseif ($this->uri->segment(2)) {?>
                                        <img src="../assets/img/employe/<?php echo $this->session->userdata('image')?>" alt="">
                                <?php } elseif ($this->uri->segment(1)) {?>
                                        <img src="assets/img/employe/<?php echo $this->session->userdata('image')?>" alt="">
                                <?php }?>
                            </div>
                            <div class="user-info">
                                <div><?php echo $this->session->userdata('n_name')?></div>
                                <div class="user-text-online">
                                    <span class="user-circle-online btn btn-success btn-circle "></span>&nbsp;Online
                                </div>
                            </div>
                        </div>
                        <!--end user image section-->
                    </li>
                    <li <?php if($this->uri->segment(1) == 'dashboardcontroller'){ echo "class='selec'"; }?>>
                        <a id="text-a" href="<?php echo base_url('dashboardcontroller');?>"><i class="fa fa-dashboard fa-fw"></i>Dashboard</a>
                    </li>
                    <?php
                    $akses = array();
                    $menus_access = $this->mmp_lib->MenuUser($this->session->userdata('level'));
                    
                        // foreach ($menus_access as $va) {
                                    
                        //           array_push($akses, $va->id_menus);
                        // }
                        // $menu = $this->mmp_lib->Menu();
                        foreach ($menus_access as $vm){
                            if($vm->id_submenus){
                                // if(in_array($vm->id_menus, $akses)) {
                                    echo '<li '; if($this->uri->segment(1) == 'UserController' || $this->uri->segment(1) == 'EmployeController' || $this->uri->segment(1) == 'ManageController' || $this->uri->segment(1) == 'MasterController'){ echo "class='selec'"; }echo'><a href="#"><i class="'.$vm->icon.'"></i>'.$vm->n_menus.'<span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">';
                                    $submenu = $this->mmp_lib->SubMenu();
                                    foreach ($submenu as $lm){
                                        if($vm->id_menus == $lm->id_menus){
                                        echo'<li class="li-sub" '; if($this->uri->segment(1) == $lm->url){ echo "class='sub'"; } echo'>
                                            <a id="text-a" href="'.base_url().$lm->url.'">'.$lm->n_submenus.'</a>
                                          </li>';
                                        }
                                    }
                                        '</ul>
                                    </li>';
                                // }
                            }else{
                                echo '<li '; if($this->uri->segment(1) == $vm->url){ echo "class='selec'"; } echo'>'
                                . '<a id="text-a" href="'.base_url().$vm->url.'"><i class="'.$vm->icon.'"></i>'.$vm->n_menus.'</a>
                                </li>';
                            }
                        }
                    ?>
                </ul>
            </div>
        </nav>

<script src="<?php echo base_url('assets/plugins/jquery-1.10.2.js');?>"></script>
<script type="text/javascript">

    $(document).ready(function(){
        var nip = '<?php echo $this->session->userdata('nip')?>';
        var lvl = '<?php echo $this->session->userdata('level')?>';

        function load_unseen_notification(view = '')
        {
         $.ajax({
                  url:"<?= base_url();?>DashboardController/check_data",
                  method:"POST",
                  data:{view:view, nip:nip, lvl:lvl},
                  dataType:"json",
                  success:function(data)
                  {
                    $('#notif').html(data.notification);
                       if(data.unseen_notification > 0)
                       {
                            $('#nav').html(data.unseen_notification1);
                       }
                    }
         });
        }

        load_unseen_notification();

        $(document).on('click', '#notif', function(){
             $('#nav').html('');
             var no = $(this).data('no');
             load_unseen_notification(no);
        });

         setInterval(function(){
             load_unseen_notification();
            }, 9000);
    });
</script>
