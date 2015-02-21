<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    window.jQuery || document.write('<script type="text/javascript" src="/js/jquery.min.js"><\/script>');
    </script>
<script src="/js/fons.js" type="text/javascript"></script>
<script src="/js/script.js" type="text/javascript"></script>

<style>

p{line-height: 0;margin: 1px;}
td{vertical-align: top;}
textarea{
    width: 300px;
  display: inline-block;
  height: 70px;
  padding: 5px 6px;
  font-size: 14px;
  line-height: 20px;
  color: #555555;
  vertical-align: middle;
  -webkit-border-radius: 2px;
     -moz-border-radius: 2px;
          border-radius: 2px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
     -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
       -o-transition: border linear 0.2s, box-shadow linear 0.2s;
          transition: border linear 0.2s, box-shadow linear 0.2s;
}

input[type="text"]{
    width: 300px;
  display: inline-block;
  height: 20px;
  padding: 5px 6px;
  font-size: 14px;
  line-height: 20px;
  color: #555555;
  vertical-align: middle;
  -webkit-border-radius: 2px;
     -moz-border-radius: 2px;
          border-radius: 2px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition: border linear 0.2s, box-shadow linear 0.2s;
     -moz-transition: border linear 0.2s, box-shadow linear 0.2s;
       -o-transition: border linear 0.2s, box-shadow linear 0.2s;
          transition: border linear 0.2s, box-shadow linear 0.2s;

}
label input{
    margin: 2px 2px 0px 0px;
}

input[type="text"]:focus, textarea:focus{
    
    border-color: rgba(82, 168, 236, 0.8);
  outline: 0;
  outline: thin dotted \9;
  /* IE6-9 */

  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6);
    
}
input[type="button"]{
    -webkit-border-radius: 2px;
     -moz-border-radius: 2px;
          border-radius: 2px;
          color: #444;
display: block;
float: left;
font: bold 11px arial, sans-serif;
height: 24px;
padding-right: 5px;
text-decoration: none;
background: white;
border: 0;
-webkit-box-shadow:  0 1px 1px rgba(58, 58, 58, 1);
     -moz-box-shadow:  0 1px 1px rgba(58, 58, 58, 1);
          box-shadow:  0 1px 1px rgba(58, 58, 58, 1);
}

input[type="button"]:hover{
    background: #2274AC;
    color: white;
    cursor: pointer;
}


#form2{display: none;}

.fr{margin: 5px 5px 15px 5px;padding: 3px 10px 12px 10px;cursor: pointer;
/* IE9 SVG, needs conditional override of 'filter' to 'none' */

-webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;


/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2RjZTRmMiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3ZGI5ZTgiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(220,228,242,1) 0%, rgba(125,185,232,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(220,228,242,1)), color-stop(100%,rgba(125,185,232,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(220,228,242,1) 0%,rgba(125,185,232,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(220,228,242,1) 0%,rgba(125,185,232,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(220,228,242,1) 0%,rgba(125,185,232,0) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(220,228,242,1) 0%,rgba(125,185,232,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dce4f2', endColorstr='#007db9e8',GradientType=0 ); /* IE6-8 */

}


.activ{
    -webkit-border-top-left-radius: 5px;
    -webkit-border-top-right-radius: 5px;
    -moz-border-radius-topleft: 5px;
    -moz-border-radius-topright: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    -webkit-box-shadow:  0 -1px 1px rgba(58, 58, 58, 1);
     -moz-box-shadow:  0 -1px 1px rgba(58, 58, 58, 1);
          box-shadow:  0 -1px 1px rgba(58, 58, 58, 1);
          
          
          
          
background: rgb(120,156,219); /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzc4OWNkYiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9Ijk5JSIgc3RvcC1jb2xvcj0iI2E1YzBlZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(top,  rgba(120,156,219,1) 0%, rgba(165,192,239,1) 99%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(120,156,219,1)), color-stop(99%,rgba(165,192,239,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(120,156,219,1) 0%,rgba(165,192,239,1) 99%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(120,156,219,1) 0%,rgba(165,192,239,1) 99%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(120,156,219,1) 0%,rgba(165,192,239,1) 99%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(120,156,219,1) 0%,rgba(165,192,239,1) 99%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#789cdb', endColorstr='#a5c0ef',GradientType=0 ); /* IE6-8 */
    
          
}

.heder_model_s{width: 156px;}

input[type="text"].red, textarea.red {
    border-color: #b94a48;
-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
-moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}
input[type="text"].red:focus,textarea.red:focus {
  border-color: #953b39;
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 6px #d59392;
}
.reds{border:1px solid #953b39;}
.grad{
    /* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMCUiIHgyPSIwJSIgeTI9IjEwMCUiPgogICAgPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iI2E1YzBlZiIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgICA8c3RvcCBvZmZzZXQ9IjEwMCUiIHN0b3AtY29sb3I9IiM3ZGI5ZTgiIHN0b3Atb3BhY2l0eT0iMCIvPgogIDwvbGluZWFyR3JhZGllbnQ+CiAgPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEiIGhlaWdodD0iMSIgZmlsbD0idXJsKCNncmFkLXVjZ2ctZ2VuZXJhdGVkKSIgLz4KPC9zdmc+);
background: -moz-linear-gradient(top,  rgba(165,192,239,1) 0%, rgba(125,185,232,0) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(165,192,239,1)), color-stop(100%,rgba(125,185,232,0))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(165,192,239,1) 0%,rgba(125,185,232,0) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(165,192,239,1) 0%,rgba(125,185,232,0) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(165,192,239,1) 0%,rgba(125,185,232,0) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(165,192,239,1) 0%,rgba(125,185,232,0) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a5c0ef', endColorstr='#007db9e8',GradientType=0 ); /* IE6-8 */
padding: 27px 10px;
}
</style>

<?
$dY=date('Y')-18;
$arr_mouse=array('Январь', 'Февраль', 'Март', 'Апрель', 'Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь');

				


if(isset($_GET['test_drive'])){?>

<div style="margin-bottom: 9px;">
<span class="fr activ" rel="form1">Тест-драйв</span>
<span class="fr" rel="form2">Мастер-класс</span>
</div>

<div id="form1" class="grad">
    <table >
        <tr><td class="heder_model_s">ФИО</td><td><input type="text" id="nameq" /></td></tr>
        <tr><td class="heder_model_s">Дата рождения</td>
        <td id="ym">
        
               
        <select id="numberq"><option>Число</option>  <?for($i=1;$i<32;$i++){echo '<option value="'.$i.'">'.$i.'</option>'; }?> </select>
        <select id="monthq"> <option>Месяц</option> <? for($i=0;$i<12;$i++){echo '<option value="'.$arr_mouse[$i].'">'.$arr_mouse[$i].'</option>'; }?></select> 
        <select id="yearq"><option>Год</option><? for($i=$dY;$i>1940;$i--){echo '<option value="'.$i.'">'.$i.'</option>'; }?> </select>
        </td></tr>
        <tr><td class="heder_model_s">Город</td><td><input type="text" id="adresq0" /></td></tr>
        <tr><td class="heder_model_s">Улица</td><td><input type="text" id="adresq1" /></td></tr>
        <tr><td class="heder_model_s">Дом</td><td><input type="text" id="adresq2" style="width: 70px;" /></td></tr>
        <tr><td class="heder_model_s">Квартира</td><td><input type="text" id="adresq3" style="width: 70px;" /></td></tr>
        
        <tr><td class="heder_model_s">Электронный адрес</td><td><input id="mailq" type="text" /></td></tr>
        <tr><td class="heder_model_s">Телефон</td><td><input id="phoneq" type="text" /></td></tr>
        <tr><td colspan="2" class="heder_model_s">Какую модель Volkswagen вы выбираете для тест-драйва:</td></tr>
        <tr><td></td><td id="ch_m">
        <p><label class="heder_model_s"><input type="checkbox" name="model" value="New Beetle" />-New Beetle</label></p>
        <p><label class="heder_model_s"><input type="checkbox" name="model" value="Passat"/>-Passat</label></p>
        <p><label class="heder_model_s"><input type="checkbox" name="model" value="Touareg"/>-Touareg</label></p>
        <p><label class="heder_model_s"><input type="checkbox" name="model" value="Tiguan"/>-Tiguan</label></p>
        <p><label class="heder_model_s"><input type="checkbox" name="model" value="Golf"/>-Golf</label></p>
        <p><label class="heder_model_s"><input type="checkbox" name="model" value="Polo Sedan"/>-Polo Sedan</label></p>
         <p><label class="heder_model_s"><input type="checkbox" name="model" value="Amarok"/>-Amarok</label></p>
       </td></tr>
       
       <tr>
       <td colspan="2" class="heder_model_s" style="font-size: 11px;">
       Отправляя эту форму, я предоставляю свои личные данные для рассмотрения моего запроса и даю безотзывное согласие на обработку своих персональных данных Джерман-Автоцентр, с целью осуществления хозяйственной деятельности (в т.ч. маркетинговых исследований) и ведения внутренних баз данных Джерман-Автоцентр, согласно Закона Украины "О защите персональных данных".
       
       </td>
       </tr>
       
       <tr><td></td><td><input type="button" value="Отправить" id="mail_test_dr" style="margin-top: 10px;"  /></td></tr>
    </table>
 </div>   

<div id="form2" class="grad">
    <table>
        <tr><td class="heder_model_s" >ФИО</td><td><input type="text" id="namew"/></td></tr>
        <tr><td class="heder_model_s">Дата рождения</td>
        <td id="ym1">
        
        <select id="numberw">
        <option>Число</option>
        <?
        for($i=1;$i<32;$i++){echo '<option>'.$i.'</option>'; }?>
        </select>
        
        <select id="monthw">
        <option>Месяц</option>
        <?
        for($i=0;$i<12;$i++){echo '<option>'.$arr_mouse[$i].'</option>'; }?>
        </select>
        
        <select id="yearw">
        <option>Год</option>
        <?
        for($i=$dY;$i>1940;$i--){echo '<option>'.$i.'</option>'; }?>
        </select>
        
        
        
        
        </td></tr>
        <tr><td class="heder_model_s">Город</td><td><input type="text" id="adresw0" /></td></tr>
        <tr><td class="heder_model_s">Улица</td><td><input type="text" id="adresw1" /></td></tr>
        <tr><td class="heder_model_s">Дом</td><td><input type="text" id="adresw2" style="width: 70px;" /></td></tr>
        <tr><td class="heder_model_s">Квартира</td><td><input type="text" id="adresw3" style="width: 70px;" /></td></tr>
        
        
        <tr><td class="heder_model_s">Электронный адрес</td><td><input id="mailw" type="text" /></td></tr>
        <tr><td class="heder_model_s">Телефон</td><td><input id="phonew" type="text" /></td></tr>
        <tr><td colspan="2" class="heder_model_s">Какой мастер-класс вы бы хотели прослушать:</td></tr>
        <tr><td></td><td id="ch_m2">
        <p><label class="heder_model_s"><input type="checkbox" name="model2"  value="Кредит. Лизинг. Страхование. Как сделать правильный выбор?" />- Кредит. Лизинг. Страхование. Как сделать правильный выбор?</label></p>
        <p><label class="heder_model_s"><input type="checkbox" name="model2" value="Почему Volkswagen?" />- Почему Volkswagen?</label></p>
       </td></tr>
       <tr>
       <td colspan="2" class="heder_model_s" style="font-size: 11px;">
       Отправляя эту форму, я предоставляю свои личные данные для рассмотрения моего запроса и даю безотзывное согласие на обработку своих персональных данных Джерман-Автоцентр, с целью осуществления хозяйственной деятельности (в т.ч. маркетинговых исследований) и ведения внутренних баз данных Джерман-Автоцентр, согласно Закона Украины "О защите персональных данных".
       
       </td>
       </tr>
       
       <tr><td></td><td><input type="button" value="Отправить" id="mail_ms_cl" style="margin-top: 10px;" /></td></tr>
    </table>
 </div> 
<script>
$('#mail_test_dr').click(function(){
        name=$('#nameq').val();
        year=$('select#yearq').val();
        month=$('select#monthq').val();
        number=$('select#numberq').val();
        adres0=$('#adresq0').val();
        adres1=$('#adresq1').val();
        adres2=$('#adresq2').val();
        adres3=$('#adresq3').val();
        mail=$('#mailq').val();
        phone=$('#phoneq').val();
        
        var allVals = new Array();
        var ns1;
        var ys1;
        var ms1;
        var ds1;
        var as1;
        var as2;
        var as3;
        var mms1;
        var ch1;
        var ps1;
        
        if(name==''){$('#nameq').addClass('red');ns1=1;}else{$('#nameq').removeClass('red');ns1=0;}
        if(phone==''){$('#phoneq').addClass('red');ps1=1;}else{$('#phoneq').removeClass('red');ps1=0;}
        if(year=='Год'){$('#ym').addClass('reds');ys1=1;}else{$('#ym').removeClass('reds');ys1=0;}
        if(month=='Месяц'){$('#ym').addClass('reds');ms1=1;}else{$('#ym').removeClass('reds');ms1=0;}
        if(number=='Число'){$('#ym').addClass('reds');ds1=1;}else{$('#ym').removeClass('reds');ds1=0;}
        if(adres0==''){$('#adresq0').addClass('red');as1=1;}else{$('#adresq0').removeClass('red');as1=0;}
        if(adres1==''){$('#adresq1').addClass('red');as2=1;}else{$('#adresq1').removeClass('red');as2=0;}
        if(adres2==''){$('#adresq2').addClass('red');as3=1;}else{$('#adresq2').removeClass('red');as3=0;}
        
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(mail=='' || !emailReg.test(mail)){$('#mailq').addClass('red');mms1=1;}else{$('#mailq').removeClass('red');mms1=0;}
        $("input[name='model']:checked").each(function() {  allVals.push($(this).val()); });
        if(allVals.length==0){$('#ch_m').addClass('reds'); ch1=1;}else{$('#ch_m').removeClass('reds');ch1=0;}
        if(ns1==0 && ys1==0 && ms1==0 && ds1==0 && as1==0 && as2==0 && as3==0 && mms1==0 && ch1==0 && ps1==0){
        $.getJSON('../ajax.php', {name:name,year:year,month:month,number:number,adres0:adres0,adres1:adres1,adres2:adres2,adres3:adres3,mail:mail,allch:allVals,phone:phone, action:'test_drive' }, function(obj){
        $('#nameq').val('');
        $("#yearq :first").attr("selected", "selected");
        $("#monthq :first").attr("selected", "selected");
        $("#numberq :first").attr("selected", "selected");
        $('#adresq0').val('');
        $('#adresq1').val('');
        $('#adresq2').val('');
        $('#adresq3').val('');
        $('#mailq').val('');
        $("input[name='model']:checked").removeAttr("checked");
        });
        }
});

$('#mail_ms_cl').click(function(){
        name=$('#namew').val();
        year=$('select#yearw').val();
        month=$('select#monthw').val();
        number=$('select#numberw').val();
        adres_0=$('#adresw0').val();
        adres_1=$('#adresw1').val();
        adres_2=$('#adresw2').val();
        adres_3=$('#adresw3').val();
        mail=$('#mailw').val();
        phone=$('#phonew').val();
        var allVals = new Array();
        var ns2;
        var ys2;
        var ms2;
        var ds2;
        var as_1;
        var as_2;
        var as_3;
        var mms2;
        var ch_2;
        var ps2;
        if(name==''){$('#namew').addClass('red');ns2=1;}else{$('#namew').removeClass('red');ns2=0;}
        if(phone==''){$('#phonew').addClass('red');ps2=1;}else{$('#phonew').removeClass('red');ps2=0;}
        if(year=='Год'){$('#ym1').addClass('reds');ys2=1;}else{$('#ym1').removeClass('reds');ys2=0;}
        if(month=='Месяц'){$('#ym1').addClass('reds');ms2=1;}else{$('#ym1').removeClass('reds');ms2=0;}
        if(number=='Число'){$('#ym1').addClass('reds');ds2=1;}else{$('#ym1').removeClass('reds');ds2=0;}
        if(adres_0==''){$('#adresw0').addClass('red');as_1=1;}else{$('#adresw0').removeClass('red');as_1=0;}
        if(adres_1==''){$('#adresw1').addClass('red');as_2=1;}else{$('#adresw1').removeClass('red');as_2=0;}
        if(adres_2==''){$('#adresw2').addClass('red');as_3=1;}else{$('#adresw2').removeClass('red');as_3=0;}
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(mail=='' || !emailReg.test(mail)){$('#mailw').addClass('red');mms2=1;}else{$('#mailw').removeClass('red');mms2=0;}
        $("input[name='model2']:checked").each(function() {allVals.push($(this).val()); });
        if(allVals.length==0){$('#ch_m2').addClass('reds'); ch_2=1;}else{$('#ch_m2').removeClass('reds');ch_2=0;}
        
        if(ns2==0 && ys2==0 && ms2==0 && ds2==0 && as_1==0 && as_2==0 && as_3==0 && mms2==0 && ch_2==0 && ps2==0){
        

        
        $.getJSON('../ajax.php', {name:name,year:year,month:month,number:number,adres0:adres_0,adres1:adres_1,adres2:adres_2,adres3:adres_3,mail:mail,allch:allVals,phone:phone, action:'mc_cl' }, function(obj){
        $('#namew').val('');
        $("#yearw :first").attr("selected", "selected");
        $("#monthw :first").attr("selected", "selected");
        $("#numberw :first").attr("selected", "selected");
        $('#adresw0').val('');
        $('#adresw1').val('');
        $('#adresw2').val('');
        $('#adresw3').val('');
        $('#mailw').val('');
        $("input[name='model2']:checked").removeAttr("checked");
        });
        }
});





</script>

    
<?}else{?>


<div style="background: url(/img/bg.png);padding: 20px;margin:10px;">
<div style="display: block;width: 429px;height: 72px;padding: 26px 20px 51px 20px;margin:0px auto;background: #ffffff;text-align: center;">
<h1>Сервис временно недоступен</h1>
    <h2>Проводятся регламентные работы</h2>
</div>
</div>
<?}?>