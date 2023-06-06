<?php
    error_reporting(0); 
    session_start();
    include ('../roots/db-connect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PatientQ - Generate Bill</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
    <link rel="stylesheet" href="../navbar/style.css" />
</head>
<body>

<?php
  include('../navbar/navmenu.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-7">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Bill Generation
                    <a href="../payment/search-residents.php" class = "btn btn-danger float-end">Residents</a>
                    </h4>
                </div>
                <div class="card-body p-4">
                    <div id="show_alert">
                    <?php include ('../roots/message.php'); ?>
                    </div>
                    <?php
                        if (isset($_GET['p_id'])) {
                            $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                            $query = "SELECT COUNT(visit_count) visit_count FROM payment_history where p_id = '$p_id' ";
                            $query_run = mysqli_query($connect, $query);

                            $count = mysqli_fetch_assoc($query_run);
                            $v_count = $count['visit_count'];
                        }
                    ?>
                    
                    <form action="#" method="POST" id = "add_charge">
                        <div class="row">
                            <div class="col-md-4 mb-3"> </div>
                            <div class="col-md-2 mb-3">
                                <p class="h6">Visit Count</p>
                                <input type="number" name="visit_count" class="form-control" value="<?=$count['visit_count'] ?>" readonly>
                            </div>
                            <div class="col-md-2 mb-3">
                                <p class="h6">Patient ID</p>
                                <input type="number" name="p_id" class="form-control" value="<?=$_GET['p_id'] ?>" readonly>
                            </div>
                            <div class="col-md-4 mb-3"> </div>
                        </div>

                        <div class="row mb-3"> </div>

                        <?php
                            if (isset($_GET['p_id'])) {
                                $p_id = mysqli_real_escape_string($connect, $_GET['p_id']);
                                $query = "SELECT * FROM payment_history where p_id = '$p_id' and visit_count = $v_count ";
                                $query_run = mysqli_query($connect, $query);
        
                                if (mysqli_num_rows($query_run) > 0) {
                                    $p_arr = mysqli_fetch_array($query_run);
                                }
                            }
                        ?>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <p class="h6">Purpose ID</p>
                                <input type="text" name="purpose_id" class="form-control" value="<?=$p_arr['purpose_id'] ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-2">
                                <p class="h6">Doctor Initial</p>
                                <input type="text" name="assign_dr_init" class="form-control" value="<?=$p_arr['assign_dr_init'] ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <p class="h6">Date of Admission</p>
                                <input type="text" name="admission_date" class="form-control" value="<?=$p_arr['admission_date'] ?>" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p class="h6">Date of Release</p>
                                <input type="text" name="release_date" class="form-control" value="<?=$p_arr['release_date'] ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-5">
                                <p class="h6">Note</p>
                                <input type="text" name="note" class="form-control" value="<?=$p_arr['note'] ?>" readonly>
                            </div>
                        </div>

                        <div id="show_charge" class="mb-3">
                            <div class="row">
                                <div class="col-md-2 mb-2" hidden>
                                    <p class="h6">Visit Count</p>
                                    <input type="number" name="visit_count[]" class="form-control" value="<?= $count['visit_count'] ?>" readonly>
                                </div>
                                <div class="col-md-2 mb-2" hidden>
                                    <p class="h6">Patient ID</p>
                                    <input type="number" name="p_id[]" class="form-control" value="<?= $_GET['p_id'] ?>" readonly>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <p class="h6">Charge Number</p>
                                    <input type="text" name="history[]" class="form-control" placeholder="Charge Number" required>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <p class="h6">Time Count</p>
                                    <input type="number" name="time_count[]" class="form-control" placeholder="Time Count" required>
                                </div>
                                <div class="col-md-3 mb-2 d-grid">
                                    <p class="h6">&nbsp</p>
                                    <button class="btn btn-secondary add_charge_btn">Add Charge</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Add Charges!" class="btn btn-success w-25" id="add_btn">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-header">
                    <h4>Ref. Charge Sheet</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead align="center">
                            <tr>
                                <th>Charge Number</th>
                                <th>Charge Name</th>
                                <th>Amount (BDT)</th>
                            </tr>
                        </thead>
                        <tbody align="center">  
                            <?php
                                $query = "SELECT * FROM charge_sheet";
                                $query_run = mysqli_query($connect, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $charge) {
                                        ?>
                                            <tr>
                                                <td> <?= $charge['charge_num']; ?> </td>
                                                <td> <?= $charge['charge_name']; ?> </td>
                                                <td> <?= $charge['amount']; ?> </td>                                            
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(e) {
        $(".add_charge_btn").click(function(e) {
            e.preventDefault();
            $("#show_charge").append(`<div class="row append_charge">
                                <div class="col-md-2 mb-2" hidden>
                                    <input type="hidden" name="visit_count[]" class="form-control" value="<?= $count['visit_count'] ?>" readonly>
                                </div>
                                <div class="col-md-2 mb-2" hidden>
                                    <input type="hidden" name="p_id[]" class="form-control" value="<?= $_GET['p_id'] ?>" readonly>
                                </div>
                                <div class="col-md-5 mb-2">
                                    <input type="text" name="history[]" class="form-control" placeholder="Charge Number" required>
                                </div>
                                <div class="col-md-4 mb-2">
                                    <input type="number" name="time_count[]" class="form-control" placeholder="Time Count" required>
                                </div>
                                <div class="col-md-3 mb-2 d-grid">
                                    <button class="btn btn-danger remove_charge_btn">Remove</button>
                                </div>
                            </div>`);
        });
        $(document).on('click', '.remove_charge_btn', function(e) {
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });

        // ajex request to insert the form data into database
        $("#add_charge").submit(function(e) {
            e.preventDefault();
            $("#add_btn").val('Adding...');
            $.ajax({
                // url: 'record-action.php',
                url: '../roots/source-codes.php',
                method: 'post',
                data: $(this).serialize(),
                success: function(response) {
                    $("#add_btn").val('Add');
                    $("#add_charge")[0].reset();
                    $(".append_charge").remove();
                    $("#show_alert").html(`<div class="alert alert-success" role="alert">${response}</div>`);
                    setTimeout(function() {
                        window.location.href = "search-residents.php";
                    }, 2000);
                }
            });
        });
    });
</script>

</body>
</html>