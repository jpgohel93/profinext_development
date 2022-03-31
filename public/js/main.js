const enableLoader = ()=>{
    $("body").append(`<div class='loading'></div>`);
}
const disableLoader = (elem=".loading")=>{
    $(elem).remove();
}
$(document).on("show.bs.modal",".modal",function(){
    enableLoader();
    $(".select2-container").css({"display":"none"});
})
$(document).on("shown.bs.modal",".modal",function(){
    disableLoader();
})
$(document).on("hidden.bs.modal",".modal",function(){
    $(".select2-container").css({"display":"inline-block"});
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