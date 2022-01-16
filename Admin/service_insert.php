<?php
//insert.php
include '../classes.php';
// $conn = (new Connection())->createConnection();

$notification  = new Notification();
$admin = new Admin();
if (isset($_POST['service_name'])) {

    $service_name = $_POST['service_name'];
    $provider_name = $_POST['provider_name'];
    //$cover_photo = $_POST['cover_photo'];
    $add_item_query = "INSERT INTO `service` (`service_name`, `provider_name`) VALUES ('$service_name','$provider_name')";
    QueryHandler::query( $add_item_query);
    $admin->sendNotificationALL($service_name);
} else {
    echo "we in service_insert.php page";
}
    

