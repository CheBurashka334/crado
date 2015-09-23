<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
IncludeModuleLangFile(__FILE__);

if ((CModule::IncludeModule("cradobaners")))
{
    //$count = KhayRComment::GetCount(0, false);
    $aMenu = Array(
        "parent_menu" => "global_menu_services",
        "sort"        => 100,
        "url"         => "parnas.khayrcomment_list.php?lang=".LANGUAGE_ID,
        "text"        => GetMessage("CRADO_BANER"),
        //"title"       => GetMessage("KHAYR_COMMENT"),
        "icon"        => "banner_icon",
        "page_icon"   => "banner_icon",
        "items_id"    => "khayr_comment",
        "items"       => Array(),
    );
    return $aMenu;
}
return false;
?>