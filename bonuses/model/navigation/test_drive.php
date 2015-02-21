<?php
			header("Content-type: text/html; charset=utf-8");
			                 
			require_once ($_SERVER['DOCUMENT_ROOT'].'/bonuses/model/system/config.php');

?>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="http://karpaty-autocenter.com.ua/bonuses/view/template/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" media="screen"  href="http://karpaty-autocenter.com.ua/bonuses/view/template/css/bootstrap-datetimepicker.min.css">

<form class="form-horizontal" style="overflow:hidden;" action="/bonuses/model/navigation/contact.php" method="post" id="test_drive">
<input type="hidden" name="validator" value="test_drive">
<fieldset>

<!-- Form Name -->
<legend>Тест драйв</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="model">Модель</label>  
  <div class="col-md-4">
  <input id="model" name="model" type="text" placeholder="" class="form-control input-md" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="fam">Фамилия</label>  
  <div class="col-md-4">
  <input id="fam" name="fam" type="text" placeholder="" class="form-control input-md" required="">
  </div>
</div>

<div class="form-group">
  <label class="col-md-4 control-label" for="name">Имя</label>  
  <div class="col-md-4">
  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" for="surname">Отчество</label>  
  <div class="col-md-4">
  <input id="surname" name="surname" type="text" placeholder="" class="form-control input-md" required="">
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="text">Контактный телефон</label>  
  <div class="col-md-4">
  <input id="tel" name="tel" type="text" placeholder="" class="form-control input-md"> 
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label " for="date" >Дата</label>  
  <div class="col-md-4 input-group date" id="pdate">
  <input id="date" name="date" type="text" placeholder="Укажите удобную для Вас дату звонка" class="form-control input-md" required="">
    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
  </div>
</div>
<script type="text/javascript">
            $(function () {
                $('#pdate').datetimepicker({
                    format: 'DD-MM-YYYY',
                    locale: 'ru'
                });
            });
</script>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="time">Время</label>  
  <div class="col-md-4 input-group date" id="ptime">
  <input id="time" name="time" type="text" placeholder="Укажите удобное время звонка" class="form-control input-md" required="">
    <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
  </div>
</div>
<script type="text/javascript">
            $(function () {
                $('#ptime').datetimepicker({
                    format: 'hh:mm'
                });
            });
</script>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="note">Примечание</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="note" name="note"></textarea>
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="singlebutton"></label>
  <div class="col-md-4">
    <button type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary">Заказать</button>
  </div>
</div>

</fieldset>
</form>
<div id="result" class="alert alert-success" role="alert" style="display:none;"></div>

<script type="text/javascript">
function nidder() {
  document.getElementById("result").style.display = "none";
}
  $('#test_drive').submit(function(e){
                        e.preventDefault();

  // Отсылаем паметры
           $.ajax({
                type: "POST",
                url: "/bonuses/model/navigation/contact.php",
                data: $('#test_drive').serialize(),
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