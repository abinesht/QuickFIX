<?php
require_once 'classes.php';
if (isset($_POST["tradesman_id"])) {
    $tradesman_id = $_POST['tradesman_id'];
    $sql = "select * from calendar where tradesman_id = '$tradesman_id' ";
    $result = QueryHandler::query($sql);
    if (!$result) {
        die('QUERY FAIL when in gerRecentSchedlue.php!');
    } else {
        $today = date("Y-m-d");
        $now = date("H:i:s");
        echo "time is : " . $now;
        while ($row = mysqli_fetch_array($result)) {
            if (($today == $row['date']) && ($row['isNotify'] != 1)) {
                // echo "day matched";

                $startTime = $row['time'];
                $hiring_id = $row['hiring_id'];
                $startTime = date("H:i:s", strtotime($startTime));
               
                echo $startTime;
                $now = strtotime($now);
                $scheduleTime = strtotime($startTime);
                $minutes = ($scheduleTime - $now) / 60;


                echo "time difference is == " . $minutes;
                if (($minutes < 60)) {
                    $sql1 = "UPDATE calendar SET isNotify = '1' WHERE hiring_id = '$hiring_id'; ";
                    $result1 = QueryHandler::query($sql1);
                    $notificationString = "Your scheduling time is reached for hiring";
                    $query = " INSERT INTO notification(notification, receiver_id,sender_id ,notification_type, service_id ) 
                                            VALUES ('$notificationString', '$tradesman_id',0 , 'sheduleTimeCame', '$hiring_id')";
                    $result2 = QueryHandler::query($query);
                }
                // if($endTime - $now > 60){

                // }
            }
        }
    }
    echo "inser";
    // echo $tradesman_id;

} else {
    echo "nothing";
}
