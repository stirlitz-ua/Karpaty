<?session_start();
include_once 'arrays.php';
include_once "../../bd.php";
include_once "../../kurs.php";
$q2=mysql_query('SELECT * FROM `cars_color` ORDER BY name');
    while($col=mysql_fetch_assoc($q2)){$colors[$col['id']]=$col['name'];}
?>
<div class="pos">
	<ul class="search-alt">
		<li><a href="/newcars/?search"><span>Новый поиск</span></a></li>
		<li class="active"><a href="/newcars/?m=tab2res"><span class="btResult lbResult"><?echo $_SESSION['count']?> автомобилей найдено</span></a></li>
	</ul>
</div>

<div class="aside-1">
<div id="dSel" class="box"></div>
<div class="parameters">
<a href="/newcars/?m=tab2res" class="total"><span class="btResult lbResult"><?echo $_SESSION['count'];?> автомобилей найдено</span></a>
<ul class="categories">
	<li>
		<a href="#" class="opener">Поиск</a>
		<div class="drop">
			<form action="#">
				<fieldset>
					<div>
                    <script type="text/javascript">
                      $(function() {
                        InitSlider('price', '0', '820000', 1000, '<?echo $_SESSION['search']['price'][1];?>', '<?echo $_SESSION['search']['price'][2];?>');
                        //InitSlider('run', '0', '1530000', 5000, '<?echo $_SESSION['search']['run'][1];?>', '<?echo $_SESSION['search']['run'][2];?>');
                        //InitSlider('year', '1970', '<?echo date('Y');?>', 1, '<?echo $_SESSION['search']['year'][1];?>', '<?echo $_SESSION['search']['year'][2];?>');
                        InitSlider('power', '0', '400', 10, '<?echo $_SESSION['search']['power'][1];?>', '<?echo $_SESSION['search']['power'][2];?>');
                        InitSlider('volume', '0', '6', 0.1, '<?echo $_SESSION['search']['volume'][1];?>', '<?echo $_SESSION['search']['volume'][2];?>');
                    
                        function InitSlider(name, vmin, vmax, vstep, val1, val2) {
                          var id = "#" + name;
                          var sl = id + " .range";
                          var v1 = id + " .value-left";
                          var v2 = id + " .value-right";
                          $(sl).slider({ range: true, min: eval(vmin), max: eval(vmax), step: vstep, values: [val1, val2],
                            slide: function(event, ui) {
                              $(v1).text(ui.values[0]);
                              $(v2).text(ui.values[1]);
                            },
                            change: function(event, ui) {
                              ApplyRangeFilter(name, ui.values[0], ui.values[1], true);
                            }
                          });
                          $(v1).text(val1)
                          $(v2).text(val2);
                          ApplyRangeFilter(name, val1, val2, false);
                        }
                      });
                    
                    </script>
                    <div id="DasW1" class="quality-mark">
                      <input type="checkbox" class="checkbox" alt="" id="isset" <?if($_SESSION['search']['isset']=='true') echo 'checked';?> onchange="CheckBoxFilterApply(this, 'isset')">
                      <label for="isset">
                        Есть в наличии
                      </label>
                    </div>
                   <div class="slider-box colors">
                      <p class="title">Модель</p>
                      <select id="selmodel"><option value=""></option>
                        <?foreach($models as $i=>$val){echo "<option value=\"$i\" ";
                        if($i==$_SESSION['search']['name2']) echo "selected";
                        echo">$i</option>";}?>
                      </select>
                    </div>
                   <div class="slider-box colors">
                      <p class="title">Комплектация</p>
                      <select id="selkomplekt">
                        <?if(isset($_SESSION['search']['name3'])){
                            //echo "test test";
                            foreach($models as $i=>$val){
                              if($i==$_SESSION['search']['name2'] and is_array($val))
                              foreach($val as $ii) {
                                echo "<option value=\"$ii\" ";
                                if($ii==$_SESSION['search']['name3']) echo "selected";
                                echo">$ii</option>";
                              }
                            }
                        }
                            ?>
                      </select>
                    </div>
                    
                    <!--div id="DasW2" class="quality-mark">
                      <input type="checkbox" class="checkbox" alt="" id="garant" <?if($_SESSION['search']['garant']=='true') echo 'checked';?> onchange="CheckBoxFilterApply(this, 'garant')">
                      <label for="garant">
                        Гарантия производителя
                      </label>
                      <a href="#" class="ico-info shide">&nbsp;</a>    
                    </div-->
                    <div class="row">&nbsp;</div>

                    <div id="price" class="slider-box">
                      <p class="title">Цена (UAH)</p>
                      <div class="slider-range range"></div>
                      <p class="value-left"></p><p class="value-right"></p>
                      <div class="cleatfix"></div>
                    </div>
                    
                    <!--div id="run" class="slider-box">
                      <p class="title">Пробег (км.)</p>
                      <div class="slider-range range"></div>
                      <p class="value-left"></p><p class="value-right"></p>
                      <div class="cleatfix"></div>
                    </div>
                    
                    <div id="year" class="slider-box">
                      <p class="title">Год выпуска</p>
                      <div class="slider-range range"></div>
                      <p class="value-left"></p><p class="value-right"></p>
                      <div class="cleatfix"></div>
                    </div-->
                    
                    <div id="power" class="slider-box">
                      <p class="title">Мощность двигателя (л.с.)</p>
                      <div class="slider-range range"></div>
                      <p class="value-left"></p><p class="value-right"></p>
                      <div class="cleatfix"></div>
                    </div>
                    
                    <div id="volume" class="slider-box">
                      <p class="title">Объём двигателя (л)</p>
                      <div class="slider-range range"></div>
                      <p class="value-left"></p><p class="value-right"></p>
                      <div class="cleatfix"></div>
                    </div>
                    
                    <div class="slider-box colors">
                      <p class="title">Цвет кузова</p>
                      <select id="selcolor"><option value=""> </option>
                        <?foreach($colors as $i=>$val){echo "<option value=\"$i\" ";
                        if($i==$_SESSION['search']['color']) echo "selected";
                        echo">$val</option>";}?>
                      </select>
                    </div>
					</div>
				</fieldset>
			</form>
		</div>
	</li>
    <?/*$n=1;
    foreach($options as $namekat=>$kat){// чекбоксы options Настрaиваемые в arrays.php
    echo '<li><a href="#" class="opener">'.$namekat.'</a><div class="drop">';
        foreach($kat as $i=>$val){
            echo '<input type="checkbox" class="check" id="op'.$i.'" />';
            echo '<label for="op'.$i.'">'.$val.'</label>';
        }
    echo '</div></li>';
    $n++;
    
    }*/?>
 </ul>
</div>				
</div>

<div class="aside-2">
    <div id="dResults">
     <?include 'Results_Page.php';?>    
    </div>
</div>
<script>
$(document).ready(function() {
//  if (typeof InitComboFilters == 'function') InitComboFilters();
//  InitOptionsFilters();
  $("#selcolor").change(function() {
    //alert('ooooooooooops');
    DO_GetCalcCars({ param: "color", val1: $(this).val() });
  });
  
  $("#selmodel").change(function() {
    if($(this).val()==''){$('#selkomplekt').html('');}else{
    $.post('../../admin/models.php',{action:'get_komplect',item:$(this).val()},function(obj){
                                                  if(obj!=='') $('#selkomplekt').html(obj);
                                                  //$('#komplect').combobox();
                                                  //alert(obj);
    });}
    DO_GetCalcCars({ param: "name2", val1: $(this).val() });
  });
  
  $("#selkomplekt").change(function() {
        DO_GetCalcCars({ param: "name3", val1: $(this).val() });
  });

});
</script>