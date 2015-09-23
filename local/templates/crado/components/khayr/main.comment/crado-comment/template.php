<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?IncludeTemplateLangFile(__FILE__);?>
<?//echo "<pre>";print_r($arParams);print_r($arResult);echo "</pre>";/*die();*/?>
<?
function KHAYR_MAIN_COMMENT_ShowTree($arItem, $arParams, $arResult)
{
	?>
	<div class="stock">
		<div class="userText">
			<?if ($arItem["AUTHOR"]["AVATAR"]) {?>
					<div class="img left">
                        <img src="<?=$arItem["AUTHOR"]["AVATAR"]["SRC"]?>" alt="<?=$arItem["AUTHOR"][$arParams["ASNAME"]]?>" />
                        
                        <div class="userInfo">
                            <?=$arItem["AUTHOR"][$arParams["ASNAME"]]?><br />
                            <?=$arItem["PUBLISH_DATE"]?>
                        </div>
                    </div>
				<?}?>
            <div class="left"   style="width: 535px;">
                <div class="text-comment">
    				<?=$arItem["PUBLISH_TEXT"]?>
    				<?
    				$additional = unserialize(htmlspecialcharsBack($arItem["PROPERTIES"]["ADDITIONAL"]["VALUE"]));
    				if (is_array($additional) && !empty($additional))
    				{
    					?><br /><?
    					$str = array();
    					foreach ($additional as $addit => $val)
    					{
    						if (!empty($addit) && !empty($val))
    							$str[] = $addit.": ".$val;
    					}
    					echo implode(" ", $str);
    				}
    				?>
                </div>
			<div class='action'>
				<?
				$answer = ((($arParams["NON_AUTHORIZED_USER_CAN_COMMENT"] == "Y") || $GLOBALS["USER"]->isAuthorized()) && ($arItem["PROPERTIES"]["DEPTH"]["VALUE"] < $arParams["MAX_DEPTH"]));
				$edit = ((($arParams["CAN_MODIFY"] == "Y") && ($arItem["PROPERTIES"]["USER"]["VALUE"] == $GLOBALS["USER"]->GetID()) && $GLOBALS["USER"]->isAuthorized()) || $GLOBALS["USER"]->isAdmin());
				$rating = ($arParams["ALLOW_RATING"] == "Y");
				?>
				<?if ($answer) {?>
					<a href="javascript:void();" onclick='KHAYR_MAIN_COMMENT_add(this, <?=$arItem["ID"]?>); return false;' title='<?=GetMessage("KHAYR_MAIN_COMMENT_COMMENT")?>'><?=GetMessage("KHAYR_MAIN_COMMENT_COMMENT")?></a>
				<?}?>
				<?if ($edit) {?>
					<?if ($answer) {?> | <?}?>
					<a href="javascript:void();" onclick='KHAYR_MAIN_COMMENT_edit(this, <?=$arItem["ID"]?>); return false;' title="<?=GetMessage("KHAYR_MAIN_COMMENT_EDIT")?>"><?=GetMessage("KHAYR_MAIN_COMMENT_EDIT")?></a>
				<?}?>
                <?if ((($arItem["PROPERTIES"]["USER"]["VALUE"] == $GLOBALS["USER"]->GetID()) && $GLOBALS["USER"]->isAuthorized()) || ($GLOBALS["USER"]->isAdmin())) {?>
			         <a href='javascript:void(0)' class='close' onclick='KHAYR_MAIN_COMMENT_delete(this, <?=$arItem["ID"]?>, "<?=GetMessage("KHAYR_MAIN_COMMENT_DEL_MESS")?>"); return false;' title='<?=GetMessage("KHAYR_MAIN_COMMENT_DELETE")?>'>Удалить</a>
		          <?}?>
				<?if ($rating) {?>
					<?if ($answer || $edit) {?> | <?}?>
					<?
					$arRatingParams = Array(
						"ENTITY_TYPE_ID" => "IBLOCK_ELEMENT",
						"ENTITY_ID" => $arItem["ID"],
						"OWNER_ID" => $arItem["PROPERTIES"]["USER"]["VALUE"],
						"PATH_TO_USER_PROFILE" => ""
					);
					if (!isset($arItem['RATING']))
						$arItem['RATING'] = Array(
							"USER_HAS_VOTED" => 'N',
							"TOTAL_VOTES" => 0,
							"TOTAL_POSITIVE_VOTES" => 0,
							"TOTAL_NEGATIVE_VOTES" => 0,
							"TOTAL_VALUE" => 0
						);
					$arRatingParams = array_merge($arRatingParams, $arItem['RATING']);
					$GLOBALS["APPLICATION"]->IncludeComponent(
						"bitrix:rating.vote",
						"standart",
						$arRatingParams,
						$component,
						Array("HIDE_ICONS" => "Y")
					);
					?>
				<?}?>
				<?if ($edit) {?>
					<div class="form comment form_for" id='edit_form_<?=$arItem["ID"]?>'<?=($arResult["POST"]["COM_ID"] == $arItem["ID"] ? " style='display: block;'" : "")?>>
						<form action="<?=$GLOBALS["APPLICATION"]->GetCurPage()?>" method='POST' onsubmit='return KHAYR_MAIN_COMMENT_validate(this);'>
							<p style='color: green; display: none;' class='suc'></p>
							<p style='color: red; display: none;' class='err'></p>
							<textarea name="MESSAGE" rows="10" placeholder='<?=GetMessage("KHAYR_MAIN_COMMENT_MESSAGE")?>'><?=$arItem["~PREVIEW_TEXT"]?></textarea>
							<input type='hidden' name='ACTION' value='update' />
							<input type='hidden' name='COM_ID' value='<?=$arItem["ID"]?>' />
							<input type="submit" class="button" value="<?=GetMessage("KHAYR_MAIN_COMMENT_SAVE")?>" />
							<a href="javascript:void(0)" onclick='KHAYR_MAIN_COMMENT_back(); return false;' class="cancel" style='margin-top: -25px; text-decoration: none;'><?=GetMessage("KHAYR_MAIN_COMMENT_BACK_BUTTON")?></a>
						</form>
					</div>
				<?}?>
				<?if ($answer) {?>
					<div class="form comment form_for" id='add_form_<?=$arItem["ID"]?>'<?=($arResult["POST"]["PARENT"] == $arItem["ID"] ? " style='display: block;'" : "")?>>
						<form action="<?=$GLOBALS["APPLICATION"]->GetCurPage()?>" method='POST' onsubmit='return KHAYR_MAIN_COMMENT_validate(this);'>
							<p style='color: green; display: none;' class='suc'></p>
							<p style='color: red; display: none;' class='err'></p>
							<input type="text" name='NONUSER' value='<?=($arResult["USER"][$arParams["ASNAME"]] ? $arResult["USER"][$arParams["ASNAME"]] : $arResult["POST"]["NONUSER"])?>' placeholder="<?=GetMessage("KHAYR_MAIN_COMMENT_FNAME")?>" class="w-45" />
							<input type="file" name='AVATAR' value='' placeholder="<?=GetMessage("KHAYR_MAIN_COMMENT_AVATAR")?>" class="w-45" />
							<?if ($arParams["REQUIRE_EMAIL"] == "Y") {?>
								<input type="text" name='EMAIL' value='<?=($arResult["USER"]["EMAIL"] ? $arResult["USER"]["EMAIL"] : $arResult["POST"]["EMAIL"])?>' placeholder="<?=GetMessage("KHAYR_MAIN_COMMENT_EMAIL")?>" class="w-45" />
							<?}?>
							<?foreach ($arParams["ADDITIONAL"] as $additional) {?>
								<?if (!empty($additional)) {?>
									<input type="text" name='<?=urlencode($additional)?>' value='<?=$arResult["POST"][$additional]?>' placeholder="<?=$additional?>" class="w-45" />
								<?}?>
							<?}?>
							<div class="clear pt10"></div>
							<textarea name="MESSAGE" rows="10" placeholder='<?=GetMessage("KHAYR_MAIN_COMMENT_MESSAGE")?>'></textarea>
							<input type='hidden' name='PARENT' value='<?=$arItem["ID"]?>' />
							<input type='hidden' name='ACTION' value='add' />
							<input type='hidden' name='DEPTH' value='<?=($arItem["PROPERTIES"]["DEPTH"]["VALUE"]+1)?>' />
							<?if (($arParams["USE_CAPTCHA"] == "Y") && !$GLOBALS["USER"]->isAuthorized()):?>
								<div>
									<div><?=GetMessage("KHAYR_MAIN_COMMENT_CAP_1")?></div>
									<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>" />
									<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA" />
									<div><?=GetMessage("KHAYR_MAIN_COMMENT_CAP_2")?></div>
									<input type="text" name="captcha_word" size="30" maxlength="50" value="" />
									<input type='hidden' name='clear_cache' value='Y' />
								</div>
							<?endif;?>
							<input type="submit" class="button" value="<?=GetMessage("KHAYR_MAIN_COMMENT_ADD")?>" />
							<a href="javascript:void(0)" onclick='KHAYR_MAIN_COMMENT_back(); return false;' class="cancel" style='margin-top: -25px; text-decoration: none;'><?=GetMessage("KHAYR_MAIN_COMMENT_BACK_BUTTON")?></a>
						</form>
					</div>
				<?}?>
			</div>
        </div>
		</div>
		<?if (!empty($arItem["CHILDS"])) {?>
			<?foreach ($arItem["CHILDS"] as $item) {?>
				<?=KHAYR_MAIN_COMMENT_ShowTree($item, $arParams, $arResult)?>
			<?}?>
		<?}?>
	</div>
    <?//echo "<pre>";print_r($arParams);/*print_r($arResult);*/echo "</pre>";/*die();*/?>
	<?
}
?>
<div class='khayr_main_comment' id='KHAYR_MAIN_COMMENT_container'>
	<?if (strlen($_POST["ACTION"]) > 0) $GLOBALS["APPLICATION"]->RestartBuffer();?>
	<?if ($arResult["ITEMS"]) {?>
		<?if ($arParams["DISPLAY_TOP_PAGER"]) {?>
			<div class="nav"><?=$arResult["NAV_STRING"]?></div>
		<?}?>
		<div class="comments-item">
			<?foreach ($arResult["ITEMS"] as $k => $arItem) {?>
				<?=KHAYR_MAIN_COMMENT_ShowTree($arItem, $arParams, $arResult)?>
			<?}?>
		</div>
		<?if ($arParams["DISPLAY_BOTTOM_PAGER"]) {?>
			<div class="nav"><?=$arResult["NAV_STRING"]?></div>
		<?}?>
	<?}?>
    <div class="form comment main_form"<?=($arResult["POST"]["PARENT"] > 0 ? " style='display: none;' " : "")?>>
		<?if (($arParams["NON_AUTHORIZED_USER_CAN_COMMENT"] == "Y") || $GLOBALS["USER"]->isAuthorized()) {?>
			<form enctype="multipart/form-data" action="<?=$GLOBALS["APPLICATION"]->GetCurPage()?>" method='POST' onsubmit='return KHAYR_MAIN_COMMENT_validate(this);'>
				<p style='color: green; display: none;' class='suc'><?=$arResult["SUCCESS"]?></p>
				<p style='color: red; display: none;' class='err'><?=$arResult["ERROR_MESSAGE"]?></p>
				<input type="text" name='NONUSER' style="display: none;" value='<?=($arResult["USER"][$arParams["ASNAME"]] ? $arResult["USER"][$arParams["ASNAME"]] : $arResult["POST"]["NONUSER"])?>' placeholder="<?=GetMessage("KHAYR_MAIN_COMMENT_FNAME")?>" class="w-45" />
				<?/*<input type="file" name='AVATAR' value='' placeholder="<?=GetMessage("KHAYR_MAIN_COMMENT_AVATAR")?>" class="w-45" />*/?>
				<?if ($arParams["REQUIRE_EMAIL"] == "Y") {?>
					<input type="text" name='EMAIL' value='<?=($arResult["USER"]["EMAIL"] ? $arResult["USER"]["EMAIL"] : $arResult["POST"]["EMAIL"])?>' placeholder="<?=GetMessage("KHAYR_MAIN_COMMENT_EMAIL")?>" class="w-45" />
				<?}?>
				<?foreach ($arParams["ADDITIONAL"] as $additional) {?>
					<?if (!empty($additional)) {?>
						<input type="text" name='<?=urlencode($additional)?>' value='<?=$arResult["POST"][$additional]?>' placeholder="<?=$additional?>" class="w-45" />
					<?}?>
				<?}?>
				<div class="clear pt10"></div>
				<textarea name="MESSAGE" rows="10" placeholder='<?=GetMessage("KHAYR_MAIN_COMMENT_MESSAGE")?>'><?=$arResult["POST"]["MESSAGE"]?></textarea>
				<input type='hidden' name='PARENT' value='' />
				<input type='hidden' name='ACTION' value='add' />
                <input type='hidden' name='OBJECT_ID' value='<?=$arParams['OBJECT_ID']?>' />
				<input type='hidden' name='DEPTH' value='1' />
				<?if (($arParams["USE_CAPTCHA"] == "Y") && !$GLOBALS["USER"]->isAuthorized()) {?>
					<div>
						<div><?=GetMessage("KHAYR_MAIN_COMMENT_CAP_1")?></div>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA" />
						<div><?=GetMessage("KHAYR_MAIN_COMMENT_CAP_2")?></div>
						<input type="text" name="captcha_word" size="30" maxlength="50" value="" />
						<input type='hidden' name='clear_cache' value='Y' />
					</div>
				<?}?>
				<input type="submit" class="button" value="<?=GetMessage("KHAYR_MAIN_COMMENT_ADD")?>" />
			</form>
		<?} else {?>
			<div style='background: #FFFFFF;'>
				<?=GetMessage("KHAYR_MAIN_COMMENT_DO_AUTH", array("#LINK#" => $arParams["AUTH_PATH"]))?>
			</div>
		<?}?>
	</div>
	<?if (strlen($_POST["ACTION"]) > 0) die();?>
</div>