<?php 
    session_start();
    require 'db-connect.php';

    // Update Charge Sheet
    if (isset($_POST['update_charge'])) {
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
    if (isset($_POST['add_charge'])) {
        $charge_num = mysqli_real_escape_string($connect, $_POST['charge_num']);
        $charge_name = mysqli_real_escape_string($connect, $_POST['charge_name']);
        $amount = mysqli_real_escape_string($connect, $_POST['amount']);
    }

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

    // Update Doctor
    if (isset($_POST['update_doctor'])) {
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
    if (isset($_POST['add_doctor'])) {
        $dr_init = mysqli_real_escape_string($connect, $_POST['dr_init']);
        $dr_name = mysqli_real_escape_string($connect, $_POST['dr_name']);
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
    }

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

    //Update Department
    if (isset($_POST['update_department'])) {
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
    if (isset($_POST['add_department'])) {
        $dept_init = mysqli_real_escape_string($connect, $_POST['dept_init']);
        $dept_name = mysqli_real_escape_string($connect, $_POST['dept_name']);
        $room_no = mysqli_real_escape_string($connect, $_POST['room_no']);
        $dept_head_init = mysqli_real_escape_string($connect, $_POST['dept_head_init']);
    }

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