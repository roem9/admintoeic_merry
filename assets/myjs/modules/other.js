// class rupiah untuk format rupiah 
$(document).on("keyup", ".rupiah", function(){
    $(this).val(formatRupiah(this.value, 'Rp. '))
})

// format rupiah 
function formatRupiah(angka, prefix){
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split   		= number_string.split(','),
    sisa     		= split[0].length % 3,
    rupiah     		= split[0].substr(0, sisa),
    ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
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

// option untuk list kecamatan 
function list_kecamatan(){
    data = ajax(url_base+"/toko/get_all_kecamatan", "POST", "");

    html = `<option value="">Pilih Kecamatan</option>`;

    if(data.length != 0){
        data.forEach(data => {
            html += `<option value="`+data.kecamatan+`">`+data.kecamatan+`</option>`;
        });
    }
    
    html += `<option value="Lainnya">Lainnya</option>`;
    $("#kecamatan_add").html(html);
    $("#kecamatan_edit").html(html);
}

// function required
function required(form){
    let eror = 0;
    // $.each($(form+" input.required, "+form+" select.required"), function(){
    $.each($(form+" .required"), function(){
        if($(this).val() == "") {
            eror = 1
            // console.log($(this).attr("name"))
        }
    })

    return eror;
}

function activeMenu(menu){
    $("a #"+menu).addClass("active")
}

function moveUp(item) {
    var prev = item.prev();
    if (prev.length == 0)
      return;
    prev.css('z-index', 999).css('position', 'relative').animate({
      top: item.height()
    }, 250);
    item.css('z-index', 1000).css('position', 'relative').animate({
      top: '-' + prev.height()
    }, 300, function() {
      prev.css('z-index', '').css('top', '').css('position', '');
      item.css('z-index', '').css('top', '').css('position', '');
      item.insertBefore(prev);
    });

    $("#saveButton").addClass("text-danger");
}
  
function moveDown(item) {
    var next = item.next();
    if (next.length == 0)
      return;
    next.css('z-index', 999).css('position', 'relative').animate({
      top: '-' + item.height()
    }, 250);
    item.css('z-index', 1000).css('position', 'relative').animate({
      top: next.height()
    }, 300, function() {
      next.css('z-index', '').css('top', '').css('position', '');
      item.css('z-index', '').css('top', '').css('position', '');
      item.insertAfter(next);
    });

    $("#saveButton").addClass("text-danger");
}
  
$(".FieldContainer").sortable({
    items: ".OrderingField",
    distance: 10
});

$(document).on('click', 'button', function() {
    var btn = $(this);
    var val = btn.val();
    if (val == 'up')
      moveUp(btn.parents('.OrderingField'));
    else if(val == 'down')
      moveDown(btn.parents('.OrderingField'));
});