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
                <div class="data-favorite">
                    <h4>���������</h4>
                    <div class="favorite">
                        <?$APPLICATION->IncludeComponent("bitrix:asd.favorite.likes", "favorite", Array(
                        	"FAV_TYPE" => "content",	// ��� ����������
                        		"PREVIEW_WIDTH" => "240",	// ������ ������
                        		"PREVIEW_HEIGHT" => "160",	// ������ ������
                        		"PAGE_COUNT" => "50",	// ���������� �� ��������
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
            </div>
        </div>
    </div>
</div>
    <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>