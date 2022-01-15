<?php
include "classes.php";
session_start();

if (!array_key_exists("customer_id", $_SESSION)) {
    header("Location: login.php");
}
else
{
    $tradesman;
    $customer;
    $user;
    $customer =new Customer();
    $customer -> read($_SESSION["customer_id"]);
    
    if($customer->getIs_worker() == 1)
    {
        $tradesman =new Tradesman();
        $tradesman -> read($_SESSION["customer_id"]);
        
        if (array_key_exists("login", $_SESSION)) {
            $tradesman->login();
            unset($_SESSION['login']);
        }
        if (array_key_exists("toggle", $_POST)) {
            $tradesman->toggle();
        }

        if(array_key_exists("switch", $_POST)){
            $tradesman->switch();
        }
        if(isset($tradesman) && ($tradesman->getState() instanceof TradesmanAsTradesman)){
            $user = $tradesman ; 
        }
        else{
            $user = $customer;
        }

    }
    else{
        $user = $customer;
    }
    
}

if (array_key_exists("logout", $_GET)) 
{
    $user->logout("login.php");
}

if (array_key_exists("registerSubmit", $_POST)) {
    $user->registerAsTradesman($_POST);
}


$searchError="";
if (array_key_exists("search", $_POST)) {
  if (!($user->search($_POST["search"]))) {
    $searchError = "Such a service or tradesman doesn't exist";
  }
}


function hidefor($userType,$user)
{
    if(((strcmp(get_class($user), "Customer") == 0)&&($userType== UserType::CUSTOMER))||((strcmp(get_class($user), "Tradesman") == 0)&&($userType== UserType::TRADESMAN))){
        echo "hidden";
}}?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>QuickFIX</title>
    <link rel="stylesheet" href="./Assets/Css/header.css">
    <link rel="stylesheet" href="./Tradesman/Assets/Css/workerSignup.css">
    <script src="./location_picker.js"></script>

  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light static-top" style="margin:0px; padding:0px; height:80px;">
        <div class="container-fluid" style="margin:0px;">

            <!-- Nav bar logo-->
            <a class="navbar-brand px-2" href="#">
                <img src="Assets/Images/logo.jpg" alt="" width="90" height="51.25">
            </a>

            <!-- Search bar-->
            <form class="d-flex" method="POST" >
                <div class="form-group has-search" style="margin-right:50px ;" <?php hidefor(UserType::TRADESMAN,$user);?>>
                    <span class="fa fa-search form-control-feedback" id="searchIcon" ></span>
                    <input class="form-control" name = "search" type="search" placeholder="Search for services,peoples..." aria-label="Search" aria-describedby="search-icon" style="border-radius: 16px;padding-left: 2.375rem;background-color: #e9ecef;">
                    <button type="submit" id="searchBtn"  name ="searchBtn" value="1" hidden></button>
                </div>
            </form>
            <!-- Nav bar menu items-->
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav navbar-center mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a id="Home" class="nav-link <?php if(array_key_exists("Service",$_GET)){echo 'active';}?>" aria-current="page" href="<?php if(get_class($user)){echo './customerHome.php?Home=';}else{ echo './tradesmanHome.php?Home=';}?>" style="color:black; text-align:center">Home</a>
                    </li>
                    <li class="nav-item" <?php hidefor(UserType::TRADESMAN,$user);?>>
                        <a id="Services" class="nav-link <?php if(array_key_exists("Service",$_GET)){echo 'active';}?>" href="./customerServicesView.php?Service=" style="color:black; text-align:center">Services</a>
                    </li>
                    <li class="nav-item">
                        <a id="abc12" class="nav-link" href="./tradesmanMyHirings.php?Hirings=jlhjs" style="color:black; text-align:center">MyHirings</a>
                    </li>
                    <li class="nav-item" <?php hidefor(UserType::TRADESMAN,$user);?>>
                        <a class="nav-link <?php if(array_key_exists("Aboutus",$_GET)){echo 'active';}?>" href="./AboutUs.php?Aboutus=" style="color:black; text-align:center">AboutUs</a>
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
                <img class="HeaderDp" src=<?php echo $user->getImg();?> alt="" width="50" height="50">

                </a>
                <ul class="dropdown-menu px-3" aria-labelledby="navbarDropdown" style="margin-left: -175px; min-width: 18rem; z-index:1">
                    <div class="row">
                        <div class="col-3"><img class="HeaderDp" src=<?php echo $user->getImg();?> alt="" width="50" height="50"></div>
                        <div class="col-9">
                            <div class="row"><span  class="dropdownp"><?php echo $user->getFirstname();?></span></div>
                            <div class="row"><span  class="dropdownp"><?php echo $user->getLastname();?></span></div>
                        </div>
                    
                    </div>
                    <div class="text-center" <?php hidefor(UserType::CUSTOMER,$user);?>>
                        <div class="d-inline-block mx-2 dropdownp">Offline</div>
                        <div class="form-check form-switch d-inline-block form-switch-xl mb-0 mt-1">
                            <form method="POST">
                                <input type="checkbox" class="form-check-input mt-0" id="site_state" style="cursor: pointer;" <?php if(($user instanceof Tradesman) && ($user->isOnline())){echo 'checked';}?>>
                                <label for="site_state" class="form-check-label dropdownp mx-2">Online</label>
                                <button type="submit" id="toggleBtn"  name ="toggle" value="1" hidden></button>
                            </form>
                        </div>
                    </div>

                    <div class="mt-1 text-center mb-1" ><a href="customerEditProfile.php" role="button" class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" name="editprofile">Edit Profile</a></div>
                    <div class="mt-1 text-center mb-1" <?php hidefor(UserType::CUSTOMER,$user);?>><a href="customerEditProfile.php" role="button" class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" name="On-going Hiring">On-going Hiring</a></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>><?php echo $user->getPhone_no();?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>><?php echo $user->getEmail();?></div>
                    <hr  style="height:4px; border:none; color:#142F61;" <?php hidefor(UserType::TRADESMAN,$user);?>>

                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> Customer Since -<?php echo date("Y M",strtotime($user->getRegistered_date()));?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> Total Hirings -<?php echo $user->getTotal_hirings_count();?></div>
                    <div class="dropdownp mx-2" <?php hidefor(UserType::TRADESMAN,$user);?>> Total Payment -<?php echo $user->getTotal_payment();?></div>
                    <hr  style="height:4px; border:none; color:#142F61;" <?php hidefor(UserType::TRADESMAN,$user);?>>
                    <div class="mt-1 text-center mb-2">
                        <form method="POST">
                            <button class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" type="submit" name="switch" value="switch" <?php if($user->getIs_worker()==UserType::CUSTOMER){echo 'hidden';}?>><?php 
                            if($user->getIs_worker()==UserType::TRADESMAN){
                                if(strcmp(get_class($user), "Customer") == 0){
                                    echo "Switch as Tradesman";
                                }else{
                                    echo "Switch as Customer";
                                }
                            }?>
                            </button>
                        </form>
                    </div>
                    <div class="text-center mb-2"><button class="btn btn-primary rounded-pill mt-2 dropdownbtn w-100" data-bs-toggle="modal" data-bs-target="#staticBackdropRAC" <?php if ($user->getIs_worker()==UserType::TRADESMAN){echo 'hidden';}?>>Register as Tradesman</button></div>
                    <div class="text-center mb-1"><a href="header.php?logout=" role="button" class="btn btn-primary rounded-pill dropdownbtn w-100" name="logout">Logout</a></div>
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
                    .$searchError.
                    '</div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                </div>';
        }

        if (!empty($searchError)) {
            echo '
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>'.$searchError.'</strong> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>         
          ';
            }

    ?>

    <?php include "Tradesman/workerSignup.php";?>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        

        $("#site_state").click(function(){
            $("#toggleBtn").click();
        });

        $("#searchIcon").click(function(){
            $("#searchBtn").click();
        });
    </script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>