// tambah tes baru
$("#addTes .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan tes baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#addTes";

            let formData = {};
            $(form+" .form").each(function(){
                formData = Object.assign(formData, {[$(this).attr("name")]: $(this).val()})
            })

            // table 
            formData = Object.assign(formData, {status: "Berjalan"});

            let eror = required(form);
            
            if( eror == 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'lengkapi isi form terlebih dahulu'
                })
            } else {
                let msg = CKEDITOR.instances['form-text-add'].getData();
                Object.assign(formData, {'msg': msg})

                data = formData;
                let result = ajax(url_base+"tes/add_tes", "POST", data);

                if(result == 1){
                    loadData();
                    $("#formAddTes").trigger("reset");
                    $(form).modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data tes',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, ulangi input tes'
                    })
                }
            }
        }
    })
})

// get data tes ketika edit
$(document).on("click",".editTes", function(){
    let form = "#editTes";
    let id_tes = $(this).data("id");

    console.log(id_tes);

    let data = {id_tes: id_tes};
    let result = ajax(url_base+"tes/get_tes", "POST", data);
    
    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value)
    })

    CKEDITOR.instances['form-text-edit'].setData(result.msg)
})

// menyimpan hasil edit data
$("#editTes .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data tes?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#editTes";
            
            let formData = {};
            $(form+" .form").each(function(){
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
                let soal = CKEDITOR.instances['form-text-edit'].getData();
                Object.assign(formData, {'msg': soal})

                data = formData;
                let result = ajax(url_base+"tes/edit_tes", "POST", data);

                if(result == 1){
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data tes',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan'
                    })
                }
            }
        }
    })
})

// menghapus tes
$(document).on("click", ".hapusTes", function(){
    let id_tes = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus data tes ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_tes: id_tes}
            let result = ajax(url_base+"tes/hapus_tes", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus data tes',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, gagal menghapus data tes'
                })
            }
        }
    })
})

// mengubah status tes 
$(document).on("click", "input[name='id_tes']", function(){
    let id_tes = $(this).val();
    if($(this).is(":checked")) data = {id_tes:id_tes, status:'Berjalan'}
    else if($(this).is(":not(:checked)")) data = {id_tes:id_tes, status:'Selesai'}

    let result = ajax(url_base+"tes/change_status", "POST", data);
    loadData();
})

// Clipboard
var clipboard = new ClipboardJS('.copy');

clipboard.on('success', function(e) {
    Swal.fire({
        icon: "success",
        text: "Berhasil menyalin link",
        showConfirmButton: false,
        timer: 1500
    })
});