<?php

require_once __DIR__ . '/../model/history.php';
require_once __DIR__ . '/../model/current.php';

class HistoryController{

    public function __construct()
    {
        
        $this->model = new History();
    }

    public function insert($power)
    {
        date_default_timezone_set('Asia/Jakarta');

        $time = date('i');
        $time = (int)$time;
        $time = $time % 30;

        $currentModel = new Current();
        $result = $currentModel->readCurrentToDatabase();
        $row = $result->fetch_assoc();
        $powers = $row['power'];
        $id = $row['id_electric'];

        if($time == 0 || $powers != $power){

           if($power != 0.000){

                $usageDate = date('Y-m-d');
                $expanse = $power / 1.000;
                $expanse = $expanse * 1.352;
                $expanse = number_format($expanse, 3, '.', '');

                $this->model->insertHistoryToDatabase($id, $usageDate, $power, $expanse);
           }
        }

       
    }

    public function show()
    {
        $result = $this->model->readHistoryToDatabase();
        return $result;
    }

    public function count()
    {
        $result = $this->model->readHistoryToDatabase();
        $total = 0;
        while($row = $result->fetch_assoc()){
            $total += $row['expense'];
        }
        return $total;
    }


    
}