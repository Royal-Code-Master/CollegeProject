<?php

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}

include '../database/connection.php';

// filtering data
$select_exam = "select examinations from valuator ORDER BY examinations";
$exam_select_exam_result = mysqli_query($con, $select_exam);



// issue bundle details.
if (isset($_POST['issue_bundle'])) {

    $exam_names = $_POST['exams_names'];
    $subject_code = $_POST['subject_codes'];
    $faculty_name = $_POST['faculty_names'];
    $chief_name = $_POST['chief'];
    $person_type = $_POST['person_type'];
    $bundle_numbers = $_POST['bn'];

    $check_bundle_number = "SELECT * from issued_bundles where faculty ='$faculty_name' and bundle_number = '$bundle_numbers'";
    $check_bundle_result = mysqli_query($con, $check_bundle_number);
    $row = mysqli_fetch_assoc($check_bundle_result);

    if (empty($exam_names) || empty($subject_code) || empty($faculty_name) || empty($bundle_numbers)) {
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <center><strong>User Alert </strong> Fill all the fields</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }
    if ($bundle_numbers == $row['bundle_number'] and $faculty_name == $row['faculty']) {

        echo '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <center><strong>User Alert </strong> Already this Bundle number is Assigned to You. </center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } else {
        // time checking for user.
        $time_check = "SELECT * from issued_bundles where faculty ='$faculty_name' and subject_codes = '$subject_code'";
        $check_time_result = mysqli_query($con, $time_check);
        $row = mysqli_fetch_assoc($check_time_result);

        $joined_time = $row['time_joiined'];

        $formatted_timee = strtotime($joined_time);
        $formatted_time = date("h:i:s", $formatted_timee);

        $present_time = strtotime("+5 hours 30 minutes");
        $formatted_present_time = date("h:i:s", $present_time);
        $start_datetime = new DateTime($formatted_present_time);

        $diff = $start_datetime->diff(new DateTime($formatted_time));
        $hour_difference = $diff->h;


        if ($hour_difference >= 2) {
            $insert_bundle_details = "insert into issued_bundles (exam_names,subject_codes,faculty,chief_name,person_type,bundle_number) values ('$exam_names','$subject_code','$faculty_name',' $chief_name','$person_type','$bundle_numbers')";
            $issue_result = mysqli_query($con, $insert_bundle_details);
            if ($issue_result) {
                echo '
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <center><strong>User Alert </strong> Bundle issued successfully.</center>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        ';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     <center><strong>User Alert! </strong>   You can able take another Bundle after 2 Hours only.</center>
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                     </div>';
        }
    }
}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-----------------------Style sheet llinks -------------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">


    <!---------------------------icons------------------------->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    <!----------------    Animation ---------------->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!----------------------short icon------------------------>
    <link rel="shortcut icon" href="../images/logo.png" type="image/x-icon">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - JNTUGV</title>
</head>

<style>
    .navbar {
        background-color: white;
        border-bottom: 4.74px solid rgba(99, 22, 172, 0.919);
    }

    #side_menu_logo {
        height: 42px;
        width: 42px;
    }

    .navbar-brand {
        font-weight: bold;
        font-style: normal;
        text-decoration: none;
        font-size: 22.74px;
        margin-left: 1px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        color: rgba(99, 22, 172, 0.919) !important;
    }

    #clg_name_sub {
        font-weight: bolder;
        font-size: 15.74px;
        margin-left: 2.8px;
        font-family: 'Times New Roman', Times, serif;
        color: rgba(0, 0, 0, 0.755);
    }

    .fa {
        size: 10px;
        box-shadow: rgba(2, 2, 2, 0.568) 0px 3px 8px;
        border-radius: 50%;
        padding: 6px;
        color: navy;
    }

    .nav-link {
        font-size: 16.74px;
        text-transform: capitalize;
        color: rgba(99, 22, 172, 0.919) !important;
        font-weight: 600;
    }

    .nav-link:hover {
        font-size: 13.74px;
        text-transform: capitalize;
        color: blue !important;
        font-weight: 650;
    }

    form {
        max-width: 1000px;
        height: auto;
        box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
    }

    #desc2 {
        font-weight: bolder;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        color: rgba(99, 22, 172, 0.919);
    }

    label {
        text-align: left;
        color: black;
        font-weight: 600;
        padding: 3px;
        text-transform: capitalize;
    }

    #send {
        font-weight: 700;
        font-size: 15.74px;
        border: 1.74px solid rgba(99, 22, 172, 0.919);
        color: rgba(99, 22, 172, 0.919);
    }

    #send:hover {
        font-weight: 700;
        font-size: 15.74px;
        background-color: rgba(99, 22, 172, 0.919);
        border: 1.74px solid rgba(99, 22, 172, 0.919);
        color: white;
    }
</style>

<body>



    <nav class="navbar navbar-light fixed-sticky">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../images/logo.png" alt="" srcset="" id="side_menu_logo" class="img-fluid"> &nbsp;JNTUGV
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon">
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <a class="navbar-brand" href="#">
                        <img src="../images/logo.png" alt="" srcset="" id="side_menu_logo" class="img-fluid">
                        &nbsp;JNTUGV<br>
                        <p id="clg_name_sub">Spot Valuation</p>
                    </a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a href="./home.php" class="nav-link">
                                <i class="fa fa-home"></i>&nbsp; Home
                            </a>
                        </li>
                        <li>
                            <a href="./instructions.php" class="nav-link">
                                <i class="fa fa-arrow-circle-right"></i>&nbsp; Instructions
                            </a>
                        </li>

                        <li>
                            <a href="./valuator_registration.php" class="nav-link">
                                <i class="fa fa-user-circle-o"></i>&nbsp; Valuator Registration</a>
                        </li>

                        <li>
                            <a href="./view_enrolled_valuators.php" class="nav-link ">
                                <i class="fa fa-eye"></i>&nbsp; View Enrolled Valuators</a>
                        </li>

                        <li>
                            <a href="./issue_bundles.php" class="nav-link">
                                <i class="fa fa-bars"></i>&nbsp; Issue Bundles </a>
                        </li>

                        <li>
                            <a href="./view_issued_bundles.php" class="nav-link">
                                <i class="fa fa-book"></i>&nbsp; View Issued Bundles </a>
                        </li>

                        <li>
                            <a href="./collect_bundles.php" class="nav-link">
                                <i class="fa fa-database"></i>&nbsp; Collect Bundles </a>
                        </li>

                        <li>
                            <a href="./view_received_bundles.php" class="nav-link">
                                <i class="fa fa-file"></i>&nbsp; View Received Bundles </a>
                        </li>

                        <li>
                            <a href="./history.php" class="nav-link">
                                <i class="fa fa-undo"></i>&nbsp; Valuator History</a>
                        </li>

                        <li>
                            <a href="./downloads.php" class="nav-link">
                                <i class="fa fa-download"></i>&nbsp; Downloads</a>
                        </li>

                        <li>
                            <a href="./change_pwd.php" class="nav-link">
                                <i class="fa fa-lock"></i>&nbsp; Change Password</a>
                        </li>

                        <li>
                            <a href="./logout.php" class="nav-link">
                                <i class="fa fa-sign-out"></i>&nbsp; Sign out</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <br>


    <div class="hero_section mt-1">
        <div class="container bg-light">
            <center>
                <br>
                <h3 class="p-2 mt-2 mb-2" id="desc2"><strong>Issue Bundles Details</strong></h3>
                <form action="" method="post" class="form-control mt-3 mb-3 p-3" enctype="multipart/form-data">
                    <div class="row p-4">
                        <div class="col-md-12">
                            <div class="row form-control mt-2">
                                <label for="">Select Examination</label>
                                <select class="form-select form-select-sm" name="exams_names" id="exams_names" required onchange="getSubcodes(this.value)">
                                    <option>--- Select Examination---</option>
                                    <?php

                                    if (mysqli_num_rows($exam_select_exam_result) > 0) {
                                        while ($row = mysqli_fetch_assoc($exam_select_exam_result)) {
                                            echo '<option value = ' . $row['examinations'] . ' >' . $row['examinations'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row form-control mt-2">
                                <label for="">Select SubCodes</label>
                                <select class="form-select form-select-sm" name="subject_codes" id="subcodes" required onchange="getFaculty(this.value)">

                                </select>
                            </div>
                            <div class="row form-control mt-2 mb-3">
                                <label for="">Select Faculty Name</label>
                                <select class="form-select form-select-sm" name="faculty_names" id="factlties" required>

                                </select>
                            </div>
                            <div class="row form-control mt-2 mb-3">
                                <label for="">Select Chief</label>
                                <select class="form-select form-select-sm" name="chief" id="factlties" required>
                                    <option>--- Slect your Chief</option>
                                    <?php
                                    $select_exam = "select names from chiefs ORDER BY names";
                                    $exam_select_exam_result = mysqli_query($con, $select_exam);
                                    if (mysqli_num_rows($exam_select_exam_result) > 0) {
                                        while ($row = mysqli_fetch_assoc($exam_select_exam_result)) {
                                            echo '<option value = ' . $row['names'] . ' >' . $row['names'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row form-control mt-2 mb-3">
                                <label for="">Select Person Type</label>
                                <select class="form-select form-select-sm" name="person_type" id="factlties" required>
                                    <option>--- select --- </option>
                                    <option value="chief">Chief</option>
                                    <option value="valuator">Valuator</option>
                                    <option value="scrutinizer">scrutinizer</option>

                                </select>
                            </div>
                            <div class="row form-control mt-2">
                                <label for="">Select Bundle Number</label>
                                <input type="number" class="form-control" name="bn" id="" placeholder="enter bunble number" required>
                            </div>


                            <button type="submit" class="btn btn-light form-control mt-3" id="send" name="issue_bundle">Issue Bundle</button>
                        </div>

                    </div>
                </form>
                <br>
            </center>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        function getSubcodes(id) {
            $('#subcodes').html('');

            $.ajax({
                type: 'post',
                url: 'issue_bundles_ajax.php',
                data: {
                    scode: id
                },
                success: function(data) {
                    $('#subcodes').html(data)
                }
            })
        }

        function getFaculty(id) {
            $('#factlties').html('');

            $.ajax({
                type: 'post',
                url: 'issue_bundles_ajax.php',
                data: {
                    teach_name: id
                },
                success: function(data) {
                    $('#factlties').html(data)
                }
            })
        }
    </script>




    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>