<?php
class cCradoBaners{
    static $MODULE_ID="cradobaners";

    /**
     * �������, ������������� �������� � ����������
     * @param $arFields
     * @return bool
     */
    static function getCradoBaners(){
        //$arResult = array();

        if (!CModule::IncludeModule('highloadblock'))
            continue;

        $ID = 2; //highloadblock Brendshl

        //������� ������� ���������� � ��� �� ���� ������ 
        $hldata = Bitrix\Highloadblock\HighloadBlockTable::getById($ID)->fetch();


        //����� ���������������� ����� ��������
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