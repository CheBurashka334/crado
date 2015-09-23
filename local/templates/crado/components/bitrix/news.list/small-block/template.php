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
	
    $date_to_from = date_to_from($arItem['ACTIVE_FROM'],$arItem['ACTIVE_TO']);
    
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
                                        <?
                                            $link_tag = tags_link($arItem['PROPERTIES']['metka']['~VALUE']);
                                         ?>
                                         <a href="<?=$link_tag?>" class="link_tag">
                                             <div class="tag row">
                                                <div class="name-tag"><?=tags($arItem['PROPERTIES']['metka']['~VALUE'])?></div>
                                                <div class="trigon"></div>
                                             </div>
                                          </a>
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
															<?endif;?>
                                                   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>

                                                     
                                                 <? else:?>  
                                                    <p class="gray name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$arItem['PROPERTIES']['address']['VALUE'];?>
                                                    </p>
                                                 <?endif;?>
                                                </div>
                                                <?/*<div class="geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                </div>
                                                <?if($arItem['PROPERTIES']['type']['VALUE_XML_ID'] == 'events'):?>
                                                    <? 
                                                        $event = event_place($arItem['PROPERTIES']['event_place']['~VALUE']);
                                                    ?>
                                                     <p class="gray name-geo">
                                                        <?//if(strlen ($event[0]['NAME'])<=15):?>
                                                            <?=$event[0]['NAME'];?>
                                                        
                                                     </p>
                                                     
                                                 <? else:?>  
                                                    <p class="gray name-geo"><?=$arItem['PROPERTIES']['address']['VALUE'];?></p>
                                                 <?endif;?>
                                                 */?>
                                            </div>
                                        </div>
                                    </div>
    </div>
    
    <?
    $n ++;
    /*
	<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						style="float:left"
						/></a>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					style="float:left"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>"><b><?echo $arItem["NAME"]?></b></a><br />
			<?else:?>
				<b><?echo $arItem["NAME"]?></b><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<?echo $arItem["PREVIEW_TEXT"];?>
		<?endif;?>
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?foreach($arItem["FIELDS"] as $code=>$value):?>
			<small>
			<?=GetMessage("IBLOCK_FIELD_".$code)?>:&nbsp;<?=$value;?>
			</small><br />
		<?endforeach;?>
		<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;?>
	</p>*/?>
<?endforeach;?>
    </div>
</div>
