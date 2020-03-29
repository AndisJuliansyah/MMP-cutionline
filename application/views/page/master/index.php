<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List Division
                             <a href="#" data-toggle="modal" data-target="#modal" type="button" class="btn btn-success btn-xs"><i class="fa fa-edit fa-fw"></i>add</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nip</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no = 1;
                                        foreach($division as $data){?>
                                        <tr class="odd gradeX">
                                                    <td><?php echo $no++?></td>
                                                    <td><?php echo $data->name_division++?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="#" data-toggle="modal" data-target="#modal<?php echo $no;?>">Edit</a></li>
                                                                <li><a href="#" class ="deletediv" data-id="<?php echo $data->id_div;?>">Hapus</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
<!-- modal add divisi -->
                    <div class="modal fade" id="modal" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Add Divisi</h4>
                            </div>
                            <div class="modal-body">
                                <form id="adddiv">
                                <div class="row">
                                     <div class="col-md-4">
                                        Nama Divisi
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="text" name="name" autocomplete="off" required>
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
    <!-- end -->

    <!-- modal edit divisi -->
                    <?php 
                    $number = 2;
                    foreach($division2 as $divisi){?>
                    <div class="modal fade" id="modal<?php echo $number?>" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Division</h4>
                            </div>
                            <div class="modal-body">
                                <form class="editdiv">
                                <div class="row">
                                     <div class="col-md-4">
                                        Nama Divisi
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="hidden" name="id" value="<?php echo $divisi->id_div ?>">
                                        <input class="form-control" type="text" name="name" value="<?php echo $divisi->name_division ?>" autocomplete="off">
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
                  <?php $number++; ?>
                  <?php }?>
    <!-- end -->

                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List Jumlah Cuti
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nip</th>
                                            <th>Total Cuti/Tahun</th>
                                            <th>Sisa Cuti</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no2 = 1;
                                        foreach($avlaiblecuti as $data2){?>
                                        <tr class="odd gradeX">
                                                    <td><?php echo $no2++?></td>
                                                    <td><?php echo $data2->nip?></td>
                                                    <td><?php echo $data2->total_cuti?></td>
                                                    <td><?php echo $data2->sisa_cuti?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="" data-toggle="modal" data-target="#modalcut<?php echo $no2;?>">Edit</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- modal edit avlaible cuti -->
                    <?php 
                    $number2 = 2;
                    foreach($avlaiblecuti as $avl){?>
                    <div class="modal fade" id="modalcut<?php echo $number2?>" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Jumlah Cuti</h4>
                            </div>
                            <div class="modal-body">
                                <form class="editjmlcuti">
                                <div class="row">
                                     <div class="col-md-4">
                                        NIP
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="hidden" name="id" value="<?php echo $avl->id_avlaible;?>">
                                        <input class="form-control" type="text" name="total" value="<?php echo $avl->nip;?>" readonly>
                                     </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-4">
                                        Total Cuti
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="text" name="total" value="<?php echo $avl->total_cuti;?>">
                                     </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-4">
                                        Sisa Cuti
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="text" name="sisa" value="<?php echo $avl->sisa_cuti;?>">
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
                  <?php $number2++; ?>
                  <?php }?>
    <!-- end -->

<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List Cabang
                             <a href="#" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-branch"><i class="fa fa-edit fa-fw"></i>add</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nip</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no3 = 1;
                                        foreach($branch as $data3){?>
                                        <tr class="odd gradeX">
                                                    <td><?php echo $no3++ ?></td>
                                                    <td><?php echo $data3->name_branch ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="" data-toggle="modal" data-target="#modal_branch<?php echo $data3->id_branch?>">Edit</a></li>
                                                                <li><a href="#" class ="deletebranch" data-id="<?php echo $data3->id_branch?>">Hapus</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

<!-- modal add branch -->
                    <div class="modal fade" id="modal-branch" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Add Cabang</h4>
                            </div>
                            <div class="modal-body">
                                <form id="addbranch">
                                <div class="row">
                                     <div class="col-md-4">
                                        Nama Cabang
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="text" name="name" autocomplete="off" required>
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
    <!-- end -->

    <!-- modal edit branch -->
                    <?php 
                    $number3 = 2;
                    foreach($branch as $cabang){?>
                    <div class="modal fade" id="modal_branch<?php echo $number3; ?>" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Cabang</h4>
                            </div>
                            <div class="modal-body">
                                <form class="editbranch">
                                <div class="row">
                                     <div class="col-md-4">
                                        Nama Cabang
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="hidden" name="id" value="<?php echo $cabang->id_branch;?>">
                                        <input class="form-control" type="text" name="name" value="<?php echo $cabang->name_branch;?>" autocomplete="off" required>
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
                  <?php $number3++; ?>
                  <?php }?>
    <!-- end -->
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List Tanggal Merah
                             <a href="#" type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-date"><i class="fa fa-edit fa-fw"></i>add</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Hari</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no4 = 1;
                                        foreach($holiday as $data4){?>
                                        <tr class="odd gradeX">
                                                    <td><?php echo $no4++ ?></td>
                                                    <td><?php echo $data4->name ?></td>
                                                    <td><?php echo $data4->date ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="" data-toggle="modal" data-target="#modal-holiday<?php echo $no4?>">Edit</a></li>
                                                                <li><a href="#" class ="deletedate" data-id="<?php echo $data4->id_date?>">Hapus</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

<!-- modal add date -->
                    <div class="modal fade" id="modal-date" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Add Tanggal Merah</h4>
                            </div>
                            <div class="modal-body">
                                <form id="adddate">
                                <div class="row">
                                     <div class="col-md-4">
                                        Hari
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="text" name="name" autocomplete="off" required>
                                     </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-4">
                                        Tanggal
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input id="date" class="form-control" type="text" name="date" autocomplete="off" required>
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
    <!-- end -->

    <!-- modal edit date -->
                    <?php 
                    $number4 = 2;
                    foreach($holiday as $hdy){?>
                    <div class="modal fade" id="modal-holiday<?php echo $number4?>" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Tanggal Merah</h4>
                            </div>
                            <div class="modal-body">
                                <form class="editdate">
                                <div class="row">
                                     <div class="col-md-4">
                                        Hari
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="hidden" name="id" value="<?php echo $hdy->id_date;?>">
                                        <input class="form-control" type="text" name="day" value="<?php echo $hdy->name;?>" autocomplete="off" required>
                                     </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-4">
                                        Tanggal
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input id="date2" class="form-control" type="text" name="date" value="<?php echo $hdy->date;?>" autocomplete="off" required>
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
                  <?php $number4++; ?>
                  <?php }?>
    <!-- end -->

<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List Subjenis
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Subjenis</th>
                                            <th>Hari Cuti</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $no5 = 1;
                                        foreach($subjenis as $data5){?>
                                        <tr class="odd gradeX">
                                                    <td><?php echo $no5++?></td>
                                                    <td><?php echo $data5->name_subjenis?></td>
                                                    <td><?php echo $data5->total_cuti?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="" data-toggle="modal" data-target="#modal-subjenis<?php echo $no5; ?>">Edit</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Report Sisa Pertahun
                        </div>
                        <div class="panel-body">
                            <label>Backup Data Sisa Pertahun :</label>
                            <a href="#" type="button" class="btn btn-primary generet">Proccess</a>
                        </div>
                    </div>
                </div>
            </div>

<!-- modal edit subjenis -->
                    <?php 
                    $number5 = 2;
                    foreach($subjenis as $sub){?>
                    <div class="modal fade" id="modal-subjenis<?php echo $number5; ?>" role="dialog">
                        <div class="modal-dialog modal-md">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Total Hari Subjenis</h4>
                            </div>
                            <div class="modal-body">
                                <form class="editsub">
                                <div class="row">
                                     <div class="col-md-4">
                                        Subjenis
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="hidden" name="id" value="<?php echo $sub->id_subjenis;?>" >
                                        <input class="form-control" type="text" name="name" value="<?php echo $sub->name_subjenis;?>" readonly>
                                     </div>
                                </div>
                                <div class="row">
                                     <div class="col-md-4">
                                        Total Hari
                                     </div>
                                     <div class="col-md-2">
                                        : 
                                     </div>
                                     <div class="col-md-6">
                                        <input class="form-control" type="text" name="date" value="<?php echo $sub->total_cuti;?>" autocomplete="off" required>
                                     </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="submit" class="btn btn-primary">Submit</button>
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                          </div>
                        </div>
                  </div>
                  <?php $number5++; ?>
                  <?php }?>
    <!-- end -->
<?php $this->load->view('js/master');?>