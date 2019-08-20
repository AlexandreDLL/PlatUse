$(document).ready(function(){
    //Back to Top
    $(window).scroll(function(){
        if ($(window).scrollTop() > 50){
            $('#bouton_btt').fadeIn();
        }
        else {
            $('#bouton_btt').fadeOut();
        }
    });
    $('#bouton_btt').click(function(event){
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 'slow');
        return false;
    });

    //Scroll page forum
    $('#btn_reglement').click(function(){
        $('html, body').animate({scrollTop: $('#reglement').offset().top}, 'slow');
        return false;
    });
    $('#btn_maj').click(function(){
        $('html, body').animate({scrollTop: $('#maj').offset().top}, 'slow');
        return false;
    });
    $('#btn_astuce').click(function(){
        $('html, body').animate({scrollTop: $('#astuce').offset().top}, 'slow');
        return false;
    });
})
