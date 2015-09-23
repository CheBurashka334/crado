<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
    //global $arrFilter;
    //$arrFilter['>=DATE_ACTIVE_FROM'] = ConvertDateTime($_GET['date_filter'], "YYYY-MM-DD")." 00:00:00";
    $arrFilter['>=DATE_ACTIVE_TO'] = ConvertDateTime($_GET['date_filter'], "DD.MM.YYYY")." 00:00:00";
    ?>
    <pre>
        <?print_r($arrFilter);?>
    </pre>
    <?
?>