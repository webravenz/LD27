<?php include(dirname(__FILE__).'/includes/header.php'); 

$themeId = rand(1, count($THEMES) - 1);
$themePhrase = $THEMES[$themeId]['phrase'];
?>
    
<a class="btn anim" href="index.php" id="browseBtn">Browse</a>

<h1 class="anim"><b>10s</b> drawing</h1>

<div id="drawBox" class="anim">
  
  <div class="pres anim">
    <p>You've got <b>10 seconds</b><br /> to draw <b><?php echo $themePhrase; ?></b></p>
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
        <input type="text" name="name" placeholder="Drawing name" maxlenght="25" />
        by
        <input type="text" name="pseudo" placeholder="Your name" maxlength="15" />
        
        <input type="hidden" name="theme_id" value="<?php echo $themeId; ?>" />
        
        <input type="submit" value="Save" class="btn" />
        <a href="draw.php" class="btn retry">Retry</a>
      </form>
      <p class="formError anim">All fields are required</p>
    </div>
  </div>
</div>


<script type="text/javascript">
  window.TEN = {};
</script>
<script type="text/javascript" src="js/libs/modernizr.js"></script>
<script type="text/javascript" src="js/libs/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/libs/jquery-extend.js"></script>
<script type="text/javascript" src="js/libs/jquery.cookie.js"></script>
<script type="text/javascript" src="js/libs/paper.js"></script>

<script type="text/javascript" src="js/classes/Draw.js"></script>

<script type="text/javascript" src="js/draw.js"></script>
    
<?php include(dirname(__FILE__).'/includes/footer.php'); ?>