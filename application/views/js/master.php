<script type="text/javascript">

	 $(document).ready(function(){
    
     $(".generet").attr("disabled", "disabled");
      var tdate = new Date();
      var dd = tdate.getDate();
      var MM = tdate.getMonth()+1;

      var compilation = dd+'-'+MM;

      if(compilation == '31-12'){
        $(".generet").attr('disabled', false);
      }

    $('#dataTables-example').dataTable({
               "bPaginate": true,
                "iDisplayLength": 10,
                "bSort": false,
                "bInfo": false,
                "bAutoWidth": false,
                "searching": false,
                "bLengthChange": false
            });

    $('#dataTables-example2').dataTable({
               "bPaginate": true,
                "iDisplayLength": 10,
                "bSort": false,
                "bInfo": false,
                "bAutoWidth": false,
                "searching": false,
                "bLengthChange": false
            });

	 	$('#date').datetimepicker({
                closeOnDateSelect:true,
                timepicker:false,
                formatDate: 'Y-m-d',
                format : 'Y-m-d',
           });
	
		$('#date2').datetimepicker({
                closeOnDateSelect:true,
                timepicker:false,
                formatDate: 'Y-m-d',
                format : 'Y-m-d',
           });

        $('.deletediv').click(function(){
            var id = $(this).data('id');
           
            swal({
                  title: 'Yakin Ingin Hapus Data!',
                  text: "Data Tak Bisa Dikembalikan?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Hapus data!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>MasterController/delete_divisi",
                                method: "POST",
                                data: {id:id},
                                success: function(data){
                                    if (data == 'ok') {
                                      swal({title: "Hapus Data", text: "Data Berhasil Dihapus!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
                                               }
                                            );
                                      }else{
                                           swal({title: "Hapus Data", text: "Gagal Hapus Data!!", type: 
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

        $('.editdiv').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/edit_divisi',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Edit Data", text: "Data Berhasil Diedit!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        $('#adddiv').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/add_divisi',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Simpan Data", text: "Data Berhasil Disimpan!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        $('.editjmlcuti').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/edit_jmlcuti',
                      method: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Edit Data", text: "Data Berhasil Diedit!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        $('.deletebranch').click(function(){
            var id = $(this).data('id');
           
            swal({
                  title: 'Yakin Ingin Hapus Data!',
                  text: "Data Tak Bisa Dikembalikan?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Hapus data!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>MasterController/delete_branch",
                                method: "POST",
                                data: {id:id},
                                success: function(data){
                                    if (data == 'ok') {
                                      swal({title: "Hapus Data", text: "Data Berhasil Dihapus!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
                                               }
                                            );
                                      }else{
                                           swal({title: "Hapus Data", text: "Gagal Hapus Data!!", type: 
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

        $('.editbranch').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/edit_branch',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Edit Data", text: "Data Berhasil Diedit!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        $('#addbranch').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/add_branch',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Simpan Data", text: "Data Berhasil Disimpan!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        $('.editsub').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/edit_subjenis',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Edit Data", text: "Data Berhasil Diedit!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        $('.deletedate').click(function(){
            var id = $(this).data('id');
           
            swal({
                  title: 'Yakin Ingin Hapus Data!',
                  text: "Data Tak Bisa Dikembalikan?",
                  type: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Hapus data!'
                }).then(function(json_data) {
                      $.ajax({
                                url: "<?= base_url(); ?>MasterController/delete_date",
                                method: "POST",
                                data: {id:id},
                                success: function(data){
                                    if (data == 'ok') {
                                      swal({title: "Hapus Data", text: "Data Berhasil Dihapus!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
                                               }
                                            );
                                      }else{
                                           swal({title: "Hapus Data", text: "Gagal Hapus Data!!", type: 
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

        $('.editdate').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/edit_date',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Edit Data", text: "Data Berhasil Diedit!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        $('#adddate').submit(function(e){
            e.preventDefault();
              $.ajax({
                      url: '<?= base_url(); ?>MasterController/add_date',
                      type: "POST",
                      data : new FormData(this),
                      processData: false,
                      contentType:false,
                      cache:false,
                      async: false,
                      success: function(data) {
                        setTimeout(function(){
                          if (data == 'ok') {
                                swal({title: "Simpan Data", text: "Data Berhasil Disimpan!", type: 
                                            "success"}).then(function(){ 
                                               window.location.href = "MasterController";
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

        // $('.generet').click(function(){
           
        //     swal({
        //           title: 'Yakin Ingin Backup Sisa Cuti Tahunan!',
        //           text: "Data Tak Bisa Dikembalikan?",
        //           type: 'warning',
        //           showCancelButton: true,
        //           confirmButtonColor: '#3085d6',
        //           cancelButtonColor: '#d33',
        //           confirmButtonText: 'Yes, Backup data!'
        //         }).then(function(json_data) {
        //               $.ajax({
        //                         url: "<?= base_url(); ?>MasterController/bc_data",
        //                         method: "POST",
        //                         data: '',
        //                         success: function(data){
        //                             if (data == 'ok') {
        //                               swal({title: "Backup Data", text: "Data Berhasil Dihapus!", type: 
        //                                     "success"}).then(function(){ 
        //                                        window.location.href = "MasterController";
        //                                        }
        //                                     );
        //                               }else{
        //                                    swal({title: "Backup Data", text: "Gagal Backup Data!!", type: 
        //                                     "error"}).then(function(){ 
        //                                        location.reload();
        //                                        }
        //                                     );
        //                               }
        //                             }
        //                     });
        //             }, function(dismiss) {
        //               if (dismiss === 'cancel' || dismiss === 'close') {
        //                 // ignore
        //               } 
        //             })
        // });
    });
</script>