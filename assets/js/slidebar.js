$(document).ready(function (){
    $(".dropdown").on('click',function (){
        console.log("JD");
        $(this).toggleClass('active')
        $(this).find($(".fas")).toggleClass('fa-arrow-down').toggleClass('fa-arrow-up')
    })
})