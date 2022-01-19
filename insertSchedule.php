
<?php
//insert.php
include 'classes.php';
$notification  = new Notification();
// $conn = (new Connection())->createConnection();
if (isset($_POST["date"])) {
    $customerID = $_POST["sender_id"] ;
    
    if (isset($_POST['radioAddress'])) {

        $address;
        $lat;
        $lng;
        if ($_POST['radioAddress'] == "Use default Address") {
            
            $result = QueryHandler::query("SELECT * from customer WHERE customer_id='$customerID'");
            $data = mysqli_fetch_assoc($result);
            $address = $data['address'];
            $lat = $data['latitude'];
            $lng = $data['longitude'];
        } else {
            $address = $_POST['address1'];
            $lat = $_POST['lat1'];
            $lng = $_POST['lng1'];
        }
        // $_SESSION['HirespecificLat'] = $lat;
        echo "insertHirenowpage";
        // echo $_SESSION['HirespecificLat'];
        // echo $address;
        // echo $lat;
        // echo $lng;
        // echo $_POST['radioAddress'];
        // echo $_POST['radio'];
    }
    echo $lat.$lng.$address;
    $date = QueryHandler::real_escape_string($_POST["date"]);
    $time = QueryHandler::real_escape_string( $_POST["time"]);
    $receiver_id = $_POST["receiver_id"];
    $sender_id = $_POST["sender_id"];
    $service_id = $_POST['radio'];
    $service = new Service();
    $service->read($service_id);
    $service_name = $service->getService_name();

    $notifi = "Scheduling request for  ".$service_name. " at " . $address;
    $notification->schedule($receiver_id, $sender_id, $date, $time,$notifi,$service_id , $lng , $lat);
}

echo  'insert schedule php file';
?>