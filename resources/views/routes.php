<?php

require_once __DIR__.'/../../app/controller/currentcontroller.php';
require_once __DIR__.'/../../app/controller/switchcontroller.php';
require_once __DIR__.'/../../app/controller/historycontroller.php';

$currentController = new CurrentController();
$switchController = new SwitchController();
$historyController = new HistoryController();

    if (isset($_POST['action'])) {
        
        $action = $_POST['action'];

        if ($action == "getCurrent") {
        
            $currentController->show();
        }

       

    }elseif (isset($_GET['actions'])) {
        $actions = $_GET['actions'];

        if ($actions == "updateSwitch") {
            $switchController->update($_POST['id'], $_POST['start_time'], $_POST['end_time']);
        }

        if($actions == "switch"){

            $switchController->updateswitch($_GET['status']);
        }

        if($actions == "resetSwitch"){

            $switchController->reset($_POST['reset_start'], $_POST['reset_end']);
           
        }

    }
    
    

    


