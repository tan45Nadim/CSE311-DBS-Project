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
                    <a href="../patient/seach-patient.php" class = "btn btn-success float-end">Patients List</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center"class="text-center">Name</th>
                            <th class="text-center">Mobile Number</th>
                            <th class="text-center">Room Number</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            $searched_id = $_GET['search_p_id'];
                            $searched_name = $_GET['search_p_name'];

                            if (!$searched_id and !$searched_name) {
                                $query = "SELECT * FROM patient WHERE isResident = '1' ";
                            } else if ($searched_id and !$searched_name) {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id AND isResident = '1' ";
                            } else if (!$searched_id and $searched_name) {
                                $query = "SELECT * FROM patient WHERE p_name LIKE '%$searched_name%' AND isResident = '1'";
                            } else {
                                $query = "SELECT * FROM patient WHERE p_id = $searched_id AND p_name LIKE '%$searched_name%' AND isResident = '1' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $patient) {
                                    ?>
                                    <tr>
                                        <td> <?= $patient['p_id']; ?> </td>
                                        <td> <?= $patient['p_name']; ?> </td>                                       
                                        <td> <?= $patient['mobile_no']; ?> </td>
                                        <td> <?= $patient['room_no']; ?> </td>
                                        <td>
                                        <a href="../payment/generate-bill.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-primary stn-sm">Generate Bill</a>
                                        <a href="../payment/include-discount.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-info stn-sm">Payment</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="5">No Record Found!</td>
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
