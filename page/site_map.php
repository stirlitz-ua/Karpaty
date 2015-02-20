 <link href="/css/site_map.css" rel="stylesheet"/>
<div id="vwd4_content" class="vwd4_clear">
<div class="vwd4_m503 vwd4_clear"><a href="/site_map/" ><img src="/img/site_map.m503_section_label_image.png" title="Карта сайта" alt="Карта сайта" /></a><!--googleoff: index--><!--googleon: index--></div>
<div id="vwd4_main" class="vwd4_clear">
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

<div class="m117_sitemap_section_3col parbase section">
<div class="vwd4_module3col vwd4_m117 vwd4_clear">
    <ul>
        <li class="vwd4_col"><h6><a href="/service/">Сервис</a></h6>
            <ul class="vwd4_linkList"><li><a href="/service/vw_service/">Volkswagen сервис</a>
                <ul>
                <?$t=mysql_query("SELECT * FROM arr_page WHERE id_arr='28' ORDER BY id DESC", $db);while($te = mysql_fetch_array($t)){echo '<li><a href="/service/vw_service/'.$te['link'].'/">'.$te['name'].' </a></li>';}?>
                </ul>
                </li>
                <li><a href="/service/garantiya/">Гарантия</a></li>
                <li><a href="/innovations/">Инновации</a></li>
                <li><a href="/service/advice/">Полезные советы</a>
                <ul>
                <?$t=mysql_query("SELECT * FROM arr_page WHERE id_arr='16' ORDER BY id DESC", $db);while($te = mysql_fetch_array($t)){echo '<li><a href="/zapchasti/zapchsti_akcii/'.$te['link'].'/">'.$te['name'].' </a></li>';}?>
                </ul>
                </li>
                <li><a href="/service/orders/">Запись на ТО On-Line</a></li>
                <li><a href="/service/akcii/">Акции</a>
                <ul>
                <?$t=mysql_query("SELECT * FROM arr_page WHERE id_arr='31' ORDER BY id DESC", $db);while($te = mysql_fetch_array($t)){echo '<li><a href="/zapchasti/zapchsti_akcii/'.$te['link'].'/">'.$te['name'].' </a></li>';}?>
                </ul>
                </li>
            </ul>        
          <h6><a href="/purchase_finance/">Спецпредложения</a></h6>
            <ul class="vwd4_linkList"><li><a href="/purchase_finance/supply/">Акции и спецпредложения</a>
                <ul>
                <?$t=mysql_query("SELECT * FROM arr_page WHERE id_arr='1' ORDER BY id DESC", $db);
                 while($te = mysql_fetch_array($t)){echo '<li><a href="/purchase_finance/supply/'.$te['link'].'/">'.$te['name'].' </a></li>';}?>
                               
                </ul>
                </li>
              <li><a href="/purchase_finance/corporate/">Корпоративные продажи</a></li>
              </ul>     
          </li>
          
                              
      <li class="vwd4_col">  
          <h6><a href="/company/">Мир Volkswagen</a></h6>
            <ul class="vwd4_linkList"><li><a href="/company/news/">Новости</a>
                <ul>
                <?$t=mysql_query("SELECT * FROM arr_page WHERE id_arr='15' ORDER BY id DESC", $db);while($te = mysql_fetch_array($t)){echo '<li><a href="/company/news/'.$te['link'].'/">'.$te['name'].' </a></li>';}?>
                </ul>
                </li>
                <li><a href="/company/events/">Полезная информация</a>
                <ul>
                <?$t=mysql_query("SELECT * FROM arr WHERE menu='1' ORDER BY id DESC", $db);while($te = mysql_fetch_array($t)){echo '<li><a href="/service/vw_service/'.$te['link'].'/">'.$te['name'].' </a></li>';}?>
                </ul>
                </li>
                <li><a href="/company/contact/">Контакты "КарпатыАвтоцентр"</a></li>
                
            </ul>        
          </li>
          <ul class="vwd4_linkList"><h6><a href="/service/">Запчасти</a></h6>
                <li><a href="/service/avtozapchasti/">Автозапчасти</a></li>
                <li><a href="/service/aksessuary/">Оригинальные аксессуары</a></li>
                <li><a href="/service/dop/">Допоборудование</a></li>
            </ul>    </li>    
            
    </ul>   





 
</div>




    </div>



    <div class="vwd4_grid1col vwd4_noPrint">



      

      <div class="templatedefparsys_editbar"></div>




    </div>



  </div>



</div>
