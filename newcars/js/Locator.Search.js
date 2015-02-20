$(function() {
  //  if ($("#importer").val() == "True" && parent.frames.length == 0) {
  //    document.location = "http://www.volkswagen.ru/ru/purchase_finance/usedcars.html";
  //  }

  /* START Popup окошки */
  //  $("a.thickbox").click(function() {
  //    var wnd = $(this).attr("wnd");
  //    $("#progress").show();
  //    $(wnd).load($(this).attr("href"), { rnd: Math.random() }, function() {
  //      $("#progress").hide(); Cufon.replace('h2');
  //      window.scrollTo(0, 0);
  //      SetCompareAccordition();
  //    });
  //    $(wnd).parent().addClass("open");
  //    return false;
  //  });

  //  $(".popup-close").live("click", function() {
  //    $(this).parent().parent().removeClass("open");
  //    return false;
  //  });
  /* END Popup окошки */

  //  $(".tabs-head li").click(function() {
  //    var tab = $(this).find("a").attr("href");
  //    if ($(tab).attr("url")) {
  //      $("#progress").show();
  //      $(tab).load($(tab).attr("url"), { rnd: Math.random() }, function() {
  //        if (typeof InitComboFilters == 'function') InitComboFilters();
  //        InitOptionsFilters();
  //        SetCombos(); SetAccordition();
  //        $("#progress").hide();
  //      });
  //    }
  //    $(".tabs-head li").removeClass("curent");
  //    $(this).addClass("curent");
  //    $(".tabs-body div").removeClass("curent");
  //    $(tab).addClass("curent");
  //    return false;
  //  });

  $("input[id^='op']").live('click', function() {
    ApplyOption();
  });
  

  //  if ($("#carousel").length > 0) {
  //    $("#carousel").featureCarousel({
  //      autoPlay: 0, trackerIndividual: false, topPadding: 55
  //      , preload: false, largeFeatureWidth: 280, largeFeatureHeight: 210
  //      , leftButtonTag: "#btleft", rightButtonTag: "#btright"
  //    });
  //  }
  //  $("#tabs").tabs({
  //    select: function(event, ui) {
  //      var tab = "#" + ui.panel.id;
  //      if ($(tab).attr("url")) {
  //        $("#progress").show();
  //        $(tab).load($(tab).attr("url"), { rnd: Math.random() }, function() {
  //          if (typeof InitComboFilters == 'function') InitComboFilters();
  //          //InitOptionsFilters();
  //          //SetCombos(); SetAccordition();
  //          initHover(); initCompares(); InitSorter();
  //          $("#dSel").html($("#dhSel").html());
  //          $("#progress").hide();
  //        });
  //      }
  //      return true;
  //    }
  //  });
  $("#tabs .tabh").click(function() { 
    $("#progress").show();
  });

});

$(document).ready(function() {
//  if (typeof InitComboFilters == 'function') InitComboFilters();
//  InitOptionsFilters();
  $("#selcolor").change(function() {
    alert('ooooooooooops');
    //DO_GetCalcCars({ param: "selcolor", val1: $(this).value });
  });

});

function InitSorter() {
  $("#cbrows").val($("#hrows").val());
  $(".allowsort th span").click(function () {
    ApplySort($(this), "sort");
  });
  $("#cbrows").change(function () {
    $head = $("th span.sortasc");
    if ($head.length == 0) $head = $("th span.sortdsc");
    ApplySort($head, "rows");
  });
  initHover(); 
}

function ApplySort($head, mode) {
  var valsort = $head.attr("val"); 
  var valrcnt = $("#cbrows").val();
  var s = $("#changesort").attr("href");
  if (valsort) {
    if (mode == "sort")
      if ($head.hasClass("sortasc")) s = s.replace("sort=0", "sort=-" + valsort); else s = s.replace("sort=0", "sort=" + valsort);
    else
      if ($head.hasClass("sortasc")) s = s.replace("sort=0", "sort=" + valsort); else s = s.replace("sort=0", "sort=-" + valsort);
  }
  s = s.replace("rows=0", "rows=" + $("#cbrows").val());  // //s.substr(0, s.indexOf("rcnt=") + 5) + $("#cbrows").val();
  $("#changesort").attr("href", s);
  $("#changesort").click();
}

function SetCombos() {
    //cuSel({ changedEl: "select", checkZIndex: true });
}

function initHover() {
  $('.favourite table tbody tr').hover(function(e) {
    $(this).addClass('hover');
    $a = $(this).find('.popaper').find('.drop-down');
    $a.css('position', 'absolute');
    $a.css('left', e.pageX);
    $a.css('top', e.pageY);
    //alert(e.pageX);		
    $a.show();

  },
	function() {
	  $(this).removeClass('hover');
	  $('.drop-down').hide();
	}
	);

}

function initCompares() {
  $('.opener').click(function() {
    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
    }
    else {
      $(this).addClass('active');
    }
    $(this).next('.drop').slideToggle('fast');
    return false;
  });
}

// Инициализация опций
function InitOptionsFilters() {
  jQuery('.checkbox input:checked').parent().addClass('checked');
  jQuery('.checkbox input').change(function() {
    if ($(this).attr('checked')) {
      $(this).parent().addClass('checked');
    } else {
      $(this).parent().removeClass('checked');
    }
  })

  $("input[id^='op']").attr("checked", "");
  //$("#opts").val('<%= ViewData["voptions"] %>');
  var v = $("#opts").val().split(',');
  for (i = 0; i < v.length; i++) {
    $("input[id='op" + v[i] + "']").attr("checked", "true");
    $("input[id='op" + v[i] + "']").parent().addClass("checked");
  }
}
// Применение опций к фильтру
function ApplyOption() {
  var s = "";
  $("input[id^='op']").each(function() {
    if ($(this).attr("checked")) s += $(this).attr("id").replace("op", "") + ",";
  });
  $("#opts").val(s.substr(0, s.length - 1));
  ApplyOptFilter($("#opts").val());
}
// Применить для фильтра выбранное значение из списка
function ApplyComboFilter(name, val1, vtitle) {
  if ($("#s" + name).text() == " " + vtitle) return;
  $("#s" + name).text(" " + vtitle);
  $("#dSel").html($("#dhSel").html());
  if (val1 == -1) return;
  DO_GetCalcCars({ param: name, val1: val1 });
}
// Применить для фильтра выбранное значение ползунка
function ApplyRangeFilter(name, val1, val2, ispost) {
  $("#s" + name).text(" " + val1 + " - " + val2);
  $("#dSel").html($("#dhSel").html());
  if (!ispost) return;
  DO_GetCalcCars({ param: name, val1: val1, val2: val2 });
}
// Применить для фильтра выбранную опцию
function ApplyOptFilter(vals) {
  DO_GetCalcCars({ param: "options", val1: vals });
}
// Применить для фильтра выбранную галку (APlus)
function CheckBoxFilterApply(el, type) {
  DO_GetCalcCars({ param: type, val1: $(el).attr("checked") });
}
// Применить для фильтра выбраннык модели
function ApplyMultiFilter(name, val1, vtitle) {
    if ($("#s" + name).text() == " " + vtitle) return;
    $("#s" + name).text(" " + vtitle);
    if (val1 == -1) return;
    DO_GetCalcCars({ param: name, val1: val1 });
}

// Подсчёт кол-ва авто с учётом фильтра
function DO_GetCalcCars(adata) {
  $("#progress").show();
  $.ajax({
      url: "GetCalcCars.php", type: "POST",
      data: adata,
      success: function (data) {
          var v = data.split(";");
          $("#progress").hide();
          $(".lbResult").text(v[0]);
          $(".lbResult").parent().addClass("blik");
          setTimeout(function(){$(".lbResult").parent().removeClass("blik")},200)
          if (v[1]) MS_InitActive(v[1]);
      },
      error: function (data) {
          $("#progress").hide();
          alert(data);
      }
  });
}

function FavouriteToogle(dat) {
  $.ajax({
    url: "GetCalcCars.php", type: "POST",
    data: { title: dat.title, price: dat.price ,idcar:dat.id,action:'izbrannoe' },
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
    url: "GetCalcCars.php", type: "POST",
    data: { title: dat.title, price: dat.price ,idcar:dat.id,action:'sravnenie'},
    success: function(data) {
      //$("#cntCom").text(data);
      var s = data.split(';');
      $("#cntCom").text(s[0]);
      if (dat.refresh) { RefreshCompares(); }
    },
    error: function(data) { }
  });
  return false;
}

function RefreshCompares() {
  //$("#tabs").tabs('select', 0); $("#tabs").tabs('select', 3);
  $("#progress").show(); 
  $("#tabs-4").load($("#tabs-4").attr("url"), { rnd: Math.random() }, function() { 
    initHover(); initCompares(); InitSorter(); $("#progress").hide(); 
  });
}

function ShowTabSearch() {
  $("#tabs").tabs('select', 0);
  $("#tabs-2").attr("url", "/dasweltauto/Car/Results_Partial?mode=search");
  $("#tabs").tabs('select', 1);
  return false;
}

function ShowTabResults() {
  $("#tabs").tabs('select', 0);
  $("#tabs-2").attr("url", "/dasweltauto/Car/Results_Partial?mode=results");
  $("#tabs").tabs('select', 1);
  return false;    
}