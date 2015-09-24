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
    $banners=array(
        array(
            "ID"=>'1',
            "SRC"=>'/images/images.png',
            "count_view"=>'251',
            "count_click"=>'11',
            "last_date_click"=>'11.10.2015',
        ),
        array(
            "ID"=>'2',
            "SRC"=>'/images/images.png',
            "count_view"=>'252',
            "count_click"=>'12',
            "last_date_click"=>'12.10.2015',
        ),
        array(
            "ID"=>'3',
            "SRC"=>'/images/images.png',
            "count_view"=>'253',
            "count_click"=>'13',
            "last_date_click"=>'13.10.2015',
        )

    );

    $banners = cCradoBaners::getCradoBaners();

?>
<pre>

    <?print_r($banners);?>
</pre>
<style>
    .baner_table{
        width:100%;
        border-spacing: 0px;
    }
    .baner_table tr{
        display: table-row;
        vertical-align: inherit;
        border-color: inherit;
    }
    .baner_table th, td{
        border: 1px solid #cecece;
        padding: 5px;
    }
    .baner_table td{
        text-align: right;
    }
</style>
<table class="baner_table">
    <tr>
        <th><?=GetMessage("CRADOBANERS_ID")?></th>
        <th><?=GetMessage("CRADOBANERS_IMG")?></th>
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
                <img src="<?=$item['SRC'];?>"
            </td>
            <td>
                <?=$item['count_view']?>
            </td>
            <td>
                <?=$item['count_click']?>
            </td>
            <td>
                <?=$item['last_date_click']?>
            </td>
        </tr>
    <?endforeach;?>
</table>