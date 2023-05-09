<?php
    session_start();
    include('../includes/header.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Purpose
                    <a href="search-purpose.php" class = "btn btn-info float-end">Purpose List</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="../roots/source-codes.php" method="POST">
                    <div class="mb-3">
                        <label>Purpose ID</label>
                        <input type="text" name = "purpose_id" class="form-control" placeholder="Enter Purpose ID" required>
                    </div>
                    <div class="mb-3">
                        <label>Purpose Name or Classification</label>
                        <input type="text" name = "purpose_name" class="form-control" placeholder="Enter Purpose Name or Classification" required>
                    </div>
                    <div class="mb-3">
                        <label>Department Initial</label>
                        <input type="text" name = "dept_init" class="form-control" placeholder="Enter Department Initial" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_purpose" class="btn btn-success">Confirm Purpose</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


<?php
    include('../includes/footer.php');
?>