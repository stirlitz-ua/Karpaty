<?php 
	$validator = $_POST['validator'];
	$test_drive = 'test_drive';
	$private_call = 'private_call';
	$to  = "<admin_karpatyautocenter@ukr.net>" ;
	//$to = "<igorrok@gmail.com>";admin@karpaty-autocenter.com.ua
	
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: <noreply@karpaty-autocenter.com.ua>\r\n";

	$valid[1] = strcmp($validator, $test_drive);
	$valid[2] = strcmp($validator, $private_call);

	if ($valid[1] == 0) {
	$marka = $_POST['marka'];
	$model = $_POST['model'];
	$date = $_POST['date'];
	$tel = $_POST['tel'];
	$note = $_POST['note'];

	$subject = "[ЗАКАЗ] Тест драйв";

	$message .= "Заказан тест драйв, детали: \r\n";
	$message .= "\r\n Марка: ";
	$message .= $marka;

	$message .= "\r\n Модель: ";
	$message .= $model;

	$message .= "\r\n Дата: ";
	$message .= $date;	

	$message .= "\r\n Телефон: ";
	$message .= $tel;

	$message .= "\r\n Примечание: ";
	$message .= $note;	

	mail($to, $subject, $message, $headers);
	}

	if ($valid[2] == 0) {
	$subject = "[ЗАКАЗ] Звонок";
	$phone = $_POST['phone']; // number of phone
	$time = $_POST['time'];
	$message .= "Заказан звонок, детали: \r\n";
	$message .= "\r\n Номер телефона: ";
	$message .= $phone;

	$message .= "\r\n Час: ";
	$message .= $time;

	mail($to, $subject, $message, $headers);
	}

?>