
<?php
include 'classes.php';
$output = '';
// $_POST["view"] = customerID =    2     - usermerge.php
if(isset($_POST["view"]))
{

$notification = new Notification();
//tradesman_id = 2 = view
$count  = $notification->countSchedule($_POST["view"]);

 $data = array(
     'notification'   => $output,
     'unseen_notification' => $count
 );
 echo json_encode($data);
}else{
    $data = array(
        'notification'   => $output,
        'unseen_notification' => 55
    );
    echo json_encode($data);
}
?>

