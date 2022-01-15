<?php
// $conn = mysqli_connect("localhost", "root", "", "quickfix_database", "3310");
// require_once('connect.php');
require_once('calendar.php');
require_once('classes.php');
$customer_id = $_GET['name'];
$concat = $_GET['current_month'];
$current_month = substr($concat, 4);
$current_month =  intval($current_month);
$current_year = substr($concat, 0, 4);
$current_year = intval($current_year);
// echo "I try to print: ".$concat." month: ".$current_month." year: ".$current_year."  **** ";
$month = date($current_year . "-" . $current_month . "-05");

$calendar = new Calendar($month);

if ($current_month == 01) {
    $current_year = $current_year - 1;
    $calendar->setActive_year($current_year);
}
if ($current_month == 01) {
    $current_month = 13;
}
$current_month = $current_month - 1;
$calendar->setActive_month($current_month);
$htmlContent = "";
?>

<div class="col-md-12 col-lg-6 mb-5" id="schedule_list">
    <div class="fw-bold me-5" id="schedule_list_box">
        <p id="scheuledList" class="h3 fw-bold">
            Your scheduled  hirings of tradesmen for this month
        </p>
        <div id="alertBox" class="alert alert-dark" role="alert">
            You Have No Schedule For This Month!!!!
        </div>
        <ul>
            <?php
            $sql = "SELECT * from calendar where customer_id='$customer_id';";
            $result = QueryHandler::query($sql);
            if (!$result) {
                die('QUERY FAIL!');
            }
            $count1 = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                // $customerObject = new Customer($row['customer_id']);
                $tradesmanObject = new Tradesman();
                $tradesmanObject->read($row['tradesman_id']);
                if (date('m', strtotime($row['date'])) == $current_month  && date('Y', strtotime($row['date'])) == $current_year) {
                    $count1 = $count1 + 1;

                    $calendar->add_event($tradesmanObject->getUsername(), $row['date'], 1, 'green', $row['time']);
                    echo  '<li class="fw bold h5">' . date('M j ,', strtotime($row['date'])) . ' ' . date('g:i a', strtotime($row['time'])) . ' - ' . $tradesmanObject->getUsername() . ' - ' . $row['service_name'] . '</li>';
                }
            }
            if ($count1 == 0) {
                echo '<script>document.getElementById("alertBox").style.display="block"; </script>';
                echo '<script>document.getElementById("scheuledList").style.display="none"; </script>';
            } else {
                echo '<script>document.getElementById("alertBox").style.display="none";</script>';
                echo '<script>document.getElementById("scheuledList").style.display="block";</script>';
            }
            ?>

        </ul>
    </div>
</div>

<div class="col-md-12 col-lg-6" id="calendar_box">
    <?php echo $calendar ?>
</div>