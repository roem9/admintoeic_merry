// class rupiah untuk format rupiah 
$(document).on("keyup", ".rupiah", function(){
    $(this).val(formatRupiah(this.value, 'Rp. '))
})

// data table custom 
// $('.table-responsive').on('show.bs.dropdown', function () {
//     $('.table-responsive').css( "overflow", "inherit" );
// });

// $('.table-responsive').on('hide.bs.dropdown', function () {
//     $('.table-responsive').css( "overflow", "auto" );
// })
// data table custom 

// number only 
$(".number").inputFilter(function(value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
});

$(document).on("keyup", "input[name='search']", function(){
    loadMobile(0);
})

// pagination 
$('#pagination').on('click','a',function(e){
    e.preventDefault(); 
    var pageno = $(this).attr('data-ci-pagination-page');
    page = pageno;
    $("#skeleton").show()
    loadMobile(pageno);
});

// sort item soal 
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