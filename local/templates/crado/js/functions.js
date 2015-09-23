/*Следующая страница инсити*/
function next_home(event,el,page)
{
            var data_page = parseInt($(el).attr('data-page')) + 1;
            var pageurl = '/include/nextpage.php?page='+page;
            var button = $(el);
            var preloader = $(el).next();
            button.css('display','none');
            preloader.css('display','inline-block');
            event.stopPropagation();
            event.preventDefault();
            
            $.ajax({
               url: pageurl,
               success: function(data) {
                    
                    var data_n = data.split('<!--endcount-->');
                    var data_count = data_n[0].split('<!--count-->');
                    //var page_size = <?=$page_size?>;
                    //var count_element = <?=$count_element-1?>;
                    //var count_element_ajax = <?=$count_element_ajax?> + parseInt(data_count[1]);
                    /*if(count_element < (data_page-1)*page_size)
                    {
                        button.parent().remove();
                    }
                    else
                    {
                        preloader.css('display','none');
                        button.css('display','inline-block');
                        button.attr('data-page',data_page);
                        button.attr('href','/?page='+data_page);    
                    }*/
                     preloader.remove();
                     button.parent().remove();
                    $(data_n[1]).appendTo('#data-home');
               }
            });
}

function incity_next(event,el,page)
{
            var data_page = parseInt($(el).attr('data-page')) + 1;
            var pageurl = '/include/nextpage_incity.php?page='+page;
            var button = $(el);
            var preloader = $(el).next();
            button.css('display','none');
            preloader.css('display','inline-block');
            event.stopPropagation();
            event.preventDefault();
            
            $.ajax({
               url: pageurl,
               success: function(data) {
                    
                    var data_n = data.split('<!--endcount-->');
                    var data_count = data_n[0].split('<!--count-->');
                    //var page_size = <?=$page_size?>;
                    //var count_element = <?=$count_element-1?>;
                    //var count_element_ajax = <?=$count_element_ajax?> + parseInt(data_count[1]);
                    /*if(count_element < (data_page-1)*page_size)
                    {
                        button.parent().remove();
                    }
                    else
                    {
                        preloader.css('display','none');
                        button.css('display','inline-block');
                        button.attr('data-page',data_page);
                        button.attr('href','/?page='+data_page);    
                    }*/
                     preloader.remove();
                     button.parent().remove();
                    $(data_n[1]).appendTo('#data-home');
               }
            });
}


function outcity_next(event,el,page)
{
            var data_page = parseInt($(el).attr('data-page')) + 1;
            var pageurl = '/include/nextpage_outcity.php?page='+page;
            var button = $(el);
            var preloader = $(el).next();
            button.css('display','none');
            preloader.css('display','inline-block');
            event.stopPropagation();
            event.preventDefault();
            
            $.ajax({
               url: pageurl,
               success: function(data) {
                    
                    var data_n = data.split('<!--endcount-->');
                    var data_count = data_n[0].split('<!--count-->');
                    //var page_size = <?=$page_size?>;
                    //var count_element = <?=$count_element-1?>;
                    //var count_element_ajax = <?=$count_element_ajax?> + parseInt(data_count[1]);
                    /*if(count_element < (data_page-1)*page_size)
                    {
                        button.parent().remove();
                    }
                    else
                    {
                        preloader.css('display','none');
                        button.css('display','inline-block');
                        button.attr('data-page',data_page);
                        button.attr('href','/?page='+data_page);    
                    }*/
                     preloader.remove();
                     button.parent().remove();
                    $(data_n[1]).appendTo('#data-home');
               }
            });
}

//функция фильтрации элементов
function filter(category,whe_city,name_fil,val,date,page)
{
    //alert(category+' '+whe_city+' '+name_fil+' '+val);
    /*var params = new Array();
        params.push(category);
        params.push(whe_city);
        params.push(name_fil);
        params.push(val);
          */
    //params = JSON.stringify(params);
    date = $('.calendar .date.active').attr('data-time');
    var search_text = $('.search #ajax-search').val();
    
    var page_filter = '/include/page_filter.php';
    $('#material').html('');
    $('.content-preloader').css('display','block');
    $.ajax({
            url: page_filter,
            type: 'get',
            data: {category: category, whe_city: whe_city, name_fil: name_fil, val: val, date: date, search: search_text,PAGEN_1: page},
            success: function(data)
            {
                $('.content-preloader').css('display','none');
                $('#material').html(data);
                if(val == 'events')
                {
                    $('.parent-calendar').animate({
                        opacity: 1,
                        height: 'show'
                    }, 500);
                    $('.parent-calendar').parent().animate({
                        height: 115
                    }, 500);
                }
                else
                {
                   $('.parent-calendar').animate({
                        opacity: 0,
                        height: 'hide'
                    }, 500);
                    $('.parent-calendar').parent().animate({
                        height: 18
                    }, 500);
                }
            }
    });
    
}

/*Следующая страница категории*/
function next_page(event,el,category,whe_city,name_fil,val,date,page)
{
     event.stopPropagation();
     event.preventDefault();
     
    if($('.calendar .date').hasClass("active") == true)
    {
        date = $('.calendar .date.active').attr('data-time');
    }

    var search_text = $('.search #ajax-search').val();
    
    var page_filter = '/include/nextpage_category.php';
    
    var button = $(el);
    var preloader = $(el).next();
    button.css('display','none');
    preloader.css('display','inline-block');

    $.ajax({
            url: page_filter,
            type: 'get',
            data: {category: category, whe_city: whe_city, name_fil: name_fil, val: val, date: date, search: search_text,PAGEN_1: page},
            success: function(data)
            {
                //preloader.css('display','none');
                //button.css('display','block');
                preloader.remove();
                button.parent().remove();
                $('#material').append(data);
            }
    });
    
}
/**/

/*Переключение даты*/
function select_date(event,element,date)
    {
        event.stopPropagation();
        event.preventDefault();
        $('.calendar .date').removeClass('active');
        //event.stopPropagation();
        $('#date_'+element).addClass('active');
        $("input#events").trigger('click');
        
    }
/**/

/*ajax поиск подсказки*/
function ajaxsearch(){
    //var text-search = $(element).val();
    $("input.type_radio:checked").trigger('click');
    //console.log($(element).val());
    
}
function clear_filter(){
    $('.calendar .date').removeClass('active');
    $('.filter_type #all').prop("checked", true);
    $('.search #ajax-search').val('');
    $('#date_other').html('Другая дата<div class="trigon"></div>'); 
    $("input.type_radio:checked").trigger('click');
    //$("input.type_radio:checked").trigger('click');
    //$("#del_filter").trigger('click');
}
function other_date(event){
    event.stopPropagation();
    event.preventDefault();
    if($('#other_date').hasClass("active") != true)
      {
            $('#other_date').addClass('active');
      }
      else
      {
            $('#other_date').removeClass('active');
      } 
}


/*Фильтрация по категории СЕКЦИИ*/
function filter_cat(whe_city,name_fil,val,date,page)
{
    date = $('.calendar .date.active').attr('data-time');
    
    //var category = $('.filter-category select option:selected').val();
    var category = '';
    var cat_del = '';
	
	var arrCat = new Array();

    $('.iselect-option input:checked').each(function(){
		arrCat.push($(this).val());
        category += $(this).val() +',';
        cat_del += '<div class="clear_cat">' + '<span onclick="cat_del(\''+whe_city+'\',\'sport_'+$(this).val()+'\')">'+$(this).next().text()+'</span></div>';
    });
    
    $('.result-category').html('');
    $('.result-category').html(cat_del);
    
    if(category == '') {
		
		category = 'all';
	}
    var search_text = $('.search #ajax-search').val();
    var page_filter = '/include/page_filter_cat.php';
    $('#material').html('');
    $('.content-preloader').css('display','block');
    $.ajax({
            url: page_filter,
            type: 'get',
            data: {category: category, whe_city: whe_city, name_fil: name_fil, val: val, date: date, search: search_text,PAGEN_1: page},
            success: function(data)
            {
                $('.content-preloader').css('display','none');
                $('#material').html(data);
				
				//Смена титлов урлов сео текста
				
				title_seo_cat(whe_city,category);
				
                if(val == 'events')
                {
                    $('.parent-calendar').animate({
                        opacity: 1,
                        height: 'show'
                    }, 500);
                    $('.parent-calendar').parent().animate({
                        height: 115
                    }, 500);
                }
                else
                {
                   $('.parent-calendar').animate({
                        opacity: 0,
                        height: 'hide'
                    }, 500);
                    $('.parent-calendar').parent().animate({
                        height: 18
                    }, 500);
                }
            }
    });
    
}

//Смена титлов урлов сео текста
				
function title_seo_cat(whe_city,category)
{
    var page_filter = '/include/title_seo_cat.php';
	$.ajax({
            url: page_filter,
            type: 'post',
            data: {category: category, whe_city: whe_city},
            success: function(data)
            {
				data = JSON.parse(data);
				var uri = data.URL;
				history.pushState({}, data.TITLE, data.URL);
				history.pathname = uri;
				$('title').text(data.TITLE);
				$('#SEO_TEXT').html(data.SEO);
				$('.zagolovok_ev h1').text(data.H1);
			}
	});
}
				

/*Следующая страница категории*/
function next_page_cat(event,el,whe_city,name_fil,val,date,page)
{
     event.stopPropagation();
     event.preventDefault();
     
    if($('.calendar .date').hasClass("active") == true)
    {
        date = $('.calendar .date.active').attr('data-time');
    }
    var category = '';
    $('.iselect-option input:checked').each(function(){
        category += $(this).val() +',';
    });
    
    if(category == '') {category = 'all';}
    
    var search_text = $('.search #ajax-search').val();
    
    var page_filter = '/include/nextpage_category_cat.php';
    
    var button = $(el);
    var preloader = $(el).next();
    button.css('display','none');
    preloader.css('display','inline-block');

    $.ajax({
            url: page_filter,
            type: 'get',
            data: {category: category, whe_city: whe_city, name_fil: name_fil, val: val, date: date, search: search_text,PAGEN_1: page},
            success: function(data)
            {
                //preloader.css('display','none');
                //button.css('display','block');
                preloader.remove();
                button.parent().remove();
                $('#material').append(data);
            }
    });
    
}
/**/
/*Переключение даты*/
function select_date_cat(event,element,date)
    {
        event.stopPropagation();
        event.preventDefault();
        $('.calendar .date').removeClass('active');
        //event.stopPropagation();
        $('#date_'+element).addClass('active');
        $("input#events").trigger('click');
        
    }
    

/**/

/*ajax поиск подсказки*/
function ajaxsearch_cat(){
    //var text-search = $(element).val();
    $("input.type_radio:checked").trigger('click');
    //console.log($(element).val());
    
}
function clear_filter_cat(){
    $('.iselect-option input').prop('checked',false);
    $('.calendar .date').removeClass('active');
    $('.filter_type #all').prop("checked", true);
    $('.filter-category #all_sport').prop("checked", true);
    $('.search #ajax-search').val('');
    $('#date_other_cat').html('Другая дата<div class="trigon"></div>'); 
    
    $("input.type_radio:checked").trigger('click');
    //$("input.type_radio:checked").trigger('click');
    //$("#del_filter").trigger('click');
}
function other_date_cat(event){
    event.stopPropagation();
    event.preventDefault();
    if($('#other_date_cat').hasClass("active") != true)
      {
            $('#other_date_cat').addClass('active');
      }
      else
      {
            $('#other_date_cat').removeClass('active');
      } 
}

function cat_select(el,city)
{
    /*var name_fil,val,date,page;*/
    var id_ar = $('.filter_type input:checked').attr('id');
    if (id_ar == 'all') id_ar = '';
    filter_cat(city,'type',id_ar);
}
function cat_del(city,cat_id){
    $('#'+cat_id).prop('checked',false);
    var id_ar = $('.filter_type input:checked').attr('id');
    if (id_ar == 'all') id_ar = '';
    filter_cat(city,'type',id_ar);
}
/**/
/*получение даты*/
function formatedDate_month(month)
{
    var m = ['января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря'];
    return m[parseInt(month)-1];
}

/*Следующая страница поиск*/
function search_next(event,el,q,page)
{
     event.stopPropagation();
     event.preventDefault();
     
    var page_next = '/include/search_next.php?q='+q;
    
    var button = $(el);
    var preloader = $(el).next();
    button.css('display','none');
    preloader.css('display','inline-block');
    /*var ar = ('q'=>q,'PAGEN_1'=>page);
    ar = json_encode*/
     //q=utf8_encode(q);
     $.ajax({
            url: page_next,
           // type: 'get',
            //dataType: 'json',
            data: {/*q: q,*/ PAGEN_1: page},
            success: function(data)
            {
                //preloader.css('display','none');
                //button.css('display','block');
                preloader.remove();
                button.remove();
                $('#search-material').append(data);
            }
    });
}


/*encode*/
function utf8_encode ( str_data ) {	// Encodes an ISO-8859-1 string to UTF-8
	// 
	// +   original by: Webtoolkit.info (http://www.webtoolkit.info/)

	str_data = str_data.replace(/\r\n/g,"\n");
	var utftext = "";

	for (var n = 0; n < str_data.length; n++) {
		var c = str_data.charCodeAt(n);
		if (c < 128) {
			utftext += String.fromCharCode(c);
		} else if((c > 127) && (c < 2048)) {
			utftext += String.fromCharCode((c >> 6) | 192);
			utftext += String.fromCharCode((c & 63) | 128);
		} else {
			utftext += String.fromCharCode((c >> 12) | 224);
			utftext += String.fromCharCode(((c >> 6) & 63) | 128);
			utftext += String.fromCharCode((c & 63) | 128);
		}
	}

	return utftext;
}

function utf8_decode(str_data) {
  //  discuss at: http://phpjs.org/functions/utf8_decode/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  //    input by: Aman Gupta
  //    input by: Brett Zamir (http://brett-zamir.me)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Norman "zEh" Fuchs
  // bugfixed by: hitwork
  // bugfixed by: Onno Marsman
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: kirilloid
  //   example 1: utf8_decode('Kevin van Zonneveld');
  //   returns 1: 'Kevin van Zonneveld'

  var tmp_arr = [],
    i = 0,
    ac = 0,
    c1 = 0,
    c2 = 0,
    c3 = 0,
    c4 = 0;

  str_data += '';

  while (i < str_data.length) {
    c1 = str_data.charCodeAt(i);
    if (c1 <= 191) {
      tmp_arr[ac++] = String.fromCharCode(c1);
      i++;
    } else if (c1 <= 223) {
      c2 = str_data.charCodeAt(i + 1);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 31) << 6) | (c2 & 63));
      i += 2;
    } else if (c1 <= 239) {
      // http://en.wikipedia.org/wiki/UTF-8#Codepage_layout
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      tmp_arr[ac++] = String.fromCharCode(((c1 & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
      i += 3;
    } else {
      c2 = str_data.charCodeAt(i + 1);
      c3 = str_data.charCodeAt(i + 2);
      c4 = str_data.charCodeAt(i + 3);
      c1 = ((c1 & 7) << 18) | ((c2 & 63) << 12) | ((c3 & 63) << 6) | (c4 & 63);
      c1 -= 0x10000;
      tmp_arr[ac++] = String.fromCharCode(0xD800 | ((c1 >> 10) & 0x3FF));
      tmp_arr[ac++] = String.fromCharCode(0xDC00 | (c1 & 0x3FF));
      i += 4;
    }
  }

  return tmp_arr.join('');
}



/*Валидация форм*/

	function isValidEmail (email, strict)
	{
		if ( !strict ) email = email.replace(/^s+|s+$/g, '');
		return (/^([a-z0-9_-]+.)*[a-z0-9_-]+@([a-z0-9][a-z0-9-]*[a-z0-9].)+[a-z]{2,4}$/i).test(email);
	}
	
	function isNumeric(value){
		return (/^[\d]+$/g).test(value);
	}
	
	function isRussian(value){
		return (/[а-яА-Я]+/g).test(value);
	}
	
	function checkEmail(val, obj){
		if (val != null && val != "") 
		{
			if (!isValidEmail(val))
			{
				obj.closest('.row_form').addClass("error_row").find('.inp_error').hide();
                                obj.closest('.row_form').removeClass("ok_row");
				obj.closest('.row_form').find('.email_field').show();
			}
			else
			{
				obj.closest('.row_form').removeClass("error_row").find('.email_field').hide();
                                obj.closest('.row_form').addClass("ok_row");
			}
		}
		else
		{
			obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                        obj.closest('.row_form').addClass("ok_row");
		}
	}
	
	function checkNumbers(val, obj){
		if (val != null && val != "") 
		{
			if(isNumeric(val))
			{
				obj.closest('.row_form').removeClass("error_row").find('.number_field').hide();
			}
			else
			{
				obj.closest('.row_form').addClass("error_row").find('.inp_error').hide();
				obj.closest('.row_form').find('.number_field').show();
			}
		}
		else
		{
			obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
		}
	}
	
	function checkLatin(val, obj){
		if (val != null && val != "") 
		{
			if(!isRussian(val))
			{
				obj.closest('.row_form').removeClass("error_row").find('.latin_field').hide();
			}
			else
			{
				obj.closest('.row_form').addClass("error_row").find('.inp_error').hide();
				obj.closest('.row_form').find('.latin_field').show();
			}
		}
		else
		{
			obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
		}
	}
        
        function checkPassword(val, obj){
		if (val != null && val != "") 
		{
			if(isRussian(val))
			{
				obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                obj.closest('.row_form').addClass("error_row").find('.latin_field').show();
                                obj.closest('.row_form').removeClass("ok_row");
			}
                        else if(val.length < 6)
                        {
                                obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                obj.closest('.row_form').addClass("error_row").find('.length_field').show();
                                obj.closest('.row_form').removeClass("ok_row");
                        }
			else
			{
				obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                obj.closest('.row_form').addClass("ok_row");
				//obj.closest('.row_form').find('.latin_field').show();
			}
		}
		else
		{
			obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
		}
	}
        function checkPassword_inp(val, obj){
		if (val != null && val != "") 
		{
			/*if(isRussian(val))
			{
				obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                obj.closest('.row_form').addClass("error_row").find('.latin_field').show();
                                obj.closest('.row_form').removeClass("ok_row");
			}
                        else if(val.length < 6)
                        {
                                obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                obj.closest('.row_form').addClass("error_row").find('.length_field').show();
                                obj.closest('.row_form').removeClass("ok_row");
                        }*/
                        if(val != obj.parent().prev().children('.paswd').val())
                        {
                            obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                            obj.closest('.row_form').addClass("error_row").find('.pass_field').show();
                            obj.closest('.row_form').removeClass("ok_row");
                        }
			else
			{
				obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
                                obj.closest('.row_form').addClass("ok_row");
				//obj.closest('.row_form').find('.latin_field').show();
			}
		}
		else
		{
			obj.closest('.row_form').removeClass("error_row").find('.inp_error').hide();
		}
	}


/*Подгружаем изображение на стороне клиента*/
function handleFileSelect(evt,element) 
{      
    
        
            var input = evt.target; // FileList object
            
            $(element).fileupload({
                    url: '/include/upload_avatar.php',
                    sequentialUploads: true
                });
            
            var reader = new FileReader();
            reader.onload = function(){
                var dataURL = reader.result;
                var img = '<img id="output" src="'+dataURL+'"/>';
                $('#pre img').hide();
                $('#img-res').html(img); 
                    
                    $('#output').cropper({
                      aspectRatio: 1 / 1,
                      autoCropArea: 0.65,
                      strict: false,
                      guides: false,
                      highlight: false,
                      dragCrop: false,
                      movable: false,
                      resizable: true,
                    });                    
                };
            reader.readAsDataURL(input.files[0]);
            console.log(input.files[0]);
            //$('#ok_avatar').click(function(){
                var name_file = input.files[0]["name"];
                
                $('#ok_avatar').attr('onclick','avatar_pic("'+translite(name_file)+'")');
                /*$(element).fileupload({
                    url: '/include/upload_avatar.php',
                    sequentialUploads: true
                });*/
            //})
            //$('#ok_avatar').attr('onclick','avatar_pic(event,"'+element+'")');
             
}
function avatar_pic(name)
{
     var x = $('#output').cropper("getData")["x"];
     var y = $('#output').cropper("getData")["y"];
     var width = $('#output').cropper("getData")["width"];
     var height = $('#output').cropper("getData")["height"];
     var file_name = name;
     
     $.ajax({
            url: '/include/avatar_ok.php',
           // type: 'get',
            //dataType: 'json',
            data: {x:x,y:y,width:width,height:height,file_name:file_name},
            success: function(data)
            {
                $('.boxshadow').hide();
                $('.img-resize').hide();
                console.log($('#avatar'));
                //$('#new_avatar_in') = $('#avatar');
                $('#new_avatar_in').attr('value','http://'+location.host+'/images/avatar/av_'+file_name);
                $('#newfile-avatar').html(data);
                //console.log(data);
            }
    });
    
     
}


function close_modal(){
    $('.boxshadow').hide();
    $('.modal').hide();
    $('#img-res').html('<img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">'); 
}


/*events*/
function next_page_events(event,el,date,page)
{
     event.stopPropagation();
     event.preventDefault();
     
    if($('.calendar .date').hasClass("active") == true)
    {
        date = $('.calendar .date.active').attr('data-time');
    }

    var search_text = $('.search #ajax-search').val();
    
    var page_filter = '/include/nextpage_events.php';
    
    var button = $(el);
    var button_parent = $(el).parent();
    var preloader = $(el).next();
    button.css('display','none');
    //button_parent.css('display','none');
    preloader.css('display','inline-block');

    $.ajax({
            url: page_filter,
            type: 'get',
            data: {date: date, search: search_text,PAGEN_1: page},
            success: function(data)
            {
                //preloader.css('display','none');
                //button.css('display','block');
                preloader.remove();
                button.remove();
                button_parent.remove();
                $('#material').append(data);
            }
    });
    
}
function select_date_events(event,element,date)
{
        event.stopPropagation();
        event.preventDefault();
        $('.calendar .date').removeClass('active');
        //event.stopPropagation();
        $('#date_'+element+'_events').addClass('active');
        $("input#ajax-search-button").trigger('click');
        
}
function ajaxsearch_events(){
    filter_events();
}
function filter_events(){
    
    date = $('.calendar .date.active').attr('data-time');
    
    History.pushState(null, "Crado | Портал активного отдыха в Сургуте", "?date="+date);
    
    var search_text = $('.search #ajax-search').val();
    var page = 1;
    var page_filter = '/include/page_filter_events.php';
    $('#material').html('');
    $('.content-preloader').css('display','block');
    $.ajax({
            url: page_filter,
            type: 'get',
            data: {date: date, search: search_text,PAGEN_1: page},
            success: function(data)
            {
                $('.content-preloader').css('display','none');
                $('#material').html(data);
            }
    });
}

function other_date_events(event){
    event.stopPropagation();
    event.preventDefault();
    if($('#other_date_events').hasClass("active") != true)
      {
            $('#other_date_events').addClass('active');
      }
      else
      {
            $('#other_date_events').removeClass('active');
      }
}
/**/


/*place*/
function filter_places(){

    var search_text = $('.search #ajax-search').val();
    var page = 1;
    var page_filter = '/include/page_filter_places.php';
    $('#material').html('');
    $('.content-preloader').css('display','block');
    $.ajax({
            url: page_filter,
            type: 'get',
            data: {search: search_text,PAGEN_1: page},
            success: function(data)
            {
                $('.content-preloader').css('display','none');
                $('#material').html(data);
            }
    });
}

function next_page_places(event,el,page)
{
     event.stopPropagation();
     event.preventDefault();
     
    var search_text = $('.search #ajax-search').val();
    
    var page_filter = '/include/nextpage_places.php';
    
    var button = $(el);
    var button_parent = $(el).parent();
    var preloader = $(el).next();
    button.css('display','none');
    //button_parent.css('display','none');
    preloader.css('display','inline-block');

    $.ajax({
            url: page_filter,
            type: 'get',
            data: { search: search_text,PAGEN_1: page},
            success: function(data)
            {
                //preloader.css('display','none');
                //button.css('display','block');
                preloader.remove();
                button.remove();
                button_parent.remove();
                $('#material').append(data);
            }
    });
    
}
function ajaxsearch_places(){
    filter_places();
}
/**/



/*shops*/
function filter_shops(){

    var search_text = $('.search #ajax-search').val();
    var page = 1;
    var page_filter = '/include/page_filter_shops.php';
    $('#material').html('');
    $('.content-preloader').css('display','block');
    $.ajax({
            url: page_filter,
            type: 'get',
            data: {search: search_text,PAGEN_1: page},
            success: function(data)
            {
                $('.content-preloader').css('display','none');
                $('#material').html(data);
            }
    });
}

function next_page_shops(event,el,page)
{
     event.stopPropagation();
     event.preventDefault();
     
    var search_text = $('.search #ajax-search').val();
    
    var page_filter = '/include/nextpage_shops.php';
    
    var button = $(el);
    var button_parent = $(el).parent();
    var preloader = $(el).next();
    button.css('display','none');
    //button_parent.css('display','none');
    preloader.css('display','inline-block');

    $.ajax({
            url: page_filter,
            type: 'get',
            data: { search: search_text,PAGEN_1: page},
            success: function(data)
            {
                //preloader.css('display','none');
                //button.css('display','block');
                preloader.remove();
                button.remove();
                button_parent.remove();
                $('#material').append(data);
            }
    });
    
}
function ajaxsearch_shops(){
    filter_shops();
}
/**/



/*tag*/
/*Следующая страница категории*/
function next_page_tag(event,el,metka,page)
{
     event.stopPropagation();
     event.preventDefault();
     
    if($('.calendar .date').hasClass("active") == true)
    {
        date = $('.calendar .date.active').attr('data-time');
    }

    var search_text = $('.search #ajax-search').val();
    
    var page_filter = '/include/nextpage_tag.php';
    
    var button = $(el);
    var preloader = $(el).next();
    button.css('display','none');
    preloader.css('display','inline-block');

    $.ajax({
            url: page_filter,
            type: 'get',
            data: {metka: metka, search: search_text,PAGEN_1: page},
            success: function(data)
            {
                //preloader.css('display','none');
                //button.css('display','block');
                preloader.remove();
                button.parent().remove();
                $('#material').append(data);
            }
    });
    
}

function ajaxsearch_tag(metka)
{
	var search_text = $('.search #ajax-search').val();
    var page = 1;
    var page_filter = '/include/nextpage_tag.php';
    $('#material').html('');
    $('.content-preloader').css('display','block');
    $.ajax({
            url: page_filter,
            type: 'get',
            data: {metka: metka,search: search_text,PAGEN_1: page},
            success: function(data)
            {
                $('.content-preloader').css('display','none');
                $('#material').html(data);
            }
    });
}
/**/
/**/


/*share social*/

Share = {
    vkontakte: function(purl, ptitle, pimg, text) {
        url  = "http://vkontakte.ru/share.php?";
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&image='       + encodeURIComponent(pimg);
        url += '&noparse=true';
        soc = 'UF_VK';
        Share.popup(url,soc);
    },
    odnoklassniki: function(purl, text) {
        url  = 'http://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1';
        url += '&st.comments=' + text;
        url += '&st._surl='    + encodeURIComponent(purl);
        soc = 'UF_OD';
        Share.popup(url,soc);
    },
    facebook: function(purl, ptitle, pimg, text) {
        url  = 'http://www.facebook.com/sharer.php?';
      // url += '&p[title]='     + encodeURIComponent(ptitle);
        //url += '&p[summary]='   + text;
        //url += '&p[description]='   + encodeURIComponent(text);
        url += 'u='       + encodeURIComponent(purl);
        //url += '&p[images][0]=' + encodeURIComponent(pimg);*/
        soc = 'UF_FB';
        Share.popup(url,soc);
    },
    twitter: function(purl, ptitle) {
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(ptitle);
        url += '&url='      + encodeURIComponent(purl);
        url += '&counturl=' + encodeURIComponent(purl);
        soc = 'UF_TW';
        Share.popup(url,soc);
    },
    mailru: function(purl, ptitle, pimg, text) {
        url  = 'http://connect.mail.ru/share?';
        url += 'url='          + encodeURIComponent(purl);
        url += '&title='       + encodeURIComponent(ptitle);
        url += '&description=' + encodeURIComponent(text);
        url += '&imageurl='    + encodeURIComponent(pimg);
        soc = 'UF_MAIL';
        Share.popup(url,soc)
    },
    
            me : function(el){
                //console.log(el.href);                
                Share.popup(el.href);
                return false;                
            },

    popup: function(url,soc) {
        var share = window.open(url,'','toolbar=0,status=0,width=626,height=436');
        
        /*$(share).onbeforeunload = function() {
            alert("Bye now!");
        };*/
		
		var href = window.location.href;
		var href_array = href.split('//');
		href = "//"+href_array[1];
		
        $.post('/include/social_share.php', {social:soc, page:href}, function (data){
            
        });
    }
};

function translite(str){
var arr={"а" : "a", 
            "б" : "b", 
            "в" : "v", 
            "г" : "g", 
            "д" : "d", 
            "е" : "e", 
            "ё" : "e", 
            "ж" : "zh", 
            "з" : "z", 
            "и" : "i", 
            "й" : "y", 
            "к" : "k", 
            "л" : "l", 
            "м" : "m", 
            "н" : "n", 
            "о" : "o", 
            "п" : "p", 
            "р" : "r", 
            "с" : "s", 
            "т" : "t", 
            "у" : "u", 
            "ф" : "f", 
            "х" : "kh", 
            "ц" : "ts", 
            "ч" : "ch", 
            "ш" : "sh", 
            "щ" : "shch", 
            "ы" : "y", 
            "э" : "e", 
            "ю" : "yu", 
            "я" : "ya", 
            "А" : "A", 
            "Б" : "B", 
            "В" : "V", 
            "Г" : "G", 
            "Д" : "D", 
            "Е" : "E", 
            "Ё" : "E", 
            "Ж" : "Zh", 
            "З" : "Z", 
            "И" : "I", 
            "Й" : "Y", 
            "К" : "K", 
            "Л" : "L", 
            "М" : "M", 
            "Н" : "N", 
            "О" : "O", 
            "П" : "P", 
            "Р" : "R", 
            "С" : "S", 
            "Т" : "T", 
            "У" : "U", 
            "Ф" : "F", 
            "Х" : "Kh", 
            "Ц" : "Ts", 
            "Ч" : "Ch", 
            "Ш" : "Sh", 
            "Щ" : "Shch", 
            "Ы" : "Y", 
            "Э" : "E", 
            "Ю" : "Yu", 
            "Я" : "Ya", 
            "Ъ" : "", 
            "ъ" : "", 
            "ь" : "", 
            "Ь" : "",
            " " : "_",
            "," : "_",
            "_" : "_",
};
var replacer=function(a){return arr[a]||a};
return str.replace(/[А-яёЁ]/g,replacer)
}

/**/




/*login shadow close*/
function close_modal_login(id){
    $('.boxshadow-login').hide();
    $('.modal').hide();
    $('#login-white').removeClass('active');
    //$('#img-res').html('<img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">'); 
}
function close_modal_login_fixed(){
    $('.boxshadow-login-fixed').hide();
    $('.modal').hide();
    $('#login-black').removeClass('active');
    //$('#img-res').html('<img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">'); 
}

function setLogin(event)
{
    $('input.login_input').val($(event).val());
}