<?php
require_once 'classes.php';


$notifi  = new Notification();
if (isset($_POST["view"])) {

    $sheduleID = QueryHandler::real_escape_string($_POST["sheduleID"]);
    echo $sheduleID;
    $sql = "SELECT * FROM notification WHERE notification_id=$sheduleID;";
    $result = QueryHandler::query($sql);
    if (!$result) {
        die('QUERY FAIL in insertC.php!');
    }
    $row = mysqli_fetch_array($result);
    
        $sender_id = $row['receiver_id'];
        $receiver_id = $row['sender_id'];
        $service_id = $row['service_id'];
        $date = $row['date'];
        $time = $row['time'];
        $lng = $row['longitude'];
        $lat = $row['latitude'];
   
        echo $sender_id.$receiver_id.$service_id;
        $customer = Customer::getInstance($sender_id);
        $customer_name = $customer->getUsername();
   
    $notification_type='ok';
    $notification =$_POST["view"];
    // echo $notification_type;
    echo "befrore type"; 
    $type = $_POST["type"];
    echo "after type"; 
    // echo $type;
    if ($type == "go_ongoing_page") {
        $notification_type = "NULL";
        $notification = "Tradesman ".$customer_name."  accepted your hireNow Request";
    } elseif ($type == "ok") {
        $notification = "Tradesman ".$customer_name."   declined your hiring request";
    } elseif ($type == "common") {
        $notification = "Tradesman  ".$customer_name."   schduled  your hiring in calendar";
    
    } else{
        $notification = "Tradesman ".$customer_name."   declined your hiring request";

    }
    // // $receiver_id = 2;
    // // $sender_id = 1;
    // echo $notification_type;
    $notifi->create($notification, $receiver_id, $sender_id,$service_id , $notification_type,$time,$date , $lng ,$lat);
}else{
    echo "nothing";
}
