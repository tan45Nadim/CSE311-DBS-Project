<?php
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<?php
    if (isset($_GET['p_id'])) {
        $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
        $query = "SELECT (COUNT(visit_count) + 1) AS visit_count FROM payment_history where p_id = '$p_id' ";
        $query_run = mysqli_query($connect, $query);

        $count = mysqli_fetch_assoc($query_run);
        $v_cnt = $count['visit_count'];
    }
?>

<div class="container mt-5">
<div class="row">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header">
                <h4>Bill Generation
                    <a href="../payment/search-residents.php" class = "btn btn-danger float-end">Residents</a>
                </h4>
            </div>
            <div class="card-body p-4">
                <div id="show_alert"> </div> <!-- alert-change  -->
                
                <form action="../roots/source-codes.php" method="POST">
                    <div class="row">
                        <div class="col-md-3 mb-3"> </div>
                        <div class="col-md-3 mb-3">
                            <p class="h6">Visit Count</p>
                            <input type="number" name="visit_count" class="form-control" value="<?=$v_cnt?>" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <p class="h6">Patient ID</p>
                            <input type="number" name="p_id" class="form-control" value="<?=$_GET['p_id'] ?>" readonly>
                        </div>
                        <div class="col-md-3 mb-3"> </div>
                    </div>

                    <div class="row mb-3"> </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <p class="h6">Purpose ID</p>
                            <input type="text" name="purpose_id" class="form-control" placeholder="Enter Purpose ID" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <p class="h6">Doctor Initial</p>
                            <input type="text" name="assign_dr_init" class="form-control" placeholder="Enter Doctor Initial" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <p class="h6">Date of Admission</p>
                            <input type="text" name="admission_date" class="form-control" placeholder="Enter Date of Admission" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <p class="h6">Date of Release</p>
                            <input type="text" name="release_date" class="form-control" placeholder="Enter Date of Release" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <p class="h6">Note</p>
                            <input type="text" name="note" class="form-control" placeholder="Write Comments Regarding the Patient (Optional)">
                        </div>
                    </div>

                    <div>
                        <input type="submit" name="payment_history" value="Add Visit History" class="btn btn-primary w-25">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="row mb-4">
            <div class="card">
                <table class="table table-bordered table-striped mt-3">
                    <thead align="center">
                        <tr>
                            <th>Purpose ID</th>
                            <th>Purpose Name</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            
                            $query = "SELECT * FROM purpose";
                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $purpose) {
                                    ?>
                                    <tr>
                                        <td> <?= $purpose['purpose_id']; ?> </td>
                                        <td> <?= $purpose['purpose_name']; ?> </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="2">No Record Found!</td>
                                    </tr>
                                <?php
                            }
                        ?>
                    </tbody>                   
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="row mb-3">
            <div class="card">
                <table class="table table-bordered table-striped mt-3">
                    <thead align="center">
                        <tr>
                            <th>Dr Initial</th>
                            <th>Doctor Name</th>
                        </tr>
                    </thead>
                    <tbody >  
                        <?php
                            
                            $query = "SELECT * FROM doctor";
                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $doctor) {
                                    ?>
                                    <tr>
                                        <td> <?= $doctor['dr_init']; ?> </td>
                                        <td> <?= $doctor['dr_name']; ?> </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="2">No Record Found!</td>
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