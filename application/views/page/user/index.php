<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List User
                             <a href="<?php echo base_url("usercontroller/adduser");?>" type="button" class="btn btn-success btn-xs"><i class="fa fa-edit fa-fw"></i>add</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nip</th>
                                            <th>Username</th>
                                            <th>Status</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $no = 1;
                                            foreach($user as $data){?>
                                        <tr class="odd gradeX">
                                                    <td><?php echo $no++;?></td>
                                                    <td><?php echo $data->nip;?></td>
                                                    <td><?php echo $data->username;?></td>
                                                    <td><span class="<?php echo $data->span; ?>"><?php echo $data->name_active;?></span></td>
                                                    <td><?php echo $data->name_level;?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="<?php echo base_url("usercontroller/edituser/$data->id_users");?>">Edit</a></li>
                                                                <li><a href="#" class="del" data-id="<?php echo $data->id_users?>">Hapus</a></li>
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

<script type="text/javascript">
    $(document).ready(function(){
            $('#dataTables-example').dataTable({
               "bPaginate": true,
                "iDisplayLength": 10,
                "bSort": false,
                "bInfo": false,
                "bAutoWidth": false,
                "searching": false,
                "bLengthChange": false
            });
            
            $('.del').click(function(){
                var id = $(this).data('id');

                swal({
                  title: 'Apakah Anda Yakin?',
                  text: "Anda Tidak dapat mengembalikan data yang sudah dihapus!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, hapus data!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>UserController/deleteuser",
                                method: "POST",
                                data: {id:id},
                                success: function(data){
                                    if (data == 'ok') {
                                        swal({title: "Hapus Data", text: "Berhasil Dihapus!", type: 
                                                "success"}).then(function(){ 
                                                   window.location.href = "./usercontroller";
                                                   }
                                                );
                                      }else{
                                        swal({title: "Hapus Data", text: "Gagal Hapus Data!!", type: 
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