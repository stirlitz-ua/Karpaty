<?php

$db = mysql_connect("localhost", "karpatya_bd", "YA7ixgRc");

mysql_select_db("karpatya_avto", $db);



mysql_query("SET NAMES utf8");

mysql_query("SET NAMES 'utf8';"); 

mysql_query("SET CHARACTER SET 'utf8';"); 







/**

 * mysql_query("SET NAMES 'utf8'",$db);

 * mysql_query("SET character_set_client = utf8",$db);

 * mysql_query("SET character_set_connection = utf8",$db);

 * mysql_query("SET character_set_results = utf8",$db);

 */











function stripslashes_array($array) {

  return is_array($array) ?

    array_map('stripslashes_array', $array) : stripslashes($array);

}



if (get_magic_quotes_gpc()) {

  $_GET = stripslashes_array($_GET);

  $_POST = stripslashes_array($_POST);

  $_COOKIE = stripslashes_array($_COOKIE);

}