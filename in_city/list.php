<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Отдых в городе");
?>
<div class="bgray-light">
    <div class="container">
		<?
			//Хлебные крошки
		?> 
		
		<?
			$APPLICATION->IncludeComponent("ls:breadcrumb","",Array(
				"START_FROM" => "0", 
				"PATH" => "", 
				"SITE_ID" => "s1" 
			)
			);
		?>
		<?
			//
		?>
        <div class="pad_40_0 table zagolovok_ev">
            <h1 class="table-cell"><?=$APPLICATION->ShowTitle('h1');?></h1>
            <div class="add_events_button table-cell">
                <?$APPLICATION->IncludeComponent(
                	"bitrix:main.include",
                	"",
                	Array(
                		"COMPONENT_TEMPLATE" => ".default",
                		"AREA_FILE_SHOW" => "file",
                		"AREA_FILE_SUFFIX" => "inc",
                		"EDIT_TEMPLATE" => "",
                		"PATH" => "/include/add_events_button.php"
                	)
                );?>
            </div>
        </div>
        
        <?  $pos=strripos($_SERVER['REQUEST_URI'], '/sportivnye-sekcii-v-surgute/');
            /*Все остальные категории*/
            if($pos === false){ 
        ?>
                        <div class="search">
                                <input type="text" id="ajax-search" onkeypress="if (event.keyCode == 13) ajaxsearch()" placeholder="Быстрый поиск"/>
                                <input type="submit" id="ajax-search-button" onclick="ajaxsearch()" value="Искать"/>
                        </div>
                            <?
                                $iblok_id = '2';
                                $category =  $_SERVER['REQUEST_URI'];
                                $category = explode("?", $category);
                                $category = explode("/", $category[0]);
                            ?>
                            <?
                                $array_empty = array('');
                                $cat = array();
                                $category = array_diff($category, $array_empty);
                                foreach($category as $item):
                                    array_push($cat ,$item);
                                endforeach;
                            ?>
                         <?
                                $arr = list_category($cat[count($cat)-1]);
                                /*Получаем значение где(в городе /за городом)*/
                                $params = $cat[count($cat)-2];
                                $city = $params;
                                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>2, "XML_ID"=>$params));
                                if($enum_fields = $property_enums->GetNext())
                                
                                global $arrFilter;
                                
                                $arrFilter = Array(
                                /*"!=ID"=>$arResult['ID'],*/
                                "PROPERTY_category"=>$arr[0]['ID'],
                                "PROPERTY_params_VALUE" => $enum_fields['~VALUE'],
                                //">=DATE_ACTIVE_TO" => "17.04.2015",
                                );
                                if($arr[0]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']!='')      
                                        $APPLICATION->SetTitle(''.$arr[0]['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']);
                                else
                                    $APPLICATION->SetTitle(''.$arr[0]['NAME']);
                                
                                if($arr[0]['IPROPERTY_VALUES']['ELEMENT_META_TITLE']!='')      
                                        $APPLICATION->SetPageProperty('title', ''.$arr[0]['IPROPERTY_VALUES']['ELEMENT_META_TITLE']);
								
								if($arr[0]['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']!='')      
                                        $APPLICATION->SetPageProperty('Description', ''.$arr[0]['IPROPERTY_VALUES']['ELEMENT_META_DESCRIPTION']);
                                /*else
                                    $APPLICATION->SetTitle('Отдых в городе | '.$arr[0]['NAME']);*/
                                
                               // $arrFilter[">=DATE_ACTIVE_TO"] = "17.04.2015";
                               $category = $arr[0]['ID'];
                               $whe_city = $enum_fields['~VALUE'];
                                $_GET['category'] = $category;
                                $_GET['whe_city'] = $whe_city;
                               //Редирект на 404
							   if($category == '')
							   {
								   LocalRedirect("/404.php", "404 Not Found");
							   }
							   
                            ?>
                            <?
                                $type = type($category,$whe_city,$iblok_id);
                                uasort($type, "sort_p");
                            ?>
							
                            <div class="filter_type"> 
                                <label class="bx_filter_param_label" for="all">
                				    <span class="bx_filter_input_checkbox">
                						  <input
                                                type="radio"
                                                value="Все"
                                                name="type"
                                                id="all"
                                                class="type_radio"
                                                checked="checked"
                                                onclick="filter('<?=$category?>','<?=$city?>','type','');"
                				            />
                                            <span class="bx_filter_param_text">Все</span>
                                    </span>
                				</label>
                                <?foreach($type as $val => $ar):?>
                				    <label data-role="label_<?=$ar["type"]?>" class="bx_filter_param_label" for="<?=$ar["type"]?>">
                						<span class="bx_filter_input_checkbox">
                							<input
                								type="radio"
                								value="<?=$ar["type_name"]?>"
                								name="type"
                                                class="type_radio"
                								id="<?=$ar["type"]?>"
                								<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                onclick="filter('<?=$category?>','<?=$city?>','type','<?echo $ar["type"];?>');"
                							/>
                                            <?
                                                if($ar["CHECKED"] == 'checked')
                                                {
                                                   $name_activ = $ar["type_name"];
                                                }
                                            ?>
                							<span class="bx_filter_param_text"><? echo $ar["type_name"]; ?></span>
                						</span>
                	               </label>
                				<?endforeach;?>
                                <div class="clear">
                                    <span href="#" onclick="clear_filter()">
                                        Сбросить все
                                    </span>
                                </div>
                                <div class="row parent-calendar" style="opacity: 0; display: none;">
                                    <div class="calendar right table">
                                        <?
                                                    date_default_timezone_set("UTC"); // Устанавливаем часовой пояс по Гринвичу
                                                    $time = time(); // Вот это значение отправляем в базу
                                                    $offset = 5; // Допустим, у пользователя смещение относительно Гринвича составляет +3 часа
                                                    $time += 5 * 3600; // Добавляем 3 часа к времени по Гринвичу
                                        ?>
                                                <a class="w60 h60 black text-center table-cell date" href="" id="date_all" onclick="select_date(event,'all','all')" data-time="" rel="nofollow">Все</a>
                                            <?for($a=0; $a<=12;$a++){?>
                                                <a class="w60 h60 black text-center table-cell date <?if($a==0):?>borderleft<?endif;?>" href="" id="date_<?=($time + 24*$a * 60 * 60);?>" onclick="select_date(event,'<?=($time + 24*$a * 60 * 60);?>','<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>')" data-time="<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>" rel="nofollow">
                                                    <p class="day">
                                                        <?echo date('j',$time + 24*$a * 60 * 60);?>
                                                    </p>
                                                    <p class="week">
                                                        <?echo uWeek(date('D',$time + 24*$a * 60 * 60));?>
                                                    </p>
                                                </a>
                                            <?}?>
                                            <a class="w150 h60 black text-center table-cell date" href="" onclick="other_date(event)" id="date_other" rel="nofollow">Другая дата
                                                <div class="trigon"></div>
                                            </a>
                                    </div>
                                    <div class="other_date" id="other_date"></div>
                                </div>
                            </div>
                        <div class="content-preloader text-center" style="display: none;">
                            <img class="preloader" src="/images/tail-spin.svg" width="50" alt="">
                        </div>
							
						<?
							//Получаем список банеров для данной категории
							$baner_c = baner_c($whe_city,$category);
							$count_b = count($baner_c);
						?>
						<?
							//Добавляем новый путь
							$APPLICATION->AddChainItem($arr[0]['NAME'], "");
						?>
                        <div class="pad_20_0 small-block" id="material">
                            <!-- Материал -->
                            <?$APPLICATION->IncludeComponent(
                            	"ls:news.list",
                            	"small-block",
                            	Array(
                            		"IBLOCK_TYPE" => "content",
                            		"IBLOCK_ID" => '2',
                            		"NEWS_COUNT" => $GLOBALS['options_props']['count_element']['~VALUE'] - ($count_b*2),
                            		"SORT_BY1" => "ACTIVE_FROM",
                            		"SORT_ORDER1" => "DESC",
                            		"SORT_BY2" => "SORT",
                            		"SORT_ORDER2" => "ASC",
                
                            		"FILTER_NAME" => "arrFilter",
                            		"FIELD_CODE" => array("ACTIVE_TO","ACTIVE_FROM"),
                            		"PROPERTY_CODE" => array("category",'type','event_place','address','metka'),
                            		"CHECK_DATES" => "Y",
                            		"DETAIL_URL" => "",
                            		"AJAX_MODE" => "Y",
                            		"AJAX_OPTION_JUMP" => "Y",
                            		"AJAX_OPTION_STYLE" => "Y",
                            		"AJAX_OPTION_HISTORY" => "Y",
                            		"CACHE_TYPE" => "A",
                            		"CACHE_TIME" => "36000000",
                            		"CACHE_FILTER" => "Y",
                            		"CACHE_GROUPS" => "Y",
                            		"PREVIEW_TRUNCATE_LEN" => "",
                            		"ACTIVE_DATE_FORMAT" => "d.m.Y",
                            		"SET_TITLE" => "N",
                            		"SET_BROWSER_TITLE" => "N",
                            		"SET_META_KEYWORDS" => "N",
                            		"SET_META_DESCRIPTION" => "N",
                            		"SET_STATUS_404" => "N",
                            		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            		"ADD_SECTIONS_CHAIN" => "Y",
                            		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            		"PARENT_SECTION" => "",
                            		"PARENT_SECTION_CODE" => "",
                            		"INCLUDE_SUBSECTIONS" => "Y",
                            		"DISPLAY_DATE" => "Y",
                            		"DISPLAY_NAME" => "Y",
                            		"DISPLAY_PICTURE" => "Y",
                            		"DISPLAY_PREVIEW_TEXT" => "Y",
                            		"PAGER_TEMPLATE" => ".default",
                            		"DISPLAY_TOP_PAGER" => "N",
                            		"DISPLAY_BOTTOM_PAGER" => "Y",
                            		"PAGER_TITLE" => "Новости",
                            		"PAGER_SHOW_ALWAYS" => "Y",
                            		"PAGER_DESC_NUMBERING" => "N",
                            		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            		"PAGER_SHOW_ALL" => "Y",
									"baner_c"=>$baner_c
                            	)
                            );?>
                            <?//include_once $_SERVER['DOCUMENT_ROOT']."/include/in_city_material.php";?>
                            
                            
                        </div>
						
                        <div class="pad_50_0 text-center">
							<?echo $arr[0]['PREVIEW_TEXT']?>
                        </div>
        <?}else{?>
         <?/*если выбрана страница Занятия в секциях*/?>
            <div class="search">
                 <input type="text" id="ajax-search" onkeypress="if (event.keyCode == 13) ajaxsearch_cat()" placeholder="Быстрый поиск"/>
                 <input type="submit" id="ajax-search-button" onclick="ajaxsearch_cat()" value="Искать"/>
            </div>
            <?
							$APPLICATION->SetTitle("Занятия в спортивных секциях");
							//Получаем свойства раздела
							$sect_sport = CIBlockSection::GetByID(1);
							if($ar_sect_sport = $sect_sport->GetNext())
							{
								//Получаем СЕО текст раздела
								$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues(
									$ar_sect_sport["IBLOCK_ID"],
									$ar_sect_sport["ID"]
								);
      
								$ar_sect_sport["IPROPERTY_VALUES"] = $ipropValues->getValues();
								//echo "<pre>"; print_r($ar_sect_sport); echo '</pre>';
							}
                                $iblok_id = '2';
                                $category =  $_SERVER['REQUEST_URI'];
                                $category = explode("?", $category);
                                $category = explode("/", $category[0]);
                            ?>
                            <?
                                $array_empty = array('');
                                $cat = array();
                                $category = array_diff($category, $array_empty);
                                foreach($category as $item):
                                    array_push($cat ,$item);
                                endforeach;
                            ?>
                        <?
                                //$arr = list_category($cat[count($cat)-1]);
                                /*Получаем значение где(в городе /за городом)*/
                                $params = $cat[0];
                                
								$city = $params;
                                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>2, "XML_ID"=>$params));
                                if($enum_fields = $property_enums->GetNext())
                                
                                global $arrFilter;
                                //echo $params;
                                $arrFilter = Array(
                                //"PROPERTY_category"=>$arr[0]['ID'],
                                "PROPERTY_params_VALUE" => $enum_fields['~VALUE'],
                                );
								
								$id_cat = '';
								if($cat[count($cat)-1] != 'sportivnye-sekcii-v-surgute')
								{
									$arSelect_cat = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PREVIEW_TEXT");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
									$arFilter_cat = Array("IBLOCK_ID"=>1, "CODE"=>$cat[count($cat)-1], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
									$res_cat = CIBlockElement::GetList(Array(), $arFilter_cat, false, false, $arSelect_cat);

									while($ob = $res_cat->GetNextElement()){ 
										$arFields_cat = $ob->GetFields();
									}
									$arrFilter['PROPERTY_category'] = $arFields_cat['ID'];
									$id_cat = $arFields_cat['ID'];
									$name_cat = $arFields_cat['NAME'];
									 //Редирект на 404
									   if($id_cat == '')
									   {
										   LocalRedirect("/404.php", "404 Not Found");
									   }
								}
								
								
								if($ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_TITLE'] != '')
									$APPLICATION->SetPageProperty('title', $ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_TITLE']);
								else	
									$APPLICATION->SetTitle($ar_sect_sport['NAME']);
								
								if($ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_DESCRIPTION']!='')      
                                        $APPLICATION->SetPageProperty('Description', ''.$ar_sect_sport['IPROPERTY_VALUES']['SECTION_META_DESCRIPTION']);
							   
								$whe_city = $enum_fields['~VALUE'];
                                    $_GET['whe_city'] = $city;
                               
                               
                            ?>
                            <?
                                $category_section = cat_section($whe_city,$iblok_id);
                                uasort($category_section, "sort_c");
                            ?>
                            <?
                                $type_c = array();
                                $type_a = array();
                                foreach($category_section as $item)
                                {
                                    $type = type($item,$whe_city,$iblok_id);
                                    uasort($type, "sort_p");
                                    foreach($type as $i)
                                    {
                                        if (in_array($i['type'], $type_c, true) != true) {
                                            array_push($type_c ,$i);
                                        }
                                    }
                                }
                                $type_c= array_map("unserialize", array_unique( array_map("serialize", $type_c) ));
                                uasort($type_c, "sort_p");
                            ?>
								
                            <div class="filter-category iselect" >
                                <div class="iselect-header">Вид спорта</div>
                                <ul class="iselect-option">
                                    <?
                                        $filter_or = array();
                                        $filter_or_element = array();
                                        $filter_or['LOGIC'] = 'OR';
                                    ?>
                                    <?foreach($category_section as $item):?>
                                        
                                        <?
                                            $filter_or_element = array(array("PROPERTY_category"=>$item['ID_CATEGORY']));
                                            $filter_or =  array_merge($filter_or, $filter_or_element);
                                        ?>
                                        <li>
                                            <input type="checkbox" onclick="cat_select(this,'<?=$city?>')" id="sport_<?=$item['ID_CATEGORY']?>" value="<?=$item['ID_CATEGORY']?>" <?if($id_cat == $item['ID_CATEGORY']):?>checked<?endif;?>/>
                                            <label for="sport_<?=$item['ID_CATEGORY']?>">
                                            <span class="qub"></span>
                                            <?=$item['NAME_CATEGORY']?></label> 
                                        </li>
                                            
                                    <?endforeach;?>
                                </ul>
                                <?
                                    $arrFilter = array_merge($arrFilter, array($filter_or));
                                    
                                ?>                                
                            </div>
                            <div class="result-category">
                                <?if($id_cat != ''):?>
									<div class="clear_cat">
										<span onclick="cat_del('<?=$city?>','sport_<?=$id_cat?>')">
                                            <?=$name_cat?>
										</span>
									</div>
									<?
										$title = iconv('utf-8','windows-1251',category_cat_TITLE($id_cat));
										$seo = iconv('utf-8','windows-1251',category_cat_SEO($id_cat));
										$h1 = iconv('utf-8','windows-1251',category_cat_TITLE($id_cat,1));
										
										$desc = iconv('utf-8','windows-1251',category_cat_TITLE($id_cat,2));
										//echo $desc;
										$APPLICATION->SetTitle($h1);
										$APPLICATION->SetPageProperty('title', $title);
										$APPLICATION->SetPageProperty("description", $desc); 
									?>
								<?endif;?>
                            </div>
                            <div class="filter_type"> 
                                <label class="bx_filter_param_label" for="all">
                				    <span class="bx_filter_input_checkbox">
                						  <input
                                                type="radio"
                                                value="Все"
                                                name="type"
                                                id="all"
                                                class="type_radio"
                                                checked="checked"
                                                onclick="filter_cat('<?=$city?>','type','');"
                				            />
                                            <span class="bx_filter_param_text">Все</span>
                                    </span>
                				</label>
                                <?foreach($type_c as $val => $ar):?>
                				    <label data-role="label_<?=$ar["type"]?>" class="bx_filter_param_label" for="<?=$ar["type"]?>">
                						<span class="bx_filter_input_checkbox">
                							<input
                								type="radio"
                								value="<?=$ar["type_name"]?>"
                								name="type"
                                                class="type_radio"
                								id="<?=$ar["type"]?>"
                								<? echo $ar["CHECKED"]? 'checked="checked"': '' ?>
                                                onclick="filter_cat('<?=$city?>','type','<?echo $ar["type"];?>');"
                							/>
                                            <?
                                                if($ar["CHECKED"] == 'checked')
                                                {
                                                   $name_activ = $ar["type_name"];
                                                }
                                            ?>
                							<span class="bx_filter_param_text"><? echo $ar["type_name"]; ?></span>
                						</span>
                	               </label>
                				<?endforeach;?>
                                <div class="clear">
                                    <span href="#" onclick="clear_filter_cat()">
                                        Сбросить все
                                    </span>
                                </div>
                                <div class="row parent-calendar" style="opacity: 0; display: none;">
                                    <div class="calendar right table">
                                        <?
                                                    date_default_timezone_set("UTC"); // Устанавливаем часовой пояс по Гринвичу
                                                    $time = time(); // Вот это значение отправляем в базу
                                                    $offset = 5; // Допустим, у пользователя смещение относительно Гринвича составляет +3 часа
                                                    $time += 5 * 3600; // Добавляем 3 часа к времени по Гринвичу
                                        ?>
                                                <a class="w60 h60 black text-center table-cell date" href="" id="date_all" onclick="select_date_cat(event,'all','all')" data-time="" rel="nofollow">Все</a>
                                            <?for($a=0; $a<=12;$a++){?>
                                                <a class="w60 h60 black text-center table-cell date <?if($a==0):?>borderleft<?endif;?>" href="" id="date_<?=($time + 24*$a * 60 * 60);?>" onclick="select_date_cat(event,'<?=($time + 24*$a * 60 * 60);?>','<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>')" data-time="<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>" rel="nofollow">
                                                    <p class="day">
                                                        <?echo date('j',$time + 24*$a * 60 * 60);?>
                                                    </p>
                                                    <p class="week">
                                                        <?echo uWeek(date('D',$time + 24*$a * 60 * 60));?>
                                                    </p>
                                                </a>
                                            <?}?>
                                            <a class="w150 h60 black text-center table-cell date" href="" onclick="other_date_cat(event)" id="date_other_cat" rel="nofollow">Другая дата
                                                <div class="trigon"></div>
                                            </a>
                                    </div>
                                    <div class="other_date" id="other_date_cat"></div>
                                </div>
                            </div>
                        <?
							$category = 'all';
                            $_GET['category'] = 'all';
                            //$_GET['whe_city'] = $whe_city;
                            //echo $_GET['category'];
                        ?>
						<?
							//Получаем список банеров для данной категории
							//$baner_c = baner_c($whe_city,$category);
							//$count_b = count($baner_c); 
						?>
                        <div class="content-preloader text-center" style="display: none;">
                            <img class="preloader" src="/images/tail-spin.svg" width="50" alt="">
                        </div>   
						<?
							//Добавляем новый путь
							$APPLICATION->AddChainItem($ar_sect_sport['NAME'], "");
						?>

						<?
							//Получаем список банеров для данной категории
							$baner_cat = baner_cat($whe_city,$category);
							$count_b = count($baner_cat);

							if($count_b>3)
							{
								$rand_array = array();
								while(count($rand_array) != 3)
								{
									$rand_array =  array_rand(range(0,$count_b-1), 3);
								}
								foreach($rand_array as $n=>$item)
								{
									$baner_c[$n] = $baner_cat[$item];
								}
							}
							else
							{
								$baner_c = $baner_cat;
							}
							$count_b = count($baner_c);
						?>
						<?
					       	/*echo '<pre>';
							print_r($baner_c);
							echo '</pre>';*/
						?>
                        <div class="pad_20_0 small-block" id="material">
                        <!-- Материал -->
                            <?$APPLICATION->IncludeComponent(
                            	"ls:news.list",
                            	"small-block_cat",
                            	Array(
                            		"IBLOCK_TYPE" => "content",
                            		"IBLOCK_ID" => '2',
                            		"NEWS_COUNT" => $GLOBALS['options_props']['count_element']['~VALUE'] - ($count_b*2),
                            		"SORT_BY1" => "ACTIVE_FROM",
                            		"SORT_ORDER1" => "DESC",
                            		"SORT_BY2" => "SORT",
                            		"SORT_ORDER2" => "ASC",
                
                            		"FILTER_NAME" => "arrFilter",
                            		"FIELD_CODE" => array("ACTIVE_TO","ACTIVE_FROM"),
                            		"PROPERTY_CODE" => array("category",'type','event_place','address','metka'),
                            		"CHECK_DATES" => "Y",
                            		"DETAIL_URL" => "",
                            		"AJAX_MODE" => "Y",
                            		"AJAX_OPTION_JUMP" => "Y",
                            		"AJAX_OPTION_STYLE" => "Y",
                            		"AJAX_OPTION_HISTORY" => "Y",
                            		"CACHE_TYPE" => "A",
                            		"CACHE_TIME" => "36000000",
                            		"CACHE_FILTER" => "Y",
                            		"CACHE_GROUPS" => "Y",
                            		"PREVIEW_TRUNCATE_LEN" => "",
                            		"ACTIVE_DATE_FORMAT" => "d.m.Y",
                            		"SET_TITLE" => "N",
                            		"SET_BROWSER_TITLE" => "N",
                            		"SET_META_KEYWORDS" => "N",
                            		"SET_META_DESCRIPTION" => "N",
                            		"SET_STATUS_404" => "N",
                            		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                            		"ADD_SECTIONS_CHAIN" => "Y",
                            		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
                            		"PARENT_SECTION" => "",
                            		"PARENT_SECTION_CODE" => "",
                            		"INCLUDE_SUBSECTIONS" => "Y",
                            		"DISPLAY_DATE" => "Y",
                            		"DISPLAY_NAME" => "Y",
                            		"DISPLAY_PICTURE" => "Y",
                            		"DISPLAY_PREVIEW_TEXT" => "Y",
                            		"PAGER_TEMPLATE" => ".default",
                            		"DISPLAY_TOP_PAGER" => "N",
                            		"DISPLAY_BOTTOM_PAGER" => "Y",
                            		"PAGER_TITLE" => "Новости",
                            		"PAGER_SHOW_ALWAYS" => "Y",
                            		"PAGER_DESC_NUMBERING" => "N",
                            		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                            		"PAGER_SHOW_ALL" => "Y",
									"baner_c"=>$baner_c
                            	)
                            );?>
                            <?//include_once $_SERVER['DOCUMENT_ROOT']."/include/in_city_material.php";?>
                            
                            
                        </div>
						<div class="pad_25_0">
							<div class="text-center"><h2>Спортивные секции в городе Сургут</h2></div><br/>
							<div class="category row">
								<div class="row line">
								<? $a=0;?>
								<?foreach($category_section as $item):?>
                                        
                                        <?
                                            $filter_or_element = array(array("PROPERTY_category"=>$item['ID_CATEGORY']));
                                            $filter_or =  array_merge($filter_or, $filter_or_element);
                                        ?>
										<?if($a == 5):?></div><div class="row line"><?$a=0; endif;?>
										<a href="/in_city/<?=$item['CODE_CATEGORY']?>/" class="left text-center bwhite category-button ">
											<div><?=$item['NAME_CATEGORY']?></div>
										</a>
										<?
										$a++;?>	
								<?
									endforeach;
								?>
								</div>
							</div>
						</div>
                        <div class="pad_50_0 text-center" id="SEO_TEXT">
							<?
								if($id_cat == '')
									echo $ar_sect_sport['DESCRIPTION'];
								else
									echo $seo;
							?>
                        </div>
                        
                            
        <?}?>
                                
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
<?
    function sort_p($a, $b)
    {
        return strcmp($a["type"], $b["type"]);
    }
    function sort_c($a, $b)
    {
        return strcmp($a["NAME_CATEGORY"], $b["NAME_CATEGORY"]);
    }
?>