<?php

			header("Content-type: text/html; charset=utf-8");
			                 	
			require_once ($_SERVER['DOCUMENT_ROOT'].'/bonuses/model/system/config.php');	


?>



<form class="form-horizontal" style="overflow:hidden; margin-top: 1%; " id="private_call" action="/page/contact.php" method="post">
  <input type="hidden" name="validator" value="private_call">
<fieldset>
<!-- Form Name -->
<legend>Заказать обратный звонок</legend>
<script>function goBack() {
    window.history.go(-1)
}</script>
<a class="link_d" style="float:right; position:relative;" onclick="goBack()">Назад</a>

<!-- Text input-->
<div class="form-group" style="margin-left: 40%;">
  <label class="col-md-4 control-label" for="phone">Номер телефона</label>  
  <div class="col-md-4">
  <input id="phone" name="phone" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Time input-->
<div class="form-group" style="margin-left: 40%;">
  <label class="col-md-4 control-label" for="time">Время</label>  
  <div class="col-md-4">
  <input id="time" name="time" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Button -->
<div class="form-group" style="margin-left: 40%;">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button id="singlebutton" name="singlebutton" class="btn btn-primary">Заказать</button>
  </div>
</div>
</fieldset>
</form>
<div id="result" class="alert alert-success" role="alert" style="display:none;"></div>
<script type="text/javascript">
function nidder() {
  document.getElementById("result").style.display = "none";
}
  $('#private_call').submit(function(e){
                        e.preventDefault();

  // Отсылаем паметры
           $.ajax({
                type: "POST",
                url: "/bonuses/model/navigation/contact.php",
                data: $('#private_call').serialize(),
                success: function(html) {
     //предварительно очищаем нужный элемент страницы
     $("#result").empty();
     document.getElementById("result").style.display = "block";
     //и выводим ответ php скрипта
     $("#result").append('Ваше сообщение успешно отправлено');
     setTimeout(nidder,3000);
                },
    error: function(html){
     
    }
        }); return false;
});
</script>