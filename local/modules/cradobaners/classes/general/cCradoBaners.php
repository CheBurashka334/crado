<?php
class cCradoBaners{
    static $MODULE_ID="cradobaners";

    /**
     * ’эндлер, отслеживающий изменени¤ в инфоблоках
     * @param $arFields
     * @return bool
     */
    static function getCradoBaners(){
       //$arResult = array();

        CModule::IncludeModule('iblock');
        global $DB;
        $result = $DB->Query('SELECT * FROM b_cradobaners');

        $arResult = array();
        $i = 0;
        while($res = $result->fetch())
        {
            $arResult[$i]['ID']=$res['ID'];
            $arResult[$i]['COUNT_CLICK']=$res['UF_COUNTCLICK'];
            $arResult[$i]['COUNT_VIEW']=$res['UF_COUNTVIEW'];
            $arResult[$i]['DATE_LAST_CLICK']=$res['UF_DATECLICK'];

            $obElement = CIBlockElement::GetByID($res['UF_IDBANERS']);
                if($arEl = $obElement->GetNext())
                {
                    //$arResult[$i]['BANNER'] = $arEl;
                    $arResult[$i]['BANNER']['ID'] = $arEl['ID'];
                    $arResult[$i]['BANNER']['NAME'] = $arEl['NAME'];

                    //Баннер в категории
                    if($arEl['PREVIEW_PICTURE']!='')
                    {
                        $arResult[$i]['BANNER']['BANNER_CATEGORY'] = CFile::ResizeImageGet($arEl['PREVIEW_PICTURE'], array('width'=>140, 'height'=>95), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    }
                    if($arEl['DETAIL_PICTURE']!='')
                    {
                        $arResult[$i]['BANNER']['BANNER_ELEMENT'] = CFile::ResizeImageGet($arEl['DETAIL_PICTURE'], array('width'=>82, 'height'=>140), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    }
                }
            $i++;
        }
        return $arResult;
    }
}