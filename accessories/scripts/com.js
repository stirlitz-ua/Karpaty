/*
 * SkyCom, версия: 1.1
 * http://skyscript.ru
 */
function showlayer(layer){
	layer = '#'+layer;
	var myLayer=$(layer);
	$("div.formError").remove();
	if(myLayer.css("display")=="none"){
		$('div[id*=komm]:not(layer)').css("display","none");
		myLayer.css("display","block");
	} else { 
		myLayer.css("display","none");
		}	
}
function ChooseLen() {
    M = window.document.Send.com_text.value.length;
    window.document.Send.Count.value = M;
}
$(document).ready(function() { 

$('span[id^=redname]').click(function(){
	$('span[id^=redname]').hide();
	$('div[id^=nname]').removeClass();	
	});

}); 

$(document).ready(function() { 

$('div[id*=comText]').css('cursor','pointer');

//модальные окна
$('div[id*=comText]').click(function(e) {
e.preventDefault();
var id = $(this).attr('href');	
var maskHeight = $(document).height();
var maskWidth = $(window).width();
$('#mask').css({'width':maskWidth,'height':maskHeight});
$('#mask').fadeIn(1000);
//$('#mask').fadeTo("slow",0.8);
var winH = $(window).height();
var winW = $(window).width();
$('#poleComRed').val($(this).text());
$('#poleComId').attr('value',$(this).attr('com'));
$(id).css('top', winH/2-$(id).height()/2);
$(id).css('left', winW/2-$(id).width()/2);
$(id).fadeIn(1000);

});

//если нажали закрыть
$('.window .close').click(function (e) {
e.preventDefault();
$('#mask').hide();
$('.window').hide();
});

//если кликнули по маске
$('#mask').click(function () {
$(this).hide();
$('.window').hide();
});	
	

}); //завершение