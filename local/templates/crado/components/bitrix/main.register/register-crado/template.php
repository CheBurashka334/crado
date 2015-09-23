<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();
?>
<div class="bx-auth-reg form">

<?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>

<?
    if (count($arResult["ERRORS"]) > 0):
            foreach ($arResult["ERRORS"] as $key => $error)
                    if (intval($key) == 0 && $key !== 0) 
                            $arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

            ShowError(implode("<br />", $arResult["ERRORS"]));

    elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
        <p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
    <?endif?>
    
    <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
        <?if($arResult["BACKURL"] <> ''):?>
            <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif;?>
        <div class="row_form">
                <label>����������� �����*</label>
		<input type="text" class="email_required only_latin" onchange="setLogin(this)" name="REGISTER[EMAIL]" value="<?=$arResult["VALUES"]['EMAIL']?>" autocomplete="off"/>
		<input type="hidden" class="login_input" name="REGISTER[LOGIN]" value="<?=$arResult["VALUES"]['LOGIN']?>" />

                <span class="inp_error email_field table"><div class="table-cell">�������� ������ e-mail</div></span>
                <span class="inp_error latin_field table"><div class="table-cell">������ ��������� �������</div></span>
                <span class="inp_error empty_field table"><div class="table-cell">���� �������� ������������ ��� ����������</div></span>

	</div>
	<div class="row_form">
		<label>���*</label>
		<input class="required" type="text" name="REGISTER[NAME]" value="<?=$arResult["VALUES"]['NAME']?>" />
		<span class="inp_error empty_field table"><div class="table-cell">���� �������� ������������ ��� ����������</div></span>
	</div>
	<div class="row_form">
		<label>������*</label>
		<input type="password" name="REGISTER[PASSWORD]" value="<?=$arResult["VALUES"]['PASSWORD']?>" class="paswd" autocomplete="off" />
		<span class="inp_error length_field table"><div class="table-cell">������ ������ ���� �� ����� 6 ��������</div></span>
                <span class="inp_error latin_field table"><div class="table-cell">������ ������ ��������� ������ ��������� ����� � �����</div></span>
                <span class="inp_error empty_field table"><div class="table-cell">���� �������� ������������ ��� ����������</div></span>
	</div>
        <div class="row_form">
                <label>��������� ������*</label>
		<input class="paswd_inp" type="password" name="REGISTER[CONFIRM_PASSWORD]" value="<?=$arResult["VALUES"]['CONFIRM_PASSWORD']?>" autocomplete="off" />
		<span class="inp_error empty_field table"><div class="table-cell">���� �������� ������������ ��� ����������</div></span>
                <span class="inp_error pass_field table"><div class="table-cell">������ �� ���������</div></span>
        </div>
        <div class="text-center">
            <input type="submit" value="������������������" class="btn3 button" name="register_submit_button" />
        </div>
        <div class="text">
            <p>����� ����������� �� ��������� ���� email ������ ������ � ��������������.</p>
        </div>
        
        <?/*foreach ($arResult["SHOW_FIELDS"] as $FIELD):?>
            <pre><?print_r($FIELD)?></pre>
            <?//if($FIELD == "AUTO_TIME_ZONE" && $arResult["TIME_ZONE_ENABLED"] == true):?>
        <?endforeach;*/?>
    </form>  
    
<?endif;?>
</div>





