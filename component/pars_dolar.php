<?

include 'nokogiri.php';
$response=file_get_contents('http://www.volkswagen.ua/');
$dom_html = new nokogiri($response);
$date=$dom_html->get('.mainMenuLink')->toArray();
$d=explode('$=', $date[6]['span']['#text']);
$fp = fopen("../dl.txt", "w+");
$test = fwrite($fp, $d[1]); 
fclose($fp);




//cars_new
//






?>