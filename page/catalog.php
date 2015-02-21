<?
$pieces=array();
if(isset($_GET['menu'])){
    $pieces = explode("-", $_GET['menu']);
    $num = "6";
    @$page = $pieces[1];
}else{
    $pieces[0]='';
}

switch($_GET['page']){
    case("catalog"): $hed="Доп. оборудование";$id_menu='5'; break;


}

if($_GET['menu']=='Online_vitrina_originalnyh_aksessuarov'){
?>
<script language="javascript" type="text/javascript">
    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }
</script>
<?php
echo '<iframe src="/accessories/cat.php" width="955px"  scrolling="no" frameborder="0" onload="javascript:resizeIframe(this);" />';
}
?>

<div class="heder_page"><a class="heder_page_name" href="/<?echo $_GET['page'];?>/"><?echo $hed;?></a>
    <ul>
        <?
        $pr=mysql_query("SELECT * FROM  `accessories` WHERE `menu`='".$id_menu."' AND `glass`='0' ORDER BY `idd` ASC");
        while($prod=mysql_fetch_array($pr)){
            echo ' <li><a href="/'.$_GET['page'].'/'.$prod['link'].'/" '; if($prod['link']==$pieces[0]){echo 'class="activ"';} echo' >'.$prod['pmenu'].'</a></li>';
        }
        ?>
    </ul></div>

<link href="/css/menu-right.css" rel="stylesheet"/>
<ul class="services-menu" style="list-style:none;">
    <li class="pic service">
        <a href="http://karpaty-autocenter.com.ua/service/zapis_to/" title="Сервис ">Запись на сервис                 </a>
    </li>
    <li class="pic tradein">
        <a href="http://karpaty-autocenter.com.ua/service/service_calc/" title="Калькулятор ТО">
            Калькулятор ТО</a>
    </li>
    <li class="pic testdrive">
        <a href="http://karpaty-autocenter.com.ua/purchase_finance/supply/" title="Акции и спецпредложения">
            Акции и спецпредложения</a>
    </li>

    <li class="pic configure">
        <a href="http://karpaty-autocenter.com.ua/configurator/" class="cboxConfigure  cboxElement" title="Конфигуратор автомобилей">
            Конфигуратор автомобилей                </a>
    </li>

    <li style="background-image:url(http://karpaty-autocenter.com.ua/img/menu/table_auto-b.png)">
        <a href="/company/novosti/" class="right_menu_link" title="Новости">
            Новости                </a>
    </li>
    <li style="background-image:url(http://karpaty-autocenter.com.ua/img/menu/notebook-b.png)">
        <a target="_blank" href="http://karpaty-autocenter.com.ua/book_reviews/" class="right_menu_link" title="Электронная книга отзывов">
            Электронная книга отзывов</a>
    </li>

</ul>



<?
if(!isset($_GET['menu'])){
    echo '<div class="l_content"><img src="../img/'.$_GET['page'].'.jpg" width="940px" />';
    $pr=mysql_query("SELECT * FROM  `accessories` WHERE menu='".$id_menu."' AND glass='0' ORDER BY idd ASC");
    $i=1;
    while($prod=mysql_fetch_array($pr)){
        if($i==5){echo '<div style="clear: both;width: 100%;height: 2px;"></div>';$i=1;}
        echo '<div class="parbase"><a href="/'.$_GET['page'].'/'.$prod['link'].'/"><img src="/photo/volkswagen_img_'.$prod['id'].'.jpg"  width="215"/></a><h4>'.$prod['pmenu'].'</h4><a href="/'.$_GET['page'].'/'.$prod['link'].'/" class="standardLink">Подробнее</a></div>';
        $i++;
    }echo '</div> ';
}else{

    $prd=mysql_fetch_array(mysql_query("SELECT * FROM  `accessories` WHERE link='".$pieces[0]."'"));
    if($prd['type']==0){
        echo '<div class="l_content">'.$prd['text'].'</div>';
    }else{
        echo '<ul class="left_menu">';
        $prs=mysql_query("SELECT * FROM  `accessories_page` WHERE id_arr='".$prd['id']."' AND glass='0' ORDER BY idd DESC");
        if($_GET['menu']=='vw_service'){echo'<li><b><a href="/service/service_calc/"> > Калькулятор ТО</a></b></li><br/>';
            echo'<li><b><a href="/order_online/"> > Поиск и заказ запчастей</a></b></li><br/>';
        }

        while($prods=mysql_fetch_array($prs)){
            echo '<li><a href="/'.$_GET['page'].'/'.$prd['link'].'/'.$prods['link'].'/">'.$prods['name'].'</a></li>'; }

        if($_GET['pmenu']=='kreditnyj_kalkulyator'){
            echo'<p><iframe align="middle" frameborder="0" height="400px" scrolling="no" src="http://calc.nespi.com.ua" width="935px"></iframe></p>';
        }

        echo '</ul> <div class="r_content">';

        if($_GET['pmenu']!=''){

            $tpage=mysql_fetch_array($result=mysql_query("SELECT * FROM accessories_page WHERE id_arr='".$prd['id']."' AND link='".$_GET['pmenu']."' ",$db));
            echo '<h1>'.$tpage['name'].'</h1>'.$tpage['text'];


            if($_GET['pmenu']=='yarmarka_finansirovaniya_ot_djerman_avtocentr'){
                echo '<iframe src="http://volkswagen.odessa.ua/page/form.php?test_drive" width="695px" height="590" scrolling="none" frameborder="0" ></iframe>';
            }



        }else{
            echo '<h1>'.$prd['pmenu'].'</h1>';

            $temp = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM accessories_page WHERE id_arr='".$prd['id']."' AND glass='0' ORDER BY idd DESC"));
            $total = (($temp[0] - 1) / $num) + 1;
            $total = intval($total);$page = intval($page);if(empty($page) or $page < 0){$page = 1;}if($page > $total){$page = $total;}$start = $page * $num - $num;
            $link="/".$_GET['page']."/".$pieces[0]."-";
            if ($page != 1) $pervpage = ' <a href='.$link. ($page - 1) .'/>&laquo;</a> ';if ($page != $total) $nextpage = ' <a href='.$link. ($page + 1) .'/>&raquo;</a> ';if($page - 5 > 0) $page5left = ' <a href='.$link. ($page - 5) .'/>'. ($page - 5) .'</a>  ';if($page - 4 > 0) $page4left = ' <a href='.$link. ($page - 4) .'/>'. ($page - 4) .'</a>  ';if($page - 3 > 0) $page3left = ' <a href='.$link. ($page - 3) .'/>'. ($page - 3) .'</a>  ';if($page - 2 > 0) $page2left = '<a href='.$link. ($page - 2) .'/>'. ($page - 2) .'</a>  ';if($page - 1 > 0) $page1left = ' <a href='.$link. ($page - 1) .'/>'. ($page - 1) .'</a>  ';if($page + 5 <= $total) $page5right = '  <a href='.$link. ($page + 5) .'/>'. ($page + 5) .'</a>';if($page + 4 <= $total) $page4right = '  <a href='.$link. ($page + 4) .'/>'. ($page + 4) .'</a>';if($page + 3 <= $total) $page3right = '  <a href='.$link. ($page + 3) .'/>'. ($page + 3) .'</a>';if($page + 2 <= $total) $page2right = ' <a href='.$link. ($page + 2) .'/>'. ($page + 2) .'</a>';if($page + 1 <= $total) $page1right = '  <a href='.$link. ($page + 1) .'/>'. ($page + 1) .'</a>';
            $result2 = mysql_query("SELECT * FROM accessories_page WHERE id_arr='".$prd['id']."' AND glass='0' ORDER BY idd DESC LIMIT $start, $num ",$db);
            while($pa2=mysql_fetch_array($result2)){
                if(file_exists('./photo/volkswagen_img_'.$pa2['id'].'_.jpg')){$img='/photo/volkswagen_img_'.$pa2['id'].'_.jpg';}else{$img='/img/none.jpg';}
                echo '<div class="artikle"><a href="/'.$_GET['page'].'/'.$prd['link'].'/'.$pa['link'].'/"><img src="'.$img.'" title="'.$pa2['name'].'" alt="'.$pa2['name'].'" width="215"></a><div  class="body"><a href="/'.$_GET['page'].'/'.$prd['link'].'/'.$pa2['link'].'/"><h2>'.$pa2['name'].'</h2></a><p>'.$pa2['d'].'</p><a class="link_c" href="/'.$_GET['page'].'/'.$prd['link'].'/'.$pa2['link'].'/">Подробнее</a></div><div class="cl"></div></div>';
            }
            echo '<div style="border-batton: 1px solid #777;clear: both;height: 30px;"></div>';if ($total > 1){echo "<div class=\"pstrnav\">";echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;echo "</div>";}}

        echo '</div>';
    }}
?>
