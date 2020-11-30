$(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if(scroll < 100){
        $('.principal').css('background', 'rgba(25, 58, 32, 0.5)');
    } else{
        $('.principal').css('background', 'rgba(25, 58, 32, 0.8)');
    }
});