<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                             Tabel List Cuti
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Kode Cuti</th>
                                            <th>Tanggal</th>
                                            <th>NIP</th>
                                            <th>Nama Karyawan</th>
                                            <th>Cabang</th>
                                            <th>Total Hari</th>
                                            <th>Jenis Cuti</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach($transaksi as $trn){?>
                                        <tr class="odd gradeX">
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
                                                    <td><?php echo $trn->name_branch;?></td>
                                                    <td><?php echo $trn->total_cuti;?></td>
                                                    <td><?php echo $trn->name_cuti;?></td>
                                                    <td><?php echo $trn->keterangan;?></td>
                                                    <td><span class="<?php echo $trn->label;?>"><?php echo $trn->name_status;?></span></td>
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
    });
</script>