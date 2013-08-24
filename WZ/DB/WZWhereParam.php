<?php

class WZWhereParam {
  
  protected $field;
  protected $cond;
  protected $val;
  protected $count;
  protected $nobind;
  
  protected static $COUNT = 0;
  
  public function __construct($field, $cond, $val, $nobind = false) {
    $this->field = $field;
    $this->val = $val;
    $this->cond = $cond;
    $this->nobind = $nobind;
    
    $this->count = WZWhereParam::$COUNT;
    WZWhereParam::$COUNT++;
  }
  
  public function getSQL() {
    $sql = $this->field.$this->cond;
    
    $sql .= $this->nobind ? $this->val : ':where_'.$this->count;
    
    return $sql;
  }
  
  public function bindVal($sth) {
    if(!$this->nobind) $sth->bindValue(':where_'.$this->count, $this->val);
  }
  
}

?>
