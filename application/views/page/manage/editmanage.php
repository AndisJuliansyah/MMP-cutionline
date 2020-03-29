<style type="text/css">
.switch {
  position: absolute;
  display: inline-block;
  width: 55px;
  height: 28px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 23px;
  width: 26px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

.slider.round {
  border-radius: 15px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                Form Edit Akses
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                    <tr>
                      <th>Menu</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                  <form id="submit">
                    <?php 
                    $a = array();
                    foreach($access as $data2){
                        array_push($a, $data2->id_menus);
                    }
                            $menus = $this->mmp_lib->Menu();
                            foreach($menus as $data)
                        {
                            if(in_array($data->id_menus, $a)){
                                echo '<tr>
                                      <td>'.$data->n_menus.'</td>
                                      <td>
                                      <label class="switch">
                                        <input type="checkbox" name="ceklis[]" value="'.$data->id_menus.'" checked>
                                        <span class="slider round"></span>
                                      </label>
                                        <input type="hidden" class="form-control" name="id_menus[]" value="'.$data->id_menus.'">
                                        <input type="hidden" class="form-control" name="id_user" value="'.$this->uri->segment(3).'">
                                      </td>
                                      </tr>';
                            }else{
                                echo '<tr><td>'.$data->n_menus.'</td>
                                      <td>
                                      <label class="switch">
                                        <input type="checkbox" name="ceklis[]" value="'.$data->id_menus.'">
                                        <span class="slider round"></span>
                                      </label>
                                        <input type="hidden" class="form-control" name="id_menus[]" value="'.$data->id_menus.'">
                                        <input type="hidden" class="form-control" name="id_user" value="'.$this->uri->segment(3).'">
                                      </td>
                                      </tr>
                                      </tr>';
                            } 
                        } 
                     ?>
                  </tbody>
                </table>
              </div>
                <a href="<?php echo base_url('manageController')?>" type="button" class="btn btn-fill btn-warning btn-sm pull-right">Cancel</a>
                <button id="btn" type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">Submit</button>
            </div>
        </form>
      
    </div>
</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {

        $('#submit').submit(function(e){
                e.preventDefault();

                  $.ajax({
                          url: '<?= base_url(); ?>managecontroller/saveaccess',
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
                                                   window.location.href = "../managecontroller";
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