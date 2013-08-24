<?php

class WZUpdateRequest extends WZRequest {
  
  protected $values = array();
  protected $valuesNoBind = array();
  
  /**
   * array of values to update
   * 
   * ex :
   * array(
   *   'field1' => 'new value 1',
   *   'field2' => 'new value 2'
   * )
   * 
   * @param type $array 
   */
  public function setValues($array) {
    $this->values = $array;
  }
  /**
   * array of values to update without binding a variable
   * 
   * ex :
   * array(
   *   'field1' => 'field1 + 2'
   * )
   * 
   * @param type $array 
   */
  public function setValuesNoBind($array) {
    $this->valuesNoBind = $array;
  }
  
  public function exec() {
    
    $this->sql = 'UPDATE '.$this->getTable().' SET '.$this->getValuesSQL().' '.$this->getWhereSQL();
    
    $this->prepare();
    
    $this->bindValues();
    
    $this->bindWhere();
    
    return $this->sth->execute();
    
  }
  
  protected function getValuesSQL() {
    
    $s = '';
    
    foreach ($this->values as $key => $value) {
      
      $s .= $key.'=:'.$key.',';
      
    }
    
    foreach ($this->valuesNoBind as $key => $value) {
      
      $s .= $key.'='.$value.',';
      
    }
    
    $s = substr($s, 0, -1);
    
    return $s;
    
  }
  
  protected function bindValues() {
    
    foreach ($this->values as $key => $value) {
      
      $this->sth->bindValue(':'.$key, $value);
      
    }
    
  }
  
}

?>