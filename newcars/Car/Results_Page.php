<?session_start(); 
$totalrows=$_SESSION['count'];//$totalrows=319; 
include_once "../../bd.php"; 
include_once "../../kurs.php";
include_once "arrays.php";
if(!$_GET['rows']) $_GET['rows']=10;
if(!$_GET['sort']) $_GET['sort']=2;
if(!$_GET['page']) $_GET['page']=1;
$_SESSION['sort']=$_GET['sort'];
$l_page=ceil($totalrows/$_GET['rows']); echo '<strong>$1 = ' .$kurs; echo'</strong>';
?>
<form class="favourite" action="#">
	<fieldset>



    <div class="row">
    <? $f_row=$_GET['rows']*($_GET['page']-1)+1;
       $l_row=$_GET['rows']*$_GET['page']; if($l_row>$totalrows) $l_row=$totalrows;
    echo "<p>$f_row - $l_row из $totalrows автомобилей</p>";?>
	    <div class="section">
		    <label for="cbrows">Отображать на странице</label>
		    <select id="cbrows" name="cbrows">
			    <option value="10"<?if($_GET['rows']=='10') echo " selected";?>>10</option>
			    <option value="20"<?if($_GET['rows']=='20') echo " selected";?>>20</option>
		    </select>
	    </div>
    </div>

<a href="/newcars/Car/Results_Page.php?page=<?echo $_GET['page'];?>&amp;sort=0&amp;rows=<?echo $_GET['rows'];?>" id="changesort" onclick="Sys.Mvc.AsyncHyperlink.handleClick(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'dResults', onSuccess: Function.createDelegate(this, InitSorter) });" style="display:none">S</a>

  <input id="hrows" type="hidden" value="<?echo $_GET['rows'];?>" />



<div class="pages">
<ul>
<?
if($_GET['page']!='1'){?>    <li><a class="prev" href="/newcars/Car/Results_Page.php?page=<?echo $_GET['page']-1;?>&amp;sort=<?echo $_GET['sort'];?>&amp;rows=<?echo $_GET['rows'];?>" onclick="Sys.Mvc.AsyncHyperlink.handleClick(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'dResults', onSuccess: Function.createDelegate(this, InitSorter) });">Предыдущая</a></li>  
<?}
for($i=1;$i<=$l_page;$i++){
    echo "<li"; if($_GET['page']==$i)echo ' class="active"';
    echo "><a href=\"/newcars/Car/Results_Page.php?page=$i&amp;sort=$_GET[sort]&amp;rows=$_GET[rows]\" onclick=\"Sys.Mvc.AsyncHyperlink.handleClick(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'dResults', onSuccess: Function.createDelegate(this, InitSorter) });\">$i</a></li>";
    echo ""; }  
    
if($_GET['page']!=$l_page){?>  

    <li><a class="next" href="/newcars/Car/Results_Page.php?page=<?echo $_GET['page']+1;?>&amp;sort=<?echo $_GET['sort'];?>&amp;rows=<?echo $_GET['rows'];?>" onclick="Sys.Mvc.AsyncHyperlink.handleClick(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'dResults', onSuccess: Function.createDelegate(this, InitSorter) });">Следующая</a></li>
<?}?>
</ul>
</div>



<table class="allowsort">
	<thead>
		<tr>
			<th class="cell-1"><span val="6" class="<?if($_GET['sort']=='6') echo 'sortasc'; if($_GET['sort']=='-6') echo 'sortdsc';?>">Модель/Комплектация, мощность двигателя, КПП</span></th>
            <th class="cell-2"></th>
			<th class="cell-3"><span val="3" class="<?if($_GET['sort']=='3') echo 'sortasc'; if($_GET['sort']=='-3') echo 'sortdsc';?>">Контракт</span></th>
            <th class="cell-4"><span val="2" class="<?if($_GET['sort']=='2') echo 'sortasc'; if($_GET['sort']=='-2') echo 'sortdsc';?>">В наличии</span></th>
			<th class="cell-5"><span val="1" class="<?if($_GET['sort']=='1') echo 'sortasc'; if($_GET['sort']=='-1') echo 'sortdsc';?>">Цена</span></th>
		</tr>
	</thead>
	<tbody>    
    
<?
$request="SELECT * FROM cars_new ";// формирование запроса к базе по поиску
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

if($_GET['sort']!='0'){
$request.=" ORDER BY car_".$sort_by[abs($_GET['sort']*1)]; if($_GET['sort']<0) $request.=" DESC";
}
$limfrom=($_GET['page']-1)*$_GET['rows'];
$request.=" LIMIT ".$limfrom.",".$_GET['rows'];
//echo $request;
$q=mysql_query($request); $i=1;
while($row=mysql_fetch_assoc($q)){
?>
<tr>
	<td class="cell-1">
		<img src="/newcars/images/Photo.php?id=img_<?echo $row['car_id'];?>z_0.jpg" alt="" />
		<strong><?echo $row['car_name'].' '.$row['car_name2'].' '.$row['car_name3'].' '.$row['car_power'].'л.с. '.$row['car_name4'];?></strong>
		<p><?echo $row['car_power'];?> л.с., <?echo $car_gearbox[$row['car_gearbox']];?>,<br> цвет автомобиля: <?echo $colors[$row['car_color']];?></p>
        <?    echo ($row['car_bron']=='1')?'<p><strong style="color:red;">ЗАБРОНИРОВАНО</strong></p>':'';?>
	</td>
	<td class="cell-2">
		<p></p>

	<td class="cell-3">
		<p><?echo $row['car_kontrakt'];?></p>
	</td>
	<td class="cell-4">
        <?if($row['car_isset']-518400>time()){$gk='через '.(date('W',$row['car_isset'])-date('W')).' недель';}else{$gk='на складе';}?>
		<p><?echo $gk;?></p>
	</td>
	
	</td>
	<td class="cell-5">
        <p class="<?if($row['car_price_new']!=0) echo 'oldprice';?>"><?echo number_format( get_grn($row['car_price']) , 0, '.', ' '); $st='';?> UAH</p>
        <?if($row['car_price_new']!=0){?>
		<p class="newprice"><?echo number_format(12*($row['car_price_new']), 0, '.', ' ');?> UAH</p><?
        }?>
	</td>
	<td class="popaper">
		<div class="drop-down" style="display:none">
			<div class="bg">
				<ul class="drop-list">
					<li class="active"><a href="/newcars/Details.php?id=<?echo $row['car_id'];?>&n=<?echo $limfrom+$i;?>"><span>Подробнее</span></a></li>
					<li><a href="" onclick="return CompareToogle({ id:<?echo $row['car_id'];?>, title:'<?echo $row['car_name'];?>', price:<?echo $row['car_price'];?> })"><span>К сравнению</span></a></li>
					<li><a href="" onclick="return FavouriteToogle({ id:<?echo $row['car_id'];?>, title:'<?echo $row['car_name'];?>', price:<?echo $row['car_price'];?> })"><span>Добавить в избранное</span></a></li>
				</ul>
			</div>
		</div>
	</td>
</tr>
<?$i++;}?>

	</tbody>
</table>



<div class="pages">
<ul>
<?
if($_GET['page']!='1'){?>    <li><a class="prev" href="/newcars/Car/Results_Page.php?page=<?echo $_GET['page']-1;?>&amp;sort=<?echo $_GET['sort'];?>&amp;rows=<?echo $_GET['rows'];?>" onclick="Sys.Mvc.AsyncHyperlink.handleClick(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'dResults', onSuccess: Function.createDelegate(this, InitSorter) });">Предыдущая</a></li>  
<?}
for($i=1;$i<=$l_page;$i++){
    echo "<li"; if($_GET['page']==$i)echo ' class="active"';
    echo "><a href=\"/newcars/Car/Results_Page.php?page=$i&amp;sort=$_GET[sort]&amp;rows=$_GET[rows]\" onclick=\"Sys.Mvc.AsyncHyperlink.handleClick(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'dResults', onSuccess: Function.createDelegate(this, InitSorter) });\">$i</a></li>";
    echo ""; }  
    
if($_GET['page']!=$l_page){?>  

    <li><a class="next" href="/newcars/Car/Results_Page.php?page=<?echo $_GET['page']+1;?>&amp;sort=<?echo $_GET['sort'];?>&amp;rows=<?echo $_GET['rows'];?>" onclick="Sys.Mvc.AsyncHyperlink.handleClick(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'dResults', onSuccess: Function.createDelegate(this, InitSorter) });">Следующая</a></li>
<?}?>
</ul>
</div>



  </fieldset>
</form>

