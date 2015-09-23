<div class="menu-profile bwhite">
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
                <div class="photo text-center">
                    <?if($ID_PICTYRE != 0):?>
                        <a href="/login/" rel="nofollow"><img src="<?=$file['src']?>" width="140" height="140"/></a>
                    <?else:?>
                        <img src="/images/no-photo.jpg"/>
                    <?endif?>
                </div>
                <div class="text-center link-uplpers" >
                    <a href="/login/personal/lin/" rel="nofollow">Редактировать личные данные</a>
                </div>
                <div class="name text-center">
                    <h2>
                        <?=$arUser['NAME']?> 
                        <?=$arUser['LAST_NAME']?> 
                    </h2>
                </div>
                <div class="main">
                    <?$APPLICATION->IncludeComponent("bitrix:menu","personal",Array(
                                    "ROOT_MENU_TYPE" => "personal", 
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