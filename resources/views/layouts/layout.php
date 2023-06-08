<?php 

    $page = isset($_GET['page']) ? $_GET['page'] : null;

    if($page == null){
        include(__DIR__.'/../dashboard.php');
    }else if($page == 'dashboard'){
        include(__DIR__.'/../dashboard.php');
    }else if ($page == 'history'){
        include(__DIR__.'/../history.php');
    } else if ($page == 'switch'){
        include(__DIR__.'/../switch.php');
    }   

?>