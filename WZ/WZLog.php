<?php

class WZLog {
  
  protected $type;
  protected $text;

  public function __construct($type) {
    
    $this->type = $type;
    
  }
  
  public function log($text) {
    $this->text .= $text."\r\n";
  }
  
  public function save() {
    $folder = WZConfig::$LOG_FOLDER.$this->type.'/';
    if(!is_dir($folder)) mkdir($folder);
    
    $fileName = date('Y-m-d_H-i-s').'.txt';
    file_put_contents($folder.$fileName, $this->text);
  }
  
  public static function getFromFolder($folder) {
    
    $logs = array();
    
    $folder = WzConfig::$LOG_FOLDER.$folder;
    if ($handle = opendir($folder)) {
      while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
          
          $fileTitle = explode('.', $entry)[0];
          $logs[$fileTitle] = file_get_contents($folder.'/'.$entry);
          
        }
      }
      closedir($handle);
    }
    
    krsort($logs);
    return $logs;
    
  }
  
  public static function deleteOld($nbJours) {
    
    if ($handle = opendir(WZConfig::$LOG_FOLDER)) {
      
      while (false !== ($entry = readdir($handle))) {
        
        if($entry != '.' && $entry != '..') {
          foreach (glob(WZConfig::$LOG_FOLDER.$entry."/*.txt") as $file) {
            if (filemtime($file) < time() - ($nbJours * 24 * 3600)) {
              unlink($file);
            }
          }
        
        }
        
      }
      
    }
    
  }
  
}

?>
