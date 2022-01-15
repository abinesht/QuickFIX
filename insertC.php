<?php
require_once 'classes.php';


$notifi  = new Notification();

if (isset($_POST["view"])) {

    $sheduleID = QueryHandler::real_escape_string($_POST["sheduleID"]);

    $sql = "SELECT * FROM notification WHERE notification_id=$sheduleID;";
    $result = QueryHandler::query($sql);
    $row = mysqli_fetch_array($result);
    
        $sender_id = $row['receiver_id'];
        $receiver_id = $row['sender_id'];
        $service_id = $row['service_id'];
   

    $notification = QueryHandler::real_escape_string($_POST["view"]);
    $type = $_POST["type"];
    if ($type == "accept") {
        $notification = "Tradesman  accepted your hireNow Request";
    } elseif ($type == "decline") {
        $notification = "Tradesman declined your hireNow Request";
    } else {
        $notification = "Type not matched...";
    }
    // $receiver_id = 2;
    // $sender_id = 1;

    $notifi->create($notification, $receiver_id, $sender_id,$service_id);
}
