<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?

    $metka_id = $_GET['metka'];
    $search_text = $_GET['search'];
    $page = $_GET['PAGEN_1'];
    //$_GET['PAGEN_1'] = $_GET['PAGEN_3'];               
    /*global $arrFilter;
                $arrFilter = Array(
                "IBLOCK_ID"=>'2',
                "PROPERTY_type"=>'2',
                );*/
	/*CModule::IncludeModule("iblock");
		$arSel = Array("ID","NAME");
		arFil = Array("IBLOCK_ID"=>5, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y",'CODE'=>$tags[count($tags)-1]);
		$res = CIBlockElement::GetList(Array(), $arFil, false, Array("nPageSize"=>150), $arSel);
		while($ob = $res->GetNextElement())
		{
			$arFields = $ob->GetFields();
			$metka_id = $arFields['ID'];
			$name = $arFields['NAME'];
		}*/
		global $arrFilter;
		$arrFilter = Array(
			"IBLOCK_ID"=>'2',
			array(
				"LOGIC" => "OR",
				array("PROPERTY_metka"=>$metka_id),
				array("PROPERTY_dop_metka"=>$metka_id)
				)
		);
		
    if($search_text != '')
    {
        $filter_or = array();
        $filter_or_element = array();
        
        $filter_or['LOGIC'] = 'OR';
        
        
        $search_text = iconv("UTF-8", "Windows-1251", $search_text);
        
        $filter_or_element = array(array('NAME' => '%'.$search_text.'%'));
        $filter_or =  array_merge($filter_or, $filter_or_element);
        $filter_or_element = array(array('PROPERTY_address' => '%'.$search_text.'%'));
        $filter_or =  array_merge($filter_or, $filter_or_element);
        $filter_or_element = array(array('DETAIL_TEXT' => '%'.$search_text.'%'));
        $filter_or =  array_merge($filter_or, $filter_or_element);
        $filter_or_element = array(array('PREVIEW_TEXT' => '%'.$search_text.'%'));
        $filter_or =  array_merge($filter_or, $filter_or_element);
        
        $arrFilter = array_merge($arrFilter, array($filter_or));
        //$arrFilter['NAME'] = '%'.$search_text.'%';
        //$arrFilter['PROPERTY_address'] = '%'.$search_text.'%';
    }
    //echo $search_text;
    /*echo '<pre>';
    print_r($arrFilter);
    echo '</pre>';*/
?>
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
            		"DISPLAY_BOTTOM_PAGER" => "Y",
            		"PAGER_TITLE" => "�������",
            		"PAGER_SHOW_ALWAYS" => "Y",
            		"PAGER_DESC_NUMBERING" => "N",
            		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            		"PAGER_SHOW_ALL" => "Y",
					"metka_id" => $metka_id
            	)
				
            );?>