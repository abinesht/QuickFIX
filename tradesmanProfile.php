<?php
//          CUSTOMER PAGE
//  $trademsna id    =    1;     // tradesman ID     JB       receiver
//  $customer_id     =    2;     // customer ID      mathi    

include 'header.php';
?>
<html>

<head>
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
            height: 5px;
            margin-bottom: 10px;
        }

        .vertical_line {

            margin-right: 10px;
        }
    </style>
</head>

<body>
    <?php
    $customerID = $_GET['id']; // tradesman ID    JB
   // $customer_id_no = 1; // customer ID    
    $tradesmanObj = Tradesman::getInstance($_GET['id']);
    ?>
   
    <div class="container-lg">
        <div class="row pt-4">
            <div class="col-md-6 col-lg-5 col-xl-4">

                <!--Profile details card start-->

                <div class="card rounded-3 shadow-lg mx-3">
                    <div class="row d-flex align-items-center py-4 ps-5">
                        <div class="col-5">
                            <img src=<?php echo $user->getImg();?> class="rounded-circle" style="width: 90px" alt="profile photo" />
                        </div>
                        <div class="col-7">
                            <div class="row">
                                <h4><b><?php echo $tradesmanObj->getFirstname() ?></b></h4>
                            </div>
                            <div class="" style="margin-top: -10px">
                                <?php
                                if ($tradesmanObj->getActive_status() == 'online') {
                                    echo "<script> disableBtn();</script>"
                                ?>
                                    <img src="assets/img/online.png" style="width: 10px" alt="" />
                                    online

                                <?php
                                } else {
                                ?>
                                    <img src="assets/img/offline.png" style="width: 10px" alt="" />
                                    offline
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                    <div class="px-3 py-1" style="text-align: justify">
                        "<?php echo $tradesmanObj->getDescription() ?>"
                    </div>
                    <div class="ps-5 py-1">
                        <span class="material-icons pe-1" style="transform: scale(1.1); position: relative; top: 5.5px">
                            account_circle
                        </span>
                        <?php echo $tradesmanObj->getUsername() ?>
                    </div>
                    <div class="ps-5 py-1">
                        <span class="material-icons pe-1" style="transform: scale(1.1); position: relative; top: 5.5px">
                            call
                        </span>
                        <?php echo $tradesmanObj->getPhone_no() ?>
                    </div>
                    <div class="ps-5 py-1">
                        <span class="material-icons pe-1" style="transform: scale(1.1); position: relative; top: 5.5px">
                            email
                        </span>
                        <?php echo $tradesmanObj->getEmail() ?>
                    </div>
                    <div class="ps-5 py-1">
                        <span class="material-icons pe-1" style="transform: scale(1.1); position: relative; top: 5.5px">
                            location_on
                        </span>
                        <?php echo $tradesmanObj->getAddress() ?>
                    </div>
                    <div class="ps-5 py-1">
                        <span class="material-icons pe-1" style="transform: scale(1.1); position: relative; top: 5.5px">
                            star_rate
                        </span>
                        <?php echo "{$tradesmanObj->getAverage_rating()} ({$tradesmanObj->getNum_of_ratings()} ratings)" ?>
                    </div>
                    <div class="ps-5 py-1">
                        <span class="material-icons pe-1" style="transform: scale(1.1); position: relative; top: 5.5px">
                            work
                        </span>
                        <?php echo $tradesmanObj->getYrs_of_experience() ?> years experience
                    </div>
                    <div class="row py-4">
                        <?php
                        if ($tradesmanObj->getActive_status() == 'online') {
                        ?>
                            <button class="offset-3 col-6 btn btn-sm fw-bold text-white rounded-pill " id="hirenowbtn" style="background: #142f61; font-size: 16px">
                                Hire Now
                            </button>
                        <?php
                        } else {
                        ?>
                            <button class="offset-3 col-6 btn btn-sm fw-bold text-white rounded-pill " disabled id="" style="background: #142f61; font-size: 16px">
                                Hire Now
                            </button>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="row pb-4">
                        <div class=" offset-3 col-6 btn btn-sm fw-bold text-white rounded-pill " style="background: #142f61; font-size: 16px">
                            Schedule Now
                        </div>
                    </div>
                </div>

                <!--Profile details card end-->



                <!--Rating card start-->

                <?php
                $star_5;
                $star_4;
                $star_3;
                $star_2;
                $star_1;
                $star_total;

                for ($i = 1; $i <= 5; $i++) {
                    $result =QueryHandler::query("SELECT count(*) as star from hiring WHERE tradesman_id='$customerID' AND rating='$i'");
                    $data = mysqli_fetch_assoc($result);
                    ${'star_' . $i} = $data['star'];
                }
                $star_total = $star_1 + $star_2 + $star_3 + $star_4 + $star_5;

                ?>
                <div class="card rounded-3 shadow-lg m-3 p-2 px-3">
                    <div class="col-3 col-md-5">
                        <h3 class="pb-2" style="border-bottom: 0.3rem solid #142f61">
                            Rating
                        </h3>
                    </div>
                    <div class="row pt-2">
                        <div class="col-4 overall_stars">
                            <div class="fw-bold text-center" style="font-size: 50px;margin-top: -20px; margin-bottom: -10px;">
                                <?php echo $tradesmanObj->getAverage_rating() ?>
                            </div>
                            <div class="text-center" style="margin-top: -5px">
                                <?php
                                for ($i = 1; $i <= floor($tradesmanObj->getAverage_rating()); $i++) {
                                ?>
                                    <span class="material-icons">star_rate</span>
                                <?php
                                }

                                if (ceil($tradesmanObj->getAverage_rating()) != floor($tradesmanObj->getAverage_rating())) {
                                ?>
                                    <span class="material-icons">star_half</span>
                                <?php
                                }
                                for ($i = ceil($tradesmanObj->getAverage_rating()); $i < 5; $i++) {
                                ?>
                                    <span class="material-icons">star_border</span>
                                <?php
                                }

                                ?>

                            </div>
                        </div>



                        <div class="col-4">
                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo $star_5 / $star_total * 100 ?>%" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo $star_4 / $star_total * 100 ?>%" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo $star_3 / $star_total * 100 ?>%" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo $star_2 / $star_total * 100 ?>%" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" style="width: <?php echo $star_1 / $star_total * 100 ?>%" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="row  p-0" style="margin-top: -10px;">
                                <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo (int)($star_5 / $star_total * 100) ?>%</div>
                                <div class="col-9 five_stars p-0 " ">
                                    <span class=" material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                </div>
                            </div>
                            <div class="row p-0" style="margin-top: -9px;">
                                <div class="col-3 p-0 pt-1" style="font-size: 10px;"><?php echo (int)($star_4 / $star_total * 100) ?>%</div>
                                <div class="col-9 five_stars p-0 ">
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_border</span>
                                </div>
                            </div>
                            <div class="row  p-0" style="margin-top: -9px;">
                                <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo (int)($star_3 / $star_total * 100) ?>%</div>
                                <div class="col-9 five_stars p-0 ">
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_border</span>
                                    <span class="material-icons">star_border</span>
                                </div>
                            </div>
                            <div class="row  p-0" style="margin-top: -9px;">
                                <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo (int)($star_2 / $star_total * 100) ?>%</div>
                                <div class="col-9 five_stars p-0 ">
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_rate</span>
                                    <span class="material-icons">star_border</span>
                                    <span class="material-icons">star_border</span>
                                    <span class="material-icons">star_border</span>
                                </div>
                            </div>
                            <div class="row  p-0" style="margin-top: -9px;">
                                <div class="col-3  p-0 pt-1" style="font-size: 10px;"><?php echo (int)($star_1 / $star_total * 100) ?>%</div>
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
                </div>

                <!--Rating card end-->

            </div>

            <!--Service and review card start-->
            <div class="col-md-6 col-lg-7 col-xl-8 mb-3">
                <div class="card rounded-3 shadow-lg ms-md-0 ms-3 me-3  p-2 px-3 py-4 ">
                    <!--Services list start-->

                    <div class="tradesman_services">
                        <h3 class="col-5 col-md-6 col-lg-5 col-xxl-3 pb-2" style="border-bottom: 0.3rem solid #142f61">
                            Services
                        </h3>
                        <div>
                            <ul class="mx-3">
                                <?php
                                $query_service_list = "SELECT * FROM service_of_tradesman  WHERE tradesman_id='$customerID'";
                                $service_result = mysqli_query($conn, $query_service_list);

                                if (mysqli_num_rows($service_result) > 0) {
                                    while ($row = mysqli_fetch_assoc($service_result)) {

                                ?>
                                        <li><a href="#" class="text-decoration-none text-dark fw-bold" style="font-size: 18px;"><?php echo $row['service_name'] ?></a></li>
                                <?php
                                    }
                                }
                                ?>

                            </ul>
                        </div>
                    </div>

                    <!--Services list end-->



                    <!--Reviews list start-->

                    <div class="tradesman_reviews">
                        <h3 class="col-5 col-md-6 col-lg-5 col-xxl-3 pb-2" style="border-bottom: 0.3rem solid #142f61">
                            Reviews (<?php echo $tradesmanObj->getNum_of_review() ?>)
                        </h3>

                        <div class="review_list ps-3 pt-2">
                            <?php
                            $query_review_list = "SELECT * FROM hiring  WHERE tradesman_id='$customerID' ORDER BY completed_cancelled_date ASC";
                            $review_result = mysqli_query($conn, $query_review_list);

                            if (mysqli_num_rows($review_result) > 0) {
                                while ($row1 = mysqli_fetch_assoc($review_result)) {
                                    $customer_id = $row1['customer_id'];

                                    $query_customer_list = "SELECT * FROM customer  WHERE customer_id='$customer_id'";
                                    $customer_result = mysqli_query($conn, $query_customer_list);

                                    if (mysqli_num_rows($customer_result) > 0) {
                                        while ($row2 = mysqli_fetch_assoc($customer_result)) {

                            ?>
                                            <div class="d-flex align-items-center pb-3">
                                                <div class="col-4 col-sm-3 col-md-4  col-xl-4 col-xxl-3 ">
                                                    <div class="row">
                                                        <div class="col-12 col-lg-4 col-xl-3 text-center ">
                                                            <img src="images/<?php echo $row2['img'] ?>" class="rounded-circle" style="width: 50px" alt="profile photo" />
                                                        </div>
                                                        <div class="col-12  col-lg-8 col-xl-9 text-center ">
                                                            <div class=" pt-1"><?php echo $row2['firstname'] ?></div>
                                                            <div class="" style="margin-top: -5px;">
                                                                <?php
                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    if ($i <= $row1['rating']) {
                                                                ?>
                                                                        <span class="material-icons material-icons-star">star_rate</span>
                                                                    <?php
                                                                    } else {
                                                                    ?>
                                                                        <span class="material-icons material-icons-star">star_border</span>
                                                                <?php
                                                                    }
                                                                }
                                                                ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-8 ps-1 ms-1">
                                                    <div class="row">
                                                        <div class="col-12 col-xl-9  px-2 " style="border-left: 0.2rem solid #142f61; text-align: justify;">

                                                            "<?php echo $row1['review'] ?>"

                                                        </div>
                                                        <div class="col-12 col-xl-3 text-center fw-bold">
                                                            <?php echo substr($row1['completed_cancelled_date'], 0, 10) ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </div>


                    </div>

                    <!--Reviews list end-->
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade " id="hirehim_modal<?php echo $customerID;  ?>">
        <div class="modal-dialog modal-dialog-centered" id="modalBoxWidth">
            <!-- Modal content-->
            <div class="modal-content  mx-3">
                <form action="" method="POST" id="hirespecificForm">
                    <div class="modal-header text-white py-1 m-0" id="modalTitle" style="background-color: #142f61;">
                        <h5 class="modal-title" id="address-label-title">Register Details</h5>
                        <button type="button" class="btn-close bg-white text-white fw-bold" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="row fw-bold mx-2">

                        <div class="col-12 col-md-6">
                            <div class="fw-bold h5" id="selectService">
                                Select Service
                            </div>
                            <fieldset id="group1">
                                <?php
                                $query_service_list = "SELECT * FROM service_of_tradesman  WHERE tradesman_id='$customerID'";
                                $service_result = mysqli_query($conn, $query_service_list);

                                if (mysqli_num_rows($service_result) > 0) {
                                    while ($row = mysqli_fetch_assoc($service_result)) {
                                ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" id="serviceRadio" name="radio" value="<?php echo $row['service_id'] ?>"><?php echo $row['service_name'] ?>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
                            </fieldset>
                        </div>
                        <div>
                            <input type="text" class="form-control" id="sender_id" name="sender_id" value="<?php echo $customer_id_no; ?>">
                            <input type="text" class="form-control" id="receiver_id" name="receiver_id" value="<?php echo $customerID; ?>">
                        </div>
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


                    <textarea class=" form-control" name="address" id="address-label" hidden></textarea>
                    <input class="col-6" type="text" name="lng" id="lng" value="" hidden>
                    <input class="col-6" type="text" name="lat" id="lat" value="" hidden>


                    <div class="row">
                        <div class="col-md-12 modal_body_map">
                            <div class="location-map" id="location-map">
                                <div style="width: 100%; height: 300px;" id="map"></div>
                            </div>
                        </div>
                    </div>

                    <div class=" d-flex flex-row-reverse mx-3 my-1">
                        <div class="">
                            <button id="hirehimfinal" class="close btn text-white fw-bold mt-1" type="submit" name="submit" style="background-color:#142f61">
                                Hire Now
                            </button>
                        </div>
                    </div>

                    <div id="id2" class="bg-primary">

                    </div>

                </form>

                <?php
                // if (isset($_POST['submit'])) {
                //     if (isset($_POST['radio'])) {
                //         if (isset($_POST['radioAddress'])) {

                //             $address;
                //             $lat;
                //             $lng;
                //             if ($_POST['radioAddress'] == "Use default Address") {
                //                 $conn = (new Connection())->createConnection();
                //                 $result = mysqli_query($conn, "SELECT * from customer WHERE customer_id='$customerID'");
                //                 $data = mysqli_fetch_assoc($result);
                //                 $address = $data['address'];
                //                 $lat = $data['latitude'];
                //                 $lng = $data['longitude'];
                //             } else {
                //                 $address = $_POST['address'];
                //                 $lat = $_POST['lat'];
                //                 $lng = $_POST['lng'];
                //             }
                //             echo $address;
                //             echo $lat;
                //             echo $lng;
                //             echo $_POST['radioAddress'];
                //             echo $_POST['radio'];
                //         } else {
                //             echo "<script>alert('please select the Address type')</script>";
                //         }
                //     } else {
                //         echo "<script>alert('please select the service')</script>";
                //     }
                // }
                ?>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $("#hirenowbtn").click(function() {
                $("#hirehim_modal<?php echo $customerID;  ?>").modal({
                    show: true
                });
            });

            setInterval(function() {
                getCount();
            }, 5000);

            $('#hirespecificForm').on('submit', function(event) {
                var form_data = $(this).serialize();
                console.log(form_data);
                let tradesman_id = <?php echo $customerID; ?>;
                event.preventDefault();
                var form_data = $(this).serialize();
                let receiver_id = $('#receiver_id').val();
                console.log("receiver is");
                console.log(receiver_id);
                if ($('#lng').val() != '' && $('#lat').val() != '') {
                    $.ajax({
                        url: "insert.php",
                        method: "POST",
                        data: form_data,
                        success: function(data) {
                            $('#hirespecificForm')[0].reset();
                            $('id2').html(data);
                        }
                    });
                }
            });

            function getCount(view = '') {
                let customer_id = <?php echo $customer_id_no ?>;
                $.ajax({

                    url: "countSchedule.php",
                    method: "POST",
                    data: {
                        view: customer_id
                    },
                    dataType: "json",
                    success: function(data) {
                        // $('#msgFromSchedulePage').html(data);

                        if (data.unseen_notification > 0) {
                            $('.count').html(data.unseen_notification);
                        }
                    }
                });
            }
            // getCount();

            function insertNotification(view = '') {
                $.ajax({
                    url: "insertC.php",
                    method: "POST",
                    data: {
                        view: view
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#insertC').html(data.notification);
                        // $('#msgFromSchedulePage').html(data);
                        load_unseen_notification('yes');
                    }
                });
            }


            function load_unseen_notification(view = '') {
                let tradesman_id = <?php echo $customer_id_no ?>;
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
                        $('.dropdown-menu').html(data.notification);
                        getCount();
                    }
                });
            }

            load_unseen_notification();

            $(document).on('click', '#drop-down', function() {
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
                        location.href = "http://localhost/quickfix/avines/ongoing/chatCustomer.php?hiring_id=" + hiring_id;

                    }
                });
            });

            $(document).on("click", "#ok", function() {

                let del = $(this);
                let sheduleID = $(this).attr("data-id");
                $.ajax({
                    type: "get",
                    data: {
                        sheduleID: sheduleID
                    },
                    url: "done_ok.php",
                    success: function(data) {
                        load_unseen_notification();
                        console.log("done clicked....");

                    }
                });
            });

           
            
        });
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2psniVzC9cwc5r1b6xt3ggfhFUt0DvsA&callback=initMap"></script>

</body>

</html>