<?php
include 'classes.php';
// $conn = (new Connection())->createConnection();
session_start();

$hiring_id = $_SESSION["hiring_id"];
$tradesman_id = $_SESSION["customer_id"];
$hiring_id = str_replace('"', '', $hiring_id);

$row1 = mysqli_fetch_assoc(QueryHandler::query( "Select * from hiring WHERE hiring_id = '$hiring_id' AND tradesman_id = '$tradesman_id'"));
$hiringObj = new Hiring();
$hiringObj->read($hiring_id);
$customer_id = $hiringObj->getCustomer_id();


$result3 = QueryHandler::query( "Select firstname from customer WHERE customer_id = '$tradesman_id'");
$row3 = mysqli_fetch_assoc($result3);
$tradesman = $row3['firstname'];

$result = QueryHandler::query( "Select firstname from customer WHERE customer_id = '$customer_id'");
$row = mysqli_fetch_assoc($result);
$customer = $row['firstname'];

if (isset($_GET['msg'])) {
  $msg = $_GET["msg"];
  QueryHandler::query( "insert into chat (message,sender,receiver,hiring_id) VALUES ('$msg','$tradesman_id','$customer_id','$hiring_id');");
//   $id = mysqli_insert_id($conn);
?>
  <div class="row  d-flex justify-content-between my-3 fw-bold">
    <div class="col-4"></div>
    <div class="col-8">
      <div class="mx-2" id="send_msg"><span><?php echo $msg; ?></span></div>
    </div>
  </div>


<?php
}
if (isset($_GET['money'])) {
  
  $hiringObj->setCurrent_status();
  $hiringObj->changeState();
  $hiringObj->changeState();
  $hiringObj->changeState();


  $current_status = $hiringObj->getCurrent_status();
  
  $sql = "UPDATE hiring SET current_status='$current_status' WHERE hiring_id= '$hiring_id'";
  QueryHandler::query( $sql);





  $money = $_GET["money"];
  $sql = "insert into chat (hiring_id) VALUES ('$money');";
  QueryHandler::query( $sql);
//   $id = mysqli_insert_id($conn);

  $sql = "UPDATE hiring SET hiring_amount='$money' WHERE hiring_id= '$hiring_id'";
  QueryHandler::query( $sql);
?>
  <form id="payment" method="GET" class="">
    <div class="d-flex justify-content-center flex-lg-column">
      <div class="pe-2">
        Service Amount : <span id="pay_amount"></span>
      </div>
      <div>
        Rs <?php echo $money; ?>.00
      </div>
    </div>
    <!-- <button type="button" class="btn px-5 mt-1" id="button_change">
      <span class="text-white fw-bold disabled">Registered</span>
    </button> -->
  </form>

<?php


}
