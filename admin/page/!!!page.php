<?
 if($_GET['page']!=''){
    switch($_GET['page']){
      case('salesavto'): $hed="Акционные автомобили в наличии";$id_menu='5'; break;
        case('purchase_finance'): $hed="Спецпредложения";$id_menu='0'; break;
        case('service'): $hed="Сервис";$id_menu='3'; break;
        case('company'): $hed="Мир Volkswagen";$id_menu='4'; break;
    }
if($hed!=''){
?>

<div class="container">
      <div class="row-fluid">

       <div class="span12">

<?if(isset($_GET['add_p'])){
   
  
if(isset($_POST['type'])){   
if($_POST['mname']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название страницы. </div>';$ename='error';}else{$ename='';}
if($_POST['pmenu']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название страницы для второго меню. </div>';$epname='error';}else{$epname='';}
if($_POST['link']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Отсутствует URL адрес страницы. </div>';$elink='error';}else{$elink='';}
if($_POST['t']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Title. </div>';$error_title='error';}else{$error_title='';}
if($_POST['d']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Description. </div>';$error_des='error';}else{$error_des='';}
if($_POST['k']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Keywords. </div>';$error_key='error';}else{$error_key='';}


//Проверяем наличие фото по допустимым параметрам 
$max_image_width	= 216;
$max_image_height	= 103;
$min_image_width	= 214;
$min_image_height	= 101;
$max_image_size		= 25 * 1024;
$valid_types 		=  array("jpg", "jpeg");
$ph_int=count($_FILES["photo"]['error']);
for($i=0;$i<$ph_int;$i++){
if (is_uploaded_file($_FILES['photo']['tmp_name'][$i])) {
$filename = $_FILES['photo']['tmp_name'][$i];
$ext = substr($_FILES['photo']['name'][$i], 1 + strrpos($_FILES['photo']['name'][$i], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 25 kb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только JPG формат.</div>';
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
$photo_real[]=$filename;
}}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$error_photo='error';}else{$error_photo='';}

    


//если все впорядке Добавляем в базу 

if($ename=='' and  $epname=='' and $elink=='' and $error_title=='' and $error_des=='' and $error_key=='' and $error_photo==''){
    include_once "../component/translit.php";
    $link=translitIt($_POST['link']);
    $mname=($_POST['mname']);
    $pmenu=($_POST['pmenu']);
    $title=($_POST['t']);
    $des=($_POST['d']);
    $key=($_POST['k']);
    $text=($_POST['text']);
    $add=mysql_query("INSERT INTO `arr` SET `menu`='".$id_menu."',`type`='".$_POST['type']."', `nmenu`='".$mname."',`link`='".$link."', `pmenu`='".$pmenu."', `k`='".$key."', `d`='".$des."', `t`='".$title."', `text`='".$text."',`date`=NOW()");
    $id=mysql_insert_id();
    $add=mysql_query("UPDATE `arr` SET `idd`='".$id."' WHERE `id`='".$id."'");
    include_once "../component/class.thumb.php";
    $ph_int2=count($photo_real);
    for($i=0;$i<$ph_int2;$i++){$foto_b = "../photo/volkswagen_img_".$id.".jpg";$tn_image = new Thumbnail($photo_real[$i], 215); $tn_image->save($foto_b);}
    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."'></head><body>";
    }}  
?>



<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
<fieldset>
    <legend>Добавить страницу в <?echo $hed;?></legend>

<div class="control-group">
    <label class="control-label">Структура страницы <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Страница одна или содержит вложеные страницы? такие как (новости, акции).'}}).show();"></i></label>
    <div class="controls">
        <label class="radio"><input type="radio" value="0" name="type" <?if(isset($_POST['type'])){if($_POST['type']==0){echo 'checked="checked"';}}else{echo 'checked="checked"';}?>  />Одиночная страница</label>
        <label class="radio"><input type="radio" value="1" name="type"<?if(isset($_POST['type'])){if($_POST['type']==1){echo 'checked="checked"';}}?>  />Група страниц</label>
    </div>
</div>    

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Название в меню <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в выплывающем меню своей категории.'}}).show();"></i></label>
    <div class="controls">
    <input type="text" id="inputname" name="mname" value="<?if(isset($_POST['mname'])){echo $_POST['mname'];}?>" class="input-xxlarge tblock" placeholder="Название в меню" maxlength="50" rel="1" />
    <span id="span_text1"></span>
    </div>
</div>
<div class="control-group <?echo $epname;?>">
    <label class="control-label" for="inputname2">Название в меню 2 <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в заголовке при открытой категории.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname2" name="pmenu" value="<?if(isset($_POST['pmenu'])){echo $_POST['pmenu'];}?>" class="input-xxlarge tblock" placeholder="Название в меню 2" maxlength="70" rel="2" />
      <span id="span_text2"></span>
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
    <label class="control-label" for="textarea1">Описание</label>
    <div class="controls">
      <textarea name="text" id="textarea1" placeholder="Описание"><?if(isset($_POST['text'])){echo $_POST['text'];}?></textarea>
    </div>
  </div>
  
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

<div class="control-group <?echo $error_photo;?>">
    <label class="control-label" for="inputico">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется под основным баннером, размер 215 на 102 пикселей.'}}).show();"></i></label>
    <div class="controls">
     <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 215px; height: 105px;"><img src="img/img215x102.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div></div></div>

<div class="control-group">
      <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> 
     </div>
</div>

</fieldset>
</form>




<?}elseif(isset($_GET['add_pp'])){
   
  
  $prod=mysql_fetch_array(mysql_query("SELECT * FROM  `arr` WHERE id='".$_GET['add_pp']."'"));
  
  
  
if(!empty($_POST)){   
if($_POST['name']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название страницы. </div>';$ename='error';}else{$ename='';}
if($_POST['link']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Отсутствует URL адрес страницы. </div>';$elink='error';}else{$elink='';}
if($_POST['t']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Title. </div>';$error_title='error';}else{$error_title='';}
if($_POST['d']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Description. </div>';$error_des='error';}else{$error_des='';}
if($_POST['k']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Keywords. </div>';$error_key='error';}else{$error_key='';}


//Проверяем наличие фото по допустимым параметрам 
$max_image_width	= 3216;
$max_image_height	= 3103;
$min_image_width	= 214;
$min_image_height	= 101;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("jpg", "jpeg");
$ph_int=count($_FILES["photo"]['error']);
for($i=0;$i<$ph_int;$i++){
if (is_uploaded_file($_FILES['photo']['tmp_name'][$i])) {
$filename = $_FILES['photo']['tmp_name'][$i];
$ext = substr($_FILES['photo']['name'][$i], 1 + strrpos($_FILES['photo']['name'][$i], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 25 kb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только JPG формат.</div>';
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
$photo_real[]=$filename;
}}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$error_photo='error';}else{$error_photo='';}

    


//если все впорядке Добавляем в базу 

if($ename=='' and  $elink=='' and $error_title=='' and $error_des=='' and $error_key=='' and $error_photo==''){
    include_once "../component/translit.php";
    $link=translitIt($_POST['link']);
    $name=$_POST['name'];
    $title=$_POST['t'];
    $des=$_POST['d'];
    $key=$_POST['k'];
    $text=$_POST['text'];
  
  
  
 // echo $_POST['text'].'<br><hr><br>'.$text.'<br><hr><br>';
  

  
  
    $add=mysql_query("INSERT INTO `arr_page` SET 
        `name`='".$name."',
        `id_arr`='".$_GET['add_pp']."',
        `link`='".$link."',
        `k`='".$key."',
        `d`='".$des."',
        `t`='".$title."',
        `text`='".$text."',
        `date`=NOW()");
    $id=mysql_insert_id();
    $add=mysql_query("UPDATE `arr_page` SET `idd`='".$id."' WHERE `id`='".$id."'");
    include_once "../component/class.thumb.php";
    $ph_int2=count($photo_real);
    for($i=0;$i<$ph_int2;$i++){$foto_b = "../photo/volkswagen_img_".$id."_.jpg";$tn_image = new Thumbnail($photo_real[$i], 215); $tn_image->save($foto_b);}
    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."&arr=".$_GET['add_pp']."'></head><body>";
    
    

    
    }}  
    
    
    
?>



<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
<fieldset>
    <legend>Добавить страницу в <?echo $hed;?> / <?echo $prod['nmenu'];?></legend>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Название<i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в заголовке и формировании url адреса.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname" name="name" value="<?if(isset($_POST['name'])){echo $_POST['name'];}?>" class="input-xxlarge tblock" placeholder="Название" maxlength="70" rel="1" />
      <span id="span_text1"></span>
    </div>
</div>
<div class="control-group <?echo $elink;?>">
    <label class="control-label" for="inputname3">URL <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'url адрес страницы, спец символы разрешены только нижнее подчеркивание.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname3" name="link" value="<?if(isset($_POST['link'])){echo $_POST['link'];}?>" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="70" rel="3" />
      <span id="span_text3"></span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="textarea1">Описание</label>
    <div class="controls">
      <textarea name="text" id="textarea1" placeholder="Описание"><?echo $_POST['text'];?></textarea>
    </div>
  </div>
  
  <div class="control-group <?echo $error_title;?>">
    <label class="control-label" for="inputt">Title <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Определяет заголовок документа.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputt"  name="t" value="<?echo $_POST['t'];?>" class="input-xxlarge tblock" placeholder="Title" maxlength="150" rel="4" />
      <span id="span_text4"></span>
    </div>
  </div>
  
  <div class="control-group <?echo $error_key;?>">
    <label class="control-label" for="inputk">Ключевые слова <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Набор ключевых слов близок к аннотации, указывать через запятую.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputk"  name="k" value="<?echo $_POST['k'];?>" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="250" rel="5" />
      <span id="span_text5"></span>
    </div>
  </div>
  <div class="control-group  <?echo $error_des;?>">
    <label class="control-label" for="inputd">description <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Дается краткое описание содержания страницы.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputd" name="d" value="<?echo $_POST['d'];?>" class="input-xxlarge tblock" placeholder="description" maxlength="250" rel="6" />
      <span id="span_text6"></span>
    </div>
  </div>

<div class="control-group <?echo $error_photo;?>">
    <label class="control-label" for="inputico">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется при выборе, размер до 3000 пикселей.'}}).show();"></i></label>
    <div class="controls">
     <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 102px; height: 102px;"><img src="img/img.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div></div></div>

<div class="control-group">
      <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> 
     </div>
</div>

</fieldset>
</form>



<?}elseif(isset($_GET['edit_r'])){
   
  
  $prd=mysql_fetch_array(mysql_query("SELECT * FROM  `arr_page` WHERE id='".$_GET['edit_r']."'"));
  
  $prod=mysql_fetch_array(mysql_query("SELECT * FROM  `arr` WHERE id='".$prd['id_arr']."'"));
  
  
  
if(!empty($_POST)){   
if($_POST['name']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название страницы. </div>';$ename='error';}else{$ename='';}
if($_POST['link']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Отсутствует URL адрес страницы. </div>';$elink='error';}else{$elink='';}
if($_POST['t']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Title. </div>';$error_title='error';}else{$error_title='';}
if($_POST['d']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Description. </div>';$error_des='error';}else{$error_des='';}
if($_POST['k']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Keywords. </div>';$error_key='error';}else{$error_key='';}




if(isset($_FILES["photo"]) and $_FILES["photo"]['error'][0]==0){

//Проверяем наличие фото по допустимым параметрам 
$max_image_width	= 3216;
$max_image_height	= 3103;
$min_image_width	= 204;
$min_image_height	= 91;
$max_image_size		= 2048 * 1024;
$valid_types 		=  array("jpg", "jpeg");
$ph_int=count($_FILES["photo"]['error']);
for($i=0;$i<$ph_int;$i++){
if (is_uploaded_file($_FILES['photo']['tmp_name'][$i])) {
$filename = $_FILES['photo']['tmp_name'][$i];
$ext = substr($_FILES['photo']['name'][$i], 1 + strrpos($_FILES['photo']['name'][$i], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 25 kb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только JPG формат.</div>';
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
$photo_real[]=$filename;
}}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$error_photo='error';}else{$error_photo='';}
}
    


//если все впорядке Добавляем в базу 

if($_POST['name']!='' ){
    
    include_once "../component/translit.php";
    $link=translitIt($_POST['link']);
    $name=$_POST['name'];
    $title=$_POST['t'];
    $des=$_POST['d'];
    $key=$_POST['k'];
    $text=egnore_text($_POST['text']);
    
    
    
    
    
    
    $add=mysql_query("UPDATE `arr_page` SET  `name`='".$name."', 
    `link`='".$link."', 
    `k`='".$key."', 
    `d`='".$des."', 
    `t`='".$title."',
    `text`='".$text."' 
    WHERE `id`='".$_GET['edit_r']."'") or die(mysql_error());
        
   
  
if(isset($_FILES["photo"]) and $_FILES["photo"]['error'][0]==0){
if(in_array("1", $ph)){
    include_once "../component/class.thumb.php";
    $ph_int2=count($photo_real);
    for($i=0;$i<$ph_int2;$i++){$foto_b = "../photo/volkswagen_img_".$_GET['edit_r']."_.jpg";$tn_image = new Thumbnail($photo_real[$i], 215); $tn_image->save($foto_b);}
    if($_POST['rassilka']=='1'){
    
        $tq=mysql_query("SELECT * FROM client WHERE status='1'", $db);
    while($cl = mysql_fetch_array($tq)){

    
    $to=$cl['mail'];
    $format=$cl['format'];
    $mail='karpatya@avtocenter.com.ua';
    $hash=$cl['hash'];
    
    $subject = "Свежая новость с сайта \"karpaty-autocenter.com.ua\"";
    
    $text5 =$text;
    
    $text5.="Если Вы хотите отписаться от рассылки пройдите по ссылке karpaty-autocenter.com.ua/page/register_user.php?hash=$hash \r\n";
    
    $extra = "From: $mail\r\nReply-To: $mail\r\n";
    $extra .= "Content-type: text/$format; charset=Windows-1251;\r\n";
     mail (iconv("UTF-8", "windows-1251",$to), iconv("UTF-8", "windows-1251",$subject), iconv("UTF-8", "windows-1251",$text5), iconv("UTF-8", "windows-1251",$extra) );

    }}
}}


echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."&arr=".$prd['id_arr']."'></head><body>";
}}  

?>
<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
<fieldset>
    <legend>Редактировать страницу в <?echo $hed;?> / <?echo $prod['nmenu'];?></legend>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Название<i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в заголовке и формировании url адреса.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname" name="name" value="<?if(isset($_POST['name'])){echo $_POST['name'];}else{echo $prd['name'];}?>" class="input-xxlarge tblock" placeholder="Название" maxlength="70" rel="1" />
      <span id="span_text1"></span>
    </div>
</div>
<div class="control-group <?echo $elink;?>">
    <label class="control-label" for="inputname3">URL <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'url адрес страницы, спец символы разрешены только нижнее подчеркивание.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname3" name="link" value="<?if(isset($_POST['link'])){echo $_POST['link'];}else{echo $prd['link'];}?>" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="50" rel="3" />
      <span id="span_text3"></span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="textarea1">Описание</label>
    <div class="controls">
      <textarea name="text" id="textarea1" placeholder="Описание"><?if(isset($_POST['text'])){echo $_POST['text'];}else{echo $prd['text'];}?></textarea>
    </div>
  </div>
  
  <div class="control-group <?echo $error_title;?>">
    <label class="control-label" for="inputt">Title <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Определяет заголовок документа.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputt"  name="t" value="<?if(isset($_POST['t'])){echo $_POST['t'];}else{echo $prd['t'];}?>" class="input-xxlarge tblock" placeholder="Title" maxlength="150" rel="4" />
      <span id="span_text4"></span>
    </div>
  </div>
  
  <div class="control-group <?echo $error_key;?>">
    <label class="control-label" for="inputk">Ключевые слова <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Набор ключевых слов близок к аннотации, указывать через запятую.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputk"  name="k" value="<?if(isset($_POST['k'])){echo $_POST['k'];}else{echo $prd['k'];}?>" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="250" rel="5" />
      <span id="span_text5"></span>
    </div>
  </div>
  <div class="control-group  <?echo $error_des;?>">
    <label class="control-label" for="inputd">description <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Дается краткое описание содержания страницы.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputd" name="d" value="<?if(isset($_POST['d'])){echo $_POST['d'];}else{echo $prd['d'];}?>" class="input-xxlarge tblock" placeholder="description" maxlength="250" rel="6" />
      <span id="span_text6"></span>
    </div>
  </div>

<div class="control-group <?echo $error_photo;?>">
    <label class="control-label" for="inputico">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется при выборе, размер до 3000 пикселей.'}}).show();"></i></label>
    <div class="controls">
     <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 102px; height: 102px;"><img src="../photo/volkswagen_img_<?echo $prd['id'];?>_.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div></div></div>

<div class="control-group">
      <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> Выполнить рассылку <input name="rassilka" type="checkbox" value="0" />
     </div>
</div>
</fieldset>
</form>


<?}elseif(isset($_GET['edit'])){
   
$prod=mysql_fetch_array(mysql_query("SELECT * FROM  `arr` WHERE id='".$_GET['edit']."'"));
  
if(isset($_POST['type'])){   
if($_POST['mname']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название страницы. </div>';$ename='error';}else{$ename='';}
if($_POST['pmenu']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указано название страницы для второго меню. </div>';$epname='error';}else{$epname='';}
if($_POST['link']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Отсутствует URL адрес страницы. </div>';$elink='error';}else{$elink='';}
if($_POST['t']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Title. </div>';$error_title='error';}else{$error_title='';}
if($_POST['d']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Description. </div>';$error_des='error';}else{$error_des='';}
if($_POST['k']==''){echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не указан Keywords. </div>';$error_key='error';}else{$error_key='';}


//Проверяем наличие фото по допустимым параметрам 
$max_image_width	= 216;
$max_image_height	= 103;
$min_image_width	= 214;
$min_image_height	= 101;
$max_image_size		= 25 * 1024;
$valid_types 		=  array("jpg", "jpeg");
$ph_int=count($_FILES["photo"]['error']);
for($i=0;$i<$ph_int;$i++){
if (is_uploaded_file($_FILES['photo']['tmp_name'][$i])) {
$filename = $_FILES['photo']['tmp_name'][$i];
$ext = substr($_FILES['photo']['name'][$i], 1 + strrpos($_FILES['photo']['name'][$i], "."));
if (filesize($filename) > $max_image_size) {
echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Размер файла больше 25 kb. </div>';
$ph[]=0; 
}elseif (!in_array($ext, $valid_types)) {
echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка Фото:</h4> Разрешено загружать только JPG формат.</div>';
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
$photo_real[]=$filename;
}}}}
if(!in_array("1", $ph)){ echo '<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Добавьте фото. </div>';$error_photo='error';}else{$error_photo='';}

    


//если все впорядке Добавляем в базу 

if($ename=='' and  $epname=='' and $elink=='' and $error_title=='' and $error_des=='' and $error_key==''){
    include_once "../component/translit.php";
    $link=translitIt($_POST['link']);
    $mname=($_POST['mname']);
    $pmenu=($_POST['pmenu']);
    $title=($_POST['t']);
    $des=($_POST['d']);
    $key=($_POST['k']);
    $text=($_POST['text']);
    $add=mysql_query("UPDATE `arr` SET `type`='".$_POST['type']."', `nmenu`='".$mname."',`link`='".$link."', `pmenu`='".$pmenu."', `k`='".$key."', `d`='".$des."', `t`='".$title."', `text`='".$text."'  WHERE `id`='".$_GET['edit']."'");
if(in_array("1", $ph)){
    include_once "../component/class.thumb.php";
    $ph_int2=count($photo_real);
    for($i=0;$i<$ph_int2;$i++){$foto_b = "../photo/volkswagen_img_".$_GET['edit'].".jpg";$tn_image = new Thumbnail($photo_real[$i], 215); $tn_image->save($foto_b);}}
    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."'></head><body>";
    }}  
?>



<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
<fieldset>
    <legend>Добавить страницу в <?echo $hed;?></legend>

<div class="control-group">
    <label class="control-label">Структура страницы <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Страница одна или содержит вложеные страницы? такие как (новости, акции).'}}).show();"></i></label>
    <div class="controls">
        <label class="radio"><input type="radio" value="0" name="type" <?if(isset($_POST['type'])){if($_POST['type']==0){echo 'checked="checked"';}}else{if($prod['type']==0){echo 'checked="checked"';}}?>  />Одиночная страница</label>
        <label class="radio"><input type="radio" value="1" name="type"<?if($_POST['type']==1){echo 'checked="checked"';}else{if($prod['type']==1){echo 'checked="checked"';}}?>  />Група страниц</label>
    </div>
</div>    

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Название в меню <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в выплывающем меню своей категории.'}}).show();"></i></label>
    <div class="controls">
    <input type="text" id="inputname" name="mname" value="<?if(isset($_POST['mname'])){echo $_POST['mname'];}else{echo $prod['nmenu'];}?>" class="input-xxlarge tblock" placeholder="Название в меню" maxlength="50" rel="1" />
    <span id="span_text1"></span>
    </div>
</div>
<div class="control-group <?echo $epname;?>">
    <label class="control-label" for="inputname2">Название в меню 2 <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется в заголовке при открытой категории.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname2" name="pmenu" value="<?if(isset($_POST['pmenu'])){echo $_POST['pmenu'];}else{echo $prod['pmenu'];}?>" class="input-xxlarge tblock" placeholder="Название в меню 2" maxlength="70" rel="2" />
      <span id="span_text2"></span>
    </div>
</div>
<div class="control-group <?echo $elink;?>">
    <label class="control-label" for="inputname3">URL <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'url адрес страницы, спец символы разрешены только нижнее подчеркивание.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputname3" name="link" value="<?if(isset($_POST['link'])){echo $_POST['link'];}else{echo $prod['link'];}?>" class="input-xxlarge tblock" placeholder="URL Адрес" maxlength="50" rel="3" />
      <span id="span_text3"></span>
    </div>
</div>
<div class="control-group">
    <label class="control-label" for="inputtt">Описание</label>
    <div class="controls">
      <textarea name="text" id="textarea1" placeholder="Описание"><?if(isset($_POST['text'])){echo $_POST['text'];}else{echo $prod['text'];}?></textarea>
    </div>
  </div>
  
  <div class="control-group <?echo $error_title;?>">
    <label class="control-label" for="inputt">Title <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Определяет заголовок документа.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputt"  name="t" value="<?if(isset($_POST['t'])){echo $_POST['t'];}else{echo $prod['t'];}?>" class="input-xxlarge tblock" placeholder="Title" maxlength="150" rel="4" />
      <span id="span_text4"></span>
    </div>
  </div>
  
  <div class="control-group <?echo $error_key;?>">
    <label class="control-label" for="inputk">Ключевые слова <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Набор ключевых слов близок к аннотации, указывать через запятую.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputk"  name="k" value="<?if(isset($_POST['k'])){echo $_POST['k'];}else{echo $prod['k'];}?>" class="input-xxlarge tblock" placeholder="Ключевые слова" maxlength="250" rel="5" />
      <span id="span_text5"></span>
    </div>
  </div>
  <div class="control-group  <?echo $error_des;?>">
    <label class="control-label" for="inputd">description <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Дается краткое описание содержания страницы.'}}).show();"></i></label>
    <div class="controls">
      <input type="text" id="inputd" name="d" value="<?if(isset($_POST['d'])){echo $_POST['d'];}else{echo $prod['d'];}?>" class="input-xxlarge tblock" placeholder="description" maxlength="250" rel="6" />
      <span id="span_text6"></span>
    </div>
  </div>

<div class="control-group <?echo $error_photo;?>">
<label class="control-label" for="inputico">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется под основным баннером, размер 215 на 102 пикселей.'}}).show();"></i></label>
<div class="controls">
<div class="fileupload fileupload-new" data-provides="fileupload">
<div class="fileupload-preview thumbnail" style="width: 215px; height: 105px;"><img src="<?
if(file_exists('../photo/volkswagen_img_'.$prod['id'].'.jpg')){
    echo '../photo/volkswagen_img_'.$prod['id'].'.jpg';
  }else{
    echo 'img/img215x102.jpg';
  }
?>" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div></div>


</div>
</div>

<div class="control-group">
      <div class="controls">
        <input type="submit" value="Сохранить" class="btn btn-primary" /> 
     </div>
</div>

</fieldset>
</form>


<?}else{
    
  if(isset($_GET['arr']) and $_GET['arr']!=''){
   
/*
  
$result = mysql_query("SELECT * FROM page11 WHERE tip='4' ORDER BY id ASC  ",$db);
while($pa=mysql_fetch_array($result)){

 
    $add=mysql_query("INSERT INTO `arr_page` SET 
        `name`='".$pa['name']."',
        `id_arr`='31',
        `link`='".$pa['link']."',
        `k`='".$pa['kes']."',
        `d`='".$pa['des']."',
        `t`='".$pa['name']."',
        `text`='".$pa['text']."',
        `date`=NOW()");
    $id=mysql_insert_id();
    $add=mysql_query("UPDATE `arr_page` SET `idd`='".$id."' WHERE `id`='".$id."'");
    //$img='../photo/volkswagen_2_'.$pa['id'].'.jpg';
    //$img2="../photo/volkswagen_img_".$id."_.jpg";
   // copy($img, $img2);
}

*/

    
    $prods=mysql_fetch_array(mysql_query("SELECT * FROM  `arr` WHERE id='".$_GET['arr']."'"));
    
    
    
            if(isset($_GET['arov_down'])){
                
                $dow=mysql_query("SELECT * FROM  `arr_page` WHERE idd>$_GET[arov_down] AND id_arr='".$prods['id']."'  ORDER BY idd ASC   LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_down'];
                $add1=mysql_query("UPDATE `arr_page` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `arr_page` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `arr_page` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."&arr=".$_GET['arr']."'></head><body>";
            }
            if(isset($_GET['arov_up'])){
                $dow=mysql_query("SELECT * FROM  `arr_page` WHERE idd<$_GET[arov_up] AND id_arr='".$prods['id']."' ORDER BY idd DESC  LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_up'];
                $add1=mysql_query("UPDATE `arr_page` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `arr_page` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `arr_page` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."&arr=".$_GET['arr']."'></head><body>";
            }
             if(isset($_GET['glass'])){
                if($_GET['glass']=='0'){$sat=1;}else{$sat=0;}
                $add1=mysql_query("UPDATE `arr_page` SET glass='$sat'  WHERE id='$_GET[id]'");
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."&arr=".$_GET['arr']."'></head><body>";
            }
    
    
    
    
    ?>
    
    
 <div class="span3">
<div class="well sidebar-nav">
            <ul class="nav nav-list">
                <li class="nav-header">Навигация</li>
                <li <?if(isset($_GET['add_pp'])){echo 'class="active"';}?> ><a href="?page=<?echo $_GET['page'];?>&add_pp=<?echo $_GET['arr'];?>"><i class="icon-plus"></i>Добавить страницу в радел</a></li>
            </ul>
</div>
</div>   
    
    
    
  <div class="span9">
<h3><?echo $hed.'/'.$prods['nmenu'];?></h3>
<table class="table table-hover table-condensed table-bordered">

 
    
<?
$pr=mysql_query("SELECT * FROM  `arr_page` WHERE id_arr='".$prods['id']."' ORDER BY idd DESC");
while($prod=mysql_fetch_array($pr)){
echo '<tr class="';
if($prod['glass']==0){ $ic='icon-eye-open';$gr="";  }else{echo 'error'; $ic='icon-eye-close'; $gr="gray";}
echo' id_'.$prod['id'].'">
<td style="width: 215px;"><img src="../photo/volkswagen_img_'.$prod['id'].'_.jpg" class="'.$gr.'" /></td>
<td>
<strong>'.$prod['name'].'</strong></td>
<td style="width: 115px;text-align: center;">';

echo '<a href="?page='.$_GET['page'].'&edit_r='.$prod['id'].'"><i class="icon-pencil tool" data-original-title="Редактировать" ></i></a>
<i class="icon-remove tool delpp" rel="'.$prod['id'].'" data-original-title="Удалить"></i>
<a href="?page='.$_GET['page'].'&arr='.$prods['id'].'&glass='.$prod['glass'].'&id='.$prod['id'].'"><i class="'.$ic.' tool" data-original-title="Отключить"></i></a>
<a href="?page='.$_GET['page'].'&arr='.$prods['id'].'&arov_down='.$prod['idd'].'"><i class="icon-chevron-up tool" data-original-title="Поменять местами"></i></a>
<a href="?page='.$_GET['page'].'&arr='.$prods['id'].'&arov_up='.$prod['idd'].'"><i class="icon-chevron-down tool" data-original-title="Поменять местами"></i></a>

</td>
</tr>'; 
}


?>


</table>


</div>
    
    
    
    
    
    
    
    
    
    
    
  <?}else{
  
  
  
  

  
  
  
  
  if(isset($_GET['arov_down'])){
                
                $dow=mysql_query("SELECT * FROM  `arr` WHERE idd>$_GET[arov_down] AND menu='".$id_menu."'  ORDER BY idd ASC   LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_down'];
                $add1=mysql_query("UPDATE `arr` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `arr` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `arr` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."'></head><body>";
            }
            if(isset($_GET['arov_up'])){
                $dow=mysql_query("SELECT * FROM  `arr` WHERE idd<$_GET[arov_up] AND menu='".$id_menu."' ORDER BY idd DESC  LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_up'];
                $add1=mysql_query("UPDATE `arr` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `arr` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `arr` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."'></head><body>";
            }
             if(isset($_GET['glass'])){
                if($_GET['glass']=='0'){$sat=1;}else{$sat=0;}
                $add1=mysql_query("UPDATE `arr` SET glass='$sat'  WHERE id='$_GET[id]'");
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."'></head><body>";
            }
  
  
?>



<div class="span3">
<div class="well sidebar-nav">
            <ul class="nav nav-list">
                <li class="nav-header">Навигация</li>
                <li <?if(isset($_GET['add_p'])){echo 'class="active"';}?> ><a href="?page=<?echo $_GET['page'];?>&add_p"><i class="icon-plus"></i>Добавить страницу</a></li>
                
                
                
              
           </ul>
           <?


if (isset($_FILES["ban"])) {
    
        $max_image_width	= 962;
        $max_image_height	= 590;
        $min_image_width	= 958;
        $min_image_height	= 120;
        $max_image_size		= 1024 * 2048;
        $valid_types 		=  array("jpg", "jpeg");

	if (is_uploaded_file($_FILES['ban']['tmp_name'])) {
		$filename = $_FILES['ban']['tmp_name'];
		$ext = substr($_FILES['ban']['name'], 1 + strrpos($_FILES['ban']['name'], "."));
		if (filesize($filename) > $max_image_size) {
			echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Размер файла больше 2 mb. </div>';
		} elseif (!in_array($ext, $valid_types)) {
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Разрешено загружать только JPG формат.</div>';
		} else {
 			$size = GetImageSize($filename);
            
 			if ($size[0] < $max_image_width	&& $size[1] < $max_image_height && $size[0] > $min_image_width	&& $size[1] > $min_image_height ) {
				             
                      if (move_uploaded_file($filename, "../img/".$_GET['page'].".jpg")) {
                 echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>Фото успешно загружено.</div>';
                 echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?page=".$_GET['page']."'></head><body>";
				} else {
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> при попытке загрузить фото возникли ошибки , попробуйте вновь , если ошибка повторилась  обратитесь к Администратору.</div>';
				}
			} else {
				echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не допустимая высота или ширина фото. Размер фото  960 Х (120-590) пикселей </div>';
			}
		}
	} 
}
           
           ?>
           
           
           
            <form action="" method="post" enctype="multipart/form-data" >
            <div class="fileupload fileupload-new" data-provides="fileupload" style="margin: 2px 0px 0px 15px;">
            <span class="btn-file"><span class="fileupload-new"><i class="icon-picture"></i>Установка баннера</span><input type="file" name="ban" /></span>
            <span class="fileupload-preview"></span>
            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
            <input type="submit" value="Go" class="fileupload-exists" />
            </div>
            
      </form>     
</div>
</div>

<div class="span9">
<h3><?echo $hed;?></h3>
<table class="table table-hover table-condensed table-bordered">


<tr>
    <td colspan="3" >
        <img src="../img/<?echo $_GET['page'];?>.jpg" />
    </td>
</tr>
<?
$pr=mysql_query("SELECT * FROM  `arr` WHERE menu='".$id_menu."' ORDER BY idd ASC");
while($prod=mysql_fetch_array($pr)){
echo '<tr class="';
if($prod['glass']==0){if($prod['type']==0){echo 'info';}else{echo 'warning';} $ic='icon-eye-open';$gr="";  }else{echo 'error'; $ic='icon-eye-close'; $gr="gray";}
echo' id_'.$prod['id'].'">
<td style="width: 215px;"><img src="../photo/volkswagen_img_'.$prod['id'].'.jpg" class="'.$gr.'" /></td>
<td>
<strong>'.$prod['nmenu'].'</strong><br>'.$prod['pmenu'].'
</td>
<td style="width: 125px;text-align: center;">';
if($prod['type']==1){echo '<a href="?page='.$_GET['page'].'&add_pp='.$prod['id'].'"><i class=" icon-plus tool" data-original-title="Добавить страницу"></i></a>
<a href="?page='.$_GET['page'].'&arr='.$prod['id'].'"><i class="icon-share tool" data-original-title="Войти в раздел"></i></a>


';}

echo '<a href="?page='.$_GET['page'].'&edit='.$prod['id'].'"><i class="icon-pencil tool" data-original-title="Редактировать" ></i></a>
<i class="icon-remove tool del_p" rel="'.$prod['id'].'" data-original-title="Удалить"></i>
<a href="?page='.$_GET['page'].'&glass='.$prod['glass'].'&id='.$prod['id'].'"><i class="'.$ic.' tool" data-original-title="Отключить"></i></a>
<a href="?page='.$_GET['page'].'&arov_up='.$prod['idd'].'"><i class="icon-chevron-up tool" data-original-title="Поменять местами"></i></a>
<a href="?page='.$_GET['page'].'&arov_down='.$prod['idd'].'"><i class="icon-chevron-down tool" data-original-title="Поменять местами"></i></a>

</td>
</tr>'; 
}


?>


</table>


</div>

<?}}?>
</div></div>
<?}}?>
