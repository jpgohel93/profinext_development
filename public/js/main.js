const enableLoader = ()=>{
    $("body").append(`<div class='loading'></div>`);
}
const disableLoader = (elem=".loading")=>{
    $(elem).remove();
}
$(document).on("show.bs.modal",".modal",function(){
    enableLoader();
    $( '.select2-container' ).each(function () {
        this.style.setProperty( 'z-index', '1049', 'important' );
    });
})
$(document).on("shown.bs.modal",".modal",function(){
    disableLoader();
})
$(document).on("hidden.bs.modal",".modal",function(){
    $( '.select2-container' ).each(function () {
        this.style.setProperty( 'z-index', '999999', 'important' );
    });
})
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    beforeSend: function(){
        enableLoader();
    },
    complete: function(){
        disableLoader();
    }
});
window.addEventListener("DOMContentLoaded",function(){
    $(".loading").hide();
})