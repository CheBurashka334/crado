<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("События");
?>
<div class="bgray-light">
    <div class="container">
		<?
			//Хлебные крошки
		?> 
		<?
			$APPLICATION->IncludeComponent("ls:breadcrumb","",Array(
				"START_FROM" => "0", 
				"PATH" => "", 
				"SITE_ID" => "s1" 
			)
			);
		?>
		<?
			//
		?>
        <div class="pad_40_0">
            <h1><?=$APPLICATION->ShowTitle('h1');?></h1>
        </div>
            <div class="search">
                                <input type="text" id="ajax-search" onkeypress="if (event.keyCode == 13) ajaxsearch_events()" placeholder="Быстрый поиск"/>
                                <input type="submit" id="ajax-search-button" onclick="ajaxsearch_events()" value="Искать"/>
                        </div>
                            
                            <?
                                $iblok_id = '2';
                                
                                $arrFilter = Array(
                                    "PROPERTY_type"=>'2',
                                );
                            ?>
                            <?
                                if($_GET['date'] != ''){
                                    
                                    $arrFilter['>=DATE_ACTIVE_TO'] = $date;
                                }
                            ?>
                            <div class="filter_type"> 
                                    <?/*<span href="#" onclick="clear_filter()">
                                        Сбросить все
                                    </span>*/?>
                                </div>
                                <div class="row parent-calendar" style="opacity: 1; display: block;">
                                    <div class="calendar right table">
                                        <?
                                                    date_default_timezone_set("UTC"); // Устанавливаем часовой пояс по Гринвичу
                                                    $time = time(); // Вот это значение отправляем в базу
                                                    $offset = 5; // Допустим, у пользователя смещение относительно Гринвича составляет +3 часа
                                                    $time += 5 * 3600; // Добавляем 3 часа к времени по Гринвичу
                                        ?>
                                                <a class="w60 h60 black text-center table-cell date" href="" id="date_all_events" onclick="select_date_events(event,'all','all')" data-time="" rel="nofollow">Все</a>
                                            <?
                                                $date = $_GET['date'];
                                            ?>
                                            <?for($a=0; $a<=12;$a++){?>
                                                <a class="w60 h60 black text-center table-cell date <?if($a==0):?>borderleft<?endif;?> <?if ($date == date('d.m.Y',$time + 24*$a * 60 * 60)):?>active<?endif;?>" href="" id="date_<?=($time + 24*$a * 60 * 60);?>_events" onclick="select_date_events(event,'<?=($time + 24*$a * 60 * 60);?>','<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>')" data-time="<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>" rel="nofollow">
                                                    <p class="day">
                                                        <?echo date('j',$time + 24*$a * 60 * 60);?>
                                                    </p>
                                                    <p class="week">
                                                        <?echo uWeek(date('D',$time + 24*$a * 60 * 60));?>
                                                    </p>
                                                </a>
                                            <?}?>
                                            <a class="w150 h60 black text-center table-cell date" href="" onclick="other_date_events(event)" id="date_other_events" rel="nofollow">Другая дата
                                                <div class="trigon"></div>
                                            </a>
                                    </div>
                                    <div class="other_date" id="other_date_events"></div>
                                </div>
                        <div class="content-preloader text-center" style="display: none;">
                            <img class="preloader" src="/images/tail-spin.svg" width="50" alt="">
                        </div>        
                        <div class="pad_20_0 small-block" id="material">
                            <!-- Материал -->
                            <?$APPLICATION->IncludeComponent(
                            	"ls:news.list",
                            	"small-block-events",
                            	Array(
                            		"IBLOCK_TYPE" => "content",
                            		"IBLOCK_ID" => '2',
                            		"NEWS_COUNT" => $GLOBALS['options_props']['count_element']['~VALUE'],
                            		"SORT_BY1" => "ACTIVE_FROM",
                            		"SORT_ORDER1" => "DESC",
                            		"SORT_BY2" => "SORT",
                            		"SORT_ORDER2" => "ASC",
                
                            		"FILTER_NAME" => "arrFilter",
                            		"FIELD_CODE" => array("ACTIVE_TO","ACTIVE_FROM"),
                            		"PROPERTY_CODE" => array("category",'type','event_place','address','metka'),
                            		"CHECK_DATES" => "Y",
                            		"DETAIL_URL" => "",
                            		"AJAX_MODE" => "Y",
                            		"AJAX_OPTION_JUMP" => "Y",
                            		"AJAX_OPTION_STYLE" => "Y",
                            		"AJAX_OPTION_HISTORY" => "Y",
                            		"CACHE_TYPE" => "A",
                            		"CACHE_TIME" => "36000000",
                            		"CACHE_FILTER" => "Y",
                            		"CACHE_GROUPS" => "Y",
                            		"PREVIEW_TRUNCATE_LEN" => "",
                            		"ACTIVE_DATE_FORMAT" => "d.m.Y",
                            		"SET_TITLE" => "N",
                            		"SET_BROWSER_TITLE" => "N",
                            		"SET_META_KEYWORDS" => "N",
                            		"SET_META_DESCRIPTION" => "N",
                            		"SET_STATUS_404" => "N",
                            		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            		"ADD_SECTIONS_CHAIN" => "Y",
                            		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            		"PARENT_SECTION" => "",
                            		"PARENT_SECTION_CODE" => "",
                            		"INCLUDE_SUBSECTIONS" => "Y",
                            		"DISPLAY_DATE" => "Y",
                            		"DISPLAY_NAME" => "Y",
                            		"DISPLAY_PICTURE" => "Y",
                            		"DISPLAY_PREVIEW_TEXT" => "Y",
                            		"PAGER_TEMPLATE" => ".default",
                            		"DISPLAY_TOP_PAGER" => "N",
                            		"DISPLAY_BOTTOM_PAGER" => "Y",
                            		"PAGER_TITLE" => "Новости",
                            		"PAGER_SHOW_ALWAYS" => "Y",
                            		"PAGER_DESC_NUMBERING" => "N",
                            		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            		"PAGER_SHOW_ALL" => "Y"
                            	)
                            );?>
                            <?//include_once $_SERVER['DOCUMENT_ROOT']."/include/in_city_material.php";?>
                            
                            
                        </div>
                        <div class="pad_50_0 text-center">
                            Crado - ваш гид по активному отдыху в городе Сургуте. Лучшие места и события в Сургуте. 
                        </div>
                                
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
    function sort_p($a, $b)
    {
        return strcmp($a["type"], $b["type"]);
    }
    function sort_c($a, $b)
    {
        return strcmp($a["NAME_CATEGORY"], $b["NAME_CATEGORY"]);
    }
?>