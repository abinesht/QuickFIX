
<?php
//insert.php
include 'classes.php';
$notification  = new Notification();
// $conn = (new Connection())->createConnection();
if (isset($_POST["sender_id"])) {

    $customerID = $_POST["sender_id"];

   


        $latitude =  $_POST['lat'];
        $longitude =  $_POST['lng'];
        $address = $_POST['address'];
        $date = $_POST['date'];
        $time = $_POST['time'];




        // echo $_SESSION['HirespecificLat'];
        // echo $address;
        // echo $lat;
        // echo $lng;
        // echo $_POST['radioAddress'];
        // echo $_POST['radio'];
   
    // $date = QueryHandler::real_escape_string($_POST["date"]);
    // $time = QueryHandler::real_escape_string($_POST["time"]);
    $receiver_id = $_POST["tradesman_id"];
    $sender_id = $_POST["sender_id"];
    $service_id = $_POST['service_id'];
    $service = new Service();
    $service->read($service_id);
    $service_name = $service->getService_name();


    $notifi = "Scheduling request for  " . $service_name . " at " . $address;
    echo $receiver_id.$notifi.$sender_id.$latitude.$longitude.$address;

    $notification->schedule($receiver_id, $sender_id, $date, $time, $notifi, $service_id, $longitude, $latitude);
}

echo  'insert schedule php file';
?>