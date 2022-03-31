const enableLoader = ()=>{
    $("body").append(`<div class='loading'></div>`);
}
const disableLoader = (elem=".loading")=>{
    $(elem).remove();
}
$(document).on("show.bs.modal",".modal",function(){
    enableLoader();
})
$(document).on("shown.bs.modal",".modal",function(){
    disableLoader();
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