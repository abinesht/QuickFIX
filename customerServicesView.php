<?php
include 'header.php';

?>

<html>

<head>
<head>
 <title>Customer Services</title>
</head>
    <style>
        /*--------------------------------------SERVICES -------------------------------------------*/
        #service_image {
            width: 15rem;
            height: 10rem;
            border-radius: 2rem;
            padding: 1rem;
        }

        #rating_star {
            color: #df8918;
            position: relative;
            top: 0.4rem;
        }

        #box_service {
            border-bottom: 0.2rem solid #142f61 !important;
            /* border-top: 0.03rem solid #dce2ec;
            border-right: 0.03rem solid #dce2ec;
            border-left: 0.03rem solid #dce2ec; */
            border-radius: 1rem;
            box-shadow: 0 0 50px rgb(233, 230, 230);
        }

        #ourServices {
            border-bottom: 0.4rem solid #142f61;
        }

        .hire_now_button {
            width: 14rem;
            color: rgb(255, 255, 255);
            background-color: #142f61;
        }

        #sevice_type {
            border-bottom: 0.2rem solid #142f61;
        }

        .schedule_hiring_button {
            color: rgb(0, 0, 0);
            background-color: #F6E92F;
            width: 14rem;
        }

        #search_service {
            background-color: rgb(236, 228, 228);
        }

        #load_more_button {
            color: rgb(255, 255, 255);
            background-color: #142f61;
        }

        #head_image {
            height: 23rem;
            width: 100%;
        }

        #introduction_head {
            position: relative;
            top: -4rem;
        }


        @media (max-width: 768px) {
            #service_detail {
                align-items: center;
            }

        }

        @media (min-width: 992px) {
            .hire_now_button {
                width: 11rem;
            }

            .schedule_hiring_button {
                width: 11rem;
            }
        }

        /*--------------------------------------TOP IMAGE & TIPS & IMAGE & BACKGROUND GRADIANT -------------------------------------------*/
        .sevice_cover {
            position: relative;
        }

        .sevice_cover .sevice_coverimg {
            background: url("QuickFIX/images/tradesman2.png");
            min-height: 55vh;
            width: 100%;
            position: absolute;
            background-size: cover;
        }

        .sevice_cover .sevice_coveroverlay {
            height: 55vh;
            width: 100%;
            background: linear-gradient(to right, #142f61, #2b477c, rgb(243, 243, 150));
            position: absolute;
            opacity: 0.8;
        }

        .service_container {
            padding-top: 120px;
            padding-left: 2rem;
        }

        .sevice_covertxt {
            position: absolute;
        }


        #fullfillyourdays {
            color: #F6E92F;
            font-size: calc(20px + 2vw);
        }

        #atyourfingertips {
            color: white;
            font-size: calc(15px + 2vw);
            position: relative;
            top: -1.3rem;
        }

        #list_intro {
            position: relative;
            top: -2rem;
        }

        #list_intro,
        #bullet_incon_intro {
            color: white;
            font-size: calc(1px + 1.5vw);

        }

        @media (max-width: 1200px) {
            .sevice_cover .sevice_coverimg {
                min-height: 65vh;
            }

            .sevice_cover .sevice_coveroverlay {
                height: 65vh;
            }

            .service_container {
                padding-top: 120px;
            }

            #list_intro,
            #bullet_incon_intro {
                font-size: calc(1px + 1.5vw);
            }

        }

        @media (max-width: 992px) {
            .sevice_cover .sevice_coverimg {
                min-height: 58vh;
            }

            .sevice_cover .sevice_coveroverlay {
                height: 58vh;
            }

            .service_container {
                padding-top: 110px;
            }

            #list_intro,
            #bullet_incon_intro {
                font-size: calc(1.5px + 1.5vw);
            }

            #list_intro {
                position: relative;
                top: -1.2rem;
            }

            #atyourfingertips {
                position: relative;
                top: -0.6rem;
            }
        }

        @media (max-width: 768px) {
            .sevice_cover .sevice_coverimg {
                min-height: 55vh;

            }

            .sevice_cover .sevice_coveroverlay {
                height: 55vh;
            }


            #list_intro,
            #bullet_incon_intro {
                font-size: calc(2px + 1.5vw);
            }

            #list_intro {
                position: relative;
                top: -1rem;
            }

            #atyourfingertips {
                position: relative;
                top: -0.6rem;
            }
        }

        @media (max-width: 576px) {
            .sevice_cover .sevice_coverimg {
                min-height: 45vh;
            }

            .sevice_cover .sevice_coveroverlay {
                height: 45vh;
            }

            .service_container {
                padding-top: 75px;
            }

            #list_intro,
            #bullet_incon_intro {
                font-size: calc(3px + 1.5vw);
            }

        }

        @media (max-width: 470px) {
            .sevice_cover .sevice_coverimg {
                min-height: 40vh;
            }

            .sevice_cover .sevice_coveroverlay {
                height: 40vh;
            }

            .service_container {
                padding-top: 80px;
            }

            #fullfillyourdays,
            #atyourfingertips {
                font-size: calc(5px + 2vw);
                padding: 0;
            }

            #atyourfingertips {
                position: relative;
                top: -0.1rem;
            }

            #service_container {
                position: relative;
                left: 3rem !important;
            }

            #list_intro {
                font-size: calc(4px + 1.5vw);

            }
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="sevice_cover">
            <div class="sevice_coverimg">

            </div>
            <div class="sevice_coveroverlay">

            </div>
            <div class="service_container ps-5">
                <div id="introduction_head" class="sevice_covertxt fst-italic ">
                    <p id="fullfillyourdays" class=" fw-bold m-0">Fulfil your days</p>
                    <p id="atyourfingertips" class=" text-white fw-bold ps-4 fst-italic ">at your fingertips</p>
                    <div id="list_intro" class="list fw-bold ps-4 m-3 text-white">
                        <p class="m-0"> <span id="bullet_incon_intro" class="material-icons"> circle </span> <span>Hire
                                your
                                tradesman by ratings, reviews and order counts</span></p>
                        <p class="m-0"><span id="bullet_incon_intro" class="material-icons "> circle </span>
                            <span>Schedule
                                tradesman at your preferred times</span>
                        </p>
                        <p class="m-0"><span id="bullet_incon_intro" class="material-icons "> circle </span> <span>Hire
                                again
                                your preferred times</span></p>
                        <p class="m-0"><span id="bullet_incon_intro" class="material-icons "> circle </span> <span>Chat,
                                pay
                                and
                                review through one system</span></p>
                    </div>
                </div>
            </div>
        </div>




        <!-- ---------------------------------OUR SERVICES HEADING    ------------------------------------------- -->

        <div class="row">
            <p id=" " class="  h1 fw-bold pb-3 pt-2 mx-md-5"><span id="ourServices" class="pe-5">OUR SERVICES</span> </p>
            <!-- <input id="search_service" class=" col-sm-12 col-md-3 form-control my-4" type="search" placeholder="Search"> -->
        </div>
        <!-- ---------------------------------PLUMBER SERVICE BOX------------------------------------------- -->

        <div class="row d-flex justify-content-evenly">

            <?php
            require_once('classes.php');
            $sql = "SELECT * FROM service Order by average_rating ;";
            $result = QueryHandler::query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $service_id = $row['service_id'];
            ?> <div id="box_service" class="col-sm-5 mb-5">
                    <div id="box_in_service" class="row ">
                        <a href="one_service_page.php?service_id=<?php echo $service_id ?>" style="text-decoration:none;">
                            <div id="" class=" d-flex justify-content-center fw-bold h5 mt-1">
                                <div id="sevice_type" class=" pb-2"><?php echo $row['provider_name']; ?></div>
                            </div>
                        </a>
                        <div class="col text-center">
                            <img id="service_image" class="" src="Assets/Images/<?php echo $row['cover_photo'] ?>" alt="" />
                        </div>
                        <div id="service_detail" class="
                            col
                            pt-3
                            d-flex
                            flex-column
                            align-items-xs-center align-items-md-center align-items-lg-start
                        ">

                            <div class="fw-bolder"><?php echo $row['total_hirings']; ?> Total Order</div>
                            <div class="fw-bolder">
                                <p class="">
                                    Avg Review <?php echo $row['average_rating']; ?>
                                    <span id="rating_star" class="material-icons"> grade</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-md-12 col-lg-6 text-center">
                            <a href="one_service_page.php?service_id=<?php echo $service_id; ?>"> <button id="hire_now_button<?php echo $service_id ?>" data-id="<?php echo $service_id; ?>" class="hire_now_button btn rounded-pill fw-bold mt-3" type="button">
                                    Hire Now
                                </button></a>
                        </div>
                        <div class="col-md-12 col-lg-6 text-center mb-4">
                            <a href="one_service_page.php?service_id=<?php echo $service_id; ?>"><button id="schedule_hiring_button<?php echo $service_id ?>" data-id="<?php echo $service_id; ?>" class="schedule_hiring_button btn rounded-pill fw-bold mt-3" type="button">
                                    Schedule hiring
                                </button></a>
                        </div>
                    </div>
                </div>

            <?php }
            ?>

        </div>

    </div>


</body>

</html>