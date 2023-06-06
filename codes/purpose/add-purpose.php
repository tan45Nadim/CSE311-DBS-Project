<?php
    session_start();
    include('../roots/db-connect.php');
    include('../includes/header.php');
?>

<div class="container mt-5">
<?php include('../roots/message.php'); ?>
<div class="row">
    <div class="col-md-8">
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
                        <input type="text" name = "purpose_id" class="form-control" placeholder="Enter Purpose ID (e.g. P01)" required>
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

    <div class="col-md-4">
        <div class="row mb-4">
            <div class="card">
                <div class="card-header">
                    <h5 align="center">Department</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped mt-3">
                        <thead align="center">
                            <tr>
                                <th>Department Initial</th>
                                <th>Department Name</th>
                            </tr>
                        </thead>
                        <tbody align="center">  
                            <?php
                                $query = "SELECT * FROM department";
                                $query_run = mysqli_query($connect, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $department) {
                                        ?>
                                            <tr>
                                                <td> <?= $department['dept_init']; ?> </td>
                                                <td> <?= $department['dept_name']; ?> </td>
                                            </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                        <tr>
                                            <td colspan="2">No Record Found!</td>
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
</div>


<?php
    include('../includes/footer.php');
?>
