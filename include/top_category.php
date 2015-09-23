<div class="category container row">
<? if (strripos($APPLICATION->GetCurPage(false), 'in_city/')): ?>
<?
        CModule::IncludeModule("iblock");
        $arSelect = Array("*");
        $arFilter = Array("IBLOCK_ID"=>1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","SECTION_ID"=>2);
        $res = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilter, false, false, $arSelect);
        $a=0;
       
        $arrCategory = array();
        while($ob = $res->GetNextElement())
        {
            
            $arFields = $ob->GetFields();
			
			//Поиск существует ли хотя бы один элемент из Магазин/Событие/Место с таким свойством (с такой категории)
			$arSelectPES = Array("*");
			$arFilterPES = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_params_VALUE"=>'Отдых в городе',"PROPERTY_category"=>$arFields['ID']);
			$PES = 0;
			$resPES = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilterPES, false, false, $arSelectPES);
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
        }
        
            $arFilter = Array('IBLOCK_ID'=>1, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>2);
            $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
           // $db_list->NavStart(20);
            echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
            while($ar_result = $db_list->GetNext())
            {
                    $arrCategoryZnach = array();
                    array_push($arrCategoryZnach ,$ar_result['NAME'],$ar_result['~CODE']);
                    array_push($arrCategory ,$arrCategoryZnach);

            }
            //echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
            //Сортируем массив
            function sort_menu($a, $b)
            {
                return strcmp($a[0], $b[0]);
            }
            uasort($arrCategory, "sort_menu");
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

    ?>
    <?endif;?>
   <? if (strripos($APPLICATION->GetCurPage(false), 'out_city/')): ?>
    
    <?
    
    CModule::IncludeModule("iblock");
    $arSelect = Array("*");
    $arFilter = Array("IBLOCK_ID"=>1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","SECTION_ID"=>2);
    $res = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilter, false, false, $arSelect);
    $a=0;
   
    $arrCategory = array();
    while($ob = $res->GetNextElement())
    {
        
        $arFields = $ob->GetFields();
		
			//Поиск существует ли хотя бы один элемент из Магазин/Событие/Место с таким свойством (с такой категории)
			$arSelectPES = Array("*");
			$arFilterPES = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_params_VALUE"=>'Отдых за городом',"PROPERTY_category"=>$arFields['ID']);
			$PES = 0;
			$resPES = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilterPES, false, false, $arSelectPES);
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
    }
    
        $arFilter = Array('IBLOCK_ID'=>1, 'GLOBAL_ACTIVE'=>'Y', 'DEPTH_LEVEL'=>2);
        $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
        //$db_list->NavStart(20);
        echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
        while($ar_result = $db_list->GetNext())
        {

                $arrCategoryZnach = array();
                array_push($arrCategoryZnach ,$ar_result['NAME'],$ar_result['~CODE']);
                array_push($arrCategory ,$arrCategoryZnach);

        }
        //Сортируем массив
        function sort_pm($a, $b)
        {
            return strcmp($a[0], $b[0]);
        }
        uasort($arrCategory, "sort_pm");
        ?>
         <div class="row line">
        <?
        foreach($arrCategory as $item):
            ?>
            <?if($a == 5):?></div><div class="row line"><?$a=0; endif;?>
            <a href="/out_city/<?=$item[1]?>/" class="left text-center bwhite category-button ">
                <div><?=$item[0]?></div>
            </a>
            <?
            $a++;
        endforeach;
        ?>
            </div>

    <?endif;?>
</div>

<script>
$(document).ready(function(){
      $('#category').click(function(){
        if($('.top-block').hasClass('active'))
        {
            $('.boxshadow-leftmenu').hide();
            $('.top-block').removeClass('active');
            $('.top-block').animate({
                //opacity: 0,
                top: -400
              }, 250);   
        }
        else
        {
            $('.boxshadow-leftmenu').show();
            $('.top-block').addClass('active');
            $('.top-block').animate({
                //opacity: 1,
                top: 55
              }, 250);   
        }
   });
   $('.boxshadow-leftmenu').click(function(){
        if($('.top-block').hasClass('active'))
        {
            $('.boxshadow-leftmenu').hide();
            $('.top-block').removeClass('active');
            $('.top-block').animate({
                //opacity: 0,
                top: -400
              }, 250);   
        }
        else
        {
            $('.boxshadow-leftmenu').show();
            $('.top-block').addClass('active');
            $('.top-block').animate({
                //opacity: 1,
                top: 55
              }, 250);   
        } 
   });

});
</script>