<?php

class WZInsertRequest extends WZRequest {
  
  protected $values = array();
  protected $valuesNoBind = array();
  
  public function setValues($array) {
    $this->values = $array;
  }
  public function setValuesNoBind($array) {
    $this->valuesNoBind = $array;
  }
  
  public function exec() {
    
    $this->sql = 'INSERT INTO '.$this->getTable().' ('.$this->getValuesSQL().') VALUES ('.$this->getValuesSQL(true).')';
    
    $this->prepare();
    
    $this->bindValues();
    
    return $this->sth->execute();
    
  }
  
  protected function getValuesSQL($vals = false) {
    
    $s = '';
    
    foreach ($this->values as $key => $value) {
      
      if($vals) $s .= ':';
      $s .= $key.',';
      
    }
    
    foreach ($this->valuesNoBind as $key => $value) {
      
      if($vals) $s .= $value;
      else      $s .= $key;
      $s .= ',';
      
    }
    
    $s = substr($s, 0, -1);
    
    return $s;
    
  }
  
  protected function bindValues() {
    
    foreach ($this->values as $key => $value) {
      
      $this->sth->bindValue(':'.$key, $value);
      
    }
    
  }
  
  public function getInsertId() {
    return WZDB::$PDO->lastInsertId();
  }
  
}

?>
