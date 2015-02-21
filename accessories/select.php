<?php


$db = mysql_connect("localhost", "karpatya_bd", "YA7ixgRc");

mysql_select_db("karpatya_volkswagen", $db);



function stripslashes_array($array) {

    return is_array($array) ?

        array_map('stripslashes_array', $array) : stripslashes($array);

}



if (get_magic_quotes_gpc()) {

    $_GET = stripslashes_array($_GET);

    $_POST = stripslashes_array($_POST);

    $_COOKIE = stripslashes_array($_COOKIE);

}

if (isset($_GET['id'])){
    echo '<dl class="cat">';
        $basecat1 = mysql_query("SELECT * FROM `z{$_GET['year']}`  WHERE  `id`='{$_GET['id']}'  GROUP BY `typee` LIMIT 1",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                    echo '<a>'.$rowcat1['title'].'</a><br/>';
                     echo'<img src="'.$rowcat1['img'].'"  width="10%" height="auto"><br/> ';
                     echo '<a>'.$rowcat1['artikul'].'</a><br/>';
                      echo '<a>'.$rowcat1['price'].'<b>грн.</b><br/>';
                       echo ''.preg_replace("|</table>(.*)|", "</table>", $rowcat1['meta']).'<br/>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</div>';
        }
    echo' </dl>';
	
}
elseif (isset($_GET['year']) && isset($_GET['model']) && isset($_GET['marka'])&& isset($_GET['type'])){

		$_GET['model'] = urldecode($_GET['model']);
		$_GET['marka'] = urldecode($_GET['marka']);
		$_GET['type'] = urldecode($_GET['type']);
		

        $basecat1 = mysql_query("SELECT `typee`,`year`,`model`,`marka`,`id` FROM `z{$_GET['year']}`  WHERE  `year`='{$_GET['year']}' AND `model`='{$_GET['model']}' AND `marka`='{$_GET['marka']}' AND `typee`='{$_GET['type']}'  GROUP BY `typee` LIMIT 6",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
			
			echo '<option value="#">Выберите</option>';
	
            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="/accessories/select.php?year='.$rowcat1['year'].'&model='.urlencode($rowcat1['model']).'&marka='.urlencode($rowcat1['marka']).'&type='.urlencode($rowcat1['typee']).'&id='.$rowcat1['id'].'">'.$rowcat1['typee'].'</option>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
        }
	
}

elseif (isset($_GET['year']) && isset($_GET['model']) && isset($_GET['marka'])){
		$_GET['model'] = urldecode($_GET['model']);
		$_GET['marka'] = urldecode($_GET['marka']);
		
        $basecat1 = mysql_query("SELECT `cat`,`year`,`model`,`marka`,`typee` FROM `z{$_GET['year']}`  WHERE  `year`='{$_GET['year']}' AND `model`='{$_GET['model']}' AND `marka`='{$_GET['marka']}' GROUP BY `cat` LIMIT 30",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
			echo '<option value="#">Выберите</option>';

            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="/accessories/select.php?year='.$rowcat1['year'].'&model='.urlencode($rowcat1['model']).'&marka='.urlencode($rowcat1['marka']).'&type='.urlencode($rowcat1['typee']).'">'.$rowcat1['cat'].'</option>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
        }
	
}
elseif (isset($_GET['year']) && isset($_GET['model'])){
		$_GET['model'] = urldecode($_GET['model']);

        $basecat1 = mysql_query("SELECT `marka`,`model`,`year` FROM `z{$_GET['year']}`  WHERE  `year`='{$_GET['year']}' AND `model`='{$_GET['model']}' GROUP BY `marka` LIMIT 30",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
			
			echo '<option value="#">Выберите</option>';
			
            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="/accessories/select.php?year='.$rowcat1['year'].'&model='.urlencode($rowcat1['model']).'&marka='.urlencode($rowcat1['marka']).'">'.$rowcat1['marka'].'</option>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
                //echo '</select>';
        }
	
}elseif (isset($_GET['year'])){

        $basecat1 = mysql_query("SELECT `model`,`year` FROM `z{$_GET['year']}`  WHERE  `year`='{$_GET['year']}' GROUP BY `model` LIMIT 43",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {

			echo '<option value="#">Выберите</option>';
            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="/accessories/select.php?year='.$rowcat1['year'].'&model='.urlencode($rowcat1['model']).'">'.$rowcat1['model'].'</option>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            //echo '</select>';
        }
}






















elseif (isset($_GET['cat'])){
    echo '<dl class="cat">';
  ?>  <h1>Выберите год:</h1> <?
        $basecat1 = mysql_query("SELECT `year` FROM `z{$_GET['year']}` GROUP BY `year` LIMIT 1",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
echo'<select>';

            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="newnew.php?year='.$rowcat1['year'].'">'.$rowcat1['year'].'</option>';
                           }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</select>';
            echo '</div>';
        }
    echo' </dl>';
    
        echo '<dl class="cat">';
  ?>  <h1>Выберите модель:</h1> <?
        $basecat1 = mysql_query("SELECT `model` FROM `z{$_GET['year']}` GROUP BY `model` ",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
echo'<select>';

            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="newnew.php?model='.$_POST['model'].'">'.$rowcat1['model'].'</option>';
                           }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</select>';
            echo '</div>';
        }
    echo' </dl>';
    
        echo '<dl class="cat">';
  ?>  <h1>Выберите комплектацию:</h1> <?
        $basecat1 = mysql_query("SELECT `marka` FROM `z{$_GET['year']}` WHERE `model`='{$_GET['model']}'  GROUP BY `marka` LIMIT 1",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
echo'<select>';

            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="'.$rowcat1['marka'].'">'.$rowcat1['marka'].'</option>';
                           }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</select>';
            echo '</div>';
        }
    echo' </dl>';
    
    echo '<dl class="cat">';
  ?>  <h1>Выберите категорию:</h1> <?
        $basecat1 = mysql_query("SELECT `cat` FROM `z{$_GET['year']}` GROUP BY `cat` LIMIT 1",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
echo'<select>';

            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="'.$rowcat1['cat'].'">'.$rowcat1['cat'].'</option>';
                           }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</select>';

        }

    }
	
/*

INSERT INTO
    `z2001` (`year`,`model`,`marka`,`cat`,`typee`,`title`,`price`,`artikul`,`meta`,`img`)
SELECT
    `zapchasti`.`year`,
    `zapchasti`.`model`,
    `zapchasti`.`marka`,
    `zapchasti`.`cat`,
    `zapchasti`.`typee`,
    `zapchasti`.`title`,
    `zapchasti`.`price`,
    `zapchasti`.`artikul`,
    `zapchasti`.`meta`,
    `zapchasti`.`img`
   FROM
   `zapchasti` 
WHERE
    `zapchasti`.`year` = 2001;

*/
?> 