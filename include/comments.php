<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?
    CModule::IncludeModule("iblock");
    
    $APPLICATION->IncludeComponent(
                		"micros:comment",
                		"",
                		Array(
                			"COUNT" => "20",
                			"ACTIVE_DATE_FORMAT" => "j F",
                			"MAX_DEPTH" => "0",
                			"ASNAME" => "NAME",
                			"SHOW_DATE" => "Y",
                			"OBJECT_ID" => 9,
                			"CAN_MODIFY" => "Y",
                			"JQUERY" => "N",
                			"MODERATE" => "N",
                			"NON_AUTHORIZED_USER_CAN_COMMENT" => "N",
                			"USE_CAPTCHA" => "NO",
                			"AUTH_PATH" => "/login/",
                			"CACHE_TYPE" => "A",
                			"CACHE_TIME" => "36000000",
                			"PAGER_TEMPLATE" => ".default",
                			"DISPLAY_TOP_PAGER" => "N",
                			"DISPLAY_BOTTOM_PAGER" => "N",
                			"PAGER_TITLE" => "",
                			"PAGER_SHOW_ALWAYS" => "N",
                			"PAGER_DESC_NUMBERING" => "N",
                			"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                			"PAGER_SHOW_ALL" => "N"
                		)
                	);
?>