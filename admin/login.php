<?session_start();
include"../bd.php";
if(isset($_POST['l']) and isset($_POST['p'])){
$login=mysql_real_escape_string($_POST['l']);
$password=mysql_real_escape_string($_POST['p']);
if($login!='' and $password!=''){
$us=mysql_query("SELECT * FROM `admin` WHERE `login`='".$login."' AND `pass`='".$password."'");
if(mysql_num_rows($us)>0){
$rez=mysql_fetch_array($us);
$_SESSION['login']=$_POST['l'];
$_SESSION['password']=$_POST['p'];
$_SESSION['name']=$rez['name'];
echo "<script>document.location.replace('./?home&menu');</script>";
}else{echo "<script>document.location.replace('login.html');</script>";}
}else{echo "<script>document.location.replace('login.html');</script>";}
}else{echo "<script>document.location.replace('login.html');</script>";}
?>