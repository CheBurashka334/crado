<?php   
    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/images/uploads/';
    //print_r($_FILES, true);
    if (move_uploaded_file($_FILES['work-avatar']['tmp_name'], $uploaddir . 
    	transliterate($_FILES['work-avatar']['name']))) {
        print "File is valid, and was successfully uploaded.";
    } else {
        print "There some errors!";
    }
    
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
    
    //echo 'Contents of $_FILES:<br/><pre>'.print_r($_FILES,true).'</pre>';
?>