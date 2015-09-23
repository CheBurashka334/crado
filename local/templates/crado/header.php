<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
    
    /*переменные цвета*/
    $white = '#ffffff';
    $black = '#252525';
    $red = '#f44336';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="google-site-verification" content="QyiSq04P1dhgq5sCGUaxWTnhBkJHLLZchVYJnSO2xsE" />
		<meta name='yandex-verification' content='67f801eff8c4c97f' />
		<meta name="cmsmagazine" content="5df16b60da1e507321e45caa359f551e" />
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/history/bundled/html4+html5/jquery.history.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/datapicker-ru.js"></script>
        <link href="<?=SITE_TEMPLATE_PATH?>/css/datapicker/jquery-ui.css" rel="stylesheet"> 
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/main.css" type="text/css" />
        <link rel="stylesheet" href="<?=SITE_TEMPLATE_PATH?>/css/cropper.min.css" type="text/css" />
        <?$APPLICATION->ShowHead();?>
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
        <script src="<?=SITE_TEMPLATE_PATH?>/js/jscarousel.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.fileupload.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/script.js"></script>
        <script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/functions.js"  charset="windows-1251"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/svg-icon.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/cropper.min.js"></script>
        <script src="<?=SITE_TEMPLATE_PATH?>/js/main.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mousewheel.min.js"></script>
        <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
        <meta name="viewport" content="width=1020">
		<meta property="og:image" content="<?echo $APPLICATION->ShowProperty("og:image");?>"/>
		<meta property="og:url" content="<?echo $APPLICATION->ShowProperty("og:url");?>"/>
		<meta property="og:title" content="<?echo $APPLICATION->ShowProperty("og:title");?>"/>
		<meta property="og:description" content="<?echo $APPLICATION->ShowProperty("og:description");?>"/>
	</head>
	
	<?
		//настройки сайта
		$APPLICATION->IncludeComponent(
                                	"bitrix:main.include",
                                	"",
                                	Array(
                                		"COMPONENT_TEMPLATE" => ".default",
                                		"AREA_FILE_SHOW" => "file",
                                		"AREA_FILE_SUFFIX" => "inc",
                                		"EDIT_TEMPLATE" => "",
                                		"PATH" => "/include/option_site.php"
                                	)
                                );?>

	
	<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter31582383 = new Ya.Metrika({
                    id:31582383,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/31582383" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60140498-5', 'auto');
  ga('send', 'pageview');

</script>
		<?global $USER;?>
		<div id="panel">
			<?$APPLICATION->ShowPanel();?>
		</div>
        <?/*svg*/?>
        <?include $_SERVER["DOCUMENT_ROOT"].'/include/svg.php';?>
        <?/*?>
        <div id="svg-icon-placeholder" style="display: none;"></div>
        <script>
            /*$(document).ready(function(){
	           $('#svg-icon-placeholder').html(icon);
            })        </script>*/?>
        <?/*<div class="search-input">
            <div class="container">
                <form action="/search/" method="get">
                    <input name="q" type="text" class="" value=""/>
                    <input name="" type="submit" value="Искать"/>
                </form>
            </div>
        </div>*/?>
        <?/*категории меню*/?>
        <? if (strripos($APPLICATION->GetCurPage(false), '_city/')): ?>
            <div class="top-block">
                                <?$APPLICATION->IncludeComponent(
                                	"bitrix:main.include",
                                	"",
                                	Array(
                                		"COMPONENT_TEMPLATE" => ".default",
                                		"AREA_FILE_SHOW" => "file",
                                		"AREA_FILE_SUFFIX" => "inc",
                                		"EDIT_TEMPLATE" => "",
                                		"PATH" => "/include/top_category.php"
                                	)
                                );?>
                            </div>
            <?endif;?>
        <?/**/?>
        <?if($APPLICATION->GetCurPage(false)=='/'):?>
            <div class="left-block">
                <?$APPLICATION->IncludeComponent(
                	"bitrix:main.include",
                	"",
                	Array(
                		"COMPONENT_TEMPLATE" => ".default",
                		"AREA_FILE_SHOW" => "file",
                		"AREA_FILE_SUFFIX" => "inc",
                		"EDIT_TEMPLATE" => "",
                		"PATH" => "/include/left_menu.php"
                	)
                );?>
            </div>
            
            <div class="container w990 header-modal">
                        <div class="modal auth" id="modal-white-login" style="display: none;">
                            <?if($USER->IsAuthorized()):?>
                                 <?$APPLICATION->IncludeComponent(
                                	"bitrix:main.include",
                                	"",
                                	Array(
                                		"COMPONENT_TEMPLATE" => ".default",
                                		"AREA_FILE_SHOW" => "file",
                                		"AREA_FILE_SUFFIX" => "inc",
                                		"EDIT_TEMPLATE" => "",
                                		"PATH" => "/include/auth.php"
                                	)
                                );?>
                            <?else:?>
                            <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","auth",Array(
                                                                         "REGISTER_URL" => "/login/register/",
                                                                         "FORGOT_PASSWORD_URL" => "/login/auth/",
                                                                         "PROFILE_URL" => "/login/personal/",
                                                                         "SHOW_ERRORS" => "Y" 
                                                                         )
                            );?>
                            <?endif;?>
                        </div>
            </div>
        
        
            <div class="menu index">
                <div class="container">
                    <div class="row">
                        <div class="col-3">
                                <a href="javascript:void(0)" class="item col-3 main" id="main" rel="nofollow">Меню</a>
                        </div>
                        <div class="col-6">
                            <div class="row parent">
                                    <a href="/in_city/" class="col-6 item">Отдых в городе</a>
                                    <a href="/out_city/" class="col-6 item">Отдых за городом</a>
                            </div>
                        </div>
                        <div class="col-3 parent">
                            <div class="col-6 null"></div>
                                    <a href="javascript:void(0);" class="item col-3 h60 h-black lk" id="login-white">
                                        <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lk-icon"></use></svg>
                                    </a>
                                    <a href="javascript:void(0);" class="item col-3 h-black h60" id="search">
                                        <svg class="icons w12 search-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon"></use></svg>
                                        <svg class="icons w12 close-svg" style="display:none;"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close-icon"></use></svg>
                                    </a>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="crado" id="crado">
				<?
					$file = CFile::GetPath($GLOBALS['options_field']['PREVIEW_PICTURE']);
				?>
                <div class="crado-absolute" style="background-image: url('<?=$file?>');">
                    <div class="table">
                        <div class="shadow"></div>
                        <div class="table-cell text-center logo">
                                <img src="/images/logo-index.png" alt="CRADO"/>
                                <?if($GLOBALS['options_props']['slogan']['USER_TYPE'] == 'HTML'):?>
                                    <?=$GLOBALS['options_props']['slogan']['~VALUE']['TEXT'];?>
                                <?else:?>
                                    <?=$GLOBALS['options_props']['slogan']['~VALUE']['TEXT'];?>
                                <?endif;?>
                             <div class="mouse-scroll"> 
								<span class="mouse">
									<span class="mouse-movement"> 
								</span>
							  </span>
								<?/*<span class="mouse-message fadeIn">scroll</span> */?>
							</div>   
                        </div>
                    </div>
                </div>
            </div>
			<script>
			/*Скрипт прокрутки на главной*/
			$('.crado-absolute').mousewheel(function(event) {
				
				//console.log(event.deltaX, event.deltaY, event.deltaFactor);
				if(event.deltaY <= 0)
				{
					event.preventDefault(); 
					event.stopPropagation(); 
					$("html,body").stop().animate( { 
					scrollTop : $(this).height()+45 
					} , 300 , 'easeInOutCubic' );
				}
			});
			</script>
        <?else:?>
	       <?/*<div><a href="/">На главную</a></div>*/?>
        <?endif;?>
        <div class="search-input <?if($APPLICATION->GetCurPage(false)=='/'):?>home<?else:?>no-home<?endif;?>">
            <div class="container">
                <form action="/search/" method="get">
                    <input name="q" type="text" class="" value=""/>
                    <input name="" type="submit" value="Искать"/>
                </form>
            </div>
        </div>
           <div class="menu <?if($APPLICATION->GetCurPage(false)=='/'):?>home<?else:?>no-home<?endif;?>">
                <div class="container">
                    <div class="row">
                        
                        <div class="<? if (strripos($APPLICATION->GetCurPage(false), '_city/') === false): ?>col-3<?else:?>col-2<?endif;?>">
                            <a href="/" class="item-logo col-3 main white icons-logo">
                                <svg class="icons"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#crado-icon"></use></svg>
                            </a>
                        </div>
                        <? if (strripos($APPLICATION->GetCurPage(false), '_city/') === false): ?>
                        <?else:?>
                            <?/*Кактегории*/?>
                            <div class="col-1">
                                    <a href="javascript:void(0)" class="category col-12 main" id="category" rel="nofollow" style="display: block;">Категории</a>
                            </div>
                            <?/**/?>
                        <?endif;?>
                        <div class="col-6">
                            <div class="row parent">
                                    <a href="/in_city/" class="col-6 item <?if($APPLICATION->GetCurPage(false)=='/in_city/'):?>active<?endif;?>">Отдых в городе</a>
                                    <a href="/out_city/" class="col-6 item <?if($APPLICATION->GetCurPage(false)=='/out_city/'):?>active<?endif;?>">Отдых за городом</a>
                            </div>
                        </div>
                        <div class="col-3 parent">
                            <div class="col-6 null"></div>
                                    <a href="javascript:void(0);" class="item col-3 white h60 lk" id="login-black">
                                        <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#lk-icon"></use></svg>
                                    </a>
                                    <a href="javascript:void(0);" class="item col-3 white h60" id="search-black">
                                    <svg class="icons w12 search-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#search-icon"></use></svg>
                                    <svg class="icons w12 close-svg" style="display:none;"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#close-icon"></use></svg>
                                </a>
                        </div>
                    </div>
                    <?/*
                    <div class="modal auth">
                        <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","auth",Array(
                                                                     "REGISTER_URL" => "/login/register/",
                                                                     "FORGOT_PASSWORD_URL" => "/login/auth/",
                                                                     "PROFILE_URL" => "/login/personal/",
                                                                     "SHOW_ERRORS" => "Y" 
                                                                     )
                        );?>
                    </div> 
                    */?>
                </div>
                 <div class="boxshadow-login-fixed" style="display: none;" onclick="close_modal_login_fixed();"></div>
                 <div class="container w990 header-modal">
                        <div class="modal auth black" id="modal-black-login" style="display: none;">
                            <?if($USER->IsAuthorized()):?>
                                 <?$APPLICATION->IncludeComponent(
                                	"bitrix:main.include",
                                	"",
                                	Array(
                                		"COMPONENT_TEMPLATE" => ".default",
                                		"AREA_FILE_SHOW" => "file",
                                		"AREA_FILE_SUFFIX" => "inc",
                                		"EDIT_TEMPLATE" => "",
                                		"PATH" => "/include/auth.php"
                                	)
                                );?>
                            <?else:?>
                            <?$APPLICATION->IncludeComponent("bitrix:system.auth.form","auth",Array(
                                                                         "REGISTER_URL" => "/login/register/",
                                                                         "FORGOT_PASSWORD_URL" => "/login/auth/",
                                                                         "PROFILE_URL" => "/login/personal/",
                                                                         "SHOW_ERRORS" => "Y" 
                                                                         )
                            );?>
                            <?endif;?>
                        </div>
                </div>
            </div>
            <div class="workarea <?if($APPLICATION->GetCurPage(false)!='/'):?>all<?endif;?>">
						