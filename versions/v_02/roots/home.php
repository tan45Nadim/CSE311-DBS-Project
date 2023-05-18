<?php
    error_reporting(0);
    session_start();
    include('../includes/header.php');
?>

<div class="container mt-5">
    <?php include ('../roots/message.php'); ?>
    <div class="row" style="margin-bottom:140px;"></div>
    <div class="row">
        <div class="col-md-4">
        <img src="../images/PatientQ.png" alt="PatientQ!" width="320px" height="320px">
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-5">
            <h1>&nbsp</h1> 
            <h1>PatientQ</h1>
            <p style="text-align: justify">
            <br>
            PatientQ, a generous <b>hospital management system</b>, is a web-based project. 
            It can admit patients with the necessary information and helps track every identical factor. 
            The relationship between patients with the doctors and the significant dependency on departments are entitled and applied. 
            That is the system, the scenario of a database that any hospital can have with their client patients with appropriate records. 
            </p>
            <br>
            <P>Github Link: <a target="_blank" href="https://github.com/tan45Nadim/CSE311-DBS-Project">https://github.com/tan45Nadim/CSE311-DBS-Project</a></P>
        </div>
        <div class="col-md-2"></div>
    </div>
    

</div>

<?php
    include('../includes/footer.php');
?>