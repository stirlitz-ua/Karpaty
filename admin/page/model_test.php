<div class="container">
      <div class="row-fluid">
       <div class="span12">
       
       <div class="span3">
<div class="well sidebar-nav">
            <ul class="nav nav-list">
                <li class="nav-header">Навигация</li>
                <li <?if(isset($_GET['add_m'])){echo 'class="active"';}?> ><a href="?models&add_m"><i class="icon-plus"></i>Добавить авто</a></li>
                <li <?if(isset($_GET['param'])){echo 'class="active"';}?>><a href="?models&param"><i class="icon-wrench"></i>Установка Параметров</a></li>
           </ul>


<?if(isset($_GET['view'])){
$model=mysql_fetch_array(mysql_query("SELECT * FROM  `models` WHERE id='".$_GET['view']."'"));
    echo '<span class="nav-header">Название: '.$model['name'].'</span>
    <span class="nav-header">Цена: '.$model['cena'].'</span>
    <img src="../photo/model/'.$model['link'].'2.png" />';
    ?>

<?}?>
</div>
</div>


<div class="span9">
<?if(isset($_GET['param'])){?>
<table class="table table-hover table-condensed table-bordered">
<tr class="success"><th>Категория</th><th style="width: 55px;text-align: center;"><i class="icon-plus" id="add_set0"></i> <i class="icon-eye-open"></i></th></tr>
<span id="addset0">
<?
$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='0' ORDER BY idd ASC");
while($mset=mysql_fetch_array($ms)){ echo '<tr class="id_'.$mset['id'].'"><td style="padding-left: 30px;">'.$mset['name'].'</td><td style="text-align: center;"><!--i class="icon-remove del_set" rel="'.$mset['id'].'" ></i--><i class="icon-pencil edit_set" rel="'.$mset['id'].'"></i></td></tr>';}
?>
</span>
<?
$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='1' ORDER BY idd ASC");
while($mset=mysql_fetch_array($ms)){ $cena[]=$mset['name'];}
?>
<tr class="success"><th>Цены: от <?echo $cena[0];?> - до <?echo $cena[1];?></th><th style="text-align: center;"><i class="icon-pencil" id="add_set1"></i> <i class="icon-eye-open"></i></th></tr>
<tr class="success"><th>Двигатель и трансмиссия</th><th style="text-align: center;"><i class="icon-plus" id="add_set2"></i> <i class="icon-eye-open"></i></th></tr>
<?
$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='2' ORDER BY idd ASC");
while($mset=mysql_fetch_array($ms)){ echo '<tr class="id_'.$mset['id'].'"><td style="padding-left: 30px;">'.$mset['name'].'</td><td style="text-align: center;"><!--i class="icon-remove del_set" rel="'.$mset['id'].'" ></i--><i class="icon-pencil edit_set" rel="'.$mset['id'].'"></i></td></tr>';}
?>
</table>

<?}elseif(isset($_GET['add_m'])){

if(!empty($_POST)){
        
if($_POST['name']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название авто. </div>';$ename='error';}else{$ename='';}
if($_POST['cena']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указана цена Авто . </div>';$ecena='error';}else{$ecena='';}
if($_POST['link']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Отсутствует URL адрес страницы. </div>';$elink='error';}else{$elink='';}
if($_POST['t']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Title. </div>';$error_title='error';}else{$error_title='';}
if($_POST['d']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Description. </div>';$error_des='error';}else{$error_des='';}
if($_POST['k']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Keywords. </div>';$error_key='error';}else{$error_key='';}
if($_POST['ch_dk']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4>Укажите Двигатель и трансмиссия. </div>';$ech='error';}else{$ech='';}
   

   
$max_image_width	= 2595;
$max_image_height	= 999;
$min_image_width	= 595;
$min_image_height	= 229;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("png");
if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
$filename = $_FILES['photo']['tmp_name'];
$ext = substr($_FILES['photo']['name'], 1 + strrpos($_FILES['photo']['name'], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 2 mb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только PNG формат.</div>';
$ph[]=0;    
}else{
$size = GetImageSize($filename);
if ($size['0'] > $max_image_width	or $size['1'] > $max_image_height  ) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография превышает допустимые размеры.</div>';
$ph[]=0; 
}elseif ($size[0] < $min_image_width or $size[1] < $min_image_height){
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография слишком мала для работы.</div>';
$ph[]=0; }else{
$ph[]=1;
$photo_real=$filename;
}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$ephoto='error';}else{$ephoto='';}
        
$max_image_width	= 962;
$max_image_height	= 457;
$min_image_width	= 958;
$min_image_height	= 453;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("jpg", "jpeg");
if (is_uploaded_file($_FILES['bann']['tmp_name'])) {
$filename2 = $_FILES['bann']['tmp_name'];
$ext = substr($_FILES['bann']['name'], 1 + strrpos($_FILES['bann']['name'], "."));
if (filesize($filename2) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 2 mb. </div>';
$ph2[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только JPG формат.</div>';
$ph2[]=0;    
}else{
$size = GetImageSize($filename2);
if ($size['0'] > $max_image_width	or $size['1'] > $max_image_height  ) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография превышает допустимые размеры 960 на 455 пикселей.</div>';
$ph2[]=0; 
}elseif ($size[0] < $min_image_width or $size[1] < $min_image_height){
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография слишком мала для работы.</div>';
$ph2[]=0; }else{
$ph2[]=1;
$photo_real2=$filename2;
}}}
if(!in_array("1", $ph2)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте баннер авто. </div>';$eban='error';}else{$eban='';}



 
 
if($ename=="" and $ecena=="" and $elink=="" and $error_title=="" and $error_des=="" and $error_key=="" and $ech=="" and in_array("1", $ph2) and in_array("1", $ph)){
    include_once "../component/translit.php";
    
    

    $link = strtolower(translitIt($_POST['link']));
    $name=mysql_real_escape_string($_POST['name']);
    $categiry=mysql_real_escape_string($_POST['categiry']);
    $title=mysql_real_escape_string($_POST['t']);
    $des=mysql_real_escape_string($_POST['d']);
    $text=mysql_real_escape_string($_POST['text']);
    $key=mysql_real_escape_string($_POST['k']);
    $cena=mysql_real_escape_string($_POST['cena']); 
    $ch=serialize($_POST['ch_dk']);
    
    
    $add=mysql_query("INSERT INTO `models` SET 
        `name`='".$name."',
        `link`='".$link."', 
        `categiry`='".$categiry."', 
        `cena`='".$cena."', 
        `ch`='".$ch."', 
        `k`='".$key."',
        `text`='".$text."',
        `d`='".$des."', 
        `t`='".$title."'");
    $id=mysql_insert_id();
    
    
    
       
    
if ( $_FILES["photo"]["error"] == 0){
include '../component/class.upload.php';
$handle = new upload($_FILES["photo"]["tmp_name"]);
if ($handle->uploaded){
$handle->file_new_name_body = $link.'3';
$handle->file_auto_rename =  false;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 595;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/'); // дирекстория для загрузки

$handle->file_new_name_body = $link.'2';
$handle->file_auto_rename =  false ;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 304;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/');

$handle->file_new_name_body = $link.'1';
$handle->file_auto_rename =  false ;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 189;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/');

$handle->file_new_name_body = $link.'0';
$handle->file_auto_rename =  false ;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 120;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/');
if ($handle->processed){$handle->clean();} else {echo 'error : ' . $handle->error;}
}}
    
if ( $_FILES["bann"]["error"] == 0){
move_uploaded_file($photo_real2, '../photo/model/b_'.$link.'.jpg');
}

if ( $_FILES["video"]["error"] == 0){
    $ext = substr($_FILES['video']['name'], 1 + strrpos($_FILES['video']['name'], "."));
    move_uploaded_file($_FILES['video']['tmp_name'], '../photo/model/v_'.$link.'.'.$ext);
    $add=mysql_query("UPDATE `models` SET ext='".$ext."' WHERE id='".$id."'");
}





$xml=new DomDocument('1.0','utf-8');
$editdata = $xml->appendChild($xml->createElement('edit-data'));
$stylesheetURL = $editdata->appendChild($xml->createElement('stylesheetURL'));
$stylesheetURL->setAttribute("type", "media-ref");
$stylesheetURL->appendChild($xml->createTextNode('../../css/styles.css'));

$fontsURL = $editdata->appendChild($xml->createElement('fontsURL'));
$fontsURL->setAttribute("type", "media-ref");
$fontsURL->appendChild($xml->createTextNode('../../component/swf/fonts.swf'));

$backgroundColor = $editdata->appendChild($xml->createElement('backgroundColor'));
$backgroundColor->setAttribute("type", "text");
$backgroundColor->appendChild($xml->createTextNode('FFFFFF'));

$headline = $editdata->appendChild($xml->createElement('headline'));
$headline->setAttribute("type", "text");
$headline->appendChild($xml->createTextNode($title));

$headlineWidth = $editdata->appendChild($xml->createElement('headlineWidth'));
$headlineWidth->setAttribute("type", "integer");
$headlineWidth->appendChild($xml->createTextNode('400'));

$copy = $editdata->appendChild($xml->createElement('copy'));
$copy->setAttribute("type", "text");

$copyWidth = $editdata->appendChild($xml->createElement('copyWidth'));
$copyWidth->setAttribute("type", "integer");
$copyWidth->appendChild($xml->createTextNode('400'));

$price = $editdata->appendChild($xml->createElement('price'));
$price->setAttribute("type", "text");

$textColor = $editdata->appendChild($xml->createElement('textColor'));
$textColor->setAttribute("type", "text");
$textColor->appendChild($xml->createTextNode('000000'));

$skipButton = $editdata->appendChild($xml->createElement('skipButton'));
$skipButton->setAttribute("type", "text");
$skipButton->appendChild($xml->createTextNode('Пропустить'));

$skipColor = $editdata->appendChild($xml->createElement('skipColor'));
$skipColor->setAttribute("type", "text");
$skipColor->appendChild($xml->createTextNode('FFFFFF'));

$skipOverColor = $editdata->appendChild($xml->createElement('skipOverColor'));
$skipOverColor->setAttribute("type", "text");
$skipOverColor->appendChild($xml->createTextNode('2275AC'));

$redirectAtVideoEnd = $editdata->appendChild($xml->createElement('redirectAtVideoEnd'));
$redirectAtVideoEnd->setAttribute("type", "link-ref");

$redirectTarget = $editdata->appendChild($xml->createElement('redirectTarget'));
$redirectTarget->setAttribute("type", "text");
$redirectTarget->appendChild($xml->createTextNode('_self'));

$imageVideoEnd = $editdata->appendChild($xml->createElement('imageVideoEnd'));
$imageVideoEnd->setAttribute("type", "media-ref");
$imageVideoEnd->appendChild($xml->createTextNode('../../photo/model/b_'.$link.'.jpg'));

$trackingConfiguration = $editdata->appendChild($xml->createElement('trackingConfiguration'));

$isActive = $trackingConfiguration->appendChild($xml->createElement('isActive'));
$isActive->setAttribute("type", "boolean");
$isActive->appendChild($xml->createTextNode('true'));

$debugTracking = $trackingConfiguration->appendChild($xml->createElement('debugTracking'));
$debugTracking->setAttribute("type", "boolean");
$debugTracking->appendChild($xml->createTextNode('false'));

$visitorNamespace = $trackingConfiguration->appendChild($xml->createElement('visitorNamespace'));
$visitorNamespace->setAttribute("type", "text");
$visitorNamespace->appendChild($xml->createTextNode('volkswagenpkw'));

$dc = $trackingConfiguration->appendChild($xml->createElement('dc'));
$dc->setAttribute("type", "text");
$dc->appendChild($xml->createTextNode('112'));

$trackingServer = $trackingConfiguration->appendChild($xml->createElement('trackingServer'));
$trackingServer->setAttribute("type", "text");
$trackingServer->appendChild($xml->createTextNode('metric.volkswagen.com'));

$trackingServerSecure = $trackingConfiguration->appendChild($xml->createElement('trackingServerSecure'));
$trackingServerSecure->setAttribute("type", "text");
$trackingServerSecure->appendChild($xml->createTextNode('smetric.volkswagen.com'));

$account = $trackingConfiguration->appendChild($xml->createElement('account'));
$account->setAttribute("type", "text");
$account->appendChild($xml->createTextNode('vwpkwrucmsprod'));

$trackingCommonProperties = $editdata->appendChild($xml->createElement('trackingCommonProperties'));

$eVar1 = $trackingCommonProperties->appendChild($xml->createElement('eVar1'));
$eVar1->setAttribute("type", "text");
$eVar1->appendChild($xml->createTextNode('CMS-RU-RU'));

$prop8 = $trackingCommonProperties->appendChild($xml->createElement('prop8'));
$prop8->setAttribute("type", "text");
$prop8->appendChild($xml->createTextNode('CMS-RU-RU'));

$eVar17 = $trackingCommonProperties->appendChild($xml->createElement('eVar17'));
$eVar17->setAttribute("type", "text");
$eVar17->appendChild($xml->createTextNode('ru'));

$prop17 = $trackingCommonProperties->appendChild($xml->createElement('prop17'));
$prop17->setAttribute("type", "text");
$prop17->appendChild($xml->createTextNode('ru'));
 
$eVar25 = $trackingCommonProperties->appendChild($xml->createElement('eVar25'));
$eVar25->setAttribute("type", "text");
$eVar25->appendChild($xml->createTextNode('ru-RU'));

$prop29 = $trackingCommonProperties->appendChild($xml->createElement('prop29'));
$prop29->setAttribute("type", "text");
$prop29->appendChild($xml->createTextNode('ru-RU'));

$video = $editdata->appendChild($xml->createElement('video'));
if ( $_FILES["video"]["error"] == 0){
$backgroundColor = $video->appendChild($xml->createElement('backgroundColor'));
$backgroundColor->setAttribute("type", "text");
$backgroundColor->appendChild($xml->createTextNode('4D4D4D'));

$videoID = $video->appendChild($xml->createElement('videoID'));
$videoID->setAttribute("type", "text");

$videoPath = $video->appendChild($xml->createElement('videoPath'));
$videoPath->setAttribute("type", "media-ref");
$videoPath->appendChild($xml->createTextNode('../../photo/model/v_'.$link.'.'.$ext));

$showController = $video->appendChild($xml->createElement('showController'));
$showController->setAttribute("type", "boolean");
$showController->appendChild($xml->createTextNode('true'));

$timeHideController = $video->appendChild($xml->createElement('timeHideController'));
$timeHideController->setAttribute("type", "integer");
$timeHideController->appendChild($xml->createTextNode('3000'));

$fullscreenPossible = $video->appendChild($xml->createElement('fullscreenPossible'));
$fullscreenPossible->setAttribute("type", "boolean");
$fullscreenPossible->appendChild($xml->createTextNode('true'));
}

$teaser = $editdata->appendChild($xml->createElement('teaser'));


$xml->formatOutput = true;
$xml->save('../component/xml/data_'.$link.'.xml');
 }echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models'></head><body>";
}
?>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
    <legend>Добавить Авто</legend>
    
    <div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Название авто <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в меню.'}}).show();"></i></label>
    <div class="controls">
    <input type="text" id="inputname" name="name" value="<?if(isset($_POST['name'])){echo $_POST['name'];}?>" class="input-xxlarge tblock" placeholder="Название в меню" maxlength="50" rel="1" />
    <span id="span_text1"></span>
    </div>
    </div>
    
    <div class="control-group <?echo $elink;?>">
    <label class="control-label" for="inputname3">URL <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'url адрес страницы, спец символы разрешены только нижнее подчеркивание.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname3" name="link" value="<?if(isset($_POST['link'])){echo $_POST['link'];}?>" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="50" rel="3" />
      <span id="span_text3"></span>
    </div>
    </div>
    
    
    <div class="control-group">
    <label class="control-label" for="section1">Категория <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Категория добавляется в Установка Параметров.'}}).show();"></i></label>
    <div class="controls">
    <select id="section1" name="categiry"><?$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='0' ORDER BY idd ASC");while($mset=mysql_fetch_array($ms)){ echo '<option value="'.$mset['link'].'" '; if(isset($_POST['categiry']) and $_POST['categiry']==$mset['link']){echo 'selected="selected"';} echo '>'.$mset['name'].'</option>';}?></select>
    </div></div>

    
    <div class="control-group <?echo $ecena;?>">
    <label class="control-label" for="small-1">Цена <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Цены указывать в долларах без центов.'}}).show();"></i></label>
    <div class="controls">
    <input class="span2" id="small-1" name="cena" value="<?if(isset($_POST['cena'])){echo $_POST['cena'];}?>" type="number">
    </div>
    </div>
    
    
    <div class="control-group <?echo $ech;?>">
    <label class="control-label">Двигатель и трансмиссия <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Необходимо для сортировки авто.'}}).show();"></i></label>
    <div class="controls">
    <?$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='2' ORDER BY idd ASC");
        while($mset=mysql_fetch_array($ms)){ echo '<label class="checkbox block"><input type="checkbox" name="ch_dk[]" '; if(isset($_POST['ch_dk'])){ if(in_array($mset['link'], $_POST['ch_dk'])){echo 'checked="checked"';}} echo' value="'.$mset['link'].'"> '.$mset['name'].'</label>';}?>
    </div>
    </div>
    
    
    
    <div class="control-group <?echo $ephoto;?>">
    <label class="control-label">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в меню и при сортировке.'}}).show();"></i></label>
    <div class="controls">
  <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left;margin-left: 5px;">
        <div class="fileupload-preview thumbnail" style="width: 136px; height: 136px;"><img src="img/img595x229.jpg" /></div>
       <div>
    <span class="btn btn-file"><span class="fileupload-new">Загрузить фото</span><span class="fileupload-exists">Change</span><input name="photo" type="file" accept="image/png"/></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div>
      
   </div>
    </div>
    
    
    <div class="control-group">
    <label class="control-label">Видео</label>
    <div class="controls">
    <div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-file"><span class="fileupload-new">Загрузить видео</span><span class="fileupload-exists">Change</span><input type="file" name="video"  /></span>
    <span class="fileupload-preview"></span><a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
    </div></div></div>
    
    <div class="control-group <?echo $eban;?>">
    <label class="control-label">Баннер авто <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Баннер авто нужен в качестве заглушки.'}}).show();"></i></label>
    <div class="controls">
    <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left;margin-left: 5px;">
    <div class="fileupload-preview thumbnail" style="width: 342px; height: 136px;"><img src="img/img960x455.jpg" /></div><div>
    <span class="btn btn-file"><span class="fileupload-new">Загрузить фото</span><span class="fileupload-exists">Change</span><input name="bann" type="file" accept="image/jpeg"/></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
    </div></div></div></div>
    
    <div class="control-group <?echo $error_title;?>">
    <label class="control-label" for="inputt">Title <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Определяет заголовок документа.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputt"  name="t" value="<?if(isset($_POST['t'])){echo $_POST['t'];}?>" class="input-xxlarge tblock" placeholder="Title" maxlength="150" rel="4" />
      <span id="span_text4"></span>
    </div>
  </div>
  
  <div class="control-group <?echo $error_key;?>">
    <label class="control-label" for="inputk">Ключевые слова <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Набор ключевых слов близок к аннотации, указывать через запятую.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputk"  name="k" value="<?if(isset($_POST['k'])){echo $_POST['k'];}?>" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="250" rel="5" />
      <span id="span_text5"></span>
    </div>
  </div>
  <div class="control-group  <?echo $error_des;?>">
    <label class="control-label" for="inputd">description <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Дается краткое описание содержания страницы.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputd" name="d" value="<?if(isset($_POST['d'])){echo $_POST['d'];}?>" class="input-xxlarge tblock" placeholder="description" maxlength="250" rel="6" />
      <span id="span_text6"></span>
    </div>
  </div>
    
    <div class="control-group"><textarea id="textarea1" name="text"><?if(isset($_POST['text']) and $_POST['text']!=''){echo $_POST['text'];}?></textarea></div>
  
    
    
    <div class="control-group">
      <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> 
     </div>
</div>
    
    
    
    
    
    </fieldset>
    </form>
    
<?}elseif(isset($_GET['edit_m'])){



$model=mysql_fetch_array(mysql_query("SELECT * FROM  `models` WHERE id='".$_GET['edit_m']."'"));




if(!empty($_POST)){
        
if($_POST['name']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название авто. </div>';$ename='error';}else{$ename='';}
if($_POST['cena']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указана цена Авто . </div>';$ecena='error';}else{$ecena='';}
if($_POST['link']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Отсутствует URL адрес страницы. </div>';$elink='error';}else{$elink='';}
if($_POST['t']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Title. </div>';$error_title='error';}else{$error_title='';}
if($_POST['d']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Description. </div>';$error_des='error';}else{$error_des='';}
if($_POST['k']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Keywords. </div>';$error_key='error';}else{$error_key='';}
if($_POST['ch_dk']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4>Укажите Двигатель и трансмиссия. </div>';$ech='error';}else{$ech='';}
   

   
$max_image_width	= 2595;
$max_image_height	= 999;
$min_image_width	= 595;
$min_image_height	= 229;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("png");
if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
$filename = $_FILES['photo']['tmp_name'];
$ext = substr($_FILES['photo']['name'], 1 + strrpos($_FILES['photo']['name'], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 2 mb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только PNG формат.</div>';
$ph[]=0;    
}else{
$size = GetImageSize($filename);
if ($size['0'] > $max_image_width	or $size['1'] > $max_image_height  ) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография превышает допустимые размеры.</div>';
$ph[]=0; 
}elseif ($size[0] < $min_image_width or $size[1] < $min_image_height){
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография слишком мала для работы.</div>';
$ph[]=0; }else{
$ph[]=1;
$photo_real=$filename;
}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$ephoto='error';}else{$ephoto='';}
        
$max_image_width	= 962;
$max_image_height	= 457;
$min_image_width	= 958;
$min_image_height	= 453;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("jpg", "jpeg");
if (is_uploaded_file($_FILES['bann']['tmp_name'])) {
$filename2 = $_FILES['bann']['tmp_name'];
$ext = substr($_FILES['bann']['name'], 1 + strrpos($_FILES['bann']['name'], "."));
if (filesize($filename2) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 2 mb. </div>';
$ph2[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только JPG формат.</div>';
$ph2[]=0;    
}else{
$size = GetImageSize($filename2);
if ($size['0'] > $max_image_width	or $size['1'] > $max_image_height  ) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография превышает допустимые размеры 960 на 455 пикселей.</div>';
$ph2[]=0; 
}elseif ($size[0] < $min_image_width or $size[1] < $min_image_height){
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография слишком мала для работы.</div>';
$ph2[]=0; }else{
$ph2[]=1;
$photo_real2=$filename2;
}}}
if(!in_array("1", $ph2)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте баннер авто. </div>';$eban='error';}else{$eban='';}



 
 
if($ename=="" and $ecena=="" and $elink=="" and $error_title=="" and $error_des=="" and $error_key=="" and $ech=="" ){
    include_once "../component/translit.php";
    
    

    $link = strtolower(translitIt($_POST['link']));
    $name=mysql_real_escape_string($_POST['name']);
    $categiry=mysql_real_escape_string($_POST['categiry']);
    $title=mysql_real_escape_string($_POST['t']);
    $des=mysql_real_escape_string($_POST['d']);
    $key=mysql_real_escape_string($_POST['k']);
    $cena=mysql_real_escape_string($_POST['cena']); 
    $text=mysql_real_escape_string($_POST['text']);
    $ch=serialize($_POST['ch_dk']);
    
    
    $add=mysql_query("UPDATE `models` SET 
        `name`='".$name."',
        `link`='".$link."', 
        `categiry`='".$categiry."', 
        `cena`='".$cena."', 
        `ch`='".$ch."',
        `text`='".$text."', 
        `k`='".$key."', 
        `d`='".$des."', 
        `t`='".$title."' WHERE id='".$_GET['edit_m']."'");

    
    
       
    
if ( $_FILES["photo"]["error"] == 0){
    unlink('../photo/model/'.$model['link'].'.png');
    unlink('../photo/model/'.$model['link'].'1.png');
    unlink('../photo/model/'.$model['link'].'2.png');
    unlink('../photo/model/'.$model['link'].'3.png');
    
include '../component/class.upload.php';
$handle = new upload($_FILES["photo"]["tmp_name"]);
if ($handle->uploaded){
$handle->file_new_name_body = $link.'3';
$handle->file_auto_rename =  false;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 595;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/'); // дирекстория для загрузки

$handle->file_new_name_body = $link.'2';
$handle->file_auto_rename =  false ;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 304;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/');

$handle->file_new_name_body = $link.'1';
$handle->file_auto_rename =  false ;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 189;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/');

$handle->file_new_name_body = $link.'0';
$handle->file_auto_rename =  false ;
$handle->file_overwrite =  true;
$handle->image_resize = true;
$handle->image_x = 120;
$handle->image_ratio_y = true;
$handle->png_compression =  9;
$handle->process('../photo/model/');
if ($handle->processed){$handle->clean();} else {echo 'error : ' . $handle->error;}
}}else{
    if($model['link']!=$link){
if (copy('../photo/model/'.$model['link'].'0.png', '../photo/model/'.$link.'0.png')) {unlink('../photo/model/'.$model['link'].'0.png');}
if (copy('../photo/model/'.$model['link'].'1.png', '../photo/model/'.$link.'1.png')) {unlink('../photo/model/'.$model['link'].'1.png');}
if (copy('../photo/model/'.$model['link'].'2.png', '../photo/model/'.$link.'2.png')) {unlink('../photo/model/'.$model['link'].'2.png');}
if (copy('../photo/model/'.$model['link'].'3.png', '../photo/model/'.$link.'3.png')) {unlink('../photo/model/'.$model['link'].'3.png');} 
    }   
}
    
if ( $_FILES["bann"]["error"] == 0){
    unlink('../photo/model/b_'.$model['link'].'.jpg');
    move_uploaded_file($photo_real2, '../photo/model/b_'.$link.'.jpg');
    $ban='../photo/model/b_'.$link.'.jpg';
}else{
    if($model['link']!=$link){
    if (copy('../photo/model/b_'.$model['link'].'.jpg', '../photo/model/b_'.$link.'.jpg')) {unlink('../photo/model/b_'.$model['link'].'.jpg');}
    }
    $ban='../photo/model/b_'.$model['link'].'.jpg';
}

if ( $_FILES["video"]["error"] == 0){
    unlink('../photo/model/v_'.$model['link'].'.'.$model['ext']);
    $ext = substr($_FILES['video']['name'], 1 + strrpos($_FILES['video']['name'], "."));
    move_uploaded_file($_FILES['video']['tmp_name'], '../photo/model/v_'.$link.'.'.$ext);
    $vid='../photo/model/v_'.$link.'.'.$ext;
}else{
    
    
    
    if($model['link']!=$link){
        if (copy('../photo/model/v_'.$model['link'].'.'.$model['ext'], '../photo/model/v_'.$link.'.'.$model['ext'])) {unlink('../photo/model/v_'.$model['link'].'.'.$model['ext']);}
    }
    $vid='../photo/model/v_'.$link.'.'.$model['ext'];
}

unlink('../component/xml/data_'.$model['link'].'.xml');

$xml=new DomDocument('1.0','utf-8');
$editdata = $xml->appendChild($xml->createElement('edit-data'));
$stylesheetURL = $editdata->appendChild($xml->createElement('stylesheetURL'));
$stylesheetURL->setAttribute("type", "media-ref");
$stylesheetURL->appendChild($xml->createTextNode('../../css/styles.css'));

$fontsURL = $editdata->appendChild($xml->createElement('fontsURL'));
$fontsURL->setAttribute("type", "media-ref");
$fontsURL->appendChild($xml->createTextNode('../../component/swf/fonts.swf'));

$backgroundColor = $editdata->appendChild($xml->createElement('backgroundColor'));
$backgroundColor->setAttribute("type", "text");
$backgroundColor->appendChild($xml->createTextNode('FFFFFF'));

$headline = $editdata->appendChild($xml->createElement('headline'));
$headline->setAttribute("type", "text");
$headline->appendChild($xml->createTextNode($title));

$headlineWidth = $editdata->appendChild($xml->createElement('headlineWidth'));
$headlineWidth->setAttribute("type", "integer");
$headlineWidth->appendChild($xml->createTextNode('400'));

$copy = $editdata->appendChild($xml->createElement('copy'));
$copy->setAttribute("type", "text");

$copyWidth = $editdata->appendChild($xml->createElement('copyWidth'));
$copyWidth->setAttribute("type", "integer");
$copyWidth->appendChild($xml->createTextNode('400'));

$price = $editdata->appendChild($xml->createElement('price'));
$price->setAttribute("type", "text");

$textColor = $editdata->appendChild($xml->createElement('textColor'));
$textColor->setAttribute("type", "text");
$textColor->appendChild($xml->createTextNode('000000'));

$skipButton = $editdata->appendChild($xml->createElement('skipButton'));
$skipButton->setAttribute("type", "text");
$skipButton->appendChild($xml->createTextNode('Пропустить'));

$skipColor = $editdata->appendChild($xml->createElement('skipColor'));
$skipColor->setAttribute("type", "text");
$skipColor->appendChild($xml->createTextNode('FFFFFF'));

$skipOverColor = $editdata->appendChild($xml->createElement('skipOverColor'));
$skipOverColor->setAttribute("type", "text");
$skipOverColor->appendChild($xml->createTextNode('2275AC'));

$redirectAtVideoEnd = $editdata->appendChild($xml->createElement('redirectAtVideoEnd'));
$redirectAtVideoEnd->setAttribute("type", "link-ref");

$redirectTarget = $editdata->appendChild($xml->createElement('redirectTarget'));
$redirectTarget->setAttribute("type", "text");
$redirectTarget->appendChild($xml->createTextNode('_self'));

$imageVideoEnd = $editdata->appendChild($xml->createElement('imageVideoEnd'));
$imageVideoEnd->setAttribute("type", "media-ref");
$imageVideoEnd->appendChild($xml->createTextNode('../'.$ban));

$trackingConfiguration = $editdata->appendChild($xml->createElement('trackingConfiguration'));

$isActive = $trackingConfiguration->appendChild($xml->createElement('isActive'));
$isActive->setAttribute("type", "boolean");
$isActive->appendChild($xml->createTextNode('true'));

$debugTracking = $trackingConfiguration->appendChild($xml->createElement('debugTracking'));
$debugTracking->setAttribute("type", "boolean");
$debugTracking->appendChild($xml->createTextNode('false'));

$visitorNamespace = $trackingConfiguration->appendChild($xml->createElement('visitorNamespace'));
$visitorNamespace->setAttribute("type", "text");
$visitorNamespace->appendChild($xml->createTextNode('volkswagenpkw'));

$dc = $trackingConfiguration->appendChild($xml->createElement('dc'));
$dc->setAttribute("type", "text");
$dc->appendChild($xml->createTextNode('112'));

$trackingServer = $trackingConfiguration->appendChild($xml->createElement('trackingServer'));
$trackingServer->setAttribute("type", "text");
$trackingServer->appendChild($xml->createTextNode('metric.volkswagen.com'));

$trackingServerSecure = $trackingConfiguration->appendChild($xml->createElement('trackingServerSecure'));
$trackingServerSecure->setAttribute("type", "text");
$trackingServerSecure->appendChild($xml->createTextNode('smetric.volkswagen.com'));

$account = $trackingConfiguration->appendChild($xml->createElement('account'));
$account->setAttribute("type", "text");
$account->appendChild($xml->createTextNode('vwpkwrucmsprod'));

$trackingCommonProperties = $editdata->appendChild($xml->createElement('trackingCommonProperties'));

$eVar1 = $trackingCommonProperties->appendChild($xml->createElement('eVar1'));
$eVar1->setAttribute("type", "text");
$eVar1->appendChild($xml->createTextNode('CMS-RU-RU'));

$prop8 = $trackingCommonProperties->appendChild($xml->createElement('prop8'));
$prop8->setAttribute("type", "text");
$prop8->appendChild($xml->createTextNode('CMS-RU-RU'));

$eVar17 = $trackingCommonProperties->appendChild($xml->createElement('eVar17'));
$eVar17->setAttribute("type", "text");
$eVar17->appendChild($xml->createTextNode('ru'));

$prop17 = $trackingCommonProperties->appendChild($xml->createElement('prop17'));
$prop17->setAttribute("type", "text");
$prop17->appendChild($xml->createTextNode('ru'));
 
$eVar25 = $trackingCommonProperties->appendChild($xml->createElement('eVar25'));
$eVar25->setAttribute("type", "text");
$eVar25->appendChild($xml->createTextNode('ru-RU'));

$prop29 = $trackingCommonProperties->appendChild($xml->createElement('prop29'));
$prop29->setAttribute("type", "text");
$prop29->appendChild($xml->createTextNode('ru-RU'));

$video = $editdata->appendChild($xml->createElement('video'));
if ( $_FILES["video"]["error"] == 0 or file_exists('../photo/model/v_'.$model['link'].'.'.$model['ext'])){
$backgroundColor = $video->appendChild($xml->createElement('backgroundColor'));
$backgroundColor->setAttribute("type", "text");
$backgroundColor->appendChild($xml->createTextNode('4D4D4D'));

$videoID = $video->appendChild($xml->createElement('videoID'));
$videoID->setAttribute("type", "text");

$videoPath = $video->appendChild($xml->createElement('videoPath'));
$videoPath->setAttribute("type", "media-ref");
$videoPath->appendChild($xml->createTextNode('../'.$vid));

$showController = $video->appendChild($xml->createElement('showController'));
$showController->setAttribute("type", "boolean");
$showController->appendChild($xml->createTextNode('true'));

$timeHideController = $video->appendChild($xml->createElement('timeHideController'));
$timeHideController->setAttribute("type", "integer");
$timeHideController->appendChild($xml->createTextNode('3000'));

$fullscreenPossible = $video->appendChild($xml->createElement('fullscreenPossible'));
$fullscreenPossible->setAttribute("type", "boolean");
$fullscreenPossible->appendChild($xml->createTextNode('true'));
}

$teaser = $editdata->appendChild($xml->createElement('teaser'));


$xml->formatOutput = true;
$xml->save('../component/xml/data_'.$link.'.xml');

    
    
 }
        
 
echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models'></head><body>";
}
    $_POST['ch_dk']=unserialize($model['ch']);
    
?>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
    <legend>Редактировать Авто</legend>
    
    <div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Название авто <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в меню.'}}).show();"></i></label>
    <div class="controls">
    <input type="text" id="inputname" name="name" value="<?if(isset($_POST['name']) and $_POST['name']!=''){echo $_POST['name'];}else{echo $model['name'];}?>" class="input-xxlarge tblock" placeholder="Название в меню" maxlength="50" rel="1" />
    <span id="span_text1"></span>
    </div>
    </div>
    
    <div class="control-group <?echo $elink;?>">
    <label class="control-label" for="inputname3">URL <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'url адрес страницы, спец символы разрешены только нижнее подчеркивание.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname3" name="link" value="<?if(isset($_POST['link']) and $_POST['link']!=''){echo $_POST['link'];}else{echo $model['link'];}?>" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="50" rel="3" />
      <span id="span_text3"></span>
    </div>
    </div>
    
    
    <div class="control-group">
    <label class="control-label" for="section1">Категория <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Категория добавляется в Установка Параметров.'}}).show();"></i></label>
    <div class="controls">
    <select id="section1" name="categiry"><?$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='0' ORDER BY idd ASC");while($mset=mysql_fetch_array($ms)){ echo '<option value="'.$mset['link'].'" ';if(isset($_POST['categiry']) and $_POST['categiry']!=''){if($_POST['categiry']==$mset['link']){echo 'selected="selected"';}}else{if($model['categiry']==$mset['link']){echo 'selected="selected"';}} echo '>'.$mset['name'].'</option>';}?></select>
    </div></div>

    
    <div class="control-group <?echo $ecena;?>">
    <label class="control-label" for="small-1">Цена <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Цены указывать в долларах без центов.'}}).show();"></i></label>
    <div class="controls">
    <input class="span2" id="small-1" name="cena" value="<?if(isset($_POST['cena']) and $_POST['cena']!=''){echo $_POST['cena'];}else{echo $model['cena'];}?>" type="number">
    </div>
    </div>
    
    
    <div class="control-group <?echo $ech;?>">
    <label class="control-label">Двигатель и трансмиссия <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Необходимо для сортировки авто.'}}).show();"></i></label>
    <div class="controls">
    <?$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='2' ORDER BY idd ASC");
        while($mset=mysql_fetch_array($ms)){ echo '<label class="checkbox block"><input type="checkbox" name="ch_dk[]" '; if(in_array($mset['link'], $_POST['ch_dk'])){echo 'checked="checked"';} echo' value="'.$mset['link'].'"> '.$mset['name'].'</label>';}?>
    </div>
    </div>
    
    
    
    <div class="control-group <?echo $ephoto;?>">
    <label class="control-label">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в меню и при сортировке.'}}).show();"></i></label>
    <div class="controls">
  <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left;margin-left: 5px;">
        <div class="fileupload-preview thumbnail" style="width: 136px; height: 136px;"><img src="../photo/model/<?echo $model['link'];?>2.png" /></div>
       <div>
    <span class="btn btn-file"><span class="fileupload-new">Загрузить фото</span><span class="fileupload-exists">Change</span><input name="photo" type="file" accept="image/png"/></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div>
      
   </div>
    </div>
    
    
    <div class="control-group">
    <label class="control-label">Видео</label>
    <div class="controls">
    <div class="fileupload fileupload-new" data-provides="fileupload">
    <span class="btn btn-file"><span class="fileupload-new">Загрузить видео</span><span class="fileupload-exists">Change</span><input type="file" name="video"  /></span>
    <span class="fileupload-preview"></span><a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
    </div></div></div>
    
    <div class="control-group <?echo $eban;?>">
    <label class="control-label">Баннер авто <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Баннер авто нужен в качестве заглушки.'}}).show();"></i></label>
    <div class="controls">
    <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left;margin-left: 5px;">
    <div class="fileupload-preview thumbnail" style="width: 342px; height: 136px;"><img src="../photo/model/b_<?echo $model['link'];?>.jpg" /></div><div>
    <span class="btn btn-file"><span class="fileupload-new">Загрузить фото</span><span class="fileupload-exists">Change</span><input name="bann" type="file" accept="image/jpeg"/></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
    </div></div></div></div>
    
    <div class="control-group <?echo $error_title;?>">
    <label class="control-label" for="inputt">Title <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Определяет заголовок документа.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputt"  name="t" value="<?if(isset($_POST['t']) and $_POST['t']!=''){echo $_POST['t'];}else{echo $model['t'];}?>" class="input-xxlarge tblock" placeholder="Title" maxlength="150" rel="4" />
      <span id="span_text4"></span>
    </div>
  </div>
  
  <div class="control-group <?echo $error_key;?>">
    <label class="control-label" for="inputk">Ключевые слова <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Набор ключевых слов близок к аннотации, указывать через запятую.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputk"  name="k" value="<?if(isset($_POST['k']) and $_POST['k']!=''){echo $_POST['k'];}else{echo $model['k'];}?>" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="250" rel="5" />
      <span id="span_text5"></span>
    </div>
  </div>
  <div class="control-group  <?echo $error_des;?>">
    <label class="control-label" for="inputd">description <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Дается краткое описание содержания страницы.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputd" name="d" value="<?if(isset($_POST['d']) and $_POST['d']!=''){echo $_POST['d'];}else{echo $model['d'];}?>" class="input-xxlarge tblock" placeholder="description" maxlength="250" rel="6" />
      <span id="span_text6"></span>
    </div>
  </div>
    
  <div class="control-group"><textarea id="textarea1" name="text"><?if(isset($_POST['text']) and $_POST['text']!=''){echo $_POST['text'];}else{echo $model['text'];}?></textarea></div>
    
    
    <div class="control-group">
      <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> 
     </div>
</div>
    
    
    
    
    
    </fieldset>
    </form>
    
<?}elseif(isset($_GET['view'])){?>
<ul class="breadcrumb">
  <li <?if(isset($_GET['galery'])){echo 'class="active"';}?> ><a href="?models&view=<?echo $_GET['view'];?>&galery">Галерея</a> <span class="divider">/</span></li>
  <li <?if(isset($_GET['overview'])){echo 'class="active"';}?> ><a href="?models&view=<?echo $_GET['view'];?>&overview">Обзор</a> <span class="divider">/</span></li>
  <li <?if(isset($_GET['catalog'])){echo 'class="active"';}?> ><a href="?models&view=<?echo $_GET['view'];?>&catalog">Каталоги</a> <span class="divider">/</span></li>
  <li <?if(isset($_GET['features'])){echo 'class="active"';}?> ><a href="?models&view=<?echo $_GET['view'];?>&features">Комплектации</a> </li><span class="divider">/</span></li>
  <li <?if(isset($_GET['special'])){echo 'class="active"';}?> ><a href="?models&view=<?echo $_GET['view'];?>&special">Спецпредложение</a> </li>
  
  
  
<li class="pull-right"><a href="?models&view=<?echo $_GET['view'];?>" class="act act-danger">Назад</a></li>
</ul>


<table class="table table-hover table-condensed table-bordered">
<tr>
<th colspan="4">
<?
if(isset($_GET['galery'])){echo 'Галерея';

 if (isset($_FILES["photo"])) {
        $max_image_width	= 2962;
        $max_image_height	= 1957;
        $min_image_width	= 958;
        $min_image_height	= 453;
        $max_image_size		= 2048 * 2048;
        $valid_types 		=  array("jpg", "jpeg");
        include '../component/resize_crop.php';
	if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
		$filename = $_FILES['photo']['tmp_name'];
		$ext = substr($_FILES['photo']['name'], 1 + strrpos($_FILES['photo']['name'], "."));
		if (filesize($filename) > $max_image_size) {
			echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Размер файла больше 2 mb. </div>';
		} elseif (!in_array($ext, $valid_types)) {
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Разрешено загружать только JPG формат.</div>';
		} else {
 			$size = GetImageSize($filename);
            
 			if ($size[0] < $max_image_width	&& $size[1] < $max_image_height && $size[0] > $min_image_width	&& $size[1] > $min_image_height ) {
				    $add=mysql_query("INSERT INTO `photo` SET `model`='".$_GET['view']."', `tip`='".$_POST['optr']."'");
                    $idd=mysql_insert_id();              
                      
                      
                      if (resize($filename, "../photo/gallery/gallery_".$idd."_.jpg".$file,960,0)) {
                            crop("../photo/gallery/gallery_".$idd."_.jpg", "../photo/gallery/gallery_".$idd.".jpg", array(0,0,960,455));
                            resize("../photo/gallery/gallery_".$idd.".jpg","../photo/gallery/gallery_".$idd."_m.jpg".$file,93,44);
                            unlink("../photo/gallery/gallery_".$idd."_.jpg");
                            $add=mysql_query("UPDATE `photo` SET `idd`='".$idd."' WHERE `id`='".$idd."' ");
					        echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>Фото успешно загружено.</div>';
                            echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&galery'></head><body>";
				} else {
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> при попытке загрузить фото возникли ошибки , попробуйте вновь , если ошибка повторилась  обратитесь к Администратору.</div>';
				}
			} else {
				echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не допустимая высота или ширина фото. Размер фото  960 Х 455 пикселей </div>';
			}
		}
	} 
}






?>

<form action="" method="post" enctype="multipart/form-data">
<div class="fileupload fileupload-new" data-provides="fileupload" style="float: right;">
  <span class="btn-file"><span class="fileupload-new"><i class="icon-plus"></i></span><span class="fileupload-exists">
  <i class="icon-minus"></i></span><input type="file" name="photo" style="width: 20px; height: 20px;border-width: 0 0 0px 0px;"></span>
  <span class="fileupload-preview" style=""></span>
  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
  
  
<label class="radio fileupload-exists"><input type="radio" name="optr" value="1" checked="checked" />Экстерьер</label>
<label class="radio fileupload-exists"><input type="radio" name="optr" value="2"/>Интерьер</label>
<input type="submit" value="Загрузить" class="fileupload-exists">
</div></form>

<?}
elseif(isset($_GET['overview'])){echo 'Обзор  <a href="?models&view='.$_GET['view'].'&overview&add" class="pull-right">Добавить Обзор</a>';}
elseif(isset($_GET['features'])){echo 'Комплектации <a href="?models&view='.$_GET['view'].'&features&add" class="pull-right">Добавить Комплектацию</a>';}
elseif(isset($_GET['catalog'])){echo 'Каталоги <a href="?models&view='.$_GET['view'].'&catalog&add" class="pull-right">Добавить новый</a>';}

elseif(isset($_GET['special'])){echo 'Спецпредложение <a href="?models&view='.$_GET['view'].'&special&add" class="pull-right">Добавить Спецпредложение</a>';}else{?>

<table class="table" style="border: 0;">
<tr class="menu_moidel">
<?
$rez=mysql_fetch_array(mysql_query("SELECT * FROM models WHERE id='$_GET[view]'"));


?>
    <th><span class="menu_moidelth <?if($rez['gallery']==0){echo ' red';}?>" onclick="menuclik('gallery', <?echo $_GET['view'];?>);">Галерея</span></th>
    <th><span class="menu_moidelth <?if($rez['g_360']==0){echo ' red';}?>" onclick="menuclik('g_360', <?echo $_GET['view'];?>);">360°</span></th>
    <th><span class="menu_moidelth <?if($rez['review']==0){echo ' red';}?>" onclick="menuclik('review', <?echo $_GET['view'];?>);">Обзор</span></th>
    <th><span class="menu_moidelth <?if($rez['complete']==0){echo ' red';}?>" onclick="menuclik('complete', <?echo $_GET['view'];?>);">Комплектации</span></th>
    <th><span class="menu_moidelth <?if($rez['technical']==0){echo ' red';}?>" onclick="menuclik('technical', <?echo $_GET['view'];?>);">Каталоги</span></th>
    <th><span class="menu_moidelth <?if($rez['deals']==0){echo ' red';}?>" onclick="menuclik('deals', <?echo $_GET['view'];?>);">Спецпредложение</span></th>
    <th><span class="menu_moidelth <?if($rez['press']==0){echo ' red';}?>" onclick="menuclik('press', <?echo $_GET['view'];?>);">Пресса</span></th>
    
 
    
    
</tr>
</table>
    
<?}?>
</th>
</tr>

<?
if(isset($_GET['galery'])){
    $ct=mysql_query("SELECT * FROM  `photo` WHERE model='".$_GET['view']."' AND `tip`='1'  ORDER BY idd DESC");
    echo '<tr><td colspan="3">Экстерьер</td></tr>';
    while($catalog=mysql_fetch_array($ct)){ 
        echo '<tr class="id_'.$catalog['id'].'">
        <td colspan="2"><img style="width: 230px;" src="../photo/gallery/gallery_'.$catalog['id'].'.jpg" /></td>
        <td style="width: 100px;">
            <i class="icon-remove del_photo" rel="'.$catalog['id'].'"></i>
        </td></tr>';
    }
    $ct=mysql_query("SELECT * FROM  `photo` WHERE model='".$_GET['view']."' AND `tip`='2'  ORDER BY idd DESC");
    echo '<tr><td colspan="3">Интерьер</td></tr>';
    while($catalog=mysql_fetch_array($ct)){ 
        echo '<tr class="id_'.$catalog['id'].'">
        <td colspan="2"><img style="width: 230px;" src="../photo/gallery/gallery_'.$catalog['id'].'.jpg" /></td>
        <td style="width: 100px;">
            <i class="icon-remove del_photo" rel="'.$catalog['id'].'"></i>
        </td></tr>';
    }
  
    
    
}elseif(isset($_GET['features'])){    
     if(isset($_GET['add'])){
        
        
        
        
        
        
        
        
if(!empty($_POST)){
        
if($_POST['name']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название авто. </div>';$ename='error';}else{$ename='';}
if($_POST['dvig'][0]==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан двигатель Авто . </div>';$ecena='error';}else{$ecena='';}
   
$max_image_width	= 687;
$max_image_height	= 327;
$min_image_width	= 683;
$min_image_height	= 323;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("png");
if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
$filename = $_FILES['photo']['tmp_name'];
$ext = substr($_FILES['photo']['name'], 1 + strrpos($_FILES['photo']['name'], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 2 mb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только PNG формат.</div>';
$ph[]=0;    
}else{
$size = GetImageSize($filename);
if ($size['0'] > $max_image_width	or $size['1'] > $max_image_height  ) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография превышает допустимые размеры.</div>';
$ph[]=0; 
}elseif ($size[0] < $min_image_width or $size[1] < $min_image_height){
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография слишком мала для работы.</div>';
$ph[]=0; }else{
$ph[]=1;
$photo_real=$filename;
}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$ephoto='error';}else{$ephoto='';}
        

 
if($ename=="" and $ecena==""){
    include_once "../component/translit.php";
    include '../component/resize_crop.php';
    

    $link = strtolower(translitIt($_POST['name']));
    $name=mysql_real_escape_string($_POST['name']);
    $count_dt=count($_POST['dvig']);
    
    for($i=0;$i<$count_dt;$i++){
    if($_POST['dvig'][$i]!=''){
    $dt=mysql_real_escape_string($_POST['dvig'][$i]);
    $add=mysql_query("INSERT INTO `complekt` SET 
        `name`='".$name."', 
        `link`='".$link."',
        `id_model`='".$_GET['view']."',
        `dt`='".$dt."',
        `tip`='".$_POST['tip'.$i]."'");
    $idd=mysql_insert_id();    
    $add=mysql_query("UPDATE `complekt` SET `idd`='".$idd."' WHERE `id`='".$idd."' ");
    }}

    
    if(in_array("1", $ph)){
    if (resize($photo_real, "../photo/complekt/".$link."_".$_GET['view']."_.png",685,0)) {
              crop("../photo/complekt/".$link."_".$_GET['view']."_.png", "../photo/complekt/".$link."_".$_GET['view'].".png", array(0,0,685,325));
              resize("../photo/complekt/".$link."_".$_GET['view'].".png","../photo/complekt/".$link."_".$_GET['view']."m.png",215,102);
              unlink("../photo/complekt/".$link."_".$_GET['view']."_.png");
              echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>Фото успешно загружено.</div>';
    }
    }

    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&features'></head><body>";
}  }
?>
    <tr><td>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
    <legend>Добавить Комплектацию</legend>
    </fieldset>
    
        <div class="control-group <?echo $ename;?>">
        <label class="control-label" for="inputk">Название</label>
        <div class="controls">
        <input type="text" id="inputk"  name="name" value="" class="input-xxlarge tblock" placeholder="Название" maxlength="200" rel="1" />
        <span id="span_text1"></span>
        </div>
        </div>
        
        <div class="control-group <?echo $ecena;?>">
        <label class="control-label" for="inputdk">д/т</label>
        <div class="controls">
        <input type="text" id="inputdk"  name="dvig[]"  class="input-xlarge" placeholder="двигатель и трансмиссия" /><i class="icon-plus dtplus" reg="1"></i>
        <div class="cl"></div>
        <label style="float: left;margin-right: 5px;"><input type="radio" name="tip0" value="0" checked="checked" />бен.</label>
        <label style="float: left;"><input type="radio" name="tip0" value="1" />диз.</label>
        </div></div>
        
        <div id="dtpl"></div>
        
        
        
        <div class="control-group <?echo $ephoto;?>">
        <label class="control-label">Изображение</label>
        <div class="controls">
        <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left;margin-left: 5px;">
        <div class="fileupload-preview thumbnail" style="width: 316px; height: 136px;"><img src="img/img685x325.jpg" /></div>
        <div><span class="btn btn-file"><span class="fileupload-new">Загрузить фото</span><span class="fileupload-exists">Change</span><input name="photo" type="file" accept="image/png"/></span>
        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
        </div></div></div></div>
  
  
  
        <div class="control-group">
        <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> 
        </div>
        </div>
  
  </form></td></tr>
    
<?}elseif(isset($_GET['edits_dt'])){
    
$compld=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt` WHERE id_model='".$_GET['view']."' AND `link`='".$_GET['edits_dt']."' LIMIT 1"));
$dtid=array();
$dt=array();
$dttip=array();
$cm0=mysql_query("SELECT * FROM  `complekt` WHERE id_model='".$_GET['view']."' AND link='".$compld['link']."' ORDER BY idd DESC");
    while($complekt0=mysql_fetch_array($cm0)){
        $dtid[]=$complekt0['id'];
        $dt[]=$complekt0['dt'];
        $dttip[]=$complekt0['tip'];
    }
    
    
    
if(!empty($_POST)){
        
if($_POST['name']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название авто. </div>';$ename='error';}else{$ename='';}
if($_POST['dvig'][0]=='' and !isset($_POST['dviged'])){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан двигатель Авто . </div>';$ecena='error';}else{$ecena='';}
   
$max_image_width	= 687;
$max_image_height	= 327;
$min_image_width	= 683;
$min_image_height	= 323;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("png");
if (is_uploaded_file($_FILES['photo']['tmp_name'])) {
$filename = $_FILES['photo']['tmp_name'];
$ext = substr($_FILES['photo']['name'], 1 + strrpos($_FILES['photo']['name'], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 2 mb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только PNG формат.</div>';
$ph[]=0;    
}else{
$size = GetImageSize($filename);
if ($size['0'] > $max_image_width	or $size['1'] > $max_image_height  ) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография превышает допустимые размеры.</div>';
$ph[]=0; 
}elseif ($size[0] < $min_image_width or $size[1] < $min_image_height){
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Фотография слишком мала для работы.</div>';
$ph[]=0; }else{
$ph[]=1;
$photo_real=$filename;
}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$ephoto='error';}else{$ephoto='';}
        

 
if($ename=="" and $ecena==""){
    
    include_once "../component/translit.php";
    include '../component/resize_crop.php';
    
    

    $link = strtolower(translitIt($_POST['name']));
    $name=mysql_real_escape_string($_POST['name']);
    $count_dt=count($_POST['dvig']);
    
    for($i=0;$i<$count_dt;$i++){
    if($_POST['dvig'][$i]!=''){
    $dt=mysql_real_escape_string($_POST['dvig'][$i]);
    $add=mysql_query("INSERT INTO `complekt` SET 
        `name`='".$name."', 
        `link`='".$link."',
        `id_model`='".$_GET['view']."',
        `dt`='".$dt."',
        `tip`='".$_POST['tip'.$i]."'");
    $idd=mysql_insert_id();    
    $add=mysql_query("UPDATE `complekt` SET `idd`='".$idd."' WHERE `id`='".$idd."' ");
    }}
    
    
    foreach($_POST['dviged'] as $key=>$val){
        $compld1=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt` WHERE id='".$key."' LIMIT 1"));
        if($compld1['dt']!=$val){
            $add=mysql_query("UPDATE `complekt` SET `dt`='".$val."' WHERE id='".$key."' ");
        }
    }
    
    if($compld['name']!=$name){
        $add=mysql_query("UPDATE `complekt` SET `name`='".$name."', `link`='".$link."' WHERE id_model='".$_GET['view']."' AND `link`='".$_GET['edits_dt']."' ");
        copy('../photo/complekt/'.$_GET['edits_dt'].'_'.$_GET['view'].'.png', '../photo/complekt/'.$link.'_'.$_GET['view'].'.png');
        copy('../photo/complekt/'.$_GET['edits_dt'].'_'.$_GET['view'].'m.png', '../photo/complekt/'.$link.'_'.$_GET['view'].'m.png');
        unlink("../photo/complekt/".$_GET['edits_dt']."_".$_GET['view'].".png");
        unlink("../photo/complekt/".$_GET['edits_dt']."_".$_GET['view']."m.png");
    }
   
    if(in_array("1", $ph)){
    if (resize($photo_real, "../photo/complekt/".$link."_".$_GET['view']."_.png",685,0)) {
              crop("../photo/complekt/".$link."_".$_GET['view']."_.png", "../photo/complekt/".$link."_".$_GET['view'].".png", array(0,0,685,325));
              resize("../photo/complekt/".$link."_".$_GET['view'].".png","../photo/complekt/".$link."_".$_GET['view']."m.png",215,102);
              unlink("../photo/complekt/".$link."_".$_GET['view']."_.png");
              echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>Фото успешно загружено.</div>';
    }}
    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&features'></head><body>";
}}
?>
<tr><td>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
    <legend>Изменить Комплектацию</legend>
    </fieldset>
    
        <div class="control-group <?echo $ename;?>">
        <label class="control-label" for="inputk">Название</label>
        <div class="controls">
        <input type="text" id="inputk"  name="name" value="<?echo $compld['name'];?>" class="input-xxlarge tblock" placeholder="Название" maxlength="200" rel="1" />
        <span id="span_text1"></span>
        </div>
        </div>
        
        <div class="control-group <?echo $ecena;?>">
        <label class="control-label" for="inputdk">д/т</label>
        <div class="controls">
        <input type="text" id="inputdk"  name="dviged[<?echo $dtid[0];?>]" value="<?echo $dt[0];?>"  class="input-xlarge" placeholder="двигатель и трансмиссия" /><i class="icon-plus dtplus" reg="0"></i>
        <div class="cl"></div>
        <label style="float: left;margin-right: 5px;"><input type="radio" name="tips0" value="0" <?if($dttip[0]==0){echo 'checked="checked"';}?>  />бен.</label>
        <label style="float: left;"><input type="radio" name="tips0" value="1" <?if($dttip[0]==1){echo 'checked="checked"';}?> />диз.</label>
        </div></div>
        
        <div id="dtpl">
        
        <?
        $count_dtd=count($dt);
        if($count_dtd>1){
        for($i=1;$i<$count_dtd;$i++){
        echo '<div class="control-group" id="dl'.$dtid[$i].'"> <label class="control-label" for="inputdk">д/т</label><div class="controls"><input type="text" id="inputdk"  name="dviged['.$dtid[$i].']" value="'.$dt[$i].'"  class="input-xlarge" placeholder="двигатель и трансмиссия" /><i class="icon-minus del_dl tool" data-title="Удалить" rel="'.$dtid[$i].'"></i><div class="cl"></div>
        <label style="float: left;margin-right: 5px;"><input type="radio" name="tips'.$i.'" value="0" '; if($dttip[$i]==0){echo 'checked="checked"';} echo' />бен.</label>
        <label style="float: left;"><input type="radio" name="tips'.$i.'" value="1" '; if($dttip[$i]==1){echo 'checked="checked"';} echo' />диз.</label>
        </div></div>';
            }
        }?>
        </div>
        
        <div class="control-group <?echo $ephoto;?>">
        <label class="control-label">Изображение</label>
        <div class="controls">
        <div class="fileupload fileupload-new" data-provides="fileupload" style="float: left;margin-left: 5px;">
        <div class="fileupload-preview thumbnail" style="width: 316px; height: 136px;"><img src="../photo/complekt/<?echo $compld['link'];?>_<?echo $_GET['view'];?>.png" /></div>
        <div><span class="btn btn-file"><span class="fileupload-new">Загрузить фото</span><span class="fileupload-exists">Change</span><input name="photo" type="file" accept="image/png"/></span>
        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
        </div></div></div></div>
  
        <div class="control-group">
        <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> 
        </div>
        </div>
  
  </form></td></tr>
<?}elseif(isset($_GET['complete'])){
    $complekts=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt` WHERE id='".$_GET['complete']."' LIMIT 1"));
    
    echo '<tr><td>'.$complekts['name'].' - '.$complekts['dt'].'</td></tr>';
    
    $cena=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt_pp` WHERE id_model=(SELECT `id` FROM  `complekt_p` WHERE model='".$complekts['id']."' AND `name`='Цена' LIMIT 1)"));
    
    
?>



<tr><td>
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset>
    <legend>Установить Комплектацию</legend>
    </fieldset>
    
        <div class="control-group <?echo $ecena;?>">
        <label class="control-label" for="inputk22">Цена $</label>
        <div class="controls">
        <input type="text" id="inputk22"  name="cena" value="<?echo $cena['name'];?>" class="input-large" placeholder="Цена в долларах"  /><i style="margin: 3px 0 0 5px;" id="sawe_cena" rel="<?echo $complekts['id'];?>" class="icon-check tool" data-title="Сохранить цену"></i>
        </div></div>
        
        
        <div class="control-group">
        <label class="control-label" for="inputsk">Варианты</label>
        <div class="controls">
        <input type="text" id="inputsk"  name="name" value="" class="input-xlarge" placeholder="Установить вариант Комплектации" />
        <i style="margin: 3px 0 0 5px;" id="sawe_comp" rel="<?echo $_GET['view'];?>" class="icon-check tool" data-title="Сохранить"></i>
        <div class="cl"></div>
        </div></div>
               
        <div id="sdddfge">
        
        
        <?
        $tf=mysql_query("SELECT * FROM  `complekt_p` WHERE  `model`='".$_GET['view']."' AND `name`!='Цена'");
        while($teh=mysql_fetch_array($tf)){
            
            
            echo'<div class="control-group">
                <label class="control-label" for="inputsk" id="lbbb'.$teh['id'].'">'.$teh['name'].'</label>
                <div class="controls">
                <input type="text" id="inputskn'.$teh['id'].'"  name="name" value="" class="input-xxlarge" placeholder="Установить '.$teh['name'].'" />
                <i style="margin: 3px 0 0 5px;" rel="'.$teh['id'].'" reg="'.$_GET['complete'].'" class="icon-plus tool sawe_comp_n" data-title="Добавить"></i>
                <i style="margin: 3px 0 0 5px;" rel="'.$teh['id'].'" class="icon-pencil tool edit_comp" data-title="Редактировать"></i>
                <div class="cl"></div>
                <label class="checkbox inline"><input type="checkbox" id="inl1'.$teh['id'].'"/> Обзор</label>
                <label class="checkbox inline"><input type="checkbox" id="inl2'.$teh['id'].'" checked="checked"/> Стандартные опции</label>
                <label class="checkbox inline"><input type="checkbox" id="inl3'.$teh['id'].'" checked="checked"/> Дополнительные опции</label>
                <div class="cl" style="height:20px;"></div>
                <table id="sddfg'.$teh['id'].'" class="table table-bordered">';
                
                
               
                
                $tf1=mysql_query("SELECT * FROM  `complekt_pp` WHERE  `id_model`='".$teh['id']."'  GROUP BY name  ");
                    while($teh1=mysql_fetch_array($tf1)){
                        
                        
            
                    $teh2=mysql_query("SELECT * FROM `complekt_pp` WHERE `id_model`='".$teh['id']."' AND `name`='".$teh1['name']."' AND `id_complete`='".$_GET['complete']."' ");
                        
                        if(mysql_num_rows($teh2)=='1'){
                            $tesee=mysql_fetch_array($teh2);
                            $id_complete=$tesee['id_complete'];
                            $val_m=$tesee['val'];
                            $vid=$tesee['id'];
                            $vname=$tesee['name'];
                            $voverview=$tesee['overview'];
                            $vstandard_options=$tesee['standard_options'];
                            $voptions=$tesee['options'];
                        }else{
                            $id_complete=$teh1['id_complete'];
                            $val_m=$teh1['val'];
                            $vid=$teh1['id'];
                            $vname=$teh1['name'];
                            $voverview=$teh1['overview'];
                            $vstandard_options=$teh1['standard_options'];
                            $voptions=$teh1['options'];
                        }
                        
                        if($id_complete==$_GET['complete']){
                            if($val_m==1){
                                $lk='<i class="icon-ok-circle"></i>';
                            }else{
                                $lk='<i class="icon-share"></i>';
                            }
                        }else{
                            $lk='<i class="icon-retweet tool dbl_complete" rel="'.$vid.'" reg="'.$_GET['complete'].'" data-title="Продублировать"></i>';
                        }
                        
                       echo'<tr><td>'.$vname.'</td><td  style="width: 90px;text-align: center;">
                       <span id="clob'.$vid.'" class="label '; if($voverview==1 and $id_complete==$_GET['complete']){echo'label-info';} if($id_complete==$_GET['complete']){echo ' cl_ob';}else{ echo ' error_cl';}    echo' " rel="'.$vid.'">об</span>
                       <span id="clso'.$vid.'" class="label '; if($vstandard_options==1 and $id_complete==$_GET['complete']){echo'label-info';} if($id_complete==$_GET['complete']){echo ' cl_so';}else{ echo ' error_cl';}  echo' " rel="'.$vid.'">ст</span>
                       <span id="clop'.$vid.'" class="label '; if($voptions==1 and $id_complete==$_GET['complete']){echo'label-info';} if($id_complete==$_GET['complete']){echo ' cl_op';}else{ echo ' error_cl';} echo' " rel="'.$vid.'">дп</span>
                       </td><td style="width: 30px;text-align: center;">'.$lk.'</td></tr>';
                    }
                    
                    
                    
                echo '</table></div></div>';
        
        }
        ?>

        </div>
        
        
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-body">
  <input type="text" id="inp_ed"  name="cena" value="" class="input-xlarge"   />
  <i style="margin: -2px 0 0 5px;" id="sawe2" rel="" class="icon-check tool" data-title="Сохранить"></i>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  </div>
</div>

<div id="myModal_copy" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-body" id="mod_error">
  
  <i class="icon-retweet tool" data-title="Продублировать"></i>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  </div>
</div>


        
        
        
        
        
        
        
        
       
        
        
  
        
  </form></td></tr>



<?}else{

$cm=mysql_query("SELECT DISTINCT `link` FROM  `complekt` WHERE id_model='".$_GET['view']."'");
while($complekt=mysql_fetch_array($cm)){
    $dt=array();
    $dtid=array();
    $cm0=mysql_query("SELECT * FROM  `complekt` WHERE id_model='".$_GET['view']."' AND link='".$complekt['link']."' ORDER BY idd DESC");
    while($complekt0=mysql_fetch_array($cm0)){
        $name=$complekt0['name'];
        
        
        
        $dt[]=$complekt0['dt'];
        $dtid[]=$complekt0['id'];
    }

   
    echo '<tr id="df'.$complekt['link'].$_GET['view'].'"><td style="width: 220px;">'.$name.'<br><img src="../photo/complekt/'.$complekt['link'].'_'.$_GET['view'].'m.png" /></td><td class="dt_model">
    <table class="table table-bordered">';
    foreach($dt as $key=>$val){
        
       
        $cena=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt_pp` WHERE `id_model`=(SELECT `id` FROM  `complekt_p` WHERE `model`='".$dtid[$key]."' AND `name`='Цена' LIMIT 1) LIMIT 1"));
        if(!isset($cena['name'])){
            $clas_cena='act-danger';
            $cenas='none';
            $cen_='';
        }else{
            $clas_cena='act-info';
            $cenas=number_format($cena['name'], 2, ',', ' ').' $';
            $cen_=$cena['name'];
        }
       
        
        echo '<tr id="dfght'.$dtid[$key].'"><td>'.$val.'</td><td style="width:135px;text-align: center;"><span id="el'.$dtid[$key].'" class="cur_id_cena '.$clas_cena.'" rel="'.$dtid[$key].'" reg="'.$cen_.'">'.$cenas.'</span></td>
                    <td style="width:55px;"><a href="?models&view=21&features&complete='.$dtid[$key].'"><i class="icon-share"></i></a>
                    <i class="icon-remove deldts" rel="'.$dtid[$key].'"></i>
                    <a href=""><i class="icon-eye-open"></i></a></td></tr>';
    }
    
    echo'</table></td>
        <td style="width:35px;">
        <a href="?models&view=21&features&edits_dt='.$complekt['link'].'"><i class="icon-pencil"></i></a>
        <i class="icon-remove del_m_dt" rel="'.$complekt['link'].'" reg="'.$_GET['view'].'" ></i>
        
        </td>
        </tr>';



    unlink($dt);
    unlink($dtid);
    unlink($name);
}?>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-body">
  <input type="text" id="inputk22"  name="cena" value="" class="input-xlarge" placeholder="Цена в долларах"  /><i style="margin: -2px 0 0 5px;" id="sawe_cena2" rel="" class="icon-check tool" data-title="Сохранить цену"></i>
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  </div>
</div>



<?}?>






  
    
    
    
    
    
    
<?    
}elseif(isset($_GET['catalog'])){
    
    if(isset($_GET['add'])){
       if(!empty($_POST)){
 if($_POST['name']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название авто. </div>';$ename='error';}else{
    include_once "../component/translit.php";
    $link = strtolower(translitIt($_POST['name']));
    $name=mysql_real_escape_string($_POST['name']);
    
    
    
    
    
    $add=mysql_query("INSERT INTO `catalogi` SET 
        `name`='".$name."',
        `link`='".$link."', 
        `model`='".$_GET['view']."'");
    $id=mysql_insert_id();
if ( $_FILES["photo"]["error"] == 0){
    $fph=end(explode(".", $_FILES["photo"]["name"]));
    move_uploaded_file($_FILES["photo"]["tmp_name"], '../photo/catalog/'.$link.'_'.$_GET['view'].'_'.$id.'.'.$fph);
}
  if ( $_FILES["files"]["error"] == 0){
    $ffl=end(explode(".", $_FILES["files"]["name"]));
    move_uploaded_file($_FILES["files"]["tmp_name"], '../photo/catalog/'.$link.'_'.$_GET['view'].'_'.$id.'.'.$ffl);
} 



$add=mysql_query("UPDATE `catalogi` SET idd='".$id."', `ph`='".$fph."', `fl`='".$ffl."'  WHERE id='".$id."'");

echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&catalog'></head><body>";     
}}
    echo '<tr><td colspan="4">
    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
    <fieldset><legend>Добавить Каталог</legend></fieldset><div class="control-group"> <label class="control-label" for="inputk">Название</label><div class="controls"><input type="text" id="inputk"  name="name" value="" class="input-xxlarge tblock" placeholder="Название" maxlength="200" rel="5" /><span id="span_text5"></span></div></div><div class="control-group"><label class="control-label">Фаил</label><div class="controls"><div class="fileupload fileupload-new" data-provides="fileupload">
  <span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="files"  /></span>
  <span class="fileupload-preview"></span><a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
</div></div></div><div class="control-group "><label class="control-label">Изображение</label><div class="controls"><div class="fileupload fileupload-new" data-provides="fileupload" style="float: left;margin-left: 5px;"><div class="fileupload-preview thumbnail" style="width: 136px; height: 136px;"></div><div><span class="btn btn-file"><span class="fileupload-new">Загрузить фото</span><span class="fileupload-exists">Change</span><input name="photo" type="file" accept="image/*"/></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></div></div></div></div><div class="control-group"><div class="controls"><input type="submit" value="Сохранить" class="btn btn-primary" /> </div></div></form></td></tr>';
    }else{
    
    $ct=mysql_query("SELECT * FROM  `catalogi` WHERE model='".$_GET['view']."' ORDER BY idd DESC");
    while($catalog=mysql_fetch_array($ct)){ 
        if($catalog['ph']==''){$ph='jpg';}else{$ph=$catalog['ph'];}
        if($catalog['fl']==''){$fl='pdf';}else{$fl=$catalog['fl'];}
        echo '<tr class="id_'.$catalog['id'].'"><td style="width: 130px;">
        <img style="width: 130px;" src="../photo/catalog/'.$catalog['link'].'_'.$_GET['view'].'_'.$catalog['id'].'.'.$ph.'" /></td>
        <td>'.$catalog['name'].'</td><td style="width: 100px;"><a target="_blank" href="../photo/catalog/'.$catalog['link'].'_'.$_GET['view'].'_'.$catalog['id'].'.'.$fl.'">
        <i class="icon-eye-open"></i></a> <i class="icon-remove del_cat" rel="'.$catalog['id'].'"></i></td></tr>';
    }
    }
}elseif(isset($_GET['overview'])){
    if(isset($_GET['add'])){
        if(!empty($_POST)){
        include_once "../component/translit.php";
        $link=translitIt($_POST['link']);
        $name=mysql_real_escape_string($_POST['name']);
        $text=mysql_real_escape_string($_POST['text']);
        $t=mysql_real_escape_string($_POST['t']);
        $d=mysql_real_escape_string($_POST['d']);
        $k=mysql_real_escape_string($_POST['k']);
        $add=mysql_query("INSERT INTO `model_page` SET `tip`='0',`model`='".$_GET['view']."', `name`='".$name."',`link`='".$link."', `k`='".$k."', `d`='".$d."', `t`='".$t."', `text`='".$text."',`date`=NOW()");
        $id=mysql_insert_id();
        $add=mysql_query("UPDATE `model_page` SET `idd`='".$id."' WHERE `id`='".$id."'");
        echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&overview'></head><body>"; }
        echo '<tr><td><form class="form-horizontal" method="post" action="" enctype="multipart/form-data"><fieldset><legend>Добавить Обзор</legend><div class="control-group"><label class="control-label" for="inputname">Название</label><div class="controls"><input type="text" id="inputname"  name="name" value="" class="input-xxlarge tblock" placeholder="Название" maxlength="250" rel="1" /><span id="span_text1"></span></div></div><div class="control-group"><label class="control-label" for="inputname3">URL</label><div class="controls"><input type="text" id="inputname3" name="link" value="" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="250" rel="2" /><span id="span_text2"></span></div></div><div class="control-group"><label class="control-label" for="textarea1">Описание</label><div class="controls"><textarea name="text" id="textarea1" placeholder="Описание"></textarea></div></div><div class="control-group "><label class="control-label" for="inputt">Title </label><div class="controls"><input type="text" id="inputt"  name="t" value="" class="input-xxlarge tblock" placeholder="Title" maxlength="300" rel="4" /><span id="span_text4"></span></div></div><div class="control-group "><label class="control-label" for="inputk">Ключевые слова </label><div class="controls"><input type="text" id="inputk"  name="k" value="" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="500" rel="5" /><span id="span_text5"></span></div></div><div class="control-group  "><label class="control-label" for="inputd">description</label><div class="controls"><input type="text" id="inputd" name="d" value="" class="input-xxlarge tblock" placeholder="description" maxlength="500" rel="6" /><span id="span_text6"></span></div></div><div class="control-group"> <div class="controls"><input type="submit" value="Сохранить" class="btn btn-primary" /> </div></div></fieldset></form></td></tr>';
    }elseif(isset($_GET['edit'])){
        $p_mod=mysql_fetch_array(mysql_query("SELECT * FROM  `model_page` WHERE `id`='".$_GET['edit']."' AND `tip`='0' LIMIT 1"));
        if(!empty($_POST)){
        include_once "../component/translit.php";
        $link=translitIt($_POST['link']);
        $name=mysql_real_escape_string($_POST['name']);
        $text=mysql_real_escape_string($_POST['text']);
        $t=mysql_real_escape_string($_POST['t']);
        $d=mysql_real_escape_string($_POST['d']);
        $k=mysql_real_escape_string($_POST['k']);
        $add=mysql_query("UPDATE  `model_page` SET  `name`='".$name."',`link`='".$link."', `k`='".$k."', `d`='".$d."', `t`='".$t."', `text`='".$text."' WHERE `id`='".$_GET['edit']."'");
        echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&overview'></head><body>"; }
        echo '<tr><td><form class="form-horizontal" method="post" action="" enctype="multipart/form-data"><fieldset><legend>Редактировать Обзор</legend> <div class="control-group"><label class="control-label" for="inputname">Название</label><div class="controls"><input type="text" id="inputname"  name="name" value="'.$p_mod['name'].'" class="input-xxlarge tblock" placeholder="Название" maxlength="250" rel="1" /><span id="span_text1"></span></div></div> <div class="control-group"><label class="control-label" for="inputname3">URL</label><div class="controls"><input type="text" id="inputname3" name="link" value="'.$p_mod['link'].'" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="250" rel="2" /><span id="span_text2"></span></div></div><div class="control-group"><label class="control-label" for="textarea1">Описание</label><div class="controls"><textarea name="text" id="textarea1" placeholder="Описание">'.$p_mod['text'].'</textarea></div></div><div class="control-group "><label class="control-label" for="inputt">Title </label><div class="controls"><input type="text" id="inputt"  name="t" value="'.$p_mod['t'].'" class="input-xxlarge tblock" placeholder="Title" maxlength="300" rel="4" /><span id="span_text4"></span></div></div><div class="control-group "><label class="control-label" for="inputk">Ключевые слова </label><div class="controls"><input type="text" id="inputk"  name="k" value="'.$p_mod['k'].'" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="500" rel="5" /><span id="span_text5"></span></div></div><div class="control-group  "><label class="control-label" for="inputd">description</label><div class="controls"><input type="text" id="inputd" name="d" value="'.$p_mod['d'].'" class="input-xxlarge tblock" placeholder="description" maxlength="500" rel="6" /><span id="span_text6"></span></div></div><div class="control-group"> <div class="controls"><input type="submit" value="Сохранить" class="btn btn-primary" /> </div></div></fieldset></form></td></tr>';
    }else{$p=mysql_query("SELECT * FROM  `model_page` WHERE `model`='".$_GET['view']."' AND `tip`='0' ORDER BY idd DESC");while($page_mod=mysql_fetch_array($p)){ echo '<tr id="tr'.$page_mod['id'].'"><td>'.$page_mod['name'].' <i class="icon-remove tool pull-right del_m_p" rel="'.$page_mod['id'].'" data-original-title="Удалить"></i> <a href="?models&view='.$_GET['view'].'&overview&edit='.$page_mod['id'].'"><i class="icon-pencil tool pull-right" data-original-title="Редактировать"></i></a></td></tr>';}}
}elseif(isset($_GET['special'])){
    if(isset($_GET['add'])){
        if(!empty($_POST)){
        include_once "../component/translit.php";
        $link=translitIt($_POST['link']);
        $name=mysql_real_escape_string($_POST['name']);
        $text=mysql_real_escape_string($_POST['text']);
        $t=mysql_real_escape_string($_POST['t']);
        $d=mysql_real_escape_string($_POST['d']);
        $k=mysql_real_escape_string($_POST['k']);
        $add=mysql_query("INSERT INTO `model_page` SET `tip`='1',`model`='".$_GET['view']."', `name`='".$name."',`link`='".$link."', `k`='".$k."', `d`='".$d."', `t`='".$t."', `text`='".$text."',`date`=NOW()");
        $id=mysql_insert_id();
        $add=mysql_query("UPDATE `model_page` SET `idd`='".$id."' WHERE `id`='".$id."'");
        if($_FILES["photo"]['error']==0){
        $filename = $_FILES['photo']['tmp_name'];
        include_once "../component/class.thumb.php";
        $foto_b = "../photo/volkswagen_img_special_m_".$id.".jpg";
        $foto_ = "../photo/volkswagen_img_special_".$id.".jpg";
        $tn_image2 = new Thumbnail($filename, 685); $tn_image2->save($foto_);
        $tn_image = new Thumbnail($filename, 215); $tn_image->save($foto_b);}
        echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&special'></head><body>"; }echo '<tr><td><form class="form-horizontal" method="post" action="" enctype="multipart/form-data"><fieldset><legend>Добавить Спецпредложение</legend><div class="control-group"><label class="control-label" for="inputname">Название</label><div class="controls"><input type="text" id="inputname"  name="name" value="" class="input-xxlarge tblock" placeholder="Название" maxlength="250" rel="1" /><span id="span_text1"></span></div></div> <div class="control-group"><label class="control-label" for="inputname3">URL</label><div class="controls"><input type="text" id="inputname3" name="link" value="" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="250" rel="2" /><span id="span_text2"></span></div></div><div class="control-group"><label class="control-label" for="textarea1">Описание</label><div class="controls"><textarea name="text" id="textarea1" placeholder="Описание"></textarea></div></div> <div class="control-group "><label class="control-label" for="inputt">Title </label><div class="controls"><input type="text" id="inputt"  name="t" value="" class="input-xxlarge tblock" placeholder="Title" maxlength="300" rel="4" /><span id="span_text4"></span></div></div> <div class="control-group "><label class="control-label" for="inputk">Ключевые слова </label><div class="controls"><input type="text" id="inputk"  name="k" value="" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="500" rel="5" /><span id="span_text5"></span></div></div> <div class="control-group  "><label class="control-label" for="inputd">description</label><div class="controls"><input type="text" id="inputd" name="d" value="" class="input-xxlarge tblock" placeholder="description" maxlength="500" rel="6" /><span id="span_text6"></span></div></div> <div class="control-group"><label class="control-label" for="inputico">Изображение</label><div class="controls"><div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-preview thumbnail" style="width: 215px; height: 105px;"><img src="img/img215x102.jpg" /></div><div><span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo" type="file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></div></div></div></div><div class="control-group"> <div class="controls"><input type="submit" value="Сохранить" class="btn btn-primary" /> </div></div></fieldset></form></td></tr>';
}elseif(isset($_GET['edit'])){
        $p_mod=mysql_fetch_array(mysql_query("SELECT * FROM  `model_page` WHERE `id`='".$_GET['edit']."' AND `tip`='1' LIMIT 1"));
        if(!empty($_POST)){
        include_once "../component/translit.php";
        $link=translitIt($_POST['link']);
        $name=mysql_real_escape_string($_POST['name']);
        $text=mysql_real_escape_string($_POST['text']);
        $t=mysql_real_escape_string($_POST['t']);
        $d=mysql_real_escape_string($_POST['d']);
        $k=mysql_real_escape_string($_POST['k']);
        $add=mysql_query("UPDATE  `model_page` SET  `name`='".$name."',`link`='".$link."', `k`='".$k."', `d`='".$d."', `t`='".$t."', `text`='".$text."' WHERE `id`='".$_GET['edit']."'");
        if($_FILES["photo"]['error']==0){
        $filename = $_FILES['photo']['tmp_name'];
        include_once "../component/class.thumb.php";
        $foto_b = "../photo/volkswagen_img_special_m_".$_GET['edit'].".jpg";
        $foto_ = "../photo/volkswagen_img_special_".$_GET['edit'].".jpg";
        $tn_image2 = new Thumbnail($filename, 685); $tn_image2->save($foto_);
        $tn_image = new Thumbnail($filename, 215); $tn_image->save($foto_b);}
        echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?models&view=".$_GET['view']."&special'></head><body>"; }echo '<tr><td><form class="form-horizontal" method="post" action="" enctype="multipart/form-data"><fieldset><legend>Редактировать Спецпредложение</legend><div class="control-group"><label class="control-label" for="inputname">Название</label><div class="controls"><input type="text" id="inputname"  name="name" value="'.$p_mod['name'].'" class="input-xxlarge tblock" placeholder="Название" maxlength="250" rel="1" /><span id="span_text1"></span></div></div><div class="control-group"><label class="control-label" for="inputname3">URL</label><div class="controls"><input type="text" id="inputname3" name="link" value="'.$p_mod['link'].'" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="250" rel="2" /><span id="span_text2"></span></div></div><div class="control-group"><label class="control-label" for="textarea1">Описание</label><div class="controls"><textarea name="text" id="textarea1" placeholder="Описание">'.$p_mod['text'].'</textarea></div></div><div class="control-group "><label class="control-label" for="inputt">Title </label><div class="controls"><input type="text" id="inputt"  name="t" value="'.$p_mod['t'].'" class="input-xxlarge tblock" placeholder="Title" maxlength="300" rel="4" /><span id="span_text4"></span></div></div><div class="control-group "><label class="control-label" for="inputk">Ключевые слова </label><div class="controls"><input type="text" id="inputk"  name="k" value="'.$p_mod['k'].'" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="500" rel="5" /><span id="span_text5"></span></div></div><div class="control-group  "><label class="control-label" for="inputd">description</label><div class="controls"><input type="text" id="inputd" name="d" value="'.$p_mod['d'].'" class="input-xxlarge tblock" placeholder="description" maxlength="500" rel="6" /><span id="span_text6"></span></div></div><div class="control-group"><label class="control-label" for="inputico">Изображение</label><div class="controls"><div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-preview thumbnail" style="width: 215px; height: 105px;"><img src="../photo/volkswagen_img_special_m_'.$p_mod['id'].'.jpg" /></div><div><span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo" type="file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></div></div></div></div><div class="control-group"> <div class="controls"><input type="submit" value="Сохранить" class="btn btn-primary" /> </div></div></fieldset></form></td></tr>';}else{$p=mysql_query("SELECT * FROM  `model_page` WHERE `model`='".$_GET['view']."' AND `tip`='1' ORDER BY idd DESC");while($page_mod=mysql_fetch_array($p)){ echo '<tr id="tr'.$page_mod['id'].'"><td><img class="pull-left img-polaroid" src="../photo/volkswagen_img_special_m_'.$page_mod['id'].'.jpg"> '.$page_mod['name'].' <i class="icon-remove tool pull-right del_m_p" rel="'.$page_mod['id'].'" data-original-title="Удалить"></i> <a href="?models&view='.$_GET['view'].'&special&edit='.$page_mod['id'].'"><i class="icon-pencil tool pull-right" data-original-title="Редактировать"></i></a></td></tr>';}}}
?>




<td></td>



</table>



<?}else{?>
  

<table class="table table-hover table-condensed table-bordered">

<?
$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='0' ORDER BY idd DESC");
    while($mset=mysql_fetch_array($ms)){ 
echo '<tr class="success"><td colspan="3" >'.$mset['id'].' '.$mset['name'].'</td></tr>';
$md=mysql_query("SELECT * FROM  `models` WHERE categiry='".$mset['link']."'");
while($model=mysql_fetch_array($md)){
    echo '<tr><td style="width: 120px;"><img src="../photo/model/'.$model['link'].'0.png"/></td><td>'.$model['name'].'<p><b>Цена:</b> '.$model['cena'].'</p></td>
    <td style="width: 120px;"><a href="?models&edit_m='.$model['id'].'"><i class="icon-pencil"></i></a>
    <a href="?models&view='.$model['id'].'"><i class="icon-share"></i></a></td></tr>';
}}
?>


</table>







    
<?}?>
</div>


</div>

</div></div>
       

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h3 id="myModalLabel">Установка фильтра</h3></div><div class="modal-body" id="mb_s">



</div></div>
       
       