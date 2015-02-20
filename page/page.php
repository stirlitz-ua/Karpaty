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
	case("novosti"): $hed="";$id_menu='4'; break;
      case('salesavto'): $hed="";$id_menu='5'; break;
        case('deals'): $hed="Спецпредложения";$id_menu='0'; break;
        case('finance'): $hed="Финансы";$id_menu='1'; break;
        case('zapchasti'): $hed="Запчасти";$id_menu='2'; break;
        case('service'): $hed="Сервис";$id_menu='3'; break;
        case('zapis_to'): $hed="Запись на ТО";$id_menu='7';break;
    case('service_calc'): $hed="Калькулятор ТО";$id_menu='8';break;
        case('company'): $hed="Мир Volkswagen";$id_menu='4';break;
case('rossilka'): $hed="testest";$id_menu='6';break;

    }


?>

<?
while($prod=mysql_fetch_array($pr)){
echo'<meta property="og:image" content="http://photo/volkswagen_img_'.$prod['id'].'.jpg" />';
}

?>

<meta property="og:description" content="<?= $rez['d']; ?>" />
<div class="heder_page"><a class="heder_page_name" href="/<?echo $_GET['page'];?>/"><?echo $hed;?></a>
<ul>    
<?
$pr=mysql_query("SELECT * FROM  `arr` WHERE `menu`='".$id_menu."' AND `glass`='0' ORDER BY `idd` ASC");
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
                <li style="background-image:url(http://karpaty-autocenter.com.ua/img/menu/cabinet-b.png)">
                <a href="/user.html" class="right_menu_link" title="Личный кабинет">
                    Личный кабинет                </a>
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
 $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='".$id_menu."' AND glass='0' ORDER BY idd ASC");
    $i=1;
    while($prod=mysql_fetch_array($pr)){
        if($i==5){echo '<div style="clear: both;width: 100%;height: 2px;"></div>';$i=1;}
    echo '<div class="parbase"><a href="/'.$_GET['page'].'/'.$prod['link'].'/"><img src="/photo/volkswagen_img_'.$prod['id'].'.jpg"  width="215"/></a><h4>'.$prod['pmenu'].'</h4><a href="/'.$_GET['page'].'/'.$prod['link'].'/" class="standardLink">Подробнее</a></div>';
    $i++;

}echo '</div> ';
}
if ($_GET['menu']=='dop') {
    
    echo '<div class="l_content"><img src="../img/'.$_GET['page'].'.jpg" width="940px" />';
    $pr=mysql_query("SELECT * FROM  `accessories` WHERE menu='".$id_menu."' AND glass='0' ORDER BY idd ASC");
    $i=1;
    while($prod=mysql_fetch_array($pr)){
        if($i==5 ){echo '<div style="clear: both;width: 100%;height: 2px;"></div>';$i=1;}
        echo '<div class="parbase"><a href="/'.$_GET['page'].'/'.$prod['link'].'/"><img src="/photo/volkswagen_img_'.$prod['id'].'.jpg"  width="215"/></a><h4>'.$prod['pmenu'].'</h4><a href="/'.$_GET['page'].'/'.$prod['link'].'/" class="standardLink">Подробнее</a></div>';
        $i++;
    }echo '</div> ';

}
if($_GET['menu']=='aksessuary'){
    ?>
<script language="javascript" type="text/javascript">
    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
    }
</script>

<?php
    echo '<iframe src="/accessories/cat.php" width="955px"  scrolling="no" frameborder="0" onload="javascript:resizeIframe(this);" />';
}

if($_GET['menu']=='not_original'){
    ?>
    <p align="center"><img alt="Автозапчасти volkswagen фото" src="/photo/images/volkswagen_13(2).jpg" style="width: 685px; height: 354px;" /></p>

    <script language="javascript" type="text/javascript">
        function resizeIframe(obj) {
            obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
        }
    </script>
    <?php
    echo '<iframe src="/accessories/index-select.php" width="595px"  height="700px" scrolling="auto" frameborder="0"  style="margin-left: 350px;" onload="javascript:resizeIframe(this); />'; ?>

                <?php
}
else{
?>
    <script type="text/javascript">(function() {
            if (window.pluso)if (typeof window.pluso.start == "function") return;
            if (window.ifpluso==undefined) { window.ifpluso = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                var h=d[g]('body')[0];
                h.appendChild(s);
            }})();</script>
<?
    $prd=mysql_fetch_array(mysql_query("SELECT * FROM  `arr` WHERE link='".$pieces[0]."'"));
    if($prd['type']==0){
        echo '<div class="l_content">'.$prd['text'].'</div>';
        echo'<h2 style="margin-left:5%">Поделиться статьей c друзьями:</h2>
<div class="pluso" style="left:5%; margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';


    }else{
        echo '<ul class="left_menu">';
                $prs=mysql_query("SELECT * FROM  `arr_page` WHERE id_arr='".$prd['id']."' AND glass='0' ORDER BY idd DESC");
        if($_GET['menu']=='vw_service'){echo'<li><b><a href="/service/service_calc/"> > Калькулятор ТО</a></b></li><br/>';
            echo'<li><b><a href="/order_online/"> > Поиск и заказ запчастей</a></b></li><br/>';
        }
        if($_GET['menu']=='avtozapchasti'){echo'<li><b><a href="/service/service_calc/"> > Калькулятор ТО</a></b></li><br/>';
            echo'<li><b><a href="/order_online/"> > Поиск и заказ запчастей</a></b></li><br/>
           
<div class="seo-text-show"></div>';
     
}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.seo-text-show').on("click", function() {
            $('#seo-text').slideToggle("fast");
        });
    });
</script>   
<?
        while($prods=mysql_fetch_array($prs)){
                echo '<li><a href="/'.$_GET['page'].'/'.$prd['link'].'/'.$prods['link'].'/">'.$prods['name'].'</a></li>'; }

        if($_GET['pmenu']=='kreditnyj_kalkulyator'){
           echo'<p><iframe align="middle" frameborder="0" height="400px" scrolling="no" src="http://calc.nespi.com.ua" width="935px"></iframe></p>';
            }

        echo '</ul> <div class="r_content">';
        if($_GET['menu']=='avtozapchasti'){echo '<div id="seo-text" style="display: none;"><p class="MsoNormal" style="text-align: center"><strong>ЗАПАСНЫЕ ЧАСТИ&nbsp;</strong></p>

<p>Компания «КарпатыАвтоцентр» предлагает как оригинальные, так и неоригинальные&nbsp;&nbsp;запчасти&nbsp;на автомобили Volkswagen Group (Volkswagen, Skoda, Audi, Seat, Porsche).</p>

<p><span style="line-height: 1.6em;">Приобретенные у нас оригинальные запчасти Volkswagen протестированы и сертифицированы заводом-изготовителем концерна Volkswagen AG, который своей серьезной репутацией выступает гарантом качества и надежности.&nbsp;</span><span style="line-height: 1.6em;">Ассортимент&nbsp; запчастей VW (более 10 000 наименований) регламентируется специальными компьютерными программами (электронный каталог ЕТКА) и постоянно обновляется по согласованию с заводом-изготовителем.</span></p>

<p><strong>Гарантийный срок</strong> от завода-изготовителя – 24 месяца со дня установки товара с выдачей соответствующих документов.</p>

<p>На складе сервисного центра компании «КарпатыАвтоцентр» – <strong>свыше 5.000 наименований</strong> товара.<br>
<br>
<strong>Возврат</strong> не использованных запчастей – в течение 14 дней со дня покупки при сохранении первоначального вида товара.</p>

<p>В случае отсутствия необходимого наименования на складе, производится <strong>заказ на центральный склад</strong> Volkswagen AG в Германии и доставка на Украину в кратчайшие сроки, обращайтесь в <a href="http://karpaty-autocenter.com.ua/zapchasti/order/">отдел продажи запчастей ООО «КарпатыАвтоцентр»</a></p>

<p><strong>Мы предлагаем:</strong></p>

<table border="0" cellpadding="1" cellspacing="1" style="width: 680px;">
    <tbody>
        <tr>
            <td>
            <h1><a href="http://karpaty-autocenter.com.ua/service/not_original/"><strong><strong style="font-size: 16px; line-height: 1.2em;"><img alt="Неоригинальные запчасти vw" src="http://karpaty-autocenter.com.ua/photo/images/18(2).jpg" style="opacity: 0.9; float: left; width: 315px; height: 183px;"></strong></strong></a></h1>
            <span style="font-family:arial,helvetica,sans-serif;"><span style="font-size:14px;"><strong style="font-size: 16px; line-height: 1.2em;"><a href="http://karpaty-autocenter.com.ua/service/not_original/"><span style="color:#FF0000;">Неоригинальные запчасти&nbsp;</span></a></strong></span></span></td>
            <td>
            <h1><a href="http://karpaty-autocenter.com.ua/service/vw_service/"><img alt="Оригинальные запчасти vw" src="http://karpaty-autocenter.com.ua/photo/images/vw.JPG" style="opacity: 0.9; float: right; width: 315px; height: 183px;"></a></h1>

            <h1><span style="font-family:arial,helvetica,sans-serif;"><span style="font-size: 14px;"><strong style="font-size: 16px; line-height: 1.2em;"><a href="http://karpaty-autocenter.com.ua/service/vw_service/"><span style="color:#FF0000;"><cufon class="cufon cufon-canvas" alt="Оригинальные " style="width: 116px; height: 16px;"><canvas width="130" height="21" style="width: 130px; height: 21px; top: -4px; left: -1px;"></canvas><cufontext>Оригинальные </cufontext></cufon><cufon class="cufon cufon-canvas" alt="запчасти&nbsp;" style="width: 71px; height: 16px;"><canvas width="85" height="21" style="width: 85px; height: 21px; top: -4px; left: -1px;"></canvas><cufontext>запчасти&nbsp;</cufontext></cufon></span></a></strong></span></span></h1>
            </td>
        </tr>
    </tbody>
</table>

<table border="0" cellpadding="1" cellspacing="1" style="width: 700px; ">
</table>

<p><a href="https://plus.google.com/105543712468143741573/?rel=author">КарпатыАвтоцентр г. Черновцы</a></p>

</div>';}            
?>
        <script type="text/javascript">(function() {
                if (window.pluso)if (typeof window.pluso.start == "function") return;
                if (window.ifpluso==undefined) { window.ifpluso = 1;
                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                    var h=d[g]('body')[0];
                    h.appendChild(s);
                }})();</script>
        <?
        if($_GET['pmenu']!=''){
        	
            $tpage=mysql_fetch_array($result=mysql_query("SELECT * FROM arr_page WHERE id_arr='".$prd['id']."' AND link='".$_GET['pmenu']."' ",$db));
            echo '<h1>'.$tpage['name'].'</h1>'.$tpage['text'];

                echo'<h2 style="">Поделиться статьей c друзьями:</h2>
<div class="pluso" style="margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';


            if($_GET['pmenu']=='yarmarka_finansirovaniya_ot_djerman_avtocentr'){
                echo '<iframe src="http://volkswagen.odessa.ua/page/form.php?test_drive" width="695px" height="590" scrolling="none" frameborder="0" ></iframe>';
            }


        }else{
            echo '<h1>'.$prd['pmenu'].'</h1>';
            if($_GET['menu']=='novosti'){echo'<b><a href="/company/rossilka/">Подписаться на рассылку новостей</a></b><br/>';}
            if($_GET['menu']=='supply'){echo'<b><a href="/company/rossilka/" style="font-size: 14px; color:red;">Подписаться на рассылку акций, спецпредложений и новостей</a></b><br/>';}
            if($_GET['menu']=='vw_service'){echo'<b><a href="/service/zapis_to/">Записаться на ТО</a></b><br/>';}
        
  
            $temp = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM arr_page WHERE id_arr='".$prd['id']."' AND glass='0' ORDER BY idd DESC"));
            $total = (($temp[0] - 1) / $num) + 1;
            $total = intval($total);$page = intval($page);if(empty($page) or $page < 0){$page = 1;}if($page > $total){$page = $total;}$start = $page * $num - $num;
            $link="/".$_GET['page']."/".$pieces[0]."-";
            if ($page != 1) $pervpage = ' <a href='.$link. ($page - 1) .'/>&laquo;</a> ';if ($page != $total) $nextpage = ' <a href='.$link. ($page + 1) .'/>&raquo;</a> ';if($page - 5 > 0) $page5left = ' <a href='.$link. ($page - 5) .'/>'. ($page - 5) .'</a>  ';if($page - 4 > 0) $page4left = ' <a href='.$link. ($page - 4) .'/>'. ($page - 4) .'</a>  ';if($page - 3 > 0) $page3left = ' <a href='.$link. ($page - 3) .'/>'. ($page - 3) .'</a>  ';if($page - 2 > 0) $page2left = '<a href='.$link. ($page - 2) .'/>'. ($page - 2) .'</a>  ';if($page - 1 > 0) $page1left = ' <a href='.$link. ($page - 1) .'/>'. ($page - 1) .'</a>  ';if($page + 5 <= $total) $page5right = '  <a href='.$link. ($page + 5) .'/>'. ($page + 5) .'</a>';if($page + 4 <= $total) $page4right = '  <a href='.$link. ($page + 4) .'/>'. ($page + 4) .'</a>';if($page + 3 <= $total) $page3right = '  <a href='.$link. ($page + 3) .'/>'. ($page + 3) .'</a>';if($page + 2 <= $total) $page2right = ' <a href='.$link. ($page + 2) .'/>'. ($page + 2) .'</a>';if($page + 1 <= $total) $page1right = '  <a href='.$link. ($page + 1) .'/>'. ($page + 1) .'</a>';
            $result = mysql_query("SELECT * FROM arr_page WHERE id_arr='".$prd['id']."' AND glass='0' ORDER BY idd DESC LIMIT $start, $num ",$db);
            while($pa=mysql_fetch_array($result)){
                if(file_exists('./photo/volkswagen_img_'.$pa['id'].'_.jpg')){$img='/photo/volkswagen_img_'.$pa['id'].'_.jpg';}else{$img='/img/none.jpg';}
                    echo '<div class="artikle"><a href="/'.$_GET['page'].'/'.$prd['link'].'/'.$pa['link'].'/"><img src="'.$img.'" title="'.$pa['name'].'" alt="'.$pa['name'].'" width="215"></a><div  class="body"><a href="/'.$_GET['page'].'/'.$prd['link'].'/'.$pa['link'].'/"><h2>'.$pa['name'].'</h2></a><p>'.$pa['d'].'</p><a class="link_c" href="/'.$_GET['page'].'/'.$prd['link'].'/'.$pa['link'].'/">Подробнее</a></div><div class="cl"></div></div>';
            }
echo '<div style="border-batton: 1px solid #777;clear: both;height: 30px;"></div>';if ($total > 1){echo "<div class=\"pstrnav\">";echo $pervpage.$page5left.$page4left.$page3left.$page2left.$page1left.'<b>'.$page.'</b>'.$page1right.$page2right.$page3right.$page4right.$page5right.$nextpage;echo "</div>";}}

        echo '</div>';
}}
?>
