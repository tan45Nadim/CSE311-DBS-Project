<?php 
    error_reporting(0);
    session_start();
    include('../includes/header.php');
    include ('../roots/db-connect.php');
?>

<div class="container mt-5">

<?php include ('../roots/message.php'); ?>

<div class="row">
    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header">
                <h4>Search Room</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="h6">Room Number</p>
                                    <input type="text" name="search_room_no" value="<?php if (isset($_GET['search_room_no'])) {echo $_GET['search_room_no']; } ?>" class="form-control" placeholder="Enter Room Initial" >
                                </div>
                                <div class="col-sm-5">
                                    <p class="h6">Available</p>
                                    <input type="text" name="search_isAvailable" value="<?php if (isset($_GET['search_isAvailable'])) {echo $_GET['search_isAvailable']; } ?>" class="form-control" placeholder="Enter 0/1 or Yes/No">
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
                <h4>Room Details
                    <a href="add-room.php" class = "btn btn-success float-end">Add room</a>
                </h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead align="center">
                        <tr>
                            <th>Room Number</th>
                            <th>Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody align="center">  
                        <?php
                            $searched_room_no = $_GET['search_room_no'];
                            $searched_isAvailable = $_GET['search_isAvailable'];

                            if (strtolower($searched_isAvailable) == 'yes') {
                                $searched_isAvailable = '1';
                            } else if (strtolower($searched_isAvailable) == 'no') {
                                $searched_isAvailable = '0';
                            } else {
                                $searched_isAvailable = (string)$searched_isAvailable;
                            }

                            if (!$searched_room_no and $searched_isAvailable == "0") {
                                $query = "SELECT * FROM hospital_room WHERE isAvailable LIKE '$searched_isAvailable' ";
                            } else if ($searched_room_no and $searched_isAvailable == "0") {
                                $query = "SELECT * FROM hospital_room WHERE room_no LIKE '%$searched_room_no%' AND isAvailable LIKE '$searched_isAvailable' ";
                            } else if (!$searched_room_no and !$searched_isAvailable) {
                                $query = "SELECT * FROM hospital_room";
                            } else if ($searched_room_no and !$searched_isAvailable) {
                                $query = "SELECT * FROM hospital_room WHERE room_no LIKE '%$searched_room_no%' ";
                            } else if (!$searched_room_no and $searched_isAvailable) {
                                $query = "SELECT * FROM hospital_room WHERE isAvailable LIKE '%$searched_isAvailable%' ";
                            } else {
                                $query = "SELECT * FROM hospital_room WHERE room_no LIKE '%$searched_room_no%' AND isAvailable LIKE '%$searched_isAvailable%' ";
                            }

                            $query_run = mysqli_query($connect, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                foreach ($query_run as $room) {
                                    ?>
                                    <tr>
                                        <td> <?= $room['room_no']; ?> </td>
                                        <?php if($room['isAvailable'] == '0'): ?>
                                            <td>No</td>
                                        <?php else: ?>
                                            <td>Yes</td>
                                        <?php endif; ?>
                                        <td>
                                            <a href="update-room.php?room_no=<?= $room['room_no']; ?>" class="btn btn-warning stn-sm">Update</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            } else {
                                ?>
                                    <tr>
                                        <td colspan="3">No Record Found!</td>
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