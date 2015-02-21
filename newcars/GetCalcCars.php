<?
session_start();
include_once "../bd.php";
include_once "../kurs.php";

//////////////////////////////////////////////////////////////////////////////////////////////
//добавить к сравнению авто id
if(isset($_POST['action']) and $_POST['action']=='sravnenie'){
    if(!is_array($_SESSION['compar'])){
        $_SESSION['compar'][]=$_POST['idcar'];
    }else{
        if(count($_SESSION['compar'])<3 and !in_array($_POST['idcar'],$_SESSION['compar'])){
            $_SESSION['compar'][]=$_POST['idcar'];
        }elseif(count($_SESSION['compar'])<=3 and in_array($_POST['idcar'],$_SESSION['compar'])){
            unset($_SESSION['compar'][array_search($_POST['idcar'],$_SESSION['compar'])]);
        }
    }
    echo count($_SESSION['compar']);
}

//////////////////////////////////////////////////////////////////////////////////////////////
//добавить к избранным авто id
if(isset($_POST['action']) and $_POST['action']=='izbrannoe'){
    if(is_array($_SESSION['select'])){//если нет в массиве , то добавить
    if(!in_array($_POST['idcar'],$_SESSION['select'])){
    $_SESSION['select'][]=$_POST['idcar'];
    }else {unset($_SESSION['select'][array_search($_POST['idcar'],$_SESSION['select'])]);}}else{$_SESSION['select'][]=$_POST['idcar'];}
    echo count($_SESSION['select']);
}

//////////////////////////////////////////////////////////////////////////////////////////////
// добавление в сессию параметров поиска
if(isset($_POST['param'])){
    if($_POST['param']=='options' or $_POST['param']=='isset' or $_POST['param']=='garant' or $_POST['param']=='color' or $_POST['param']=='name2' or $_POST['param']=='name3'){
        $_SESSION['search'][$_POST['param']]=$_POST['val1'];
        if(($_POST['param']=='color' or $_POST['param']=='name2' or $_POST['param']=='name3') and $_POST['val1']=='') unset($_SESSION['search'][$_POST['param']]);
        if($_POST['param']=='name2' and $_POST['val1']=='') unset($_SESSION['search']['name3']);
    }else{
        $_SESSION['search'][$_POST['param']][1]=$_POST['val1'];
        $_SESSION['search'][$_POST['param']][2]=$_POST['val2'];
    }


$request="SELECT * FROM cars_new ";// формирование запроса к базе
if(is_array($_SESSION['search'])){
    $request.="WHERE ";
    foreach($_SESSION['search'] as $i=>$val){
        if(is_array($val)){
            if($i=='price'){
            $req[]="`car_$i`>='". get_usd($val[1]) ."'";
            $req[]="`car_$i`<='". get_usd($val[2]) ."'";              
            }else{
            $req[]="`car_$i`>='$val[1]'";
            $req[]="`car_$i`<='$val[2]'";}
        }elseif($i=='options'){
            $r=explode(',',$val);
            foreach($r as $a){
            $req[]="`car_$i` LIKE '%$a%'";
            }
        }elseif($val=="true" and $i=='isset'){
            $req[]="`car_$i` <= UNIX_TIMESTAMP()";
        }elseif($i=='color' or $i=='name2' or $i=='name3'){
            $req[]="`car_$i` = '$val'";
        }elseif($val=="true"){
            $req[]="`car_$i` = '1'";
        }
    }
   $request.=implode(' and ',$req); 
}

//echo $request;
$q=mysql_query($request);
$_SESSION['count']=mysql_num_rows($q);
echo mysql_num_rows($q).' автомобилей найдено';
//echo $request;
}

//session_destroy();


?>