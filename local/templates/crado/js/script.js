


$(document).ready(function(){
     
    var height = $(window).height();
    $('#crado').css('height',height);
    
    
    $('#comments').click(function(){
      if($(this).hasClass("active") != true)
      {
            $(this).addClass('active').next().addClass('active');
      }
      else
      {
            $(this).removeClass('active').next().removeClass('active');
      } 
    });
    
    
    $('#search-black').click(function(){
        if($(this).hasClass("active") != true)
          {
                $(this).addClass('active');
                $('.search-input input[name="q"]').focus();
                $(this).children('.search-svg').hide();
                $(this).children('.close-svg').show();
                $(".menu.home").addClass('active');
                
                $("#search").addClass('active');
                $("#search").children('.search-svg').hide();
                $("#search").children('.close-svg').show();
                
                //$('.menu.home.fixed.active').css('top','60px');
                
                $('.search-input').addClass('active');
                
                $('.workarea.all').animate({
                    marginTop: 120
                }, 250);
                $('.menu.no-home,.menu.home.active.fixed').animate({
                    top: "60"
                      }, 250);
                $('.search-input').animate({
                    height: "60"
                      }, 250);
                
          }
          else
          {
                $(this).removeClass('active');
                $(this).children('.search-svg').show();
                $(this).children('.close-svg').hide();
                $(".menu.home").removeClass('active');
                
                $("#search").removeClass('active');
                $("#search").children('.search-svg').show();
                $("#search").children('.close-svg').hide();
                
               //if($('.menu.home.fixed').hasClass('active'))
                    
                 //else
                 //$('.menu.home.fixed').css('top','0');
            
                $('.search-input').removeClass('active');
                
                $('.workarea.all').animate({
                    marginTop: 60
                }, 250);
                $('.menu.no-home,.menu.home.fixed').animate({
                    top: "0"
                      }, 250);
                $('.search-input').animate({
                    height: "0"
                      }, 250);
          } 
    })
    
    $('#search').click(function(){
        if($(this).hasClass("active") != true)
          {
                $(this).addClass('active');
                $(this).children('.search-svg').hide();
                $(this).children('.close-svg').show();
                $(".menu.home").addClass('active');
                
                
                $("#search-black").addClass('active');
                $("#search-black").children('.search-svg').hide();
                $("#search-black").children('.close-svg').show();
                
                $('.search-input').animate({
                    height: "60"
                      }, 250);
                $("html, body").animate({ scrollTop: $('.search-input').offset().top },700);
                $('.search-input input[name="q"]').focus();
                
          }
          else
          {
                $(this).removeClass('active');
                $(this).children('.search-svg').show();
                $(this).children('.close-svg').hide();
                $(".menu.home").removeClass('active');
                
                $("#search-black").removeClass('active');
                $("#search-black").children('.search-svg').show();
                $("#search-black").children('.close-svg').hide();
                
                $('.search-input').animate({
                    height: "0"
                      }, 250);
          } 
    })
    /**/
    
    
    
    /*login*/
    $('#login-white').click(function(){
        id = $(this).attr('id');
        if($('#login-white').hasClass('active') == true)
        {
            $(this).removeClass('active');
            $('#modal-white-login').hide();
            $('.boxshadow-login')/*.attr('onclick','close_modal_login("'+id+'")')*/.hide();
        }
        else
        {
            $(this).addClass('active');
            $('#modal-white-login').show();
            $('.boxshadow-login')/*.attr('onclick','close_modal_login("'+id+'")')*/.show();
        }
    });
    
    $('#login-black').click(function(){
        id = $(this).attr('id');
        if($('#login-black').hasClass('active') == true)
        {
            $(this).removeClass('active');
            $('#modal-black-login').hide();
            $('.boxshadow-login-fixed').hide();
        }
        else
        {
            $(this).addClass('active');
            $('#modal-black-login').show();
            $('.boxshadow-login-fixed').show();
        }
    });
    
    
    
    
    /**/
    $('#allphotos').click(function(){
        var id_photo = '#'+$(this).attr('id')+'-event';
        if($(this).hasClass("active") != true)
        {
            //$(this).addClass('active');
            $(id_photo).animate({
                opacity: 1
              }, 500);
            $(id_photo).css('z-index','1');
            //.show('slow');
            $(id_photo).parent().animate({
                height: "600"
              }, 500);
            
            //.css('height','500px');
            $('.head-event').animate({
                opacity: 0
              }, 500);
              $('.head-event').css('z-index','0');
            
            //.hide('slow');
        }
        else
        {
            //$(this).removeClass('active');
            $(id_photo).hide('slow');
            $('.head-event').show('slow');
        } 
    });
    $('.photos #close').click(function(){
            $(this).parent().animate({
                opacity: 0
              }, 500);
               $(this).parent().css('z-index','0');
            //.hide('slow');
            $(this).parent().parent().animate({
                height: $('.imag').height()
              }, 500);//.css('height','420px');
            $('.head-event').animate({
                opacity: 1
              }, 500);
              $('.head-event').css('z-index','0');
            //.show('slow');
    });
    
    $('.map-show').click(function(){
       if($(this).hasClass("hide") != true)
      {
            $(this).addClass('hide');
            $(this).text('Скрыть карту');
            $(this).next().css('display','none');
            $(this).prev().addClass('bwhite');
            
      }
      else
      {
            $(this).removeClass('hide');
            $(this).text('Показать карту');
            $(this).next().css('display','block');
            $(this).prev().removeClass('bwhite');
      } 
    });
    /*carousel*/
        $('.carousel')
		.jcarousel({
			wrap: 'circular',
		});
		$('.carousel-controlls .prev').jcarouselControl({
			target: '-=1'
		});
		$('.carousel-controlls .next').jcarouselControl({
			target: '+=1'
		});
    /**/
    
    
    /*select*/
    $('.iselect-header').click(function(){
        if($(this).hasClass("active") != true)
      {
            $(this).addClass('active').next().addClass('active');
      }
      else
      {
            $(this).removeClass('active').next().removeClass('active');
      } 
    })
    $(document).click(function(e){
    	if ($(e.target).closest(".iselect-header,.iselect-option").length) return;
    	$(".iselect-header").removeClass('active').next().removeClass('active');
            e.stopPropagation();
    }); 
    
    
    /*форм*/
    $('.inp_error').hide();
    
    $('body').on('change', '.form .email_required', function(){
		var val = $.trim($(this).val());
		checkEmail(val, $(this));
    });
    
    $('body').on('change', '.form .paswd', function(){
		var val = $.trim($(this).val());
		checkPassword(val, $(this));
    });
    
    $('body').on('change', '.form .paswd_inp', function(){
		var val = $.trim($(this).val());
		checkPassword_inp(val, $(this));
    });
    
    $('body').on('change', '.form .required', function(){
		var val = $.trim($(this).val());
		//checkEmail(val, $(this));
                if(val != '' && val.length < 2)
                {
                    $(this).parent().addClass("error_row").find('.inp_error').hide();
                    $(this).parent().removeClass("ok_row");
                    $(this).parent().find('.empty_field').show();
                }
                else
                {
                    $(this).parent().removeClass("error_row").find('.inp_error').hide();
                    $(this).parent().addClass("ok_row");
                    //$(this).parent().find('.empty_field').show();
                }
    });
    
    $('body').on('submit', '.form form, .add_question', function(){
            
            var error = false;
            $(this).find(".required").each(function(index, element){
                                var val = $.trim($(this).val());
                                if (val == '')
                                {
                                        $(this).closest('.row_form').addClass("error_row").find('.inp_error').hide();
                                        $(this).closest('.row_form').find('.empty_field').show();
                                        error = true;
                                }
                                else
                                        $(this).closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                        });

            $(this).find(".email_required").each(function(index, element){
                                var val = $.trim($(this).val());
                                if (val != null && val != "")
                                {
                                        if (!isValidEmail(val))
                                        {
                                                $(this).closest('.row_form').addClass("error_row").find('.inp_error').hide();
                                                $(this).closest('.row_form').find('.email_field').show();
                                                error = true;
                                        }
                                        else
                                                $(this).closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                }
                                else
                                {
                                    $(this).closest('.row_form').addClass("error_row").find('.empty_field').show();
                                    $(this).closest('.row_form').removeClass("ok_row");
                                }
                        });
            $(this).find('.paswd').each(function(index, element){
                    var val = $.trim($(this).val());
                    if (val != null && val != "") 
                    {
                            if(isRussian(val))
                            {
                                    $(this).closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                    $(this).closest('.row_form').addClass("error_row").find('.latin_field').show();
                                    $(this).closest('.row_form').removeClass("ok_row");
                                    error = true;
                            }
                            else if(val.length < 6)
                            {
                                    $(this).closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                    $(this).closest('.row_form').addClass("error_row").find('.length_field').show();
                                    $(this).closest('.row_form').removeClass("ok_row");
                                    error = true;
                            }
                            else
                            {
                                    $(this).closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                    $(this).closest('.row_form').addClass("ok_row");
                                    //obj.closest('.row_form').find('.latin_field').show();
                            }
                    }
                    else
                    {
                            $(this).closest('.row_form').addClass("error_row").find('.empty_field').show();
                            $(this).closest('.row_form').removeClass("ok_row");
                    }
                });
                
            $(this).find('.paswd_inp').each(function(index, element){
                    var val = $.trim($(this).val());
                    if (val != null && val != "") 
                    {
                            if(val != $(this).parent().prev().children('.paswd').val())
                        {
                            $(this).closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                            $(this).closest('.row_form').addClass("error_row").find('.pass_field').show();
                            $(this).closest('.row_form').removeClass("ok_row");
                            error = true;
                        }
			else
			{
				$(this).closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                $(this).closest('.row_form').addClass("ok_row");
				//obj.closest('.row_form').find('.latin_field').show();
			}
		}
		else
		{
			$(this).closest('.row_form').addClass("error_row").find('.empty_field').show();
                        $(this).closest('.row_form').removeClass("ok_row");
		}
                });
                if (error)
                    {
                            return false;
                    }
                else
                {
                        //return false;
                }
    });
    /**/
    
    
    /*input-file*/
    $('div.inputfile input[type="file"]').on('change',function(){
       var text = $(this).val();
       var obj = $(this);
       text = text.split('\\');
       $(this).parent().prev().children('.text').text(text[text.length-1]); 
      // $('#file_modal').val($(this).val());
       //alert(window.pageYOffset ); 
       
       $('.boxshadow').show();
       $('.img-resize').show();
       
       $('#pre img').show();
       $('.modal').css('top',window.pageYOffset+100+'px');
       //handleFileSelect(obj)
       //document.getElementById('files').addEventListener('change', handleFileSelect, false);//.addEventListener('change', handleFileSelect, false);
    });
    /**/
    
    
    /*scroll*/
    $('a.scroll').click(function(){
       var id = $(this).attr('href');
       var scrollDestination=$(id).offset().top;
       $('html, body').animate({scrollTop: scrollDestination-100}, 800); 
    });
    /**/
    

});

$(window).scroll(function(){
    var height = $(window).height();
    if($('html').scrollTop()+$('body').scrollTop() > $('#crado').height())
    {
         $('.search-input.home').addClass('fixed');
         $('.menu.home').removeClass('nofixed');
         $('.menu.home').addClass('fixed');
         if($('.menu.home.fixed').hasClass('active'))
            $('.menu.home.fixed.active').css('top','60px');
         else
            $('.menu.home.fixed').css('top','0');
    }
    else{
        $('.search-input.home').removeClass('fixed');
        $('.menu.home').addClass('nofixed');
        $('.menu.home.active.nofixed').css('top','0px');
        $('.menu.home').removeClass('fixed');
    }
    
    /*if($('html').scrollTop() > height)
    {
         $('.search-input.home').addClass('fixed');
         $('.menu.home').removeClass('nofixed');
         $('.menu.home').addClass('fixed');
         if($('.menu.home.fixed').hasClass('active'))
            $('.menu.home.fixed.active').css('top','60px');
         else
            $('.menu.home.fixed').css('top','0');
    }
    else{
        $('.search-input.home').removeClass('fixed');
        $('.menu.home').addClass('nofixed');
        $('.menu.home.active.nofixed').css('top','0px');
        $('.menu.home').removeClass('fixed');
    }*/
    //alert($('body').scrollTop());
});


/*date picker*/
$(function() { 
    /*$( "#date-input" ).datepicker({
                        changeMonth: true,
                        changeYear: true,
                        yearRange: "-100:+0"
                    });
    */                
    $( "#other_date" ).datepicker({
        minDate:0,
        altField: "#date_other",
        onSelect: function(dateText, inst) { 
            //alert(dateText);
            var formatDate = dateText.split('.');
            var month = formatedDate_month(formatDate[1]);
            $('#date_other').html(formatDate[0]+' '+month+'<div class="trigon"></div>'); 
            $('#date_other').attr('data-time',dateText);
            $( "#other_date" ).removeClass('active');
            
            $('.calendar .date').removeClass('active');
            //event.stopPropagation();
            $('#date_other').addClass('active');
            $("input#events").trigger('click');
            //var a = function(event) {   select_date(event,'other',dateText);}
        }
    });
    
    $( "#other_date_events" ).datepicker({
        minDate:0,
        altField: "#date_other_events",
        onSelect: function(dateText, inst) { 
            //alert(dateText);
            var formatDate = dateText.split('.');
            var month = formatedDate_month(formatDate[1]);
            $('#date_other_events').html(formatDate[0]+' '+month+'<div class="trigon"></div>'); 
            $('#date_other_events').attr('data-time',dateText);
            $( "#other_date_events" ).removeClass('active');
            
            $('.calendar .date').removeClass('active');
            //event.stopPropagation();
            $('#date_'+'other'+'_events').addClass('active');
            $("input#ajax-search-button").trigger('click');
            
            
            //var a = function(event) {  select_date_events(event,'other',dateText);}
        }
    });
    
    $( "#other_date_cat" ).datepicker({
        minDate:0,
        altField: "#date_other_cat",
        onSelect: function(dateText, inst) { 
            //alert(dateText);
            var formatDate = dateText.split('.');
            var month = formatedDate_month(formatDate[1]);
            $('#date_other_cat').html(formatDate[0]+' '+month+'<div class="trigon"></div>'); 
            $('#date_other_cat').attr('data-time',dateText);
            $( "#other_date_cat" ).removeClass('active');
            
            $('.calendar .date').removeClass('active');
            //event.stopPropagation();
            $('#date_'+'other'+'_cat').addClass('active');
            $("input#events").trigger('click');
           //var a = function(event) {   select_date_cat(event,'other',dateText);}
        }
    });
  });
  
  $(window).resize(function(){
                    var height = $(window).height();
                    $('#crado').css('height',height);
                });