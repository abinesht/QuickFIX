<?php

include 'classes.php';
// $conn = (new Connection())->createConnection();

session_start();

$hiring_id = $_SESSION["hiring_id"];
$customer_id = $_SESSION["customer_id"];
$hiring_id = str_replace('"', '', $hiring_id);

$row1 = mysqli_fetch_assoc(QueryHandler::query("Select * from hiring WHERE hiring_id = '$hiring_id'"));
$hiringObj = new Hiring();
$hiringObj->read($hiring_id);

$tradesman_id = $hiringObj->getTradesman_id();
$customer_id = $hiringObj->getCustomer_id();

if (isset($_GET['msg'])) {
  $msg = $_GET["msg"];
  QueryHandler::query("insert into chat (message,sender,receiver,hiring_id) VALUES ('$msg','$customer_id','$tradesman_id','$hiring_id');");
//   $id = mysqli_insert_id($conn);
?>
  <div class="row  d-flex justify-content-between my-3 fw-bold">
    <div class="col-4"></div>
    <div class="col-8">
      <div class="mx-2" id="send_msg"><span><?php echo $msg; ?></span></div>
    </div>
  </div>
<?php
} else {
  echo "NO POSTGET['submit'] created yet!!";
}
?>