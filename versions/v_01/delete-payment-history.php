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
                <h4>Search Patient</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-7"></div>
                                <div class="col-sm-4">
                                    <p class="h6">Patient ID</p>
                                    <input type="number" name="search_p_id" value="<?php if (isset($_GET['search_p_id'])) {echo $_GET['search_p_id']; } ?>" class="form-control" placeholder="Enter ID" >
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
                            <th>Visit Count</th>
                            <th>ID</th>
                            <th>Purpose</th>
                            <th>Payable Amount</th>
                            <th>Paid</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            include "db-connect.php";

                            $searched_id = $_GET['search_p_id'];

                            $query = "SELECT visit_count, p_id, purpose_name, payable_amount, paid
                                    FROM payment_history, purpose
                                    WHERE payment_history.purpose_id = purpose.purpose_id";

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $patient) {
                                    ?>
                                    <tr>
                                        <td> <?= $patient['visit_count']; ?> </td>
                                        <td> <?= $patient['p_id']; ?> </td>
                                        <td> <?= $patient['purpose_name']; ?> </td>
                                        <td> <?= $patient['payable_amount']; ?> </td>
                                        <td> <?= $patient['paid']; ?> </td>
                                        <td>
                                            <a href="view-patient.php?p_id=<?= $patient['p_id']; ?>" class="btn btn-info btn-sm">View</a>
                                            <form action="source-codes.php" method="POST" class="d-inline">
                                                <input type="hidden" name="p_id" value="<?= $patient['p_id']; ?>">
                                                <input type="hidden" name="visit_count" value="<?= $patient['visit_count']; ?>">
                                                <button type="submit" name="delete_payment_history" value="<?=$patient['p_id'];?>" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="6">No Record Found!</td>
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