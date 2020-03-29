<form id="submit">
<div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Data Employe
                        </div>
                        <div class="panel-body">
                            
                                <?php foreach($employe as $data){?>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>NIP</label>
                                            <input class="form-control" type="hidden" name="code" value="<?= $code; ?>">
                                            <input class="form-control" type="text" name="nip" value="<?php echo $data->nip;?>" readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Nama Karyawan</label>
                                            <input class="form-control" type="text" name="name" value="<?php echo $data->name_employe;?>"readonly>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Position</label>
                                            <input class="form-control" type="text" name="position" value="<?php echo $data->name_level;?>"readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Division</label>
                                            <input class="form-control" type="text" name="division" value="<?php echo $data->name_division;?>"readonly>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Date Join</label>
                                             <input class="form-control" type="text" name="join" value="<?php echo $data->date_join;?>"readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Total Cuti</label>
                                            <input class="form-control" type="text" name="total" value="<?php echo $data->total_cuti;?>"readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Sisa Cuti</label>
                                            <?php
                                                $sisa_new = $data->sisa_cuti;
                                                if(empty($sisa)){
                                                        $sisa_old = 0;
                                                }else{
                                                    foreach ($sisa as $key) {
                                                        $sisa_old = $key->sisa;
                                                    }
                                                }
                                                $jml = $sisa_new + $sisa_old;
                                            ?>
                                            <input class="form-control" type="text" name="sisa" value="<?php echo $jml;?>"readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Signature</label>
                                            <div>
                                                <img src="<?php echo base_url("assets/img/employe/$data->signature")?>" name="signature" style="width: 150px; height: 100px">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        <?php }?>
                        </div>
                    </div>
                </div>
            </div>
<!-- End data -->
<div class="row">
                <div class="col-lg-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Form Input Data Cuti
                        </div>
                        <div class="panel-body clear">
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Start</label>
                                            <input id="dts" class="form-control" type="text" autocomplete="off">
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Finish</label>
                                            <input id="dtf" class="form-control" type="text" name="date" autocomplete="off">
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Total Cuti</label>
                                            <input id="selisih" class="form-control" type="text" readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jenis Cuti</label>
                                            <select class="form-control" id="jenis" name="jenis_cuti">
                                                <option>-- Select --</option>
                                                <?php foreach ($jenis as $key) {?>
                                                    <option value="<?php echo $key->id_jenis;?>"><?php echo $key->name_cuti;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Sub Jenis</label>
                                            <select class="form-control" id="subjenis" name="subjenis">
                                                <option>-- Select --</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                             <textarea id="keterangan" name="keterangan" class="form-control" rows="3"></textarea>
                                        </div>
                                </div>
                                </div>
                            <button type="button" class="btn btn-primary" onClick="tambah_pengguna()">Record Data</button>
                        </div>
                    </div>
                     <!-- End Form Elements -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Records Data
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Date Early</th>
                                            <th>Date End</th>
                                            <th>Long Cuti</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_pengguna">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total Cuti</td>
                                            <td colspan="2">
                                                <input type="text" id="jml" style="border:none; margin:0;" value="0" name="jml" onfocus="this.value=''" readonly>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <a href="pengajuancontroller" type="button" class="btn btn-fill btn-warning btn-sm pull-right">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">Submit</button>
                        </div>
                    </div>

                    
                </div>
            </div>
</form>
<script src="<?php echo base_url('assets/plugins/jquery-1.10.2.js');?>"></script>

<script>

var tanggal = '';

$(function() { 

    var url = '<?php echo site_url("cutiController/get_date")?>';
            $.get(url, function(response) {
                var r = JSON.parse(response);
                
                tanggal = r.lem;

                //console.log(tanggal);
            

      $('#dts').datetimepicker({
       onGenerate:function( ct ){
       
            jQuery(this).find('.xdsoft_date.xdsoft_weekend')
            .addClass('xdsoft_disabled');
        },
            closeOnDateSelect:true,
            disabledDates: tanggal,
            minDate:'-1970/01/01',
            timepicker:false,
            formatDate: 'Y-m-d',
            format : 'Y-m-d',
       });
    
      $('#dtf').datetimepicker({
       onGenerate:function( ct ){
            jQuery(this).find('.xdsoft_date.xdsoft_weekend')
            .addClass('xdsoft_disabled');
        },
            closeOnDateSelect:true,
            disabledDates: tanggal,
            minDate:'-1970/01/01',
            timepicker:false,
            formatDate: 'Y-m-d',
            format : 'Y-m-d',

       });
      });
      
 });  

  $(document).ready(function(){
           $('#dtf').change(function(){
            var dt = $('#dts').val();
            var dt2 = $('#dtf').val();
            if(dt > dt2 || dt == ''){
                //alert(NO);
            }else{
                $.ajax({
                        url: "<?=base_url()?>CutiController/sumcuti",
                        async: false,
                        type: "POST",
                        data: {date:dt,date2:dt2},
                        dataType: "text",
                        success: function(data) {
                            $('#selisih').val(data);
                        }
                    });
            }
        });

        $('#jenis').change(function(){

            var jn = $('#jenis').val();
            if(jn == ''){
                //alert(NO);
            }else{
                $.ajax({
                        url: "<?=base_url()?>CutiController/get_subjenis",
                        async: false,
                        type: "POST",
                        data: {jenis_cuti:jn},
                        dataType: "html",
                        success: function(data) {
                            if(data =='no'){
                                $('#subjenis').prop('disabled', 'disabled');
                                $('#subjenis').html("<option>-- None Data --<option>");
                            }else{
                                $('#subjenis').prop('disabled', false);
                                $('#subjenis').html(data);
                        }
                    }
                });
            }
        });

        $('#submit').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>cutiController/add',
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
                                               window.location.href = "PengajuanController";
                                               }
                                            );
                          }else{
                                swal({title: "Simpan Data", text: "Data Sudah Ada, Gagal Disimpan!!", type: 
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

var t = [];
function tambah_pengguna()
{
    var start = $('#dts').val();
    var finish = $('#dtf').val();
    var jml = $('#selisih').val();

            var markup1 = '<tr>';
            var markup2 = '<td style="text-align:center; width:5%; padding:0">';
            var markup3 = '<input id="str" type="text" value="'+start+'" name="start[]" style="border:none; margin:0;">';
            var markup4 = '</td>';
            var markup5 = '<td style="text-align:center; width:5%; padding:0">';
            var markup6 = '<input id="fns" type="text" value="'+finish+'" name="finish[]" style="border:none; margin:0;">';
            var markup7 = '</td>';
            var markup8 = '<td style="text-align:center; width:5%; padding:0">';
            var markup9 = '<input id="total" type="text" value="'+jml+'" name="jumlah[]" style="border:none; margin:0;">';
            var markup10 = '</td>';
            var markup11 = '<td style="text-align:center; width:5%; padding:0">';
            var markup12 = '<button class="btn btn-primary btn-sm" onClick="deleteRow(this)">Delete</button>';
            var markup13 = '</td>';
            var markup14 = "</tr>";
            var markup15 ="<tr>";

            $("#table_pengguna").append(markup1+markup2+markup3+markup4+markup5+markup6+markup7+markup8+markup9+markup10+markup11+markup12+markup13+markup14);
            
            var dot = document.getElementsByName('jumlah');
            var det = document.getElementById('jml');
            var selisih =document.getElementById('selisih');
            var hps =document.getElementById('hps');
            
            t.push(selisih.value);
            var a =0;
            var b =0;

                for(i=0; i<t.length; i++){
                    a = parseInt(a) + parseInt(t[i]);
                    //hps = t;
                }
                //alert(t);
                 det.value = a;
                 // hps.value = hps;
            
             resetForm1();
             
        }
        
        function deleteRow(btn) 
        {
                t = [];
                var row = btn.parentNode.parentNode;
                row.parentNode.removeChild(row);
     
                var jumlah = document.querySelectorAll("#dataTables-example input[name='jumlah[]']");
                
                var itung = 0;
                
                for(i=0;i<jumlah.length;i++)
                {
                        itung = parseInt(itung) + parseInt(jumlah[i].value);
                }
        
                t.push(itung);
                var sum = document.getElementById('jml');
                
                sum.value = itung;
        }

        function resetForm1(){

            $('.clear').find('input:text').val('');
        }

        
        
    </script>
