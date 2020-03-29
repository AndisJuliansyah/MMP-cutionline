<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             List Approvel
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Cuti</th>
                                            <th>NIP</th>
                                            <th>Nama Karyawan</th>
                                            <th>Total Hari</th>
                                            <th>Jenis Cuti</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>~</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;
                                            foreach($transaksi as $val){?>
                                        <tr class="odd gradeX">
                                            <td style="border-bottom-style: none;"><?php echo $no++;?></td>
                                            <td style="border-bottom-style: none;"><?php echo $val->no_cuti;?></td>
                                            <td><?php echo $val->nip;?></td>
                                            <td><?php echo $val->name_employe;?></td>
                                            <td><?php echo $val->total_cuti;?></td>
                                            <td><?php echo $val->name_cuti;?></td>
                                            <td><?php echo $val->keterangan;?></td>
                                            <td><span class="<?php echo $val->label;?>"><?php echo $val->name_status;?></span></td>
                                            <td>
                                                <div class="btn-group">
                                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="#" data-toggle="modal" data-target="#modal<?php echo $no;?>">Detail</a>
                                                                </li>
                                                                <li><a class="app" href="#" data-id="<?php echo $val->id_header;?>" data-in="<?php echo $val->total_cuti;?>" data-np="<?php echo $val->nip;?>">Approve</a>
                                                                </li>
                                                                <li><a href="#" data-toggle="modal" data-target="#revisi<?php echo $no;?>">Revisi</a>
                                                                </li>
                                                                <li><a href="#" data-toggle="modal" data-target="#tolak<?php echo $no;?>">Tolak</a>
                                                                </li>
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
<?php 
$no1 = 2;
foreach($transaksi as $val1){?>
<div class="modal fade" id="modal<?php echo $no1?>" role="dialog">
                    <div class="modal-dialog modal-lg">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Detail Cuti</h4>
                        </div>
                        <div class="modal-body">
                            <iframe scrolling="yes" frameborder="0" width="850" height="425" src="CutiController/review/<?php echo $val1->no_cuti?>"></iframe>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                      
                    </div>
                  </div>
   <?php $no1++; ?>
<?php }?>

<!--Modal Revisi-->

<?php 
$no2 = 2;
foreach($transaksi as $val2){?>
<div class="modal fade" id="revisi<?php echo $no2?>" role="dialog">
                    <div class="modal-dialog modal-lg">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Revisi Cuti</h4>
                        </div>
                        <div class="modal-body">
                            <form id="submit">
                            <div class="row">
                                 <div class="col-md-2">
                                    Kode Cuti
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <input type="hidden" name="no" value="<?php echo $val2->id_header;?>">
                                    <?php echo $val2->no_cuti;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Nama Karyawan
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <?php echo $val2->name_employe;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Jenis Cuti
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <?php echo $val2->name_cuti;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Total Hari
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <?php echo $val2->total_cuti;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Keterangan
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <textarea class="control-panel" rows="4" name="revisi" style="min-width: 70%"></textarea> 
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
   <?php $no2++; ?>
<?php }?>

<?php 
$no3 = 2;
foreach($transaksi as $val3){?>
<div class="modal fade" id="tolak<?php echo $no3?>" role="dialog">
                    <div class="modal-dialog modal-lg">
                    
                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Tolak Cuti</h4>
                        </div>
                        <div class="modal-body">
                            <form id="send">
                            <div class="row">
                                 <div class="col-md-2">
                                    Kode Cuti
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <input type="hidden" name="no" value="<?php echo $val3->id_header;?>">
                                    <?php echo $val3->no_cuti;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Nama Karyawan
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <?php echo $val3->name_employe;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Jenis Cuti
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <?php echo $val3->name_cuti;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Total Hari
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <?php echo $val3->total_cuti;?>
                                 </div>
                            </div>
                            <div class="row">
                                 <div class="col-md-2">
                                    Keterangan
                                 </div>
                                 <div class="col-md-2">
                                    : 
                                 </div>
                                 <div class="col-md-8">
                                    <textarea class="control-panel" rows="4" name="revisi" style="min-width: 70%"></textarea> 
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
   <?php $no3++; ?>
<?php }?>

<script src="<?php echo base_url('assets/plugins/jquery-1.10.2.js');?>"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#dataTables-example').dataTable({
                "bPaginate": true,
                "iDisplayLength": 10,
                "searching": false,
                "bSort": false,
                "bInfo": false,
                "bAutoWidth": true,
                "bLengthChange": false,
            });

        $('.app').click(function(){
            var no = $(this).data('id');
            var total = $(this).data('in');
            var nip = $(this).data('np');

            swal({
                  title: 'Approve Data!',
                  text: "Apakah Anda Ingin Menyetuji?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Approve data!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>ApprovelController/approvetransaksi",
                                method: "POST",
                                data: {id:no, total:total, nip:nip},
                                success: function(data){
                                    if (data == 'ok') {
                                        swal({title: "Setujui Cuti", text: "Data Berhasil Disetujui!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "PengajuanController";
                                               }
                                            );
                                      }else if(data == 'okok'){
                                        swal({title: "Setujui Cuti", text: "Data Berhasil Disetujui!", type: 
                                              "success"}).then(function(){ 
                                                 window.location.href = "PengajuanController";
                                                 }
                                              );
                                      }else{
                                        swal({title: "Setujui Cuti", text: "Pengajuan Gagal Disetujui!!", type: 
                                          "error"}).then(function(){ 
                                             location.reload();
                                             }
                                          );
                                      }
                                    }
                            });
                    }, function(dismiss) {
                      if (dismiss === 'cancel' || dismiss === 'close') {
                        // ignore
                      } 
                    })
        });

        $('#submit').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>ApprovelController/revisi',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Revisi Cuti", text: "Pengajuan Berhasil Dikembalikan!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "PengajuanController";
                                               }
                                            );
                          }else{
                                swal({title: "Revisi Cuti", text: "Data Gagal Disetujui!!", type: 
                                        "error"}).then(function(){ 
                                           location.reload();
                                           }
                                        );
                          }
                        },500);
                      }
                  });
        });

        $('#send').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>ApprovelController/failed',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Pengajuan Cuti", text: "Pengajuan Berhasil Dibatalkan!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "PengajuanController";
                                               }
                                            );
                          }else{
                               swal({title: "Revisi Cuti", text: "Pengajuan Gagal Dibatalkan!!", type: 
                                        "error"}).then(function(){ 
                                           location.reload();
                                           }
                                        );
                          }
                        },500);
                      }
                  });
        });
    });
</script>