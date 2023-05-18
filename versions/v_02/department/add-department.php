<?php
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Add Department
                    <a href="search-department.php" class = "btn btn-info float-end">Department List</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="../roots/source-codes.php" method="POST">
                    <div class="mb-3">
                        <label>Department Initial</label>
                        <input type="text" name = "dept_init" class="form-control" placeholder="Enter Department Initial" required>
                    </div>
                    <div class="mb-3">
                        <label>Department Name</label>
                        <input type="text" name = "dept_name" class="form-control" placeholder="Enter Department Name" required>
                    </div>
                    <div class="mb-3">
                        <label>Department Room</label>
                        <input type="text" name = "room_no" class="form-control" placeholder="Enter Department Room No" required>
                    </div>
                    <div class="mb-3">
                        <label>Department Head</label>
                        <input type="text" name = "dept_head_init" class="form-control" placeholder="Assign Depeartment Head From Update" readonly>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_department" class="btn btn-success">Confirm Department</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4" style="margin-top:340px">
        <div class="card">
            <div class="card-header">
                <h4>Available Rooms</h4>
            </div>
            <div class="card-body">
                <?php
                    $query = "SELECT room_no FROM hospital_room WHERE isAvailable = '1' AND (room_no LIKE 'AD%')";
                    $query_run_available_room = mysqli_query($connect, $query);

                    if (mysqli_num_rows($query_run_available_room) > 0) {
                        foreach ($query_run_available_room as $room) {
                            ?>
                                <?= $room['room_no'] ?>, &nbsp &nbsp                            
                            <?php
                        }
                    } else {
                        ?>
                           No Room Available.
                        <?php
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