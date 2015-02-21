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
        $basecat1 = mysql_query("SELECT * FROM `zapchasti`  WHERE  `id`='{$_GET['id']}'  GROUP BY `typee` LIMIT 1",$db) or die(mysql_error());
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
    echo '<dl class="cat">';
        $basecat1 = mysql_query("SELECT `typee`,`year`,`model`,`marka`,`id` FROM `zapchasti`  WHERE  `year`='{$_GET['year']}' AND `model`='{$_GET['model']}' AND `marka`='{$_GET['marka']}' AND `typee`='{$_GET['type']}'  GROUP BY `typee` LIMIT 6",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                echo '<a href="newnew.php?year='.$rowcat1['year'].'&model='.$rowcat1['model'].'&marka='.$rowcat1['marka'].'&type='.$rowcat1['typee'].'&id='.$rowcat1['id'].'">'.$rowcat1['typee'].'</a>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</div>';
        }
    echo' </dl>';
	
}

elseif (isset($_GET['year']) && isset($_GET['model']) && isset($_GET['marka'])){
    echo '<dl class="cat">';
        $basecat1 = mysql_query("SELECT `cat`,`year`,`model`,`marka`,`typee` FROM `zapchasti`  WHERE  `year`='{$_GET['year']}' AND `model`='{$_GET['model']}' AND `marka`='{$_GET['marka']}' GROUP BY `cat` LIMIT 30",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                echo '<a href="newnew.php?year='.$rowcat1['year'].'&model='.$rowcat1['model'].'&marka='.$rowcat1['marka'].'&type='.$rowcat1['typee'].'">'.$rowcat1['cat'].'</a>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</div>';
        }
    echo' </dl>';
	
}
elseif (isset($_GET['year']) && isset($_GET['model'])){
    echo '<dl class="cat">';
        $basecat1 = mysql_query("SELECT `marka`,`model`,`year` FROM `zapchasti`  WHERE  `year`='{$_GET['year']}' AND `model`='{$_GET['model']}' GROUP BY `marka` LIMIT 30",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                echo '<a href="newnew.php?year='.$rowcat1['year'].'&model='.$rowcat1['model'].'&marka='.$rowcat1['marka'].'">'.$rowcat1['marka'].'</a>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</div>';
        }
    echo' </dl>';
	
}elseif (isset($_GET['year'])){

    echo '<dl class="cat">';
        $basecat1 = mysql_query("SELECT `model`,`year` FROM `zapchasti`  WHERE  `year`='{$_GET['year']}' GROUP BY `model` LIMIT 43",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                echo '<a href="newnew.php?year='.$rowcat1['year'].'&model='.$rowcat1['model'].'">'.$rowcat1['model'].'</a>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</div>';
        }
    echo' </dl>';
}
elseif (isset($_GET['cat'])){
    echo '<dl class="cat">';
  ?>  <h1>Выберите год:</h1> <?
        $basecat1 = mysql_query("SELECT `year` FROM `zapchasti` GROUP BY `year` LIMIT 1",$db) or die(mysql_error());
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
        $basecat1 = mysql_query("SELECT `model` FROM `zapchasti` GROUP BY `model` ",$db) or die(mysql_error());
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
        $basecat1 = mysql_query("SELECT `marka` FROM `zapchasti` WHERE `model`='{$_GET['model']}'  GROUP BY `marka` LIMIT 1",$db) or die(mysql_error());
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
        $basecat1 = mysql_query("SELECT `cat` FROM `zapchasti` GROUP BY `cat` LIMIT 1",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {
echo'<select>';

            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<option value="'.$rowcat1['cat'].'">'.$rowcat1['cat'].'</option>';
                           }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</select>';
            echo '</div>';
        }
    echo' </dl>';
    }
?> 