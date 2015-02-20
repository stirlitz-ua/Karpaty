<?//if($_GET['page']=='avto_in_stock'){?>

<!-- <div class="heder_page"><a class="heder_page_name" href="/avto_in_stock/">Новые автомобили</a></div>

<div class="l_content">

 <iframe width="100%" height="2250" frameborder="0"  src="/newcars/?car=<? echo $_GET['car']; ?>" scrolling="no">&lt;p&gt;Настройки безопасности Вашего браузера блокируют IFrame.&lt;/p&gt;</iframe>

</div> -->
  <?  if($_GET['page']=='avto_in_stock'){
    ?>

<?php
echo '<div style="overflow:hidden; "><iframe src="http://cc.porscheinformatik.com/sklad-volkswagen/BNR/24320" width="955px" height="780px" scrolling="no" style="margin-top: -110px; margin-left: -20px;" frameborder="0"  /></div>';

}if($_GET['page']=='das_weltauto'){?>

<div class="heder_page"><a class="heder_page_name" href="/das_weltauto/">Автомобили с пробегом</a></div>

<div class="l_content">

 <iframe width="100%" height="2250" frameborder="0"  src="/dasweltauto/" scrolling="no">&lt;p&gt;Настройки безопасности Вашего браузера блокируют IFrame.&lt;/p&gt;</iframe>

</div>

<?}?>

<?if($_GET['page']=='accessories'){?>

    <div class="heder_page"><a class="heder_page_name" href="/accessories/">Каталог аксессуаров</a></div>

    <div class="l_content">

        <iframe width="100%" height="2250" frameborder="0"  src="/accessories/" scrolling="no">&lt;p&gt;Настройки безопасности Вашего браузера блокируют IFrame.&lt;/p&gt;</iframe>

    </div>

<?}?>