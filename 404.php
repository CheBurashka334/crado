<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y"); 

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("404 Not Found");

/*$APPLICATION->IncludeComponent("bitrix:main.map", ".default", Array(
	"LEVEL"	=>	"3",
	"COL_NUM"	=>	"2",
	"SHOW_DESCRIPTION"	=>	"Y",
	"SET_TITLE"	=>	"Y",
	"CACHE_TIME"	=>	"36000000"
	)
);*/
?>
    <div class="bgray notfound">
        <div class="text-center">
            <img src="/images/404.png"/>
            <div class="">
                Данной страницы не существует :(
            </div> 
            <div class=""> 
                Воспользуйтесь поиском или перейдите на <a href="/">главную страницу</a>
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
<?

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>