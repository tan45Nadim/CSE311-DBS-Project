<?php
    error_reporting(0);
    session_start();
    include('../includes/header.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Doctor
                    <a href="search-doctor.php" class = "btn btn-info float-end">Doctor List</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="../roots/source-codes.php" method="POST">
                    <div class="mb-3">
                        <label>Doctor Initial</label>
                        <input type="text" name = "dr_init" class="form-control" placeholder="Enter Doctor Initial" required>
                    </div>
                    <div class="mb-3">
                        <label>Doctor Name</label>
                        <input type="text" name = "dr_name" class="form-control" placeholder="Enter Doctor Name" required>
                    </div>
                    <div class="mb-3">
                        <label>Department Initial</label>
                        <input type="text" name = "dept_init" class="form-control" placeholder="Enter Department Initial" required>
                    </div>
                    <div class="mb-3">
                        <label>Room Number</label>
                        <input type="text" name = "room_no" class="form-control" placeholder="Enter Room Number" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_doctor" class="btn btn-success">Confirm Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php
    include('../includes/footer.php');
?>