
$(window).load(function() {
  $('body').addClass('loaded');

  var $drawBtn = $('#drawBtn'),
      $categories = $('.categories a');
  
  // categories btn
  $categories.on('click', function(e) {
    $categories.off('click');
    $('body').removeClass('loaded');
    setTimeout(function() {
      window.location = 'http://'+window.location.hostname+'/index.php?cat='+$(e.currentTarget).data('id');
    }, 500);
    return false;
  });
  
  // draw btn
  $drawBtn.on('click', function(e) {
    $drawBtn.off('click');
    $('body').removeClass('loaded');
    setTimeout(function() {
      window.location = 'http://'+window.location.hostname+'/draw.php';
    }, 500);
    return false;
  });

});