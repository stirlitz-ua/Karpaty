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
 
	// Ссылка подкатегории откуда парсить. ОСТАВИТЬ ?page=0 В КОНЦЕ!!
	$BASE = 'http://volkswagen-eshop.ru/odejda-aksessuary/jenskaya-odejda?page=0';
	
	// ID соответсвующего каталога в базе!
	$CAT = 170;
	
	

	// ККоличество страниц в каталоге
	//$PAGES = 9;
	
	$dblocation = "localhost";
	$dbname = "karpatya_catalog";
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


	$base1 = 'http://volkswagen-eshop.ru';
	
	//for($i=;$i<=$PAGES;$i++){
		//$url = $BASE.$i;
		$url = $BASE;
		$html = new simple_html_dom();
		$html->load_file($url); 
		
		foreach ($html->find('div.ico a') as $e1) {
			
			$urls[] =  $base1.$e1->href;
		
		}									
		
		$html->clear();
		unset($html);	
	//}
	
	for($i=0;$i<=count($urls)-1;$i++){
		$url = $urls[$i];
		$html2 = new simple_html_dom();
		$html2->load_file($url); 
		
		foreach($html2->find('.item a') as $e2){
			$PHOTO =  explode('/', $e2->href);
			$PHOTO =  $PHOTO[count($PHOTO)-1];
			break;
		}
		
		foreach($html2->find('.active') as $e3){
			$NAZVA =  $e3->plaintext;
			break;
		}
		
		foreach($html2->find('.bottom-description') as $e3){
			$ARTIC =  preg_replace("|<br />(.*)|", "", $e3->innertext);
			
			break;
		}
		
		$j=0;
		foreach($html2->find('table') as $e4){
		$j++; 
		if($j==1) continue;
		if($j==3) break;
			$OPIS = $e4->innertext;
			
			break;
		}
		
		$html2->clear();
		unset($html2);	
		
		$PHOTO = addslashes($PHOTO);
		$NAZVA = addslashes($NAZVA);
		$OPIS = addslashes($OPIS);
		$ARTIC = addslashes($ARTIC);
		
		/*echo $PHOTO;
		echo $NAZVA;
		echo $OPIS;
		echo $ARTIC;*/
		
		//getImage
		$imgF = file_get_contents("http://volkswagen-eshop.ru/uploads/items/".$PHOTO);
		$file = fopen ('./images/sm_'.$PHOTO,"w+");
		  if ( !$file )
		  {
			echo("Ошибка открытия файла");
		  }
		  else
		  {
			fputs ( $file, $imgF);
		  }
		  fclose ($file);
		
		$query = "INSERT INTO `cat_tov` VALUES (null, '{$CAT}', '{$PHOTO}', '{$NAZVA}', '{$ARTIC}', '', '', '{$OPIS}', '0', '0', '1')";
		$result = mysql_query($query, $dbcnx);
	}
										
										

	echo "Ok,Done";

?>