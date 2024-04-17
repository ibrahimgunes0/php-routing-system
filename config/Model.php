<?php

class Model extends Database
{
    // Get all data from the specified table
    public function fetchAll($tableName){
        return $this->db->query("SELECT * FROM $tableName")->fetchAll(PDO::FETCH_ASSOC);
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
}