<?
include "class_json.php";
include "../bd.php";


$controls0=array();
$controls1=array();
$controls2=array();
$ar_t_cena=array();
$model=array();


$content =   file ( '../dl.txt' );
$pr=$content[0];

$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='0' ORDER BY idd ASC");
$i=0;
while($mset=mysql_fetch_array($ms)){
    $controls0[$i]['value']=$mset['link'];
    $controls0[$i]['label']=$mset['name'];
    $controls0[$i]['selected']=true;
    $i++;
}


$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='1' ORDER BY idd ASC");while($mset=mysql_fetch_array($ms)){$ar_t_cena[]=$mset['name'];}
$controls1['left']=intval($ar_t_cena[0]);
$controls1['right']=intval($ar_t_cena[1]);
$controls1['scaleIncrement']=100;
$controls1['defaultStartValue']=100-intval($ar_t_cena[0]);
$controls1['defaultEndValue']=intval($ar_t_cena[1]);


$ms=mysql_query("SELECT * FROM  `set_models` WHERE id_cat='2' ORDER BY idd ASC");
$i=0;
while($mset=mysql_fetch_array($ms)){
    if($i==0){
        $controls2[$i]['valueRef']='transmission';
        $controls2[$i]['abbreviation']='GT';
        $controls2[$i]['value']=$mset['link'];
        $controls2[$i]['label']=$mset['name'];
        $controls2[$i]['selected']=true; 
    }else{
        $controls2[$i]['valueRef']='engine';
        $controls2[$i]['abbreviation']='FT';
        $controls2[$i]['value']=$mset['link'];
        $controls2[$i]['label']=$mset['name'];
        $controls2[$i]['selected']=true;
    }
    $i++;
}

    



$md=mysql_query("SELECT * FROM  `models` WHERE weight='1' AND visible='1' ORDER BY idd DESC");
$s=0;
while($mod=mysql_fetch_array($md)){
    
    $cena=intval($mod['cena']);
    $cena=sprintf("%01.2f",$cena);
    
    $model[$s]['metadata']['name']=$mod['name'];
    $model[$s]['metadata']['priceText']= number_format($cena, 2, ',', ' ').' $';
    $model[$s]['metadata']['cutoutImages'][0]="/photo/model/".$mod['link']."0.png";
    $model[$s]['metadata']['cutoutImages'][1]="/photo/model/".$mod['link']."1.png";
    $model[$s]['metadata']['cutoutImages'][2]="/photo/model/".$mod['link']."2.png";
    $model[$s]['metadata']['cutoutImages'][3]="/photo/model/".$mod['link']."3.png";
    $model[$s]['submodels'][0]['vehicleCategory'][]=$mod['categiry'];
    $model[$s]['submodels'][0]['price']=$cena;
    $model[$s]['submodels'][0]['consumption']=intval(0);
    $model[$s]['submodels'][0]['urbanConsumption']=intval(0);
    $model[$s]['submodels'][0]['extraUrbanConsumption']=intval(0);
    
    $sdf=unserialize($mod['ch']);
    $is=0;
    foreach($sdf as $val){
        if($is==0){
            $model[$s]['submodels'][0]['transmission']=$val;
        }else{
            $model[$s]['submodels'][0]['engine'][]=$val;
        }
        $is++;
    }
    $model[$s]['links'][0]['url']="/models/".$mod['link']."/";
    $model[$s]['links'][0]['linkTarget']="_self";
    $model[$s]['links'][0]['name']="Подробнее";
$s++;
}




$model=array(
'configuration'=>array( "thousandseparator" => "","hundredthseparator" => ",","currency_suffix" => "грн.","version"=>2), 

'filters'=>array(
    array("label"=>"Категория","type" => "Checkbox", "valueRef"=>"vehicleCategory", "abbreviation"=>"VC", 'controls'=>$controls0),
    array( "type" => "DoubleSlider", "label" => "Цены в гривне","valueRef"=>"price",  "abbreviation"=>"PR", "control"=>$controls1),
    array("label" => "Двигатель и трансмиссия","type" => "MultirefCheckbox",'controls'=>$controls2)),  
'content'=>array("modelfinderHeadline" => "Модели","filterHeadline" => "Выберите:","resetLabel" => "Сбросить", "noResult" => array("headline" => "Ничего не найдено","text" => "По вашему запросу ничего не найдено.\n\n Что Вы хотите сделать дальше?","backLabel" => "Вернуться на предыдущую страницу","resetLabel" => "Сбросить все фильтры"),
"footerLinks" => array(
        array("url" => "/configurator/", "linkTarget" => "_self", "name" => "Конфигуратор"),
        array("url" => "/avto_in_stock/", "linkTarget" => "_self", "name" => "Автомобили в наличии")
    )           
),       
        
'models'=>$model);
echo preg_replace_callback('/\\\u([0-9a-fA-F]{4})/', create_function('$match', 'return mb_convert_encoding("&#" . intval($match[1], 16) . ";", "UTF-8", "HTML-ENTITIES");'),json_encode($model));
?>