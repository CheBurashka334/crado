<?


    function uMonth($number)
    {
        //$number = (int)$number;
        $month = array(
        1 => "Января",
        2 => "Февраля",
        3 => "Марта",
        4 => "Апреля",
        5 => "Мая",
        6 => "Июня",
        7 => "Июля",
        8 => "Августа",
        9 => "Сентября",
        10 => "Октября",
        11 => "Ноября",
        12 => "Декабря");
        
        return $month[$number];

    }
    function uWeek($day)
    {
        $week = array(
        'Mon' => 'пн',
        'Tue' => 'вт',
        'Wed' => 'ср',
        'Thu' => 'чт',
        'Fri' => 'пт', 
        'Sat' => 'сб',
        'Sun' => 'вс'
        );
        return $week[$day];
    }
    
    /*Получить банеры в массив для главной странице*/
     function baners($page){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
            $page = 1;
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_home_link_VALUE"=>'Да');
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>3,"iNumPage"=>$page), $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;
        //}
     }
	 //Банер в категориях
	 function baner_c($whe_city,$baner_c){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");

            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            if($whe_city == "Отдых в городе")
				$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_category_in_link"=>$baner_c);
            else
				$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_category_out_link"=>$baner_c);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;
        //}
     }
	 //Банер разделах в городе либо за городом (in_city_link/out_city_link)
	 function baner_city($baner_city){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");

            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_".$baner_city."_VALUE"=>"Да");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;
        //}
     }
     
	 
	 //Банер у элемента
	 function baner_c_e($whe_city,$baner_c){ 
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");

            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            if($whe_city == "Отдых в городе")
				$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_category_in_link_element"=>$baner_c);
            else
				$arFilter = Array("IBLOCK_ID"=>4, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","PROPERTY_category_out_link_element"=>$baner_c);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;
        //}
     }
	 //Банеры раздела занятия спортом
	 function baner_cat($whe_city,$baner_c){ 
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
			if($baner_c == 'all')
			{
				$arSelectCat = Array('ID');
				$arFilterCat = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y","SECTION_ID"=>1);
				$resCat = CIBlockElement::GetList(Array(), $arFilterCat, false, false, $arSelectCat);
				
				$listCat = array();
				while($ob = $resCat->GetNextElement())
				{
					$arFields = $ob->GetFields();
					array_push($listCat, $arFields['ID']);
				}
			}
			else
			{
				$listCat = explode(',',$baner_c);
			}
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            if($whe_city == "Отдых в городе")
			{
				$arFilter = Array(
					"IBLOCK_ID"=>4,
					"ACTIVE_DATE"=>"Y",
					"ACTIVE"=>"Y");
				$arFilterOr = array();
				
				$arFilterOr['LOGIC'] = 'OR';
				
				foreach($listCat as $item)
				{
					$filter_or_element = array(array('PROPERTY_category_in_link'=>$item));
					$arFilterOr =  array_merge($arFilterOr, $filter_or_element);
				}
				$arFilter = array_merge($arFilter, array($arFilterOr));	
			}
            else
			{
				$arFilter = Array(
					"IBLOCK_ID"=>4,
					"ACTIVE_DATE"=>"Y",
					"ACTIVE"=>"Y");
				$arFilterOr = array();
				
				$arFilterOr['LOGIC'] = 'OR';
				
				foreach($listCat as $item)
				{
					$filter_or_element = array(array('PROPERTY_category_out_link'=>$item));
					$arFilterOr =  array_merge($arFilterOr, $filter_or_element);
				}
				$arFilter = array_merge($arFilter, array($arFilterOr));	
			}
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;
        //}
     }
	 
	 
     /*Материал на главной в массив*/
     function material($page_size,$page){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>"DESC")/*Array()*/, $arFilter, false, Array("nPageSize"=>$page_size,"iNumPage"=>$page), $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 array_push($_SESSION['HOME_ELEMENTS'],$arFields);
                 //array_push($GLOBALS['HOME_ELEMENTS'],$arFields);
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            
            return $result;
        //}
     }
     
      function material_incity($page_size,$page){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","=PROPERTY_params_VALUE" => "Отдых в городе");
            $res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>"DESC")/*Array()*/, $arFilter, false, Array("nPageSize"=>$page_size,"iNumPage"=>$page), $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;
        //}
     }
     
     function material_outcity($page_size,$page){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","=PROPERTY_params_VALUE" => "Отдых за городом");
            $res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>"DESC")/*Array()*/, $arFilter, false, Array("nPageSize"=>$page_size,"iNumPage"=>$page), $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;
        //}
     }
     
     /*дата начала и окончание активности элемента*/
     function date_element($id_iblock,$id){
            
            CModule::IncludeModule("iblock");
            $arSelect = Array("DATE_ACTIVE_FROM","DATE_ACTIVE_TO","PROPERTY_date_active_from");
            $arFilter = Array("IBLOCK_ID"=>$id_iblock, "ID"=>$id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>9), $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 /*$arFields['PROPERTY'] = array();*/
                 array_push($result ,$arFields);
                 /*$arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);*/
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result[0];
     }
     /*количество элементов в инфоблоке*/
     
      function count_element($iblock_id){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
            $arSelect = Array("ID");
            $arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>"DESC")/*Array()*/, $arFilter, false, false, $arSelect);
            $result = 0;
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $result ++;
            }
            return $result;
        //}
     }
     function count_element_in_city($iblock_id){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
            $arSelect = Array("ID");
            $arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","=PROPERTY_params_VALUE" => "Отдых в городе");
            $res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>"DESC")/*Array()*/, $arFilter, false, false, $arSelect);
            $result = 0;
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $result ++;
            }
            return $result;
        //}
     }
     
     function count_element_out_city($iblock_id){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){
            CModule::IncludeModule("iblock");
            $arSelect = Array("ID");
            $arFilter = Array("IBLOCK_ID"=>$iblock_id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","=PROPERTY_params_VALUE" => "Отдых за городом");
            $res = CIBlockElement::GetList(Array("DATE_ACTIVE_FROM"=>"DESC")/*Array()*/, $arFilter, false, false, $arSelect);
            $result = 0;
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $result ++;
            }
            return $result;
        //}
     }
     
     /*function element_filter($arrFilter)
     {
           CModule::IncludeModule("iblock");
           $arSelect = Array("ID");
           
     }*/
     
     function tags($id)
     {
            CModule::IncludeModule("iblock");
            $arSelect = Array("NAME");
            $arFilter = Array("IBLOCK_ID"=>5, "ID"=>$id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = 0;
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $result = $arFields['NAME'];
            }
            return $result;
     }
     /*ссылка на тег*/
     function tags_link($id)
     {
            CModule::IncludeModule("iblock");
            $arSelect = Array("CODE");
            $arFilter = Array("IBLOCK_ID"=>5, "ID"=>$id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = 0;
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                $arFields = $ob->GetFields();
                $result = $arFields['CODE'];
            }
            return '/'.$result.'/';
     }
     
     /*получение данных места от события*/
     function event_place($id){
        //if(CModule::IncludeModule("catalog") && CModule::IncludeModule("iblock")){\
        CModule::IncludeModule("iblock");
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>2, "ID"=>$id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result;    
       // }             
     }
     
     function list_category($code){
            
            CModule::IncludeModule("iblock");
            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
            $arFilter = Array("IBLOCK_ID"=>1, "CODE"=>$code, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            //$result['property'] = array();
            while($ob = $res->GetNextElement())
            {
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arFields["IPROPERTY_VALUES"] = array();
                 $arProps = $ob->GetProperties();
 
                 $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
                    $arFields["IBLOCK_ID"],
                    $arFields["ID"]
                );
                $arFields["IPROPERTY_VALUES"] = $ipropValues->getValues();
                //echo '<pre>'; print_r($arSection["IPROPERTY_VALUES"]); echo '</pre>';
                 array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$arFields);
                 //array_push($result ,$arProps);
                 /*формирование url*/
            }
            return $result; 
            
     }
     function date_to_from($date_in_from,$date_in_to){
        
      /*формирование даты*/
        $date_from = explode(' ', $date_in_from);
        $date_to = explode(' ', $date_in_to);
        $year_from = explode('.', $date_from[0]);
        $year_to = explode('.', $date_to[0]);
                                               // print_r($date_from);
        if(strtotime($date_from[0]) < strtotime($date_to[0])):
            if($year_from[2] < $year_to[2]):
                return $year_from[0].'.'.$year_from[1].'.'.$year_from[2].' - '.$year_to[0].'.'.$year_to[1].'.'.$year_to[2];
            else:
                return $year_from[0].'.'.$year_from[1].' - '.$year_to[0].'.'.$year_to[1].'.'.$year_to[2];
            endif;
        else:
            return $date_from[0];
        endif;
     }
     
     /*Получаем типы (Событие/Место/Магазин) которые имеются у элементов*/
     function type($category,$whe_city,$iblok_id)
     {
        
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_type");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
            $arFilter = Array("IBLOCK_ID"=>$iblok_id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_params_VALUE" => $whe_city, "PROPERTY_category"=>$category);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            $result_e = array();
            while($ob = $res->GetNextElement()){ 
                 
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                 //$result_e['ID'] = $arFields['ID'];
                 $result_e['type'] = $arProps['type']['VALUE_XML_ID'];
                 $result_e['type_name'] = $arProps['type']['VALUE'];
                 
                // array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$result_e);
                 $result_e = array();
            }
            $result= array_map("unserialize", array_unique( array_map("serialize", $result) ));
            return $result;
     }
     
     /*Подкатегории категории Занятия в секциях*/
     function cat_section($whe_city,$iblok_id)
     {
        
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_category");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
            $arFilter = Array("IBLOCK_ID"=>$iblok_id, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "PROPERTY_params_VALUE" => $whe_city/*, "PROPERTY_category"=>$category*/);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            $result_e = array();
            while($ob = $res->GetNextElement()){ 
                 
                 $arFields = $ob->GetFields();
                 $arFields['PROPERTY'] = array();
                 $arProps = $ob->GetProperties();
                 
                
                 $result_e['ID'] = $arFields['ID'];
                 $result_e['CATEGORY'] = $arProps['category']['VALUE'];
                 $result_e['CODE'] = $arFields['CODE'];
                 
                // array_push($arFields['PROPERTY'] ,$arProps);
                 array_push($result ,$result_e);
                 $result_e = array();
            }
            $result= array_map("unserialize", array_unique( array_map("serialize", $result) ));
            
			$sect_elem = sect_elem(); 
            $res = array();
            $res_a = array();
            foreach($sect_elem as $item)
            {
                foreach($result as $item_el)
                {
                    /*Множественный выбор категорий*/
                    foreach($item_el['CATEGORY'] as $cat_item)
                    {
                        if($item['ID'] == $cat_item)
                       {
                            //$res_a['ID_ELEMENT'] = $item_el['ID'];
                            $res_a['ID_CATEGORY'] = $item['ID'];
                            $res_a['NAME_CATEGORY'] = $item['NAME'];
							$res_a['CODE_CATEGORY'] = $item['CODE'];
							$res_a['SEO_CATEGORY'] = $item['SEO'];
                            array_push($res ,$res_a);
                       }
                    }
                   /*if($item['ID'] == $item_el['CATEGORY'])
                   {
                        //$res_a['ID_ELEMENT'] = $item_el['ID'];
                        $res_a['ID_CATEGORY'] = $item['ID'];
                        $res_a['NAME_CATEGORY'] = $item['NAME'];
                        array_push($res ,$res_a);
                   }*/ 
                }
                $res_a = array();
            }
            $res= array_map("unserialize", array_unique( array_map("serialize", $res) ));
            /*echo '<pre>';
            print_r($res); 
            echo '</pre>';*/
            return $res;
     }
	 
     function sect_elem()
     {
            $arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","CODE","PREVIEW_TEXT");
            $arFilter = Array("IBLOCK_ID"=>1, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "SECTION_ID" => 1);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
            $result = array();
            $result_e = array();
            while($ob = $res->GetNextElement()){ 
                 
                 $arFields = $ob->GetFields();

                 $result_e['ID'] = $arFields['ID'];
                 $result_e['NAME'] = $arFields['NAME'];
				 $result_e['CODE'] = $arFields['CODE'];
				 
				 $result_e['SEO'] = $arFields['PREVIEW_TEXT'];
                 
                 array_push($result ,$result_e);
                 $result_e = array();
            }
            $result= array_map("unserialize", array_unique( array_map("serialize", $result) ));
            return $result;
     }
     /*Смена фото пользователя*/
    AddEventHandler("main", "OnBeforeUserUpdate", Array("MyClass", "OnBeforeUserUpdateHandler"));
    class MyClass
    {
        // создаем обработчик события "OnBeforeUserUpdate"
        function OnBeforeUserUpdateHandler(&$arFields)
        {
            if(strlen($arFields["UF_IMG"]) > 0)
            {
                $user = new CUser;
            	$arNewFile = CFile::MakeFileArray($arFields["UF_IMG"]);
            	$fields = Array("PERSONAL_PHOTO" => $arNewFile);
            	$user->Update($arFields['ID'], $fields);
                $link_del = explode('.ru',$arFields["UF_IMG"]);
                
                unlink($_SERVER['DOCUMENT_ROOT'].$link_del[1]);
            }
        }
    }
   
   
   //html безопасный код  
   
   function html_security($text)
   {
        $search = array ("'<script[^>]*?>.*?</script>'si",  // Вырезает javaScript
                 "'<[\/\!]*?[^<>]*?>'si",           // Вырезает HTML-теги
                 "'([\r\n])[\s]+'",                 // Вырезает пробельные символы
                 "'&(quot|#34);'i",                 // Заменяет HTML-сущности
                 "'&(amp|#38);'i",
                 "'&(lt|#60);'i",
                 "'&(gt|#62);'i",
                 "'&(nbsp|#160);'i",
                 "'&(iexcl|#161);'i",
                 "'&(cent|#162);'i",
                 "'&(pound|#163);'i",
                 "'&(copy|#169);'i",
                 "'&#(\d+);'e");                    // интерпретировать как php-код
 
    $replace = array ("",
                    "",
                  "\\1",
                  "\"",
                  "&",
                  "<",
                  ">",
                  " ",
                  chr(161),
                  chr(162),
                  chr(163),
                  chr(169),
                  "chr(\\1)");
 
    $text = preg_replace($search, $replace, $text);
    return $text;
   }
     
	 
	 
	 
	 
	 
	 
	 
//SEO TITLE URL И прочее

function category_all_SEO()
{
	CModule::IncludeModule("iblock");
	$sect_sport = CIBlockSection::GetByID(1);
	if($ar_sect_sport = $sect_sport->GetNext())
	{
		//Получаем СЕО текст раздела
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
			$ar_sect_sport["IBLOCK_ID"],
			$ar_sect_sport["ID"]
		);
		$ar_sect_sport["IPROPERTY_VALUES"] = $ipropValues->getValues();

	}
	//SEO TEXT
	return iconv('windows-1251','utf-8',$ar_sect_sport['DESCRIPTION']);
}

function category_all_TITLE($h1 = 0)
{
	CModule::IncludeModule("iblock");
	$sect_sport = CIBlockSection::GetByID(1);
	if($ar_sect_sport = $sect_sport->GetNext())
	{
		//Получаем СЕО текст раздела
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
			$ar_sect_sport["IBLOCK_ID"],
			$ar_sect_sport["ID"]
		);
		$ar_sect_sport["IPROPERTY_VALUES"] = $ipropValues->getValues();

	}
	//SEO TEXT
	if($h1 == 0)
	{
		if($ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_TITLE'] != '')
			return iconv('windows-1251','utf-8',$ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_TITLE']);
		else	
			return iconv('windows-1251','utf-8',$ar_sect_sport['NAME']);
	}
	//H1
	if($h1 == 1)
	{
		if($ar_sect_sport['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] != '')
			return iconv('windows-1251','utf-8',$ar_sect_sport['IPROPERTY_VALUES']['SECTION_PAGE_TITLE']);
		else	
			return iconv('windows-1251','utf-8',$ar_sect_sport['NAME']);
	}
	//DESCRIPTION
	if($h1 ==2)
	{
			return iconv('windows-1251','utf-8',$ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_DESCRIPTION']);
	}
}
function category_all_URL($whe_city)
{
	CModule::IncludeModule("iblock");
	$sect_sport = CIBlockSection::GetByID(1);
	if($ar_sect_sport = $sect_sport->GetNext())
	{
		//Получаем СЕО текст раздела
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
			$ar_sect_sport["IBLOCK_ID"],
			$ar_sect_sport["ID"]
		);
		$ar_sect_sport["IPROPERTY_VALUES"] = $ipropValues->getValues();

	}
	//URL TEXT
		return "/".$whe_city."/".$ar_sect_sport['CODE']."/";

}

//Категории
function category_cat_SEO($category)
{
	CModule::IncludeModule("iblock");
	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PREVIEW_TEXT");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>1, "ID"=>$category, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement()){ 
                 
                 $arFields = $ob->GetFields();
                 $arProps = $ob->GetProperties();
    }
	
	if($arFields['PREVIEW_TEXT']!='')
	{
		//SEO TEXT
		return iconv('windows-1251','utf-8',$arFields['PREVIEW_TEXT']);
	}
	else
	{
		$sect_sport = CIBlockSection::GetByID(1);
		if($ar_sect_sport = $sect_sport->GetNext())
		{
			//Получаем СЕО текст раздела
			$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
				$ar_sect_sport["IBLOCK_ID"],
				$ar_sect_sport["ID"]
			);
			$ar_sect_sport["IPROPERTY_VALUES"] = $ipropValues->getValues();

		}
		//SEO TEXT
		return iconv('windows-1251','utf-8',$ar_sect_sport['DESCRIPTION']);
	}
}

function category_cat_TITLE($category,$h1=0)
{
	
	CModule::IncludeModule("iblock");
	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PREVIEW_TEXT");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>1, "ID"=>$category, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement()){ 
                 
                 $arFields = $ob->GetFields();
                 $arProps = $ob->GetProperties();
				 
				 $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
						$arFields["IBLOCK_ID"],
						$arFields["ID"]
					);
			$arFields["IPROPERTY_VALUES"] = $ipropValues->getValues();
    }
	
	if($arFields['NAME']!='')
	{
		if($h1 == 0)
		{
			//TITLE
			if($arFields['IPROPERTY_VALUES']['ELEMENT_META_TITLE'] != '')
				return iconv('windows-1251','utf-8',$arFields['IPROPERTY_VALUES']['ELEMENT_META_TITLE']);
			else	
				return iconv('windows-1251','utf-8',$arFields['NAME']);
		}
		if($h1 == 1)
		{
			//h1
			if($arFields['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != '')
				return iconv('windows-1251','utf-8',$arFields['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']);
			else	
				return iconv('windows-1251','utf-8',$arFields['NAME']);
		}
		//DESCRIPTION
		if($h1 ==2)
		{
			return iconv('windows-1251','utf-8',$arFields['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']);
		}
	}
	else
	{
		$sect_sport = CIBlockSection::GetByID(1);
		if($ar_sect_sport = $sect_sport->GetNext())
		{
			//Получаем СЕО текст раздела
			$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
				$ar_sect_sport["IBLOCK_ID"],
				$ar_sect_sport["ID"]
			);
			$ar_sect_sport["IPROPERTY_VALUES"] = $ipropValues->getValues();

		}
		//TITLE
		if($ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_TITLE'] != '')
			return iconv('windows-1251','utf-8',$ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_TITLE']);
		else	
			return iconv('windows-1251','utf-8',$ar_sect_sport['NAME']);
	}
}
function category_cat_URL($whe_city,$category)
{
	CModule::IncludeModule("iblock");
	
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","CODE");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
    $arFilter = Array("IBLOCK_ID"=>1, "ID"=>$category, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

    while($ob = $res->GetNextElement()){ 
                 
                 $arFields = $ob->GetFields();
                 $arProps = $ob->GetProperties();
    }
	
	$sect_sport = CIBlockSection::GetByID(1);
	if($ar_sect_sport = $sect_sport->GetNext())
	{
		//Получаем СЕО текст раздела
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
			$ar_sect_sport["IBLOCK_ID"],
			$ar_sect_sport["ID"]
		);
		$ar_sect_sport["IPROPERTY_VALUES"] = $ipropValues->getValues();

	}
	//URL TEXT
		return "/".$whe_city."/".$ar_sect_sport['CODE']."/".$arFields['CODE'].'/';

}


//Обработка сезонности элементов
function seaseon()
{
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
				//$sean_start_day = explode(".",$sean_start)[0];
				//$sean_start_month = explode(".",$sean_start)[1];				
				
				$sean_finish = $season[1];
				//$sean_finish_day = explode(".",$sean_finish)[0];
				//$sean_finish_month = explode(".",$sean_finish)[1];	

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
}

/*перенаправление на 404*/
AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);  
function _Check404Error(){
   if(defined('ERROR_404') && ERROR_404=='Y' || CHTTP::GetLastStatus() == "404 Not Found"){
      global $APPLICATION;
      $APPLICATION->RestartBuffer();
      require ($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php');
      require $_SERVER['DOCUMENT_ROOT'].'/404.php';
      require ($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php');
   }
}
?>