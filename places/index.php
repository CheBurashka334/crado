<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("�����");
?>
<div class="bgray-light">
    <div class="container">
		<?
			//������� ������
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
                                <input type="text" id="ajax-search" onkeypress="if (event.keyCode == 13) ajaxsearch_places()" placeholder="������� �����"/>
                                <input type="submit" id="ajax-search-button" onclick="ajaxsearch_places()" value="������"/>
                        </div>
                            <?
                                $iblok_id = '2';
                                
                                $arrFilter = Array(
                                    "PROPERTY_type"=>'1',
                                );
                            ?>
                        <div class="content-preloader text-center" style="display: none;">
                            <img class="preloader" src="/images/tail-spin.svg" width="50" alt="">
                        </div>        
                        <div class="pad_20_0 small-block" id="material">
                            <!-- �������� -->
                            <?$APPLICATION->IncludeComponent(
                            	"ls:news.list",
                            	"small-block-places",
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
                            		"PAGER_TITLE" => "�������",
                            		"PAGER_SHOW_ALWAYS" => "Y",
                            		"PAGER_DESC_NUMBERING" => "N",
                            		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            		"PAGER_SHOW_ALL" => "Y"
                            	)
                            );?>                            
                            
                        </div>
                        <div class="pad_50_0 text-center">
                            Crado - ��� ��� �� ��������� ������ � ������ �������. ������ ����� � ������� � �������. 
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