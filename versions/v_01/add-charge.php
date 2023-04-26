<?php
    session_start();
    include('includes/header.php');
?>

<div class="container mt-5">

<?php include('message.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Charge
                    <a href="search-charge.php" class = "btn btn-info float-end">Charges List</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="source-codes.php" method="POST">
                    <div class="mb-3">
                        <label>Charge Number</label>
                        <input type="text" name = "charge_num" class="form-control" placeholder="Enter Charge Number" required>
                    </div>
                    <div class="mb-3">
                        <label>Charge Name</label>
                        <input type="text" name = "charge_name" class="form-control" placeholder="Enter Charge Name" required>
                    </div>
                    <div class="mb-3">
                        <label>Charge Amount</label>
                        <input type="number" name = "amount" class="form-control" placeholder="Enter Charge Amount" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_charge" class="btn btn-success">Confirm Charge</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php
    include('includes/footer.php');
?>