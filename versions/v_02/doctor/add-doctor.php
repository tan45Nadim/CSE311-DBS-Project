<?php
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Add Doctor
                    <a href="search-doctor.php" class = "btn btn-info float-end">Doctor List</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="../roots/source-codes.php" method="POST">
                    <div class="mb-3">
                        <label>Doctor Initial</label>
                        <input type="text" name = "dr_init" class="form-control" placeholder="Enter Doctor Initial" required>
                    </div>
                    <div class="mb-3">
                        <label>Doctor Name</label>
                        <input type="text" name = "dr_name" class="form-control" placeholder="Enter Doctor Name" required>
                    </div>
                    <div class="mb-3">
                        <label>Department Initial</label>
                        <input type="text" name = "dept_init" class="form-control" placeholder="Enter Department Initial" required>
                    </div>
                    <div class="mb-3">
                        <label>Room Number</label>
                        <input type="text" name = "room_no" class="form-control" placeholder="Enter Room Number" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_doctor" class="btn btn-success">Confirm Doctor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="row mb-4">
            <div class="card">
                <!-- <div class="card-header">
                    <h5 align="center">Department</h5>
                </div> -->
                <!-- <div class="card-body"> -->
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
                <!-- </div> -->
            </div>
        </div>
        
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h5 align="center">Available Rooms</h5>
                </div>
                <div class="card-body">
                    <?php
                        $query = "SELECT room_no FROM hospital_room WHERE isAvailable = '1' AND (room_no LIKE 'DR%')";
                        $query_run_available_room = mysqli_query($connect, $query);

                        if (mysqli_num_rows($query_run_available_room) > 0) {
                            foreach ($query_run_available_room as $room) {
                                ?>
                                    <?= $room['room_no'] ?>, &nbsp &nbsp                            
                                <?php
                            }
                        } else {
                            ?>
                            No Room Available.
                            <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<?php
    include('../includes/footer.php');
?>