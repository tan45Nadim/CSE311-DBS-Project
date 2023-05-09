<?php
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md12">
        <div class="card">
            <div class="card-header">
                <h4>Update Doctor
                    <a href="search-doctor.php" class = "btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
            <?php
                if (isset($_GET['dr_init'])) {
                    $dr_init = mysqli_real_escape_string($connect, $_GET['dr_init']);
                    $query = "SELECT * FROM doctor where dr_init = '$dr_init' ";
                    $query_run = mysqli_query($connect, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $doctor_arr = mysqli_fetch_array($query_run);
                        ?>
                        <form action="../roots/source-codes.php" method="POST">
                            <input type="hidden" name = "dr_init" value="<?= $doctor_arr['dr_init'] ?>">
                            <div class="mb-3">
                                <label>Doctor Name</label>
                                <input type="text" name = "dr_name" class="form-control" value="<?= $doctor_arr['dr_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Depeartment Initial</label>
                                <input type="text" name = "dept_init" class="form-control" value="<?= $doctor_arr['dept_init'] ?>" required>
                            </div> 
                            <div class="mb-3">
                                <label>Room Number</label>
                                <input type="text" name = "room_no" class="form-control" value="<?= $doctor_arr['room_no'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="update_doctor" class="btn btn-primary">Update Doctor</button>
                            </div>
                        </form>                                
                        <?php
                    } else {
                        echo "<h4>No Such Doctor Found!</h4>";
                    }
                } else {
                    echo "<h4>No Doctor Found to Update!</h4>";
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