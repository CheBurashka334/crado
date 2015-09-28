<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
   // echo 'Материал на главной отсортированный по дате с метками';
    
    $page = $_GET['page'];
    $baner = baners($page);
    $k = 0;
    
    
    $count_element = count_element(2);
    
    $count_baner = count($baner);
    
    
    /*
        $page_size_one - Для первой страици
        $page_size - Для всех остальных
    */

    if($count_baner == 3){ $page_size = 20; $two_big = 13; $page_size_one = 19;}
    elseif($count_baner == 2){ $page_size = 22; $two_big = 13; $page_size_one = 21;}
    elseif($count_baner == 1){ $page_size = 24; $two_big = 15; $page_size_one = 23;}
    else { $page_size = 26; $two_big = 17; $page_size_one = 25;}

    //if($page != 1) { $page_size ++;}
    
    
    /*
    bug с выводом следующей страницы после первой заключатся в следующем
    на 1 странице выводится на один элемент меньше чем на всех остальных из за блока метки
    в связи с этим массив $master формирует 2 страницу с элементами на 1 больше,
    но при этом пропуская 1 элемент из первой страница была сформирована так же на 1 элемент больше
    nPageSize - количество элементов
    iNumPage - номер страницы
     Array("nPageSize"=>$page_size,"iNumPage"=>$page)
    */
    
    //$mater = material($page_size,$page);
    $mater_page = material($page_size,$page);
    $mater = $_SESSION['HOME_ELEMENTS'];

    $count_mater = count($mater_page);
    
    $w_container = 0;
    $big_w = 0;
    
    
    $otstup = $page_size_one + ($page-2)*$page_size;
?>


    <!--count--><?=$count_mater;?><!--endcount--> 
    <div class="mat-list row page_<?=$page;?>">
            <?
             for($n=0; $n < $count_mater; $n++)
             {
                $item_num = $otstup+$n;
                /*Дата проведения*/
                $date_to_from = date_to_from($mater[$item_num]['PROPERTY'][0]['date_active_from']['~VALUE'],$mater[$item_num]['ACTIVE_TO']);
                ?>
                
                <?
                if($n == 0 || $n == $two_big)
                    { 
                        $big_w = 2;
                        $w_container += 500;
                        ?>
                            <div class="big left">
                                <?      
                        				$file = CFile::ResizeImageGet($mater[$item_num]['DETAIL_PICTURE'], array('width'=>490, 'height'=>500),
                        				BX_RESIZE_IMAGE_EXACT);?>
                                <?
                                    $width = '490px';
                                    $height = '500px';
                                ?>
                                <a href="/<?=$mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID']?>/<?=$mater[$item_num]['CODE']?>/">
                                    <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                </a>
                                <?if($mater[$item_num]['PROPERTY'][0]['metka']['~VALUE']!=''):?>
                                    <div class="tag row">
                                         <?
                                                $link_tag = tags_link($mater[$item_num]['PROPERTY'][0]['metka']['~VALUE']);
                                            ?>
                                             <a href="<?=$link_tag?>" class="link_tag">
                                                <div class="name-tag"><?=tags($mater[$item_num]['PROPERTY'][0]['metka']['~VALUE'])?></div>
                                                <div class="trigon"></div>
                                             </a>
                                    </div>
                                <?endif;?>
                                <div class="pad_10_15 name-item">
                                    <h3>
                                        <a href="/<?=$mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID']?>/<?=$mater[$item_num]['CODE']?>/"><?=$mater[$item_num]["NAME"];?></a>
                                    </h3>
                                    <?if($mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
                                        <p class="date gray">
                                            <?=$date_to_from;?>
                                        </p>
                                    <?endif;?>
                                </div>
                                <div class="razdelitel">
                                    <div class="pad_16_15">
                                        <div class="row">
                                            <div class="geo geolocation">
                                                    <?if($mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
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
                                                    <?=$mater[$item_num]['PROPERTY'][0]['address']['VALUE'];?>
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
                                <div class="small marginrigth10 left metka">Метки</div>
                            <?
                        }
                    } 
                    else
                    {
                        $w_container += 250;
                        ?>
                            <div class="small <?if($w_container <= 990){ ?>marginrigth10<?}else{$big_w--; if($big_w <= 0){$w_container = 0;}else{$w_container = 500;}}?> left">
                            
                                <?      
                    				$file = CFile::ResizeImageGet($mater[$item_num]['DETAIL_PICTURE'], array('width'=>240, 'height'=>160),
                    				BX_RESIZE_IMAGE_EXACT);?>
                                <?
                                    $width = '240px';
                                    $height = '160px';
                                ?>
                                <a href="/<?=$mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID']?>/<?=$mater[$item_num]['CODE']?>/">
                                    <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                </a>
                                <?if($mater[$item_num]['PROPERTY'][0]['metka']['~VALUE']!=''):?>
                                    <div class="tag row">
                                         <?
                                                $link_tag = tags_link($mater[$item_num]['PROPERTY'][0]['metka']['~VALUE']);
                                            ?>
                                             <a href="<?=$link_tag?>" class="link_tag">
                                                <div class="name-tag"><?=tags($mater[$item_num]['PROPERTY'][0]['metka']['~VALUE'])?></div>
                                                <div class="trigon"></div>
                                             </a>
                                    </div>
                                <?endif;?>
                                <div class="pad_10_15 name-item">
                                    <h3>
                                        <a href="/<?=$mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID']?>/<?=$mater[$item_num]['CODE']?>/"><?=$mater[$item_num]["NAME"];?></a>
                                    </h3>
                                    <?if($mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
                                        <p class="date gray">
                                            <?=$date_to_from;?>
                                        </p>
                                    <?endif;?>
                                </div>
                                <div class="razdelitel">
                                    <div class="pad_16_15">
                                        <div class="row">
                                            <div class="geo geolocation">
                                                    <?if($mater[$item_num]['PROPERTY'][0]['type']['VALUE_XML_ID'] == 'events'):?>
                                                    <? 
                                                        $event = event_place($mater[$item_num]['PROPERTY'][0]['event_place']['~VALUE']);
                                                    ?>
                                                   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>

                                                     
                                                 <? else:?>  
                                                    <p class="gray name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$mater[$item_num]['PROPERTY'][0]['address']['VALUE'];?>
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
                            else
                            {
                                  if($n == 4 || $n == 12 || $n == 19)
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
                                           <a href="<?=$baner[$k]['PROPERTY'][0]['link']['VALUE']?>" target="_blank"  onclick="setClick(<?=$baner[$k]['ID']?>);">
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
             <?
                  /*  echo "Первая страница ".$page_size_one;
                    echo '<br>';
                    echo "Остальные страницы ".$page_size;
                    echo '<br>';
                    echo "Всего страницы ".$count_element;
                    echo '<br>';
                    echo "Количество материалов ".$count_mater;
                    echo '<br>';
                    $e = $page_size_one+ $count_mater+($page-2)*$page_size ;
                    echo 'Сумма '.$e;*/
                ?>
                </div>
                
                 <?
                 if($page_size_one+ $count_mater+($page-2)*$page_size < $count_element-1):
                 //if($page_size_one+($page-1)*($page_size) <= $count_element-1):?>    
                    <div class="text-center more">
                        <a href="/?page=<?=$page+1?>" data-page="<?=$page+1?>" class="button" onclick="next_home(event,this,<?=$page+1?>)">Показать ещё</a>
                        <img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">
                    </div>
                <?endif;?>