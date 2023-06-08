<?php

    require_once __DIR__.'/../../app/controller/historycontroller.php';

    $controller = new HistoryController();
    $historyData = $controller->show();
    $total = $controller->count();

?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Expense History</h1>
    <p class="mb-4">The total payable for this month is Rp. <?php echo $total?></p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Usage Date</th>
                            <th>Power</th>
                            <th>Expense</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php $no = 0?>
                        <?php while($row = $historyData->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo ++$no; ?></td>
                            <td><?php echo $row['usage_date']; ?></td>
                            <td><?php echo $row['power']; ?></td>
                            <td>Rp. <?php echo $row['expense']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

