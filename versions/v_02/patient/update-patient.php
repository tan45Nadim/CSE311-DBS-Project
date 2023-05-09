<?php
    session_start();
    require ('../roots/db-connect.php');
    include('../includes/header.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md12">
        <div class="card">
            <div class="card-header">
                <h4>Update Patient
                    <a href="search-patient.php" class = "btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">

            <?php
                if (isset($_GET['p_id'])) {
                    $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                    $query = "SELECT * FROM patient where p_id = '$p_id' ";
                    $query_run = mysqli_query($connect, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $p_arr = mysqli_fetch_array($query_run);
                        
                        ?>
                        <form action="../roots/source-codes.php" method="POST">
                            <input type="hidden" name = "p_id" value="<?= $p_arr['p_id'] ?>">                                    

                            <div class="mb-3">
                                <label>Patient Name</label>
                                <input type="text" name = "p_name" class="form-control" value="<?= $p_arr['p_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Patient Age</label>
                                <input type="number" name = "p_age" class="form-control" value="<?= $p_arr['p_age'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Patient Sex</label>
                                <input type="text" name = "p_sex" class="form-control" value="<?= $p_arr['p_sex'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Patient Mobile Number</label>
                                <input type="number" name = "mobile_no" class="form-control" value="<?= $p_arr['mobile_no'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Patient Address</label>
                                <input type="text" name = "address" class="form-control" value="<?= $p_arr['address'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Patient Room Number</label>
                                <input type="text" name = "room_no" class="form-control" value="<?= $p_arr['room_no'] ?>">
                            </div> 
                            <div class="mb-3">
                                <button type="submit" name="update_patient" class="btn btn-primary">Update Patient</button>
                            </div>
                        </form>                                
                        <?php

                    } else {
                        echo "<h4>No Such Patient Found!</h4>";
                    }
                } else {
                    echo "<h4>No ID is Assigned to Update!</h4>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php
    include('../includes/footer.php');
?>