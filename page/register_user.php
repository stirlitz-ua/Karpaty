<?


if(isset($_REQUEST['firstname'])){

 
$patronymic=$_REQUEST['patronymic'];
$birthday=$_REQUEST['birthday'];
$firstname=$_REQUEST['firstname'];
$lastname=$_REQUEST['lastname'];
$phone=$_REQUEST['phone'];
$city=$_REQUEST['city'];
$mail=$_REQUEST['mail'];
$format=$_REQUEST['format'];
$gender=$_REQUEST['gender'];

$hash=md5($mail.$phone);
     
   
   
   


    $db = mysql_connect("localhost", "karpatya_bd", "YA7ixgRc");
    mysql_select_db("karpatya_avto", $db);
    mysql_query("SET NAMES utf8");

    $tq=mysql_query("SELECT * FROM client WHERE mail like '$mail'", $db);
    //$t33d = mysql_fetch_array($tq);
    if(mysql_num_rows($tq)>0){
        echo json_encode(array(  'json' => 'bed'));
    }else{
        
        $tq=mysql_query("INSERT INTO client SET 
        patronymic='$patronymic',
        birthday='$birthday',
        firstname='$firstname',
        lastname='$lastname',
        phone='$phone',
        city='$city',
        mail='$mail',
        format='$format',
        gender='$gender',
        hash='$hash'
        ", $db);
        echo json_encode(array(  'json' => 'ok'));
        
    $to=$mail;
    
    $subject.= "Оповещение с сайта \"karpaty-autocenter.com.ua\"";
    
    $text ="Здравствуйте,  $lastname $firstname $patronymic.\r\n";

    $text.="Вы зарегистрированы на рассылку новостей на сайте http://karpaty-autocenter.com.ua\r\n";
    $text.="Если Вы хотите отписаться от рассылки пройдите по ссылке http://karpaty-autocenter.com.ua/page/register_user.php?hash=$hash \r\n";
    
    $extra = "From: $mail\r\nReply-To: $mail\r\n";
    $extra .= "Content-type: text/$format; charset=Windows-1251;\r\n";
     mail (iconv("UTF-8", "windows-1251",$to), iconv("UTF-8", "windows-1251",$subject), iconv("UTF-8", "windows-1251",$text), iconv("UTF-8", "windows-1251",$extra) );
/**/    
          
        
    }
  


    
 
    
}


if(isset($_GET['hash'])){
    $db = mysql_connect("localhost", "karpatya_bd", "YA7ixgRc");
    mysql_select_db("karpatya_avto", $db);
    mysql_query("SET NAMES utf8");

    $tq=mysql_query("SELECT * FROM client WHERE hash like '$_GET[hash]'", $db);
    //$t33d = mysql_fetch_array($tq);
    if(mysql_num_rows($tq)>0){
        mysql_query("DELETE FROM client WHERE hash like '$_GET[hash]'", $db);
        echo "Ваш mail удален из нашей базы";
    }



}

?>