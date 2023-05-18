<?php 
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Search Purpose</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="h6">Purpose ID</p>
                                    <input type="text" name="search_purpose_id" value="<?php if (isset($_GET['search_purpose_id'])) {echo $_GET['search_purpose_id']; } ?>" class="form-control" placeholder="Enter Purpose ID" >
                                </div>
                                <div class="col-sm-5">
                                    <p class="h6">Purpose Classification</p>
                                    <input type="text" name="search_purpose_name" value="<?php if (isset($_GET['search_purpose_name'])) {echo $_GET['search_purpose_name']; } ?>" class="form-control" placeholder="Enter Purpose Name">
                                </div>
                                <div class="col-sm-3">
                                    <p class="h6">Department Initial</p>
                                    <input type="text" name="search_dept_init" value="<?php if (isset($_GET['search_dept_init'])) {echo $_GET['search_dept_init']; } ?>" class="form-control" placeholder="Enter Department Initial">
                                </div>
                                <div class="col-sm-1 text-center">
                                    <p class="h6">&nbsp</p>
                                    <button type="submit" class="btn btn-primary">Search</button>
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
                <h4>Purpose Details 
                    <a href="add-purpose.php" class = "btn btn-success float-end">Add Purpose</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>Purpose ID</th>
                            <th>Purpose Name or Classification</th>
                            <th>Department Initial</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php
                            $searched_purpose_id = $_GET['search_purpose_id'];
                            $searched_purpose_name = $_GET['search_purpose_name'];
                            $searched_dept_init = $_GET['search_dept_init'];

                            if (!$searched_purpose_id and !$searched_purpose_name and !$searched_dept_init) {
                                $query = "SELECT * FROM purpose";
                            } else if ($searched_purpose_id and !$searched_purpose_name and !$searched_dept_init) {
                                $query = "SELECT * FROM purpose WHERE purpose_id LIKE '%$searched_purpose_id%' ";
                            } else if (!$searched_purpose_id and $searched_purpose_name and !$searched_dept_init) {
                                $query = "SELECT * FROM purpose WHERE purpose_name LIKE '%$searched_purpose_name%' ";
                            } else if (!$searched_purpose_id and !$searched_purpose_name and $searched_dept_init) {
                                $query = "SELECT * FROM purpose WHERE dept_init LIKE '%$searched_dept_init%' ";
                            } else if ($searched_purpose_id and $searched_purpose_name and !$searched_dept_init) {
                                $query = "SELECT * FROM purpose WHERE purpose_id LIKE '%$searched_purpose_id%' AND purpose_name LIKE '%$searched_purpose_name%' ";
                            } else if (!$searched_purpose_id and $searched_purpose_name and $searched_dept_init) {
                                $query = "SELECT * FROM purpose WHERE purpose_name LIKE '%$searched_purpose_name%' AND dept_init LIKE '%$searched_dept_init%' ";
                            } else if ($searched_purpose_id and !$searched_purpose_name and $searched_dept_init) {
                                $query = "SELECT * FROM purpose WHERE purpose_id LIKE '%$searched_purpose_id%' AND dept_init LIKE '%$searched_dept_init%' ";
                            } else {
                                $query = "SELECT * FROM purpose WHERE purpose_id LIKE '%$searched_purpose_id%' AND purpose_name LIKE '%$searched_purpose_name%' AND dept_init LIKE '%$searched_dept_init%' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $purpose) {
                                    ?>
                                    <tr>
                                        <td> <?= $purpose['purpose_id']; ?> </td>
                                        <td> <?= $purpose['purpose_name']; ?> </td>
                                        <td> <?= $purpose['dept_init']; ?> </td>
                                        <td>
                                            <a href="update-purpose.php?purpose_id=<?= $purpose['purpose_id']; ?>" class="btn btn-warning stn-sm">Update</a>
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