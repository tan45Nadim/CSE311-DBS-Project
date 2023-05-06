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
                <h4>Search Doctor</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="h6">Doctor Initial</p>
                                    <input type="text" name="search_dr_init" value="<?php if (isset($_GET['search_dr_init'])) {echo $_GET['search_dr_init']; } ?>" class="form-control" placeholder="Enter Doctor Initial" >
                                </div>
                                <div class="col-sm-5">
                                    <p class="h6">Doctor Name</p>
                                    <input type="text" name="search_dr_name" value="<?php if (isset($_GET['search_dr_name'])) {echo $_GET['search_dr_name']; } ?>" class="form-control" placeholder="Enter Doctor Name">
                                </div>
                                <div class="col-sm-3">
                                    <p class="h6">Department Initial</p>
                                    <input type="text" name="search_dept_init" value="<?php if (isset($_GET['search_dept_init'])) {echo $_GET['search_dept_init']; } ?>" class="form-control" placeholder="Enter Department Initial">
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
                <h4>doctor Details 
                    <a href="add-doctor.php" class = "btn btn-success float-end">Add Doctor</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>Doctor Initial</th>
                            <th>Doctor Name</th>
                            <th>Department Initial</th>
                            <th>Room Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            include "db-connect.php";

                            $searched_dr_init = $_GET['search_dr_init'];
                            $searched_dr_name = $_GET['search_dr_name'];
                            $searched_dept_init = $_GET['search_dept_init'];

                            if (!$searched_dr_init and !$searched_dr_name and !$searched_dept_init) {
                                $query = "SELECT * FROM doctor";
                            } else if ($searched_dr_init and !$searched_dr_name and !$searched_dept_init) {
                                $query = "SELECT * FROM doctor WHERE dr_init LIKE '%$searched_dr_init%' ";
                            } else if (!$searched_dr_init and $searched_dr_name and !$searched_dept_init) {
                                $query = "SELECT * FROM doctor WHERE dr_name LIKE '%$searched_dr_name%' ";
                            } else if (!$searched_dr_init and !$searched_dr_name and $searched_dept_init) {
                                $query = "SELECT * FROM doctor WHERE dept_init LIKE '%$searched_dept_init%' ";
                            } else if ($searched_dr_init and $searched_dr_name and !$searched_dept_init) {
                                $query = "SELECT * FROM doctor WHERE dr_init LIKE '%$searched_dr_init%' AND dr_name LIKE '%$searched_dr_name%' ";
                            } else if (!$searched_dr_init and $searched_dr_name and $searched_dept_init) {
                                $query = "SELECT * FROM doctor WHERE dr_name LIKE '%$searched_dr_name%' AND dept_init LIKE '%$searched_dept_init%' ";
                            } else if ($searched_dr_init and !$searched_dr_name and $searched_dept_init) {
                                $query = "SELECT * FROM doctor WHERE dr_init LIKE '%$searched_dr_init%' AND dept_init LIKE '%$searched_dept_init%' ";
                            } else {
                                $query = "SELECT * FROM doctor WHERE dr_init LIKE '%$searched_dr_init%' AND dr_name LIKE '%$searched_dr_name%' AND dept_init LIKE '%$searched_dept_init%' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $doctor) {
                                    ?>
                                    <tr>
                                        <td> <?= $doctor['dr_init']; ?> </td>
                                        <td> <?= $doctor['dr_name']; ?> </td>
                                        <td> <?= $doctor['dept_init']; ?> </td>
                                        <td> <?= $doctor['room_no']; ?> </td>
                                        <td>
                                            <!-- <a href="update-doctor.php?dr_init=<?= $doctor['dr_init'];?>" class="btn btn-warning stn-sm">Update</a> -->
                                            <form action="source-codes.php" method="POST">
                                                <button type="submit" name="delete_doctor" value="<?=$doctor['dr_init'];?>" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
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