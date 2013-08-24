<?php

class WZRequest {
  
  protected $table;
  protected $where;
  
  protected $sth;
  protected $sql;
  
  public function __construct($table) {
    $this->table = $table;
  }
  
  protected function getTable() {
    
    $s = '';
    
    if(is_array($this->table)) {
      foreach($this->table as $as => $name) {
        $s .= '`'.WZConfig::$DB_PREFIX.$name.'` '.$as.', ';
      }
      $s = substr($s, 0, -2);
    } else {
      $s = '`'.WZConfig::$DB_PREFIX.$this->table.'`';
    }
    
    return $s;
  }
  
  /**
   * set the where condition of the request
   * 
   * @param array $array 
   */
  public function setWhere($array) {
    $this->where = $array;
  }
  
  protected function getWhereSQL() {
    
    $s = '';
    
    if(is_array($this->where)) {
      $s .= 'WHERE ';
      $s .= $this->getWhereSQLRec($this->where);
    }
    
    return $s;
    
  }
  
  protected function getWhereSQLRec($array, $type = '') {
    
    $s = '';
    
    $first = true;
    
    foreach($array as $k => $v) {
      
      $cond = $this->getWhereCond($k);
      
      if(!$first) $s .= ' '.$type.' ';
      
      if($cond) {
        $s .= '(';
        $s .= $this->getWhereSQLRec($v, $cond);
        $s .= ')';
      } else {
        $s .= $v->getSQL();
      }
      
      $first = false;
      
    }
    
    return $s;
    
  }
  
  protected function bindWhere() {
    
    if(is_array($this->where)) {
      $this->bindWhereRec($this->where);
    }
    
  }
  
  protected function bindWhereRec($array) {
    
    foreach($array as $k => $v) {
      
      $cond = $this->getWhereCond($k);
      
      if($cond) {
        $this->bindWhereRec($v);
      } else {
        $v->bindVal($this->sth);
      }
      
    }
    
  }
  
  protected function getWhereCond($str) {
    $cond = false;
      
    if(substr($str, 0, 2) === 'OR') $cond = 'OR';
    else if (substr($str, 0, 3) === 'AND') $cond = 'AND';
    
    return $cond;
  }
  
  protected function prepare() {
    $this->sql = str_replace('##_', WZConfig::$DB_PREFIX, $this->sql);
    $this->sth = WZDB::$PDO->prepare($this->sql);
  }
  
  /**
   * get sql of the request
   * @return string $sql 
   */
  public function getSQL() {
    return $this->sql;
  }
  
}

?>
