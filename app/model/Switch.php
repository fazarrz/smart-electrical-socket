<?php

require_once __DIR__ . '/../../databases/database.php';

class Switchs{
    
    public function __construct() {
        
        $this->db = new Database();
        $this->connection = $this->db->databases();

    }

    public function readSwitchToDatabase()
    {
        $sql = "SELECT id_switch, switch, start_time, end_time FROM switch_electrics";
        $result = $this->connection->query($sql);
        return $result;
    }

    public function updateSwitchToDatabase($id, $switch, $start_time, $end_time)
    {
        $sql = "UPDATE switch_electrics SET switch = '$switch', start_time = '$start_time', end_time = '$end_time' WHERE id_switch = $id";
        $result = $this->connection->query($sql);
        
    }

    public function updateSwitchFirstLineToDatabase($status)
    {
        $sql = "UPDATE switch_electrics SET switch = '$status' WHERE id_switch = 1";
        $result = $this->connection->query($sql);
    }

    public function updateResetSwitchToDatabase($switch, $reset_start, $reset_end)
    {
        $sql = "UPDATE switch_electrics SET switch = '$switch', start_time = '$reset_start', end_time = '$reset_end' WHERE id_switch = 1";
        $result = $this->connection->query($sql);
    }

    

}