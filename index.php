<? error_reporting(E_ERROR | E_PARSE); include 'bd.php';include 'kurs.php';include'component/component.php';include'component/meta.php';?>

<!DOCTYPE html>

<html lang="ru">

  <head>
      <meta charset="utf-8">
      <link href="/css/menu-right.css" rel="stylesheet"/>
      <link rel="shortcut icon" href="/img/favicon.ico"/>


    <title><?= $rez['t'] ?></title>
      <meta property="og:title" content="<?= $rez['t']; ?>" />
      <meta property="og:type" content="article" />
      <meta property="og:url" content="<?= $rez['link']; ?>" />
      <!--<meta property="og:image" content="http://karpaty-autocenter.com.ua/img/logo.jpg" /> -->
      <meta property="og:description" content="<?= $rez['d']; ?>" />
    <meta name="description" content="<?= $rez['d']; ?>"/>
	<meta name="keywords" content="<?= $rez['k']; ?>">

      <link href="/css/style.css" rel="stylesheet"/>
      <link href="/css/normalize.css" rel="stylesheet"/>
    <script type="text/javascript">

    window.jQuery || document.write('<script type="text/javascript" src="/js/jquery.min.js"><\/script>');

    </script>


  </head>

<body>



<?if($_SERVER['REMOTE_ADDR']=='89.209.89.266'){?>

<div class="error_fon">

<div class="error">

    <h1>Проводятся регламентные работы</h1>

    <img src="/img/logo.jpg" alt="Карпати авто центр">

   

</div>

 <?echo $_SERVER['REMOTE_ADDR'];?>

</div>

<?}?>



<div class="container">

<div class="span7"><a href="/"><img src="/img/logo.jpg"  alt="Карпаты АвтоЦентр Черновцы"></a></div>

<div class="span5">

<div class="top">

    <a href="/company/contact/">Контакты</a>

    <a href="/company/o_kom/">О компании</a>
<a href="/site_map/">Карта сайта</a>
    <a href="/">Главная</a>
   <a href="http://volkswagen.cv.ua" target="_blank"><img style="width:20px; height:20px; margin-top:-4px;" src="/img/flag_ua.png" data-toggle="tooltip" alt="Українська"></a>
 
    </div>
    <div class="flag">
<a href="/"><img src="/img/karpaty.png" data-toggle="tooltip" alt="КарпатыАвтоЦентр"></a><br/>
</div>

</div>

<div class="span12">



<div class="main_menu" id="topNav">

  


<div class="first_investment">

<?echo'<a href="/light/" class="first_investment_home">Легковые</a>';?>

<ul class="second_embedding_model"><li class="heder_model">Легковые автомобили</li>

<?     $md=mysql_query("SELECT * FROM  `models` WHERE visible='1' AND WEIGHT='0' ORDER BY idd DESC");
$i=1;
    while($model=mysql_fetch_array($md))
        { 
            if($i>0)
            {
                echo '<li>';
}
    echo '<a href="/models/'.$model['link'].'/"><img src="/photo/model/'.$model['link'].'0.png" alt="'.$model['name'].' Черновцы"><strong>'.$model['name'].'</strong></a></li>';
$i++;
}
?>

<li class="cl" style="margin-top: 16px;"></li></ul></div>



<div class="first_investment">

<a href="/heavy/" class="first_investment_home">Коммерческие</a>

<ul class="second_embedding_model"><li class="heder_model">Коммерческие автомобили</li>

<?
        $md=mysql_query("SELECT * FROM  `models` WHERE visible='1' AND WEIGHT='1' ORDER BY idd DESC");
        $i=1;
        while($model=mysql_fetch_array($md))
            { 
                if($i>0)
                    {
                        echo '<li>';
                    }
                    echo '<a href="/models/'.$model['link'].'/"><img src="/photo/model/'.$model['link'].'0.png" alt="'.$model['name'].' Черновцы"><strong>'.$model['name'].'</strong></a></li>';
                $i++;
                }
                ?>

<li class="cl" style="margin-top: 16px;"></li></ul></div>








<div class="first_investment"><a class="first_investment_home last_l">Автомобили в наличии</a>

<ul class="second_embedding" >

<li><a href="/avto_in_stock/" class="first_investment_home">Новые автомобили</a></li>

<li><a href="/das_weltauto/" class="first_investment_home">Автомобили с пробегом</a></li>
<?

    $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='5' AND glass='0' ORDER BY idd ASC");

    while($prod=mysql_fetch_array($pr)){

        echo ' <li><a href="/salesavto/'.$prod['link'].'/" class="first_investment_home">'.$prod['nmenu'].'</a></li>';

    }

?>

</ul>

</div>



<div class="first_investment"><a href="/purchase_finance/" class="first_investment_home">Спецпредложения</a>

<ul class="second_embedding" >

<?

    $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='0' AND glass='0' ORDER BY idd ASC");

    while($prod=mysql_fetch_array($pr)){

        echo ' <li><a href="/purchase_finance/'.$prod['link'].'/" >'.$prod['nmenu'].'</a></li>';

    }

?>

</ul>



</div>







<div class="first_investment"><a href="/service/" class="first_investment_home">Сервис</a>

<ul class="second_embedding" >

<?

    $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='3' AND glass='0' ORDER BY idd ASC");

    while($prod=mysql_fetch_array($pr)){

        echo ' <li><a href="/service/'.$prod['link'].'/" >'.$prod['nmenu'].'</a></li>';

    }

?>

</ul>



</div>







<div class="first_investment"><a href="/company/" class="first_investment_home">Мир Volkswagen</a> 

<ul class="second_embedding" >

    <?

    $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='4' AND glass='0' ORDER BY idd ASC");

    while($prod=mysql_fetch_array($pr)){

        echo ' <li><a href="/company/'.$prod['link'].'/" >'.$prod['nmenu'].'</a></li>';

    }

?>

</ul> </div>

<div class="first_investment"><?echo '<p style="margin-top:6px;">&nbsp;<strong></strong></p>'; ?></div>





<div class="configurator"><a href="/configurator/"></a></div></div>

</div>

<div class="span12 content">

<?

if(isset($_GET['page']) and $_GET['page']!=''){

switch($_GET['page']){
    case("salesavto"):include 'page/page.php';break;  
    case("models"):include 'page/model.php'; break;
    case("heavy"):include 'page/model.php'; break;
    case("light"):include 'page/model.php'; break;

    case("book_reviews"):include 'page/book_reviews.php';break;
    case("service_calc"):include 'page/serv_calc.php';break;
    case("order_online"):include 'page/order_online.php';break;
    case("callback"):include 'page/callback.php';break;


    case("site_map"): include 'page/site_map.php';break;
    
    case("catalog"):include 'page/catalog.php';break;
    case('purchase_finance'):case("finance"):case("zapchasti"):case("service"):case("company"):include 'page/page.php';
    break;

    case("avto_in_stock"):case("das_weltauto"):case("accessories"):include 'page/stock.php'; break;

    case("configurator"): echo '<div style="widows: 988px;position: relative;"><div  style="height: 800px;overflow: hidden;position: relative;widows: 988px;" ><iframe onload="frame1();" style="margin-top: -90px;margin-left: -3px;" width="988px"  height="800" scrolling="none" frameborder="0" id="hostFrame" src="http://cc.porscheinformatik.com/nwapp/nws_ua/ICC3/VW!uk!!!V!!!/?HDLINT=J&BNR=24320&GRP="></iframe></div></div>';break; 

}

    ?>

 <link href="/css/flexisel.css" rel="stylesheet"/>
    <ul id="flexisel" >
        <?
        $pr1=mysql_query("SELECT * FROM  `ban` WHERE id>0 AND id<6 AND glass='0' ORDER BY idd ASC");

      $i=1;

        while($prod1=mysql_fetch_array($pr1)){

            echo '<li><a href="'.$prod1['link'].'"><img src="/img/rotator/'.$prod1['id'].'.jpg" id="img'.$i.'" rel="'.$i.'" alt="Баннер '.$i.'" /></a></li>';

        $i++;}


        ?> 

    </ul>
    <script type="text/javascript" src="/js/jquery.flexisel.js"></script>

    <script type="text/javascript">

        jQuery(document).ready(function ($) {


            $("#flexisel").flexisel({
                visibleItems: 5,
                animationSpeed: 1000,
                autoPlay: false,
                autoPlaySpeed: 800,
                pauseOnHover: true,
                enableResponsiveBreakpoints: true,
                responsiveBreakpoints: {
                    portrait: {
                        changePoint:480,
                        visibleItems: 1
                    },
                    landscape: {
                        changePoint:640,
                        visibleItems: 2
                    },
                    tablet: {
                        changePoint:768,
                        visibleItems: 3
                    }
                }
            });



        });
    </script>
    <?
}else{



?>

<!--div id="top_ban">Регистрация на<br />

Ярмарку Финансирования</div-->



<div class="fasebook"><div class="divs">

<p><a href="http://www.odnoklassniki.ru/profile/532410973270" target="_blank"><img src="/img/34360e.png" alt="Карпаты АвтоЦентр в Одноклассниках">odnoklassniki.ru</a></p>

<p><a href="http://vk.com/id_karpaty_autocenter" target="_blank"><img src="/img/Logo_Vkontake.png" alt="Карпаты АвтоЦентр ВКонтакте">vkontakte.ru</a></p>



</div></div>



<div class="rotator" id="rotator"></div>
<ul class="services-menu" style="list-style:none;">
                            <li class="pic service">
                <a href="http://karpaty-autocenter.com.ua/service/zapis_to/" title="Сервис ">
                    Запись на сервис                 </a>
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
<div id="rkl">

<?

     $pr0=mysql_query("SELECT * FROM  `ban` WHERE id>0 AND id<6 AND glass='0' ORDER BY idd ASC");

      $i=1;

        while($prod0=mysql_fetch_array($pr0)){

            echo '<a href="'.$prod0['link'].'"><img src="img/rotator/'.$prod0['id'].'.jpg" id="img'.$i.'"  alt="Рекламма '.$i.'" /></a>';

        $i++;}

     

     ?>

</div>



<?}?>
  
</div>

<div class="span12" style="color: #666;margin-top: 10px;font-size: 11px;">


   

<span style="float: right;">"КарпатыАвтоцентр" | г. Черновцы, ул.Энергетическая 2 В | +38 (0372) 543-888, +38 (050) 374-40-08, +38 (067) 373-57-00 

</span>

<div style="display: none">


<!-- HotLog -->
<!-- /HotLog -->

</div>



<!-- siteheart -->

<script type="text/javascript"> _shcp = []; _shcp.push({widget_id : 543011, widget : "Chat"}); (function() { var hcc = document.createElement("script"); hcc.type = "text/javascript"; hcc.async = true; hcc.src = ("https:" == document.location.protocol ? "https" : "http")+"://widget.siteheart.com/apps/js/sh.js"; var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(hcc, s.nextSibling); })();</script>

<!--/siteheart -->



 <!-- google_analytics -->

 <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-38712192-1', 'karpaty-autocenter.com.ua');
  ga('send', 'pageview');

</script>
<!--/google_analytics -->



<ul class="social-likes" data-title="Карпаты Автоцентр">

    <li class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</li>

	<li class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</li>

    <li class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</li>

	<li class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</li>

	<li class="mailru" title="Поделиться ссылкой в Моём мире">Мой мир</li>

	<li class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</li>
<!-- Yandex.Metrika informer -->
<a href="https://metrika.yandex.ru/stat/?id=26914833&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/26914833/3_1_FFFFFFFF_EFEFEFFF_0_pageviews"
style="position:relative; width:88px; height:31px; border:0; top:10px;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:26914833,lang:'ru'});return false}catch(e){}"/></a>
<!-- /Yandex.Metrika informer -->
</ul>





</div>



<div class="cl"></div>





<?if(!isset($_GET['page'])){

    

    

    

    

    

    

    

    ?>
<div class="seo-text-show-2"></div>
<script type="text/javascript">
   $(document).ready(function() {
        $('.seo-text-show-2').on("click", function() {
            $('#seo-text').slideToggle("fast");
        });
    });
</script>
<div id="seo-text" style="display:none;">

<h1>«КарпатыАвтоцентр» - официальный дилер Volkswagen</h1>
<div style="font-size: 11px;">
<p>Автомобили известного на весь мир автогиганта Volkswagen, который является родоначальником крупнейшего мирового конгломерата, такого как автоконцерн Volkswagen Group на сегодняшний день пользуются очень большой популярностью на всех мировых рынках. Автомобили Фольксваген ценят, прежде всего, за высокие инженерные и технологические инновации. VW – это не только отличная и комфортабельная машина. Это нечто большее. Огромное количество различных инновационных решений в сумме дает великолепный результат. При этом цена Фольксваген, хоть и являются довольно высокими – все равно ощутимо ниже того уровня качества и комфорта, которое предлагает компания. Гибкая ценовая и маркетинговая политика позволяет купить новый Фольксваген в кредит или же приобрести его в лизинг, не смотря на то какую именно модель Вы выберете, будь то Поло седан, Тигуан, Туарег или Амарок. </p>
<p>Предмет особой гордости работников немецкой компании - новый <a href="http://karpaty-autocenter.com.ua/models/new_passat_b8/" title="новый Фольксваген Пассат B 8"><span>Volkswagen Passat</span></a> который впитал в себя все лучшие черты, которые только были у всех предыдущих поколений автомобилей этой марки. Фольксваген Пассат – это не только отличный автомобиль для повседневного использования. Слава, идущая впереди него, позволяет использовать VW Passat и в качестве представительского автомобиля, для ведения бизнеса. </p>
<p>Компания КарпатыАвтоцентр исповедует исключительный клиенто-ориентированный подход, а поэтому мы установили планку по уровню обслуживания наших посетителей на уровне лучших стандартов Volkswagen Group. Вы можете быть полностью уверенными - официальный дилер Фольксваген – автосалон «КарпатыАвтоцентр» не только сможет предложить вам абсолютно весь спектр услуг по продаже и сервисному обслуживанию автомобилей Volkswagen, но и сделает это так, как будто Вы обратились непосредственно в головной офис компании Фольксваген. Официальный сервис Фольксваген всегда на высоте.</p>
<p>Следует всегда помнить о том, что только официальный дилер сможет предложить вам уровень обслуживания, который не только придётся вам по вкусу, но и обезопасит от абсолютно всех неприятностей и шероховатостей, которые могут возникнуть на этапе выбора и покупки автомобиля. Если вы хотите купить новый Фольксваген – тогда незамедлительно обращайтесь к нам. Ведь только у нас цены Фольксваген находятся на самом низком уровне, при фантастически высоком качестве обслуживания, а частые акции Фольксваген помогут купить новый автомобиль со скидкой.</p>
<p>В автосалоне «КарпатыАвтоцентр» вы можете подобрать и купить новый Фольксваген - <a href="http://karpaty-autocenter.com.ua/models/touareg/" title="Volkswagen Touareg"><span>Touareg</span></a>, <a href="http://karpaty-autocenter.com.ua/models/tiguan/" title="Volkswagen Tiguan"><span>Tiguan</span></a>, <a href="http://karpaty-autocenter.com.ua/models/volkswagen_cc/" title="Volkswagen Passat CC"><span>Passat CC</span></a>, <a href="http://karpaty-autocenter.com.ua/models/passat_variant/" title="Volkswagen Passat Variant"><span>Passat Variant</span></a>, <a href="http://karpaty-autocenter.com.ua/models/polo_new/" title="Volkswagen Polo"><span>Polo</span></a>, <a href="http://karpaty-autocenter.com.ua/models/polo_sedan/" title="Volkswagen Polo Sedan"><span>Polo Sedan</span></a>, <a href="http://karpaty-autocenter.com.ua/models/new_golf/" title="Volkswagen Golf 7"><span>Golf 7</span></a>, <a href="http://karpaty-autocenter.com.ua/models/touran/" title="Volkswagen Touran"><span>Touran</span></a>, <a href="http://karpaty-autocenter.com.ua/models/transporter_kombi/" title="Volkswagen Transporter"><span>Transporter</span></a>, <a href="http://karpaty-autocenter.com.ua/models/amarok/" title="Volkswagen Amarokg"><span>Amarok</span></a>, <a href="http://karpaty-autocenter.com.ua/models/caddy_kombi/" title="Volkswagen Caddy"><span>Caddy</span></a>, <a href="http://karpaty-autocenter.com.ua/models/crafter/" title="Volkswagen Crafter"><span>Crafter</span></a>, <a href="http://karpaty-autocenter.com.ua/models/caravelle/" title="Volkswagen Caravelle"><span>Caravelle</span></a>, <a href="http://karpaty-autocenter.com.ua/models/multivan/" title="Volkswagen Multivan"><span>Multivan</span></a>, а также другие популярные модели. </p>
<p>Также мы можем предложить вам автокредит, автомобили в лизинг, trade-in (трейд-ин) - обмен старого автомобиля на новый с доплатой, страховку, автосервис. Наше СТО (автосервис для Volkswagen, Skoda, Audi, Seat) предлагает высококачественную диагностику и оригинальные запчасти Фольксваген, кузовные работы и автомойку. </p>

<p>Контакты "КарпатыАвтоцентр": 58007, г. Черновцы, ул.Энергетическая 2 В Многоканальный контактный телефон:</p>

<p>тел.:+38 (0372) 543-888</p>

<p>Режим работы:</p>

<p>ПН - СБ 9:00- 18:00</p>

<p>ВС 9.00 - 15.00</p>
</div>
</div>
<a href="https://plus.google.com/105543712468143741573/?rel=author"> КарпатыАвтоцентр г.Черновцы </a>
<?}?>


</div>





<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->

<!--[if lt IE 9]>

<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="/js/social-likes.min.js"></script>


<?if(isset($_GET['page']) and $_GET['page']=='heavy'){?>


    <script type="text/javascript" src="/js/lib.min.js"></script>

    <script type="text/javascript" src="/js/ru.js_config.js"></script>

    <script type="text/javascript" src="/js/app.project.min.js"></script>

    <script type="text/javascript" src="/js/app.documentready.min.js"></script>

<?}?>

<?if(isset($_GET['page']) and $_GET['page']=='light'){?>


    <script type="text/javascript" src="/js/lib.min.js"></script>

    <script type="text/javascript" src="/js/ru.js_config.js"></script>

    <script type="text/javascript" src="/js/app.project.min.js"></script>

    <script type="text/javascript" src="/js/app.documentready.min.js"></script>

<?}?>

<?if(isset($_GET['page']) and $_GET['page']=='models'){?>


    <script type="text/javascript" src="/js/lib.min.js"></script>

    <script type="text/javascript" src="/js/ru.js_config.js"></script>

    <script type="text/javascript" src="/js/app.project.min.js"></script>

    <script type="text/javascript" src="/js/app.documentready.min.js"></script>

<?}?>

<script src="/js/fons.js" type="text/javascript"></script>

<script src="/js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/social-share.js"></script>


<script type="text/javascript" src="/js/jquery.rotator.js"></script>

<script>

    (function($){

        $('#rotator').rotator({fx:'slide',autorun: true, nav: true,random: false, slides: [

            <? $pr=mysql_query("SELECT * FROM  `ban` WHERE id>5 AND glass='0' ORDER BY idd ASC");while($prod=mysql_fetch_array($pr)){echo "{url:'".$prod['link']."',img:'img/rotator/avto_".$prod['id'].".jpg'},";}?>]});

    })(jQuery);

</script>
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter26914833 = new Ya.Metrika({id:26914833,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/26914833" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->



<!-- Yandex.Metrika counter -->

</body>

</html>