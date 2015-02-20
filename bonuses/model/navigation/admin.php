<?php
			header("Content-type: text/html; charset=utf-8");
			                
			require_once ($_SERVER['DOCUMENT_ROOT'].'/bonuses/model/system/config.php');
				

			echo '<span class="text-size">Админ панель</span></br>';
			echo '<span class="text-size">Изменения информации пользователя</span></br>';
			
				if (isset($_POST['ID']) ) {
				if ( $_POST['ID']!=='' && $_POST['ID']!=='ID' && $_POST['ID']>0 ) {
				$db=new mysql_conns ();
					$sqlres=$db->my_mysql_select( 'SELECT first_name,	name,	father_name FROM user WHERE id_user = "'.$_POST['ID'].'"' );   
						if (count($sqlres)==1) {	$y=0;			
							if ( $_POST['first_name']!=='' && $_POST['first_name']!=='Фамилия'  ) {							$rez=$db->my_mysql_select ('UPDATE user SET first_name="'.$_POST['first_name'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['name']!=='' && $_POST['name']!=='Имя'  ) {												$rez=$db->my_mysql_select ('UPDATE user SET name="'.$_POST['name'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['father_name']!=='' && $_POST['father_name']!=='Отчество'  ) {				$rez=$db->my_mysql_select ('UPDATE user SET father_name="'.$_POST['father_name'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}	
							    if ( $_POST['pass']!=='' && $_POST['pass']!=='Пароль'  ) {											$rez=$db->my_mysql_select ('UPDATE user SET pass="'.$_POST['pass'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['email']!=='' && $_POST['email']!=='Емаил'  ) {											$rez=$db->my_mysql_select ('UPDATE user SET email="'.$_POST['email'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['phone']!=='' && $_POST['phone']!=='Телефон'  ) {										$rez=$db->my_mysql_select ('UPDATE user SET phone="'.$_POST['phone'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['birthdey']!=='' && $_POST['birthdey']!=='День рождения'  ) {							$rez=$db->my_mysql_select ('UPDATE user SET birthdey="'.$_POST['birthdey'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['state']!=='' && $_POST['state']!=='Страна'  ) { 											$rez=$db->my_mysql_select ('UPDATE user SET state="'.$_POST['state'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['region']!=='' && $_POST['region']!=='Регион'  ) {											$rez=$db->my_mysql_select ('UPDATE user SET region="'.$_POST['region'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['garden']!=='' && $_POST['garden']!=='Город'  ) {										$rez=$db->my_mysql_select ('UPDATE user SET garden="'.$_POST['garden'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['strit']!=='' && $_POST['strit']!=='Улица'  ) {													$rez=$db->my_mysql_select ('UPDATE user SET strit="'.$_POST['strit'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								if ( $_POST['сustomer_сode']!=='' && $_POST['сustomer_сode']!=='ID_u_bonus'  ) {	$rez=$db->my_mysql_select ('UPDATE user SET сustomer_сode="'.$_POST['сustomer_сode'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}	
							if ( $_POST['note']!=='' && $_POST['note']!=='Коментарий'  ) {											$rez=$db->my_mysql_select ('UPDATE user SET note="'.$_POST['note'].'"   WHERE id_user="'.$_POST['ID'].'" '); 		
							$y++;}
								
								
								
								
								if ( $y>0 ) {
								echo 'Изменения для пользователь с ID: '.$_POST['ID'].' вступили в силу.';
								} else  { echo 'Изменения для пользователь с ID: '.$_POST['ID'].' не указаны.';}
						} else { echo 'Пользователь с ID: '.$_POST['ID'].' не найден.'; }
				} else { echo 'Не правильный ID  пользователя.'; }
				} 
			
			
			
			
			if (isset($_POST['reg']) && $_POST['reg']==true ) {
			
			
			
								if ( $_POST['first_name']=='' || $_POST['first_name']=='Фамилия'  ) {  $_POST['first_name']='';} else {  $_POST['first_name']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['first_name']))); }
								if ( $_POST['name']=='' || $_POST['name']=='Имя'  )  { $_POST['name']=''; }  else {  $_POST['name']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['name']))); }
								if ( $_POST['father_name']=='' || $_POST['father_name']=='Отчество'  )  { $_POST['father_name']=''; } else {  $_POST['father_name']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['father_name']))); }
							    if ( $_POST['pass']=='' || $_POST['pass']=='Пароль'  )  { $_POST['pass']=''; } else {  $_POST['pass']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['pass']))); }
								if ( $_POST['email']=='' || $_POST['email']=='Емаил'  )  { $_POST['email']=''; } else {  $_POST['email']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['email']))); }
								if ( $_POST['phone']=='' || $_POST['phone']=='Телефон'  )  { $_POST['phone']=''; } else {  $_POST['phone']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['phone']))); }
								if ( $_POST['birthdey']=='' || $_POST['birthdey']=='День рождения'  )  { $_POST['birthdey']=''; } else {  $_POST['birthdey']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['birthdey']))); }
								if ( $_POST['state']=='' || $_POST['state']=='Страна'  )  { $_POST['state']=''; } else {  $_POST['state']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['state']))); }
								if ( $_POST['region']=='' || $_POST['region']=='Регион'  )  { $_POST['region']=''; } else {  $_POST['region']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['region']))); }
								if ( $_POST['garden']=='' || $_POST['garden']=='Город'  )  { $_POST['garden']=''; } else {  $_POST['garden']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['garden']))); }
								if ( $_POST['strit']=='' || $_POST['strit']=='Улица'  ) { $_POST['strit']=''; } else {  $_POST['strit']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['strit']))); }
								if ( $_POST['сustomer_сode']=='' || $_POST['сustomer_сode']=='ID_u_bonus'  ) { $_POST['сustomer_сode']=''; } else {  $_POST['сustomer_сode']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['сustomer_сode']))); }
								if ( $_POST['note']=='' || $_POST['note']=='Коментарий'  )  { $_POST['note']=''; } else {  $_POST['note']=mysql_escape_string(htmlspecialchars(stripslashes($_POST['note']))); }
							
							
							
			
			
			
		
			
				$db=new mysql_conns ();
				$db->my_mysql_select (' INSERT INTO user (first_name , name , father_name , pass , email ,  phone 
													,birthdey , state , region , garden , strit  ,note , сustomer_сode , data_reg	) VALUES (
				"'.$_POST['first_name'].'", "'.$_POST['name'].'" ,"'.$_POST['father_name'].'", "'.$_POST['pass'].'",
				"'.$_POST['email'].'","'.$_POST['phone'].'","'.$_POST['birthdey'].'","'.$_POST['state'].'","'.$_POST['region'].'",
				"'.$_POST['garden'].'","'.$_POST['strit'].'", "'.$_POST['note'].'","'.$_POST['сustomer_сode'].'" ,
				"'.date("Y.m.d / H:i:s").'"  )  '); 	
				echo 'Клиент зарегистрирован.';
			}
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
				if (isset($_POST['id_user']) && $_POST['admin'] =='admin') {
					$db=new mysql_conns ();
				    $sqlres=$db->my_mysql_select( 'SELECT * FROM user  ' );   
					
				}	
						
	?>
		<div class="admin_menu">
			<div onclick="openBlock(this);" class="toggle"><center><p style="color:#fff">Изменения клиента</p></center></div>
														<div class="this_block_is_hidden">
															<form id="yare"   name="yare"> 
															<input name="ID"  id="ID"  style="width: 155px;" type="text" value="ID"  maxlength="11" onfocus="if (this.value=='ID') this.value='';"onblur="if (this.value==''){this.value='ID'}"/><br />
															<input name="first_name" id="first_name"  style="width: 155px;" type="text" value="Фамилия"  maxlength="100" onfocus="if (this.value=='Фамилия') this.value='';"onblur="if (this.value==''){this.value='Фамилия'}"/><br />
															<input name="name" id="name"  style="width: 155px;" type="text" value="Имя"  maxlength="100" onfocus="if (this.value=='Имя') this.value='';"onblur="if (this.value==''){this.value='Имя'}"/><br />
															<input name="father_name" id="father_name"  style="width: 155px;" type="text" value="Отчество"  maxlength="100" onfocus="if (this.value=='Отчество') this.value='';"onblur="if (this.value==''){this.value='Отчество'}"/><br />
															<input name="pass" id="pass"  style="width: 155px;" type="text" value="Пароль"  maxlength="100" onfocus="if (this.value=='Пароль') this.value='';"onblur="if (this.value==''){this.value='Пароль'}"/><br />
															<input name="email" id="email"  style="width: 155px;" type="text" value="Емаил"  maxlength="100" onfocus="if (this.value=='Емаил') this.value='';"onblur="if (this.value==''){this.value='Емаил'}"/><br />
															<input name="phone" id="phone"  style="width: 155px;" type="text" value="Телефон"  maxlength="100" onfocus="if (this.value=='Телефон') this.value='';"onblur="if (this.value==''){this.value='Телефон'}"/><br />
															<input name="birthdey" id="birthdey"  style="width: 155px;" type="text" value="День рождения"  maxlength="100" onfocus="if (this.value=='День рождения') this.value='';"onblur="if (this.value==''){this.value='День рождения'}"/><br />
															<input name="state" id="state"  style="width: 155px;" type="text" value="Страна"  maxlength="100" onfocus="if (this.value=='Страна') this.value='';"onblur="if (this.value==''){this.value='Страна'}"/><br />
															<input name="region" id="region"  style="width: 155px;" type="text" value="Регион"  maxlength="100" onfocus="if (this.value=='Регион') this.value='';"onblur="if (this.value==''){this.value='Регион'}"/><br />
															<input name="garden" id="garden"  style="width: 155px;" type="text" value="Город"  maxlength="100" onfocus="if (this.value=='Город') this.value='';"onblur="if (this.value==''){this.value='Город'}"/><br />
															<input name="strit" id="strit"  style="width: 155px;" type="text" value="Улица"  maxlength="100" onfocus="if (this.value=='Улица') this.value='';"onblur="if (this.value==''){this.value='Улица'}"/><br />
															<input name="note" id="note"  style="width: 155px;" type="text" value="Коментарий"  maxlength="300" onfocus="if (this.value=='Коментарий') this.value='';"onblur="if (this.value==''){this.value='Коментарий'}"/><br />
															<input name="сustomer_сode" id="сustomer_сode"  style="width: 155px;" type="text" value="ID_u_bonus"  maxlength="10" onfocus="if (this.value=='ID_u_bonus') this.value='';"onblur="if (this.value==''){this.value='ID_u_bonus'}"/><br />
															<input type="button" onclick="yare_do(1);" value="Изменить" />
															</form>
														</div>										
		</div>
				





	<div class="admin_reg">
			<div onclick="openBlock(this);" class="toggle"><center><p style="color:#fff">Регистрация клиента</p></center></div>
														<div class="this_block_is_hidden">
															<form id="reg"   name="reg"> 
															<input name="r_first_name" id="r_first_name"  style="width: 155px;" type="text" value="Фамилия"  maxlength="100" onfocus="if (this.value=='Фамилия') this.value='';"onblur="if (this.value==''){this.value='Фамилия'}"/><br />
															<input name="r_name" id="r_name"  style="width: 155px;" type="text" value="Имя"  maxlength="100" onfocus="if (this.value=='Имя') this.value='';"onblur="if (this.value==''){this.value='Имя'}"/><br />
															<input name="r_father_name" id="r_father_name"  style="width: 155px;" type="text" value="Отчество"  maxlength="100" onfocus="if (this.value=='Отчество') this.value='';"onblur="if (this.value==''){this.value='Отчество'}"/><br />
															<input name="r_pass" id="r_pass"  style="width: 155px;" type="text" value="Пароль"  maxlength="100" onfocus="if (this.value=='Пароль') this.value='';"onblur="if (this.value==''){this.value='Пароль'}"/><br />
															<input name="r_email" id="r_email"  style="width: 155px;" type="text" value="Емаил"  maxlength="100" onfocus="if (this.value=='Емаил') this.value='';"onblur="if (this.value==''){this.value='Емаил'}"/><br />
															<input name="r_phone" id="r_phone"  style="width: 155px;" type="text" value="Телефон"  maxlength="100" onfocus="if (this.value=='Телефон') this.value='';"onblur="if (this.value==''){this.value='Телефон'}"/><br />
															<input name="r_birthdey" id="r_birthdey"  style="width: 155px;" type="text" value="День рождения"  maxlength="100" onfocus="if (this.value=='День рождения') this.value='';"onblur="if (this.value==''){this.value='День рождения'}"/><br />
															<input name="r_state" id="r_state"  style="width: 155px;" type="text" value="Страна"  maxlength="100" onfocus="if (this.value=='Страна') this.value='';"onblur="if (this.value==''){this.value='Страна'}"/><br />
															<input name="r_region" id="r_region"  style="width: 155px;" type="text" value="Регион"  maxlength="100" onfocus="if (this.value=='Регион') this.value='';"onblur="if (this.value==''){this.value='Регион'}"/><br />
															<input name="r_garden" id="r_garden"  style="width: 155px;" type="text" value="Город"  maxlength="100" onfocus="if (this.value=='Город') this.value='';"onblur="if (this.value==''){this.value='Город'}"/><br />
															<input name="r_strit" id="r_strit"  style="width: 155px;" type="text" value="Улица"  maxlength="100" onfocus="if (this.value=='Улица') this.value='';"onblur="if (this.value==''){this.value='Улица'}"/><br />
															<input name="r_note" id="r_note"  style="width: 155px;" type="text" value="Коментарий"  maxlength="300" onfocus="if (this.value=='Коментарий') this.value='';"onblur="if (this.value==''){this.value='Коментарий'}"/><br />
															<input name="r_сustomer_сode" id="r_сustomer_сode"  style="width: 155px;" type="text" value="ID_u_bonus"  maxlength="10" onfocus="if (this.value=='ID_u_bonus') this.value='';"onblur="if (this.value==''){this.value='ID_u_bonus'}"/><br />
															<input type="button" onclick="yare_do(2);" value="Зарегистрировать" />
															</form>
														</div>										
		</div>








														
														
														
														<div class="admin_xml">
															<div onclick="openBlock2(this);" class="toggle"><center><p style="color:#fff">Загрузка файла .xml</p></center></div>
														<div class="this_block_is_hidden2">
														
													<form action='/' method='post' enctype='multipart/form-data'>
													<input type='file' name='uploadfile'>
													<input type='submit' name='xml_download' value='Загрузить' ></form>
														</div>	
														</div>	
	
<table class="table table-bordered table-hover">
    <tr>
        <td>№</td>
        <td>ID</td>
        <td>Фамилия</td>
        <td>Имя</td>
        <td>Отчество</td>
        <td>Пароль</td>
        <td>Емаил</td>
        <td>Бонусы</td>
        <td>Телефон</td>
        <td>День рождения</td>
        <td>Страна</td>
        <td>Регион</td>
        <td>Город</td>
        <td>Улица</td>
        <td>Активность</td>
        <td>Онлайн</td>
        <td>Коментарий</td>
        <td>ID_user_bonus</td>
        <td>Дата регистрации</td>
    </tr>
    <?php
	if ( isset ($sqlres) && count($sqlres>0)) {
		$y=1;	
		
		for ($i = 0; $i < count($sqlres); $i++) { 
			echo '<tr><td>'.$y.'</td>';$y++; 
				  for ($j= 0; $j< 19; $j++) {
				  if ($j==17) { continue; }
				  
				  if ($j==13) {
				   echo '<td>'.date('d.m.Y h:i:s', $sqlres[$i][$j]).'</td>';
				  
				  } else {
				  echo '<td>'.$sqlres[$i][$j].'</td>'; }
				  }
			echo '</tr>'; 	  
		}
	}
	?>
</table>

