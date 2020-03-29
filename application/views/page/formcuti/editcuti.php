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
                                            <input class="form-control" type="hidden" name="code" value="<?php //$code; ?>">
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
                                            <input class="form-control" type="text" name="sisa" value="<?php echo $data->sisa_cuti;?>"readonly>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Signature</label>
                                            <div>
                                                <img src="<?php echo base_url("assets/img/$data->signature")?>" name="signature" style="width: 150px; height: 100px">
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
                                            <input id="idc" class="form-control" type="hidden">
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
                                <?php 
                                foreach($jenis_kete as $get){?>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Jenis Cuti</label>
                                            <input name="nocuti" class="form-control no" type="hidden" value="<?php echo $get->no_cuti;?>">
                                            <select class="form-control" id="jenis" name="jenis_cuti">
                                                <option value="0">-- Select --</option>
                                                <?php foreach ($jenis as $key) {?>
                                                    <option value="<?php echo $key->id_jenis;?>" <?php if($key->id_jenis == $get->jenis_cuti){ echo 'selected';} ?>><?php echo $key->name_cuti;?></option>
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
                                                <option value="0">-- Select --</option>
                                                <?php foreach ($subjenis as $sub) {?>
                                                    <option value="<?php echo $sub->id_subjenis;?>" <?php if($sub->id_subjenis == $get->subjenis){ echo 'selected';} ?>><?php echo $sub->name_subjenis;?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                             <textarea id="keterangan" name="keterangan" class="form-control" rows="3"><?php echo $get->keterangan;?></textarea>
                                             <input id="codecuti" class="form-control" type="hidden" name="code" value="<?php echo $get->no_cuti; ?>">
                                        </div>
                                </div>
                                <?php }?>
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
                                                <?php foreach($cek_data as $eddata){?>
                                                <input type="text" id="jml" style="border:none; margin:0;" value="<?php echo $eddata->total_cuti?>" name="jml" readonly>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                    <?php //}?>
                                </table>
                            </div>
                            <a href="<?php echo base_url('pengajuancontroller')?>" type="button" class="btn btn-fill btn-warning btn-sm pull-right">Cancel</a>
                            <button type="submit" class="btn btn-primary btn-sm pull-right" style="margin-right: 5px">Submit</button>
                        </div>
                    </div>
                </div>

            </div>
</form>

<script src="<?php echo base_url('assets/plugins/jquery-1.10.2.js');?>"></script>

<script>
    $(document).ready(function(){

        var cd = $('#codecuti').val();    
        var url = '<?php echo base_url('cuticontroller/delete')?>';

        $.ajax({
                type  : 'POST',
                url   : '<?php echo base_url()?>cuticontroller/datacuti',
                data  : 'data='+cd,
                async : false,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                                    '<td>'+
                                        '<input id="idct" type="hidden" value="'+data[i].id_cuti+'" name="id_cuti[]" style="border:none; margin:0;">'+
                                        '<input id="str" type="text" value="'+data[i].datestart+'" name="start[]" style="border:none; margin:0;">'+
                                    '</td>'+
                                    '<td>'+
                                        '<input id="str2" type="text" value="'+data[i].dateend+'" name="finish[]" style="border:none; margin:0;">'+
                                    '</td>'+
                                    '<td>'+
                                        '<input id="total" type="text" value="'+data[i].total_cuti+'" name="jumlah[]" style="border:none; margin:0;">'+
                                    '</td>'+
                                    '<td>'+
                                        '<button onClick="deleteRow(this)" data-in="'+data[i].total_cuti+'" class="btn btn-success btn-sm tbl" data-id="'+data[i].datestart+'" data-on="'+data[i].dateend+'" data-idd="'+data[i].id_cuti+'">Edit</button>'+
                                        '<a class="btn btn-primary btn-sm del" data-id="'+data[i].id_cuti+'">Delete</a>'+

                                    '</td>'+
                                '<tr>';
                    }

                    $('#table_pengguna').html(html);
                }
            });

            $('.tbl').click(function(){

                var det = document.getElementById('dts');
                var selisih =document.getElementById('dtf');
                var jumlah =document.getElementById('selisih');
                var id =document.getElementById('idc');

                var myBookId = $(this).data('id');
                var myBookId2 = $(this).data('on');
                var total = $(this).data('in');
                var idc = $(this).data('idd');

                det.value = myBookId;
                selisih.value = myBookId2;
                jumlah.value = total;
                id.value = idc;
            });

            $('#submit').submit(function(e){
                e.preventDefault();
                  $.ajax({
                          url: '<?= base_url(); ?>cutiController/update',
                          type: "POST",
                          data : new FormData(this),
                          processData: false,
                          contentType:false,
                          cache:false,
                          async: false,
                          success: function(data) {
                            setTimeout(function(){
                              if (data == 'ok') {
                                    swal({title: "Edit Data", text: "Berhasil Edit!", type: 
                                                "success"}).then(function(){ 
                                                   window.location.href = "../../PengajuanController";
                                                   }
                                                );
                              }else{
                                    swal({title: "Edit Data", text: "Data Gagal Edit!!", type: 
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



        $(document).on('click','.del', function(){

            var no = $(this).attr('data-id');
            var total_day = $('#total').val();
            var nocuti = $('.no').val();

                swal({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>CutiController/delete_detail",
                                method: "POST",
                                data: {id:no, total:total_day, no:nocuti},
                                success: function(data){
                                    if (data == 'ok') {
                                        swal({title: "Hapus Data", text: "Berhasil Dihapus", type: 
                                                "success"}).then(function(){ 
                                                   window.location.href = 'CutiController/edit/'+nocuti;
                                                   }
                                                );
                                        
                                      }else{
                                             swal({title: "Hapus Data", text: "Data Gagal Dihapus!!", type: 
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

var t = [];
function tambah_pengguna()
{
    var start = $('#dts').val();
    var finish = $('#dtf').val();
    var jml = $('#selisih').val();
    var id = $('#idc').val();
    


            var markup1 = '<tr>';
            var markup2 = '<td style="text-align:center; width:5%; padding:0">';
            var markup3 = '<input id="str" type="text" value="'+start+'" name="startad[]" style="border:none; margin:0;"><input type="hidden" value="'+id+'" name="id_cut[]">';
            var markup4 = '</td>';
            var markup5 = '<td style="text-align:center; width:5%; padding:0">';
            var markup6 = '<input id="fns" type="text" value="'+finish+'" name="finishad[]" style="border:none; margin:0;">';
            var markup7 = '</td>';
            var markup8 = '<td style="text-align:center; width:5%; padding:0">';
            var markup9 = '<input id="total" type="text" value="'+jml+'" name="jumlahad[]" style="border:none; margin:0;">';
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
            var jumlah = document.querySelectorAll("#dataTables-example input[name='jumlah[]']");
            var jumlah2 = document.querySelectorAll("#dataTables-example input[name='jumlahad[]']");
            var sum = $('#jml').val();

            t.push(selisih.value);
            var a =0;
            var b =0;
            
                for(i=0; i<jumlah.length; i++){
                    b = parseInt(b) + parseInt(jumlah[i].value);
                        
                    }
                    
               for(i=0; i<jumlah2.length; i++){
                    a = parseInt(a) + parseInt(jumlah2[i].value);
                        
                    }

                    
                 det.value = parseInt(a) + parseInt(b);
                
                 
            
             resetForm1();
             
        }
        
        

        function deleteRow(btn) 
        {
             var row = btn.parentNode.parentNode;
                row.parentNode.removeChild(row);
     
                var jumlah = document.querySelectorAll("#dataTables-example input[name='jumlah[]']");
                var jumlah2 = document.querySelectorAll("#dataTables-example input[name='jumlahad[]']");
                
                var itung = 0;
                var itung2 = 0;
                for(i=0;i<jumlah2.length;i++)
                {
                        itung2 = parseInt(itung2) + parseInt(jumlah2[i].value);
                }

                for(i=0;i<jumlah.length;i++)
                {
                        itung = parseInt(itung) + parseInt(jumlah[i].value);
                }

                
                t = [];
                t.push(parseInt(itung2)+parseInt(itung));
               
                var sum = document.getElementById('jml');
                
                sum.value =  parseInt(itung2)+parseInt(itung);
        }

        function resetForm1(){

            var id = document.getElementById('idc');

            $('.clear').find('input[type=text]').val('');
            id.value = '';
        }
    </script>
