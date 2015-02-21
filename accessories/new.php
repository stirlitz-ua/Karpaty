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
        $basecat1 = mysql_query("SELECT `id`,`year` FROM `zapchasti`  GROUP BY `year` ",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                echo '<a title="'.$rowcat1['year'].'" href="zapch.php?act=cat&year='.$rowcat1['year'].'">'.$rowcat1['year'].'</a>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
            echo '</div>';
        }
    echo' </dl>';
    echo '<dl class="cat2">';
    ?>  <h1>Выберите год </h1> <?
    $basecat1 = mysql_query("SELECT `id`,`model` FROM `zapchasti`  GROUP BY `model` ",$db) or die(mysql_error());
    if (mysql_num_rows($basecat1) > 0)
    {


        $rowcat1 = mysql_fetch_array($basecat1);
        do {
            echo '<dd>';
            echo '<a title="'.$rowcat1['model'].'" href="zapch.php?act=cat&model='.$rowcat1['model'].'">'.$rowcat1['model'].'</a>';
            echo '</dd>';
        }
        while($rowcat1 = mysql_fetch_array($basecat1));
        echo '</div>';
    }
    echo' </dl>';

    echo '<dl class="cat3">';
    ?>  <h1>Выберите год </h1> <?
    $basecat1 = mysql_query("SELECT `id`,`cat` FROM `zapchasti`  GROUP BY `cat` ",$db) or die(mysql_error());
    if (mysql_num_rows($basecat1) > 0)
    {


        $rowcat1 = mysql_fetch_array($basecat1);
        do {
            echo '<dd>';
            echo '<a title="'.$rowcat1['marka'].'" href="zapch.php?act=cat&cat='.$rowcat1['cat'].'">'.$rowcat1['cat'].'</a>';
            echo '</dd>';
        }
        while($rowcat1 = mysql_fetch_array($basecat1));
        echo '</div>';
    }
    echo' </dl>';
    }
if($_GET['act']=='cat'){
    if (isset($cat))
    {
        $basecat1 = mysql_query("SELECT * FROM `zapchasti` WHERE `year`=`2014`",$db) or die(mysql_error());
        if (mysql_num_rows($basecat1) > 0)
        {


            $rowcat1 = mysql_fetch_array($basecat1);
            do {
                echo '<dd>';
                echo '<a title="'.$rowcat1['marka'].'" href="zapch.php?act=cat&cat='.$rowcat1['cat'].'">'.$rowcat1['cat'].'</a>';
                echo '</dd>';
            }
            while($rowcat1 = mysql_fetch_array($basecat1));
    }
}
}
    ?>