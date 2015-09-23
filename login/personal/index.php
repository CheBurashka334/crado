<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?if(!$USER->IsAuthorized()):
        header("Location: /login/");
        exit();
    endif;?>
<div class="bgray-light profile">
    <div class="container">
        <div class="profile-block row">
            <?$APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR."include/profile-menu.php"), false);?>
            <div class="block">
                <?
                    $rsUser = CUser::GetByID($USER->GetID());
                    $arUser = $rsUser->Fetch();
                ?>
                <div class="data-profile">
                    <h4>������ ������</h4>
                    <div class="bwhite prof shadow">
                        <?/*<pre>
                            <?print_r($arUser);?>
                        </pre>*/?>
                        <div class="row el">
                            <div class="col-3">
                                <label>���:</label>
                            </div>
                            <div class="col-9">
                                <?=$arUser['NAME']?>
                            </div>
                        </div>
                        
                        <div class="row el">
                            <div class="col-3">
                                <label>�������:</label>
                            </div>
                            <div class="col-9">
                                <?=$arUser['LAST_NAME']?>
                            </div>
                        </div>
                        
                        <div class="row el">
                            <div class="col-3">
                                <label>���� ��������:</label>
                            </div>
                            <div class="col-9">
                                <?=$arUser['PERSONAL_BIRTHDAY']?>
                            </div>
                        </div>
                        
                        <div class="row el">
                            <div class="col-3">
                                <label>���:</label>
                            </div>
                            <div class="col-9">
                                <?if($arUser['PERSONAL_GENDER'] == 'F'):?>
                                    �������
                                <?else:?>
                                    �������
                                <?endif;?>
                            </div>
                        </div>

                        <div class="row el">
                            <div class="col-3">
                                <label>eMail:</label>
                            </div>
                            <div class="col-9">
                                <?=$arUser['EMAIL']?>
                            </div>
                        </div>

                    </div>
                </div>
                
                <div class="data-favorite">
                    <h4>���������</h4>
                    <div class="favorite">
                        <?$APPLICATION->IncludeComponent("bitrix:asd.favorite.likes", "favorite-personal", Array(
                        	"FAV_TYPE" => "content",	// ��� ����������
                        		"PREVIEW_WIDTH" => "240",	// ������ ������
                        		"PREVIEW_HEIGHT" => "160",	// ������ ������
                        		"PAGE_COUNT" => "2",	// ���������� �� ��������
                        		"PAGER_TEMPLATE" => "",	// ������ ������������ ���������
                        		"USER_ID" => "",	// ID ������������ (������� �� ����.)
                        		"FOLDER_ID" => "",	// ID �����
                        		"NOT_SHOW_WITH_NOT_FOLDER" => "N",	// �� �������� ��������, ���� �� ����� ID �����
                        		"ALLOW_MOVED" => "N",	// ��������� ���������� ��������
                        	),
                        	false
                        );?>
                    </div>
                </div>
                <div class="data-social">
                    <h4>��������� ���. ����</h4>
                    <div class="social-block bwhite shadow">
                        <?
                            	$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", "social", array(
                            			"SHOW_PROFILES" => "Y",
                            			"ALLOW_DELETE" => "Y"
                            		),
                            		false
                            	);
                        ?>
                    </div>
                </div>
                <?/*$APPLICATION->IncludeComponent(
                    "bitrix:main.profile", 
                    "profile-crado", 
                    array(
                            "AJAX_MODE" => "N",
                            "AJAX_OPTION_JUMP" => "N",
                            "AJAX_OPTION_STYLE" => "Y",
                            "AJAX_OPTION_HISTORY" => "N",
                            "SET_TITLE" => "Y",
                            "USER_PROPERTY" => array(
                            ),
                            "SEND_INFO" => "N",
                            "CHECK_RIGHTS" => "N",
                            "USER_PROPERTY_NAME" => "",
                            "AJAX_OPTION_ADDITIONAL" => ""
                    ),
                    false
                );*/?>
            </div>
        </div>
    </div>
</div>
    <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>