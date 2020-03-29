<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List Employe
                             <a href="<?php echo base_url("employecontroller/addemploye");?>" type="button" class="btn btn-success btn-xs"><i class="fa fa-edit fa-fw"></i>add</a>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example" class="display nowrap">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nip</th>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Division</th>
                                            <th>Cabang</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Sisa Cuti</th>
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
                                                    <td><?php echo $data->name_employe;?></td>
                                                    <td><?php echo $data->name_level;?></td>
                                                    <td><?php echo $data->name_division;?></td>
                                                    <td><?php echo $data->name_branch;?></td>
                                                    <td>
                                                        <?php 
                                                            $transform = date_create($data->date_join);
                                                            echo date_format($transform, 'd-m-Y');?>
                                                    </td>
                                                    <td><?php echo $data->sisa_cuti;?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button id="hid" type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                                                Actions
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu pull-right" role="menu">
                                                                <li><a href="<?php echo base_url("employecontroller/editemploye/$data->id_employe");?>">Edit</a></li>
                                                                <li><a href="#" class ="del" data-id="<?php echo $data->id_employe?>">Hapus</a></li>
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

    <!-- <script src="<?php //echo base_url('assets/plugins/dataTables/jquery.dataTables.js')?>"></script> -->
<script src="<?php //echo base_url('assets/plugins/dataTables/jquery-3.3.1.js');?>"></script>
<script src="<?php //echo base_url('assets/plugins/dataTables/jquery.dataTables.min.js');?>"></script>
<script src="<?php //echo base_url('assets/plugins/dataTables/dataTables.buttons.min.js');?>"></script>
<script src="<?php //echo base_url('assets/plugins/dataTables/buttons.flash.min.js');?>"></script>
<script src="<?php //echo base_url('assets/plugins/dataTables/jszip.min.js');?>"></script>
<script src="<?php //echo base_url('assets/plugins/dataTables/pdfmake.min.js');?>"></script>
<script src="<?php //echo base_url('assets/plugins/dataTables/vfs_fonts.js');?>"></script>
<script src="<?php ///echo base_url('assets/plugins/dataTables/buttons.html5.min.js');?>"></script>
<script src="<?php //echo base_url('assets/plugins/dataTables/buttons.print.min.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#dataTables-example').dataTable({
                "bPaginate": true,
                "iDisplayLength": 10,
                "bSort": false,
                "bInfo": true,
                "bAutoWidth": true,
                "bLengthChange": false,
                dom: 'Bfrtip',
                 buttons: [  
                   'excel'
                 ]
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
                                url: "<?= base_url(); ?>EmployeController/deleteemploye",
                                method: "POST",
                                data: {id:id},
                                success: function(data){
                                    if (data == 'ok') {
                                        swal({title: "Hapus Data", text: "Berhasil Dihapus!", type: 
                                                "success"}).then(function(){ 
                                                   window.location.href = "../employecontroller/";
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