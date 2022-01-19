<?php

// include 'classes.php';
require_once 'classes.php';
require_once 'calendar.php';

// $conn = (new Connection())->createConnection();

$calendar_date = date("Y-m-d");
$calendar = new Calendar($calendar_date);
$notification = new Notification();

$sheduleID = $_GET['sheduleID'];
$sql = "SELECT * from notification where notification_id=$sheduleID;";
$result = QueryHandler::query($sql);
if (!$result) {
    die('QUERY FAILLLL!');
}
$row = mysqli_fetch_assoc($result);

    $date = $row['date'];
    $time = $row['time'];
    $tradesman_id = $row['receiver_id'];
    $customer_id = $row['sender_id'];
    // $service_id = $row[''];
    $service_id = $row['service_id'];
    $service = new Service();
    $service->read($service_id);
    $service_name = $service->getService_name();
    // $notification->createHiring($sheduleID);
    echo $date.' '.$time.' '.$tradesman_id.' '.$customer_id.' '.$service_id;

    // $notification_id, $date, $time, $tradesman_id, $customer_id, $service_id)

$lng = $row['longitude'];
$lat = $row['latitude'];
    $hiring_id = $notification->createHiring($date,$time, $tradesman_id,$customer_id,$service_id, "Scheduled" , $lng , $lat, "On the way");
    // echo $sheduleID . '  ' . $date . '  ' . $time . '<br>';
    $canSchedule = $calendar->checkShedule($tradesman_id, $time, $date );
    // $tradesman_id = 1;
    if ($canSchedule) {
        echo "Hiring was successfully scheduled <br>This Hiring request is scheduled in your calendar<br>Check it!!! ";
        echo $service_name;
        $query = "INSERT INTO calendar(tradesman_id,date, time,customer_id,service_name)VALUES ('$tradesman_id','$date', '$time','$customer_id', '$service_name')";
        $result = QueryHandler::query($query);
        if (!$result) {
            die('QUERY FAILLLL!');
        }
    } else {
        echo "You have been scheduled for hiring at the same time already <br> The notification has been sent to the customer.";
        // echo '<script> alert("You have another work at this time. You can not schedule this hiring request!!");<script>';
    }



$notification->remove($sheduleID);

$data = $hiring_id;
echo json_encode($data);