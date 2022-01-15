<?php
include("header.php");
$error = "";
$dperror = "";
$success = array();
if (array_key_exists("profilePic", $_FILES)){
    $dperror = $user->uploadProfilePic($_FILES["profilePic"]);

}

if (array_key_exists("submit", $_POST)) {
    $status = $user->editProfile($_POST);
    $success = $status["success"];
    $error = $status["error"];
}


function createSuccessMsg($success)
{
    $successMsg = "";
    $length = count($success);
    for ($i = 0; $i < $length - 1; $i++) {
        if ($length == 2) {
            continue;
        }
        $successMsg .= $success[$i] . ", ";
    }
    if ($length > 2) {
        $successMsg = trim($successMsg, ", ");
        $successMsg .= " and " . $success[$length - 1] . " were successfully updated.";
    } else if ($length == 2) {
        $successMsg .= $success[$length - 2] . " and " . $success[$length - 1] . " were successfully updated.";
    } else if ($length == 1) {
        $successMsg .= $success[0] . " was successfully updated.";
    }

    return $successMsg;
}
?>

<html>

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>Profile</title>

    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="./location_picker.js"></script>

    <link rel="stylesheet" href="Customer/Assets/Css/customerEditProfile.css">
    <link rel="stylesheet" href="Customer/Assets/Css/locationSelect.css">
    <link rel="stylesheet" href="Assets/Css/header.css">
    <link rel="stylesheet" href="Tradesman/Assets/Css/workerSignup.css">

</head>

<body>
    <div class="bodyDiv">
        <div id="cu-edit">
            <h4>EDIT PROFILE</h4>

        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-7 mb-4 card1 " style="margin-left:48px; margin-right: 65px;">
                <div class="row card " style="text-align: center;">
                    
                    <img src=<?php echo $user->getImg();?> class="card-img-top px-0" alt="">
                    
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $user->getUsername(); ?></h5>
                        <form action="" method="POST" enctype="multipart/form-data" id="profilePicForm">
                            <input type="file" id="profilePic" name="profilePic" class="inputfile">
                            <label for="profilePic" class="btn btn-primary mt-2 rounded-pill px-4 upload">Upload Profile</label>
                        </form>
                    </div>
                    <?php if ($dperror != "") {
                    echo '<div class="alert alert-danger m-2" role="alert" style="text-align:center; font-weight:bold;">' . $dperror . '</div>';
                    } ?>
                </div>
                <form class="form-horizontal" role="form" method="POST">
                <?php 
                    if(strcmp(get_class($user), "Tradesman") == 0){
                        echo '<div class="row card">';
                        include "Customer/changePassword.php";
                        echo '</div>';

                    }
                ?>
                
                    
              

            
            </div>

            <div class="col-lg-7 col-md-7 col-sm-12">
                <div class="card p-5" style="width: 100%; height:95% ; text-align: left;">
                    <div>
                        <div id="ac-inform">
                            <h5 style="text-align:left" class="ml-5">Account Information</h5>
                        </div>
                        <div>
                            <!--form class="form-horizontal" role="form" method="POST"-->
                                <div class="form-group row my-3">
                                    <label class="col-lg-3 col-md-4 col-sm-4 control-label mt-1 text-sm-left">First
                                        name:</label>
                                    <div class="col-lg-9 col-md-6 col-sm-8 col-xs-4 ">
                                        <input class="form-control" type="text" value=<?php echo $user->getFirstname(); ?> name="fname">
                                    </div>
                                </div>

                                <div class="form-group row my-3 ">
                                    <label class="col-lg-3 col-md-4 col-sm-4 control-label mt-1">Last name:</label>
                                    <div class="col-lg-9 col-md-6 col-sm-8 col-xs-4">
                                        <input class="form-control" type="text" value=<?php echo $user->getLastname(); ?> name="lname">
                                        <input class="form-control" type="text" value=<?php echo $user->getTmp_image(); ?> name="img" hidden>
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-lg-3 col-md-4 col-sm-4 control-label mt-1 text-sm-left">User name:</label>
                                    <div class="col-lg-9 col-md-6 col-sm-8 col-xs-4 ">
                                        <input class="form-control" type="text" value=<?php echo $user->getUsername(); ?> disabled="disabled" name="username">
                                    </div>
                                </div>
                                <div class="form-group row my-3">
                                    <label class="col-lg-3 col-md-4 col-sm-4  control-label mt-1">Email:</label>
                                    <div class="col-lg-9 col-md-6 col-sm-8 col-xs-4">
                                        <input class="form-control " disabled="disabled" type="text" value=<?php echo $user->getEmail(); ?> name="email">
                                    </div>
                                </div>
                                <div class="form-group row my-3 ">
                                    <label class="col-lg-3 col-md-4 col-sm-4  control-label mt-1">Phone no:</label>
                                    <div class="col-lg-9 col-md-6 col-sm-8 col-xs-4">
                                        <input class="form-control " type="tel" id="phoneno" value=<?php echo $user->getPhone_no(); ?> name="phoneno">
                                    </div>
                                </div>
                                <div class="form-group row my-3 ">
                                    <label class="col-lg-3 col-md-4 col-sm-4  control-label mt-1">Address:</label>
                                    <div class="col-lg-9 col-md-6 col-sm-8 col-xs-4">
                                        <div class="input-group">
                                            <input class="form-control" id ="address" type="text" value=<?php echo '"' . $user->getAddress() . '"'; ?> name="address">
                                            <span class="input-group-text map"><i class="fas fa-map-marker-alt" data-bs-toggle="modal" data-bs-target="#staticBackdropAddress"></i></span>
                                            <input class="col-6" type="text" name="lng" id="lng" value=<?php echo '"' . $user->getLongitude() . '"'; ?> hidden>
                                            <input class="col-6" type="text" name="lat" id="lat" value=<?php echo '"' . $user->getLatitude() . '"'; ?> hidden>
                                        </div>
                                    </div>
                                </div>

                                <?php 
                                    if(strcmp(get_class($user), "Customer") == 0){
                                        include "Customer/changePassword.php";
                                       
                                    }
                                    if(strcmp(get_class($user), "Tradesman") == 0){
                                        include "Tradesman/workerExtra.php";
                                       
                                    }
                                ?>
                
                               
                                <?php if ($error != "") {
                                    echo '<div class="alert alert-danger" role="alert" style="text-align:center; font-weight:bold;">' . $error . '</div>';
                                } ?>
                                <?php if (createSuccessMsg($success) != "") {
                                    echo '<div class="alert alert-success" role="alert" style="text-align:center; font-weight:bold;">' . createSuccessMsg($success) . '</div>';
                                } ?>
                                <div class="mt-2 text-center"><button type="submit" class="btn btn-primary rounded-pill px-5 mt-2 savechanges" name="submit" value="submit">Save Changes</button></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="modal fade" id="staticBackdropAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #142F61; color: white;">
                        <h5 class="modal-title" id="address-label-title"><?php echo $user-> getAddress();?></h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="opacity: 1;"></button>
                    </div>
                    <form>
                        <div class="modal-body ">
                            <div id="tradesman_map " class="row mx-3 p-0">

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
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2psniVzC9cwc5r1b6xt3ggfhFUt0DvsA&callback=initMap"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script-->
    <script type="text/javascript">

        $(".eye-icon-cup").click(function() {
            if ($("#currentpassword").attr("type") === "password") {
                $("#currentpassword").attr("type", "text");
            } else {
                $("#currentpassword").attr("type", "password");
            }
            $(".eye-icon-cup").css("display", "block");
            $(this).css("display", "none");
        });

        $(".eye-icon-cip").click(function() {
            if ($("#confirmpassword").attr("type") === "password") {
                $("#confirmpassword").attr("type", "text");
            } else {
                $("#confirmpassword").attr("type", "password");
            }
            $(".eye-icon-cip").css("display", "block");
            $(this).css("display", "none");
        });

        $(".eye-icon-np").click(function() {
            if ($("#newpassword").attr("type") === "password") {
                $("#newpassword").attr("type", "text");
            } else {
                $("#newpassword").attr("type", "password");
            }
            $(".eye-icon-np").css("display", "block");
            $(this).css("display", "none");
        });

        document.getElementById("profilePic").onchange = function() {
            document.getElementById("profilePicForm").submit();
        };

        initMap(<?php echo $user->getLatitude();?>,<?php echo $user->getLongitude();?>);
    </script>

</body>
</html>


