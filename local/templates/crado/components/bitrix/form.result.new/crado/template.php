<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<?if ($arResult["isFormErrors"] == "Y"):?><?//=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

<div class="text-center">
    <h2><?=$arResult["FORM_NOTE"]?></h2>
</div>


<?if ($arResult["isFormNote"] != "Y")
{
?>
<?=$arResult["FORM_HEADER"]?>

<table>
<?
if ($arResult["isFormDescription"] == "Y" || $arResult["isFormTitle"] == "Y" || $arResult["isFormImage"] == "Y")
{
?>
	<tr>
		<td><?
/***********************************************************************************
					form header
***********************************************************************************/
if ($arResult["isFormTitle"])
{
/*?>
	<h3><?=$arResult["FORM_TITLE"]?></h3>
<?*/
} //endif ;

	if ($arResult["isFormImage"] == "Y")
	{
	?>
	<a href="<?=$arResult["FORM_IMAGE"]["URL"]?>" target="_blank" alt="<?=GetMessage("FORM_ENLARGE")?>"><img src="<?=$arResult["FORM_IMAGE"]["URL"]?>" <?if($arResult["FORM_IMAGE"]["WIDTH"] > 300):?>width="300"<?elseif($arResult["FORM_IMAGE"]["HEIGHT"] > 200):?>height="200"<?else:?><?=$arResult["FORM_IMAGE"]["ATTR"]?><?endif;?> hspace="3" vscape="3" border="0" /></a>
	<?//=$arResult["FORM_IMAGE"]["HTML_CODE"]?>
	<?
	} //endif
	?>

			<p><?=$arResult["FORM_DESCRIPTION"]?></p>
		</td>
	</tr>
	<?
} // endif
	?>
</table>
<br />
<?
/***********************************************************************************
						form questions
***********************************************************************************/
?>
<div>
    <?
	foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
	{
		if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
		{
			echo $arQuestion["HTML_CODE"];
		}
		else
		{
	?>
		<div class="item_input <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>error_row<?endif?>">
            <label>
				<?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				    <span class="error-fld" title="<?=$arResult["FORM_ERRORS"][$FIELD_SID]?>"></span>
				<?endif;?>
				<?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?>
                    *
                <?endif;?>
				<?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
			</label>
			<?/*select*/?>
			<?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'dropdown'){?>
			<select class="inputselect" name="form_dropdown_type" id="form_dropdown_type">
				<?foreach($arQuestion['STRUCTURE'] as $arQ_item):?>
				<option value="<?=$arQ_item['ID']?>"><?=$arQ_item['MESSAGE']?></option>
				<?endforeach;?>
			</select>
			<?
			}
			else
			{
				//text textarea date
				?>
				<?/*<pre>
					<?print_r($arQuestion)?>
				</pre>*/?>
				<?foreach($arQuestion['STRUCTURE'] as $arQ_item):?>
					<?if($arQ_item['FIELD_TYPE'] == 'text'):?>
						<input type="text" name="form_text_<?=$arQ_item['QUESTION_ID']?>"/>
					<?elseif($arQ_item['FIELD_TYPE'] == 'date'):?>
						<?/*<input type="text" class="date" id="date-input" name="PERSONAL_BIRTHDAY" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>" />
						<script>
						$(function() { $( "#date-input" ).datepicker({
								changeMonth: true,
								changeYear: true,
								yearRange: "-100:+0",
								defaultDate: '<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>'
							});
							//$( "#date-input" ).datepicker('setDate', '<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>');
						});
						</script>*/?>
						<input type="text" class="date" id="date-input-<?=$arQ_item['QUESTION_ID']?>" name="form_date_<?=$arQ_item['QUESTION_ID']?>"/>
						<script>
							$(function() { $( "#date-input-<?=$arQ_item['QUESTION_ID']?>" ).datepicker({
									changeMonth: true,
									changeYear: true,
									minDate:0
								});
								//$( "#date-input" ).datepicker('setDate', '06.01.1944');
							});
						</script>
					<?elseif($arQ_item['FIELD_TYPE'] == 'email'):?>
						<input type="text" name="form_email_<?=$arQ_item['QUESTION_ID']?>"/>
					<?elseif($arQ_item['FIELD_TYPE'] == 'textarea'):?>
						<textarea name="form_textarea_<?=$arQ_item['QUESTION_ID']?>"></textarea>
					<?elseif($arQ_item['FIELD_TYPE'] == 'dropdown'):?>
						<? 
						/*
						<pre>
							<?print_r($arQuestion)?>
						</pre>
						*/
						?>
					<?else:?>
						<input type="text" name="form_text_<?=$arQ_item['QUESTION_ID']?>"/>
					<?endif;?>    
				<?endforeach;?>
			<?
			}
			?>
            <?if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])):?>
				    <span class="inp_error empty_field table"><div class="table-cell">Поле является обязательным для заполнения</div></span>
			<?endif;?>
                <?//=$arQuestion["HTML_CODE"]?>
		</div>
	<?
		}
	} //endwhile
	?>
    <div class="text-center">
        <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" class="button" name="web_form_submit" value="Добавить" />

    </div>
</div>
<?=$arResult["FORM_FOOTER"]?>
<?
} //endif (isFormNote)
?>