<?php include(dirname(__FILE__).'/includes/header.php');

$currentCat = isset($_GET['cat']) ? $_GET['cat'] : '';

?>

<h1 class="anim"><b>10s</b> drawing</h1>

<a href="draw.php" class="btn anim" id="drawBtn">Draw</a>

<div class="categories anim">
  <p>Category</p>
  <a href="index.php" data-id="" <?php if($currentCat == '') echo 'class="selected"'; ?>>All</a>
  <?php
  foreach($THEMES as $i => $theme) {
    if($i != 0) echo '<a href="index.php?cat='.$i.'" data-id="'.$i.'" '.($currentCat == $i ? 'class="selected"' : '').'>'.$theme['name'].'</a>';
  }
  ?>
  <div class="clear"></div>
</div>

<div class="drawsList anim">
<?php

$nbParPage = 1;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$req = new WZSelectRequest('draw');
$req->setOrder(array('draw_date DESC'));
$req->setLimit(($page - 1) * $nbParPage, $nbParPage);
if($currentCat != '') $req->setWhere (array(new WZWhereParam ('theme_id', '=', $currentCat)));

$draws = $req->exec();

$reqC = new WZSelectRequest('draw');
$reqC->setFields(array('COUNT(draw_id) AS total'));
if($currentCat != '') $reqC->setWhere (array(new WZWhereParam ('theme_id', '=', $currentCat)));
$res = $reqC->exec();
$total = $res[0]['total'];

foreach($draws as $draw) {
  $paths = explode(';', $draw['draw_path']);
  ?>
  
  <a href="view.php?id=<?php echo $draw['draw_id']; ?>" class="anim">
    <svg>
      <?php foreach($paths as $path) { ?>
        <path d="<?php echo $path; ?>" />
      <?php } ?>
    </svg>
    <span class="infos anim"><?php echo $draw['draw_name']; ?> <br /><span>by <?php echo $draw['draw_pseudo']; ?></span></span>
  </a>

  <?php
}

?>
  <div class="clear"></div>
  
  <div class="pagination">
    <?php if($page > 1) echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/index.php?page='.($page - 1).'&cat='.$currentCat.'">Previous</a>'; ?>
    <?php if($page * $nbParPage < $total) echo '<a href="http://'.$_SERVER['HTTP_HOST'].'/index.php?page='.($page + 1).'&cat='.$currentCat.'">Next</a>'; ?>
  </div>
</div>


<script type="text/javascript">
  window.TEN = {};
</script>
<script type="text/javascript" src="js/libs/modernizr.js"></script>
<script type="text/javascript" src="js/libs/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="js/libs/jquery-extend.js"></script>
<script type="text/javascript" src="js/libs/jquery.cookie.js"></script>

<script type="text/javascript" src="js/browse.js"></script>
    
<?php include(dirname(__FILE__).'/includes/footer.php'); ?>