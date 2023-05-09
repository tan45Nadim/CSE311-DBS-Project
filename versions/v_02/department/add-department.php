<?php
    session_start();
    include('../includes/header.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-12">
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
                        <input type="text" name = "dept_head_init" class="form-control" placeholder="Enter Initial of Department Head" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_department" class="btn btn-success">Confirm Department</button>
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