<?php  
include_once('bd.php');
    header('Content-type:text/xml;charset=utf-8');
    echo    '<?xml version="1.0" encoding="UTF-8" ?';echo'>'."\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$http='http://karpaty-autocenter.com.ua/';

$t=mysql_query("SELECT * FROM page WHERE tip='1' ORDER BY id DESC", $db);
while($te = mysql_fetch_array($t)){$link_array[]='service/vw_service/'.$te['link'].'/';$priority[]='0.8';}
$link_array[]='service/garantiya/';$priority[]='0.8';
$link_array[]='innovations/';$priority[]='0.8';
$link_array[]='service/vw_service/'.$te['link'].'/';$priority[]='0.8';
$link_array[]='service/advice/';$priority[]='0.8';
$t=mysql_query("SELECT * FROM page WHERE tip='3' ORDER BY id DESC", $db);
while($te = mysql_fetch_array($t)){$link_array[]='zapchasti/zapchsti_akcii/'.$te['link'].'/';$priority[]='0.8';}
$link_array[]='service/orders/';$priority[]='0.8';
$link_array[]='service/akcii/';$priority[]='0.9';
$t=mysql_query("SELECT * FROM page WHERE tip='5' ORDER BY id DESC", $db);
while($te = mysql_fetch_array($t)){$link_array[]='zapchasti/zapchsti_akcii/'.$te['link'].'/';$priority[]='0.8';}
$link_array[]='purchase_finance/';$priority[]='0.8';
$link_array[]='purchase_finance/supply/';$priority[]='0.9';              
$tq0=mysql_query("SELECT * FROM pcategory WHERE id_cat='1' ORDER BY id DESC", $db);
while($te = mysql_fetch_array($tq0)){$link_array[]='purchase_finance/supply/'.$te['link'].'/';$priority[]='0.8';}
$link_array[]='purchase_finance/corporate/';$priority[]='0.8';                               
$link_array[]='zapchasti/';$priority[]='0.8';            
$link_array[]='zapchasti/avtozapchasti/';$priority[]='0.8';           
$link_array[]='zapchasti/order/';$priority[]='0.8'; 
$link_array[]='zapchasti/aksessuary/';$priority[]='0.8'; 
$link_array[]='zapchasti/dop/';$priority[]='0.9'; 
$link_array[]='company/';$priority[]='0.8';                               
$link_array[]='company/news/';$priority[]='0.9';    
$t=mysql_query("SELECT * FROM page WHERE tip='9' ORDER BY id DESC", $db);
while($te = mysql_fetch_array($t)){$link_array[]='service/vw_service/'.$te['link'].'/';$priority[]='0.8'; }
$link_array[]='company/events/';$priority[]='0.8';  
$t=mysql_query("SELECT * FROM page WHERE tip='10' ORDER BY id DESC", $db);
while($te = mysql_fetch_array($t)){$link_array[]='service/vw_service/'.$te['link'].'/';$priority[]='0.8';}
$link_array[]='company/contact/';$priority[]='0.8';
$link_array[]='models/';$priority[]='0.8';
$us=mysql_query("SELECT * FROM model");
while($rez=mysql_fetch_array($us)){
    if($rez['id']<14 or $rez['id']=='30'){$a='';}else{$a='_k';}
    
    if($rez['gallery']=='1') {$link_array[]='models'.$a.'/'.$rez['link'].'/gallery/';$priority[]='0.8';}
    if($rez['g_360']=='1') {$link_array[]='models'.$a.'/'.$rez['link'].'/colors_and_wheels/';$priority[]='0.8';}
    if($rez['review']=='1') {$link_array[]='models'.$a.'/'.$rez['link'].'/overview/';$priority[]='0.8';}
    if($rez['complete']=='1') {$link_array[]='models'.$a.'/'.$rez['link'].'/features/';$priority[]='0.8';}
    if($rez['technical']=='1') {$link_array[]='models'.$a.'/'.$rez['link'].'/information_and_pricing/';$priority[]='0.8';}
    if($rez['deals']=='1') {$link_array[]='models'.$a.'/'.$rez['link'].'/special_offers/';$priority[]='0.8';}
    if($rez['press']=='1') {$link_array[]='models'.$a.'/'.$rez['link'].'/press/';$priority[]='0.8';}
}

$link_array[]='configurator/';$priority[]='1.0';  

    for($i=0;$i<count($link_array);$i++){
      ?>

        <url>
          <loc><?php echo $http.$link_array[$i]; ?></loc>
          <lastmod><?php echo date('c'); ?></lastmod>
          <changefreq>always</changefreq>
          <priority><?php echo $priority[$i] ?></priority>
        </url>
        <?php
    }

    echo '</urlset>';



?>
