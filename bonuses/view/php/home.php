<?php
	$car = $_GET['car'] ? addslashes(htmlspecialchars($_GET['car'])) : '';
?>

<script type="text/javascript">

                          var kno="<? if (isset( $_SESSION['menu'] )) { echo  $_SESSION['menu'] ;  }?>";
						  
	                    if (kno==1) { var knopka= "../bonuses/model/navigation/history_to.php";  }
						else if (kno==2) { var knopka= "../bonuses/model/navigation/private_call.php";   }
						else if (kno==3) { var knopka= "../bonuses/model/navigation/test_drive.php";  }
						else if (kno==4) { var knopka= "../bonuses/model/navigation/servis.php";  }
						else if (kno==5) { var knopka= "../bonuses/model/navigation/admin.php";  }
						else if (kno==7) { var knopka= "../bonuses/model/navigation/history_bonus.php";  }
						
						var xml_download ="<? if (isset($_POST['xml_download'])) { echo $_POST['xml_download'];}  ?>";
						var uploadfile ="<? if (isset($_FILES['uploadfile']['name'])) { echo $_FILES['uploadfile']['name'];}  ?>";
						var id_user ="<? if (isset($_SESSION['id_user'])) { echo $_SESSION['id_user'];}  ?>";
						var admin ="<? if (isset($_SESSION['admin']) && $_SESSION['admin'] =='admin') { echo $_SESSION['admin'];}  ?>";
						

			
							$.ajax ({
							url: knopka,
							type: "POST",
							data: {  id_user:id_user, admin:admin, uploadfile:uploadfile, xml_download:xml_download, car:'<?=$car?>'	} ,
								success: function (maseg) {
								
								 $ ("#content").html(maseg);

								}
							});

						function openBlock(el) {
						var kids = el.parentNode.childNodes;
						for (var k = 0; k < kids.length; k++) {
							var child = kids[k];
							if (child && child.className == "this_block_is_hidden") {
								if (child.style.display != 'block') {
									child.style.display = 'block';
								} else {
									child.style.display = 'none';
								}
							}
						}
					}
					 
						function vostan (kno)
								{
							
								 var email  = document.getElementById("login_vost").value ;     
										$.ajax ({
										url: "../bonuses/model/avtorization/vostanov.php",
										type: "POST",
										data: {    email:email  } ,
											success: function (maseg) {
											 $ (".vo").html(maseg);
											}
										});	
								} 
					 
					
					
							function menu(kno) {

						if (kno==1) { var knopka= "../bonuses/model/navigation/history_to.php";  }
						else if (kno==2) { var knopka= "../bonuses/model/navigation/private_call.php";   }
						else if (kno==3) { var knopka= "../bonuses/model/navigation/test_drive.php";  }
						else if (kno==4) { var knopka= "../bonuses/model/navigation/servis.php";  }
						else if (kno==5) { var knopka= "../bonuses/model/navigation/admin.php";  }
						else if (kno==7) { var knopka= "../bonuses/model/navigation/history_bonus.php";  }
			
						var xml_download ="<? if (isset($_POST['xml_download'])) { echo $_POST['xml_download'];}  ?>";
						var uploadfile ="<? if (isset($_FILES['uploadfile']['name'])) { echo $_FILES['uploadfile']['name'];}  ?>";
						var id_user ="<? if (isset($_SESSION['id_user'])) { echo $_SESSION['id_user'];}  ?>";
						var admin ="<? if (isset($_SESSION['admin']) && $_SESSION['admin'] =='admin') { echo $_SESSION['admin'];}  ?>";
									
							$.ajax ({
							url: knopka,
							type: "POST",
							data: {  id_user:id_user, admin:admin, uploadfile:uploadfile, xml_download:xml_download, car:'<?=$car?>'	} ,
								success: function (mess) {
								
								 $ ("#content").html(mess);

								}
							});
					

					}	
					
	function openBlock(el) {
						var kids = el.parentNode.childNodes;
						for (var k = 0; k < kids.length; k++) {
							var child = kids[k];
							if (child && child.className == "this_block_is_hidden") {
								if (child.style.display != 'block') {
									child.style.display = 'block';
								} else {
									child.style.display = 'none';
								}
							}
						}
					}	
					
					function openBlock2(el) {
						var kids = el.parentNode.childNodes;
						for (var k = 0; k < kids.length; k++) {
							var child = kids[k];
							if (child && child.className == "this_block_is_hidden2") {
								if (child.style.display != 'block') {
									child.style.display = 'block';
								} else {
									child.style.display = 'none';
								}
							}
						}
					}
					
					
											function yare_do(kno)
								{
								var id_user ="<? if (isset($_SESSION['id_user'])) { echo $_SESSION['id_user'];}  ?>";
						var admin ="<? if (isset($_SESSION['admin']) && $_SESSION['admin'] =='admin') { echo $_SESSION['admin'];}  ?>";
						
									
								if (kno==1) { var ID = $('#ID').val() 	
							var first_name = $('#first_name').val() 
									var name = $('#name').val() 
									var father_name = $('#father_name').val() 
									var pass = $('#pass').val() 
									var email = $('#email').val() 
									var phone = $('#phone').val() 
									var birthdey = $('#birthdey').val() 
									var state = $('#state').val() 
									var region = $('#region').val() 
									var garden = $('#garden').val() 
									var strit = $('#strit').val() 
									var note = $('#note').val() 
									var сustomer_сode = $('#сustomer_сode').val() 
										$.ajax ({
										url:  "../bonuses/model/navigation/admin.php",
										type: "POST",
										data: {  id_user:id_user, admin:admin , ID:ID, first_name:first_name  , name:name  , father_name:father_name   , pass:pass   , email:email   , 
										phone:phone   , birthdey:birthdey   , state:state   , region:region   , garden:garden   , strit:strit   , note:note  , сustomer_сode:сustomer_сode    } ,
											success: function (maseg) {
											 $ ("#content").html(maseg);
											}
										});	
								
								}
																if (kno==2) {
																	
							var first_name = $('#r_first_name').val() 
									var name = $('#r_name').val() 
									var father_name = $('#r_father_name').val() 
									var pass = $('#r_pass').val() 
									var email = $('#r_email').val() 
									var phone = $('#r_phone').val() 
									var birthdey = $('#r_birthdey').val() 
									var state = $('#r_state').val() 
									var region = $('#r_region').val() 
									var garden = $('#r_garden').val() 
									var strit = $('#r_strit').val() 
									var note = $('#r_note').val() 
									var сustomer_сode = $('#r_сustomer_сode').val() 
									
					
																var reg = true; 
																	$.ajax ({
																	url:  "../bonuses/model/navigation/admin.php",
																	type: "POST",
																
																	data: {   id_user:id_user, admin:admin ,reg:reg ,  first_name:first_name  , name:name  , father_name:father_name   , pass:pass   , email:email   , 
																				phone:phone   , birthdey:birthdey   , state:state   , region:region   , garden:garden   , strit:strit   , note:note  , сustomer_сode:сustomer_сode  } ,
																		success: function (maseg) {
																		 $ ("#content").html(maseg);
																		}
																	});	
																}
								
								
								}
					
					function showClose(id) {
	  $('.'+id).toggle(
          function() {
            if ($(this).is(':visible'))
                $('#a_dok'+id).html('-');
            else
                $('#a_dok'+id).html('+');
          }
       );
   }
   
function showGood(id) {
	  $('.'+id).toggle(
          function() {
            if ($(this).is(':visible'))
                $('#a_good'+id).html('-');
            else
                $('#a_good'+id).html('+');
          }
       );
   }

</script><?php
	
 if (isset($_SESSION['id_user'])) { 
?> 
    <div class="bonuses">
     <?php
echo  'Количество бонусов: <b>'.$_SESSION['bonus_all'].'</b>' ;
     ?>
     </div>
<img class="img" src="../bonuses/view/template/images/logo.jpg"/>
    <div class="user_name"><span>
&nbsp<span class="glyphicon glyphicon-user"></span>&nbsp
<?php
 echo $_SESSION['first_name'] .' '. $_SESSION['name'].' '.$_SESSION['father_name']  ;  
?>
 <br><a href="/?action=out" class="go_out pull-right"> &nbsp&nbsp <span class="glyphicon glyphicon-log-out"></span>Выход</a>
        </span></div>    
    </div>
<div class="mmenu-div">
    <table class="mmenu">
        <tr>
            <td class="active" id="item_1" onclick="menuActive(1);"><a onclick="menu(1); " href="#accumulation_of_bonuses">История ТО</a> </td>
            <td id="item_7" onclick="menuActive(7);"><a onclick="menu(7); " href="#real_accumulation_of_bonuses">История начисления баллов</a> </td>
            <td id="item_2" onclick="menuActive(2);"><a onclick="menu(2); " href="#request_a_call">Заказать звонок</a></td>
            <td id="item_3" onclick="menuActive(3);"><a onclick="menu(3); " href="#test_drive">Тест-драйв</a></td>
            <td id="item_4" onclick="menuActive(4);"><a onclick="menu(4); " href="#request_a_TO">Запись на ТО</a></td>
            <td id="item_5" onclick="menuActive(5);"><a href="http://karpaty-autocenter.com.ua/book_reviews/"  target="_blank">Электронная книга отзывов</a></td>
            <?php if (admin($_SESSION['id_user'])) {?> 
                 <td id="item_6" onclick="menuActive(6);"><a onclick="menu(5); " href="#admin_panel">Админ панель</a>
                     <?php } ?> </td>
        </tr>
    </table>
    <script type="text/javascript">
    var count = 7; // 6 пунктів меню
    function menuActive(item){
    	for (var i = 1; i<=count; i++) {
    	document.getElementById("item_"+i).removeAttribute("class");
    	}
    	document.getElementById("item_"+item).setAttribute("class","active");
    }
    </script>
</div>
<br />
<div id="content">
													
													
	

	
</div>

  <?php

 } else {
?>				
            <div class="wrapper">
            <div class="container form-signin">

      <form action="" method="post"  id="login">
        <h2 class="form-signin-heading">Личный веб-кабинет</h2>
        <label for="inputEmail" class="sr-only">Email адрес</label>
        <input type="email" name="login" id="inputEmail" class="form-control" placeholder="Email адрес" required autofocus/>
        <label for="inputPassword" class="sr-only">Пароль</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required name="password"/>
        <input class="btn btn-lg btn-primary btn-block " type="submit" value="Войти" name="log_in"/>
        <div class="checkbox pull-left">
          <label>
            <input type="checkbox" value="remember-me"> Запомнить меня
          </label>
        </div>
        <div onclick="eat_cookie()" class="toggle toggle_ pull-left">Востановить пароль</div>
      </form>
														
                <form method="post" name="vost" id="reg" > 
                    <h3 class="form-signin-heading">Восстановление пароля</h3>
                     <label for="login_vost" class="sr-only">Email адрес</label>
				    <input name="login_vost" class="form-control" id="login_vost" type="email" placeholder="Email адрес" required autofocus/>	
				<input type="button" class="btn btn-lg btn-info btn-block button-bottom" onclick="vostan(1);" value="Востановить" /> 
              <div onclick="standart_cookie()" class="toggle">Вернуться к авторизации</div>
               </form>

    </div> 
    </div>
    <script type="text/javascript">
        function standart_cookie() {
            document.getElementById("login").style.display = "block";
            document.getElementById("reg").style.display = "none";
        }
        function eat_cookie() {
            document.getElementById("login").style.display = "none";
            document.getElementById("reg").style.display = "block";
        }
        function no_eat_cookie() {
            standart_cookie();
        }
        window.onload = standart_cookie();
    </script>

														</div>
													</div>
													
													
													<div class="vo">
													
													</div>	
<?php
}

?>	