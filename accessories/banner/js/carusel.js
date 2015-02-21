  var arrowLeft = document.getElementById('arrow-left');
  var arrowRight = document.getElementById('arrow-right');
  var list = document.getElementById('images');
  var lis = list.getElementsByTagName('li');
  var count = 0;
  
  arrowRight.onclick = function() {
    if (count < 5) {
      var value = parseInt(list.style.marginLeft);
      list.style.marginLeft = value - 96 + 'px';
      list.style.transition = "1s";
      count++;
    }
  }
  arrowLeft.onclick = function() {
    if (count > 0) {
      var value = parseInt(list.style.marginLeft);
      list.style.marginLeft = value + 96 + 'px';
      list.style.transition = "1s";
      count--;
    }
  }