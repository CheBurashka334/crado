<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<ul class="menu-modal">

<?
foreach($arResult as $arItem):
	if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
		continue;
?>
	<?if($arItem["SELECTED"]):?>
		<li <?/*if($arItem["LINK"] == '/?logout=yes'):?>class="red"<?endif;*/?>><a href="<?=$arItem["LINK"]?>"  rel="nofollow" class="selected"><?=$arItem["TEXT"]?></a></li>
	<?else:?>
		<li <?/*if($arItem["LINK"] == '/?logout=yes'):?>class="red"<?endif;*/?>><a href="<?=$arItem["LINK"]?>"  rel="nofollow" class=""><?=$arItem["TEXT"]?></a></li>
	<?endif?>
	
<?endforeach?>

</ul>
<?endif?>