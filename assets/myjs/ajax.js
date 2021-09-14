// load data for mobile 
function loadDataMobile(pagno, url){
    // console.log(table)
    let search = $("input[name='search']").val();
    let data = {search:search};
    // let result = ajax(url_base+"marketing/loadLacMobile/"+pagno, "POST", data);
    let result = ajax(url_base+url+pagno, "POST", data);
    
    if(result.total_rows != 0) {
        
        if(result.total_rows_perpage != 0){
            
            $('#pagination').html(result.pagination);
            createTable(result.result,result.row);

        } else {
            page = pagno - 1;
            let result = ajax(url_base+url+page, "POST", "");

            $('#pagination').html(result.pagination);
            createTable(result.result,result.row);
        }

    } else {
        html = `
        <div class="d-flex flex-column justify-content-center">
            <div class="empty">
                <div class="empty-img"><img src="`+url_base+`assets/static/illustrations/undraw_printing_invoices_5r4r.svg" height="128"  alt="">
                </div>
                <p class="empty-title">Data kosong</p>
            </div>
        </div>`;
        
        $('#pagination').html("");
        $("#dataAjax").html(html);
    }
    
    $("#skeleton").hide()
}

// input data 
function inputData(data) {
    Swal.fire({
        icon: 'question',
        text: data.confirm,
        showCloseButton: true,
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
    }).then(function (result) {
        if (result.value) {
            let form = data.form;
            
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
                let result = ajax(url_base+data.url, "POST", formData);

                if(result == 1){
                    loadData();
                    
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        text: data.success,
                        showConfirmButton: false,
                        timer: 1500
                    })

                    $(data.form+" form").trigger("reset");
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
}

// ajax function 
function ajax(url, method, data){
    var result = "";
    $.ajax({
        // option nama dan option sumber 
        url: url,
        method: method,
        data: data,
        dataType: "JSON",
        async: false, 
        success: function(data){
            result = data;
        }
    })

    return result;
}