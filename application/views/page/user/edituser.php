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
                            Form Edit User
                        </div>
                        <div class="panel-body">
                            <form id="submit">
                            <div class="row">
                              <?php foreach($user as $data ){?>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                             <input class="form-control" type="hidden" name="id_users" value="<?php echo $data->id_users?>">
                                             <input class="form-control" type="text" name="username" value="<?php echo $data->username?>" required>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="Password" name="pass" value="<?php echo $data->pass;?>" required>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <?php foreach($active as $data2){?>
                                                <option value="<?php echo $data2->id_join;?>" <?php if($data2->id_join == $data->status){ echo 'selected';} ?>>
                                                    <?php echo $data2->name_active; ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Level</label>
                                            <select class="form-control" name="level" required>
                                                <?php foreach($level as $data3){?>
                                                <option value="<?php echo $data3->id_level;?>" <?php if($data3->id_level == $data->level){ echo 'selected';} ?>>
                                                    <?php echo $data3->name_level; ?>
                                                </option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                </div>
                            </div>
                            <?php }?>
                            <!-- <a href="<?php //echo base_url('./usercontroller') ?>" type="button" class="btn btn-fill btn-warning btn-sm pull-right">Cancel</a> -->
                            <button id="btn" type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#submit').submit(function(e){
                e.preventDefault();

                  $.ajax({
                          url: '<?= base_url(); ?>UserController/edit_data',
                          type: "POST",
                          data : new FormData(this),
                          processData: false,
                          contentType:false,
                          cache:false,
                          async: false,
                          success: function(data) {
                            setTimeout(function(){
                              if (data == 'ok') {
                                    swal({title: "Edit Data", text: "Berhasil Diedit!", type: 
                                                "success"}).then(function(){ 
                                                   window.location.href = "../usercontroller";
                                                   }
                                                );
                              }else{
                                    swal({title: "Edit Data", text: "Gagal Edit Data!!", type: 
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