<?php

require_once __DIR__ . '/../../databases/database.php';

class Current {


    public function __construct() {
        
        $this->db = new Database();
        $this->connection = $this->db->databases();

    }

    public function updateCurrentToDatabase($voltage, $current, $power, $energy)
    {
        
        $sql = "UPDATE electric_currents SET voltage = $voltage, current = $current, power = $power, energy = $energy WHERE id_electric = 1";
        $this->connection->query($sql);


    }
    
    public function readSwitchToDatabase()
    {
        $sql = "SELECT switch, start_time, end_time FROM electric_currents JOIN switch_electrics ON electric_currents.id_electric = switch_electrics.id_switch WHERE electric_currents.id_electric = 1";
        $result = $this->connection->query($sql);

        foreach ($result as $value) {

            $data = array(
                'switch' => $value['switch'],
                'start_time' => date('H:i', strtotime($value['start_time'])),
                'end_time' => date('H:i', strtotime($value['end_time']))
            );
        }
        return json_encode($data);
    }

    public function readCurrentToDatabase()
    {
        $sql = "SELECT id_electric, voltage, current, power, energy FROM electric_currents";
        $result = $this->connection->query($sql);
        return $result;
    }
}