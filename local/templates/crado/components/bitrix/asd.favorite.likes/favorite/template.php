<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>

<script type="text/javascript">
	var sCurPage = '<?= CUtil::JSescape($APPLICATION->GetCurPageParam('a', array('a', 'sessid', 'move', 'moveto', 'del')))?>&'+'<?= bitrix_sessid_get()?>';
	var sMessConfirmDel = '<?= CUtil::JSescape(GetMessage('ASD_TPL_FAV_DEL_CONF'))?>';
</script>

<?if (!empty($arResult['CURRENT_FOLDER'])):?>
<h3><?= $arResult['CURRENT_FOLDER']['NAME']?></h3>
<?endif;?>

<?if (!empty($arResult['FAVS'])):?>
	<?
	$moveOptions = '';
	foreach ($arResult['FOLDERS'] as $ID => $arFolder)
	{
		if ($arFolder['ID'] != $arParams['FOLDER_ID'])
			$moveOptions .= '<option value="'.$ID.'">'.$arFolder['NAME'].'</option>'."\n";
	}

	?>
	<?foreach ($arResult['FAVS'] as $ID => $arItem):?>
	<?if (empty($arItem)) continue;?>
	
    <div class="bwhite shadow favorit-person">
        <pre><?//print_r($arItem)?></pre>
        <?
            $arSelect = Array("*","PROPERTY_*");//IBLOCK_ID и ID обязательно должны быть указаны, см. описание arSelectFields выше
            $arFilter = Array("IBLOCK_ID"=>2, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y", "ID"=>$arItem['ID']);
            $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1000), $arSelect);
            while($ob = $res->GetNextElement()){ 
             $arFields = $ob->GetFields();
             /*echo '<pre>';  
                print_r($arFields);
             echo '</pre>';*/  
             $arProps = $ob->GetProperties();
             /*echo '<pre>';  
                print_r($arProps);
             echo '</pre>';*/
             
             $type = $arProps['type']['VALUE_XML_ID'];
             $code = $arFields['CODE'];
             $name =  $arFields['NAME'];
             $date_to = $arFields['ACTIVE_TO'];
             $date_from = $arFields['ACTIVE_FROM'];
             $event_place = $arProps['event_place']['~VALUE'];
             $address = $arProps['address']['VALUE'];
             $img_id = $arFields['DETAIL_PICTURE'];
             
             /*Изменяем размер изображения*/
             	$file = CFile::ResizeImageGet($img_id, array('width'=>240, 'height'=>160),
                        				BX_RESIZE_IMAGE_EXACT);
                $width = '240px';
                $height = '160px';
             /**/
                            
            }
        ?>
        <div class="fav-img">
            <a href="/<?=$type?>/<?=$code?>/">
                <img src="<?=$file['src']?>"/>
            </a>
        </div>
        <div class="fav-text">
            <div>
                 <a class="name" href="/<?=$type?>/<?=$code?>/">
                    <?=$name?>
                 </a>
            </div>
            <?if($type == 'events'):?>
                    <?
                        $date_to_from = date_to_from($date_from,$date_to);
                    ?>
                <p class="date gray">
                      <?=$date_to_from;?>
                </p>
            <?endif;?>
            <div class="geo-data row">
                <div class="geo geolocation">
                                                    <?if($type == 'events'):?>
                                                    <? 
                                                        $event = event_place($event_place);
                                                    ?>
                                                   <a  class="gray name-geo" href="/places/<?=$event[0]['CODE']?>/">
                                                            <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                            <?=$event[0]['NAME'];?>
                                                    </a>

                                                     
                                                 <? else:?>  
                                                    <p class="gray name-geo">
                                                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                                                    <?=$address;?>
                                                    </p>
                                                 <?endif;?>
                                                </div>
                <?/*<div class="geo left">
                    <svg class="icons w12"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#geo-icon"></use></svg>
                </div>
                <?if($type == 'events'):?>
                <? 
                   $event = event_place($event_place);
                ?>
                    <p class="left gray name-geo">
                        <?if(strlen ($event[0]['NAME'])<=15):?>
                            <?=$event[0]['NAME'];?>
                        <?else:?>
                            <?=substr($event[0]['NAME'],0,12).'...';?>
                        <?endif;?>
                    </p>
                                                         
                <? else:?>  
                    <p class="left gray name-geo"><?=$address;?></p>
                <?endif;?>
                */?>
            </div>
            <div class="del">
                <a href="#" class="asd_fav_delete" id="asd_fd_<?= $ID?>"><?= GetMessage('ASD_TPL_FAV_DEL')?></a>
            </div>
        </div>
    </div>
    
    
    <?/*<div class="asd_fav_item">
		<?if (strlen($arItem['PREVIEW_PICTURE_RESIZED']['src'])){?><a href="<?= $arItem['DETAIL_PAGE_URL']?>"><img src="<?= $arItem['PREVIEW_PICTURE_RESIZED']['src']?>" alt="" /></a><?}?>
		<a href="<?= $arItem['DETAIL_PAGE_URL']?>"><?= $arItem['NAME']?></a><br/>
		<?= $arItem['PREVIEW_TEXT']?>
		<div class="asd_clear"></div>
		<?if ($arResult['CAN_EDIT'] == 'Y'):?>
		<div class="asd_fav_menu">
			<?if ($arParams['ALLOW_MOVED'] == 'Y'):?>
			<a href="#" class="asd_fav_move" id="asd_fm_<?= $ID?>"><?= GetMessage('ASD_TPL_FAV_MOVE')?></a>
			<select id="asd_fs_<?= $ID?>">
				<option val="">...</option>
				<?= $moveOptions?>
			</select> |
			<?endif;?>
			<a href="#" class="asd_fav_delete" id="asd_fd_<?= $ID?>"><?= GetMessage('ASD_TPL_FAV_DEL')?></a>
		</div>
		<?endif;?>
	</div>*/?>
	<?endforeach;?>

	<?if (strlen($arResult['NAV_STRING']) > 0):?>
	<div class="asd_fav_pagen">
		<?= $arResult['NAV_STRING']?>
	</div>
	<?endif;?>

<?elseif ($arParams['FOLDER_ID'] > 0):?>
	<?= GetMessage('ASD_TPL_FAV_EMPTY')?>
<?else:?>
	<?= GetMessage('ASD_TPL_FAV_NOTHING')?>
<?endif;?>