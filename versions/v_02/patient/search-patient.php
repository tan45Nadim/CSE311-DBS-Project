<?php 
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include ('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Search Patient</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="h6">Patient ID</p>
                                    <input type="number" name="search_p_id" value="<?php if (isset($_GET['search_p_id'])) {echo $_GET['search_p_id']; } ?>" class="form-control" placeholder="Enter ID" >
                                </div>
                                <div class="col-sm-4">
                                    <p class="h6">Patient Name</p>
                                    <input type="text" name="search_p_name" value="<?php if (isset($_GET['search_p_name'])) {echo $_GET['search_p_name']; } ?>" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="col-sm-4">
                                    <p class="h6">Patient Mobile No</p>
                                    <input type="number" name="search_mobile_no" value="<?php if (isset($_GET['search_mobile_no'])) {echo $_GET['search_mobile_no']; } ?>" class="form-control" placeholder="Enter Mobile No">
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
                <h4>Patient Details 
                    <a href="admit-patient.php" class = "btn btn-success float-end">Admit Patient</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Mobile Number</th>
                            <th>isAdmitted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            $searched_id = $_GET['search_p_id'];
                            $searched_name = $_GET['search_p_name'];
                            $searched_mobile_no = $_GET['search_mobile_no'];

                            if (!$searched_id and !$searched_name and !$searched_mobile_no) {
                                $query = "SELECT * FROM patient";
                            } else if ($searched_id and !$searched_name and !$searched_mobile_no) {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id";
                            } else if (!$searched_id and $searched_name and !$searched_mobile_no) {
                                $query = "SELECT * FROM patient WHERE p_name LIKE '%$searched_name%' ";
                            } else if (!$searched_id and !$searched_name and $searched_mobile_no) {
                                $query = "SELECT * FROM patient WHERE mobile_no LIKE '%$searched_mobile_no%' ";
                            } else if ($searched_id and $searched_name and !$searched_mobile_no) {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id AND p_name LIKE '%$searched_name%' ";
                            } else if (!$searched_id and $searched_name and $searched_mobile_no) {
                                $query = "SELECT * FROM patient WHERE p_name LIKE '%$searched_name%' AND mobile_no LIKE '%$searched_mobile_no%' ";
                            } else if ($searched_id and !$searched_name and $searched_mobile_no) {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id AND mobile_no LIKE '%$searched_mobile_no%' ";
                            } else {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id AND p_name LIKE '%$searched_name%' AND mobile_no LIKE '%$searched_mobile_no%' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $patient) {
                                    ?>
                                    <tr>
                                        <td> <?= $patient['p_id']; ?> </td>
                                        <td> <?= $patient['p_name']; ?> </td>
                                        <td> <?= $patient['p_age']; ?> </td>

                                        <?php if($patient['p_sex'] == 'M' or $patient['p_sex'] == 'm'): ?>
                                            <td>Male</td>
                                        <?php elseif ($patient['p_sex'] == 'F' or $patient['p_sex'] == 'f'): ?>
                                            <td>Female</td>
                                        <?php else: ?>
                                            <td>Fix</td>
                                        <?php endif; ?>

                                        <td> <?= $patient['mobile_no']; ?> </td>

                                        <?php if($patient['isResident'] == '1'): ?>
                                            <td>Yes</td>
                                        <?php else: ?>
                                            <td>No</td>
                                        <?php endif; ?>

                                        <td>
                                            <a href="../patient/view-patient.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-info btn-sm" style="width:30%">View</a>

                                            <?php if($patient['isResident'] == '1'): ?>
                                                <a href="../patient/update-patient.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-warning btn-sm" style="width:30%">Update</a>
                                            <?php else: ?>
                                                <a href="../patient/update-patient.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-success btn-sm" style="width:30%">Re Admit</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="9">No Record Found!</td>
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