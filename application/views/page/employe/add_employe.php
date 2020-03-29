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
                                            <input class="form-control" type="text" name="nip" autocomplete="off" required>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Karyawan</label>
                                            <input class="form-control" type="text" name="name" autocomplete="off" required>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <select class="form-control" name="position">
                                            <option>-- Select Data --</option>
                                            <?php foreach($position as $posisi){?>
                                                <option value="<?php echo $posisi->id_level?>"><?php echo $posisi->name_level?></option>
                                            <?php }?>
                                        </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Division</label>
                                            <select class="form-control" name="division">
                                            <option>-- Select Data --</option>
                                            <?php foreach($division as $divisi){?>
                                                <option value="<?php echo $divisi->id_div?>"><?php echo $divisi->name_division?></option>
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
                                                <option>-- Select Data --</option>
                                                <?php foreach($branch as $cabang){?>
                                                <option value="<?php echo $cabang->id_branch?>"><?php echo $cabang->name_branch?></option>
                                            <?php }?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Join</label>
                                             <input id="join" name="join" class="form-control" type="text" autocomplete="off">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div id="imagePreview">
                                            </div><br>
                                            <input id="file" type="file" class="form-control" name="userfile[]" aria-describedby="inputGroupFileAddon01" onchange="return fileValidation()" required>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Signature</label>
                                            <div id="imagePreview2">
                                            </div><br>
                                            <input id="file2" type="file" class="form-control" name="userfile[]" aria-describedby="inputGroupFileAddon01" onchange="return fileValidation2()" required>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Total Cuti</label>
                                            <input class="form-control" type="text" name="total" autocomplete="off" required>
                                        </div>
                                </div>
                            </div>
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
                          url: '<?= base_url(); ?>EmployeController/add_data',
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
                                                   window.location.href = "../EmployeController";
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