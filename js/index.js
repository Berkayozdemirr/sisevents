


  $('.scroll').on('click',function(){
    var body = $("html, body");
    body.stop().animate({scrollTop:0}, 500, 'swing');
});






$('.slick-move').slick({
	slidesToShow: 1,
	slidesToScroll: 1,
	autoplay: true,
	autoplaySpeed: 2000,
	arrows: false,
});






$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});


// scroll ozellıgı burda



function scrollTopFunction(){
    if ($(window).scrollTop() > 100) {
        $('body').addClass('fixed');

    }
    else {
        $('body').removeClass('fixed');
    }
}
scrollTopFunction();
$(window).scroll(function(){
    scrollTopFunction();
});



$("input[name='telefon']").keyup(function() {
    $(this).val($(this).val().replace(/^(\d{3})(\d{3})(\d)+$/, "($1)$2-$3"));
});