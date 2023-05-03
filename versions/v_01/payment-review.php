<?php
    error_reporting(0);
    require 'db-connect.php';
    include('includes/header.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-2">
            <!-- spacing -->
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Payment Review
                        <a href="search-department.php" class = "btn btn-danger float-end">Dont's Click</a>
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div id="show_alert"> </div>
                    <?php
                        if (!$_GET['visit_count']) {
                            if (isset($_GET['p_id'])) {
                                $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                                $query = "SELECT COUNT(visit_count) visit_count FROM payment_history where p_id = '$p_id' ";
                                $query_run = mysqli_query($connect, $query);
    
                                $dataTuple = mysqli_fetch_assoc($query_run);
                                $v_cnt = $dataTuple['visit_count'];
                            }
                        } else {
                            $v_cnt = $_GET['visit_count'];
                        }

                        if (!$_GET['discount_pct']) {
                            if (isset($_GET['p_id'])) {
                                $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                                $query = "SELECT discount_pct FROM payment_history where p_id = '$p_id' AND 
                                        visit_count = '$v_cnt' ";
                                $query_run = mysqli_query($connect, $query);
    
                                $dataTuple = mysqli_fetch_assoc($query_run);
                                $discount = $dataTuple['discount_pct'];
                            }
                        } else {
                            $discount = $_GET['discount_pct'];
                        }

                        
                    ?>
                    
                        <form action="source-codes.php" method="POST">
                            <div class="row mb-3">
                                <div class="col-md-4 mb-3"> </div>
                                <div class="col-md-2 mb-3">
                                    <p class="h6 text-center">Patient ID</p>
                                    <input type="number" name="p_id" class="form-control text-center" value="<?=$_GET['p_id']?>" readonly>
                                </div>
                                <div class="col-md-2 mb-3">
                                    <p class="h6 text-center">Visit Count</p>
                                    <input type="number" name="visit_count" class="form-control text-center" value="<?=$v_cnt?>" readonly>
                                </div>
                                <div class="col-md-4 mb-3"> </div>
                            </div>

                            <?php
                            if (isset($_GET['p_id'])) {
                                $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                                $query = "SELECT * FROM patient where p_id = '$p_id' ";
                                $query_run = mysqli_query($connect, $query);

                                $dataTuple = mysqli_fetch_assoc($query_run);
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <p class="h6">Name</p>
                                    <input type="text" name="p_name" class="form-control" value="<?=$dataTuple['p_name'] ?>" readonly>
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p class="h6">Age</p>
                                    <input type="number" name="p_age" class="form-control" value="<?=$dataTuple['p_age'] ?>" readonly>  
                                </div>
                                <div class="col-md-3 mb-2">
                                    <p class="h6">Sex</p>
                                    <input type="text" name="p_sex" class="form-control" value="<?=$dataTuple['p_sex'] ?>" readonly>  
                                </div>
                            </div>
                            <?php
                            if (isset($_GET['p_id'])) {
                                $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                                $query = "SELECT * FROM payment_history where p_id = '$p_id' AND visit_count = '$v_cnt' ";
                                $query_run = mysqli_query($connect, $query);

                                $dataTuple = mysqli_fetch_assoc($query_run);
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <p class="h6">Date of Admission</p>
                                    <input type="text" name="admission_date" class="form-control" value="<?=$dataTuple['admission_date'] ?>" readonly>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p class="h6">Date of Release</p>
                                    <input type="text" name="release_date" class="form-control" value="<?=$dataTuple['release_date'] ?>" readonly>
                                </div>
                            </div>

                            <?php
                            if (isset($_GET['p_id'])) {
                                $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                                $query = "SELECT purpose_name, dr_name, dept_name
                                        FROM payment_history, purpose, doctor, department
                                        WHERE p_id = '$p_id' AND visit_count = '$v_cnt' AND payment_history.purpose_id = purpose.purpose_id 
                                        AND payment_history.assign_dr_init = doctor.dr_init AND purpose.dept_init = department.dept_init; ";
                                $query_run = mysqli_query($connect, $query);

                                $dataTuple = mysqli_fetch_assoc($query_run);
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <p class="h6">Purpose Name</p>
                                    <input type="text" name="purpose_name" class="form-control" value="<?=$dataTuple['purpose_name'] ?>" readonly>  
                                </div>
                                <div class="col-md-6 mb-2">
                                    <p class="h6">Doctor Name</p>
                                    <input type="text" name="dr_name" class="form-control" value="<?=$dataTuple['dr_name'] ?>" readonly>  
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <p class="h6">Department Name</p>
                                    <input type="name" name="dept_name" class="form-control" value="<?=$dataTuple['dept_name'] ?>" readonly>  
                                </div>
                                <div class="col-md-6"> </div>
                            </div>
                            
                            <table class="table table-bordered table-striped">
                            <thead align="center">
                                <tr>
                                    <th class="text-center">Charge Number</th>
                                    <th class="text-center">Charge Name</th>
                                    <th class="text-center">Amount (BDT)</th>
                                    <th class="text-center">Time Count</th>
                                    <th class="text-center">Subtotal (BDT)</th>
                                </tr>
                            </thead>
                            <tbody align="center">  
                                <?php
                                    $query = "SELECT charge_sheet.charge_num, charge_sheet.charge_name, amount, time_count, (amount * time_count) AS subtotal
                                            FROM patient_record, charge_sheet
                                            WHERE p_id = '$p_id' AND visit_count = '$v_cnt' 
                                            AND patient_record.history = charge_sheet.charge_num;";

                                    $query_run = mysqli_query($connect, $query);

                                    if (mysqli_num_rows($query_run) > 0) {
                                        foreach ($query_run as $charge) {
                                            ?>
                                            <tr>
                                                <td> <?= $charge['charge_num']; ?> </td>
                                                <td> <?= $charge['charge_name']; ?> </td>
                                                <td> <?= $charge['amount']; ?> </td>
                                                <td> <?= $charge['time_count']; ?> </td>
                                                <td> <?= $charge['subtotal']; ?> </td>
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
                            
                                <tr>
                                    <!-- <td></td> -->
                                </tr>
                            </tbody>                   
                        </table>

                        <!-- <div class="row mb-5">
                        </div> -->

                        <?php
                        if ($discount) {
                            $query = "SELECT ROUND((payable_amount * (100 - discount_pct) / 100.0), 0) AS payable, payable_amount
                                    FROM payment_history
                                    WHERE p_id = '$p_id' and visit_count = '$v_cnt' ";
                        } else {
                            $query = "SELECT payable_amount AS payable, payable_amount
                                    FROM payment_history
                                    WHERE p_id = '$p_id' and visit_count = '$v_cnt' ";
                        }

                        $query_run = mysqli_query($connect, $query);
                        $dataTuple = mysqli_fetch_assoc($query_run);

                        ?>
                    
                        <div class="row mb-2"> </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <p class="h6">Total Amount (BDT)</p>
                                <input type="number" name="total_amount" class="form-control" value="<?=$dataTuple['payable_amount']?>" readonly>
                            </div>
                            <div class="col-md-7 mb-3">
                                
                            </div>
                        </div>
                        <div class="row mb-6">
                            <div class="col-md-2 mb-3">
                                <p class="h6">Discount (%)</p>
                                <input type="number" name="discount_pct" class="form-control" value="<?=$discount?>" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <p class="h6">After Discount (BDT)</p>
                                <input type="number" name="payable_amount" class="form-control" value="<?=$dataTuple['payable']?>" readonly>
                            </div>

                            <div class="col-md-1 mb-3">
                                
                            </div>

                            <div class="col-md-4 mb-3">
                                <p class="h6">Paid</p>
                                <input type="number" name="paid_amount" class="form-control mb-3" placeholder="Enter Paid Amount" required>
                            </div>
                            
                            <div class="col-md-2 mb-3">
                                <p class="h6">&nbsp</p>
                                <button type="submit" class="btn btn-success btn-block">Update</button>
                            </div>
                        </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <!-- spacing -->
        </div>
    </div>
</div>

<?php
    include('includes/footer.php');
?>