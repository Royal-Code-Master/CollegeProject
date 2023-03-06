<?php
include '../database/connection.php';

if (isset($_POST['scode'])) {
    $ids = $_POST['scode'];
    $query = "SELECT * FROM issued_bundles where exam_names = '$ids' ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Subject code ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['subject_codes'] . '>' . $row['subject_codes'] . '</option>';
        }
    } else {
        echo '<option>No Subject code Found!</option>';
    }
}
// teach_name
elseif (isset($_POST['teach_name'])) {
    $ids = $_POST['teach_name'];
    $query = "SELECT * FROM issued_bundles where subject_codes = '$ids' ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty Name ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['faculty'] . '>' . $row['faculty'] . '</option>';
        }
    } else {
        echo '<option>No faculty Found!</option>';
    }
}
// bundle number
elseif (isset($_POST['bn'])) {
    $ids = $_POST['bn'];
    $query = "SELECT * FROM issued_bundles where faculty = '$ids' ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty Name ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['bundle_number'] . '>' . $row['bundle_number'] . '</option>';
        }
    } else {
        echo '<option>No faculty Found!</option>';
    }
}

// person type.

elseif (isset($_POST['pt'])) {
    $ids = $_POST['pt'];
    $query = "SELECT * FROM issued_bundles where bundle_number = $ids ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty Name ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['person_type'] . '>' . $row['person_type'] . '</option>';
        }
    } else {
        echo '<option>No faculty Found!</option>';
    }
}
