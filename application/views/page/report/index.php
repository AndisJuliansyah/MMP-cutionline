<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Form Report Data
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('reportcontroller/get_transaksi');?>" method="POST">
                    <div class="row">
                     <div class="col-md-1">NIP</div>
                     <div class="col-md-5">
                        <input id="nip" type="text" class="form-control" value="<?php echo @$_SESSION['nip'];?>" name="nip" autocomplete="off">
                    </div>
                    <div class="col-md-1">Nama</div>
                    <div class="col-md-5">
                        <input id="name" type="text" class="form-control" value="<?php echo @$_SESSION['name'];?>" name="name" autocomplete="off">
                    </div>
                </div>
                <br>
                <div class="row">
                 <div class="col-md-1">Divisi</div>
                 <div class="col-md-5">
                    <select class="form-control" name="divisi" id="divisi">
                        <option value="">-- Select Data --</option>
                        <?php foreach($divisi as $div){?>
                            <option value="<?php echo $div->id_div ?>" <?php if(@$_SESSION['divisi'] == $div->id_div){ echo 'selected';} ?>><?php echo $div->name_division ?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-md-1">Cabang</div>
                <div class="col-md-5">
                    <select class="form-control" name="cabang" id="cabang">
                        <option value="">-- Select Data --</option>
                        <?php foreach($cabang as $cab){?>
                            <option value="<?php echo $cab->id_branch ?>" <?php if(@$_SESSION['cabang'] == $cab->id_branch){ echo 'selected';} ?>><?php echo $cab->name_branch ?></option>
                        <?php }?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
             <div class="col-md-1">Status</div>
             <div class="col-md-5">
               <select class="form-control" name="status" id="status">
                <option value="">-- Select Data --</option>
                <option value="3" <?php if(@$_SESSION['status'] == 3){ echo 'selected';} ?>>Diambil</option>
                <option value="2" <?php if(@$_SESSION['status'] == 2){ echo 'selected';} ?>>Direvisi</option>
                <option value="4" <?php if(@$_SESSION['status'] == 4){ echo 'selected';} ?>>Dibatalkan</option>
            </select>
        </div>
        <div class="col-md-1">Jenis Cuti</div>
        <div class="col-md-5">
           <select class="form-control" name="jenis" id="jenis">
            <option value="">-- Select Data --</option>
            <?php foreach($jenis as $jen){?>
                <option value="<?php echo $jen->id_jenis ?>"  <?php if(@$_SESSION['jenis'] == $jen->id_jenis){ echo 'selected';} ?>><?php echo $jen->name_cuti ?></option>
            <?php }?>
        </select>
    </div>
</div>
<br>
<div class="row">
 <div class="col-md-1">Date</div>
 <div class="col-md-5">
    <input id="datestart" type="text" class="form-control" name="datestart" value="<?php echo @$_SESSION['datestart'];?>" autocomplete="off">
</div>
<div class="col-md-1">s/d</div>
<div class="col-md-5">
    <input id="dateend" type="text" class="form-control" name="dateend" value="<?php echo @$_SESSION['dateend'];?>" autocomplete="off">
</div>
</div>
<br>
<a href="<?php echo base_url('ReportController')?>" type="button" class="btn btn-fill btn-warning btn-sm pull-right"><i class="fa fa-refresh fa-fw"></i>Refresh</a>
<button id="btn" type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px"><i class="fa fa-search fa-fw"></i>Search</button>
</div>
</form>
</div>
</div>
</div>
<div id="pesan_kirim" style="display:none"></div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
            <form action="<?php echo base_url('reportcontroller/export');?>" method="POST">
                <input type="hidden" class="form-control" name="nip" value="<?php echo @$_SESSION['nip'];?>">
                <input type="hidden" class="form-control" name="name" value="<?php echo @$_SESSION['name'];?>">
                <input type="hidden" class="form-control" name="divisi" value="<?php echo @$_SESSION['divisi'];?>">
                <input type="hidden" class="form-control" name="cabang" value="<?php echo @$_SESSION['cabang'];?>">
                <input type="hidden" class="form-control" name="status" value="<?php echo @$_SESSION['status'];?>">
                <input type="hidden" class="form-control" name="jenis" value="<?php echo @$_SESSION['jenis'];?>">
                <input type="hidden" class="form-control" name="datestart" value="<?php echo @$_SESSION['datestart'];?>">
                <input type="hidden" class="form-control" name="dateend" value="<?php echo @$_SESSION['dateend'];?>">
            <button type="submit" class="btn btn-success btn-xs"><i class="fa fa-table fa-fw"></i>Export</button>
            </form>
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
                    <th>Divisi</th>
                    <th>Cabang</th>
                    <th>Jenis Cuti</th>
                    <th>Keterangan</th>
                    <th>Status</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($transaksi)): ?>
                    <?php foreach($transaksi as $data){?>
                        <tr>
                            <td><?php echo $data->no_cuti?></td>
                            <td>
                                <?php for($i = $data->datestart; $i <= $data->dateend; $i++){
                                                              $baru = $i;
                                                              $date5 = date_create($baru);
                                                              echo date_format($date5, 'd / m / Y').'<br>';
                                                        }
                                ?>
                            </td>
                            <td><?php echo $data->nip?></td>
                            <td><?php echo $data->name_employe?></td>
                            <td><?php echo $data->name_division?></td>
                            <td><?php echo $data->name_branch?></td>
                            <td><?php echo $data->name_cuti?></td>
                            <td><?php echo $data->keterangan?></td>
                            <td><span class="<?php echo $data->label?>"><?php echo $data->name_status?></span></td>
                            <td><a href="<?php echo base_url('ReportController/get_detail/'.$data->no_cuti);?>" type="button" class="btn btn-info btn-xs" target="_blank" rel="noopener noreferrer">Print</a></td>
                        </tr>
                    <?php }?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#datestart').datetimepicker({
                closeOnDateSelect:true,
                timepicker:false,
                formatDate: 'Y-m-d',
                format : 'Y-m-d',
           });

        $('#dateend').datetimepicker({
                closeOnDateSelect:true,
                timepicker:false,
                formatDate: 'Y-m-d',
                format : 'Y-m-d',
           });

            $('#dataTables-example').dataTable({
               "bPaginate": true,
                "iDisplayLength": 10,
                "bFilter": false,
                "bSort": false,
                "bInfo": true,
                "bLengthChange": false,
                "bAutoWidth": true
            });
        });
</script>