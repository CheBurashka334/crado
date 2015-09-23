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
<?if(count($arResult["ITEMS"])>0):?>
<div class="bgray">
    <div class="container">
        <h2>–екомендуем посетить</h2>
        <div>
		<?
			$pw = 0;
			$ph = 0;
		?>
            <div class="ad-list row">
            <?foreach($arResult["ITEMS"] as $arItem):?>
            	<?
            	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            	?>
                <?
                   /*echo '<pre>';
                    print_r($arItem);
                    echo '</pre>';*/
                ?>
                <?
                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","*");
                    $arFilter = Array("IBLOCK_ID"=>$arItem["PROPERTIES"]['content']['LINK_IBLOCK_ID'], "ID"=>$arItem["PROPERTIES"]['content']['VALUE'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                    while($ob = $res->GetNextElement())
                    {
                     $arFields = $ob->GetFields();
                         /*echo '<pre>';
                         print_r($arFields);
                         echo '</pre>';*/
                     
                     $name = $arFields['NAME'];
                     $prew_img = CFile::GetFileArray($arFields["DETAIL_PICTURE"]);
                        
                     $arProps = $ob->GetProperties();
                     
                     /*формирование url*/
                     $url_el_code = $arFields['CODE'];
                     $url_type = $arProps['type']['VALUE_XML_ID'];
                     
                     $id = $arProps['event_place']['~VALUE'];
                     $address = $arProps['address']['VALUE'];
                        /*echo '<pre>';
                        print_r($arProps);
                        echo '</pre>';*/
                    }
                ?>
				<?//если изображение к рекомендуем посетить НЕ прикреплено?>
				<?if($arItem['~PREVIEW_PICTURE'] == ''):?>
					<?if($arItem['PROPERTIES']['size']['VALUE_XML_ID'] == 'big'):?>
						<?      
								$file = CFile::ResizeImageGet($prew_img, array('width'=>490, 'height'=>480),
								BX_RESIZE_IMAGE_EXACT);?>
						<?
							$width = '490px';
							$height = '480px';
							$pw += 2;
							$ph += 1;
						?>
					<?elseif($arItem['PROPERTIES']['size']['VALUE_XML_ID'] == 'medium'):?>
						<?
								$file = CFile::ResizeImageGet($prew_img, array('width'=>490, 'height'=>230),
								BX_RESIZE_IMAGE_EXACT);?>
						<?
							$width = '490px';
							$height = '230px';
							$pw += 2;
							$ph += 0.5;
						?>
					<?else:?>
						<?
								$file = CFile::ResizeImageGet($prew_img, array('width'=>240, 'height'=>240),
								BX_RESIZE_IMAGE_EXACT);?>
						<?
							$width = '240px';
							$height = '240px';
							$pw += 1;
							$ph += 0.5;
						?>
					<?endif?>
				<?else:?>
				<?//если изображение к рекомендуем посетить прикреплено?>
					<?if($arItem['PROPERTIES']['size']['VALUE_XML_ID'] == 'big'):?>
							<?      
									$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>490, 'height'=>480),
									BX_RESIZE_IMAGE_EXACT);?>
							<?
								$width = '490px';
								$height = '480px';
								$pw += 2;
								$ph += 1;
							?>
						<?elseif($arItem['PROPERTIES']['size']['VALUE_XML_ID'] == 'medium'):?>
							<?
									$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>490, 'height'=>230),
									BX_RESIZE_IMAGE_EXACT);?>
							<?
								$width = '490px';
								$height = '230px';
								$pw += 2;
								$ph += 0.5;
							?>
						<?else:?>
							<?
									$file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>240, 'height'=>240),
									BX_RESIZE_IMAGE_EXACT);?>
							<?
								$width = '240px';
								$height = '240px';
								$pw += 1;
								$ph += 0.5;
							?>
						<?endif?>
				<?endif;?>
                
                <div class="element <?=$arItem['PROPERTIES']['size']['VALUE_XML_ID']?> left"
					<?
					//ќтступ справа от элемента 
						if($pw == 2 && $ph >= 2):
							$pw = 0; 
							$ph = 0;
						elseif($pw == 4):
							$pw = 0;
						else:?>
							style = "margin-right:10px"
						<?
						endif; ?>
						>
                    <a href="/<?=$url_type?>/<?=$url_el_code?>/">
                        <img src="<?=$file['src'];?>" width="<?=$width?>" height="<?=$height?>"/>
                        <div class="gradient-shadow">
                            
                        </div>
                        <div class="name-cont white">
                            <h3 class="white"><?=$name?></h3>
                            <div class="location">
                                <div class="geo">
                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                </div>
                                <?if($url_type == 'events'):?>
                                    <? 
                                       // $event = event_place($id);
                                    ?>
									
                                    <p class="name-geo">
                                    <?//if(strlen ($event[0]['NAME'])<=15):?>
                                        <?//=$event[0]['NAME'];?>
										<?=$address?>
                                    <?/*else:?>
                                        <?=substr($event[0]['NAME'],0,12).'...';?>
                                    <?endif;*/?>
                                   </p>
                                                                 
                                <? else:?>  
                                    <p class="name-geo"><?=$address?></p>
                                <?endif;?>
                                
                            </div>
                        </div>
                        <?/*<pre>
                            print_r($arItem);
                        </pre>*/?>
                    </a>
                </div>
            	<?/*<p class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
    </div>
</div>

<?endif;?>