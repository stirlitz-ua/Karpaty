<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Панель администратора</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="css/style.css"/>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
     </style>
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <![endif]-->


  </head>

  <body>


<div class="navbar subnav navbar-fixed-top">
   <div class="navbar-inner">
    <div class="container">
   
    <ul class="nav">
      <li class="dropdown <?if(isset($_GET['st'])){echo 'active';}?>">
        <a  class="dropdown-toggle " data-toggle="dropdown" >Разное <b class="caret"></b></a>
        
        <ul class="dropdown-menu">
            <li > <a href="?st">Статистика</a></li>
            <li class="<?if($_GET['banner']=='banner'){echo 'active';}?>"> <a href="?banner=banner">Главный баннер</a></li>
            <li class="<?if($_GET['banner']=='mb'){echo 'active';}?>"> <a href="?banner=mb">Дополнительные линки</a></li>

        </ul>
        
      </li>
      <li class="divider-vertical"></li>
      <li class="dropdown <?if(isset($_GET['models'])){echo 'active';}?>">
        <a class="dropdown-toggle" href="?models">Модели</a>
      </li>
      <li class="divider-vertical"></li>

      
       <li class="dropdown <?if(isset($_GET['form'])){echo 'active';}?>">
        <a  class="dropdown-toggle " data-toggle="dropdown" >Формы <b class="caret"></b></a>
        
        <ul class="dropdown-menu">
            <li class="<?if($_GET['form']=='evaluation'){echo 'active';}?>"> <a href="?form=evaluation">Оценка</a></li>
            <li class="<?if($_GET['form']=='proposal'){echo 'active';}?>"> <a href="?form=proposal">Предложение</a></li>
            <li class="<?if($_GET['form']=='requirement'){echo 'active';}?>"> <a href="?form=requirement">Требование</a></li>

        </ul>
        
      </li>


   
      
      <li class="divider-vertical"></li>
      
      <li class="dropdown <?if(isset($_GET['page'])){echo 'active';}?>">
        <a class="dropdown-toggle " data-toggle="dropdown" >Основное меню <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li class="<?if($_GET['page']=='purchase_finance'){echo 'active';}?>"> <a href="?page=purchase_finance">Спецпредложения</a></li>
            <li class="<?if($_GET['page']=='service'){echo 'active';}?>"> <a href="?page=service">Сервис</a></li>
            <li class="<?if($_GET['page']=='company'){echo 'active';}?>"> <a href="?page=company">Volkswagen</a></li>
            <li class="<?if($_GET['page']=='salesavto'){echo 'active';}?>"> <a href="?page=salesavto">Акционные автомобили в наличии</a></li>
        </ul>
      </li>

    <li class="dropdown <?if(isset($_GET['avto'])){echo 'active';}?>">
        <a class="dropdown-toggle " data-toggle="dropdown" >Автомобили <b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li class="<?if($_GET['avto']=='in_stock'){echo 'active';}?>"> <a href="?avto=in_stock">Автомобили в наличии</a></li>
            <li class="<?if($_GET['avto']=='mileage'){echo 'active';}?>"> <a href="?avto=mileage">Автомобили с пробегом</a></li>
        </ul>
      </li>

        <li class="dropdown <?if(isset($_GET['catalog'])){echo 'active';}?>">
        <li class="dropdown <?if(isset($_GET['catalog'])){echo 'active';}?>">
            <a class="dropdown-toggle " data-toggle="dropdown" >Каталог аксесуаров <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li class="<?if($_GET['catalog']=='vitrina'){echo 'active';}?>"> <a href="?catalog=vitrina">On-line витрина</a></li>
                <li class="<?if($_GET['catalog']=='accessories'){echo 'active';}?>"> <a href="?catalog=accessories">Доп. оборудование</a></li>

            </ul>
        </li>

<li class="divider-vertical"></li>
      <li class="dropdown <?if(isset($_GET['distribution'])){echo 'active';}?>">
        <a class="dropdown-toggle" href="?distribution&to_mail">Заявки</a>
      </li>
      <li class="divider-vertical"></li>

 




      <li><a href="#labels"></a></li>
    </ul>
    <ul class="nav pull-right"><li><a href="?exit"><i class="icon-off tool" data-placement="left" data-original-title="Выход"></i></a></li></ul>
  </div></div></div>