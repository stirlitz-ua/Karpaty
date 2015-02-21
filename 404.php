<?include 'bd.php';include 'kurs.php';include 'component/component.php';?>

<!DOCTYPE html>

<html lang="ru">

  <head>
<?

//titles
if(isset($_GET['page']) and $_GET['page']!=''){

    switch($_GET['page']){

        case("models"):

      if($_GET['link']=='') {
        $rez = array('t' => 'Новые автомобили Volkswagen (Фольксваген). КарпатыАвтоцентр / Официальный дилер Volkswagen в Украине
Ключ. слова: модельный ряд Фольксваген, фольксваген модельный ряд и цены, автосалон фольксваген модельный ряд, фольксваген модельный ряд 2014, модельный ряд автомобилей фольксваген, фольксваген официальный сайт модельный ряд, авто фольксваген модельный ряд, автомобиль фольксваген, купить автомобиль фольксваген, новый автомобиль фольксваген, новые автомобили фольксваген, официальный фольксваген', 'k' => '', 'd' => 'Коммерческие автомобили Volkswagen (Фольксваген) от КарпатыАвтоцентр / Официальный дилер Volkswagen в Украине. Фольксваген Кади, Транспортер Т5, Каравелла, Мультиван, Амарок, Крафтер, автобусы Сириус, Альтаир. Все цены, комплектации, фотогалерея, видео тест-драйв. Продажа Volkswagen (Фольксваген) в кредит, лизинг (от производителя) или по схеме TRADE-IN.'); 
            }
          
       if($_GET['link']) {
        $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }

      elseif($_GET['menu']) {
        $query = "SELECT t,d,k FROM models WHERE link='$_GET[menu]'";
            $rez=mysql_fetch_array(mysql_query($query));
 
            }

        if($_GET['pmenu']=='overview') {
               $query = "SELECT overview_t AS t, overview_d AS d, overview_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
                   if($_GET['pmenu']=='gallery') {
               $query = "SELECT gal_t AS t, gal_d AS d, gal_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
       if($_GET['pmenu']=='special_offers') {
               $query = "SELECT special_t AS t, special_d AS d, special_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
                 if($_GET['pmenu']=='information_and_pricing') {
               $query = "SELECT cat_t AS t, cat_d AS d, cat_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
    if($_GET['pmenu']=='features') {
               $query = "SELECT comp_t AS t, comp_d AS d, comp_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
            
        break;   
        case("book_reviews"):
            $rez = array('t' => '', 'k' => '', 'd' => '');
            break; 

case("salesavto"): if(empty($_GET['pmenu'])) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE link='$_GET[menu]'")); else
                $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr_page WHERE link='$_GET[pmenu]'"));
                 break; 


      case('purchase_finance'):
      if(empty($_GET['pmenu']))
        $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE link='$_GET[menu]'"));
      else
        $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr_page WHERE link='$_GET[pmenu]'"));
          if (($_GET['menu']=='supply-1') || ($_GET['menu']=='supply-2') ||($_GET['menu']=='supply-3') ||($_GET['menu']=='supply-4') ||($_GET['menu']=='supply-5') ||($_GET['menu']=='supply-6') or($_GET['menu']=='supply-7') or$_GET['menu']=='supply-9' or($_GET['menu']=='supply-8') or($_GET['menu']=='supply-10') or($_GET['menu']=='supply-11'))
              $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE menu='0'"));

          break;
    
        case("finance"):
        case("zapchasti"):
        case("service"):
        case("company"):

        if(empty($_GET['pmenu'])) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE link='$_GET[menu]'")); else
                $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr_page WHERE link='$_GET[pmenu]'"));
        if (($_GET['menu']=='novosti-1') || ($_GET['menu']=='novosti-1') || ($_GET['menu']=='novosti-2') ||($_GET['menu']=='novosti-3') ||($_GET['menu']=='novosti-4') ||($_GET['menu']=='novosti-5') ||($_GET['menu']=='novosti-6') or($_GET['menu']=='novosti-7') or$_GET['menu']=='novosti-9' or($_GET['menu']=='novosti-8') or($_GET['menu']=='novosti-10') or($_GET['menu']=='novosti-11')) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE menu='4'"));
        break;

        case("avto_in_stock"):
        if(isset($_GET['page']))
                $rez=mysql_fetch_array(mysql_query("SELECT t,d,k,car_name2 FROM cars_new"));
            else
      $rez = array('t' => 'Новые автомобили', 'k' => '', 'd' => 'Новые автомобили'); 
            break; 
        case("das_weltauto"):
            $rez = array('t' => 'Автомобили с пробегом', 'k' => '', 'd' => 'Автомобили с пробегом'); 
            break; 

        case("configurator"): 
            $rez = array('t' => 'Конфигуратор', 'k' => '', 'd' => 'Конфигуратор');
            break; 

    default:
      $rez = array('t' => 'КарпатыАвтоцентр официальный диллер Volkswagen', 'k' => '', 'd' => 'КарпатыАвтоцентр официальный диллер Volkswagen');
      break;

    }

}else{
  $rez = array('t' => 'Официальный дилер Volkswagen (Фольксваген) в Черновицкой области -  продажа новых автомобилей Volkswagen&nbsp;-&nbsp;ООО «КарпатыАвтоцентр»', 'k' => 'купить VW, Volkswagen, Фольцваген, официальный диллер в Черновцах, Чернівці, СТО, автосалон, гарантия, автосервис, автозапчасти, купить автомобиль,импортер,фольксваген,новый
VW Touareg (Туарег)
', 'd' => 'Официальный дилер Volkswagen
(Фольксваген) в Черновцах -  продажа автомобилей Volkswagen, гарантия, сервис, страхование,СТО, автосалон, гарантия, автосервис, автозапчасти,новый VW Touareg (Туарег)');
}
?>
    <title><?= $rez['t'] ?></title>

    <meta name="description" content="<?= $rez['d']; ?>"/>
  <meta name="keywords" content="<?= $rez['k']; ?>">

      <link href="/css/style.css" rel="stylesheet"/>
       <link href="/css/site_map.css" rel="stylesheet"/>
    <script type="text/javascript">

    window.jQuery || document.write('<script type="text/javascript" src="/js/jquery.min.js"><\/script>');

    </script>


  </head>

<body>




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

<?echo'<a href="/models/?type=light" class="first_investment_home">Легковые</a>';?>

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

<a href="/models/?type=heavy" class="first_investment_home">Коммерческие</a>

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
    case("book_reviews"):include 'page/book_reviews.php';break;
    case("site_map"):           include 'page/site_map.php';break;
    

    case('purchase_finance'):case("finance"):case("zapchasti"):case("service"):case("company"):include 'page/page.php';break;  

    case("avto_in_stock"):case("das_weltauto"):include 'page/stock.php'; break; 

    case("configurator"): echo '<div style="widows: 988px;position: relative;"><div  style="height: 800px;overflow: hidden;position: relative;widows: 988px;" ><iframe onload="frame1();" style="margin-top: -90px;margin-left: -3px;" width="988px"  height="800" scrolling="none" frameborder="0" id="hostFrame" src="http://cc.porscheinformatik.com/nwapp/nws_ua/ICC3/VW!uk!!!V!!!/?HDLINT=J&BNR=24320&GRP="></iframe></div></div>';break; 

}

}else{



?>





<div class="fasebook"><div class="divs">

<p><a href="http://www.odnoklassniki.ru/group/51715330605142" target="_blank"><img src="/img/34360e.png" alt="Карпаты АвтоЦентр в Одноклассниках">odnoklassniki.ru</a></p>

<p><a href="http://vk.com/id_karpaty_autocenter" target="_blank"><img src="/img/Logo_Vkontake.png" alt="Карпаты АвтоЦентр ВКонтакте">vkontakte.ru</a></p>



</div></div>




<div class="span12">

<h1><p align="center">Страница не найдена (Ошибка 404)</p></h1><br/><br/><br/>

<p style="font-size:18px;" align="center"><strong>Запрашиваемая Вами страница не найдена. Это значит что она недоступна либо не существует вовсе.</strong></p><br/><br/>
<script>
function goback() {
    history.go(-1);
}
</script>
<p style="float:left; margin-left:20px; font-size:16px;"> <strong>Вы можете:</strong>  <a href="javascript:goback()">Вернуться назад</a> | <a href="/">На главную</a></p><br/>
<br/><br/><br/>

<div class="vwd4_grid3col">
<div class="templatedefparsys_editbar">
<div class="parbase m116_sitemap_models_3col section">
<div class="vwd4_module3col vwd4_m116 vwd4_clear"><h6><a href="/models/">Легковые автомобили.</a></h6>
<ul><li class="vwd4_col">
    <ul class="vwd4_linkList">
    <li><a href="/models/volkswagen_polo/">Polo</a></li>
    <li><a href="/models/polo_sedan/">Polo седан</a></li>
    <li><a href="/models/new_golf/">Golf</a></li>
    <li><a href="/models/sportsvan/">Golf Sportsvan</a></li>
    <li><a href="/models/golf_gti/">Golf GTI</a></li>
     <li><a href="/models/polo_new/">Polo NEW!</a></li>
    </ul>
    </li>
    <li class="vwd4_col">
    <ul class="vwd4_linkList">
    <li><a href="/models/scirocco/">Scirocco</a></li>
    <li><a href="/models/jetta/">Jetta</a></li>
    <li><a href="/models/touran/">Touran</a></li>
    <li><a href="/models/passat/">Passat</a></li>
    <li><a href="/models/passat_variant/">Passat Variant</a></li>
     
    </ul>
    </li>
    
    <li class="vwd4_rightCol">
    <ul class="vwd4_linkList">
    
    <li><a href="/models/tiguan/">Tiguan</a></li>
    <li><a href="/models/touareg/">Touareg</a></li>
    <li><a href="/models/phaeton/">Phaeton</a></li>
 <li><a href="/models/volswagen_cc/">Volkswagen CC</a></li>
  <li><a href="/models/beetle/">Beetle</a></li>
    </ul>
    </li>
    </ul>
</div></div>

<div class="parbase m118_sitemap_further_links_3col section">
<div class="vwd4_module3col vwd4_m116 vwd4_clear"><h6><a href="/models/">Коммерческие автомобили</a></h6>
<div>
    <div class="templatedefparsys">
        
<ul><li class="vwd4_col">
    <ul class="vwd4_linkList">
    <li><a href="/models/amarok/">Amarok</a></li>
    <li><a href="/models/caddy_kasten/">Caddy Kasten</a></li>
    <li><a href="/models/caddy_kombi/">Caddy Kombi</a></li>
    <li><a href="/models/caravelle/">Caravelle</a></li>
    <li><a href="/models/crafter/">Crafter</a></li>
    <li><a href="/models/multivan/">Multivan</a></li>
    </ul>
    </li>
    <li class="vwd4_col">
    <ul class="vwd4_linkList">
    <li><a href="/models/multivan_business/">Multivan Business</a></li>
    <li><a href="/models/sirius/">Sirius</a></li>
    <li><a href="/models/transporter_kombi/">Transporter Kombi</a></li>
    <li><a href="/models/transporter_kasten/">Transporter Kasten</a></li>
    <li><a href="/models/caddy/">Сaddy</a></li>
   
    </ul>
    </li>
    
    <li class="vwd4_rightCol">
    <ul class="vwd4_linkList">
    <li><a href="/models/altair/">Altair</a></li>
    <li><a href="/models/multivan/">Multivan</a></li>
    <li><a href="/models/multivan_business/">Multivan Business</a></li>
   

    </ul>
    </li>
    </ul>
</div>
</div></div></div>
</div>
<div class="m117_sitemap_section_3col parbase section">
<div class="vwd4_module3col vwd4_m117 vwd4_clear">
  <h6><a href="/purchase_finance/">Спецпредложения</a></h6>
            <ul class="vwd4_linkList"><li><a href="/purchase_finance/supply/">Акции и спецпредложения</a>
               
                </li>
              <li><a href="/purchase_finance/corporate/">Корпоративные продажи</a></li>
              </ul>     
          </li>
    <ul>
        <li class="vwd4_col"><h6><a href="/service/">Сервис</a></h6>
            <ul class="vwd4_linkList"><li><a href="/service/vw_service/">Volkswagen сервис</a>
              
                </li>
                <li><a href="/service/garantiya/">Гарантия</a></li>
                <li><a href="/innovations/">Инновации</a></li>
                <li><a href="/service/advice/">Полезные советы</a>
                
                </li>
                <li><a href="/service/orders/">Запись на ТО On-Line</a></li>
                <li><a href="/service/akcii/">Акции</a>
                
                </li>
            </ul>        
          
<li class="vwd4_col">  
          <h6><a href="/company/">Мир Volkswagen</a></h6>
            <ul class="vwd4_linkList"><li><a href="/company/news/">Новости</a>
               
                </li>
                <li><a href="/company/events/">Полезная информация</a>
                
                </li>
                <li><a href="/company/contact/">Контакты "КарпатыАвтоцентр"</a></li>
                
            </ul>        
          </li>
          <ul class="vwd4_linkList"><h6><a href="/service/">Запчасти</a></h6>
                <li><a href="/service/avtozapchasti/">Автозапчасти</a></li>
                <li><a href="/service/aksessuary/">Оригинальные аксессуары</a></li>
                <li><a href="/service/dop/">Допоборудование</a></li>
            </ul>    </li>    
            
   





 
</div>




    </div>


<?}?>


</div>

<div class="span12" style="color: #666;margin-top: 10px;font-size: 11px;">



<span style="float: right;">"КарпатыАвтоцентр" | г. Черновцы, ул.Энергетическая 2В | +38 (0372) 543-888, +38 (050) 374-40-08, +38 (067) 373-57-00 <br/>


<a href="https://plus.google.com/105543712468143741573/?rel=author"> КарпатыАвтоцентр г.Черновцы </a>









</span>





<div style="display: none">


<!-- HotLog -->
<!-- /HotLog -->

</div>



<!-- siteheart -->





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






<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->

<!--[if lt IE 9]>

<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>

<![endif]-->

<link rel="shortcut icon" href="/img/favicon.ico"/>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" src="/js/social-likes.min.js"></script>


<?if(isset($_GET['page']) and $_GET['page']=='models'){?>


    <script type="text/javascript" src="/js/lib.min.js"></script>

    <script type="text/javascript" src="/js/ru.js_config.js"></script>

    <script type="text/javascript" src="/js/app.project.min.js"></script>

    <script type="text/javascript" src="/js/app.documentready.min.js"></script>

<?}?>


<script src="/js/fons.js" type="text/javascript"></script>

<script src="/js/script.js" type="text/javascript"></script>








</body>

</html>