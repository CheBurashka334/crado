<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/places/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
		"RULE" => "code=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/places/detail.php",
	),
	array(
		"CONDITION" => "#^/shops/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
		"RULE" => "code=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/shops/detail.php",
	),
    array(
		"CONDITION" => "#^/events/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
		"RULE" => "code=\$1",
		"ID" => "bitrix:news.detail",
		"PATH" => "/events/detail.php",
	),
	array(
		"CONDITION" => "#^/out_city/([a-zA-Z0-9\\.\\-_]+)/#",
		"RULE" => "", 
		"ID" => "bitrix:news.list",
		"PATH" => "/out_city/list.php",
	),
	array(
		"CONDITION" => "#^/in_city/([a-zA-Z0-9\\.\\-_]+)/#",
		"RULE" => "",
		"ID" => "bitrix:news.list",
		"PATH" => "/in_city/list.php",
	),
	array(
		"CONDITION" => "#^/([a-zA-Z0-9_-]+)(/)(?:\\\\?.*)?#",
		"RULE" => "code=\$1",
		"ID" => "bitrix:news.list",
		"PATH" => "/tags/detail.php",
	),
);

?>