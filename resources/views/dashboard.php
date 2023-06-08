<?php

require_once __DIR__.'/../../app/controller/switchcontroller.php';
require_once __DIR__.'/../../app/controller/historycontroller.php';

$switchController = new SwitchController();
$switch = $switchController->read();


if($switch['switch'] == 0) {

    $status = "ON";

}else if($switch['switch'] == 1){

    $status = "OFF";
}




?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <button type="submit" class="btn btn-primary" value="<?php echo $status?>" id="myButton" onclick="switchs()"><?php echo $status?></button>
    </div>

    <?php 
        if($switch['start_time'] == '00:00:00' && $switch['end_time'] == '00:00:00'){
            echo "<p class='mb-4'>Let's Monitor Electrical Power in Realtime.</p>";
        }else{
            echo "

            <div class='alert alert-danger' role='alert'>
                You can't turn the switch on or off. Please reset the set timer!
            </div>
            ";
        }
    
    ?>


    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Voltages</div>
                            <div id="voltage" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bolt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Currents</div>
                            <div id="current" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bolt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Powers
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div id="power" class="h5 mb-0 mr-3 font-weight-bold text-gray-800"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bolt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Energies</div>
                            <div id="energy" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-bolt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Electricity Use</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area" id="chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    
    $(document).ready(function () {
        setInterval(function () {
            getDataCurrent();
        }, 2000);
    });

   

    function getDataCurrent() {
        var action = "getCurrent";

        $.ajax({
            type: "POST",
            url: "routes.php",
            data: {action: action},
            dataType: "json",
            success: function (data) {
                console.log(data);
                $("#voltage").html(data.voltage);
                $("#current").html(data.current);
                $("#power").html(data.power);
                $("#energy").html(data.energy);
            }
        });
    }


    function switchs() {
        let dataValue = document.getElementById('myButton');
        let status;

        if (dataValue.value == "ON") {
            status = 1;
            window.location.href = "routes.php?actions=switch&status="+status;
        }else if(dataValue.value == "OFF"){
            status = 0;
            window.location.href = "routes.php?actions=switch&status="+status;
        }
    }
</script>

<script>
    var options = {
        chart: {
            type: 'line',
            height : 500,
            animations: {
                enabled: true,
                easing: 'linear',
                dynamicAnimation: {
                speed: 1000
                }
            }
        },
        stroke: {
            curve: 'smooth'
            },
        dataLabels: {
        enabled: false
        },
        series: [{
            name: 'power',
            data: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        }],
        xaxis: {
            categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun', 'Mon', 'Tue', 'Wed']
        }
    }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();
  
  </script>



