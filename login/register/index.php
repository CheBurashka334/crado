<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>
<?if($USER->IsAuthorized()):
        header("Location: /login/personal/");
        exit();
    endif;?>
<div class="bgray-light register">
    <div class="container w725">
        <h1>Регистрация</h1>
        <div class="bwhite register-block row">
            <?$APPLICATION->IncludeComponent(
                    "bitrix:main.register",
                    "register-crado",
                    Array(
                            "SHOW_FIELDS" => array("EMAIL","NAME"),
                            "REQUIRED_FIELDS" => array("EMAIL","NAME"),
                            "AUTH" => "Y",
                            "USE_BACKURL" => "Y",
                            "SUCCESS_PAGE" => "",
                            "SET_TITLE" => "Y",
                            "USER_PROPERTY" => array(),
                            "USER_PROPERTY_NAME" => ""
                    )
            );?>
            </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        
        /*Привязывем футер к низу страницы*/
        var f = function() {
        $(".footer").css({position:"relative"});
        var h1 = $("body").height();
        var h2 = $(window).height();
        var d = h2 - h1;
        var h = $(".workarea").height() + d;
        var ruler = $("<div>").appendTo(".workarea > div");
        h = Math.max(ruler.position().top,h);
        ruler.remove();
        $(".workarea > div").height(h-60);
        };
        setInterval(f,1);
        $(window).resize(f);
        f();


    /**/
    
    })
    </script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>