<div class="container">
      <div class="row-fluid">

       <div class="span12">
        
        
     <table class="table table-hover table-condensed table-bordered">
     
   
        
     <?
     $ms=mysql_query("SELECT * FROM  `page11` WHERE tip!='3' and  tip!='4' ORDER BY tip ASC");
    while($mset=mysql_fetch_array($ms)){ 
        echo '<tr><td>'.$mset['tip'].'</td><td>'.$mset['name'].'</td></tr>';
    }
     

     
     ?>
        
        
         </table>   
        
        
        
        
        
        
        
        
        </div>
      </div>
