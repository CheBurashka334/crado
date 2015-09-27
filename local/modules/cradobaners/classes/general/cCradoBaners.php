<?php
class cCradoBaners{
    static $MODULE_ID="cradobaners";

    /**
     * Тэндлер, отслеживающий изменени§ в инфоблоках
     * @param $arFields
     * @return bool
     */
    static function getCradoBaners(){
        //$arResult = array();

        if (!CModule::IncludeModule('highloadblock'))
            continue;

        $ID = 2; //highloadblock Brendshl

        //сначала выбрать информацию о ней из базы данных 
        $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();


        //затем инициализировать класс сущности
        $hlentity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);

        $hlDataClass = $hldata['NAME'].'Table';

        $result = $hlDataClass::getList(array(
            'select' => array('ID', 'UF_COUNTCLICK','UF_DATECLICK','UF_COUNTVIEW','UF_IDBANERS'),

        ));
        $ID = '';
        while($res = $result->fetch())
        {
            $arResult[]=$res;
        }
        return $arResult;
    }
}