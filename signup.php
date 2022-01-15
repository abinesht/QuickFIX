<?php
require("./classes.php");

session_start();
$signUpper = new SignUpper();
$error = "";

if (array_key_exists("SignupProfilePic", $_FILES)){
    $error = $signUpper->uploadProfilePic($_FILES["SignupProfilePic"]);
}

if (array_key_exists("signup", $_POST)) {
    $error = $signUpper->register($_POST);
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!-- Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="http://fonts.cdnfonts.com/css/quikhand" rel="stylesheet">
    <link href="//db.onlinewebfonts.com/c/3a025ae92e6446cec24efcb6d29e5bf3?family=Malgun+Gothic" rel="stylesheet" type="text/css" />
    <title>Signup</title>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="./location_picker.js"></script>
    <link rel="stylesheet" href="./Assets/Css/signup.css">
    <link rel="stylesheet" href="./Assets/Css/locationSelect.css">
</head>

<body class="">
    <div class="row m-0  vh-100">
        <div id="leftside" class="col-md-7 col-lg-8">
            <button type="button" class="btn btn-primary float-end m-4 rounded-pill px-4 help">Help</button>
            <div style="margin-left: 8%; margin-top: 15px;">
                <img src="Assets/Images/logo.jpg" alt="" width="120" height="69">
            </div>
            <div class="" id="cu-signup">
                <h2>CUSTOMER SIGNUP</h2>
            </div>
            <div class="mt-2 text-center" id="changeProfile" style="margin-left:25px;">
                <form action="" method="POST" enctype="multipart/form-data" id="SignupProfilePicForm">
                    <input type="file" id="SignupProfilePic" name="SignupProfilePic" class="SignupInputFile">
                    <label for="SignupProfilePic" ><img class="SignupDp" src= <?php echo $signUpper->getImg()?> alt="" width="50" height="50"></label>
                </form>
            </div>
            
            <div class="signup-body" style="margin-left:50px; margin-right:50px;">
                <form method="POST">
                    <div class="row" style="margin-left: 10px;">
                        <div class="row">
                            <div class="col-sm-6 form-group m-3 mb-4 mx-auto">
                                <input type="text" class="form-control" name="fname" id="name-f" placeholder="FIRST NAME" required>
                                <input class="form-control" type="text" value=<?php echo $signUpper->getImg(); ?> name="img" hidden>
                            </div>
                            <div class="col-sm-6 form-group m-3 mb-4 mx-auto">
                                <input type="text" class="form-control" name="lname" id="name-l" placeholder="LAST NAME" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group m-3 mb-4 mx-auto">
                                <input type="email" class="form-control" name="email" id="email" placeholder="EMAIL" required>
                            </div>
                            <div class="col-sm-6 form-group m-3 mb-4 mx-auto">
                                <input class="form-control" type="tel" id="phoneno" name="phoneno" placeholder="PHONE NUMBER" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group m-3 mb-4 mx-auto ">
                                <input type="text" class="form-control" name="username" id="username" placeholder="USER NAME" required>
                            </div>

                            <div class="col-sm-6">
                                <div class="input-group form-group input-group m-3 mb-4 mx-auto">
                                    <input type="text" class="form-control " name="address" id="address" placeholder="ADDRESS" style="border-right: none;" required>
                                    <span class="input-group-text map"><i class="fas fa-map-marker-alt" data-bs-toggle="modal" data-bs-target="#staticBackdropSignup"></i></span>
                                    <input class="col-6" type="text" name="lng" id="lng" value="" required hidden>
                                    <input class="col-6" type="text" name="lat" id="lat" value="" required hidden>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class=" form-group input-group m-3 mb-4 mx-auto">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="PASSWORD" style="border-right: none;">
                                    <span class="input-group-text eye"><i id="eye-icon-open-p" class="fas fa-eye eye-icon-p"></i><i class="fas fa-eye-slash eye-icon-p"></i></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group input-group m-3 mb-2 mx-auto">
                                    <input type="password" id="cpassword" name="confirmpassword" class="form-control" placeholder="CONFIRM PASSWORD" style="border-right: none;">
                                    <span class="input-group-text eye"><i id="eye-icon-open-cp" class="fas fa-eye eye-icon-cp"></i><i class="fas fa-eye-slash eye-icon-cp"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class=" text-center"><button type="submit" class="btn btn-primary rounded-pill px-5 mt-2 help" id = "registerBtn" name="signup">Register</button></div>
                        <div class="text-center pt-3">
                            <p><b>Have an account? <a id="Loginacc" href="./login.php"><i>Login</i></a></b></p>
                        </div>

                        <?php if ($error != "") {
                            echo '<div class="alert alert-danger" role="alert" style="text-align:center; font-weight:bold;">' . $error . '</div>';
                        } ?>
                        <div class="alert alert-danger" id ="locationError" role="alert" style="text-align:center; font-weight:bold; display:none;" >Pick Your Location By Clicking The Location Icon</div>

                    </div>
                </form>
            </div>
        </div>
        <div id="rightside" class="col-md-5 col-lg-4">
            <div class="trans-box" style="height: 100%;">
                <div class="p-5">
                    <div id="weare" style="margin-top: 100px;">
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
    </div>


    <div class="modal fade" id="staticBackdropSignup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #142F61; color: white;">
                    <h5 class="modal-title" id="address-label-title">Choose your location</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1;"></button>
                </div>
                <form>
                    <div class="modal-body ">
                        <div id="tradesman_map " class="row mx-3 p-0">

                            <!--div id="fixed_map"></div-->
                            <div style="width: 100%; height: 300px;" id="map"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary done" data-bs-dismiss="modal">Done</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2psniVzC9cwc5r1b6xt3ggfhFUt0DvsA&callback=initMap"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(".eye-icon-cp").click(function() {
            if ($("#cpassword").attr("type") === "password") {
                $("#cpassword").attr("type", "text");
            } else {
                $("#cpassword").attr("type", "password");
            }
            $(".eye-icon-cp").css("display", "block");
            $(this).css("display", "none");
        });

        $(".eye-icon-p").click(function() {
            if ($("#password").attr("type") === "password") {
                $("#password").attr("type", "text");
            } else {
                $("#password").attr("type", "password");
            }
            $(".eye-icon-p").css("display", "block");
            $(this).css("display", "none");
        });

        document.getElementById("SignupProfilePic").onchange = function() {
            document.getElementById("SignupProfilePicForm").submit();
        };

        $("#registerBtn").click(function(){
           if(($("#lat").val()== "" )|| ($("#lng").val()== "" )) {
                $("#locationError").css("display", "block");
           }

        });

        initMap(9.6615,  80.0255);
    </script>

</body>

</html>