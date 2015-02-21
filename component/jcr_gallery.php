<?
include "class_json.php";
include "../bd.php";
$rez=mysql_fetch_array(mysql_query("SELECT * FROM models WHERE link='$_GET[model]'"));
$gall=array();
$galleryI=array();
$s=0;
//$gall['metadata']['galleryHeadline']='Самое привлекательное в '.$rez['name'].'... ';
//$gall['metadata']['galleryShort']='В галерее для загрузки доступны изображения и видеоролики, демонстрирующие автомобиль со всех сторон, а также экранные заставки.';
$gall['galleries'][0]['metadata']['name']='Экстерьер';
$gall['galleries'][0]['metadata']['fontColor']='dark';
$gall['galleries'][0]['metadata']['thumbnailFontColor']='light';
$ct=mysql_query("SELECT * FROM  `photo` WHERE model='".$rez['id']."' AND `tip`='1' ORDER BY idd DESC");
while($catalog=mysql_fetch_array($ct)){ 
    $galleryI[$s]['thumbnail']='/photo/gallery/gallery_'.$catalog['id'].'_m.jpg';
    $galleryI[$s]['image']='/photo/gallery/gallery_'.$catalog['id'].'.jpg';
    $galleryI[$s]['deeplinkid']='volkswagen.odessa.ua.gallery.'.$rez['link'].'.'.$catalog['id'].'';
    $galleryI[$s]['shareurl']='http://volkswagen.odessa.ua/models/'.$rez['link'].'/gallery/selection=2.html';
    $s++;
}
$gall['galleries'][0]['galleryItems']=$galleryI;
unset($galleryI);
$galleryI=array();
$gall['galleries'][1]['metadata']['name']='Интерьер';
$gall['galleries'][1]['metadata']['fontColor']='dark';
$gall['galleries'][1]['metadata']['thumbnailFontColor']='light';
$ct=mysql_query("SELECT * FROM  `photo` WHERE model='".$rez['id']."' AND `tip`='2' ORDER BY idd DESC");
$s=0;
while($catalog=mysql_fetch_array($ct)){ 
    $galleryI[$s]['thumbnail']='/photo/gallery/gallery_'.$catalog['id'].'_m.jpg';
    $galleryI[$s]['image']='/photo/gallery/gallery_'.$catalog['id'].'.jpg';
    $galleryI[$s]['link']='<a href="/photo/gallery/gallery_'.$catalog['id'].'.jpg"></a><br/>';
    $galleryI[$s]['deeplinkid']='volkswagen.odessa.ua.gallery.'.$rez['link'].'.'.$catalog['id'].'';
    $galleryI[$s]['shareurl']='http://volkswagen.odessa.ua/models/'.$rez['link'].'/gallery/selection=2.html';
    $s++;
}
$gall['galleries'][1]['galleryItems']=$galleryI;
echo preg_replace_callback('/\\\u([0-9a-fA-F]{4})/', create_function('$match', 'return mb_convert_encoding("&#" . intval($match[1], 16) . ";", "UTF-8", "HTML-ENTITIES");'),  json_encode($gall));
?>


    
