<?include 'bd.php';include 'component/component.php';?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <title></title>
    <meta name="description" content=""/>
    <link href="/css/style.css" rel="stylesheet"/>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="/img/favicon.ico"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    window.jQuery || document.write('<script type="text/javascript" src="/js/jquery.min.js"><\/script>');
    </script>
    <script src="/js/social-likes.min.js"></script>

<?if(isset($_GET['page']) and $_GET['page']=='models'){?>  
    
    <script type="text/javascript" src="/js/lib.min.js"></script>
    <script type="text/javascript" src="/js/ru.js_config.js"></script>
    <script type="text/javascript" src="/js/app.project.min.js"></script>
    <script type="text/javascript" src="/js/app.documentready.min.js"></script>
<?}?>    

<script src="/js/fons.js" type="text/javascript"></script>
<script src="/js/script.js" type="text/javascript"></script>
    
    
  </head>
<body>

<?if($_SERVER['REMOTE_ADDR']=='89.209.89.266'){?>
<div class="error_fon">
<div class="error">
    <h1>Проводятся регламентные работы</h1>
    <img src="/img/logo.jpg" />
   
</div>
 <?echo $_SERVER['REMOTE_ADDR'];?>
</div>
<?}?>

<div class="container">
<div class="span7"><a href="/" ><img src="/img/logo.jpg"  /></div></a>
<div class="span5">
<div class="top">
    <a href="/company/contact/">Контакты</a>
    <a href="/company/o_kom/">О компании</a>
    <a href="/">Главная</a>
</div>
</div>
<div class="span12">

<div class="main_menu" id="topNav">
  
<li class="first_investment">
<a href="/models/" class="first_investment_home">Легковые</a>
<ul class="second_embedding_model"><li class="heder_model">Легковые автомобили</li>
<?$ms=mysql_query("SELECT * FROM  `set_models` WHERE id='4' OR id='5' OR id='6' OR id='7' OR id='8' OR id='9'  OR id='19' ORDER BY idd DESC", $db);while($mset=mysql_fetch_array($ms)){ echo '<li style="margin-left: 5px;"><span class="heder_model_s">'.$mset['name'].'</span>';$md=mysql_query("SELECT * FROM  `models` WHERE categiry='".$mset['link']."'");$i=0;while($model=mysql_fetch_array($md)){ if($i>0){echo '<li>';}echo '<a href="/models/'.$model['link'].'/"><img src="/photo/model/'.$model['link'].'0.png"/><strong>'.$model['name'].'</strong></a></li>';$i++;}}?>
<li class="cl" style="margin-top: 16px;"></li></ul></li>

<li class="first_investment">
<a href="/models/" class="first_investment_home">Комерческие</a>
<ul class="second_embedding_model"><li class="heder_model">Комерческие автомобили</li>
<?$ms=mysql_query("SELECT * FROM  `set_models` WHERE id='16' OR id='17' OR id='18' ORDER BY idd DESC", $db);while($mset=mysql_fetch_array($ms)){ echo '<li style="margin-left: 5px;"><span class="heder_model_s">'.$mset['name'].'</span>';$md=mysql_query("SELECT * FROM  `models` WHERE categiry='".$mset['link']."'");$i=0;while($model=mysql_fetch_array($md)){ if($i>0){echo '<li>';}echo '<a href="/models/'.$model['link'].'/"><img src="/photo/model/'.$model['link'].'0.png"/><strong>'.$model['name'].'</strong></a></li>';$i++;}}?>
<li class="cl" style="margin-top: 16px;"></li></ul></li>


<li class="first_investment"><a class="first_investment_home last_l">Автомобили в наличии</a>
<ul class="second_embedding" >
<li><a href="/avto_in_stock/" class="first_investment_home">Новые автомобили</a></li>
<li><a href="/das_weltauto/" class="first_investment_home">Автомобили с пробегом</a></li>
</ul>
</li>

<li class="first_investment"><a href="/purchase_finance/" class="first_investment_home">Спецпредложения</a>
<ul class="second_embedding" >
<?
    $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='0' AND glass='0' ORDER BY idd ASC");
    while($prod=mysql_fetch_array($pr)){
        echo ' <li><a href="/purchase_finance/'.$prod['link'].'/" >'.$prod['nmenu'].'</a></li>';
    }
?>
</ul>

</li>



<li class="first_investment"><a href="/service/" class="first_investment_home">Сервис</a>
<ul class="second_embedding" >
<?
    $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='3' AND glass='0' ORDER BY idd ASC");
    while($prod=mysql_fetch_array($pr)){
        echo ' <li><a href="/service/'.$prod['link'].'/" >'.$prod['nmenu'].'</a></li>';
    }
?>
</ul>

</li>



<li class="first_investment"><a href="/company/" class="first_investment_home">Мир Volkswagen</a>
<ul class="second_embedding" >
    <?
    $pr=mysql_query("SELECT * FROM  `arr` WHERE menu='4' AND glass='0' ORDER BY idd ASC");
    while($prod=mysql_fetch_array($pr)){
        echo ' <li><a href="/company/'.$prod['link'].'/" >'.$prod['nmenu'].'</a></li>';
    }
?>
</ul></li>


<li class="configurator"><a href="/configurator/"></a></li></div>
</div>
<div class="span12 content">
<?
if(isset($_GET['page']) and $_GET['page']!=''){
switch($_GET['page']){
    case("models"):include 'page/model.php';break; 
    case("book_reviews"):include 'page/book_reviews.php';break; 
    
    case('purchase_finance'):case("finance"):case("zapchasti"):case("service"):case("company"):include 'page/page.php';break;  
    case("avto_in_stock"):case("das_weltauto"):include 'page/stock.php'; break; 
    case("configurator"): echo '<div style="widows: 988px;position: relative;"><div  style="height: 800px;overflow: hidden;position: relative;widows: 988px;" ><iframe onload="frame1();" style="margin-top: -90px;margin-left: -3px;" width="988px"  height="800" scrolling="none" frameborder="0" id="hostFrame" src="http://cc.porscheinformatik.com/nwapp/nws_ua/ICC3/VW!uk!!!V!!!/cc3.htm?APP=&MGN="></iframe></div></div>';break; 
}
}else{

?>
<!--div id="top_ban">Регистрация на<br />
Ярмарку Финансирования</div-->

<div class="fasebook"><div class="divs">
<p><a href="http://www.odnoklassniki.ru/group/51715330605142" target="_blank"><img src="/img/34360e.png" />odnoklassniki.ru</a></p>
<p><a href="http://vk.com/id_karpaty_autocenter" target="_blank"><img src="/img/Logo_Vkontake.png" />vkontakte.ru</a></p>

</div></div>

<div class="rotator" id="rotator"></div>
<div id="rkl">
<?
     $pr0=mysql_query("SELECT * FROM  `ban` WHERE id>0 AND id<6 AND glass='0' ORDER BY idd ASC");
      $i=1;
        while($prod0=mysql_fetch_array($pr0)){
            echo '<a href="'.$prod0['link'].'"><img src="img/rotator/'.$prod0['id'].'.jpg" id="img'.$i.'" rel="'.$i.'" /></a>';
        $i++;}
     
     ?>
</div>




     <script type="text/javascript" src="/js/jquery.rotator.js"></script>
     <script>
     (function($){
     $('#rotator').rotator({fx:'slide',autorun: true, nav: true,random: false, slides: [
     <? $pr=mysql_query("SELECT * FROM  `ban` WHERE id>5 AND glass='0' ORDER BY idd ASC");while($prod=mysql_fetch_array($pr)){echo "{url:'".$prod['link']."',img:'img/rotator/avto_".$prod['id'].".jpg'},";}?>]}); 
     })(jQuery); 
     </script>

<?}?>








</div>
<div class="span12" style="color: #666;margin-top: 10px;font-size: 11px;">
<span>*) Изображения на картинках могут отличаться от серийных моделей</span>
<span style="float: right;">ООО "КарпатыАвтоцентр" | г. Черновцы, вул.Энергетическая 2В | +38 (0372) 543-888

    <!--LiveInternet counter--><script type="text/javascript"><!--
document.write("<a href='http://www.liveinternet.ru/click' "+
"target=_blank><img src='//counter.yadro.ru/hit?t44.6;r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random()+
"' alt='' title='LiveInternet' "+
"border='0' width='10' height='10'><\/a>")
//--></script><!--/LiveInternet-->

</span>


<div style="display: none">
<!-- HotLog -->
<script type="text/javascript">
hotlog_r=""+Math.random()+"&amp;s=2178227&amp;im=68&amp;r="+
escape(document.referrer)+"&amp;pg="+escape(window.location.href);
hotlog_r+="&amp;j="+(navigator.javaEnabled()?"Y":"N");
hotlog_r+="&amp;wh="+screen.width+"x"+screen.height+"&amp;px="+
(((navigator.appName.substring(0,3)=="Mic"))?screen.colorDepth:screen.pixelDepth);
hotlog_r+="&amp;js=1.3";
document.write('<a href="http://click.hotlog.ru/?2178227" target="_blank"><img '+
'src="http://hit10.hotlog.ru/cgi-bin/hotlog/count?'+
hotlog_r+'" border="0" width="88" height="31" alt="HotLog"><\/a>');
</script>
<noscript>
<a href="http://click.hotlog.ru/?2178227" target="_blank"><img
src="http://hit10.hotlog.ru/cgi-bin/hotlog/count?s=2178227&amp;im=68" border="0"
width="88" height="31" alt="HotLog"></a>
</noscript>
<!-- /HotLog -->
</div>

 <!-- google_analytics -->
 <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38712192-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!--/google_analytics -->

<ul class="social-likes" data-title="Карпаты Автоцентр">
    <li class="plusone" title="Поделиться ссылкой в Гугл-плюсе">Google+</li>
	<li class="facebook" title="Поделиться ссылкой на Фейсбуке">Facebook</li>
    <li class="vkontakte" title="Поделиться ссылкой во Вконтакте">Вконтакте</li>
	<li class="twitter" title="Поделиться ссылкой в Твиттере">Twitter</li>
	<li class="mailru" title="Поделиться ссылкой в Моём мире">Мой мир</li>
	<li class="odnoklassniki" title="Поделиться ссылкой в Одноклассниках">Одноклассники</li>
    <li class="livejournal" title="Поделиться ссылкой в ЖЖ">LiveJournal</li>
</ul>


</div>

<div class="cl"></div>


<?if(!isset($_GET['page'])){
    
    
    
    
    
    
    
    ?>
<div style="color: #B2B2B2;">
<p>  Автомобили известного на весь мир автогиганта Volkswagen, который является родоначальником крупнейшего мирового конгломерата, такого как автоконцерн Volkswagen Group на сегодняшний день пользуются очень большой популярностью на всех мировых рынках. Фольксваген ценят, прежде всего, за высокие инженерные и технологические инновации. Volkswagen – это не только отличная и комфортабельная машина. Это нечто большее. Огромное количество различных инновационных решений в сумме дает великолепный результат. При этом цены на Volkswagen, хоть и являются довольно высокими – все равно ощутимо ниже того уровня качества и комфорта, которое предлагает компания. Гибкая ценовая и маркетинговая политика позволяет купить Volkswagen в кредит или же приобрести его в лизинг, как для коммерческих так и для легковых групп автомобилей.</p>
<p>  Предмет особой гордости работников немецкой компании - новый Volkswagen Passat который впитал в себя все лучшие черты, которые только были у всех предыдущих поколений автомобилей этой марки. Фольксваген Пассат – это не только отличный автомобиль для повседневного использования. Слава, идущая впереди него, позволяет использовать VW Passat и в качестве представительского автомобиля, для ведения бизнеса.</p>
<p>  Наша компания исповедует исключительный клиенто-ориентированный подход, а поэтому мы установили планку по уровню обслуживания наших посетителей на уровне лучших стандартов Volkswagen Group. Вы можете быть полностью уверенными - официальный дилер Volkswagen - КарпатиАвтоцентр не только сможет предложить вам абсолютно весь спектр услуг по продаже, предпродажной подготовке и обслуживанию автомобилей Volkswagen, но и сделает это так, как будто вы обратились непосредственно в головной офис компании Фольксваген.</p>
<p> Следует всегда помнить о том, что только официальный дилер Volkswagen сможет предложить вам уровень обслуживания, который не только придётся вам по вкусу, но и обезопасит от абсолютно всех неприятностей и шероховатостей, которые могут возникнуть на этапе выбора и покупки автомобиля. Если вы хотите купить Фольксваген – тогда незамедлительно обращайтесь к нам. Ведь только у нас цены на Фольксваген находятся на самом низком уровне, при фантастически высоком качестве обслуживания.</p>
<p>КарпатыАвтоцентр - официальный дилер Volkswagen (Фольксваген) в Черновицкой области (Украина), продажа новых автомобилей Volkswagen: Volkswagen Touareg, Фольксваген Тигуан, Volkswagen Passat B7, Volkswagen Polo sedan, Фольксваген Гольф 7, Passat CC, Passat Variant, Polo Хэтчбек (Фольксваген Поло), Туран, Фольксваген Транспортер, Volkswagen Amarok, Caddy (Кэди), Crafter (Крафтер), Каравелла, Multivan, а также автокред под 0% годовых, автомобили в лизинг, trade-in (трейд-ин) - обмен старых автомобилей на новый Фольксваген с доплатой, страховка, оригинальные запчасти Фольксваген, автосервис для Volkswagen, Skoda, Audi, Seat, диагостика автомобилей Фольксваген Груп, кузовные работы, автомойка.</p>
<p>Контакты "КарпатыАвтоцентр": 58007, г. Черновцы, вул.Энергетическая 2В Многоканальный контактный телефон:</p>
<p>тел.:+38 (0372) 543-888</p>
<p>Режим работы:</p>
<p>ПН - СБ 9:00- 18:00</p>
<p>ВС 9.00 - 15.00</p>
</div>
<?}?>


</div>

   
   
   
   
   
   
   
</body>
</html>