<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
   // echo 'Материал на главной отсортированный по дате с метками';
    
    $page = 1;
    $baner = baners($page);
    $k = 0;
    
    /*Переменная для главной страницы*/
    $_SESSION['HOME_ELEMENTS'] = array();
    
    $count_baner = count($baner);
    
    /*if($count_baner == 3){ $page_size = 19; $two_big = 13;}
    elseif($count_baner == 2){ $page_size = 21; $two_big = 13;}
    elseif($count_baner == 1){ $page_size = 23; $two_big = 15;}
    else { $page_size = 25; $two_big = 17;}*/
    
    if($count_baner == 3){ $page_size = 20; $two_big = 13;}
    elseif($count_baner == 2){ $page_size = 22; $two_big = 13;}
    elseif($count_baner == 1){ $page_size = 24; $two_big = 15;}
    else { $page_size = 26; $two_big = 17;}
    
    if($page != 1) { $page_size ++;}
    
    $count_element = count_element(2);
    
    //$all_mater = array();
    
    //$mater = material($page_size,$page);
    
    $mater_page =  material($page_size,$page);
    $mater = $_SESSION['HOME_ELEMENTS'];
    
    $count_mater = count($mater_page);
    
    $count_element_ajax = 0;
    $count_element_ajax += $count_mater;
    
    /*echo $count_element;
    echo $count_element_ajax;*/
    
    $w_container = 0;
    $big_w = 0;
    
    ?>

     <div class="data_home" id="data-home">
                <div class="mat-list row">
            <?
             for($n=0; $n < ($page_size-1); $n++)
             {
                /*Дата проведения*/
                $date_to_from = date_to_from($mater[$n]['PROPERTY'][0]['date_active_from']['~VALUE'],$mater[$n]['ACTIVE_TO']);
                
                if($n == 0 || $n == $two_big)
                    { 
                        $big_w = 2;
                        $w_container += 500;
                        ?>
                            <div class="big left">
                                <?      
                        				$file = CFile::ResizeImageGet($mater[$n]['DETAIL_PICTURE'], array('width'=>490, 'height'=>500),
                        				BX_RESIZE_IMAGE_EXACT);?>
                                <?
                                    $width = '490px';
                                    $height = '500px';
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
                        if($n == $two_big && $page == 1)
                        {
                            $w_container += 250;
                            ?>
                                <div class="small marginrigth10 left metka">
                                    <div class="zag-metka">
                                        Популярные метки
                                    </div>
                                    <div class="tags">
                                        <?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
                                            "AREA_FILE_SHOW" => "file", 
                                            /*"AREA_FILE_SUFFIX" => "inc", 
                                            "AREA_FILE_RECURSIVE" => "Y", */
                                            "PATH" => "/include/tags-list.php" 
                                        )
                                    );?>
                                    </div>
                                
                                </div>
                            <?
                        }
                    } 
                    else
                    {
                        $w_container += 250;
                        ?>
                            <div class="small <?if($w_container <= 990){ ?>marginrigth10<?}else{$big_w--; if($big_w <= 0){$w_container = 0;}else{$w_container = 500;}}?> left">
                            
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
                                                    <?if($mater[$n]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events')
													{?>
                                                    	<?if($mater[$n]['PROPERTY'][0]['event_place']['~VALUE'] != ''){?>
															<? 
																$event = event_place($mater[$n]['PROPERTY'][0]['event_place']['~VALUE']);
															?>
															<a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
																	<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																	<?=$event[0]['NAME'];?>
															</a>
														<?}
														else{?>
														<p class="gray name-geo">
															<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
															<?=$mater[$n]['PROPERTY'][0]['address']['VALUE'];?>
														</p><?}
														?>
                                                   <?/*
												   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>
													*/?>
                                                     
													<? }else{?>  
                                                    <p class="gray name-geo">
														<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
														<?=$mater[$n]['PROPERTY'][0]['address']['VALUE'];?>
                                                    </p>
													<?}?>
                                            </div>
                                            <?/*<div class="geo">
                                               <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                            </div>
                                            <?if($mater[$n]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
                                                <? 
                                                    $event = event_place($mater[$n]['PROPERTY'][0]['event_place']['~VALUE']);
                                                ?>
                                                 <p class="gray name-geo">
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
                          if($count_baner == 3){ 
                            if($page == 1){
                                if($n == 4 || $n == 12 || $n == 18)
                                {
                                    $w_container += 500; 
                                    
                                    ?>
                                        <div class="medium baner <?if($w_container <= 990){?>marginrigth10<?}else{$w_container = 0;}?>  left">
                                            <?
                                            //Производим запись в БД по банеру
                                            CModule::IncludeModule('cradobaners');
                                            $banners = cCradoBaners::setCradoBanersView($baner[$k]['ID']);
                                            ?>
                                            <?
                                                $file = CFile::ResizeImageGet($baner[$k]['PREVIEW_PICTURE'], array('width'=>490, 'height'=>330),
                                                BX_RESIZE_IMAGE_EXACT);?>
                                            <?
                                                    $width = '488px';
                                                    $height = '328px';
                                            ?>
                                           <a href="<?=$baner[$k]['PROPERTY'][0]['link']['VALUE']?>" target="_blank" onclick="setClick(<?=$baner[$k]['ID']?>);">
                                                <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                           </a>
                                           <?
                                            $k++;
                                           ?>
                                        </div>
                                    <?
                                }
                            }
                            else
                            {
                                  if($n == 4 || $n == 12 || $n == 19)
                                {
                                    $w_container += 500; 
                                    
                                    ?>
                                        <div class="medium baner <?if($w_container <= 990){?>marginrigth10<?}else{$w_container = 0;}?>  left">
                                        <?      
                            				$file = CFile::ResizeImageGet($baner[$k]['PREVIEW_PICTURE'], array('width'=>490, 'height'=>330),
                            				BX_RESIZE_IMAGE_EXACT);?>
                                        <?
                                                $width = '490px';
                                                $height = '330px';
                                        ?>
                                           <a href="<?=$baner[$k]['PROPERTY'][0]['link']['VALUE']?>" target="_blank">
                                                <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                           </a>
                                           <?
                                            $k++;
                                           ?>
                                        </div>
                                    <?
                                }  
                            }
                        }
                        elseif($count_baner == 2){
                           if($n == 4 || $n == 12)
                            {
                                $w_container += 500; 
                                
                                ?>
                                    <div class="medium baner <?if($w_container <= 990){?>marginrigth10<?}else{$w_container = 0;}?>  left">
                                        <?
                                        //Производим запись в БД по банеру
                                        CModule::IncludeModule('cradobaners');
                                        $banners = cCradoBaners::setCradoBanersView($baner[$k]['ID']);
                                        ?>
                                        <?
                                            $file = CFile::ResizeImageGet($baner[$k]['PREVIEW_PICTURE'], array('width'=>490, 'height'=>330),
                                            BX_RESIZE_IMAGE_EXACT);?>
                                        <?
                                            $width = '490px';
                                            $height = '330px';
                                        ?>
                                       <a href="<?=$baner[$k]['PROPERTY'][0]['link']['VALUE']?>" target="_blank" onclick="setClick(<?=$baner[$k]['ID']?>);">
                                            <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                       </a>
                                       <?
                                        $k++;
                                       ?>
                                    </div>
                                <?
                            } 
                        }
                        elseif($count_baner == 1){
                           if($n == 4)
                            {
                                $w_container += 500; 
                                
                                ?>
                                    <div class="medium baner <?if($w_container <= 990){?>marginrigth10<?}else{$w_container = 0;}?>  left">
                                        <?
                                        //Производим запись в БД по банеру
                                        CModule::IncludeModule('cradobaners');
                                        $banners = cCradoBaners::setCradoBanersView($baner[$k]['ID']);
                                        ?>
                                        <?
                                            $file = CFile::ResizeImageGet($baner[$k]['PREVIEW_PICTURE'], array('width'=>490, 'height'=>330),
                                            BX_RESIZE_IMAGE_EXACT);?>
                                        <?
                                            $width = '490px';
                                            $height = '330px';
                                        ?>
                                       <a href="<?=$baner[$k]['PROPERTY'][0]['link']['VALUE']?>" target="_blank" onclick="setClick(<?=$baner[$k]['ID']?>);">
                                            <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                       </a>
                                       <?
                                        $k++;
                                       ?>
                                    </div>
                                <?
                            } 
                        }
                    }
             }
             ?>
                </div>
          </div>  
          <?if($count_element_ajax < $count_element):?>    
                <div class="text-center more">
                    <a href="/?page=2" data-page="2" class="button" onclick="next_home(event,this,<?=$page+1?>)">Показать ещё</a>
                    <img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">
                </div>
          <?endif;?>
    
    <script>
    /*$(document).ready(function(){
        $('.more a.button').click(function(e){
            var data_page = parseInt($(this).attr('data-page')) + 1;
            var pageurl = '/include/nextpage.php?page='+$(this).attr('data-page');
            var button = $(this);
            var preloader = $(this).next();
            button.css('display','none');
            preloader.css('display','inline-block');
            e.stopPropagation();
            e.preventDefault();
            
            $.ajax({
               url: pageurl,
               success: function(data) {
                    
                    var data_n = data.split('<!--endcount-->');
                    var data_count = data_n[0].split('<!--count-->');
                    var count_element = <?=$count_element?>;
                    var count_element_ajax = <?=$count_element_ajax?> + parseInt(data_count[1]);
                    if(count_element_ajax >= count_element)
                    {
                        button.parent().remove();
                    }
                    else
                    {  //display: initial;
                        preloader.css('display','none');
                        button.css('display','inline-block');
                        button.attr('data-page',data_page);
                        button.attr('href','/?page='+data_page);    
                    }
                    $(data_n[1]).appendTo('#data-home');
               }
            });
        });
    })*/
    </script>