<div class="container">
      <div class="row-fluid">
       <div class="span12">
<?


if($_GET['avto']=='in_stock'){
    $hed="Авто в наличии";
    $db_avto='`cars_new`';
    $page_avto='newcars';
    $del_avto='0';
    $head_avto='Добавить авто  в наличии';
    $head_avto_edit='Редактировать авто  в наличии';
    include_once "../newcars/Car/arrays.php";
}else{
    $hed="Авто с пробегом";
    $db_avto='`cars`';
    $page_avto='dasweltauto';
    $del_avto='1';
    $head_avto='Добавить авто с пробегом';
    $head_avto_edit='Редактировать авто с пробегом';
    include_once "../dasweltauto/Car/arrays.php";
}


if(!empty($_POST)){
    if(!empty($_POST['car_name'])){
    if(!isset($_POST['car_isset'])){$quer[] = '`car_isset`=\'0\'';}
    if(!isset($_POST['car_garant'])){$quer[] = '`car_garant`=\'0\'';}
    foreach($_POST as $i=>$a){
    if($i=='car_options') {
        $quer[] = '`'.$i.'`=\''.implode(',',$a).'\'';} 
    elseif($i=='car_optext') {
        $quer[] = '`'.$i.'`=\''.$a.'\'';}
    elseif(substr_count($i,'car_opt')!=0) {
        foreach($a as $l=>$b){ if($b=='') unset($a[$l]);}
        $quer[] = '`'.$i.'`=\''.implode('&amp;',$a).'\'';} 
    elseif($i=='car_id_edit'){}
        else {
            $quer[] = '`'.$i.'`=\''.$a.'\'';}
    }
    if(isset($_POST['car_id_edit'])){
//print_r($quer);
//exit();
        $request='UPDATE '.$db_avto.' SET '.implode(' , ',$quer).' WHERE `car_id`=\''.$_POST['car_id_edit'].'\'';
        mysql_query($request, $db);
        $id_car=$_POST['car_id_edit'];
    
    }else{
        $request='INSERT INTO '.$db_avto.' SET '.implode(' , ',$quer);
        mysql_query($request, $db);
        $id_car=mysql_insert_id();
    }
    
    
    
    //echo $request;
    include( "../component/class.thumb.php" );  
    
    if ( $_FILES["img_ico"]["error"] == 0 ) {
        if($_FILES["img_ico"]["tmp_name"]){
        	$filename = "../".$page_avto."/images/img_".$id_car."_0.jpg";
        
        	$tn_image = new Thumbnail( $_FILES["img_ico"]["tmp_name"], 500, 0, 0, 80 ); $tn_image->save( $filename );
		}
     }
    
    $i=1;  
    $ph_int=count($_FILES["photo"]['error']);
    $ph_int++;
    for($i=1;$i<$ph_int;$i++){
            if ( $_FILES["photo"]["error"][$i] == 0 ) {
               if($_FILES['photo']["tmp_name"][$i]){
            		$filename = '../'.$page_avto.'/images/img_'.$id_car.'_'.$i.'.jpg';
            		$tni_image = new Thumbnail( $_FILES['photo']["tmp_name"][$i], 500, 0, 0, 80 ); $tni_image->save( $filename );
				}
           }
       }
    if($id_car!=0) ?><script> window.location.href="/admin/?avto=<?echo $_GET['avto'];?>";</script><?;
    }else{
        echo '
        <div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4 class="alert-heading">Ошибка</h4>
            <p>Заполните все поля!</p>    
          </div>';
    }
}


if(isset($_GET['add'])){
    
?>

<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
<fieldset>
    <legend><?echo $head_avto;?></legend>

<div class="control-group <?echo $error_photo;?>">
    <label class="control-label" for="inputico">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется основным изображение при использования поиска.'}}).show();"></i></label>
    <div class="controls">
     <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 200px; height: 200px;"><img src="img/img200x200.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="img_ico" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
</div></div></div></div>
  
  

<div class="control-group <?echo $ename;?>">
    <label class="control-label" >Авто</label>
    <div class="controls">
    <input type="text"   name="car_name" value="<?if(isset($_POST['car_name'])){echo $_POST['car_name'];}?>" class="input-xlarge avto_plus" placeholder="Название авто" maxlength="150"  autocomplete="off"  />
      <input type="text"  placeholder="Мощность" name="car_power" value="<?if(isset($_POST['car_power'])){echo $_POST['car_power'];}?>" class="input-small" style="margin:0 10px;" />
    
    <select name="car_body" style="width: 120px;float: left;"><option value="0">Тип кузова</option>
        <?foreach($car_body as $i=>$val){echo '<option value="'.$i.'">'.$val.'</option>';}?>
    </select>
    
    <input type="text" placeholder="Владельцев" name="car_own" value="<?if(!isset($_POST['car_own']) or $_POST['car_own']==''){echo 1;}else{echo $_POST['car_own'];}?>" class="input-mini" data-mask="9" style="margin:0 10px;"  />

    
    </div>
</div>




<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Привод</i></label>
    <div class="controls">
        <label class="radio">передний <input name="car_drivegear" type="radio" value="1" <?if(!isset($_POST['car_drivegear'])){echo 'checked="checked"';}elseif($_POST['car_drivegear']=='1'){echo 'checked="checked"';}?> /></label>
        <label class="radio">задний <input name="car_drivegear" type="radio" value="2"  <?if(isset($_POST['car_drivegear']) and $_POST['car_drivegear']=='2'){echo 'checked="checked"';}?>  /></label>
        <label class="radio">полноприводный <input name="car_drivegear" type="radio" value="3"  <?if(isset($_POST['car_drivegear']) and $_POST['car_drivegear']=='3'){echo 'checked="checked"';}?>  /></label>
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Обивка салона</label>
    <div class="controls"><input type="text" id="inputname" name="car_obivka" value="<?if(isset($_POST['car_obivka'])){echo $_POST['car_obivka'];}?>" class="input-xxlarge tblock" placeholder="Кожа, ткань, комбинир...." maxlength="30" rel="7" />
<span id="span_text7"></span></div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">КПП</i></label>
    <div class="controls">
        <label class="radio">механическая <input name="car_gearbox" type="radio" value="1"  <?if(!isset($_POST['car_gearbox'])){echo 'checked="checked"';}elseif($_POST['car_gearbox']=='1'){echo 'checked="checked"';}?>   /></label>
        <label class="radio">автоматическая <input name="car_gearbox" <?if(isset($_POST['car_gearbox']) and $_POST['car_gearbox']=='2'){echo 'checked="checked"';}?> type="radio" value="2"    /></label>
    </div>
</div>

<div class="control-group <?echo $ename;?>">

    <label class="control-label" for="inputname">Тип двигателя</label>

    <div class="controls">

        <label class="radio">TDI <input name="car_engine" type="radio" value="1"  <?
            if(!isset($_POST['car_engine'])){
                echo 'checked="checked"';
            }elseif($_POST['car_engine']=='1'){
                echo 'checked="checked"';
                
            }?>   /></label>

        <label class="radio">TSI <input name="car_engine" <?
        if(isset($_POST['car_engine']) and $_POST['car_engine']=='2'){
            echo 'checked="checked"';
        }?> type="radio" value="2"    /></label>

    </div>

</div>

<div class="control-group <?echo $ename;?>">

    <label class="control-label" for="inputname">Дата поставки (0000-00-00)</label>

    <div class="controls">

    <input type="text" id="inputname" name="delivery_date" value="<?if(isset($_POST['delivery_date'])){echo $_POST['delivery_date'];}?>" class="input-small" placeholder="0000-00-00"  />

    </div>

</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Пробег(км.)</i></label>
    <div class="controls">
    <input type="text" id="inputname" name="car_run" value="<?if(isset($_POST['car_run'])){echo $_POST['car_run'];}?>" class="input-small" placeholder="Пробег(км.)"  />
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Цена <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'формат 0000.00'}}).show();"></i></label>
    <div class="controls">
    <input type="text" id="inputname" name="car_price" value="<?if(isset($_POST['car_price'])){echo $_POST['car_price'];}?>" class="input-small" placeholder="Цена" />
   </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Цена с скидкой</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_price_new" value="<?if(isset($_POST['car_price_new'])){echo $_POST['car_price_new'];}?>" class="input-small" placeholder="Цена с скидкой" />
   </div>
</div>


<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Цвет</label>
    <div class="controls">
        <select class="inputZ" name="car_color" style="width: 200px;"><option value="0"></option>
            <?$q2=mysql_query('SELECT * FROM cars_color ORDER BY name');while($color=mysql_fetch_assoc($q2)){echo '<option value="'.$color['id'].'" >'.$color['name'].'</option>';}?>
        </select>
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Год выпуска</i></label>
    <div class="controls">
    <input type="text" id="inputname" name="car_year" value="<?if(isset($_POST['car_year'])){echo $_POST['car_year'];}?>" class="input-small " data-mask="9999"  />
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Объём двигателя(см3)</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_volume" value="<?if(isset($_POST['car_volume'])){echo $_POST['car_volume'];}?>" class="input-small" placeholder="Объём двигателя(см3)" data-mask="9.9" />
    </div>
</div>

   
<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Тип топлива</label>
    <div class="controls">
        <label class="radio">Бензин <input name="car_fuel" type="radio" value="1" <?if(!isset($_POST['car_fuel'])){echo 'checked="checked"';}elseif($_POST['car_fuel']=='1'){echo 'checked="checked"';}?>   /></label>
        <label class="radio">Дизель <input name="car_fuel" type="radio" value="2"  <?if(isset($_POST['car_fuel']) and $_POST['car_fuel']=='2'){echo 'checked="checked"';}?>  /></label>
    </div>
</div>     

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Номер контракта</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_kontrakt" value="<?if(isset($_POST['car_kontrakt'])){echo $_POST['car_kontrakt'];}?>" class="input-small" placeholder="Номер контракта" />
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <div class="controls">
        <label class="checkbox"><input name="car_garant" type="checkbox" <?if(isset($_POST['car_garant'])){if($_POST['car_garant']=='1'){echo 'checked="checked"';}}?> value="1"   /> Гарантия производителя</label>
        <label class="checkbox"><input name="car_isset" type="checkbox" <?if(isset($_POST['car_isset']) and $_POST['car_isset']=='1'){echo 'checked="checked"';}?> value="1"   /> Есть в наличии</label>
        <label class="checkbox"><input name="car_bron" type="checkbox" <?if(isset($_POST['car_bron']) and $_POST['car_bron']=='1'){echo 'checked="checked"';}?> value="1"   /> Забронировано</label>
    </div>
</div>    
   

<div class="control-group <?echo $ename;?>">
<div class="controls">

<?if($_GET['avto']=='in_stock'){?>
<textarea id="textarea1" name="car_optext" class="inputZ" style="width: 750px; height: 400px; visibility: hidden; display: none;"></textarea>
<?}else{?>
<div class="bs-docs-example">
          <ul id="myTab" class="nav nav-tabs">
              <?$n=1;foreach($options as $namekat=>$kat){echo '<li class=""><a href="#pr'.$n.'" data-toggle="tab">'.$namekat.'</a></li>';$n++;}?>
          </ul>
          <div id="myTabContent" class="tab-content">        
 <?
    $n=1;
    foreach($options as $namekat=>$kat){// чекбоксы options Настриваемые в arrays.php
    echo '<div class="tab-pane fade" id="pr'.$n.'">';
        foreach($kat as $i=>$val){
            if(isset($_POST['car_options'])){if(in_array($i, $_POST['car_options'])){$chek='checked="checked"';}else{$chek='';}}
            echo '<label class="checkbox">'.$val.':<input id="op'.$i.'" name="car_options[]" type="checkbox" value="'.$i.'" '.$chek.' /></label>';
        }
        echo '<div id="atext'.$n.'">';
        
         if(isset($_POST['car_opt'.$n]) and $_POST['car_opt'.$n]!=''){
          
            foreach($_POST['car_opt'.$n] as $m){
                echo '<input name="car_opt'.$n.'[]" class="input-xxlarge"  type="text" value="'.$m.'" />';
            }
        }
        
        echo '</div> <br style="clear:both;" /><div class="input-append"><input class="input-large add_text'.$n.'" id="appendedInputButton" type="text"><button class="btn add_text" rel="'.$n.'" type="button"><i class="icon-plus"></i></button></div>';
        echo '</div>';
    $n++;
    }?>
          
</div></div>
<?}?>

</div></div> 




<div class="control-group <?echo $error_photo;?>">
    <label class="control-label" for="inputico">Фото <i class="icon-plus addph"></i></label>
    <div class="controls" id="adph">



<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 200px; height: 200px;"><img src="img/img200x200.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div>
  
  
  </div></div>



<div class="control-group">
      <div class="controls">
      <input type="submit" class="btn btn-info" value="Сохранить"/>
    </div>
  </div>
</fieldset>
</form>

          
          
          
          
          
          
          
          
          
          
  <?
  }elseif(isset($_GET['edit'])){
    $q=mysql_query('SELECT * FROM '.$db_avto.' WHERE `car_id`=\''.$_GET['edit'].'\'');
    $row=mysql_fetch_assoc($q);?>


<form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
<fieldset>
    <legend><?echo $head_avto_edit;?></legend>
<input type="hidden" name="car_id_edit" value="<?echo $row['car_id'];?>"/>
<div class="control-group <?echo $error_photo;?>">
    <label class="control-label" for="inputico">Изображение <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Используется основным изображение при использования поиска.'}}).show();"></i></label>
    <div class="controls">
     <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 200px; height: 200px;"><img src="../<?echo $page_avto;?>/images/Photo.php?id=img_<?echo $row['car_id'];?>z_0.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="img_ico" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div></div></div>
  
  

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Название авто</label>
    <div class="controls">
    <input type="text" id="inputname"  name="car_name" value="<?echo $row['car_name']?>" class="input-xxlarge tblock avto_plus" placeholder="Название авто" maxlength="150" rel="1" autocomplete="off"  />
    <span id="span_text1"></span>
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Мощность<i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'Мощность двигателя(л.с.)'}}).show();"></i></label>
    <div class="controls">
    <input type="text" id="inputname" name="car_power" value="<?echo $row['car_power']?>" class="input-small" />
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Тип кузова</label>
    <div class="controls">
        <select class="inputZ" name="car_body" style="width: 200px;"><option value="0"></option>
            <?foreach($car_body as $i=>$val){echo '<option value="'.$i.'"   '; if($i==$row['car_body']) echo 'selected ';   echo '>'.$val.'</option>';}?>
        </select>
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Владельцев</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_own" value="<?if($row['car_own']==''){echo 1;}else{echo $row['car_own'];}?>" class="input-small" data-mask="9" />

    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Привод</i></label>
    <div class="controls">
        <label class="radio">передний <input name="car_drivegear" type="radio" value="1" <?if(!isset($row['car_drivegear'])){echo 'checked="checked"';}elseif($row['car_drivegear']=='1'){echo 'checked="checked"';}?> /></label>
        <label class="radio">задний <input name="car_drivegear" type="radio" value="2"  <?if(isset($row['car_drivegear']) and $row['car_drivegear']=='2'){echo 'checked="checked"';}?>  /></label>
        <label class="radio">полноприводный <input name="car_drivegear" type="radio" value="3"  <?if(isset($row['car_drivegear']) and $row['car_drivegear']=='3'){echo 'checked="checked"';}?>  /></label>
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Обивка салона</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_obivka" value="<?echo $row['car_obivka']?>" class="input-xxlarge tblock" placeholder="Кожа, ткань, комбинир...." maxlength="30" rel="7" />
    <span id="span_text7"></span>
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">КПП</i></label>
    <div class="controls">
        <label class="radio">механическая <input name="car_gearbox" type="radio" value="1"  <?if(!isset($row['car_gearbox'])){echo 'checked="checked"';}elseif($row['car_gearbox']=='1'){echo 'checked="checked"';}?>   /></label>
        <label class="radio">автоматическая <input name="car_gearbox" <?if(isset($row['car_gearbox']) and $row['car_gearbox']=='2'){echo 'checked="checked"';}?> type="radio" value="2"    /></label>
    </div>
</div>

<div class="control-group <?echo $ename;?>">

    <label class="control-label" for="inputname">Тип двигателя</label>

    <div class="controls">

        <label class="radio">TDI <input name="car_engine" type="radio" value="1"  <?
        if(!isset($row['car_engine'])){
            echo 'checked="checked"';
            
        }elseif($row['car_engine']=='1'){
            echo 'checked="checked"';
            
        }?>   /></label>

        <label class="radio">TSI <input name="car_engine" <?if(isset($row['car_engine']) and $row['car_engine']=='2'){echo 'checked="checked"';}?> type="radio" value="2"    /></label>

    </div>

</div>

<div class="control-group <?echo $ename;?>">

    <label class="control-label" for="inputname">Дата поставки (0000-00-00)</label>

    <div class="controls">

    <input type="text" id="inputname" name="delivery_date" value="<?if(isset($row['delivery_date'])){echo $row['delivery_date'];}?>" class="input-small" placeholder="0000-00-00"  />

    </div>

</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Пробег(км.)</i></label>
    <div class="controls">
    <input type="text" id="inputname" name="car_run" value="<?echo $row['car_run']?>" class="input-small" placeholder="Пробег(км.)"  />
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Цена <i class="icon-question-sign po" style="margin: 7px 0px; 0 0" onclick="$('.bottom-left').notify({message: {text: 'формат 0000.00'}}).show();"></i></label>
    <div class="controls">
    <input type="text" id="inputname" name="car_price" value="<?echo $row['car_price']?>" class="input-small" placeholder="Цена" />
   </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Цена со скидкой</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_price_new" value="<?echo $row['car_price_new']?>" class="input-small" placeholder="Цена" />
   </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Цвет</label>
    <div class="controls">
        <select class="inputZ" name="car_color" style="width: 200px;"><option value="0"></option>
            <?$q2=mysql_query('SELECT * FROM cars_color ORDER BY name');
            while($color=mysql_fetch_assoc($q2)){
                echo '<option value="'.$color['id'].'" '; if($color['id']==$row['car_color']) echo 'selected ';   echo '>'.$color['name'].'</option>';}?>
        </select>
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Год выпуска</i></label>
    <div class="controls">
    <input type="text" id="inputname" name="car_year" value="<?echo $row['car_year']?>" class="input-small " data-mask="9999"  />
    </div>
</div>

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Объём двигателя(см3)</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_volume" value="<?echo $row['car_volume']?>" class="input-small" placeholder="Объём двигателя(см3)" data-mask="9.9" />
    </div>
</div>
   
<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Тип топлива</label>
    <div class="controls">
        <label class="radio">Бензин <input name="car_fuel" type="radio" value="1" <?if(!isset($row['car_fuel'])){echo 'checked="checked"';}elseif($row['car_fuel']=='1'){echo 'checked="checked"';}?>   /></label>
        <label class="radio">Дизель <input name="car_fuel" type="radio" value="2"  <?if(isset($row['car_fuel']) and $row['car_fuel']=='2'){echo 'checked="checked"';}?>  /></label>
    </div>
</div> 

<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Номер контракта</label>
    <div class="controls">
    <input type="text" id="inputname" name="car_kontrakt" value="<?echo $row['car_kontrakt']?>" class="input-small" placeholder="Номер контракта" />
    </div>
</div>    
    
<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Гарантия производителя</label>
    <div class="controls">
        <label class="checkbox"><input name="car_garant" type="checkbox" <?if(isset($row['car_garant']) and $row['car_garant']=='1'){echo 'checked="checked"';}?> value="1"   /></label>
    </div>
</div>    
   
<div class="control-group <?echo $ename;?>">
    <label class="control-label" for="inputname">Есть в наличии</i></label>
    <div class="controls">
        <label class="checkbox"><input name="car_isset" type="checkbox" <?if(isset($row['car_isset']) and $row['car_isset']=='1'){echo 'checked="checked"';}?> value="1"   /></label>
    </div>
</div>     
   

<div class="control-group <?echo $ename;?>">
    <div class="controls">
	
	<?if($_GET['avto']=='in_stock'){?>
<textarea id="textarea1" name="car_optext" class="inputZ" style="width: 750px; height: 400px; visibility: hidden; display: none;"><?= $row['car_optext'] ?></textarea>
<?}else{?>

<div class="bs-docs-example">
          <ul id="myTab" class="nav nav-tabs">
              <?$n=1;foreach($options as $namekat=>$kat){echo '<li class=""><a href="#pr'.$n.'" data-toggle="tab">'.$namekat.'</a></li>';$n++;}?>
          </ul>
          <div id="myTabContent" class="tab-content">        
 <?
    $n=1;
    foreach($options as $namekat=>$kat){// чекбоксы options Настриваемые в arrays.php
    echo '<div class="tab-pane fade" id="pr'.$n.'">';
        foreach($kat as $i=>$val){
            $chek=(substr_count($row['car_options'], $i)!=0)?'checked="checked"':'';
            echo '<label class="checkbox">'.$val.':<input id="op'.$i.'" name="car_options[]" type="checkbox" value="'.$i.'" '.$chek.' /></label>';
        }
        echo '<div id="atext'.$n.'">';
        
         if($row['car_opt'.$n]!=''){
            $ar=explode('&amp;',$row['car_opt'.$n]);
            foreach($ar as $m){
                echo '<input name="car_opt'.$n.'[]" class="input-xxlarge"  type="text" value="'.$m.'" />';
            }
        }
        
        echo '</div>
        <br style="clear:both;" />
        <div class="input-append">
        <input class="input-large add_text'.$n.'" id="appendedInputButton" type="text">
            <button class="btn add_text" rel="'.$n.'" type="button"><i class="icon-plus"></i></button>
        </div>
        ';
        
        
        echo '</div>';
    $n++;
    }?>
          
</div></div><? } ?></div></div> 




<div class="control-group <?echo $error_photo;?>">
    <label class="control-label" for="inputico">Фото <i class="icon-plus addph"></i></label>
    <div class="controls" id="adph">


<?$i=1;
    while(@fopen('../'.$page_avto.'/images/img_'.$row['car_id'].'_'.$i.'.jpg', "r")){
    
    echo '
    <div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 200px; height: 200px;"><img src="../'.$page_avto.'/images/Photo.php?id=img_'.$row['car_id'].'_z'.$i.'.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div>
    ';

    $i++;
    } 
    ?>

<div class="fileupload fileupload-new" data-provides="fileupload">
  <div class="fileupload-preview thumbnail" style="width: 200px; height: 200px;"><img src="img/img200x200.jpg" /></div>
  <div>
    <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span>
    <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
  </div></div>
  
  
  </div></div>



<div class="control-group">
      <div class="controls">
      <input type="submit" class="btn btn-info" value="Сохранить"/>
    </div>
  </div>
</fieldset>
</form>



<?}else{?>
<div class="span3">
<div class="well sidebar-nav">
<ul class="nav nav-list">
    <li class="nav-header">Навигация</li>
    <li <?if(isset($_GET['add'])){echo 'class="active"';}?> ><a href="?avto=<?echo $_GET['avto'];?>&add"><i class="icon-plus"></i>Добавить авто</a></li>
</ul>
</div>
</div>

<div class="span9">
<h3><?echo $hed;?></h3>
<table class="table table-hover table-condensed table-bordered table-avto">
<tr><th style="width: 120px;">Изображение</th><th colspan="3" >Название</th><th style="width: 60px;"></th></tr>
<?


 if(isset($_GET['glass'])){
                if($_GET['s']=='0'){$sat=1;}else{$sat=0;}
                $add1=mysql_query("UPDATE ".$db_avto." SET glass='$sat'  WHERE car_id='$_GET[glass]'");
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?avto=".$_GET['avto']."'></head><body>";
            }



$tq=mysql_query("SELECT * FROM ".$db_avto." ORDER BY `car_id` ASC");
while($teh = mysql_fetch_array($tq)){
    $color=mysql_fetch_assoc(mysql_query('SELECT * FROM cars_color WHERE id="'.$teh['car_color'].'" LIMIT 1'));
    
    if($teh['glass']=='0'){
        $clss="";
        $cl_img="";
        $ic_gl="<a href='?avto=".$_GET['avto']."&glass=".$teh['car_id']."&s=0'><i class='icon-eye-open'></i></a>";
    }else{
        $cl_img="class='gray'";
        $clss='class="error"';
        $ic_gl="<a href='?avto=".$_GET['avto']."&glass=".$teh['car_id']."&s=1'><i class='icon-eye-close'></i></a>";
    }
    
    echo '<tr id="td'.$teh['car_id'].'" '.$clss.'>
    <td><img src="../'.$page_avto.'/images/Photo.php?id=img_'.$teh['car_id'].'z_0.jpg"  '.$cl_img.'></td>
    <td>
        <strong>'.$teh['car_name'].' </strong>
        <p><strong>Цена: </strong>'.$teh['car_price'].'</p>
        <p><strong>Цвет: </strong>'.$color['name'].'</p>
        <p><strong>Тип кузова: </strong>';
        foreach($car_body as $i=>$val){ if($i==$teh['car_body']) echo $val;}
        echo '</p>
    </td>
    <td>
        <p><strong>Год выпуска: </strong>'.$teh['car_year'].'</p>
        <p><strong>Пробег: </strong>'.$teh['car_run'].'</p><p><strong>КПП: </strong>';
        if($teh['car_gearbox']==1){echo 'механическая'; }else{ echo 'автоматическая'; }echo'</p> <p><strong>Привод:</strong>';
        if($teh['car_drivegear']==1){echo 'передний';}elseif($teh['car_drivegear']==2){echo 'задний';}else{ echo 'полноприводный';}echo '</p> </td><td>
        
        <p><strong>Мощность: </strong>'.$teh['car_power'].'</p>
        <p><strong>Объём: </strong>'.$teh['car_volume'].'</p>
        <p><strong>Обивка салона: </strong>'.$teh['car_obivka'].'</p>
    </td>
    <td>
    <i class="icon-remove delavto'.$del_avto.'" rel="'.$teh['car_id'].'"></i>
    <a href="?avto='.$_GET['avto'].'&edit='.$teh['car_id'].'"><i class=" icon-pencil"></i></a>
    
    '.$ic_gl.'
    </td>
    </tr>';
}
?>
</table>
</div>

<?}?>



</div>
</div>
</div>


