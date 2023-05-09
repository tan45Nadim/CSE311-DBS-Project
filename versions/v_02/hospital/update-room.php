<?php
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include('../roots/message.php'); ?>

<div class="row">
    <div class="col-md12">
        <div class="card">
            <div class="card-header">
                <h4>Update or Reserve Room
                    <a href="search-room.php" class = "btn btn-success float-end">Back</a>
                </h4>
            </div>
            <div class="card-body">
            <?php
                if (isset($_GET['room_no'])) {
                    $room_no = mysqli_real_escape_string($connect, $_GET['room_no']);
                    $query = "SELECT * FROM hospital_room where room_no = '$room_no' ";
                    $query_run = mysqli_query($connect, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        $room_arr = mysqli_fetch_array($query_run);
                        
                        ?>
                        <form action="../roots/source-codes.php" method="POST">
                            <div class="mb-3">
                                <label>Room Number</label>
                                <input type="text" name = "room_no" class="form-control" value="<?= $room_arr['room_no'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label>Room Status</label>
                                <input type="text" name = "isAvailable" class="form-control" value="<?= $room_arr['isAvailable'] ?>" required>
                            </div> 
                            <div class="mb-3">
                                <button type="submit" name="update_room" class="btn btn-primary">Update room</button>
                            </div>
                        </form>                                
                        <?php
                    } else {
                        echo "<h4>No Such Room Found!</h4>";
                    }   
                } else {
                    echo "<h4>No Such Room Found!</h4>";
                }
            ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php
    include('../includes/footer.php');
?>