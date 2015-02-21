<?php
//ini_set('max_execution_time', 900);
//include "admin/bd.php";


    include 'simple_html_dom.php';
    /*$link = "http://www.volkswagen.ua/";
    $html = file_get_html($link);
    $data = str_get_html($html);
        if($data->innertext!='' and count($data->find('body'))){
            $rows = $data->find('.last .mainMenuLink span'); 
            foreach($rows as $a){
                $rez = $a->plaintext;
            }*/
        
    //$data->clear(); unset($data);
    
   // $arr=explode('=','12');
    //$kurs = $arr[1];
    //mysql_query("INSERT INTO `katirovki` SET `date`='".date('Y-m-d')."', `usd`='$kurs'");
/*}*/

function get_grn($grn){
    global $kurs;
    return 12*$grn;
}
function get_usd($grn){
    global $kurs;
    return (int)($grn/12)*1;
}
?> 