<?php
    include "header.php";
    $service_id = $_GET['service_id'];  //----------------------

    $sql = "SELECT * FROM service WHERE service_id = '$service_id'";
    $result_service = QueryHandler::query($sql);
    $row = mysqli_fetch_assoc($result_service);

    $service = new Service();
    $service->read($service_id);

    $service_id = $service->getService_id();
    $service_name = $service->getService_name();
    $provider_name = $service->getProvider_name();
    $total_tradesman = $service->getTotal_tradesman();
    $total_hirings = $service->getTotal_hirings();
    $average_rating = $service->getAverage_rating();
    $cover_photo = $service->getCover_photo();


    $star_5;
    $star_4;
    $star_3;
    $star_2;
    $star_1;
    $star_total;

    for ($i = 1; $i <= 5; $i++) {
        $result = QueryHandler::query("SELECT count(*) as star from hiring WHERE service_id='$service_id' AND rating='$i'");
        $data = mysqli_fetch_assoc($result);
        ${'star_' . $i} = $data['star'];
    }
    $star_total = $star_1 + $star_2 + $star_3 + $star_4 + $star_5;
    
    $pending_hirings;

    $result = QueryHandler::query("SELECT count(*) as pendings from hiring WHERE service_id='$service_id' AND final_status = 'Scheduled'");
    $data = mysqli_fetch_assoc($result);
    $pending_hirings = $data['pendings'];
    


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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

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
    
    <title>Service</title>
</head>

<style>
    .oneService {
        background-color: #dcdcdc;

    }

    .oneService .heading {
        border-bottom: solid #142f61;
        border-width: 4px;
        font-size: calc(20px + 0.5vw);
        font-weight: 600;
        padding-bottom: 1.5px;
        margin-bottom: 10px;
        width: fit-content;

        padding-left: 0px;
    }

    .oneService .coverphoto {
        margin-top: 6px;
        margin-bottom: 10px;
        background-image: url("Assets/Images/<?php echo $cover_photo ?>");
        min-height: 320px;
        background-repeat: no-repeat;
        background-position: center;

        background-size: cover;
        border-radius: 11px;

    }



    .oneService .aboutService {

        background-color: white;
        margin-right: 15px;
        border-radius: 9px;
        min-height: 200px;
        padding-left: 15px;
        padding-top: 15px;
        margin-top: 10px;
        margin-bottom: 10px;

    }

    .oneService .ratingPart {
        min-height: 200px;
        background-color: white;

        border-radius: 9px;
        padding-left: 15px;
        padding-top: 15px;
        margin-top: 10px;
        margin-bottom: 10px;

    }

    .oneService .subHeading {
        border-bottom: solid #142f61;
        border-width: 4px;
        font-size: calc(18px + 0.3vw);
        font-weight: bold;
        padding-bottom: 1.5px;

        width: fit-content;



    }

    .oneService .aboutService .details {
        margin-top: 20px;
        font-weight: 600;
    }

    .oneService .star {
        color: #CB7E17;
        font-size: 21px;
        position: relative;
        top: 0.2rem;

    }

    .oneService .aboutService .button {
        max-width: 150px;
        border: none;
        padding: 0.2rem;
        border-radius: 20px;
        color: #fff;
        margin-top: 15px;
        background-color: #142f61;

        font-weight: 600;
    }

    .oneService .aboutService .button:hover {
        background-color: #5789e6;
        color: black;
    }

    .oneService .aboutService .hire_any_tradesman {
        margin-top: 25px;
    }
    .oneService .aboutService .hire_one_tradesman {
        margin-top: 25px;
    }

    .oneService .relatedPeople {

        margin-top: 33px;
        margin-left: 30px;
        border-radius: 10px;
        background-color: white;
        margin-bottom: 25px;

    }

    .oneService .relatedPeople .subheading {


        font-size: calc(18px + 0.3vw);
        font-weight: 600;
        padding: 10px;



    }

    .oneService .relatedPeople .peopleone {
        padding-left: 10px;

        padding-top: 10px;
    }

    .oneService .relatedPeople .profile {
        border-radius: 50%;
        height: 50px;
        width: 50px;



    }

    .oneService .relatedPeople .name {
        font-weight: 500;
        margin-left: 5px;
    }

    .oneService .relatedPeople .button {
        min-width: 145px;
        border: none;
        font-size: 13px;

        border-radius: 20px;
        color: #fff;
        margin-bottom: 6.5px;
        background-color: #142f61;


    }

    .oneService .relatedPeople .button:hover {
        background-color: #5789e6;
        color: black;
    }





    @media (max-width: 1400px) {
        .oneService {} 

        .oneService .relatedPeople .button {
            min-width: 135px;

        }
    }

    @media (max-width: 1200px) {
        .oneService {
            padding: 10px;
        }

        .oneService .aboutService .button {
            max-width: 265px;

        }

        .oneService .relatedPeople .button {
            min-width: 115px;

        }
    }

    @media (max-width: 992px) {
        .oneService {
            padding: 30px;

        }

        .oneService .aboutService .button {
            max-width: 310px;

        }

        .oneService .relatedPeople {

            margin-top: 10px;
            margin-left: 0px;
        }

        .oneService .relatedPeople .button {
            min-width: 180px;
            padding: 2.5px;
            margin-top: 12px;
        }
    }



    @media (max-width: 768px) {
        .oneService {}

        .oneService .aboutService .button {
            max-width: 220px;

        }

        .oneService .relatedPeople .button {
            min-width: 220px;
            padding: 2px;
            margin-top: 0px;
        }
    }

    @media (max-width: 576px) {
        .oneService {}

        .oneService .aboutService .button {
            max-width: 180px;

        }

        .oneService .relatedPeople .button {
            min-width: 160px;
            padding: 2px;
            margin-top: 0px;
        }
    }

    @media (max-width: 476px) {
        .oneService {}

        .oneService .aboutService .button {
            max-width: 140px;

        }

        .oneService .relatedPeople .button {
            min-width: 140px;
            padding: 2px;
            margin-top: 0px;
        }
    }

    @media (max-width: 416px) {
        .oneService {}

        .oneService .aboutService .button {
            max-width: 120px;

        }

        .oneService .relatedPeople .button {
            min-width: 110px;
            padding: 2px;
            margin-top: 0px;
        }
    }
</style>
<style>
    body {
        background: #f5f5f5;
    }

    .five_stars .material-icons,
    .material-icons-star,
    .overall_stars .material-icons {
        color: orange;
        font-size: 15px;
        margin-right: -4.5px;
    }


    .progress {
        max-height: 5px;
        margin-bottom: 10px;
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
    }
</style>

<body>
    <div class="oneService">
        <div class="container ">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <span class="heading pe-5">
                            <?php echo $service_name ?>
                        </span>


                    </div>
                    <div class="row">
                        <div class="col coverphoto">


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-12 aboutService">
                            <span class="subHeading pe-4">About Service</span>
                            <div class="row">
                                <div class="col details">
                                    <span><?php echo $total_hirings ?> Total Hirings</span><br>
                                    <span><?php echo $pending_hirings?> Pending Hirings </span><br>
                                    <span><?php echo $total_tradesman ?> Total Workers</span><br>
                                    <span id="" class="material-icons star"> grade</span>
                                    <span><?php echo $average_rating ?> (<?php echo $star_total?> ratings)</span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <button class="btn button hire_any_tradesman fw-bold" type="button">Hire Now </button>
                                    </div>
                                    <div class="row">
                                        <button class="btn button schedule_any_tradesman fw-bold" type="button">Schedule Now
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col ratingPart ">
                            <span class="subHeading pe-4">Rating for the workers</span>
                            
                            <!--Rating card start-->
                            <div class="row pt-4 mt-2">
                                <div class="col-4 overall_stars">
                                    <div class="fw-bold text-center"
                                        style="font-size: 50px;margin-top: -20px; margin-bottom: -10px;">
                                        <?php echo $average_rating?>
                                    </div>
                                    <div class="text-center" style="margin-top: -5px">
                                        <?php if($average_rating == 1){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php    
                                        }
                                        else if($average_rating < 2){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        }
                                        else if($average_rating == 2){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        }
                                        else if($average_rating < 3){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        }
                                        else if($average_rating == 3){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        }
                                        else if($average_rating < 4){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        }
                                        else if($average_rating == 4){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        }
                                        else if($average_rating < 5){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                        <?php
                                        }
                                        else if($average_rating == 5){?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                        <?php
                                        }?>
                                        
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_5*100/$star_total?>%" role="progressbar"
                                            aria-valuenow="<?php echo $star_5*100/$star_total?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_4*100/$star_total?>%" role="progressbar"
                                            aria-valuenow="<?php echo $star_4*100/$star_total?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_3*100/$star_total?>%" role="progressbar" aria-valuenow="<?php echo $star_3*100/$star_total?>"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_2*100/$star_total?>%" role="progressbar" aria-valuenow="<?php echo $star_2*100/$star_total?>"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_1*100/$star_total?>%" role="progressbar" aria-valuenow="<?php echo $star_1*100/$star_total?>"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="col-4" style="">
                                    <div class="row  p-0" style="margin-top: -10px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_5*100/$star_total)?>%</div>
                                        <div class="col-9 five_stars p-0 " style="">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                        </div>
                                    </div>
                                    <div class="row p-0" style="margin-top: -9px;">
                                        <div class="col-3 p-0 pt-1" style="font-size: 10px;"><?php echo round($star_4*100/$star_total)?>%</div>
                                        <div class="col-9 five_stars p-0 " style="">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                        </div>
                                    </div>
                                    <div class="row  p-0" style="margin-top: -9px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_3*100/$star_total)?>%</div>
                                        <div class="col-9 five_stars p-0 " style="">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        </div>
                                    </div>
                                    <div class="row  p-0" style="margin-top: -9px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_2*100/$star_total)?>%</div>
                                        <div class="col-9 five_stars p-0 " style="">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        </div>
                                    </div>
                                    <div class="row  p-0" style="margin-top: -9px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_1*100/$star_total)?>%</div>
                                        <div class="col-9 five_stars p-0 " style="">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            

                            <!--Rating card end-->
                        </div>
                    </div>
                </div>

                

                <div class="col relatedPeople">
                    <div class="subheading">
                        <span>People related to service</span>
                    </div>


                    <?php
                    $sql = "SELECT * FROM service_of_tradesman WHERE service_id = '$service_id' ORDER BY average_rating DESC";
                    $result = QueryHandler::query($sql);

                    $x = min(7,mysqli_num_rows($result));
                    for ($x; $x > 0; $x--) {
                        $row = mysqli_fetch_assoc($result);

                        $st_id = $row["st_id"];

                        $service_of_tradesman = new Service_of_tradesman();
                        $service_of_tradesman->read($st_id);

                        $tradesman_id = $service_of_tradesman->getTradesman_id();
                        $average_rating = $service_of_tradesman->getAverage_rating();

                        $tradesman = Tradesman::getInstance($tradesman_id);

                        $username = $tradesman->getUsername();
                        $img = $tradesman->getImg();

                        ?>
                        <div class="row peopleone">
                            <div class="col-md-1 col-lg-2 col-sm-2 col-2">
                                <img id="" class="profile" src="<?php echo $img?>" alt="profile">

                            </div>
                            <div class="col-4 col-lg-4 col-sm-3">
                                <p class="name"><?php echo $username?> <br> <?php echo $average_rating?>
                                    <span id="" class="material-icons star"> grade</span>

                                </p>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <button class=" button hire_one_tradesman fw-bold" type="button">Hire Now </button>

                                    </div>
                                    <div class="col">
                                        <button class=" button schedule_one_tradesman fw-bold" type="button">Schedule Now

                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    
                    <?php
                    }
                    ?>
                


                </div>
            </div>
        </div>
    </div>






    <!-- MODAL schedule_any_tradesman   -->
    
    <div class="modal fade " id="modal_schedule_any_tradesman">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content  mx-3">
                <div class="modal-header text-white py-1 m-0" id="modalTitle">
                    <h5 class="address-label-title">Register Details</h5>
                    <button type="button" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close" id="close_any_tradesman" onclick=""></button>
                </div>

                <form action="one_service_page.php" method="POST">

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
                            Schedule Now
                        </button>
                    </div>
                </div>

                </form>
                
            </div>
        </div>
    </div>

    <!-- MODAL schedule_one_tradesman   -->
    
    <div class="modal fade " id="modal_schedule_one_tradesman">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content  mx-3">
                <div class="modal-header text-white py-1 m-0" id="modalTitle">
                    <h5 class="address-label-title">Register Details</h5>
                    <button type="button" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close" id="close_one_tradesman" onclick=""></button>
                </div>

                <form action="one_service_page.php" method="POST">

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
                            Schedule Now
                        </button>
                    </div>
                </div>

                </form>
                
            </div>
        </div>
    </div>

    

</body>
<script>
    //code for model--------------------------------------------------------------------------------------------------------
    $(document).ready(function () {
        $(".schedule_any_tradesman").click(function () {
            $("#modal_schedule_any_tradesman").modal({
                show: true
            });
        });
    });

    $(document).ready(function () {
        $("#close_any_tradesman").click(function () {
            $("#modal_schedule_any_tradesman").modal('toggle');
        });
    });

    $(document).ready(function () {
        $(".schedule_one_tradesman").click(function () {
            $("#modal_schedule_one_tradesman").modal({
                show: true
            });
        });
    });

    $(document).ready(function () {
        $("#close_one_tradesman").click(function () {
            $("#modal_schedule_one_tradesman").modal('toggle');
        });
    });
</script>
<!--You have to paste your API key in the following link-->
<script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2psniVzC9cwc5r1b6xt3ggfhFUt0DvsA&callback=initMap"></script>
    

</html>


<?php
include "footer.php";
?>