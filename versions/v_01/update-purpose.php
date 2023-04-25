<?php
    error_reporting(0);
    session_start();
    require 'db-connect.php'
?>

<?php
    include('includes/header.php');
?>

<div class="container mt-5">

    <?php include('message.php'); ?>

    <div class="row">
        <div class="col-md12">
            <div class="card">
                <div class="card-header">
                    <h4>Update Purpose
                        <a href="search-purpose.php" class = "btn btn-danger float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">

                <?php
                    if (isset($_GET['purpose_id'])) {
                        $purpose_id = mysqli_real_escape_string($connect, $_GET['purpose_id']);
                        $query = "SELECT * FROM Purpose where purpose_id = '$purpose_id' ";
                        $query_run = mysqli_query($connect, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $purpose_arr = mysqli_fetch_array($query_run);
                            
                            ?>
                            <form action="source-codes.php" method="POST">
                                <input type="hidden" name = "purpose_id" value="<?= $purpose_arr['purpose_id'] ?>">                                    

                                <div class="mb-3">
                                    <label>Purpose Name or Classification</label>
                                    <input type="text" name = "purpose_name" class="form-control" value="<?= $purpose_arr['purpose_name'] ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label>Depeartment Initial</label>
                                    <input type="text" name = "dept_init" class="form-control" value="<?= $purpose_arr['dept_init'] ?>" required>
                                </div> 
                                <div class="mb-3">
                                    <button type="submit" name="update_purpose" class="btn btn-primary">Update Purpose</button>
                                </div>
                            </form>                                
                            <?php

                        } else {
                            echo "<h4>No Such Purpose Found!</h4>";
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