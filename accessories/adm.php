<? session_start();

include ("db.php"); 
unset($prava);
$cat_id = globper('cat_id'); $cat_name = globper('cat_name'); $cat_ud = globper('cat_ud'); $tov_id = globper('tov_id'); $mod_id = globper('mod_id'); if ($mod=='mod') { if (empty($mod_id)) { $mod_id=1; } } if (!isset($mod)) {  $mod='cat';  }

//выход
if (isset($_GET['logout']))
{	if (isset($_SESSION['ses_user'])) { unset($_SESSION['ses_user']); }
	if (isset($_SESSION['pass'])) { unset($_SESSION['pass']); }
	setcookie('user_id', '', 0, "/");
	setcookie('user_pass', '', 0, "/");
	header('Location: adm.php');
	exit;
}

//вход
if (!empty($_POST) && $act=="login")
{	$user_email = (isset($_POST['user_email'])) ? mysql_real_escape_string($_POST['user_email']) : '';
	$user_email =  trim($user_email);
	$user_pass = (isset($_POST['user_pass'])) ? mysql_real_escape_string($_POST['user_pass']) : '';
	$skybaselogin = mysql_query("SELECT `user_sol` FROM `users` WHERE `user_email`='{$user_email}' LIMIT 1",$db) or die(mysql_error());
	if (mysql_num_rows($skybaselogin) == 1)
	{
		$skyrowlogin = mysql_fetch_assoc($skybaselogin);
		$user_sol = $skyrowlogin['user_sol'];
		$user_pass = md5(md5($_POST['user_pass']) . $user_sol);
		$skybaselogin = mysql_query("SELECT `user_id`,`user_login`,`user_pass`,`user_prava` FROM `users` 
									WHERE `user_email`='{$user_email}' 
						   			AND `user_pass`='{$user_pass}' LIMIT 1",$db) or die(mysql_error());
		if (mysql_num_rows($skybaselogin) == 1)
		{
			$skyrowlogin = mysql_fetch_assoc($skybaselogin);
			$_SESSION['ses_user'] = $skyrowlogin['user_id'];
			$_SESSION['pass'] = $skyrowlogin['user_pass'];
			$name =  $skyrowlogin['user_login'];
			$prava = $skyrowlogin['user_prava'];
			if (isset($_POST['zapomnit']))
			{	$time = 12960000;
				setcookie('user_id', $skyrowlogin['user_id'], time()+$time, "/");
				setcookie('user_pass', $user_pass, time()+$time, "/");
			}
		if (isset ($cat_id) && !empty($cat_id)) {$act = "cat";}
		else {unset($act);}
		if (isset ($acton) && !empty($acton)) {$act = "pod";}
		}
		else { $oshibka = "Пароль для данного электронного адреса не верен"; }
	}
	else { $oshibka = "Пользователь с таким электронным адресом не найден"; }
}

//вход, если запомнили
if (isset($_COOKIE['user_id']) && isset($_COOKIE['user_pass']))
	{	$_SESSION['ses_user'] = $_COOKIE['user_id'];
		$_SESSION['pass'] = $_COOKIE['user_pass'];
	}
	
//проверка
if (isset($_SESSION['ses_user']) && isset($_SESSION['pass']))
	{
	$ses_user = (isset($_SESSION['ses_user'])) ? mysql_real_escape_string($_SESSION['ses_user']) : '';
	$pass = (isset($_SESSION['pass'])) ? mysql_real_escape_string($_SESSION['pass']) : '';
	$skybase = mysql_query("SELECT `user_id`,`user_login`,`user_pass`,`user_prava`,`user_email`
	FROM `users` WHERE `user_pass`='{$pass}' AND `user_id`='{$ses_user}' LIMIT 1",$db) or die(mysql_error());
		if (mysql_num_rows($skybase) == 1)
		{	$skyrow = mysql_fetch_array($skybase);
			$prava = $skyrow['user_prava'];
			$name =  $skyrow['user_login'];
			$user_email = $skyrow['user_email'];
		}
		else 
		{ 	$prava = 0;
			if (isset($_SESSION['ses_user'])) { unset($_SESSION['ses_user']); }
			if (isset($_SESSION['pass'])) { unset($_SESSION['pass']); }
			setcookie('user_id', '', 0, "/");
			setcookie('user_pass', '', 0, "/");
			header('Location: adm.php');
			exit(); 
		}
	}

//добавление фото
if (isset ($_FILES['file']['name']) && !empty($_FILES['file']['name']))
{
	//изменение картинки
	function file_sm2($bil, $stal, $width, $height, $quality=100)
		{ if (!file_exists($bil)) return false;
		  $size = getimagesize($bil);
		  if ($size === false) return false;
		  $icfunc = imagecreatefromstring(file_get_contents($bil));
		  $x_ratio = $width / $size[0];
		  $y_ratio = $height / $size[1];
		  $ratio       = min($x_ratio, $y_ratio);
		  $use_x_ratio = ($x_ratio == $ratio);
		  $new_width   = $use_x_ratio  ? $width  : floor($size[0] * $ratio);
		  $new_height  = !$use_x_ratio ? $height : floor($size[1] * $ratio);
		  $isrc = $icfunc;
		  $idest = imagecreatetruecolor($new_width, $new_height);
		  imagecopyresampled($idest, $isrc, 0, 0, 0, 0, 
		  $new_width, $new_height, $size[0], $size[1]);
		  imagejpeg($idest, $stal, $quality);
		  imagedestroy($isrc);
		  imagedestroy($idest);
		  return true;
		}
		
	  //добавление изображений
	  if ($mod=="cat") { $filedir = "pic/tov"; }
	  $filename = $_FILES['file']['name'];
	  $filesize = $_FILES['file']['size'];
	  $dopus=array("gif","jpg","jpeg","png"); 
	  $rash = strtolower(substr($filename, 1 + strrpos($filename, ".")));
	  $filename = $vrem.".".$rash;
	  if (!in_array($rash, $dopus)) 
	  { 
		  $oshibka .= "<center><div class='alert'>
		  Разрешены изображения с расширениями: gif, jpg, jpeg, png</div></center>"; $osh=1; }
		  $tochka = substr_count($filename, "."); 
		  if ($tochka > 1) 
		  { $oshibka .= "<center><div class='alert'>Запрещенный файл! Более одной точки</div></center>\r\n"; 
		  }
		  if (!preg_match("/^[a-z0-9\.\-_]+\.(jpg|gif|png|)+$/is",$filename)) 
		  { $oshibka .= "<center><div class=alert>
		  Название изображения содержит запрещенные символы</div></center>";
		  }
		  $filekb = round($filesize/10.24)/100;
		  $filexy=getimagesize($_FILES['file']['tmp_name']);
		  $gor = $filexy[0];
		  $ver = $filexy[1];
		  if ($filesize > "0" && !isset($oshibka)) 
		  {
		  copy ($_FILES['file']['tmp_name'], $filedir."/".$filename);
		  
		  if ($mod=='cat') { $maxgor=700;  $maxver=600; $sm_maxgor=140;  $sm_maxver=140; }
			if ($gor > $maxgor or $ver > $maxver)
			{
			if (file_sm2("$filedir/$filename", "$filedir/$filename", $maxgor, $maxver)) {  }
			else  { $oshibka .= '<div class=alert>Ошибка маштабирования</div>'; }	
			}
			if (file_sm2("$filedir/$filename", "$filedir/sm_$filename", $sm_maxgor, $sm_maxver)) {  }
			else  { $oshibka .= '<div class=alert>Ошибка маштабирования</div>'; }
			$foto = 'da';
		  }
		  else { $oshibka .= '<center><div class=alert>Изображение не загружено!</div></center>';
		  }
}
//конец добавления фото ^^	

//удаление товара
if (isset($tov_id) && !empty($tov_id)&& $prava==5 && $act=="udtov")
{	$skybasedeltov = mysql_query("SELECT `tov_foto` FROM `cat_tov` WHERE `tov_id`='{$tov_id}' LIMIT 1",$db) or die(mysql_error());
	$skyrowdeltov = mysql_fetch_array($skybasedeltov);
		if ($skyrowdeltov['tov_foto'] != 0) 
		{
		$tov_foto = $skyrowdeltov['tov_foto'];
		if (is_file("pic/tov/$tov_foto")) unlink ("pic/tov/$tov_foto");
		if (is_file("pic/tov/sm_$tov_foto")) unlink ("pic/tov/sm_$tov_foto");
		}
	$skybasedeltov1 = mysql_query ("DELETE FROM `cat_tov` WHERE `tov_id`='{$tov_id}'");
	$ok = "<center><div class='ok'>Товар успешно удален</div></center>"; 
}

//добавление категории и подкатегорий
if($act=="novpodkat" && $prava==5) 
{	if ($foto=="da") { $cat_pic = $filename; } else { $cat_pic = ''; }
	if(empty($cat_name)) { $oshibka="<center><div class='alert'>Обязательно напишите название рубрики</div></center>"; }
	else { 	$skydob = mysql_query ("INSERT INTO `cat_cat` (`cat_papa`,`cat_name`,`cat_pic`) 
																VALUES ('{$cat_id}','{$cat_name}','{$cat_pic}')",$db); }
	header('Location: adm.php?mod=cat&cat_id='.$cat_id);
}

//удаление категорий
if($act=="udcat" && $prava==5) 
{  	$skybase = mysql_query("SELECT `cat_pic` FROM `cat_cat` WHERE `cat_id`='{$cat_id}' LIMIT 1",$db) or die(mysql_error());
	$skyrow = mysql_fetch_assoc($skybase);
	if (!empty($skyrow['cat_pic'])) 
	{	$ob_foto = $skyrow['cat_pic'];
		if (is_file("pic/cat/$ob_foto")) unlink ("pic/cat/$ob_foto");
	}
	$skybase2 = mysql_query("SELECT `cat_id` FROM `cat_cat` WHERE `cat_papa`='{$cat_id}'",$db) or die(mysql_error());
	$skyrow2 = mysql_fetch_array($skybase2);
	if (mysql_num_rows($skybase2) > 0)
	{
	do {
		$skybase3 = mysql_query("SELECT `cat_id` FROM `cat_cat` WHERE `cat_papa`='{$skyrow2['cat_id']}'",$db) or die(mysql_error());
		if (mysql_num_rows($skybase3) > 0)
		{	$skyrow3 = mysql_fetch_array($skybase3);
			do {
				$skybase5 = mysql_query("SELECT `tov_foto` FROM `cat_tov` WHERE `tov_cat`='{$skyrow3['cat_id']}'",$db) or die(mysql_error());
				if (mysql_num_rows($skybase5) > 0)
				{	$skyrow5 = mysql_fetch_array($skybase5);
					do {
						if (!empty($skyrow5['tov_foto'])) 
						{	$ob_foto = $skyrow5['tov_foto'];
							if (is_file("pic/tov/$ob_foto")) unlink ("pic/tov/$ob_foto");
							if (is_file("pic/tov/sm_$ob_foto")) unlink ("pic/tov/sm_$ob_foto");
						}	
					}
					while ($skyrow5 = mysql_fetch_array($skybase5));
				$skybasedelob = mysql_query ("DELETE FROM `cat_tov` WHERE `tov_cat`='{$skyrow3['cat_id']}'");
				$skybasedelcat2 = mysql_query ("DELETE FROM `cat_cat` WHERE `cat_papa`='{$skyrow3['cat_id']}'");
				}
			}
			while($skyrow3 = mysql_fetch_array($skybase3));
		}
		else 
		{	$skybase4 = mysql_query("SELECT `tov_foto` FROM `cat_tov` WHERE `tov_cat`='{$skyrow2['cat_id']}'",$db) or die(mysql_error());
			if (mysql_num_rows($skybase4) > 0)
			{	$skyrow4 = mysql_fetch_array($skybase4);
				do {	if (!empty($skyrow4['tov_foto'])) 
						{	$ob_foto = $skyrow4['tov_foto'];
							if (is_file("pic/tov/$ob_foto")) unlink ("pic/tov/$ob_foto");
							if (is_file("pic/tov/sm_$ob_foto")) unlink ("pic/tov/sm_$ob_foto");
						}	
					}
					while ($skyrow4 = mysql_fetch_array($skybase4));
			  $skybasedelob = mysql_query ("DELETE FROM `cat_tov` WHERE `tov_cat`='{$skyrow2['cat_id']}'");
			  }
		}
	  $skybasedelcat1 = mysql_query ("DELETE FROM `cat_cat` WHERE `cat_papa`='{$skyrow2['cat_id']}'");
	  }
	  while ($skyrow2 = mysql_fetch_array($skybase2));
	  $skybasedelcat1 = mysql_query ("DELETE FROM `cat_cat` WHERE `cat_papa`='{$cat_id}'");
  }
  else 
  {	$skybase1 = mysql_query("SELECT `tov_foto` FROM `cat_tov` WHERE `tov_cat`='{$cat_id}'",$db) or die(mysql_error());
	if (mysql_num_rows($skybase1) > 0)
	{	$skyrow1 = mysql_fetch_array($skybase1);
		do {	if (!empty($skyrow1['tov_foto'])) 
				{	$ob_foto = $skyrow1['tov_foto'];
					if (is_file("pic/tov/$ob_foto")) unlink ("pic/tov/$ob_foto");
					if (is_file("pic/tov/sm_$ob_foto")) unlink ("pic/tov/sm_$ob_foto");
				}	
			}
		while ($skyrow1 = mysql_fetch_array($skybase1));
		$skybasedelob = mysql_query ("DELETE FROM `cat_tov` WHERE `tov_cat`='{$cat_id}'");
	}
  }
  $skybasedelcat = mysql_query ("DELETE FROM `cat_cat` WHERE `cat_id`='{$cat_id}'");
if (isset($cat_ud)) { $cat_id = $cat_ud; } else { unset($cat_id); }
}

//изменение личной информации
if ($prava==5 && $act=="redlich")
{
if (isset($_POST['user_pass']) && !empty($_POST['user_pass'])) 
{	$user_pass = globper('user_pass');
	function usersol($n=3)
	{	$key = '';
		$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
		$counter = strlen($pattern)-1;
		for($i=0; $i<$n; $i++)
		{ $key .= $pattern{rand(0,$counter)}; }
		return $key;
	}
	$user_sol = usersol();
	$newpass = $user_pass;
	$code_pass = md5(md5($newpass) . $user_sol);
	$skybase = mysql_query("UPDATE `cat_users` SET `user_pass`='{$code_pass}',`user_sol`='{$user_sol}' 
						   WHERE `user_id`='{$_SESSION['ses_user']}' AND `user_pass`='{$_SESSION['pass']}'",$db) or die(mysql_error());
	$_SESSION['pass'] = $code_pass;
}
$user_login = globper('user_login');
$user_email = globper('user_email');
$user_obl = globper('user_obl');
$user_gorod = globper('user_gorod');
$user_tel = globper('user_tel');
$user_fax = globper('user_fax');
$user_icq = globper('user_icq');
$user_web = globper('user_web');
$user_osebe = globper('user_osebe');
$skybase = mysql_query("UPDATE `cat_users` SET `user_email`='{$user_email}',`user_login`='{$user_login}',`user_obl`='{$user_obl}',
					`user_gorod`='{$user_gorod}',`user_tel`='{$user_tel}',`user_fax`='{$user_fax}',`user_icq`='{$user_icq}',
					`user_web`='{$user_web}',`user_osebe`='{$user_osebe}'  
					 WHERE `user_id`='{$_SESSION['ses_user']}' AND `user_pass`='{$_SESSION['pass']}'",$db) 
					 or die(mysql_error());
unset($act);
$ok = "<center><div class='ok'>Информация изменена</div></center>"; 
}	

//редактирование названия категории
if ($act=='redkat' && $prava==5) { 	$skybase = mysql_query("UPDATE `cat_cat` SET `cat_name`='{$cat_name}' WHERE `cat_id`='{$cat_id}'",$db) or die(mysql_error()); unset($rednazv);}	

//изменение разделов/модулей
if ($mod=='mod' && $act=='redmod' && $prava==5)
{	if (isset($_POST['mod_text'])) { $mod_text = $_POST['mod_text']; }
	$mod_nazv = globper('mod_nazv');
	if (!empty($mod_nazv)) { $modn=",`mod_nazv`='{$mod_nazv}'"; }
	$skycatred = mysql_query ("UPDATE `mod` SET `mod_text`='{$mod_text}'".$modn." WHERE `mod_id`='{$mod_id}'",$db);
	$ok = '<center><div class="ok">Изменения внесены</div></center>';
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "">
<html xml:lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title><? echo $nazv_cat; ?> — Администрирование</title>
<link href="st.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="tiny_mce/plugins/php/examples/snippets_admin.pages_php.js"></script>
<script type="text/javascript">
function showlayer(layer){
	var myLayer=document.getElementById(layer);
	if(myLayer.style.display=="none" || myLayer.style.display==""){
		myLayer.style.display="block";
	} else { 
		myLayer.style.display="none";
		}
}
</script>
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
		mode : "textareas",
		theme : "advanced",
		language : "ru",
		plugins : "pagebreak,style,layer,table,save,advhr,images,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
 /*		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,images",*/
		theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,fontsizeselect,backcolor,forecolor,|,preview",
		theme_advanced_buttons2 : "bullist,numlist,|,outdent,indent,|,anchor,link,unlink,hr,images,media,|,sub,sup,|,charmap,|,code",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "bottom",
		theme_advanced_toolbar_align : "center",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		content_css : "st.css",
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"
	});
</script>
<script type="text/javascript" src="scripts/jquery.fancybox-1.2.1.pack.js"></script>
<script src="scripts/jquery.validationengine.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/cat.js"></script>
</head>
<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" background="pic/skyscript_fon_verh.png">
  <tr>
    <td align="center">

</td>
  </tr>
</table>
<!-- Верх -->
<div align="center">

</div>
<? if ($prava==5) { ?>
<!-- Верхнее меню-->
<table style='margin-top:25px;' align='center' width='884' border='0' cellspacing='0' cellpadding='0'>
<tr>
    <td style='border-bottom:1px solid #cccccc;' valign='middle' align="left" height="37">
<a href="?mod=cat" class="nav">каталог</a>
<a href="?mod=mod" class="nav">разделы</a>
    <a href="?mod=nas"  class="nav">настройки</a>
    <a href="index.php" target="_blank" class="nav">в каталог</a></td>
    <td align="right" style='border-bottom:1px solid #cccccc; padding-right:10px;'><span class="zag2"><? echo $name; ?> </span></td>
    <td width="80" style='border-bottom:1px solid #cccccc;' align="right"><a class="nav" href="?logout" title="Выйти">выйти</a>   
    </td>
</tr>
</table>
<!-- Завершение Верхнее меню-->

<?
if (isset($oshibka)) { echo '<br />'.$oshibka; }
if (isset($ok)) { echo '<br />'.$ok; }
?>

<!-- Основная таблица -->
<table width="884" border="0" cellspacing="3" cellpadding="0" align="center" style="margin-top:15px;">
  <tr>
  <td valign="top" width="260">
<? if ($mod=="cat") 
{	$skybasecat = mysql_query("SELECT `cat_id`,`cat_name`,`cat_pic` FROM `cat_cat` WHERE `cat_papa`='0' ORDER BY `cat_name`",$db) or die(mysql_error());
	if (mysql_num_rows($skybasecat) > 0)
	{	$skyrowcat = mysql_fetch_array($skybasecat);
		do {	echo '<dl class="cat"><dt>';
				echo '<form action="adm.php" method="post">';
				echo '<input title="удалить рубрику '.$skyrowcat['cat_name'].'" align="right" style="border:0; padding:6px; cursor:pointer; margin:0; color:#000; background-color:#fff;" type="image"  src="pic/del.png" width="18" border="0" value="Удалить" onclick="if(confirm(\'Действительно удалить рубрику '.$skyrowcat['cat_name'].'?\n(все подрубрики и находящиеся в ней товары будут уничтожены)\'))submit();else return false;">';
				echo '<INPUT type="hidden" name="cat_id" value="'.$skyrowcat['cat_id'].'" />
				<INPUT type="hidden" name="act" value="udcat" />
				<INPUT type="hidden" name="mod" value="cat" /></form>';
				echo '<a href="adm.php?mod=cat&cat_id='.$skyrowcat['cat_id'].'">'.$skyrowcat['cat_name'].'</a></dt>';
				$skybasecat1 = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$skyrowcat['cat_id']}'
														ORDER BY `cat_name`",$db) or die(mysql_error());
				if (mysql_num_rows($skybasecat1) > 0)
				{	$skyrowcat1 = mysql_fetch_array($skybasecat1);
					do {  echo '<dd>';
						  echo '<form action="adm.php" method="post">';
						  echo '<a href="adm.php?mod=cat&cat_id='.$skyrowcat1['cat_id'].'" 
						  title="'.$skyrowcat1['cat_name'].'">'.$skyrowcat1['cat_name'].'</a>';
						  echo '<input title="удалить подрубрику '.$skyrowcat1['cat_name'].'" style="border:0; padding:1px 1px 1px 10px; cursor:pointer; margin:0; color:#000; background-color:#fff;" type="image"  src="pic/del.png" width="10" border="0" value="Удалить" onclick="if(confirm(\'Действительно удалить подрубрику '.$skyrowcat1['cat_name'].'?\n(все подрубрики и находящиеся в ней товары будут уничтожены)\'))submit();else return false;">';
						  echo '<INPUT type="hidden" name="cat_id" value="'.$skyrowcat1['cat_id'].'" />
						  <INPUT type="hidden" name="act" value="udcat" />
						  <INPUT type="hidden" name="mod" value="cat" /></form>';
						  echo '</dd>';
						}
					while($skyrowcat1 = mysql_fetch_array($skybasecat1));
				}
				echo'<dd><form action="adm.php" method="post"><input name="cat_name" type="text" value="" />
				<input name="act" value="novpodkat" type="hidden" /> 
				<input name="cat_id" value="'.$skyrowcat['cat_id'].'" type="hidden" /> 
				<input style="width:12px; margin:0; border:none; background:none;" type="image" src="pic/zap.png" value="Submit" /></form></dd>';
				echo '</dl>';
			}
		while($skyrowcat = mysql_fetch_array($skybasecat));
		}
		else { echo "Нет категорий"; }
			echo '<dl class="cat">';
		 	echo '<dt>';
			  echo'<form action="adm.php" method="post" enctype="multipart/form-data">';
//			  <span class="sm">картинка для рубрики: </span><br />
//			  <input style="margin:2px 0 0px 0;" value="" size="5" type="file" name="file" />
			  echo'<input style="margin:2px 0 8px 0;" name="cat_name" type="text" value="" />
			  <input name="act" value="novpodkat" type="hidden" /> 
			  <input name="cat_id" value="0" type="hidden" /> 
			  <input style="width:20px; margin:0; border:none; background:none;" type="image" src="pic/zap.png" value="Submit" /></form>';
echo '</dt></dl>';	
} 
if ($mod=='mod')
{
	//добавление раздела
	if ($act=='novmod')
		{
		$mod_nazv = globper('mod_nazv');
		if (empty($mod_nazv)) { al("Обязательно введите название раздела"); }
		else { $skydob = mysql_query ("INSERT INTO `mod` (`mod_nazv`) VALUES ('{$mod_nazv}')",$db) or die(mysql_error()); }
		}
	//Удаление раздела
		if ($act=='udmod')
		{
		if ($mod_id==1) { al("Главную страницу удалить нельзя"); }
		else { $skyud = mysql_query ("DELETE FROM `mod` WHERE `mod_id`='{$mod_id}'"); $mod_id=1; }
		}
	$skybasemod = mysql_query("SELECT `mod_id`,`mod_nazv` FROM `mod` ORDER BY `mod_id`",$db) or die(mysql_error());
	if (mysql_num_rows($skybasemod) > 0)
		{
			echo '<br />';
			$skyrowmod = mysql_fetch_array($skybasemod);
			do { 
			if ($skyrowmod['mod_id']!=1){
			echo '<form action="adm.php" method="post">';
			echo '<input title="удалить раздел '.$skyrowmod['mod_nazv'].'" style="border:0; padding:1px 35px 1px 10px; cursor:pointer; margin:0; color:#000; background-color:#fff; float:right;" type="image" src="pic/del.png" width="18" border="0" value="Удалить" onclick="if(confirm(\'Действительно удалить раздел '.$skyrowmod['mod_nazv'].'?\n(вся информация раздела будет уничтожена)\'))submit();else return false;">';
			echo '<INPUT type="hidden" name="mod_id" value="'.$skyrowmod['mod_id'].'" />
			<INPUT type="hidden" name="act" value="udmod" /><INPUT type="hidden" name="mod" value="mod" /></form>';
			}
			echo ' <a class="nav" href="adm.php?mod=mod&mod_id='.$skyrowmod['mod_id'].'" title="'.$skyrowmod['mod_nazv'].'">'.$skyrowmod['mod_nazv'].'</a> ';
			echo '<br /><br /><br />';
			}
			while ($skyrowmod = mysql_fetch_array($skybasemod));
		}
?>	
<form method="post" action="adm.php">
<input type="text" name="mod_nazv" style="width:200px;" />
<input type="hidden" name="act" value="novmod" />
<input type="hidden" name="mod" value="mod" />
<input type="hidden" name="mod_id" value="<? echo $mod_id; ?>" />
<input style="margin-top:10px; width:205px;" type="submit" class="kn" value="Добавить новый раздел" />
</form>
<? } ?>
 </td>
    <td valign="top">
<!-- Рабочий блок -->  

<?
//категории
if ($mod=='cat')
{
	
//добавление товара
if ($act=="dobavtov")
{	$tov_nazv = globper('tov_nazv');
	$tov_artic = globper('tov_artic');
	$tov_cena = globper('tov_cena');
	$tov_starcena = globper('tov_starcena');
	$tov_perv = globper('tov_perv');
	$tov_com = globper('tov_com');
	$tov_kolvo = globper('tov_kolvo');
	if (!empty($tov_perv)) {$tov_perv=1;} else {$tov_perv=0;}
	if (!empty($tov_com)) {$tov_com=1;} else {$tov_com=0;}
	if (isset($_POST['tov_opis'])) { $tov_opis = $_POST['tov_opis']; $tov_opis = trim($tov_opis); $tov_opis = stripslashes($tov_opis); }
	if (empty($tov_nazv)) {
		echo "<center><div class=alert>Обязательно напишите название товара</div></center>";
		$act='dobtov';	
		}
	else {
		$skybase= mysql_query ("INSERT INTO `cat_tov` 
		(`tov_cat`,`tov_foto`,`tov_nazv`,`tov_artic`,`tov_cena`,`tov_starcena`,`tov_opis`,`tov_kolvo`,`tov_perv`,`tov_com`) 
VALUES ('{$cat_id}','{$filename}','{$tov_nazv}','{$tov_artic}','{$tov_cena}','{$tov_starcena}','{$tov_opis}','{$tov_kolvo}','{$tov_perv}','{$tov_com}')",$db) or die(mysql_error());	
		
		// xml
		$skybasexml = mysql_query("SELECT `tov_id`,`tov_cat`,`tov_nazv`,`tov_cena`,`tov_opis`
		FROM `cat_tov` ORDER BY `tov_id` DESC LIMIT 10",$db) or die(mysql_error());
		  $skyrowxml = mysql_fetch_array($skybasexml);
		  $requrl = str_replace("adm.php", "cat.php", $_SERVER['REQUEST_URI']);
		  $adres = $_SERVER['SERVER_NAME'].$requrl;
			$fz = fopen("cat.xml","w"); 
			fwrite($fz,""); 
			fclose($fz); 
		  $skyfz = fopen ("cat.xml", "a+");
	  fputs($skyfz,"<?xml version='1.0' encoding='windows-1251'?> \n");
	  fputs($skyfz,"	<rss version='2.0'> \n");
	  fputs($skyfz,"		<channel> \n");
	  fputs($skyfz,"			<title>".$nazv_cat."</title> \n");
	  fputs($skyfz,"			<link>http://".$adres."</link> \n");
	  fputs($skyfz,"			<description>Последние поступления — ".$nazv_cat."</description>  \n");
  do
	  {
	  $tov_opis = strip_tags($skyrowxml["tov_opis"]);	
	  $opis = substr("$tov_opis", 0, 70); $opis = $opis."...";
	  
	  fputs($skyfz,"			<item> \n");
	  fputs($skyfz,"				<title>".$skyrowxml["tov_nazv"]."</title> \n");
	  fputs($skyfz,"				<link>http://".$adres."?mod=cat&amp;cat_id=".$skyrowxml["tov_cat"]."&amp;tov_id=".$skyrowxml["tov_id"]."</link> \n");
	  fputs($skyfz,"				<description>".$opis." Цена: ".$skyrowxml["tov_cena"]." ".$cat_val."</description> \n");
	  fputs($skyfz,"			</item> \n");  
	   }
  while ($skyrowxml = mysql_fetch_array($skybasexml));  
		fputs($skyfz,"		</channel> \n");
		fputs($skyfz,"	</rss> \n");
		fclose($skyfz);
		
	}
}

//редактирование товара
if ($act=="redaktov")
{
	$tov_nazv = globper('tov_nazv');
	$tov_artic = globper('tov_artic');
	$tov_cena = globper('tov_cena');
	$tov_starcena = globper('tov_starcena');
	$tov_perv = globper('tov_perv');
	$tov_cat = globper('tov_cat');
	$tov_com = globper('tov_com');
	$tov_kolvo = globper('tov_kolvo');

	if (!empty($tov_perv)) {$tov_perv=1;} else {$tov_perv=0;}
	if (!empty($tov_com)) {$tov_com=1;} else {$tov_com=0;}
	if (isset($_POST['tov_opis'])) { $tov_opis = $_POST['tov_opis']; $tov_opis = trim($tov_opis); $tov_opis = stripslashes($tov_opis); }
	if (empty($tov_nazv) or empty($tov_cena)) {
		$al ="Обязательно напишите название товара и его цену"; 	
		}
	else {
		if (empty($filename)) {$foto ="";}
		else { $foto = ",`tov_foto`='{$filename}'"; } 
		$skybase = mysql_query("UPDATE `cat_tov` SET  `tov_cat`='{$tov_cat}',`tov_nazv`='{$tov_nazv}',`tov_artic`='{$tov_artic}',`tov_cena`='{$tov_cena}',`tov_starcena`='{$tov_starcena}',`tov_perv`='{$tov_perv}',`tov_opis`='{$tov_opis}',`tov_kolvo`='{$tov_kolvo}',`tov_com`='{$tov_com}'".$foto." 
						   WHERE `tov_id`='{$tov_id}'",$db) or die(mysql_error());
		}
$act='redtov';
$cat_id=$tov_cat;
}	
	//путь по открытым категориям
	if (!empty($cat_id)) {
	$cat_idput = $cat_id;
		for ($i = 0; ; $i++) 
		{
		$skybaseput = mysql_query("SELECT `cat_id`,`cat_name`,`cat_papa` FROM `cat_cat` WHERE `cat_id`='{$cat_idput}'",$db) 
		or die(mysql_error());
				$skyrowput = mysql_fetch_array($skybaseput);
				$catput = "<a class='ch' href='adm.php?mod=cat&cat_id=".$skyrowput['cat_id']."'>
				".$skyrowput['cat_name']."</a> <span class='kr'>&raquo;</span> ".$catput;
				if ($skyrowput['cat_papa']==0) { break;}
				$cat_idput = $skyrowput['cat_papa'];
		}	
	}	
				$catput = "<a class='ch' title='к рубрикам' href='adm.php?mod=cat'>Главная</a> 
				<span class='kr'>&raquo;</span> ".$catput."";
				$catsey = $skyrowput['cat_name'];
		echo '<div style="background-color:#f5f5f5; padding:10px; margin:0 0 10px 0;">';
      	echo $catput; 
		echo '</div>';


//добавление доп фото
if ($act=='dobfoto') {
	if(!isset($oshibka)) {
		$foto_tit = globper('foto_tit');
		$skydobfoto = mysql_query ("INSERT INTO `foto` (`foto_kmestu`,`foto_tit`,`foto_file`)
				VALUES ('{$tov_id}','{$foto_tit}','{$filename}')",$db);
		}
$act='redtov';
}

//удаление доп фото
if ($act=="udfoto") 
{
	$foto_id = globper('foto_id');
	$skynameudfoto = mysql_query("SELECT `foto_file` FROM `foto` WHERE `foto_id`='{$foto_id}' LIMIT 1",$db);
	$skyrowudfoto = mysql_fetch_array($skynameudfoto);
	$udfoto = $skyrowudfoto['foto_file'];
	if (is_file("pic/tov/$udfoto")) unlink ("pic/tov/$udfoto");
	if (is_file("pic/tov/sm_$udfoto")) unlink ("pic/tov/sm_$udfoto");
	$skyudfoto = mysql_query ("DELETE FROM `skyfoto` WHERE `foto_id`='{$foto_id}' LIMIT 1"); 
$act="redtov";
}

	
//добавление/редактирование товара
if ($act=='dobtov' or $act=='redtov') 
{
		$skybasecatname = mysql_query("SELECT `cat_name` FROM `cat_cat` WHERE `cat_id`='{$cat_id}'",$db) or die(mysql_error());
		$skyrowcatname = mysql_fetch_array($skybasecatname);
		echo '<h4 style="margin:15px 0 10px 0;">';
		if ($act=='dobtov') { echo 'Новый товар в категорию'; }
		if ($act=='redtov') { 
						echo '<form action="adm.php" method="post">';
						  echo '<input align="right" title="удалить товар" style="background:none; border:0; padding:1px 1px 1px 10px; cursor:pointer; margin:0; color:#000;" type="image"  src="pic/del.png" width="25" border="0" value="Удалить" onclick="if(confirm(\'Действительно удалить товар?\n(изображение и информация будут удалены)\'))submit();else return false;">';
						  echo '<INPUT type="hidden" name="tov_id" value="'.$tov_id.'" />
						  <INPUT type="hidden" name="cat_id" value="'.$cat_id.'" />
						  <INPUT type="hidden" name="act" value="udtov" />
						  <INPUT type="hidden" name="mod" value="cat" /></form>';
		echo 'Редактирование товара в категории'; }
		echo ' — '.$skyrowcatname['cat_name'].'</h4>';
	if ($act=='redtov')
	{
		$skybasetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_id`='{$tov_id}' LIMIT 1",$db) or die(mysql_error());
		$skyrowtov = mysql_fetch_array($skybasetov);
		if (!empty($skyrowtov['tov_foto'])) { $tov_foto = '<img src="pic/tov/sm_'.$skyrowtov['tov_foto'].'"><br />'; } 
		else { $tov_foto = ''; }
		$tov_nazv = $skyrowtov['tov_nazv'];
		$tov_opis = $skyrowtov['tov_opis'];
		$tov_artic = $skyrowtov['tov_artic'];
		$tov_cena = $skyrowtov['tov_cena'];
		$tov_starcena = $skyrowtov['tov_starcena'];
		$tov_opis = $skyrowtov['tov_opis'];
		$tov_kolvo = $skyrowtov['tov_kolvo'];
		$tov_perv = $skyrowtov['tov_perv'];
		$tov_com = $skyrowtov['tov_com'];
		if ($tov_perv==1) { $check='checked="checked"'; } else { $check=''; }
		if ($tov_com==1) { $checkcom='checked="checked"'; } else { $checkcom=''; }
	}
	else { unset($tov_foto); unset($tov_nazv); unset($tov_opis); unset($tov_artic); unset($tov_cena); unset($tov_starcena); unset($tov_opis); unset($tov_perv); $checkcom='checked="checked"';}
?>
	<form class="formular"  action="adm.php" method="post" enctype="multipart/form-data" style="margin:10px 0 0 0;">
	<table width="450" class="tbl" cellpadding="0" cellspacing="0">
<? 

if ($act=='redtov') { 
echo '<tr><td>Перенести в категорию</td><td>
<select name="tov_cat" style="width:300px; margin:8px;">';
     $skybasecat = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='0' ORDER BY `cat_name`",$db) 
	or die(mysql_error());
	if (mysql_num_rows($skybasecat) > 0)
		{
			$skyrowcat = mysql_fetch_array($skybasecat);
			do { 
			
			$skybasecat1 = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$skyrowcat['cat_id']}'
													ORDER BY `cat_name`",$db) or die(mysql_error());
						if (mysql_num_rows($skybasecat1) > 0)
							{
								echo '<optgroup label="'.$skyrowcat['cat_name'].'" style="margin-left:0px;">';
								$skyrowcat1 = mysql_fetch_array($skybasecat1);
								do { 
								
								$skybasecat2 = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$skyrowcat1['cat_id']}' ORDER BY `cat_name`",$db) or die(mysql_error());
									if (mysql_num_rows($skybasecat2) > 0)
										{
											echo '<optgroup label="'.$skyrowcat1['cat_name'].'" style="padding-left:15px;">';
											$skyrowcat2 = mysql_fetch_array($skybasecat2);
											do {
											if ($skyrowcat2['cat_id']==$cat_id) { $chek = ' selected="selected"'; } else { $chek = ''; }
								echo '<option '.$chek.' value="'.$skyrowcat2['cat_id'].'">'.$skyrowcat2['cat_name'].'</option>';
											}
											while($skyrowcat2 = mysql_fetch_array($skybasecat2));
											echo '</optgroup>';
										}
									else {
								
								if ($skyrowcat1['cat_id']==$cat_id) { $chek = ' selected="selected"'; } else { $chek = ''; }
								echo '<option '.$chek.' value="'.$skyrowcat1['cat_id'].'" style="padding-left:15px;">'.$skyrowcat1['cat_name'].'</option>';
									}
						  		}
								while($skyrowcat1 = mysql_fetch_array($skybasecat1));
								$chek = '';
								echo '</optgroup>';
							}
				else { 
				
					if ($skyrowcat['cat_id']==$cat_id) { $chek = ' selected="selected"'; } else { $chek = ''; }
					echo '<option '.$chek.' value="'.$skyrowcat['cat_id'].'" style="margin-left:0px;">'.$skyrowcat['cat_name'].'</option>'; 
					
					}
			
				}
			while($skyrowcat = mysql_fetch_array($skybasecat));
		}
echo '</select></td></tr>';
} 

?>
    <tr>
	<td width="200">
	<span class="text">Основное фото товара</span><br />
	<span class="sm">(Желательно размером не более 1 Mb)</span><br />
    <center><? echo $tov_foto; ?></center></td>
    <td><input type="file" name="file" style="margin:8px;" /></td></tr>
	<tr><td><span class="text">Название товара:</span><br />
	<span class="sm">(Не более 70 символов)</span></td>
    <td>
    <INPUT class="validate[required,length[0,100]] text-input" value="<? echo $tov_nazv; ?>" type="text" name="tov_nazv" style="width:300px; margin:8px;">
    </td></tr>
   	<tr><td><span class="text">Артикул:</span></td>
    <td><INPUT value="<? echo $tov_artic; ?>" type="text" class="inp2" name="tov_artic" style="width:300px; margin:8px;">
    </td></tr>
    <tr><td><span class="text">Цена товара:</span></td>
    <td><INPUT value="<? echo $tov_cena; ?>" type="text" class="inp2" name="tov_cena" onkeyup="return tolkoCif(this);" onchange="return tolkoCif(this);" style="width:300px; margin:8px;">
    </td></tr>
    <tr><td><span class="text">Старая цена:</span><br />
	<span class="sm">(будет перечеркнута)</span></td>
    <td><INPUT value="<? echo $tov_starcena; ?>" type="text" class="inp2" name="tov_starcena" onkeyup="return tolkoCif(this);" onchange="return tolkoCif(this);" style="width:300px; margin:8px;"></td></tr>
    <tr><td><span class="text">Количество:</span><br />
	<span class="sm"></span></td>
    <td><INPUT value="<? echo $tov_kolvo; ?>" type="text" class="inp2" name="tov_kolvo" onkeyup="return tolkoCif(this);" onchange="return tolkoCif(this);" style="width:300px; margin:8px;"></td></tr>
    <tr><td><span class="text">Отображать на 1 странице</span><br />
	<span class="sm">(будет показан на главной)</span></td>
    <td><INPUT type="checkbox" <? echo $check; ?> class="inp2" name="tov_perv" style="margin:12px 0 12px 8px;"></td></tr>
        <tr><td><span class="text">Комментирование</span><br />
	<span class="sm">(при снятой галочке комментарии запрещены)</span></td>
    <td><INPUT type="checkbox" <? echo $checkcom; ?> class="inp2" name="tov_com" style="margin:12px 0 12px 8px;"></td></tr>
	 <tr><td colspan="2"><div class="text" style="margin:5px 0 3px 0;">Описание товара:<br />
	<span class="sm"></span></div>
	 <textarea id="elm_content" name="tov_opis" style="width:620px; height:300px;"><? echo $tov_opis; ?></textarea></td></tr>
	<tr><td colspan="2" align="center">
	<INPUT type="hidden" name="mod" value="cat" />
	<INPUT type="hidden" name="page" value="<? echo $page; ?>" />
    <INPUT type="hidden" name="cat_id" value="<? echo $cat_id; ?>" />
    <? if ($act=="redtov") { ?>
	<INPUT type="hidden" name="act" value="redaktov" />
	<INPUT type="hidden" name="tov_id" value="<? echo $tov_id; ?>" />
    <INPUT type="submit" style="margin:10px 0 20px 0; cursor:pointer;" value="Редактировать товар">
    <? } else { ?>
	<INPUT type="hidden" name="act" value="dobavtov" /> 
    <INPUT style="margin: 10px 0 20px 0; cursor:pointer;" type="submit" value="Разместить товар">
    <? } ?>
	</td>
	</tr></table>
	</form>
    
<!--Дополнительные фотографии-->
<table align="left" class="tbl" border="0"><tr><td>
<form action="adm.php#dopfoto" method="post" enctype="multipart/form-data">
Дополнительные фотографии
<span class="sm"> (подгружайте дополнительные изображения к товару) </span><br />
<input value="" size="18" type="file" name="file" style="width:230px; margin:7px 0 10px 0;" /> 
Подпись к фото: <INPUT type="text" name="foto_tit" style="width:150px;" />
<INPUT type="hidden" name="act" value="dobfoto" /> 
<input type="hidden" name="mod" value="cat">
<input type="hidden" name="cat_id" value="<? echo $cat_id; ?>">
<input type="hidden" name="tov_id" value="<? echo $tov_id; ?>">
<input type="hidden" name="page" value="<? echo $page; ?>">
<INPUT style="padding:3px; margin:0px 0px 0 10px; cursor:pointer;" type="submit" value="Загрузить" />
</form> 
</td></tr></table>
<a name="dopfoto" id="dopfoto"></a>

<? 
$skybasefoto = mysql_query("SELECT * FROM `foto` WHERE `foto_kmestu`='{$tov_id}' ORDER BY `foto_id`",$db);
	if (mysql_num_rows($skybasefoto) > 0)
		{
		echo '<table><tr><td>';
		$skyrowfoto = mysql_fetch_array($skybasefoto);
			do { 
			echo '<table align="left" class="tbl" border="0"><tr><td>
			<a title="удалить" class="kr" href="?act=udfoto&mod=cat&cat_id='.$cat_id.'&tov_id='.$tov_id.'&foto_id='.$skyrowfoto['foto_id'].'#dopfoto">
			<img width="15" src="pic/del.png" /></a><br />
			<a class="gallery" rel="group" title="'.$skyrowfoto['foto_tit'].'" href="pic/tov/'.$skyrowfoto['foto_file'].'">
			<img style="margin-right:10px;" height="50" src="pic/tov/sm_'.$skyrowfoto['foto_file'].'"></a></td></tr></table>';
			}
			while ($skyrowfoto = mysql_fetch_array($skybasefoto));
		echo '</td></tr></table>';
		}
echo '<br /><br /><br /><br /><br />';
	}
	
//название категории и редактирование
$skybasecatname = mysql_query("SELECT `cat_name` FROM `cat_cat` WHERE `cat_id`='{$cat_id}'",$db) or die(mysql_error());
$skyrowcatname = mysql_fetch_array($skybasecatname);
echo '<p class="zag2" style="margin:0 0 0 0; font-size:140%; font-weight:bold;">';
$rednazv = globper('rednazv');
if ($rednazv && !empty($cat_id)) { 
echo'<form action="adm.php" method="post">
<input style="width:300px;" name="cat_name" type="text" value="'.$skyrowcatname['cat_name'].'" />
<input name="act" value="redkat" type="hidden" /> 
<INPUT type="hidden" name="mod" value="cat" />
<input name="cat_id" value="'.$cat_id.'" type="hidden" /> 
<input style="margin-top:5px;" name="" type="submit" value="редактировать" /></form>';
} else if (!empty($cat_id)){
echo $skyrowcatname['cat_name'].' <a class="sm2" href="adm.php?mod=cat&cat_id='.$cat_id.'&rednazv=1"> ред.</a>';
}
echo '</p>';

//список подкатегорий
$skybasecat = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$cat_id}' ORDER BY `cat_name`",$db) or die(mysql_error());
echo '<dl class="cat" style="width:625px; border:0px solid #000;">';
if (mysql_num_rows($skybasecat) > 0)
{
$skyrowcat = mysql_fetch_array($skybasecat);
do { 
  //подсчет кол-ва товаров в рубрике
  $skybasekol = mysql_query("SELECT `cat_id` FROM `cat_cat` 
  WHERE `cat_papa`='{$skyrowcat['cat_id']}'",$db) or die(mysql_error());
  if (mysql_num_rows($skybasekol) > 0)
  {	  $skyrowkol = mysql_fetch_array($skybasekol);
	  do {
  $skybasekolvo = mysql_query("SELECT `tov_id` FROM `cat_tov` 
  WHERE `tov_cat`='{$skyrowkol['cat_id']}'",$db) or die(mysql_error());
  $kolvotov = $kolvotov + mysql_num_rows($skybasekolvo);
	  }
	  while ($skyrowkol = mysql_fetch_array($skybasekol));
	  if ($kolvotov>0) {$kolvotov="(".$kolvotov.")";} else {$kolvotov="";}
  }
  else 
  {
  $skybasekolvo = mysql_query("SELECT `tov_id` FROM `cat_tov` 
  WHERE `tov_cat`='{$skyrowcat['cat_id']}'",$db) or die(mysql_error());
  $kolvotov = mysql_num_rows($skybasekolvo);
  if ($kolvotov>0) {$kolvotov="(".$kolvotov.")";} else {$kolvotov="";}
  }
echo "<dd><form action='adm.php' method='post'>";
echo"<a href='adm.php?mod=cat&cat_id=".$skyrowcat['cat_id']."' title='".$skyrowcat['cat_name']."'>".$skyrowcat['cat_name']."</a>
<span style='margin-left:3px;' class='sm2'>".$kolvotov."</span>";
$kolvotov = "";
echo '<input title="удалить подрубрику '.$skyrowcat['cat_name'].'" style="border:0; padding:1px 1px 1px 10px; cursor:pointer; margin:0; color:#000; background-color:#fff;" type="image"  src="pic/del.png" width="10" border="0" value="Удалить" onclick="if(confirm(\'Действительно удалить подрубрику '.$skyrowcat['cat_name'].'?\n(все подрубрики и находящиеся в ней товары будут уничтожены)\'))submit();else return false;">';
echo "<INPUT type='hidden' name='cat_id' value='".$skyrowcat['cat_id']."' />
<INPUT type='hidden' name='act' value='udcat' />
<INPUT type='hidden' name='mod' value='cat' />
<INPUT type='hidden' name='cat_ud' value='".$cat_id."' /></form>";
echo"</dd>";
}
while($skyrowcat = mysql_fetch_array($skybasecat));
if ($act!='dobtov') 
{
echo'<dd><form action="adm.php" method="post"><input name="cat_name" type="text" value="" />
<input name="act" value="novpodkat" type="hidden" /> 
<input name="mod" value="cat" type="hidden" /> 
<input name="cat_id" value="'.$cat_id.'" type="hidden" /> 
<input style="margin-top:5px;" name="" type="submit" value="добавить подрубрику" /></form></dd>';	}	
}	
else { 
	if ($act!='dobtov') { echo '<div align="right" style="margin:0 0 10px 0;"><a class="zag2" href="adm.php?mod=cat&cat_id='.$cat_id.'&act=dobtov"> + Добавить товар</a></div>';	 }

// вывод товаров
	  $num = 12;
	  $link .= 'adm.php?mod=cat&cat_id='.$cat_id.'';
	  if (isset($_GET['page'])) {$page = $_GET['page']; }
	  if (isset($_POST['page'])) {$page = $_POST['page']; }
	  $skybase1 = mysql_query("SELECT COUNT(*) FROM `cat_tov` 
							   WHERE `tov_cat`='{$cat_id}'");
	  $temp = mysql_fetch_array($skybase1);
	  $posts = $temp[0];
	  $total = (($posts - 1) / $num) + 1;
	  $total =  intval($total);
	  $page = intval($page);
	  if(empty($page) or $page < 0) $page = 1;
		if($page > $total) $page = $total;
	  $start = $page * $num - $num;
	  if ($start < 0) { $start = 0;}
	  if ($page != 1) $pervpage = ' &nbsp;<a class="nav" href='.$link.'&page=1>Первая</a>&nbsp;
	  &nbsp;<a class="nav" title=Предидущая  href='.$link.'&page='. ($page - 1) .'>&laquo;</a>&nbsp; ';
	  if ($total > 1 and $page > 2) { $toch = ' &nbsp;<span class=ser> .... </span>&nbsp; '; }
	  $page2 = $total - $page;
	  if ($total > 1 and $page2 >= 2) { $toch2 = ' &nbsp;<span class=ser> .... </span>&nbsp; '; }
	  if ($page != $total) $nextpage = ' &nbsp;<a class="nav" title=Следующая href='.$link.'&page='. ($page + 1) .'>&raquo;</a>&nbsp;
	  &nbsp;<a class="nav" href='.$link.'&page=' .$total. '>Последняя</a>&nbsp; ';
	  if($page - 5 > 0) $page5left = ' &nbsp;<a class="nav" href='.$link.'&page='. ($page - 5) .'>'.($page - 5).'</a>&nbsp; ';
	  if($page - 4 > 0) $page4left = ' &nbsp;<a class="nav" href='.$link.'&page='. ($page - 4) .'>'.($page - 4).'</a>&nbsp; ';
	  if($page - 3 > 0) $page3left = ' &nbsp;<a class="nav" href='.$link.'&page='. ($page - 3) .'>'.($page - 3).'</a>&nbsp; ';
	  if($page - 2 > 0) $page2left = ' &nbsp;<a class="nav" href='.$link.'&page='. ($page - 2) .'>'.($page - 2).'</a>&nbsp; ';
	  if($page - 1 > 0) $page1left = ' &nbsp;<a class="nav" href='.$link.'&page='. ($page - 1) .'>'. ($page - 1) .'</a>&nbsp; ';
	 if($page + 5 <= $total) $page5right = ' &nbsp;<a class="nav" href='.$link.'&page='.($page + 5).'>'.($page + 5).'</a>&nbsp; ';
	 if($page + 4 <= $total) $page4right = ' &nbsp;<a class="nav" href='.$link.'&page='.($page + 4).'>'.($page + 4).'</a>&nbsp; ';
	 if($page + 3 <= $total) $page3right = ' &nbsp;<a class="nav" href='.$link.'&page='.($page + 3).'>'.($page + 3).'</a>&nbsp; ';
	 if($page + 2 <= $total) $page2right = ' &nbsp;<a class="nav" href='.$link.'&page='.($page + 2).'>'.($page + 2).'</a>&nbsp; ';
	 if($page + 1 <= $total) $page1right = ' &nbsp;<a class="nav" href='.$link.'&page='.($page + 1).'>'.($page + 1).'</a>&nbsp; ';
	  $skybasetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_cat`='{$cat_id}' 
									 ORDER BY `tov_id` DESC LIMIT $start, $num",$db) or die(mysql_error());
				if (mysql_num_rows($skybasetov) > 0)
				{
					$skyrowtov = mysql_fetch_array($skybasetov);
					if ($total > 1) { if ($page==1) {$startol=1; } if ($page==2) {$startol=$num+1; } 
					if ($page>=3) {$startol=$num*($page-1)+1; } } else {$startol=1;}
				$gor=0;
				echo '<table cellspacing="0" cellpadding="0" style="margin:0 0 15px 0; border:1px solid #f2f2f2;"><tr>';
					do { 
						if ($gor >= 3) { echo "<tr>"; }
						if ($cv == 1) { $bgzapis = "#ffffff"; $cv=0; } else { $bgzapis = "#f5f5f5"; $cv++; }
						if (!empty($skyrowtov['tov_foto'])) { 
					$img = '<a href="adm.php?mod=cat&cat_id='.$cat_id.'&act=redtov&tov_id='.$skyrowtov['tov_id'].'&page='.$page.'">
					<img align="center" style="margin:10px 0 10px 0;" 
					src="pic/tov/sm_'.$skyrowtov['tov_foto'].'" border="0" /><br /></a>';  }
						else { $img="<br /><br /><br /><br />"; }
					if (!empty($skyrowtov['tov_starcena'])) { 
					$tov_starcena = '<p><s>Старая цена: '.$skyrowtov['tov_starcena'].' '.$cat_val.'</s></p>';  }
						else { $tov_starcena=""; }
							if (!empty($skyrowtov['tov_cena'])) { 
					$tov_cena = '<p class="zag2" style="margin:0 0 0 0;">Цена: '.$skyrowtov['tov_cena'].' '.$cat_val.'</p>';  }
						else { $tov_cena=""; }	
						$tov_nazv = $skyrowtov['tov_nazv'];
						if (strlen($tov_nazv) > 40) { $tov_nazv = substr("$tov_nazv", 0, 40); $tov_nazv = $tov_nazv."..."; }
		echo '<td>';				
		echo'<table class="tbl" width="190" height="270" bgcolor="'.$bgzapis.'" align="left" style="position:relative; margin:5px 7px 5px 7px; padding:0;" cellpadding="0" cellspacing="0"><tr><td valign="top" align="center" style="margin:0; padding:0;">';
						echo '<form action="adm.php" method="post">';
						  echo '<input align="right" title="удалить товар" style="background:none; border:0; padding:1px 1px 1px 10px; cursor:pointer; margin:0; color:#000;" type="image"  src="pic/del.png" width="15" border="0" value="Удалить" onclick="if(confirm(\'Действительно удалить товар?\n(изображение и информация будут удалены)\'))submit();else return false;">';
						  echo '<INPUT type="hidden" name="tov_id" value="'.$skyrowtov['tov_id'].'" />
						  <INPUT type="hidden" name="cat_id" value="'.$cat_id.'" />
						  <INPUT type="hidden" name="act" value="udtov" />
						  <INPUT type="hidden" name="mod" value="cat" /></form>';
		echo ''.$img.'<p style="word-wrap: break-word; margin:0; padding:0;"><a href="adm.php?mod=cat&cat_id='.$cat_id.'&act=redtov&tov_id='.$skyrowtov['tov_id'].'&page='.$page.'"><span class="ch">'.$tov_nazv.'</span></a></p><p>'.$tov_starcena.'</p>
		'.$tov_cena.'</td></tr></table>';
		echo '</td>';
					$gor++;
						if ($gor >= 3) { echo '</tr>'; $gor = 0; } 	
					}
					while($skyrowtov = mysql_fetch_array($skybasetov));
					echo '</tr></table>';
					
// Вывод меню если страниц больше одной
if ($total > 1)
{
Error_Reporting(E_ALL & ~E_NOTICE);
echo '<div class="navbar" style="margin:20px 0 0 0;" align="center">';
echo $pervpage.$toch.$page5left.$page4left.$page3left.$page2left.$page1left.'<span class=nav><strong>'.$page.'</strong></span>'.$page1right.$page2right.$page3right.$page4right.$page5right.$toch2.$nextpage;
echo '</div><br />';
}	
				}
				else 
				{	if ($act!='dobtov') 
					{
					echo'<dd><form action="adm.php" method="post"><input name="cat_name" type="text" value="" />
					<input name="act" value="novpodkat" type="hidden" /> 
					<input name="mod" value="cat" type="hidden" /> 
					<input name="cat_id" value="'.$cat_id.'" type="hidden" /> 
					<input style="margin-top:5px;" name="" type="submit" value="добавить подрубрику" /></form></dd>';	
					echo '<br /><br />В данной категории пока нет товаров<br />'; 
					}
				}
			}
echo '</dl>';		
} 			

//изменение модули (разделы)
if ($mod=='mod')
{
$skybase = mysql_query("SELECT * FROM `mod` WHERE `mod_id`='{$mod_id}' LIMIT 1",$db);
$skyrow = mysql_fetch_array($skybase);
if (isset($_GET['rednazv'])) { $redn='<input style="margin-bottom:15px; width:250px;" type="text" name="mod_nazv" value="'.$skyrow['mod_nazv'].'" />'; }
else {
?>
<div class="zag2" style="margin:0 0 5px 0;"><? echo $skyrow['mod_nazv']; ?> <a class="sm2" href="adm.php?mod=mod&mod_id=<? echo $mod_id; ?>&rednazv"> редактировать</a></div>
<? } ?>
<form method="post" action="adm.php">
<? echo $redn; ?>
<textarea id="elm_content" name="mod_text" style="width:590px; height:260px;">
<? echo $skyrow['mod_text']; ?></textarea>
<input type="hidden" name="act" value="redmod" />
<input type="hidden" name="mod" value="mod" />
<input type="hidden" name="mod_id" value="<? echo $skyrow['mod_id']; ?>" />
<center><input style="margin-top:17px" type="submit" class="kn" value="Изменить" /></center>
</form>
<? } 

//настройки
if ($mod=='nas')
	{
	//общие
	if ($act == "rednas")
	{
	if (isset($_POST['user_pass']) && !empty($_POST['user_pass'])) 
	{ $user_pass = globper('user_pass'); 
				function usersol($n=3)
				{	$key = '';
					$pattern = '1234567890abcdefghijklmnopqrstuvwxyz.,*_-=+';
					$counter = strlen($pattern)-1;
					for($i=0; $i<$n; $i++)
					{ $key .= $pattern{rand(0,$counter)}; }
					return $key;
				}
				$user_sol = usersol();
				$newpass = $user_pass;
				$code_pass = md5(md5($newpass) . $user_sol);
				$newpass=",`user_pass`='{$code_pass}',`user_sol`='{$user_sol}'";
				$_SESSION['pass'] = $code_pass;
		}
	else { $newpass=""; }
	$user_email = globper('user_email'); 
	if (empty($user_email)) { al("обязательно введите адрес электронной почты"); }
	else
		{ 
	$skybase = mysql_query("UPDATE `users` SET `user_email`='{$user_email}'".$newpass." WHERE `user_id`='{$_SESSION['ses_user']}'",$db) or die(mysql_error());
		echo '<div class="ok">изменения внесены</div>'; 
		}
	}
	
	
//  редактирование остальных настроек
	if ($act == "rednasvse")
	{
		$skybasenastr = mysql_query("SELECT `nas_par` FROM `nas`",$db) or die(mysql_error());
		$skyrownastr = mysql_fetch_array($skybasenastr);
		do { if (isset ($_POST[$skyrownastr['nas_par']])) { $$skyrownastr['nas_par'] = globper($skyrownastr['nas_par']); } }
		while ($skyrownastr = mysql_fetch_array($skybasenastr));
			$skybasenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `nas`",$db) or die(mysql_error());
			$skyrownastr = mysql_fetch_array($skybasenastr);
			do {
				if (!empty($$skyrownastr['nas_par']))
				{ $skybase = mysql_query("UPDATE `nas` SET `nas_znach`='{$$skyrownastr['nas_par']}'
			WHERE `nas_par`='{$skyrownastr['nas_par']}'",$db) or die(mysql_error()); }
				}
			while ($skyrownastr = mysql_fetch_array($skybasenastr));
			echo '<div class="ok">изменения внесены</div>';
	}	
	
	
	
	
	//каталог
//	if ($act == "rednascat")
//	{
//	$nazv_cat = globper('nazv_cat'); 
//	if (empty($nazv_cat)) { al("Обязательно напишите название каталога"); $oshibka=1; }
//	if (!isset($oshibka))
//		{ 
//	$skybase = mysql_query("UPDATE `nas` SET `nas_znach`='{$nazv_cat}'
//	WHERE `nas_par`='nazv_cat'",$db) or die(mysql_error());
//	echo '<div class="ok">изменения внесены</div>';
//		}
//	}
	echo'<div class="zag2" style="margin:0 0 5px 0;">Настройки</div>';

	$skybase = mysql_query("SELECT `user_email`
	FROM `users` WHERE `user_id`='{$_SESSION['ses_user']}' LIMIT 1",$db) or die(mysql_error());
	$skyrow = mysql_fetch_array($skybase); ?>
    
<fieldset class="nas">
<legend class="ser">Общие настройки</legend>    
<form action="adm.php" method="post">
<table border="0" width="870" class="tbl" cellpadding="4" cellspacing="0">
<tr><td width="150">E-mail для входа<br />
<span class="sm2">он же системный</span></td><td><input  class="validate[required,length[0,200]] text-input" style="width:500px" name="user_email" value="<? echo $skyrow['user_email'] ?>" type="text" /></td><td width="100"></td></tr>
<tr><td>Пароль<br />
<span class="sm2">можете ввести и поменять</span></td><td><input style="width:500px" name="user_pass" type="text" /></td><td width="100">
<input type="hidden" name="mod" value="nas" />
<input type="hidden" name="act" value="rednas" />
<input style="width:100px; cursor:pointer;" type="submit" value="Изменить" /></td></tr>
</table></form>
</fieldset>

<?    //настройки
 $skybasenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `nas`",$db) or die(mysql_error());
 $skyrownastr = mysql_fetch_array($skybasenastr);
 do {
	 $$skyrownastr['nas_par'] = $skyrownastr['nas_znach'];
	 }
while ($skyrownastr = mysql_fetch_array($skybasenastr));	
if ($cat_price!=1) { $sel ='selected="selected"'; } else { $sel =''; }
?>



<fieldset class="nas">
<legend class="ser">Каталог продукции</legend>
<form action="adm.php" method="post">
<table border="0" width="870" class="tbl" cellpadding="4" cellspacing="0">

<tr><td width="150">Название каталога<br />
<span class="sm2">Выводится в титлах и т.д.</span></td><td>
<input class="validate[required,length[0,200]] text-input" style="width:500px" name="nazv_cat" value="<? echo $nazv_cat; ?>" type="text" /></td><td width="100">
</td></tr>

<tr><td width="150">Прайс<br />
<span class="sm2">можно скрыть раздел</span></td><td>
<select style="width:506px" name="cat_price">
<option value="1">Виден</option>
<option value="null"  <? echo $sel; ?>>Скрыт</option>
</select>
</td><td width="100">

</td></tr>

<tr><td width="150">Денежная единица<br />
<span class="sm2">Будет прикреплена к цене</span></td><td>
<input class="validate[required,length[0,10]] text-input" style="width:500px" name="cat_val" value="<? echo $cat_val; ?>" type="text" />
</td><td width="100">
<input type="hidden" name="mod" value="nas" />
<input type="hidden" name="act" value="rednasvse" /> 
<input style="width:100px; cursor:pointer;" name="" type="submit" value="Изменить" />
</td></tr>

</table>
</form>
</fieldset>


<fieldset class="nas">
<legend class="ser"> Комментарии </legend>
<form action="adm.php" method="post">
<table border="0" width="100%" class="tbl" cellpadding="4" cellspacing="0">

<tr><td width="150">Ширина комментария<br /><span class="sm2">начальная в пикселях</span></td><td>
<input  class="validate[required,length[0,5]] text-input" style="width:500px" onkeyup="return tolkoCif(this);" onchange="return tolkoCif(this);" name="com_width" value="<? echo $com_width; ?>" type="text" /></td><td width="100">
</td></tr>

<tr><td width="150">Максимальная длина<br /><span class="sm2">количество символов</span></td><td>
<input  class="validate[required,length[0,7]] text-input" style="width:500px" onkeyup="return tolkoCif(this);" onchange="return tolkoCif(this);" name="com_dlina" value="<? echo $com_dlina; ?>" type="text" /></td><td width="100">
</td></tr>

<tr><td width="150">Комментариев на стр<br /><span class="sm2">основных (1-го уровня)</span></td><td>
<input  class="validate[required,length[0,3]] text-input" style="width:500px" onkeyup="return tolkoCif(this);" onchange="return tolkoCif(this);" name="com_str" value="<? echo $com_str; ?>" type="text" /></td><td width="100">
<input type="hidden" name="mod" value="nas" />
<input type="hidden" name="act" value="rednasvse" /> 
<input style="width:100px; cursor:pointer;" name="" type="submit" value="Изменить" />
</td></tr>

</table></form>
</fieldset> 


<? } ?>

<!-- Завершение Рабочий блок -->   
    </td>
  </tr>
</table>
<!-- Завершение Основной таблицы -->

<? } else { ?>
<center>
<? if(isset($oshibka)) { echo '<center><div class="alert">'.$oshibka.'</div></center>'; } ?>
<div>
<form action="adm.php" method="post">
	<table border="0" style="margin-left:15px; margin:20px 0 50px 0;" cellpadding="4">
		<tr>
			<td align="right" width="100" class="text">Логин (e-mail)</td>
			<td height="35" style="padding-left:15px;">
            <input class="validate[required,length[0,200]] text-input" title="Введите логин" name="user_email" type="text" size="23" /></td>
		</tr>
		<tr>
			<td align="right" class="text">Пароль</td>
			<td height="35" style="padding-left:15px;">
            <input class="validate[required,length[0,200]] text-input" name="user_pass" type="password" size="23" />
            </td>
		</tr>
		<tr>
			<td align="right" class="text">Запомнить</td>
			<td height="35" style="padding-left:15px;">
            <input type="checkbox" name="zapomnit" />
            <input type="hidden" name="act" value="login">
            <input class="menuinp" style="width:100px; margin-left:53px; cursor:pointer;" type="submit" value="Войти" />
			</td>
		</tr>
	</table> 
</form>  
<br />
<br />
<br />
</div>
<?
?> 
</center>
<? } ?>


<!-- Низ -->
<? if (isset($al)) { al($al); } ?>
</body>
</html>