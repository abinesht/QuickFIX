<?php
//insert.php
// session_start();
include 'classes.php';
$notification  = new Notification();
if (isset($_POST["lat"])) {
    echo "<script>alert('gdsgd')</script>";
    echo "<script>console.log('gdsgd')</script>";
    $customerID = $_POST["sender_id"] ;
 
    if (isset($_POST['radio'])) {
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
                $address = $_POST['address'];
                $lat = $_POST['lat'];
                $lng = $_POST['lng'];
            }
            $_SESSION['HirespecificLat'] = $lat;
            echo "insertHirenowpage";
            echo $_SESSION['HirespecificLat'];
            // echo $address;
            // echo $lat;
            // echo $lng;
            // echo $_POST['radioAddress'];
            // echo $_POST['radio'];
        }
    }
    $receiver_id = $_POST["receiver_id"] ;
    $sender_id = $_POST["sender_id"] ;
    // $receiver_id = 1;
    // $sender_id = 2;
    $service_id = $_POST['radio'];

    $service = new Service();
    $service->read($service_id);
    $service_name = $service->getService_name();

    $customer = Customer::getInstance($sender_id);
    $name_customer = $customer->getUsername();

    $notificationString = "Hire Now request <br> Service - : <strong>".$service_name." </strong><br> Customer : <strong>".$name_customer."</strong><br> From: ".$address;
    $notification->hireNow($notificationString, $receiver_id, $sender_id , "accept_decline" ,$service_id , $lat, $lng);
}else{
    echo "jgfjfhjdgfhfd";
}
?>