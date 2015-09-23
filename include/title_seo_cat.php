<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<?
	//Получение СЕО текста, титла, дискрипшен, H1 
	$category = $_POST['category'];
    $whe_city = $_POST['whe_city'];
	
	$url = '';
	$title = '';
	$seo = '';
	$h1 = '';
	$discription = '';
	
	if($category == "all")
	{
		$url = category_all_URL($whe_city);
		$title = category_all_TITLE();
		$seo = category_all_SEO();
		
		$h1 = category_all_TITLE(1);
		$discription = category_all_TITLE(2);
	}
	else
	{
		$category = explode(',',$category);
		unset($category[count($category)-1]);
		if(count($category)>1)
		{
			$url = category_all_URL($whe_city);
			$title = category_all_TITLE();
			$seo = category_all_SEO();
			$h1 = category_all_TITLE(1);
			$discription = category_all_TITLE(2);
		}
		else
		{
			$url = category_cat_URL($whe_city,$category[0]);
			$title = category_cat_TITLE($category[0]);
			$seo = category_cat_SEO($category[0]);
			$h1 = category_cat_TITLE($category[0],1); 
			$discription = category_cat_TITLE($category[0],2);
		}
	}
	$res = array(
		'URL' => $url,
		'TITLE' => $title,
		'SEO' => $seo,
		'H1' => $h1,
		'DESCRIPTION' => $discription
		);
	echo json_encode($res,true);
	

?>