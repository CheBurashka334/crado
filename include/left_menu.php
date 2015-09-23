<div class="left-header table">
    <div class="close">
        <svg class="icons w12 close-svg" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close-icon"></use></svg>
    </div>
    <div class="table-cell">
        <a href="/">
          <img src="/images/logo-footer.png"/>
        </a>
    </div>
</div>
<div class="items">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"left-menu-crado",
	Array(
		"COMPONENT_TEMPLATE" => "",
		"ROOT_MENU_TYPE" => "left",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(""),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	)
);?>
</div>
<div class="left-footer">
    <div class="text-center">
        info@crado.ru
    </div>

    <div class="text-center pad_15_15">
        <a href="<?=$GLOBALS['options_props']['vk']['~VALUE']?>" class="vkontakte" target="_blank" rel="nofollow"> </a>
        <a href="<?=$GLOBALS['options_props']['fb']['~VALUE']?>" class="facebook" target="_blank" rel="nofollow"> </a>
		<a href="<?=$GLOBALS['options_props']['in']['~VALUE']?>" class="instogram" target="_blank" rel="nofollow"> </a>
    </div>
    <div class="text-center">
        © Crado <?=date('Y');?>
    </div>
     <div class="text-center">
        Разработка сайта - <a href="http://legacystudio.ru" target="_blank" >Legacy</a>
    </div>
</div>

<script>
$(document).ready(function(){
   $('#main').click(function(){
        if($('.left-block').hasClass('active'))
        {
            $('.boxshadow-leftmenu').hide();
            $('.left-block').removeClass('active');
            $('.left-block').animate({
                //opacity: 0,
                left: -240
              }, 250);   
        }
        else
        {
            $('.boxshadow-leftmenu').show();
            $('.left-block').addClass('active');
            $('.left-block').animate({
                //opacity: 1,
                left: 0
              }, 250);   
        }
   });
   $('.left-header .close').click(function(){
        if($('.left-block').hasClass('active'))
        {
            $('.boxshadow-leftmenu').hide();
            $('.left-block').removeClass('active');
            $('.left-block').animate({
                //opacity: 0,
                left: -240
              }, 250);   
        }
        else
        {
            $('.boxshadow-leftmenu').show();
            $('.left-block').addClass('active');
            $('.left-block').animate({
                //opacity: 1,
                left: 0
              }, 250);   
        } 
   });
   $('.boxshadow-leftmenu').click(function(){
        $('.boxshadow-leftmenu').hide();
        $('.left-header .close').trigger('click');
   });
});
</script>