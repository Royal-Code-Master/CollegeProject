<?php
include '../database/connection.php';

if (isset($_POST['fn'])) {
    $ids = $_POST['fn'];
    $query = "SELECT * FROM collect_bundles where exam_names = '$ids' ";
    $result = mysqli_query($con, $query);
    if ($result->num_rows > 0) {
        echo '<option>--- Select Faculty ---</option>';
        while ($row = $result->fetch_assoc()) {
            echo '<option value=' . $row['faculty'] . '>' . $row['faculty'] . '</option>';
        }
    } else {
        echo '<option>No Subject code Found!</option>';
    }
}
