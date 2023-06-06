<?php
    error_reporting(0);
    session_start();
    require '../roots/db-connect.php';
    include('../includes/header.php');
?>

<div class="container mt-5">
<?php include('../roots/message.php'); ?>
<div class="row">
    <div class="col-md-8">
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
                                <input type="text" name = "room_no" class="form-control" value="<?= $dept_arr['room_no'] ?>" readonly>
                            </div> 
                            <div class="mb-3">
                                <label>Head of Depeartment</label>
                                <input type="text" name = "dept_head_init" class="form-control" value="<?= $dept_arr['dept_head_init'] ?>" required>
                            </div> 
                            <div class="mb-3">
                                <button type="submit" name="update_department" class="btn btn-success">Update Department</button>
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

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Doctor Details </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>Doctor Initial</th>
                            <th>Doctor Name</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            if (isset($_GET['dept_init'])) {
                                $dept_init = mysqli_real_escape_string($connect, $_GET['dept_init']);
                            }
                            
                            $query = "SELECT * FROM doctor WHERE dept_init = '$dept_init'; ";
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