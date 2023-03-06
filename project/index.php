<!-----------------------Style sheet llinks -------------------------->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!---------------------------icons------------------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">


<?php

// database connection.
include './database/connection.php';

session_start();

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    header("Location: ./pages/home.php");
    exit();
} else {

    // checking user conformation
    if (isset($_POST['user_login'])) {

        $data_user_name = $_POST['user_name'];
        $data_password = $_POST['user_password'];
        $data_user_type = $_POST['user_type'];

        // select query.
        $select_query = "SELECT * FROM login where username='$data_user_name'";
        $result = mysqli_query($con, $select_query);
        $row_data = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($data_user_name == $row_data['username'] && $data_password == $row_data['passwords'] && $data_user_type == $row_data['usertype']) {

            // session checking
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $data_user_name;

            // success msgs.
            
            echo '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <center style="margin-top:7.74px; color:green; font-size:17.74px;"><strong>login success</strong> Redirecting to Spot Center Coordinators Portal. </center>
                </div>      
                <br>
                <center><br><br><br><br><br><br>
                    <div class="mt-5">
                        <div class="spinner-grow text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-secondary" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-success" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-warning" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-info" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="spinner-grow text-dark" role="status">
                        <span class="visually-hidden">Loading...</span>
                       </div>
                    </div>
                </center>
            ';

            header('Refresh: 6; ./pages/home.php');
            exit();
        } else {
            echo '
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <center><strong>User Alert </strong> User login failed please check once</center>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
        }
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
    <link rel="shortcut icon" href="./images/logo.png" type="image/x-icon">


    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to JNTUGV Vizianagaram.</title>

</head>


<!---------- page style ------------>

<style>
    body {

        margin: 0px;
        padding: 0px;
        z-index: -1;
    }

    #logo {
        height: 105px;
        width: 105px;
    }

    #clg1 {
        margin-top: 3px;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        font-weight: bold;
        font-size: 28.25px;
        word-spacing: 1.5px;
        color: rgb(78, 4, 147);
    }

    #clg2 {
        color: black;
    }

    #clg_img {
        height: 360px;
        width: 400px;
        background-repeat: no-repeat;
        background-size: 100%, 100%;
    }

    label {
        color: black;
        font-weight: 600;
        font-family: 'Times New Roman', Times, serif;
    }

    input {
        color: black !important;
        font-weight: 600;
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        font-size: 15.74px !important;
    }

    #login {
        text-align: center;
        font-weight: bolder;
    }

    #login:hover {
        background-color: whitesmoke;
        border: 2px solid navy;
        color: navy;
        font-weight: bolder;
    }

    /*#clg_box{*/
    /*    box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;*/
    /*}*/
</style>


<body>
    <!--- aos animation -->
    <script>
        AOS.init({
            duration: 2400,
        });
    </script>

    <div class="content">
        <div class="container" data-aos="fade-down">
            <!---logo and college description -->
            <div class="row mt-1">
                <div class="col-md-12 text-center">
                    <img src="./images/logo.png" alt="JNTUGV_LOGO" srcset="" id="logo" class="mt-5">
                    <h3 id="clg1"><strong class="mt-1">JNTU-GV COLLEGE OF ENGINEERING, VIZIANAGARAM</strong></h3>
                    <h6 id="clg2"><strong class="mt-1">Examination Branch - Spot Validation Management System</strong>
                    </h6>
                </div>
            </div>

            <div class="row mt-4" style="border: 2px solid #e2e2e2;">
                <div class="col-md-6" style="    background: #042c56;border: 0 solid rgba(0,0,0,.125);    padding: 40px;box-shadow: 0 0 1px rgb(0 0 0 / 13%), 0 1px 3px rgb(0 0 0 / 20%);">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <img src="./images/college.png" style="width:100%;height:300px;padding-top: 10px; ">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-8 mb-3">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row mt-3 mb-2">
                                    <label class="p-2"><i class="fa fa-user"></i>&nbsp;User Name</label>
                                    <input type="text" name="user_name" id="" class="form-control" required placeholder="Enter Username">
                                </div>
                                <div class="row mt-2 mb-2">
                                    <label class="p-2"><i class="fa fa-lock"></i>&nbsp;Password</label>
                                    <input type="password" name="user_password" id="" class="form-control" required placeholder="Enter Password">
                                </div>
                                <div class="row mt-2 mb-2">
                                    <label class="p-2"><i class="fa fa-list"></i>&nbsp;Admin Type</label>
                                    <select id="user_type" name="user_type" class="form-control" required>
                                        <option value="">---Select---</option>
                                        <option value="DE">Director of Evaluation</option>
                                        <option value="CE">Controller of Examinations</option>
                                        <option value="ACE">Addl Controller of Examinations</option>
                                        <option value="SPOT">Spot Center Coordinators</option>
                                    </select>
                                </div>
                                <br>
                                <center><button type="submit" class="btn btn-primary mt-2 mb-1" id="login" name="user_login">User
                                        login</button></center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>



    <!-- bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>


    <script type="text/javascript">
        document.addEventListener("contextmenu", function(event) {
            event.preventDefault();
        });
    </script>

</body>


</html>