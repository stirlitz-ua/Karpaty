<head>
    <meta charset="UTF-8">
</head>
<div align="center"><form id="tc" method="POST" action="/calculator/"><div><div style="font-weight:bold;font-style:italic;padding:10px 10px 10px 40px;">Выберите автомобиль, укажите дату его продажи и пробег для планового ТО:</div>
            <table cellpadding="0" cellspacing="0" border="0" id="to_select"><tbody><tr>
                    <td colspan="2">
                        <table cellpadding="0" cellspacing="0" border="0"><tbody><tr>
                                <td colspan="3" style="text-align:center;font-weight:bold;font-size:14px;">Марка автомобиля</td></tr><tr id="brands">
                                <td><a href="#" id="vw"><img src="/calculator/img/volkswagen.png" alt="Техническое обслуживание Фольксваген"></a></td>
                                <td><a href="#" id="audi"><img src="/calculator/img/audi.png" style="margin-left:60px; margin-right:60px;" alt="Техническое обслуживание Ауди"></a></td>
                                <td><a href="#" id="skoda"><img src="/calculator/img/skoda.png" alt="Техническое обслуживание Шкода"></a></td></tr></tbody></table>
                    </td></tr></tbody></table></div></form></div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('#vw').click(function(){
            $('#iframeHolder').empty()
            if(!$('#iframe').length) {
                $('#iframeHolder').html('<iframe id="iframe" src="/calculator/volkswagen.html" width="390" height="535" frameborder="0" scrolling="no"></iframe>');
            }
        });
        $('#audi').click(function(){
            $('#iframeHolder').empty()
            if(!$('#iframe').length) {
                $('#iframeHolder').html('<iframe id="iframe" src="/calculator/Audi.html"  width="390" height="535" frameborder="0" scrolling="no"></iframe>');
            }
        });
        $('#skoda').click(function(){
            $('#iframeHolder').empty()
            if(!$('#iframe').length) {
                $('#iframeHolder').html('<iframe id="iframe" src="/calculator/Skoda.html" width="390" height="565" frameborder="0" scrolling="no"></iframe>');
            }
        });
    });
</script>

<div id="iframeHolder" style="margin-left:43%"></div>
<h4 style="margin-left: 200px; align="center">! Калькулятор находится в тестовом режиме. Результаты расчетов могут нуждаться в уточнениях
</h4>