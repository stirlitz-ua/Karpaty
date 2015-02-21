<?
$db = mysql_connect ("localhost","karpatya_bd","YA7ixgRc"); 
mysql_select_db("karpatya_catalog",$db);
//mysql_select_db("название базы данных",$db);

mysql_query("SET NAMES cp1251");
function globper($a) 
{
if (isset($_POST[$a])) { $per = $_POST[$a]; $per = trim($per); $per = stripslashes($per); $per = htmlspecialchars($per); }	
if (isset($_GET[$a])) { $per = $_GET[$a]; $per = trim($per); $per = stripslashes($per); $per = htmlspecialchars($per); }
$a = $per;
return $a;
}

$act = globper('act');
$mod = globper('mod');
$page = globper('page');
function russian_date() {
$translation = array("am" => "дп", "pm" => "пп", "AM" => "ДП", "PM" => "ПП", "Monday" => "Понедельник", "Mon" => "Пн", "Tuesday" => "Вторник", "Tue" => "Вт", "Wednesday" => "Среда", "Wed" => "Ср", "Thursday" => "Четверг", "Thu" => "Чт", "Friday" => "Пятница", "Fri" => "Пт", "Saturday" => "Суббота", "Sat" => "Сб", "Sunday" => "Воскресенье", "Sun" => "Вс", "January" => "Января", "Jan" => "Янв", "February" => "Февраля", "Feb" => "Фев", "March" => "Марта", "Mar" => "Мар", "April" => "Апреля", "Apr" => "Апр", "May" => "Мая", "May" => "Мая", "June" => "Июня", "Jun" => "Июн", "July" => "Июля", "Jul" => "Июл", "August" => "Августа", "Aug" => "Авг", "September" => "Сентября", "Sep" => "Сен", "October" => "Октября", "Oct" => "Окт", "November" => "Ноября", "Nov" => "Ноя", "December" => "Декабря", "Dec" => "Дек", "st" => "ое", "nd" => "ое", "rd" => "е", "th" => "ое",);
   if (func_num_args() > 1) {
      $timestamp = func_get_arg(1);
      return strtr(date(func_get_arg(0), $timestamp), $translation);
   } else {
      return strtr(date(func_get_arg(0)), $translation);
   };
}

function al($a){ echo '<script type="text/javascript">$(document).ready(function() { alert("'.$a.'"); });</script>'; }

//настройки
 $basenastr = mysql_query("SELECT `nas_par`,`nas_znach` FROM `nas`",$db) or die(mysql_error());
 $rownastr = mysql_fetch_array($basenastr);
 do {
	 $$rownastr['nas_par'] = $rownastr['nas_znach'];
	 }
while ($rownastr = mysql_fetch_array($basenastr));
$vrem = time();
//////////////////////////////////////
//добавлено с версии 1.1
$acom = globper('acom');
$base = mysql_query("SELECT `user_email`	FROM `users` WHERE `user_id`='1' LIMIT 1",$db) or die(mysql_error());
$row = mysql_fetch_array($base);
$adm_email = $row['user_email'];

//выход
if (isset($_GET['logout']))
{	if (isset($_SESSION['ses_user'])) { unset($_SESSION['ses_user']); }
	if (isset($_SESSION['pass'])) { unset($_SESSION['pass']); }
	setcookie('user_id', '', 0, "/");
	setcookie('user_pass', '', 0, "/");
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
			header('Location: index.php');
			exit(); }
	}
//комментирование
if ($acom=="dobcom") 
{
$com = globper('com');
$com_kto = globper('com_kto');
$com_email = globper('com_email');
$com_text = globper('com_text');
$com_papa = globper('com_papa');
$com_ip = $_SERVER['REMOTE_ADDR'];

$com_kogda = time();

$time = 31536000;
if (!empty($com_kto)) {	setcookie('com_kto', $com_kto, time()+$time, "/"); }
if (!empty($com_email)) { setcookie('com_email', $com_email, time()+$time, "/"); }

if (empty($com_kto) or empty($com_text)) { $oshibka = '<div class="alert">Обязательно напишите своё имя и текст комментария</div>'; }
else {

if (strlen($com_text) > $com_dlina) { $com_text = substr("$com_text", 0, $com_dlina); $com_text = $com_text."..."; }

if ($prava==5) { $com_adm=1; }	else { $com_adm=0; }
	
	$dob = mysql_query ("INSERT INTO `com` (`com_adm`,`com_kgol`,`com_papa`,`com_kto`,`com_kogda`,`com_email`,`com_text`,`com_ip`) 
	VALUES ('{$com_adm}','{$com}','{$com_papa}','{$com_kto}','{$com_kogda}','{$com_email}','{$com_text}','{$com_ip}')",$db) or die(mysql_error());
	
	$headers=null;
	$headers.="Content-Type: text/html; charset=windows-1251\r\n";
	$headers.="From: SkyScript.ru@SkyMail.v2\r\n";
	$headers.="X-Mailer: SkyMail\r\n";
	$msg="<html><head><meta http-equiv='Content-Type' content='text/html; charset=windows-1251'>
	<style>BODY {FONT-FAMILY: arial,helvetica; FONT-SIZE: 12px; COLOR: #333} 
	TD {FONT-SIZE: 12px; COLOR: #333} .sm {FONT-SIZE: 9px;}</style>
	</head>
	<body>
	<strong>".$com_kto."</strong><br /> В материале: 
	<a title='перейти' href='http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']."?com=".$com."'>
	просмотреть</a><br /><br />
	Оставил комментарий: «".$com_text."» 
	<br /><br /><br />
	<span class='sm'>Это письмо было сгенерировано автоматически, отвечать на него не надо</span><br /><br /><hr /><center>
	<a class='sm' target=_blank href=http://www.skyscript.ru>Скрипт разработан SkyScript</a>
	</center>
	</body></html>";
	mail($adm_email, "Новый комментарий", $msg, $headers);
	$nopage = globper('nopage');
	$ncom = globper('ncom');
	if ($nopage==1 && $page > 1) {header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'&page=1#ncom');}
	else { header('Location: http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'].'#'.$ncom.''); }
	}
}	
?>