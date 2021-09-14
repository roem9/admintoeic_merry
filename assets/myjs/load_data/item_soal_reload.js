load_item(id);

function load_item(id){
    let data = {id_sub: id};

    let result = ajax(url_base+"subsoal/get_all_item_soal", "POST", data);

    html = ""
    // result = 1;
    if(result.item.length != 0) {
        result.item.forEach(data => {
            if(data.item == "soal"){
                
                if(data.penulisan == "RTL"){
                    soal = `<div dir="rtl" class="mb-3">`+data.data.soal+`</div>`
                    // jawaban = `<div dir="rtl" class="mb-3 text-danger">`+data.data.jawaban+`</div>`
                    pilihan = "";
                    data.data.pilihan.forEach(data_pilihan => {
                        if(data_pilihan == data.data.jawaban) checked = "checked";
                        else checked = "disabled"
                        pilihan += `
                            <div class="mb-3">
                                <div class="form-check">
                                    <div class="text-right" dir="rtl">
                                        <label>
                                            <input type="radio" `+checked+`>
                                            `+data_pilihan+`
                                        </label>
                                    </div>
                                </div>
                            </div>`
                    });
    
                    // item = soal+pilihan+jawaban;
                    item = soal+pilihan;
                } else {
                    soal = `<div class="mb-3">`+data.data.soal+`</div>`
                    // jawaban = `<div class="mb-3 text-danger">`+data.data.jawaban+`</div>`
                    pilihan = "";
                    data.data.pilihan.forEach(data_pilihan => {
                        if(data_pilihan == data.data.jawaban) checked = "checked";
                        else checked = "disabled"
                        pilihan += `
                            <div class="mb-3">
                                <div class="form-check p-0">
                                    <label>
                                        <input type="radio" `+checked+`>
                                        `+data_pilihan+`
                                    </label>
                                </div>
                            </div>`
                    });
                    // item = soal+pilihan+jawaban;
                    item = soal+pilihan;
                }

            } else if(data.item == "petunjuk"){

                if(data.penulisan == "RTL"){
                    item = `<div dir="rtl" class="mb-3">`+data.data+`</div>`
                } else {
                    item = `<div dir="ltr" class="mb-3">`+data.data+`</div>`
                }

            }
            else if(data.item == "audio"){

                item = `<center><audio controls controlsList="nodownload"><source src="`+url_base+`assets/myaudio/`+data.data+`?t=`+Math.random()+`" type='audio/mpeg'></audio></center>`

            } else if(data.item == "gambar"){

                item = `<img src="`+url_base+`assets/myimg/`+data.data+`?t=`+Math.random()+`" onerror="this.onerror=null; this.src='`+url_base+`assets/tabler-icons-1.39.1/icons/x.svg'" class="card-img-top" width=100%>`

            }

            if(data.item == 'audio' || data.item == 'gambar'){
                edit = '';
            } else {
                edit = `
                <a class="dropdown-item editItem" href="#editItem" data-bs-toggle="modal" data-id="`+data.id_item+`">
                    `+icon("me-1", "edit")+`
                    Edit
                </a>
                <div class="dropdown-divider"></div>
                `
            }

            html += `
            <div class="OrderingField">
                <div class="card mb-3">
                    <div class="card-body">

                        <input type="hidden" name="id_item" value="`+data.id_item+`">
                        
                        `+item+`
    
                    </div>
                    <div class="RightFloat Commands d-flex justify-content-between mb-3">
                        <div>
                        </div>
                        <div>
                            <button value='up' class="btn btn-sm btn-success me-3">
                                <svg width="24" height="24">
                                    <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-big-top" />
                                </svg>
                            </button>
                            <button value='down' class="btn btn-sm btn-success">
                                <svg width="24" height="24">
                                    <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-arrow-big-down" />
                                </svg> 
                            </button>
                        </div>
                        <div class="me-3">
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <svg width="24" height="24">
                                    <use xlink:href="`+url_base+`assets/tabler-icons-1.39.1/tabler-sprite.svg#tabler-settings" />
                                </svg>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                `+edit+`
                                <a class="dropdown-item hapusItem" href="javascript:void(0)" data-id="`+data.id_item+`">
                                    `+icon("me-1", "trash")+`
                                    Hapus
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`

        })

    } else {
        html = `
        <div class="d-flex flex-column justify-content-center">
            <div class="empty">
                <div class="empty-img"><img src="`+url_base+`assets/static/illustrations/undraw_printing_invoices_5r4r.svg" height="128"  alt="">
                </div>
                <p class="empty-title">Data kosong</p>
                <p class="empty-subtitle text-muted">
                    Silahkan tambahkan data
                </p>
            </div>
        </div>`;

    }

    $("#dataAjax").html(html);
}
