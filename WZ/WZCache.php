<?php
class WZCache {

  public static function getCache($key, $time = 3600) {
    $file = WZConfig::$CACHE_FOLDER.$key.'.txt';
    if(is_file($file)) {
      // garde 1h en cache
      if(time() - filemtime($file) <= $time) {
        return json_decode(file_get_contents($file));
      }
    }
    return false;
  }

  public static function setCache($key, $content) {
    
    $file = WZConfig::$CACHE_FOLDER.$key.'.txt';
    
    if($fp = @fopen($file, 'w')) {
      fputs($fp, $content);
      fclose($fp);
    }

  }

}
?>

