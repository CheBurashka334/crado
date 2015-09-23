<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "Владельцам заведений");
$APPLICATION->SetTitle("Владельцам заведений");
?><br>
 <br>
<div class="container">
	<div class="pad_40_0">
		<h1>Владельцам заведений</h1>
	</div>
	<p>
		 Друзья, мы с радостью сообщим о вас жителям города! <br>
	</p>
	<p>
 <br>
	</p>
	<p style="text-align: justify;">
		 Пишите нам на почту <a href="mailto:info@crado.ru">info@crado.ru</a> с описанием вашего заведения и мы разместим его на нашем сайте <b>бесплатно</b>. В описании-самопрезентации желательно указать название, сферу деятельности, адрес, время работы, контакты, цены на услуги... И совсем уж хорошо будет, если вы поделитесь с нами парой фотографий и вкратце опишете, в чем ваши особенности.
	</p>
	<p>
 <br>
	</p>
	<p style="text-align: justify;">
		 Мы также можем предложить платные размещения на нашем сайте, которые гарантированно будут просмотрены аудиторией. Более подробно узнать о них вы можете, написав нам на почту <a href="mailto:info@crado.ru">info@crado.ru</a> либо позвонив по телефону +7 (922) 47-00-417. Мы обсудим с вами все моменты вашей рекламной кампании и сформируем индивидуальное коммерческое предложение. <br>
	</p>
	<p style="text-align: justify;">
		<br>
	</p>
	<p>
		 С уважением, команда CRADO
	</p>
	<p>
 <br>
 <br>
	</p>
	<p>
 <a href="https://crado.ru/add_events/"></a>
	</p>
	<p>
 <a href="https://crado.ru/add_events/"></a>
	</p>
</div>
 <br>
<div class="container w725">
	<div class="pad_20_0">
		<h2 class="text-center">Размещение события, места или магазина</h2>
	</div>
	<div class="bwhite add_event new row">
		<div>
			 <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"crado",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"WEB_FORM_ID" => 1,
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"VARIABLE_ALIASES" => Array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID"),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "result_list.php",
		"EDIT_URL" => "result_edit.php",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => ""
	)
);?>
		</div>
	</div>
</div>
 <br><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>