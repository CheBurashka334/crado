<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Crado - ваш гид по активному отдыху за городом в Сургуте. Огромный выбор загородного отдыха.");
$APPLICATION->SetPageProperty("title", "Crado | Отдых за городом на портале активного отдыха в Сургуте");
$APPLICATION->SetTitle("Отдых за городом");
?>
<div class="bgray-light">
    <div class="container">
		<?
			//’лебные крошки
		?> 
		
		<?
			$APPLICATION->IncludeComponent("ls:breadcrumb","",Array(
				"START_FROM" => "0", 
				"PATH" => "", 
				"SITE_ID" => "s1" 
			)
			);
		?>
		<?
			//
		?>
        <div class="pad_40_0 table zagolovok_ev">
            <h1 class="table-cell"><?=$APPLICATION->ShowTitle('h1');?></h1>
            <div class="add_events_button  table-cell">
                <?$APPLICATION->IncludeComponent(
                	"bitrix:main.include",
                	"",
                	Array(
                		"COMPONENT_TEMPLATE" => ".default",
                		"AREA_FILE_SHOW" => "file",
                		"AREA_FILE_SUFFIX" => "inc",
                		"EDIT_TEMPLATE" => "",
                		"PATH" => "/include/add_events_button.php"
                	)
                );?>
            </div>
        </div>
        <div class="category row">
            <?include_once $_SERVER['DOCUMENT_ROOT']."/include/categories_out.php";?>
        </div>
        <div class="pad_20_0 small-block">
            <?include_once $_SERVER['DOCUMENT_ROOT']."/include/out_city_material.php";?>
        </div>
		<div class="pad_25_0">
							<div class="text-center"><h2>Все спортивные секции за городом Сургут</h2></div><br/>
							<div class="category row">
								<div class="row line">
								<? $a=0;?>
								
								<?
                                $params = 'out_city';
                                $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>2, "XML_ID"=>$params));
                                if($enum_fields = $property_enums->GetNext())
								$whe_city = $enum_fields['~VALUE'];
                                
                              
									$iblok_id = '2';
									
									$category_section = cat_section($whe_city,$iblok_id);
									uasort($category_section, "sort_c");
								?>
								<?foreach($category_section as $item):?>
                                        
                                        <?
                                            $filter_or_element = array(array("PROPERTY_category"=>$item['ID_CATEGORY']));
                                            $filter_or =  array_merge($filter_or, $filter_or_element);
                                        ?>
										<?if($a == 5):?></div><div class="row line"><?$a=0; endif;?>
										<a href="/out_city/<?=$item['CODE_CATEGORY']?>/" class="left text-center bwhite category-button ">
											<div><?=$item['NAME_CATEGORY']?></div>
										</a>
										<?
										$a++;?>	
								<?
									endforeach;
								?>
								</div>
							</div>
		</div>
        <div class="pad_50_0 text-center">
            Crado - ваш гид по активному отдыху за городом в Сургуте. Огромный выбор загородного отдыха. 
        </div>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>


<?
    function sort_c($a, $b)
    {
        return strcmp($a["NAME_CATEGORY"], $b["NAME_CATEGORY"]);
    }
?>