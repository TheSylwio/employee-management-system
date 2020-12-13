$(document).ready(function (){
    $("#sidebarCollapse").on('click',function (){
        $("#sidebar").toggleClass('active')
        $(this).find($(".fas")).toggleClass('fa-arrow-down').toggleClass('fa-arrow-up')
    })
})