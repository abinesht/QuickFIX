<?php
include "header.php";
$service_id = $_GET['service_id'];

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
$star_total = $star_1 + $star_2 + $star_3 + $star_4 + $star_5 + 1;

$pending_hirings;

$result = QueryHandler::query("SELECT count(*) as pendings from hiring WHERE service_id='$service_id' AND final_status = 'Scheduled'");
$data = mysqli_fetch_assoc($result);
$pending_hirings = $data['pendings'];

if (isset($_SESSION["customer_id"])) {
    $customer_id = $_SESSION["customer_id"]; // customer ID     
    $customerObj = new Customer();
    $customerObj->read($customer_id);
}

if (isset($_SESSION['tradesman_id_for_hire_now'])) {
    $tradesman_id_hire_Now = $_SESSION['tradesman_id_for_hire_now'];
    echo "<script>console.log($tradesman_id_hire_Now)</script>";
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <title>Abinesh</title>
    <script src="./index.js"></script>

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
    </style>

</head>

<body>

    <script>
        function openNext_schedule() {
            $(document).ready(function() {
                $("#hireschedule_modalNext<?php echo $customer_id ?>").modal("show");
            });
        };
    </script>


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
                                    <span><?php echo $pending_hirings ?> Pending Hirings </span><br>
                                    <span><?php echo $total_tradesman ?> Total Workers</span><br>
                                    <span id="" class="material-icons star"> grade</span>
                                    <span><?php echo $average_rating ?> (<?php echo $star_total ?> ratings)</span>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <button class="btn button hire_any_tradesman fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#hireany_modal<?php echo $customer_id ?>">Hire Now </button>
                                    </div>
                                    <div class="row">

                                        <button class="btn button schedule_any_tradesman fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#hireschedule_modal<?php echo $customer_id ?>">Schedule Now </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col ratingPart ">
                            <span class="subHeading pe-4">Rating for the workers</span>

                            <!--Rating card start-->
                            <div class="row pt-4 mt-2">
                                <div class="col-4 overall_stars">
                                    <div class="fw-bold text-center" style="font-size: 50px;margin-top: -20px; margin-bottom: -10px;">
                                        <?php echo $average_rating ?>
                                    </div>
                                    <div class="text-center" style="margin-top: -5px">
                                        <?php if ($average_rating == 1) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        } else if ($average_rating < 2) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        } else if ($average_rating == 2) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        } else if ($average_rating < 3) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        } else if ($average_rating == 3) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        } else if ($average_rating < 4) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        } else if ($average_rating == 4) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                        <?php
                                        } else if ($average_rating < 5) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_half</span>
                                        <?php
                                        } else if ($average_rating == 5) { ?>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                        <?php
                                        } ?>

                                    </div>
                                </div>

                                <div class="col-4">

                                    <div class="progress">

                                        <div class="progress-bar" style="width: <?php echo $star_5 * 100 / $star_total ?>%" role="progressbar" aria-valuenow="<?php echo $star_5 * 100 / $star_total ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>

                                    <div class="progress">

                                        <div class="progress-bar" style="width: <?php echo $star_4 * 100 / $star_total ?>%" role="progressbar" aria-valuenow="<?php echo $star_4 * 100 / $star_total ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_3 * 100 / $star_total ?>%" role="progressbar" aria-valuenow="<?php echo $star_3 * 100 / $star_total ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_2 * 100 / $star_total ?>%" role="progressbar" aria-valuenow="<?php echo $star_2 * 100 / $star_total ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: <?php echo $star_1 * 100 / $star_total ?>%" role="progressbar" aria-valuenow="<?php echo $star_1 * 100 / $star_total ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="row  p-0" style="margin-top: -10px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_5 * 100 / $star_total) ?>%</div>
                                        <div class="col-9 five_stars p-0 ">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                        </div>
                                    </div>
                                    <div class="row p-0" style="margin-top: -9px;">
                                        <div class="col-3 p-0 pt-1" style="font-size: 10px;"><?php echo round($star_4 * 100 / $star_total) ?>%</div>
                                        <div class="col-9 five_stars p-0 ">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                        </div>
                                    </div>
                                    <div class="row  p-0" style="margin-top: -9px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_3 * 100 / $star_total) ?>%</div>
                                        <div class="col-9 five_stars p-0 ">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        </div>
                                    </div>
                                    <div class="row  p-0" style="margin-top: -9px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_2 * 100 / $star_total) ?>%</div>
                                        <div class="col-9 five_stars p-0 ">
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_rate</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                            <span class="material-icons">star_border</span>
                                        </div>
                                    </div>
                                    <div class="row  p-0" style="margin-top: -9px;">
                                        <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo round($star_1 * 100 / $star_total) ?>%</div>
                                        <div class="col-9 five_stars p-0 ">
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

                    $x = min(7, mysqli_num_rows($result));

                    for ($x; $x > 0; $x--) {
                        $row = mysqli_fetch_assoc($result);

                        $st_id = $row["st_id"];

                        $service_of_tradesman = new Service_of_tradesman();
                        $service_of_tradesman->read($st_id);

                        $tradesman_id = $service_of_tradesman->getTradesman_id();
                        $average_rating = $service_of_tradesman->getAverage_rating();

                        $tradesman = new Tradesman();
                        $tradesman->read($tradesman_id);

                        $username = $tradesman->getUsername();
                        $img = $tradesman->getImg();

                    ?>
                        <div class="row peopleone">
                            <div class="col-md-1 col-lg-2 col-sm-2 col-2">
                                <img id="" class="profile" src="images/<?php echo $img ?>" alt="profile">

                            </div>
                            <div class="col-4 col-lg-4 col-sm-3">
                                <p class="name"><?php echo $username ?> <br> <?php echo $average_rating ?>
                                    <span id="" class="material-icons star"> grade</span>

                                </p>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                    <a href="user_merge.php?tradesman_id=<?php echo $tradesman_id; ?>"> <button class=" button hire_one_tradesman fw-bold" type="button">Hire Now </button> </a>

                                    </div>
                                    <div class="col">
                                    <a href="user_merge.php?tradesman_id=<?php echo $tradesman_id; ?>">  <button class="button schedule_one_tradesman fw-bold" type="button" data-bs-toggle="modal" data-bs-target="#modal_schedule_one_tradesman">Schedule Now </button> </a>

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

    <!-- MODAL hire_any_tradesman   -->

    <div class="modal fade " id="hireany_modal<?php echo $customer_id ?>">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content  mx-3">
                <form id="hireanyform" action="" method="POST">
                    <div class="modal-header text-white py-1 m-0" id="modalTitle" style="background-color: #142f61;">
                        <h5 class="modal-title" id="address-label-title-HireAny">Register Details</h5>
                        <button type="button" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="row fw-bold mx-2 mb-2">

                        <div class="col-12 col-md-6">
                            <div class="fw-bold h5" id="dateAndTime">
                                Select Location
                            </div>
                            <fieldset id="group2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioAddress" id="flexRadioDefault1" value="Use default Address">Use default Address
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="radioAddress" id="flexRadioDefault2" value="Pick new Address">Pick new Address
                                </div>
                            </fieldset>

                        </div>

                    </div>


                    <textarea class=" form-control" name="address" id="address-label-HireAny" hidden></textarea>
                    <input class="col-6" type="text" name="lng" id="lngHireAny" value="" hidden>
                    <input class="col-6" type="text" name="lat" id="latHireAny" value="" hidden>
                    <input type="hidden" class="form-control" id="customer_id" name="customer_id" value="<?php echo $customer_id; ?>">
                    <input type="hidden" class="form-control" id="service_id" name="service_id" value="<?php echo $service_id; ?>">


                    <div class="row mx-3 p-0">

                        <div id="fixed_map">
                            <div class="location-map" id="location-map">
                                <div style="width: 100%; height: 21.5rem;" class="map m-0" id="mapHireAny"></div>
                            </div>
                        </div>
                    </div>

                    <div class=" d-flex flex-row-reverse mx-3 my-1">
                        <div class="">

                            <button id="hirehimfinal<?php echo $customer_id; ?>" data-id=" <?php echo $customer_id; ?>" class="close btn text-white fw-bold mt-1" type="submit" name="submit" style="background-color:#142f61">
                                <!-- <input type="submit" name="post" id="post" class="btn btn-info" value="Post" /> -->
                                Hire Now
                            </button>
                        </div>
                    </div>

                </form>

                <?php


                ?>

            </div>
        </div>
    </div>

    <!-- Schdule Any Tradesman Modal box 1 -->

    <div class="modal fade summa_modal" id="hireschedule_modal<?php echo $customer_id ?>" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <div class="modal-content  mx-3">
                <form action="" method="POST" id="comment_form<?php echo $customer_id; ?>">

                    <div class="modal-header text-white py-1 m-0" style="background-color:#142f61" id="modalTitle">
                        <h5 class="modal-title" id="address-label-title-ScheduleAny">Register Details</h5>
                        <button type="button" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="row fw-bold mx-2">
                        <div class="col-12 col-md-6">
                            <div class="fw-bold h5" id="dateAndTime">
                                Select Date and Time
                            </div>
                            <div class="row my-1">
                                <div class="col-3 col-md-2 mt-2">Date</div>
                                <div class="col-6 col-md-10">
                                    <input id="date<?php echo $customer_id; ?>" name="date" type="date" class="form-control" placeholder="" required />
                                </div>
                            </div>
                            <div class="row my-1">
                                <div class="col-3 col-md-2  mt-2">Time</div>
                                <div class="col-6 col-md-10">
                                    <input id="time<?php echo $customer_id; ?>" name="time" type="time" class="form-control" placeholder="" required />
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="fw-bold h5" id="selectLocation">
                                Select Location
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="schedule_Address_radio" id="flexRadioDefault1" value="Use default Address" required>Use default Address
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="schedule_Address_radio" id="flexRadioDefault2" value="Pick new Address">Pick new Address
                            </div>

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 modal_body_map">
                            <div class="location-map">
                                <div style="width: 100%; height: 300px;" id="mapScheduleAny" class="map"></div>
                            </div>
                        </div>
                    </div>

                    <textarea class=" form-control" name="address_schedule" id="address-label-ScheduleAny" hidden></textarea>
                    <input class="col-6" type="text" name="lng_schedule" id="lngScheduleAny" value="" hidden>
                    <input class="col-6" type="text" name="lat_schedule" id="latScheduleAny" value="" hidden>

                    <div class=" d-flex flex-row-reverse mx-3">
                        <div class="my-2">
                            <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">Open second modal</button> -->

                            <button type="submit" id="scheduleAnybtn" data-id=" <?php echo $customer_id; ?>" data-bs-toggle="modal" data-bs-dismiss="modal" class="close btn text-white fw-bold mt-1" name="scheduleNext" style="background-color:#142f61">
                                <!-- <input type="submit" name="post" id="post" class="btn btn-info" value="Post" /> -->
                                Hire Schedule
                            </button>
                        </div>
                    </div>
                </form>


                <?php

                if (isset($_POST['scheduleNext'])) {

                    // echo "<script> alert('dsgas') </script>";
                    if ($_POST['schedule_Address_radio'] == "Use default Address") {
                        $result =  QueryHandler::query("SELECT * from customer WHERE customer_id='$customer_id'");
                        $data = mysqli_fetch_assoc($result);
                        $address = $data['address'];
                        $lat = $data['latitude'];
                        $lng = $data['longitude'];
                    } else {
                        $address = $_POST['address_schedule'];
                        $lat = $_POST['lat_schedule'];
                        $lng = $_POST['lng_schedule'];
                    }
                    $distanceArr = $customerObj->findNearTradesmanHireSchedule($lat, $lng, $service_id);
                    $_SESSION['distance_arr'] = $distanceArr;
                    $_SESSION['lat'] = $lat;
                    $_SESSION['lng'] = $lng;
                    $_SESSION['address'] = $address;
                    $_SESSION['date'] = $_POST['date'];
                    $_SESSION['time'] = $_POST['time'];
                    $c = count($distanceArr);

                    echo "<script> console.log('dsgas') </script>";
                    //echo "<script> count_check($c); </script>";
                    echo "<script> openNext_schedule(); </script>";
                }
                ?>
            </div>
        </div>
    </div>


    <div class="modal fade " id="scheduleAny_dummy">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content p-4  mx-3">
                There are no tradesmen Active Now please try again later
            </div>
        </div>
    </div>

    <!-- Schedule Any Tradesman Modal Box 2 -->

    <div class="modal fade summamodal2" id="hireschedule_modalNext<?php echo $customer_id ?>">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <div class="modal-content  mx-3">
                <form action="" method="POST" id="scheduleAnyForm">
                    <div>
                        <!-- <input type="text" class="form-control" id="sender_id" name="sender_id" value="<?php echo $customer_id; ?>">
                        <input type="text" class="form-control" id="receiver_id" name="receiver_id" value="<?php echo $tradesman_id; ?>">
                        <input type="text" class="form-control" id="service_id" name="service_id" value="<?php echo $service_id; ?>"> -->
                    </div>
                    <div class="modal-header text-white py-1 m-0" style="background-color:#142f61" id="modalTitle">
                        <h5 class="modal-title">Select Tradesman</h5>
                        <button type="button" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <?php
                    if (isset($_POST['scheduleNext'])) {

                        $js = json_encode($distanceArr);
                        echo "<script>console.log($js)</script>";
                    }

                    $suggest_count = 0;
                    foreach ($distanceArr as $tradesmanid => $distance) {
                        if ($suggest_count < 5) {
                            $suggest_count++;
                            $trademan_for_suggestion = new Tradesman();
                            $trademan_for_suggestion->read($tradesmanid);
                            $x = $trademan_for_suggestion->getFirstname();
                            echo "<script>console.log($x)</script>";
                    ?>

                            <div class="d-flex pt-2  pb-3 text-secondary">
                                <div class="col-5 ms-3 ">
                                    <div class="row">
                                        <div class="col-4 text-center ">
                                            <img src="images/logo.png" class="rounded-circle" style="width: 50px; height:50px;" alt="profile photo" />
                                        </div>
                                        <div class="col-8" style="border-right: 0.2rem solid #142f61;">
                                            <div class=" "><?php echo $trademan_for_suggestion->getFirstname(); ?></div>
                                            <div class=""><?php echo $trademan_for_suggestion->getAverage_rating(); ?><span class="material-icons" style="color: orange; font-size: 18px; margin-left:5px; margin-top:3px;">star_rate</span></div>
                                            <div class=" "><?php echo $trademan_for_suggestion->getTotal_hirings_count() ?> Total Hirings</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7 ps-4 ms-1">
                                    <div class="row">
                                        <div class="col-4  ps-2 " style=" text-align: justify;">
                                            <?php echo $distance ?>km away
                                        </div>
                                        <div class="col-8  text-center fw-bold">

                                        
                                            <input class=" form-control" name="address" id="address-label-HireAny" hidden value="<?php echo $_SESSION['address'];?>"></input>
                                            <input class="col-6" type="text" name="lng" id="lngHireAny"  hidden value="<?php echo $_SESSION['lat'];?>">
                                            <input class="col-6" type="text" name="lat" id="latHireAny" hidden value="<?php echo $_SESSION['lng'];?>">
                                            <input type="hidden" class="form-control" id="sender_id" name="sender_id" value="<?php echo $customer_id; ?>">
                                            <input type="hidden" class="form-control" id="time" name="time" value="<?php echo $_SESSION['time']; ?>">
                                            <input type="hidden" class="form-control" id="date" name="date" value="<?php echo $_SESSION['date']; ?>">
                                            <input type="hidden" class="form-control" id="tradesman_id" name="tradesman_id" value="<?php echo $tradesman_id; ?>">
                                            <input type="hidden" class="form-control" id="service_id" name="service_id" value="<?php echo $service_id; ?>">

                                            <button id="hireschedule<?php echo $tradesmanid; ?>" data-id="" class=" btn text-white fw-bold mt-1 rounded" type="submit" name="schedule_last" style="background-color:#142f61">
                                                <!-- <input type="submit" name="post" id="post" class="btn btn-info" value="Post" /> -->
                                                Schedule
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>


                </form>


            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            initMaphireAny()
            initMapScheduleAny()
            console.log("doc ready");

            // scheduleAnyForm

            $('#hireanyform').on('submit', function(event) {

                let customer_id = $('#hirehimfinal<?php echo $customer_id; ?>').attr("data-id");
                console.log(customer_id);
                // alert(customer_id);
                event.preventDefault();
                var form_data = $(this).serialize();
                console.log(form_data);
                if ($('#date').val() != '' && $('#time').val() != '') {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "insertHireAny.php",
                        method: "POST",
                        data: form_data,
                        success: function(data) {
                            $('#hireanyform')[0].reset();
                            // load_unseen_notification();
                            console.log("hire any form success");
                            console.log(data);
                        }
                    });
                } else {
                    alert("Both Fields are Required");
                    console.log("Aler msg = #date");
                }
            });

            $('#scheduleAnyForm').on('submit', function(event) {

                event.preventDefault();
                var form_data = $(this).serialize();
                console.log("schedule any start");
                console.log(form_data);
                if ($('#date').val() != '' && $('#time').val() != '') {
                    var form_data = $(this).serialize();
                    $.ajax({
                        url: "insertScheduleAny.php",
                        method: "POST",
                        data: form_data,
                        success: function(data) {
                            $('#scheduleAnyForm')[0].reset();
                            // load_unseen_notification();
                            console.log("schedule any form success");
                            console.log(data);
                        }
                    });
                } else {
                    alert("Both Fields are Required");
                    console.log("Aler msg = #date");
                }
            });


        });
    </script>

    <!--You have to paste your API key in the following link-->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2psniVzC9cwc5r1b6xt3ggfhFUt0DvsA"></script>

</body>

</html>


<?php
include "footer.php";
?>