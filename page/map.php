<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
    window.jQuery || document.write('<script type="text/javascript" src="../js/jquery.min.js"><\/script>');
    </script>
<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript">	
		var myMap, route;
        ymaps.ready(init);
       function init () {
            myMap = new ymaps.Map("map", {
                    center: [46.407394, 30.726063],
                    zoom: 17
                }); 
                
           myPlacemark = new ymaps.Placemark([46.407364, 30.725900], {
                   balloonContentHeader :'<span style="color: #333;font-size: 18px;font-weight: 600;">"Джерман-Автоцентр"</span>',
                   balloonContentBody: '<span style="color: #333;font-size: 16px;">г. Одесса ул. Левитана 44</span>',
                   balloonContentFooter :' +380(48)777-97-97, +380(482)33-65-20'
                }, {
                   iconImageHref: 'http://volkswagen.odessa.ua/img/log.png',
                   iconImageSize: [49, 48],
                 
                });

           
           
           
            myMap.controls.add(new ymaps.control.ZoomControl());
            myMap.controls.add(new ymaps.control.TypeSelector(['yandex#map', 'yandex#publicMap']));
            myMap.controls.add(new ymaps.control.TrafficControl({providerKey: 'traffic#archive'}));
            myMap.geoObjects.add(myPlacemark);    
  	
    	 $('#search_route').submit(function () {                
			var start = $("#start").val();
			var end = "Одесса, ул. Левитана 44";
            			
            ymaps.route([
                   // Список точек, которые необходимо посетить
                   [start], [end]], {
                // Опции маршрутизатора
                mapStateAutoApply: true // автоматически позиционировать карту
            }).then(function (router) {
			    route && myMap.geoObjects.remove(route);
				route = router;
                myMap.geoObjects.add(route);
            }, function (error) {
                alert("Возникла ошибка: " + error.message);
            });
				return false;
			});
		 }	
			
            
            
         
			
</script>
<div id="map" style="width:690px;height:490px"></div>

