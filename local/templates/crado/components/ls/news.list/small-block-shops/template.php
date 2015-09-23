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

<div class="small-list">
    <div class="row">
<?
    $n = 0;
    foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
    $date_to_from = date_to_from($arItem['PROPERTIES']['date_active_from']['~VALUE'],$arItem['ACTIVE_TO']);
    
    ?>
        <?if($n == 4):?></div><div class="row"><?$n = 0; endif;?>
            <div class="small left">
                                    
                                    <?    
                                    
                                    CModule::IncludeModule("iblock");
                                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
                                    $arFilter = Array("IBLOCK_ID"=>2, "ID"=>$arItem['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);

                                    while($ob = $res->GetNextElement())
                                    {
                                         $arFields = $ob->GetFields();
                                         $detail_img = $arFields;
                                         
                                         //array_push($result ,$arProps);
                                         /*формирование url*/
                                    }  
                        				$file = CFile::ResizeImageGet($detail_img['DETAIL_PICTURE'], array('width'=>240, 'height'=>160),
                        				BX_RESIZE_IMAGE_EXACT);?>
                                    
                                    <?
                                        $width = '240px';
                                        $height = '160px';
                                    ?>
                                    <a href="/<?=$arItem['PROPERTIES']['type']['VALUE_XML_ID']?>/<?=$arItem['CODE']?>/">
                                        <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                    </a>
                                     <?if($arItem['PROPERTIES']['metka']['~VALUE']!=''):?>
                                         <div class="tag row">
                                            <?
                                                $link_tag = tags_link($arItem['PROPERTIES']['metka']['~VALUE']);
                                            ?>
                                             <a href="<?=$link_tag?>" class="link_tag">
                                                <div class="name-tag"><?=tags($arItem['PROPERTIES']['metka']['~VALUE'])?></div>
                                                <div class="trigon"></div>
                                             </a>
                                         </div>
                                     <?endif;?>
                                    <div class="pad_10_15 name-item">
                                        <h3>
                                            <a href="/<?=$arItem['PROPERTIES']['type']['VALUE_XML_ID']?>/<?=$arItem['CODE']?>/"><?=$arItem["NAME"];?></a>
                                        </h3>
                                        <?if($arItem['PROPERTIES']['type']['VALUE_XML_ID'] == 'events'):?>
                                            <p class="date gray">
                                                <?=$date_to_from;?>
                                            </p>
                                        <?endif;?>
                                    </div>
                                    <div class="razdelitel">
                                        <div class="pad_16_15">
                                            <div class="row">
                                                 <div class="geo geolocation">
                                                    <?if($arItem['PROPERTIES']['type']['VALUE_XML_ID'] == 'events'):?>
                                                    	<?if($arItem['PROPERTY']['event_place']['~VALUE'] != ''):?>
																<? 
																	$event = event_place($arItem['PROPERTY']['event_place']['~VALUE']);
																?>
																<a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
																		<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																		<?=$event[0]['NAME'];?>
																</a>
																<?else:?>
																<p class="gray name-geo">
																	<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																	<?=$arItem['PROPERTIES']['address']['VALUE'];?>
																</p>
														<?endif;?>
                                                   <?/*
                                                   <a  class="gray name-geo" href="/events/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>
                                                    */?>
                                                     
                                                 <? else:?>  
                                                    <p class="gray name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$arItem['PROPERTIES']['address']['VALUE'];?>
                                                    </p>
                                                 <?endif;?>
                                                </div>
                                                <?/*<div class="geo left">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                </div>
                                                <?if($arItem['PROPERTIES']['type']['VALUE_XML_ID'] == 'events'):?>
                                                    <? 
                                                        $event = event_place($arItem['PROPERTIES']['event_place']['~VALUE']);
                                                    ?>
                                                     <p class="left gray name-geo">
                                                        <?if(strlen ($event[0]['NAME'])<=15):?>
                                                            <?=$event[0]['NAME'];?>
                                                        <?else:?>
                                                            <?=substr($event[0]['NAME'],0,12).'...';?>
                                                        <?endif;?>
                                                     </p>
                                                     
                                                 <? else:?>  
                                                    <p class="left gray name-geo"><?=$arItem['PROPERTIES']['address']['VALUE'];?></p>
                                                 <?endif;?>
                                                 */?>
                                            </div>
                                        </div>
                                    </div>
    </div>
    
    <?
        $n ++;
    ?>
<?endforeach;?>
    </div>
</div>
<?/*<pre>
    <?print_r($arResult['NAV_RESULT']);?>
</pre>*/?>
<?if($arResult['NAV_RESULT']->NavPageNomer < $arResult['NAV_RESULT']->NavPageCount):?>  
                <div class="text-center more" id="pagen">
                <?$navNum = $arResult['NAV_RESULT']->NavNum;?>
                <?
                    if($_GET['PAGEN_'.$navNum]) {$num = $_GET['PAGEN_'.$navNum]+1;}
                    else {$num = 2;}
                ?>
                    <a href="?PAGEN_<?=$navNum?>=<?=$num?>" data-page="2" onclick="next_page_shops(event,this,'<?=$num?>')" class="button">Показать ещё</a>
                    <img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">
                </div>
<?endif;?>
<?/*<input type="hidden" class="count_page" value="<?=$arResult['NAV_RESULT']->NavPageCount;?>"/>
<input type="hidden" class="nomer_page" value="<?=$arResult['NAV_RESULT']->NavPageNomer;?>"/>*/?>