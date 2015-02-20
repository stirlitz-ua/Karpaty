$(document).ready(function() {

     

$('.tool').tooltip('hide');

$('.popov').popover('show');



$('.icon-plus.tool.sawe_comp_n').click(function(){
    location.reload();
});


$(".tblock").keyup(function(){maxchars = $(this).attr('maxlength');id = $(this).attr('rel');number = $(this).val().length;if(number <= maxchars){$("#span_text"+id).html(maxchars-number + " символов осталось");}});

$("#inputname").keyup(function(){nam = $(this).val();$("#inputname3").val(translite(nam));});



$('#add_set0').click(function(){

    $('#myModal').modal('show');

    $('#mb_s').html('<div class="input-append"><input style="width: 422px;" id="appendedInputButton" type="text"><button class="btn" type="button" onclick="sawe_set(0)">Добавить</button></div>');

    

    

});

$('#add_set2').click(function(){

    $('#myModal').modal('show');

    $('#mb_s').html('<div class="input-append"><input style="width: 422px;" id="appendedInputButton" type="text"><button class="btn" type="button" onclick="sawe_set(2)">Добавить</button></div>');

    

    

});



$('#add_set1').click(function(){

    $('#myModal').modal('show');

    $.getJSON('/ajax.php', {action:'cena_set' }, function(obj){

        $('#mb_s').html('<div class="form-inline"> <input type="text" class="input-small" value="'+obj.json[0]+'" id="ot_set" placeholder="от"><input value="'+obj.json[1]+'" type="text" class="input-small" id="do_set" placeholder="до"><button type="submit" class="btn" onclick="sawe_set(1)">Сохранить</button></div>');

   });

});





$('.del_m_p').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_m_p' }, function(obj){

         $('#tr'+id).fadeOut(500).addClass('error');

   });

});





$('.del_set').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_se' }, function(obj){

         $('.id_'+id).fadeOut(500).addClass('error');

   });

});



$('.del_cat').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_ca' }, function(obj){

         $('.id_'+id).fadeOut(500).addClass('error');

   });

});

$('.op_ft').click(function(){

    id=$(this).attr('rel');

   $('#fr'+id).toggle();

});



$('.del_ft').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_ft' }, function(obj){

         $('#fr'+id).fadeOut(500).addClass('error');

         $('#frq'+id).fadeOut(500).addClass('error');

   });

});



$('.edit_set').click(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'editset' }, function(obj){

        $('#myModal').modal('show');

        $('#mb_s').html('<div class="input-append"><input type="hidden" value="'+id+'" id="appendedInput" /><input style="width: 369px;" value="'+obj.json+'" id="appendedInputButton"  type="text"><input style="width: 20px;" value="'+obj.weight+'" id="appendedWeightButton" type="text"><button class="btn" type="button" onclick="sawe_set(4)">Редактировать</button></div>');

     

   });

});



$('.del_p').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'delp' }, function(obj){

        $('.id_'+id).fadeOut(500).addClass('error');

   });

});



$('.delpp').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'delpp' }, function(obj){

        $('.id_'+id).fadeOut(500).addClass('error');

   });

});



$('.del_photo').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'delphoto' }, function(obj){

        $('.id_'+id).fadeOut(500).addClass('error');

   });

});





$('.del_dl').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'deldl' }, function(obj){

        $('#dl'+id).empty().hide();

   });

});

$('.deldts').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'deldl' }, function(obj){

        $('#dfght'+id).fadeOut(500).addClass('error');

   });

});

 

$('.del_m_dt').dblclick(function(){

    id=$(this).attr('rel');

    idm=$(this).attr('reg');

    $.getJSON('/ajax.php', {id:id,idm:idm, action:'deldlmm' }, function(obj){

        $('#df'+id+idm).fadeOut(500).addClass('error');

   });

});



$('#add_mail').click(function(){

        $('#myModal').modal('toggle');

        $('#inputid').val('0');

        $('#inputEmail').val('');

        $('#inputsmtp').val('');

        $('#inputportr').val('');

        $('#inputpass').val('');

        $('#inputtitle').val('');

});



$('.del_mail').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_mail' }, function(obj){

        $('#mai'+id).fadeOut(500).addClass('error');

   });

});

$('#deletemails').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_mail_post' }, function(obj){

        location.href='?distribution&post_mail';

   });

});



$('.deletema').click(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_mail_post' }, function(obj){

        $('#mails'+id).addClass('error').fadeOut(500);

   });

});











$('.edit_mail').click(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'edit_mail' }, function(obj){

        $('#myModal').modal('toggle');

        $('#inputid').val(obj.json['id']);

        $('#inputEmail').val(obj.json['mail']);

        $('#inputsmtp').val(obj.json['smtp']);

        $('#inputportr').val(obj.json['port']);

        $('#inputpass').val(obj.json['pass']);

        $('#inputtitle').val(obj.json['title']);

   });

});



$('#template_mail').click(function(){

    $('#mail_temp').toggle("slow");

});











$('.dtplus').click(function(){

    id=$(this).attr('reg');

    $('#dtpl').append('<div class="control-group"><label class="control-label" for="inputdk">д/т</label><div class="controls"><input type="text" id="inputdk"  name="dvig[]"  class="input-xlarge" placeholder="двигатель и трансмиссия" /><div class="cl"></div><label style="float: left;margin-right: 5px;"><input type="radio" name="tip'+id+'" value="0" checked="checked" />бен.</label><label style="float: left;"><input type="radio" name="tip'+id+'" value="1" />диз.</label></div></div>');

    id++;

    $(this).attr('reg', id);

});





$('#inputk22').keyup(function(){

    $('#sawe_cena').removeClass('icon-check').addClass('icon-edit');

    $('#sawe_cena2').removeClass('icon-check').addClass('icon-edit');

});



$('#sawe_cena').click(function(){

    id=$(this).attr('rel');

    v=$('#inputk22').val();

    $.getJSON('/ajax.php', {id:id,v:v, action:'cenna' }, function(obj){

        $('#sawe_cena').removeClass('icon-edit').addClass('icon-check');

   });

});

$('#sawe_cena2').click(function(){

    id=$(this).attr('rel');

    v=$('#inputk22').val();

    $.getJSON('/ajax.php', {id:id,v:v, action:'cenna' }, function(obj){

        $('#sawe_cena2').removeClass('icon-edit').addClass('icon-check');

        $('#myModal').modal('hide');

        $('#el'+id).attr('reg', v);

        if(v!=''){

            $('#el'+id).removeClass('act-danger').addClass('act-info').html(v+' $');

        }else{

            $('#el'+id).removeClass('act-info').addClass('act-danger').html('none');

        }

   });

});







$('.dbl_complete').click(function(){

    id=$(this).attr('rel');

    ids=$(this).attr('reg');

    $.getJSON('/ajax.php', {id:id,ids:ids, action:'dblcomplete' }, function(obj){

        history.go(0);

    });

});







$('.cur_id_cena').click(function(){

    id=$(this).attr('rel');

    cen=$(this).attr('reg');

    $('#sawe_cena2').attr('rel', id);

    $('#inputk22').val(cen);

    $('#myModal').modal('show');

});



$('#sawe_comp').click(function(){

    id=$(this).attr('rel');

    v=$('#inputsk').val();

    if(v!=''){

    $.getJSON('/ajax.php', {id:id,v:v, action:'sawecomp' }, function(obj){

        if(obj.json=='n'){

            alert('Дубликат!!!');

        }else{

            history.go(0);

        }

    });

    }

});











$('.avto_plus').typeahead({

    items:20,

    source:[

        'Volkswagen Polo',

        'Volkswagen Polo Trendline',

        'Volkswagen Polo Fly',

        'Volkswagen Polo Comfortline',

        'Volkswagen Cross Polo',

        'Volkswagen Polo Sedan',

        'Volkswagen Polo Sedan Trendline',

        'Volkswagen Polo Sedan Comfortline',

        'Volkswagen Polo Sedan Highline',

        'Volkswagen Golf',

        'Volkswagen Golf Team',

        'Volkswagen Golf Highline',

        'Volkswagen Golf GTI',

        'Volkswagen Golf R',

        'Volkswagen Golf Comfortline',

        'Volkswagen Golf Plus',

        'Volkswagen Golf Plus Trendline',

        'Volkswagen Golf Plus Comfortline',

        'Volkswagen Golf Variant',

        'Volkswagen Golf Variant Trendline',

        'Volkswagen Golf Variant Comfortline',

        'Volkswagen Touran',

        'Volkswagen Touran Trendline',

        'Volkswagen Touran Comfortlin',

        'Volkswagen Touran Highline',

        'Volkswagen Touran Cross',

        'Volkswagen Touran Special',

        'Volkswagen Jetta',

        'Volkswagen Jetta Pride',

        'Volkswagen Jetta Trendline',

        'Volkswagen Jetta Comfortline',

        'Volkswagen Jetta Highline',

        'Volkswagen Scirocco',

        'Volkswagen Eos',

        'Volkswagen Tiguan',

        'Volkswagen Tiguan Trend&Fun',

        'Volkswagen Tiguan Track&Field',

        'Volkswagen Tiguan Sport&Style',

        'Volkswagen Tiguan Track&Style',

        'Volkswagen Tiguan Fun',

        'Volkswagen Tiguan Track',

        'Volkswagen Tiguan Sport',

        'Volkswagen Tiguan Style',

        'Volkswagen Passat',

        'Volkswagen Passat Trendline',

        'Volkswagen Passat Comfortlin',

        'Volkswagen Passat Highline',

        'Volkswagen Passat Trend',

        'Volkswagen Passat Comfort',

        'Volkswagen Passat ComfortPlus',

        'Volkswagen Passat Premium',

        'Volkswagen Passat PremiumPlus',

        'Volkswagen Passat Variant',

        'Volkswagen Passat Variant Trendline',

        'Volkswagen Passat Variant Comfortlin',

        'Volkswagen Passat Variant Highline',

        'Volkswagen Passat Alltrack',

        'Volkswagen CC',

        'Volkswagen Touareg',

        'Volkswagen Touareg Life',

        'Volkswagen Touareg V6 TDI',

        'Volkswagen Touareg V6 FSI',

        'Volkswagen Touareg V8 TDI',

        'Volkswagen Touareg V8 FSI',

        'Volkswagen Caddy Kombi',

        'Volkswagen Caddy Kombi Startline',

        'Volkswagen Caddy Kombi Trendline',

        'Volkswagen Caddy Kombi Comfortline',

        'Volkswagen Caddy Kombi Highline',

        'Volkswagen Caddy Kombi Maxi Startline',

        'Volkswagen Caddy Kombi Maxi Trendline',

        'Volkswagen Caddy Kombi Maxi Comfortline',

        'Volkswagen Caddy Kasten',

        'Volkswagen Caddy Kasten Kasten (короткая база)',

        'Volkswagen Caddy Kasten Kombi (короткая база)',

        'Volkswagen Caddy Kasten Kasten (длинная база)',

        'Volkswagen Caddy Kasten Kombi (длинная база)',

        'Volkswagen Multivan',

        'Volkswagen Multivan Long',

        'Volkswagen Multivan Comfortline',

        'Volkswagen Multivan Startline',

        'Volkswagen Multivan Business',

        'Volkswagen Multivan Highline',

        'Volkswagen Multivan Edition25',

        'Volkswagen Amarok',

        'Volkswagen Amarok DoubleCab',

        'Volkswagen Amarok DoubleCab Trendline',

        'Volkswagen Amarok DoubleCab Highline',

        'Volkswagen Caravelle',

        'Volkswagen Caravelle Trendline',

        'Volkswagen Caravelle Comfortline',

        'Volkswagen Crafter',

        'Volkswagen Crafter 30, колесная база 3250 мм',

        'Volkswagen Crafter 30, колесная база 3665 мм',

        'Volkswagen Crafter 50, колесная база 4325 мм',

        'Volkswagen Crafter 35, колесная база 3665 мм,',

        'Volkswagen Crafter 50, колесная база 3665 мм',

        'Volkswagen Crafter 35, колесная база 4325 мм',

        'Volkswagen Crafter Pritschen',

        'Volkswagen Crafter Pritschen 30, колесная база 3250 мм',

        'Volkswagen Crafter Pritschen 35, колесная база 3250 мм',

        'Volkswagen Crafter Pritschen 30, колесная база 3665 мм',

        'Volkswagen Crafter Pritschen 35, колесная база 3665 мм',

        'Volkswagen Crafter Pritschen 50, колесная база 3665 мм',

        'Volkswagen Crafter Pritschen 35, колесная база 4325 мм',

        'Volkswagen Crafter Pritschen 50, колесная база 4325 мм',

        'Volkswagen Crafter Kasten',

        'Volkswagen Crafter Kasten 30, колесная база 3250 мм',

        'Volkswagen Crafter Kasten 35, колесная база 3250 мм',

        'Volkswagen Crafter Kasten 30, колесная база 3665 мм',

        'Volkswagen Crafter Kasten 35, колесная база 3665 мм',

        'Volkswagen Crafter Kasten 50, колесная база 3665 мм',

        'Volkswagen Crafter Kasten 35, колесная база 4325 мм',

        'Volkswagen Crafter Kasten 50, колесная база 4325 мм',

        'Volkswagen Transporter Kasten',

        'Volkswagen Transporter Kombi'

        ]

});













$('.del_p').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_p' }, function(obj){

         $('.id_'+id).fadeOut(500).addClass('error');

   });

});







$('.delban').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'delban' }, function(obj){

         $('.bn'+id).fadeOut(500).addClass('error');

   });

});









$('#chehome').change(function(){

    if($("#chehome").filter(':checked').size()==0) {

        $('.h2s').hide();

        $('.h1s').hide();

        

    }else{

        $('.h1s').show();

        $('.h2s').show();

    }

   

});

$('.add_ban').click(function(){

    $('.ban_table').append('<tr><td><div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-preview thumbnail" style="width: 300px; height: 150px;"></div><div><span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo" type="file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></div></div></td><td><label>link: <input type="text" value="/" name="new_link" class="input-xxlarge" /></label></td><td></td></tr>');

});





$('.add_text').click(function(){

    id=$(this).attr('rel');

    text=$('.add_text'+id).val();

    $('#atext'+id).append('<input value="'+text+'" type="text" class="input-xxlarge"  name="car_opt'+id+'[]" /><br>');

});

$('.addph').click(function(){

    $('#adph').append('<div class="fileupload fileupload-new" data-provides="fileupload"><div class="fileupload-preview thumbnail" style="width: 200px; height: 200px;"><img src="img/img200x200.jpg" /></div><div> <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="photo[]" type="file" /></span><a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a></div></div>');

});





$('.delavto0').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_a0' }, function(obj){

        $('#td'+id).fadeOut(700).addClass('error');

   });

    

});



$('.delavto1').dblclick(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'del_a1' }, function(obj){

        $('#td'+id).fadeOut(700).addClass('error');

   });

    

});





$('.edit_comp').click(function(){

     id=$(this).attr('rel');

     $.getJSON('/ajax.php', {id:id, action:'editcomp' }, function(obj){

        

        $('#inp_ed').val(obj.json);

        $('#sawe2').attr('rel', id);

       $('#myModal').modal('show');

    });

     

     

     

});



$('#sawe2').click(function(){

   id=$(this).attr('rel');

   te=$('#inp_ed').val();

   $.getJSON('/ajax.php', {id:id,te:te, action:'swcomp' }, function(obj){

       $('#myModal').modal('hide');

       $('#lbbb'+id).html(te);

       $('#inputskn'+id).attr('placeholder', 'Установить '+te);

   }); 

});





$('.sawe_comp_n').click(function(){

    id=$(this).attr('rel');

    id_m=$(this).attr('reg');

    v=$('#inputskn'+id).val();

    ch1=$('#inl1'+id).prop("checked");

    ch2=$('#inl2'+id).prop("checked");

    ch3=$('#inl3'+id).prop("checked");

    $.getJSON('/ajax.php', {id:id,id_m:id_m,v:v,ch1:ch1,ch2:ch2,ch3:ch3,action:'saweomp_op_n' }, function(obj){

        

        

    });   

});



$('.error_cl').click(function(){

    

   $('#mod_error').prepend('dddd'); 

   $('#myModal_copy').modal('show');

});

$('.cl_ob').click(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id,action:'clob' }, function(obj){

        if(obj.json==0){

            $('#clob'+id).removeClass('label-info');

        }else{

            $('#clob'+id).addClass('label-info');

        }

    });  

});



$('.cl_so').click(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id,action:'clso' }, function(obj){

        if(obj.json==0){

            $('#clso'+id).removeClass('label-info');

        }else{

            $('#clso'+id).addClass('label-info');

        }

    });  

});



$('.cl_op').click(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id,action:'clop' }, function(obj){

        if(obj.json==0){

            $('#clop'+id).removeClass('label-info');

        }else{

            $('#clop'+id).addClass('label-info');

        }

    });  

});









$('#m').click(function(){

    $('#m').hide();

    $('#s').show();

});



$('#s_m').click(function(){

    $('#m').show();

    $('#s').hide();

});



$('#s_m2').click(function(){

    id=$(this).attr('rel');

    t=$('.input1').val();

    $.getJSON('/ajax.php', {id:id,t:t, action:'s_m' }, function(obj){

        if(obj.json==0){

            $('#m').removeClass('btn-info').addClass('btn-danger');

        }else{

            $('#m').removeClass('btn-danger').addClass('btn-info');

        }

        $('#m').show();

        $('#s').hide();

    });  

});







$('#z').click(function(){

    $('#z').hide();

    $('#d').show();

});



$('#z_d').click(function(){

    $('#z').show();

    $('#d').hide();

});



$('#z_d2').click(function(){

    id=$(this).attr('rel');

    t=$('.input2').val();

    $.getJSON('/ajax.php', {id:id,t:t, action:'z_d' }, function(obj){

        if(obj.json==0){

            $('#z').removeClass('btn-info').addClass('btn-danger');

        }else{

            $('#z').removeClass('btn-danger').addClass('btn-info');

        }

        $('#z').show();

        $('#d').hide();

    });  

});



























$('.sinch').click(function(){

    id=$(this).attr('rel');

    $.getJSON('/ajax.php', {id:id, action:'t_d' }, function(obj){

      if(obj.json==0){

        $('.sinch').find('i').removeClass('icon-refresh').addClass('icon-random');

        $('.sinch').attr('data-original-title', 'нет синхронизации').removeClass('btn-info').addClass('btn-danger');

       }else{

        $('.sinch').find('i').removeClass('icon-random').addClass('icon-refresh');

        $('.sinch').attr('data-original-title', 'Синхронизировано').removeClass('btn-danger').addClass('btn-info');

       }

    }); 

    

    

    

    

});

   







var textarea1= CKEDITOR.replace( 'textarea1',{}); CKFinder.setupCKEditor( textarea1, 'js/ckfinder' ) ;

var textarea2= CKEDITOR.replace( 'textarea2',{}); CKFinder.setupCKEditor( textarea2, 'js/ckfinder' ) ;

});



function translite(str){

    var translit = {"А":"a","Б":"b","В":"v","Г":"g","Д":"d","Е":"e","Ж":"j","З":"z","И":"i","Й":"j","К":"k","Л":"l","М":"m","Н":"n","О":"o","П":"p","Р":"r","С":"s","Т":"t","У":"u","Ф":"f","Х":"h","Ц":"c","Ч":"ch","Ш":"sh","Щ":"sch","Ъ":"","Ы":"y","Ь":"","Э":"je","Ю":"ju","Я":"ya","а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ж":"j","з":"z","и":"i","й":"j","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"h","ц":"c","ч":"ch","ш":"sh","щ":"shh","ъ":"y","ы":"y","ь":"","э":"je","ю":"ju","я":"ya", " ": "-", ".": "", "/": "_",",": "","™":"","®":"","(":"",")":"","?":"","№":"","+":"",":":"","!":"","«":"","»":"","%":"","—":"-"};

    var translit_all = {"_–_":"_","-":"-", " ": "-","__":"_"," ":"-","&":"","ё":"e",".":"","…":"","%":"","$":"","|_":"",'"':"","[":"","]":"","{":"","}":"","'":"","@":"","#":"","^":"","*":"","\\":"","|":"","=":"","<":"",">":""};

    for (var val in translit){str = str.split(val).join(translit[val]);}

    for (var val in translit_all){str = str.split(val).join(translit_all[val]);}

    return str;

}





function sawe_set(id){

    if(id==0){

        va=$('#appendedInputButton').val();

        tr=translite(va);

        $.getJSON('/ajax.php', {id:id,va:va,tr:tr, action:'sawe_set' }, function(obj){

            $('#myModal').modal('hide');

            history.go(0);    

        });

        

    }else if(id==1){

        va1=$('#ot_set').val();

        va2=$('#do_set').val();

        $.getJSON('/ajax.php', {id:id,va2:va2,va1:va1, action:'sawe_set' }, function(obj){

            $('#myModal').modal('hide');

            history.go(0);    

        });

    }else if(id==2){

        va=$('#appendedInputButton').val();

        tr=translite(va);

        

        $.getJSON('/ajax.php', {id:id,va:va,tr:tr, action:'sawe_set' }, function(obj){

            $('#myModal').modal('hide');

            history.go(0);    

        });

        

    }else if(id==4){

        va=$('#appendedInputButton').val();
		weight=$('#appendedWeightButton').val();

        tr=translite(va);

        idd=$('#appendedInput').val();

        $.getJSON('/ajax.php', {id:id,va:va,weight:weight,tr:tr,idd:idd, action:'sawe_set' }, function(obj){

            $('#myModal').modal('hide');

            history.go(0);    

        });

        

    }

    











}



function menuclik(name, id){

    $.getJSON('/ajax.php', {id:id,name:name, action:'menu_clik' }, function(obj){

              history.go(0);

        });

}





