$(document).ready(function () {
$("#topNav .first_investment").hover(
    function(){
        if($(this).children('ul').css('display') == 'none' ) $(this).children('ul').slideDown();
        //$(this).find("ul").stop(true, true).slideDown();
    }, 
    function () { 
        $(this).children('ul').slideUp();
        //$(this).find("ul").stop(true, true).slideUp();
    }
);
$('#top_ban').hover(
function(){
   $(this).html('<a href="/company/novosti/yarmarka_finansirovaniya_ot_djerman_avtocentr/">Регистрация на тест-драйв</a><br><a href="/company/novosti/yarmarka_finansirovaniya_ot_djerman_avtocentr/">Регистрация на мастер-класс</a>');
 }, function () {  
   
    $(this).html('Регистрация на<br />Ярмарку Финансирования');
});    


$(".fasebook").hover(
    function(){
        if($(this).children('.divs').css('display') == 'none' ) $(this).children('.divs').slideDown();
        
    }, 
    function () { 
        $(this).children('.divs').slideUp();

    }
);
$('.bl_br').click(function(){
    id=$(this).attr('rel');
    $('.bl_br').hide();
    $('.uk_ft_li').show();
    $('.uk_ft_li li').removeClass('activ');
    $('#for_id_li'+id).addClass('activ');
    $('.for_id_l').hide();
    $('#for_id'+id).show();
    $('.for_id_close').show();
});
$('.bl_brs').click(function(){
    id=$(this).attr('rel');
    $('.bl_br').hide();
    $('.uk_ft_li').show();
    $('.uk_ft_li li').removeClass('activ');
    $('#for_id_li4').addClass('activ');
    $('.for_id_l').hide();
    $('#for_id'+id).show();
    $('.for_id_close').show();
});



$('.uk_ft_li li').click(function(){
    id=$(this).attr('rel');
    $('.uk_ft_li li').removeClass('activ');
    $('#for_id_li'+id).addClass('activ');
    $('.for_id_l').hide();
    $('#for_id'+id).show();
    
});
$('.for_id_close').click(function(){
    $('.bl_br').show();
    $('.uk_ft_li').hide();
    $('.for_id_l').hide();
    $('.for_id_close').hide();
});

$('.fr').click(function(){
    id=$(this).attr('rel');
    $('.fr').removeClass('activ');
    $(this).addClass('activ');
    $('#form1').hide();
    $('#form2').hide();
    $('#'+id).show();
});
$('.vkl_m_f li').click(function(){
    $('.vkl_m_f li').removeClass('activ');
    $(this).addClass('activ')
    id=$(this).attr('rel');
    $('#td1, #td2, #td3').hide();
    $('#td'+id).show();
});





$(".formV").submit(function() {
    name=$("input[name=name]").val();
    city=$("input[name=city]").val();
    phone=$("input[name=phone]").val();
    grade=$("input[name=grade]:checked").val();
    if(grade > 0){$('.formV p').css('border-bottom', '1px solid #fff');}else{$('.formV p').css('border-bottom', '1px solid red');}
    if(name !=''){$('input[name=name]').css('border', '1px solid gray');}else{$('input[name=name]').css('border', '1px solid gray').css('border-bottom', '1px solid red');}
    if(city !=''){$('input[name=city]').css('border', '1px solid gray');}else{$('input[name=city]').css('border', '1px solid gray').css('border-bottom', '1px solid red');}
    if(phone !=''){$('input[name=phone]').css('border', '1px solid gray');}else{$('input[name=phone]').css('border', '1px solid gray').css('border-bottom', '1px solid red');}
    if(grade > 0 && name !='' && city !='' && phone !=''){
        return true;
    }else{
       return false; 
    }  
});











equalHeight($(".blok_complete"));



$('#rkl img').hover(function () {id=$(this).attr('rel');id0=parseInt(id)-4;id1=parseInt(id)-3;id2=parseInt(id)-2;id3=parseInt(id)-1;id4=parseInt(id)+1;id5=parseInt(id)+2;id6=parseInt(id)+3;id7=parseInt(id)+4;$('#img'+id).stop(true).animate({'width':'216px','height': '124px'},300,'linear');$('#img'+id3).stop(true).animate({'width':'157px','height': '87px'},300,'linear');$('#img'+id4).stop(true).animate({'width':'157px','height': '87px'},300,'linear');$('#img'+id0).stop(true).animate({'width':'126px','height': '70px'},300,'linear');$('#img'+id1).stop(true).animate({'width':'126px','height': '70px'},300,'linear');$('#img'+id2).stop(true).animate({'width':'126px','height': '70px'},300,'linear');$('#img'+id5).stop(true).animate({'width':'126px','height': '70px'},300,'linear');$('#img'+id6).stop(true).animate({'width':'126px','height': '70px'},300,'linear');$('#img'+id7).stop(true).animate({'width':'126px','height': '70px'},300,'linear');}, function () { $.each([1, 2, 3, 4, 5], function(i) {ic=i+1;$('#img'+ic).stop(true).animate({'width':'157px','height': '87px'},220,'linear');});});

Cufon.replace('h1', { fontFamily: 'vw-headline-ot-black' });
Cufon.replace('h2', { fontFamily: 'vw-headline-ot-black' });
Cufon.replace('h3', { fontFamily: 'vw-headline-ot-black' });
Cufon.replace('h4', { fontFamily: 'vw-headline-ot-black' });
Cufon.replace('h5', { fontFamily: 'vw-headline-ot-semibold' });
Cufon.replace('.first_investment_home', {fontFamily: 'vw-headline-ot-book', color:'#33434C'});
Cufon.replace('.heder_model_s', {fontFamily: 'vw-headline-ot-book', color:'#33434C'});
Cufon.replace('.heder_model', {fontFamily: 'vw-headline-ot-semibold'});
Cufon.replace('.second_embedding_model strong', {fontFamily: 'vw-headline-ot-semibold'});
Cufon.replace('.second_embedding li a', {fontFamily: 'vw-headline-ot-book'});
Cufon.replace('.heder_page ul li a', {fontFamily: 'vw-headline-ot-book', hover: { color: '#2274AC' }});
Cufon.replace('.heder_page_name', {fontFamily: 'vw-headline-ot-black'});
Cufon.replace('.heder_page_name_red', {fontFamily: 'vw-headline-ot-book',color:'#ff0000'});
Cufon.replace('.fr', {fontFamily: 'vw-headline-ot-book'});






         
});

 function equalHeight(group) {
        tallest = 0;
        group.each(function() {
            thisHeight = $(this).height();
            if(thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest+102);
        $(".blok_complete img").show();
    }

