<?php
CModule::IncludeModule("cradobaners");
global $DBType;

$arClasses=array(
    'cCradoBaners'=>'classes/general/cCradoBaners.php'
);

CModule::AddAutoloadClasses("cradobaners",$arClasses);
