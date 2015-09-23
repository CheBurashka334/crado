<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
    </div>
    <div class="footer bblack">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <a href="/">
                        <img src="/images/logo-footer.png"/>
                    </a>
                </div>
                <div class="col-6">
                    <?$APPLICATION->IncludeComponent(
                    	"bitrix:main.include",
                    	"",
                    	Array(
                    		"COMPONENT_TEMPLATE" => ".default",
                    		"AREA_FILE_SHOW" => "file",
                    		"AREA_FILE_SUFFIX" => "inc",
                    		"EDIT_TEMPLATE" => "",
                    		"PATH" => "/include/footer_menu.php"
                    	)
                    );?>
                </div>
                <?
                    
                ?>
                <div class="col-3 text-right">
                    <a href="mailto:info@crado.ru">info@crado.ru</a>
                    <div class="social-footer">
                        <a href="<?=$GLOBALS['options_props']['vk']['~VALUE']?>" class="vkontakte" target="_blank" rel="nofollow"> </a>
                        <a href="<?=$GLOBALS['options_props']['fb']['~VALUE']?>" class="facebook" target="_blank" rel="nofollow"> </a>
						<a href="<?=$GLOBALS['options_props']['in']['~VALUE']?>" class="instogram" target="_blank" rel="nofollow"> </a>
                    </div>
                    
                </div>
            </div>
            <div class="row pad_20_0">
                <div class="col-6 text-left white">© Crado <?=date('Y');?></div>
                <div class="col-6 text-right white">
                    <div class="razrab">Разработка сайта - <a href="http://legacystudio.ru" target="_blank" >Legacy</a> </div>
                </div>
            </div>
        </div>
    </div>
        <div class="modal img-resize" style="display: none;">
            <div class="container">
                <span class="close" onclick="close_modal();"><svg class="icons w12 close-svg" style=""><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close-icon"></use></svg></span>
                <h3>Выделите область изображения, которую хотите поместить на аватарку, и нажмите на кнопку Сохранить.</h3>
    	        <div class="text-center" id="img-res">
                    <img id="output"/>
                </div>
                <div class="text-center" id="pre">
                    <img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">
                </div>
            	<input type="hidden" id="x" name="x" />
            	<input type="hidden" id="y" name="y" />
            	<input type="hidden" id="w" name="w" />
            	<input type="hidden" id="h" name="h" />
                <input type="button" class="button" id="ok_avatar" value="Применить"/>
            </div>
            
        </div>
            
        <div class="boxshadow" style="display: none;" onclick="close_modal();"></div>
        
        <div class="boxshadow-login" style="display: none;" onclick="close_modal_login();"></div>
        
        <div class="boxshadow-leftmenu" style="display: none;"></div>
	</body>
</html>