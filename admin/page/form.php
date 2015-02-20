<div class="container">
      <div class="row-fluid">
       <div class="span12">
       
       <div class="span3">
<div class="well sidebar-nav">
            <ul class="nav nav-list">
                <li class="nav-header">Навигация</li>
                <li class="<?if($_GET['form']=='all'){echo 'active';}?>"> <a href="?form=all">Все</a></li>
                <li class="<?if($_GET['form']=='evaluation'){echo 'active';}?>"> <a href="?form=evaluation">Оценка</a></li>
                <li class="<?if($_GET['form']=='proposal'){echo 'active';}?>"> <a href="?form=proposal">Предложение</a></li>
                <li class="<?if($_GET['form']=='requirement'){echo 'active';}?>"> <a href="?form=requirement">Требование</a></li>
           </ul>


</div>
</div>


<div class="span9">
<?if($_GET['form']=='all'){?>
<table class="table table-bordered table-condensed table-hover table-striped" data-provides="rowlink">
<tr><th>Название</th><th colspan="3" style="width: 100px;">Отпрака</th><th style="width: 50px;"></th></tr>
<tr><td><a href="?form=evaluation">ОЦЕНКА работы служб автоцентра</a></td><td></td><td></td><td></td><td></td></tr>
</table>

<?}elseif($_GET['form']=='evaluation'){
    
    $rez=mysql_fetch_array(mysql_query("SELECT * FROM `set_form`  WHERE id='1'"));
    
    
    ?>
<h3 class="page-header"><?echo $rez['name'];?></h3>

<span style="float: left;margin-right: 10px;">
<button class="btn tool <?if($rez['mail']==''){echo 'btn-danger';}else{echo 'btn-info';}?>" id="m" data-original-title="Отпровлять на e-mail"><i class="icon-envelope" ></i></button>
<div class="control-group" id="s" style="display: none;">
   <div class="controls">
    <div class="input-prepend input-append">
      <span class="add-on"><i class="icon-envelope tool" data-original-title="Отмена" id="s_m" rel="1"></i></span>
      <input class="input-lagre input1" id="inputIcon" type="text" value="<?echo $rez['mail'];?>" >
      <span class="add-on"><i class="icon-check tool" data-original-title="Сохранить" id="s_m2" rel="1"></i></span>
    </div>
  </div>
</div>
</span>

<span style="float: left;margin-right: 10px;">
<button class="btn tool <?if($rez['phone']==''){echo 'btn-danger';}else{echo 'btn-info';}?>" id="z" data-original-title="Отпровлять SMS"><i class="icon-share" ></i></button>
<div class="control-group" id="d" style="display: none;">
   <div class="controls">
    <div class="input-prepend input-append">
      <span class="add-on"><i class="icon-share tool" data-original-title="Отмена" id="z_d" rel="1"></i></span>
      <input class="input-lagre input2" id="inputIcon" type="text" value="<?echo $rez['phone'];?>">
      <span class="add-on"><i class="icon-check tool" data-original-title="Сохранить" id="z_d2" rel="1"></i></span>
    </div>
  </div>
</div>
</span>

<span style="float: left;"><button rel="1" class="btn tool sinch <?if($rez['sinch']==0){echo 'btn-danger';}else{echo 'btn-info';}?>" data-original-title="<?if($rez['sinch']==0){echo 'нет синхронизации';}else{echo 'Синхронизировано';}?>"> <?if($rez['sinch']==0){echo '<i class="icon-random"></i>';}else{echo '<i class="icon-refresh"></i>';}?> </button></span>

<div class="cl" style="height: 7px;"></div>
<table class="table table-bordered table-condensed table-hover table-striped">
<tr><th>ФИО</th><th>Город</th><th>Дата</th><th  style="width: 100px;">Удовлетворение</th><th style="width: 50px;" ></th></tr>

<?
 $ffor=mysql_query("SELECT * FROM  `form` WHERE idform='1' ORDER BY id DESC");
  while($fform=mysql_fetch_array($ffor)){
    $arr=unserialize($fform['arr']);
    
    echo '<tr id="frq'.$fform['id'].'"><td>'.$arr['name'].'</td><td>'.$arr['city'].'</td><td>'.date_smart($fform['date'], '21:45').'</td><td><div class="star st'.$fform['grade'].'"></div></td><td><i class="icon-eye-open op_ft" rel="'.$fform['id'].'"></i><i class="del_ft  icon-remove"  rel="'.$fform['id'].'"></i></td></tr>
    <tr id="fr'.$fform['id'].'" style="display: none;">
    <td colspan="5"><table class="table" style="">
    <tr><td>'.$fform['text1'].'</td><td >'.$fform['text2'].'</td>
    <td style="width: 300px;font-size: 11px;">
    <li><b>ФИО</b>:'.$arr['name'].'</li>
    <li><b>Город</b>:'.$arr['city'].'</li>
    <li><b>Организация</b>:'.$arr['org'].'</li>
    <li><b>Телефон</b>:'.$arr['phone'].'</li>
    <li><b>Адрес</b>:'.$arr['adres'].'</li>
    <li><b>E-mail</b>:'.$arr['mail'].'</li>
    </td></tr></table></td></tr>';
    
  }

?>



</table>

<?}?>
</div>
</div>
</div>
</div>