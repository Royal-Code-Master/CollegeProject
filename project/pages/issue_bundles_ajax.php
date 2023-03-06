<?php
include '../database/connection.php';

if (isset($_POST['scode'])) {
    $ids = $_POST['scode'];
    $query = "SELECT * FROM valuator where examinations = '$ids' ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Subject code ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['subjectcode'] . '>' . $row['subjectcode'] . '</option>';
        }
    } else {
        echo '<option>No Subject code Found!</option>';
    }
}
// teach_name
elseif (isset($_POST['teach_name'])) {
    $ids = $_POST['teach_name'];
    $query = "SELECT * FROM valuator where subjectcode = '$ids' ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty Name ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['facultyname'] . '>' . $row['facultyname'] . '</option>';
        }
    } else {
        echo '<option>No faculty Found!</option>';
    }
}


