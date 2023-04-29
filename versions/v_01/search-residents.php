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
        <div class="card mb-4">
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
                                <!-- <div class="col-sm-4">
                                    <p class="h6">Patient Mobile No</p>
                                    <input type="number" name="search_mobile_no" value="<?php if (isset($_GET['search_mobile_no'])) {echo $_GET['search_mobile_no']; } ?>" class="form-control" placeholder="Enter Mobile No">
                                </div> -->
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
                            <th>Mobile Number</th>
                            <th>Room Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            include "db-connect.php";

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
                                            <a href="generate-bill.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-warning stn-sm">Generate Bill</a>
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