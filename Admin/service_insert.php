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
echo $service_name;
echo $provider_name;

    $getNewServiceId =  "SELECT * FROM service where service_name='$service_name' AND provider_name='$provider_name';";
    $result_1 = QueryHandler::query($getNewServiceId);
    $row = mysqli_fetch_assoc($result_1);
    $newservice_id = $row['service_id'];
    echo "new service id is////";
    echo $newservice_id;
    $admin->sendNotificationALL($service_name , $newservice_id);

} else {
    echo "we in service_insert.php page";
}
    

