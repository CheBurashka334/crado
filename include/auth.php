<?
    
?>
<?
                    $ID_PICTYRE = 0;
                    /*$arUser = '';
                    echo '<pre>';
                    print_r($USER->IsAuthorized());
                    echo '</pre>';*/
                    $rsUser = CUser::GetByID($USER->GetID());
                    $arUser = $rsUser->Fetch();
                    //echo "<pre>"; print_r($arUser); echo "</pre>";
                    if($arUser['PERSONAL_PHOTO'] != '')
                    {
                        $ID_PICTYRE = $arUser['PERSONAL_PHOTO']; 
                        $item_slider = CFile::GetFileArray($ID_PICTYRE);
                        $file = CFile::ResizeImageGet($item_slider, array('width'=>140, 'height'=>140),
                        BX_RESIZE_IMAGE_EXACT   );
                        //$URL = CFile::GetPath($ID_PICTYRE);
                    }
                ?>
                <div class="table">
                    <div class="table-cell personal-modal">
                        <div class="table">
                            <div class="photo text-left table-cell">
                                <?if($ID_PICTYRE != 0):?>
                                    <a href="/login/" rel="nofollow"><img src="<?=$file['src']?>" width="90" height="90"/></a>
                                <?else:?>
                                    <a href="/login/" rel="nofollow"><img src="/images/no-photo.jpg"/></a>
                                <?endif?>
                            </div>
                            <div class="name text-left table-cell">
                                <p>Вы авторизованны как</p>
                                <a href="/login/" rel="nofollow">
                                    <h3>
                                        <?=$arUser['NAME']?> 
                                        <?=$arUser['LAST_NAME']?> 
                                    </h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-cell link-modal">
                        <?$APPLICATION->IncludeComponent("bitrix:menu","personal_modal",Array(
                                    "ROOT_MENU_TYPE" => "personal_modal", 
                                    "MAX_LEVEL" => "1", 
                                    "CHILD_MENU_TYPE" => "", 
                                    "USE_EXT" => "N",
                                    "DELAY" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "MENU_CACHE_TYPE" => "N", 
                                    "MENU_CACHE_TIME" => "3600", 
                                    "MENU_CACHE_USE_GROUPS" => "Y", 
                                    "MENU_CACHE_GET_VARS" => "" 
                            )
                    );?>
                    </div>
                </div>