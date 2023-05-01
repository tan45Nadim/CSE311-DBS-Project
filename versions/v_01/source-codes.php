<?php
$con = new PDO('mysql:host=localhost;dbname=PatientQ', 'root', '');

foreach($_POST['visit_count'] as $key => $value) {
    $sql = 'INSERT INTO patient_record(visit_count, p_id, history, time_count) 
        VALUES (:visit_count, :p_id, :history, :time_count)';

    $stmt = $con->prepare($sql);
    $stmt->execute([
        'visit_count' => $value,
        'p_id' => $_POST['p_id'][$key],
        'history' => $_POST['history'][$key],
        'time_count' => $_POST['time_count'][$key]
    ]);
} echo 'Charges Inserted Successfully! <b>Redirecting to Residents....</b>';
?>

<?php 
    session_start();
    require 'db-connect.php';

    if (isset($_POST['login_btn'])) { 
        $user_name = mysqli_real_escape_string($connect, $_POST['username']);  
        $pass_word = mysqli_real_escape_string($connect, $_POST['pass_word']); 
    
        $query = "SELECT * FROM panel WHERE username ='$user_name' AND pass_word='$pass_word' ";
        $query_run = mysqli_query($connect, $query);
    
        if (mysqli_fetch_array($query_run)) {
            $_SESSION['message'] = $user_name;
    
            header('Location: admit-patient.php');
    
        } else {
            $_SESSION['status'] = "Username / Password is Invalid";
            header('Location: login.php');
        }
        
    }

    // Inserting Information into Payment History
    else if (isset($_POST['payment_history'])) {
        $p_id = mysqli_real_escape_string($connect, $_POST['p_id']);
        $visit_count = mysqli_real_escape_string($connect, $_POST['visit_count']);
        $purpose_id = mysqli_real_escape_string($connect, $_POST['purpose_id']);
        $assign_dr_init = mysqli_real_escape_string($connect, $_POST['assign_dr_init']);
        $admission_date = mysqli_real_escape_string($connect, $_POST['admission_date']);
        $release_date = mysqli_real_escape_string($connect, $_POST['release_date']);
        $note = mysqli_real_escape_string($connect, $_POST['note']);

        if ($note) {
            $query = "INSERT INTO payment_history (visit_count, p_id, purpose_id, payable_amount, paid, admission_date, release_date, assign_dr_init, note, discount_pct)
                VALUES ('$visit_count', '$p_id', '$purpose_id', 0, 0, '$admission_date', '$release_date', '$assign_dr_init', '$note', 0)";
        } else {
            $query = "INSERT INTO payment_history (visit_count, p_id, purpose_id, payable_amount, paid, admission_date, release_date, assign_dr_init, note, discount_pct)
                VALUES ('$visit_count', '$p_id', '$purpose_id', 0, 0, '$admission_date', '$release_date', '$assign_dr_init', 'Nothing Mentionable!', 0)";
        }

        $query_run = mysqli_query($connect, $query);

        if ($query_run) {
            $_SESSION['message'] = "Visit Count for <b>ID {$p_id}</b> Posted! Add Charges...";
            header("Location: include-charges.php?p_id=$p_id");
            exit(0);
        } else {
            $_SESSION['message'] = "Visit Count Not Posted!";
            header("Location: include-charges.php?p_id=$p_id");
            exit(0);
        }
    }

    // Update Room
    else if (isset($_POST['update_room'])) {
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $isAvailable = mysqli_real_escape_string($connect, $_POST['isAvailable']);

        $query = "UPDATE hospital_room SET isAvailable = '$isAvailable'
            WHERE room_no = '$room_no' ";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Room Number <b>{$room_no}</b> Updated Successfully!";
            header("Location: search-room.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Room Number <b>{$room_no}</b> Not Updated!";
            header("Location: search-room.php");
            exit(0);
        }
    }
    // Add Room
    else if (isset($_POST['add_room'])) {
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $query = "INSERT INTO hospital_room (room_no, isAvailable)
            VALUES ('$room_no', '1')";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Room Added Successfully!";
            header("Location: search-room.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Room Not Added!";
            header("Location: search-room.php");
            exit(0);
        }
    }
    // Update Charge Sheet
    else if (isset($_POST['update_charge'])) {
        $charge_num = mysqli_real_escape_string($connect, $_POST['charge_num']);
        $charge_name = mysqli_real_escape_string($connect, $_POST['charge_name']);
        $amount = mysqli_real_escape_string($connect, $_POST['amount']);
        $query = "UPDATE charge_sheet SET charge_name = '$charge_name', amount = '$amount'
            WHERE charge_num = '$charge_num' ";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Charge Number <b>{$charge_num}</b> Updated Successfully!";
            header("Location: search-charge.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Charge Number <b>{$charge_num}</b> Not Updated!";
            header("Location: search-charge.php");
            exit(0);
        }
    }
    // Add Charge Sheet
    else if (isset($_POST['add_charge'])) {
        $charge_num = mysqli_real_escape_string($connect, $_POST['charge_num']);
        $charge_name = mysqli_real_escape_string($connect, $_POST['charge_name']);
        $amount = mysqli_real_escape_string($connect, $_POST['amount']);
        $query = "INSERT INTO charge_sheet (charge_num, charge_name, amount)
        VALUES ('$charge_num', '$charge_name', '$amount')";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Charge Added Successfully!";
            header("Location: search-charge.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Charge Not Added!";
            header("Location: search-charge.php");
            exit(0);
        }
    }
    // Update Doctor
    else if (isset($_POST['update_doctor'])) {
        $dr_init = mysqli_real_escape_string($connect, $_POST['dr_init']);
        $dr_name = mysqli_real_escape_string($connect, $_POST['dr_name']);
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $query = "UPDATE doctor SET dr_name = '$dr_name', dept_init = '$dept_init', room_no = '$room_no'
            WHERE dr_init = '$dr_init' ";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Doctor Initial <b>{$dr_init}</b> Updated Successfully!";
            header("Location: search-doctor.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Doctor Initial <b>{$dr_init}</b> Not Updated!";
            header("Location: search-doctor.php");
            exit(0);
        }
    }
    // Add Doctor
    else if (isset($_POST['add_doctor'])) {
        $dr_init = mysqli_real_escape_string($connect, $_POST['dr_init']);
        $dr_name = mysqli_real_escape_string($connect, $_POST['dr_name']);
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $query = "INSERT INTO doctor (dr_init, dr_name, dept_init, room_no)
            VALUES ('$dr_init', '$dr_name', '$dept_init', '$room_no')";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Doctor Added Successfully!";
            header("Location: search-doctor.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Doctor Not Added!";
            header("Location: search-doctor.php");
            exit(0);
        }
    }
    //Update Department
    else if (isset($_POST['update_department'])) {
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $dept_name = mysqli_real_escape_string($connect, $_POST['dept_name']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $dept_head_init = mysqli_real_escape_string($connect, $_POST['dept_head_init']);
        $query = "UPDATE department SET dept_name = '$dept_name', room_no = '$room_no', 
                dept_head_init = '$dept_head_init' where dept_init = '$dept_init' ";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Department Initial <b>{$dept_init}</b> Updated Successfully!";
            header("Location: search-department.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Department Initial <b>{$dept_init}</b> Not Updated!";
            header("Location: search-department.php");
            exit(0);
        }
    }
    // Add Department
    else if (isset($_POST['add_department'])) {
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $dept_name = mysqli_real_escape_string($connect, $_POST['dept_name']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $dept_head_init = mysqli_real_escape_string($connect, $_POST['dept_head_init']);
        $query = "INSERT INTO department (dept_init, dept_name, room_no, dept_head_init)
            VALUES ('$dept_init', '$dept_name', '$room_no', '$dept_head_init') ";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Department Added Successfully!";
            header("Location: search-department.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Department Not Added!";
            header("Location: search-department.php");
            exit(0);
        }
    }
    
    // Update Purpose
    else if (isset($_POST['update_purpose'])) {
        $purpose_id = mysqli_real_escape_string($connect, $_POST['purpose_id']);
        $purpose_name = mysqli_real_escape_string($connect, $_POST['purpose_name']);
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $query = "UPDATE purpose SET purpose_name = '$purpose_name', dept_init = '$dept_init'
            where purpose_id = '$purpose_id' ";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "purpose ID <b>{$purpose_id}</b> Updated Successfully!";
            header("Location: search-purpose.php");
            exit(0);
        } else {
            $_SESSION['message'] = "purpose ID <b>{$purpose_id}</b> Not Updated!";
            header("Location: search-purpose.php");
            exit(0);
        }
    }
    
    // Add Purpose
    else if (isset($_POST['add_purpose'])) {
        $purpose_id = mysqli_real_escape_string($connect, $_POST['purpose_id']);
        $purpose_name = mysqli_real_escape_string($connect, $_POST['purpose_name']);
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $query = "INSERT INTO purpose (purpose_id, purpose_name, dept_init)
        VALUES ('$purpose_id', '$purpose_name', '$dept_init')";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Purpose Added Successfully!";
            header("Location: search-purpose.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Purpose Not Added!";
            header("Location: search-purpose.php");
            exit(0);
        }
    }
    // Update Patient
    else if (isset($_POST['update_patient'])) {
        $p_id = mysqli_real_escape_string($connect, $_POST['p_id']);
        $p_name = mysqli_real_escape_string($connect, $_POST['p_name']);
        $p_age = mysqli_real_escape_string($connect, $_POST['p_age']);
        $p_sex = mysqli_real_escape_string($connect, $_POST['p_sex']);
        $mobile_no = mysqli_real_escape_string($connect, $_POST['mobile_no']);
        $address = mysqli_real_escape_string($connect, $_POST['address']);
        //$isResident = mysqli_real_escape_string($connect, $_POST['isResident']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        if ($room_no) {
            $query = "UPDATE patient SET p_name = '$p_name', p_age = '$p_age', p_sex = '$p_sex',
                mobile_no = '$mobile_no', address = '$address', isResident = 1, room_no = '$room_no' 
                where p_id = '$p_id' ";
        } else  {
            $query = "UPDATE patient SET p_name = '$p_name', p_age = '$p_age', p_sex = '$p_sex',
                mobile_no = '$mobile_no', address = '$address'
                where p_id = '$p_id' ";
        }
        
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Patient ID <b>{$p_id}</b> Updated Successfully!";
            header("Location: search-patient.php");
            // header("Location: update-patient.php?p_id={$p_id}");
            exit(0);
        } else {
            $_SESSION['message'] = "Patient ID <b>{$p_id}</b> Not Updated!";
            header("Location: search-patient.php");
            exit(0);
        }
    }
    // Admit Patient
    else if (isset($_POST['admit_patient'])) {
        $p_name = mysqli_real_escape_string($connect, $_POST['p_name']);
        $p_age = mysqli_real_escape_string($connect, $_POST['p_age']);
        $p_sex = mysqli_real_escape_string($connect, $_POST['p_sex']);
        $mobile_no = mysqli_real_escape_string($connect, $_POST['mobile_no']);
        $address = mysqli_real_escape_string($connect, $_POST['address']);
        //$isResident = mysqli_real_escape_string($connect, $_POST['isResident']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $query = "INSERT INTO patient (p_name, p_age, p_sex, mobile_no, address, isResident, room_no)
                VALUES ('$p_name', '$p_age', '$p_sex', '$mobile_no', '$address', 1, '$room_no')";
        $query_run = mysqli_query($connect, $query);
        if ($query_run) {
            $_SESSION['message'] = "Patient Admitted Successfully!";
            header("Location: search-patient.php");
            exit(0);
        } else {
            $_SESSION['message'] = "Patient Not Admitted!";
            header("Location: search-patient.php");
            exit(0);
        }
    }
?>