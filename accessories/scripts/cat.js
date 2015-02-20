/*
 * skyscript.ru  skystudio.ru
 */

function tolkoCif(input) { 
    input.value = input.value.replace(/[^\d.]/g, '');
};

function showlayer(layer){
	var myLayer=document.getElementById(layer);
	if(myLayer.style.display=="none" || myLayer.style.display==""){
		myLayer.style.display="block";
	} else { 
		myLayer.style.display="none";
		}
}
function inputBG( obj, on )
 {
	if(on) obj.className='bginp1';
	 else if( !obj.value ) obj.className='bginp2';
 }

$(document).ready(function() { 

$("a.gallery").fancybox();
 
//показ подкатегорий

$('img[id*=otPodcat]').click(function(){
if($(this).attr('otkr')==0) { 
$('#Podcat'+$(this).attr('cat')).removeClass(); $(this).attr({'otkr':1,'src':'pic/cat-dt.gif'}); 
$.cookie('Podcat'+$(this).attr('cat'),1);
}
else { 
$('#Podcat'+$(this).attr('cat')).addClass('nevid'); $(this).attr({'otkr':0,'src':'pic/cat-cl.gif'}); 
$.cookie('Podcat'+$(this).attr('cat'), null);
}

	});
	
	
}); //завершение
