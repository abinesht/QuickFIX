<?php
include "connection.php";
class Admin
{
    private $customers = array();
    private static $instance = null;

    private function __construct()
    {
        // $this->customers = array();
        $query = "SELECT * FROM customer";
        $result = QueryHandler::query($query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $customer = new Customer();
                $customer->read($row['customer_id']);
                array_push(($this->customers), ($customer));
            }
        }
    }
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Admin();
        }

        return self::$instance;
    }
    public function attach(Customer $customer_object)
    {
        array_push($customers, $customer_object);
        // array_push($customers, $customerNewDetails);
    }

    public function detach(Customer $customerNewDetails)
    {
        // $this->customers->detach($customerNewDetails);
    }

    public function notify($service_name, $newservice_id)
    {
        foreach ($this->customers as $customer) {
            $customer->AddNewServiceNotification($service_name, ($customer->getCustomer_id()), $newservice_id);
            // $customer->sendOffer($this);
        }
    }

    public function sendNotificationALL($service_name, $newservice_id)
    {
        $this->notify($service_name, $newservice_id);
    }

    // public function addNewService($customer_id, $notificationString, $notificationType)
    // {
    //     $conn = (new Connection())->createConnection();
    //     $query = " INSERT INTO notification(notification, receiver_id,sender_id ,notification_type ) VALUES ('$notificationString', '$customer_id',0 , '$notificationType')";
    //     mysqli_query($conn, $query);
    // }
}

class Customer
{
    private $customer_id;
    private $username;
    private $firstname;
    private $lastname;
    private $email;
    private $phone_no;
    private $address;
    private $latitude;
    private $longitude;
    private $password;
    private $is_worker;
    private $img;
    private $total_hirings_count;
    private $total_payment;
    private $registered_date;
    private $tmp_image;
    private $customers;

    public function __construct()
    {
    }

    public function AddNewServiceNotification($service_name, $customer_id, $newservice_id)
    {
        // $conn = (new Connection())->createConnection();

        $notificationString = "Admin add new service : " . $service_name;
        $query = " INSERT INTO notification(notification, receiver_id,sender_id ,notification_type, service_id ) VALUES ('$notificationString', '$customer_id',0 , 'addnewservice', '$newservice_id')";
        QueryHandler::query($query);
    }

    public static function getInstance($customer_id)
    {
        if (!array_key_exists($customer_id, self::$customers)) {
            $sql = "SELECT `customer_id` FROM `Customer` WHERE customer_id = $customer_id";
            if (QueryHandler::query($sql)->num_rows == 0) {
                return null;
            } else {
                self::$customers[$customer_id] = new Customer();
                self::$customers[$customer_id]->read($customer_id);
            }
        }
        return self::$customers[$customer_id];
    }


    //read from database
    public function read($customer_id)
    {
        //$conn = (new Connection())->createConnection();
        $result = QueryHandler::query("SELECT * from customer WHERE customer_id='$customer_id'");
        $data = mysqli_fetch_assoc($result);
        $this->customer_id = $customer_id;
        $this->username = $data['username'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
        $this->phone_no = $data['phone_no'];
        $this->address = $data['address'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->password = Password::decrypt($data['password']);
        $this->is_worker = $data['is_worker'];
        $this->img = $data['img'];
        $this->total_hirings_count = $data['total_hirings_count'];
        $this->total_payment = $data['total_payment'];
        $this->registered_date = $data['registered_date'];
    }


    public function sendOffer(Customer $customer)
    {
        $customer_id = $customer->getCustomer_id();
    }
    /**
     * Get the value of customer_id
     */
    public function getCustomer_id()
    {
        return $this->customer_id;
    }

    /**
     * Get the value of username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     */
    public function setFirstname($firstname)
    {
        QueryHandler::query("UPDATE `customer` SET firstname = '" . $firstname . "' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->firstname = $firstname;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     */
    public function setLastname($lastname)
    {
        QueryHandler::query("UPDATE `customer` SET lastname = '" . $lastname . "' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->lastname = $lastname;
    }


    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of phone_no
     */
    public function getPhone_no()
    {
        return $this->phone_no;
    }

    /**
     * Set the value of phone_no
     */
    public function setPhone_no($phone_no)
    {
        QueryHandler::query("UPDATE `customer` SET phone_no = '" . $phone_no . "' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->phone_no = $phone_no;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     */
    public function setAddress($address)
    {
        QueryHandler::query("UPDATE `customer` SET address = '" . QueryHandler::real_escape_string($address) . "' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->address = $address;
    }


    /**
     * Get the value of latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the value of latitude
     */
    public function setLatitude($latitude)
    {
        QueryHandler::query("UPDATE `customer` SET latitude = '" . $latitude . "' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->latitude = $latitude;
    }


    /**
     * Get the value of longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     */
    public function setLongitude($longitude)
    {
        QueryHandler::query("UPDATE `customer` SET longitude = '" . $longitude . "' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->longitude = $longitude;
    }


    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password)
    {
        $newpassword = Password::encrypt($password);
        QueryHandler::query("UPDATE `customer` SET password = '$newpassword' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->password = $password;
    }


    /**
     * Get the value of is_worker
     */
    public function getIs_worker()
    {
        return $this->is_worker;
    }

    /**
     * Set the value of is_worker
     */
    public function setIs_worker($is_worker)
    {
        QueryHandler::query("UPDATE `customer` SET is_worker = '" . QueryHandler::real_escape_string($is_worker) . "' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->is_worker = $is_worker;
    }



    /**
     * Get the value of img
     */
    public function getImg()
    {
        if (isset($this->tmp_image)) {
            return $this->tmp_image;
        }
        return $this->img;
    }

    /**
     * Set the value of img
     */
    public function setImg($img)
    {
        QueryHandler::query("UPDATE `customer` SET img = '$img' WHERE customer_id = '" . $this->customer_id . "' LIMIT 1");
        $this->img = $img;
    }

    /**
     * Get the value of total_hirings_count
     */
    public function getTotal_hirings_count()
    {
        return $this->total_hirings_count;
    }

    /**
     * Set the value of total_hirings_count
     */
    public function setTotal_hirings_count($total_hirings_count)
    {
        $this->total_hirings_count = $total_hirings_count;
    }


    /**
     * Get the value of total_payment
     */
    public function getTotal_payment()
    {
        return $this->total_payment;
    }

    /**
     * Set the value of total_payment
     */
    public function setTotal_payment($total_payment)
    {
        $this->total_payment = $total_payment;
    }

    /**
     * Get the value of registered_date
     */
    public function getRegistered_date()
    {
        return $this->registered_date;
    }

    /**
     * Set the value of registered_date
     */
    public function setRegistered_date($registered_date)
    {
        $this->registered_date = $registered_date;
    }

    public function editProfile($customerNewDetails)
    {
        $error = "";
        $success = array();

        if (array_key_exists("img", $customerNewDetails)) {
            rename($customerNewDetails["img"], $this->getImg());
            $success[] = "Profile Picture";
        }

        if ($customerNewDetails["fname"] != $this->getFirstname()) {
            $this->setFirstname($customerNewDetails["fname"]);
            $success[] = "First Name";
        }
        if ($customerNewDetails["lname"] != $this->getLastname()) {
            $this->setLastname($customerNewDetails["lname"]);
            $success[] = "Last Name";
        }
        if ($customerNewDetails["address"] != $this->getAddress()) {
            $this->setAddress($customerNewDetails["address"]);
            $this->setLongitude($customerNewDetails["lng"]);
            $this->setLatitude($customerNewDetails["lat"]);
            $success[] = "Address";
        }

        if ($customerNewDetails["phoneno"] != $this->getPhone_no()) {
            $this->setPhone_no($customerNewDetails["phoneno"]);
            $success[] = "Phone Number";
        }

        if ($customerNewDetails["currentpassword"] != "" && $customerNewDetails["newpassword"] != "") {
            if ($customerNewDetails["confirmpassword"] != "") {
                if ($this->getPassword() == $customerNewDetails["currentpassword"]) {
                    if ($customerNewDetails["newpassword"] == $customerNewDetails["confirmpassword"]) {
                        $this->setPassword($customerNewDetails["newpassword"]);
                        $success[] = "Password";
                    } else {
                        $error = "New password didn't match with confirm password";
                    }
                } else {
                    $error = "Current password didn't match";
                }
            } else {
                $error = "Confirmation of new password wasn't provided";
            }
        }
        $status = array();
        $status["success"] = $success;
        $status["error"] = $error;
        return $status;
    }

    public function uploadProfilePic($file)
    {
        $id = $this->getCustomer_id();
        $status = File::upload($file, FileType::IMAGE, "Customer/Assets/customerProfilePic/tmp/$id");
        if ($status["errorUploadFile"] == "") {
            $this->tmp_image = $status["fileName"];
        }

        return $status["errorUploadFile"];
    }

    public function getTmp_image()
    {
        return $this->tmp_image;
    }



    public function logout($location)
    {
        if ($this->getIs_worker() == 1) {
            $tradesman  = new Tradesman();
            $tradesman->read($this->customer_id);
            $tradesman->setState(new TradesmanAsTradesman());
            $tradesman->setActive_status(new Offline());
        }
        session_unset();
        header("Location: $location");
    }

    public function registerAsTradesman($tradesmanDetails)
    {
        $query = "INSERT INTO `tradesman` (`tradesman_id`,`username`,`yrs_of_experience`,`description`) VALUES ('" .
            $this->customer_id . "','" .
            $this->username . "','" .
            $tradesmanDetails["experience"] . "','" .
            $tradesmanDetails["description"] . "'" .
            ")";
        if (QueryHandler::query($query)) {
            foreach ($tradesmanDetails['works'] as $work) {
                $this->addService($work);
            }
            $this->setIs_worker(1);
            header("Location: header.php");
        }
    }

    public function addService($provider_name)
    {
        $service = new Service();
        $service->readByPName($provider_name);
        $query = "INSERT INTO `service_of_tradesman` (`tradesman_id`,`service_id`,`service_name`) VALUES ('" .
            $this->customer_id . "','" .
            $service->getService_id() . "','" .
            $service->getService_name() . "'" .
            ")";
        QueryHandler::query($query);

        $service->setTotal_tradesman(($service->getTotal_tradesman() + 1));
        return $service->getService_id();
    }

    public function searchService($enteredService)
    {
        $sql = "SELECT `service_id` FROM `service` WHERE service_name = '$enteredService'";
        $result = QueryHandler::query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row["service_id"];
        } else {
            return false;
        }
    }

    public function searchTradesman($enteredTradesman)
    {
        $sql = "SELECT `tradesman_id` FROM `tradesman` WHERE username = '$enteredTradesman'";
        $result = QueryHandler::query($sql);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row["tradesman_id"];
        } else {
            return false;
        }
    }

    public function search($enteredST)
    {
        if (($service_id = $this->searchService($enteredST))) {
            Header("Location: service.php?id=$service_id");
        } else if (($tradesman_id = $this->searchTradesman($enteredST))) {
            Header("Location: tradesmanProfile.php?id=$tradesman_id");
        }
        return false;
    }

    public function findNearTradesmanHireNow($lat1, $lng1, $service_id)
    {
        $distanceArr = array();
        //$tradesman_lat_lng = "SELECT latitude,longitude,customer_id FROM customer  WHERE customer_id !=' $this->customer_id'";
        //$tradesman_lat_lng2 = "SELECT customer.latitude, customer.longitude, customer.customer_id FROM customer,tradesman,service_of_tradesman WHERE tradesman.tradesman_id !=' $this->customer_id' AND service_of_tradesman.service_id='$service_id' AND tradesman.active_status='online'";

        $query_service = "SELECT tradesman_id FROM service_of_tradesman  WHERE service_id =' $service_id'";
        $query_service_result = QueryHandler::query($query_service);
        if (mysqli_num_rows($query_service_result) > 0) {
            while ($row1 = mysqli_fetch_assoc($query_service_result)) {
                $tradesmanID = $row1['tradesman_id'];
                $tradesman_query = "SELECT tradesman_id FROM tradesman  WHERE tradesman_id = '$tradesmanID' AND active_status ='online'";
                $tradesman_result =  QueryHandler::query($tradesman_query);
                //echo "<script>console.log($tradesmanID)</script>";
                if (mysqli_num_rows($tradesman_result) > 0) {
                    while ($row2 = mysqli_fetch_assoc($tradesman_result)) {
                        $tradesmanID2 = $row2['tradesman_id'];

                        $tradesman_lat_lng = "SELECT latitude,longitude,customer_id FROM customer  WHERE customer_id ='$tradesmanID2' AND customer_id !=' $this->customer_id'";
                        $lat_lng_result = QueryHandler::query($tradesman_lat_lng);

                        if (mysqli_num_rows($lat_lng_result) > 0) {
                            while ($row1 = mysqli_fetch_assoc($lat_lng_result)) {
                                $lat2 = $row1['latitude'];
                                $lng2 = $row1['longitude'];
                                $tradesman_id = $row1['customer_id'];
                                // echo "<script>let x{$tradesman_id};</script>";  
                                // $temp='';
                                // echo "<script>x{$tradesman_id}=(getDistanceFromLatlngInKm($lat1,$lng1,$lat2,$lng2));</script>";             
                                // $temp = "<script>document.writeln(x{$tradesman_id})</script>";
                                // echo "<script>alert({$temp})</script>";

                                $delta_lat = $lat2 - $lat1;
                                $delta_lon = $lng2 - $lng1;

                                $earth_radius = 6372.795477598;

                                $alpha    = $delta_lat / 2;
                                $beta     = $delta_lon / 2;
                                $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                $c        = asin(min(1, sqrt($a)));
                                $distance = 2 * $earth_radius * $c;
                                $distance = round($distance, 4);

                                $distanceArr[$tradesman_id] = $distance;
                            }
                        }
                    }
                }
            }
        }


        $js = json_encode($distanceArr);
        echo "<script>console.log($js)</script>";
        asort($distanceArr);
        //echo "<script>let x = initMap2()</script>";
        return $distanceArr;
    }


    public function findNearTradesmanHireSchedule($lat1, $lng1, $service_id)
    {
        $distanceArr = array();
        //$tradesman_lat_lng = "SELECT latitude,longitude,customer_id FROM customer  WHERE customer_id !=' $this->customer_id'";
        //$tradesman_lat_lng2 = "SELECT customer.latitude, customer.longitude, customer.customer_id FROM customer,tradesman,service_of_tradesman WHERE tradesman.tradesman_id !=' $this->customer_id' AND service_of_tradesman.service_id='$service_id'";

        $query_service = "SELECT tradesman_id FROM service_of_tradesman  WHERE service_id =' $service_id'";
        $query_service_result = QueryHandler::query($query_service);
        if (mysqli_num_rows($query_service_result) > 0) {
            while ($row1 = mysqli_fetch_assoc($query_service_result)) {
                $tradesmanID = $row1['tradesman_id'];
                $tradesman_query = "SELECT tradesman_id FROM tradesman  WHERE tradesman_id = '$tradesmanID' ";
                $tradesman_result = QueryHandler::query($tradesman_query);

                if (mysqli_num_rows($tradesman_result) > 0) {
                    while ($row2 = mysqli_fetch_assoc($tradesman_result)) {
                        $tradesmanID2 = $row2['tradesman_id'];

                        $tradesman_lat_lng = "SELECT latitude,longitude,customer_id FROM customer  WHERE customer_id ='$tradesmanID2' AND customer_id !=' $this->customer_id'";
                        $lat_lng_result = QueryHandler::query($tradesman_lat_lng);

                        if (mysqli_num_rows($lat_lng_result) > 0) {
                            while ($row1 = mysqli_fetch_assoc($lat_lng_result)) {
                                $lat2 = $row1['latitude'];
                                $lng2 = $row1['longitude'];
                                $tradesman_id = $row1['customer_id'];

                                $delta_lat = $lat2 - $lat1;
                                $delta_lon = $lng2 - $lng1;

                                $earth_radius = 6372.795477598;

                                $alpha    = $delta_lat / 2;
                                $beta     = $delta_lon / 2;
                                $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin(deg2rad($beta)) * sin(deg2rad($beta));
                                $c        = asin(min(1, sqrt($a)));
                                $distance = 2 * $earth_radius * $c;
                                $distance = round($distance, 4);

                                $distanceArr[$tradesman_id] = $distance;
                            }
                        }
                    }
                }
            }
        }


        $js = json_encode($distanceArr);
        echo "<script>console.log($js)</script>";
        asort($distanceArr);
        return $distanceArr;
    }
}

class Tradesman extends Customer
{
    private $tradesman_id;
    private $yrs_of_experience;
    private $description;
    private $active_status;
    private $num_of_review;
    private $num_of_ratings;
    private $average_rating;
    private $total_earnings;
    private $num_of_hirings;
    private $reg_date_as_tradesman;
    private $state;
    private $services;
    private $tradesmans;
    private $hiring_list;

    public function __construct()
    {
    }
    public static function getInstance($tradesman_id)
    {
        if (!array_key_exists($tradesman_id, self::$tradesmans)) {
            $sql = "SELECT `tradesman_id` FROM `tradesman` WHERE customer_id = $tradesman_id";
            if (QueryHandler::query($sql)->num_rows == 0) {
                return null;
            } else {
                self::$tradesmans[$tradesman_id] = new Customer();
                self::$tradesmans[$tradesman_id]->read($tradesman_id);
            }
        }
        return self::$tradesmans[$tradesman_id];
    }

    public function read($tradesman_id)
    {
        parent::read($tradesman_id);
        $this->tradesman_id = $tradesman_id;
        $result = QueryHandler::query("SELECT * from tradesman WHERE tradesman_id='$tradesman_id'");
        $row = mysqli_fetch_assoc($result);
        $this->yrs_of_experience =  $row['yrs_of_experience'];
        $this->description = $row['description'];
        $this->num_of_review = $row['num_of_reviews'];
        $this->average_rating = $row['average_rating'];
        $this->num_of_ratings = $row['num_of_ratings'];
        $this->total_earnings = $row['total_earnings'];
        $this->num_of_hirings = $row['num_of_hirings'];
        $this->reg_date_as_tradesman = $row['reg_date_as_tradesman'];

        if ($row['state'] == "TAT") {
            $this->state = new TradesmanAsTradesman();
        } else {
            $this->state = new TradesmanAsCustomer();
        }

        if ($row['active_status'] == "ONLINE") {
            $this->active_status = new Online();
        } else {
            $this->active_status = new Offline();
        }

        $query = "SELECT `service_id` FROM `service_of_tradesman` WHERE tradesman_id = $tradesman_id";
        $result = QueryHandler::query($query);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        foreach ($rows as $row) {
            //$service = new Service();
            //$service->read($row['service_id']);
            $this->services[] = $row['service_id'];
        }
    }

    public function checkHiringTimeCome($tradesman_id)
    {

        echo "Tradesman ID is : " . $tradesman_id . " <br>";
        $result = QueryHandler::query("SELECT * from hiring WHERE tradesman_id='$tradesman_id'");
        while ($row = mysqli_fetch_assoc($result)) {
            $html = '';
            if (($row['date'] != NULL) && ($row['date'] == date("Y-m-d"))) {
                $timeNow = date("H:i:s");
                $timeNow = strtotime("+270 minutes", strtotime($timeNow));
                $timeNow = date("H:i:s", ($timeNow));
                echo  $timeNow . "  ";
                $timeHiring = $row['time'];

                $timeHiring = date("H:i:s", strtotime($timeHiring));
                echo  $timeHiring . "  ";
                $hiringNotifyStart = strtotime("-60 minutes", strtotime($timeHiring));
                $hiringNotifyStart = date("H:i:s", ($hiringNotifyStart));
                echo $hiringNotifyStart . "  <br>";

                echo $row['date'];
                echo "<br>";
                echo "today....";
                if (($timeNow < $timeHiring) && ($hiringNotifyStart < $timeNow)) {
                    echo "you have an shedule within some time";
                }
            }
        }
        return $html;
    }

    /**
     * Get the value of tradesman_id
     */
    public function getTradesman_id()
    {
        return $this->tradesman_id;
    }



    /**
     * Get the value of yrs_of_experience
     */
    public function getYrs_of_experience()
    {
        return $this->yrs_of_experience;
    }

    /**
     * Set the value of yrs_of_experience
     */
    public function setYrs_of_experience($yrs_of_experience)
    {
        $this->yrs_of_experience = $yrs_of_experience;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription($description)
    {
        QueryHandler::query("UPDATE `tradesman` SET description = '$description' WHERE tradesman_id = '" . $this->tradesman_id . "' LIMIT 1");
        $this->description = $description;
    }

    /**
     * Get the value of active_status
     */
    public function getActive_status()
    {
        return $this->active_status;
    }

    /**
     * Set the value of active_status
     */
    public function setActive_status($active_status)
    {
        $stateType = $active_status->getACTIVE_STATUS();
        QueryHandler::query("UPDATE `tradesman` SET active_status = '$stateType' WHERE tradesman_id = '" . $this->tradesman_id . "' LIMIT 1");
        $this->active_status = $active_status;
    }

    /**
     * Get the value of num_of_review
     */
    public function getNum_of_review()
    {
        return $this->num_of_review;
    }

    /**
     * Set the value of num_of_review
     */
    public function setNum_of_review($num_of_review)
    {
        $this->num_of_review = $num_of_review;
    }

    /**
     * Get the value of num_of_ratings
     */
    public function getNum_of_ratings()
    {
        return $this->num_of_ratings;
    }

    /**
     * Set the value of num_of_ratings
     */
    public function setNum_of_ratings($num_of_ratings)
    {
        $this->num_of_ratings = $num_of_ratings;
    }

    /**
     * Get the value of average_rating
     */
    public function getAverage_rating()
    {
        return $this->average_rating;
    }

    /**
     * Set the value of average_rating
     */
    public function setAverage_rating($average_rating)
    {
        $this->average_rating = $average_rating;
    }

    /**
     * Get the value of total_earnings
     */
    public function getTotal_earnings()
    {
        return $this->total_earnings;
    }

    /**
     * Set the value of total_earnings
     */
    public function setTotal_earnings($total_earnings)
    {
        $this->total_earnings = $total_earnings;
    }

    /**
     * Get the value of num_of_hirings
     */
    public function getNum_of_hirings()
    {
        return $this->num_of_hirings;
    }

    /**
     * Set the value of num_of_hirings
     */
    public function setNum_of_hirings($num_of_hirings)
    {
        $this->num_of_hirings = $num_of_hirings;
    }

    /**
     * Get the value of reg_date_as_tradesman
     */
    public function getReg_date_as_tradesman()
    {
        return $this->reg_date_as_tradesman;
    }

    public function editProfile($customerNewDetails)
    {
        $status = parent::editProfile($customerNewDetails);
        if ($customerNewDetails["description"] != $this->getDescription()) {
            $this->setDescription($customerNewDetails["description"]);
            $status["success"][] = "Description";
        }

        foreach ($customerNewDetails['works'] as $work) {
            $this->addService($work);
        }

        foreach ($this->services as $service_id) {
            $service = new Service();
            $service->read($service_id);
            if (!in_array($service->getProvider_name(), $customerNewDetails['works'])) {
                $this->removeService($service->getProvider_name());
            }
        }
        return $status;
    }

    public function addService($provider_name)
    {
        $service = new Service();
        $service->readByPName($provider_name);
        if (!in_array($service->getService_id(), $this->services)) {
            $this->services[] = parent::addService($provider_name);
        }
    }

    public function removeService($provider_name)
    {
        $service = new Service();
        $service->readByPName($provider_name);
        if (in_array($service->getService_id(), $this->services)) {
            $id = $service->getService_id();
            $query = "DELETE FROM `service_of_tradesman` WHERE tradesman_id = $this->tradesman_id AND service_id = $id";
            QueryHandler::query($query);
            unset($this->services[array_search($id, $this->services)]);
            $service->setTotal_tradesman(($service->getTotal_tradesman() - 1));
        }
    }

    public function switch()
    {
        $this->state->switch($this);
    }

    public function toggle()
    {
        $this->active_status->toggle($this);
    }

    public function getState()
    {
        return $this->state;
    }



    public function setState($state)
    {
        $stateType = $state->getSTATE();
        QueryHandler::query("UPDATE `tradesman` SET state = '$stateType' WHERE tradesman_id = '" . $this->tradesman_id . "' LIMIT 1");
        $this->state = $state;
    }

    public function isOnline()
    {
        return $this->active_status instanceof Online;
    }

    public function login()
    {
        $this->setActive_status(new Online());
    }

    public function hasService($service_id)
    {
        // foreach ($this->services as $service) {
        //     if ($service->getProvider_name() == $provider_name) {
        //         return true;
        //     }
        // }
        // return false;

        return in_array($service_id, $this->services);
    }
}

abstract class TradesmanState
{
    private $STATE;
    public function __construct($STATE)
    {
        $this->STATE = $STATE;
    }

    public function getSTATE()
    {
        return $this->STATE;
    }

    public abstract function switch($tradesman);
}

class TradesmanAsTradesman extends TradesmanState
{

    public function __construct()
    {
        parent::__construct("TAT");
    }

    public function switch($tradesman)
    {
        $tradesman->setState(new TradesmanAsCustomer());
    }
}

class TradesmanAsCustomer extends TradesmanState
{
    public function __construct()
    {
        parent::__construct("TAC");
    }

    public function switch($tradesman)
    {
        $tradesman->setState(new TradesmanAsTradesman());
    }
}

abstract class ActiveStatus
{
    private $ACTIVE_STATUS;
    public function __construct($ACTIVE_STATUS)
    {
        $this->ACTIVE_STATUS = $ACTIVE_STATUS;
    }

    public function getACTIVE_STATUS()
    {
        return $this->ACTIVE_STATUS;
    }

    public abstract function toggle($tradesman);
}

class Online extends ActiveStatus
{

    public function __construct()
    {
        parent::__construct("ONLINE");
    }

    public function toggle($tradesman)
    {
        $tradesman->setActive_status(new Offline());
    }
}

class Offline extends ActiveStatus
{
    public function __construct()
    {
        parent::__construct("OFFLINE");
    }

    public function toggle($tradesman)
    {
        $tradesman->setActive_status(new Online());
    }
}


class Hiring
{
    private $hiring_id;
    private $tradesman_id;
    private $service_id;
    private $customer_id;
    private $registered_dateTime;
    private $completed_cancelled_date;
    private $hiring_amount;
    private $payment_method;
    private $rating;
    private $review;
    private $final_status;
    private $current_status;
    private $latitude;
    private $longitude;
    private $address;
    private $chatlist;
    private $current;
    private $date;
    private $time;

    public function __construct()
    {
    }


    public function read($hiring_id)
    {
        $this->chatlist = array();
        $result = QueryHandler::query("SELECT * from hiring WHERE hiring_id='$hiring_id'");
        $data = mysqli_fetch_assoc($result);

        $this->hiring_id = $hiring_id;
        $this->tradesman_id = $data['tradesman_id'];
        $this->service_id = $data['service_id'];
        $this->customer_id = $data['customer_id'];
        $this->registered_dateTime = $data['registered_dateTime'];
        $this->completed_cancelled_date = $data['completed_cancelled_date'];
        $this->hiring_amount = $data['hiring_amount'];
        $this->payment_method = $data['payment_method'];
        $this->rating = $data['rating'];
        $this->review = $data['review'];
        $this->final_status = $data['final_status'];
        $this->current_status = $data['current_status'];
        $this->latitude = $data['latitude'];
        $this->longitude = $data['longitude'];
        $this->address = $data['address'];
    }


    /**
     * Get the value of time
     */
    public function getTime()
    {
        return $this->time;
    }


    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }
    public function getChatlist()
    {
        return $this->chatlist;
    }

    /**
     * Set the value of chatlist
     *
     * @return  self
     */
    public function setChatlist($chatlist)
    {
        $this->chatlist = $chatlist;

        return $this;
    }
    /**
     * Get the value of hiring_id
     */
    public function getHiring_id()
    {
        return $this->hiring_id;
    }

    /**
     * Get the value of tradesman_id
     */
    public function getTradesman_id()
    {
        return $this->tradesman_id;
    }

    /**
     * Get the value of service_id
     */
    public function getService_id()
    {
        return $this->service_id;
    }

    /**
     * Get the value of customer_id
     */
    public function getCustomer_id()
    {
        return $this->customer_id;
    }

    /**
     * Get the value of registered_dateTime
     */
    public function getRegistered_dateTime()
    {
        return $this->registered_dateTime;
    }

    /**
     * Get the value of completed_cancelled_date
     */
    public function getCompleted_cancelled_date()
    {
        return $this->completed_cancelled_date;
    }

    /**
     * Get the value of hiring_amount
     */
    public function getHiring_amount()
    {
        return $this->hiring_amount;
    }

    /**
     * Get the value of payment_method
     */
    public function getPayment_method()
    {
        return $this->payment_method;
    }

    /**
     * Get the value of rating
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Get the value of review
     */
    public function getReview()
    {
        return $this->review;
    }

    /**
     * Get the value of final_status
     */
    public function getFinal_status()
    {
        return $this->final_status;
    }

    /**
     * Get the value of current_status
     */
    public function getCurrent_status()
    {
        return $this->current_status;
    }

    /**
     * Get the value of latitude
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get the value of longitude
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Get the value of address
     */
    public function getAddress()
    {
        return $this->address;
    }

    //----------   get other class details   -------------------

    public function getProvider_name($service_id)
    {
        $sql = "SELECT * FROM service WHERE service_id = '$service_id'";
        $result_service = QueryHandler::query($sql);




        if (mysqli_num_rows($result_service) > 0) {
            $row = mysqli_fetch_assoc($result_service);

            $provider_name = $row["provider_name"];
        }
        return $provider_name;
    }

    public function getService_name($service_id)
    {
        $sql = "SELECT * FROM service WHERE service_id = '$service_id'";
        $result_service = QueryHandler::query($sql);




        if (mysqli_num_rows($result_service) > 0) {
            $row = mysqli_fetch_assoc($result_service);

            $service_name = $row["service_name"];
        }
        return $service_name;
    }











    //---------------------    setters    --------------------------
    /**
     * Set the value of completed_cancelled_date
     */
    public function setCompleted_cancelled_date($completed_cancelled_date)
    {
        $this->completed_cancelled_date = $completed_cancelled_date;
    }

    /**
     * Set the value of hiring_amount
     */
    public function setHiring_amount($hiring_amount)
    {
        $this->hiring_amount = $hiring_amount;
    }

    /**
     * Set the value of payment_method
     */
    public function setPayment_method($payment_method)
    {
        $this->payment_method = $payment_method;
    }

    /**
     * Set the value of rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * Set the value of review
     */
    public function setReview($review)
    {
        $this->review = $review;
    }

    /**
     * Set the value of final_status
     */
    public function setFinal_status($final_status)
    {
        $this->final_status = $final_status;
    }

    /**
     * Set the value of current_status
     */
    public function setCurrent_status()
    {
        if ($this->getCurrent_status() == "") {
            $this->current = new On_the_way();
        } else if ($this->getCurrent_status() == "On the way") {
            $this->current = new On_the_way();
        } else if ($this->getCurrent_status() == "Reached") {
            $this->current = new Reached();
        } else if ($this->getCurrent_status() == "On work") {
            $this->current = new On_work();
        } else if ($this->getCurrent_status() == "Payment added") {
            $this->current = new Payment_added();
        } else if ($this->getCurrent_status() == "Paid") {
            $this->current = new Paid();
        }

        $this->current_status = $this->current->setState();
    }
    public function setCurrent(State $state)
    {
        $this->current = $state;
        $this->current_status = $this->current->setState();
    }

    /**
     * Set the value of latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * Set the value of longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * Set the value of address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }


    //---------------------------------------state---------------------
    public function changeState()
    {
        $this->current->changeState($this);
    }

    public function cancelHiring()
    {
        $this->current->cancelHiring($this);
    }
}



class Service
{
    private $service_id;
    private $service_name;
    private $provider_name;
    private $total_tradesman;
    private $total_hirings;
    private $average_rating;
    private $cover_photo;


    public function read($service_id)
    {

        $result = QueryHandler::query("SELECT * from service WHERE service_id='$service_id'");
        $data = mysqli_fetch_assoc($result);
        $this->service_id = $service_id;
        $this->service_name = $data['service_name'];
        $this->provider_name = $data['provider_name'];
        $this->total_tradesman = $data['total_tradesman'];
        $this->total_hirings = $data['total_hirings'];
        $this->average_rating = $data['average_rating'];
        $this->cover_photo = $data['cover_photo'];
    }

    public function readByPName($provider_name)
    {
        $result = QueryHandler::query("SELECT * from service WHERE provider_name='$provider_name'");
        $data = mysqli_fetch_assoc($result);
        $this->provider_name = $provider_name;
        $this->service_id = $data['service_id'];
        $this->service_name = $data['service_name'];
        $this->total_tradesman = $data['total_tradesman'];
        $this->total_hirings = $data['total_hirings'];
        $this->average_rating = $data['average_rating'];
        $this->cover_photo = $data['cover_photo'];
    }


    /**
     * Get the value of provider_name
     */
    public function getProvider_name()
    {
        return $this->provider_name;
    }

    /**
     * Get the value of service_name
     */
    public function getService_name()
    {
        return $this->service_name;
    }

    /**
     * Get the value of service_id
     */
    public function getService_id()
    {
        return $this->service_id;
    }

    /**
     * Get the value of total_tradesman
     */
    public function getTotal_tradesman()
    {
        return $this->total_tradesman;
    }

    /**
     * Get the value of totoal_hirings
     */
    public function getTotal_hirings()
    {
        return $this->total_hirings;
    }

    /**
     * Get the value of average_rating
     */
    public function getAverage_rating()
    {
        return $this->average_rating;
    }

    /**
     * Get the value of cover_photo
     */
    public function getCover_photo()
    {
        return $this->cover_photo;
    }

    /**
     * Set the value of service_id
     *
     * @return  self
     */
    public function setService_id($service_id)
    {
        $this->service_id = $service_id;

        return $this;
    }

    /**
     * Set the value of service_name
     *
     * @return  self
     */
    public function setService_name($service_name)
    {
        $this->service_name = $service_name;

        return $this;
    }

    /**
     * Set the value of provider_name
     *
     * @return  self
     */
    public function setProvider_name($provider_name)
    {
        $this->provider_name = $provider_name;

        return $this;
    }

    /**
     * Set the value of total_tradesman
     *
     * @return  self
     */
    public function setTotal_tradesman($total_tradesman)
    {
        QueryHandler::query("UPDATE `service` SET total_tradesman = '" . $total_tradesman . "' WHERE service_id = '" . $this->service_id . "' LIMIT 1");
        $this->total_tradesman = $total_tradesman;

        return $this;
    }

    /**
     * Set the value of totoal_hirings
     *
     * @return  self
     */
    public function setTotal_hirings($total_hirings)
    {
        $this->total_hirings = $total_hirings;

        return $this;
    }

    /**
     * Set the value of average_rating
     *
     * @return  self
     */
    public function setAverage_rating($average_rating)
    {
        $this->average_rating = $average_rating;

        return $this;
    }

    /**
     * Set the value of cover_photo
     *
     * @return  self
     */
    public function setCover_photo($cover_photo)
    {
        $this->cover_photo = $cover_photo;

        return $this;
    }
}


class Chat
{
    private $message;
    private $hiring_id;
    private  $date_time;
    private $sender;
    private $receiver;

    function __construct($message, $hiring_id, $date_time, $sender, $receiver)
    {
        $this->message = $message;
        $this->hiring_id = $hiring_id;
        $this->date_time = $date_time;
        $this->sender = $sender;
        $this->receiver = $receiver;
    }
    public function getMessage()
    {
        return $this->message;
    }
    public function getHiring_id()
    {
        return $this->hiring_id;
    }
    public function getDate_time()
    {
        return $this->date_time;
    }
    public function getSender()
    {
        return $this->sender;
    }
    public function getReceiver()
    {
        return $this->receiver;
    }
}

class Password
{
    private string $key;

    public function getKey(): string
    {
        return $this->key;
    }

    public function setKey(string $key)
    {
        $this->key = $key;
    }

    public static function encrypt(string $decryptedText): string
    {
        $encryptedText = "";
        $chars = str_split($decryptedText);
        foreach ($chars as $char) {
            $encryptedChar = (ord($char) + 5) . "$";
            $encryptedText .= $encryptedChar;
        }
        return $encryptedText;
    }

    public static function decrypt(string $encryptedText): string
    {
        $decryptedText = "";
        $ords = explode("$", trim($encryptedText, '$'));
        foreach ($ords as $ord) {
            $decryptedChar = chr((int)$ord - 5);
            $decryptedText .= $decryptedChar;
        }
        return $decryptedText;
    }
}

class UserType
{
    const CUSTOMER = 0;
    const TRADESMAN = 1;
}

class FileType
{
    public const IMAGE = array("jpg", "jpeg", "png");
    public const VIEW_PRINT = array("pdf");
}

class File
{
    public static int $allowedMaxSize = 16777216;

    public static function upload(array $file, array $fileType, String $into)
    {
        $statusOfUpload = array();
        $errors = "";
        $newFileName = "";

        $fileExt = strtolower(explode('.', $file['name'])[1]);
        if (count($fileType) != 0 && in_array($fileExt, $fileType) === false) {
            $errors .= "This extension isn't allowed.";
        }

        if ($file['size'] > self::$allowedMaxSize) {
            $errors .= 'File size must be less than or equal to ' .
                (self::$allowedMaxSize / (1024 * 1024)) . ' MB.';
        }

        if (empty($errors) == true) {
            $newFileName = "$into.$fileExt";
            move_uploaded_file($file['tmp_name'], $newFileName);
        }
        $statusOfUpload["errorUploadFile"] = $errors;
        $statusOfUpload["fileName"] = $newFileName;
        return $statusOfUpload;
    }
}

class SignUpper
{
    private $tmp_image;
    private $default_image;

    public function __construct()
    {
        $this->default_image = "Customer/Assets/customerProfilePic/default.png";
    }

    public function getImg()
    {
        if (isset($this->tmp_image)) {
            return $this->tmp_image;
        }
        return $this->default_image;
    }

    public function uploadProfilePic($file)
    {
        $id = (((QueryHandler::query("SELECT MAX(`customer_id`) AS `id` FROM `customer`"))->fetch_assoc())["id"]) + 1;
        $status = File::upload($file, FileType::IMAGE, "Customer/Assets/customerProfilePic/tmp/$id");
        if ($status["errorUploadFile"] == "") {
            $this->tmp_image = $status["fileName"];
        }

        return $status["errorUploadFile"];
    }

    public function register($data)
    {
        $error = "";
        if ($result = QueryHandler::query("SELECT `customer_id` FROM `customer` WHERE username = '" . $data["username"] . "' OR email = '" . $data["email"] . "'")) {
            if ($result->num_rows == 0) {
                if ($data["password"] == $data["confirmpassword"]) {
                    $query = "INSERT INTO `customer` (`username`,`firstname`,`lastname`,`email`,`phone_no`,`address`,`longitude`,`latitude`,`password`) VALUES ('" .
                        $data["username"] . "','" .
                        $data["fname"] . "','" .
                        $data["lname"] . "','" .
                        $data["email"] . "','" .
                        $data["phoneno"] . "','" .
                        $data["address"] . "','" .
                        $data["lng"] . "','" .
                        $data["lat"] . "','" .
                        Password::encrypt($data["password"]) . "'" .
                        ")";
                    if (QueryHandler::query($query)) {
                        $id = QueryHandler::$insert_id;
                        $fileExt = strtolower(explode('.', $data["img"])[1]);
                        $newFile = "Customer/Assets/customerProfilePic/$id.$fileExt";
                        if ($data["img"] != $this->default_image) {
                            rename($data["img"], $newFile);
                        } else {
                            copy($data["img"], $newFile);
                        }
                        QueryHandler::query("UPDATE `customer` SET img = '$newFile' WHERE customer_id = '" . $id . "' LIMIT 1");
                        $_SESSION["customer_id"] = $id;
                        header("Location: header.php");
                    }
                } else {
                    $error = "Password doesn't match with confirm password";
                }
            } else {
                $error = "Username or Email already exist";
            }
        } else {
            $error = "Something went wrong.Try again";
        }
        return $error;
    }
}

class Service_of_tradesman
{
    private $st_id;
    private $tradesman_id;
    private $service_id;
    private $service_name;
    private $average_rating;
    private $total_hirings;
    private $total_earnings;

    public function read($st_id)
    {

        $result = QueryHandler::query("SELECT * from service_of_tradesman WHERE st_id='$st_id'");
        $data = mysqli_fetch_assoc($result);
        $this->st_id = $st_id;
        $this->tradesman_id = $data['tradesman_id'];
        $this->service_id = $data['service_id'];
        $this->service_name = $data['service_name'];
        $this->average_rating = $data['average_rating'];
        $this->total_hirings = $data['total_hirings'];
        $this->total_earnings = $data['total_earnings'];
    }


    /**
     * Get the value of st_id
     */
    public function getSt_id()
    {
        return $this->st_id;
    }

    /**
     * Get the value of tradesman_id
     */
    public function getTradesman_id()
    {
        return $this->tradesman_id;
    }

    /**
     * Get the value of service_id
     */
    public function getService_id()
    {
        return $this->service_id;
    }

    /**
     * Get the value of service_name
     */
    public function getService_name()
    {
        return $this->service_name;
    }

    /**
     * Get the value of average_rating
     */
    public function getAverage_rating()
    {
        return $this->average_rating;
    }

    /**
     * Get the value of total_hirings
     */
    public function getTotal_hirings()
    {
        return $this->total_hirings;
    }

    /**
     * Get the value of total_earnings
     */
    public function getTotal_earnings()
    {
        return $this->total_earnings;
    }
}

//----------------------------------------state----------------------------------------------------------------------------------------------
abstract class State
{
    abstract public function changeState(Hiring $hiring);
    abstract public function setState();
    abstract public function cancelHiring(Hiring $hiring);
}
class On_the_way extends State
{
    public function setState()
    {
        return "On the way";
    }
    public function changeState(Hiring $hiring)
    {
        $hiring->setCurrent(new Reached());
    }
    public function cancelHiring(Hiring $hiring)
    {
        $hiring->setCurrent(new Cancelled());
    }
}
class Reached extends State
{
    public function setState()
    {
        return "Reached";
    }
    public function changeState(Hiring $hiring)
    {
        $hiring->setCurrent(new On_work());
    }
    public function cancelHiring(Hiring $hiring)
    {
        $hiring->setCurrent(new Cancelled());
    }
}
class On_work extends State
{
    public function setState()
    {
        return "On work";
    }
    public function changeState(Hiring $hiring)
    {
        $hiring->setCurrent(new Payment_added());
    }
    public function cancelHiring(Hiring $hiring)
    {
        //$hiring->setCurrent(new Cancelled());

    }
}
class Payment_added extends State
{
    public function setState()
    {
        return "Payment added";
    }
    public function changeState(Hiring $hiring)
    {
        $hiring->setCurrent(new Paid());
    }
    public function cancelHiring(Hiring $hiring)
    {
        //$hiring->setCurrent(new Cancelled());

    }
}
class Paid extends State
{
    public function setState()
    {
        return "Paid";
    }
    public function changeState(Hiring $hiring)
    {
        $hiring->setCurrent(new Completed());
    }
    public function cancelHiring(Hiring $hiring)
    {
        //$hiring->setCurrent(new Cancelled());

    }
}
class Completed extends State
{
    public function setState()
    {
        return "Completed";
    }
    public function changeState(Hiring $hiring)
    {
        //$hiring->setCurrent(new Reached());

    }
    public function cancelHiring(Hiring $hiring)
    {
        //$hiring->setCurrent(new Cancelled());

    }
}
class Cancelled extends State
{
    public function setState()
    {
        return "Cancelled";
    }
    public function changeState(Hiring $hiring)
    {
        //$hiring->setCurrent(new Reached());

    }
    public function cancelHiring(Hiring $hiring)
    {
        //$hiring->setCurrent(new Cancelled());

    }
}







//------------------------------------------------Strategy-----------------------------------------------------------------
class Payment
{
    private $paymentStrategy;

    public function __construct()
    {
    }

    public function setStrategy($paymentStrategy)
    {
        $this->paymentStrategy = $paymentStrategy;
    }

    public function pay($amount)
    {
        return $this->paymentStrategy->pay($amount);
    }
}

interface PaymentStrategy
{
    public function pay($amount);
}

class OnlinePaymentStrategy implements PaymentStrategy
{
    private $name;
    private $cardNumber;
    private $cvv;
    private $dateOfExpiry;

    public function __construct($name, $cardNumber, $cvv, $dateOfExpiry)
    {
        $this->name = $name;
        $this->cardNumber = $cardNumber;
        $this->cvv = $cvv;
        $this->dateOfExpiry = $dateOfExpiry;
    }

    public function pay($amount)
    {
    }
}

class DirectCashPaymentStrategy implements PaymentStrategy
{

    public function __construct()
    {
    }

    public function pay($amount)
    {
    }
}

class Notification
{
    private $notification_id;
    private $time;
    private $receiver_id;
    private $seen_status;
    private $date;
    private $notification;
    private $sender_id;
    private $service_id;

    public function read($notification_id)
    {

        $sql = "SELECT * FROM notification WHERE notification_id='$notification_id';";
        $result = QueryHandler::query($sql);
        $row = mysqli_fetch_array($result);
        if (!$result) {
            die('QUERY FAIL when reading notification Table!');
        } else {
            $this->time = $row['time'];
            $this->date = $row['date'];
            $this->receiver_id = $row['receiver_id'];
            $this->seen_status = $row['seen_status'];
            $this->notification = $row['notification'];
            $this->sender_id = $row['sender_id'];
            $this->service_id = $row['service_id'];
        }
    }

    public function see_Response()
    {
    }
    public function see_Schedule()
    {
    }

    public function decline_schedule($notification_id)
    {

        $delete_sql = "DELETE FROM notification WHERE notification_id='$notification_id';";
        $result = QueryHandler::query($delete_sql);
        if (!$result) {
            die('QUERY FAIL in decline notifiacation table row!');
        }
    }


    public function countSchedule($receiver_id)
    {
        $query_1 = "SELECT * FROM notification WHERE notification is not NULL AND seen_status = 0 AND receiver_id='$receiver_id'";
        $result_1 = QueryHandler::query($query_1);
        $count = mysqli_num_rows($result_1);
        if (!$result_1) {
            die('QUERY FAIL!');
        }
        return $count;
    }


    public function countResponse($customer_id)
    {
        $query_1 = "SELECT * FROM notification WHERE notification is not NULL AND seen_status = 0 AND receiver_id='$customer_id'";
        $result_1 = QueryHandler::query($query_1);
        $count = mysqli_num_rows($result_1);
        if (!$result_1) {
            die('QUERY FAIL!');
        }
        return $count;
    }

    public function hireNow($notification, $receiver_id, $sender_id, $notification_type, $service_id, $longitude, $latitude)
    {
        $query = " INSERT INTO notification(notification, receiver_id,sender_id ,notification_type,service_id , longitude,latitude  ) VALUES ('$notification', '$receiver_id','$sender_id' , '$notification_type','$service_id', '$longitude' , '$latitude')";
        QueryHandler::query($query);
    }


    public function create($notification, $receiver_id, $sender_id, $service_id, $notification_type, $time, $date, $longitude, $latitude)
    {
        $query = " INSERT INTO notification(notification, receiver_id,sender_id, service_id,notification_type,date,time, longitude,latitude) VALUES ('$notification', '$receiver_id','$sender_id','$service_id','$notification_type','$date','$time', '$longitude' , '$latitude')";
        QueryHandler::query($query);
    }

    public function schedule($receiver_id, $sender_id, $date, $time, $notification, $service_id, $longitude, $latitude)
    {

        $query = " INSERT INTO notification( receiver_id,sender_id,date,time,notification,notification_type,service_id, longitude,latitude) VALUES ( '$receiver_id','$sender_id','$date' , '$time','$notification','common','$service_id', '$longitude' , '$latitude')";
        QueryHandler::query($query);
    }

    public function remove($notification_id)
    {
        $delete_sql = "DELETE FROM notification WHERE notification_id='$notification_id';";
        $result = QueryHandler::query($delete_sql);
        if (!$result) {
            die('QUERY FAIL in notifiacation table!');
        }
    }
    public function createHiring($date, $time, $tradesman_id, $customer_id, $service_id, $final_status, $longitude, $latitude, $current_status)
    {

        // echo $date.' '.$time.' '.$tradesman_id.' '.$customer_id.' '.$service_id;
        $query = " INSERT INTO hiring( customer_id,tradesman_id, service_id,registered_dateTime,time,final_status , longitude , latitude , current_status)
                             VALUES ( '$customer_id','$tradesman_id','$service_id','$date','$time','$final_status','$longitude' ,'$latitude' ,'$current_status');";
        $result_1 = QueryHandler::query($query);
        if (!$result_1) {
            die('QUERY FAIL!');
        }
        $query_1 = "SELECT hiring_id FROM hiring WHERE customer_id='$customer_id' AND tradesman_id='$tradesman_id' AND service_id= '$service_id' ORDER BY hiring_id DESC LIMIT 1;";
        $result_1 = QueryHandler::query($query_1);
        $row = mysqli_fetch_assoc($result_1);
        $hiring_id = $row['hiring_id'];
        // echo $hiring_id;
        return $hiring_id;
    }

    public function getHiringIDOngoing($tradesman_id, $customer_id, $service_id, $date, $time)
    {
        // echo $tradesman_id.' '.$customer_id.' '.$service_id.' '.$time;
        $query_1 = "SELECT hiring_id FROM hiring WHERE customer_id='$customer_id' AND tradesman_id='$tradesman_id' AND service_id= '$service_id' AND time='$time' ORDER BY hiring_id DESC LIMIT 1;";
        $result_1 = QueryHandler::query($query_1);
        if (!$result_1) {
            die('QUERY FAIL in getHiringIDOngoing!');
        }
        $row = mysqli_fetch_assoc($result_1);
        $hiring_id = $row['hiring_id'];
        return $hiring_id;
    }

    /**
     * Get the value of time
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of receiver_id
     */
    public function getReceiver_id()
    {
        return $this->receiver_id;
    }

    /**
     * Get the value of sender_id
     */
    public function getSender_id()
    {
        return $this->sender_id;
    }

    /**
     * Get the value of service_id
     */
    public function getService_id()
    {
        return $this->service_id;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get the value of notification
     */
    public function getNotification()
    {
        return $this->notification;
    }
}
