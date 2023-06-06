<?php 
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<div class="container mt-5">
<?php include ('../roots/message.php'); ?>
<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Search Residents</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="h6">Patient ID</p>
                                    <input type="number" name="search_p_id" value="<?php if (isset($_GET['search_p_id'])) {echo $_GET['search_p_id']; } ?>" class="form-control" placeholder="Enter ID" >
                                </div>
                                <div class="col-sm-4">
                                    <p class="h6">Patient Name</p>
                                    <input type="text" name="search_p_name" value="<?php if (isset($_GET['search_p_name'])) {echo $_GET['search_p_name']; } ?>" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="col-sm-1 text-center">
                                    <p class="h6">&nbsp</p>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Patient Details 
                    <a href="../patient/search-patient.php" class = "btn btn-success float-end">Patients List</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Mobile Number</th>
                            <th>Room Number</th>
                            <th>Patient Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            $searched_id = $_GET['search_p_id'];
                            $searched_name = $_GET['search_p_name'];

                            if (!$searched_id and !$searched_name) {
                                $query = "SELECT * FROM patient WHERE isResident = '1' ";
                            } else if ($searched_id and !$searched_name) {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id AND isResident = '1' ";
                            } else if (!$searched_id and $searched_name) {
                                $query = "SELECT * FROM patient WHERE p_name LIKE '%$searched_name%' AND isResident = '1'";
                            } else {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id AND p_name LIKE '%$searched_name%' AND isResident = '1' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $patient) {
                                    ?>
                                    <tr>
                                        <td> <?= $patient['p_id']; ?> </td>
                                        <td> <?= $patient['p_name']; ?> </td>                                       
                                        <td> <?= $patient['mobile_no']; ?> </td>
                                        <td> <?= $patient['room_no']; ?> </td>

                                        <?php
                                            $p_id = $patient['p_id'];
                                            $query = "SELECT COUNT(visit_count) visit_count FROM payment_history where p_id = '$p_id' ";
                                            $query_run_visit = mysqli_query($connect, $query);
                                            $visitTuple = mysqli_fetch_assoc($query_run_visit);
                                            $v_cnt = $visitTuple['visit_count'];
                                            

                                            $query = "SELECT COUNT(*) charge_count FROM patient_record where p_id = '$p_id' AND visit_count = '$v_cnt' ";
                                            $query_run_charge = mysqli_query($connect, $query);
                                            $chargeTuple = mysqli_fetch_assoc($query_run_charge);
                                            $charge_cnt = $chargeTuple['charge_count'];

                                            $query = "SELECT paid FROM payment_history where p_id = '$p_id' AND visit_count = '$v_cnt' ";
                                            $query_run_paid = mysqli_query($connect, $query);
                                            $paidTuple = mysqli_fetch_assoc($query_run_paid);
                                            $paid = $paidTuple['paid'];
                                            
                                        ?>
                                        <?php if (!$v_cnt): ?>
                                            <td>New Patient</td>
                                        <?php elseif ($v_cnt and $paid): ?>
                                            <td>Readmitted</td>
                                        <?php elseif ($v_cnt and !$paid and !$charge_cnt): ?>
                                            <td>Add Charge</td>
                                        <?php else: ?>
                                            <td>Generated</td>
                                        <?php endif; ?>

                                        <td>
                                            <?php if (!$v_cnt): ?>
                                                <a href="../payment/generate-bill.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-success btn-sm" style="width:55%">Generate Bill</a>
                                            <?php elseif ($v_cnt and $paid): ?>
                                                <a href="../payment/generate-bill.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-success btn-sm" style="width:55%">Generate Bill</a>
                                            <?php elseif ($v_cnt and !$paid and !$charge_cnt): ?>
                                                <a href="../payment/include-charges.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-warning btn-sm" style="width:55%">Add Charge</a>
                                            <?php else: ?>
                                                <a href="../payment/include-discount.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-danger btn-sm" style="width:55%">Payment</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="5">No Record Found!</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>                   
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php
    include('../includes/footer.php');
?>