<?php
    session_start();
?>

<?php
    include('includes/header.php');
?>

<div class="container mt-5">

<?php include('message.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Admit Patient
                    <a href="search-patient.php" class = "btn btn-info float-end">Patients List</a>
                </h4>
            </div>
            <div class="card-body">
                <form action="source-codes.php" method="POST">
                    <div class="mb-3">
                        <label>Patient Name</label>
                        <input type="text" name = "p_name" class="form-control" placeholder="Enter Patient Name" required>
                    </div>
                    <div class="mb-3">
                        <label>Patient Age</label>
                        <input type="number" name = "p_age" class="form-control" placeholder="Enter Patient Age" required>
                    </div>
                    <div class="mb-3">
                        <label>Patient Sex</label>
                        <input type="text" name = "p_sex" class="form-control" placeholder="Enter M or F" required>
                    </div>
                    <div class="mb-3">
                        <label>Patient Mobile Number</label>
                        <input type="number" name = "mobile_no" class="form-control" placeholder="Enter Patient Mobile Number" required>
                    </div>
                    <div class="mb-3">
                        <label>Patient Address</label>
                        <input type="text" name = "address" class="form-control" placeholder="Enter Patient Address" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label>Patient Residential Status</label>
                        <input type="text" name = "isResident" class="form-control" placeholder="Enter 1" required>
                    </div> -->
                    <div class="mb-3">
                        <label>Patient Room Number</label>
                        <input type="text" name = "room_no" class="form-control" placeholder="Enter Patient Room Number" required>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="admit_patient" class="btn btn-success">Confirm Admission</button>
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