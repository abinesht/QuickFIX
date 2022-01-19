<?php
require_once('classes.php');
// $conn = (new Connection())->createConnection();

if(isset($_POST['text'])){
    $sql_students = "SELECT username, average_rating FROM tradesman  WHERE username LIKE '%{$_POST['text']}%' LIMIT 5";
}
echo "<div>";
$result_students = QueryHandler::query($sql_students);
$total_students = mysqli_num_rows($result_students);
// $output='';
if($total_students > 0){
    $i=0;
    echo "<div class='text-white d-flex m-0 p-0'> TRADESMAN </div> ";
    while($row_students = mysqli_fetch_assoc($result_students)){
        // echo $row_students['username']."^".$row_students['average_rating']."&";
        $username= $row_students['username'];
        $sql_students = "SELECT  * FROM tradesman  WHERE username='$username' limit 1";
        $result_students1 = QueryHandler::query($sql_students);
        $row_students1 = mysqli_fetch_assoc($result_students1);
        $tradesman_id = $row_students1['tradesman_id'];

        echo "<a href='user_merge.php?tradesman_id=".$tradesman_id."' style='text-decoration:none;'>
                <li class='text-white d-flex  ps-3'>
                     ".$row_students['username']." 
                      ".$row_students['average_rating']." 
                      <span id='star' class='material-icons' style='color: orange;' > grade</span>
                </li>
            </a>";
    }
   
}


if(isset($_POST['text'])){
    $sql_students = "SELECT provider_name, average_rating FROM service  WHERE provider_name LIKE '%{$_POST['text']}%' LIMIT 5";
}

$result_students = QueryHandler::query($sql_students);
$total_service = mysqli_num_rows($result_students);
// $output='';
if($total_service > 0){
    $i=0;
    echo "<div class='text-white d-flex m-0 p-0'> SERVICES </div> ";
    while($row_students = mysqli_fetch_assoc($result_students)){
        // echo $row_students['username']."^".$row_students['average_rating']."&";
        $provider_name= $row_students['provider_name'];
        $sql_students = "SELECT  * FROM service  WHERE provider_name='$provider_name' limit 1";
        $result_students1 = QueryHandler::query($sql_students);
        $row_students1 = mysqli_fetch_assoc($result_students1);
        $service_id = $row_students1['service_id'];

        echo "<a href='one_service_page.php?service_id=".$service_id."' style='text-decoration:none;'>
                <li class='text-white d-flex m-0 ps-3'>
                     ".$row_students['provider_name']." 
                      ".$row_students['average_rating']." 
                      <span id='star' class='material-icons' style='color: orange;' > grade</span>
                </li>
            </a>";
    }
}

echo "</div>";
if(($total_service<=0) && ($total_students<=0)){
    echo "No Results Found";
}

?>