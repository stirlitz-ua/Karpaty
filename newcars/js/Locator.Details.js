$(function() {
//  if ($("#importer").val() == "True" && parent.frames.length == 0) {
//    document.location = "http://www.volkswagen.ru/ru/purchase_finance/usedcars.html";
//  }
});

//$(function() {
$(document).ready(function() { 
  Galleria.loadTheme($("#theme").val() + 'galleria/galleria.classic.min.js');
  InitDetails();
});

function InitDetails() {
/* START Popup окошки */
$("a.thickbox").click(function() {
  var wnd = $(this).attr("wnd");
  $("#progress").show();
  $(wnd).load($(this).attr("href"), { rnd: Math.random() }, function() {
      $("#progress").hide(); Cufon.replace('h2'); Cufon.replace('.cufon'); 
      window.scrollTo(0, 0);
      SetCompareAccordition();
  });
  $(wnd).parent().addClass("open");
  return false;
});

$(".popup-close").live("click", function() {
  $(this).parent().parent().removeClass("open");
  return false;
});
/* END Popup окошки */

$(".tabs-head li").click(function() {
  $(".tabs-head li").removeClass("curent");
  $(this).addClass("curent");
  $(".tabs-body div").removeClass("curent");
  $($(this).find("a").attr("href")).addClass("curent");
  return false;
});

  $(".tab-options .showall input").change(function() {
    var acs = $(".tab-options .acc");
    if ($(this).attr('checked')) {
      $(acs).each(function() {
        if (!$(this).hasClass("open")) { $(this).addClass("open"); $(this).find('.acc-body').animate({ height: 'toggle' }, 'fast'); }
      });
    } else {
      $(acs).each(function() {
        if ($(this).hasClass("open")) { $(this).removeClass("open"); $(this).find('.acc-body').animate({ height: 'toggle' }, 'fast'); }
      });
    }
  });

  $(".tab-specifications .showall input").change(function() {
    var acs = $(".tab-specifications .acc");
    if ($(this).attr('checked')) {
      $(acs).each(function() {
        if (!$(this).hasClass("open")) { $(this).addClass("open"); $(this).find('.acc-body').animate({ height: 'toggle' }, 'fast'); }
      });
    } else {
      $(acs).each(function() {
        if ($(this).hasClass("open")) { $(this).removeClass("open"); $(this).find('.acc-body').animate({ height: 'toggle' }, 'fast'); }
      });
    }
  });  
  
  $("#CarPhotos").galleria({ preload: 0, popupLinks: true, transition: 'flash', showImagenav: false, 
    extend: function(options) {
      this.bind('image', function(e) {
        $(e.imageTarget).mouseover(function() {
          $(e.imageTarget).css({ cursor: "pointer" });
        });
        $(e.imageTarget).click(this.proxy(function() {
          this.openLightbox();
        }));
      });
      this.bind('loadstart', function(e) {
        //$("#progress").show();
      });
      this.bind('lightbox_image', function(e) {
        $("#progress").hide();
      });      
    }
  });

  SetSelectorData();
  if (typeof Cufon == 'function') {
    Cufon.replace('h2'); Cufon.replace('h3'); Cufon.replace('.cufon');
  }
  $("#tabs").tabs();
}

function FavouriteToogle(dat) {
  $.ajax({
    url: "/dasweltauto/Car/FavouritesToggle/" + dat.id, type: "POST",
    data: { title: dat.title, price: dat.price },
    success: function(data) {
      //$("#cntFav").text(data);
      var s = data.split(';');
      $("#cntFav").text(s[0]);
    },
    error: function(data) { }
  });
  return false;
}

function CompareToogle(dat) {
  $.ajax({
    url: "/dasweltauto/Car/ComparesToggle/" + dat.id, type: "POST",
    data: { title: dat.title, price: dat.price },
    success: function(data) {
      //$("#cntCom").text(data);
      var s = data.split(';');
      $("#cntCom").text(s[0]);
    },
    error: function(data) { }
  });
  return false;
}

function ShowMap() {
  $("#fMap").attr("src", "/Car/Map");
  $("#wShowMap").parent().addClass("open");
  window.scrollTo(0, 0);
  return false;
}

  function ShowCode() {
    $("#wShowCode").parent().addClass("open");
    window.scrollTo(0, 0);
    return false;
  }


function openPrintDialog(url) {
  window.open(url, "Печать", "width=830,location=no,menubar=no,toolbar=no,scrollbars=yes");
  return false;
}

function MailSended() {
  $("#wSendToMail").parent().removeClass("open");  
}

function ManagerSended() {
  $("#wSendToManager").parent().removeClass("open");
}

