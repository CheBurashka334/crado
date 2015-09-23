<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$file_name = transliterate($_REQUEST['file_name']);
$file_name_ex = explode('.',$file_name);
$x = $_REQUEST['x'];
$y = $_REQUEST['y'];
$w = $_REQUEST['width'];
$h = $_REQUEST['height'];

    //print_r($file_name);
    //обрезка и сохранение на сервере
    /*$src = imagecreatefromjpeg('/images/uploads/153225000_698c62c38a_o.jpg');
    $dest = imagecreatetruecolor($w, $h);

    // Копирование
    imagecopy($dest, $src, $x, $y, $w, $h, $w, $h);
        
    // Вывод и освобождение памяти
    //header('Content-Type: image/*');
    imagejpeg($dest,'avatar.jpg', 90);*/
        
    /*imagedestroy($dest);
    imagedestroy($src);*/
    if($file_name_ex[1] == 'jpg' || $file_name_ex[1] == 'jpeg' || $file_name_ex[1] == 'JPG' || $file_name_ex[1] == 'JPEG')
    {
    	$targ_w = $targ_h = 140;
    	$jpeg_quality = 100;
    	$img_r = imagecreatefromjpeg("../images/uploads/".$file_name);
    	$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
    	imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
    	imagejpeg($dst_r, "../images/avatar/av_".$file_name, $jpeg_quality);
        echo '<img src="/images/avatar/av_'.$file_name.'"/>';
    }
    elseif($file_name_ex[1] == 'png' || $file_name_ex[1] == 'PNG')
    {
        $targ_w = $targ_h = 140;
    	$img_r = imagecreatefrompng("../images/uploads/".$file_name);
    	$dst_r = ImageCreateTrueColor($targ_w, $targ_h);
    	imagecopyresampled($dst_r,$img_r,0,0,$x,$y,$targ_w,$targ_h,$w,$h);
    	imagepng($dst_r, "../images/avatar/av_".$file_name,9);
        echo '<img src="/images/avatar/av_'.$file_name.'"/>';
    }
    else{
        echo 'error';
    }
    unlink($_SERVER['DOCUMENT_ROOT'].'/images/uploads/'.$file_name);
    
    
    function transliterate($input){
        $gost = array( 
            "а" => "a", 
            "б" => "b", 
            "в" => "v", 
            "г" => "g", 
            "д" => "d", 
            "е" => "e", 
            "ё" => "e", 
            "ж" => "zh", 
            "з" => "z", 
            "и" => "i", 
            "й" => "y", 
            "к" => "k", 
            "л" => "l", 
            "м" => "m", 
            "н" => "n", 
            "о" => "o", 
            "п" => "p", 
            "р" => "r", 
            "с" => "s", 
            "т" => "t", 
            "у" => "u", 
            "ф" => "f", 
            "х" => "kh", 
            "ц" => "ts", 
            "ч" => "ch", 
            "ш" => "sh", 
            "щ" => "shch", 
            "ы" => "y", 
            "э" => "e", 
            "ю" => "yu", 
            "я" => "ya", 
            "А" => "A", 
            "Б" => "B", 
            "В" => "V", 
            "Г" => "G", 
            "Д" => "D", 
            "Е" => "E", 
            "Ё" => "E", 
            "Ж" => "Zh", 
            "З" => "Z", 
            "И" => "I", 
            "Й" => "Y", 
            "К" => "K", 
            "Л" => "L", 
            "М" => "M", 
            "Н" => "N", 
            "О" => "O", 
            "П" => "P", 
            "Р" => "R", 
            "С" => "S", 
            "Т" => "T", 
            "У" => "U", 
            "Ф" => "F", 
            "Х" => "Kh", 
            "Ц" => "Ts", 
            "Ч" => "Ch", 
            "Ш" => "Sh", 
            "Щ" => "Shch", 
            "Ы" => "Y", 
            "Э" => "E", 
            "Ю" => "Yu", 
            "Я" => "Ya", 
            "Ъ" => "", 
            "ъ" => "", 
            "ь" => "", 
            "Ь" => "",
            " " => "_",
            "," => "_",
            "_" => "_",
        ); 
         
        return strtr($input, $gost);
        }
     
?>