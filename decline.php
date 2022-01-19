<?php
// include 'connect.php';
require_once('classes.php');
// $conn = (new Connection())->createConnection();



if (isset($_POST["sheduleID"])) {
    $sheduleID = QueryHandler::real_escape_string( $_POST["sheduleID"]);
}

$sql = "SELECT * FROM notification WHERE notification_id=$sheduleID;";
$result = QueryHandler::query( $sql);
$row = mysqli_fetch_array($result);
if (!$result) {
    die('QUERY FAIL in notifiacation table!');
}else{
    echo "This Hiring request of".$row['notification_id']."  declined<br> Date: ".$row['date']." <br>Time: ".$row['time']."<br> ";
}

$delete_sql = "DELETE FROM notification WHERE notification_id=$sheduleID;";
$result =QueryHandler::query( $delete_sql);
if (!$result) {
    die('QUERY FAIL in notifiacation table!');
}


