<?php
include(dirname(__FILE__).'/includes/init.php');

?>
<div class="anim">
<?php

$showed = false;
if(isset($_GET['id']) && !empty($_GET['id'])) {
  
  $req = new WZSelectRequest('draw');
  $req->setWhere(array(new WZWhereParam('draw_id', '=', $_GET['id'])));

  $draws = $req->exec();
  if(count($draws > 0)) {
    
    $draw = $draws[0];
    $showed = true;
    $paths = explode(';', $draw['draw_path']);
    ?>
    <svg class="anim">
      <?php foreach($paths as $path) { ?>
        <path d="<?php echo $path; ?>" />
      <?php } ?>
    </svg>
    <div class="infos anim">
      <?php echo $draw['draw_name']; ?> <br />
      <span>by <?php echo $draw['draw_pseudo']; ?></span>
      <span class="category"><?php echo $THEMES[$draw['theme_id']]['name']; ?></span>
    </div>
    
    <a href="#" class="facebook"
      onclick="
        window.open(
          'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
          'facebook-share-dialog', 
          'width=626,height=436'); 
        return false;">
      
    </a>

    <?php
    
  }
  
}
?>
</div>
<?php

if(!$showed) echo '<p class="error">Drawing not found</p>';
?>
