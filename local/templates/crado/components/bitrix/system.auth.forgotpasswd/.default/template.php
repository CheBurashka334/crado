<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?
?>
<div class="bgray-light register">
    <div class="container w725">
        <h1>Востановление пароля</h1>
        <div class="bwhite register-block row">
			<div class="bx-auth-reg form">
				<?ShowMessage($arParams["~AUTH_RESULT"]);?>
				<form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>">
				<?
				if (strlen($arResult["BACKURL"]) > 0)
				{
				?>
					<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
				<?
				}
				?>
					<input type="hidden" name="AUTH_FORM" value="Y">
					<input type="hidden" name="TYPE" value="SEND_PWD">
					<p>
						<?//=GetMessage("AUTH_FORGOT_PASSWORD_1")?>
					</p>
					<br/>
					<b><?=GetMessage("AUTH_GET_CHECK_STRING")?></b>
					<br/><br/>
					 <div class="row_form">
								<label>Электронная почта*</label>
						<input type="text" class="email_required only_latin" name="USER_EMAIL" value="<?=$arResult["VALUES"]['EMAIL']?>" autocomplete="off"/>

								<span class="inp_error email_field table"><div class="table-cell">Неверный формат e-mail</div></span>
								<span class="inp_error latin_field table"><div class="table-cell">Только латинские символы</div></span>
								<span class="inp_error empty_field table"><div class="table-cell">Поле является обязательным для заполнения</div></span>

					</div>
					<div class="table">
						<div class="table-cell col-6 text-center"><input type="submit" name="send_account_info" class="button" value="<?=GetMessage("AUTH_SEND")?>" /></div>
						<div class="table-cell col-6 text-center"><a href="/login/"><?=GetMessage("AUTH_AUTH")?></a></div>
					</div>
				</form>
			</div>
			<script type="text/javascript">
			document.bform.USER_LOGIN.focus();
			</script>
			</div>
			</div>
			</div>
