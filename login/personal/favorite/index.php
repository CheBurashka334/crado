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
                    <h4>Избранное</h4>
                    <div class="favorite">
                        <?$APPLICATION->IncludeComponent("bitrix:asd.favorite.likes", "favorite", Array(
                        	"FAV_TYPE" => "content",	// Тип избранного
                        		"PREVIEW_WIDTH" => "240",	// Ширина превью
                        		"PREVIEW_HEIGHT" => "160",	// Высота превью
                        		"PAGE_COUNT" => "50",	// Количество на странице
                        		"PAGER_TEMPLATE" => "",	// Шаблон постраничной навигации
                        		"USER_ID" => "",	// ID пользователя (текущий по умол.)
                        		"FOLDER_ID" => "",	// ID папки
                        		"NOT_SHOW_WITH_NOT_FOLDER" => "N",	// Не выводить элементы, если не задан ID папки
                        		"ALLOW_MOVED" => "N",	// Позволять перемещать элементы
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