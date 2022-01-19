<?php 
// session_start();
include 'header.php';
// include 'classes.php';
?>

<?php
// $_SESSION["customer_id"] = 1;
$_SESSION["hiring_id"] = ($_GET['hiring_id']);

$hiring_id = $_SESSION["hiring_id"];
$hiring_id = str_replace('"', '', $hiring_id);
$customer_id = $_SESSION["customer_id"];

// $conn = (new Connection())->createConnection();

$row1 = mysqli_fetch_assoc(QueryHandler::query( "Select * from hiring WHERE hiring_id = '$hiring_id' AND customer_id = '$customer_id'"));
$hiringObj = new Hiring();
$hiringObj->read($hiring_id);

$chatlist = $hiringObj->getChatlist();
$service_id = $hiringObj->getService_id();
$tradesman_id = $hiringObj->getTradesman_id();
$current_status =  $hiringObj->getCurrent_status();

$row5 = mysqli_fetch_assoc(QueryHandler::query("Select * from service WHERE service_id = '$service_id'"));
$serviceObj = new Service();
$serviceObj->read($service_id);

$tradesmanObject = new Customer();
$tradesmanObject->read($tradesman_id);
$username = $tradesmanObject->getUsername();

$customerObj = new Tradesman();
$customerObj->read($tradesman_id);
$rating = $customerObj->getNum_of_ratings();

if (isset($_GET["button_paynow"])) {
  $status = $hiringObj->getCurrent_status();

  if ($status == "Payment added"){
  
    $hiringObj->setCurrent_status();
    $hiringObj->changeState();


    $current_status = $hiringObj->getCurrent_status();
  
    $sql = "UPDATE hiring SET current_status='$current_status' WHERE hiring_id= '$hiring_id'";
    QueryHandler::query($sql);
  }

}

if (isset($_GET["button_cancel"])) {
  $status = $hiringObj->getCurrent_status();
  if ($status == "On the way" || $status =="Reached"){
  
    $hiringObj->setCurrent_status();
    $hiringObj->cancelHiring();


    $current_status = $hiringObj->getCurrent_status();
    $final_Status = "Cancelled";
  
    $sql = "UPDATE hiring SET current_status='$current_status', final_status='$final_Status' WHERE hiring_id= '$hiring_id'";
    QueryHandler::query($sql);

    $receiver_id = $hiringObj->getTradesman_id();
    $sender_id = $hiringObj->getCustomer_id();
    $cusObj = new Customer();
    $cusObj->read($sender_id);
    $sender_name = $cusObj->getUsername();
    // $date = $hiringObj->getTime();
    // $time = $hiringObj->getDate();
    $notificationString = "Hiring cancelled by ".$sender_name." " ;
    $sql1 = "INSERT into notification (receiver_id, sender_id , notification, notification_type) values ('$receiver_id' , '$sender_id', '$notificationString','ok')  ";
    QueryHandler::query($sql1);

  }
}

?>

<html>

<head>
  
  <style>
    body {
      background-color: rgb(223, 217, 217);
    }

    #button_register {
      border-radius: 10px;
      background-color: #142f61;
    }

    #button_paynow {
      border-radius: 30px;
      background-color: #142f61;
      margin-bottom: 5px;
      min-width: 170px;
    }
    #button_cancel {
      margin-top: 5px;
      border-radius: 30px;
      background-color: red;
      min-width: 170px;
    }

    #rating_star {
      color: #df8918;
      position: relative;
      top: 0.4rem;
    }

    #drop_down {
      float: right;
    }

    #send_icon1,
    #more_vert {
      float: right;
    }

    #send_icon1,
    #more_vert {
      background-color: #142f61;
      color: white;
    }


    #tradesman_box {
      background-color: white;
    }

    #box1,
    #box2 {
      border-right: 0.2rem solid #142f61;
    }

    #heading_map {
      background-color: #142f61;
    }

    #fixed_map {
      height: 22rem;
      background-color: rgb(218, 236, 247);
    }

    #chat_box {
      background-color: rgb(218, 236, 247);
      height: 34.5rem;
      margin-left: 5rem;
      margin-right: 2rem;
    }

    #receive_msg {
      background-color: rgba(68, 198, 202, 0.945);
      border-radius: 2rem;
      padding: 0.25rem 1.5rem;
    }

    #send_msg {
      background-color: white;
      border-radius: 2rem;
      padding: 0.25rem 1.5rem;
    }

    #chat_bottom,
    #chat_top {
      background-color: white;
    }

    #image_chat {
      border-radius: 50%;
      width: 2rem;
      height: 2rem;
    }

    #image_detail {
      border-radius: 50%;
      width: 4rem;
      height: 4rem;
    }

    #username_tradesman,
    #profile_tradesman {
      display: grid;
      place-items: center;
    }

    #chat_boxx1 {
      overflow-x: hidden;
      overflow-y: auto;
    }

    @media (max-width: 988px) {
      #chat_box {
        margin-right: 12rem;
        margin-left: 12rem;
      }
    }

    @media (max-width: 768px) {
      #tradesman_box {
        text-align: center;
      }

      #chat_box {
        margin-right: 8rem;
        margin-left: 8rem;
      }

      #box1,
      #box2 {
        border-bottom: 0.2rem solid #142f61;
      }
    }

    @media (max-width: 600px) {

      #chat_box {
        margin-right: 3rem;
        margin-left: 3rem;
      }
    }

    @font-face {
      font-family: 'Lucida Fax';
      src: url(fonts/Lucida\ Fax\ Regular.ttf);
    }

    @font-face {
      font-family: 'proxima nova';
      src: url(fonts/Proxima\ Nova\ Regular.ttf);
    }

    .footer {
      background-color: #142f61;
      color: white;
    }

    .footer1234 {
      font-family: 'Lucida Fax', Arial, Helvetica, sans-serif;
      font-style: italic;
      font-weight: 600;
      font-size: calc(15px + 0.1vw);
    }

    .footer234 {
      padding-top: 25px;
    }

    .footer2 form input[type=submit] {
      background: #5c726a;
      border: none;
      padding: 3px 15px;
      border-radius: 10px;
      color: #fff;
      margin-top: 9px;
      margin-left: 6px;
      height: 32px;
      font-family: 'Lucida Fax', Arial, Helvetica, sans-serif;
      font-style: italic;
      font-weight: 600;
    }

    .footer2 form input[type=submit]:hover {
      background-color: #d1d4d3;
      color: black;

    }

    .footer2 form input[type=email] {
      width: 330px;
      height: 30px;
      border: none;
      border-radius: 3px;
      margin-top: 9px;
    }

    .footer3 span {
      margin-left: 5px;
      padding: 0;
    }

    .footer3 a {
      background: #d1d3d2;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      padding: 0px 1px;
      margin: 3.5px 0.5vw;
      font-size: 20px;
    }

    .footer3 a:hover {
      background-color: white;
    }

    .footer3 a i {
      color: #142f61;
      padding-left: 4.5px;
      padding-bottom: px;
    }

    .copyright {
      border-top-style: solid;
      border-color: white;
      border-width: 3.5px;
      font-size: calc(17px + 0.1vw);
      font-family: 'proxima nova', Arial, Helvetica, sans-serif;
      font-weight: lighter;
    }

    /* ----------------------------------------------------------------------------------------------------------- */

    @media (max-width: 1400px) {

      .footer2 form input[type=submit] {
        font-weight: 600;
      }

      .footer2 form input[type=email] {
        width: 310px;
      }
    }

    @media (max-width: 1200px) {

      .footer2 form input[type=email] {
        width: 300px;
      }
    }

    @media (max-width: 992px) {

      .footer1 {
        margin-bottom: -28px;
      }

      .footer34 {
        display: grid;
        justify-content: center;
      }

      .footer3 {
        margin-right: 150px;
      }

      .copyright {
        margin-top: -20px;
      }

    }

    @media (max-width: 768px) {

      .footer2 form input[type=email] {
        width: 360px;
      }

      .footer1 {
        display: grid;
        justify-content: center;
        margin-bottom: -22px;
      }

      .logo {
        margin-right: 12px;
        margin-top: -12px;
      }

      .footer34 {
        display: grid;
        justify-content: center;
      }

      .footer3 {
        margin-right: 20px;
        width: 250px;
      }

      .copyright {
        margin-top: -20px;
      }

      .footer3 a {
        width: calc(20px + 0.3vw);
        height: calc(20px + 0.3vw);
        padding: 0px 1px;
        margin: 3.5px 0.9vw;
        font-size: calc(13px + 0.3vw);
      }

      .footer3 a i {
        color: #142f61;
        padding-left: 4.5px;
        padding-bottom: px;
      }

      .footer2 form input[type=submit] {
        height: 34px;

      }

      .footer2 form input[type=email] {
        height: 32px;

      }
    }

    @media (max-width: 576px) {

      .footer1 {
        display: grid;
        justify-content: center;
        margin-bottom: -24px;
      }

      .logo {
        margin-right: 9px;
        margin-top: -14px;
      }

      .footer2 form input[type=submit] {
        width: 60%;
      }

      .footer2 form input[type=email] {
        width: 80%;
      }

      .footer3 {
        margin-right: 20px;
        width: 250x;
        margin-left: 4%;
      }

      .copyright {
        margin-top: -25px;
      }
    }

    @media (max-width: 300px) {
      .footer3 {
        margin-right: 02px;
        width: 250x;
        margin-left: 4%;
      }

      .copyright {
        margin-top: -15px;
      }
    }
  </style>
</head>

<body class="">

  <!-- To show the hiring status to the tradesman.  -->
  <div class="text-center my-3" id="hiring_status_box">
    <button type="submit" class="btn col-4 col-md-4 col-lg-3" id="button_register">
      <span class="text-white fw-bold"><?php echo $current_status; ?></span>
    </button>
  </div>

  <div class="row">
    <div class="col-12 col-lg-5 mb-4">
      <div id="chat_box" class="d-flex flex-column">
        <div id="chat_top" class="p-2">
          <div class="">
            <div>
              <img src="images/<?php echo $tradesmanObject->getImg(); ?>" class="" id="image_chat" />
              <span class="material-icons btn" id="more_vert" data-toggle="dropdown">more_vert</span>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Options</a>
              </div>
            </div>
          </div>
        </div>

        <div id="chat_boxx1">

          <!-- 
        customer receives text messages from the tradesman.
        customer can send text messages to the tradesman. 

           
        For a chatbox, we show messages in order of sent/received date. 
        If the message received from a tradesman(sender is treadesman), we align message to the left side.
        If the sender is a customer, we align to the right side. 
-->
          <?php
          $sql = "SELECT * from chat where hiring_id='$hiring_id';";
          $chats =QueryHandler::query( $sql);
          if (!$chats) {
            die('QUERY FAIL!');
          }
          while ($chat = mysqli_fetch_assoc($chats)) {
            $chatObj = new Chat($chat["message"], $chat["hiring_id"], $chat["date_time"], $chat["sender"], $chat["receiver"]);
            array_push($chatlist, $chatObj);
            // print_r($chatlist);


          }
          for ($i = 0; $i < count($chatlist); $i++) {
            $message =  $chatlist[$i]->getMessage();
            if ($chatlist[$i]->getSender() == $tradesman_id) {
              echo '
              <div class="row d-flex justify-content-between my-3 fw-bold">
                    <div class="col-8">
                            <div class="mx-2" id="receive_msg"><span>' . $message . ' </span></div>
                    </div>
                    <div class="col-4"></div>
              </div>
              ';
            } elseif ($chatlist[$i]->getSender() == $customer_id) {
              echo '
               <div class="row d-flex justify-content-between my-3 fw-bold">
                      <div class="col-4"></div>
                      <div class="col-8">
                              <div class="mx-2" id="send_msg"><span>' . $message . '</span></div>
                      </div>
               </div>
        
        ';
            }
          }

          ?>
          <!-- CHAT BOTTOM SEND ICON -->
        </div>
        <div id="chat_bottom" class="mt-auto p-2">
          <div class="row" class="input-group">
            <form id="frm1" method="GET" class="row  p-0 m-0">
              <div class="col m-0">
                <input id="msg" name="msg" type="text" class="form-control" placeholder="Type a message......">
              </div>
              <div class="col-1">
                <button class="material-icons btn " id="send_icon1" name="send" type="button"> send </button>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php


    ?>
    <!-- TRADESMAN DETAIL BOX -->
    <div class="col-12 col-lg-6">
      <div id="tradesman_box" class="row mb-4 fw-bold">
        <div id="box1" class="row col-12 col-md-6 col-lg-4 m-1 d-md-flex my-3">
          <div id="profile_tradesman" class="col-12 col-md-3 col-lg-12">
            <img src="images/jb.jpg" class="" id="image_detail" />
          </div>
          <div id="username_tradesman" class="ps-2 col-12 col-md-9 col-lg-12 ">@<?php echo $username; ?></div>
        </div>
        <div id="box2" class="col-12 col-md-5 col-lg-3 m-1 ps-4 my-3">
          <div id="detail">
            <div> <?php echo $tradesmanObject->getFirstname(); ?> </div>
            <div><?php echo  $serviceObj->getProvider_name(); ?></div>
            <div> <?php echo $tradesmanObject->getPhone_no(); ?> </div>
            <div>
              <?php echo $customerObj->getNum_of_ratings(); ?> <span id="rating_star" class="material-icons"> grade</span>
            </div>
          </div>
        </div>


        <?php
          if ($current_status == "On the way" || $current_status == "Reached"){
            ?>
            <div id="box3" class="col-12 col-md-11 col-lg-4 m-1 text-center p-2 my-3">
            
            <form method="GET" action="chatCustomer.php?" enctype="multipart/form-data" >
            
              <input type="hidden" name="hiring_id" id="hiring_id" value="<?php echo $hiring_id?>">


              <button type="" class="btn px-5" id="button_cancel" name="button_cancel">
                <span class="text-white fw-bold">Cancel</span>
              </button>
            </form>
            </div>
            <?php
          }
          else if($current_status == "On work" ){
            ?>
            <div id="box3" class="col-12 col-md-11 col-lg-4 m-1 text-center p-2 my-3">
              
            </div>
            <?php
          }
          else if($current_status == "Payment added" ){
            ?>
            <div id="box3" class="col-12 col-md-11 col-lg-4 m-1 pl-0  my-3">
              <div class="pb-2 ">
                Service Amount: <span id="pay_amount">Rs <?php echo $hiringObj->getHiring_amount() + 50; ?>.00</span>
              </div>
              <form method="GET" action="chatCustomer.php?" enctype="multipart/form-data" >
            
                <input type="hidden" name="hiring_id" id="hiring_id" value="<?php echo $hiring_id?>">
                <div class="pl-2">
                  <div class="fw-bold h5" id="payment_method">
                      Select payment method
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked value="direct">
                      <label class="form-check-label" for="flexRadioDefault2">
                          Direct cash payment
                      </label>
                  </div>
                  <div class="form-check">
                      <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="online">
                      <label class="form-check-label" for="flexRadioDefault1">
                          Online payment
                      </label>
                  </div>
                  
                  <div class="text-center mt-1">
                    <button type="paynow" class="btn px-5 " id="button_paynow" name="button_paynow">
                      <span class="text-white fw-bold">Pay Now</span>
                    </button>
                  </div>
                </div>
              </form>
              
            </div>
            <?php
          }
          else if($current_status == "Paid" ){
            ?>
            <div id="box3" class="col-12 col-md-11 col-lg-4 m-1 text-center p-2 my-3">
              <div class="pb-2">
              Service Amount: <span id="pay_amount">Rs <?php echo $hiringObj->getHiring_amount() + 50; ?>.00</span>
              </div>
              
            </div>
            <?php
          }
          else if($current_status == "Completed" ){
            ?>
            <div id="box3" class="col-12 col-md-11 col-lg-4 m-1 text-center p-2 my-3">
              <div class="pb-2">
              Service Amount: <span id="pay_amount">Rs <?php echo $hiringObj->getHiring_amount() + 50; ?>.00</span>
              </div>
              
            </div>
            <?php
          }
          ?>
        
          

        
      </div>

      <!-- LOCATION  -->
      <div id="tradesman_map" class="row my-2">
        <div id="heading_map" class="text-white fw-bold py-2">
          Live Location
        </div>
        <div id="fixed_map">
          <div style="width: 100%; height: 100%;" id="map"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- FOOTER CODE -->
  <div class="footer">
    <div class="container">
      <div class="row pt-4">

        <!-- --------------------footer1 -------------------------------------->
        <div class="col-lg-2 col-md-4 text-center footer1 footer1234">
          <div class="row">
            <div class="col logo">
              <img src="images/logo_footer.png" alt="QuickFIX" width="130">
            </div>
            <div class="col mt-2 mb-3">
              <span>
                Your Needs <br>
                Our Priorities
              </span>
            </div>
          </div>
        </div>

        <!------------------------------ footer2 --------------------------------->
        <div class="col text-center footer234 footer2 footer1234">
          <span>
            Join the conversation, Subscribe to receive
            <br>
            emails for events, updates and offers.
          </span>
          <form action="" class="">

            <input type="email" id="subscribe" name="subscribe">

            <input type="submit" class="" value="SUBSCRIBE">

          </form>

        </div>

        <!------------------------- footer 3&4 ----------------------------------------->
        <div class="col-lg-4 footer234 footer34 footer1234">
          <div class="row" style="min-height: 100px;">
            <div class="col footer3 pb">
              <div class="row">
                <span>Follow us</span>
              </div>

              <div class="row">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>

              </div>
            </div>

            <div class="col footer34 footer4">
              <span>Call us
                <br>
                0212223456</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <span class="text-center mb-2 copyright pt-1">
          Copyright &copy;2021 QuickFIX. All rights reserved
        </span>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(function() {
     
        function load_unseen_notification(view = '') {
        let tradesman_id = <?php echo $customer_id ?>;
        console.log(tradesman_id);
        $.ajax({
          url: "../fetchOK.php",
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

      function insertNotificationn(type, sheduleID, view = '') {
        console.log("insert start");

        $.ajax({
          url: "insertCancelation.php",
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
      $(document).on("click", "#button_cancel", function() {
        let hiring_id = $(this).attr("data-id");
        console.log("camcel ntm clicksd");
        insertNotificationn('cancel', hiring_id);
      });
      $("#send_icon1").click(function() {
        $.ajax({
          url: 'chatC1.php',
          type: 'GET',
          data: $("#frm1").serialize(),
          success: function(data) {
            // $("#chat_boxx1").html(data);
            $("#chat_boxx1").append(data);
            // $("").html(data).appendTo("#chat_boxx1");
            $("#frm1")[0].reset();
          }
        });
      });
    });

    let map;

    function initMap() {
      map = new google.maps.Map(document.getElementById("map"), {
        center: {
          lat: 6.9,
          lng: 79.8
        },
        zoom: 8,
      });
    }
    
  </script>
  <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2psniVzC9cwc5r1b6xt3ggfhFUt0DvsA&callback=initMap"> </script>
</body>

</html>