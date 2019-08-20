$(document).ready(function(){
    $(window).scroll(function(){
        if ($(window).scrollTop() > 150){
            $('#resume').addClass('resume');
            $('#img1').addClass('img1');
            $('#img2').addClass('img2');
        }
    });
})