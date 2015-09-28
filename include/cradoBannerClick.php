<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
    $id = $_POST['id'];
    CModule::IncludeModule('cradobaners');
    $return = cCradoBaners::setCradoBanersClick($id);

?>