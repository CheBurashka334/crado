	<?
		
						CModule::IncludeModule("iblock");
						$arSelect = Array("*");
						$arFilter = Array("IBLOCK_ID"=>10, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
						$res = CIBlockElement::GetList(Array("name"=>"ASC"), $arFilter, false, false, $arSelect);
						while($ob = $res->GetNextElement())
						{
							
							$arFields = $ob->GetFields();
							$arProps = $ob->GetProperties();
						}
						$GLOBALS['options_field'] = $arFields; 
						$GLOBALS['options_props'] = $arProps; 
	?>