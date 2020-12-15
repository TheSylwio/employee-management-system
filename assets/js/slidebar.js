$(document).ready(function (){
    $(".dropdown").on('click',function (){
        $(this).toggleClass('active')
        $(this).find($(".fas")).toggleClass('fa-arrow-down').toggleClass('fa-arrow-up')
    })
})