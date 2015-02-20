<?php
                 			
header("Content-type: text/html; charset=utf-8"); 

require_once ($_SERVER['DOCUMENT_ROOT'].'/bonuses/model/system/config.php');
$db=new mysql_conns ();

if (isset($_POST['id_user']) && $_POST['id_user'] !=='') {
	$CustomerCode=$db->my_mysql_select( 'SELECT сustomer_сode FROM user WHERE id_user="'.$_POST['id_user'].'"  ' );
	$sqlres=$db->my_mysql_select( 'SELECT DISTINCT `Model`,`RegistrationNumber` FROM documents WHERE CustomerCode="'.$CustomerCode['0']['сustomer_сode'].'" GROUP BY `Model`' );
	if (count($sqlres)>1){
		echo "<h5>Выберите вашу машину: ";
		foreach($sqlres as $car) {
			echo '<a href="?car='.$car['Model'].'">'.$car['Model'].' ('.$car['RegistrationNumber'].')</a> &nbsp;  &nbsp; ';
		}
		echo "</h5>";
	}
}

$car = urldecode(addslashes(htmlspecialchars($_POST['car'])));
if (strlen($car)){
	
	echo '<legend>История ТО (Volkswagen '.$car.')</legend>';
		if (isset($_POST['id_user']) && $_POST['id_user'] !=='') {
			$CustomerCode=$db->my_mysql_select( 'SELECT сustomer_сode FROM user WHERE id_user="'.$_POST['id_user'].'"  ' );   
			//$sqlres=$db->my_mysql_select( 'SELECT * FROM documents WHERE CustomerCode="'.$CustomerCode['0']['сustomer_сode'].'"  GROUP BY `Zayavka`' );
			$sqlres=$db->my_mysql_select( 'SELECT DISTINCT * FROM documents WHERE CustomerCode="'.$CustomerCode['0']['сustomer_сode'].'" AND `Model` LIKE \''.$car.'\' GROUP BY `Zayavka`' );
		}

	foreach($sqlres as $zayavka){
		printDocs($zayavka, $CustomerCode['0']['сustomer_сode'], rand(1,1000));
	}

}else{




}
	
	function printDocs($zayavka, $userId, $rand){
			require_once ($_SERVER['DOCUMENT_ROOT'].'/bonuses/model/system/config.php');
			
			echo '<div style="margin-bottom:50px;">';
			
			echo "<table class='table table-bordered table-hover'>
				<tr class='title'>
					<td>Дата</td>
					<td>Вид</td>
					<td>Документ</td>
					<td>Пробег</td>
					<td>Сумма</td>
					<td>Начис. Бонус.</td>
					<td>Комментарий</td>
				</tr>

				<tr style='font-size: 90%;'>
					<td>{$zayavka['ZayavkaPeriod']}</td>
					<td>{$zayavka['TypeOfBonus']}</td>
					<td><center>Заявка номер: {$zayavka['Zayavka']}<BR>{$zayavka['CustomerName']}</center></td>
					<td>{$zayavka['Probeg']}</td>
					<td>{$zayavka['SumDocument']}</td>
					<td>{$zayavka['NumberOfPoints']}</td>
					<td>{$zayavka['Recommendations']}</td>
				</tr>				
			</table>";
			
			$zNumber = $zayavka["Zayavka"];
			
			$db=new mysql_conns ();
			$sqlres=$db->my_mysql_select( 'SELECT * FROM documents WHERE CustomerCode="'.$userId.'"  AND `Zayavka` = "'.$zNumber.'" GROUP BY `Zayavka`' );
			if ( isset ($sqlres) && count($sqlres)>0) {
				$y=1;	
					?>
				<table class="table table-bordered table-hover bonusestable" style="margin-top: -21px;width: 100%;">
					<!--<tr class="title">
						<td>&nbsp;</td>
						<td>№</td>
						<td>Документ</td>
						<td>Номер документа</td>
						<td>Период документа</td>
						<td>Истечение документа</td>
						<td>Заявка</td>
						<td>Период заявки</td>
						<td>Код клиента</td>
						<td>Имя клиента</td>
						<td>Рекомендации</td>
						<td>VIN</td>
						<td>Бренд</td>
						<td>Модель</td>
						<td>Номер регистрации</td>
						<td>Номер карти</td>
						<td>Тип бонуса</td>
						<td>Сумма</td>
						<td>Число точек</td>
						<td>Статус</td>

					</tr>-->
    <?php
					for ($i = 0; $i < count($sqlres); $i++) {
    ?> 
						<tr   class="detal title" id="<?php  echo 'a_dok'.$i; ?>" onclick="showClose('<?php  echo 'dok'.$rand.$i; ?>'); return false;" style='font-size: 90%;' >
						
						<td> <a><nobr><span class="glyphicon glyphicon-plus"></span>Детальнее</nobr></a>
						
						<?php 
						
						echo '</td><!--<td>'.$y.'</td>-->';
						$y++; 
						
						//for ($j = 1; $j < 19; $j++) {  
							echo '<td>Наряд Заказ: '.$sqlres[$i]['DocumentNumber'].'</td>';
							echo '<td>'.$sqlres[$i]['DocumentPeriod'].'</td>';
							echo '<td>Итого: '.$sqlres[$i]['SumDocument'].' грн.</td>';
						//}
	?> 
						</tr>
						<tr class="<?php echo 'dok'.$rand.$i; ?> " style='display: none;'>
							<td colspan="20">
	<?php   
								$TableGoods=$db->my_mysql_select( 'SELECT * FROM  TableGoods WHERE DocumentNumber="'.$sqlres[$i]['DocumentNumber'].'"  ' );  
								if ( isset ($TableGoods) && count($TableGoods)>0 ) {
    ?>
									<a  id="<?php  echo 'a_good'.$rand.$i; ?>" onclick="showGood('<?php  echo 'good'.$rand.$i; ?>'); return false;"><button type="button" class="btn btn-primary">Покупки</button></a>
								
									<table class="table table-striped">
										<tr class="<?php echo 'good'.$rand.$i; ?> title" > 
											
			<!--№	Наименование	Вид операции	Ед. изм.	Кол-во	Цена без НДС	Сумма скидки	Сумма НДС	Итого	-->

											<td>№</td>
											<!--<td> </td>-->
											<!--<td>Номер рядка</td>-->
											<td>Имя</td>
											<!--<td>Код</td>-->
											<td>Тип операции</td>
											<!--<td>Оriginal</td>-->
											<td>Единица измерения</td>
											<td>Количество</td>
											<td>Цена без НДС</td>
											<!--<td>Цена c НДС</td>-->
											<!--<td>Сума без НДС</td>-->
											<!--<td>Сума c НДС</td>-->
											<td>Сума НДС</td>
											<!--<td>Скидка</td>-->
											<td>Размер скидки</td>
											<!--<td>Цена без НДС и скидки</td>-->
											<!--<td>Цена с НДС без скидки</td>-->

											<td>Итого</td>
										</tr>
							  <?php
					$good_num=1;
					for ($e = 0; $e < count($TableGoods); $e++) {
					?>
						<tr class="<?php echo 'good'.$rand.$i; ?> " > <?php 
						//for ($j= 5; $j< 18; $j++) {  
							echo '<td>'. $good_num .'</td>'; 	
							echo '<td>'.$TableGoods[$e]['Name'].'</td>'; 	
							echo '<td>'.$TableGoods[$e]['TransactionType'].'</td>'; 	
							echo '<td>'.$TableGoods[$e]['UnitOfMeasurement'].'</td>'; 	
							echo '<td>'.$TableGoods[$e]['Amount'].'</td>'; 	
							echo '<td>'.$TableGoods[$e]['PriceWithouTax'].'</td>'; 	
							echo '<td>'.$TableGoods[$e]['SumTax'].'</td>'; 	
							echo '<td>'.$TableGoods[$e]['AmoutOfDiscount'].'</td>'; 	
							echo '<td>'. ($TableGoods[$e]['PriceWithouTax']+$TableGoods[$e]['SumTax']-$TableGoods[$e]['AmoutOfDiscount']) .'</td>'; 	
						//} 
						$good_num++; 
						echo '</tr>';
					} ?> 					
					</table>
					<?php 
						}

						    $TableWork=$db->my_mysql_select( 'SELECT * FROM  TableWork WHERE DocumentNumber="'.$sqlres[$i]['DocumentNumber'].'"  ' );  
						if ( isset ($TableWork) && count($TableWork)>0) {
                    ?> <a  id="<?php  echo 'a_Work'.$i; ?>" onclick="showGood('<?php  echo 'Work'.$rand.$i; ?>'); return false;"><button type="button" class="btn btn-primary">Работы</button></a>
						<table class="table table-striped">
							<tr class="<?php echo 'Work'.$rand.$i; ?> title">
								<!--<td>№</td>
								<td> </td>
								<td>Номер рядка</td>
								<td>Тип операции</td>
								<td>Код</td>
								<td>Имя</td>
								<td>Оriginal</td>
								<td>Единица измерения</td>
								<td>Количество</td>
								<td>Цена без НДС</td>
								<td>Цена c НДС</td>
								<td>Сума без НДС</td>
								<td>Сума c НДС</td>
								<td>Сума НДС</td>
								<td>Скидка</td>
								<td>Размер скидки</td>
								<td>Цена без НДС и скидки</td>
								<td>Цена с НДС без скидки</td>-->
								
											<td>№</td>
											<!--<td> </td>-->
											<!--<td>Номер рядка</td>-->
											<td>Имя</td>
											<!--<td>Код</td>-->
											<td>Тип операции</td>
											<!--<td>Оriginal</td>-->
											<td>Единица измерения</td>
											<td>Количество</td>
											<td>Цена без НДС</td>
											<!--<td>Цена c НДС</td>-->
											<!--<td>Сума без НДС</td>-->
											<!--<td>Сума c НДС</td>-->
											<td>Сума НДС</td>
											<!--<td>Скидка</td>-->
											<td>Размер скидки</td>
											<!--<td>Цена без НДС и скидки</td>-->
											<!--<td>Цена с НДС без скидки</td>-->

											<td>Итого</td>								
							</tr>
							  <?php
							 	  $Work_num=1;
					for ($e = 0; $e < count($TableWork); $e++) {
						?>  <tr class="<?php echo 'Work'.$rand.$i; ?> "> <?php 
							//for ($j = 5; $j < 18; $j++) {  echo '<td>'.$TableWork[$e][$j].'</td>'; 		}
						//for ($j= 5; $j< 18; $j++) {  
							echo '<td>'. $Work_num .'</td>'; 	
							echo '<td>'.$TableWork[$e]['Name'].'</td>'; 	
							echo '<td>'.$TableWork[$e]['TransactionType'].'</td>'; 	
							echo '<td>'.$TableWork[$e]['UnitOfMeasurement'].'</td>'; 	
							echo '<td>'.$TableWork[$e]['Amount'].'</td>'; 	
							echo '<td>'.$TableWork[$e]['PriceWithouTax'].'</td>'; 	
							echo '<td>'.$TableWork[$e]['SumTax'].'</td>'; 	
							echo '<td>'.$TableWork[$e]['AmoutOfDiscount'].'</td>'; 	
							echo '<td>'. ($TableWork[$e]['PriceWithouTax']+$TableWork[$e]['SumTax']-$TableWork[$e]['AmoutOfDiscount']) .'</td>'; 	
						//}
						$Work_num++; 
						echo '</tr>';
						}
					?> 
						</table>
					<?php 
						}
						
						    $bonuses=$db->my_mysql_select( 'SELECT * FROM  bonuses WHERE DocumentNumber="'.$sqlres[$i]['DocumentNumber'].'"  ' );  
						if ( isset ($bonuses) && count($bonuses)>0) {
                    ?> <a  id="<?php  echo 'a_bonuses'.$i; ?>" onclick="showGood('<?php  echo 'bonuses'.$i; ?>'); return false;"><button type="button" class="btn btn-primary">Бонусы</button></a>
						<table class="table table-striped">
							<tr class="<?php echo 'bonuses'.$i; ?> title" > 
								<!--<td>№</td>-->
                                <td> </td>
                                <td>Период документа</td>
                                <td>Истечение документа</td>
                                <td>Заявка</td>
                                <td>Период заявки</td>
                                <td>Код клиента</td>
                                <td>Имя клиента</td>
                                <td>Рекомендации</td>
                                <td>VIN</td>
                                <td>Бренд</td>
                                <td>Модель</td>
                                <td>Номер регистрации</td>
                                <td>Номер карти</td>
                                <td>Тип бонуса</td>
                                <td>Сумма</td>
                                <td>Число точек</td>
                                <td>Статус</td>
							</tr>
					<?php
					$bonuses_num=1;
					for ($e = 0; $e < count($bonuses); $e++) { 
						?>  <tr class="<?php echo 'bonuses'.$i; ?> " > <?php echo '<td>'.$bonuses_num.'</td>';$bonuses_num++; 
						for ($j= 2; $j< 18; $j++) {  echo '<td>'.$bonuses[$e][$j].'</td>'; 		}
						}
					?> 
						</table>
					<?php 
						}
						?>
						
						
						
						
				</td></tr><?php 	  
					}
			?>
			</table>	
	<?php 
			} else { echo 'Вы не получали бонусы :('; }
			
			echo '</div>';
	}