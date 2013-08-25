
$(window).load(function() {
  $('body').addClass('loaded');

  var $drawBtn = $('#drawBtn'),
      $categories = $('.categories a'),
      $drawLinks = $('.drawsList > a'),
      $detailBox = $('#detail'),
      $detailContent = $detailBox.find('.content');
      $detailClose = $detailBox.find('.close');
  
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
  
  // click on draws
  $drawLinks.on('click', function(e) {
    var id = $(e.currentTarget).data('id');
    showDrawDetail(id);
  });
  
  function showDrawDetail(id) {
    $detailBox.css('display', 'block');
    setTimeout(function() {
      $detailBox.addClass('show');
      
      $detailContent.load('drawDetail.php?id='+id, function() {
        $detailContent.addClass('loaded');
      });
      
    }, 50);
  }
  
  // clsoe detail
  $detailClose.on('click', function(e) {
    $detailBox.removeClass('show');
    setTimeout(function() {
      $detailBox.css('display', 'none');
      $detailContent.removeClass('loaded');
    }, 500);
    return false;
  });
  
  // open detail if id in url
  if(window.location.hash != '') {
    var id = window.location.hash.replace('#', '');
    showDrawDetail(id);
  }

});