<?php
require("../bd.php");
require("translit.php");


if(isset($_REQUEST['ma']) and $_REQUEST['action']=='mail'){
    $add=mysql_query("UPDATE admin_ SET mail='".$_REQUEST['ma']."'");
    echo json_encode(array( 'json' => $_REQUEST['ma'])); 
}
if(isset($_REQUEST['ma']) and $_REQUEST['action']=='mail2'){
    $add=mysql_query("UPDATE admin_ SET mail2='".$_REQUEST['ma']."'");
    echo json_encode(array( 'json' => $_REQUEST['ma'])); 
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='mail1'){
    $add=mysql_query("SELECT * FROM  admin_");
    $ma=mysql_fetch_array($add);
    echo json_encode(array( 'mail2' => $ma['mail'])); 
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='mail4'){
    $add=mysql_query("SELECT * FROM  admin_");
    $ma=mysql_fetch_array($add);
    echo json_encode(array( 'mailss' => $ma['mail2'])); 
}



if(isset($_REQUEST['ma']) and $_REQUEST['action']=='phone'){
    $add=mysql_query("UPDATE admin_ SET phone='".$_REQUEST['ma']."'");
    echo json_encode(array( 'json' => $_REQUEST['ma'])); 
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='phone1'){
    $add=mysql_query("SELECT * FROM  admin_");
    $ma=mysql_fetch_array($add);
    echo json_encode(array( 'phone2' => $ma['phone'])); 
}



if(isset($_REQUEST['ma']) and $_REQUEST['action']=='phone33'){
    $add=mysql_query("UPDATE admin_ SET phone2='".$_REQUEST['ma']."'");
    echo json_encode(array( 'json' => $_REQUEST['ma'])); 
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='phone4'){
    $add=mysql_query("SELECT * FROM  admin_");
    $ma=mysql_fetch_array($add);
    echo json_encode(array( 'phone2' => $ma['phone2'])); 
}



if(isset($_REQUEST['ma']) and $_REQUEST['action']=='phone3as'){
    $add=mysql_query("UPDATE admin_ SET phone3='".$_REQUEST['ma']."'");
    echo json_encode(array( 'json' => $_REQUEST['ma'])); 
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='phone3a'){
    $add=mysql_query("SELECT * FROM  admin_");
    $ma=mysql_fetch_array($add);
    echo json_encode(array( 'phone2' => $ma['phone3'])); 
}



if(isset($_REQUEST['ma']) and $_REQUEST['action']=='mail3as'){
    $add=mysql_query("UPDATE admin_ SET mail3='".$_REQUEST['ma']."'");
    echo json_encode(array( 'json' => $_REQUEST['ma'])); 
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='mail3a'){
    $add=mysql_query("SELECT * FROM  admin_");
    $ma=mysql_fetch_array($add);
    echo json_encode(array( 'vvvv2' => $ma['mail3'])); 
}




//влд.выкл меню на моделях авто

if(isset($_REQUEST['id'])  and $_REQUEST['action']=='resets'){
        $t=mysql_query("SELECT * FROM model WHERE id='".$_REQUEST['id']."'", $db);
        $te = mysql_fetch_array($t);
        if($te[$_REQUEST['wher']]=='1'){$i=0;}else{$i=1;}
        $query=mysql_query("UPDATE model SET $_REQUEST[wher]='$i' WHERE id='".$_REQUEST['id']."'");
        echo json_encode(array( 'json' => '1')); 
}


// запрос на обновления страницы
if($_REQUEST['action']=='resets_table'){
$us=mysql_query("SELECT * FROM model ORDER BY id");
$rez=mysql_fetch_array($us);
do{
$json.= "<tr class='ten2'>
    <td width='155px' align='left' class='blue'><b>$rez[model]</b></td>
    <td  align='center' onclick='gallery($rez[id]);' "; if($rez['gallery']=='1'){$json.= "class='green'";}else{$json.= "class='red'";} $json.= "><span>Галерея</span></td>
    <td  align='center' onclick='g_360($rez[id]);'";if($rez['g_360']=='1'){$json.= "class='green'";}else{$json.= "class='red'";}  $json.= "><span>360&deg;</span></td>
    <td  align='center' onclick='review($rez[id]);'";if($rez['review']=='1'){$json.= "class='green'";}else{$json.= "class='red'";}  $json.= "><span>Обзор</span></td>
    <td  align='center' onclick='complete($rez[id]);'";if($rez['complete']=='1'){$json.= "class='green'";}else{$json.= "class='red'";}  $json.= "><span>Комплектации</span></td>
    <td  align='center' onclick='configurator($rez[id]);'";if($rez['configurator']=='1'){$json.= "class='green'";}else{$json.= "class='red'";} $json.= "><span>Конфигуратор</span></td>
    <td  align='center' onclick='technical($rez[id]);'";if($rez['technical']=='1'){$json.= "class='green'";}else{$json.= "class='red'";} $json.= "><span>Тех. характеристики</span></td>
    <td align='center'  onclick='deals($rez[id]);'";if($rez['deals']=='1'){$json.= "class='green'";}else{$json.= "class='red'";}  $json.= "><span>Спецпредложения</span></td>
    <td  align='center' onclick='press($rez[id]);'";if($rez['press']=='1'){$json.= "class='green'";}else{$json.= "class='red'";}  $json.= "><span>Пресса</span></td>
</tr>";
}while($rez=mysql_fetch_array($us));
echo json_encode(array( 'json' => $json)); 
}





//Новый pdf
if(isset($_REQUEST['id'])  and $_REQUEST['action']=='name_pdf'){
    $link=translitIt($_REQUEST['text']); 
    $query=mysql_query("Insert into pdf  SET kto='".$_REQUEST['id']."', name='".$_REQUEST['text']."', link='".$link."'");
    $pcat=mysql_insert_id();
    echo json_encode(array( 'id' => $p_cat)); 
}





if(isset($_REQUEST['id'])  and $_REQUEST['action']=='edit_txt'){
    
    $us=mysql_query("SELECT * FROM `model` WHERE `id`='".$_REQUEST['id']."'", $db);
    $rez=mysql_fetch_assoc($us);
    echo json_encode(array( 'txt' => htmlspecialchars($rez['text']), 'id' => $_REQUEST['id'])); 
}

if(isset($_REQUEST['id'])  and $_REQUEST['action']=='del_cars'){
    
    $deles=mysql_query("DELETE FROM cars WHERE id='".$_REQUEST['id']."'", $db);
    echo json_encode(array( 'id' => '1')); 
}



if(isset($_REQUEST['id'])  and $_REQUEST['action']=='del_special3'){
    
    $deles=mysql_query("DELETE FROM model_special WHERE id='".$_REQUEST['id']."'", $db);
    echo json_encode(array( 'id' => '1')); 
}

if(isset($_REQUEST['id'])  and $_REQUEST['action']=='del_press3'){
    
    $deles=mysql_query("DELETE FROM model_press WHERE id='".$_REQUEST['id']."'", $db);
    echo json_encode(array( 'id' => '1')); 
}

if(isset($_REQUEST['id'])  and $_REQUEST['action']=='del_t'){
    
    $deles=mysql_query("DELETE FROM komissionnaja_table WHERE id='".$_REQUEST['id']."'", $db);
    $p_cat=$_REQUEST['id'];
    echo json_encode(array( 'id' => $p_cat)); 
}
if(isset($_REQUEST['id'])  and $_REQUEST['action']=='del_tablesss'){
    
    $deles=mysql_query("DELETE FROM pcategory WHERE id='".$_REQUEST['id']."'", $db);
    
    echo json_encode(array( 'id' => '1')); 
}

if(isset($_REQUEST['id'])  and $_REQUEST['action']=='de'){
    
    $deles=mysql_query("DELETE FROM pdf WHERE id='".$_REQUEST['id']."'", $db);
    
    echo json_encode(array( 'id' => '1')); 
}

if(isset($_REQUEST['id'])  and $_REQUEST['action']=='del_tablesss2'){
    
    $deles=mysql_query("DELETE FROM page WHERE id='".$_REQUEST['id']."'", $db);
    
    echo json_encode(array( 'id' => '1')); 
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='edit_tit'){
    $t=mysql_query("SELECT * FROM komissionnaja WHERE id='".$_REQUEST['id']."'", $db);
    $te = mysql_fetch_array($t);
    $p=$te['name'];
    echo json_encode(array( 'name' => $p));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='edit_st'){
    $t=mysql_query("SELECT * FROM komissionnaja_table  WHERE id='".$_REQUEST['id']."'", $db);
    $te = mysql_fetch_array($t);
    $query=mysql_query("UPDATE komissionnaja_table  SET text='".$_REQUEST['text']."' WHERE id='".$_REQUEST['id']."'");
    $p=$te['kto'];
    echo json_encode(array( 'id' => $p));
}

//
if(isset($_REQUEST['id']) and $_REQUEST['action']=='resets_gal'){
    
    $us=mysql_query("SELECT * FROM model_gallery WHERE id='".$_REQUEST['id']."'");
    $rez=mysql_fetch_array($us);
    $p=$rez[$_REQUEST['reg']];
    echo json_encode(array( 'json' => $p));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='resets_galjs'){
    
    $query=mysql_query("UPDATE model_gallery  SET $_REQUEST[reg]='".$_REQUEST['name']."' WHERE id='".$_REQUEST['id']."'");
    $p=$_REQUEST['name'];
    echo json_encode(array( 'json' => $p));
    
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_imgs'){
    
    $deles=mysql_query("DELETE FROM model_gallery_img WHERE id ='".$_REQUEST['id']."' ", $db);
    unlink('../photo/gallery/m_'.$_REQUEST['id'].'.jpg');
    unlink('../photo/gallery/b_'.$_REQUEST['id'].'.jpg');
    
    echo json_encode(array( 'json' => '1'));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='obzor'){
    
    $us=mysql_query("SELECT * FROM model_review WHERE wher='".$_REQUEST['id']."'");
    $rez=mysql_fetch_array($us);
    echo json_encode(array( 'json' => $rez['text']));
    
}


if(isset($_REQUEST['id']) and $_REQUEST['action']=='obzor_zapros'){
    
    $us=mysql_query("SELECT * FROM model_review WHERE id='".$_REQUEST['id']."'");
    $rez=mysql_fetch_array($us);
    echo json_encode(array( 'json' => $rez['text']));
    
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='obzor_zapros_dell'){
    
    $us=mysql_query("DELETE FROM model_review WHERE id='".$_REQUEST['id']."'");
    
}




if(isset($_REQUEST['id']) and $_REQUEST['action']=='newsalon'){
    if($_REQUEST['st']=='0'){
    $query=mysql_query("Insert into salon  SET id_motor='".$_REQUEST['id']."', name='".$_REQUEST['text']."'");
    }elseif($_REQUEST['st']=='1'){
    $query=mysql_query("UPDATE salon  SET name='".$_REQUEST['text']."' WHERE id='".$_REQUEST['id']."'");    
    }elseif($_REQUEST['st']=='5'){
    $query=mysql_query("UPDATE options  SET name='".$_REQUEST['text']."' WHERE id='".$_REQUEST['id']."'"); 
    }  elseif($_REQUEST['st']=='4'){
    $query=mysql_query("Insert into options  SET id_motor='".$_REQUEST['id']."', name='".$_REQUEST['text']."'");
    }  
    echo json_encode(array( 'json' => '1'));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='reg_salon'){
    
    $us=mysql_query("SELECT * FROM salon WHERE id='".$_REQUEST['id']."'");
    $rez=mysql_fetch_array($us);
    echo json_encode(array( 'json' => $rez['name']));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_salon'){
    $deles=mysql_query("DELETE FROM salon WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_salon2'){
    $deles=mysql_query("DELETE FROM configurator_4 WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_op'){
    $deles=mysql_query("DELETE FROM options WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='edit_op'){
    
    $us=mysql_query("SELECT * FROM options WHERE id='".$_REQUEST['id']."'");
    $rez=mysql_fetch_array($us);
    echo json_encode(array( 'json' => $rez['name']));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_op_'){
    $deles=mysql_query("DELETE FROM configurator_5 WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_dvig'){
    $deles=mysql_query("DELETE FROM configurator_2 WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_komplect'){
    $deles=mysql_query("DELETE FROM configurator_1 WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}
if(isset($_REQUEST['idavto']) and $_REQUEST['action']=='komplect'){
    $names=htmlspecialchars($_REQUEST['name']);
    
    $query=mysql_query("Insert into configurator_1  SET name='".$names."', cena='".$_REQUEST['cena']."', id_avto='".$_REQUEST['idavto']."'");
    echo json_encode(array( 'json' => '1'));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='komplect_edit'){
    $us=mysql_query("SELECT * FROM configurator_1 WHERE id='".$_REQUEST['id']."'");
    $rez=mysql_fetch_array($us);
    echo json_encode(array( 'json' => $rez['name'],'json_' => $rez['cena'] ));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='ekomplect'){
    $names=htmlspecialchars($_REQUEST['name']);
    $query=mysql_query("UPDATE configurator_1  SET name='".$names."', cena='".$_REQUEST['cena']."' WHERE id='".$_REQUEST['id']."'"); 
    echo json_encode(array( 'json' => '1'));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='delekomplect'){
    $deles=mysql_query("DELETE FROM configurator_1 WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}



if(isset($_REQUEST['id']) and $_REQUEST['action']=='m_edit'){
    $t=mysql_query("SELECT * FROM configurator WHERE id='".$_REQUEST['id']."'", $db);
    $te = mysql_fetch_array($t);
    $p=$te['name'];
    $t=$te['text'];
    $c=$te['cena'];
    echo json_encode(array( 'name' => $p, 'text' => $t, 'cena' => $c));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_m'){
    $deles=mysql_query("DELETE FROM configurator WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='key'){
    $t=mysql_query("SELECT * FROM `key` WHERE id='".$_REQUEST['id']."'", $db);
    $te = mysql_fetch_array($t);
    $k=$te['k'];
    $d=$te['d'];
    $t=$te['t'];
    echo json_encode(array( 't' => $t, 'k' => $k, 'd' => $d));
}



if(isset($_REQUEST['id']) and $_REQUEST['action']=='dells'){
    $deles=mysql_query("DELETE FROM page WHERE id ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}

if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_car_komiss'){
    $deles=mysql_query("DELETE FROM cars WHERE `car_id` ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}
if(isset($_REQUEST['id']) and $_REQUEST['action']=='del_car_new'){
    $deles=mysql_query("DELETE FROM cars_new WHERE `car_id` ='".$_REQUEST['id']."' ", $db);
    echo json_encode(array( 'json' => '1'));
}


?>




