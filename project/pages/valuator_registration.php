<?php

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}

include_once '../database/connection.php';
if (isset($_POST['enroll'])) {

    $admin_type = $_POST['admin_type'];
    $exam = $_POST['exams'];
    $subject_code = $_POST['s_code'];
    $faculty_name = $_POST['teacher'];
    $college_code = $_POST['cc'];
    $phone_number = $_POST['phone'];
    $mail_id = $_POST['mail'];
    $bank_account = $_POST['bank1'];
    $bank_account_confirm = $_POST['bank2'];
    $ifsc_code = $_POST['ifsc'];
    $pan_number = $_POST['pan'];
    $address_data = $_POST['addrs'];

    if (empty($admin_type) || empty($exam) || empty($subject_code) || empty($faculty_name) || empty($college_code) || empty($mail_id) || empty($phone_number) || empty($bank_account_confirm) || empty($ifsc_code) || empty($pan_number) || empty($address_data)) {
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <center><strong>User Alert </strong> Fill all the fields.</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    }

    // error checking.
    if ($bank_account != $bank_account_confirm) {
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <center><strong>User Alert </strong> Does not match Bank Account numbers. please check once</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } elseif (strlen($phone_number) != 10) {
        echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <center><strong>User Alert </strong> Wrong phone number you entered. please check once</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
    } else {
        $access_denied = "select * from valuator where subjectcode='$subject_code' and phone ='$phone_number' ";
        $denied_result = mysqli_query($con, $access_denied);
        $row = mysqli_fetch_assoc($denied_result);
        if ($row['subjectcode'] == $subject_code && $row['phone'] == $phone_number) {
            echo '
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <center><strong>User Alert </strong> Already Chief Exist.</center>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        ';
        } else {
            $user_insert = "insert into valuator (admin_type, examinations, subjectcode,facultyname,collegecode,mailid,phone,bankaccount,bankaccountconform,ifsccode,pan,locations) values ('$admin_type', '$exam', '$subject_code', '$faculty_name',  '$college_code',  '$mail_id', '$phone_number', '$bank_account',  '$bank_account_confirm',  '$ifsc_code', '$pan_number', '$address_data')";
            $user_result = mysqli_query($con, $user_insert);
            if ($user_result) {
                echo '
              <div class="alert alert-success alert-dismissible fade show" role="alert">
              <center><strong>User Alert </strong> Successful.</center>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        ';
            }
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        max-width: 900px;
        height: auto;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 3px 6px, rgba(0, 0, 0, 0.23) 0px 3px 6px;
        border-radius: 7.4px;
    }

    label {
        color: black;
        text-align: left;
        padding: 2px;
        font-weight: 600;
        text-transform: capitalize;
        font-size: 15.74px;
        font-family: 'Times New Roman', Times, serif;
    }
</style>

<body>

    <?php
    $select_exams = "SELECT exam_name FROM teachers ORDER BY exam_name";
    $result_exams = mysqli_query($con, $select_exams);
    ?>

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
    <br>

    <div class="hero_section mt-1">
        <center>
            <form action="" method="post" class="form-control" enctype="multipart/form-data">
                <i class="fa fa-user-circle-o fa-3x mt-1"></i>
                <h5 class="mt-2 text-dark"><strong>Valuator Registration</strong></h5>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="row form-control mt-2">
                            <label for="">Person Type</label>
                            <select class="form-select form-select-sm form-control" name="admin_type" required>
                                <option>--- select --- </option>
                                <option value="chief">Chief</option>
                                <option value="valuator">Valuator</option>
                            </select>
                        </div>
                        <div class="row form-control mt-2">
                            <label for="">Examinations</label>
                            <select class="form-select form-select-sm form-control" name="exams" id="first_dropdown" onchange="getExam(this.value)" required>
                                <option>--- Select Examinations ---</option>
                                <!-- exam name -->
                                <?php

                                if (mysqli_num_rows($result_exams) > 0) {
                                    while ($row = mysqli_fetch_assoc($result_exams)) {
                                        echo '<option value = ' . $row['exam_name'] . ' >' . $row['exam_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="row form-control mt-2">
                            <label for="">Subject code</label>
                            <select class="form-select form-select-sm form-control" name="s_code" id="second_dropdown" onchange="getCode(this.value)" required>

                                <!-- subject code -->

                            </select>
                        </div>

                        <div class="row form-control mt-2">
                            <label for="">Faculty Name</label>
                            <select class="form-select form-select-sm form-control" name="teacher" id="third_dropdown" onchange="getCC(this.value)" required>


                            </select>
                        </div>
                        <div class="row form-control mt-2">
                            <label for="">College Code</label>
                            <select class="form-select form-select-sm form-control" name="cc" id="fourth_dropdown" onchange="getPhone(this.value)" required>
                            </select>
                        </div>

                        <div class="row form-control mt-2">
                            <label for="">Phone Number</label>
                            <select class="form-select form-select-sm form-control" name="phone" id="fifth_dropdown" required>
                            </select>
                        </div>

                        <div class="row form-control mt-2">
                            <label for="">Email ID</label>
                            <input type="email" name="mail" id="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row form-control mt-2">
                            <label for="">Bank Account Number</label>
                            <input type="text" name="bank1" id="" class="form-control" required>
                        </div>
                        <div class="row form-control mt-2">
                            <label for="">Re-enter Bank Account Number</label>
                            <input type="text" name="bank2" id="" class="form-control" required>
                        </div>
                        <div class="row form-control mt-2">
                            <label for="">IFSC Code</label>
                            <input type="text" name="ifsc" id="" class="form-control" required>
                        </div>
                        <div class="row form-control mt-2">
                            <label for="">PAN Number</label>
                            <input type="text" name="pan" id="" class="form-control" required>
                        </div>
                        <div class="row form-control mt-2">
                            <label for="">Address</label>
                            <textarea name="addrs" id="" cols="30" rows="7" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success form-control" name="enroll">Enroll</button>
                    </div>
                    <div class="col-md-6">
                        <a href="../pages/home.php" role="button" class="btn btn-danger form-control">Back</a>
                    </div>
                </div>
            </form>
            <br>
        </center>
        <br>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        function getExam(id) {

            $('#second_dropdown').html('');

            $.ajax({
                type: 'post',
                url: '../pages/ajaxdata.php',
                data: {
                    ecode: id
                },
                success: function(data) {
                    $('#second_dropdown').html(data)
                }
            })
        }

        function getCode(id) {
            $('#third_dropdown').html('');

            $.ajax({
                type: 'post',
                url: '../pages/ajaxdata.php',
                data: {
                    teach_name: id
                },
                success: function(data) {
                    $('#third_dropdown').html(data)
                }
            })
        }

        function getCC(id) {

            $('#fourth_dropdown').html('');

            $.ajax({
                type: 'post',
                url: '../pages/ajaxdata.php',
                data: {
                    ccid: id
                },
                success: function(data) {
                    $('#fourth_dropdown').html(data)
                }
            })
        }

        function getPhone(id) {

            $('#fifth_dropdown').html('');

            $.ajax({
                type: 'post',
                url: '../pages/ajaxdata.php',
                data: {
                    pn: id
                },
                success: function(data) {
                    $('#fifth_dropdown').html(data)
                }
            })
        }
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>