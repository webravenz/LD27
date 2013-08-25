
$(window).load(function() {
  $('body').addClass('loaded');

  var $box = $('#drawBox'),
      $pres = $box.find('.pres'),
      $startBtn = $pres.find('.btn'),
      $compte = $box.find('.compte'),
      $compteP = $compte.find('p'),
      currentCompte = 0,
      $bottom = $box.find('.bottom'),
      $saveForm = $('#saveForm'),
      $retryBtn = $saveForm.find('.retry'),
      $formError = $bottom.find('.formError'),
      saving = false,
      $browseBtn = $('#browseBtn'),
      draw = null;

  // hide pres
  $startBtn.on('click', function() {

    if(!$pres.hasClass('hidden')) {
      $pres.addClass('hidden');
      setTimeout(function() {
        $pres.remove();
        nextCompte();
      }, 500);
    }

    return false;
  });

  // compte a rebours avant draw
  function nextCompte() {
    $compteP.removeClass('active');

    if(currentCompte == 3) {
      $box.addClass('active');
      setTimeout(function() {
        $compte.remove();
        startDrawing();
      }, 250);
      return;
    }

    $compteP.eq(currentCompte).addClass('active');

    setTimeout(nextCompte, 1000);

    currentCompte++;
  }

  // init le dessin
  function startDrawing() {
    draw = new TEN.Draw();
    $bottom.addClass('progress');
    setTimeout(function() {
      stopDrawing();
    }, 12000);
  }

  // stop le dessin et init formulaire save
  function stopDrawing() {
    draw.stop();
    $bottom.addClass('end');
    if($.cookie('userName') !== undefined) $saveForm.find('input[name=pseudo]').val($.cookie('userName'));
    
    $saveForm.on('submit', function() {
      
      if(!saving) {
      
        var params = $saveForm.serializeObject();

        $.cookie('userName', params.pseudo);

        params.path = draw.pathString;

        if(params.pseudo == '' || params.name == '') {
          $formError.addClass('show');
        } else {
          $formError.removeClass('show');
          saving = true;
          
          $.post('saveDraw.php', params, function(data) {
            $('body').removeClass('loaded');
            setTimeout(function() {
              //window.location = 'http://'+window.location.hostname+'/view.php?id='+data;
              window.location = 'http://'+window.location.hostname+'/index.php';
            }, 500);
          });
        }

        return false;
        
      }
    });
  }
  
  // retry btn
  $retryBtn.on('click', function(e) {
    $retryBtn.off('click');
    $('body').removeClass('loaded');
    setTimeout(function() {
      window.location.reload();
    }, 500);
    return false;
  });
  
  
  $browseBtn.on('click', function(e) {
    $browseBtn.off('click');
    $('body').removeClass('loaded');
    setTimeout(function() {
      window.location = 'http://'+window.location.hostname+'/index.php';
    }, 500);
    return false;
  });

});