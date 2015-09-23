<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
    $category = $_GET['category'];
    $whe_city = $_GET['whe_city'];
    $name_fil = $_GET['name_fil'];
    $val = $_GET['val'];
    $date = $_GET['date'];
    $search_text = $_GET['search'];
	$page = $_GET['PAGEN_1']; 
	
    CModule::IncludeModule("iblock");
    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>2, "XML_ID"=>$whe_city));
        if($enum_fields = $property_enums->GetNext())            
    $whe_city = $enum_fields['~VALUE'];
    
    if($val!='')
    { 
        $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>2, "XML_ID"=>$val));
            if($enum_fields = $property_enums->GetNext())
        $val = $enum_fields['~VALUE'];
    }               
    global $arrFilter;
                $arrFilter = Array(
                "IBLOCK_ID"=>'2',
                "PROPERTY_params_VALUE" => $whe_city,
                );
     
     $category_section = cat_section($whe_city,2);
     uasort($category_section, "sort_c");
                            
    if($val!='')
    { 
        $arrFilter["PROPERTY_".$name_fil."_VALUE"] = $val;
    }
    if($val == 'Событие')
    {
        $arrFilter['>=DATE_ACTIVE_TO'] = $date;
    }
	
	//Получаем список банеров для данной категории
	$baner_cat = baner_cat($whe_city,$category);
	$count_b = count($baner_cat);
	if($count_b>3)
	{
		$rand_array = array();
		while(count($rand_array) != 3)
		{
			$rand_array =  array_rand(range(0,$count_b-1), 3);
		}
		foreach($rand_array as $n=>$item)
		{
			$baner_c[$n] = $baner_cat[$item];
		}
	}
	else
	{
		$baner_c = $baner_cat;
	}
	$count_b = count($baner_c);
	
	
	
     if($category == 'all')
    {
        
       $filter_or = array();
       $filter_or_element = array();
       $filter_or['LOGIC'] = 'OR';
                                    
       foreach($category_section as $item):                     
           $filter_or_element = array(array("PROPERTY_category"=>$item['ID_CATEGORY'],));
           $filter_or =  array_merge($filter_or, $filter_or_element);
       endforeach;
       $arrFilter = array_merge($arrFilter, array($filter_or)); 
				
    }
    else
    {
        $category = explode(',',$category);
        
        $filter_or = array();
        $filter_or_element = array();
        $filter_or['LOGIC'] = 'OR';
                                    
        foreach($category as $item):                     
           $filter_or_element = array(array("PROPERTY_category"=>$item,));
           $filter_or =  array_merge($filter_or, $filter_or_element);
        endforeach;
        $arrFilter = array_merge($arrFilter, array($filter_or)); 
    }
    
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
                                );
?>
    <?$APPLICATION->IncludeComponent(
            	"ls:news.list",
            	"small-block_cat",
            	Array(
            		"IBLOCK_TYPE" => "content",
            		"IBLOCK_ID" => '2',
            		"NEWS_COUNT" => $GLOBALS['options_props']['count_element']['~VALUE'] - ($count_b*2),
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
            		"PAGER_TITLE" => "Новости",
            		"PAGER_SHOW_ALWAYS" => "Y",
            		"PAGER_DESC_NUMBERING" => "N",
            		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
            		"PAGER_SHOW_ALL" => "Y",
					"baner_c"=>$baner_c
            	)
            );?>