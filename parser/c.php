<meta http-equiv="Content-Type" content="text/html; charset=cp1251" />
<?PHP

@error_reporting ( E_ALL );
@ini_set ( 'display_errors', true );
@ini_set ( 'html_errors', false );
@ini_set ( 'error_reporting', E_ALL  );

@set_time_limit(0);
@ini_set('max_execution_time',0);
@ini_set('set_time_limit',0);

include_once "curl.php";

include_once "simple_html_dom.php";
 
$base = 'http://www.parts.kiev.ua';



	$dblocation = "localhost";
	$dbname = "karpatya_volkswagen";
	$dbuser = "karpatya_bd";
	$dbpasswd = "YA7ixgRc";
	$dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
	if (!$dbcnx) 
	{
	  echo( "<P>В настоящий момент сервер базы данных не доступен, поэтому 
				корректное отображение страницы невозможно.</P>" );
	  exit();
	}
	if (!@mysql_select_db($dbname, $dbcnx)) 
	{
	  echo( "<P>В настоящий момент база данных не доступна, поэтому
				корректное отображение страницы невозможно.</P>" );
	  exit();
	}
	
	mysql_query("SET NAMES utf8_general_ci");
	mysql_query("SET CHARSET utf8");

	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET SESSION collation_connection = 'utf8_general_ci'");



/* Volkswagen по годам */
//for ($year=2014;$year<=2014;$year++){
	$year = intval($_GET['year']) ? intval($_GET['year']) : 3000;
		$model_i = 0;
		$model_num = intval($_GET['model']) ? intval($_GET['model']) : 0;

	unset($html);
	unset($html2);
	unset($html3);
	unset($html4);
	unset($html5);
	
	$html = new simple_html_dom();
	$html2 = new simple_html_dom();
	$html3 = new simple_html_dom();
	$html4 = new simple_html_dom();
	$html5 = new simple_html_dom();
	
	/* Volkswagen по моделям  */
		$url_year = $base."/zapchasti-volkswagen-".$year."-goda/0-587-".$year;
		$html = new simple_html_dom();
		$html->load_file($url_year); 
		
		foreach ($html->find('div.row div.col-md-4 ul.nav a') as $e1) {
			
			$model_i++;
			if ($model_i != $model_num) {continue;}
			
			$model = $e1->innertext;
			//echo $base.$e1->href; echo "<br>";
			
			/* Volkswagen по конкретным машинам (Марка Модель Тип)  */
				$url_model = str_replace("&#xa0;", "%20", $base.$e1->href);
				$html->clear();
				unset($html2);
				$html2 = new simple_html_dom();
				$html2->load_file($url_model);
				foreach ($html2->find('div.hidden-xs table a') as $e2) {		
					$marka = $e2->innertext;
					//echo str_replace('&#xa0;', '%20', $base.$e2->href); echo "<br>";
					
					
					/* По типам запчастей  */
						$url_zapchs = str_replace("&#xa0;", "%20", $base.$e2->href);
$html3->clear();

						unset($html3);
						$html3 = new simple_html_dom();
						$html3->load_file($url_zapchs);
						foreach ($html3->find('div.type_groups div.col-md-4 div a') as $e3) {		
							if ($e3->class == 'inactive') {continue;}
							
							$type = $e3->innertext;
							//echo str_replace('&#xa0;', '%20', $base.$e3->href); 
							
							
							/* Конкретные пацанские запчасти  */
								$url_zapch = str_replace("&#xa0;", "%20", $base.$e3->href);
$html4->clear();

								unset($html4);
								$html4 = new simple_html_dom();
								$html4->load_file($url_zapch);
								foreach ($html4->find('div.col-md-7') as $subhtml) {
									
									foreach ($subhtml->find('a') as $e4) {
										$cat = $e4->innertext;
										
										
										/* Информация о запчасти  */
											$url_info = str_replace("&#xa0;", "%20", $base.$e4->href);
$html5->clear();

											unset($html5);
											$html5 = new simple_html_dom();
											$html5->load_file($url_info);
											$price=false;
											foreach ($html5->find('div.col-md-9 div.col-md-8 div.row div.col-md-6 div[style="margin-bottom:2px;margin-top:2px;background-color:#fcf7de; padding: 5px 10px 5px 10px; display: inline-block; font-size: 2.35em;font-weight: bold;color:#379c22;"]') as $e5) {
												$price = $e5->plaintext;
												$price = str_replace('грн.   					','',$price);
												$price =  preg_replace("/(.*) 							/","",$price);
												$price = str_replace('грн.','',$price);
											}
											if (!$price){
												foreach ($html5->find('div.col-md-9 div.col-md-8 div.row div.col-md-6 div[style="line-height:0.9em;margin-bottom:2px;margin-top:2px;background-color:#fcf7de; padding: 5px 10px 5px 10px; display: inline-block; font-size: 2.35em;font-weight: bold;color:#379c22;"]') as $e5) {
													$price = $e5;
													$price = str_replace("грн.   					",'',$price);
													$price =  preg_replace("/(.*)strike/", "", $price, 1);
													$price =  preg_replace("/(.*)  						/", "", $price, 1);
													$price = str_replace("грн.",'',$price);
												}
											}
												
											$artikul = '';
											foreach ($html5->find('div[style="padding: 3px;background-color: #f1f1f1;display: inline-block;"]') as $e5) {
													$artikul = $e5->plaintext;
											}
											
											$meta = '';
											foreach ($html5->find('div[style="color: #555;"]') as $e5) {
													$meta = $e5;
											}
											
											$title = '';
											foreach ($html5->find('h1[style="font-size: 1.4em;margin-top: 5px;"]') as $e5) {
													$title = $e5->plaintext;
											}
											
											$img = '';
											foreach ($html5->find('img.img-rounded') as $e5) {
													$img = $e5->src;
											}
											
											
											/*
												echo $year;	 echo "<BR>";
												echo $model; echo "<BR>";
												echo $marka; echo "<BR>";
												echo $cat; echo "<BR>";
												echo $type; echo "<BR>";
												echo $title; echo "<BR>";
												echo strip_tags($price); echo "<BR>";
												echo $img; echo "<BR>";
												//echo $meta; echo "<BR>"; 
												echo "<BR>";
											*/
											
											$model = addslashes($model);
											$marka = addslashes($marka);
											$type = addslashes($type);
											$cat = addslashes($cat);
											$title = addslashes(strip_tags($title));
											$price = addslashes(strip_tags($price));
											$artikul = addslashes($artikul);
											$meta = addslashes($meta);
											
											$query = "INSERT INTO `zapchasti` VALUES (null, '{$year}', '{$model}', '{$marka}', '{$type}', '{$cat}', '{$title}', '{$price}', '{$artikul}', '{$meta}', '{$img}')";
											$result = mysql_query($query, $dbcnx);
											
											//var_dump($result);
											//echo $artikul; echo "<BR>";
										
										
										break;//!important; permamently; отсекает кнопку Подробнее
									}
									//break;// убрать брейк
								}
							//break;// убрать брейк
						}
				}
				
			//echo "<br>";
			//break;// убрать брейк
		}
		
	$html->clear();
	//break;// убрать брейк

	echo "Ok,Done";

?>