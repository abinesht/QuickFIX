<?php
include 'header.php';

$tradesman_id = "2";   //only for first viva

?>


<!DOCTYPE html>
<html lang="en">

<head>
 
    <title>Tradesman Hirings</title>
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


    

    .myHiringsPage .box .details {
        font-weight: 600;
        margin-top: -8px;
        font-size: 15px;
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
    }



    .review_box {
        height: 200px;
        border: solid #142f61;
        border-radius: 15px;
    }

    .dropdownbtn {
        background-color: #142f61;
        font-weight: bold;
        border: none;
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
                        <?php showHirings("SELECT * FROM hiring WHERE tradesman_id = '$tradesman_id'") ?>
                    </div>
                    <div class="row containofboxes justify-content-center menu-tab-content tabcontent" id="completed">
                        <?php showHirings("SELECT * FROM hiring WHERE tradesman_id = '$tradesman_id' AND final_status = 'Completed'") ?>
                    </div>
                    <div class="row containofboxes justify-content-center menu-tab-content tabcontent" id="scheduled">
                        <?php showHirings("SELECT * FROM hiring WHERE tradesman_id = '$tradesman_id' AND final_status = 'Scheduled'") ?>
                    </div>
                    <div class="row containofboxes justify-content-center menu-tab-content tabcontent" id="cancelled">
                        <?php showHirings("SELECT * FROM hiring WHERE tradesman_id = '$tradesman_id' AND final_status = 'Cancelled'") ?>
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
           

            $customer_id = $hiring->getCustomer_id();
            $service_id = $hiring->getService_id();
            $dateTime = $hiring->getCompleted_cancelled_date();
            $hiring_amount = $hiring->getHiring_amount();
            $payment_method = $hiring->getPayment_method();
            $rating = $hiring->getRating();
            $review = $hiring->getReview();
            $final_status = $hiring->getFinal_status();
            $hiring_id = $hiring->getHiring_id();
            $time = $hiring->getTime();

            $service_name = $hiring->getService_name($service_id);
            
            $customer = new Customer();
            $customer->read($customer_id);
            $customer_name = $customer->getFirstname();
            $customer_address = $customer->getAddress();  //address may be changed
            $profile = $customer->getImg();


            



           
        ?>


            <div class="col-xxl-3 col-lg-4 col-md-5 col-sm-7 col-xs-8 col-9  box">
                <div class="row justify-content-between">
                    <div class="col-2">
                        <img id="" class="profile" src="Customer/Assets/custoimages/<?php echo $profile ?>" alt="profile">    

                    </div>
                    <div class="col-8 col-xs-8 col-sm-9 col-md-9">
                        <p class="details">
                            ID No    : <?php echo $hiring_id ?>
                            <br>
                            Name     : <?php echo $customer_name ?>
                            <br>
                            Address  : <?php echo $customer_address ?>
                            
                            <br>
                            <?php
                            $date = date_create($dateTime);
                            echo date_format($date, "Y M d"); 
                            echo " @";
                            echo $time;  ?>
                            <br>
                            <?php echo $service_name ?>
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
                                    Not given
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
                                    <span class=""> 
                                        Not Given
                                    </span>

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

    
    
    

    



    
<script>
    
        $("#abc12").addClass("active");
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


</body>

</html>

<?php
include "footer.php";
?>