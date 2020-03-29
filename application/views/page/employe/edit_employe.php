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
                                <?php foreach($employe as $data){?>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input class="form-control" type="hidden" name="id" value="<?php echo $data->id_employe?>">
                                            <input class="form-control" type="text" name="nip" value="<?php echo $data->nip?>">
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Karyawan</label>
                                            <input class="form-control" type="text" name="name" value="<?php echo $data->name_employe ?>">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control" name="position">
                                            <?php foreach($position as $posisi){?>
                                                <option value="<?php echo $posisi->id_level?>" <?php if($posisi->id_level == $data->position){ echo 'selected';} ?>><?php echo $posisi->name_level?></option>
                                            <?php }?>
                                        </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Division</label>
                                            <select class="form-control" name="division">
                                            <?php foreach($division as $divisi){?>
                                                <option value="<?php echo $divisi->id_div?>" <?php if($divisi->id_div == $data->division){ echo 'selected';} ?>><?php echo $divisi->name_division?></option>
                                            <?php }?>
                                        </select>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Branch</label>
                                            <select class="form-control" name="branch">
                                                <?php foreach($branch as $cabang){?>
                                                <option value="<?php echo $cabang->id_branch?>"<?php if($cabang->id_branch == $data->branch){ echo 'selected';} ?>><?php echo $cabang->name_branch?></option>
                                            <?php }?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Join</label>
                                             <input id="join" name="join" class="form-control" type="text" value="<?php echo $data->date_join?>" autocomplete="off">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div id="imagePreview">
                                               <img src="<?php echo base_url("assets/img/employe/$data->image")?>" name="signature" style="width: 150px; height: 100px"> 
                                            </div>
                                            <input id="file" type="file" class="form-control" name="userfile[]" aria-describedby="inputGroupFileAddon01" onchange="return fileValidation()">
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Signature</label>
                                            <div id="imagePreview2">
                                                <img src="<?php echo base_url("assets/img/employe/$data->signature")?>" name="signature" style="width: 150px; height: 100px"> 
                                            </div>
                                            <input id="file2" type="file" class="form-control" name="userfile[]" aria-describedby="inputGroupFileAddon01" onchange="return fileValidation2()">
                                        </div>
                                </div>
                            </div>
                            <?php }?>
                            <a href="<?php echo base_url('./employecontroller')?>" type="button" class="btn btn-fill btn-warning btn-sm pull-right">Cancel</a>
                            <button id="btn" type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#join').datetimepicker({
                closeOnDateSelect:true,
                timepicker:false,
                formatDate: 'Y-m-d',
                format : 'Y-m-d',
           });

        $('#submit').submit(function(e){
                e.preventDefault();

                  $.ajax({
                          url: '<?= base_url(); ?>EmployeController/update_data',
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
                                                   window.location.href = "../employecontroller";
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

    function fileValidation(){
      var fileInput = document.getElementById('file');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
      if(!allowedExtensions.exec(filePath)){
           alert('Please upload file having extensions .jpeg/.jpg/.png only.');
           fileInput.value = '';
           return false;
      }else{
           if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
             document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" style="width: 150px; height: 100px"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
           }
        }
    }

    function fileValidation2(){
      var fileInput = document.getElementById('file2');
      var filePath = fileInput.value;
      var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
      if(!allowedExtensions.exec(filePath)){
           alert('Please upload file having extensions .jpeg/.jpg/.png only.');
           fileInput.value = '';
           return false;
      }else{
           if (fileInput.files && fileInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
             document.getElementById('imagePreview2').innerHTML = '<img src="'+e.target.result+'" style="width: 150px; height: 100px"/>';
            };
            reader.readAsDataURL(fileInput.files[0]);
           }
        }
    }
</script>