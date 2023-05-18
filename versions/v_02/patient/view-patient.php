<?php
    error_reporting(0);
    session_start();
    include('../roots/db-connect.php');
    include('../includes/header.php');
?> 

<?php
    if (isset($_GET['p_id'])) {
        $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
        $query = "SELECT * FROM patient where p_id = '$p_id' ";
        $query_run_patient = mysqli_query($connect, $query);

        $patientTuple = mysqli_fetch_assoc($query_run_patient);

        $query = "SELECT payment_history.p_id, payment_history.visit_count, purpose_name,
                    (SELECT SUM(amount * time_count)
                    FROM patient_record, charge_sheet
                    WHERE payment_history.p_id = patient_record.p_id
                    AND payment_history.visit_count = patient_record.visit_count 
                    AND patient_record.history = charge_sheet.charge_num
                    AND payment_history.p_id = '$p_id') AS total
                FROM payment_history, purpose
                WHERE payment_history.purpose_id = purpose.purpose_id
                AND payment_history.p_id = '$p_id'; ";
        $query_run_payment = mysqli_query($connect, $query);
    }
?>

<div class="container mt-5">
    <div class="row">
       <div class="col-md-2"> </div> 
       <div class="col-md-8">
        <?php include ('../roots/message.php'); ?>
        <div class="card shadow">
            <div class="card-header">
                <h4>View Patient
                    <a href="search-patient.php" class = "btn btn-success float-end">Patients' List</a>
                </h4>
            </div>
            <div class="card-body">
                <div class="show_alert mb-2"> </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p class="h6">Name</p>
                        <input type="text" name="p_name" class="form-control" value="<?=$patientTuple['p_name'] ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="h6">ID</p>
                        <input type="number" name="p_id" class="form-control" value="<?=$_GET['p_id'] ?>" readonly>  
                    </div>
                    <div class="col-md-3 mb-2">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <p class="h6">Mobile</p>
                        <input type="text" name="mobile_no" class="form-control" value="<?=$patientTuple['mobile_no'] ?>" readonly>
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="h6">Age</p>
                        <input type="number" name="p_age" class="form-control" value="<?=$patientTuple['p_age'] ?>" readonly>  
                    </div>
                    <div class="col-md-3 mb-2">
                        <p class="h6">Sex</p>
                        <?php if($patientTuple['p_sex'] == 'M' or $patientTuple['p_sex'] == 'm'): ?>
                            <input type="text" name="p_sex" class="form-control" value="Male" readonly>
                        <?php elseif ($patientTuple['p_sex'] == 'F' or $patientTuple['p_sex'] == 'f'): ?>
                            <input type="text" name="p_sex" class="form-control" value="Female" readonly>
                        <?php else: ?>
                            <input type="text" name="p_sex" class="form-control" value="Not Given" readonly>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12 mb-2">
                        <p class="h6">Address</p>
                        <input type="text" name="address" class="form-control" value="<?=$patientTuple['address'] ?>" readonly>
                    </div>
                </div>
                
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>Visit Count</th>
                            <th>Purpose</th>
                            <th>Doctor Name</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Action</th>                            
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php
                            if (mysqli_num_rows($query_run_payment) > 0) {
                                foreach ($query_run_payment as $info) {
                                    ?>
                                    <tr>
                                        <td> <?= $info['visit_count'] ?> </td>
                                        <td> <?= $info['purpose_name'] ?> </td>
                                        <td> 
                                            <?php
                                                $v_cnt = $info['visit_count'];
                                                $query = "SELECT dr_name
                                                        FROM payment_history, doctor
                                                        WHERE payment_history.assign_dr_init = doctor.dr_init
                                                        AND p_id = '$p_id' AND visit_count = '$v_cnt' ";
                                                
                                                $query_run_dr = mysqli_query($connect, $query);
                                                $drName = mysqli_fetch_assoc($query_run_dr);
                                            ?>
                                            <?php  if ($drName['dr_name']):?>
                                                <?= $drName['dr_name'] ?>
                                            <?php  else:?>
                                                Doctor Not Found
                                            <?php endif; ?>
                                        </td>
                                        <td> <?= $info['total'] ?> </td>

                                        <?php
                                            $v_cnt = $info['visit_count'];
                                            $query = "SELECT (payable_amount - paid) AS paid
                                                FROM payment_history
                                                WHERE p_id = '$p_id' AND visit_count = '$v_cnt' ";

                                            $query_run_paid = mysqli_query($connect, $query);
                                            $paidAmount = mysqli_fetch_assoc($query_run_paid);
                                        ?>

                                        <?php if($paidAmount['paid'] == 0): ?>
                                            <td> Paid </td>
                                        <?php elseif($paidAmount['paid'] > 0): ?>
                                            <td> Due </td>
                                        <?php else: ?>
                                            <td> Advanced </td>
                                        <?php endif; ?>

                                        <td> 
                                            <a href="../payment/generate-receipt.php?p_id=<?=$p_id?>&visit_count=<?=$v_cnt?>" class="btn btn-info btn-sm">Record</a>
                                        </td>
                                        
                                    </tr>

                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="6">No Record Found!</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
       </div>
       <div class="col-md-2"> </div>
    </div>
</div>

<?php
    include('../includes/footer.php');
?>