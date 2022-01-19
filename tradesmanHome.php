<?php
include 'header.php';
include 'calendar.php';
// $tradesman_id = 17;
$tradesman_id = $_SESSION['customer_id'];
// $tradesman_id = $_GET['tradesman_id'];

$tradesmanObj = new Tradesman();
$tradesmanObj->read($tradesman_id);
?>

<html>

<style>
    #top1 {
        background-color: rgb(223, 223, 223);
        font-weight: bold;
    }

    #earnsHeading {
        border-bottom: 0.2rem solid #142f61;
    }

    #workerPhoto {
        border-radius: 35%;
        height: 7rem;
        width: 7rem;
    }

    #reviewtext {
        color: #818589;
        ;
    }

    @media (max-width: 992px) {
        #details {
            text-align: center;
        }

        #number {
            text-align: center;
        }


    }

    @media (min-width: 768px) {
        #profile {
            border-right: 0.3rem solid #142f61;
        }
    }



    /*------------------------------------------------------------------------*/
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

    /* --------------------------------------------------------------- */
    .horizontal_line_customer {
        border-top: 6px solid #142f61;
        width: 22rem;
        position: relative;
        top: -1rem;
    }

    #job_images {
        width: 15rem;
        height: 10rem;
        border-radius: 2rem;
        padding: 1rem;
    }

    /* #job{
        border-bottom: 0.18rem solid #0d56dd;
        padding-bottom: 0.5rem;
       } */
    #star {
        color: #df8918;
        position: relative;
        top: 0.4rem;
    }

    #box {
        border-bottom: 0.2rem solid #142f61;
    }

    #topServices,
    #lastHiringUnderline,
    #yourScheduleUnderline {
        border-bottom: 0.4rem solid #142f61;
    }

    @media (max-width: 768px) {
        #service_detail {
            align-items: center;
        }
    }

    /* ---------------------------------------------------------------------------------- */

    #photoWorker {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
        padding: 1rem;
    }

    #hireBox {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2),
            0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-radius: 2%;
    }
</style>

<body>
    <?php
    $month = date("Y-m-d");
    $calendar = new Calendar($month);
    $current_month = $calendar->getActive_month();
    $current_year = $calendar->getActive_year();
    ?>

    <div class="container">
        <!-- --------------------Top  box 1 ------------------------------------------- -->
        <div id="top1" class="row py-5">
            <div class="col-md-5 com-sm-12 ms-lg-5 pe-0" id="profile">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-3" id="photo">
                        <div class="text-center">
                            <img src=<?php $tradesmanObj->getImg() ?> id="workerPhoto" class="" />
                        </div>
                        <div class="text-center pt-3">@<?= $tradesmanObj->getUsername() ?></div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-8 ms-lg-4 ms-md-4 ms-lg-0" id="details">
                        <div class="row" id="name">
                            <div class="text-uppercase"><?= $tradesmanObj->getFirstname(); ?> <?= $tradesmanObj->getLastname() ?></div>
                        </div>
                        <div class="row pt-3" id="number">
                            <div><?= $tradesmanObj->getPhone_no() ?></div>
                            <div><?= $tradesmanObj->getEmail() ?></div>
                            <div><?= $tradesmanObj->getAddress() ?></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 com-sm-12 ms-4 row mt-sm-3" id="earnings">
                <div id="counts" class="col-md-12 col-sm-6">
                    <div>Total Hirings - <?= $tradesmanObj->getNum_of_hirings() ?></div>
                    <div>Total Ratings - <?= $tradesmanObj->getNum_of_ratings() ?></div>
                    <div>Total Reviews - <?= $tradesmanObj->getNum_of_review() ?></div>
                    <div>Average Rating - <?= $tradesmanObj->getAverage_rating() ?></div>
                    <div>Total Earnings - <?= $tradesmanObj->getTotal_earnings() ?></div>
                </div>
                <div id="eanrs" class="mt-3 col-md-12 col-sm-6">
                    <span id="earnsHeading" class="text-uppercase pb-1 pe-5">earnings
                    </span>
                    <div class="mt-2">Plumbing - 10 - Hirings - Rs 3600/=</div>
                    <div>Electrical work - 13 - Hirings - Rs 4600/=</div>
                </div>
            </div>
        </div>

        <!-- ------------------------------------------------------------------------- -->
        <!-- CUSTOMER scheduleS -> show scheduled details in 2 way. CALENDAR & LIST  -->

        <div class="h1 text-uppercase mt-2">
            <p>your schedules</p>
        </div>



        <div class="horizontal_line_customer"></div>
        <!-- LIST VIEW OF scheduleS   :: example ::  "Sep 1, 02.10 p.m - Jeyabawan"  -->
        <div class="row m-3" id="CalendarContent">
            <div class="col-md-12 col-lg-6 mb-5" id="schedule_list">
                <div class="fw-bold me-5" id="schedule_list_box">
                    <p id="scheuledList" class="h3 fw-bold">
                        Your scheduled hirings for this month
                    </p>
                    <div id="alertBox" class="alert alert-dark" role="alert">
                        You Have No Schedule For This Month!!!!
                    </div>
                    <ul>
                        <?php
                        $sql = "SELECT * from calendar where tradesman_id='$tradesman_id' ORDER BY date;";
                        $result = QueryHandler::query($sql);
                        if (!$result) {
                            die('QUERY FAIL!');
                        }
                        $count = 0;

                        while ($row = mysqli_fetch_assoc($result)) {
                            $customerObject = new Customer();
                            $customerObject->read($row['customer_id']);
                            // echo $row['customer_id'];
                            if (date('m', strtotime($row['date'])) == $current_month  && date('Y', strtotime($row['date'])) == $current_year) {
                                $count = $count + 1;
                                $calendar->add_event($customerObject->getUsername(), $row['date'], 1, 'green', $row['time']);
                                echo  '<li class="fw bold h5">' . date('M j ,', strtotime($row['date'])) . ' ' . date('g:i a', strtotime($row['time'])) . ' - ' . $customerObject->getUsername() . ' - ' . $row['service_name'] . '</li>';
                                $events = $calendar->getEvents();
                                // echo '<script> console.log('.$events[0].'); </script>';
                                // echo $events[0];

                                for ($i = 1; $i <= 31; $i++) {
                        ?><div class="modal fade" id="modal_schedule_date_<?php echo $i; ?>" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <!-- Modal content-->
                                            <div class="modal-content p-3 text-center">
                                                <div><?php echo $customerObject->getUsername() . "<br>Date:" . $row['date'] . "    Time:" . $row['time']; ?></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <button class="btn text-white fw-bold" style="background-color: #142f61">
                                                            CHANGE
                                                        </button>
                                                    </div>
                                                    <div class="col">
                                                        <button type="close" data-dismiss="modal" class="close btn text-white fw-bold" style="background-color: #142f61">
                                                            CLOSE
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><?php
                                        }
                                    }
                                }

                                if ($count == 0) {
                                    echo '<script>document.getElementById("scheuledList").style.display="none"; </script>';
                                    echo '<script>document.getElementById("alertBox").style.display="block"; </script>';
                                } else {
                                    echo '<script>document.getElementById("scheuledList").style.display="block";</script>';
                                    echo '<script>document.getElementById("alertBox").style.display="none";</script>';
                                }
                                            ?>
                        <!-- <li class="fw bold h5">Sep 1, 02.10 p.m - Jeyabawan</li> -->

                    </ul>
                </div>
            </div>

            <div class="col-md-12 col-lg-6" id="calendar_box">
                <?php echo $calendar ?>
            </div>
        </div>




        <!-- --------------------Third  box - LAST HIRINGS ------------------------------------------- -->
        <div class="h1 text-uppercase mt-2 ms-5">
            <span id="lastHiringUnderline">last hirings</span>
        </div>
        <div class="row fw-bold ms-3" id="hiringRow">
            <?php
            require_once('classes.php');
            $sql = "SELECT * FROM hiring WHERE current_status = 'completed' AND tradesman_id='$tradesman_id' limit 4;";
            $result = QueryHandler::query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $customerObject = new Customer();
                $customerObject->read($row['customer_id']);
                $hiringObject = new Hiring();
                $hiringObject->read($row['hiring_id']);
            ?>
                <div class="d-flex justify-content-center row col-sm-12 col-md-12 col-lg-6">
                    <div id="hireBox" class="p-2 m-3 col-sm-12 col-lg-11">
                        <div class="row">
                            <div class="col-4  d-flex justify-content-center">
                                <img src="images/mathi.JPG" id="photoWorker" />
                            </div>
                            <div class="col-8" id="statics">
                                <div>ID No &nbsp; &nbsp; :<span> <?= $customerObject->getCustomer_id() ?></span></div>
                                <div>Name &nbsp; &nbsp; :<span> <?= $customerObject->getFirstname() ?></span></div>
                                <div>Address &nbsp;:<span> <?= $customerObject->getAddress() ?></span></div>
                                <div><?= $hiringObject->getRegistered_dateTime(); ?></div>
                                <?php
                                $serviceID = $hiringObject->getService_id();
                                $serviceObj = new Service();
                                $serviceObj->read($serviceID);
                                ?>
                                <div><?= $serviceObj->getService_name(); ?></div>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                Hiring amount &nbsp;&nbsp; &nbsp;:<span> Rs <?= $hiringObject->getHiring_amount() ?>/=</span>
                            </div>
                            <div>Payment method :<span> <?= $hiringObject->getPayment_method() ?></span></div>
                        </div>
                        <div class="row">
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-2 col-lg-3 ">Rating :</div>
                                <div class="col-9 col-sm-9 col-md-10 col-lg-9 p-0 m-0" id="ratingStar">
                                    <span id="star" class="material-icons"> grade</span>
                                    <span id="star" class="material-icons"> grade</span>
                                    <span id="star" class="material-icons"> grade</span>
                                    <span id="star" class="material-icons"> grade</span>
                                    <span id="star" class="material-icons"> grade</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 col-sm-3 col-md-2 col-lg-3 ">Review :</div>
                                <?php
                                if ($row['review'] == NULL) {
                                    $review = "Not Given";
                                } elseif ($row['review'] != NULL) {
                                    $review = $row['review'];
                                }
                                ?>
                                <div class="col-9 col-sm-9 col-md-10 col-lg-9 p-0 m-0" id="reviewtext"><?= $review ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }

            ?>
        </div>


        <!-- ---------------------------------TOP SERVIES------------------------------------------- -->

        <p id="top-services " class="h1 fw-bold p-3">
            <span id="topServices" class="pe-5">TOP SERVICES</span>
        </p>

        <!-- ---------------------------------PLUMBER  BOX------------------------------------------- -->
        <div class="row d-flex justify-content-evenly">
            <?php
            require_once('classes.php');
            $sql = "SELECT * FROM service Order by average_rating DESC limit 4;";
            $result = QueryHandler::query($sql);
            while ($row = mysqli_fetch_array($result)) {
                $serviceObject = new Service();
                $serviceObject->read($row['service_id']);

            ?>

                <div id="box_service" class="col-md-5 mb-5">
                    <div id="box" class="row">
                        <div class="col text-center">
                            <img id="job_images" class="" src="<?= $serviceObject->getCover_photo() ?>" alt="" />
                        </div>
                        <div id="service_detail " class=" col
                            pt-3
                            d-flex
                            flex-column
                            align-items-xs-center align-items-md-center align-items-lg-start
                        ">
                            <div id="job" class="d-flex text-center fw-bold h5 mt-1">
                                <div id="box" class="pb-2"><?= $serviceObject->getProvider_name() ?></div>
                            </div>
                            <div class="fw-bolder"><?= $serviceObject->getTotal_hirings() ?> Total Order</div>
                            <div class="fw-bolder">
                                <p class="">
                                    Avg Rating <?= $serviceObject->getAverage_rating() ?>
                                    <span id="star" class="material-icons"> grade</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>


        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function() {
        // console.log('documemt ready');
        let tradesman_id = <?php echo $tradesman_id ?>;

       
        // function interval(tradesman_id = '') {
        //     console.log("interval start");
        //     $.ajax({

        //         url: "interval.php",
        //         method: "POST",
        //         data: {
        //             tradesman_id: tradesman_id
        //         },
        //         dataType: "json",
        //         success: function(data) {
        //             console.log('success interval');
        //             console.log(data);
        //         }
        //     });
        // }


       
       








     


        // $(document).on("click", "#done", function() {

        //     let del = $(this);


        //     let sheduleID = $(this).attr("data-id");
        //     // location.href = "http://localhost/quickfix/avines/chatTradesman.php?hiring_id=" + sheduleID;
        //     $.ajax({
        //         type: "get",
        //         data: {
        //             sheduleID: sheduleID
        //         },
        //         url: "done_ok.php",
        //         success: function(data) {
        //             load_unseen_notification();
        //             console.log("done clicked....");

        //         }
        //     });
        // });

        $(document).on("click", ".del", function() {
            console.log("previous button cicked.");
            let del = $(this);
            let current_month = $(this).attr("data-id");
            var name = <?php echo $tradesman_id ?>;
            $.ajax({
                type: "get",
                data: {
                    name: name,
                    current_month: current_month
                },
                url: "previous.php",
                success: function(data) {
                    console.log(data);
                    $("#CalendarContent").html(data);
                }
            });
        });

        $(document).on("click", ".del1", function() {
            // let del1 = $(this);
            let current_month = $(this).attr("data-id");
            var name = <?php echo $tradesman_id ?>;
            $.ajax({
                type: "get",
                data: {
                    name: name,
                    current_month: current_month
                },
                url: "next.php",
                success: function(data) {
                    console.log(data);
                    $("#CalendarContent").html(data);

                }
            });
        });

        <?php
        for ($x = 0; $x <= 31; $x++) {
        ?>
            $("#month_date<?php echo $x; ?>").click(function() {
                $("#modal_schedule_date_<?php echo $x; ?>").modal({
                    show: true
                });
            });
        <?php } ?>


    });
</script>