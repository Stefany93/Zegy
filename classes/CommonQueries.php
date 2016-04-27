<?php
class CommonQueries extends StartDB
{
    protected $table;


    public function setTable($table)
    {
        $this->table = $table;
    }
    protected function getTable()
    {
        return $this->table;
    }
    public function newQuery()
    {   
        return parent::DBConnect();
    }
    public function exceptionMessage()
    {
        return array(
            'empty' => sprintf("No results found!", $this->table),
            'couldNotDelete' => sprintf("Could not delete from %s table!", $this->table),
            'falseQuery' => sprintf("Query failed from %s table!", $this->table),

            );
    }
    protected function checkResultSet($array)
    {
        if( !empty($array) and $array !== false ) 
        {
            return true;
        }else
        {
            throw new Exception($this->exceptionMessage()['empty']);
        }
    }
    public function fetchAllsCond($where, $condition, $operator = '=', $orderBy = null)
    {
        if(!isset($where, $condition))
        {
            throw new Exception("fetchOneRowWithCond method expects two parameters!");  
        }
            $sql = sprintf("SELECT * FROM %s  WHERE %s %s ? $orderBy  ", $this->table, $where, $operator );
            $query = $this->newQuery();
            $prepared = $query->prepare($sql);  
            $prepared->bindParam(1, $condition);
            $prepared->execute();
            $result =  $prepared->fetchAll(PDO::FETCH_ASSOC);
        if( $this->checkResultSet($result) )
        {
            return $result;
        }
    }
      public function fetchAlls($orderBy = null)
    {
            $sql = sprintf("SELECT * FROM %s $orderBy  ", $this->table );
            $query = $this->newQuery();
            $prepared = $query->prepare($sql);  
            $prepared->execute();
            $result =  $prepared->fetchAll(PDO::FETCH_ASSOC);
        if( $this->checkResultSet($result) )
        {
            return $result;
        }
    }
    public function fetchOneRowWithCond($where, $condition, $operator = '=')
    {
        if(!isset($where, $condition))
        {
            throw new Exception("fetchOneRowWithCond method expects two parameters!");  
        }
            $sql = sprintf("SELECT * FROM %s WHERE %s %s ?", $this->table, $where, $operator );
            $query = $this->newQuery();
            $prepared = $query->prepare($sql);  
            $prepared->bindParam(1, $condition);
            $prepared->execute();
            return $prepared->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAllColumns($where, $condition, $columns, $operator = '=')
    {
        if(!isset($where, $condition))
        {
            throw new Exception("fetchOneRowWithCond method expects two parameters!");  
        }
            $sql = sprintf("SELECT $coumns FROM %s WHERE %s %s ?", $this->table, $where, $operator );
            $query = $this->newQuery();
            $prepared = $query->prepare($sql);  
            $prepared->bindParam(1, $condition);
            $prepared->execute();
            return $prepared->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchOneColumn($where, $condition, $column_name, $operator = '=')
    {
        if(!isset($where, $condition))
        {
            throw new Exception("fetchOneColumn method expects 3 parameters!");  
        }
            $sql = sprintf("SELECT %s FROM %s WHERE %s %s ?", $column_name, $this->table, $where, $operator );
            $query = $this->newQuery();
            $prepared = $query->prepare($sql);  
            $prepared->bindParam(1, $condition);
            $prepared->execute();
            return $prepared->fetchColumn();
    }
    public function insert($values_array, $num_values)
    {
        print_r($values_array);
        $k = (array_keys($values_array));
        $ki =  implode(',', $k);
        $question_marks = array_fill(1, $num_values, '?');
        $question_marks_string =  implode(',', $question_marks);
        $i = 0; 
        $sql = sprintf("INSERT INTO %s(%s) VALUES(%s)",  $this->table, $ki, $question_marks_string);
       $query = $this->newQuery();
        $prepare = $query->prepare($sql);
        if(!is_object($prepare))
        {
            throw new Exception("Could not execute the query!  $sql", 1);
            
        }
        foreach ($values_array as &$value) {
            $i++;
            $prepare->bindParam($i, $value);
        }
        if(!$prepare->execute())
        {
            throw new Exception("Could not execute an insert query! $sql", 1);
            
        }

    }
    public function replace($values_array, $num_values)
    {
        print_r($values_array);
        $k = (array_keys($values_array));
        $ki =  implode(',', $k);
        $question_marks = array_fill(1, $num_values, '?');
        $question_marks_string =  implode(',', $question_marks);
        $i = 0; 
        $sql = sprintf("REPLACE INTO %s(%s) VALUES(%s)",  $this->table, $ki, $question_marks_string);
       $query = $this->newQuery();
        $prepare = $query->prepare($sql);
        if(!is_object($prepare))
        {
            throw new Exception("Could not execute the query!  $sql", 1);
            
        }
        foreach ($values_array as &$value) {
            $i++;
            $prepare->bindParam($i, $value);
        }
        if(!$prepare->execute())
        {
            throw new Exception("Could not execute an insert query! $sql", 1);
            
        }

    }

    // Delete

    public function delete($condition1, $condition2, $operator = '=')
    {
        $sql = sprintf("DELETE FROM %s WHERE %s $operator %s ", $this->table, $condition1, $condition2);
        $query = $this->newQuery();
        $prepare = $query->prepare($sql);
        if(!is_object($prepare))
        {
            throw new Exception("Could not execute the query!  $sql", 1);   
        }
        if(!$prepare->execute())
        {
            throw new Exception("Could not execute an ".__FUNCTION__." query! $sql", 1);
            
        }
    }
}