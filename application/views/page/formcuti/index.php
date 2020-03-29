<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel Pengajuan Cuti
                             <a href="<?php echo base_url("cuticontroller");?>" type="button" class="btn btn-success btn-xs"><i class="fa fa-edit fa-fw"></i>add</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Cuti</th>
                                            <th>Tanggal</th>
                                            <th>NIP</th>
                                            <th>Nama Karyawan</th>
                                            <th>Total Hari</th>
                                            <th>Jenis Cuti</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach($transaksi as $trn){?>
                                        <tr class="odd gradeX">
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $trn->no_cuti;?></td>
                                                    <td>
                                                        <?php for($i = $trn->datestart; $i <= $trn->dateend; $i++){
                                                              $baru = $i;
                                                              $date5 = date_create($baru);
                                                              echo date_format($date5, 'd / m / Y').'<br>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $trn->nip;?></td>
                                                    <td><?php echo $trn->name_employe;?></td>
                                                    <td><?php echo $trn->total_cuti;?></td>
                                                    <td><?php echo $trn->name_cuti;?></td>
                                                    <td><?php echo $trn->keterangan;?></td>
                                                    <td><span class="<?php echo $trn->label;?>"><?php echo $trn->name_status;?></span></td>
                                                    <td>
                                                      <?php
                                                       if($trn->status == "5" || $trn->status == "2"){
                                                           echo'<div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="#" data-toggle="modal" data-target="#modal'.$no.'">Detail</a>
                                                                </li>
                                                                <li><a href="'.base_url("CutiController/edit/".$trn->no_cuti."").'">Edit</a>
                                                                </li>
                                                                <li><a class="del" href="#" data-id="'.$trn->id_header.'" data-in="'.$trn->no_cuti.'">Hapus</a>
                                                                </li>
                                                                <li><a class="send" href="#" data-id="'.$trn->id_header.'">Ajukan Cuti</a>
                                                                </li>
                                                            </ul>
                                                        </div>';
                                                      }else{
                                                        echo'<div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="#" data-toggle="modal" data-target="#modal'.$no.'">Detail</a>
                                                                </li>
                                                            </ul>
                                                        </div>';
                                                      }
                                                      ?>
                                                        
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

            $('.del').click(function(){
                var id = $(this).data('id');
                var kode = $(this).data('in');

                swal({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>PengajuanController/delete",
                                method: "POST",
                                data: {id:id, kode:kode},
                                success: function(data){
                                    if (data == 'ok') {
                                         swal({title: "Hapus Data", text: "Berhasil Dihapus!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "PengajuanController";
                                               }
                                            );
                                      }else{
                                          swal({title: "Hapus Data", text: "Gagal Dihapus!!", type: 
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

            $('.send').click(function(){
                var id = $(this).data('id');

                swal({
                  title: 'Kirim Data',
                  text: "Apakah Anda Ingin Mengajukan Cuti?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Send data!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>CutiController/send_data",
                                method: "POST",
                                data: {id:id},
                                success: function(data){
                                    if (data == 'ok') {
                                      swal({title: "Ajukan Cuti!", text: "Pengajuan Berhasil Dikirim", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "PengajuanController";
                                               }
                                            );
                                      }else{
                                       swal({title: "Ajukan Cuti", text: "Pengajuan Cuti Gagal", type:
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
    });
</script>