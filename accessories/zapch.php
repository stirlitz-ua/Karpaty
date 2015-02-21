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

if($_GET['act']==''){





        echo '<dl class="cat">';
?>  <h1>Выберите год </h1> <?
        $basecat1 = mysql_query("SELECT `id`,`year` FROM `zapchasti2`  GROUP BY `year` ",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                echo '<a title="'.$rowcat1['year'].'" href="zapch.php?act=cat&model='.$rowcat1['year'].'">'.$rowcat1['year'].'</a>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</div>';
        }
    echo' </dl>';
    }

    ?>