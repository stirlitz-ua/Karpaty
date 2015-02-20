<?

//titles

if(isset($_GET['page']) and $_GET['page']!=''){

    switch($_GET['page']){
        case("light"):

            if($_GET['link']=='') {
                $rez = array('t' => 'Модельный ряд Volkswagen. Легковые автомобили от официального дилера', 'k' => 'модельный ряд Фольксваген. Поло седан, поло хэтчбэк, гольф, гольф гти, гольф спортсван, гольф вариант, битл, туран, джетта, сирокко, пассат, пассат вариант, тигуан, фольксваген сс, туарег, фаэтон
', 'd' => 'Весь модельный ряд Volkswagen от официального дилера "КарпатыАвтоцентр". Polo sedan, Polo, Golf, Golf Sportsvan, Golf GTI, Golf Variant, Beetl, Touran, Jetta,Scirocco, Passat, Passat Variant, Tiguan, Volkswagen CC, Touareg, Phaeton. Акции, комплектации и  цены.
');
            }
             case("service"):

            if(empty($_GET['pmenu'])) 
              $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE link='$_GET[menu]'")); 
            else
              $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr_page WHERE link='$_GET[pmenu]'"));

           if(empty($rez['t']))
              $rez = array('t' => ' КарпатыАвтоцентр, официальный сервис-центр Volkswagen. Все виды сервисных работ. Гарантийное и послегарантийное обслуживание Volkswagen, Skoda, Audi, Seat, Porsche.', 'd' => 'СТО для Volkswagen Group. Он-лайн магазин оригинальных и неоригинальных запчастей, аксессуары, ДОП-оборуджование.',
                'k' => 'сто фольксваген, доп фольксваген, доп оборудование +на фольксваген , аксесуары фольксваген, запчасти фольксваген, купить запчасти +на фольксваген , каталог запчастей фольксваген , запчасти +на фольксваген цены , оригинальные запчасти фольксваген , интернет магазин запчастей фольксваген');


        if (($_GET['menu']=='novosti-1') || ($_GET['menu']=='novosti-1') || ($_GET['menu']=='novosti-2') ||($_GET['menu']=='novosti-3') ||($_GET['menu']=='novosti-4') ||($_GET['menu']=='novosti-5') ||($_GET['menu']=='novosti-6') or($_GET['menu']=='novosti-7') or$_GET['menu']=='novosti-9' or($_GET['menu']=='novosti-8') or($_GET['menu']=='novosti-10') or($_GET['menu']=='novosti-11')) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE menu='4'"));
            break;
        case("heavy"):

            if($_GET['link']=='') {
                $rez = array('t' => 'Модельный ряд Volkswagen Коммерческие автомобили от официального дилера "КарпатыАвтоцентр".', 'k' => 'амарок, кади кастен, кади комбиб крафтер, каравелла, мультиван, Т5, транспортер пассажир, транспортер грузовой, автобус сириус, автобус альтаир
', 'd' => 'Модельный ряд Volkswagen Коммерческие автомобили от официального дилера "КарпатыАвтоцентр". Amarok, Caddy Kasten, Caddy Kombi, Crafter, Caravelle, Multivan, Trasporter Kombi, Transporter Kasten, Sirius, Altair. Акции, комплектации и  цены.');
            }
            break;


        case("catalog"):
        if(empty($_GET['pmenu'])) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM accessories WHERE link='$_GET[menu]'")); else
                $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM accessories_page WHERE link='$_GET[pmenu]'"));
                    break;


        case("models"):

       if($_GET['link']) {
				$query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }

			elseif($_GET['menu']) {
				$query = "SELECT t,d,k FROM models WHERE link='$_GET[menu]'";
            $rez=mysql_fetch_array(mysql_query($query));
 
            }

        if($_GET['pmenu']=='overview') {
               $query = "SELECT overview_t AS t, overview_d AS d, overview_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
                   if($_GET['pmenu']=='gallery') {
               $query = "SELECT gal_t AS t, gal_d AS d, gal_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
       if($_GET['pmenu']=='special_offers') {
               $query = "SELECT special_t AS t, special_d AS d, special_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
                 if($_GET['pmenu']=='information_and_pricing') {
               $query = "SELECT cat_t AS t, cat_d AS d, cat_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT t,d,k FROM model_page WHERE link='$_GET[link]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            }
    if($_GET['pmenu']=='features') {
               $query = "SELECT comp_t AS t, comp_d AS d, comp_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
  if($_GET['link']) {
                $query = "SELECT comp_t AS t, comp_d AS d, comp_k as k FROM models WHERE link='$_GET[menu]'";
 $rez=mysql_fetch_array(mysql_query($query));
 
            }
            
            }
            
        break;   
        case("book_reviews"):
            $rez = array('t' => '', 'k' => '', 'd' => '');
            break; 

case("salesavto"): if(empty($_GET['pmenu'])) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE link='$_GET[menu]'")); else
                $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr_page WHERE link='$_GET[pmenu]'"));
                 break; 


      case('purchase_finance'):
			if(empty($_GET['pmenu']))
				$rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE link='$_GET[menu]'"));
			else
				$rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr_page WHERE link='$_GET[pmenu]'"));
          if (($_GET['menu']=='supply-1') || ($_GET['menu']=='supply-2') ||($_GET['menu']=='supply-3') ||($_GET['menu']=='supply-4') ||($_GET['menu']=='supply-5') ||($_GET['menu']=='supply-6') or($_GET['menu']=='supply-7') or$_GET['menu']=='supply-9' or($_GET['menu']=='supply-8') or($_GET['menu']=='supply-10') or($_GET['menu']=='supply-11'))
              $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE menu='0'"));

          break;
  
  
        case("finance"):
        case("zapchasti"):
        case("company"):
     if(empty($_GET['pmenu'])) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE link='$_GET[menu]'")); else
                $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr_page WHERE link='$_GET[pmenu]'"));
        if (($_GET['menu']=='novosti-1') || ($_GET['menu']=='novosti-1') || ($_GET['menu']=='novosti-2') ||($_GET['menu']=='novosti-3') ||($_GET['menu']=='novosti-4') ||($_GET['menu']=='novosti-5') ||($_GET['menu']=='novosti-6') or($_GET['menu']=='novosti-7') or$_GET['menu']=='novosti-9' or($_GET['menu']=='novosti-8') or($_GET['menu']=='novosti-10') or($_GET['menu']=='novosti-11')) $rez=mysql_fetch_array(mysql_query("SELECT t,d,k FROM arr WHERE menu='4'"));
        break;

        case("avto_in_stock"):
        if(isset($_GET['page']))
            $rez = array('t' => 'Новые автомобили Фольксваген в наличии у официального дилера "КарпатыАвтоцентр"', 'k' => 'фольксваген  в наличии, автомобили фольксваген +в наличии, фольксваген дилер, официальный дилер фольксваген,  фольксваген новый цена, фольксваген поло, поло седан, гольф, гольф вариант, гольф спортсван, джетта, битл, пассат, фольксваген сс, пассат вариант, скирокко, туран, тигуан, туарег.', 'd' => 'Новые автомобили Фольксваген в наличии. Акционные предложения, комплектации, цена. КарпатыАвтоцентр - официальный дилер Volkswagen в Украине');

            break;
        case("order_online"):
            if(isset($_GET['page']))
                $rez = array('t' => 'On-line каталоги автозапчастей для Volkswagen, Skoda, Audi, Seat. ПОИСК ЗАПЧАСТИ по названию или артикулу', 'k' => 'каталог автозапчатей онлайн, онлайн поиск запчастей, автозапчасти онлайн,', 'd' => 'Удобный он-лайн поиск запчастей для автомобилей Volkswagen Group');

            break;
        case("das_weltauto"):
            $rez = array('t' => 'Автомобили с пробегом', 'k' => '', 'd' => 'Автомобили с пробегом'); 
            break; 

        case("configurator"): 
            $rez = array('t' => 'Конфигуратор', 'k' => '', 'd' => 'Конфигуратор');
            break; 

		default:
			$rez = array('t' => 'КарпатыАвтоцентр официальный диллер Volkswagen', 'k' => '', 'd' => 'КарпатыАвтоцентр официальный диллер Volkswagen');
			break;

    }

}else{
	$rez = array('t' => 'КарпатыАвтоцентр-официальный дилер Volkswagen (Фольксваген) в Украине', 'k' => 'trade-in, трейд-ин, автокредит, акции Фольксваген, Официальный сервис Фольксваген, официальный дилер Фольксваген, VW Passat, Фольксваген Пассат, Фольксваген Пассат B8 , купить новый Фольксваген, цена Фольксваген, VW, Volkswagen Group, Поло седан, Тигуан, Туарег, Амарок, купить новый автомобиль, Volkswagen Passat, купить VW, Volkswagen, Фольцваген, СТО Фольксваген, диагностика Фольксваген, автосервис для Volkswagen, оригинальные запчасти Фольксваген', 'd' => 'Купить новый автомобиль Volkswagen (Фольксваген) у дилера, оригинальные запчасти и аксессуары. Гарантийное и послегарантийное обслуживание Volkswagen, Skoda, Audi, Seat.');
}
?>