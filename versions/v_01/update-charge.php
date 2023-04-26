<?php
    error_reporting(0);
    session_start();
    require 'db-connect.php';
    include('includes/header.php');
?>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Charge
                        <a href="search-charge.php" class = "btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                <?php
                    if (isset($_GET['charge_num'])) {
                        $charge_num = mysqli_real_escape_string($connect, $_GET['charge_num']);
                        $query = "SELECT * FROM charge_sheet where charge_num = '$charge_num' ";
                        $query_run = mysqli_query($connect, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $charge_arr = mysqli_fetch_array($query_run);
                            
                            ?>
                            <form action="source-codes.php" method="POST">
                                <input type="hidden" name = "charge_num" value="<?= $charge_arr['charge_num'] ?>">                                    

                                <div class="mb-3">
                                    <label>Charge Name</label>
                                    <input type="text" name = "charge_name" class="form-control" value="<?= $charge_arr['charge_name'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Charge Amount</label>
                                    <input type="number" name = "amount" class="form-control" value="<?= $charge_arr['amount'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="update_charge" class="btn btn-primary">Update Charge</button>
                                </div>
                            </form>                                
                            <?php

                        } else {
                            echo "<h4>No Such Charge Found!</h4>";
                        }  
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    include('includes/footer.php');
?>