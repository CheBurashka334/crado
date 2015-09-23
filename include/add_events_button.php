<?
    global $USER;
    //if ($USER->IsAuthorized()){
        $link = '/add_events/';
    /*}else{
        $link = '/login/';
    }*/
?>
 <?/*
    if ($USER->IsAuthorized()){*/?>
<div>
    <a class="button" href="<?=$link?>">Добавить событие или заведение</a>
</div>
<?/*}else {?>
<div>
    Для добавления нового событя <a href="<?=$link?>">авторизуйтесь</a> или <a href="<?=$link?>">зарегестрируйтесь</a> на сайте.
</div>
<?}*/?>