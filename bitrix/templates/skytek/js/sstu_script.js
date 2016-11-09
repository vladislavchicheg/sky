  WebFontConfig = {
    google: { families: [ 'Roboto:400,300,300italic,400italic,500,500italic,700,700italic,900,900italic,100italic,100:latin,cyrillic-ext,latin-ext,cyrillic' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); 

jQuery(function($) {
	$(".left_swap").click(function (){
		$(".touch-menu").slideToggle("slow");
		
	});
});

jQuery(function($) {
	$(".touch-menu li ").click(function (){
	   $(this).children('ul').toggle('fast');
		
	});
});

$(document).ready(function(){
 
        var $menu = $(".menu-wrapper");
 
        $(window).scroll(function(){
            if ( $(this).scrollTop() > 100 && $menu.hasClass("default") ){
                $menu.removeClass("default").addClass("fixed-menu");
            } else if($(this).scrollTop() <= 100 && $menu.hasClass("fixed-menu")) {
                $menu.removeClass("fixed-menu").addClass("default");
            }
        });//scroll
    jQuery(function($){
        $("input[type=tel]").mask("+7 (999) 999-9999");

    });
    $("a#zam").mouseover( function() {

        var link_title = $(this).attr("title");
        $('h4.elementToReplace').replaceWith('<h4 class="elementToReplace"> Вы хотите заказать:' + link_title + '</h4>');
        $("input#zamenatovar").val(link_title);



        return false;
    });
    });




  function next(arr) {
      var max = arr.length - 1,
        i = -1;
      return function () {
        i = i < max ? i + 1 : 0;
        return arr[i];
      };
    }
    jQuery(function () {
      var slider = next($('.preim-items .preim-item'));
      var curent;
      setInterval(function () {
        if (curent) $(curent).removeClass('act');
        curent = slider();
        $(curent).addClass('act');
      }, 1000);
    });
    
	
$(document).ready(function() {
    $(".product__form").submit(function () {
        var form = $(this);


        var data = form.serialize();
        form.find('input[type="submit"]').attr('disabled', 'disabled');
        $.post('/include/addtovar.php', data, function(){
            $('.modal').modal('hide');
            $('#succ').modal('show');
            form.find('input[type="submit"]').prop('disabled', false);
            form.find('input[type="text"]').val('');
        });

        return false;
    });
    $(".addtovar").submit(function () {
        var form = $(this);


        var data = form.serialize();
        form.find('input[type="submit"]').attr('disabled', 'disabled');
        $.post('/include/addtovar.php', data, function(){
            $('.modal').modal('hide');
            $('#succ').modal('show');
            form.find('input[type="submit"]').prop('disabled', false);
            form.find('input[type="text"]').val('');
        });

        return false;
    });
    $(".zvonok").submit(function () {
        var form = $(this);


        var data = form.serialize();
        form.find('input[type="submit"]').attr('disabled', 'disabled');
        $.post('/include/addzvon.php', data, function(){
            $('.modal').modal('hide');
            $('#succ').modal('show');
            form.find('input[type="submit"]').prop('disabled', false);
            form.find('input[type="text"]').val('');
        });

        return false;
    });
    $(".addvopros").submit(function () {
        var form = $(this);


        var data = form.serialize();
        form.find('input[type="submit"]').attr('disabled', 'disabled');
        $.post('/include/addvopros.php', data, function(){
            $('.modal').modal('hide');
            $('#succ').modal('show');
            form.find('input[type="submit"]').prop('disabled', false);
            form.find('input[type="text"]').val('');
        });

        return false;
    });
    $(".fancybox").fancybox();
    $('.slick11').slick({
        dots: true,
        autoplay: true,
        arrows: true,
        infinite: true,
        prevArrow:'<button type="button" class="slick-prev"></button>',
        nextArrow:'<button type="button" class="slick-next"></button>',
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 730,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    arrows: false,
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    $('.carousel').carousel();
    $(window).scroll(function() {
		var wB = $( ".preim" );
		var position = wB.position();

		var isSTop = $(window).scrollTop();
        if (isSTop > position.top + 450)
        {
           $('.circlestat').circliful(); 
        }
        if (isSTop > position.top + 3)
        {
            $('.wrn').css('display', 'block');
           $('.wrn').addClass('animated bounceInLeft');
        }
               
        
        
        });
           $(window).scroll(function() {
		var wB2 = $( "#bg1" );
		var position2 = wB2.position();

		var isSTop = $(window).scrollTop();
        
        if (isSTop > position2.top - 80)
        {
        $('.warn11').css('display', 'block');
           $('.warn11').addClass('animated bounceInUp');
        }
      
        });
        $(window).scroll(function() {
		var wB2 = $( "#bg1" );
		var position2 = wB2.position();

		var isSTop = $(window).scrollTop();
        
        if (isSTop > position2.top - 370)
        {
            $('.doc-item').css('display', 'block');
           $('.doc-item').addClass('animated zoomIn');
        }
      
        });
        $(window).scroll(function() {
		var wB3 = $( ".resh" );
		var position3 = wB3.position();

		var isSTop = $(window).scrollTop();
        
        if (isSTop > position3.top + 760)
        {
           $('.cup').addClass('animated tada');
        }
        if (isSTop > position3.top + 260)
        {
            $('.preim-item').css('display', 'block');
           $('.preim-item').addClass('animated bounceInRight');
           
        }
        });
        
      
        
    });
		
     