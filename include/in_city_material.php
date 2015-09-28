<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
   // echo 'Материал на главной отсортированный по дате с метками';
    if($_GET['page'])
    {
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }
    //$baner = baners($page);
    $k = 0;
    
	//настройки сайта
		$APPLICATION->IncludeComponent(
                                	"bitrix:main.include",
                                	"",
                                	Array(
                                		"COMPONENT_TEMPLATE" => ".default",
                                		"AREA_FILE_SHOW" => "file",
                                		"AREA_FILE_SUFFIX" => "inc",
                                		"EDIT_TEMPLATE" => "",
                                		"PATH" => "/include/option_site.php"
                                	)
                                );
	
	$baner_city = baner_city('in_city_link');						
	$count_b = count($baner_city);
	
    $page_size = $GLOBALS['options_props']['count_element']['~VALUE']- ($count_b*2);
    $count_element = count_element_in_city(2);
  
    $mater = material_incity($page_size,$page);
    $count_mater = count($mater);
    
    $count_element_ajax = 0;
    $count_element_ajax += $count_mater;
    ?>
     <div class="data_home" id="data-home">
        <div class="small-list">
            <div class="row">
            <?
            $k = -1;
             for($n=0; $n < $count_mater; $n++)
             {
                $k++;
                /*Дата проведения*/
                $date_to_from = date_to_from($mater[$n]['PROPERTY'][0]['date_active_from']['~VALUE'],$mater[$n]['ACTIVE_TO']);
                
                        ?> <?if($k == 4):?></div><div class="row"><?$k=0; endif;?>
						
						<?
		
						//Выводим 2 рекламный беанер
							if($count_b > 1){

								if($n == 6){
								?>
									<div class="medium baner marginrigth10 left">
                                        <?
                                        //Производим запись в БД по банеру
                                        CModule::IncludeModule('cradobaners');
                                        $banners = cCradoBaners::setCradoBanersView($baner_city[1]['ID']);
                                        ?>
                                        <?
											$file = CFile::ResizeImageGet($baner_city[1]['PREVIEW_PICTURE'], array('width'=>490, 'height'=>330),
											BX_RESIZE_IMAGE_EXACT);?>
										<?
											$width = '488px';
											$height = '328px';
										?>
										<a href="<?=$baner_city[1]['PROPERTY'][0]['link']['VALUE']?>" target="_blank" onclick="setClick(<?=$baner_city[1]['ID']?>);">
											<img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
										</a>
									</div>
								<?
								$k=2;
								}
							}
							//
						?>
						
						<?
						
						//Выводим 3 рекламный беанер
							if($count_b > 2){

								if($n == 12){
								?>
									<div class="medium marginrigth10 baner left">
                                        <?
                                        //Производим запись в БД по банеру
                                        CModule::IncludeModule('cradobaners');
                                        $banners = cCradoBaners::setCradoBanersView($baner_city[2]['ID']);
                                        ?>
                                        <?
											$file = CFile::ResizeImageGet($baner_city[2]['PREVIEW_PICTURE'], array('width'=>490, 'height'=>330),
											BX_RESIZE_IMAGE_EXACT);?>
										<?
											$width = '488px';
											$height = '328px';
										?>
										<a href="<?=$baner_city[2]['PROPERTY'][0]['link']['VALUE']?>" target="_blank" onclick="setClick(<?=$baner_city[2]['ID']?>);">
											<img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
										</a>
									</div>
								<?
								$k=2;
								}
							}
							//
						?>
                            <div class="small left">
                            
                                <?      
                    				$file = CFile::ResizeImageGet($mater[$n]['DETAIL_PICTURE'], array('width'=>240, 'height'=>160),
                    				BX_RESIZE_IMAGE_EXACT);?>
                                <?
                                    $width = '240px';
                                    $height = '160px';
                                ?>
                                <a href="/<?=$mater[$n]['PROPERTY'][0]['type']['VALUE_XML_ID']?>/<?=$mater[$n]['CODE']?>/">
                                    <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                </a>
                                 <?if($mater[$n]['PROPERTY'][0]['metka']['~VALUE']!=''):?>
                                     <div class="tag row">
                                            <?
                                                $link_tag = tags_link($mater[$n]['PROPERTY'][0]['metka']['~VALUE']);
                                            ?>
                                             <a href="<?=$link_tag?>" class="link_tag">
                                                <div class="name-tag"><?=tags($mater[$n]['PROPERTY'][0]['metka']['~VALUE'])?></div>
                                                <div class="trigon"></div>
                                             </a>
                                     </div>
                                 <?endif;?>
                                <div class="pad_10_15 name-item">
                                    <h3>
                                        <a href="/<?=$mater[$n]['PROPERTY'][0]['type']['VALUE_XML_ID']?>/<?=$mater[$n]['CODE']?>/"><?=$mater[$n]["NAME"];?></a>
                                    </h3>
                                    <?if($mater[$n]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
                                        <p class="date gray">
                                            <?=$date_to_from;?>
                                        </p>
                                    <?endif;?>
                                </div>
                                <div class="razdelitel">
                                    <div class="pad_16_15">
                                        <div class="row">
                                             <div class="geo geolocation">
                                                    <?if($mater[$n]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
                                                    	<?if($mater[$n]['PROPERTY'][0]['event_place']['~VALUE'] != ''):?>
																<? 
																	$event = event_place($mater[$n]['PROPERTY'][0]['event_place']['~VALUE']);
																?>
																<a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
																		<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																		<?=$event[0]['NAME'];?>
																</a>
															<?else:?>
																<p class="gray name-geo">
																	<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																	<?=$mater[$n]['PROPERTY'][0]['address']['VALUE'];?>
																</p>
															<?endif;?>
                                                  <?/*
                                                   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>
                                                        */?>
                                                     
                                                 <? else:?>  
                                                    <p class="gray name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$mater[$n]['PROPERTY'][0]['address']['VALUE'];?>
                                                    </p>
                                                 <?endif;?>
                                                </div>
                                            
                                            <?/*<div class="geo">
                                                <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                            </div>
                                            <?if($mater[$n]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
                                                <? 
                                                    $event = event_place($mater[$n]['PROPERTY'][0]['event_place']['~VALUE']);
                                                ?>
                                                 <p class="gray name-geo">
                                                    <?//if(strlen ($event[0]['NAME'])<=15):?>
                                                        <?=$event[0]['NAME'];?>
                                                    
                                                 </p>
                                                 
                                             <? else:?>  
                                                <p class="gray name-geo"><?=$mater[$n]['PROPERTY'][0]['address']['VALUE'];?></p>
                                             <?endif;?>
                                             */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
            

<?
		
						//Выводим 1 рекламный беанер
							if($count_b > 0){
								if($n == 1){
								?>
									<div class="medium baner left">
                                        <?
                                        //Производим запись в БД по банеру
                                        CModule::IncludeModule('cradobaners');
                                        $banners = cCradoBaners::setCradoBanersView($baner_city[0]['ID']);
                                        ?>
                                        <?
											$file = CFile::ResizeImageGet($baner_city[0]['PREVIEW_PICTURE'], array('width'=>490, 'height'=>330),
											BX_RESIZE_IMAGE_EXACT);?>
										<?
											$width = '488px';
											$height = '328px';
										?>
										<a href="<?=$baner_city[0]['PROPERTY'][0]['link']['VALUE']?>" target="_blank" onclick="setClick(<?=$baner_city[0]['ID']?>);">
											<img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
										</a>
									</div>
								<?
								$k=3;
								}
							}
							//
						?>            
            <? 
                }
            ?>
             
                </div>
             </div>
          </div>  
          <?if($page*$page_size <= $count_element-1):?>    
                <div class="text-center more">
                    <a href="?page=<?=$page+1?>" data-page="<?=$page+1?>" onclick="incity_next(event,this,<?=$page+1?>)"class="button">Показать ещё</a>
                    <img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">
                </div>
          <?endif;?>
    
    <script>
    
    </script>