<?php

include 'classes.php';
$notification  = new Notification();



if (isset($_POST['radioAddress'])) {
    $address;
    $lat;
    $lng;
    $customer_id = $_POST['customer_id'];
    $service_id = $_POST['service_id'];
    if ($_POST['radioAddress'] == "Use default Address") {
        $result = QueryHandler::query("SELECT * from customer WHERE customer_id='$customer_id'");
        $data = mysqli_fetch_assoc($result);
        $address = $data['address'];
        $lat = $data['latitude'];
        $lng = $data['longitude'];
    } else {
        $address = $_POST['address'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
    }

    $customerObj = new Customer();
    $customerObj->read($customer_id);
    $_SESSION['lat_hire_any_now'] = $lat;
    $_SESSION['lng_hire_any_now'] = $lng;
    $_SESSION['address_hire_any_now'] = $address;
    $distanceArrNow = $customerObj->findNearTradesmanHireNow($lat, $lng, $service_id);
    $c = count($distanceArrNow);
    if ($c > 0) {
        $suggest_count = 0;
        foreach ($distanceArrNow as $tradesman_id_hire_Now => $distanceNow) {
            if ($suggest_count < 1) {
                $suggest_count++;
                $_SESSION['tradesman_id_for_hire_now'] = $tradesman_id_hire_Now;
            }
        }
    }else{
        echo "<script>alert('There are no tradesman online now try again later')</script>";
    }
    // echo "<script> count_check($c); </script>";
    $latitude = $_SESSION['lat_hire_any_now'];
    $longitude = $_SESSION['lng_hire_any_now'] ;
    $address = $_SESSION['address_hire_any_now'] ;
    $tradesman_id = $_SESSION['tradesman_id_for_hire_now'];
    echo $longitude.$address.$latitude;



    $receiver_id = $tradesman_id;
    $sender_id = $customer_id;

    $service = new Service();
    $service->read($service_id);
    $service_name = $service->getService_name();

    $customer = new Customer();
    $customer->read($customer_id);
    $name_customer = $customer->getUsername();

    $notificationString = "Hire Now request <br> Service - : <strong>".$service_name." </strong><br> Customer : <strong>".$name_customer."</strong><br> From: ".$address;
    $notification->hireNow($notificationString, $receiver_id, $sender_id , "accept_decline" ,$service_id , $latitude, $longitude);



} else {
    echo "aibswulefglwfe";
}
