<?php
require ("./classes.php");
session_start();
//session_unset();
if (array_key_exists('customer_id',$_SESSION)) {
    if($_SESSION["is_worker"]==1){
        header("Location: tradesmanHome.php?Home=");
    }
    else{
        header("Location: customerHome.php?Home=");
    }
}
$error = "";
$success = "";

//$mysqli = new mysqli("localhost", "root", "", "quickfix");

//if ($mysqli -> connect_error) {
    //echo "Error";
//}
if (array_key_exists("login", $_POST)) {
    if ($result = QueryHandler::query("SELECT `password` FROM `admin` WHERE username = '".$_POST["username"]."' LIMIT 1")){
        if ($result -> num_rows == 1) {
            $row = $result->fetch_assoc();
            if($_POST["password"] == Password::decrypt($row["password"])){
                //$_SESSION["customer_id"]=$row["customer_id"];
                //$_SESSION["login"]=1;
                header("Location: Admin/dashboard.php");
            } 
            else{
                $error = "Password wasn't matched";
            }
        }

        else if ($result = QueryHandler::query("SELECT `password`,`customer_id`,`is_worker` FROM `customer` WHERE username = '".$_POST["username"]."' LIMIT 1")) {
            if ($result -> num_rows == 1) {
                $row = $result->fetch_assoc();
                if($_POST["password"] == Password::decrypt($row["password"])){
                    $_SESSION["customer_id"]=$row["customer_id"];
                    $_SESSION["login"]=1;
                    $_SESSION["is_worker"]=$row["is_worker"];
                    if($row["is_worker"]==1){
                       header("Location: tradesmanHome.php?Home=");
                    }
                    else{
                        header("Location: customerHome.php?Home=");
                    }
                } 
                else{
                    $error = "Password wasn't matched";
                }
            }
            else if ($result -> num_rows == 0) { 
                $error = "Username doesn't exist";
            }
        }
        else{
            $error = "Something went wrong.Try again";
        }
}
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <title>Login</title>
    <link rel="stylesheet" href="Assets/Css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Extra Fonts  -->
    <link href="http://fonts.cdnfonts.com/css/quikhand" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/3a025ae92e6446cec24efcb6d29e5bf3?family=Malgun+Gothic" rel="stylesheet"
        type="text/css" />

</head>

<body>

    <div class="row m-0 vh-100 vw-100">
        <!-- left side-->
        <div id="leftside" class="col-sm-7 col-md-7 col-lg-8">
            <div class="trans-box vh-100">
                <div class="p-5">
                    <a class="navbar-brand" href="#">
                        <img src="Assets/Images/logo_footer.png" alt="" width="130" style="background-size: cover;">
                    </a>
                </div>
                <div class="p-5">
                    <div id="weare">
                        WE ARE HERE
                    </div>
                    <div id="tohelp">
                        TO HELP
                    </div>
                    <div id="you">
                        YOU
                    </div>
                </div>
            </div>
        </div>

        <!-- Rigth side -->
        <div class="col-sm-5 col-md-5 col-lg-4 vh-100 px-0">
            <button type="button" class="btn btn-primary float-end m-5 rounded-pill px-4 help">Help</button>

            <div class="login-body">
                <div id="login" class="" style="margin-left: 13%;">
                    <h2 style="margin-top: 150px;">LOGIN</h2>
                </div>

                <form method="POST">
                    <div class="input-group flex-nowrap m-3 p mb-4 w-75 mx-auto mt-5">
                        <span class="input-group-text input-icon" id="addon-wrapping"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Username" name="username" aria-label="Username"
                            aria-describedby="addon-wrapping" required>
                    </div>

                    <div class="input-group flex-nowrap m-3 mb-2 w-75 mx-auto">
                        <span class="input-group-text input-icon" id="addon-wrapping"><i class="fas fa-key"></i></span>
                        <input type="password" id="password" class="form-control" name="password" placeholder="Password"
                            aria-label="password" aria-describedby="addon-wrapping" style="border-right: none;" required>
                        <span class="input-group-text eye" id="addon-wrapping"><i id="eye-icon-open"
                                class="fas fa-eye eye-icon"></i><i class="fas fa-eye-slash eye-icon "></i></span>

                    </div>
                    <div class="mt-3"><a id="forgot" href="#">Forgot Password?</a></div>
                    <div class="float_clear"></div>
                    <div class="mt-2 text-center"><button type="submit"
                            class="btn btn-primary rounded-pill px-5 mt-2 help" name="login">Login</button></div>
                    <div class="text-center pt-3">
                        <p><b>Don't have an account? <a id="Signup" href="./signup.php"><i>Signup</i></a></b></p>
                    </div>
                </form>
                
                <?php if ($error != "") {
                        echo '<div class="alert alert-danger mx-4" role="alert" style="text-align:center; font-weight:bold;">' . $error . '</div>';
                } ?>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(".eye-icon").click(function () {
            if ($("#password").attr("type") === "password") {
                $("#password").attr("type", "text");
            } else {
                $("#password").attr("type", "password");
            }
            $(".eye-icon").css("display", "block");
            $(this).css("display", "none");
        });
    </script>

</body>

</html>