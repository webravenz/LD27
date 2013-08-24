<?php

class WZSelectRequest extends WZRequest {
  
  protected $fields;
  protected $class = '';
  protected $order;
  protected $limit = '';
  protected $join = '';
  protected $groupBy = '';

    /**
   * select only specified fields
   * 
   * @param array $fields 
   */
  public function setFields($fields) {
    $this->fields = $fields;
  }
  
  /**
   * return results in a class
   * 
   * @param string $class 
   */
  public function setClass($class) {
    $this->class = $class;
  }
  
  /**
   * set the join string of the request
   * @param string $join 
   */
  public function setJoin($join) {
    $this->join = $join;
  }
  
  /**
   * 
   * set request order
   * 
   * @param array $order 
   */
  public function setOrder($order) {
    $this->order = $order;
  }
  
  /**
   * 
   * set request group by
   * 
   * @param string $field
   */
  public function setGroupBy($field) {
    $this->groupBy = $field;
  }
  
  public function setLimit($start, $count) {
    $this->limit = 'LIMIT '.$start.','.$count;
  }
  
  public function exec() {
    
    $this->sql = 'SELECT '.$this->getFieldsSQL().' FROM '.$this->getTable().' '.$this->join.' '.$this->getWhereSQL().' '.$this->getGroupBySQL().' '.$this->getOrderSQL().' '.$this->limit;
    
    $this->prepare();
    
    $this->bindWhere();
    
    $this->sth->execute();
    
    if($this->class == '')
      return $this->sth->fetchAll(PDO::FETCH_ASSOC);
    else
      return $this->sth->fetchAll(PDO::FETCH_CLASS, $this->class);
    
  }
  
  protected function getFieldsSQL() {
    
    if(is_array($this->fields)) {
      return implode(',', $this->fields);
    } else {
      return '*';
    }
    
  }
  
  protected function getOrderSQL() {
    
    if(is_array($this->order)) {
      
      $s = 'ORDER BY ';
      
      foreach($this->order as $o) {
        $s .= $o.', ';
      }
      
      $s = substr($s, 0, -2);
      return $s;
      
    } else {
      return '';
    }
    
  }
  
  protected function getGroupBySQL() {
    
    if($this->groupBy != '') {
      
      return 'GROUP BY '.$this->groupBy;
      
    } else {
      return '';
    }
    
  }
  
}

?>
