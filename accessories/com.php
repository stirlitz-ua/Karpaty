<?

$prava=0;
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
	{	$row = mysql_fetch_array($base);
		$prava = $row['user_prava'];
		$name =  $row['user_login'];
		$user_email = $row['user_email'];
	}
	else 
	{ 	$prava = 0;
		if (isset($_SESSION['ses_user'])) { unset($_SESSION['ses_user']); }
		if (isset($_SESSION['pass'])) { unset($_SESSION['pass']); }
		setcookie('user_id', '', 0, "/");
		setcookie('user_pass', '', 0, "/");
		header('Location: index.php');
		exit(); 
	}
}
//удалить комментарий
if ($acom=="udcom" && $prava==5) 
{$al='Демоверсия. Изменения невозможны.';/*	
$com_id = globper('com_id');
$base = mysql_query("UPDATE `com` SET `com_kto`='',`com_email`='',`com_text`='' WHERE `com_id`='{$com_id}'",$db) or die(mysql_error());
*/}
//редактировать комментарий
if ($acom=="redcom" && $prava==5) 
{$al='Демоверсия. Изменения невозможны.';/*	$com_id = globper('com_id');
	$com_text = globper('com_text');
$base = mysql_query("UPDATE `com` SET `com_text`='{$com_text}' WHERE `com_id`='{$com_id}'",$db) or die(mysql_error());
*/}

if (isset($oshibka)) { echo '<br />'.$oshibka; }
if (isset($ok)) { echo '<br />'.$ok; }
//подсчет комментариев
$base = mysql_query("SELECT COUNT(*) FROM `com` WHERE `com_kgol`='{$com}'",$db);
$row = mysql_fetch_array($base);
$posts = $row[0]; //в переменной $posts храниться количество комментариев в теме $com  
?>
<table width="<? echo $com_width; ?>" border="0" bgcolor="#fbfbfb" style="border-bottom:1px solid #999999;" >
<tr><td height="30">
<?
if (!empty($posts)) { echo 'Комментариев: '.$posts; } else { echo 'Комментариев пока нет'; }
?>

</td><td align="right">
<a name="nach" id="ncom"></a> <a style="cursor:pointer;" onClick="showlayer('komm')">Добавить комментарий</a>
<? if($prava==5) { echo ' | <a href="?logout">выход</a>'; } ?>
</td></tr></table>
<?
if (isset($_COOKIE['com_kto']))	{ $com_kto = $_COOKIE['com_kto']; }
if (isset($_COOKIE['com_email'])) {	$com_email = $_COOKIE['com_email'];	}
echo '<div id="komm" style="display:none; padding:10px; background-color:#fbfbfb; width:'.($com_width-20).'px;" align="left">
<form action="http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'" method="post" name="Send">';
if (!empty($com_kto)) { echo '<span style="cursor:pointer;" title="изменить имя/e-mail" id="redname" class="zag">'.$com_kto.'</span>'; $nev=' class="nevid"'; }
else {$nev='';}
echo '<div id="nname"'.$nev.'><input class="validate[required,length[0,100]] text-input" type="text" style="width:210px;" value="'.@$com_kto.'" name="com_kto"> — Имя <input class="validate[custom[email]] text-input" value="'.@$com_email.'" type="text" style="width:210px; margin-left:50px;" name="com_email"> — Почта</div>';
echo '<textarea class="validate[required,length[0,'.$com_dlina.']] text-input" onchange="ChooseLen()" onkeyup="ChooseLen()" onkeydown="ChooseLen()" onkeypress="ChooseLen()" name="com_text" style="width:100%; height:80px; margin:9px 0 9px 0; padding:3px;"></textarea>
<input type="hidden" name="nopage" value="1">
<input type="hidden" name="com" value="'.$com.'">
<input type="hidden" name="acom" value="dobcom">
<input type="submit" value="Комментировать">
<input size="4" value="0" name="Count" type="text" style="background:none; border:none; text-align:right; margin: 0 7px 0 210px"> символов набрано
</form>
</div>';
$com_papa=0;

function viv_com($rowcom,$com,$com_width,$com_dlina,$prava) 
{
if (isset($_COOKIE['com_kto']))	{ $com_kto = $_COOKIE['com_kto']; }
if (isset($_COOKIE['com_email'])) {	$com_email = $_COOKIE['com_email'];	}

if ($rowcom['com_adm']==1) { $bgadm='fef6f6'; } else { $bgadm='ffffff'; }
echo '<table width="'.$com_width.'" border="0" cellpadding="0" cellspacing="0" bgcolor="#'.$bgadm.'"><tr>';
echo '<td class="zag" valign="bottom"><a name="nach" id="'.$rowcom['com_id'].'"></a>
<div style="padding:20px 0 0 0;" align="left">'.$rowcom['com_kto'].' ';
if (!empty($rowcom['com_email'])) { echo '<a title="Написать письмо" href="mailto:'.$rowcom['com_email'].'"><img src="pic/email.png" border="0" /></a></div>'; }
$data=russian_date('j F Y',$rowcom['com_kogda']);
$vrem = time();
$seg=russian_date('j F Y',$vrem);
if ($data == $seg) { $data='Сегодня'; }
$chas=russian_date('G:i',$rowcom['com_kogda']);
echo '</td><td align="right" class="data" style="padding:0; margin:0;" valign="bottom"><div style="padding:15px 0 0 0;">';
if($prava==5) {
echo '<form action="http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'" method="post">';
echo '<input title="Удалить комментарий" style="border:0; padding:1px 1px 1px 10px; cursor:pointer; margin:0; color:#000; background:none;" type="image" align="right"  src="pic/del.png" width="22" border="0" value="Удалить" onclick="if(confirm(\'Действительно удалить комментарий?\n(текст будет удален)\'))submit();else return false;">';
echo '<INPUT type="hidden" name="com_id" value="'.$rowcom['com_id'].'" />
<INPUT type="hidden" name="acom" value="udcom" /></form>';
$idred='id="comText'.$rowcom['com_id'].'" href="#ComRed" title="Редактировать" com="'.$rowcom['com_id'].'"';
}
else { $idred=''; }
if (empty($rowcom['com_text'])) {$rowcom['com_text']='<span class="ser">комментарий удален</span>';}

echo ''.$data.', '.$chas.'</div></td></tr>
<tr><td colspan="2"><div '.$idred.' style="width:'.$com_width.'px; padding:10px 0 0 0; word-wrap:break-word;" align="left">'.$rowcom['com_text'].'</div>';
?>
<script type="text/javascript">
<!--
function chooselen<? echo $rowcom['com_id']; ?>() {
    M = window.document.send<? echo $rowcom['com_id']; ?>.com_text.value.length;
    window.document.send<? echo $rowcom['com_id']; ?>.count<? echo $rowcom['com_id']; ?>.value = M;
}
//-->
</script>
<div align="right" style="border-bottom:1px solid #d1d2d6; background-color: #<? echo $bgadm; ?>; margin-left:<? echo $ot; ?>px;">
<a style="cursor:pointer;" class="sm2" onClick="showlayer('komm<? echo $rowcom['com_id']; ?>')">ответить</a></div>
<?
echo '</td></tr></table>';
echo '<div id="komm'.$rowcom['com_id'].'" style="display:none; width:'.($com_width-20).'px; padding:10px; background-color:#fbfbfb;" align="left">
<form action="http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'" method="post" name="send'.$rowcom['com_id'].'">';
if (!empty($com_kto)) { echo '<span style="cursor:pointer;" title="изменить имя/e-mail" id="redname'.$rowcom['com_id'].'" class="zag">'.$com_kto.'</span>'; $nev=' class="nevid"'; }
else {$nev='';}
echo '<div id="nname'.$rowcom['com_id'].'"'.$nev.'><input class="validate[required,length[0,100]] text-input" type="text" style="width:170px;" value="'.@$com_kto.'" name="com_kto"> — Имя <input class="validate[custom[email]] text-input" value="'.@$com_email.'" type="text" style="width:170px; margin-left:30px;" name="com_email"> — Почта</div>';
echo '<textarea class="validate[required,length[0,'.$com_dlina.']] text-input" onchange="chooselen'.$rowcom['com_id'].'()" onkeyup="chooselen'.$rowcom['com_id'].'()" onkeydown="chooselen'.$rowcom['com_id'].'()" onkeypress="chooselen'.$rowcom['com_id'].'()" name="com_text" style="width:'.($com_width-30).'px; height:80px; margin:9px 0 9px 0; padding:3px;"></textarea>
<input type="hidden" name="page" value="'.$page.'">
<input type="hidden" name="com_papa" value="'.$rowcom['com_id'].'">
<input type="hidden" name="com" value="'.$com.'">
<input type="hidden" name="ncom" value="'.$rowcom['com_id'].'">
<input type="hidden" name="acom" value="dobcom">
<input type="submit" value="Комментировать"> 
<input size="4" value="0" name="count'.$rowcom['com_id'].'" type="text" style="background:none; border:none; text-align:right; margin: 0 7px 0 190px"> символов набрано
</form>
</div>';
$com_sl = $rowcom['com_id'];
return $com_sl; // возвращаем ид комментария для вывода комментов к нему
}
	$num = $com_str;
	$link .= '?mod=cat&cat_id='.$cat_id.'&tov_id='.$tov_id;
	$base1 = mysql_query("SELECT COUNT(*) FROM `com` WHERE `com_kgol`='{$com}' AND `com_papa`='0'",$db);
	$temp = mysql_fetch_array($base1);
	$posts = $temp[0];
	$total = (($posts - 1) / $num) + 1;
	$total = intval($total);
	$page = intval($page);
	if(empty($page) or $page < 0) $page = 1;
	if($page > $total) $page = $total;
	$start = $page * $num - $num;
	if ($start < 0) { $start = 0;}
	if ($page != 1) $pervpage = '<a class=nav href='.$link.'&page=1>первая</a> <a class=nav title=предидущая  href='.$link.'&page='. ($page - 1) .'><</a> ';
	if ($total > 1 and $page > 4) { $toch = '<span class=ser> .... </span> '; }
	$page2 = $total - $page;
	if ($total > 1 and $page2 >= 4) { $toch2 = ' <span class=ser> .... </span>'; }
	if ($page != $total) $nextpage = ' <a class=nav title=следующая href='.$link.'&page='. ($page + 1) .'>></a> <a class=nav href='.$link.'&page=' .$total. '>последняя</a>';
	if($page - 3 > 0) $page3left = ' <a class=nav href='.$link.'&page='.($page - 3).'>'.($page - 3).'</a> ';
	if($page - 2 > 0) $page2left = ' <a class=nav href='.$link.'&page='.($page - 2).'>'.($page - 2).'</a> ';
	if($page - 1 > 0) $page1left = ' <a class=nav href='.$link.'&page='.($page - 1).'>'.($page - 1).'</a> ';
	if($page + 3 <= $total) $page3right = ' <a class=nav href='.$link.'&page='.($page + 3).'>'.($page + 3).'</a> ';
	if($page + 2 <= $total) $page2right = ' <a class=nav href='.$link.'&page='.($page + 2).'>'.($page + 2).'</a> ';
	if($page + 1 <= $total) $page1right = ' <a class=nav href='.$link.'&page='.($page + 1).'>'.($page + 1).'</a> ';
function zapros($com,$com_papa,$start,$num)
{	if ($com_papa==0) {
	$basecom = mysql_query("SELECT * FROM `com` WHERE `com_kgol`='{$com}' AND `com_papa`='{$com_papa}'
							ORDER BY `com_id` DESC LIMIT $start, $num") or die(mysql_error());
	} else {
	$basecom = mysql_query("SELECT * FROM `com` WHERE `com_kgol`='{$com}' AND `com_papa`='{$com_papa}'
							ORDER BY `com_id` DESC") or die(mysql_error()); }
	return $basecom;
}
function pokaz_com($com,$com_width,$s,$com_dlina,$start,$num,$prava) { //к чему комментарий, ширина комментария, id к чему ответ
	$basecom = zapros($com,$s,$start,$num);
	if (mysql_num_rows($basecom) > 0) {
	$rowcom = mysql_fetch_array($basecom);
	if ($com_width>540) { $com_width = $com_width-20; }
	do { 
		$s = viv_com($rowcom,$com,$com_width,$com_dlina,$prava);
		pokaz_com($com,$com_width,$s,$com_dlina,$start,$num,$prava);
		}
	while($rowcom = mysql_fetch_array($basecom));
	if ($com_width>540) { $com_width = $com_width+20; }
	}
}
//показываем
echo '<div align="right" style="width:'.$com_width.'px;">';
pokaz_com($com,$com_width+20,$s,$com_dlina,$start,$num,$prava);
// Вывод меню если страниц больше одной
if ($total > 1)
{
Error_Reporting(E_ALL & ~E_NOTICE);
echo "<center><div class=navbar>";
echo $pervpage.$toch.$page5left.$page4left.$page3left.$page2left.$page1left.'<span class=nav><strong>'.$page.'</strong></span>'.$page1right.$page2right.$page3right.$page4right.$page5right.$toch2.$nextpage;
echo "</div><br /></center>";

}	
echo '</div><div id="mask"></div>';

?>
<form id="ComRed" action="#" method="post" class="window" style="padding:10px;">
<textarea name="com_text" id="poleComRed" style="width:350px; height:150px;"></textarea><br />
<input id="poleComId" name="com_id" type="hidden" value="0" />
<input id="poleComId" name="acom" type="hidden" value="redcom" />
<center>
<input type="submit" value="Редактировать" style="cursor:pointer; margin:10px 0 0 0;" />
</center>
</form>
<? if (isset($al)) { al($al); } ?>