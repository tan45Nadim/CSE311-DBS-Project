<?php
    error_reporting(0);
    session_start();
    include('../includes/header.php');
?>

<div class="container mt-5">
<?php include('../roots/message.php'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Add Room
                    <a href="search-room.php" class = "btn btn-info float-end">Room List</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="../roots/source-codes.php" method="POST">
                    <div class="mb-3">
                        <label>Room Number</label>
                        <input type="text" name = "room_no" class="form-control" placeholder="Enter Room Number" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="add_room" class="btn btn-success">Confirm room</button>
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
