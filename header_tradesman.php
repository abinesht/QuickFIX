<?php
require_once("classes.php");
session_start();

// if (!array_key_exists("customer_id", $_SESSION)) {
//     header("Location: login.php");
// }
// else
// {
    $user =new Customer();
    if($user->getIs_worker() == 1)
    {
        $user =new Tradesman();
    }
    $user -> read(2);
//}

if (array_key_exists("logout", $_GET)) 
{
    $user->logout("login.php");
}

function hidefor($userType , $user)
{
    if(((strcmp(get_class($user), "Customer") == 0) && ($userType== UserType::CUSTOMER)) 
        || ((strcmp(get_class($user), "Tradesman") == 0) && ($userType== UserType::TRADESMAN))){
        echo "hidden";
    }
 
}
?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="./location_picker.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <title>My Shedules</title>
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/workerSignup.css">

</head>
<style>
        @font-face {
            font-family: 'malgun';
            src: url(fonts/malgun.ttf);
        }

        @font-face {
            font-family: 'quikhand';
            src: url(fonts/Quikhand.otf);
        }

        @font-face {
            font-family: 'tahoma';
            src: url(fonts/Tahoma\ Regular\ font.ttf);
        }

        .cover {
            position: relative;
        }

        .cover .coverimg {
            background: url("images/cover_xl.jpg");
            min-height: 53vh;
            width: 100%;
            background-size: cover;
        }

        .cover .coveroverlay {
            min-height: 53vh;
            width: 100%;
            background: linear-gradient(to right, #142f61, #2b477c, rgb(243, 243, 150));
            opacity: 0.8;
        }

        .container {
            padding-top: 120px;
            padding-bottom: 20px;
        }

        .weAreHere {
            font-size: calc(13px + 3vw);
            font-family: 'quikhand', Arial, Helvetica, sans-serif;
            color: white;
        }

        .toHelp {
            font-size: calc(25px + 4vw);
            font-family: 'malgun', Arial, Helvetica, sans-serif;
            color: #F6E92F;
            font-weight: bold;
            line-height: 0.5;
        }

        .you {
            font-size: calc(17px + 3vw);
            font-family: 'tahoma', Arial, Helvetica, sans-serif;
            color: white;
            line-height: 1.1;
            position: relative;
            top: 1rem;

        }

        @media (max-width: 1200px) {
            .cover .coverimg {
                min-height: 49vh;
            }

            .cover .coveroverlay {
                min-height: 49vh;
            }

            .container {
                padding-top: 120px;
            }
        }

        @media (max-width: 1200px) {
            .cover .coverimg {
                min-height: 48vh;
            }

            .cover .coveroverlay {
                min-height: 48vh;
            }

            .container {
                padding-top: 120px;
            }
        }

        @media (max-width: 992px) {
            .cover .coverimg {
                min-height: 45vh;
            }

            .cover .coveroverlay {
                min-height: 45vh;
            }

            .container {
                padding-top: 110px;
            }
        }

        @media (max-width: 768px) {
            .cover .coverimg {
                min-height: 42vh;

            }

            .cover .coveroverlay {
                min-height: 42vh;
            }

            .container {
                padding-top: 90px;
            }
        }

        @media (max-width: 576px) {
            .cover .coverimg {
                min-height: 38vh;
            }

            .cover .coveroverlay {
                min-height: 38vh;
            }

            .container {
                padding-top: 75px;
            }

            .weAreHere {
                font-size: calc(20px + 3vw);
            }

            .toHelp {
                font-size: calc(35px + 4vw);
            }

            .you {
                font-size: calc(28px + 3vw);
            }
        }


        @media (max-width: 470px) {
            .cover .coverimg {
                min-height: 35vh;
            }

            .cover .coveroverlay {
                min-height: 35vh;
            }

            .container {
                padding-top: 80px;
            }

            .weAreHere {
                font-size: calc(20px + 3vw);
            }

            .toHelp {
                font-size: calc(35px + 4vw);
            }

            .you {
                font-size: calc(25px + 3vw);
            }
        }

        .calendar {
            display: flex;
            flex-flow: column;
        }

        .calendar .days {
            display: flex;
            flex-flow: wrap;
        }

        .calendar .days .day_name {
            width: calc(100% / 7);
            border-right: 1px solid #ffffff;
            padding: 0.25rem;
            text-transform: none;
            font-size: 0.75rem;
            font-weight: bold;
            color: #818589;
            color: #fff;
            background-color: #142f61;
        }

        .calendar .days .day_name:nth-child(7) {
            border: none;
        }

        .calendar .days .day_num {
            display: flex;
            flex-flow: column;
            width: calc(100% / 7);
            border-right: 1px solid #000000;
            border-bottom: 1px solid #000000;
            padding: 2px;
            font-weight: bold;
            color: #000000;
            cursor: pointer;
            min-height: 50px !important;
            max-height: 50px !important;
        }

        .calendar .days .day_num span {
            display: inline-flex;
            width: 30px;
            font-size: 14px;
        }

        .calendar .days .day_num .scheduled_event {
            margin-top: -13px;
            font-weight: 500;
            font-size: 14px;
            padding-left: 10px;
            color: rgb(0, 0, 0);
            max-height: 50px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
        }

        .calendar .days .day_num:nth-child(7n + 1) {
            border-left: 1px solid #000000;
        }

        .calendar .days .day_num:hover {
            background-color: #fdfdfde8;
        }

        .calendar .days .day_num.ignore_dates {
            background-color: #fdfdfd;
            color: #ced2d4;
            cursor: inherit;
        }

        .calendar .days .day_num.selected {
            background-color: #f1f2f3;
            cursor: inherit;
        }

        .horizontal_line_customer {
            border-top: 6px solid #142f61;
            /* height: 25rem; */
            width: 22rem;
            position: relative;
            /* right: 60%; */
            top: -1rem;
        }

        .new1 {
            border: 6px solid #142f61;
            width: 6rem;
        }

        #schedule_list {
            margin: auto;
        }

        #calendar_box {
            border: 6px solid #142f61;
            border-width: 0 0 0 0.4rem;
            padding-left: 2rem;
        }

        @media (max-width: 992px) {
            #calendar_box {
                border: 6px hidden #142f61;
            }

            .horizontal_line_customer {
                border-top: 6px solid #142f61;
                position: relative;
                top: -1rem;
                padding-top: 2rem;
                width: 18rem;
            }
        }
    </style>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" style="margin:0px; padding:0px; height:80px;">
        <div class="container-fluid" style="margin:0px;">

            <!-- Nav bar logo-->
            <a class="navbar-brand px-2" href="#">
                <img src="images/logo.png" alt="" width="90" height="51.25">
            </a>

            <!-- Search bar-->
            <form class="d-flex" >
                <div class="form-group has-search" style="margin-right:50px ;" <?php hidefor(UserType::TRADESMAN,$user); ?>>
                    <span class="fa fa-search form-control-feedback"></span>
                    <input class="form-control" type="search" placeholder="Search for services,peoples..." aria-label="Search" aria-describedby="search-icon" style="border-radius: 16px;padding-left: 2.375rem;background-color: #e9ecef;">
                </div>
            </form>

            <!-- Nav bar menu items-->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">

                <ul class="navbar-nav navbar-center mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a id="Home" class="nav-link active" aria-current="page" href="#Home" style="color:black; text-align:center">Home</a>
                    </li>
                    <li class="nav-item" <?php hidefor(UserType::TRADESMAN,$user); ?>>
                        <a id="Services" class="nav-link" href="#Services" style="color:black; text-align:center">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" style="color:black; text-align:center">MyHirings</a>
                    </li>
                    <li class="nav-item" <?php hidefor(UserType::TRADESMAN,$user); ?> >
                        <a class="nav-link" href="#" style="color:black; text-align:center">AboutUs</a>
                    </li>


                </ul>
            </div>

            <!-- Notification icon-->
            

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#"  id="drop-down" class="dropdown-toggle btn btn-danger" data-toggle="dropdown">
                        <span class="material-icons"> notifications</span>
                        <span class="label label-pill label-danger count" style="border-radius:10px;"></span>
                        <span class="glyphicon glyphicon-envelope" style="font-size:18px;"></span>
                    </a>
                    <ul class="dropdown-menu"></ul>
                </li>
            </ul>

            <!-- Profile icon with dropdown-->
            <ul class="Profile nav-item dropdown" style="margin-top: 15px;">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:black;">
                <img class="HeaderDp" src= <?php echo $user->getImg()?> alt="" width="50" height="50">

                </a>
                <ul class="dropdown-menu px-3" aria-labelledby="navbarDropdown" style="margin-left: -175px; min-width: 18rem; z-index:1">
                    <div class="row">
                        <div class="col-3"><img class="HeaderDp" src= <?php echo $user->getImg()?> alt="" width="50" height="50"></div>
                        <div class="col-9">
                            <div class="row"><span  class="dropdownp"><?php echo $user->getFirstname();?></span></div>
                            <div class="row"><span  class="dropdownp"><?php echo $user->getLastname();?></span></div>
                        </div>
                    
                    </div>

                    <div class="mt-1 text-center mb-1" ><a href="customerEditProfile.php" role="button" class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" name="editprofile">Edit Profile</a></div>
                    <div class="mt-1 text-center mb-1" <?php hidefor(UserType::CUSTOMER,$user);?>><a href="customerEditProfile.php" role="button" class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" name="On-going Hiring">On-going Hiring</a></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> <?php echo $user->getPhone_no();?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> <?php echo $user->getEmail();?></div>
                    <hr  style="height:4px; border:none; color:#142F61;" <?php hidefor(UserType::TRADESMAN,$user);?>>

                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> Customer Since - <?php echo date("Y M",strtotime($user->getRegistered_date()));?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> Total Hirings - <?php echo $user->getTotal_hirings_count();?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> Total Payment - <?php echo $user->getTotal_payment();?></div>
                    <hr  style="height:4px; border:none; color:#142F61;" <?php hidefor(UserType::TRADESMAN,$user);?>>
                    <div class="mt-1 text-center mb-2"><button class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100"  data-bs-toggle="modal" data-bs-target="#staticBackdropRAC">
                        <?php 
                        if($user->getIs_worker()==UserType::TRADESMAN){
                            if(strcmp(get_class($user), "Customer") == 0){
                                echo "Switch as Tradesman";
                            }else{
                                echo "Switch as Customer";
                            }
                        }else{
                            echo "Register as Tradesman";
                        }?>
                        </button>
                    </div>
                    <div class="form-check form-switch form-switch-xl">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                    </div>

                    <div class="text-center mb-1"><a href="header.php?logout=" role="button" class="btn btn-primary rounded-pill dropdownbtn w-100" name="logout">Logout</a></div>
                </ul>
            </ul>

            <!-- Toggler icon -->
            <button class="navbar-toggler float-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>





    <!-- Nav bar active-->
    <script>
        var btns =
            $(".nav-link");

        for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click",
                function() {
                    var current = document
                        .getElementsByClassName("active");

                    current[0].className = current[0]
                        .className.replace(" active", "");

                    this.className += " active";
                });
        }
    </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>