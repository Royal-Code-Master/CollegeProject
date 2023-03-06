<?php

session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../index.php");
    exit();
}

// updating the data.

include '../database/connection.php';

$u_id = $_SESSION['username'];

if (isset($_POST['update_user'])) {

    // get data.
    $newuser = $_POST['user_name'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // select user
    $select_stmt = "select * from login where username ='$u_id'";
    $result_stmt = mysqli_query($con, $select_stmt);
    $user_data = mysqli_fetch_assoc($result_stmt);
    $newuser_id = $user_data['id'];

    $update_stmt = "UPDATE login SET username = '$newuser', passwords = '$new_password' WHERE id = $newuser_id";
    if (mysqli_query($con, $update_stmt)) {
        $_SESSION['username'] = $newuser;

        echo '
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
             <center><strong>User Alert </strong> Updation Successfully Done</center>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
    } else {
        echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <center><strong>User Alert </strong> Updation Failed. Something went Wrong.</center>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        ';
    }
}

$con->close();

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
        max-width: 374px;
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }

    label {
        text-align: left;
        color: black;
        font-weight: 500;
    }
</style>

<body>

    <!--------------- aos animation ---------------->
    <script>
        AOS.init({
            duration: 2400,
        });
    </script>


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
    

    <div class="hero_section">
        <div class="container bg-light p-1">
            <center>
                <form action="" method="post" class="form-control mt-3 p-3" enctype="multipart/form-data" data-aos="slide-up">
                    <i class="fa fa-lock fa-3x mb-2" style="color: green; height: 65px; width: 65px;"></i>
                    <p class="p-3">Update Your Password</p>
                    <div class="row form-control mb-2">
                        <label for="" class="p-1"> User Name</label>
                        <input type="text" class="form-control" name="user_name" id="" required placeholder="Enter User Name">
                    </div>
                    <div class="row form-control mb-2">
                        <label for="" class="p-1">New Password</label>
                        <input type="password" class="form-control" name="new_password" id="" required placeholder="Enter New Password">
                    </div>

                    <div class="row form-control mb-2">
                        <label for="" class="p-1">Confirm Password</label>
                        <input type="text" class="form-control" name="confirm_password" id="" required placeholder="Enter Confirm Password">
                    </div>
                    <button type="submit" class="form-control btn btn-primary mt-3 mb-2" name="update_user">Update Password</button>
                    <button type="reset" class="form-control btn btn-dark mt-3 mb-2" name="">Cancel</button>
                </form>
            </center>
            <br>
        </div>
    </div>
    <br>
    </div>






    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>



</body>

</html>