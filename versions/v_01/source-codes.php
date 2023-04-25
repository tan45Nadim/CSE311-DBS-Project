<?php 
    session_start();
    require 'db-connect.php';

    // Update Purpose
    if (isset($_POST['update_purpose'])) {
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
    if (isset($_POST['add_purpose'])) {
        $purpose_id = mysqli_real_escape_string($connect, $_POST['purpose_id']);
        $purpose_name = mysqli_real_escape_string($connect, $_POST['purpose_name']);
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
    }

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

    // Update Patient
    if (isset($_POST['update_patient'])) {
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
    if (isset($_POST['admit_patient'])) {
        $p_name = mysqli_real_escape_string($connect, $_POST['p_name']);
        $p_age = mysqli_real_escape_string($connect, $_POST['p_age']);
        $p_sex = mysqli_real_escape_string($connect, $_POST['p_sex']);
        $mobile_no = mysqli_real_escape_string($connect, $_POST['mobile_no']);
        $address = mysqli_real_escape_string($connect, $_POST['address']);
        //$isResident = mysqli_real_escape_string($connect, $_POST['isResident']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
    }
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
?>