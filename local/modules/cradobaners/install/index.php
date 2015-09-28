<?
Class cradobaners extends CModule
{
    var $MODULE_ID = "cradobaners";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;

    function cradobaners()
    {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
        $path = substr($path, 0, strlen($path) - strlen("/index.php"));
        include($path."/version.php");
        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }
        $this->MODULE_NAME = "Модуль Банеры";
        $this->MODULE_DESCRIPTION = "Модуль вывода банеров (показы, переходы, последние переходы)";
    }

    function InstallDB()
    {
        global $DB, $DBType, $APPLICATION;
        $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/local/modules/cradobaners/install/db/mysql/install.sql");
        return true;
    }

    function InstallFiles($arParams = array())
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/cradobaners/install/admin/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/admin");
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/cradobaners/install/panel/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default", true, true);
        return true;
    }
    function DoInstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        // Install events
        $this->InstallDB();
        $this->InstallFiles();
        RegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","cradobaners","cCradoBaners","onBeforeElementUpdateHandler");
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Установка модуля cradobaners", $DOCUMENT_ROOT."/local/modules/cradobaners/install/step.php");
        return true;
    }

    function DoUninstall()
    {
        global $DOCUMENT_ROOT, $APPLICATION;
        UnRegisterModuleDependences("iblock","OnAfterIBlockElementUpdate","cradobaners","cCradoBaners","onBeforeElementUpdateHandler");
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile("Деинсталляция модуля cradobaners", $DOCUMENT_ROOT."/local/modules/cradobaners/install/unstep.php");
        return true;
    }
}