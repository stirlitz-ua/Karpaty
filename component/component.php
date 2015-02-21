<?

//дата по русски
function date_smart($date_input, $time) {
 $monthes = array(
  '', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
  'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
 );
 $date = strtotime($date_input);

 //Время
 if(isset($time)) $time = 'G:i';
 else $time = '';
 //Сегодня, вчера, завтра
 if(date('Y') == date('Y',$date)) {
  if(date('z') == date('z', $date)) {
   $result_date = date('Сегодня,'.$time, $date);
  } elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)+1,date('Y',$date)))) {
   $result_date = date('Вчера,'.$time, $date);
  } elseif(date('z') == date('z',mktime(0,0,0,date('n',$date),date('j',$date)-1,date('Y',$date)))) {
   $result_date = date('Завтра'.$time, $date);
  }

  if(isset($result_date)) return $result_date;
 }

 //Месяца
 $month = $monthes[date('n',$date)];

 //Года
 if(date('Y') != date('Y', $date)) $year = 'Y г.';
 else $year = '';

 
 $result_date = date('j '.$month.' '.$year.' в '.$time, $date);
 return $result_date;
}




function cut($string, $length = 660, $etc = '.', $charset='UTF-8', $break_words = true, $middle = true) {
    if ($length == 0) return '';
    if (strlen($string) > $length) {
        $length -= min($length, strlen($etc));
        if (!$break_words && !$middle) {$string = preg_replace('/\s+?(\S+)?$/', '', mb_substr($string, 0, $length+1, $charset));}
        if(!$middle) { return mb_substr($string, 0, $length, $charset) . $etc;} else {return mb_substr($string, 0, $length/2, $charset) . $etc . mb_substr($string, -$length/2, $charset);}
    } else {
        return $string;
    }
}

function htmlchars($str){
    $tr = array(
       "&"=>"","–"=> "&ndash;", "—"=> "&mdash;", "©"=> "&copy;", "®"=> "&reg;", "™"=> "&trade;", "º"=> "&ordm;", "ª"=> "&ordf;",
       "‰"=> "&permil;", "π"=> "&pi;", "×"=> "&times;", "÷"=> "&divide;", "<"=> "&lt;", ">"=> "&gt;", "±"=> "&plusmn;", "¹"=> "&sup1;", 
       "²"=> "&sup2;", "³"=> "&sup3;", "¬"=> "&not;", "¼"=> "&frac14;", "½"=> "&frac12;", "¾"=> "&frac34;", "⁄"=> "&frasl;", "/"=> "&frasl;", 
       "−"=> "minus;", "\""=> "&quot;",  "«"=> "&laquo;", "»"=> "&raquo;", "′"=> "&prime;", "'"=> "&prime;", "″"=> "&Prime;", "^"=>"","&"=>"",
       "‘"=> "&lsquo;", "’"=> "&rsquo;", "‚"=> "&sbquo;", "“"=> "&ldquo;", "”"=> "&rdquo;", "„"=> "&bdquo;","#"=>"", "$"=>"","%"=>""
    );
    return strtr($str,$tr);
}

function htmsor($str){
    $tr = array(
       "&ndash;" => "–", "&mdash;"=> "—", "&copy;"=> "©", "&reg;"=> "®","&trade;" => "™","&ordm;" => "º", "&ordf;"=> "ª",
        "&lt;"=>"<" ,"&gt;" => ">","&frasl;" =>"/", "minus;"=> "−", "&quot;"=> "\"",  "&laquo;"=> "«", "&raquo;"=> "»","&prime;" => "′");
    return strtr($str,$tr);
}
function htmlcha($str){
    $tr = array(
       "&"=>"", "©"=> "", "®"=> "", "™"=> "", "º"=> "", "ª"=> "",
       "‰"=> "", "π"=> "", "×"=> "", "÷"=> "", "<"=> "", ">"=> "", "±"=> "", "¹"=> "", 
       "²"=> "", "³"=> "", "¬"=> "", "¼"=> "", "½"=> "", "¾"=> "", "⁄"=> "", "/"=> "", 
       "\""=> "",  "«"=> "", "»"=> "", "′"=> "", "'"=> "", "″"=> "", "^"=>"","&"=>"",
       "‘"=> "", "’"=> "",  "“"=> "", "”"=> "", "„"=> "","#"=>"", "$"=>"","%"=>""
    );
    return strtr($str,$tr);
}




function get_gearch_bot(){
if (stristr($_SERVER['HTTP_USER_AGENT'], "Yandex")){ $bot="Yandex";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "StackRambler")){$bot="Rambler";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "msnbot")){$bot="msnbot/1.0";}
else if ( stristr($_SERVER['HTTP_USER_AGENT'], "stack") ) {$bot="Rambler";}
else if ( stristr($_SERVER['HTTP_USER_AGENT'], "rambler") ) {$bot="Rambler 2";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "ia_archiver")){$bot="Alexa search engine";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "Googlebot")){$bot="Google";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "google") ) {$bot="Google 2";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "scooter")){$bot="AltaVista";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "lycos")){$bot="Lycos";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "WebAlta")){$bot="WebAlta";}
else if (stristr($_SERVER['HTTP_USER_AGENT'], "yahoo")){$bot="Yahoo";}
else if ( stristr($_SERVER['HTTP_USER_AGENT'], "aport") ) {$bot="Aport";}
else { $bot=false; }
return $bot;
} 




function Clear_array_empty($array){
$ret_arr = array();
foreach($array as $val){if (!empty($val)){$ret_arr[] = trim($val);}}
return $ret_arr;
}



function fun_ot_com($str){
    $content =   file ( 'dl.txt' );
    $pr=$content[0];
    $cena= $str*$pr;
    if($str!=0){
    $cena= 'от '.number_format($cena, 0, '', ' ').' грн.';
    }else{
        $cena='Цена не установлена';
    }
    return $cena;
}




    $config['smtp_username'] = 'admin@web-rich.ru';  //Смените на имя своего почтового ящика.
    $config['smtp_port']     = '25'; // Порт работы. Не меняйте, если не уверены.
    $config['smtp_host']     = 'smtp.yandex.ru';  //сервер для отправки почты
    $config['smtp_password'] = '9562876';  //Измените пароль
    $config['smtp_debug']   = true;  //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
    $config['smtp_charset']  = 'UTF-8';  //кодировка сообщений. (или UTF-8, итд)
    $config['smtp_from']     = 'Volkswagen'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"
function smtpmail($mail_to, $subject, $message, $headers='') {
    global $config;
    $SEND = "Date: ".date("D, d M Y H:i:s") . " UT\r\n";
    $SEND .=    'Subject: =?'.$config['smtp_charset'].'?B?'.base64_encode($subject)."=?=\r\n";
    if ($headers) $SEND .= $headers."\r\n\r\n";
    else
    {
            $SEND .= "Reply-To: ".$config['smtp_username']."\r\n";
            $SEND .= "MIME-Version: 1.0\r\n";
            $SEND .= "Content-Type: text/html; charset=\"".$config['smtp_charset']."\"\r\n";
            $SEND .= "Content-Transfer-Encoding: 8bit\r\n";
            $SEND .= "From: \"".$config['smtp_from']."\" <".$config['smtp_username'].">\r\n";
            $SEND .= "To: $mail_to <$mail_to>\r\n";
            $SEND .= "X-Priority: 3\r\n\r\n";
    }
    $SEND .=  $message."\r\n";
     if( !$socket = fsockopen($config['smtp_host'], $config['smtp_port'], $errno, $errstr, 30) ) {
        if ($config['smtp_debug']) echo $errno."&lt;br&gt;".$errstr;
        return false;
     }
 
    if (!server_parse($socket, "220", __LINE__)) return false;
 
    fputs($socket, "HELO " . $config['smtp_host'] . "\r\n");
    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Не могу отправить HELO!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "AUTH LOGIN\r\n");
    if (!server_parse($socket, "334", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Не могу найти ответ на запрос авторизаци.</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, base64_encode($config['smtp_username']) . "\r\n");
    if (!server_parse($socket, "334", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Логин авторизации не был принят сервером!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, base64_encode($config['smtp_password']) . "\r\n");
    if (!server_parse($socket, "235", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Пароль не был принят сервером как верный! Ошибка авторизации!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "MAIL FROM: <".$config['smtp_username'].">\r\n");
    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Не могу отправить комманду MAIL FROM: </p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "RCPT TO: <" . $mail_to . ">\r\n");
 
    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Не могу отправить комманду RCPT TO: </p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "DATA\r\n");
 
    if (!server_parse($socket, "354", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Не могу отправить комманду DATA</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, $SEND."\r\n.\r\n");
 
    if (!server_parse($socket, "250", __LINE__)) {
        if ($config['smtp_debug']) echo '<p>Не смог отправить тело письма. Письмо не было отправленно!</p>';
        fclose($socket);
        return false;
    }
    fputs($socket, "QUIT\r\n");
    fclose($socket);
    return TRUE;
}
 
function server_parse($socket, $response, $line = __LINE__) {
    global $config;
    while (@substr($server_response, 3, 1) != ' ') {
        if (!($server_response = fgets($socket, 256))) {
            if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
            return false;
        }
    }
    if (!(substr($server_response, 0, 3) == $response)) {
        if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
        return false;
    }
    return true;
}


?>