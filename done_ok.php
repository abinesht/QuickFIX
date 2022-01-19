<?php

include 'calendar.php';
require_once 'classes.php';
$sheduleID = $_GET['sheduleID'];
$notification = new Notification();
$notification->read($sheduleID);

$tradesman_id = $notification->getSender_id();
$customer_id = $notification->getReceiver_id();

$service_id = $notification->getService_id();
$time = $notification->getTime();
$date= $notification->getDate();

echo $tradesman_id.' '.$customer_id.' '.$sheduleID;
$hiring_id = $notification->getHiringIDOngoing( $tradesman_id,$customer_id,$service_id,$date,$time);

$notification->remove($sheduleID);

$data = $hiring_id;
echo json_encode($data);


?>

