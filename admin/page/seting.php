<div class="container">
      <div class="row-fluid">
<div class="span12">
<?if(isset($_GET['ban'])){
    
    
   if (isset($_FILES["ban"])) {
    
        $max_image_width	= 962;
        $max_image_height	= 392;
        $min_image_width	= 958;
        $min_image_height	= 388;
        $max_image_size		= 1024 * 2048;
        $valid_types 		=  array( "png");

	if (is_uploaded_file($_FILES['ban']['tmp_name'])) {
		$filename = $_FILES['ban']['tmp_name'];
		$ext = substr($_FILES['ban']['name'], 1 + strrpos($_FILES['ban']['name'], "."));
		if (filesize($filename) > $max_image_size) {
			echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Размер файла больше 1 mb. </div>';
		} elseif (!in_array($ext, $valid_types)) {
			echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Разрешено загружать только PNG формат.</div>';
		} else {
 			$size = GetImageSize($filename);
            
 			if ($size[0] < $max_image_width	&& $size[1] < $max_image_height && $size[0] > $min_image_width	&& $size[1] > $min_image_height ) {
				    $add=mysql_query("INSERT INTO `ban` SET `idd`='0' ");
                    $idd=mysql_insert_id();              
                      if (move_uploaded_file($filename, "../img/m".$idd.".jpg")) {
                      $add=mysql_query("UPDATE `ban` SET `idd`='".$idd."' WHERE id='".$idd."' ");
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>Фото успешно загружено.</div>';
                    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?set&ban'></head><body>";
				} else {
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> при попытке загрузить фото возникли ошибки , попробуйте вновь , если ошибка повторилась  обратитесь к Администратору.</div>';
				}
			} else {
				echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не допустимая высота или ширина фото. Размер фото  960 Х 500 пикселей </div>';
			}
		}
	} 
}
?>
<table class="table table-hover table-condensed table-bordered ban_table">
<tr><td colspan="3" >
<form action="" method="post" enctype="multipart/form-data" >
<div class="fileupload fileupload-new" data-provides="fileupload" style="float: right;" >
  <span class="btn-file" ><span class="fileupload-new"><i class="icon-plus"></i></span><span class="fileupload-exists"><i class="icon-minus"></i></span><input type="file" name="ban" style="width: 20px; height: 20px;border-width: 0 0 0px 0px;" /></span>
  <span class="fileupload-preview" ></span>
  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
  <input type="submit" value="Go" class="fileupload-exists" />
</div>
</form>
</td></tr>

<?

 if(isset($_GET['arov_down'])){
                $dow=mysql_query("SELECT * FROM  `ban` WHERE idd>$_GET[arov_down]  ORDER BY idd ASC   LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_down'];
                $add1=mysql_query("UPDATE `ban` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `ban` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `ban` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?set&ban'></head><body>";
            }
            if(isset($_GET['arov_up'])){
                $dow=mysql_query("SELECT * FROM  `ban` WHERE idd<$_GET[arov_up] ORDER BY idd DESC  LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_up'];
                $add1=mysql_query("UPDATE `ban` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `ban` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `ban` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?set&ban'></head><body>";
            }
             if(isset($_GET['glass'])){
                if($_GET['s']=='0'){$sat=1;}else{$sat=0;}
                $add1=mysql_query("UPDATE `ban` SET glass='$sat'  WHERE id='$_GET[glass]'");
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?set&ban'></head><body>";
            }




$pr=mysql_query("SELECT * FROM  `ban` ORDER BY idd ASC");
$i=1;
$i2=mysql_num_rows($pr);
while($prod=mysql_fetch_array($pr)){
echo '<tr class="bn'.$prod['id'].'">
    <td><img src="../img/m'.$prod['id'].'.jpg" width="400px" '; if($prod['glass']==1){echo 'class="gray"';}  echo' /></td><td><i class="icon-remove delban" rel="'.$prod['id'].'" ></i>
    ';
    
     if($i2>1){ if($i!=1){echo '<a href="?set&ban&arov_up='.$prod['idd'].'"><i class="icon-arrow-up"></i></a>';}
     if($i!=$i2){echo '<a href="?set&ban&arov_down='.$prod['idd'].'"><i class="icon-arrow-down"></i></a>';}
     
     if($prod['glass']==1){echo '<a href="?set&ban&glass='.$prod['id'].'&s=1"><i class="icon-eye-close"></i></a>';}else{
        echo '<a href="?set&ban&glass='.$prod['id'].'&s=0"><i class="icon-eye-open"></i></a>';
     }
      
       
  }
    $i++;
    echo '</td>
</tr>';

}
?>






</table>
    
    
    
    
    
<?}else{?>
<a href="?set&ban"><i class="icon-tag"></i>Управление баннером</a><br /><br />


<?

 $result = mysql_query("SELECT * FROM `admin`  ",$db);
 $pa= mysql_fetch_array($result);

if($_POST['login']!='' and $_POST['pass']!='' and $_POST['mail']!=''){
    $query=mysql_query("UPDATE `admin`  SET login='".$_POST['login']."', pass='".$_POST['pass']."', mail='".$_POST['mail']."'");
    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?set'></head><body>";
}
?>

<form  action="" method="post" enctype="multipart/form-data">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Login</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="login" value="<?echo $pa['login'];?>" placeholder="Login">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
      <input type="text" id="inputPassword" name="pass" value="<?echo $pa['pass'];?>" placeholder="Password">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">отправлять форму "Контактов" на</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="mail" value="<?echo $pa['mail'];?>" placeholder="E-mail">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Сохранить</button>
    </div>
  </div>
</form>
<?}?>

       </div>
       
       </div>
       
       </div>
       
       