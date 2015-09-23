<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Crado | Портал активного отдыха в Сургуте");
$APPLICATION->SetTitle("Размещение события, места или магазина");
?>
<?/*if(!$USER->IsAuthorized()):
        header("Location: /login/");
        exit();
    endif;*/?>
<div class="bgray-light">
    <div class="container w725">
        <div class="pad_40_0">
            <h1><?=$APPLICATION->ShowTitle('h1');?></h1>
        </div>
        <div class="bwhite add_event row">
            <div>
               <?$APPLICATION->IncludeComponent(
                	"bitrix:form.result.new",
                	"crado",
                	Array(
                		"COMPONENT_TEMPLATE" => ".default",
                		"WEB_FORM_ID" => 1,
                		"IGNORE_CUSTOM_TEMPLATE" => "N",
                		"USE_EXTENDED_ERRORS" => "Y",
                		"SEF_MODE" => "N",
                		"VARIABLE_ALIASES" => Array(
                			"WEB_FORM_ID" => "WEB_FORM_ID",
                			"RESULT_ID" => "RESULT_ID"
                		),
                		"CACHE_TYPE" => "A",
                		"CACHE_TIME" => "3600",
                		"LIST_URL" => "result_list.php",
                		"EDIT_URL" => "result_edit.php",
                		"SUCCESS_URL" => "",
                        //"AJAX_MODE" => "Y",
                		"CHAIN_ITEM_TEXT" => "",
                		"CHAIN_ITEM_LINK" => ""
                	)
                );?>
            </div>
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>