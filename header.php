<?php
include "classes.php";
session_start();

if (!array_key_exists("customer_id", $_SESSION)) {
    header("Location: login.php");
} else {
    $tradesman;
    $customer;
    $user;
    $customer = Customer::getInstance($_SESSION["customer_id"]);

    if ($customer->getIs_worker() == 1) {
        $tradesman = Tradesman::getInstance($_SESSION["customer_id"]);
        if (array_key_exists("login", $_SESSION)) {
            $tradesman->login();
            unset($_SESSION['login']);
        }
        if (array_key_exists("toggle", $_POST)) {
            $tradesman->toggle();
        }

        if (array_key_exists("switch", $_POST)) {
            $tradesman->switch();
            if ($tradesman->getState() instanceof TradesmanAsTradesman) {
                header("Location: tradesmanHome.php?Home=?");
            }else{
                header("Location: customerHome.php?Home=?");
            }
        }
        if (isset($tradesman) && ($tradesman->getState() instanceof TradesmanAsTradesman)) {
            $user = $tradesman;
        } else {
            $user = $customer;
        }
    } else {
        $user = $customer;
    }
}

if (array_key_exists("logout", $_GET)) {
    $user->logout("login.php");
}

if (array_key_exists("registerSubmit", $_POST)) {
    $user->registerAsTradesman($_POST);
}


$searchError = "";
if (array_key_exists("search", $_POST)) {
    if (!($user->search($_POST["search"]))) {
        $searchError = "Such a service or tradesman doesn't exist";
    }
}


function hidefor($userType, $user)
{
    if (((strcmp(get_class($user), "Customer") == 0) && ($userType == UserType::CUSTOMER)) || ((strcmp(get_class($user), "Tradesman") == 0) && ($userType == UserType::TRADESMAN))) {
        echo "hidden";
    }
} ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> <!--  This script for dropdown notification view. is I comment this, dropdown not visible. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <title>QuickFIX</title>
    <link rel="stylesheet" href="./Assets/Css/header.css">
    <link rel="stylesheet" href="./Tradesman/Assets/Css/workerSignup.css">
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="./index.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light static-top" style="margin:0px; padding:0px; height:80px;">
        <div class="container-fluid" style="margin:0px;">

            <!-- Nav bar logo-->
            <a class="navbar-brand px-2" href="#">
                <img src="Assets/Images/logo.jpg" alt="" width="90" height="51.25">
            </a>

            <!-- Search bar-->
            <form class="d-flex">
                <div class="form-group has-search" style="margin-right:50px ;" <?php hidefor(UserType::TRADESMAN, $user); ?>>
                    <span class="fa fa-search form-control-feedback"></span>
                    <input id="searchbar" class="form-control" onkeyup="searchme()" type="search" placeholder="Search for services,peoples..." aria-label="Search" aria-describedby="search-icon" style="border-radius: 16px;padding-left: 2.375rem;background-color: #e9ecef;">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <!-- <a href="#" id="drop-down" class="dropdown-toggle " data-toggle="dropdown"> -->
                            <!-- </a> -->
                            <ul class="searchmenu-item  m-0 p-0" style="list-style-type: none;"></ul>
                        </li>
                    </ul>

                </div>
            </form>
            <!-- Nav bar menu items-->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav navbar-center mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a id="Home" class="nav-link <?php if (array_key_exists("Home", $_GET)) {echo 'active-header';} ?>" 
                        aria-current="page" href="
                        <?php if (get_class($user)=="Customer") {
                                echo './customerHome.php?Home=';
                            } else {
                                echo './tradesmanHome.php?Home=';} 
                        ?>" style="color:black; text-align:center">Home</a>
                    </li>
                    <li class="nav-item" <?php hidefor(UserType::TRADESMAN, $user); ?>>
                        <a id="Services" class="nav-link <?php if (array_key_exists("Service", $_GET)) {
                                                                echo 'active-header';
                                                            } ?>" href="./customerServicesView.php?Service=" style="color:black; text-align:center">Services</a>
                    </li>
                    <li class="nav-item">
                        <a id="MyHirings" class="nav-link <?php if (array_key_exists("Hirings", $_GET)) {
                                                                echo 'active-header';
                                                            } ?>" href="<?php if (get_class($user)=="Customer") {
                                                                echo './customerMyHirings.php?Hirings=';
                                                            } else {
                                                                echo './tradesmanMyHirings.php?Hirings=';} 
                                                        ?>" style="color:black; text-align:center">MyHirings</a>
                    </li>
                    <li class="nav-item" <?php hidefor(UserType::TRADESMAN, $user); ?>>
                        <a class="nav-link <?php if (array_key_exists("Aboutus", $_GET)) {
                                                echo 'active-header';
                                            } ?>" href="./AboutUs.php?Aboutus=" style="color:black; text-align:center">AboutUs</a>
                    </li>
                </ul>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" id="drop-down1" class="dropdown-toggle btn btn-danger" data-toggle="dropdown">
                        <span class="material-icons "> notifications</span>
                        <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                        <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span>
                    </a>
                    <ul id="notification_ul" class="dropdown-menu overflow-auto" style="margin-left: -200px; min-width: 18rem;">

                    </ul>

                </li>
            </ul>


            <!-- Profile icon with dropdown-->
            <ul class="Profile nav-item dropdown" style="margin-top: 15px;">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black;">
                    <img class="HeaderDp" src=<?php echo $user->getImg(); ?> alt="" width="50" height="50">

                </a>
                <ul class="dropdown-menu px-3" aria-labelledby="navbarDropdown" style="margin-left: -175px; min-width: 18rem; z-index:1">
                    <div class="row">
                        <div class="col-3"><img class="HeaderDp" src=<?php echo $user->getImg(); ?> alt="" width="50" height="50"></div>
                        <div class="col-9">
                            <div class="row"><span class="dropdownp"><?php echo $user->getFirstname(); ?></span></div>
                            <div class="row"><span class="dropdownp"><?php echo $user->getLastname(); ?></span></div>
                        </div>

                    </div>
                    <div class="text-center" <?php hidefor(UserType::CUSTOMER, $user); ?>>
                        <div class="d-inline-block mx-2 dropdownp">Offline</div>
                        <div class="form-check form-switch d-inline-block form-switch-xl mb-0 mt-1">
                            <form method="POST">
                                <input type="checkbox" class="form-check-input mt-0" id="site_state" style="cursor: pointer;" <?php if (($user instanceof Tradesman) && ($user->isOnline())) {
                                                                                                                                    echo 'checked';
                                                                                                                                } ?>>
                                <label for="site_state" class="form-check-label dropdownp mx-2">Online</label>
                                <button type="submit" id="toggleBtn" name="toggle" value="1" hidden></button>
                            </form>
                        </div>
                    </div>
                    
                    
                    <div class="mt-1 text-center mb-1"><a href="customerEditProfile.php" role="button" class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" name="editprofile">Edit Profile</a></div>
                    
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN, $user); ?>><?php echo $user->getPhone_no(); ?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN, $user); ?>><?php echo $user->getEmail(); ?></div>
                    <hr style="height:4px; border:none; color:#142F61;" <?php hidefor(UserType::TRADESMAN, $user); ?>>

                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN, $user); ?>> Customer Since -<?php echo date("Y M", strtotime($user->getRegistered_date())); ?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN, $user); ?>> Total Hirings -<?php echo $user->getTotal_hirings_count(); ?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN, $user); ?>> Total Payment -<?php echo $user->getTotal_payment(); ?></div>
                    <hr style="height:4px; border:none; color:#142F61;" <?php hidefor(UserType::TRADESMAN, $user); ?>>
                    <div class="mt-1 text-center mb-2">
                        <form method="POST">
                            <button class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" type="submit" name="switch" value="switch" <?php if ($user->getIs_worker() == UserType::CUSTOMER) {
                                                                                                                                                echo 'hidden';
                                                                                                                                            } ?>><?php
                                                                                                                                                    if ($user->getIs_worker() == UserType::TRADESMAN) {
                                                                                                                                                        if (strcmp(get_class($user), "Customer") == 0) {
                                                                                                                                                            echo "Switch as Tradesman";
                                                                                                                                                        } else {
                                                                                                                                                            echo "Switch as Customer";
                                                                                                                                                        }
                                                                                                                                                    } ?>
                            </button>
                        </form>
                    </div>
                    <div class="text-center mb-2"><button class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" data-bs-toggle="modal" data-bs-target="#staticBackdropRAC" <?php if ($user->getIs_worker() == UserType::TRADESMAN) {
                                                                                                                                                                                        echo 'hidden';
                                                                                                                                                                                    } ?>>Register as Tradesman</button></div>
                    
                    <?php
                        $ongoinghref="#";
                        $id = $user->getCustomer_id();
                        if (get_class($user)=="Customer") {
                            $query = "SELECT `hiring_id` FROM `hiring` WHERE customer_id = $id AND final_status = 'On going' ORDER BY hiring_id DESC LIMIT 1";
                            $result = QueryHandler::query($query);
                            if ($result->num_rows ==1) {
                                $row=$result->fetch_assoc();
                                $hid=$row["hiring_id"];
                                $ongoinghref = "chatCustomer.php?hiring_id=$hid";
                            }
                        }else{
                            $query =  "SELECT `hiring_id` FROM `hiring` WHERE tradesman_id = $id AND final_status = 'On going' ORDER BY hiring_id DESC LIMIT 1";
                            $result = QueryHandler::query($query);
                            if ($result->num_rows ==1) {
                                $row=$result->fetch_assoc();
                                $hid=$row["hiring_id"];
                                $ongoinghref = "chatTradesman.php?hiring_id=$hid";
                            }

                        }
                    ?>
                    
                    <div class="mt-1 text-center mb-2" ><a href= <?= $ongoinghref ?> role="button" class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" name="On-going Hiring">On-going Hiring</a></div>
                    <div class="text-center mb-1"><a href="header.php?logout=" role="button" class="btn btn-primary rounded-pill dropdownbtn w-100 mt-2" name="logout">Logout</a></div>
                </ul>
            </ul>

            <!-- Toggler icon -->
            <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <?php
    if (!empty($searchError)) {
        echo '<div class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">'
            . $searchError .
            '</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                </div>';
    }

    if (!empty($searchError)) {
        echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>' . $searchError . '</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>         
          ';
    }
    $customer_id = $_SESSION["customer_id"];
    ?>

    <?php include "Tradesman/workerSignup.php"; ?>

    <!--script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <!-- Nav bar active-->
    <script>
        $("#site_state").click(function() {
            $("#toggleBtn").click();
        });

        // $("#searchIcon").click(function(){
        //     $("#searchBtn").click();
        // });

        console.log("kesa");
        $(document).ready(function() {
            console.log("laksi");





            setInterval(function() {
                getCount();
            }, 5000);


            function getCount(view = '') {
                let customer_id = <?php echo $customer_id ?>;
                console.log("get count start");
                $.ajax({

                    url: "countSchedule.php",
                    method: "POST",
                    data: {
                        view: customer_id
                    },
                    dataType: "json",
                    success: function(data) {
                        // $('#msgFromSchedulePage').html(data);
                        console.log("get count success");
                        console.log(data);

                        if (data.unseen_notification > 0) {
                            $('.count').html(data.unseen_notification);
                        }
                    }
                });
            }
            // getCount();

            function insertNotification(type, sheduleID, view = '') {
            console.log("insert notification start");
            console.log(type,sheduleID);
            $.ajax({
                url: "insertC.php",
                method: "POST",
                data: {
                    view: view,
                    type: type,
                    sheduleID: sheduleID
                },
                dataType: "json",
                success: function(data) {
                    load_unseen_notification('yes');
                    console.log("insert notification success");
                    console.log(data);
                }
            });
        }

            function load_unseen_notification(view = '') {
                let tradesman_id = <?php echo $customer_id ?>;
                console.log("load unseen start");
                console.log(tradesman_id);
                $.ajax({
                    url: "fetchOK.php",
                    method: "POST",
                    data: {
                        view: view,
                        tradesman_id: tradesman_id
                    },
                    dataType: "json",
                    success: function(data) {
                        // $('#msgFromSchedulePage').html(data);
                        $('#notification_ul').html(data.notification);
                        // console.log(data.notification);
                        getCount();
                    }
                });
            }
            load_unseen_notification();

            console.log("hiiii");
            $(document).on('click', '#drop-down1', function() {
                console.log("drop down clicked....");
                $('.count').html('');
                load_unseen_notification('yes');
            });

            $(document).on("click", "#done", function() {

                let del = $(this);
                let sheduleID = $(this).attr("data-id");
                console.log("notification id is ");
                console.log(sheduleID);
                let hiring_id;
                $.ajax({
                    type: "get",
                    data: {
                        sheduleID: sheduleID
                    },
                    url: "done_ok.php",
                    success: function(data) {
                        load_unseen_notification();
                        console.log(data);
                        hiring_id = data;
                        // location.href = "http://localhost/quickfix/avines/ongoing/chatCustomer.php?hiring_id=" + hiring_id;

                    }
                });
            });

            $(document).on("click", "#ok", function() {
                console.log("ok clicked");
                let del = $(this);
                let sheduleID = $(this).attr("data-id");
                $.ajax({
                    type: "get",
                    data: {
                        sheduleID: sheduleID
                    },
                    url: "done_ok.php",
                    success: function(data) {
                        console.log("ok clicked success");
                        console.log(data);
                        load_unseen_notification();

                    }
                });
            });
          
            $(document).on("click", "#accept", function() {

                $("#hirehim_modalFinal").modal({
                    show: true
                });
                let del = $(this);
                let sheduleID = $(this).attr("data-id");
                insertNotification("go_ongoing_page", sheduleID);
                let hiring_id;
                console.log("accept clicked");
                $.ajax({
                    type: "get",
                    data: {
                        sheduleID: sheduleID
                    },
                    url: "schedule.php",
                    success: function(data) {
                        load_unseen_notification();
                        hiring_id = data;
                        console.log(data);
                        // location.href = "http://localhost/quickfix/avines/ongoing/chatTradesman.php?hiring_id=" + hiring_id;
                    }
                });

            });
            $(document).on("click", "#schedule", function() {
                $("#hirehim_modalFinal").modal({
                    show: true
                });
                // let del = $(this);
                let sheduleID = $(this).attr("data-id");
                insertNotification("common", sheduleID);
                console.log("schedule clicked");
                let hiring_id;
                $.ajax({
                    type: "get",
                    data: {
                        sheduleID: sheduleID
                    },
                    url: "scheduleHiring.php",
                    success: function(data) {
                        console.log(data);
                        // location.href = "http://localhost/quickfix/avines/ongoing/chatTradesman.php?hiring_id="+hiring_id;
                    }
                });

            });


            $(document).on("click", "#decline", function() {
                $("#hirehim_modalFinal").modal({
                    show: true
                });
                let del = $(this);
                console.log("decline clicked");
                let sheduleID = $(this).attr("data-id");
                console.log(sheduleID);
                insertNotification("ok", sheduleID);
                $.ajax({
                    type: "post",
                    data: {
                        sheduleID: sheduleID
                    },
                    url: "decline.php",
                    success: function(data) {
                        console.log("schedule ID is : ");
                        load_unseen_notification();
                       

                        console.log("decline clicked success....");

                    }
                });
            });

            $(document).on("click", "#view", function() {

                let del = $(this);
                let sheduleID = $(this).attr("data-id");
                $.ajax({
                    type: "get",
                    data: {
                        sheduleID: sheduleID
                    },
                    url: "deleteNotification.php",
                    success: function(data) {
                        load_unseen_notification();
                        console.log(data);

                    }
                });
            });


        });

        function searchme() {
            console.log("search bar click");
            $text = $("#searchbar").val()
            if ($text != "") {
                $.ajax({
                    url: 'process_search.php',
                    type: 'POST',
                    data: {
                        text: $("#searchbar").val()
                    },
                    success: function(result) {
                        console.log(result);
                        $('.searchmenu-item').html(result);
                    }
                });
            }

        }
    </script>

</body>

</html>