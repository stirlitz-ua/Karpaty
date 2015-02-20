<?session_start(); include_once "../../bd.php";include_once "arrays.php";
if(!empty($_SESSION['compar'])){ foreach($_SESSION['compar'] as $r) {$qer[] = "`car_id` = '$r'";}
$q2=mysql_query('SELECT * FROM `cars_color` ORDER BY name');
    while($col=mysql_fetch_assoc($q2)){$colors[$col['id']]=$col['name'];}
$request="SELECT * FROM cars_new WHERE ".implode(' or ',$qer);
$im1="<img src=\"/newcars/img/img-circle-01.gif\" alt=\"\" />";
$im2="<img src=\"/newcars/img/img-circle-02.gif\" alt=\"\" />";
$q=mysql_query($request);
$car1=mysql_fetch_assoc($q);$car2=mysql_fetch_assoc($q);$car3=mysql_fetch_assoc($q);}
?>
<div class="pos">
  <ul class="search">
    <li class="active"><a href="/newcars/" onclick="return ShowTabResults();"><span>К результатам поиска</span></a></li>
    <li><a href="/newcars/?search"><span>Новый поиск</span></a></li>
    <!--li><a href="#" onclick="return ShowTabSearch();"><span>Уточнить результаты поиска</span></a></li-->
  </ul>
</div>

<div class="compare">
  <div class="col-1"><p></p></div>

<?if(!empty($car1)){?>
	<div class="col">
		<div class="model">
    		<div class="img-frame">
    				<img src="/newcars/images/Photo.php?id=img_<?echo $car1['car_id'];?>_0.jpg" width="215" height="161" alt="" />
    				<a href="#" onclick="return CompareToogle({ id:<?echo $car1['car_id'];?>, title:'<?echo $car1['car_name'];?>', price:<?echo $car1['car_price'];?>, refresh:1 })" class="remove"></a>			
            </div>
			<div class="wrap">
				<strong><?echo $car1['car_name'].' '.$car1['car_name2'].' '.$car1['car_name3'].' '.$car1['car_power'].'л.с. '.$car1['car_name4'].'';?></strong>
				<p><?echo number_format($car1['car_price'], 0, '.', ' ');?> $.
                <?echo ($car1['car_bron']=='1')?'<strong style="color:red;"> ЗАБРОНИРОВАНО</strong>':'';?></p>
				<ul class="actions">
					<li><a href="/newcars/Details.php?id=<?echo $car1['car_id'];?>&table=compares&n=1">Подробнее</a></li>
					<li><a href="" onclick="return FavouriteToogle({ id:<?echo $car1['car_id'];?>, title:'<?echo $car1['car_name'];?>', price:<?echo $car1['car_price'];?> })">Добавить в избранное</a></li>
				</ul>
			</div>
		</div>
	</div>
<?}if(!empty($car2)){?>
	<div class="col">
		<div class="model">
    		<div class="img-frame">
    				<img src="/newcars/images/Photo.php?id=img_<?echo $car2['car_id'];?>_0.jpg" width="215" height="161" alt="" />
    				<a href="#" onclick="return CompareToogle({ id:<?echo $car2['car_id'];?>, title:'<?echo $car2['car_name'];?>', price:<?echo $car2['car_price'];?>, refresh:1 })" class="remove"></a>			
            </div>
			<div class="wrap">
				<strong><?echo $car2['car_name'].' '.$car2['car_name2'].' '.$car2['car_name3'].' '.$car2['car_power'].'л.с.  '.$car2['car_name4'].'';?></strong>
				<p><?echo number_format($car2['car_price'], 0, '.', ' ');?> $.
                <?echo ($car['car_bron']=='1')?'<strong style="color:red;"> ЗАБРОНИРОВАНО</strong>':'';?></p>
				<ul class="actions">
					<li><a href="/newcars/Details.php?id=<?echo $car2['car_id'];?>&table=compares&n=2">Подробнее</a></li>
					<li><a href="" onclick="return FavouriteToogle({ id:<?echo $car2['car_id'];?>, title:'<?echo $car2['car_name'];?>', price:<?echo $car2['car_price'];?> })">Добавить в избранное</a></li>
				</ul>
			</div>
		</div>
	</div>
<?}if(!empty($car3)){?>
	<div class="col">
		<div class="model">
    		<div class="img-frame">
    				<img src="/newcars/images/Photo.php?id=img_<?echo $car3['car_id'];?>_0.jpg" width="215" height="161" alt="" />
    				<a href="#" onclick="return CompareToogle({ id:<?echo $car3['car_id'];?>, title:'<?echo $car3['car_name'];?>', price:<?echo $car3['car_price'];?>, refresh:1 })" class="remove"></a>			
            </div>
			<div class="wrap">
				<strong><?echo $car3['car_name'].' '.$car3['car_name2'].' '.$car3['car_name3'].' '.$car3['car_power'].'л.с.  '.$car3['car_name4'].'';?></strong>
				<p><?echo number_format($car3['car_price'], 0, '.', ' ');?> $.
                <?echo ($car3['car_bron']=='1')?'<strong style="color:red;"> ЗАБРОНИРОВАНО</strong>':'';?></p>
				<ul class="actions">
					<li><a href="/newcars/Details.php?id=<?echo $car3['car_id'];?>&table=compares&n=3">Подробнее</a></li>
					<li><a href="" onclick="return FavouriteToogle({ id:<?echo $car3['car_id'];?>, title:'<?echo $car3['car_name'];?>', price:<?echo $car3['car_price'];?> })">Добавить в избранное</a></li>
				</ul>
			</div>
		</div>
	</div>
<?}?>
	
  <div class="holder">
    <div class="col-1"><p>Цвет</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.$colors[$car1['car_color']].'</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.$colors[$car2['car_color']].'</p>';}?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.$colors[$car3['car_color']].'</p>';}?></div>
    <!--div class="col-1"><p>Год выпуска</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.$car1['car_year'].'</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.$car2['car_year'].'</p>';}?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.$car3['car_year'].'</p>';}?></div>
    <div class="col-1"><p>Пробег</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.number_format($car1['car_run'], 0, '.', ' ').' км.</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.number_format($car2['car_run'], 0, '.', ' ').' км.</p>'; }?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.number_format($car3['car_run'], 0, '.', ' ').' км.</p>'; }?></div-->
    <div class="col-1"><p>КПП</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.$car_gearbox[$car1['car_gearbox']].'</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.$car_gearbox[$car2['car_gearbox']].'</p>';}?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.$car_gearbox[$car3['car_gearbox']].'</p>';}?></div>
    <div class="col-1"><p>Привод</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.$car_drivegear[$car1['car_drivegear']].'</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.$car_drivegear[$car2['car_drivegear']].'</p>';}?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.$car_drivegear[$car3['car_drivegear']].'</p>';}?></div>
    <div class="col-1"><p>Мощность двигателя</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.$car1['car_power'].' л.с.</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.$car2['car_power'].' л.с.</p>';}?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.$car3['car_power'].' л.с.</p>';}?></div>
    <div class="col-1"><p>Объём двигателя</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.$car1['car_volume'].' л</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.$car2['car_volume'].' л</p>'; }?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.$car3['car_volume'].' л</p>'; }?></div>
    <div class="col-1"><p>Тип топлива</p></div>
        <div class="col-2"><?if(!empty($car1)){ echo '<p>'.$car_fuel[$car1['car_fuel']].'</p>'; }?></div>
        <div class="col-2"><?if(!empty($car2)){ echo '<p>'.$car_fuel[$car2['car_fuel']].'</p>';}?></div>
        <div class="col-2"><?if(!empty($car3)){ echo '<p>'.$car_fuel[$car3['car_fuel']].'</p>';}?></div>
    <!--div class="col-1"><p>Гарантия производителя</p></div>
        <div class="col-2"><?if(!empty($car1) and $car1['car_garant']==1){ echo '<p>да</p>';}?></div>
        <div class="col-2"><?if(!empty($car2) and $car2['car_garant']==1){ echo '<p>да</p>';}?></div>
        <div class="col-2"><?if(!empty($car3) and $car3['car_garant']==1){ echo '<p>да</p>';}?></div-->
    <div class="col-1"><p>В наличии</p></div>
        <div class="col-2"><?if(!empty($car2) and $car1['car_isset']-518400>time()){echo '<p>через '.(date('W',$car1['car_isset'])-date('W')).' недель</p>';}else{echo '<p>на складе</p>';}?></div>
        <div class="col-2"><?if(!empty($car2) and $car2['car_isset']-518400>time()){echo '<p>через '.(date('W',$car2['car_isset'])-date('W')).' недель</p>';}else{echo '<p>на складе</p>';}?></div>
        <div class="col-2"><?if(!empty($car2) and $car3['car_isset']-518400>time()){echo '<p>через '.(date('W',$car3['car_isset'])-date('W')).' недель</p>';}else{echo '<p>на складе</p>';}?></div>
    
<ul class="accordion">    
<?/*foreach($options as $cat => $a){?>
    <li><a href="#" class="opener"><?echo $cat;?></a>
      <div class="drop" id="Div1">
      <?foreach($a as $i=>$val){?>
	      <div class="col-1"><p title="Биксеноновые фары"><?echo $val;?></p></div>  
        
        <div class="col-2"><?if(!empty($car1)){ if(substr_count($car1['car_options'], $i)!=0) echo $im1; else echo $im2;}?></div>
        <div class="col-2"><?if(!empty($car2)){ if(substr_count($car2['car_options'], $i)!=0) echo $im1; else echo $im2;}?></div>
        <div class="col-2"><?if(!empty($car3)){ if(substr_count($car3['car_options'], $i)!=0) echo $im1; else echo $im2;}?></div>
      <?}?>
    </div></li>
<?}*/?>
    
</ul>     
          
  </div>
  
</div>