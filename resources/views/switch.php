<?php

require_once __DIR__.'/../../app/controller/switchcontroller.php';

$controller = new SwitchController();
$switch = $controller->read();


?>

<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Set Timer</h1>
<p class="mb-4">Regulate your electricity usage so that electricity costs do not swell.</p>

<p>Previous Time : <?php echo $switch['start_time'] ?> -  <?php echo $switch['end_time']?></p>

    <form action="routes.php?actions=updateSwitch" method="post">
        <input type="hidden" name="id" value="<?php echo $switch['id_switch']?>">
        <div class="form-group">
            <label for="exampleInputEmail1">Start Time</label>
            <input type="time" class="form-control" id="exampleInputEmail1" name="start_time" required>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">End Time</label>
            <input type="time" class="form-control" id="exampleInputPassword1" name="end_time" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form><br>
    <form action="routes.php?actions=resetSwitch" method="post">
        <input type="time" class="form-control" id="exampleInputEmail1" name="reset_start" hidden>
        <input type="time" class="form-control" id="exampleInputEmail1" name="reset_end" hidden>
        <button type="submit" class="btn btn-danger">Reset</button>
    </form>

</div>

