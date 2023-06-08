<?php
include(__DIR__.'/../controller/currentcontroller.php');
include(__DIR__.'/../controller/historycontroller.php');

$currentController = new CurrentController();
$historyController = new HistoryController();

$currentController->update($_POST['voltage'], $_POST['current'], $_POST['power'], $_POST['energy']);

$data = (float)$_POST['power'];


if (!is_numeric($data)) {
    echo "Data is not a number";
}else{
    $historyController->insert($data);
}




echo $currentController->read();   

