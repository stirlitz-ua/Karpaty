<?php
if(isset($_GET['action']) && $_GET['action'] == "out") out(); //если передана переменная action, «разавторизируем» пользователя
		if (login()) //вызываем функцию login, определяющую, авторизирован юзер или нет
		{
		$db=new mysql_conns ();
		 $bon=$db->my_mysql_select ('SELECT SUM(NumberOfPoints) FROM  documents WHERE CustomerCode="'.$_SESSION['сustomer_сode'] .'"   '); 		
                        
if ($bon[0][0]=='') { $bon[0][0]=0;} 						$_SESSION['bonus_all'] = $bon[0][0] ;
		}
		else //если пользователь не авторизирован, то проверим, была ли нажата кнопка входа на сайт
		{
			if(isset($_POST['log_in'])) 
			{
				$error = enter(); //функция входа на сайт
				echo $error;
				if (count($error) == 0) //если нет ошибок, авторизируем юзера
				{
				
				}
				
			} 
		}

?>