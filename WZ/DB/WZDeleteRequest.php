<?php

class WZDeleteRequest extends WZRequest {
  
  private $tablesDel = '';
  
  /**
   * en cas de delete multiple, tables a supprimer
   * @param array $tables 
   */
  public function setDelTables($tables) {
    $this->tablesDel = implode(', ', $tables);
  }
  
  public function exec() {
    
    $this->sql = 'DELETE '.$this->tablesDel.' FROM '.$this->getTable().' '.$this->getWhereSQL();
    
    $this->prepare();
    
    $this->bindWhere();
    
    return $this->sth->execute();
    
  }
  
}

?>