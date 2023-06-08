<?php


include(__DIR__ . '/../model/current.php');

class CurrentController{


    public function __construct()
    {
        
        $this->model = new Current();
    }

    public function update($voltage, $current, $power, $energy)
    {
        $this->model->updateCurrentToDatabase($voltage, $current, $power, $energy);
    }

    public function read()
    {
        return $this->model->readSwitchToDatabase();
    }

    public function show()
    {
        $data = $this->model->readCurrentToDatabase();
        $result = $data->fetch_assoc();
        echo json_encode($result);

      
    }

    
}