<?
  session_start();
  include"../bd.php";
  include"../component/component.php";
  include "../component/class_json.php";
  include  'page/heder.php';

 
  if(isset($_GET['exit'])){session_destroy(); echo "<script>document.location.replace('login.php');</script>";} 
  date_default_timezone_set('Europe/Kiev');
  $sdate = date("m-d-y H:i:s");	
  $date = date("Y-m-d H:i:s");
  //$add=mysql_query("UPDATE admin SET login='admin', pass='956'");
$us=mysql_query("SELECT * FROM admin WHERE login='".$_SESSION['login']."' AND pass='".$_SESSION['password']."'");
if(mysql_num_rows($us)>0){}else{ echo "<script>document.location.replace('login.php');</script>";}

if(isset($_GET['models'])){include 'page/model.php';}
if(isset($_GET['page'])){include 'page/page.php';}
if(isset($_GET['avto'])){include 'page/avto.php';}
if(isset($_GET['task'])){
    include 'page/catalog.php';}
if(isset($_GET['banner'])){include 'page/banner.php';}
if(isset($_GET['st'])){include 'page/home.php';}
if(isset($_GET['form'])){include 'page/form.php';}
if(isset($_GET['distribution'])){include 'page/distribution.php';}


include  'page/fut.php';
?>