// ketika menekan tombol simpan pada modal tambah soal 
$("#addSoal .btnTambah").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan soal baru?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#addSoal";
            let formData = {};
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
                // data = {nama_soal: nama_soal, tgl_pembuatan: tgl_pembuatan, catatan: catatan}
                let result = ajax(url_base+"soal/add_soal", "POST", formData);

                if(result == 1){
                    loadData();
                    $("#formAddSoal").trigger("reset");
                    $(form).modal("hide");

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil menambahkan data soal',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'terjadi kesalahan, ulangi input soal'
                    })
                }
            }
        }
    })
})

// ketika menekan tombol edit soal 
$(document).on("click",".editSoal", function(){
    let form = "#editSoal";
    let id_soal = $(this).data("id");
    let data = {id_soal: id_soal};
    let result = ajax(url_base+"soal/get_soal", "POST", data);
    
    $.each(result, function(key, value){
        $(form+" [name='"+key+"']").val(value);
    })

    if(result.tipe_soal == "Latihan"){
        $("[name='poin']").prop("disabled", false);
    } else {
        $("[name='poin']").prop("disabled", true);
        $("[name='poin']").val("")
    }
})

// ketika menyimpan hasil edit soal 
$("#editSoal .btnEdit").click(function(){
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan mengubah data soal?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = "#editSoal";

            let formData = {};
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
                let result = ajax(url_base+"soal/edit_soal", "POST", formData);

                if(result == 1){
                    loadData();

                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: 'Berhasil mengubah data soal',
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

// ketika menghapus data soal 
$(document).on("click", ".hapusSoal", function(){
    let id_soal = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus data soal ini?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            data = {id_soal: id_soal}
            let result = ajax(url_base+"soal/hapus_soal", "POST", data);

            if(result == 1){
                loadData();

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    text: 'Berhasil menghapus data soal',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'terjadi kesalahan, gagal menghapus data soal'
                })
            }
        }
    })
})

// klik tombol tambah sesi 
$(document).on("click", ".komponenSoal", function(){
    let id = $(this).data("id");

    $("#komponenSoal [name='id_soal']").val(id);
    detailSubSoal(id)
})

function detailSubSoal(id) {
    let result = ajax(url_base+"soal/get_sesi_soal/"+id, "POST", "");
    // console.log(result);
    let sesi = "";
    if(result.length != 0){
        num = 1;
        result.forEach(function(dataSesi){
            sesi += `<li class="list-group-item d-flex justify-content-between">
                    `+num+`. `+dataSesi.nama_sub+`
                    <a href="javascript:void(0)" class="deleteSesi" data-id="`+dataSesi.id+`">
                        <svg width="24" height="24" class="text-danger">
                            <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-trash" />
                        </svg> 
                    </a>
                </li>`
            num++;
        })
    } else {
        sesi += `
        <div class="alert alert-important alert-warning alert-dismissible" role="alert">
            <div class="d-flex">
                <svg width="24" height="24" class="me-1">
                    <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-alert-circle" />
                </svg> 
                <div>
                    Sesi kosong
                </div>
            </div>
        </div>`
    }

    $("#sesiSoal").html(sesi);
}

// ketika menambahkan sub soal 
$("#komponenSoal .btnTambah").click(function(){
    let form = "#komponenSoal";
    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menambahkan sub soal?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function(result){
        if(result.value){
            let formData = {};
            $(form+" .form").each(function(){
                formData = Object.assign(formData, {[$(this).attr('name')]: $(this).val()})
            })

            let eror = required(form);
            if(eror == 1){
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: "lengkapi isi form terlebih dahulu",
                })
            } else {

                let result = ajax(url_base+"soal/add_sesi_soal", "POST", formData);

                if(result == 1){
                    
                    id_soal = $("#komponenSoal [name='id_soal']").val();
                    detailSubSoal(id_soal)

                    $("#formKomponenSoal").trigger("reset");
                    Swal.fire({
                        icon: "success",
                        text: "Berhasil menambahkan sub soal",
                        showConfirmButton: false,
                        timer: 1500
                    })
                    
                    loadData()

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

// delete sesi 
$(document).on("click", ".deleteSesi", function(){
    let id = $(this).data("id");

    Swal.fire({
        icon: 'question',
        text: 'Yakin akan menghapus sesi soal?',
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function(result){
        if(result.value){
            data = {id:id};
            let result = ajax(url_base+`soal/hapus_sesi`, "POST", data);
            if(result == 1){
                loadData();
                
                id_soal = $("#komponenSoal [name='id_soal']").val();
                detailSubSoal(id_soal)

                Swal.fire({
                    icon: "success",
                    text: "Berhasil menghapus data",
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

$("[name='tipe_soal']").change(function() {
    $("[name='poin']").val("");

    if($(this).val() == "Latihan"){
        $("[name='poin']").prop("disabled", false);
        $("[name='poin']").addClass("required");
    } else {
        $("[name='poin']").prop("disabled", true);
        $("[name='poin']").removeClass("required");
    }
    
})