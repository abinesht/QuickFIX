
<?php
// include("connect.php");
include 'classes.php';

$output = '';

if (isset($_POST["view"])) {
    $tradesman_id = $_POST["tradesman_id"];
    // $tradesman_id =2;
    if ($_POST["view"] != '') {
        $update_query = "UPDATE notification SET seen_status=1 WHERE seen_status=0  AND receiver_id = '$tradesman_id'; ";
        $result =  QueryHandler::query($update_query);
        if (!$result) {
            die('QUERY FAIL!');
        }
    }
    // $query = "SELECT * FROM notification WHERE receiver_id = '$tradesman_id'; ";
    $query = "SELECT * FROM notification WHERE receiver_id = '$tradesman_id' Order by notification_id DESC; ";
    $result = QueryHandler::query($query);
    

    if (!$result) {
        die('QUERY FAIL!');
    }

    if (mysqli_num_rows($result) > 0) {


        // <a href="test_get.php?subject=PHP&web=W3schools.com">Test $GET</a>
        //href = "chatTradesman.php?customer_id='.$commentID.'"
        // href = "sample_myHiring.php?customer_id=3"
        while ($row = mysqli_fetch_array($result)) {
            $notificationID = '';
            if ($row['notification_type'] == 'ok') {
                $notificationID = $row['notification_id'];
                $output .= '
                        <li>
                                <div class="bg-light p-1 row" >
                                    <div class="col"><strong>' . $row["notification"] . '</strong> </div>
                                    <div class="btn btn-success " id="ok" style="background-color:#142f61; color: white;"  data-id="' . $notificationID . '" >OK</div>
                                </div>
                        </li>
                        <li class="divider"></li>
                     ';
            } elseif ($row['notification_type'] == 'accept_decline') {
                $commentID = $row['notification_id'];
                $output .= '
              <li class="p-0">
                <div class="" >
                    <div class=" p-1"> ' . $row["notification"] . '<br /> Date : <strong>' . $row["date"] . '</strong><br /> Time : <small><em>' . $row["time"] . '</em></small></div>
                    <div class="d-flex">
                        <a  class="btn m-1" id="accept" style="background-color:#142f61; color: white;" data-id="' . $commentID . '" >Accept</a>
                        <a class="btn m-1" id="decline" style="background-color:#142f61; color: white;" data-id="' . $commentID . '">Decline</a>
                    </div>
                </div>
              </li>
              <li class="divider"></li>
              ';
            } elseif ($row['notification_type'] == 'common') {
                $commentID = $row['notification_id'];
                $output .= '
              <li class="p-0">
                <div class="" >
                    <div class=" p-1"> ' . $row["notification"] . '<br /> Date : <strong>' . $row["date"] . '</strong><br /> Time : <small><em>' . $row["time"] . '</em></small></div>
                    <div class="d-flex">
                        <a  class="btn m-1" id="schedule" style="background-color:#142f61; color: white;" data-id="' . $commentID . '" >Schedule</a>
                        <a class="btn m-1" id="decline" style="background-color:#142f61; color: white;" data-id="' . $commentID . '">Decline</a>
                    </div>
                </div>
              </li>
              <li class="divider"></li>
              ';
            } elseif ($row['notification_type'] == 'addnewservice') {
                $notificationID = $row['notification_id'];
                $service_id = $row['service_id'];
                $output .= '
                        <li>
                            <div class="bg-light p-1 row" >
                                <div class="col"><strong>' . $row["notification"] . '</strong> </div>
                               <a href="one_service_page.php?service_id='.$service_id.'"> <div  class="btn btn-success " id="view" style="background-color:#142f61; color: white;"  data-id=" ' . $notificationID . '" >view</div> </a>
                            </div>
                        </li>
                        <li class="divider"></li>
              ';
            } elseif ($row['notification_type'] == 'sheduleTimeCame') {
                $notificationID = $row['notification_id'];
                $hiring_id = $row['service_id'];
                $output .= '
                        <li>
                            <div class="bg-light p-1 row" >
                                <div class="col"><strong>' . $row["notification"] . '</strong> </div>
                               <a href="on_going_hiring.php?hiring_id='.$hiring_id.'"> <div  class="btn btn-success " id="view" style="background-color:#142f61; color: white;"  data-id=" ' . $notificationID . '" > On Going Hiring </div> </a>
                            </div>
                        </li>
                        <li class="divider"></li>
              ';
            } else {
                $notificationID = $row['notification_id'];
                $output .= '
                        <li>
                                <div class="bg-light p-1 row" >
                                    <div class="col"><strong>' . $row["notification"] . '</strong> </div>
                                    <div  class="btn btn-success " id="done" style="background-color:#142f61; color: white;"  data-id="' . $notificationID . '" >done</div>
                                </div>
                        </li>
                        <li class="divider"></li>
                     ';
            }
        }
    } else {
        $output .= '<li><div  class="text-bold text-italic">No Notification Found</div></li>';
    }

    
}

$data = array(
    'notification'   => $output
);
echo json_encode($data);
?>