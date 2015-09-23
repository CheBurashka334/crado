<?php
$tek_date = date("d.m"); //формат текущей даты 01.01
	$tek_day = date("d");
	$tek_month = date("m");
	//Активируем либо дезактивируем элементы по их сезонности
	
	CModule::IncludeModule("iblock");
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","CODE","*");
	$arFilter = Array("IBLOCK_ID"=>2);
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	
	while($ob = $res->GetNextElement()){

		$arProps = $ob->GetProperties();
		$arFields = $ob->GetFields();

		if(isset($arProps['season']['VALUE_XML_ID']))
		{
			$a = 0;
			foreach($arProps['season']['VALUE_XML_ID'] as $season)
			{
				$season = explode("-",$season);

				$sean_start = $season[0];
				$sean_start_data = explode(".",$sean_start);
                
                $sean_start_day = $sean_start_data[0];
                $sean_start_month = $sean_start_data[1];				
				
				$sean_finish = $season[1];
				$sean_finish_data = explode(".",$sean_finish);
	           
                $sean_finish_day = $sean_finish_data[0];
                $sean_finish_month = $sean_finish_data[1];

				if(($tek_day >= $sean_start_day && $tek_day <= $sean_finish_day) && ($tek_month >= $sean_start_month && $tek_month <= $sean_finish_month))
				{
						//echo $season;
						$el = new CIBlockElement;
						$arLoadProductArray = Array(
						  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
						  "ACTIVE"         => "Y"            // активен
						  );

						$PRODUCT_ID = $arFields['ID'];  // изменяем элемент с кодом (ID) 2
						$result = $el->Update($PRODUCT_ID, $arLoadProductArray);
						$a = 1;
				}
				else
				{
					$el = new CIBlockElement;
						$arLoadProductArray = Array(
						  "MODIFIED_BY"    => $USER->GetID(), // элемент изменен текущим пользователем
						  "ACTIVE"         => "N"            // активен
						  );
						$PRODUCT_ID = $arFields['ID'];  // изменяем элемент с кодом (ID) 2
						$result = $el->Update($PRODUCT_ID, $arLoadProductArray);
				}
				if($a == 1) break;
			}
		}
	}
	?>