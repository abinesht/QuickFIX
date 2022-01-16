
<?php
//insert.php
include 'classes.php';
$notification  = new Notification();
// $conn = (new Connection())->createConnection();
if (isset($_POST["date"])) {
    // echo '<script> console.log(sdvfverb); </script>';
    // include("connect.php");
    $date = QueryHandler::real_escape_string($_POST["date"]);
    $time = QueryHandler::real_escape_string( $_POST["time"]);
    $receiver_id = $_POST["receiver_id"];
    $sender_id = $_POST["sender_id"];

    // $service_id = $_POST["service_id"];
    $service_id = 2;
    $service = new Service();
    $service->read($service_id);
    $service_name = $service->getService_name();

    $notifi = "Scheduling request for  ".$service_name. " ";
    $notification->schedule($receiver_id, $sender_id, $date, $time,$notifi,$service_id);
}

echo  'insert schedule php file';
?>