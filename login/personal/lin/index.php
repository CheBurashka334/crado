<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?if(!$USER->IsAuthorized()):
        header("Location: /login/");
        exit();
    endif;?>
<?php
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
    header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
    header("Pragma: no-cache"); // HTTP/1.0
?>
<div class="bgray-light profile">
    <div class="container">
        <div class="profile-block row">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/profile-menu.php"), false);?>
            <div class="block">
                <h4>Редактирование личных данных</h4>
                <?$APPLICATION->IncludeComponent(
                	"bitrix:main.profile",
                	"profile-crado",
                	Array(
                		"COMPONENT_TEMPLATE" => ".default",
                		"AJAX_MODE" => "N",
                		"AJAX_OPTION_JUMP" => "N",
                		"AJAX_OPTION_STYLE" => "Y",
                		"AJAX_OPTION_HISTORY" => "N",
                		"SET_TITLE" => "Y",
                		"USER_PROPERTY" => array(),
                		"SEND_INFO" => "N",
                		"CHECK_RIGHTS" => "N",
                		"USER_PROPERTY_NAME" => ""
                	)
                );?>
            </div>
        </div>
    </div>
</div>
        
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>