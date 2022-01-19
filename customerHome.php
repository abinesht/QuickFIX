<?php
//       TRADESMAN PAGE
//  $trademsna id       =   1;     // tradesman ID    JB
//  $customer_id    =       2;     // customer ID     mathi

include 'header.php';
include 'calendar.php';
$customer_id = $user->getCustomer_id();
//$customerObj = new Customer();
//$customerObj->read($customer_id);

// echo $tradesmanObj->checkHiringTimeCome($tradesman_id);


?>
<html>
<style>
    <?php include 'Tradesman/Assets/Css/tradesman_home.css' ?><?php include 'Assets/Css/header.css' ?><?php include './Tradesman/Assets/Css/workerSignup.css' ?>
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
                            <img id="job_images" class="" src="Assets/Images/<?php echo $row['cover_photo']; ?>" alt="" />
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
                            $sql = "SELECT * from calendar where customer_id='$customer_id' ORDER BY date;";
                            $result = QueryHandler::query($sql);
                            if (!$result) {
                                die('QUERY FAIL!');
                            }
                            $count = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $tradesmanObj = Tradesman::getInstance($row['tradesman_id']);
                                // echo $row['customer_id'];
                                if (date('m', strtotime($row['date'])) == $current_month  && date('Y', strtotime($row['date'])) == $current_year) {
                                    $count = $count + 1;
                                    $calendar->add_event($tradesmanObj->getUsername(), $row['date'], 1, 'green', $row['time']);
                                    echo  '<li class="fw bold h5">' . date('M j ,', strtotime($row['date'])) . ' ' . date('g:i a', strtotime($row['time'])) . ' - ' . $tradesmanObj->getUsername() . ' - ' . $row['service_name'] . '</li>';
                                    $events = $calendar->getEvents();
                                    // echo '<script> console.log('.$events[0].'); </script>';
                                    // echo $events[0];

                                    for ($i = 1; $i <= 31; $i++) {
                            ?><div class="modal fade" id="modal_schedule_date_<?php echo $i; ?>" role="dialog">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <!-- Modal content-->
                                                <div class="modal-content p-3 text-center">
                                                    <div><?php echo $tradesmanObj->getUsername() . "<br>Date:" . $row['date'] . "    Time:" . $row['time']; ?></div>
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
<?php include 'footer.php' ?>
<script>
    $(document).ready(function() {
        $(document).on("click", ".del", function() {
            console.log("previous button cicked.");
            let del = $(this);
            let current_month = $(this).attr("data-id");
            var name = <?php echo $customer_id ?>;
            $.ajax({
                type: "get",
                data: {
                    name: name,
                    current_month: current_month
                },
                url: "previousC.php",
                success: function(data) {
                    console.log(data);
                    $("#CalendarContent").html(data);
                }
            });
        });

        $(document).on("click", ".del1", function() {
            // let del1 = $(this);
            let current_month = $(this).attr("data-id");
            var name = <?php echo $customer_id ?>;
            $.ajax({
                type: "get",
                data: {
                    name: name,
                    current_month: current_month
                },
                url: "nextC.php",
                success: function(data) {
                    console.log(data);
                    $("#CalendarContent").html(data);

                }
            });
        });
    });
</script>