<style type="text/css">
select {
appearance:none; -webkit-appearance:none; -moz-appearance:none
}
</style>

<div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Form User
                        </div>
                        <div class="panel-body">
                            <form id="submit">
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <select id="inp" class="form-control" name="nip" required>
                                                <option value="0">Select Item</option>
                                                <?php foreach($employe as $data){?>
                                                    <option value="<?php echo $data->nip ?>"><?php echo $data->nip.' - '.$data->name_employe?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Karyawan</label>
                                            <input id="name" class="form-control" type="text" name="name" readonly>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <input id="position" class="form-control" type="text" name="position" readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Division</label>
                                            <input id="division" class="form-control" type="text" name="division"readonly>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Join</label>
                                             <input id="join" class="form-control" type="text" name="join"readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <input id="branch" class="form-control" type="text" name="total" value=""readonly>
                                        </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                             <input class="form-control" type="text" name="username" required>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="Password" name="pass" required>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <?php foreach($active as $data){?>
                                                <option value="<?php echo $data->id_active; ?>">
                                                    <?php echo $data->name_active; ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select class="form-control" name="level" required>
                                                <option value="#">-- Select Data --</option>
                                                <?php foreach($level as $data){?>
                                                <option value="<?php echo $data->id_level; ?>">
                                                    <?php echo $data->name_level; ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                </div>
                            </div>
                            <a href="usercontroller" type="button" class="btn btn-fill btn-warning btn-sm pull-right">Cancel</a>
                            <button id="btn" type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    $(document).ready(function() {
    $('#inp').select2();
    $('#inp').change(function(){

            var nip = $('#inp').val();
        
                $.ajax({
                        url: "<?=base_url()?>UserController/get_employe",
                        async: false,
                        type: "POST",
                        data: {nip:nip},
                        dataType: "html",
                        success: function(r) {
                            var r = JSON.parse(r);
                            var obj = r.ada;

                            document.getElementById('name').value = obj.name_employe;
                            document.getElementById('position').value = obj.position;
                            document.getElementById('division').value = obj.division;
                            document.getElementById('join').value = obj.date_join;
                            document.getElementById('branch').value = obj.name_branch;
                    }
                });
            });

    $('#submit').submit(function(e){
            e.preventDefault();

              $.ajax({
                      url: '<?= base_url(); ?>UserController/add_data',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Simpan Data", text: "Berhasil Disimpan!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "../usercontroller";
                                               }
                                            );
                          }else if(data == 'ni'){
                                swal({title: "Data Karyawan Kosong", text: "Isikan NIP!!", type: 
                                        "error"}).then(function(){ 
                                           location.reload();
                                           }
                                        );
                          }else if(data == 'no'){
                                swal({title: "Gagal Simpan Data", text: "Data Sudah Ada!!", type: 
                                        "error"}).then(function(){ 
                                           location.reload();
                                           }
                                        );
                          }else{
                                swal({title: "Simpan Data", text: "Gagal Simpan Data!!", type: 
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