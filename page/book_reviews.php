<?if(isset($_GET['menu']) AND $_GET['menu']=='form_post'){

    if(!empty($_POST)){



    $form=mysql_real_escape_string(preg_replace("/\D/","",$_POST['form']));
    $text1=mysql_real_escape_string($_POST['text1']);
    if($form==1){$text2=mysql_real_escape_string($_POST['text2']);}else{$text2='';}
    $name=mysql_real_escape_string($_POST['name']);
    $city=mysql_real_escape_string($_POST['city']);
    $org=mysql_real_escape_string($_POST['org']);
    $phone=mysql_real_escape_string(preg_replace("/\D/","",$_POST['phone']));
    $adres=mysql_real_escape_string($_POST['adres']);
    $mail=mysql_real_escape_string($_POST['mail']);
    $grade=mysql_real_escape_string(preg_replace("/\D/","",$_POST['grade']));

    $ar=array('name'=>$name,'city'=>$city,'org'=>$org,'phone'=>$phone,'adres'=>$adres,'mail'=>$mail);
    $arr=serialize($ar);

    $add=mysql_query("INSERT INTO `form` SET
        `idform`='".$form."',
        `text1`='".$text1."',
        `text2`='".$text2."',
        `arr`='".$arr."',
        `date`=NOW(),
        `ip`='".$_SERVER['REMOTE_ADDR']."',
        `grade`='".$grade."'");

    $seting=mysql_fetch_array(mysql_query("SELECT * FROM `set_form`  WHERE id='1'"));


    if($seting['mail']!=''){






        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers = "Content-type: text/html; charset=\"utf-8\"\r\n";
        $headers .= 'From: <'.$mail.'>'. "\r\n";

        $mais='<html><head><title>Джерман-Автоцентр</title>
        <style type="text/css">.email_background {width: 680px;}img {display: block;border: none;}h1 {color: #2274ac;font-family: Arial,Helvetica,sans-serif;padding: 0;margin: 0;font-size: 24px;font-weight: normal;text-align: left;}.footer {padding: 0;margin: 0; font-family: Arial, Helvetica, sans-serif;font-size: 10px; color: #777777;line-height: 20px;	text-align: left;}.content {font-family: Arial, Helvetica, sans-serif;font-size: 12px;line-height: 20px;text-align: left;padding: 0;margin: 0;}.content_head{font-family: Arial, Helvetica, sans-serif;font-size: 13px;line-height: 20px;text-align: left;padding: 0;margin: 0;color: #333;font-style: italic;font-weight: bold;}</style></head>
        <body>
            <table cellpadding="0" cellspacing="0" border="0" width="99%" bgcolor="#ffffff">
                <tr bgcolor="#2274ac">
                <td align="center" height="2"></td></tr>
                <tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" width="680"><tr><td>
                <table cellpadding="0" cellspacing="0" border="0" width="680"><tr>
                <td align="center"><table cellpadding="0" cellspacing="0" border="0" width="680"><tr>
                <td align="left" style="padding-bottom: 20px;"><img src="http://volkswagen.odessa.ua/img/logo1.jpg" width="353" height="66" border="0" style=" padding-top: 20px;" />
                </td><td style="padding-bottom: 20px;"></td>
                <td style="padding-bottom: 20px;"></td>	<td style="padding-bottom: 20px;"></td>	<td style="padding-bottom: 20px;"></td></tr>
                <tr><td align="left" colspan="5" align="left" style="padding-bottom: 10px;"><h1>Электронная Книга Отзывов и предложений</h1><p class="content_head">ОЦЕНКА работы служб автоцентра</p></td>
                </tr><tr><td align="left" valign="top" colspan="5" style="padding-bottom: 20px;">
                    <p class="content"><b>ФИО:</b> '.$name.'</p>
                    <p class="content"><b>Город:</b> '.$city.'</p>
                    <p class="content"><b>Организация:</b> '.$org.'</p>
                    <p class="content"><b>Телефон:</b> '.$phone.'</p>
                    <p class="content"><b>Адрес:</b> '.$adres.'</p>
                    <p class="content"><b>E-mail:</b> '.$mail.'</p>
                    <p class="content"><b>Чем Вы остались НЕДОВОЛЬНЫ в работе Автоцентра:</b><br> '.$text1.'</p>
                    <p class="content"><b>Что Вам ПОНРАВИЛОСЬ в работе Автоцентра / кому Вы хотели бы выразить БЛАГОДАРНОСТЬ:</b> <br> '.$text2.'</p>
                </td></tr></table></td></tr><tr bgcolor="#2274ac"><td  height="1"></td></tr><tr><td><p class="footer">Рассылка автоматическая отвечать не обязательно.</p></td></tr></table></td></tr></table></td></tr></table></body></html>';


        smtpmail($seting['mail'], 'Volkswagen Дать оценку', $mais, $headers);



    }





    }
    ?>

 <h1 style="text-align: center;margin-top: 50px;">Благодарим за участие в опросе!</h1>
<h2 style="text-align: center;margin-bottom: 50px;">Ваше обращение принято и находится на контроле у руководства компании.</h2>
<meta HTTP-EQUIV='Refresh' CONTENT='3; URL=/book_reviews/'>
<?}else{?>

<div class="heder_page"><a class="heder_page_name" href="/book_reviews/">Электронная Книга Отзывов и предложений</a></div>
<div class="bl_br" rel='1'><h2>ДАТЬ ОЦЕНКУ</h2> <span>работы служб автоцентра</span></div>
<div class="bl_br" rel='2'><h2>ДАТЬ ПРЕДЛОЖЕНИЕ</h2><span> по работе служб автоцентра</span></div>
<div class="bl_br" rel='3'><h2>ПОТРЕБОВАТЬ</h2> <span>СВЯЗАТЬСЯ С ВАМИ</span></div>
<div class="bl_br" rel='4'><h2>ЗАПОЛНИТЬ</h2> <span>Анкету удовлетворенности</span> </div>
<ul class="uk_ft_li">
<li id="for_id_li1" rel='1'>ДАТЬ ОЦЕНКУ</li>
<li id="for_id_li2" rel='2'>ДАТЬ ПРЕДЛОЖЕНИЕ</li>
<li id="for_id_li3" rel='3'>ПОТРЕБОВАТЬ</li>
<li id="for_id_li4" rel='4'>ЗАПОЛНИТЬ</li>
</ul>

<span class="for_id_close"></span>
<div id="for_id1" class="for_id_l">
<form class="formV" method="post" enctype="multipart/form-data" action="/book_reviews/form_post/">
<input type="hidden" value="1" name="form" />
<table border="0" style="width: 100%;margin: 20px 0 20px 0;">
<tr><td rowspan="5" style="width: 420px;"><div class="heder_page_name">Чем Вы остались НЕДОВОЛЬНЫ в работе Автоцентра</div><textarea name="text1"></textarea></td>
<td class="heder_page_name" style="text-align: center; float: none;">Представьтесь</td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">ФИО<span class="heder_page_name_red">*</span>:<input type="text" name="name" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Город<span class="heder_page_name_red">*</span>:<input type="text" name="city" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Организация:<input type="text" name="org" /></label></td></tr>
<tr><td></td></tr>
<tr><td rowspan="5"><div class="heder_page_name">Что Вам ПОНРАВИЛОСЬ в работе Автоцентра / кому Вы хотели бы выразить БЛАГОДАРНОСТЬ:</div><textarea name="text2"></textarea></td>
<td class="heder_page_name" style="text-align: center; float: none;">Как с вами связаться?</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Телефон<span class="heder_page_name_red">*</span>:<input type="text" name="phone" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Адрес:<input type="text" name="adres" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">E-mail:<input type="text" name="mail" /></label></td></tr>
<tr><td></td></tr>
<tr><td colspan="2">
<div class="heder_page_name grade" >Насколько в целом Вы удовлетворены нашей работой?<span class="heder_page_name_red">*</span>:</div>
<div class="cl"></div>
<p><label class="heder_model_s"><input type="radio" name="grade" value="5" />В высшей степени доволен</label></p>
<p><label class="heder_model_s"><input type="radio" name="grade" value="4" />Очень доволен</label></p>
<p><label class="heder_model_s"><input type="radio" name="grade" value="3" />Вполне доволен</label></p>
<p><label class="heder_model_s"><input type="radio" name="grade" value="2" />Не очень доволен</label></p>
<p><label class="heder_model_s"><input type="radio" name="grade" value="1" />Совсем не доволен</label></p>
</td></tr>
<tr><td colspan="2"><input type="submit" class="link_d" value="Отправить оценку администрации" /></td></tr>
</table>
<div class="cl"></div>
</form>
</div>


<div id="for_id2" class="for_id_l">
<form>
<table border="0" style="width: 100%;margin: 20px 0 0 0;">
<tr>
<td rowspan="10" style="width: 420px;"><div class="heder_page_name">Предложение:</div><textarea style="height: 203px;"></textarea></td>
<td class="heder_page_name" style="text-align: center; float: none;">Представьтесь</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">ФИО<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Город<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Организация:<input type="text" /></label></td></tr>
<tr><td></td></tr>
<td class="heder_page_name" style="text-align: center; float: none;">Как с вами связаться?</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Телефон<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Адрес:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">E-mail:<input type="text" /></label></td></tr>
<tr><td></td></tr>
<tr><td colspan="2">
<div class="heder_page_name">Насколько в целом Вы удовлетворены нашей работой?<span class="heder_page_name_red">*</span>:</div><div class="cl"></div>
<p><label class="heder_model_s"><input type="radio" />В высшей степени доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Очень доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Вполне доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Не очень доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Совсем не доволен</label></p>
</td></tr>
<tr><td colspan="2"><input type="submit" class="link_d" value="Отправить оценку администрации" /></td></tr>

</table>
<div class="cl"></div>
</form>
</div>


<div id="for_id3" class="for_id_l">
<form>
<table border="0" style="width: 100%;margin: 20px 0 0 0;">
<tr>
<td rowspan="10" style="width: 420px;"><div class="heder_page_name">Тема:</div><textarea style="height: 203px;"></textarea></td>
<td class="heder_page_name" style="text-align: center; float: none;">Представьтесь</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">ФИО<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Город<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Организация:<input type="text" /></label></td></tr>
<tr><td></td></tr>
<td class="heder_page_name" style="text-align: center; float: none;">Как с вами связаться?</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Телефон<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Адрес:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">E-mail:<input type="text" /></label></td></tr>
<tr><td></td></tr>
<tr><td colspan="2">
<div class="heder_page_name">Насколько в целом Вы удовлетворены нашей работой?<span class="heder_page_name_red">*</span>:</div><div class="cl"></div>
<p><label class="heder_model_s"><input type="radio" />В высшей степени доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Очень доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Вполне доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Не очень доволен</label></p>
<p><label class="heder_model_s"><input type="radio" />Совсем не доволен</label></p>
</td></tr>
<tr><td colspan="2"><input type="submit" class="link_d" value="Отправить оценку администрации" /></td></tr>

</table>
<div class="cl"></div>
</form>
</div>

<div id="for_id4" class="for_id_l" >
<h1 style="text-align: center;">Пожалуйста выберите анкету</h1>
<div class="bl_brs" rel='5'><h2>Продажа автомобилей</h2></div>
<div class="bl_brs" rel='6'><h2>Услуги СТО</h2></div>
<div class="cl"></div>
</div>


<div id="for_id5" class="for_id_l">
<form>
<table border="0" style="width: 550px;margin: 20px 0 0 0;">
<tr>
<td class="heder_page_name" style="text-align: left; float: none;">Представьтесь</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">ФИО<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Город<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Организация:<input type="text" /></label></td></tr>
<tr><td></td></tr>
<td class="heder_page_name" style="text-align: left; float: none;">Как с вами связаться?</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Телефон<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Адрес:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">E-mail:<input type="text" /></label></td></tr>
</table>
</form>
</div>


<div id="for_id6" class="for_id_l">
<form>
<table border="0" style="width: 550px;margin: 20px 0 0 0;">
<tr>
<td class="heder_page_name" style="text-align: left; float: none;">Представьтесь</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">ФИО<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Город<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Организация:<input type="text" /></label></td></tr>
<tr><td></td></tr>
<td class="heder_page_name" style="text-align: left; float: none;">Как с вами связаться?</td>
</tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Телефон<span class="heder_page_name_red">*</span>:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">Адрес:<input type="text" /></label></td></tr>
<tr><td style="text-align: right;"><label class="heder_model_s">E-mail:<input type="text" /></label></td></tr>
</table>
</form>
</div>
<?}?>
