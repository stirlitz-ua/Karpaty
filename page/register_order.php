<?php

if(isset($_REQUEST['firstname'])){
    $patronymic=$_REQUEST['patronymic'];
    $car=$_REQUEST['car'];
    $firstname=$_REQUEST['firstname'];
    $lastname=$_REQUEST['lastname'];
    $phone=$_REQUEST['phone'];
    $numbers=$_REQUEST['numbers'];
    $times=$_REQUEST['zapch'];
    $mail=$_REQUEST['mail'];
    $format=$_REQUEST['format'];


    $hash=md5($mail.$phone);


    $db = mysql_connect("localhost", "karpatya_bd", "YA7ixgRc");
    mysql_select_db("karpatya_avto", $db);
    mysql_query("SET NAMES utf8");

    $tzz=mysql_query("SELECT * FROM order WHERE mail like '$mail'", $db);
    //$t33d = mysql_fetch_array($tzz);
    if(mysql_num_rows($tzz)>0){
        echo json_encode(array(  'json' => 'bed'));
    }else{

        $tzz=mysql_query("INSERT INTO service SET
        patronymic='$patronymic',
        car='$car',
        firstname='$firstname',
        lastname='$lastname',
        phone='$phone',
        mail='$mail',
        format='$format',
        numbers='$numbers',
        zapch='$zapch',
        hash='$hash'
        ", $db);
        echo json_encode(array(  'json' => 'ok'));


        $to=$mail;

        $subject.= "Заказ запчасти с сайта \"karpaty-autocenter.com.ua\"";

        $text ="Здравствуйте,  $lastname $firstname $patronymic.\r\n";

        $text.="Спасибо за заказ запчасти с сайта http://karpaty-autocenter.com.ua<br/>\r\n";
        $text.="<u>Ваши даные:</u><br/> \r\n";
        $text.="Автомобиль: $car <br/>\r\n";
        $text.="Номер кузова: $numbers<br/> \r\n";
        $text.="Номер телефона: $phone<br/>\r\n";
        $text.="Запчасть: $zapch<br/>\r\n";
        $text.="После обработки Вашей заявки, мы обязательно свяжемся с Вами\r\n";
        $extra = "From: $mail\r\nReply-To: $mail\r\n";
        $extra .= "Content-type: text/$format; charset=Windows-1251;\r\n";
        mail (iconv("UTF-8", "windows-1251",$to), iconv("UTF-8", "windows-1251",$subject), iconv("UTF-8", "windows-1251",$text), iconv("UTF-8", "windows-1251",$extra) );
        /**/

        $to2='admin_karpatyautocenter@ukr.net';

        $subject2.= "Заказ запчасти с сайта \"karpaty-autocenter.com.ua\"";

        $text2="<u>Данные:</u><br/> \r\n";
        $text2.="ФИО: $lastname $firstname $patronymic <br/>\r\n";
        $text2.="Автомобиль: $car <br/>\r\n";
        $text2.="Номер кузова: $numbers<br/> \r\n";
        $text2.="Номер телефона: $phone<br/>\r\n";
        $text2.="Запчасть: $zapch<br/>\r\n";
        $extra2 = "From: $mail\r\nReply-To: $mail\r\n";
        $extra2 .= 'Cc: oleg_grusha@karpaty-autocenter.com.ua' . "\r\n";
        $extra2 .= "Content-type: text/$format; charset=Windows-1251;\r\n";
        mail (iconv("UTF-8", "windows-1251",$to2), iconv("UTF-8", "windows-1251",$subject2), iconv("UTF-8", "windows-1251",$text2), iconv("UTF-8", "windows-1251",$extra2) );

    }






}


if(isset($_GET['hash'])){
    $db = mysql_connect("localhost", "karpatya_bd", "YA7ixgRc");
    mysql_select_db("karpatya_avto", $db);
    mysql_query("SET NAMES utf8");

    $tz=mysql_query("SELECT * FROM order WHERE hash like '$_GET[hash]'", $db);
    //$t33d = mysql_fetch_array($tz);
    if(mysql_num_rows($tz)>0){
        mysql_query("DELETE FROM order WHERE hash like '$_GET[hash]'", $db);
        echo "Ваш mail удален из нашей базы";
    }



}

?>