<?

include 'bd.php';

include 'component/class_json.php';

include 'component/component.php';



function mails($mail){

        $to = $mail; 

        $subject.= 'marketing@volkswagen.odessa.ua';

        $from = 'marketing@volkswagen.odessa.ua'; 

        $subject = '=?utf-8?b?'. base64_encode($subject) .'?='; 

        $headers = "Content-type: text/html; charset=\"utf-8\"\r\n"; 

        $headers .= "From: <". $from .">\r\n"; 

        $headers .= "MIME-Version: 1.0\r\n"; 

        $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n"; 

        $mais='<html><head><title>Джерман-Автоцентр</title><style type="text/css">.email_background {width: 680px;}img {display: block;border: none;}h1 {color: #2274ac;font-family: Arial,Helvetica,sans-serif;padding: 0;margin: 0;font-size: 24px;font-weight: normal;text-align: left;}.footer {padding: 0;margin: 0; font-family: Arial, Helvetica, sans-serif;font-size: 10px; color: #777777;line-height: 20px;	text-align: left;}.content {font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 20px;text-align: left;padding: 0;margin: 0;}</style></head><body><table cellpadding="0" cellspacing="0" border="0" width="99%" bgcolor="#ffffff"><tr bgcolor="#2274ac"><td align="center" height="2"></td></tr><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" width="680"><tr><td><table cellpadding="0" cellspacing="0" border="0" width="680"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" width="680"><tr><td align="left" style="padding-bottom: 20px;"><img src="http://volkswagen.odessa.ua/img/logo.jpg" width="503" height="66" border="0" style=" padding-top: 20px;" /> </td><td style="padding-bottom: 20px;"></td>	<td style="padding-bottom: 20px;"></td>	<td style="padding-bottom: 20px;"></td>	<td style="padding-bottom: 20px;"></td></tr><tr><td align="left" colspan="5" align="left" style="padding-bottom: 10px;"><h1>Уважаемый клиент!</h1></td></tr><tr><td align="left" valign="top" colspan="5" style="padding-bottom: 20px;"><p class="content">Благодарим Вас за регистрацию на сайте www.volkswagen.odessa.ua </p><p class="content">13 апреля 2013 года в Джерман-Автоцентр состоится Ярмарка Финансирования.</p><p class="content">Вас ждет:</p><p class="content"> С 11.00 до 18.00  Тест-драйв  новинки этого сезона The Beetle и всего модельного ряда Volkswagen. </p><p class="content"> Викторина для самых эрудированных. Призы для каждого от наших партнеров.</p><p class="content"> В 11.30 Мастер-класс ведущих специалистов по 2-м темам:</p><p class="content">   Кредит! Лизинг! Страхование! Как сделать правильный выбор?</p><p class="content">   Почему Volkswagen?   </p><p class="content">В 12.30 Аукцион  автомобилей Volkswagen. Формируем цену в режиме реального времени. </p><p class="content">13.00 Розыгрыш iPhone 5 для самых активных и заинтересованных клиентов!</p></td></tr></table></td></tr><tr bgcolor="#2274ac"><td  height="1"></td></tr><tr><td><p class="footer">В честь Ярмарки Финансирования мы предлагаем БЕСПРЕЦЕДЕНТНЫЕ условия приобретения Volkswagen!</p><p class="footer">С уважением, Коллектив Джерман-Автоцентр.</p></td></tr></table></td></tr></table></td></tr></table></body></html>';

        

        smtpmail($to, $subject, $mais, $headers);

        

}









session_start();





if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_a0'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `cars_new` WHERE car_id='".$_REQUEST['id']."'"));

    $i=0;

    while(@fopen('avtoinstock/images/img_'.$teh['car_id'].'_'.$i.'.jpg', "r")){

        unlink('avtoinstock/images/img_'.$teh['car_id'].'_'.$i.'.jpg');

        $i++;

    }

    $deles=mysql_query("DELETE FROM `cars_new` WHERE car_id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}





if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_m_p'){

    $deles=mysql_query("DELETE FROM `model_page` WHERE `id`='".$_REQUEST['id']."'", $db);

    unlink('photo/volkswagen_img_special_m_'.$_REQUEST['id'].'.jpg');

    unlink('photo/volkswagen_img_special_'.$_REQUEST['id'].'.jpg');

    echo json_encode(array( 'json' => 'ok'));

}







if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_mail'){

    $deles=mysql_query("DELETE FROM `mail` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='edit_mail'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `mail` WHERE id='".$_REQUEST['id']."'"));

    echo json_encode(array( 'json' => $teh));

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_mail_post'){

    $deles=mysql_query("DELETE FROM `mail_post` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}







if(isset($_REQUEST['action']) and $_REQUEST['action']=='delban'){

    unlink('img/rotator/avto_'.$teh['car_id'].'_'.$i.'.jpg');

    $deles=mysql_query("DELETE FROM `ban` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_ft'){

    $deles=mysql_query("DELETE FROM `form` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='deldl'){

    $deles=mysql_query("DELETE FROM `complekt` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='varrem'){

    $deles=mysql_query("DELETE FROM `complekt_p` WHERE id='".$_REQUEST['id']."'", $db);
    $deles=mysql_query("DELETE FROM `complekt_pp` WHERE id_model='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => '0'));

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='deldlmm'){

    unlink('photo/complekt/'.$_REQUEST['id'].'_'.$_REQUEST['idm'].'m.png');

    unlink('photo/complekt/'.$_REQUEST['id'].'_'.$_REQUEST['idm'].'.png');

    $deles=mysql_query("DELETE FROM `complekt` WHERE link='".$_REQUEST['id']."' AND `id_model`='".$_REQUEST['idm']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}







if(isset($_REQUEST['action']) and $_REQUEST['action']=='delphoto'){

    unlink('photo/gallery/gallery_'.$_REQUEST['id'].'.jpg');

    unlink('photo/gallery/gallery_'.$_REQUEST['id'].'_m.jpg');

    $deles=mysql_query("DELETE FROM `photo` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='cenna'){


    $add0=mysql_query("UPDATE `complekt` SET `cena`='".$_REQUEST['v']."' WHERE `id`='".$_REQUEST['id']."'");

    echo json_encode(array( 'json' => 'ok'));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='cenna2'){


    $add0=mysql_query("UPDATE `complekt` SET `cena2`='".$_REQUEST['v']."' WHERE `id`='".$_REQUEST['id']."'");

    echo json_encode(array( 'json' => 'ok'));

}





if(isset($_REQUEST['action']) and $_REQUEST['action']=='sawecomp'){

    $tf=mysql_query("SELECT * FROM  `complekt_p` WHERE `name`='".$_REQUEST['v']."' AND `model`='".$_REQUEST['id']."'");

    if(mysql_num_rows($tf)==0){

         $add=mysql_query("INSERT INTO `complekt_p` SET `name`='".$_REQUEST['v']."',`model`='".$_REQUEST['id']."'");

         echo json_encode(array( 'json' => 'ok'));

    }else{

         echo json_encode(array( 'json' => 'n'));

    }

    

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='editcomp'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt_p` WHERE `id`='".$_REQUEST['id']."'"));

    echo json_encode(array( 'json' => $teh['name']));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='swcomp'){

    $add0=mysql_query("UPDATE `complekt_p` SET `name`='".$_REQUEST['te']."' WHERE `id`='".$_REQUEST['id']."'");

    echo json_encode(array( 'json' => 'ok'));

}





if(isset($_REQUEST['action']) and $_REQUEST['action']=='saweomp_op_n'){

    $tf=mysql_query("SELECT * FROM  `complekt_pp` WHERE `name`='".$_REQUEST['v']."' AND `id_model`='".$_REQUEST['id']."'");

    if(mysql_num_rows($tf)==0){

        if($_REQUEST['ch1']==true){$ch1=1;}else{$ch1=0;};

        if($_REQUEST['ch2']==true){$ch2=1;}else{$ch2=0;};

        if($_REQUEST['ch3']==true){$ch3=1;}else{$ch3=0;};

        

        $add=mysql_query("INSERT INTO `complekt_pp` SET 

                            `name`='".$_REQUEST['v']."',

                            `id_model`='".$_REQUEST['id']."',

                            `id_complete`='".$_REQUEST['id_m']."',

                            `overview`='".$ch1."',

                            `standard_options`='".$ch2."',

                            `options`='".$ch3."',

                            `val`='1'");

                            

        $id=mysql_insert_id();

        $add0=mysql_query("UPDATE `complekt_pp` SET `idd`='".$id."' WHERE `id`='".$id."'");                    

                            

        echo json_encode(array( 'json' => 'ok'));

    }else{

        echo json_encode(array( 'json' => 'n'));

    }

}





if(isset($_REQUEST['action']) and $_REQUEST['action']=='clob'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt_pp` WHERE `id`='".$_REQUEST['id']."'"));

    if($teh['overview']==1){

        $add=mysql_query("UPDATE `complekt_pp` SET `overview`='0' WHERE `id`='".$_REQUEST['id']."'");

        echo json_encode(array( 'json' => '0'));

    }else{

        $add=mysql_query("UPDATE `complekt_pp` SET `overview`='1' WHERE `id`='".$_REQUEST['id']."'");

        echo json_encode(array( 'json' => '1'));

    }

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='clso'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt_pp` WHERE `id`='".$_REQUEST['id']."'"));

    if($teh['standard_options']==1){

        $add=mysql_query("UPDATE `complekt_pp` SET `standard_options`='0' WHERE `id`='".$_REQUEST['id']."'");

        echo json_encode(array( 'json' => '0'));

    }else{

        $add=mysql_query("UPDATE `complekt_pp` SET `standard_options`='1' WHERE `id`='".$_REQUEST['id']."'");

        echo json_encode(array( 'json' => '1'));

    }

}





if(isset($_REQUEST['action']) and $_REQUEST['action']=='clop'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt_pp` WHERE `id`='".$_REQUEST['id']."'"));

    if($teh['options']==1){

        $add=mysql_query("UPDATE `complekt_pp` SET `options`='0' WHERE `id`='".$_REQUEST['id']."'");

        echo json_encode(array( 'json' => '0'));

    }else{

        $add=mysql_query("UPDATE `complekt_pp` SET `options`='1' WHERE `id`='".$_REQUEST['id']."'");

        echo json_encode(array( 'json' => '1'));

    }

}


if(isset($_REQUEST['action']) and $_REQUEST['action']=='clrem'){

	$del=mysql_query("DELETE FROM `complekt_pp` WHERE `id`='".$_REQUEST['id']."'");
	$del=mysql_query("DELETE FROM `complekt_pp` WHERE `id`='".$_REQUEST['id']."'");
	$del=mysql_query("DELETE FROM `complekt_pp` WHERE `id`='".$_REQUEST['id']."'");
	echo json_encode(array( 'json' => '0'));

}


if(isset($_REQUEST['action']) and $_REQUEST['action']=='dblcomplete'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `complekt_pp` WHERE `id`='".$_REQUEST['id']."'"));

    

    $th=mysql_query("SELECT * FROM  `complekt_pp` WHERE `name`='".$teh['name']."' AND id!='".$teh['id']."'");

    if(mysql_num_rows($th)==0){

        

        $add=mysql_query("INSERT INTO `complekt_pp` SET 

                            `name`='".$teh['name']."',

                            `id_model`='".$teh['id_model']."',

                            `id_complete`='".$_REQUEST['ids']."',

                            `overview`='".$teh['overview']."',

                            `standard_options`='".$teh['standard_options']."',

                            `options`='".$teh['options']."',

                            `val`='1'");

        

        echo json_encode(array( 'json' => '1'));

        

    }else{

        echo json_encode(array( 'json' => '0'));

    }



}













if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_ca'){

    $catalog=mysql_fetch_array(mysql_query("SELECT * FROM  `catalogi` WHERE id='".$_REQUEST['id']."' LIMIT 1"));

    unlink('./photo/catalog/'.$catalog['link'].'_'.$catalog['model'].'_'.$catalog['id'].'.pdf');

    unlink('./photo/catalog/'.$catalog['link'].'_'.$catalog['model'].'_'.$catalog['id'].'.jpg');

    $deles=mysql_query("DELETE FROM `catalogi` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}







if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_se'){

    $deles=mysql_query("DELETE FROM `set_models` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}







if(isset($_REQUEST['action']) and $_REQUEST['action']=='del_a1'){

    $teh=mysql_fetch_array(mysql_query("SELECT * FROM  `cars` WHERE car_id='".$_REQUEST['id']."'"));

    $i=0;

    while(@fopen('dasweltauto/images/img_'.$teh['car_id'].'_'.$i.'.jpg', "r")){

        unlink('dasweltauto/images/img_'.$teh['car_id'].'_'.$i.'.jpg');

        $i++;

    }

    $deles=mysql_query("DELETE FROM `cars` WHERE car_id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='cena_set'){

    $ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='1'");

    while($mset=mysql_fetch_array($ms)){ $cena[]=$mset['name'];}

    echo json_encode(array( 'json' => $cena));

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='editset'){

    $mset=mysql_fetch_array(mysql_query("SELECT * FROM  `set_models` WHERE id='".$_REQUEST['id']."'"));

    echo json_encode(array( 'json' => $mset['name'], 'weight' => $mset['weight']));

}







if(isset($_REQUEST['action']) and $_REQUEST['action']=='sawe_set'){

    if($_REQUEST['id']==0){

        $add=mysql_query("INSERT INTO `set_models` SET `id_cat`='0',`name`='".$_REQUEST['va']."', `link`='".$_REQUEST['tr']."' ");

        $id=mysql_insert_id();

        $add=mysql_query("UPDATE `set_models` SET `idd`='".$id."' WHERE `id`='".$id."'");

    }elseif($_REQUEST['id']==2){

        $add=mysql_query("INSERT INTO `set_models` SET `id_cat`='2',`name`='".$_REQUEST['va']."', `link`='".$_REQUEST['tr']."' ");

        $id=mysql_insert_id();

        $add=mysql_query("UPDATE `set_models` SET `idd`='".$id."' WHERE `id`='".$id."'");

    }elseif($_REQUEST['id']==1){

        $add=mysql_query("UPDATE `set_models` SET `name`='".$_REQUEST['va1']."' WHERE `id`='9'");

        $add=mysql_query("UPDATE `set_models` SET `name`='".$_REQUEST['va2']."' WHERE `id`='10'");

        $id='ok';

    }elseif($_REQUEST['id']==4){

        $add=mysql_query("UPDATE `set_models` SET `name`='".$_REQUEST['va']."', `weight`='".$_REQUEST['weight']."',`link`='".$_REQUEST['tr']."' WHERE `id`='".$_REQUEST['idd']."'");

        $id='ok';

    }

 

    echo json_encode(array( 'json' => $id));

}





if(isset($_REQUEST['action']) and $_REQUEST['action']=='delp'){

    unlink('photo/volkswagen_img_'.$_REQUEST['id'].'.jpg');

    $deles=mysql_query("DELETE FROM `arr` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='delpp'){

    unlink('photo/volkswagen_img_'.$_REQUEST['id'].'_.jpg');

    $deles=mysql_query("DELETE FROM `arr_page` WHERE id='".$_REQUEST['id']."'", $db);

    echo json_encode(array( 'json' => 'ok'));

}









if(isset($_REQUEST['action']) and $_REQUEST['action']=='test_drive'){

$json.='<li>ФИО: '.$_REQUEST['name'].'</li><li>Дата рождения: '.$_REQUEST['number'].' '.$_REQUEST['month'].' '.$_REQUEST['year'].'</li><li>Почтовый адрес: '.$_REQUEST['adres'].' </li><li>Электронный адрес: '.$_REQUEST['mail'].' </li><li>телефон: '.$_REQUEST['phone'].' </li><li>Модель: ';

foreach($_REQUEST['allch'] as $val){ $json.=$val.', ';}

$json.=' </li>';

        $to = 'marketing@volkswagen.odessa.ua'; 

        $subject.= $_REQUEST['mail'];

        $from = $_REQUEST['mail']; 

        $subject = '=?utf-8?b?'. base64_encode($subject) .'?='; 

        $headers = "Content-type: text/html; charset=\"utf-8\"\r\n"; 

        $headers .= "From: <". $from .">\r\n"; 

        $headers .= "MIME-Version: 1.0\r\n"; 

        $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n"; 

        $message = $json; 

        smtpmail($to, $subject, $message, $headers);

        mails($_REQUEST['mail']);

echo json_encode(array( 'json' => 'ok'));

}

if(isset($_REQUEST['action']) and $_REQUEST['action']=='mc_cl'){

$json.='<li>ФИО: '.$_REQUEST['name'].'</li><li>Дата рождения: '.$_REQUEST['number'].' '.$_REQUEST['month'].' '.$_REQUEST['year'].'</li>

<li>Город: '.$_REQUEST['adres0'].' </li>

<li>Улица: '.$_REQUEST['adres1'].' </li>

<li>Дом: '.$_REQUEST['adres2'].' </li>

<li>Кв: '.$_REQUEST['adres3'].' </li>

<li>Электронный адрес: '.$_REQUEST['mail'].' </li><li>телефон: '.$_REQUEST['phone'].' </li><li>Мастер класс: ';

foreach($_REQUEST['allch'] as $val){ $json.=$val.', ';}

$json.=' </li>';

        $to = 'marketing@volkswagen.odessa.ua'; 

        $subject.= $_REQUEST['mail'];

        $from = $_REQUEST['mail']; 

        $subject = '=?utf-8?b?'. base64_encode($subject) .'?='; 

        $headers = "Content-type: text/html; charset=\"utf-8\"\r\n"; 

        $headers .= "From: <". $from .">\r\n"; 

        $headers .= "MIME-Version: 1.0\r\n"; 

        $headers .= "Date: ". date('D, d M Y h:i:s O') ."\r\n"; 

        $message = $json; 

        smtpmail($to, $subject, $message, $headers);

        

        mails($_REQUEST['mail']);

        

echo json_encode(array( 'json' => 'ok'));

}





if(isset($_REQUEST['action']) and $_REQUEST['action']=='menu_clik'){

$rez=mysql_fetch_array(mysql_query("SELECT * FROM models WHERE id='".$_REQUEST['id']."'"));

if($rez[$_REQUEST['name']]==0){$add=mysql_query("UPDATE `models` SET `".$_REQUEST['name']."`='1' WHERE `id`='".$_REQUEST['id']."'");}else{$add=mysql_query("UPDATE `models` SET `".$_REQUEST['name']."`='0' WHERE `id`='".$_REQUEST['id']."'");}

echo json_encode(array( 'json' => 'ok'));

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='t_d'){

$rez=mysql_fetch_array(mysql_query("SELECT * FROM set_form WHERE id='".$_REQUEST['id']."'"));

if($rez['sinch']==0){$add=mysql_query("UPDATE `set_form` SET `sinch`='1' WHERE `id`='".$_REQUEST['id']."'");$a=1;}else{$add=mysql_query("UPDATE `set_form` SET `sinch`='0' WHERE `id`='".$_REQUEST['id']."'");$a=0;}

echo json_encode(array( 'json' => $a));

}







if(isset($_REQUEST['action']) and $_REQUEST['action']=='s_m'){

$add=mysql_query("UPDATE `set_form` SET `mail`='".$_REQUEST['t']."' WHERE `id`='".$_REQUEST['id']."'");

$s=iconv_strlen($_REQUEST['t'],'UTF-8');

echo json_encode(array( 'json' => $s));

}



if(isset($_REQUEST['action']) and $_REQUEST['action']=='z_d'){

    $pl=preg_replace("/\D/","",$_REQUEST['t']);

$add=mysql_query("UPDATE `set_form` SET `phone`='".$pl."' WHERE `id`='".$_REQUEST['id']."'");

$s=iconv_strlen($pl,'UTF-8');

echo json_encode(array( 'json' => $s));

}



































?>