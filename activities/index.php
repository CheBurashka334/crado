<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "ќрганизаторам меропри€тий");
$APPLICATION->SetTitle("ќрганизаторам меропри€тий");
?><br>
 <br>
<div class="container">
	<div class="pad_40_0">
		<h1>ќрганизаторам меропри€тий</h1>
	</div>
	<p>
		 ƒрузь€, мы с радостью сообщим о вас жител€м города!
	</p>
	<p>
 <br>
	</p>
	<p>
		 ƒл€ этого заполните форму ниже либо напишите нам на почту <a href="mailto:info@crado.ru">info@crado.ru</a> с описанием готов€щегос€ меропри€ти€. „ем подробнее будет описано событие, тем лучше. ¬ описание войдут ответы на несколько вопросов: кто организатор, что за событие, где и когда произойдет, зачем организуетс€? ≈сли у вас есть оригинальные фотографии или картинки, присылайте и их. Ёта услуга предоставл€етс€ бесплатно. <br>
	</p>
	<p>
		<br>
	</p>
	<p>
		„ем актуальнее событие, тем выше оно размещаетс€ на сайте и тем больше людей о нем узнают. Ќаш контент посто€нно пополн€етс€, поэтому ранее размещенные на сайте анонсы событий уступают места более новым. ћы можем предложить платные размещени€, которые гарантированно будут просмотрены нашими посетител€ми. ќ них вы можете узнать, написав нам на почту <a href="mailto:info@crado.ru">info@crado.ru</a> либо позвонив по телефону+7 (922) 47-00-417. ћы обсудим с вами все моменты вашей рекламной кампании и сформируем индивидуальное коммерческое предложение.&nbsp;
	</p>
 <br>
	<p>
	</p>
	<p>
		 — уважением, команда CRADO
	</p>
</div>
 <br>
 <br>
 <br>
<div class="container w725">
	<div class="pad_20_0">
		<h2 class="text-center">–азмещение событи€, места или магазина</h2>
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