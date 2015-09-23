<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
    
    CModule::IncludeModule("iblock");
    $arSelect = Array("*");
    $arFilter = Array("IBLOCK_ID"=>1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","SECTION_ID"=>2);
    $res = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilter, false, Array("nPageSize"=>9999), $arSelect);
    $a=0;
   
    $arrCategory = array();
    while($ob = $res->GetNextElement())
    {
        
        $arFields = $ob->GetFields();
          
		  
		  //Поиск существует ли хотя бы один элемент из Магазин/Событие/Место с таким свойством (с такой категории)
			$arSelectPES = Array("*");
			$arFilterPES = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_params_VALUE"=>'Отдых в городе',"PROPERTY_category"=>$arFields['ID']);
			$PES = 0;
			$resPES = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilterPES, false, Array("nPageSize"=>9999), $arSelectPES);
			while($obPES = $resPES->GetNextElement())
			{
				$PES++;
			}

			//echo $PES.' /';
			if($PES != 0)
			{
				$arrCategoryZnach = array();
				array_push($arrCategoryZnach ,$arFields['NAME'],$arFields['~CODE']);
				array_push($arrCategory ,$arrCategoryZnach);
			}
            /*//array_push($result ,$arFields);
            ?>
            <?if($a == 5):?></div><div class="row line"><?$a=0; endif;?>
            <a href="/in_city/<?=$arFields["~CODE"]?>/" class="left text-center bwhite category-button ">
                <div><?=$arFields["NAME"]?></div>
            </a>
            <?
            $a++;*/
    }
    
        $arFilter = Array('IBLOCK_ID'=>1, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>2);
        $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
        $db_list->NavStart(20);
        echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
        while($ar_result = $db_list->GetNext())
        {
            //echo $ar_result['ID'].' '.$ar_result['NAME'].': '.$ar_result['ELEMENT_CNT'].'<br>';
                $arrCategoryZnach = array();
                array_push($arrCategoryZnach ,$ar_result['NAME'],$ar_result['~CODE']);
                array_push($arrCategory ,$arrCategoryZnach);
                /*echo '<pre>';
                print_r($ar_result);
                echo '</pre>';*/
        }
        //echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
        //—ортируем массив
        function sort_p($a, $b)
        {
            return strcmp($a[0], $b[0]);
        }
        uasort($arrCategory, "sort_p");
        ?>
         <div class="row line">
        <?
        foreach($arrCategory as $item):
            ?>
            <?if($a == 5):?></div><div class="row line"><?$a=0; endif;?>
            <a href="/in_city/<?=$item[1]?>/" class="left text-center bwhite category-button ">
                <div><?=$item[0]?></div>
            </a>
            <?
            $a++;
        endforeach;
        ?>
            </div>
        <?
        /*echo '<pre>';
        print_r($arrCategory);
        echo '</pre>';*/
    //echo $a;

?>