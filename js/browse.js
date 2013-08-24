
$(window).load(function() {
  $('body').addClass('loaded');

  var $drawBtn = $('#drawBtn');
  
  // retry btn
  $drawBtn.on('click', function(e) {
    $drawBtn.off('click');
    $('body').removeClass('loaded');
    setTimeout(function() {
      window.location = 'http://'+window.location.hostname+'/draw.php';
    }, 500);
    return false;
  });

});