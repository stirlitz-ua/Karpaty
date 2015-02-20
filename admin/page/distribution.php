


<div class="container">
      <div class="row-fluid">
       <div class="span12">

       <div class="span3">
        <div class="well sidebar-nav">
            <ul class="nav nav-list">
                  <li class="divider"></li>
                <p align="left"<big><b>Разделы:<br/></b></big></p>
                 <li <?if(isset($_GET['to_mail'])){echo 'class="active"';}?>><a href="?distribution&to_mail">Запись на ТО</a></li>
                <li <?if(isset($_GET['base_orders'])){echo 'class="active"';}?>><a href="?distribution&base_orders">Заказ запчастей</a></li>

           </ul>

        </div></div>


        <div class="span9">
        
        <?
        if(isset($_GET['to_mail'])){

            if(isset($_GET['view']) and $_GET['view']!=''){
                $pm=mysql_fetch_array(mysql_query("SELECT * FROM  `mail_post` WHERE id='".$_GET['view']."'"));
                echo '<div class="page-header"><i class="icon-remove tool pull-right" id="deletemails" data-original-title="Удалить"  rel="'.$pm['id'].'"></i><a href="?distribution&post_mail&edit_mail='.$pm['id'].'"><i class="icon-pencil tool pull-right"  data-original-title="Редактировать"></i></a><h3>'.$pm['name'].'</h3></div>'.$pm['mail'];


            }elseif(isset($_GET['edit_mail'])){$pm=mysql_fetch_array(mysql_query("SELECT * FROM  `mail_post` WHERE id='".$_GET['edit_mail']."'")); ?>




            <?}elseif(isset($_GET['add_mail'])){?>

            <? }else{?>
         <div class="page-header">
          <h4>Список записавшихся на ТО</h4></div>
         <table class="table table-hover table-condensed table-bordered">

             <td><b>ФИО</b></td><td><b>Автомобиль</b></td><td><b>Гос. номер</b></td><td><b>Номер телефона</b></td><td><b>Удобное время звонка</b></td>
         <?
         $mm=mysql_query("SELECT * FROM  `service` ORDER BY `id` DESC");
         while($pm=mysql_fetch_array($mm)){
            echo '<tr id="mails'.$pm['patronymic'].'"><td>'.$pm['firstname'].' '.$pm['patronymic'].' '.$pm['lastname'].' </td>
            <td style="width:170px;">'.$pm['car'].'</td>
            <td>'.$pm['numbers'].'</td>
            <td>'.$pm['phone'].'</td>
            <td>'.$pm['times'].'</td>
            </tr>
            ';
         }

         ?>


         </table>
         
         
      
         <?}}elseif(isset($_GET['base_mail'])){?>

        <div class="page-header"> <h4>Список записавшихся на ТО</h4></div>
           <table class="table table-hover table-condensed table-bordered">

               <?
               $mm=mysql_query("SELECT * FROM  `service` ORDER BY `id` DESC");
               while($pm=mysql_fetch_array($mm)){
                   echo '<tr id="mails'.$pm['patronymic'].'"><td>'.$pm['firstname'].' '.$pm['patronymic'].' '.$pm['lastname'].' </td>
            <td>'.$pm['car'].'</td>
            <td>'.$pm['numbers'].'</td>
            <td>'.$pm['phone'].'</td>
            <td>'.$pm['times'].'</td>
            </tr>
            ';
               }?>
        <?}?>
        
        
        <?if(isset($_GET['base_orders'])){?>

               <div class="page-header"> <h4>Список записавшихся на ТО</h4></div>
               <table class="table table-hover table-condensed table-bordered">
                   <td><b>ФИО</b></td><td><b>Автомобиль</b></td><td><b>Номер кузова</b></td><td><b>Номер телефона</b></td><td><b>Запчасть</b></td>

                   <?
                   $mm2=mysql_query("SELECT * FROM `order` ORDER BY `id` DESC");
                   while($pm2=mysql_fetch_array($mm2)){
                       echo '<tr id="mails'.$pm2['lastname'].'"><td>'.$pm2['firstname'].' '.$pm2['patronymic'].' '.$pm2['lastname'].' </td>
            <td>'.$pm2['car'].'</td>
            <td>'.$pm2['numbers'].'</td>
            <td>'.$pm2['phone'].'</td>
            <td>'.$pm2['zapch'].'</td>
            </tr>
            ';
                   }?>
                   </table>
                   <?}?>
        
        
        
        
        
        
        
        
        
        </div></div></div></div>

