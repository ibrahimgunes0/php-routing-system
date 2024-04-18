<?php

class Model extends Database
{
    // Get all data from the specified table
    public function fetchAll($tableName){
        return $this->db->query("SELECT * FROM $tableName ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    }

    // Get data conditionally
    public function fetchColumn($table,$params,$values){

        $conditon = '';

        foreach($params as $param){
            $conditon .= ($conditon ? ' AND ' : '') . "$param=:$param";
        }
        
        $conditon = $conditon ?: "1=1";

        $stmt = $this->db->prepare("SELECT * FROM $table WHERE $conditon");

        for($i=0; $i < count($values); $i++){
            $stmt->bindParam(":$params[$i]", $values[$i]);
        }

        
        $stmt->execute();

        return  $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addRow($table, $params) {
        // Create separate arrays to store column names and values
        $columns = array();
        $values = array();
        
        // Loop through column names and values
        foreach ($params as $columnName => $columnValue) {
            $columns[] = $columnName;
            $values[] = $columnValue;
        }
    
        $columnNamesStr = implode(", ", $columns);
        $placeholders = implode(", ", array_fill(0, count($values), "?"));
    
        // Create the query
        $query = "INSERT INTO $table ($columnNamesStr) VALUES ($placeholders)";
    
        // Prepare and run the query
        $stmt = $this->db->prepare($query);
        $stmt->execute($values);
        return $this->db->lastInsertId();
    }
}