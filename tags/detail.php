<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Метка");
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
		
		                            <?
                                $iblok_id = '2';
                                $tag =  $_SERVER['REQUEST_URI'];
                                $tag = explode("?", $tag);
                                $tag = explode("/", $tag[0]);
                            ?>
                            
                            <?
                                $array_empty = array('');
                                $tags = array();
                                $tag = array_diff($tag, $array_empty);
                                foreach($tag as $item):
                                    array_push($tags ,$item);
                                endforeach;
                            ?>
                         <?
                                //$arr = list_category($cat[count($cat)-1]);
                                
                                /*Получаем значение где(в городе /за городом)*/
                                /**$params = $cat[count($cat)-2];
                                $city = $params;*/
								$metka_id = '';
                                CModule::IncludeModule("iblock");
                                $arSel = Array("ID","NAME");
                                $arFil = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",'CODE'=>$tags[count($tags)-1]);
                                $res = CIBlockElement::GetList(Array(), $arFil, false, Array("nPageSize"=>150), $arSel);
                                while($ob = $res->GetNextElement())
                                {
                                    $arFields = $ob->GetFields();
                                    $metka_id = $arFields['ID'];
                                    $name = $arFields['NAME'];
                                }
                                global $arrFilter;
                                $arrFilter = Array(
                                array(
                                    "LOGIC" => "OR",
                                        array("PROPERTY_metka"=>$metka_id),
                                        array("PROPERTY_dop_metka"=>$metka_id)
                                )
                                );?>
                                <?
								//echo $metka_id;
								//Редирект на 404
							   if($metka_id == '')
							   {
								   LocalRedirect("/404.php", "404 Not Found");
							   }
								?>
                        <div class="search">
                                <input type="text" id="ajax-search" onkeypress="if (event.keyCode == 13) ajaxsearch_tag('<?=$metka_id?>')" placeholder="Быстрый поиск"/>
                                <input type="submit" id="ajax-search-button" onclick="ajaxsearch_tag('<?=$metka_id?>')" value="Искать"/>
                        </div>

                                <?
                                    $APPLICATION->SetTitle(''.$name);    
                                    $APPLICATION->SetPageProperty('title', ''.$name);
                                ?>
                        <div class="content-preloader text-center" style="display: none;">
                            <img class="preloader" src="/images/tail-spin.svg" width="50" alt="">
                        </div> 
						<?
							//Добавляем новый путь
							$APPLICATION->AddChainItem($name, "");
						?>						
                        <div class="pad_20_0 small-block" id="material">
                            <!-- Материал -->
                            <?$APPLICATION->IncludeComponent(
                            	"ls:news.list",
                            	"small-block-tag",
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
                            		"PROPERTY_CODE" => array("category",'type','event_place','address','metka','date_active_from'),
                            		"CHECK_DATES" => "Y",
                            		"DETAIL_URL" => "",
                            		"AJAX_MODE" => "N",
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
                            		"ADD_SECTIONS_CHAIN" => "N",
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
                            		"PAGER_SHOW_ALL" => "Y",
									"metka_id" => $metka_id
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