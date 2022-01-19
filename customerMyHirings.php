<?php
include 'header.php';
$customer_id = $user->getCustomer_id();   

if (isset($_POST["saveReview"])) {
    $review = $_POST["review"];
    $review_hiring_id = $_POST["hiring_id"];
    $sql = "UPDATE hiring SET review='{$_POST["review"]}' WHERE hiring_id='{$_POST["hiring_id"]}'";
    QueryHandler::query($sql);
}

if (isset($_POST["saveRating"])) {
    $rating = $_POST["ratingInput"];
    $rating_hiring_id = $_POST["hiring_id"];
    if ($rating > 0) {
        $sql = "UPDATE hiring SET rating='{$_POST["ratingInput"]}' WHERE hiring_id= '{$_POST["hiring_id"]}'";
        QueryHandler::query($sql);
    }
}

if (isset($_POST["hireNow"])){
    $hiring_id = $_POST["hiring_id"];

    $hiring = new Hiring();
    $hiring->read($hiring_id);

    $tradesman_id = $hiring->getTradesman_id();
    $service_id = $hiring->getService_id();
            

    $date = $_POST["date"];
    $time = $_POST["time"];
    $addressType= $_POST["flexRadioDefault"];
    $latitude = $_POST["lat"];
    $longitude = $_POST["lng"];
    $address= $_POST["address-label"];
    $final_status = "Scheduled";


    $sql = "INSERT INTO hiring (tradesman_id, service_id, customer_id, completed_cancelled_date, final_status, latitude, longitude, address, time) VALUES ('$tradesman_id','$service_id','$customer_id','$date','$final_status','$latitude','$longitude','$address','$time')";

    QueryHandler::query($sql);  
    
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <!-- for map -->
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script src="./index.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />


    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title>My Hirings</title>
</head>
<style>
    .myHiringsPage {
        background-color: #dcdcdc;



        padding: calc(5px + 0.5vw) calc(15px + 1vw);

    }
    

    .myHiringsPage .heading {

        border-bottom: solid #142f61;
        border-width: 4px;
        font-size: calc(20px + 0.5vw);
        font-weight: 700;
        padding-bottom: 2px;
        margin-bottom: 4px;
        width: fit-content;
    }

    .myHiringsPage .typeBox {
        margin: 9px 0px;
        border-radius: 8px;
        background-color: white;
        box-shadow: 0px 0px 10px 5px #bebcbc;
        border: solid #bebcbc;
        border-width: 3px;

    }

    .myHiringsPage .types {

        padding: 4px 5px;
        cursor: pointer;

    }

    .myHiringsPage .item {
        color: black;
        font-weight: 700;
        padding: 0%;

    }

    .myHiringsPage .item:hover {
        color: Red;

    }

    .myHiringsPage .item.active {
        color: red;
    }

    .myHiringsPage .body {
        background-color: white;
        border: solid #bebcbc;
        border-width: 3px;
        box-shadow: 0px 0px 15px 5px #bebcbc;

        border-radius: 10px;
        margin-bottom: 25px;

    }

    .myHiringsPage .box {

        background-color: white;
        margin: 23px;
        box-shadow: 0px 0px 20px 5px #e0dfdf;
        border-radius: 8px;
        font-weight: 600;
        border-bottom: solid #142f61;
        border-width: 4px;
        padding: 15px 25px;

    }

    .myHiringsPage .box .profile {
        border-radius: 50%;
        height: 85px;
        width: 85px;

    }


    .myHiringsPage .box h4 {
        color: black;
        width: fit-content;

        border-bottom: solid #142f61;
        border-width: 4px;
        padding-bottom: 3px;
    }

    .myHiringsPage .box .name {
        font-weight: 600;
        margin-top: -8px;
        font-size: 17px;
    }

    .myHiringsPage .box .star {
        color: #CB7E17;
        font-size: 21px;
        position: relative;
        top: 0.2rem;

    }

    .myHiringsPage .box .hiringAmount {
        border-bottom: solid #142f61;
        border-width: 3px;
        margin-bottom: 3px;

    }

    .myHiringsPage .box .review {
        font-weight: 400;

    }

    .myHiringsPage .box .ratingReview {
        border-bottom: solid #142f61;
        border-width: 3px;
        padding-bottom: 5px;
        min-height: 83px;
    }

    .myHiringsPage .box .giveReview {
        color: #fff;
        background-color: #9b9999;
        padding: 0.5px 0px;
        border-radius: 30px;
        min-width: 150px;
        margin: 4px;

    }

    .myHiringsPage .twobutton .button {

        border: none;
        padding: 2.3px 15px;
        border-radius: 10px;

        margin-top: 12px;


        font-weight: 600;

    }





    .myHiringsPage .scheduledbtn {

        background-color: rgb(245, 221, 8);
        cursor: none;


    }

    .myHiringsPage .completedbtn {
        background-color: #0f7936;
        color: white;
        cursor: none;
    }
    .myHiringsPage .completedbtn:hover {
        color: white;
    }



    .myHiringsPage .cancelledbtn {
        background-color: red;
        color: white;
        cursor: none;
    }
    .myHiringsPage .cancelledbtn:hover {
        color: white;
    }


    .myHiringsPage .hirebtn {
        background: #142f61;
        padding: 2.3px 25px;
        color: white;

    }

    .myHiringsPage .hirebtn:hover {
        background-color: #5789e6;
        color: black;

    }

    .myHiringsPage .loadMore {
        background-color: #142f61;
        color: white;
        border-radius: 8px;
    }
    .myHiringsPage .loadMore:hover {
        color: white;
    }
    
    .myHiringsPage .containofboxes {
        margin-left: -150px;
        margin-right: -150px;
    }

    @media (max-width: 1400px) {
        .myHiringsPage {

            padding: 10px 100px;
        }

        .myHiringsPage .box {
            margin: calc(20px + 0.5vw);
        }



        .myHiringsPage .containofboxes {
            margin-left: -190px;
            margin-right: -190px;
        }
    }

    @media (max-width: 1200px) {
        .myHiringsPage {

            padding: 10px calc(45px + 0.5vw);
        }

        .myHiringsPage .box {
            margin: calc(18px + 0.5vw);
        }

        .myHiringsPage .containofboxes {
            margin-left: -160px;
            margin-right: -160px;
        }
    }

    @media (max-width: 992px) {
        .myHiringsPage {

            padding: 10px calc(10px + 2vw);
        }

        .myHiringsPage .box {
            margin: 25px calc(5px + 0.7vw);
        }

        .myHiringsPage .containofboxes {
            margin-left: calc(-70px + 1vw);
            margin-right: calc(-70px + 1vw);
        }
    }


    @media (max-width: 910px) {
        .myHiringsPage {

            padding: 10px calc(5px + 2vw);
        }

        .myHiringsPage .box {
            margin: 25px calc(5px + 0.1vw);
            padding: 15px 15px;

        }

        .myHiringsPage .containofboxes {
            margin-left: calc(-70px + 0.1vw);
            margin-right: calc(-70px + 0.5vw);
        }
    }




    @media (max-width: 768px) {
        .myHiringsPage {

            padding: 10px calc(50px + 3vw);
        }

        .myHiringsPage .box {
            margin: calc(20px + 0.7vw);
            padding: 15px 25px;

        }

        .myHiringsPage .containofboxes {
            margin-left: calc(-150px + 2.5vw);
            margin-right: calc(-150px + 2.5vw);
        }
    }

    @media (max-width: 576px) {
        .myHiringsPage {

            padding: 10px calc(20px + 3vw);
        }

        .myHiringsPage .containofboxes {
            margin-left: calc(-75px + 2.5vw);
            margin-right: calc(-75px + 2.5vw);
        }
    }

    @media (max-width: 500px) {
        .myHiringsPage {

            padding: 10px calc(15px + 2vw);
        }

        .myHiringsPage .containofboxes {
            margin-left: calc(-60px + 1vw);
            margin-right: calc(-60px + 1vw);
        }
    }

    @media (max-width: 440px) {
        .myHiringsPage .box {
            margin: 20px calc(3px + 0.1vw);
            padding: 15px 10px;

        }

        .myHiringsPage {

            padding: 10px 3px;
        }

        .myHiringsPage .containofboxes {
            margin-left: calc(-60px + 1vw);
            margin-right: calc(-60px + 1vw);
        }
    }


    /*---------------------------------------------------------------------------------------*/
    #modalTitle {
        background-color: #142f61;
        color: white;
    }

    #fixed_map {
        height: 22rem;
        background-color: rgb(218, 236, 247);
        border: solid #142f61;
        padding: 0px;

    }



    .review_box {
        height: 200px;
        border: solid #142f61;
        border-radius: 15px;
    }
</style>

<!-- star rating part css --------------------------------------->
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');


    .rating_modal .star_rating {
        position: relative;
        width: 400px;
        margin: 20px 30px;
        padding: 20px 30px;
        border: solid #142f61;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;

    }


    .rating_modal .star_rating .star-widget input {
        display: none;
    }

    .rating_modal .star-widget label {
        font-size: 40px;
        color: #444;
        padding: 10px;
        float: right;
        transition: all 0.2s ease;
    }

    .rating_modal input:not(:checked)~label:hover,
    .rating_modal input:not(:checked)~label:hover~label {
        color: #fd4;
    }

    .rating_modal input:checked~label {
        color: #fd4;
    }

    .rating_modal input#rate-5:checked~label {
        color: #fe7;
        text-shadow: 0 0 20px #952;
    }

    

    .rating_modal .star_rating form {
        display: none;
    }

    .dropdownbtn {
        background-color: #142f61;
        font-weight: bold;
        border: none;
        }

        .dropdownbtn:focus {
        box-shadow: none;
        background-color: #142f61;
        }
        .dropdownbtn:hover {
        background-color: #1d345f;
        }   
</style>







<body>

    <section class="menu-section">

        <div class="myHiringsPage">
            <!-- header code -->

            <div class="heading pe-5">
                My Hirings
            </div>

            <!-- Hiring types code -->

            <div class="">

                <div class="row justify-content-center text-center">
                    <div class="col-md-8 col-10 typeBox">
                        <div class="row justify-content-center" id="types">
                            <div class="col-md-3 col-6 types">
                                <a class="nav-link item   active" id="defaultOpen" onclick="openPage('all')">All Hirings</a>


                            </div>
                            <div class="col-md-3 col-6 types ">
                                <a class="nav-link item  " onclick="openPage('completed')">Completed</a>

                            </div>
                            <div class="col-md-3 col-6 types">
                                <a class="nav-link item  " onclick="openPage('scheduled')">Scheduled</a>
                            </div>
                            <div class="col-md-3 col-6 types">
                                <a class="nav-link item  " onclick="openPage('cancelled')">Cancelled</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- body part code -->
            <div class="row body">
                <div class="col">
                    
                    <div class="row containofboxes justify-content-center menu-tab-content active tabcontent" id="all">
                        <?php showHirings("SELECT * FROM hiring WHERE customer_id = '$customer_id'") ?>
                    </div>
                    <div class="row containofboxes justify-content-center menu-tab-content tabcontent" id="completed">
                        <?php showHirings("SELECT * FROM hiring WHERE customer_id = '$customer_id' AND final_status = 'Completed'") ?>
                    </div>
                    <div class="row containofboxes justify-content-center menu-tab-content tabcontent" id="scheduled">
                        <?php showHirings("SELECT * FROM hiring WHERE customer_id = '$customer_id' AND final_status = 'Scheduled'") ?>
                    </div>
                    <div class="row containofboxes justify-content-center menu-tab-content tabcontent" id="cancelled">
                        <?php showHirings("SELECT * FROM hiring WHERE customer_id = '$customer_id' AND final_status = 'Cancelled'") ?>
                    </div>

                </div>




                <div class="text-center">
                    <button id="" class="loadMore btn btn-sm  fw-bold  px-5 mb-5 mt-3" type="button">
                        Load More.....
                    </button>
                </div>




            </div>

        </div>
    </section>


    <?php
    function showHirings($item_query)
    {
        $result_hiring = QueryHandler::query($item_query);

        for ($x = mysqli_num_rows($result_hiring); $x > 0; $x--) {
            $row = mysqli_fetch_assoc($result_hiring);

            $hiring_id = $row["hiring_id"];

            $hiring = new Hiring();
            $hiring->read($hiring_id);

            $tradesman_id = $hiring->getTradesman_id();
            $service_id = $hiring->getService_id();
            $dateTime = $hiring->getCompleted_cancelled_date();
            $hiring_amount = $hiring->getHiring_amount();
            $payment_method = $hiring->getPayment_method();
            $rating = $hiring->getRating();
            $review = $hiring->getReview();
            $final_status = $hiring->getFinal_status();
            $time = $hiring->getTime();






            $provider_name = $hiring->getProvider_name($service_id);
            
            $tradesman = Tradesman::getInstance($tradesman_id);
            if(!is_null($tradesman)){
                $tradesman_username = $tradesman->getUsername();
                $average_rating = $tradesman->getAverage_rating();
                $profile = $tradesman->getImg();
                
            }



           
        ?>


            <div class="col-xxl-3 col-lg-4 col-md-5 col-sm-7 col-xs-8 col-9  box">
                <div class="row justify-content-between">
                    <div class="col-2">
                        <img id="" class="profile" src="<?php echo $profile ?>" alt="profile">

                    </div>
                    <div class="col-8 col-xs-8 col-sm-9 col-md-9">
                        <h4 class="pe-5">
                            <?php echo $provider_name ?>
                        </h4>
                        <p class="name">
                            <?php echo $tradesman_username ?> - <?php echo $average_rating ?>
                            <span id="" class="material-icons star"> grade</span>
                            <br>

                            <?php
                            $date = date_create($dateTime);
                            echo date_format($date, "Y M d"); 
                            echo " @";
                            echo $time; 
                            ?>
                        </p>

                    </div>

                </div>
                <!-- completed hiring part -->

                <?php
                if ($final_status == "Completed") {  ?>
                    <div class="hiringAmount">
                        <p>
                            Hiring amount:
                            <?php
                            echo "Rs ";
                            echo number_format($hiring_amount, 2, '.', ''); ?>
                            <br>
                            Payment method:
                            <?php
                            echo $payment_method;
                            ?>
                        </p>
                    </div>


                    <div class="ratingReview">

                        <?php
                        if ($rating == null) {  ?>
                            <div class="row">
                                <div class="col-4 ">
                                    Your Rating: </div>
                                <div class="col-8 ">
                                    <button class="btn rating giveReview fw-bold" id="rating" onclick="saveRating(<?php echo $hiring_id ?>)">Give Rating</button>
                                </div>
                            </div>
                        <?php
                        } else { ?>
                            <div class="row">
                                <div class="col-4 ">
                                    Your Rating: </div>
                                <div class="col-8 ">

                                    <?php
                                    for ($i = 0; $i < $rating; $i++) {
                                    ?>
                                        <span id="" class="material-icons star"> grade</span>
                                    <?php
                                    } ?>

                                </div>
                            </div>
                        <?php
                        } ?>


                        <?php
                        if ($review == null) {  ?>
                            <div class="row">
                                <div class="col-4">
                                    Your Review:
                                </div>
                                <div class="col-8">
                                    <span class="review"> <button onclick="saveReview(<?php echo $hiring_id ?>)" class="btn giveReview fw-bold" type="button">Write
                                            Review </button></span>

                                </div>
                            </div>
                        <?php
                        } else { ?>
                            <div class="row">
                                <div class="col-4">
                                    Your Review:
                                </div>
                                <div class="col-8">
                                    <span class="review">
                                        <?php
                                        echo $review; ?>
                                    </span>

                                </div>
                            </div>
                        <?php
                        } ?>

                    </div>


                    <div class="twobutton">
                        <div class="row">
                            <div class="col text-center">
                                <button class="btn button completedbtn fw-bold" type="">
                                    <?php echo $final_status;
                                    echo " hiring"; ?>
                                </button>
                            </div>
                            <div class="col text-center">
                                <button class="btn button hirebtn fw-bold" id="hire_him_again" onclick="hireNow(<?php echo $hiring_id ?>)" type="button">Hire him again </button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!-- scheduled hiring part -->
                <?php
                if ($final_status == "Scheduled") {  ?>
                    <div class="hiringAmount">
                        <p>
                            Hiring amount:

                            <br>
                            Payment method:

                        </p>
                    </div>
                    <div class="ratingReview">
                        <div class="row">
                            <div class="col-4 ">
                                Your Rating: </div>
                            <div class="col-8 ">
                                <div class="col-8 ">


                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                Your Review:
                            </div>
                            <div class="col-8">
                                <span class="review">

                                </span>

                            </div>
                        </div>
                    </div>


                    <div class="twobutton">
                        <div class="row">
                            <div class="col text-center">
                                <button class="btn button scheduledbtn fw-bold" type="">
                                    <?php echo $final_status;
                                    echo " hiring"; ?>
                                </button>
                            </div>
                            <div class="col text-center">
                                <button class="btn button hirebtn fw-bold" id="hire_him_again" onclick="hireNow(<?php echo $hiring_id ?>)" type="button">Hire him again </button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

                <!-- cancelled hiring part -->
                <?php
                if ($final_status == "Cancelled") {  ?>
                    <div class="hiringAmount">
                        <p>
                            Hiring amount:

                            <br>
                            Payment method:

                        </p>
                    </div>
                    <div class="ratingReview">
                        <div class="row">
                            <div class="col-4 ">
                                Your Rating: </div>
                            <div class="col-8 ">
                                <div class="col-8 ">


                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                Your Review:
                            </div>
                            <div class="col-8">
                                <span class="review">

                                </span>

                            </div>
                        </div>
                    </div>


                    <div class="twobutton">
                        <div class="row">
                            <div class="col text-center">
                                <button class="btn button cancelledbtn fw-bold" type="">
                                    <?php echo $final_status;
                                    echo " hiring"; ?>
                                </button>
                            </div>
                            <div class="col text-center">
                                <button class="btn button hirebtn fw-bold" id="hire_him_again" onclick="hireNow(<?php echo $hiring_id ?>)" type="button">Hire him again </button>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>
    <?php
        }
    }
    ?>





    <!-- MODAL  hire_him_again  -->
    
    <div class="modal fade " id="modal_hire_him_again">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content  mx-3">
                <div class="modal-header text-white py-1 m-0" id="modalTitle">
                    <h5 class="address-label-title">Register Details</h5>
                    <button type="button" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close" id="closeHireagain" onclick=""></button>
                </div>

                <form action="sample_myHiring.php" method="POST">

                <div class="row fw-bold mx-2">
                    <div class="col-12 col-md-6">
                        <div class="fw-bold h5" id="dateAndTime">
                            Select Date and Time
                        </div>
                        <div class="row my-1">
                            <div class="col-3 col-md-2 mt-2">Date</div>
                            <div class="col-6 col-md-10">
                                <input type="date" name="date" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="row my-1">
                            <div class="col-3 col-md-2  mt-2">Time</div>
                            <div class="col-6 col-md-10">
                                <input type="time" name="time" class="form-control" placeholder="" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="fw-bold h5" id="dateAndTime">
                            Select Location
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="default">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Use default Address
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked value="new">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Pick new Address
                            </label>
                        </div>

                    </div>
                </div>
                <input type="hidden" name="hiring_id" id="hireNow1" value="">

                <input type="hidden" name="lat" id="lat" value="">
                <input type="hidden" name="lng" id="lng" value="">
                <input type="hidden" name="address-label" id="address-label" value="">






                <div id="tradesman_map " class="row mx-3 p-0">

                    <div id="fixed_map">
                        <div class="location-map" id="location-map">
                            <div style="width: 100%; height: 21.5rem;" class="m-0" id="map"></div>
                        </div>
                    </div>
                </div>
                


                <div class=" d-flex flex-row-reverse mx-3">
                    <div class="">
                        <button type="submit" class="close btn text-white fw-bold mt-2 mb-3" name="hireNow" style="background-color:#142f61">
                            Hire Now
                        </button>
                    </div>
                </div>

                </form>
                
            </div>
        </div>
    </div>

    <!-- give rating part ------------------------------------------------------->
    <div class="modal fade rating_modal " id="modal_rating">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content  mx-3">
                <div class="modal-header text-white py-1 m-0" id="modalTitle">
                    <h5 class="modal-title">Give Rating</h5>
                    <button type="button" id="closeRating" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form action="sample_myHiring.php" method="POST">
                    <div class="star_rating">

                        <div class="star-widget" name="rating">
                            <input type="radio" name="rate" id="rate-5">
                            <label for="rate-5" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-4">
                            <label for="rate-4" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-3">
                            <label for="rate-3" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-2">
                            <label for="rate-2" class="fas fa-star"></label>
                            <input type="radio" name="rate" id="rate-1">
                            <label for="rate-1" class="fas fa-star"></label>

                        </div>
                        <input type="hidden" name="ratingInput" id="ratingInput" value="">
                        <input type="hidden" name="hiring_id" id="rating1" value="">

                    </div>


                    <div class=" d-flex flex-row-reverse mx-4 mb-3">
                        <div class="">
                            <button class="close btn text-white fw-bold mt-1 px-5" name="saveRating" style="background-color:#142f61">
                                Save
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>



    <!-- write review part ------------------------------------------------------->
    <div class="modal fade " id="modal_review">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content  mx-3">
                <div class="modal-header text-white py-1 m-0" id="modalTitle">
                    <h5 class="modal-title">Write Review</h5>
                    <button type="button" id="closeReview" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <form action="sample_myHiring.php" method="POST">
                    <div id="" class="row mx-4 my-3 ">

                        <textarea name="review" id="review" cols="30" rows="10" class="review_box p-3" placeholder="Write your review here.(maximum 20 words)"></textarea>

                    </div>
                    <input type="hidden" name="hiring_id" id="review1" value="">


                    <div class=" d-flex flex-row-reverse mx-4 mb-3">
                        <div class="">
                            <button type="submit" name="saveReview" class="close btn text-white fw-bold mt-1 px-5" style="background-color:#142f61">
                                Save
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>





    


    <script>
        //code for tab active change----------------------------------------------------------------------------------------
        var typeContainer = document.getElementById("types");

        var types = typeContainer.getElementsByClassName("item");

        for (var i = 0; i < types.length; i++) {
            types[i].addEventListener("click", function() {
                var current = document.getElementsByClassName("active");
                current[0].className = current[0].className.replace(" active", "");
                this.className += " active";
            });
        }

        //code for model--------------------------------------------------------------------------------------------------------

        $(document).ready(function() {
            $("#closeHireagain").click(function() {
                $("#modal_hire_him_again").modal('toggle');
            });
        });



        $(document).ready(function() {
            $("#closeReview").click(function() {
                $("#modal_review").modal('toggle');
            });
        });


        function saveReview(id) {
            $("#modal_review").modal({
                show: true
            });
            $("#review1").val(id);
        }

        function saveRating(id) {
            $("#modal_rating").modal({
                show: true
            });
            $("#rating1").val(id);
        }


        $(document).ready(function() {
            $("#closeRating").click(function() {
                $("#modal_rating").modal('toggle');
            });
        });



        function hireNow(id){
            $("#modal_hire_him_again").modal({
                show: true
            });
            $("#hireNow1").val(id);
        }



        //script code for give rating part---------------------------------------------------------------------------------------
        const widget = document.querySelectorAll(".star-widget .fas");
        widget.forEach((star, idx) => {
            star.addEventListener("click", () => {
                var rating = 5 - idx;

                document.getElementById("ratingInput").value = rating;
            })
        })


        //script code for different tabs-------------------------------------------------------------------------------------------
        function openPage(pageName) {
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Show the specific tab content
            document.getElementById(pageName).style.display = "flex";

        }
        document.getElementById("defaultOpen").click();

        
    </script>



    
    <!--You have to paste your API key in the following link-->
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2psniVzC9cwc5r1b6xt3ggfhFUt0DvsA&callback=initMap"></script>
    



</body>

</html>
<?php include 'footer.php' ?>
