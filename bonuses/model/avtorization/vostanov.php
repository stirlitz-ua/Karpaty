<?php
	header("Content-type: text/html; charset=utf-8");
			require_once ($_SERVER['DOCUMENT_ROOT'].'/bonuses/model/system/config.php');
		if (isset ($_POST['email']) ) {
            $login=mysql_escape_string(htmlspecialchars(stripslashes($_POST['email'])));
				if ($_POST['email']!==''  && preg_match('/^[0-9a-zA-Z_\-\.]+@[0-9a-z_^\.]+\.[a-z]{2,6}$/i', $login) )  {
					$db=new mysql_conns ();
					$sqlres=$db->my_mysql_select( 'SELECT first_name,	name,	father_name, pass FROM user WHERE email = "'.$_POST['email'].'"' );   
						if (isset ($sqlres) && count($sqlres)==1) {

						$to  = $_POST['email']; 
						$subject = "Востановление доступа к аккаунту на сайте " .$_SERVER['HTTP_HOST']; 
									  $message = 
										"Здравствуйте." .$sqlres[0]['first_name']." ".$sqlres[0]['name']." ".$sqlres[0]['father_name']." 
										Данное письмо сгенерировано автоматически. Отвечать на него не нужно.
										Вы (или кто-то иной) подали запрос на востановление пароля от аккаунта " .$_POST['email']. " на сайте " .$_SERVER['HTTP_HOST']."'.
										Имя аккаунта: ".$_POST['email'].
									   " Пароль: ".$sqlres[0]['pass']."
										 Если это не Вы желали востановить пароль , то просто удалите данное письмо.
									   С уважением   Администрация"; 
											$headers= "MIME-Version: 1.0\r\n";
											 $headers .= "Content-type: text/html; charset=utf-8\r\n";
											 $headers .= "From: <admin@avto.com>\r\n";
								
								
								if (mail($to, $subject, $message, $headers)==1){	
								 echo 'На указанный email отправлено письмо востановления доступа к аккаунту.'; 
								 }	else { 
								 echo 'Приносим извинения, не получилось отправить на ваш email письмо востановления доступа к аккаунту. Пожалуйста заново повторите попытку востановления.';
								}	
						} else {    echo 'Пользователь с такием  email не найден ';   }		
							
						
				} else { echo 'Не правельный email';}
		}

?>
