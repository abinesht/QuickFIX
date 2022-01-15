<?php
//       TRADESMAN PAGE
//  $trademsna id       =   1;     // tradesman ID    JB
//  $customer_id    =       2;     // customer ID     mathi
include 'header.php';
include 'calendar.php';
$tradesman_id = 1;

//echo "loop start<br>";
$tradesmanObj = new Tradesman();
$tradesmanObj->read($tradesman_id);
//echo $tradesmanObj->checkHiringTimeCome($tradesman_id);


?>
<html>

<style>
    <?php include 'Tradesman/Assets/Css/tradesman_home.css'?>
    <?php include 'Assets/Css/header.css'?>
    <?php include './Tradesman/Assets/Css/workerSignup.css'?>
</style>    

<body>
    <?php
    $month = date("Y-m-d");
    $calendar = new Calendar($month);
    $current_month = $calendar->getActive_month();
    $current_year = $calendar->getActive_year();
    ?>



    <!-- ---------------------------------COVER PHOTO ON TOP WITH GRADIENT------------------------------------------- -->
 
    <div class="cover">
        <div class="coverimg">
            <div class="coveroverlay">
                <div class="container">
                    <div class="covertxt">
                        <span class="weAreHere">
                            WE ARE HERE
                        </span><br>
                        <span class="toHelp">
                            TO HELP
                        </span><br>
                        <span class="you">
                            YOU
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="scheduledMessage" class="bg-warning"></div>
    <!-- ---------------------------------TOP SERVIES------------------------------------------- -->
    <div id="exceptCoverPhoto">
        <p id="top-services " class="h1 fw-bold p-3"><span id="topServices" class="pe-5">TOP SERVICES</span> </p>
        <div class="row d-flex justify-content-evenly">

            <!-- ---------------------------------PLUMBER  BOX------------------------------------------- -->
            <?php
            require_once('classes.php');
            $sql = "SELECT * FROM service Order by average_rating limit 4;";
            $result = QueryHandler::query($sql);
            while ($row = mysqli_fetch_array($result)) {


            ?>

                <div id="box_service" class="col-md-5 mb-5">
                    <div id="box" class="row ">

                        <div class="col text-center">
                            <img id="job_images" class="" src="Assets/Images/plumber.jpg" alt="" />
                        </div>
                        <div id="service_detail " class="  col pt-3 d-flex  flex-column  align-items-xs-center align-items-md-center align-items-lg-start">
                            <div id="job" class=" d-flex text-center fw-bold h5 mt-1">
                                <div id="box" class=" pb-2"><?php echo $row['service_name']; ?></div>
                            </div>
                            <div class="fw-bolder"><?php echo $row['total_hirings']; ?> Total Order</div>
                            <div class="fw-bolder">
                                <p class="">
                                    Avg Review <?php echo $row['average_rating']; ?>
                                    <span id="star" class="material-icons"> grade</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
 
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
    </div>
    <div id="getCount" class="bg-warning">

    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        // console.log('documemt ready');
        let tradesman_id = <?php echo $tradesman_id ?>;

        function getCount(view = '') {

            $.ajax({

                url: "countSchedule.php",
                method: "POST",
                data: {
                    view: tradesman_id
                },
                dataType: "json",
                success: function(data) {
                    console.log('success');
                    if (data.unseen_notification > 0) {
                        $('.count').html(data.unseen_notification);
                    }
                }
            });
        }

        function interval(tradesman_id = '') {
            console.log("interval start");
            $.ajax({

                url: "interval.php",
                method: "POST",
                data: {
                    tradesman_id: tradesman_id
                },
                dataType: "json",
                success: function(data) {
                    console.log('success interval');
                    console.log(data);
                }
            });
        }
        
        getCount();

        function insertNotification(type, sheduleID, view = '') {
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
                }
            });
        }

        setInterval(function() {
            getCount();


        }, 5000);



        function load_unseen_notification(view = '') {
            let tradesman_id = <?php echo $tradesman_id ?>;
            $.ajax({
                url: "fetchOK.php",
                method: "POST",
                data: {
                    tradesman_id: tradesman_id,
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    $('.dropdown-menu').html(data.notification);
                    getCount();
                    // console.log("load_unseen_notification success");
                }
            });
        }



        load_unseen_notification();

        $(document).on('click', '#drop-down', function() {
            console.log("drop down clicked....");
            $('.count').html('');
            load_unseen_notification('yes');
            console.log("dropdown success");
        });



        $(document).on("click", "#accept", function() {
            $("#hirehim_modalFinal").modal({
                show: true
            });
            let del = $(this);
            let sheduleID = $(this).attr("data-id");
            insertNotification("accept", sheduleID);
            let hiring_id;
            $.ajax({
                type: "get",
                data: {
                    sheduleID: sheduleID
                },
                url: "schedule.php",
                success: function(data) {
                    hiring_id = data;
                    location.href = "http://localhost/quickfix/avines/ongoing/chatTradesman.php?hiring_id=" + hiring_id;
                }
            });

        });
        $(document).on("click", "#schedule", function() {
            $("#hirehim_modalFinal").modal({
                show: true
            });
            let del = $(this);
            let sheduleID = $(this).attr("data-id");
            insertNotification("accept", sheduleID);
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
            let sheduleID = $(this).attr("data-id");
            insertNotification("decline", sheduleID);
            $.ajax({
                type: "post",
                data: {
                    sheduleID: sheduleID
                },
                url: "decline.php",
                success: function(data) {
                    console.log("schedule ID is : ");
                    console.log(sheduleID);

                    console.log("decline clicked....");

                }
            });
        });

        $(document).on("click", ".del", function() {
            let del = $(this);
            let current_month = $(this).attr("data-id");
            console.log("preious clic");
            var name = <?php echo $tradesman_id ?>;
            $.ajax({
                type: "get",
                data: {
                    name: name,
                    current_month: current_month
                },
                url: "previous.php",
                success: function(data) {
                    $("#CalendarContent").html(data);
                }
            });
        });

        $(document).on("click", ".del1", function() {
            let del1 = $(this);
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
                    $("#CalendarContent").html(data);
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

        $(document).on("click", "#done", function() {

            let del = $(this);


            let sheduleID = $(this).attr("data-id");
            // location.href = "http://localhost/quickfix/avines/chatTradesman.php?hiring_id=" + sheduleID;
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