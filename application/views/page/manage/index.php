<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                List Management User
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach($level as $data){?>
                            <tr>
                                <td><?php echo $no++?></td>
                                <td><?php echo $data->name_level?></td>
                                <td><?php //echo $data->status?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                            Actions
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu pull-right" role="menu">
                                            <li><a href="<?php echo base_url("managecontroller/editmanage/$data->id_level");?>">Edit</a></li>
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