<?php 
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include ('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Search Charges</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-4"> </div>
                                <div class="col-sm-3">
                                    <p class="h6">Charge Number</p>
                                    <input type="text" name="search_charge_num" value="<?php if (isset($_GET['search_charge_num'])) {echo $_GET['search_charge_num']; } ?>" class="form-control" placeholder="Enter Charge Number" >
                                </div>
                                <div class="col-sm-4">
                                    <p class="h6">Charge Name</p>
                                    <input type="text" name="search_charge_name" value="<?php if (isset($_GET['search_charge_name'])) {echo $_GET['search_charge_name']; } ?>" class="form-control" placeholder="Enter Charge Name">
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
                <h4>Charge Details 
                    <a href="../charge/add-charge.php" class = "btn btn-success float-end">Add Charge</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>Charge Number</th>
                            <th>Charge Name</th>
                            <th>Amount (BDT)</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            $searched_charge_num = $_GET['search_charge_num'];
                            $searched_charge_name = $_GET['search_charge_name'];

                            if (!$searched_charge_num and !$searched_charge_name) {
                                $query = "SELECT * FROM charge_sheet";
                            } else if ($searched_charge_num and !$searched_charge_name) {
                                $query = "SELECT * FROM charge_sheet WHERE charge_num LIKE '%$searched_charge_num%' ";
                            } else if (!$searched_charge_num and $searched_charge_name) {
                                $query = "SELECT * FROM charge_sheet WHERE charge_name LIKE '%$searched_charge_name%' ";
                            } else {
                                $query = "SELECT * FROM charge_sheet WHERE charge_num LIKE '%$searched_charge_num%' AND charge_name LIKE '%$searched_charge_name%' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $charge) {
                                    ?>
                                    <tr>
                                        <td> <?= $charge['charge_num']; ?> </td>
                                        <td> <?= $charge['charge_name']; ?> </td>
                                        <td> <?= $charge['amount']; ?> </td>
                                        <td>
                                            <a href="../charge/update-charge.php?charge_num=<?= $charge['charge_num']; ?>" class="btn btn-warning stn-sm">Update</a>
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