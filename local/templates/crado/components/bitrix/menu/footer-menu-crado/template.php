<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="footer-menu-crado">
    <div class="left col-6">
        <?
        $i = 1;
        foreach($arResult as $arItem):
        	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
        		continue;
        ?>
        <?if($i == 4):?>
        </div><div class="left col-6">
        <?endif;?>
        	<?if($arItem["SELECTED"]):?>
        		<div class="item"><a href="<?=$arItem["LINK"]?>" class="selected"><?=$arItem["TEXT"]?></a></div>
        	<?else:?>
        		<div  class="item"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></div>
        	<?endif?>
        	<?$i++;?>
        <?endforeach?>
    </div>
</div>
<?endif?>