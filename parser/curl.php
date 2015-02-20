<?PHP
function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

function curl_get_contents($url, $post=array()){
global $headers_responses;

		$time_start = microtime_float();
		
        $ecx = count($post);
        while($ecx--){
                @$post['fields'].=key($post).'='.array_shift($post).'&';
        }
        $post = rtrim($post['fields'], '&');
        try {
                $crl = curl_init($url);
                curl_setopt_array($crl, array(
                                CURLOPT_HEADER => 1,
                                CURLOPT_RETURNTRANSFER => 1,
                                //CURLOPT_POST => 1,
                                //CURLOPT_POSTFIELDS => $post,
                                CURLOPT_USERAGENT => 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)',
                                CURLOPT_CUSTOMREQUEST => 'GET',
								CURLOPT_SSL_VERIFYPEER => 0,
								CURLOPT_SSL_VERIFYHOST => 0,
                                CURLOPT_FOLLOWLOCATION => 1,
								CURLOPT_CONNECTTIMEOUT_MS => 13000,
								CURLOPT_TIMEOUT_MS => 16000
                        )
                );
                if(!($html = curl_exec($crl))) throw new Exception();
        curl_close($crl);

		$headers_responses = substr($html, 0, strpos($html, "\r\n\r\n"));
			if (stristr($headers_responses, 'Location: ')) { 
				$headers_responses = explode( "\r\n", substr($html, 0, strpos($html, "\r\n\r\n")) );
				$headers_responses['load_time'] = microtime_float() - $time_start;
				foreach ($headers_responses as $value) {
				
					$str = 'Location: '; 
					if ( strstr ($value, $str) ){
						return curl_get_contents(substr($value, strpos($value, $str)+strlen($str)));
						break;
					}	

				//$headers_responses = explode( "\r\n", substr($html, 0, strpos($html, "\r\n\r\n")) );
				//return file_get_contents($ulr);
				}
			
			}else{
				$headers_responses = explode( "\r\n", substr($html, 0, strpos($html, "\r\n\r\n")) ); // SPIKE! global
				$headers_responses['load_time'] = microtime_float() - $time_start;
				return substr($html, strpos($html, "\r\n\r\n")+4);
			}

        } catch(Exception $e){
                return FALSE;
        }
}

function get_cpage($url, $cookies="PHPSESSID=f7ca6c8b5de1e527c21035b66516d1ee; BITRIX_SM_LOGIN=afterme; BITRIX_SM_UIDH=de2d0ea8a54fbfb17420fd971e553cef; BITRIX_SM_SALE_UID=1708012; BITRIX_SM_SOUND_LOGIN_PLAYED=Y; BITRIX_SM_SALE_UID=1712248;")
{ 
	  $uagent = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)";
      ob_start();
      $ch = curl_init();
      curl_setopt($ch,CURLOPT_URL,$url);
      curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 900);
      curl_setopt($ch, CURLOPT_TIMEOUT_MS, 900);
      if(!empty($cookies)) 
         curl_setopt ($ch, CURLOPT_COOKIE,$cookies);
      else 
      {
         curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
         curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
      }
      curl_exec($ch);
      $result = ob_get_contents();
      curl_close ($ch);
      ob_end_clean();
      return $result;
}
?>