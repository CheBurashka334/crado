<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>

<?
 $soc = $_POST['social'];
 $page = $_POST['page'];
if (!CModule::IncludeModule('highloadblock'))
   continue;
 
$ID = 1; //highloadblock Brendshl
 
//сначала выбрать информацию о ней из базы данных
$hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();
 
 
//затем инициализировать класс сущности
$hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
 
$hlDataClass = $hldata['NAME'].'Table';
 
$result = $hlDataClass::getList(array(
                      'select' => array('ID', 'UF_URL','UF_OD','UF_FB','UF_VK'),
                      'order' => array('UF_URL' =>'ASC'),
                      'filter' => array('UF_URL'=>$page),
                     ));
 $ID = '';                                                
while($res = $result->fetch())
{
    $ID = $res['ID'];
    $UF_VK=$res['UF_VK'];
    $UF_FB=$res['UF_FB'];
    $UF_OD=$res['UF_OD'];
}
 if($ID == '')
 {
     $hlDataClass::add(array(
        $soc => '1',
        'UF_URL'=>$page
    ));   
 }
 else
 {
      if($soc == 'UF_VK')  $zn = $UF_VK+1;
      if($soc == 'UF_FB')  $zn = $UF_FB+1;
      if($soc == 'UF_OD')  $zn = $UF_OD+1;
      
      $hlDataClass::update($ID, array(
            $soc => $zn
        )); 

 }
?> 