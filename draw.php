<?php include(dirname(__FILE__).'/includes/header.php'); ?>
    
<a class="btn anim" href="index.php" id="browseBtn">Browse</a>

<h1><b>10s</b> drawing</h1>

<div id="drawBox" class="anim">
  
  <div class="pres anim">
    <p>You've got <b>10 seconds</b><br /> to draw whatever you want</p>
    <a class="btn" href="#">Start !</a>
  </div>
  
  <div class="compte">
    <p>3</p>
    <p>2</p>
    <p>1</p>
  </div>
  
  <canvas id="drawStage"></canvas>
  
  <div class="bottom">
    <div class="back"></div>
    <div class="front anim">
      <form method="post" id="saveForm">
        <input type="text" name="name" placeholder="Drawing name" />
        by
        <input type="text" name="pseudo" placeholder="Your name" />
        
        <input type="submit" value="Save" class="btn" />
        <a href="draw.php" class="btn">Retry</a>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  window.TEN = {};
</script>
<script type="text/javascript" src="js/libs/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/libs/jquery-extend.js"></script>
<script type="text/javascript" src="js/libs/paper.js"></script>

<script type="text/javascript" src="js/classes/Draw.js"></script>

<script>

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
      $saveForm.on('submit', function() {
        console.log($saveForm.serializeObject());
        return false;
      });
    }
    
  });
</script>
    
<?php include(dirname(__FILE__).'/includes/footer.php'); ?>