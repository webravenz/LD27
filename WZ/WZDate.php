<?php

class WZDate {
  
  /**
   * get a date at SQL format
   * @param int $time time
   * @param boolean $datetime true to have a DATETIME format
   */
  public static function getDateSQL($time, $datetime = false) {
    
    $date = date('Y-m-d', $time);
    if($datetime) $date .= date(' H:i:s', $time);
    
    return $date;
    
  }
  
}

?>
