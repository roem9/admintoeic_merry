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
    ajax: {"url": url_base+"soal/loadSoal", "type": "POST"},
    columns: [
        {"data": "nama_soal"},
        {"data": "tipe_soal"},
        {"data": "soal", render : function (data) {
            if(jQuery.browser.mobile == true) return data
            else return "<center>"+data+"</center>"
        }},
        {"data": "poin", render : function(data){
            if(data == 0) data = "-"
            if(jQuery.browser.mobile == true) return data
            else return "<center>"+data+"</center>"
        }},
        {"data": "catatan"},
        {"data": "tgl_pembuatan"},
        {"data": "action", render : function (data) {
            if(jQuery.browser.mobile == true) return data
            else return "<center>"+data+"</center>"
        }},
    ],
    order: [[5, 'desc']],
    rowCallback: function(row, data, iDisplayIndex) {
        var info = this.fnPagingInfo();
        var page = info.iPage;
        var length = info.iLength;
        $('td:eq(0)', row).html();
    },
    "columnDefs": [
    { "searchable": false, "targets": "" },  // Disable search on first and last columns
    { "targets": [2, 6], "orderable": false},
    ],
    "rowReorder": {
        "selector": 'td:nth-child(0)'
    },
    "responsive": true,
});