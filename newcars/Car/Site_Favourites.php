<?session_start();
include_once "../../bd.php";
include_once "arrays.php";
?>
<script type="text/javascript">
  function DeleteItem(el) {
    $(el).closest("tr").hide();
  }
</script>

<div class="pos">
  <ul class="search">
    <li class="active"><a href="#" onclick="return ShowTabResults();"><span>К результатам поиска</span></a></li>
    <li><a href="/newcars/?search"><span>Новый поиск</span></a></li>
    <li><a href="#" onclick="return ShowTabSearch();"><span>Уточнить результаты поиска</span></a></li>
  </ul>
</div>

<form class="favourite" action="#">
	<fieldset>
    <div class="row">
	    <p>1 - <?echo count($_SESSION['select']);?> из <?echo count($_SESSION['select']);?> автомобилей</p>
	    <div class="section" style="display:none">
		    <label for="quantuty">Отображать на странице</label>
		    <select id="quantuty" name="quantuty">
			    <option value="10">10</option>
			    <option value="20">20</option>
			    <option value="30">30</option>
			    <option value="40">40</option>
			    <option value="50">50</option>
		    </select>
	    </div>
    </div>
    

    
		<table>
			<thead>
				<tr>
        			<th class="cell-1"><span val="6" class="<?if($_GET['sort']=='6') echo 'sortasc'; if($_GET['sort']=='-6') echo 'sortdsc';?>">Модель/Комплектация, мощность двигателя, КПП</span></th>
        			<th class="cell-2"></th>
                    <th class="cell-3"><span val="2" class="<?if($_GET['sort']=='2') echo 'sortasc'; if($_GET['sort']=='-2') echo 'sortdsc';?>">В наличии</span></th>
        			<th class="cell-4"></th>
        			<th class="cell-5"><span val="1" class="<?if($_GET['sort']=='1') echo 'sortasc'; if($_GET['sort']=='-1') echo 'sortdsc';?>">Цена</span></th>
				</tr>
			</thead>
			<tbody>    


    
<?

if(is_array($_SESSION['select']) and !empty($_SESSION['select'])){
    $request="SELECT * FROM cars_new ";// формирование запроса к базе
    $request.="WHERE ";
    foreach($_SESSION['select'] as $i=>$val){
        $req[]="`car_id` = '$val'";
    }
   if(is_array($req))$request.=implode(' or ',$req); 

//if($_GET['sort']!='0'){
//$request.=" ORDER BY car_".$sort_by[abs($_GET['sort']*1)]; if($_GET['sort']<0) $request.=" DESC";
//}
//$request.=" LIMIT ".($_GET['page']-1)*$_GET['rows'].",".$_GET['rows'];
//echo $request;
$q=mysql_query($request);$i=1;
while($row=mysql_fetch_assoc($q)){
?>

<tr>
	<td class="cell-1">
		<img src="/newcars/images/Photo.php?id=img_<?echo $row['car_id'];?>w_0.jpg" alt="" />
		<strong><?echo $row['car_name'].' '.$row['car_name2'].' '.$row['car_name3'].' '.$row['car_power'].'л.с.  '.$row['car_name4'].'';?></strong>
		<p><?echo $row['car_power'];?> л.с., <?echo $car_gearbox[$row['car_gearbox']];?></p>
        <?    echo ($row['car_bron']=='1')?'<p><strong style="color:red;">ЗАБРОНИРОВАНО</strong></p>':'';?>
	</td>

	<td class="cell-2">
		<p></p>
	</td>
	<td class="cell-3">
        <?if($row['car_isset']-518400>time()){$gk='через '.(date('W',$row['car_isset'])-date('W')).' недель';}else{$gk='на складе';}?>
		<p><?echo $gk;?></p>
	</td>
	
	<td class="cell-4">
		<p></p>
	</td>
	<td class="cell-5">
		<p><?echo number_format($row['car_price'], 0, '.', ' ');?> $.</p>
	</td>
	<td class="popaper">
		<div class="drop-down" style="display:none">
			<div class="bg">
				<ul class="drop-list">
					<li class="active"><a href="/newcars/Details.php?id=<?echo $row['car_id'];?>&n=<?echo $i;?>&table=favorite"><span>Подробнее</span></a></li>
					<li><a href="" onclick="return CompareToogle({ id:<?echo $row['car_id'];?>, title:'<?echo $row['car_name'];?>', price:<?echo $row['car_price'];?> })"><span>К сравнению</span></a></li>
					<li><a href="" onclick="DeleteItem(this);return FavouriteToogle({ id:<?echo $row['car_id'];?>, title:'<?echo $row['car_name'];?>', price:<?echo $row['car_price'];?> })"><span>Удалить из избранного</span></a></li>
				</ul>
			</div>
		</div>
	</td>
</tr>
<?}}?>

			</tbody>
		</table>



  </fieldset>
</form>