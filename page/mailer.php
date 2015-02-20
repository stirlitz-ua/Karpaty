<html>
<script id="tinyhippos-injected">if (window.top.require) { window.top.require("ripple/bootstrap").inject(window, document); }</script><head><link rel="stylesheet" type="text/css" href="/css/style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.maskedinput-1.3.js" type="text/javascript"></script>

<style>


.table th, .table td {
padding: 3px 8px 0 9px;
line-height: 25px;
text-align: left;
vertical-align: top;
border-top: 1px solid #DDD;
font-size: 12px;
}
</style>




</head><body><br>


<table class="table table-hover">
<tbody><tr>
<td style="width: 100px;">Пол:</td>
<td>
<label class="radio inline"><input class="radio" name="form_gender" type="radio" value="female">Женский</label>
<label class="radio inline"><input class="radio" name="form_gender" type="radio" value="male">Мужской</label>
</td>
</tr>



<tr>
<td>Фамилия</td>
<td>
    <div id="lnd" class="input-prepend">
      <span class="add-on"><i class="icon-font"></i></span>
      <input class="span3 lastname" id="inputIcon" type="text" placeholder="Ваша Фамилия">
    </div>
</td>
</tr>

<tr>
<td>Имя</td>
<td>
    <div id="fnd" class="input-prepend">
      <span class="add-on"><i class="icon-font"></i></span>
      <input class="span3 firstname" id="inputIcon" type="text" placeholder="Ваше Имя">
    </div>
    
   
</td>
</tr>

<tr>
<td>Отчество</td>
<td>
    <div id="pnd" class="input-prepend">
      <span class="add-on"><i class="icon-font"></i></span>
      <input class="span3 patronymic" id="inputIcon" type="text" placeholder="Ваше Отчество">
    </div>
</td>
</tr>

<!--tr>
<td>Дата рождения</td>
<td>
    <div id="bd" class="input-prepend" style="float: left;">
      <span class="add-on"><i class="icon-globe"></i></span>
      <input class="span3 	birthday" id="inputIcon" type="text" placeholder="Ваша дата рождения"> 
    </div>
    <label style="float: left;margin:3px 0 0 7px;">01.01.1980 </label>
</td>
</tr-->


<tr>
<td>Телефон</td>
<td>
    <div id="pd" class="input-prepend">
      <span class="add-on"><i class="icon-globe"></i></span>
      <input class="span3 phones" id="inputIcon" type="text" placeholder="Ваш Тел.">
    </div>
</td>
</tr>

<!--tr>
<td>Город</td>
<td>
    <div id="cd" class="input-prepend">
      <span class="add-on"><i class="icon-home"></i></span>
      <input class="span3 city" id="inputIcon" type="text" value="">
    </div>
</td>
</tr-->

<tr>
<td>E-Mail</td>
<td>
    <div id="md" class="input-prepend">
      <span class="add-on"><i class="icon-envelope"></i></span>
      <input class="span3 mail" id="inputIcon" type="text" placeholder="Ваш E-mail">
    </div>
</td>
</tr>
<tr>
<td>Формат</td>
<td>
<label class="radio inline"><input class="radio" name="form_format" type="radio" checked="checked" value="html">HTML-Формат</label>
<label class="radio inline"><input class="radio" name="form_format" type="radio" value="plain">Текст-Формат</label>

</td>
</tr>
<tr>
<td></td>
<td><input type="submit" onclick="formsubmit();" id="bt" class="btn btn-info" value="Подписаться на новости"></td>
</tr>
</tbody></table>



<script>
$(document).ready(function () {
   $(".phones").mask("(999) 99-99-999");
   $('.birthday').mask("99.99.9999");
});

function formsubmit(){
    var firstname = $('.firstname').val();
    var lastname=$('.lastname').val();
    var patronymic=$('.patronymic').val();
    var birthday=$('.birthday').val();
    var phone =$('.phones').val();
    var city=$('.city').val();
    var mail=$('.mail').val();
    var format=$(":radio[name=form_format]").filter(":checked").val();
    var gender=$(":radio[name=form_gender]").filter(":checked").val();
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    
    $('#bt').removeClass('btn-danger').removeClass('btn-info').removeClass('btn-warning').removeClass('btn-success').val('Ожидайте').attr('disabled', 'disabled');
    
    if(firstname==''){
    $('#fnd').addClass('control-group error');
    $('#fnd span').css('background','B94A48');
    }else{
    $('#fnd').removeClass('control-group error');
    $('#fnd span').css('background','EEE');
    var fn='ok';
    }
    
    
    if(lastname==''){
    $('#lnd').addClass('control-group error');
    $('#lnd span').css('background','B94A48');
    }else{
    $('#lnd').removeClass('control-group error');
    $('#lnd span').css('background','EEE');
    var ln='ok';
    }
    
    if(patronymic==''){
    $('#pnd').addClass('control-group error');
    $('#pnd span').css('background','B94A48');
    }else{
    $('#pnd').removeClass('control-group error');
    $('#pnd span').css('background','EEE');
    var ptn='ok';
    }
    
    
    if(phone==''){
    $('#pd').addClass('control-group error');
    $('#pd span').css('background','B94A48');
    }else{
    $('#pd').removeClass('control-group error');
    $('#pd span').css('background','EEE');
    var bn='ok';
    }
    
    if(birthday==''){
    $('#bd').addClass('control-group error');
    $('#bd span').css('background','B94A48');
    }else{
    $('#bd').removeClass('control-group error');
    $('#bd span').css('background','EEE');
    var pn='ok';
    }
    
    
    
    if(city==''){
    $('#cd').addClass('control-group error');
    $('#cd span').css('background','B94A48');
    }else{
    $('#cd').removeClass('control-group error');
    $('#cd span').css('background','EEE');
    var cn='ok';
    }
    
    
    if(mail=='' || !emailReg.test(mail)){
    $('#md').addClass('control-group error');
    $('#md span').css('background','B94A48');
    }else{
    $('#md').removeClass('control-group error');
    $('#md span').css('background','EEE');
    var mn='ok';
    }
    
    
    if(fn=='ok' && ln=='ok' && pn=='ok' && cn=='ok' && mn=='ok' && ptn=='ok' && bn=='ok'){
        $.getJSON('register_user.php', {patronymic:patronymic, 
        //birthday:birthday, 
        firstname:firstname, lastname:lastname, phone:phone, city:city,mail:mail, format:format, gender:gender}, function(obj){
        
        //alert(obj.json);
        if(obj.json=='bed'){
            $('#md').addClass('control-group error');
            $('#md span').css('background','B94A48');
            $('#bt').addClass('btn-danger').val('E-mail: '+mail+' уже есть в базе данных').removeAttr('disabled');
        }else{
            $('.firstname').val('');
            $('.lastname').val('');
            $('.phones').val('');
            $('.city').val('');
            $('.mail').val('');
            $('#bt').addClass('btn-success').val('Заявка принята '+lastname+' '+firstname).removeAttr('disabled');
        }
        
        });
        
        
        
        
    }else{
        $('#bt').addClass('btn-warning').val('Заполните все поля').removeAttr('disabled');
    }  
    
    
}

</script></body></html>