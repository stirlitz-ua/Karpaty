<div class="container"><div class="row-fluid"><div class="span12"><?
 if ($_GET['banner']=='banner') {
   if (isset($_FILES["ban"])) {
        $max_image_width	= 962;
        $max_image_height	= 490;
        $min_image_width	= 958;
        $min_image_height	= 470;
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
				    $add=mysql_query("INSERT INTO `ban` SET `link`='".$_POST['link']."'  ");
                    $idd=mysql_insert_id();              
                      if (move_uploaded_file($filename, "../img/rotator/avto_".$idd.".jpg")) {
                      $add=mysql_query("UPDATE `ban` SET `idd`='".$idd."' WHERE id='".$idd."' ");
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>Фото успешно загружено.</div>';
                    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=banner'></head><body>";
				} else {
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> при попытке загрузить фото возникли ошибки , попробуйте вновь , если ошибка повторилась  обратитесь к Администратору.</div>';
				}
			} else {
				echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не допустимая высота или ширина фото. Размер фото  960 Х 485 пикселей </div>';
			}
		}
	} 
}
?><table class="table table-hover table-condensed table-bordered ban_table">
<tr><td colspan="3" ><form action="" method="post" enctype="multipart/form-data" >
<div class="fileupload fileupload-new" data-provides="fileupload" style="float: right;" >
  <span class="btn-file" ><span class="fileupload-new"><i class="icon-plus"></i></span><span class="fileupload-exists"><i class="icon-minus"></i></span><input type="file" name="ban" style="width: 20px; height: 20px;border-width: 0 0 0px 0px;" /></span>
  <span class="fileupload-preview" ></span>
  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
  <input type="text" class="fileupload-exists" style="margin: 0px 0px 0px 0px ;" name="link" placeholder="link" />
  <input type="submit" value="Go" class="fileupload-exists" />
</div></form></td></tr>
<?if(isset($_GET['arov_down'])){
                $dow=mysql_query("SELECT * FROM  `ban` WHERE idd>$_GET[arov_down]  ORDER BY idd ASC   LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_down'];
                $add1=mysql_query("UPDATE `ban` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `ban` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `ban` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=banner'></head><body>";
            }
            if(isset($_GET['arov_up'])){
                $dow=mysql_query("SELECT * FROM  `ban` WHERE idd<$_GET[arov_up] ORDER BY idd DESC  LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_up'];
                $add1=mysql_query("UPDATE `ban` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `ban` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `ban` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=banner'></head><body>";
            }
             if(isset($_GET['glass'])){
                if($_GET['s']=='0'){$sat=1;}else{$sat=0;}
                $add1=mysql_query("UPDATE `ban` SET glass='$sat'  WHERE id='$_GET[glass]'");
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=banner'></head><body>";
            }
$pr=mysql_query("SELECT * FROM  `ban` WHERE id>5 ORDER BY idd ASC");
$i=1;$i2=mysql_num_rows($pr);
while($prod=mysql_fetch_array($pr)){
echo '<tr class="bn'.$prod['id'].'"><td width="400px" ><img src="../img/rotator/avto_'.$prod['id'].'.jpg" width="400px" '; if($prod['glass']==1){echo 'class="gray"';}  echo' /></td><td>';
    if($prod['link']!=''){ echo '<a href="'.$prod['link'].'" target="_blank">'.$prod['link'].'</a>'; }
   echo ' </td><td><i class="icon-remove delban" rel="'.$prod['id'].'" ></i> ';
      if($i2>1){ if($i!=1){echo '<a href="?banner=banner&arov_up='.$prod['idd'].'"><i class="icon-arrow-up"></i></a>';}
     if($i!=$i2){echo '<a href="?banner=banner&arov_down='.$prod['idd'].'"><i class="icon-arrow-down"></i></a>';}
      } if($prod['glass']==1){echo '<a href="?banner=banner&glass='.$prod['id'].'&s=1"><i class="icon-eye-close"></i></a>';}else{
        echo '<a href="?banner=banner&glass='.$prod['id'].'&s=0"><i class="icon-eye-open"></i></a>';
     } $i++; echo '</td></tr>';
}
?>
</table>
    <?}elseif($_GET['banner']=='mb'){
    if (isset($_FILES["ban"])) {
    
        $max_image_width	= 208;
        $max_image_height	= 116;
        $min_image_width	= 204;
        $min_image_height	= 112;
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
				             
                      if (move_uploaded_file($filename, "../img/rotator/".$_POST['id'].".jpg")) {
                      
                      $add=mysql_query("UPDATE `ban` SET `link`='".$_POST['link']."' WHERE id='".$_POST['id']."' ");
                      
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>Фото успешно загружено.</div>';
                    echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=mb'></head><body>";
				} else {
					echo '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> при попытке загрузить фото возникли ошибки , попробуйте вновь , если ошибка повторилась  обратитесь к Администратору.</div>';
				}
			} else {
				echo '<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">×</button><h4>Ошибка:</h4> Не допустимая высота или ширина фото. Размер фото  206 Х 114 пикселей </div>';
			}
		}
	} 
}
?>
<table class="table table-hover table-condensed table-bordered ban_table">
<?if(isset($_GET['arov_down'])){
                $dow=mysql_query("SELECT * FROM  `ban` WHERE idd>$_GET[arov_down]  ORDER BY idd ASC   LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_down'];
                $add1=mysql_query("UPDATE `ban` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `ban` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `ban` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=mb'></head><body>";
            }
            if(isset($_GET['arov_up'])){
                $dow=mysql_query("SELECT * FROM  `ban` WHERE idd<$_GET[arov_up] ORDER BY idd DESC  LIMIT 1");
                $down=mysql_fetch_array($dow);
                $onm1=$down['idd'];
                $onm2=$_GET['arov_up'];
                $add1=mysql_query("UPDATE `ban` SET idd='0'  WHERE idd='$onm1'");
                $add2=mysql_query("UPDATE `ban` SET idd='$onm1'  WHERE idd='$onm2'");
                $add3=mysql_query("UPDATE `ban` SET idd='$onm2'  WHERE idd='0'"); 
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=mb'></head><body>";
            }
             if(isset($_GET['glass'])){
                if($_GET['s']=='0'){$sat=1;}else{$sat=0;}
                $add1=mysql_query("UPDATE `ban` SET glass='$sat'  WHERE id='$_GET[glass]'");
                echo "<html> <head> <meta HTTP-EQUIV='Refresh' CONTENT='0; URL=./?banner=mb'></head><body>";
            }
$pr=mysql_query("SELECT * FROM  `ban` WHERE id>0 AND id<6 ORDER BY idd ASC");
$i=1;$i2=mysql_num_rows($pr);while($prod=mysql_fetch_array($pr)){
echo '<tr class="bn'.$prod['id'].'"><td width="206px" ><img src="../img/rotator/'.$prod['id'].'.jpg" width="206px" '; if($prod['glass']==1){echo 'class="gray"';}  echo' /></td><td>';
if($prod['link']!=''){ echo '<a href="'.$prod['link'].'" target="_blank">'.$prod['link'].'</a>'; }
echo ' </td><td>'; if($i2>1){ if($i!=1){echo '<a href="?banner=mb&arov_up='.$prod['idd'].'"><i class="icon-arrow-up"></i></a>';}
     if($i!=$i2){echo '<a href="?banner=mb&arov_down='.$prod['idd'].'"><i class="icon-arrow-down"></i></a>';}}
     if($prod['glass']==1){echo '<a href="?banner=mb&glass='.$prod['id'].'&s=1"><i class="icon-eye-close"></i></a>';}else{
     echo '<a href="?banner=mb&glass='.$prod['id'].'&s=0"><i class="icon-eye-open"></i></a>';}
     echo '<form action="" method="post" enctype="multipart/form-data" ><input type="hidden" value="'.$prod['id'].'" name="id" /><div class="fileupload fileupload-new" data-provides="fileupload" style="float: right;" ><span class="btn-file" ><span class="fileupload-new"><i class="icon-pencil"></i></span><span class="fileupload-exists"><i class="icon-minus"></i></span><input type="file" name="ban" style="width: 20px; height: 20px;border-width: 0 0 0px 0px;" /></span><span class="fileupload-preview" ></span><a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a><input type="text" class="fileupload-exists" style="margin: 0px 0px 0px 0px ;" name="link" placeholder="link" /><input type="submit" value="Go" class="fileupload-exists" /></div></form>';
    $i++;echo '</td></tr>';
}?></table><?}?></div></div></div>