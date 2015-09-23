<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>

<div class="small-list">
    <div class="row">
			<?
				$k = -1;
			?>
        	<?foreach($arResult["SEARCH"] as $arItem):?>
        		<?
                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
					$arFilter = Array("IBLOCK_ID"=>2,"ID"=>$arItem['ITEM_ID'],"ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
					$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
					$result = array();
					//$result['property'] = array();
					while($ob = $res->GetNextElement())
					{
						 $arFields = $ob->GetFields();
						 $arProps = $ob->GetProperties();
					}
                /*?>
                <pre>
                    <?print_r($arFields);?>
                </pre>
                <pre>
                    <?print_r($arProps);?>
                </pre>
				<?*/
				
				$k++;
                /*Дата проведения*/
                $date_to_from = date_to_from($arProps['date_active_from']['~VALUE'],$arFields['ACTIVE_TO']);
                
                        ?> <?if($k == 4):?></div><div class="row"><?$k=0; endif;?>
                            <div class="small left">
                            
                                <?      
                    				$file = CFile::ResizeImageGet($arFields['DETAIL_PICTURE'], array('width'=>240, 'height'=>160),
                    				BX_RESIZE_IMAGE_EXACT);?>
                                <?
                                    $width = '240px';
                                    $height = '160px';
                                ?>
                                <a href="/<?=$arProps['type']['VALUE_XML_ID']?>/<?=$arFields['CODE']?>/">
                                    <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                                </a>
                                 <?if($arProps['metka']['~VALUE']!=''):?>
                                     <div class="tag row">
                                         <?
                                            $link_tag = tags_link($arProps['metka']['~VALUE']);
                                         ?>
                                         <a href="<?=$link_tag?>" class="link_tag">
                                            <div class="name-tag"><?=tags($arProps['metka']['~VALUE'])?></div>
                                            <div class="trigon"></div>
                                         </a>
                                         </div>
                                 <?endif;?>
                                <div class="pad_10_15 name-item">
                                    <h3>
                                        <a href="/<?=$arProps['type']['VALUE_XML_ID']?>/<?=$arFields['CODE']?>/"><?=$arFields["NAME"];?></a>
                                    </h3>
                                    <?if($arProps['type']['VALUE_XML_ID'] == 'events'):?>
                                        <p class="date gray">
                                            <?=$date_to_from;?>
                                        </p>
                                    <?endif;?>
                                </div>
                                <div class="razdelitel">
                                    <div class="pad_16_15">
                                        <div class="row">
                                            <div class="geo geolocation">
                                                    <?if($arProps['type']['VALUE_XML_ID'] == 'events'):?>
														<?if($arProps['event_place']['~VALUE'] != ''):?>
															<? 
																$event = event_place($arProps['event_place']['~VALUE']);
															?>
															<a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
																	<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																	<?=$event[0]['NAME'];?>
															</a>
															<?else:?>
																<p class="gray name-geo">
																	<svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
																	<?=$arProps['address']['VALUE'];?>
																</p>
														<?endif;?>
                                                   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>

                                                     
                                                 <? else:?>  
                                                    <p class="gray name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$arProps['address']['VALUE'];?>
                                                    </p>
                                                 <?endif;?>
                                                </div>
                                            <?/*<div class="geo left">
                                                <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                            </div>
											<?//echo $arProps['type']['VALUE_XML_ID'];?>
                                            <?if($arProps['type']['VALUE_XML_ID'] == 'events'):?>
                                                <? 
                                                    $event = event_place($arProps['event_place']['~VALUE']);
                                                ?>
                                                 <p class="left gray name-geo">
                                                    <?if(strlen ($event[0]['NAME'])<=15):?>
                                                        <?=$event[0]['NAME'];?>
                                                    <?else:?>
                                                        <?=substr($event[0]['NAME'],0,12).'...';?>
                                                    <?endif;?>
                                                 </p>
                                                 
                                             <? else:?>  
                                                <p class="left gray name-geo"><?=$arProps['address']['VALUE'];?></p>
                                             <?endif;?>
                                             */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                <?/*<a href="<?echo $arItem["URL"]?>"><?echo $arItem["TITLE_FORMATED"]?></a>
        		<p><?echo $arItem["BODY_FORMATED"]?></p>
        		<?if (
        			$arParams["SHOW_RATING"] == "Y"
        			&& strlen($arItem["RATING_TYPE_ID"]) > 0
        			&& $arItem["RATING_ENTITY_ID"] > 0
        		):?>
        			<div class="search-item-rate"><?
        				$APPLICATION->IncludeComponent(
        					"bitrix:rating.vote", $arParams["RATING_TYPE"],
        					Array(
        						"ENTITY_TYPE_ID" => $arItem["RATING_TYPE_ID"],
        						"ENTITY_ID" => $arItem["RATING_ENTITY_ID"],
        						"OWNER_ID" => $arItem["USER_ID"],
        						"USER_VOTE" => $arItem["RATING_USER_VOTE_VALUE"],
        						"USER_HAS_VOTED" => $arItem["RATING_USER_VOTE_VALUE"] == 0? 'N': 'Y',
        		 				"TOTAL_VOTES" => $arItem["RATING_TOTAL_VOTES"],
        						"TOTAL_POSITIVE_VOTES" => $arItem["RATING_TOTAL_POSITIVE_VOTES"],
        						"TOTAL_NEGATIVE_VOTES" => $arItem["RATING_TOTAL_NEGATIVE_VOTES"],
        						"TOTAL_VALUE" => $arItem["RATING_TOTAL_VALUE"],
        						"PATH_TO_USER_PROFILE" => $arParams["~PATH_TO_USER_PROFILE"],
        					),
        					$component,
        					array("HIDE_ICONS" => "Y")
        				);?>
        			</div>
        		<?endif;?>
        		<small><?=GetMessage("SEARCH_MODIFIED")?> <?=$arItem["DATE_CHANGE"]?></small><br /><?
        		if($arItem["CHAIN_PATH"]):?>
        			<small><?=GetMessage("SEARCH_PATH")?>&nbsp;<?=$arItem["CHAIN_PATH"]?></small><?
        		endif;
        		?><hr />
                */?>
        	<?endforeach;?>
		</div>
             </div>
            <?if($arResult['NAV_RESULT']->NavPageNomer < $arResult['NAV_RESULT']->NavPageCount):?> 
                <div class="text-center more">
                    <a href="?page=<?=$arResult['NAV_RESULT']->NavPageNomer+1?>" data-page="<?=$arResult['NAV_RESULT']->NavPageNomer+1?>" onclick="search_next(event,this,'<?=$_GET["q"]?>','<?=$arResult['NAV_RESULT']->NavPageNomer+1?>')" class="button">Показать ещё</a>
                    <img class="preloader" src="/images/tail-spin.svg" style="display: none;" width="50" alt="">
                </div>
            <?endif;?>
          