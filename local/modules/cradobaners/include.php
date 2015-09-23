<?php
CModule::IncludeModule("cradobaners");
global $DBType;

$arClasses=array(
    'cMainDull'=>'classes/general/cMainDull.php'
);

CModule::AddAutoloadClasses("cradobaners",$arClasses);
