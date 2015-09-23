<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?$id_element_com = $APPLICATION->IncludeComponent(
	"bitrix:news.detail",
	"places",
	Array(
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"USE_SHARE" => "N",
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "content",
		"IBLOCK_ID" => "2",
		"ELEMENT_ID" => "",
		"ELEMENT_CODE" => $_REQUEST["code"],
		"CHECK_DATES" => "Y",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"PROPERTY_CODE" => array(
			0 => "type",
			1 => "params",
			2 => "map",
			3 => "address",
			4 => "dop_images",
            5 => "video",
            6 => "dop_znachenia",
            7 => "rejim",
            8 => 'date_active_from',
		),
		"IBLOCK_URL" => "/places/",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "NAME",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_STATUS_404" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"ADD_ELEMENT_CHAIN" => "N",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"USE_PERMISSIONS" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Страница",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	),
false
);?>
<div class="place">
	<?/*
    <div class="container">
		<div class="dop-text">
        <div class="comments text-center pad_15_15 active" id="comments">
                Отзывы
            </div>
            <div class="items-comments active">
                    <?$APPLICATION->IncludeComponent(
                    	"khayr:main.comment",
                    	"crado-comment",
                    	Array(
                    		"OBJECT_ID" => $id_element_com,
                    		"COUNT" => "20",
                    		"MAX_DEPTH" => "1",
                    		"JQUERY" => "N",
                    		"ACTIVE_DATE_FORMAT" => "j F",
                    		"ASNAME" => "NAME",
                    		"REQUIRE_EMAIL" => "N",
                    		"ADDITIONAL" => array(""),
                    		"ALLOW_RATING" => "N",
                    		"MODERATE" => "N",
                    		"CAN_MODIFY" => "Y",
                    		"USE_PERMISSIONS" => "N",
                    		"GROUP_PERMISSIONS" => array("2"),
                    		"NON_AUTHORIZED_USER_CAN_COMMENT" => "N",
                    		"USE_CAPTCHA" => "N",
                    		"AUTH_PATH" => "/login/",
                    		"CACHE_TYPE" => "A",
                    		"CACHE_TIME" => "36000",
                    		"PAGER_TEMPLATE" => ".default",
                    		"DISPLAY_TOP_PAGER" => "N",
                    		"DISPLAY_BOTTOM_PAGER" => "Y",
                    		"PAGER_TITLE" => "",
                    		"PAGER_SHOW_ALWAYS" => "N",
                    		"PAGER_DESC_NUMBERING" => "N",
                    		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                    		"PAGER_SHOW_ALL" => "N",
                    		"COMPONENT_TEMPLATE" => "crado-comment"
                    	)
                    );?>
                </div> 
            </div>
        </div>
        */?>
            <div class="bgray-light">
        <div class="container also">
        <h2>Смотрите также:</h2>
        <?
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID" => $id_element_com);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $arProps = $ob->GetProperties();
                //print_r($arProps);
            }
            ?> 
            <?
                global $arrFilter;
                $arrFilter = Array(
                "!=ID"=>$id_element_com,
                "PROPERTY_category"=>$arProps['category']['~VALUE'],
                );
            ?>
            <?$APPLICATION->IncludeComponent(
            	"ls:news.list",
            	"small-block",
            	Array(
            		"IBLOCK_TYPE" => "content",
            		"IBLOCK_ID" => 2,
            		"NEWS_COUNT" => "4",
            		"SORT_BY1" => "ACTIVE_FROM",
            		"SORT_ORDER1" => "DESC",
            		"SORT_BY2" => "SORT",
            		"SORT_ORDER2" => "ASC",
            		"FILTER_NAME" => 'arrFilter',
            		"FIELD_CODE" => array(),
            		"PROPERTY_CODE" => array("category",'type','event_place','address','metka'),
            		"CHECK_DATES" => "Y",
            		"DETAIL_URL" => "",
            		"AJAX_MODE" => "N",
            		"AJAX_OPTION_JUMP" => "N",
            		"AJAX_OPTION_STYLE" => "Y",
            		"AJAX_OPTION_HISTORY" => "N",
            		"CACHE_TYPE" => "A",
            		"CACHE_TIME" => "36000000",
            		"CACHE_FILTER" => "N",
            		"CACHE_GROUPS" => "Y",
            		"PREVIEW_TRUNCATE_LEN" => "",
            		"ACTIVE_DATE_FORMAT" => "d.m.Y",
            		"SET_TITLE" => "Y",
            		"SET_BROWSER_TITLE" => "Y",
            		"SET_META_KEYWORDS" => "Y",
            		"SET_META_DESCRIPTION" => "Y",
            		"SET_STATUS_404" => "N",
            		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
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
            		"DISPLAY_BOTTOM_PAGER" => "N",
            		"PAGER_TITLE" => "Новости",
            		"PAGER_SHOW_ALWAYS" => "N",
            		"PAGER_DESC_NUMBERING" => "N",
            		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            		"PAGER_SHOW_ALL" => "N"
            	)
            );?>
        </div>
    </div>
 </div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>