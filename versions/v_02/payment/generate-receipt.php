<?php
    error_reporting(0);
    include ('../roots/db-connect.php');
    include('../includes/header.php');
?>

<?php
    if (!$_GET['visit_count']) {
        if (isset($_GET['p_id'])) {
            $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
            $query = "SELECT COUNT(visit_count) visit_count FROM payment_history where p_id = '$p_id' ";
            $query_run_visit = mysqli_query($connect, $query);

            $visitTuple = mysqli_fetch_assoc($query_run_visit);
            $v_cnt = $visitTuple['visit_count'];
        }
    } else {
        $v_cnt = $_GET['visit_count'];
    }

    if (isset($_GET['p_id'])) {
        $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
        $query = "SELECT discount_pct FROM payment_history where p_id = '$p_id' AND 
                visit_count = '$v_cnt' ";
        $query_run_disc = mysqli_query($connect, $query);

        $discTuple = mysqli_fetch_assoc($query_run_disc);
        $discount = $discTuple['discount_pct'];

        // all-patient-tuples
        $query = "SELECT * FROM patient where p_id = '$p_id' ";
        $query_run_patient = mysqli_query($connect, $query);

        $patientTuple = mysqli_fetch_assoc($query_run_patient);

        // all-payment-history
        $query = "SELECT * FROM payment_history where p_id = '$p_id' AND visit_count = '$v_cnt' ";
        $query_run_payment = mysqli_query($connect, $query);

        $paymentTuple = mysqli_fetch_assoc($query_run_payment);

        // purpose-name-dept-name
        $query = "SELECT purpose_name, dept_name
                FROM payment_history, purpose, department
                WHERE p_id = '$p_id' AND visit_count = '$v_cnt' AND payment_history.purpose_id = purpose.purpose_id 
                AND purpose.dept_init = department.dept_init; ";
        $query_run_purpose_dept = mysqli_query($connect, $query);

        $purposeDeptTuples = mysqli_fetch_assoc($query_run_purpose_dept);
    }

    // dr-name-rel-paymenthistory-doctor-table
    $query = "SELECT dr_name
        FROM payment_history, doctor
        WHERE p_id = '$p_id' AND visit_count = '$v_cnt' 
        AND payment_history.assign_dr_init = doctor.dr_init;";
    $query_run_dr = mysqli_query($connect, $query);

    $doctorTuple = mysqli_fetch_assoc($query_run_dr);

    // patient-record-AND-charge-sheet
    $query = "SELECT charge_sheet.charge_num, charge_sheet.charge_name, amount, time_count, (amount * time_count) AS subtotal
        FROM patient_record, charge_sheet
        WHERE p_id = '$p_id' AND visit_count = '$v_cnt' 
        AND patient_record.history = charge_sheet.charge_num;";

    $query_run_charges = mysqli_query($connect, $query);

    // count total
    $query = "SELECT SUM(amount * time_count) AS total
        FROM patient_record, charge_sheet
        WHERE p_id = '$p_id' AND visit_count = '$v_cnt' 
        AND patient_record.history = charge_sheet.charge_num;";

    $query_run_total = mysqli_query($connect, $query);
    $totalTuple = mysqli_fetch_assoc($query_run_total);

    // payable-paid
    $query = "SELECT payable_amount, paid
            FROM payment_history
            WHERE p_id = '$p_id' and visit_count = '$v_cnt' ";

    $query_run_payable_paid = mysqli_query($connect, $query);
    $payablePaidTuple = mysqli_fetch_assoc($query_run_payable_paid);


    // due
    $query = "SELECT (payable_amount - paid) due
        FROM payment_history
        WHERE p_id = '$p_id' and visit_count = '$v_cnt' ";

    $query_run_due = mysqli_query($connect, $query);
    $dueTuple = mysqli_fetch_assoc($query_run_due);
?>


<div class="container mt-5">
    <div class="row">
        <div class="col-md-2"> </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Payment Review
                        <a href="" class = "btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div id="show_alert"> </div> <!-- alert-change -->
                    <form action="../roots/source-codes.php" method="POST">
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

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p class="h6">Name</p>
                                <input type="text" name="p_name" class="form-control" value="<?=$patientTuple['p_name'] ?>" readonly>
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="h6">Age</p>
                                <input type="number" name="p_age" class="form-control" value="<?=$patientTuple['p_age'] ?>" readonly>  
                            </div>
                            <div class="col-md-3 mb-2">
                                <p class="h6">Sex</p>
                                <input type="text" name="p_sex" class="form-control" value="<?=$patientTuple['p_sex'] ?>" readonly>  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p class="h6">Date of Admission</p>
                                <input type="text" name="admission_date" class="form-control" value="<?=$paymentTuple['admission_date'] ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="h6">Date of Release</p>
                                <input type="text" name="release_date" class="form-control" value="<?=$paymentTuple['release_date'] ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p class="h6">Purpose Name</p>
                                <input type="text" name="purpose_name" class="form-control" value="<?=$purposeDeptTuples['purpose_name'] ?>" readonly>  
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="h6">Doctor Name</p>
                                <?php  if ($doctorTuple['dr_name']):?>
                                    <input type="text" name="dr_name" class="form-control" value="<?=$doctorTuple['dr_name']?>" readonly>
                                <?php  else:?>
                                    <input type="text" name="dr_name" class="form-control" value="Doctor Not Found" readonly>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <p class="h6">Department Name</p>
                                <input type="name" name="dept_name" class="form-control" value="<?=$purposeDeptTuples['dept_name'] ?>" readonly>  
                            </div>
                            <div class="col-md-6"> </div>
                        </div>
                            
                        <table class="table table-bordered table-striped">
                            <thead align="center">
                                <tr>
                                    <th>Charge Number</th>
                                    <th>Charge Name</th>
                                    <th>Amount (BDT)</th>
                                    <th>Time Count</th>
                                    <th>Subtotal (BDT)</th>
                                </tr>
                            </thead>
                            <tbody align="center">  
                                <?php
                                    if (mysqli_num_rows($query_run_charges) > 0) {
                                        foreach ($query_run_charges as $charge) {
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
                            </tbody>                   
                        </table>

                        <div class="row mb-2"> </div>

                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <p class="h6">Total Amount (BDT)</p>
                                <input type="number" name="total_amount" class="form-control" value="<?=$totalTuple['total']?>" readonly>
                            </div>
                            <div class="col-md-2 mb-3"> </div>

                            <div class="col-md-2 mb-3">
                                <p class="h6">Discount (%)</p>
                                <input type="number" name="discount_pct" class="form-control" value="<?=$discount?>" readonly>
                            </div>
                            <div class="col-md-3 mb-3">
                                <p class="h6">After Discount (BDT)</p>
                                <input type="number" name="payable_amount" class="form-control" value="<?=$payablePaidTuple['payable_amount']?>" readonly>
                            </div>
                        </div>

                        <div class="row mb-6">
                            <div class="col-md-2 mb-3"></div>

                            <div class="col-md-3 mb-3">
                                <p class="h6">Paid (BDT)</p>
                                <input type="number" name="paid_amount" class="form-control mb-3" value="<?=$payablePaidTuple['paid']?>" readonly>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <p class="h6">Due (BDT)</p>
                                <input type="number" name="due_amount" class="form-control mb-3"  value="<?=$dueTuple['due']?>" readonly>
                            </div>

                            <div class="col-md-4 mb-3">
                                <p class="h6">&nbsp</p>
                                <a href="update-payment.php?p_id=<?=$p_id?>&visit_count=<?=$v_cnt?>" class="btn btn-success">Update Payment</a>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2"> </div>
    </div>
</div>

<?php
    include('../includes/footer.php');
?>