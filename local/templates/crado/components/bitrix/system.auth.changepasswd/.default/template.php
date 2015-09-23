<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

	<div class="bgray-light register">
		<div class="container w725">
			<h1>Востановление пароля</h1>
			<div class="bwhite register-block row">
				<div class="bx-auth-reg form">
				<?
				ShowMessage($arParams["~AUTH_RESULT"]);
				?>
				<form method="post" action="<?=$arResult["AUTH_FORM"]?>" name="bform">
					<?if (strlen($arResult["BACKURL"]) > 0): ?>
					<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
					<? endif ?>
					<input type="hidden" name="AUTH_FORM" value="Y">
					<input type="hidden" name="TYPE" value="CHANGE_PWD">
					
					<div class="row_form">
						<label>Электронная почта*</label>
						<input type="text" class="email_required only_latin" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>" autocomplete="off"/>

								<span class="inp_error email_field table"><div class="table-cell">Неверный формат e-mail</div></span>
								<span class="inp_error latin_field table"><div class="table-cell">Только латинские символы</div></span>
								<span class="inp_error empty_field table"><div class="table-cell">Поле является обязательным для заполнения</div></span>

					</div>
					
					<div class="row_form">
						<label>Контрольная строка*</label>
						<input type="text" name="USER_CHECKWORD" maxlength="50" value="<?=$arResult["USER_CHECKWORD"]?>" class="bx-auth-input" />
					</div>
					
					<div class="row_form">
						<label>Новый пароль*</label>
						<input type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult["USER_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
				<?if($arResult["SECURE_AUTH"]):?>
								<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
									<div class="bx-auth-secure-icon"></div>
								</span>
								<noscript>
								<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
									<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
								</span>
								</noscript>
				<script type="text/javascript">
				document.getElementById('bx_auth_secure').style.display = 'inline-block';
				</script>
				<?endif?>
					</div>
					
					<div class="row_form">
						<label>Подтверждение пароля*</label>
						<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult["USER_CONFIRM_PASSWORD"]?>" class="bx-auth-input" autocomplete="off" />
					</div>
					<div class="table">
						<div class="table-cell col-6 text-center">
							<input type="submit" name="change_pwd" class="button" value="<?=GetMessage("AUTH_CHANGE")?>" />
						</div>
						<div class="table-cell col-6 text-center">
							<a href="/login/"><?=GetMessage("AUTH_AUTH")?></a>
						</div>
					</div>
				<br/>
				<p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p><br/>
				<p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>
				</form>

				<script type="text/javascript">
				document.bform.USER_LOGIN.focus();
				</script>
				</div>
			</div>
		</div>
	</div>