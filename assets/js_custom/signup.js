$(document).ready(function(){
	    $('.nip').select2();
        $('.nip').change(function(){

            var nip = $('.nip').val();
        
                $.ajax({
                        url: "SignupController/get_employe",
                        async: false,
                        type: "POST",
                        data: {nip:nip},
                        dataType: "html",
                        success: function(r) {
                            var r = JSON.parse(r);
                            var obj = r.ada;

                            document.getElementById('name').value = obj.name_employe;
                            document.getElementById('position').value = obj.name_level;
                            document.getElementById('division').value = obj.name_division;
                            document.getElementById('join').value = obj.date_join;
                            document.getElementById('branch').value = obj.name_branch;
                            document.getElementById('level').value = obj.id_level;
                            document.getElementById('lvl').value = obj.name_level;
                    }
                });
            });

    $('#submit').submit(function(e){
            e.preventDefault();

              $.ajax({
                      url: 'SignupController/add_data',
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
                                               window.location.href = "login";
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
    })