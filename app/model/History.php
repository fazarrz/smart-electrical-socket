<?php

require_once __DIR__ . '/../../databases/database.php';

class History {


    public function __construct() {
        
        $this->db = new Database();
        $this->connection = $this->db->databases();

    }

    public function insertHistoryToDatabase($id, $usageDate, $power, $expanse)
    {
            
        $sql = "INSERT INTO history_use_electrics(electric_id, usage_date, power, expense) VALUES ($id, '$usageDate', $power, $expanse)";
        $this->connection->query($sql);
            
    }

    public function readHistoryToDatabase()
    {
        $sql = "SELECT power, expense, usage_date FROM history_use_electrics";
        $result = $this->connection->query($sql);
        return $result;
    }

 

   

   
}