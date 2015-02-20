<?session_start(); include_once "../bd.php";include_once "Car/arrays.php";?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >
<head><title>

</title>
	  <link href="/newcars/css/dop.css" rel="stylesheet" type="text/css" />  
	  <link href="/newcars/css/font-face.css" rel="stylesheet" type="text/css" />
	  <link href="/newcars/css/all.css" rel="stylesheet" type="text/css" />
	  
    <link href="/newcars/pub/favicon.ico" rel="shortcut icon" />
    <script type="text/javascript" src="/newcars/js/jquery-1.5.2.min.js"></script> 
    <script type="text/javascript" src="/newcars/js/jquery-ui-1.8.11.custom.min.js"></script>    

 
    <script src="/newcars/js/Locator.Details.js" type="text/javascript"></script> 
     
    <script src="/newcars/js/MicrosoftAjax.js" type="text/javascript"></script>  
    <script src="/newcars/js/MicrosoftMvcAjax.js" type="text/javascript"></script>     
    <!-- Подключать после всех js скриптов -->

 
    <script src="/newcars/js/galleria/galleria-1.2.2.js" type="text/javascript"></script> 
    <script src="/newcars/js/galleria/galleria.classic.min.js" type="text/javascript"></script>  

    
<!--[if lt IE 7]><link rel="stylesheet" href="/css/lt7.css" type="text/css"/><![endif]-->    

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-19031359-1']);
  _gaq.push(['_setDomainName', 'none']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
<div id="progress">
  <div class="popup-bg"></div>
  <div class="popup-content">
    <img src="/newcars/img/preloader.gif" alt=""/>
  </div>
</div>
<input id="importer" type="hidden" value='True' />
<input id="theme" type="hidden" value="/" />  
<div id="dError" style="display:none"></div>

  
  
  <div id="main" class="home inframe">
    <ul class="breadcrumbs">
      <li><a href="#">Мир Volkswagen</a></li>
      <li class="active"><a href="#">Автомобили новые</a></li>
    </ul>
    <!--h2>Автомобили новые</h2-->
    <ul class="search">
      <li class="active"><a href="/newcars/?m=tab2res"><span>К результатам поиска</span></a></li>
      <li><a href="/newcars/?search"><span>Новый поиск</span></a></li>
      <li><a href="/newcars/?m=tab2"><span>Уточнить результаты поиска</span></a></li>
    </ul>    
    
    <div id="dDetails">
<?$request="SELECT * FROM cars_new ";// формирование запроса к базе по поиску
if(is_array($_SESSION['search'])){
    $request.="WHERE ";
    foreach($_SESSION['search'] as $i=>$val){
        if(is_array($val)){
            $req[]="`car_$i`>='$val[1]'";
            $req[]="`car_$i`<='$val[2]'";
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
if($_SESSION['sort']!='0'){
$request.=" ORDER BY car_".$sort_by[abs($_SESSION['sort']*1)]; if($_SESSION['sort']<0) $request.=" DESC";
}
if($_GET['table']=='favorite'){
    if(is_array($_SESSION['select']) and !empty($_SESSION['select'])){
    $request="SELECT * FROM cars_new ";// формирование запроса к базе
    $request.="WHERE ";
    foreach($_SESSION['select'] as $i=>$val){
        $req[]="`car_id` = '$val'";
    }
   if(is_array($req))$request.=implode(' or ',$req); }
}

if($_GET['table']=='compares'){
    $request="SELECT * FROM cars_new ";// формирование запроса к базе
    $request.="WHERE `car_id`='$_GET[id]'";

}

$q=mysql_query($request);$i=1;
if($_GET['table']!='compares'){
while($i<=$_GET['n']){
    $row=mysql_fetch_assoc($q);
    $i++;
}}else $row=mysql_fetch_assoc($q);
$q2=mysql_query('SELECT * FROM `cars_color` ORDER BY name');
    while($col=mysql_fetch_assoc($q2)){
        $colors[$col['id']]=$col['name'];
    }
?>      
<input id="hfcurnum" type="hidden" value="<?echo $_GET['n'];?>" />
<input id="hfcurcnt" type="hidden" value="<?echo $_GET['table']==''? $_SESSION['count']:count($_SESSION['select']);?>" />
<input id="hfupd" type="hidden" value="0" />

<div class="entry">
  

<script type="text/javascript">

  function SetSelectorData() {
    var n = eval($("#hfcurnum").val());
    var cnt = eval($("#hfcurcnt").val());
    $(".curnum").text($("#hfcurnum").val());
    $(".curcnt").text($("#hfcurcnt").val());
    //s = "/Car/Details_Partial?page=";
    //s = '/Car/Details/30229?n=';
    var nprev = n - 1; if (nprev <= 0) nprev = 1;
    var nnext = n + 1; if (nnext > cnt) nnext = cnt;
    //$(".selprev").attr("href", s + nprev + "&table=" + $("#resultstable").val());
    //$(".selnext").attr("href", s + nnext + "&table=" + $("#resultstable").val());
    var rtable = $("#resultstable").val() == "" ? "" : "&table=" + $("#resultstable").val();
    $(".selprev").attr("href", "/newcars/Details.php?id="+$("#prevID").val()+"&n=" + nprev + rtable);
    $(".selnext").attr("href", "/newcars/Details.php?id="+$("#nextID").val()+"&n=" + nnext + rtable);    
    if(n==1) $(".selprev").hide();
    if(n==cnt) $(".selnext").hide();
    if ($("#hfupd").val() == 1) {
      //tb_init('a.thickbox, area.thickbox, input.thickbox');
    }
  }
  
  
  

    //<= Url.Content("/Car/Details/" + item.ID + "?n=" + item.n


</script>
<input id="resultstable" type="hidden" value='<?echo $_GET['table'];?>' />
<input id="prevID" type="hidden" value='30170' />
<input id="nextID" type="hidden" value='30170' />
<div class="heading">
  <a class="selprev prev-auto" href="/newcars/Details.php?id=30229$page=1">Предыдущий автомобиль</a>
  
  <h4>Автомобиль (<span class="curnum">2</span>/<span class="curcnt">2</span>)</h4>
  <a class="selnext next-auto" href="/newcars/Details.php?id=30229$page=1">Следующий автомобиль &nbsp;</a>
  
</div>

 
<h2><?echo $row['car_name'].' '.$row['car_name2'].' '.$row['car_name3'].' '.$row['car_power'].'л.с. '.$row['car_name4'];?></h2>
  <div class="holder">
    <div class="col-1">
      <dl>
        <dt>Цена</dt><dd>
            <p class="<?if($row['car_price_new']!=0) echo 'oldprice';?>"><?echo number_format($row['car_price'], 0, '.', ' '); $st='';?> $</p>
            <?if($row['car_price_new']!=0){?>
    		<p class="newprice"><?echo number_format($row['car_price_new'], 0, '.', ' ');?> $</p><?
            }?>
        </dd>
        <dt>Цвет</dt><dd> <?echo $colors[$row['car_color']].' ';?>&nbsp;</dd>
        <dt>Тип кузова</dt><dd><?echo $car_body[$row['car_body']];?>&nbsp;</dd>
        <dt>Владельцев</dt><dd><?echo $row['car_own'];?>&nbsp;</dd>
        <dt>Год выпуска</dt><dd><?echo $row['car_year'];?>&nbsp;</dd>        
        <!--dt>Пробег</dt><dd><?echo number_format($row['car_run'], 0, '.', ' ');?> км</dd-->
      	<dt>КПП</dt><dd><?echo $car_gearbox[$row['car_gearbox']];?>&nbsp;</dd>   
      	<dt>Привод</dt><dd><?echo $car_drivegear[$row['car_drivegear']];?>&nbsp;</dd>
        <dt>Мощность</dt><dd><?echo $row['car_power'];?> л.с.&nbsp;</dd>
        <dt>Объём</dt><dd><?echo $row['car_volume'];?> л</dd>
        <dt>Тип мотора</dt><dd><?echo $car_fuel[$row['car_fuel']];?>&nbsp;</dd>
        <?if($row['car_isset']-518400>time()){$gk='через '.(date('W',$row['car_isset'])-date('W')).' недель';}else{$gk='на складе';}?>
        <dt>В наличии</dt><dd><?echo $gk;?>&nbsp;</dd>                    
        <dt>Контакт</dt><dd><?echo $row['car_kontrakt'];?>&nbsp;</dd>                    
      	<dt>ID</dt><dd><?echo $row['car_id'];?>&nbsp;</dd>
      </dl>  
      
    </div>
    <div class="col-2">
      <div id="CarPhotos" style="width:402px; height:364px;">
<?$i=0;
while(@fopen('images/img_'.$row['car_id'].'_'.$i.'.jpg', "r")){
echo '<a href="/newcars/images/Photo.php?id=img_'.$row['car_id'].'_'.$i.'.jpg"><img alt="" src="/newcars/images/Photo.php?id=img_'.$row['car_id'].'w_'.$i.'.jpg" /></a>';
$i++;
}?>      
     
      </div>                      
    </div>
    <div class="col-3">
      <div id="DealerInfo" class="box">
        

<!--h4>Контакты дилерского центра</h4>
<h4>Автоцентр Атлант-М</h4>
<p>129128, Москва, ул. Бажова, д.17, стр.10 </p>
<dl>
  <dt>Телефон:</dt><dd>(495) 777-65-05</dd>
  <dt>E-mail: </dt><dd><a href="mailto:vw.atlantm@gmail.com">vw.atlantm@gmail.com</a></dd>
</dl>

  <li><a href="http://www.atlant-m.ru" target="_blank" title="">Перейти на сайт дилера</a></li-->

<ul class="actions">

  <li><a href="/newcars/?m=tab3" title="Избранное">Избранное (<span id="cntFav"><?echo count($_SESSION['select']);?></span>)</a></li>
  <li><a href="/newcars/?m=tab4" title="Сравнение">Сравнение (<span id="cntCom"><?echo count($_SESSION['compar']);?></span>)</a></li>
</ul>   
 

      </div>            
      <div id="AdditionalTools" class="box">
        

<h4>Дополнительно</h4>

<ul class="more">
    <li><a href="#" onclick="return FavouriteToogle({ id:<?echo $row['car_id'];?>, title:'<?echo $row['car_name'];?>', price:<?echo $row['car_price'];?> })" title="">Добавить в избранное</a></li>
    <li><a href="#" onclick="return CompareToogle({ id:<?echo $row['car_id'];?>, title:'<?echo $row['car_name'];?>', price:<?echo $row['car_price'];?> })" title="">Добавить к сравнению</a></li>

    <!--li class="pdf"><a href="/Car/DetailsPrintPDFget/30229?random=634771925531875000" target="_blank" title="">Открыть в PDF</a></li-->



</ul>



      
      </div>  
      
      <div>
      <h3>Забронировать авто</h3>
      <div style="float: right;" id="registration">
         <div id="RegisterUserForm">
         	<fieldset id="for">
                 <p>
                    <input id="name" name="name" type="text" class="text" placeholder="Имя" value="">
                 </p>
                
                 <p>
                    <label for="tel" style="position: absolute; left: 0px; top: -2px; display: none; " class="infield">Телефон</label>
                    <input id="tel" name="tel" type="tel" class="text" value="+38">
                 </p>
                
                 <p>
                    <input id="email" name="email" type="email" class="text" placeholder="Электронная почта" value="">
                 </p>
                
               
                 <p>
                    <button id="registerNew" onclick="saw_form();" type="button">Отправить</button>
                 </p>
         	</fieldset>
            <div id="fon_ok"></div>
         </div>
        </div>
       </div>   
    </div>              
  </div>
</div>
<div id="tabs">
	<div class="container">
		<ul class="info">
			<li><a href="#tabs-1"><span>Описание</span></a></li>
			<li><a href="#tabs-2"><span>Отправить письмо дилеру</span></a></li>
			<!--li><a href="#tabs-3"><span>Юридическая информация</span></a></li-->
		</ul>
	</div>
	<div id="tabs-1">
    <div class="holder">
<?/*$n=1;
foreach($options as $namekat=>$kat){// чекбоксы options Настриваемые в arrays.php
    echo '<h4>'.$namekat.'</h4><ul class="list">';
    
        foreach($kat as $i=>$val){
            if(substr_count($row['car_options'],$i)!=0) echo "<li>$val</li>";
         }
        if($row['car_opt'.$n]!=''){
            $rr=explode('&amp;',$row['car_opt'.$n]);
            foreach($rr as $b){echo "<li>$b</li>";}
        } 
    
    echo '</ul>';
    $n++;
}*/
echo $row['car_optext'];
?>      

</div></div>
  <div id="tabs-2">
    

<script type="text/javascript">
  function DealerSended() {
    if ($("#vSummary").length == 0) {
      $("#message").text("Сообщение успешно отправлено!");
    }
  } 
  
  function saw_form(){
    name=$('#name').val();
    tel=$('#tel').val(); 
    email=$('#email').val();
    sess_id='<?echo $sess;?>';
    $.getJSON('/configurator/mess.php', { sess_id:sess_id,name:name,tel:tel,email:email, action:'bron'}, function(obj){
        
        
        
        if(obj.mail==1){
           $('#email').addClass('erore');
           $('#email').removeClass('text');
        }else{
           $('#email').addClass('text');
           $('#email').removeClass('erore');
        }
       
        if(obj.name==1){
           $('#name').addClass('erore');
           $('#name').removeClass('text');
        }else{
            $('#name').addClass('text');
            $('#name').removeClass('erore');
        }
        if(obj.tel==1){
            $('#tel').addClass('erore');
            $('#tel').removeClass('text');
        }else{
            $('#tel').addClass('text');
            $('#tel').removeClass('erore');
        }
       
       if(obj.tel==0 && obj.mail==0 && obj.name==0){
               
        $('#for').hide();     
        $('#fon_ok').fadeIn(400);     
  
        //setTimeout("window.location.href = 'index.php';", 3500);  
       }
        
        
        
    });
}
</script>

<div id="wSendToDealer">

    <form action="/Car/Details_SendToDealerPartial/30229" method="post" onclick="Sys.Mvc.AsyncForm.handleClick(this, new Sys.UI.DomEvent(event));" onsubmit="Sys.Mvc.AsyncForm.handleSubmit(this, new Sys.UI.DomEvent(event), { insertionMode: Sys.Mvc.InsertionMode.replace, loadingElementId: 'progress', updateTargetId: 'wSendToDealer', onSuccess: Function.createDelegate(this, DealerSended) });">

      <table class="todealer">
      <tr>
        <td class="leftfields" valign="top">
            <div class="editor-label">
                <label for="Name">Имя</label>
            </div>
            <div class="editor-field">
                <input id="Name" name="Name" type="text" value="" />
                
            </div>
            
            <div class="editor-label">
                <label for="SecondName">Фамилия</label>
            </div>
            <div class="editor-field">
                <input id="SecondName" name="SecondName" type="text" value="" />
                
            </div>
            
            <div class="editor-label">
                <label for="Email">E-mail</label>
            </div>
            <div class="editor-field">
                <input id="Email" name="Email" type="text" value="" />
                
            </div>
            
            <div class="editor-label">
                <label for="Phone">Телефон</label>
            </div>
            <div class="editor-field">
                <input id="Phone" name="Phone" type="text" value="" />
                
            </div>
            
            <div class="editor-label">
                <label for="ContactType">Предпочительный способ связи</label>
            </div>
            <div class="editor-field">
              
                <input id="rbContactType" name="rbContactType" type="radio" value="1" /> <label for="rbContactType1">по телефону</label>&nbsp;
                <input checked="checked" id="rbContactType" name="rbContactType" type="radio" value="2" /> <label for="rbContactType2">по e-mail</label>            
            </div>
        </td>
        <td valign="top">
            <div class="editor-label">
                <label for="Message">Сообщение</label>
            </div>
            <div class="editor-field">
                <textarea cols="80" id="Message" name="Message" rows="12">
</textarea>
                  
            </div>        
        </td>
      </tr>
      </table>

    <div style="height:30px">
        
        <div id="message"></div>
    </div>      

    <ul class="search">
      <li>  
        <a href="" title="" class="button-red" onclick="$('#btDealerSubmit').click(); return false;">
          <span>Отправить</span>
            <i class="button-right"></i>
            <i class="button-center"></i>
            <i class="button-left"></i>
        </a>
      </li>
    </ul>  

    <input id="btDealerSubmit" type="submit" value="Отправить" style="display:none" />  

    </form>

</div>
  </div>
  <!--div id="tabs-3">  
    <p>
      Volkswagen Russia прилагает существенные усилия для того, чтобы информация, опубликованная в данном разделе, 
      соответствовала реальности. Однако ошибки могут случаться, поэтому просьба уточнять данные 
      по каждому опубликованному автомобилю в соответствующем дилерском центре.    
    </p>
  </div-->
</div>






    </div>
    
  	<a href="/newcars/Details.php?id=30229" onclick="return openPrintDialog('/Car/DetailsPrint/30229')" class="print">print</a>     
  </div>
  
     
    <link href="/js/galleria/galleria.classic.css" rel="stylesheet" type="text/css" />
    <style>

/* Add whatever you need to your CSS reset */
#registration {
			color: #333;
        	width: 260px;
            }

fieldset{
    border: none;
}
	  

	  
input.text {
    outline: none;
      -webkit-border-radius: 15px;
      -moz-border-radius: 15px;
      border-radius: 15px;
      border:solid 1px #ddd;
      font-size: 14px;
      width: 100%;
      padding: 7px 8px 7px 30px;
      -moz-box-shadow: 0px 1px 0px #777;
      -webkit-box-shadow: 0px 1px 0px #777;
	  background: #ddd url('/configurator/images/inputSprite.png') no-repeat 4px 5px;
	  background: url('/configurator/images/inputSprite.png') no-repeat 4px 5px, -moz-linear-gradient(
           center bottom,
           rgb(225,225,225) 0%,
           rgb(215,215,215) 54%,
           rgb(173,173,173) 100%
           );
	  background:  url('/configurator/images/inputSprite.png') no-repeat 4px 5px, -webkit-gradient(
          linear,
          left bottom,
          left top,
          color-stop(0, rgb(225,225,225)),
          color-stop(0.54, rgb(215,215,215)),
          color-stop(1, rgb(173,173,173))
          );
      color:#333;
      text-shadow:0px 1px 0px #FFF;
}	  

 input#email { 
 	background-position: 4px 5px; 
	background-position: 4px 5px, 0px 0px;
	}
	
	
 input#name { 
 	background-position: 4px -46px; 
	background-position: 4px -46px, 0px 0px; 
	}
	
 input#tel { 
 	background-position: 4px -76px; 
	background-position: 4px -76px, 0px 0px; 
	}
	

#registerNew {
	width: 100px;
	height: 32px;
	border: none;
	text-indent: -9999px;
	background: url('/configurator/images/createAccountButton.png') no-repeat;
	cursor: pointer;
	float: right;
	}
	
	#registerNew:hover { background-position: 0px -31px; }
	#registerNew:active { background-position: 0px -62px; }
	
 #registration p {
      position: relative;
      }
	  
fieldset label.infield /* .infield label added by JS */ {
    color: #333;
    text-shadow: 0px 1px 0px #fff;
    position: absolute;
    text-align: left;
    top: 5px !important;
    left: 35px !important;
    line-height: 29px;
    }
#fon_ok{
    background: url('/configurator/images/ok.jpg') no-repeat;
    height: 193px;
    width: 256px;
    display: none;
}
input.erore {
    outline: none;
      -webkit-border-radius: 15px;
      -moz-border-radius: 15px;
      border-radius: 15px;
      border:solid 1px #de2020;
      font-size: 14px;
      width: 100%;
      padding: 7px 8px 7px 30px;
      -moz-box-shadow: 0px 1px 0px #777;
      -webkit-box-shadow: 0px 1px 0px #777;
	  background: #d39797 url('/configurator/images/inputSprite.png') no-repeat 4px 5px;
	  background: url('/configurator/images/inputSprite.png') no-repeat 4px 5px, -moz-linear-gradient(
           center bottom,
           rgb(225,225,225) 0%,
           rgb(215,215,215) 54%,
           rgb(173,173,173) 100%
           );
	  background:  url('/configurator/images/inputSprite.png') no-repeat 4px 5px, -webkit-gradient(
          linear,
          left bottom,
          left top,
          color-stop(0, rgb(225,225,225)),
          color-stop(0.54, rgb(215,215,215)),
          color-stop(1, rgb(173,173,173))
          );
      color:#ff0000;
      text-shadow:0px 1px 0px #FFF;
}
</style>
</body>
</html>

