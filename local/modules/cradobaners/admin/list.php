<?
define("ADMIN_MODULE_NAME", "seofilter");
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once($_SERVER["DOCUMENT_ROOT"]."/local/modules/cradobaners/include.php");
IncludeModuleLangFile(__FILE__);
CModule::IncludeModule("iblock");

$APPLICATION->SetTitle(GetMessage("CRADOBANERS_TITLE"));
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");
?>
<?
$banners = cCradoBaners::getCradoBaners();
?>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/local/modules/cradobaners/css/table.css">
<div class="container">
    <table class="table ">
        <tr>
            <th><?=GetMessage("CRADOBANERS_ID")?></th>
            <th><?=GetMessage("CRADOBANERS_BANNER")?></th>
            <th><?=GetMessage("CRADOBANERS_COUNTVIEW")?></th>
            <th><?=GetMessage("CRADOBANERS_COUNTCLICK")?></th>
            <th><?=GetMessage("CRADOBANERS_DATECLICK")?></th>
        </tr>
        <?foreach($banners as $item):?>
            <tr>
                <td>
                    <?=$item['ID'];?>
                </td>
                <td>
                    <table class="table  table-bordered">
                        <tr>
                            <th><?=GetMessage("CRADOBANERS_ID_BANERS")?></th>
                            <th><?=GetMessage("CRADOBANERS_NAME")?></th>
                            <?if(isset($item['BANNER']['BANNER_CATEGORY'])):?>
                                <th><?=GetMessage("CRADOBANERS_IMG_CAT")?></th>
                            <?endif;?>
                            <?if(isset($item['BANNER']['BANNER_ELEMENT'])):?>
                                <th><?=GetMessage("CRADOBANERS_IMG_EL")?></th>
                            <?endif;?>
                        </tr>
                        <tr>
                            <td><?=$item['BANNER']['ID']?></td>
                            <td><?=$item['BANNER']['NAME']?></td>
                            <?if(isset($item['BANNER']['BANNER_CATEGORY'])):?>
                                <td><img src="<?=$item['BANNER']['BANNER_CATEGORY']['src']?>"/></td>
                            <?endif;?>
                            <?if(isset($item['BANNER']['BANNER_ELEMENT'])):?>
                                <td><img src="<?=$item['BANNER']['BANNER_ELEMENT']['src']?>"/></td>
                            <?endif;?>
                        </tr>
                    </table>
                </td>
                <td>
                    <?=$item['COUNT_VIEW']?>
                </td>
                <td>
                    <?=$item['COUNT_CLICK']?>
                </td>
                <td>
                    <?=$item['DATE_LAST_CLICK']?>
                </td>
            </tr>
        <?endforeach;?>
    </table>
</div>