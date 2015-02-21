

function animate(opts) {

  var start = new Date; 
  var timer = setInterval(function() {
    var progress = (new Date - start) / opts.duration;
    if (progress > 1) progress = 1;
    opts.step(progress);
    if (progress == 1) clearInterval(timer);
  }, opts.delay || 10);
}

function goItem_1(elem) {
	
	var from = 845;
	var to = 300;
	var delta_ft = from-to;
	elem.style.visibility = "visible";
  animate({
    duration: 4000,
    step: function(progress) {
      elem.style.width = (from-progress*delta_ft) + "px";
    }
  });

}

function goItem_2(elem) {
	
	var from = 100;
	var to = 650;
	var delta_ft = from-to;
	elem.style.visibility = "visible";
  animate({
    duration: 4000,
    step: function(progress) {
      elem.style.right = (from-progress*delta_ft) + "px";
    }
  });
  setTimeout( function() {  goItem_3(item_3); },1000);

}

function goItem_3(elem) {
	
	var from = 50;
	var to = 275;
	var delta_ft = from-to;

  animate({
    duration: 1000,
    step: function(progress) {
      elem.style.width = (from-progress*delta_ft) + "px";
    }
  });
  setTimeout( function() {  goItem_4(item_4); },1000);
}

function goItem_4(elem) {
	
	var from = 20;
	var to = 194;
	var delta_ft = from-to;

	var from2 = -174;
	var to2 = 0;
	var delta_ft2 = from2-to2;

  animate({
    duration: 900,
    step: function(progress) {
      elem.style.width = (from - progress * delta_ft) + "px";
      elem.style.backgroundPosition = (from2-progress*delta_ft2 + "px");
    }
  });
    setTimeout( function() {  goItem_5(item_5); },900);

}

function goItem_5(elem) {
	
	var from = 0;
	var to = 150;
	var delta_ft = from-to;

  animate({
    duration: 800,
    step: function(progress) {
      elem.style.width = (from - progress * delta_ft) + "px";
    }
  });
  setTimeout( function() {  goItem_6(item_6); },800);

}

function goItem_6(elem) {
	
	var from = 20;
	var to = 120;
	var delta_ft = from-to;

	var from2 = -100;
	var to2 = 0;
	var delta_ft2 = from2-to2+1.5;

  animate({
    duration: 500,
    step: function(progress) {
      elem.style.width = (from - progress * delta_ft) + "px";
      elem.style.backgroundPosition = (from2-progress*delta_ft2 + "px");
    }
  });
  setTimeout( function() {  goItem_7(item_7); },500);

}

function goItem_7(elem) {
	
	var from = 20;
	var to = 120;
	var delta_ft = from-to;

  animate({
    duration: 400,
    step: function(progress) {
      elem.style.width = (from - progress * delta_ft) + "px";
    }
  });
  setTimeout( function() { 
    document.getElementById("zindex").style.zIndex = "0";
    toys_show(toys);
  //дропаєм непотрібні елементи    
  //видаляємо залишки анімації
    var div = document.getElementById("break");
    var div_2 = document.getElementById("bg_break");
    var div_3 = document.getElementById("am_script");
    document.getElementById('banner').removeChild(div);
    document.getElementById('banner').removeChild(div_2);
    document.body.removeChild(div_3);
  },400);

}

function drop(elem,from,to,from2,to2,from3,to3) {

  var delta_ft = from-to;
  var delta_ft2 = from2-to2;
  var delta_ft3 = from3-to3;

  animate({
    duration: 1100,
    step: function(progress) {
      elem.style.top = (from - progress * delta_ft) + "px";
      elem.style.left = (from2 - progress * delta_ft2) + "px";
      elem.style.transform = "rotate(" + (from3 - progress * delta_ft3) + "deg)";
    }
  });
}

function f_bg_break(elem) {
  var from = 10;
  var to = 0;
  var delta_ft = from-to;

      animate({
    duration: 1100,
    step: function(progress) {
      elem.style.opacity = (from - progress * delta_ft)/10;
      elem.style.filter = 'alpha(opacity=' + (from - progress * delta_ft) + ')';
    }
  });
}

function toys_show(elem) {
  var from = 0;
  var to = 10;
  var delta_ft = from-to;

      animate({
    duration: 1000,
    step: function(progress) {
      elem.style.opacity = (from - progress * delta_ft)/10;
      elem.style.filter = 'alpha(opacity=' + (from - progress * delta_ft) + ')';
    }
  });
}

function content_show(elem) {
  var from = 0;
  var to = 10;
  var delta_ft = from-to;

      animate({
    duration: 1000,
    step: function(progress) {
      elem.style.opacity = (from - progress * delta_ft)/10;
      elem.style.filter = 'alpha(opacity=' + (from - progress * delta_ft) + ')';
    }
  });
}

function slide_move(elem){
  var from = -500;
  var to = 100;
  var delta_ft = from-to;
    
  animate({
    duration: 2000,
    step: function(progress) {
      elem.style.right = (from - progress * delta_ft) + "px";
    }
  });
}  

var item_1 = document.getElementById("item_1");
var item_2 = document.getElementById("item_2");
var item_3 = document.getElementById("item_3");
var item_4 = document.getElementById("item_4");
var item_5 = document.getElementById("item_5");
var item_6 = document.getElementById("item_6");
var item_7 = document.getElementById("item_7");

var child_11 = document.getElementById("child_11");
var child_12 = document.getElementById("child_12");
var child_13 = document.getElementById("child_13");
var child_14 = document.getElementById("child_14");
var child_21 = document.getElementById("child_21");
var child_22 = document.getElementById("child_22");
var child_23 = document.getElementById("child_23");
var child_24 = document.getElementById("child_24");

var bg_break = document.getElementById("bg_break");
var sl_animate = document.getElementById("sl_animate");
var toys = document.getElementById("toys");
var content = document.getElementById("content");


window.onload = setTimeout( function() { document.getElementById("banner").style.background="url('images/bg_default.jpg')";},500);
window.onload = setTimeout( function() { 
  f_bg_break(bg_break);
  drop(child_11,0,350,0,-100,0,-90);
  drop(child_12,0,400,0,100,0,90);
  drop(child_13,0,350,0,-100,0,45);
  drop(child_14,0,420,0,-100,0,90);
  drop(child_21,0,350,0,100,0,-90);
  drop(child_22,0,350,0,100,0,90);
  drop(child_23,0,500,0,150,0,-60);
  drop(child_24,0,250,0,100,0,90);

},1500);

window.onload = setTimeout( function() { content_show(content);},1800);
window.onload = setTimeout( function() { slide_move(sl_animate);},4000);

window.onload = setTimeout( function() { 
  goItem_1(item_1);
  goItem_2(item_2);
},2500);

//Далі йде рекурсивне виконная функцій від 3 до 7
/*
window.onload = function() {
  for (var i = 1; i <=7; i++) {
    document.getElementById("item_"+i).style.display = "none";
  }
  document.getElementById("zindex").style.zIndex = "-1";
}
*/