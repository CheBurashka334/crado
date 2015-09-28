<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
IncludeModuleLangFile(__FILE__);

if ((CModule::IncludeModule("cradobaners")))
{
    //$count = KhayRComment::GetCount(0, false);
    $aMenu = Array(
        "parent_menu" => "global_menu_services",
        "sort"        => 100,
        "url"         => "cradobaners_list.php?lang=".LANGUAGE_ID,
        "text"        => GetMessage("CRADO_BANER"),
        "icon"        => "banner_icon", // малая иконка
        //"title"       => GetMessage("KHAYR_COMMENT"),
    );
    return $aMenu;
}
return false;
?>