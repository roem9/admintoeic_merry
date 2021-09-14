
var url = window.location.href;
var id_tes = url.substring(url.indexOf("hasil/") + 6);

if(tipe == "TOEFL" || tipe == "TOAFL"){
    var datatable = $('#dataTable').DataTable({ 
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('input.DT', function() {
                    api.search(this.value).draw();
            });
        },
        oLanguage: {
        sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": url_base+"tes/loadHasil/"+tipe+"/"+id_tes, "type": "POST"},
        columns: [
            {"data": "nama"},
            {"data": "full", render : function(data, row, iDisplayIndex){
                if(iDisplayIndex.no_doc == ""){
                    return `<a href="javascript:void(0)" class="btn btn-success addSertifikat" data-id="`+iDisplayIndex.id+`|`+iDisplayIndex.nama+`"> `+icon("me-1", "award")+` add</a>`;
                } else {
                    if(jQuery.browser.mobile == true) {
                        return data
                    } else {
                        return `<center>`+data+`</center>`;
                    }
                }
            }},
            {"data": "nilai_listening", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "nilai_structure", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "nilai_reading", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "skor", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "action", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
        ],
        order: [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        },
        "columnDefs": [
        { "searchable": false, "targets": "" },  // Disable search on first and last columns
        { "targets": [4, 5], "orderable": false},
        ],
        "rowReorder": {
            "selector": 'td:nth-child(0)'
        },
        "responsive": true,
    });
} else if(tipe == "TOEIC"){
    var datatable = $('#dataTable').DataTable({ 
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('input.DT', function() {
                    api.search(this.value).draw();
            });
        },
        oLanguage: {
        sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": url_base+"tes/loadHasil/"+tipe+"/"+id_tes, "type": "POST"},
        columns: [
            {"data": "nama"},
            {"data": "full", render : function(data, row, iDisplayIndex){
                if(iDisplayIndex.no_doc == ""){
                    return `<a href="javascript:void(0)" class="btn btn-success addSertifikatToeic" data-id="`+iDisplayIndex.id+`|`+iDisplayIndex.nama+`"> `+icon("me-1", "award")+` add</a>`;
                } else {
                    if(jQuery.browser.mobile == true) {
                        return data
                    } else {
                        return `<center>`+data+`</center>`;
                    }
                }
            }},
            {"data": "nilai_listening", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "nilai_reading", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "skor", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "action", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
        ],
        order: [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        },
        "columnDefs": [
        { "searchable": false, "targets": "" },  // Disable search on first and last columns
        { "targets": [4, 5], "orderable": false},
        ],
        "rowReorder": {
            "selector": 'td:nth-child(0)'
        },
        "responsive": true,
    });
} else {
    var datatable = $('#dataTable').DataTable({ 
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('input.DT', function() {
                    api.search(this.value).draw();
            });
        },
        oLanguage: {
        sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": url_base+"tes/loadHasil/"+tipe+"/"+id_tes, "type": "POST"},
        columns: [
            {"data": "nama"},
            {"data": "email"},
            {"data": "nilai", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
            {"data": "skor", render : function (data) {
                if(jQuery.browser.mobile == true) return data
                else return "<center>"+data+"</center>"
            }},
        ],
        order: [[1, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            $('td:eq(0)', row).html();
        },
        "columnDefs": [
        { "searchable": false, "targets": "" },  // Disable search on first and last columns
        { "targets": [3], "orderable": false},
        ],
        "rowReorder": {
            "selector": 'td:nth-child(0)'
        },
        "responsive": true,
    });
}