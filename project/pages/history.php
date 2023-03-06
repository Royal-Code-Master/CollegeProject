<?php

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}

include '../database/connection.php';
$select_bundle_exam = "select * from collect_bundles";
$select_bundle_exam_result = mysqli_query($con, $select_bundle_exam);


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

    #row_desc1 {
        background-color: rgba(99, 22, 172, 0.919);
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
            <h5 class="p-3 text-dark"><strong>Subject Details</strong></h5>
            <div class="container">
                <form method="post" class="row p-2 mb-4" id="row_desc1">
                    <div class="col-md-5">
                        <select class="form-select form-select-m" name="ex" id="" required onchange="getExam(this.value)">
                            <option></option>
                            <!-- exam name -->
                            <?php
                            if (mysqli_num_rows($select_bundle_exam_result) > 0) {
                                while ($row = mysqli_fetch_assoc($select_bundle_exam_result)) {
                                    echo '<option value = ' . $row['exam_names'] . ' >' . $row['exam_names'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select class="form-select form-select-m" name="fn" id="fname" required>

                        </select>
                    </div>

                    <div class="col-md-2">
                        <button type="submit" name="history" class="form-control btn btn-light">search</button>
                    </div>

                </form>
                <!-------------- data ----------------->

                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead style="background-color: white !important;">
                            <tr>
                                <th scope="col">SI.NO</th>
                                <th scope="col">Examination</th>
                                <th scope="col">Faculty Name</th>
                                <th scope="col">Subcode</th>
                                <th scope="col">BundleNumber</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            if (isset($_POST['history'])) {

                                $data_select1 = $_POST['ex'];
                                $data_select2 = $_POST['fn'];
                                $select_valuator = "select * from collect_bundles where exam_names ='$data_select1' and faculty = '$data_select2'";
                                $query_run = mysqli_query($con, $select_valuator);
                                $count = mysqli_num_rows($query_run);
                                if ($count > 0) {
                                    foreach ($query_run as $items) {
                                        $i = $i + 1;
                            ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $items['exam_names'] ?></td>
                                            <td><?php echo $items['faculty'] ?></td>
                                            <td><?php echo $items['subject_codes'] ?></td>
                                            <td><?php echo $items['bundle_number'] ?></td>

                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr id="not">
                                        <td colspan="10" style="color: white;">
                                            <center style="font-family:Cambria;color:black;">
                                                Alert msessage : No student data is available right now.
                                            </center>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
            <br>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
            function getExam(id) {

                $('#fname').html('');
                $.ajax({
                    type: 'post',
                    url: '../pages/history_ajax.php',
                    data: {
                        fn: id
                    },
                    success: function(data) {
                        $('#fname').html(data)
                    }
                })
            }
        </script>




        <!-- bootstrap js -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>