<?php

				function login () { 	
						
					if (isset($_SESSION['id_user'])) //если сесcия есть 	
								{ 		
									return true; 		
								}  		else { return false; 		}
					
				}		

				function admin ($id) { 	
						
					if (isset($id)) //если сесcия есть 	
						{	$db=new mysql_conns (); // конект к базе 
						$sqlres=$db->my_mysql_select( 'SELECT admin FROM user WHERE id_user = "'.$id.'"' );  
									if ($sqlres[0]['admin']==1) { 
									 $_SESSION['admin'] ='admin';
									return true; } else { return false; 		}
						}
					
				}

	

function out () { 	
if (isset($_SESSION['id_user'])) {
$id = $_SESSION['id_user'];			 	

$db=new mysql_conns (); // конект к базе 
	$rez=$db->my_mysql_select ('UPDATE user SET onli=0 WHERE id_user="'.$id.'" ');
	                                      
			  session_destroy();
		
}

}



















function lastAct($id)
{ 	$tm = time(); 	
	$db=new mysql_conns (); // конект к базе 
	$rez=$db->my_mysql_select ('UPDATE user SET onli=1, last_act="'.$tm.'"   WHERE id_user="'.$id.'" '); //запрашиваем строку из БД с логином, введённым пользователем 		
					
}


function enter ()
 { 
$error = ''; //для ошибок 	
if ($_POST['login'] != "" && $_POST['password'] != "") //если поля заполнены 	

{ 		
				$login=mysql_escape_string(htmlspecialchars(stripslashes($_POST['login'])));
				$password=mysql_escape_string(htmlspecialchars(stripslashes($_POST['password'])));
					
					if (!( $login=='') && preg_match('/^[0-9a-zA-Z_\-\.]+@[0-9a-z_^\.]+\.[a-z]{2,6}$/i', $login)) 
					 { $validloginl=1; } else { $validloginl=0; }
					 if ($password!=='' && preg_match('/^[0-9a-zA-Z_\-\.]{4,50}/i', $password) ) 
								  { $validpass=1; } else  { $validpass=0; }
				  
						if ($validloginl==1 && $validpass==1)  	 {
							 $_SESSION['login'] = $login ; 
							$_SESSION['password'] = $password ;

					$db=new mysql_conns (); // конект к базе 
					$rez=$db->my_mysql_select ('SELECT * FROM user WHERE email="'.$login.'" AND pass="'.$password.'"  '); //запрашиваем строку из БД с логином, введённым пользователем 		
                         
						 
	if (count($rez) == 1) //если нашлась одна строка, значит такой юзер существует в БД 		

	{ 			
	$bon=$db->my_mysql_select ('SELECT SUM(NumberOfPoints) FROM  documents WHERE CustomerCode="'.$rez[0]['сustomer_сode'].'"   '); 		
     if ($bon[0][0]=='') { $bon[0][0]=0;} 		
			$_SESSION['first_name'] = $rez[0]['first_name'] ; 
                         $_SESSION['name'] = $rez[0]['name'] ; 
                         $_SESSION['сustomer_сode'] = $rez[0]['сustomer_сode'] ; 
                         $_SESSION['father_name'] = $rez[0]['father_name'] ; 
                         
						 $_SESSION['bonus_all'] = $bon[0][0] ; 
                        
						if (!isset($_SESSION['menu'])) { $_SESSION['menu'] = 1; }			
			 $_SESSION['id_user']= $rez[0]['id_user'] ;	//записываем в сессию id пользователя 				
			
			lastAct($_SESSION['id_user']); 
			admin($_SESSION['id_user']);				
			
			
			
			
			return $error; 			
	
	} 		
	else //если такого пользователя не найдено в БД 		

	{ 			
		$error = "Неверный логин и пароль"; 			
		return $error; 		
	} 	
} 	else //если    если даніе не прошли валидацию 		

	{ 			
		$error = "Не корректные данные"; 			
		return $error; 		
	} 	
 
 }

	else 	
	{ 		
		$error = "Поля не должны быть пустыми!"; 				
		return $error; 	
	} 

}



?>