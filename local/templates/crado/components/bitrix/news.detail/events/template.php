<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?//if($arResult['PROPERTIES']['type']['VALUE_XML_ID']!='events') die(); ?>
<?
    /*Проверка правильности url*/
    /*$url = $APPLICATION->GetCurPage();
    $pos = strpos($url, $arResult['PROPERTIES']['type']['VALUE_XML_ID']);
    if ($pos === false) {
        LocalRedirect('/404.php');
    }*/
?>


<div class="event">
    <div class="bgray-light">
        <div class="container event-preview">
            <div class="return">
                <a href="javascript:history.back()" rel="nofollow">
                    
                        <span class="treug"></span>
                        <span>Вернутся назад</span>
                    
                </a>
            </div>

            <div class="row">
                <div class="photos" id="allphotos-event">
                        <div class="closed white" id="close"></div>
                        <div class="white carousel">
                            	 
                                <ul class="carousel-inner"> 
                                    <?      
                                        /*$file = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>475, 'height'=>420),
                                         BX_RESIZE_IMAGE_EXACT);?>
                                        <?
                                           $width = '475px';
                                           $height = 'px';
                                        */?>
                                    <li class="slider-item">
                                        <img class="" src="<?=$arResult['DETAIL_PICTURE']['SRC'];?>"  alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>"/> 				 
                                    </li>
                                    <?foreach($arResult['PROPERTIES']['video']['VALUE'] as $arItem):?>
                                        <li class="slider-item">
                                            <div class="video">
                                                <iframe width="880" height="560" src="https://www.youtube.com/embed/<?=$arItem?>" frameborder="0" allowfullscreen></iframe>	
                                            </div>		 
                                        </li>
                                    <?endforeach;?>
                                    <?foreach($arResult['PROPERTIES']['dop_images']['VALUE'] as $arItem):?>
                                        <?$file = CFile::GetPath($arItem);?>
                                        <li class="slider-item">
                                            <img class="" src="<?=$file?>"/> 				 
                                        </li>
                                    <?endforeach;?>
                                        
                                </ul>
                                <?/*
                                    <pre>
                                        <?print_r($arResult['PROPERTIES']['dop_images']);?>
                                    </pre>
                                */?>
                            <div class="carousel-controlls">
                                <a href="#" class="arr prev"></a>
                                <a href="#" class="arr next"></a>
                            </div>
        
                        </div>        
                </div> 
                <div class="head-event">
                    <div class="imag left">
                        <?      
                            $file = CFile::ResizeImageGet($arResult['DETAIL_PICTURE']['ID'], array('width'=>475, 'height'=>420),
                             BX_RESIZE_IMAGE_EXACT);?>
                            <?
                               $width = '475px';
                               $height = '420px';
                            ?>
                         <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>" alt="<?=$arResult['DETAIL_PICTURE']['ALT']?>"/>
                            <?  $d_element = date_element($arResult['IBLOCK_ID'],$arResult['ID']);?>
                            <?
                                //$date_to_from = date_to_from($d_element['DATE_ACTIVE_FROM'],$d_element['DATE_ACTIVE_TO']);
                            /*?>
                            <pre>
                            <?print_r($d_element);?>
                            </pre>
                            <?*/
                                $date_from = explode(' ', $d_element['PROPERTY_DATE_ACTIVE_FROM_VALUE']);
                                $date_to = explode(' ', $d_element['DATE_ACTIVE_TO']);
                                $w = 0;
                                /* $date_from[0].'<br>';
                                echo $date_to[0].'<br>';
                                /echo date(strtotime($date_to[0])); 
                                echo date(strtotime($date_from[0]));*/
                                if(strtotime($date_from[0]) < strtotime($date_to[0]))
                                {
                                    $date_from = explode('.', $date_from[0]);
                                    $date_to = explode('.', $date_to[0]);
                                    $w = 160;
                                    ?>
                                    <div class="date red w160 h60 table">
                                        
                                            <div class="start-date col-5 table-cell text-center">
                                                <p class="day"><?=$date_from[0]?></p>
                                                <p class="month"><?echo uMonth((int)$date_from[1])?></p>
                                            </div>
                                            <div class="col-2 table-cell text-center"> - </div>
                                            <div class="end-date col-5 table-cell text-center">
                                                <p class="day"><?=$date_to[0]?></p>
                                                <p class="month"><?echo uMonth((int)$date_to[1])?></p>
    
                                        </div>
                                    </div>
                                    <? 
                                }
                                else
                                {
                                    $date_from = explode('.', $date_from[0]); 
                                    $w = 120;  
                                    ?>
                                    <div class="date red w120 h60">
                                        <div class="text-center table-cell w120 h60">
                                            <p class="day"><?=$date_from[0]?></p>
                                            <p class="month"><?=uMonth((int)$date_from[1])?></p>
                                        </div>
                                    </div>
                                    <? 
                                }
                                
                                if($w == 160)
                                {
                                    ?>
                                        <div class="address bblack table h60 w315">
                                            <?if($arResult['PROPERTIES']['type']['VALUE_XML_ID'] == 'events'):?>
                                                    	<?if($arResult['PROPERTIES']['event_place']['~VALUE'] != ''):?>
																<? 
																	$event = event_place($arResult['PROPERTIES']['event_place']['~VALUE']);
																?>
																<a  class="white name-geo" href="/places/<?=$event[0]['CODE']?>/">
																		<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																		<?=$event[0]['NAME'];?>
																</a>
																<?else:?>
																<p class="white name-geo">
																	<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																	<?=$arResult['PROPERTIES']['address']['VALUE'];?>
																</p>
															<?endif;?>
                                                  <?/*
                                                   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>
                                                        */?>
                                                     
                                                 <? else:?>  
                                                    <p class="white name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$mater[$n]['PROPERTY'][0]['address']['VALUE'];?>
                                                    </p>
                                                 <?endif;?>
                                            
                                            
                                            <? /*
                                               $event = event_place($arResult['PROPERTIES']['event_place']['~VALUE']);
                                            ?>
                                            <div class="geo table-cell">
                                                  <svg class="icons w9"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                            </div>
                                             <p class="white name-geo table-cell">
                                                    <?=$event[0]['NAME'];?>
                                             </p>
                                             */?>
                                        </div>
                                    <?
                                }
                                else
                                {
                                    ?>
                                        <div class="address bblack table h60 w355">
                                            <?if($arResult['PROPERTIES']['type']['VALUE_XML_ID'] == 'events'):?>
                                                    	<?if($arResult['PROPERTIES']['event_place']['~VALUE'] != ''):?>
																<? 
																	$event = event_place($arResult['PROPERTIES']['event_place']['~VALUE']);
																?>
																<a  class="white name-geo" href="/places/<?=$event[0]['CODE']?>/">
																		<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																		<?=$event[0]['NAME'];?>
																</a>
																<?else:?>
																<p class="white name-geo">
																	<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																	<?=$arResult['PROPERTIES']['address']['VALUE'];?>
																</p>
															<?endif;?>
                                                  <?/*
                                                   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>
                                                        */?>
                                                     
                                                 <? else:?>  
                                                    <p class="white name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$mater[$n]['PROPERTY'][0]['address']['VALUE'];?>
                                                    </p>
                                                 <?endif;?>
                                           <? /*
                                               $event = event_place($arResult['PROPERTIES']['event_place']['~VALUE']);
                                            ?>
                                            <div class="geo table-cell">
                                                  <svg class="icons w9"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                            </div>
                                             <p class="white name-geo table-cell">
                                                    <?=$event[0]['NAME'];?>
                                             </p>
                                             */?>
                                        </div>
                                    <?
                                }
                            ?>
                            
                            <div class="allphoto table h40 w160 white" id="allphotos">
                                    <div class="photo table-cell text-center">
                                        <svg class="icons w15"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#camera-icon"></use></svg>
                                    </div>
                                    <p class="name-photo table-cell">Смотреть все</p>
                            </div>   
                    </div>
                    <div class="anonse left">
                        <h1>
                            <?=$arResult["NAME"]?>
                        </h1>
                        <div class="preview-text">
                            <?=$arResult["PREVIEW_TEXT"];?>
                        </div>
                        
                         <?if($arResult['PROPERTIES']['metka']['~VALUE'] != ''):?>
                        <div class="tags row">
                            <div class="tag row left">
                                 <?
                                            $link_tag = tags_link($arResult['PROPERTIES']['metka']['~VALUE']);
                                 ?>
                                <a href="<?=$link_tag?>" class="link_tag">
                                   <div class="name-tag"><?=tags($arResult['PROPERTIES']['metka']['~VALUE'])?></div>
                                   <div class="trigon"></div>
                               </a>
                           </div>

                           <?foreach($arResult['PROPERTIES']['dop_metka']['VALUE'] as $id_metka):?>
                           <?
                                //Определяем активные ли метка
                                
                                $arSelect = Array("ID", "ACTIVE");
                                $arFilter = Array("IBLOCK_ID"=>5, "ID"=>$id_metka);
                                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
                                while($ob = $res->GetNextElement())
                                {
                                     $arFields = $ob->GetFields();
                                     $active = $arFields['ACTIVE'];
                                }
                                if($active=='Y'):
                               ?>
                               <div class="tag row left">
                                    <?
                                                $link_tag = tags_link($id_metka);
                                     ?>
                                    <a href="<?=$link_tag?>" class="link_tag">
                                       <div class="name-tag"><?=tags($id_metka)?></div>
                                       <div class="trigon"></div>
                                   </a>
                               </div>
                               <?endif?>
                           <?endforeach;?>
                           
                        </div>
                        
                        <?endif;?>
                        <div class="social">
                              <?$APPLICATION->IncludeComponent("bitrix:asd.favorite.button", "crado", Array(
                                        "FAV_TYPE" => "content",	// Тип избранного
                                        "BUTTON_TYPE" => "fav",	// Тип кнопки
                              			"ELEMENT_ID" => $arResult["ID"],	// ID элемента
                              			"GET_COUNT_AFTER_LOAD" => "Y",	// Обновить счетчик уже после загрузки страницы
                              			"SET_COUNT" => '',	// Количество голосов
                              			"FAVED" => '',	// Есть голос
                                		),
                                		false
                                	);?>
                            <a class="col-3 comments scroll" href="#comments">
                                <div class="text">Отзывы</div>
                                <?
                                    $ob = 'ob_'.$arResult['ID'];
                                    $arFilter = Array('IBLOCK_ID'=>9, 'GLOBAL_ACTIVE'=>'Y','CODE' =>$ob );
                                    $db_list = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
                                    /*$db_list->NavStart(20);
                                    echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);*/
                                    while($ar_result = $db_list->GetNext())
                                    {
                                        $col_comments = $ar_result['ELEMENT_CNT'];
                                    }
                                    //echo $db_list->NavPrint($arIBTYPE["SECTION_NAME"]);
                                ?>
                                <div class="comment">
                                        <svg class="icons"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#comment-icon"></use></svg>
                                 </div>
                                <div class="znach"><?=$col_comments?></div>
                            </a>
                            <div class="col-3 noborder nobutton">
                                <div class="view">
                                        <svg class="icons"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#view-icon"></use></svg>
                                 </div>
                                <div class="znach"> <?
                                    /*Количество просмотров*/
                                    CIBlockElement::CounterInc($arResult['ID']);
                                    $res = CIBlockElement::GetByID($arResult['ID']);                                      
                                    if($ar_res = $res->GetNext())  
                                        echo $ar_res['SHOW_COUNTER'];
                                ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
		<div class="left">
			<div class="full-text">
				<?echo $arResult["DETAIL_TEXT"];?>
			</div>
			<div class="map text-center" id="map">
			
				<?if($arResult['PROPERTIES']['event_place']['~VALUE']!=''):?>
					 <?$event = event_place($arResult['PROPERTIES']['event_place']['~VALUE']);?>
						<?
							$ballon = '<p class="text-center"><b>'.$arResult["NAME"].'</b><br/>'.$event[0]['PROPERTY'][0]['address']['VALUE'].'</p>';
						 ?>
						<script type="text/javascript">
								// Как только будет загружен API и готов DOM, выполняем инициализацию
							var sMap,
							sPlacemark;
							ymaps.ready(function(){
								sMap = new ymaps.Map('map',{
									center: [<?=$event[0]['PROPERTY'][0]['map']['VALUE']?>],
									zoom: 15
								});
								
								sPlacemark = new ymaps.Placemark([<?=$event[0]['PROPERTY'][0]['map']['VALUE']?>], {
									balloonContentBody: '<?=$ballon?>'
								},{
									iconLayout: 'default#image',
									iconImageHref: '/images/geo.png',
									iconImageSize: [35,56]
								});
								sMap.behaviors.disable('scrollZoom');
								sMap.geoObjects.add(sPlacemark);
							});
							</script>
				<?else:?> 
					 <?
						$ballon = '<p class="text-center"><b>'.$arResult["NAME"].'</b><br/>'.$arResult['PROPERTIES']['address']['VALUE'].'</p>';
					 ?>
					 <script type="text/javascript">
								// Как только будет загружен API и готов DOM, выполняем инициализацию
							var sMap,
							sPlacemark;
							ymaps.ready(function(){
								sMap = new ymaps.Map('map',{
									center: [<?=$arResult['PROPERTIES']['map']['VALUE']?>],
									zoom: 15
								});
								
								sPlacemark = new ymaps.Placemark([<?=$arResult['PROPERTIES']['map']['VALUE']?>], {
									balloonContentBody: '<?echo $ballon;?>'
								},{
									iconLayout: 'default#image',
									iconImageHref: '/images/geo.png',
									iconImageSize: [35,56]
								});
								sMap.behaviors.disable('scrollZoom');
								sMap.geoObjects.add(sPlacemark);
							});
							</script>
				<?endif;?>
			</div>
			<?if($arResult['PROPERTIES']['dop_znachenia']['VALUE']!='' || $arResult['PROPERTIES']['rejim']['VALUE']!=''):?>
				<div class="settings">
				<?if($arResult['PROPERTIES']['dop_znachenia']['VALUE']!=''):?>
					<div class="dop-znachenia">
						<?for($a=0;$a<count($arResult['PROPERTIES']['dop_znachenia']['VALUE']); $a++){?>
							<div class="item">
								<strong><?=$arResult['PROPERTIES']['dop_znachenia']['DESCRIPTION'][$a];?>:</strong>
								<span><?=$arResult['PROPERTIES']['dop_znachenia']['VALUE'][$a];?></span>
							</div>
						<?}?>
					</div>
				<?endif;?>
				<?if($arResult['PROPERTIES']['rejim']['VALUE']!=''):?>
					<div class="rejim">
						<strong>Режим работы: </strong>
						<div class="rejim-el">
						<?/*<pre>
							<?print_r($arResult['PROPERTIES']['rejim'])?>
						</pre>*/?>
							<?=$arResult['PROPERTIES']['rejim']['~VALUE']['TEXT']?>
						</div>
					</div>
				<?endif;?>
				</div>
			<?endif;?>
			<div class="dop-text like">
			   <?
					$description = str_replace(array("\r\n", "\r", "\n","\"","<b>","</b>","«","»",","), "",  strip_tags(html_security($arResult["PREVIEW_TEXT"])));//str_replace(array("\r\n", "\r", "\n"), '',  "".strip_tags(html_security($arResult["PREVIEW_TEXT"]))."");
					
					$description = str_replace(array("'"), '&prime;',  $description);
					
					if(strlen($description) >=  325)
					{
						//echo strlen($description);
						$description = substr($description,0,325).'...';
					}
					//$description = strip_tags($description);
					
					$title = 'CRADO | '.$arResult["NAME"];
					$title = str_replace(array("'"), '&prime;',  $title);
					//$description = 'discription';
					$pimg = 'http://'.$_SERVER['HTTP_HOST'].$arResult["DETAIL_PICTURE"]["SRC"];
					$purl = 'http://'.$_SERVER['HTTP_HOST'].$GLOBALS["APPLICATION"]->GetCurPage();
					
					$APPLICATION->SetPageProperty("og:url", $purl);
					$APPLICATION->SetPageProperty("og:image", $pimg);
					$APPLICATION->SetPageProperty("og:title", $title);
					$APPLICATION->SetPageProperty("og:description", $description);
					
					$UF_VK=0;
					$UF_FB=0;
					$UF_TW=0;
					$UF_URL='//'.$_SERVER['HTTP_HOST'].$GLOBALS["APPLICATION"]->GetCurPage();
					
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
						  'filter' => array('UF_URL'=>$UF_URL),
						 ));
													 
					   while($res = $result->fetch())
						{
							//$id_razdel = $res['UF_ELEMENT_ENC'];
							$UF_VK=$res['UF_VK'];
							$UF_FB=$res['UF_FB'];
							$UF_OD=$res['UF_OD'];
						}
													
				?>
				<div class="row social-like">
					<div class="w200 button-like left" onclick="Share.vkontakte('<?=$purl?>','<?=$title?>','<?=$pimg?>','<?=$description?>')">
						<svg class="icons"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#vk-icon"></use></svg>
						<div class="count"><?if($UF_VK != '') echo $UF_VK; else echo '0';?></div>
					</div>
					<div class="w200 button-like left" onclick="Share.facebook('<?=$purl?>','<?=$title?>','<?=$pimg?>','<?=$description?>')">
						<svg class="icons"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#fb-icon"></use></svg>
						<div class="count"><?if($UF_FB != '') echo $UF_FB; else echo '0';?></div>
					</div>
					<div class="w200 button-like left" onclick="Share.odnoklassniki('<?=$purl?>','<?=$description?>')">
						<svg class="icons"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#ok-icon"></use></svg>
						<div class="count"><?if($UF_OD != '') echo $UF_OD; else echo '0';?></div>
					</div>
				</div>
			</div>
			<div class="dop-text com">
			<div class="comments text-center pad_15_15 active" id="comments">
				 Отзывы
			</div>
			<div class="items-comments active">
				 <?$APPLICATION->IncludeComponent(
					"khayr:main.comment",
					"crado-comment",
					Array(
						"OBJECT_ID" => $arResult['ID'],
						"COUNT" => "20",
						"MAX_DEPTH" => "1",
						"JQUERY" => "N",
						"ACTIVE_DATE_FORMAT" => "j F",
						"ASNAME" => "NAME",
						"REQUIRE_EMAIL" => "N",
						"ADDITIONAL" => array(""),
						"ALLOW_RATING" => "N",
						"MODERATE" => "N",
						"CAN_MODIFY" => "Y",
						"USE_PERMISSIONS" => "N",
						"GROUP_PERMISSIONS" => array("2"),
						"NON_AUTHORIZED_USER_CAN_COMMENT" => "N",
						"USE_CAPTCHA" => "N",
						"AUTH_PATH" => "/login/",
						"CACHE_TYPE" => "N",
						"CACHE_TIME" => "36000",
						"PAGER_TEMPLATE" => ".default",
						"DISPLAY_TOP_PAGER" => "N",
						"DISPLAY_BOTTOM_PAGER" => "Y",
						"PAGER_TITLE" => "",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"COMPONENT_TEMPLATE" => "crado-comment"
					)
				);?>
			</div>
		</div>
		</div>
		<div class="right">
			<div class="baner-element">
				<?foreach($arResult['PROPERTIES']['category']['VALUE'] as $item):
					$baner = baner_c_e($arResult['PROPERTIES']['params']['VALUE'],$item);
					if(count($baner)!=0) break;
				endforeach;?>
				<?if(count($baner)!=0){?>
                    <?
                    //Производим запись в БД по банеру
                    CModule::IncludeModule('cradobaners');
                    $banners = cCradoBaners::setCradoBanersView($baner[0]['ID']);
                    ?>
					<?      
						$file = CFile::ResizeImageGet($baner[0]['DETAIL_PICTURE'], array('width'=>280, 'height'=>480),
						BX_RESIZE_IMAGE_EXACT);
						$width = '280px';
						$height = '480px';
					?>
					<a href="<?=$baner[0]['PROPERTY'][0]['link']['~VALUE']?>" target="_blank" onclick="setClick(<?=$baner[0]['ID']?>);">
						<img src="<?=$file['src']?>" width="<?=$width?>" height="<?=$height?>"/>
					</a>
				<?}?>
			</div>
		</div>
    </div>
</div>

<?/*
<div class="news-detail">
	<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arResult["DETAIL_PICTURE"])):?>
		<img
			class="detail_picture"
			border="0"
			src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>"
			width="<?=$arResult["DETAIL_PICTURE"]["WIDTH"]?>"
			height="<?=$arResult["DETAIL_PICTURE"]["HEIGHT"]?>"
			alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"
			title="<?=$arResult["DETAIL_PICTURE"]["TITLE"]?>"
			/>
	<?endif?>
	<?if($arParams["DISPLAY_DATE"]!="N" && $arResult["DISPLAY_ACTIVE_FROM"]):?>
		<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
	<?endif;?>
	<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
		<h3><?=$arResult["NAME"]?></h3>
	<?endif;?>
	<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["FIELDS"]["PREVIEW_TEXT"]):?>
		<p><?=$arResult["FIELDS"]["PREVIEW_TEXT"];unset($arResult["FIELDS"]["PREVIEW_TEXT"]);?></p>
	<?endif;?>
	<?if($arResult["NAV_RESULT"]):?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?><?=$arResult["NAV_STRING"]?><br /><?endif;?>
		<?echo $arResult["NAV_TEXT"];?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?><br /><?=$arResult["NAV_STRING"]?><?endif;?>
	<?elseif(strlen($arResult["DETAIL_TEXT"])>0):?>
		<?echo $arResult["DETAIL_TEXT"];?>
	<?else:?>
		<?echo $arResult["PREVIEW_TEXT"];?>
	<?endif?>
	<div style="clear:both"></div>
	<br />
	<?foreach($arResult["FIELDS"] as $code=>$value):
		if ('PREVIEW_PICTURE' == $code || 'DETAIL_PICTURE' == $code)
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?
			if (!empty($value) && is_array($value))
			{
				?><img border="0" src="<?=$value["SRC"]?>" width="<?=$value["WIDTH"]?>" height="<?=$value["HEIGHT"]?>"><?
			}
		}
		else
		{
			?><?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?><?
		}
		?><br />
	<?endforeach;
	foreach($arResult["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>

		<?=$arProperty["NAME"]?>:&nbsp;
		<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
			<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
		<?else:?>
			<?=$arProperty["DISPLAY_VALUE"];?>
		<?endif?>
		<br />
	<?endforeach;
	if(array_key_exists("USE_SHARE", $arParams) && $arParams["USE_SHARE"] == "Y")
	{
		?>
		<div class="news-detail-share">
			<noindex>
			<?
			$APPLICATION->IncludeComponent("bitrix:main.share", "", array(
					"HANDLERS" => $arParams["SHARE_HANDLERS"],
					"PAGE_URL" => $arResult["~DETAIL_PAGE_URL"],
					"PAGE_TITLE" => $arResult["~NAME"],
					"SHORTEN_URL_LOGIN" => $arParams["SHARE_SHORTEN_URL_LOGIN"],
					"SHORTEN_URL_KEY" => $arParams["SHARE_SHORTEN_URL_KEY"],
					"HIDE" => $arParams["SHARE_HIDE"],
				),
				$component,
				array("HIDE_ICONS" => "Y")
			);
			?>
			</noindex>
		</div>
		<?
	}
	?>
</div>
*/?>