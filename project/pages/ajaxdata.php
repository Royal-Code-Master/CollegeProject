<?php
include '../database/connection.php';

if (isset($_POST['ecode'])) {
    $ids = $_POST['ecode'];
    $query = "SELECT sub_code FROM teachers where exam_name = '$ids' ORDER BY sub_code";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Subject code ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['sub_code'] . '>' . $row['sub_code'] . '</option>';
        }
    } else {
        echo '<option>No Subject code Found!</option>';
    }
}
// teach_name
elseif (isset($_POST['teach_name'])) {
    $ids = $_POST['teach_name'];
    $query = "SELECT names FROM teachers where sub_code = '$ids' ORDER BY names";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty Name ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['names'] . '>' . $row['names'] . '</option>';
        }
    } else {
        echo '<option>No faculty Found!</option>';
    }
}

// college code
elseif (isset($_POST['ccid'])) {

    $ids = $_POST['ccid'];
    $query = "SELECT cc FROM teachers where names = '$ids'";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty Name ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['cc'] . '>' . $row['cc'] . '</option>';
        }
    } else {
        echo '<option>No code Found!</option>';
    }
}

// phone

elseif (isset($_POST['pn'])) {

    $ids = $_POST['pn'];
    $query = "SELECT phone FROM teachers where cc = '$ids'";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty Name ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['phone'] . '>' . $row['phone'] . '</option>';
        }
    } else {
        echo '<option>No code Found!</option>';
    }
}