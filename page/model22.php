<?if($_GET['page']=='light' and !isset($_GET['menu'])){?>

<div class="heder_page"><a class="heder_page_name" href="/light/">Легковые автомобили</a></div>

<div class="vwd4_flash {'flashvars':{'configuration':'/component/json/flashconfig.json','trackingConfigCallback':'vwd4.config.getTrackConfig'},'height':630,'id':'3bc80a01867e1c42e998e47a20d5c509','params':{'wmode':'opaque'},'swf':'../component/swf/shell.swf','width':958}"></div>

<?}elseif($_GET['page']=='heavy' and !isset($_GET['menu'])){?>

    <div class="heder_page"><a class="heder_page_name" href="/heavy/">Коммерчиские автомобили</a></div>

    <div class="vwd4_flash {'flashvars':{'configuration':'/component/json/flashconfig2.json','trackingConfigCallback':'vwd4.config.getTrackConfig'},'height':630,'id':'3bc80a01867e1c42e998e47a20d5c509','params':{'wmode':'opaque'},'swf':'../component/swf/shell.swf','width':958}"></div>

<?}elseif($_GET['page']!='' and $_GET['menu']!=''){

    $rez=mysql_fetch_array(mysql_query("SELECT * FROM models WHERE link='$_GET[menu]'"));


?>
    <meta property="og:title" content="<?= $rez['t']; ?>" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?= $rez['link']; ?>" />
    <meta property="og:image" />
    <meta property="og:description" content="<?= $rez['d']; ?>" />
<div class="heder_page"><a class="heder_page_name" href="/<?echo $_GET['page'].'/'.$_GET['menu'];?>/"><?echo $rez['name'];?></a>

<ul>

<?

if($rez['gallery']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/gallery/">Галерея</a></li>';}

if($rez['g_360']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/colors_and_wheels/">360°</a></li>';}

if($rez['review']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/overview/">Обзор</a></li>';}

if($rez['complete']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/features/">Комплектации и цены</a></li>';}

if($rez['technical']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/information_and_pricing/">Прайсы и каталоги</a></li>';}

if($rez['deals']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/special_offers/">Спецпредложения</a></li>';}

if($rez['press']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/press/">Пресса</a></li>';}


?>
<li><a href="/index.php?page=avto_in_stock&isset&car=<?= urlencode($rez['name']); ?>">Авто в наличии</a></li>
<? if($rez['sale_cars']=='1') {  echo'<li><a href="/'.$_GET['page'].'/'.$_GET['menu'].'/sale_cars/">Акционные автомобили</a></li>';} ?>
</ul></div>

    <link href="/css/menu-right.css" rel="stylesheet"/>
    <ul class="services-menu" style="list-style:none;">
        <li class="pic service">
            <a href="http://karpaty-autocenter.com.ua/service/zapis_to/" title="Сервис ">Запись на сервис</a>
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

    </div>
    <div class="clearout"></div>


    <?if(!isset($_GET['pmenu'])){?>

<div class="vwd4_flash {'flashvars':{'xmldata':'/component/xml/data_<?echo $_GET['menu'];?>.xml'},'height':455,'params':{'wmode':'opaque'}, 'swf':'/component/swf/main.swf','width':960}"></div>

<?if($rez['text']!=''){echo '<div style="padding: 10px;">'.$rez['text'].'</div>'; echo'<h3 style="">Поделиться статьей c друзьями:</h3>
<div class="pluso" style="margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';
        }?>



<?}elseif($_GET['pmenu']=='gallery'){?>

<div style="height: 450px;overflow: hidden;position: relative;widows: 980px;"  >

  <div class="vwd4_flash {'flashvars':{'configuration':'/component/json/_jcr_content.flashconfig.php?model=<?echo $_GET['menu'];?>','deeplink':'mediaLists_medialist_mediaItems_medialist_mediaitem_2','trackingConfigCallback':'vwd4.config.getTrackConfig'},'height':455,'id':'06070b2015f60a03f67814d2e2d802e8','params':{'wmode':'opaque'},'swf':'/component/swf/shell.swf','width':960} vwd4_clear vwd4_m4xx"></div>

</div>

<?}elseif($_GET['pmenu']=='features'){



    if(!isset($_GET['link']) and $_GET['link']==''){







    ?>



<a class="link_s" href="/models/<?echo $_GET['menu'];?>/features/compare_equipment/">Сравнить комплектации</a>

<h1 style="margin-left: 10px;float: left;">Комплектации и цены <?echo $rez['name'];?>.</h1>

<div class="cl"></div>

<?

$cm=mysql_query("SELECT DISTINCT `link` FROM  `complekt` WHERE id_model='".$rez['id']."'");

while($complekt=mysql_fetch_array($cm)){

    $comp=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt` WHERE id_model='".$rez['id']."' AND link='".$complekt['link']."' ORDER BY idd DESC LIMIT 1"));

    $comp_id=mysql_fetch_array(mysql_query("SELECT `id` FROM  `complekt_p` WHERE model='".$comp['id']."' AND `name`='Цена' LIMIT 1"));

    $cen_com=mysql_fetch_array(mysql_query("SELECT `name` FROM  `complekt_pp` WHERE id_model='".$comp_id['id']."'  ORDER BY name  LIMIT 1"));

    $cena=fun_ot_com($cen_com['name']);

echo '<div class="blok_complete"><div class="name_complekt_fga"><img src="/photo/complekt/'.$complekt['link'].'_'.$rez['id'].'m.png" style="display: none;"/></div>

<div class="name_complekt"><h2>'.$comp['name'].'</h2><h3>'.$cena.'<h3></div><ul class="dt_complete">';

    $arr_man_tesee=array();

    $c=mysql_query("SELECT * FROM  `complekt` WHERE id_model='".$rez['id']."' AND link='".$complekt['link']."'");

    while($cp=mysql_fetch_array($c)){
        echo $cp['text'];
        echo '<li>'.$cp['dt'].'</li>';

        $tf=mysql_query("SELECT * FROM  `complekt_p` WHERE  `model`='".$rez['id']."' AND `name`!='Цена'");

        while($teh=mysql_fetch_array($tf)){

            $tf1=mysql_query("SELECT * FROM  `complekt_pp` WHERE  `id_model`='".$teh['id']."' AND `overview`='1' AND `sale_cars`='1' GROUP BY name  ");

                while($teh1=mysql_fetch_array($tf1)){

                    $teh2=mysql_query("SELECT * FROM `complekt_pp` WHERE `id_model`='".$teh['id']."' AND `name`='".$teh1['name']."'  AND `id_complete`='".$cp['id']."' ");

                        if(mysql_num_rows($teh2)=='1'){

                            $tesee=mysql_fetch_array($teh2);

                            $arr_man_tesee[$tesee['name']]=0;

                         }}}}

foreach($arr_man_tesee as $key=>$val){echo '<li>'.$key.'</li>';}unlink($arr_man_tesee);echo'</ul><div class="cl" style="height: 30px;"></div>

<a class="link_d" href="/models/'.$_GET['menu'].'/features/'.$complekt['link'].'/">Подробнее</a></div>';}?>

<div class="cl" style="height: 30px;"></div>

<?}elseif(isset($_GET['link']) and $_GET['link']=='compare_equipment'){

echo '1a';

}elseif(isset($_GET['link']) and $_GET['link']!='' and $_GET['link']!='compare_equipment'){



    $cpm=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt` WHERE id_model='".$rez['id']."' AND `link`='".$_GET['link']."' ORDER BY idd DESC LIMIT 1"));





    $arr_ob_md=array();

    $cf1=mysql_query("SELECT * FROM  `complekt` WHERE  id_model='".$rez['id']."' AND `link`='".$_GET['link']."' ORDER BY idd DESC  ");

        while($cf1f=mysql_fetch_array($cf1)){             $arr_ob_md[]=$cf1f['dt'];

        }







?>

<a class="link_s" href="/models/<?echo $_GET['menu'];?>/features/">Назад к обзору</a>

<h1 style="margin-left: 10px;float: left;"><?echo $cpm['name'];?></h1>

<div class="cl"></div>



<div  class="l_cf">

<img src="/photo/complekt/<?echo $cpm['link'].'_'.$cpm['id_model'];?>.png" class="cs_b_i" />

<div class="cl"></div>

<a class="link_s">Сравнить</a>

<div class="cl"></div>

<ul class="vkl_m_f">

<li class="activ" rel="1">Обзор</li>

<li rel='2'>Стандартные опции</li>

<li rel='3'>Дополнительные опции</li>

</ul>

<div class="cl"></div>





<table id="td1" class="vwd4_table3col" border="0" cellspacing="0" cellpadding="0">

<tr>

<td class="vwd4_key">Цена</td>

<td class="vwd4_space"></td>

<td class="vwd4_value">d</td>

</tr>

<tr>

<td class="vwd4_key">Обзор</td>

<td class="vwd4_space"></td>

<td class="vwd4_value"><?

foreach($arr_ob_md as $v){

    echo '<li>'.$v.'</li>';

}



?></td>

</tr>

</table>





<table id="td2" class="vwd4_table3col" border="0" cellspacing="0" cellpadding="0">

<tr>

<td class="vwd4_key">Цена</td>

<td class="vwd4_space"></td>

<td class="vwd4_value">d</td>

</tr>

<tr>

<td class="vwd4_key">Обзор</td>

<td class="vwd4_space"></td>

<td class="vwd4_value">d</td>

</tr>

</table>



<table id="td3" class="vwd4_table3col" border="0" cellspacing="0" cellpadding="0">

<tr>

<td class="vwd4_key">Цена</td>

<td class="vwd4_space"></td>

<td class="vwd4_value">d</td>

</tr>

<tr>

<td class="vwd4_key">Обзор</td>

<td class="vwd4_space"></td>

<td class="vwd4_value">d</td>

</tr>

</table>





















<?



?>



</div>

<div class="r_cf">

<?$cm=mysql_query("SELECT DISTINCT `link` FROM  `complekt` WHERE id_model='".$rez['id']."'");

while($complekt=mysql_fetch_array($cm)){

    $comp=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt` WHERE id_model='".$rez['id']."' AND link='".$complekt['link']."' ORDER BY idd DESC LIMIT 1"));

    $comp_id=mysql_fetch_array(mysql_query("SELECT `id` FROM  `complekt_p` WHERE model='".$comp['id']."' AND `name`='Цена' LIMIT 1"));

    $cen_com=mysql_fetch_array(mysql_query("SELECT `name` FROM  `complekt_pp` WHERE id_model='".$comp_id['id']."'  ORDER BY name  LIMIT 1"));

    $cena=fun_ot_com($cen_com['name']);

echo '<a href="/models/'.$_GET['menu'].'/features/'.$complekt['link'].'/"><div class="blok_complete '; if($cpm['id']==$comp['id']){echo 'active';} echo'"><div class="name_complekt_fga"><img src="/photo/complekt/'.$complekt['link'].'_'.$rez['id'].'m.png" style="display: none;"/></div>

<div class="name_complekt"><h2>'.$comp['name'].'</h2><h3>'.$cena.'<h3></div></div></a>';}?>



</div>

















<?}



}elseif($_GET['pmenu']=='colors_and_wheels'){?>













    <div class="vwd4_flash {

                                'flashvars':{

                                    'configuration':'/component/_jcr_content.flashconfig.php?wheels=<?echo $_GET['menu'];?>',

                                    'trackingConfigCallback':'vwd4.config.getTrackConfig'},

                                    'height':455,'id':'da5b2f8a5efe128870e1b6a4b09dd0ab',

                                    'params':{'wmode':'opaque'},

                                    'swf':'/component/swf/shell.swf',

                                    'width':960

                                    } vwd4_clear vwd4_m4xx">

                                    </div>

















<?}elseif($_GET['pmenu']=='overview'){

?>

<ul class="left_menu">

<?$ove=mysql_query("SELECT * FROM model_page WHERE tip='0' and  model='".$rez['id']."' ORDER BY idd ASC");

  while($overview=mysql_fetch_array($ove)){

    echo '<li><a href="/models/'.$_GET['menu'].'/overview/'.$overview['link'].'/">'.$overview['name'].'</a></li>';

  }?></ul>


<div class="r_content">

<?if($_GET['pmenu']!='' and $_GET['link']==''){ $us3=mysql_query("SELECT * FROM model_page WHERE tip='0' and  model='".$rez['id']."' ORDER BY idd ASC LIMIT 1"); $rez3=mysql_fetch_array($us3);echo '<h1>'.$rez3['name'].'</h1>'; echo $rez3['text'];

  }else{

   $us3=mysql_query("SELECT * FROM model_page WHERE tip='0' AND  model='".$rez['id']."' AND link='".$_GET['link']."' ORDER BY idd ASC LIMIT 1 ");

  $rez3=mysql_fetch_array($us3);

  echo '<h1>'.$rez3['name'].'</h1>';

  echo $rez3['text'];
    echo'<h3 style="">Поделиться статьей c друзьями:</h3>
<div class="pluso" style="margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';

}?>

</div>
<?}elseif($_GET['pmenu']=='sale_cars'){

?>

<ul class="left_menu">

<?$sal=mysql_query("SELECT * FROM model_page WHERE tip='2' and  model='".$rez['id']."' ORDER BY idd ASC");

  while($sale=mysql_fetch_array($sal)){

    echo '<li><a href="/models/'.$_GET['menu'].'/sale_cars/'.$sale['link'].'/">'.$sale['name'].'</a></li>';

  }?></ul>


<div class="r_content">
<?if($_GET['pmenu']!='' and $_GET['link']==''){ $us3=mysql_query("SELECT * FROM model_page WHERE tip='2' and  model='".$rez['id']."' ORDER BY idd ASC LIMIT 1"); $rez3=mysql_fetch_array($us3);echo '<h1>'.$rez3['name'].'</h1>'; echo $rez3['text'];
    echo'<h3 style="">Поделиться статьей c друзьями:</h3>
<div class="pluso" style="margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';


  }else{

   $us3=mysql_query("SELECT * FROM model_page WHERE tip='2' AND  model='".$rez['id']."' AND link='".$_GET['link']."' ORDER BY idd ASC LIMIT 1 ");

  $rez3=mysql_fetch_array($us3);

  echo '<h1>'.$rez3['name'].'</h1>';

    echo $rez3['text'];
    ?>

            <?
    echo'<h3 style="">Поделиться статьей c друзьями:</h3>
<div class="pluso" style="margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';

}?>

</div>
<?  /**

    * Информационные материалы

    **/

}elseif($_GET['pmenu']=='information_and_pricing'){

echo '<img src="/img/hed_teh_'.$_GET['menu'].'.jpg" height="150" width="960"/>';

echo '<div style="padding:0 15px;"><h1>Прайсы и каталоги</h1><br/>'.$rez['text2'].'</div>';

$us2=mysql_query("SELECT * FROM `catalogi` WHERE model='".$rez['id']."'");$i=1;

while($rez2=mysql_fetch_array($us2)){    if($rez2['ph']==''){$ph='jpg';}else{$ph=$rez2['ph'];}    if($rez2['fl']==''){$fl='pdf';}else{$fl=$rez2['fl'];} if($i==4){echo '<div  style="clear: both;"></div>';$i=1;}    echo ' <div class="m113_download_image_item parbase"><a href="/photo/catalog/'.$rez2['link'].'_'.$rez2['model'].'_'.$rez2['id'].'.'.$fl.'" target="_blank"><img src="/photo/catalog/'.$rez2['link'].'_'.$rez2['model'].'_'.$rez2['id'].'.'.$ph.'"  class="vwd4_m113Thumb"/></a><br/><h3>'.$rez2['name'].'</h3><a class="btn" type="button" href="/photo/catalog/'.$rez2['link'].'_'.$rez2['model'].'_'.$rez2['id'].'.'.$fl.'" target="_blank">Подробнее</a></div>';$i++;}
        echo'<h3 style="float: left;">Поделиться статьей c друзьями:</h3><br/>
<div class="pluso" style="margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';





}elseif($_GET['pmenu']=='special_offers'){

?>

<ul class="left_menu">

<?

  $us2=mysql_query("SELECT * FROM model_page WHERE tip='1' and  model='".$rez['id']."' ORDER BY idd ASC");

  while($rez2=mysql_fetch_array($us2)){

    echo '<li><a href="/models/'.$_GET['menu'].'/special_offers/'.$rez2['link'].'/">'.$rez2['name'].'</a></li>';

  }

  ?>

</ul>

<div class="r_content">



<?

if(isset($_GET['link'])){

    $pa=mysql_fetch_array(mysql_query("SELECT * FROM model_page WHERE tip='1' and  model='".$rez['id']."' AND link='".$_GET['link']."' LIMIT 1"));

     echo '<h1>'.$pa['name'].'</h1><img src="/photo/volkswagen_img_special_'.$pa['id'].'.jpg" alt="'.$pa['name'].'"/>'.$pa['text'];

    echo'<h3 style="">Поделиться статьей c друзьями:</h3>
<div class="pluso" style="margin-bottom: 2%;" data-background="#ebebeb" data-options="medium,square,line,horizontal,nocounter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,email"></div>';




}else{

   $result = mysql_query("SELECT * FROM model_page WHERE tip='1' and  model='".$rez['id']."' ORDER BY idd ASC");

    while($pa=mysql_fetch_array($result)){

     echo '<div class="artikle"><img src="/photo/volkswagen_img_special_m_'.$pa['id'].'.jpg"  width="215"><div class="body">

     <h2>'.$pa['name'].'</h2><a href="/models/'.$_GET['menu'].'/special_offers/'.$pa['link'].'/">Подробнее</a></div><div class="cl"></div></div>';

    }

}





?>

</div>

<?}}?>









