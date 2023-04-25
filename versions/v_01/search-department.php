<?php 
    error_reporting(0);
    session_start();
    include('includes/header.php');
?>

<div class="container mt-5">
<?php
    include ('message.php');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Search Department</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-4">

                                </div>
                                <div class="col-sm-3">
                                    <p class="h6">Department Initial</p>
                                    <input type="text" name="search_dept_init" value="<?php if (isset($_GET['search_dept_init'])) {echo $_GET['search_dept_init']; } ?>" class="form-control" placeholder="Enter Department Initial" >
                                </div>
                                <div class="col-sm-4">
                                    <p class="h6">Department Name</p>
                                    <input type="text" name="search_dept_name" value="<?php if (isset($_GET['search_dept_name'])) {echo $_GET['search_dept_name']; } ?>" class="form-control" placeholder="Enter Department Name">
                                </div>
                                <div class="col-sm-1 text-center">
                                    <p class="h6">&nbsp</p>
                                    <button type="submit" class="btn btn-primary">Search</button>
                                    <!-- <input type="reset" class="btn btn-secondary"></button> -->
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Department Details 
                    <a href="add-department.php" class = "btn btn-success float-end">Add Department</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>Department Initial</th>
                            <th>Department Name</th>
                            <th>Room No</th>
                            <th>Department Head</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            include "db-connect.php";

                            $searched_dept_init = $_GET['search_dept_init'];
                            $searched_dept_name = $_GET['search_dept_name'];

                            if (!$searched_dept_init and !$searched_dept_name) {
                                $query = "SELECT * FROM department";
                            } else if ($searched_dept_init and !$searched_dept_name) {
                                $query = "SELECT * FROM department WHERE dept_init LIKE '%$searched_dept_init%' ";
                            } else if (!$searched_dept_init and $searched_dept_name) {
                                $query = "SELECT * FROM department WHERE dept_name LIKE '%$searched_dept_name%' ";
                            } else {
                                $query = "SELECT * FROM department WHERE dept_init LIKE '%$searched_dept_init%' AND dept_name LIKE '%$searched_dept_name%' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $department) {
                                    ?>
                                    <tr>
                                        <td> <?= $department['dept_init']; ?> </td>
                                        <td> <?= $department['dept_name']; ?> </td>
                                        <td> <?= $department['room_no']; ?> </td>
                                        <td> <?= $department['dept_head_init']; ?> </td>
                                        <td>
                                            <a href="update-department.php?dept_init=<?= $department['dept_init']; ?>" class="btn btn-warning stn-sm">Update</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="4">No Record Found!</td>
                                    </tr>
                                <?php
                            }

                        ?>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>                   
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php
    include('includes/footer.php');
?>