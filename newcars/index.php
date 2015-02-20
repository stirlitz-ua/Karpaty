<?session_start();

include_once "../bd.php";

if(isset($_SESSION['type_cars']) and $_SESSION['type_cars']=='daswelt'){

    unset($_SESSION['search']); unset($_SESSION['compar']); 

    unset($_SESSION['action']);unset($_SESSION['select']);

    }

if(isset($_GET['search'])) unset($_SESSION['search']);//сброс параметров поиска

if(!isset($_SESSION['search']['price'])){$_SESSION['search']['price'][1]=0; $_SESSION['search']['price'][2]=820000;}

if(!isset($_SESSION['search']['run'])){$_SESSION['search']['run'][1]=0; $_SESSION['search']['run'][2]=1530000;}

if(!isset($_SESSION['search']['year'])){$_SESSION['search']['year'][1]=1970; $_SESSION['search']['year'][2]=Date('Y');}

if(!isset($_SESSION['search']['power'])){$_SESSION['search']['power'][1]=0; $_SESSION['search']['power'][2]=400;}

if(!isset($_SESSION['search']['volume'])){$_SESSION['search']['volume'][1]=0; $_SESSION['search']['volume'][2]=6;}

if(!empty($_GET['car'])){$_SESSION['search']['name2']=urldecode($_GET['car']);}

//var_dump($_SESSION);

//session_destroy();
//echo '<!--';
//print_r($_SESSION);
//echo '-->';
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" >

<head><title>

</title>

	  <link href="/newcars/css/font-face.css" rel="stylesheet" type="text/css" />

	  <link href="/newcars/css/all.css" rel="stylesheet" type="text/css" />    

	  <link href="/newcars/css/cusel.css" rel="stylesheet" type="text/css" /> 	  

    <script type="text/javascript" src="/newcars/js/jquery-1.5.2.min.js"></script> 

    <script type="text/javascript" src="/newcars/js/jquery-ui-1.8.11.custom.min.js"></script> 

    <script src="/newcars/js/Locator.Search.js" type="text/javascript"></script>

    <script src="/newcars/js/MicrosoftAjax.js" type="text/javascript"></script>  

    <script src="/newcars/js/MicrosoftMvcAjax.js" type="text/javascript"></script>

    <!-- Подключать после всех js скриптов -->

	  <link href="/newcars/css/modelselector.css" rel="stylesheet" type="text/css" />      

<!--[if lt IE 7]><link rel="stylesheet" href="/css/lt7.css" type="text/css"/><![endif]--> 	  

<script type="text/javascript">

  $(document).ready(function() {

    var itab = $("#tabs").tabs('option', 'selected');

    $("#progress").show();

    var mode = $("#tabmode").val();

    if ('True' != 'True' && mode == "") mode = "tab2";

    switch (mode) {

      case "":

        $("#thead1").addClass("ui-tabs-selected").addClass("ui-state-active");

        $("#tabs-1").load($("#tabs-1").attr("url"), { rnd: Math.random() }, function() {

          $("#progress").hide();

          MS_InitSlider('mprice', '12000', '82000', 1000, '12000', '82000');

        });

        break;



      case "tab2":

        $("#thead2").addClass("ui-tabs-selected").addClass("ui-state-active");

        $("#tabs-2").load($("#tabs-2").attr("url"), { rnd: Math.random() }, function() {

          if (typeof InitComboFilters == 'function') InitComboFilters();

          initHover(); initCompares(); InitSorter(); $("#progress").hide();

        });

        break;

      case "tab2res":

        $("#thead2").addClass("ui-tabs-selected").addClass("ui-state-active");

        $("#tabs-2").load("Car/Results_Partial.php?mode=results", { rnd: Math.random() }, function() {

          initHover(); initCompares(); InitSorter(); $("#progress").hide();

        });

        break;

      case "tab3":

        $("#thead3").addClass("ui-tabs-selected").addClass("ui-state-active");

        $("#tabs-3").load($("#tabs-3").attr("url"), { rnd: Math.random() }, function() {

          initHover(); initCompares(); InitSorter(); $("#progress").hide();

        });

        break;

      case "tab4":

        $("#thead4").addClass("ui-tabs-selected").addClass("ui-state-active");

        $("#tabs-4").load($("#tabs-4").attr("url"), { rnd: Math.random() }, function() {

          initHover(); initCompares(); InitSorter(); $("#progress").hide();



        });



        break;



    };



    $(".btResult").live("click", function() {

      return true;

    });

    if (itab != 0) {

      $("#tabs").tabs('select', 0);

      $("#tabs").tabs('select', itab);

    }

    if ($("#tabs li.hidden").length != 0) $("#tabs").tabs('select', 1);

  });

</script>	  



<?if(isset($_SESSION['type_cars']) and $_SESSION['type_cars']=='daswelt'){?>

<script>DO_GetCalcCars({param:'power',val1:'0',val2:'400'});</script>

<?}$_SESSION['type_cars']='newcars';?>







</head>



<body>



<div id="progress">







  <div class="popup-content">



    <img src="img/preloader.gif" alt=""/>



  </div>



</div>



<input id="importer" type="hidden" value='True' />



<input id="theme" type="hidden" value="/" />



<input id="opts" type="hidden" value='' />

<?if(!isset($_GET['m'])) $_GET['m']='tab2res';?>

<input id="tabmode" type="hidden" value='<?echo $_GET['m']?>' /> 



<div id="dError" style="display:none"></div>  



<div id="dhSel" style="display:none">



 <h4>Ваш выбор</h4>







<!--p><strong>Город:</strong><span id="stown"></span></p>



<p><strong>Модель:</strong><span id="smodels"></span></p>







<p><strong>Тип топлива:</strong><span id="sfuel"></span></p>



<p><strong>КПП:</strong><span id="sgearbox"></span></p>



<p><strong>Привод:</strong><span id="sdrivegear"></span></p>



<p><strong>Тип кузова:</strong><span id="sbody"></span></p>



<p><strong>Цвет кузова:</strong><span id="scolor"></span></p-->







<p><strong>Цена:</strong><span id="sprice"></span> UAH</p>



<!--p><strong>Пробег:</strong><span id="srun"></span> км</p>



<p><strong>Год выпуска:</strong><span id="syear"></span></p-->



<p><strong>Мощность двиг.:</strong><span id="spower"></span> л.с.</p>



<p><strong>Объём двиг.:</strong><span id="svolume"></span> л</p>











<!--a href="/" class="specify" >Уточнить поисковый запрос</a--> 



</div>







  



    



  <div id="main" class="inframe">



		<ul class="breadcrumbs">



			<li><a href="#">Мир Volkswagen</a></li>



			<li class="active"><a href="#">Автомобили с пробегом</a></li>



		</ul>



		<!--h2>Автомобили с пробегом</h2-->



  	<div id="tabs">



			<div class="container">



				<ul class="info tabs-head">

					<li id="thead2"><a class="tabh" href="?mode=search"><span>Поиск</span></a></li>

					<li id="thead3"><a class="tabh" href="?m=tab3"><span>Избранное (<label id="cntFav"><?echo count($_SESSION['select']);?></label>)</span></a></li>

					<li id="thead4"><a class="tabh" href="?m=tab4"><span>Сравнение (<label id="cntCom"><?echo count($_SESSION['compar']);?></label>)</span></a></li>

				</ul>



			</div>







      <div id="tabs-1" url="Car/Search_Models.php">







      </div>



      <div id="tabs-2" url="Car/Results_Partial.php?mode=search" ></div>

      <div id="tabs-3" url="Car/Site_Favourites.php"></div>

      <div id="tabs-4" url="Car/Site_Compares.php"></div>



    </div>



  	<a href="javascript:window.print()" class="print">print</a>     



  </div>



</body>



</html>



