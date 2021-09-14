// ketika menekan tombol edit audio 
$(document).on("click",".editAudio", function(){
    let form = "#editAudio";
    let id_audio = $(this).data("id");
    let data = {id_audio: id_audio};
    let result = ajax(url_base+"audio/get_audio", "POST", data);
    
    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })
})

// ketika menyimpan hasil edit audio 
$("#editAudio .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data audio?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#editAudio";
            
            formData = {};
            $(form+" .form").each(function(index){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            let eror = required(form);
            
            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let result = ajax(url_base+"audio/edit_audio", "POST", formData);

                if(result == 1){
                    loadData()

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data audio',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, silahkan refresh page'
                    })
                }
            }
        }
    })
})

// ketika menghapus data audio 
$(document).on("click", ".hapusAudio", function(){
    let id_audio = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus data audio ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_audio: id_audio}
            let result = ajax(url_base+"audio/delete_audio", "POST", data);

            if(result == 1){
                loadData()

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus data audio',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, silahkan refresh page'
                })
            }
        }
    })
})

$("#addAudio .btnTambah").click(function(){
    let form = "#addAudio";

    var fd = new FormData();
    var files = $('#file')[0].files;
    
    // Check file selected or not
    if(files.length > 0 ){
        Swal.fire({
            icon: 'question',
            text: 'Yakin akan menambahkan audio baru?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then(function (result) {
            if (result.value) {
                fd.append('file',files[0]);
                fd.append('nama_audio', $(form+" input[name='nama_audio']").val())

                let eror = required(form);
            
                if( eror == 1){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'lengkapi isi form terlebih dahulu'
                    })
                } else {
                    $.ajax({
                        url: url_base+'audio/upload_data',
                        type: 'post',
                        //   data: {fd, nama_audio:nama_audio},
                        data: fd,
                        contentType: false,
                        processData: false,
                        success: function(response){

                            if(response == 1){
                                
                                $(form+" .myform").trigger("reset");
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    text: 'Berhasil mengupload file',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else if(response == 2){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    text: 'Gagal mengupload file. Format file harus mp3',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            } else if(response == 0){
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    text: 'terjadi kesalahan, silahkan refresh page',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }

                            loadData()

                        },
                    });
                }
            }
        })
    }else{
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: 'Pilih file terlebih dahulu',
            showConfirmButton: false,
            timer: 1500
        })
    }
});

