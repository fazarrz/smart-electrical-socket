<?php

include(__DIR__ . '/../model/switch.php');

class SwitchController{

    public function __construct()
    {
        
        $this->model = new Switchs();
    }

    public function read()
    {
        $data =  $this->model->readSwitchToDatabase();
        $result = $data->fetch_assoc();
        return $result;
    }

    public function update($id, $start_time, $end_time)
    {
        date_default_timezone_set('Asia/Jakarta');

        $start = date('h:i', strtotime($start_time));

        $time = date('h:i');

        if($start == $time){
            $switch = 1;
        }else{
            $switch = 0;
        }

        $this->model->updateSwitchToDatabase($id, $switch, $start_time, $end_time);

        
        header('Location: ../views/index.php?page=switch');

    }

    public function updateswitch($status)
    {

        $data =  $this->model->readSwitchToDatabase();
        $result = $data->fetch_assoc();

        if($result['start_time'] == '00:00:00' && $result['end_time'] == '00:00:00'){

            $this->model->updateSwitchFirstLineToDatabase($status);
               
            header('Location: ../views/index.php?page=dashboard');
        }else{
            echo "<script>alert('Please set the time first!')</script>";
            header('Location: ../views/index.php?page=dashboard');

        }
     
    }

    public function reset($reset_start, $reset_end)
    {
        $switch = 0;
        $this->model->updateResetSwitchToDatabase($switch, $reset_start, $reset_end);

        header('Location: ../views/index.php?page=switch');
    }
 
   

    

}