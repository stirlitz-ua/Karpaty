<? session_start();

include ("db.php"); 
$mod_id = globper('mod_id');
$cat_id = globper('cat_id');
$tov_id = globper('tov_id');
//выход
if (isset($_GET['logout']))
{	if (isset($_SESSION['ses_user'])) { unset($_SESSION['ses_user']); }
	if (isset($_SESSION['pass'])) { unset($_SESSION['pass']); }
	setcookie('user_id', '', 0, "/");
	setcookie('user_pass', '', 0, "/");
	header('Location: cat.php');
	exit;
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
	$base = mysql_query("SELECT `user_id`,`user_login`,`user_pass`,`user_prava`,`user_email`
	FROM `users` WHERE `user_pass`='{$pass}' AND `user_id`='{$ses_user}' LIMIT 1",$db) or die(mysql_error());
		if (mysql_num_rows($base) == 1)
		{
			$row = mysql_fetch_array($base);
			$prava = $row['user_prava'];
			$name =  $row['user_login'];
			$user_email = $row['user_email'];
		}
		else { 
			$prava = 0;
			if (isset($_SESSION['ses_user'])) { unset($_SESSION['ses_user']); }
			if (isset($_SESSION['pass'])) { unset($_SESSION['pass']); }
			setcookie('user_id', '', 0, "/");
			setcookie('user_pass', '', 0, "/");
			header('Location: cat.php');
			exit(); }
	}

//путь по открытым рубрикам
if (isset($cat_id) && !empty($cat_id) && $act != "login")
{
	$cat_idtitl = $cat_id;
	for ($i = 0; ; $i++) 
	{
	$baseput = mysql_query("SELECT `cat_name`,`cat_papa` FROM `cat_cat` WHERE `cat_id`='{$cat_idtitl}'",$db) 
	or die(mysql_error());
			$rowput = mysql_fetch_array($baseput);
			$titl = $rowput['cat_name']." &raquo; ".$titl;
			if ($rowput['cat_papa']==0) { break;}
			$cat_idtitl = $rowput['cat_papa'];
	}	
}
//название товара в титл
if (isset($tov_id))
{
	$basetovtit = mysql_query("SELECT `tov_nazv` FROM `cat_tov` WHERE `tov_id`='{$tov_id}' LIMIT 1",$db) or die(mysql_error());
			$rowtovtit = mysql_fetch_array($basetovtit);
			$titl .= $rowtovtit['tov_nazv'];
}

//категории
if (isset($mod_id))
{
	$basemodtit = mysql_query("SELECT `mod_nazv` FROM `mod` WHERE `mod_id`='{$mod_id}' LIMIT 1",$db) or die(mysql_error());
			$rowmodtit = mysql_fetch_array($basemodtit);
			$titl = $rowmodtit['mod_nazv'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "">
<html xml:lang="ru" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
<title><? echo $nazv_cat; if (isset($titl)) { echo " &raquo; ".$titl; } ?></title>
<link rel="shortcut icon" href="pic/favicon.ico">
<link href="st.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/jquery.fancybox-1.2.1.pack.js"></script>
<script src="scripts/jquery.validationengine.js" type="text/javascript"></script>
<script type="text/javascript" src="scripts/cat.js"></script>
<script type="text/javascript" src="scripts/com.js"></script>
</head>
<body>

<div align="center">

</div>

<table style='margin-top:25px;' align='center' width='884' border='0' cellspacing='0' cellpadding='0'>
<tr>
    <td style='border-bottom:1px solid #cccccc;' valign='middle' align="left" height="37">
<?
	$basemod = mysql_query("SELECT `mod_id`,`mod_nazv` FROM `mod` ORDER BY `mod_id`",$db) or die(mysql_error());
	if (mysql_num_rows($basemod) > 0)
		{
			$rowmod = mysql_fetch_array($basemod);
			do { 
			echo ' <a class="nav" href="cat.php?mod_id='.$rowmod['mod_id'].'" title="'.$rowmod['mod_nazv'].'">'.$rowmod['mod_nazv'].'</a>';
			}
			while ($rowmod = mysql_fetch_array($basemod));
		}
if($cat_price == 1) {
?>  
<a class="nav" href="cat.php?mod=price">Прайс</a>  
<? } ?> 
    </td>
</tr>
</table>


<form action="cat.php" method="post">
<table style='margin-top:17px;' align='center' width='884' border='0' cellspacing='0' cellpadding='0'>
<tr><td>
<input onblur="inputBG(this,0)"  onfocus="inputBG(this,1)" name="poisk" type="text" style="width:550px;" />
<input name="act" type="hidden" value="poisk"/></td><td>
<input style="height:26px; width:60px; cursor:pointer;" type="submit" value="найти" />
</td></tr>
</table>
</form>

<?
if (isset($oshibka)) { echo '<br />'.$oshibka; }
if (isset($ok)) { echo '<br />'.$ok; }
?>

<!-- Основная таблица -->
<table width="884" border="0" cellspacing="3" cellpadding="0" align="center" style="margin-top:15px;">
  <tr>
    <td valign="top" width="260">
<?
$basecat = mysql_query("SELECT `cat_id`,`cat_name`,`cat_pic` FROM `cat_cat` WHERE `cat_papa`='0' ORDER BY `cat_name`",$db) or die(mysql_error());
if (mysql_num_rows($basecat) > 0)
{
	$rowcat = mysql_fetch_array($basecat);
	do { 
	
	if (isset($_COOKIE['Podcat'.$rowcat['cat_id']]))	{ $nev=''; $otkr = 1; $src = 'pic/'.$rowcat['cat_pic'].''; } 
	else { $nev='class="nevid"'; $otkr = 0; $src = 'pic/'.$rowcat['cat_pic'].'';}
	
	echo '<dl class="cat">
	<dt>
	
	<img id="otPodcat'.$rowcat['cat_id'].'" cat="'.$rowcat['cat_id'].'" otkr="'.$otkr.'" title="Открыть подкатегории" src="'.$src.'" style="float:left; margin: 4px 5px 0 0; cursor:pointer;" />

	<a href="cat.php?act=cat&cat_id='.$rowcat['cat_id'].'">'.$rowcat['cat_name'].'</a></dt>';
	
	$basecat1 = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$rowcat['cat_id']}' ORDER BY `cat_name`",$db) or die(mysql_error());
		if (mysql_num_rows($basecat1) > 0)
		{
		
		
		echo '<div id="Podcat'.$rowcat['cat_id'].'" '.$nev.'>';	
		$rowcat1 = mysql_fetch_array($basecat1);
			do { 
				echo '<dd>';
				echo '<a title="'.$rowcat1['cat_name'].'" href="cat.php?act=cat&cat_id='.$rowcat1['cat_id'].'">'.$rowcat1['cat_name'].'</a>';
				echo '</dd>';
				}
			while($rowcat1 = mysql_fetch_array($basecat1));
		echo '</div>';	
		}
		echo '</dl>';
	}
	while($rowcat = mysql_fetch_array($basecat));
}
else { echo "Нет категорий"; }
?>
    </td>
    <td valign="top">
<!-- Рабочий блок -->    
<?
if (!isset($cat_id) && !isset($mod_id) && !isset($mod) && !isset($act)) { $mod_id = 1; }

if (isset($mod_id)) 
	{
	$basemodpr = mysql_query("SELECT `mod_nazv`,`mod_text` FROM `mod` WHERE `mod_id`='{$mod_id}' LIMIT 1",$db) or die(mysql_error());
			$rowmodpr = mysql_fetch_array($basemodpr);
			echo '<div class="zag2" style="margin:0 0 5px 0;">'.$rowmodpr['mod_nazv'].'</div>';
			echo $rowmodpr['mod_text'];
			
			//вывод товаров на 1 страницу
			if ($mod_id==1){
				$basetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_perv`='1' ORDER BY `tov_id` DESC",$db) or die(mysql_error());
				if (mysql_num_rows($basetov) > 0)
				{
				$rowtov = mysql_fetch_array($basetov);
				$gor=0;
				echo '<table cellspacing="0" cellpadding="0" style="margin:0 0 15px 0; border:1px solid #f2f2f2;"><tr>';
					do { 
						if ($gor >= 3) { echo "<tr>"; }
						if ($cv == 1) { $bgzapis = "#ffffff"; $cv=0; } else { $bgzapis = "#f5f5f5"; $cv++; }
						if (!empty($rowtov['tov_foto'])) { 
						$img = '<a href="cat.php?mod=cat&cat_id='.$rowtov['tov_cat'].'&tov_id='.$rowtov['tov_id'].'"><img align="center" style="margin:10px 0 10px 0;" src="pic/tov/sm_'.$rowtov['tov_foto'].'" border="0" /><br /></a>';  }
						else { $img="<br /><br /><br /><br />"; }
						if (!empty($rowtov['tov_starcena'])) { 
						$tov_starcena = '<p><s>Старая цена: '.$rowtov['tov_starcena'].' '.$cat_val.'</s></p>';  }
						else { $tov_starcena=""; }
						if (!empty($rowtov['tov_cena'])) { 
						$tov_cena = '<p class="zag2" style="margin:0 0 0 0;">Цена: '.$rowtov['tov_cena'].' '.$cat_val.'</p>';  }
						else { $tov_cena=""; }						
						$tov_nazv = $rowtov['tov_nazv'];
						if (strlen($tov_nazv) > 40) { $tov_nazv = substr("$tov_nazv", 0, 40); $tov_nazv = $tov_nazv."..."; }
						echo '<td>';	
						echo'<table class="tbl" width="190" height="270" bgcolor="'.$bgzapis.'" style="position:relative; margin:5px 7px 5px 7px; padding:0;" cellpadding="0" cellspacing="0"><tr><td valign="top" align="center" style="margin:0; padding:0;">'.$img.'<p style="word-wrap: break-word; margin:0; padding:0;"><a href="cat.php?mod=cat&cat_id='.$cat_id.'&tov_id='.$rowtov['tov_id'].'"><span class="ch">'.$tov_nazv.'</span></a></p><p>'.$tov_starcena.'</p>
						'.$tov_cena.'</td></tr></table>';	
						echo '</td>';				
						$gor++;
						if ($gor >= 3) { echo '</tr>'; $gor = 0; } 
					}
					while($rowtov = mysql_fetch_array($basetov));
				echo '</tr></table>';		
				}
			}
	}
//путь по открытым рубрикам
//категории	
if (isset($cat_id)) 
	{
		$cat_idput = $cat_id;
		for ($i = 0; ; $i++) 
		{
		$baseput = mysql_query("SELECT `cat_id`,`cat_name`,`cat_papa` FROM `cat_cat` WHERE `cat_id`='{$cat_idput}'",$db) 
		or die(mysql_error());
				$rowput = mysql_fetch_array($baseput);
				$catput = "<a class='ch' href='cat.php?act=cat&cat_id=".$rowput['cat_id']."'>
				".$rowput['cat_name']."</a> <span class='kr'>&raquo;</span> ".$catput;
				if ($rowput['cat_papa']==0) { break;}
				$cat_idput = $rowput['cat_papa'];
		}	
				$catput = "<a class='ch' title='к рубрикам' href='cat.php'>Главная</a> 
				<span class='kr'>&raquo;</span> ".$catput."";
				$catsey = $rowput['cat_name'];
		echo '<div style="background-color:#f5f5f5; padding:10px; margin:0 0 10px 0;">';
      	echo $catput; 
		echo '</div>';

	//вывод товара крупно
	if (isset($tov_id))
	{
		$basetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_id`='{$tov_id}' LIMIT 1",$db) or die(mysql_error());
		$rowtov = mysql_fetch_array($basetov);
		if (!empty($rowtov['tov_foto'])) { $tov_foto = '<td valign="top" width="1">
		<a class="gallery" rel="group" href="pic/tov/'.$rowtov['tov_foto'].'">
		<img style="margin:0 10px 3px 0;" src="pic/tov/sm_'.$rowtov['tov_foto'].'"></a></td>'; } 
		else { $tov_foto = '<td></td>'; }
		$tov_nazv = $rowtov['tov_nazv'];
		$tov_opis = $rowtov['tov_opis'];
		$tov_artic = $rowtov['tov_artic'];
		$tov_cena = $rowtov['tov_cena'];
		$tov_starcena = $rowtov['tov_starcena'];
		$tov_opis = $rowtov['tov_opis'];
		$tov_perv = $rowtov['tov_perv'];
		$tov_kolvo = $rowtov['tov_kolvo'];
		if (!empty($tov_artic)) { $tov_artic = '<p>Артикул: '.$tov_artic.'</p>'; }
		if (!empty($tov_starcena)) { $tov_starcena = '<p><s>Старая цена: '.$tov_starcena.' '.$cat_val.'</s></p>'; }
		if (!empty($tov_cena)) { $tov_cena = '<p class="zag2" style="margin-bottom:0;">Цена: '.$tov_cena.' '.$cat_val.'</p>'; }
		if (!empty($tov_kolvo)) { $tov_kolvo = '<p class="sm">Количество: '.$tov_kolvo.'</p>'; } else { $tov_kolvo =''; }
		echo '<table border="0" style="margin:0 0 20px 0;"><tr>'.$tov_foto.'';
		echo '<td valign="top"><h4>'.$tov_nazv.'</h4>'.$tov_artic.$tov_starcena.$tov_cena.$tov_kolvo.'</td></tr>';
		
		$basefoto = mysql_query("SELECT * FROM `foto` WHERE `foto_kmestu`='{$tov_id}' ORDER BY `foto_id`",$db);
	if (mysql_num_rows($basefoto) > 0)
		{
		echo '<tr><td colspan="2">';
		$rowfoto = mysql_fetch_array($basefoto);
			do { 
			echo '<table align="left" border="0"><tr><td>
			<a class="gallery" rel="group" title="'.$rowfoto['foto_tit'].'" href="pic/tov/'.$rowfoto['foto_file'].'">
			<img style="margin-right:5px;" height="40" src="pic/tov/sm_'.$rowfoto['foto_file'].'"></a></td></tr></table>';
			}
			while ($rowfoto = mysql_fetch_array($basefoto));
		echo '</td></tr>';
		}
		
		echo '<tr><td colspan="2">'.$tov_opis.'</td></tr>';
		echo '</table>';
		if ($rowtov['tov_com']==1) {	$com='c'.$rowtov['tov_id']; include("com.php"); echo '<br /><br />';}
	}	
	else {
$basecat = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$cat_id}' ORDER BY `cat_name`",$db)
or die(mysql_error());
		if (mysql_num_rows($basecat) > 0)
		{
			$rowcat = mysql_fetch_array($basecat);
			echo '<dl class="cat" style="width:450px;">';
			do { 
				//подсчет кол-ва позиций в рубрике
				$basekol = mysql_query("SELECT `cat_id` FROM `cat_cat` 
				WHERE `cat_papa`='{$rowcat['cat_id']}'",$db) or die(mysql_error());
				if (mysql_num_rows($basekol) > 0)
				{
					$rowkol = mysql_fetch_array($basekol);
					do {
				$basekolvo = mysql_query("SELECT `tov_id` FROM `cat_tov` 
				WHERE `tov_cat`='{$rowkol['cat_id']}'",$db) or die(mysql_error());
				$kolvotov = $kolvotov + mysql_num_rows($basekolvo);
					}
					while ($rowkol = mysql_fetch_array($basekol));
					if ($kolvotov>0) {$kolvotov="(".$kolvotov.")";} else {$kolvotov="";}
				}
				else 
				{
				$basekolvo = mysql_query("SELECT `tov_id` FROM `cat_tov` 
				WHERE `tov_cat`='{$rowcat['cat_id']}'",$db) or die(mysql_error());
				$kolvotov = mysql_num_rows($basekolvo);
				if ($kolvotov>0) {$kolvotov="(".$kolvotov.")";} else {$kolvotov="";}
				}
				echo '<dd><a href="cat.php?act=cat&cat_id='.$rowcat['cat_id'].'" 
					title="'.$rowcat['cat_name'].'">'.$rowcat['cat_name'].'</a>
					<span style="margin-left:3px;" class="sm2">'.$kolvotov.'</span></dd>';				
					$kolvotov = '';
			}
			while($rowcat = mysql_fetch_array($basecat));
			echo '</dl>';
		}
		else { 
			$basecatname = mysql_query("SELECT `cat_name` FROM `cat_cat` WHERE `cat_id`='{$cat_id}'",$db) or die(mysql_error());
			$rowcatname = mysql_fetch_array($basecatname);
	echo '<p class="zag2" style="margin:15px 0 0 0; font-size:140%; font-weight:bold;">';
			echo $rowcatname['cat_name'].':</p>';
			
// вывод товаров
$num = 12;
$link .= 'cat.php?act=cat&cat_id='.$cat_id.'';
if (isset($_GET['page'])) {$page = $_GET['page']; }
if (isset($_POST['page'])) {$page = $_POST['page']; }
$base1 = mysql_query("SELECT COUNT(*) FROM `cat_tov` WHERE `tov_cat`='{$cat_id}'");
$temp = mysql_fetch_array($base1);
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
$basetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_cat`='{$cat_id}' ORDER BY `tov_id` DESC LIMIT $start, $num",$db) or die(mysql_error());
				if (mysql_num_rows($basetov) > 0)
				{
					$rowtov = mysql_fetch_array($basetov);
					if ($total > 1) { if ($page==1) {$startol=1; } if ($page==2) {$startol=$num+1; } 
					if ($page>=3) {$startol=$num*($page-1)+1; } } else {$startol=1;}
				$gor=0;
				echo '<table cellspacing="0" cellpadding="0" style="margin:0 0 15px 0; border:1px solid #f2f2f2;"><tr>';
					do { 
						if ($gor >= 3) { echo "<tr>"; }
						if ($cv == 1) { $bgzapis = "#ffffff"; $cv=0; } else { $bgzapis = "#f5f5f5"; $cv++; }
						if (!empty($rowtov['tov_foto'])) { 
						$img = '<a href="cat.php?mod=cat&cat_id='.$cat_id.'&tov_id='.$rowtov['tov_id'].'"><img align="center" style="margin:10px 0 10px 0;" src="pic/tov/sm_'.$rowtov['tov_foto'].'" border="0" /><br /></a>';  }
						else { $img="<br /><br /><br /><br />"; }
						if (!empty($rowtov['tov_starcena'])) { 
						$tov_starcena = '<p><s>Старая цена: '.$rowtov['tov_starcena'].' '.$cat_val.'</s></p>';  }
						else { $tov_starcena=""; }
						if (!empty($rowtov['tov_cena'])) { 
						$tov_cena = '<p class="zag2" style="margin:0 0 0 0;">Цена: '.$rowtov['tov_cena'].' '.$cat_val.'</p>';  }
						else { $tov_cena=""; }						
						$tov_nazv = $rowtov['tov_nazv'];
						if (strlen($tov_nazv) > 40) { $tov_nazv = substr("$tov_nazv", 0, 40); $tov_nazv = $tov_nazv."..."; }
						echo '<td>';	
						echo'<table class="tbl" width="190" height="270" bgcolor="'.$bgzapis.'" style="position:relative; margin:5px 7px 5px 7px; padding:0;" cellpadding="0" cellspacing="0"><tr><td valign="top" align="center" style="margin:0; padding:0;">'.$img.'<p style="word-wrap: break-word; margin:0; padding:0;"><a href="cat.php?mod=cat&cat_id='.$cat_id.'&tov_id='.$rowtov['tov_id'].'"><span class="ch">'.$tov_nazv.'</span></a></p><p>'.$tov_starcena.'</p>
						'.$tov_cena.'</td></tr></table>';	
						echo '</td>';				
						$gor++;
						if ($gor >= 3) { echo '</tr>'; $gor = 0; } 
					}
					while($rowtov = mysql_fetch_array($basetov));
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
				{
				echo "<br />В данной категории пока нет товаров<br /><br /><br /><br />"; 	
				}
			}
	}
?>
</div>
<!-- /page -->	
<? }	

//результаты поиска
if ($act=="poisk")
{
$poisk = globper('poisk');
$num = 10;
$link .= 'cat.php?act=poisk&poisk='.$poisk.'';
if (isset($_GET['page'])) {$page = $_GET['page']; }
if (isset($_POST['page'])) {$page = $_POST['page']; }
$base1 = mysql_query("SELECT COUNT(*) FROM `cat_tov` WHERE `tov_nazv` LIKE '%$poisk%' OR `tov_opis` LIKE '%$poisk%'");
$temp = mysql_fetch_array($base1);
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
$baseob = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_nazv` LIKE '%$poisk%' OR `tov_opis` LIKE '%$poisk%' LIMIT $start, $num",$db) or die(mysql_error()); 
if (empty($poisk)) { echo '<p class="alert">Обязательно введите ключевое слово для поиска</p>';}
else {
			echo '<div style="background-color:#f5f5f5; padding:10px; margin:0 0 10px 0;">';
			echo 'Найдено товаров: <strong>'.$posts.'</strong> по запросу: <strong>'.$poisk.'</strong>'; 
			echo '</div>';
				if (mysql_num_rows($baseob) > 0)
				{
					$rowob = mysql_fetch_array($baseob);
					if ($total > 1) { if ($page==1) {$startol=1; } if ($page==2) {$startol=$num+1; } 
					if ($page>=3) {$startol=$num*($page-1)+1; } } else {$startol=1;}
					echo '<ol class="results" START="'.$startol.'">';
					do { 
						if (!empty($rowob['tov_foto'])) { 
				$img = '<td valign="top" style="margin:0; padding:0;"><img width="40px" align="left" style="margin:5px 10px 0 0;" 
					src="pic/tov/sm_'.$rowob['tov_foto'].'" border="0" /></td>'; }
						else { $img="";  }
						$tov_nazv = $rowob['tov_nazv'];
						if (strlen($tov_nazv) > 245) { $tov_nazv = substr("$ob_text", 0, 245); $tov_nazv = $tov_nazv."..."; }
						$rowob['tov_opis'] = strip_tags($rowob['tov_opis']);
						$tov_opis = $rowob['tov_opis'];
						if (strlen($tov_opis) > 245) { $tov_opis = substr("$tov_opis", 0, 245); $tov_opis = $tov_opis."..."; }
		  	$kuda = mysql_query("SELECT `cat_name` FROM `cat_cat` 
			WHERE `cat_id`='{$rowob['tov_cat']}' LIMIT 1",$db) or die(mysql_error());
			$kuda = mysql_fetch_array($kuda);
		echo '<li class="cat" style="border-bottom:1px solid #f2f2f2; margin:10px 0 15px 0;"><h4>';
        echo '<a title="" href="cat.php?mod=cat&cat_id='.$rowob['tov_cat'].'&tov_id='.$rowob['tov_id'].'">'.$rowob['tov_nazv'].'</a></h4><div class="sm4" style="margin:0; padding:0;">Рубрика: <a href="cat.php?cat_id='.$rowob['tov_cat'].'"><span class="sm4">'.$kuda['cat_name'].'</span></a></div><table border="0" style="margin:0; padding:0;" cellpadding="0" cellspacing="0"><tr>'.$img.'<td valign="top" style="margin:0; padding:4px 0 10px 0;"><p style="margin:0; width:525px; padding:0; word-wrap: break-word;">'.$tov_opis.'</p></td></tr></table></li>';
					}
					while($rowob = mysql_fetch_array($baseob));
					echo '</ol>';	
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
				{
				echo ""; 	
				}
	}
} 

//  Прайс
if ($mod=='price')
{
echo '<div align="left" style="margin:0 0 0 0; border-bottom:2px solid #f2f2f2; padding:0px 0px 16px 0px; width:615px; background-color:#FFF;">';
echo '<div class="zag2" style="border:0px solid #000;">Прайс-лист <div style="float:right; width:150px; border:0px solid #000;" align="right"><a href="price.xls"><span class="ser">скачать <img style="display:inherit;" src="pic/excel.png" alt="" width="20"/></span></a></div></div>';	
echo '<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tbl">';	
echo '<tr height="15"><td align="center" class="sm2">наименование</td><td align="center" class="sm2">артикул</td><td align="center" class="sm2">цена ('.$cat_val.')</td><td align="center" class="sm2">количество</td></tr>';	
include("scripts/excelwriter.inc.php");
$excel=new ExcelWriter("price.xls");
if($excel==false)
echo $excel->error;
$myArr=array($nazv_cat,"","","");
$excel->writeLine($myArr);
$myArr=array("","","","");
$excel->writeLine($myArr);
$myArr=array("наименование","артикул","цена(".$cat_val.")","количество");
$excel->writeLine($myArr);
$myArr=array("","","","");
$excel->writeLine($myArr);

//1 уровень	
$basecat = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$cat_id}' ORDER BY `cat_name`",$db) or die(mysql_error());
	if (mysql_num_rows($basecat) > 0)
	{
	$rowcat = mysql_fetch_array($basecat);
	do { 
		echo '<tr bgcolor="#fde9f1" height="25"><td colspan="4" style="padding-left:5px;"><a href="cat.php?mod=cat&cat_id='.$rowcat['cat_id'].'" 
		title="'.$rowcat['cat_name'].'"><strong>'.$rowcat['cat_name'].'</strong></a></td></tr>';
		$myArr=array($rowcat['cat_name']);
   		$excel->writeLine($myArr);
		//2 уровень		
		$basecat1 = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$rowcat['cat_id']}' ORDER BY `cat_name`",$db) or die(mysql_error());
		if (mysql_num_rows($basecat1) > 0)
			{
			$rowcat1 = mysql_fetch_array($basecat1);
			do { 
				echo '<tr><td colspan="4" height="25" style="padding-left:12px; background:url(pic/bg_podcat.png) 0px 7px no-repeat"><a title="'.$rowcat1['cat_name'].'" href="cat.php?mod=cat&cat_id='.$rowcat1['cat_id'].'"><strong style="color:#555555;">'.$rowcat1['cat_name'].'</strong></a></td></tr>';
				$myArr=array($rowcat1['cat_name']);
   				$excel->writeLine($myArr);
				//3 уровень	
				$basecat3 = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$rowcat1['cat_id']}' ORDER BY `cat_name`",$db) or die(mysql_error());
				if (mysql_num_rows($basecat3) > 0)
					{
					$rowcat3 = mysql_fetch_array($basecat3);
					do { 
						echo '<tr><td colspan="4" height="25" style="padding-left:23px; background:url(pic/bg_podcat.png) 10px 7px no-repeat"><a title="'.$rowcat3['cat_name'].'" href="cat.php?mod=cat&cat_id='.$rowcat3['cat_id'].'"><span style="color:#777777;"><strong>'.$rowcat3['cat_name'].'</strong></span></a></td></tr>';
						$myArr=array($rowcat3['cat_name']);
   						$excel->writeLine($myArr);
						//4 уровень	
				$basecat4 = mysql_query("SELECT `cat_id`,`cat_name` FROM `cat_cat` WHERE `cat_papa`='{$rowcat3['cat_id']}' ORDER BY `cat_name`",$db) or die(mysql_error());
				if (mysql_num_rows($basecat4) > 0)
					{
//					$rowcat4 = mysql_fetch_array($basecat4);
//					do { 
//						echo '<tr><td colspan="4" height="25" style="padding-left:33px; background:url(pic/bg_podcat.png) 20px 7px no-repeat"><a title="'.$rowcat4['cat_name'].'" href="cat.php?mod=cat&cat_id='.$rowcat4['cat_id'].'"><span style="color:#333333;">'.$rowcat4['cat_name'].'</span></a></td></tr>';
//						$myArr=array($rowcat4['cat_name']);
//   						$excel->writeLine($myArr);
//						}
//					while($rowcat4 = mysql_fetch_array($basecat4));
					}
				else 
					{
					$basetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_cat`='{$rowcat3['cat_id']}' 			 ORDER BY `tov_id` DESC",$db) or die(mysql_error());
						if (mysql_num_rows($basetov) > 0)
						{
							$rowtov = mysql_fetch_array($basetov);
							do { 
							if ($cv == 1) { $bgzapis = "#fff"; $cv=0; } else { $bgzapis = "#fef3f7"; $cv++; }
								$tov_nazv = $rowtov['tov_nazv'];
								if (strlen($tov_nazv) > 50) { $tov_nazv = substr("$tov_nazv", 0, 50); $tov_nazv = $tov_nazv."..."; }
				echo '<tr height="25" bgcolor="'.$bgzapis.'">';	
				echo'<td style="padding-left:23px;"><a href="cat.php?mod=cat&cat_id='.$cat_id.'&act=redtov&tov_id='.$rowtov['tov_id'].'"><span style="color:#333333;">'.$tov_nazv.'</span></a></td><td align="center">'.$rowtov['tov_artic'].'</td><td align="center">'.$rowtov['tov_cena'].'</td><td align="center">'.$rowtov['tov_kolvo'].'</td>';	
				echo '</tr>';	
					$myArr=array($rowtov['tov_nazv'],$rowtov['tov_artic'],$rowtov['tov_cena'],$rowtov['tov_kolvo']);
					$excel->writeLine($myArr);			
							}
							while($rowtov = mysql_fetch_array($basetov));
						}
					}

						}
					while($rowcat3 = mysql_fetch_array($basecat3));
					}
				else 
					{
					$basetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_cat`='{$rowcat1['cat_id']}' 			 ORDER BY `tov_id` DESC",$db) or die(mysql_error());
						if (mysql_num_rows($basetov) > 0)
						{
							$rowtov = mysql_fetch_array($basetov);
							do { 
							if ($cv == 1) { $bgzapis = "#fff"; $cv=0; } else { $bgzapis = "#fef3f7"; $cv++; }
								$tov_nazv = $rowtov['tov_nazv'];
								if (strlen($tov_nazv) > 50) { $tov_nazv = substr("$tov_nazv", 0, 50); $tov_nazv = $tov_nazv."..."; }
				echo '<tr height="25" bgcolor="'.$bgzapis.'">';	
				echo'<td style="padding-left:12px;"><a href="cat.php?mod=cat&cat_id='.$cat_id.'&act=redtov&tov_id='.$rowtov['tov_id'].'"><span style="color:#333333;">'.$tov_nazv.'</span></a></td><td align="center">'.$rowtov['tov_artic'].'</td><td align="center">'.$rowtov['tov_cena'].'</td><td align="center">'.$rowtov['tov_kolvo'].'</td>';	
				echo '</tr>';	
					$myArr=array($rowtov['tov_nazv'],$rowtov['tov_artic'],$rowtov['tov_cena'],$rowtov['tov_kolvo']);
					$excel->writeLine($myArr);			
							}
							while($rowtov = mysql_fetch_array($basetov));
						}
					}
					//завершение 3 уровня
				}
				while($rowcat1 = mysql_fetch_array($basecat1));
			}
		else 
			{
			$basetov = mysql_query("SELECT * FROM `cat_tov` WHERE `tov_cat`='{$rowcat['cat_id']}' 						 ORDER BY `tov_id` DESC",$db) or die(mysql_error());
			if (mysql_num_rows($basetov) > 0)
				{
				$rowtov = mysql_fetch_array($basetov);
				do { 
					if ($cv == 1) { $bgzapis = "#fff"; $cv=0; } else { $bgzapis = "#fef3f7"; $cv++; }
					$tov_nazv = $rowtov['tov_nazv'];
					if (strlen($tov_nazv) > 50) { $tov_nazv = substr("$tov_nazv", 0, 50); $tov_nazv = $tov_nazv."..."; }
		echo '<tr height="25" bgcolor="'.$bgzapis.'">';	
		echo'<td style="padding-left:12px;"><a href="cat.php?mod=cat&cat_id='.$cat_id.'&act=redtov&tov_id='.$rowtov['tov_id'].'"><span style="color:#333333;">'.$tov_nazv.'</span></a></td><td align="center">'.$rowtov['tov_artic'].'</td><td align="center">'.$rowtov['tov_cena'].'</td><td align="center">'.$rowtov['tov_kolvo'].'</td>';	
		echo '</tr>';				
		    $myArr=array($rowtov['tov_nazv'],$rowtov['tov_artic'],$rowtov['tov_cena'],$rowtov['tov_kolvo']);
  			$excel->writeLine($myArr);
					}
					while($rowtov = mysql_fetch_array($basetov));
				}
			}

				
		}
		while($rowcat = mysql_fetch_array($basecat));		
	}

echo '</table>';	
$excel->close();		
echo '</div>';
} ?>	

 
    </td>
  </tr>
</table>


</body>
</html>