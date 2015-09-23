<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("description", "Crado.ru - ������ ��� �������� ����� � ����� � �������: �����, ������, ����� � ������ ������! �� ������, ���� ����� � �������? ����� �����!");
$APPLICATION->SetPageProperty("title", "Crado.ru | �������� ����� � ������� ��� ����� � �������� - ������ ����� � �������");
$APPLICATION->SetTitle("���� ����� � �������");
?> 
<div class="container">
    <div class="zag-index table row">
        <div class="col-6 table-cell">
            <h2 style="font-size: 28px;">� �������</h2>
            <div class="desc">
                Crado - ��� ���������� ������ �� ��������� ������ � ������ �������. �� ����� ����� �� ������ ����� ����� ���������� �� ������ � ����������� �������� � �������.
            </div>
        </div>
        <div class="col-6 table-cell">
            <div class="w300 calendar right table">
                <?
                            date_default_timezone_set("UTC"); // ������������� ������� ���� �� ��������
                            $time = time(); // ��� ��� �������� ���������� � ����
                            $offset = 5; // ��������, � ������������ �������� ������������ �������� ���������� +3 ����
                            $time += 5 * 3600; // ��������� 3 ���� � ������� �� ��������
                ?>
                <a href="/events/?date=<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>" class="w120 red tek-date table-cell text-center">
                        <p class="day">
                            <?echo date('j',$time);?>
                        </p>
                        <p class="month">
                            <?echo uMonth(date('n',$time));?>
                        </p>
                </a>
                <div class="w180 table-cell text-center next-date">
                    <div class="borderright borderbottom">
                    <?for($a=1; $a<=6;$a++){?>
                        <?if($a==4):?></div><div class="borderright"><?endif;?>
                        <a class="w60 left black" href="/events/?date=<?=date('d.m.Y',$time + 24*$a * 60 * 60);?>">
                            <p class="day">
                                <?echo date('j',$time + 24*$a * 60 * 60);?>
                            </p>
                            <p class="week">
                                <?echo uWeek(date('D',$time + 24*$a * 60 * 60));?>
                            </p>
                        </a>
                    <?}?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



            <?
                global $arrFilter;
                $arrFilter = Array(
                //�IBLOCK_ID�=>7,
                "PROPERTY_main_VALUE"=>"��",
                );
            ?>
            <?$APPLICATION->IncludeComponent(
        	"bitrix:news.list",
        	"ad",
        	Array(
        		"DISPLAY_DATE" => "Y",
        		"DISPLAY_NAME" => "Y",
        		"DISPLAY_PICTURE" => "Y",
        		"DISPLAY_PREVIEW_TEXT" => "Y",
        		"AJAX_MODE" => "N",
        		"IBLOCK_TYPE" => "content",
        		"IBLOCK_ID" => "3",
        		"NEWS_COUNT" => "4",
        		"SORT_BY1" => "SORT",//"size",
        		"SORT_ORDER1" => "ASC",
        		"SORT_BY2" => "size",
        		"SORT_ORDER2" => "ASC",
        		"FILTER_NAME" => 'arrFilter',
        		"FIELD_CODE" => array(),
        		"PROPERTY_CODE" => array("content", "size", "main"),
        		"CHECK_DATES" => "Y",
        		"DETAIL_URL" => "",
        		"PREVIEW_TRUNCATE_LEN" => "",
        		"ACTIVE_DATE_FORMAT" => "d.m.Y",
        		"SET_TITLE" => "N",
        		"SET_BROWSER_TITLE" => "N",
        		"SET_META_KEYWORDS" => "N",
        		"SET_META_DESCRIPTION" => "N",
        		"SET_STATUS_404" => "N",
        		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        		"ADD_SECTIONS_CHAIN" => "Y",
        		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
        		"PARENT_SECTION" => "",
        		"PARENT_SECTION_CODE" => "",
        		"INCLUDE_SUBSECTIONS" => "Y",
        		"CACHE_TYPE" => "A",
        		"CACHE_TIME" => "36000000",
        		"CACHE_FILTER" => "N",
        		"CACHE_GROUPS" => "Y",
        		"PAGER_TEMPLATE" => ".default",
        		"DISPLAY_TOP_PAGER" => "N",
        		"DISPLAY_BOTTOM_PAGER" => "N",
        		"PAGER_TITLE" => "�������",
        		"PAGER_SHOW_ALWAYS" => "N",
        		"PAGER_DESC_NUMBERING" => "N",
        		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
        		"PAGER_SHOW_ALL" => "N",
        		"AJAX_OPTION_JUMP" => "N",
        		"AJAX_OPTION_STYLE" => "Y",
        		"AJAX_OPTION_HISTORY" => "N"
        	),
        false
        );?>
        

<div class="material">
    <div class="container">
        <?include_once $_SERVER['DOCUMENT_ROOT']."/include/home_material.php";?>
    </div>
</div>
<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>