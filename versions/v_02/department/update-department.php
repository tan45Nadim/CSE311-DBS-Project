<?php
    error_reporting(0);
    session_start();
    require '../roots/db-connect.php';
    include('../includes/header.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md12">
        <div class="card">
            <div class="card-header">
                <h4>Update Department
                    <a href="search-department.php" class = "btn btn-danger float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
            <?php
                if (isset($_GET['dept_init'])) {
                    $dept_init = mysqli_real_escape_string($connect, $_GET['dept_init']);
                    $query = "SELECT * FROM department where dept_init = '$dept_init' ";
                    $query_run = mysqli_query($connect, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $dept_arr = mysqli_fetch_array($query_run);
                        ?>
                        <form action="../roots/source-codes.php" method="POST">
                            <input type="hidden" name = "dept_init" value="<?= $dept_arr['dept_init'] ?>">
                            <div class="mb-3">
                                <label>Department Name</label>
                                <input type="text" name = "dept_name" class="form-control" value="<?= $dept_arr['dept_name'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label>Depeartment Room</label>
                                <input type="text" name = "room_no" class="form-control" value="<?= $dept_arr['room_no'] ?>" required>
                            </div> 
                            <div class="mb-3">
                                <label>Head of Depeartment</label>
                                <input type="text" name = "dept_head_init" class="form-control" value="<?= $dept_arr['dept_head_init'] ?>" required>
                            </div> 
                            <div class="mb-3">
                                <button type="submit" name="update_department" class="btn btn-primary">Update Purpose</button>
                            </div>
                        </form>                                
                        <?php

                    } else {
                        echo "<h4>No Such Department Found!</h4>";
                    }
                } else {
                    echo "<h4>No Such Department to Update!</h4>";
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