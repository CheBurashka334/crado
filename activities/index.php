<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("title", "������������� �����������");
$APPLICATION->SetTitle("������������� �����������");
?><br>
 <br>
<div class="container">
	<div class="pad_40_0">
		<h1>������������� �����������</h1>
	</div>
	<p>
		 ������, �� � �������� ������� � ��� ������� ������!
	</p>
	<p>
 <br>
	</p>
	<p>
		 ��� ����� ��������� ����� ���� ���� �������� ��� �� ����� <a href="mailto:info@crado.ru">info@crado.ru</a> � ��������� ������������ �����������. ��� ��������� ����� ������� �������, ��� �����. � �������� ������ ������ �� ��������� ��������: ��� �����������, ��� �� �������, ��� � ����� ����������, ����� ������������? ���� � ��� ���� ������������ ���������� ��� ��������, ���������� � ��. ��� ������ ��������������� ���������. <br>
	</p>
	<p>
		<br>
	</p>
	<p>
		��� ���������� �������, ��� ���� ��� ����������� �� ����� � ��� ������ ����� � ��� ������. ��� ������� ��������� �����������, ������� ����� ����������� �� ����� ������ ������� �������� ����� ����� �����. �� ����� ���������� ������� ����������, ������� �������������� ����� ����������� ������ ������������. � ��� �� ������ ������, ������� ��� �� ����� <a href="mailto:info@crado.ru">info@crado.ru</a> ���� �������� �� ��������+7 (922) 47-00-417. �� ������� � ���� ��� ������� ����� ��������� �������� � ���������� �������������� ������������ �����������.&nbsp;
	</p>
 <br>
	<p>
	</p>
	<p>
		 � ���������, ������� CRADO
	</p>
</div>
 <br>
 <br>
 <br>
<div class="container w725">
	<div class="pad_20_0">
		<h2 class="text-center">���������� �������, ����� ��� ��������</h2>
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